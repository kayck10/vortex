<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Perfil - Alfa Tech Dashboard</title>
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

        .form-control {
            background-color: #000000;
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #ffffff;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <img style="width: 250px; margin-left: 50px; height: 90px" src="{{ asset('assets/logovortex.png') }}" class="logo" />
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

        <!-- Conteúdo Principal -->
        <div class="main-content">
            <h2>Editar Perfil</h2>

            <!-- Exibe a mensagem de sucesso -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.put') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                </div>

                <div class="form-group">
                    <label for="password">Nova Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite a nova senha">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirme a Nova Senha:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme a nova senha">
                </div>

                <button type="submit" class="btn btn-primary">Atualizar Senha</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function formatDate(date) {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return date.toLocaleDateString('pt-BR', options);
        }

        document.getElementById('current-date').textContent = formatDate(new Date());
    </script>
</body>

</html>
    