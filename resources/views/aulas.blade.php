<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alfa Tech Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #131212;
            color: white;
            height: 100vh;
        }

        .navbar {
            background-color: #000000;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .main-layout {
            display: flex;
            height: calc(100vh - 60px);
        }

        .sidebar a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            padding: 15px 0;
            color: #FCEE09;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar a i {
            font-size: 30px;
        }

        .sidebar a:hover {
            background-color: #979729;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: black;
        }

        .action-card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            margin: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .action-card img {
            width: 90%;
            height: 300px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .action-card h3 {
            position: absolute;
            bottom: 20px;
            left: 10px;
            margin: 0;
            color: white;
            font-size: 18px;
            z-index: 2;
        }

        .action-card::before {
            content: "";
            position: absolute;
            bottom: -50px;
            left: 45%;
            width: 100%;
            height: 150px;
            background: linear-gradient(180deg, transparent, #FCEE09);
            transform: translateX(-50%);
            transition: bottom 0.3s ease;
            opacity: 0;
        }

        .action-card:hover img {
            transform: scale(1.1);
            opacity: 0.7;
        }

        .action-card:hover::before {
            bottom: 0;
            opacity: 1;
        }

        .action-card a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <img style="width: 250px; margin-left: 50px;" src="{{ asset('assets/logovortex.png') }}"
            class="logo" />
        <div class="navbar-right">
            <span id="current-date"></span>
            <i style="font-size: 1.8rem;" class="bi bi-person-circle mx-3"></i>
        </div>
    </nav>

    <!-- Layout Principal -->
    <div class="main-layout">
        <!-- Barra lateral -->
        <div class="sidebar">
            <a href="#"><i class="bi bi-house-door-fill"></i></a>
            <a href="#"><i class="bi bi-robot"></i></a>
            <a href="#"><i class="bi bi-calendar-range-fill"></i></a>
            <a href="#"><i class="bi bi-play-fill"></i></a>
            <a href="#"><i class="bi bi-file-earmark-check-fill"></i></a>
        </div>

        <!-- Conteúdo principal -->
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mx-5"><strong>Aulas em Vídeo</strong></h2>
                    <p class="text-secondary mx-5">
                        Aprenda sobre o mercado, gerenciamento de risco e como usar
                        nossos principais Robôs em detalhes.
                    </p>

                    <h3 class="mt-5 mx-5 mb-3">Assista Agora!⚡</h3>

                    <!-- Cards alinhados em uma linha de 6 -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-2">
                            <div class="action-card">
                                <a href="{{ route('video1') }}">
                                    <img src="{{ asset('assets/conta-video.jpg') }}" alt="Tutorial Image" />
                                    <h3>CRIAR CONTA DERIV</h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="action-card">
                                <a href="{{route('video.deposito')}}">
                                    <img src="{{ asset('assets/dinheiro.jpg') }}" alt="Operating Image" />
                                    <h3>DEPOSITANDO DÓLARES NO AIRTM</h3>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="create-brokerage-account.html">
                                <div class="action-card">
                                    <a href="{{ route('video3') }}">
                                        <img src="{{ asset('assets/brokerage.jpg') }}" alt="Brokerage Account Image" />
                                        <h3>REGISTRANDO-SE NO AIRTM</h3>
                                    </a>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <div class="action-card">
                                <a href="{{ route('video4') }}">
                                    <img src="{{ asset('assets/inicie.jpg') }}" alt="Support Image" />
                                    <h3>COMECE A OPERAR</h3>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <a href="trading.html">
                                <div class="action-card">
                                    <a href="{{ route('video5') }}">
                                        <img src="{{ asset('assets/tutorial.jpg') }}" alt="Trading Image" />
                                        <h3>EASY</h3>
                                    </a>
                                </div>
                        </div>
                        <div class="col-md-2">
                            <div class="action-card">
                                <a href="{{ route('video5') }}">
                                    <img src="{{ asset('assets/tutorial.jpg') }}" alt="News Image" />
                                    <h3>SACANDO DINHEIRO DA AIRTM</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
