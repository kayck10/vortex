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
                <h5>Cuenta dólar</h5>
                <input id="userToken" type="hidden" value="{{$token}}">
                <p class="text-secondary">cr78493148 - USD</p>
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
                        <p class="text-light">$ 0,00</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <i class="bi bi-robot"> IA Easy</i>
            </div>
        </div>
        <div class="mt-2 text-center">
            <div>
                <h2>Software detenido</h2>
                <div class="flex justify-center space-x-2 my-2 loading-icons d-flex justify-content-center">
                    <div class="text-center text-success">
                        <i class="bi bi-circle-fill"></i>
                        <i class="bi bi-circle-fill"></i>
                        <i class="bi bi-circle-fill"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 text-center">
            <div>
                <div id="btn-iniciar" class="flex justify-center space-x-2 my-2">

                </div>
            </div>
        </div>
        <div id="loginDeriv"></div>
        <div class="mt-5 tabela">
            <div>
                <h4 class="text-center p-2">Tabela</h4>
                <h6>Histórico de Operaciones <span id="acertos">0</span>/<span id="perdas">0</span> </h6>
            </div>
        </div>
        <table class="custom-table" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ref</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Salida</th>
                    <th scope="col">Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr style="display: none">
                    <td>Digitunder-7</td>
                    <td>48223422</td>
                    <td>70</td>
                    <td>80</td>
                    <td>10</td>
                </tr>
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
            appId: {{env('APP_ID')}}
        };
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
