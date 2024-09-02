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

    // Variáveis de configuração do bot
    let loss_limit;
    let profit_goal;
    let initial_value;
    let value_after_win;

    if (tokenInput.trim() == "") {
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
            const pingMessage = JSON.stringify({ ping: 1 });
            websocket.send(pingMessage);
        }, interval_time);
    });

    // Handle incoming messages
    websocket.addEventListener('message', (event) => {
        const receivedMessage = JSON.parse(event.data);

        if (receivedMessage.msg_type === 'authorize') {
            console.log('Authorization successful');
            if (inTrade) return;

            // Request balance after authorization
            requestBalance();
            startTrading();
        }

        if (receivedMessage.msg_type === 'proposal') {
            const proposalId = receivedMessage.proposal.id;
            pendingProposalId = proposalId;

            // Prepare to buy after receiving the proposal
            const buyPayload = JSON.stringify({
                "buy": pendingProposalId,
                "price": initial_value
            });
            websocket.send(buyPayload);
        }

        if (receivedMessage.msg_type === 'buy') {
            const buyResult = receivedMessage.buy;
            if (buyResult.error) {
                console.error('Error in buy response:', buyResult.error);
                return;
            }

            inTrade = true;
            console.log('Trade started:', buyResult);

            // Wait for the trade to complete
            setTimeout(() => {
                checkTradeStatus();
            }, trade_duration * 1000); // Wait for the duration of the contract
        }

        if (receivedMessage.msg_type === 'sell') {
            const sellResult = receivedMessage.sell;
            if (sellResult.error) {
                console.error('Error in sell response:', sellResult.error);
                return;
            }

            inTrade = false;
            console.log('Trade ended:', sellResult);

            // Calculate profit or loss
            const profitLoss = sellResult.sell.profit || 0;
            console.log('Profit/Loss:', profitLoss);

            if (sellResult.sell.result === 'loss') {
                lossCount++;
                if (lossCount >= loss_limit) {
                    console.log('Loss limit reached, stopping trading.');
                    clearInterval(interval);
                    return;
                }
            } else {
                lossCount = 0;
                initial_value = value_after_win; // Update initial value after a win
            }

            if (lossCount < loss_limit) {
                startTrading();
            }
        }

        if (receivedMessage.msg_type === 'error') {
            console.error('Error received:', receivedMessage.error);
        }

        if (receivedMessage.msg_type === 'balance') {
            const balance = receivedMessage.balance.balance || 0;
            $("#userBalance").text(` $ ${balance}`);
        }
    });

    function startTrading() {
        if (inTrade) return;

        const proposalPayload = JSON.stringify({
            proposal: 1,
            amount: initial_value,
            barrier: "+0.1",
            basis: "payout",
            contract_type: "CALL",
            currency: "USD",
            duration: 60,
            duration_unit: "s",
            symbol: "R_100"
        });
        websocket.send(proposalPayload);
    }

    function checkTradeStatus() {
        if (!inTrade) return;

        // Request balance to check if the trade has been closed
        requestBalance();
    }

    function requestBalance() {
        const balancePayload = JSON.stringify({
            balance: 1,
            subscribe: 1
        });
        websocket.send(balancePayload);
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
        if (isNaN(loss_limit)) loss_limit = 5; // Default value
        if (isNaN(initial_value)) initial_value = 1000; // Default value
        if (isNaN(value_after_win)) value_after_win = initial_value; // Default value

        console.log(`Starting bot with settings: Loss Limit = ${loss_limit}, Profit Goal = ${profit_goal}, Initial Value = ${initial_value}, Value After Win = ${value_after_win}`);

        startTrading();
    });
});
