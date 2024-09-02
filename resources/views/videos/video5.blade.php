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
            color: #fcee09;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <img style="width: 250px; margin-left: 50px;" src="{{ asset('assets/logovortex.png') }}" class="logo" />
        <div class="navbar-right">
            <span id="current-date"></span>
            <i style="font-size: 1.8rem;" class="bi bi-person-circle mx-3"></i>
        </div>
    </nav>


    <!-- Layout Principal -->
    <div class="main-layout">
        <!-- Barra lateral -->
        <div class="sidebar">
            <a href="{{ route('index') }}"><i class="bi bi-house-door-fill"></i></a>
            <a href="{{ route('robo') }}"><i class="bi bi-robot"></i></a>
            <a href="#"><i class="bi bi-calendar-range-fill"></i></a>
            <a href="{{ route('aulas') }}"><i class="bi bi-play-fill"></i></a>
        </div>

        <!-- Conteúdo principal -->
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mx-5"><strong>Aulas em Vídeo</strong></h2>
                    <p class="text-secondary mx-5">
                        Aprenda sobre o mercado, gerenciamento de risco e como usar nossos
                        principais Robôs em detalhes.
                    </p>

                    <a href="{{ route('aulas') }}"><i style="font-size: 1.8rem"
                            class="bi bi-arrow-left-circle mx-5"></i></a>


                    <h3 class="mt-5 mx-5 mb-3"><strong>Nosso Robô</strong>
                    </h3>

                    <div class="col-6 mx-auto">
                        <iframe width="1000px" height="500px"
                            src="https://www.youtube.com/embed/cl_uqVQTO6Q?si=v539bLX67ADIKLwd"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        ></iframe>
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
