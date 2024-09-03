import {
    find
} from 'rxjs/operators';
import DerivAPI from './src/DerivAPI'; // Ajuste o caminho conforme necessário

// O WebSocket nativo do navegador pode ser usado diretamente
const WebSocket = window.WebSocket;

const token = $("#userToken").val();
const app_id = window.Laravel.appId;
const expected_payout = 19;

// Variáveis de configuração do bot
let loss_limit;
let profit_goal;
let initial_value;
let saldoInicial;
let lucro = 0;
const api2 = new DerivAPI({
    app_id
});

async function accountCheck() {
    let accountCheck = await api2.account(token);
    let { balance } = accountCheck;

    $("#userBalance").text(` $ ${balance.display}`);
    $("#loginId").text(` ${accountCheck._data.loginid} - ${accountCheck._data.currency}`);
    $("#userProfit").text(` $ ${lucro}`);
}

if (token.trim() === "") {
    $('#loginDeriv').html(`
        <a class="text-light button" href="https://oauth.binary.com/oauth2/authorize?app_id=${app_id}&l=pt">LOGIN</a>
    `);
} else {
    $("#btnDiv").html(`
        <button id="iniciarBot" class="text-light button">
            <i class="bi bi-play"></i> Iniciar Software
        </button>
        <button id="stopBot" class="text-light button hidden">
            <i class="bi bi-play"></i> Parar Software
        </button>
    `);

    accountCheck();
}

function addOperationToHistory(saldoInicial, valor, profit, status) {
    $('#dataTable').removeClass('hidden');
    $('#tabelaHeader').removeClass('hidden');
    let style;
    if(status == 'won'){
        lucro += parseFloat(profit);
        style = "won_td";
    }else{
        style = "loose_td";
    }

    let saldoFinal = parseFloat(saldoInicial) + parseFloat(profit) + parseFloat(valor);
    const newRow = `
        <tr>
            <td>$ ${saldoInicial}</td>
            <td>$ ${valor}</td>
            <td class="${style}">$ ${profit}</td>
        </tr>
    `;
    $("#historicoOperacao").prepend(newRow);
}




async function startTrading() {
    try {
        const api = new DerivAPI({
            app_id
        });
        const account = await api.account(token);

        const {
            balance,
            currency
        } = account;

        const maxLosses = loss_limit //parseInt(prompt("Quantas partidas perdidas para parar?"), 10);
        const profitGoal = profit_goal //parseFloat(prompt("Qual é a meta de lucro?"), 10);
        let initialBet = initial_value //parseFloat(prompt("Qual é o valor inicial de investimento?"), 10);

        let losses = 0;
        let won = 0;
        let currentProfit = 0;




        console.log(`Your current balance is: ${balance.currency} ${balance.display}`);
        console.log(`currency: ${currency}`);


        while (losses < maxLosses && currentProfit < profitGoal) {
            console.log('vezes perdidas' + losses);
            console.log('vezes ganhar' + won);
            $("#userProfit").text(` $ ${lucro}`);
            $("#analisandoSpan").removeClass('hidden');
            $("#contratoAbertoSpan").addClass('hidden');
            $("#contratoFechadoSpan").addClass('hidden');

            balance.onUpdate(() => {
                saldoInicial = balance.display;
                $("#userBalance").text(` $ ${balance.display}`);
                $("#contratoAbertoSpan").addClass('hidden');
                $("#contratoFechadoSpan").removeClass('hidden');
                console.log(`Your new balance is: ${balance.currency} ${balance.display}`);
            });

            const contract = await api.contract({
                proposal: 1,
                subscribe: 1,
                amount: initialBet,
                basis: 'stake',
                contract_type: 'CALL',
                currency: 'USD',
                duration: 15,
                duration_unit: 's',
                symbol: 'R_75',
                barrier: '+0.1',
            });

            contract.onUpdate(({
                status,
                payout,
                bid_price
            }) => {
                switch (status) {
                    case 'proposal':
                        return console.log(
                            `Current payout: ${payout.currency} ${payout.display}`,
                        );
                    case 'open':
                        $("#contratoFechadoSpan").addClass('hidden');
                        $("#analisandoSpan").addClass('hidden');
                        $("#contratoAbertoSpan").removeClass('hidden');
                        return console.log(
                            `Current bid price: ${bid_price.currency} ${bid_price.display}`,
                        );
                    default:
                        break;
                }
            });

            // Wait until payout is greater than USD 19
            await contract.onUpdate()
                .pipe(find(({
                    payout
                }) => payout.value >= expected_payout)).toPromise();

            const buy = await contract.buy();

            console.log(`Buy price is: ${buy.price.currency} ${buy.price.display}`);

            // Wait until the contract is sold
            await contract.onUpdate().pipe(find(({
                is_sold
            }) => is_sold)).toPromise();
            const {
                profit,
                status
            } = contract;
            if (typeof status !== 'undefined') {
                if (status === 'won') {
                    won += 1;
                    console.log(`You won: ${profit.currency} ${profit.display}`);
                    currentProfit += profit.value; // Soma o lucro atual ao lucro total
                    initialBet = initialBet; // Restaura o valor da aposta inicial após vitória
                    addOperationToHistory(saldoInicial, initialBet, profit.display, 'won');

                    // Verifica se o lucro acumulado já atingiu ou ultrapassou a meta de lucro
                    if (currentProfit >= profitGoal) {
                        console.log(`Parando o jogo após atingir a meta de lucro de ${profitGoal}.`);
                        break; // Sai do loop ao atingir a meta de lucro
                    }
                } else if (status === 'lost') {
                    console.log(`You lost: ${profit.currency} ${profit.display}`);
                    losses += 1;
                    initialBet *= 2; // Dobra a aposta após uma perda
                    addOperationToHistory(saldoInicial, initialBet, profit.display, 'loose');
                }

            } else {
                console.error('Status is not defined');
            }
        }

        if (losses >= maxLosses) {
            console.log(`Parando o jogo após ${losses} perdas consecutivas.`);
            $("#stopBot").addClass('hidden');
            $("#iniciarBot").removeClass('hidden');
        } else if (currentProfit >= profitGoal) {
            console.log(`Parando o jogo após atingir a meta de lucro de ${profitGoal}.`);
            $("#stopBot").addClass('hidden');
            $("#iniciarBot").removeClass('hidden');
        }

    } catch (err) {
        console.error(err);
    } finally {
        // Close the connection and exit
        api.basic.disconnect();
    }
}



$("#stopBot").on("click", function () {
    $("#stopBot").addClass('hidden');
    $("#iniciarBot").removeClass('hidden');
});
$("#iniciarBot").on("click", function () {
    loss_limit = prompt("Enter MAXIMUM LOSSES IN A ROW:");
    profit_goal = prompt("Enter PROFIT GOAL:");
    initial_value = parseFloat(prompt("Enter INITIAL VALUE:"));


    $('#dataTable').removeClass('hidden');
    $('#tabelaHeader').removeClass('hidden');
    $("#historicoOperacao").html('');
    $("#iniciarBot").addClass('hidden');
    // value_after_win = parseFloat(prompt("Enter VALUE AFTER WIN:"));

    // Convert to integer if necessary, and start the trading bot
    loss_limit = parseInt(loss_limit, 10);
    if (isNaN(loss_limit)) loss_limit = 2; // Default value for loss limit
    if (isNaN(initial_value)) initial_value = 200; // Default value for initial value
    // if (isNaN(value_after_win)) value_after_win = initial_value; // Default value for value after win
    $("#iniciarBot").addClass('hidden');
    $("#bot_progress").removeClass('hidden');
    $("#analisandoSpan").removeClass('hidden');


    console.log(`Starting bot with settings: Loss Limit = ${loss_limit}, Profit Goal = ${profit_goal}, Initial Value = ${initial_value}`);

    startTrading();
});
