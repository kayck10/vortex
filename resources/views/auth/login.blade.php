<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfa Tech Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .form-control {
            background-color: #000000;
            color: #ffffff;
        }
        .form-control::placeholder {
            color: #ffffff;
        }

        /* Oculta a segunda imagem em telas pequenas */
        @media (max-width: 767px) {
            .phone-image {
                display: none;
            }
        }

        /* Estilo para fixar a logo no topo e canto da tela */
        .img-logo {
            position: fixed;
            top: 0;
            left: 0;
            margin-left: 50px;
            margin-top: 20px;
            width: 300px;
        }
    </style>
</head>
<body style="background-color: #141413;">
    <section class="d-flex flex-column justify-content-center align-items-center vh-100">
        <img class="img-logo" src="{{ asset('assets/logovortex.png') }}" alt="Logo">
        <div class="container py-5">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-6 text-center">
                    <img style="height: 300px;" src="{{ asset('assets/elefante.png') }}" class="phone-image" alt="Phone image">
                </div>
                <div class="col-md-6">
                    @if(Session::has('mensagem.falha'))
                        <div class="alert alert-danger">
                            {{ Session::get('mensagem.falha') }}
                        </div>
                    @endif

                    <!-- Exibir mensagens de erro de validação -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="mt-5" method="POST" action="{{ route('login.auth') }}">
                        @csrf
                        <div class="text-light mb-5 px-5 text-center">
                            <h5 class="border-bottom border-3 d-inline-block" style="border-color: #9400D3;">Faça Login</h5>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" placeholder="Diga seu melhor email" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" placeholder="Digite sua senha" />
                        </div>

                        <a style="text-decoration: none; color:#ffffff" href="{{ route('cadastro.create') }}">Não tem conta? Cadastre-se</a>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Faça Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
