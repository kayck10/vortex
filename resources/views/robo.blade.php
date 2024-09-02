<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <title>Opções Binárias</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(to bottom right, #2e004f, #531a9b);
        color: #fff;
        overflow-x: hidden;
        position: relative;
      }
      .cont {
        padding-top: 10px;
        min-height: 100vh;
        background: rgba(0, 0, 0, 0.6);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
      }
      .power {
        position: absolute;
        top: 10px;
        left: 30px;
        height: 80px;
        width: 80px;
        border: solid #b333ff;
        border-radius: 20%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        background-color: #7a00ff;
      }
      .barra {
        width: 98%;
        border-radius: 20px;
        height: 120px;
        background-color: rgba(123, 31, 162, 0.2);
        position: relative;
        z-index: 0;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease;
      }
      .barra:hover {
        background-color: rgba(144, 82, 179, 0.3);
      }
      .icone {
        font-size: 2rem;
      }
      .saldo,
      .perda {
        width: 98%;
        border-radius: 20px;
        height: 120px;
        background-color: rgba(123, 31, 162, 0.2);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
      }
      .saldo:hover,
      .perda:hover {
        background-color: rgba(144, 82, 179, 0.3);
      }
      .saldo h5,
      .perda h5 {
        font-size: 1.5rem;
        margin-bottom: 10px;
      }
      .saldo p,
      .perda p {
        font-size: 1.2rem;
        margin: 0;
      }
      .cuenta {
        position: absolute;
        top: 40px;
        right: 60px;
        text-align: right;
      }
      .recarregar {
        font-size: 2rem;
        position: absolute;
        top: 40px;
        right: 10px;
        z-index: 1;
      }
      .button {
        background-color: rgba(123, 31, 162, 0.7);
        border: 2px solid #b333ff;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        animation: pulse 0.7s infinite alternate;
      }
      @keyframes pulse {
        0% {
          transform: scale(1);
        }
        100% {
          transform: scale(1.1);
        }
      }
      .custom-table {
        width: 100%;
        background-color: rgba(46, 0, 79, 0.4);
        color: #fff;
        border-collapse: collapse;
        margin-top: 20px;
      }
      .custom-table th,
      .custom-table td {
        border: 1px solid #fff;
        padding: 8px;
        text-align: left;
        background-color: rgba(46, 0, 79, 0.3);
      }
      .custom-table th {
        background-color: rgba(46, 0, 79, 0.5);
      }
      .tabela {
        width: 95%;
        margin-top: 20px;
        overflow-x: auto;
      }
      footer {
        background-color: rgba(0, 0, 0, 0.8);
        color: #fff;
        text-align: center;
        padding: 20px 0;
        width: 100%;
        bottom: 0;
      }
      .loading-icons .bi-circle-fill {
        opacity: 0.5;
        animation: loading-animation 1.5s infinite;
      }
      .loading-icons .bi-circle-fill:nth-child(1) {
        animation-delay: 0s;
      }
      .loading-icons .bi-circle-fill:nth-child(2) {
        animation-delay: 0.5s;
      }
      .loading-icons .bi-circle-fill:nth-child(3) {
        animation-delay: 1s;
      }
      @keyframes loading-animation {
        0%,
        100% {
          opacity: 0.5;
          transform: scale(1);
        }
        50% {
          opacity: 1;
          transform: scale(1.5);
        }
      }
    </style>
  </head>
  <body>
    <div class="cont container-fluid">
      <nav
        class="barra col-12 col-md-10 col-lg-8 mx-auto d-flex align-items-center justify-content-between"
      >
        <div class="power">
          <i class="bi bi-power icone text-light"></i>
        </div>
        <div class="cuenta text-light">
          <h5>Cuenta dólar</h5>
          <p class="text-secondary">cr78493148 - USD</p>
        </div>
        <i class="bi bi-arrow-clockwise recarregar text-secondary"></i>
      </nav>
      <div class="container text-center">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="saldo">
              <p>Saldo</p>
              <p class="text-light">$ 50,00</p>
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
          <div
            class="flex justify-center space-x-2 my-2 loading-icons d-flex justify-content-center"
          >
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
          <div class="flex justify-center space-x-2 my-2">
            <button id="btnIniciar" class="text-light button">
              <i class="bi bi-play"></i> Iniciar Software
            </button>
          </div>
        </div>
      </div>
      <div class="mt-5 tabela">
        <div>
          <h4 class="text-center p-2">Tabla</h4>
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
            <td>Digitunder-4</td>
            <td>4822342</td>
            <td>0</td>
            <td>10</td>
            <td>10</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-5</td>
            <td>48223422</td>
            <td>10</td>
            <td>21</td>
            <td>11</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-8</td>
            <td>4822342</td>
            <td>21</td>
            <td>31</td>
            <td>10</td>
          </tr>
        </tbody>

        <tbody>
          <tr style="display: none">
            <td>Digitunder-6</td>
            <td>48223422</td>
            <td>31</td>
            <td>20</td>
            <td>-11</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-2</td>
            <td>48223422</td>
            <td>20</td>
            <td>40</td>
            <td>20</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-9</td>
            <td>4822342</td>
            <td>40</td>
            <td>50</td>
            <td>20</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-1</td>
            <td>48223422</td>
            <td>50</td>
            <td>60</td>
            <td>10</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-3</td>
            <td>48223422</td>
            <td>60</td>
            <td>70</td>
            <td>10</td>
          </tr>
          <tr style="display: none">
            <td>Digitunder-7</td>
            <td>48223422</td>
            <td>70</td>
            <td>80</td>
            <td>10</td>
          </tr>
        </tbody>
      </table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div>
           <h3 class="text-success text-center">RETIRA $130 POR DÍA</h3>
        </div>

        <p class="text-dark text-center">Mira el siguiente vídeo hasta el final donde te mostraré cómo hacerlo MÁS DE $130 POR DÍA y REALIZAR TU PRIMER RETIRO COMPLETO!</p>
        <div class="d-grid gap-2 col-6 mx-auto">
          <a class="btn btn-success" href="http://">VER VÌDEO</a>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
    <footer>
      <p>&copy; Todos los derechos reservados.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Capturando elementos de saldo e ganho/perda
        const saldoElement = document.querySelector(".saldo p.text-light");
        const ganhoPerdaElement = document.querySelector(".perda p.text-light");

        // Valores para animação
        const saldoValues = [50, 60, 71, 81, 70, 100, 130];
        const ganhoPerdaValues = [0, 10, 20, -10, 20, 50, 80];
        const interval = 1000; // Intervalo de tempo entre os valores (ms)

        // Função para animar os valores
        function animateValues(targetElement, values) {
          let index = 0;
          const intervalId = setInterval(() => {
            targetElement.textContent = `$ ${values[index]}.00`;
            index++;
            if (index === values.length) {
              clearInterval(intervalId);
            }
          }, interval);
        }

        // Evento de clique no botão "Iniciar Software"
        const btnIniciar = document.getElementById("btnIniciar");
        btnIniciar.addEventListener("click", function () {
          animateValues(saldoElement, saldoValues);
          animateValues(ganhoPerdaElement, ganhoPerdaValues);
          showTableRows();
        });

        // Função para mostrar linhas da tabela uma por uma
        function showTableRows() {
          const rows = document.querySelectorAll("#dataTable tbody tr");
          let index = 0;
          const intervalId = setInterval(() => {
            if (index < rows.length) {
              rows[index].style.display = "";
              index++;
              console.log(rows.length)
              console.log(index)
             if(index == rows.length){
              $('#acertos').text(index - 1)
             }
             else {
              $('#acertos').text(index)
             }
            } else {
              clearInterval(intervalId);
            }
            if(index == rows.length) {
              $('#exampleModal').modal('show')
                console.log('teste')
              }
              if(index == 4) {
                 $('#perdas').text('1')
              }

          }, 1000); // Intervalo de 1 segundo entre as linhas
        }
      });
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

  </body>
</html>
