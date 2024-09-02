    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Alfa Tech Dashboard</title>
        <!-- Bootstrap CSS -->
        <link
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        rel="stylesheet"
        />
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        />
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
            padding: 15px 0; /* Aumenta o espaçamento entre os ícones */
            color: #FCEE09;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar a i {
            font-size: 30px; /* Ajuste o tamanho dos ícones */
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
            margin-top: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .action-card img {
            width: 85%;
            height: 300px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .action-card h3 {
            position: absolute;
            bottom: 20px;
            left: 20px;
            margin: 0;
            color: white;
            font-size: 24px;
            z-index: 2;
        }

        .action-card::before {
            content: "";
            position: absolute;
            bottom: -50px;
            left: 45%;
            width: 88%;
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

        @media (min-width: 768px) {
            .carousel {
            display: none;
            }

            .info-perfil {
            display: flex;
            justify-content: center;
            align-items: center;
    }

            .profile-card {
                background-color: #0f0f0f;
                margin-top: 60px;
                height: 750px;
                border-radius: 20px;
                padding: 20px;
            }

            .profile-header {
                margin-bottom: 15px;
            }

            .profile-avatar i {
                font-size: 60px;
                color: #FCEE09;
            }

            .profile-header h3 {
                margin: 10px 0 0 0;
                font-size: 22px;
            }

            .profile-details {
                margin-top: 10px;
            }

            .status, .plan {
                font-size: 16px;
                margin-bottom: 8px;
            }

            .green {
                color: #4caf50;
            }

            .purple {
                color: #9c27b0;
            }

            .divider {
                border: none;
                border-top: 1px solid #444;
                margin: 15px 0;
            }

            .account-info {
                display: flex;
                gap: 10px;
            }
            .account-text {
                border-radius: 20px;
                height: 180px;
                width: 200px;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 16px;
            }
            .bank-total {
                background: linear-gradient(80deg, rgba(18, 102, 38, 0.3) 0%, rgba(23, 34, 85, 0.3) 100%);
            }
            .dollar {
            background: rgb(12,32,122);
            background: linear-gradient(80deg, rgba(12,32,122,1) 0%, rgba(12,13,18,0.9836309523809523) 100%);        }

    .btn-connect {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 20px;
        transition: background-color 0.3s;
    }

    .btn-connect:hover {
        background-color: #0056b3;
    }
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
            <a href="{{route('index')}}"
            ><span><i class="bi bi-house-door-fill"></i></span
            ></a>
            <a href="{{route('robo')}}">
                <span><i class="bi bi-robot"></i></span>
            </a>

            <a href="#"
            ><span><i class="bi bi-calendar-range-fill"></i></span
            ></a>
            <a href="#"
            ><span><i class="bi bi-play-fill"></i></span
            ></a>
            <a href="#"
            ><span><i class="bi bi-file-earmark-check-fill"></i></span
            ></a>
        </div>

        <!-- Conteúdo principal -->
        <div class="main-content container-fluid">
            <div class="row">
            <div class="col-md-9">
                <h3>Olá, {{ auth()->user()->name }}!</h3>

                <!-- Carrossel para dispositivos móveis -->
                <div
                id="carouselExampleIndicators"
                class="carousel slide d-md-none"
                data-ride="carousel"
                >
                <ol class="carousel-indicators">
                    <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="0"
                    class="active"
                    ></li>
                    <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="1"
                    ></li>
                    <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="2"
                    ></li>
                    <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="3"
                    ></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="action-card">
                        <img src="{{asset('assets/tutorial.jpg')}}" alt="Tutorial Image" />
                        <h3>TUTORIAL</h3>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="action-card">
                        <img src="{{ asset('assets/employ_24_small_logo.png') }}" alt="Operating Image" />
                        <h3>START OPERATING</h3>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="action-card">
                        <img src="{{asset('assets/brokerage.jpg')}}" alt="Brokerage Account Image" />
                        <h3>CREATE BROKERAGE ACCOUNT</h3>
                    </div>
                    </div>
                    <div class="carousel-item">
                    <div class="action-card">
                        <img src="{{asset('assets/brokerage.jpg')}}" alt="Support Image" />
                        <h3>SUPPORT</h3>
                    </div>
                    </div>
                </div>
                <a
                    class="carousel-control-prev"
                    href="#carouselExampleIndicators"
                    role="button"
                    data-slide="prev"
                >
                    <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                    ></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a
                    class="carousel-control-next"
                    href="#carouselExampleIndicators"
                    role="button"
                    data-slide="next"
                >
                    <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                    ></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>

                <!-- Cards padrão para telas maiores -->
                <div class="row d-none d-md-flex">
                <div class="col-md-3">
                    <div class="action-card">
                     <a href="{{route('aulas')}}">
                    <img src="{{asset('assets/tutorial.jpg')}}" alt="Tutorial Image" />
                    <h3>TUTORIAL</h3>
                 </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="action-card">
                        <a href="">
                    <img src="{{asset('assets/operating.jpg')}}" alt="Operating Image" />
                    <h3>START OPERATING</h3>
                </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="action-card">
                        <a href="">
                    <img src="{{asset('assets/brokerage.jpg')}}" alt="Brokerage Account Image" />
                    <h3>CREATE BROKERAGE ACCOUNT</h3>
                </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="action-card">
                        <a href="#">
                    <img src="{{asset('assets/support.jpg')}}" alt="Support Image" />
                        <h3>Support</h3>
                     </a>
                    </div>
                </div>
                </div>

                <h2>Últimas Operações</h2>
                <p>Total de Operações</p>
            </div>

        <!-- Informações do Perfil -->
        <div class="col-md-3 info-perfil">
            <div class="profile-card">
            <div class="profile-header text-center">
                <h1 class="profile-avatar"><i class="bi bi-person-circle"></i></h1>
                <h3>Juarez Airão</h3>
            </div>
            <div class="profile-details">
                <div>
                <p style="background-color: rgb(58, 54, 54); border: solid rgb(58, 54, 54); border-radius: 10px; position: relative;" class="p-3">
                    Status da Conta:
                    <span style="background-color: rgba(0, 128, 0, 0.2); border: 2px solid rgba(0, 128, 0, 0.8); border-radius: 20px; padding: 10px 25px 10px 25px; color: white;">Ativo</span>
                </p>
                </div>
                <div>
                <p style="background-color: rgb(58, 54, 54); border: solid rgb(58, 54, 54); border-radius: 10px; position: relative;" class="p-3">
                    <strong>Meu Plano:</strong>
                    <span style="background-color: rgba(75, 0, 130, 0.2); border: 2px solid rgba(75, 0, 130, 0.8); border-radius: 20px; padding: 10px 25px 10px 25px; color: white;">SMART</span>
                </p>
                </div>

                <hr class="divider" />
                <div class="account-info">
                <p class="account-text bank-total">Banco Total</p>
                <p class="account-text dollar">Dólar</p>
            </div>
            </div>
            </div>
        </div>

        </div>
        </div>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
        function formatDate(date) {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('pt-BR', options);
        }

        document.getElementById('current-date').textContent = formatDate(new Date());
    </script>
    </body>
    </html>
