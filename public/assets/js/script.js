$(document).ready(function () {

    const tokenInput = $("#userToken").val();
    const app_id = window.Laravel.appId;
    const websocket = new WebSocket(`wss://ws.derivws.com/websockets/v3?app_id=${app_id}`);

    const interval_time = 12000; // Intervalo de 12 segundos para manter a conexão viva
    let interval;
    let lossCount = 0;
    let inTrade = false; // Estado do bot
    let pendingProposalId = null; // ID da proposta pendente
    let tokenUsuario = $("#userToken").val();
    let tradeStartTime = null; // Tempo de início da negociação
    const TRADE_TIMEOUT = 60000; // Tempo limite para a negociação (em milissegundos)
    const SELL_THRESHOLD = 100; // Valor do preço abaixo do qual você quer vender antecipadamente
    let currentPrice = 105; // Preço atual do ativo (inicialmente um valor fictício)
    let isSubscribedToBalance = false;

    // Variáveis de configuração do bot
    let loss_limit;
    let profit_goal;
    let initial_value;
    let value_after_win;

    if (tokenInput.trim() === "") {
        $('#loginDeriv').html(`
            <a class="text-light button" href="https://oauth.binary.com/oauth2/authorize?app_id=${app_id}&l=pt">LOGIN</a>
        `);
    } else {
        $("#btn-iniciar").html(`
            <button id="iniciarBot" class="text-light button">
                <i class="bi bi-play"></i> Iniciar Software
            </button>
        `);
    }

    // Handle the connection opening
    websocket.addEventListener('open', () => {
        console.log('WebSocket connection established');
        const authorizePayload = JSON.stringify({
            authorize: tokenUsuario,
        });
        websocket.send(authorizePayload);

        interval = setInterval(() => {
            const pingMessage = JSON.stringify({
                ping: 1
            });
            websocket.send(pingMessage);
        }, interval_time);
    });

    // Handle incoming messages
    websocket.addEventListener('message', (event) => {
        const receivedMessage = JSON.parse(event.data);
        console.log('Received Message:', receivedMessage); // Adicionado para debugging

        switch (receivedMessage.msg_type) {
            case 'authorize':
                console.log('Authorization successful');
                if (!inTrade) requestBalance();
                break;
            case 'proposal':
                if (receivedMessage.proposal && receivedMessage.proposal.id) {
                    const proposalId = receivedMessage.proposal.id;
                    pendingProposalId = proposalId;

                    // Prepare to buy after receiving the proposal
                    const buyPayload = JSON.stringify({
                        "buy": pendingProposalId,
                        "price": initial_value
                    });
                    websocket.send(buyPayload);
                    console.log(proposalId);

                    // Set trade start time
                    tradeStartTime = Date.now();
                } else {
                    console.error('Proposal ID is missing or undefined:', receivedMessage);
                }
                break;
            case 'buy':
                handleBuyResponse(receivedMessage.buy);
                break;
            case 'sell':
                handleSellResponse(receivedMessage.sell);
                break;
            case 'error':
                console.error('Error received:', receivedMessage.error);
                break;
            case 'history':
                console.log('Trade History:', receivedMessage.history);
                break;
            case 'balance':
                handleBalanceResponse(receivedMessage.balance);
                break;
            case 'price':
                updateCurrentPrice(receivedMessage.price);
                break;
        }
    });

    function handleBuyResponse(buyResult) {
        if (buyResult.error) {
            console.error('Error in buy response:', buyResult.error);
            return;
        }

        console.log('Trade started:', buyResult);

        if (buyResult.balance_after !== undefined &&
            buyResult.buy_price !== undefined &&
            buyResult.contract_id !== undefined &&
            buyResult.payout !== undefined) {
            console.log('Contract ID:', buyResult.contract_id);
            console.log('Buy Price:', buyResult.buy_price);
            console.log('Balance After:', buyResult.balance_after);
            console.log('Payout:', buyResult.payout);
        } else {
            console.error('Incomplete buy result:', buyResult);
        }

        inTrade = true;

        // Wait for the trade to complete
        setTimeout(() => {
            checkTradeStatus();
        }, 15000); // Wait for the duration of the contract
    }

    function handleSellResponse(sellResult) {
        if (sellResult.error) {
            console.error('Error in sell response:', sellResult.error);
            return;
        }

        inTrade = false;
        console.log('Trade ended:', sellResult);

        // Calculate profit or loss
        const profitLoss = sellResult.sell.profit || 0;
        console.log('Profit/Loss:', profitLoss);

        // Add operation to history
        addOperationToHistory(initial_value, profitLoss, sellResult.sell.result);

        if (sellResult.sell.result === 'loss') {
            lossCount++;
            if (lossCount >= loss_limit) {
                console.log('Loss limit reached, stopping trading.');
                clearInterval(interval);
                return;
            }
            // Double the initial value after a loss
            initial_value *= 2;
        } else {
            lossCount = 0;
            initial_value = value_after_win; // Update initial value after a win
        }

        // Check if profit goal is reached
        const currentBalance = parseFloat($("#userBalance").text().replace('$', ''));
        if (currentBalance >= profit_goal) {
            console.log('Profit goal reached, stopping trading.');
            clearInterval(interval);
            return;
        }

        // Continue trading
        startTrading();
    }

    function handleBalanceResponse(balance) {
        if (balance.error) {
            console.error('Error in balance response:', balance.error);
            return;
        }
        const currentBalance = balance.balance || 0;
        $("#userBalance").text(` $ ${currentBalance}`);
    }

    function startTrading() {
        if (inTrade || lossCount >= loss_limit) return;

        // Request a new proposal
        const proposalPayload = JSON.stringify({
            proposal: 1,
            subscribe: 1,
            amount: initial_value,
            basis: 'payout',
            contract_type: 'CALL',
            currency: 'USD',
            duration: 5,
            duration_unit: 'm',
            symbol: 'R_75',
            barrier: '+0.1',
        });
        websocket.send(proposalPayload);
    }

    function requestBalance() {
        if (!isSubscribedToBalance) {
            const balancePayload = JSON.stringify({
                balance: 1,
                subscribe: 1
            });
            websocket.send(balancePayload);
            isSubscribedToBalance = true;
        }
    }

    function checkTradeStatus() {
        console.log("Verificando status da negociação");

        // Verifica se há uma negociação em andamento
        if (!inTrade) {
            console.log("Nenhuma negociação em andamento.");
            return;
        }

        // Obtém o tempo atual
        let currentTime = Date.now();

        // Condição para venda antecipada: Se o tempo limite foi atingido ou se o preço está abaixo do valor de venda
        if (currentTime - tradeStartTime >= TRADE_TIMEOUT || currentPrice < SELL_THRESHOLD) {
            sellContract(pendingProposalId);
        } else {
            requestBalance(); // Verifica o saldo para ver se o contrato foi encerrado
        }

        console.log("Fim da verificação do status");
    }

    function sellContract(contractId) {
        const sellPayload = JSON.stringify({
            sell_expired: contractId
        });
        websocket.send(sellPayload);
    }

    function addOperationToHistory(amount, profitLoss, result) {
        const newRow = `
            <tr>
                <td>${amount.toFixed(2)}</td>
                <td>${profitLoss.toFixed(2)}</td>
                <td>${result.toUpperCase()}</td>
            </tr>
        `;
        $("#historicoOperacao").append(newRow);
    }

    function updateCurrentPrice(price) {
        console.log('llllllllllllllllllllllll')
        currentPrice = price;
    }

    websocket.addEventListener('close', () => {
        console.log('WebSocket connection closed');
        clearInterval(interval);
    });

    websocket.addEventListener('error', () => {
        console.error('An error happened in our WebSocket connection');
    });

    // Evento de clique no botão "Iniciar Bot"
    $("#btn-iniciar").on("click", function () {
        loss_limit = prompt("Enter MAXIMUM LOSSES IN A ROW:");
        profit_goal = prompt("Enter PROFIT GOAL:");
        initial_value = parseFloat(prompt("Enter INITIAL VALUE:"));
        value_after_win = parseFloat(prompt("Enter VALUE AFTER WIN:"));

        // Convert to integer if necessary, and start the trading bot
        loss_limit = parseInt(loss_limit, 10);
        if (isNaN(loss_limit)) loss_limit = 2; // Default value for loss limit
        if (isNaN(initial_value)) initial_value = 200; // Default value for initial value
        if (isNaN(value_after_win)) value_after_win = initial_value; // Default value for value after win

        console.log(`Starting bot with settings: Loss Limit = ${loss_limit}, Profit Goal = ${profit_goal}, Initial Value = ${initial_value}, Value After Win = ${value_after_win}`);

        startTrading();
    });
});
