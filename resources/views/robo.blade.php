<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <title>Opções Binárias</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <a href="{{ route('aulas') }}"><i style="font-size: 1.8rem; color:#fcee09;"
            class="bi bi-arrow-left-circle mx-5"></i></a>
    <div>
        <div class="cont container-fluid">
            <nav class="barra col-12 col-md-10 col-lg-8 mx-auto d-flex align-items-center justify-content-between">
                <div class="power">
                    <i class="bi bi-power icone text-dark"></i>
                </div>
                <div class="cuenta text-light">
                    <h5>Conta Virtual</h5>
                    <input id="userToken" type="hidden" value="{{ $token }}">
                    <p class="text-secondary" id="loginId"></p>
                </div>
                <i class="bi bi-arrow-clockwise recarregar text-secondary"></i>
            </nav>
            <div class="container text-center">

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="saldo">
                            <p>Saldo</p>
                            <p class="text-light" id="userBalance"> - </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="perda">
                            <p>Ganancia | Perdida</p>
                            <p class="text-light" id="userProfit"> - </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>

            </div>
            <div class="mt-2 text-center">
                <div>
                    <div id="trading_main">
                        <div>
                            <i class="bi bi-robot"> IA Easy</i>
                        </div>

                        <div id="bot_progress" class="hidden">
                            <h3 class="text_robo_parado" id="status-bot-active">Software Operando</h3>
                            <div class="main-trade">
                                <div class="button_pulse">
                                    <div class="progress-group-groups">
                                        <div class="progress-group-bot">
                                            <span id="analisandoSpan" class="hidden">Analisando</span>
                                            <span id="contratoAbertoSpan" class="hidden">Contrato Aberto</span>
                                            <span id="contratoFechadoSpan" class="hidden">Contrato Fechado</span>
                                            <div class="flex justify-center space-x-2 my-2 loading-icons d-flex justify-content-center">
                                                <div class="text-center text-success">
                                                    <i class="bi bi-circle-fill"></i>
                                                    <i class="bi bi-circle-fill"></i>
                                                    <i class="bi bi-circle-fill"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="trading_steps">
                                    <div class="step"></div>
                                    <div class="step"></div>
                                    <div class="step"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center">
                <div>
                    <div id="btnDiv" class="flex justify-center space-x-2 my-2"></div>
                </div>
            </div>
            <div id="loginDeriv"></div>
            <div class="mt-5 tabela hidden" id="tabelaHeader">
                <div>
                    <h4 class="text-center p-2">Tabela</h4>
                    <h6>Histórico de Operaciones <span id="acertos">0</span>/<span id="perdas">0</span></h6>
                </div>
            </div>
            <table class="custom-table hidden" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Saldo Inicial</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Lucro/Prejuízo</th>
                    </tr>
                </thead>
                <tbody id="historicoOperacao">
                </tbody>
            </table>

        </div>
        <footer>
            <p>&copy; Todos los derechos reservados.</p>
        </footer>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>



        <script>
            window.Laravel = {
                appId: "{{ env('APP_ID') }}",
            };
        </script>

        @vite('resources/js/bot.js')


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</body>

</html>
