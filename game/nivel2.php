<?php
session_start();
require_once 'classes/conexionDB.php';

$conexionDB = new ConexionDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['dropPuntos']) || isset($_POST['dropPuntos2'])) {
    $_SESSION['puntos'] = $_SESSION['puntos'] + 10;
    $conexionDB->conectar();
    $conexionDB->updatePuntos($_SESSION['id']);
    $conexionDB->desconectar();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NIVEL 2</title>

  <link rel="shortcut icon" href="./imagenes/favicon.png" type="image/x-icon" />

  <style>
    body {
      overflow: hidden;
    }

    .fondo {
      background-image: url(imagenes/gifi.gif);
      background-repeat: no-repeat;
      background-size: cover;
    }

    .dialog-box {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 30vw;
      /* Ajustado el ancho */
      padding: 20px;
      background: linear-gradient(45deg, #9370db, #ff69b4, #ffa07a);
      border: 1px solid #cf00de;
      text-align: center;
      z-index: 1000;
      border-radius: 10px;
    }

    .dialog-box p {
      color: #fff;
      font-size: 24px;
      /* Tamaño del texto ajustado */
      font-weight: bold;
      /* Negrita */
      margin-bottom: 20px;
      /* Espacio después del texto */
    }

    .dialog-buttons {
      margin-top: 20px;
    }

    .dialog-buttons button {
      margin: 0 10px;
      padding: 10px 20px;
      /* Ajustado el padding para el botón */
      font-size: 18px;
      /* Tamaño del texto del botón */
      border-radius: 5px;
      /* Bordes redondeados */
      cursor: pointer;
    }

    .dialog-buttons button.sí {
      background: #2ecc71;
      /* Color verde */
      color: #fff;
    }

    .dialog-buttons button.no {
      background: #e74c3c;
      /* Color rojo */
      color: #fff;
    }

    .cerrar-link {
      position: absolute;
      top: 20px;
      right: 20px;
      z-index: 999;
    }

    .cerrar-link:hover {
      animation: vibrar 0.5s ease infinite;
    }

    .manzana:hover {
      background-color: rgb(255, 255, 5);
      border-radius: 120%;
    }

    .papel:hover {
      background-color: rgb(96, 97, 96);
      border-radius: 120%;
    }


    .lata:hover {
      background-color: rgb(1, 233, 245);
      border-radius: 120%;
    }

    .cola:hover {
      background-color: rgb(85, 28, 1);
      border-radius: 120%;
    }

    .lata {
      width: 70px;
      height: 70px;
      float: left;
      margin-left: 26%;
      margin-top: -10%;
      cursor: pointer;
    }

    .cola {
      width: 60px;
      height: 70px;
      float: left;
      margin-left: 58%;
      margin-top: -9%;
      cursor: pointer;
    }

    .manzana {
      width: 70px;
      height: 70px;
      float: left;
      margin-left: 40%;
      margin-top: 40%;
      cursor: pointer;
    }

    .papel {
      width: 100px;
      height: 100px;
      float: left;
      margin-left: 24%;
      margin-top: 39%;
      cursor: pointer;
    }

    .cuadrado-blanco {
      display: none;
      width: 700px;
      height: 300px;
      background-color: rgb(255, 255, 255);
      opacity: 90%;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 20px;
    }

    .cuadrado-blanco img {
      opacity: 1;
      margin-top: 30px;
      margin-left: 20px;
    }

    .texto-contenedores img {
      opacity: 1;
      margin-top: 10px;
      margin-left: 150px;
    }

    .verde:hover {
      background-color: rgb(3, 255, 3);
    }

    .azul:hover {
      background-color: rgb(0, 187, 255);
    }

    .amarillo:hover {
      background-color: yellow;
    }

    .marron:hover {
      background-color: #9c7040;
    }




    .cuadrado-estrellas {
      display: none;
      width: 100%;
      height: 100vh;
      background-image: url(./imagenes/pio.gif);
      background-repeat: no-repeat;
      background-size: cover;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      z-index: 1000;
    }

    .cuadrado-estrellas img {
      width: 50px;
      /* Cambié este valor a un tamaño más pequeño */
      height: auto;
      object-fit: contain;
      margin: 20px;
      margin-right: 400px;
      float: right;

    }




    #reloj-container {
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      top: 15px;
      left: 85%;
      width: 5%;
      padding: 10px;
    }

    #reloj-img {
      margin-right: 10px;
      height: 50px;
      /* Ajusta la altura según sea necesario */
    }

    #reloj {
      font-size: 35px;
      color: white;
      text-align: center;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      20%,
      60% {
        transform: translateX(-5px) rotate(5deg);
      }

      40%,
      80% {
        transform: translateX(5px) rotate(-5deg);
      }
    }

    .shake {
      animation: shake 0.5s ease-in-out infinite alternate;
    }


    .mensaje-perdiste {
      opacity: 0%;
    }




    #contenedorImagenes {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      overflow: hidden;
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 5px;
    }

    #contenedorImagenes img {
      width: 50px;
      /* Ajusta el ancho según tus necesidades */
      height: 50px;
      /* Ajusta la altura según tus necesidades */
      margin: 0 10px;
      /* Ajusta el margen entre imágenes según tus necesidades */
    }


    #contenedorImagenes {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      overflow: hidden;
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 5px;

    }

    #contenedorImagenes img {
      width: 50px;
      /* Ajusta el ancho según tus necesidades */
      height: 50px;
      /* Ajusta la altura según tus necesidades */
      margin: 0 10px;
      /* Ajusta el margen entre imágenes según tus necesidades */
    }


    .reseña {
      width: 10%;
      margin-top: 20%;
    }



    .dialog-box {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      text-align: center;
      width: 50%;
      height: 60vh;
    }

    /* Estilos para el botón de cerrar dentro del cuadro de diálogo */
    .dialog-box .cerrar {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .sound-button {
      position: fixed;
      top: 10px;
      right: 452px;
    }


    .dialog-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 2;
      /* Coloca el contenedor encima del resto del contenido */
    }

    .dialog-box-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(5px);
      /* Ajusta el valor de desenfoque según tus preferencias */
      z-index: 2;
      /* Coloca el fondo borroso encima del resto del contenido y detrás del cuadro de diálogo */
      display: none;
      /* Inicialmente oculto */
    }

    .dialog-box {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.8);
      /* Color de fondo con transparencia para simular el efecto de filtro */
      padding: 20px;
      border: 1px solid #ccc;
      text-align: center;
      z-index: 3;
      /* Asegura que el cuadro de diálogo esté encima del fondo borroso y del resto del contenido */
    }



    #musicList {
      float: right;
      margin-top: 10px;
      /* Ajusta según sea necesario */
    }







    #contenedorImagenes {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      overflow: hidden;
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 5px;
      animation: borderColorChange 4s infinite;
    }

    #contenedorImagenes img {
      width: 50px;
      /* Ajusta el ancho según tus necesidades */
      height: 50px;
      /* Ajusta la altura según tus necesidades */
      margin: 0 10px;
      /* Ajusta el margen entre imágenes según tus necesidades */
    }

    @keyframes borderColorChange {
      0% {
        border: 2px solid white;
      }

      25% {
        border: 2px solid white;
      }

      50% {
        border: 2px solid white;
      }

      75% {
        border: 2px solid white;
      }

      100% {
        border: 2px solid white;
      }
    }
  </style>
</head>

<body class="fondo">
  <div class="mensaje-perdiste" id="mensajePerdiste">¡Perdiste!</div>
  <img src="imagenes/3-vidas.png" alt="3 vidas" style="position: absolute; top: 4px; left: 10px; width: 80px; height: 80px;" />
  <span id="contador" style="position: absolute; top:19px; left: 95px; font-size: 44px; color: #fff;">3</span>



  <audio id="miAudio" src="sonidos/reloj2.mp3"></audio>









  <div class="container">
    <a href="#" class="cerrar-link" onclick="abrirDialogo()" onclick="cerrarDialog()">
      <img src="imagenes/pausa2.png" alt="Cerrar" style="width: 50px; height: 50px" />
    </a>

    <!-- Botón de sonido en la esquina superior derecha -->

  </div>


 <div class="dialog-box-bg" id="dialogBoxBg"></div>

<!-- Cuadro de diálogo oculto inicialmente -->
<div class="dialog-box" id="dialogBox">
  <div id="musicList">
    <img id="musicButton" src="imagenes/boton-musica-cerrado1.png" alt="Reproducir" onclick="togglePlayPause()" style="cursor: pointer; width: 80px; margin-right: 650px;">

    <img src="imagenes/x.png" style="width: 50px; height: 50px;" class="cerrar" onclick="cerrarDialog()">
    <div style="margin-top: 0%;"><img src="imagenes/PAUSADO.png"></div>
    <div style="margin-top: 10%;" onclick="cerrarDialog()">
      <img style="width: 190px; height: 40px;" src="imagenes/CONTINUE.png">
    </div>
    <a href="nivel2.php">
      <div style="margin-top: 3%;">
        <img style="width: 190px; height: 40px;" src="imagenes/restart-2.png">
      </div>
    </a>
    <a href="niveles.php">
      <div style="margin-top: 3%;">
        <img style="width: 90px; height: 40px;" src="imagenes/exits.png">
      </div>
    </a>
  </div>
</div>

<!-- Elemento de audio -->
<audio id="myAudio" src="sonidos/electronic jazz.mp3"></audio>

<script>
  var audioElement = document.getElementById('myAudio');
  var isPlaying = false;

  function togglePlayPause() {
    var musicButton = document.getElementById('musicButton');
    if (isPlaying) {
      audioElement.pause();
      musicButton.src = 'imagenes/boton-musica-cerrado1.png';
    } else {
      audioElement.play();
      musicButton.src = 'imagenes/boton-musica1.png';
    }
    isPlaying = !isPlaying;
  }

  function cerrarDialog() {
    document.getElementById('dialogBoxBg').style.display = 'none';
    document.getElementById('dialogBox').style.display = 'none';
  }
</script>


























  <div class="cuadrado-estrellas" id="cuadradoEstrellas" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; height: 100vh;">

    <a href="niveles.php" class="cerrar-link"><img src="imagenes/x.png" alt="Cerrar" style="width: 40px; height: 50px; margin-top: -5px; margin-right: -1px;" /> </a>
    <img src="imagenes/gameover.png" alt="Game Over" style="width: 70%; height: auto; margin-top: 100px; margin-right: 200px;" />
    <a href="niveles.php"><img src="imagenes/exits.png" alt="Game Over" style="width: 15%; height: auto; margin-top: 50px; margin-right: 610px;" /> </a>
    <a href="nivel2.php"><img src="imagenes/restart-2.png" alt="Estrellas" style="width:30%; margin-top: 50px; height: auto; margin-right: 500px;" /></a>
  </div>









  <form action="credit.html" method="POST">
    <input type="hidden" value="1" name="dropPuntos2">
    <div class="cuadrado-estrellas" id="cuadradoEstrellas3">
      <a href="niveles.php" class="cerrar-link"><img src="imagenes/x.png" alt="Cerrar" style="width: 40px; height: 50px; margin-top: -5px; margin-right: -1px;" /></a>

      <img src="imagenes/youwin.png" alt="Estrellas" style="width: 50%; height: 30vh; margin-top: 100px; margin-right: 350px;" />


      <div style="text-align: center;">
        <div style="margin: 0 auto;">

          <button type="submit" name="next" onclick="window.location.href='niveles.php';" style="background: none; border: 0px; margin-top: 20px; margin-left: 400px;">
            <img src="imagenes/next1.png" alt="Estrellas" style="width: 270px; height: auto; border: 0px;">
          </button>

          <a href="nivel2.php">
            <img src="imagenes/restart-2.png" alt="Estrellas" style="width: 300px; height: auto; border: 0px; margin-top: 20px; margin-right:600px">
          </a>
        </div>
      </div>




    </div>
  </form>











  <div id="contenedorImagenes">
    <img src="imagenes/platano.png" alt="Manzana">
    <img src="imagenes/botella.png" alt="Lata">
    <img src="imagenes/carto.png" alt="Papel">
    <img src="imagenes/choco.png" alt="Cola">
  </div>





  <div id="manzana-container">
    <img src="imagenes/platano.png" class="manzana" alt="Manzana" id="manzana" />
    <div class="cuadrado-blanco" id="cuadrado-manzana">
      <div class="texto-contenedores">
        <img src="imagenes/texto-contenedores.png" style="width: 350px; height: 50px" />
      </div>
      <img src="imagenes/verde.png" class="verde" style="width: 150px; height: 150px" id="verde" />
      <img src="imagenes/azul.png" class="azul" style="width: 140px; height: 150px" id="azul" />
      <img src="imagenes/amarillo.png" class="amarillo" style="width: 150px; height: 150px" id="amarillo" />
      <img src="imagenes/marron.png" class="marron" style="width: 150px; height: 150px" id="marron" onclick="cambiarImagen()" />
    </div>
  </div>

  <div id="papel-container">
    <img src="imagenes/carto.png" class="papel" alt="Cerrar" id="papel" />
    <div class="cuadrado-blanco" id="cuadrado-papel">
      <div class="texto-contenedores">
        <img src="imagenes/texto-contenedores.png" style="width: 350px; height: 50px" />
      </div>
      <img src="imagenes/verde.png" class="verde" style="width: 150px; height: 150px" id="verde-papel" />
      <img src="imagenes/azul.png" class="azul" style="width: 140px; height: 150px" id="azul-papel" onclick="cambiarImagen2()" />
      <img src="imagenes/amarillo.png" class="amarillo" style="width: 150px; height: 150px" id="amarillo-papel" />
      <img src="imagenes/marron.png" class="marron" style="width: 150px; height: 150px" id="marron-papel" />
    </div>
  </div>
  </div>

  <div id="lata-container">
    <img src="imagenes/botella.png" class="lata" alt="Cerrar" id="lata" />
    <div class="cuadrado-blanco" id="cuadrado-lata">
      <div class="texto-contenedores">
        <img src="imagenes/texto-contenedores.png" style="width: 350px; height: 50px" />
      </div>
      <img src="imagenes/verde.png" class="verde" style="width: 150px; height: 150px" id="verde-lata" />
      <img src="imagenes/azul.png" class="azul" style="width: 140px; height: 150px" id="azul-lata" />
      <img src="imagenes/amarillo.png" class="amarillo" style="width: 150px; height: 150px" id="amarillo-lata" onclick="cambiarImagen1()" />
      <img src="imagenes/marron.png" class="marron" style="width: 150px; height: 150px" id="marron-lata" />
    </div>
  </div>

  <div id="cola-container">
    <img src="imagenes/choco.png" class="cola" alt="Cerrar" id="cola" />
    <div class="cuadrado-blanco" id="cuadrado-cola">
      <div class="texto-contenedores">
        <img src="imagenes/texto-contenedores.png" style="width: 350px; height: 50px" />
      </div>
      <img src="imagenes/verde.png" class="verde" style="width: 150px; height: 150px" onclick="cambiarImagen3()" id="verde-cola" />
      <img src="imagenes/azul.png" class="azul" style="width: 140px; height: 150px" id="azul-cola" />
      <img src="imagenes/amarillo.png" class="amarillo" style="width: 150px; height: 150px" id="amarillo-cola" />
      <img src="imagenes/marron.png" class="marron" style="width: 150px; height: 150px" id="marron-cola" />
    </div>
  </div>




  <audio id="audio-verde" src="sonidos/bloop-2-186531.mp3" preload="auto"></audio>
  <audio id="audio-azul" src="sonidos/bloop-2-186531.mp3" preload="auto"></audio>
  <audio id="audio-amarillo" src="sonidos/bloop-2-186531.mp3" preload="auto"></audio>
  <audio id="audio-marron" src="sonidos/bloop-2-186531.mp3" preload="auto"></audio>

  <audio id="audio-manzana" src="sonidos/objetos.mp3"></audio>
  <audio id="audio-papel" src="sonidos/objetos.mp3"></audio>
  <audio id="audio-lata" src="sonidos/objetos.mp3"></audio>
  <audio id="audio-cola" src="sonidos/objetos.mp3"></audio>



  <div id="reloj-container">
    <img id="reloj-img" src="imagenes/reloj.png" alt="Reloj">
    <div id="reloj">03:00</div>
  </div>




  </main>


  <script>
    // Funciones para mostrar/ocultar el diálogo
    function mostrarDialog() {
      document.getElementById('dialogBox').style.display = 'block';
    }

    function cerrarDialog() {
      document.getElementById('dialogBox').style.display = 'none';
    }

    // Esta función podría redirigirte a la página de inicio, por ejemplo.
    function cerrarVentana() {
      // Simplemente redirigir a la página de inicio por ejemplo
      window.location.href = 'niveles.php';
    }

    // Evento al hacer clic en el botón "x"
    document.querySelector('.cerrar-link').addEventListener('click', function(event) {
      event.preventDefault(); // Evita el comportamiento predeterminado del enlace
      mostrarDialog(); // Muestra el cuadro de diálogo
    });


    var cuadradoManzana = document.getElementById("cuadrado-manzana");
    var cuadradoPapel = document.getElementById("cuadrado-papel");
    var cuadradoLata = document.getElementById("cuadrado-lata");
    var cuadradoCola = document.getElementById("cuadrado-cola");

    document.getElementById("manzana").addEventListener("click", function() {
      cuadradoManzana.style.display = "block";
      cuadradoPapel.style.display = "none";
    });

    document.getElementById("papel").addEventListener("click", function() {
      cuadradoPapel.style.display = "block";
      cuadradoManzana.style.display = "none";

    });

    document.getElementById("lata").addEventListener("click", function() {
      cuadradoLata.style.display = "block";
      cuadradoManzana.style.display = "none";
      cuadradoPapel.style.display = "none";
    });

    document.getElementById("cola").addEventListener("click", function() {
      cuadradoLata.style.display = "none";
      cuadradoManzana.style.display = "none";
      cuadradoPapel.style.display = "none";
      cuadradoCola.style.display = "block";
    });

    document.querySelector("#cuadrado-lata .amarillo").addEventListener("click", function(event) {
      event.stopPropagation(); // Evitar la propagación del clic al contenedor de la lata

      cuadradoLata.style.display = "none";
      document.getElementById("lata").style.visibility = "hidden";
    });

    document.querySelector("#cuadrado-cola .verde").addEventListener("click", function(event) {
      event.stopPropagation();

      cuadradoCola.style.display = "none"; // Ocultar el cuadro blanco de la cola

      // Ocultar también la imagen de la cola si se hace clic en el cuadro verde
      document.getElementById("cola").style.display = "none";
    });

    document.querySelector("#cuadrado-manzana .marron").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor de la manzana
      cuadradoManzana.style.display = "none";
      document.getElementById("manzana").style.visibility = "hidden";
    });

    document.querySelector("#cuadrado-papel .azul").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor del papel
      cuadradoPapel.style.display = "none";
      document.getElementById("papel").style.visibility = "hidden";
    });




    var cuadradoManzana = document.getElementById("cuadrado-manzana");
    var interruptorManzana = false; // Estado inicial: apagado

    document.getElementById("manzana").addEventListener("click", function() {
      cuadradoManzana.style.display = (interruptorManzana = !interruptorManzana) ? "block" : "none";
    });

    document.querySelector("#cuadrado-manzana .marron").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor de la manzana

      if (interruptorManzana) {
        cuadradoManzana.style.display = "none";
        interruptorManzana = false;
      }
    });


    var cuadradoPapel = document.getElementById("cuadrado-papel");
    var interruptorPapel = false; // Estado inicial: apagado

    document.getElementById("papel").addEventListener("click", function() {
      cuadradoPapel.style.display = (interruptorPapel = !interruptorPapel) ? "block" : "none";
    });

    document.querySelector("#cuadrado-papel .azul").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor del papel

      if (interruptorPapel) {
        cuadradoPapel.style.display = "none";
        interruptorPapel = false;
      }
    });


    var cuadradoLata = document.getElementById("cuadrado-lata");
    var interruptorLata = false;

    document.getElementById("lata").addEventListener("click", function() {
      cuadradoLata.style.display = (interruptorLata = !interruptorLata) ? "block" : "none";
    });

    document.querySelector("#cuadrado-lata .amarillo").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor del papel

      if (interruptorlata) {
        cuadradoLata.style.display = "none";
        interruptorLata = false;
      }
    });


    var cuadradoCola = document.getElementById("cuadrado-cola");
    var interruptorCola = false;

    document.getElementById("cola").addEventListener("click", function() {
      cuadradoCola.style.display = (interruptorCola = !interruptorCola) ? "block" : "none";
    });

    document.querySelector("#cuadrado-cola .verde").addEventListener("click", function(event) {
      event.stopPropagation(); // Evita que el clic se propague al contenedor del papel

      if (interruptorcola) {
        cuadradoCola.style.display = "none";
        interruptorCola = false;
      }
    });
  </script>

  <script>
    function handleColorClick(color, cuadrado) {
      const imagenX = `imagenes/${color}-x.png`;
      const imagenesColores = cuadrado.querySelectorAll(`.${color}`);
      const width = window.getComputedStyle(imagenesColores[0]).getPropertyValue('width');

      imagenesColores.forEach(imagen => {
        if (!imagen.src.includes('-x')) {
          imagen.src = imagenX;
          imagen.style.width = width;
        }
        imagen.removeEventListener('click', () => handleColorClick(color, cuadrado));
      });

      if (color === 'verde' && cuadrado.id === 'cuadrado-manzana') {
        updateVidasImage(cuadrado);
      }
    }

    // Asociar el clic en las imágenes de frutas y colores a handleColorClick
    document.querySelectorAll('#manzana, #papel, #lata, #cola, .verde, .azul, .amarillo, .marron').forEach(elemento => {
      elemento.addEventListener('click', () => {
        const colorClass = elemento.classList[0] || elemento.id;
        const cuadrado = elemento.closest('.cuadrado-blanco');
        handleColorClick(colorClass, cuadrado);
      });
    });
  </script>


  <script>
    function handleColorClick(color, cuadrado) {
      const imagenX = `imagenes/${color}-x.png`;
      const imagenesColores = cuadrado.querySelectorAll(`.${color}`);
      const width = window.getComputedStyle(imagenesColores[0]).getPropertyValue('width');

      imagenesColores.forEach(imagen => {
        if (!imagen.src.includes('-x')) {
          imagen.src = imagenX;
          imagen.style.width = width;
        }
        imagen.removeEventListener('click', () => handleColorClick(color, cuadrado));
      });

      if (color === 'verde' && cuadrado.id === 'cuadrado-manzana') {
        updateVidasImage(cuadrado);
      }
    }

    // Asociar el clic en las imágenes de frutas y colores a handleColorClick
    document.querySelectorAll('#manzana, #papel, #lata, #cola, .verde, .azul, .amarillo, .marron').forEach(elemento => {
      elemento.addEventListener('click', () => {
        const colorClass = elemento.classList[0] || elemento.id;
        const cuadrado = elemento.closest('.cuadrado-blanco');
        handleColorClick(colorClass, cuadrado);
      });
    });
  </script>




  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let contador = 3;
      const contadorElement = document.getElementById('contador');
      const mensajePerdiste = document.getElementById('mensajePerdiste');
      const cuadradoEstrellas = document.getElementById('cuadradoEstrellas');

      mensajePerdiste.style.display = "none";
      cuadradoEstrellas.style.display = "none";

      const updateVidas = function(cuadrado, coloresRequeridos) {
        const clickedColors = new Set();

        coloresRequeridos.forEach(color => {
          cuadrado.querySelector(`.${color}`).addEventListener('click', function() {
            clickedColors.add(color);
            if (coloresRequeridos.every(color => clickedColors.has(color))) {
              contador--;
              if (contador >= 0) {
                contadorElement.textContent = contador;
              }

              if (contador === 0) {
                mensajePerdiste.style.display = "block";
                cuadradoEstrellas.style.display = "block";
              } else {
                mensajePerdiste.style.display = "none";
                cuadradoEstrellas.style.display = "none";
              }
            }
          });
        });
      }; // Cierre correcto de la función updateVidas

      const cuadrados = document.querySelectorAll('.cuadrado-blanco');

      cuadrados.forEach(cuadrado => {
        if (cuadrado.id === 'cuadrado-manzana') {
          updateVidas(cuadrado, ['amarillo']);
        }
        if (cuadrado.id === 'cuadrado-manzana') {
          updateVidas(cuadrado, ['azul']);
        }
        if (cuadrado.id === 'cuadrado-manzana') {
          updateVidas(cuadrado, ['verde']);
        }

        if (cuadrado.id === 'cuadrado-lata') {
          updateVidas(cuadrado, ['azul']);
        }
        if (cuadrado.id === 'cuadrado-lata') {
          updateVidas(cuadrado, ['verde']);
        }

        if (cuadrado.id === 'cuadrado-lata') {
          updateVidas(cuadrado, ['marron']);
        }

        if (cuadrado.id === 'cuadrado-cola') {
          updateVidas(cuadrado, ['azul']);
        }

        if (cuadrado.id === 'cuadrado-cola') {
          updateVidas(cuadrado, ['marron']);
        }

        if (cuadrado.id === 'cuadrado-cola') {
          updateVidas(cuadrado, ['amarillo']);
        }

        if (cuadrado.id === 'cuadrado-papel') {
          updateVidas(cuadrado, ['amarillo']);
        }

        if (cuadrado.id === 'cuadrado-papel') {
          updateVidas(cuadrado, ['marron']);
        }

        if (cuadrado.id === 'cuadrado-papel') {
          updateVidas(cuadrado, ['verde']);
        }
      });
    });
  </script>








  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const cuadrados = document.querySelectorAll('.cuadrado-blanco');
      const audioError = new Audio('sonidos/error1.mp3'); // Ajusta la ruta y el formato según tu archivo de sonido

      // Reproducir el audio de inmediato al hacer clic
      cuadrados.forEach(cuadrado => {
        cuadrado.addEventListener('click', function() {
          // Lógica para verificar si el color es correcto o incorrecto
          const colorCorrecto = false; // Reemplaza esto con tu lógica real

          if (!colorCorrecto) {
            // Pausar el audio si ya está en reproducción para evitar superposiciones
            audioError.pause();
            audioError.currentTime = 0; // Reiniciar la reproducción al inicio

            // Reproducir el sonido de error de inmediato
            audioError.play().catch(error => {
              console.error('Error al reproducir el sonido:', error);
            });
          }
        });
      });
    });



    document.addEventListener("DOMContentLoaded", function() {
      const cuadradoManzana = document.getElementById('cuadrado-manzana');
      const colorMarron = cuadradoManzana.querySelector('.marron');
      const audioMarron = new Audio('sonidos/tirar-manzana.mp3'); // Ajusta la ruta y el formato según tu archivo de sonido

      // Reproducir el sonido al hacer clic en el color marrón
      colorMarron.addEventListener('click', function() {
        // Pausar el audio si ya está en reproducción para evitar superposiciones
        audioMarron.pause();
        audioMarron.currentTime = 0; // Reiniciar la reproducción al inicio

        // Reproducir el sonido de inmediato
        audioMarron.play().catch(error => {
          console.error('Error al reproducir el sonido:', error);
        });
      });
    });


    document.addEventListener("DOMContentLoaded", function() {
      const cuadradoAmarillo = document.getElementById('cuadrado-lata');
      const colorAmarrillo = cuadradoLata.querySelector('.amarillo');
      const audioAmarillo = new Audio('sonidos/tirar-botella-plastico.mp3'); // Ajusta la ruta y el formato según tu archivo de sonido

      // Reproducir el sonido al hacer clic en el color marrón
      colorAmarrillo.addEventListener('click', function() {
        // Pausar el audio si ya está en reproducción para evitar superposiciones
        audioAmarillo.pause();
        audioAmarillo.currentTime = 0; // Reiniciar la reproducción al inicio

        // Reproducir el sonido de inmediato
        audioAmarillo.play().catch(error => {
          console.error('Error al reproducir el sonido:', error);
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      const cuadradoAzul = document.getElementById('cuadrado-papel');
      const colorAzul = cuadradoPapel.querySelector('.azul');
      const audioAzul = new Audio('sonidos/tirar-carton.mp3'); // Ajusta la ruta y el formato según tu archivo de sonido

      // Reproducir el sonido al hacer clic en el color marrón
      colorAzul.addEventListener('click', function() {
        // Pausar el audio si ya está en reproducción para evitar superposiciones
        audioAzul.pause();
        audioAzul.currentTime = 0; // Reiniciar la reproducción al inicio

        // Reproducir el sonido de inmediato
        audioAzul.play().catch(error => {
          console.error('Error al reproducir el sonido:', error);
        });
      });
    });

    document.addEventListener("DOMContentLoaded", function() {
      const cuadradoVerde = document.getElementById('cuadrado-cola');
      const colorVerde = cuadradoCola.querySelector('.verde');
      const audioVerde = new Audio('sonidos/tirar-botella-vidrio.mp3'); // Ajusta la ruta y el formato según tu archivo de sonido

      // Reproducir el sonido al hacer clic en el color marrón
      colorVerde.addEventListener('click', function() {
        // Pausar el audio si ya está en reproducción para evitar superposiciones
        audioVerde.pause();
        audioVerde.currentTime = 0; // Reiniciar la reproducción al inicio

        // Reproducir el sonido de inmediato
        audioVerde.play().catch(error => {
          console.error('Error al reproducir el sonido:', error);
        });
      });
    });
  </script>


















  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Lista de colores correctos que se deben seleccionar
      const coloresCorrectos = ['verde', 'azul', 'amarillo', 'marron'];

      // Lista de colores seleccionados por el usuario
      const coloresSeleccionados = new Set();

      // Función para verificar si se deben mostrar las 3 estrellas
      function verificarMostrarEstrellas() {
        if (coloresCorrectos.every(color => coloresSeleccionados.has(color))) {
          // Mostrar la imagen de 3 estrellas cuando todos los colores correctos han sido seleccionados
          document.getElementById('cuadradoEstrellas3').style.display = 'block';
        }
      }

      // Asociar el clic en las imágenes de colores a la lógica de selección
      document.querySelectorAll('.verde, .azul, .amarillo, .marron').forEach(elemento => {
        elemento.addEventListener('click', function() {
          const color = elemento.classList[0] || elemento.id; // Obtener el nombre del color
          coloresSeleccionados.add(color); // Agregar el color a la lista de seleccionados
          verificarMostrarEstrellas(); // Verificar si se deben mostrar las 3 estrellas
        });
      });
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Lista de colores correctos que se deben seleccionar
      const coloresCorrectos = ['verde', 'azul', 'amarillo', 'marron'];

      // Lista de colores seleccionados por el usuario
      const coloresSeleccionados = new Set();

      // Función para verificar si se deben mostrar las estrellas según el contador
      function verificarMostrarEstrellas() {
        if (coloresCorrectos.every(color => coloresSeleccionados.has(color))) {
          if (contador === 3) {
            // Mostrar la imagen de 3 estrellas cuando todos los colores correctos han sido seleccionados
            document.getElementById('cuadradoEstrellas3').style.display = 'block';
            document.getElementById('cuadradoEstrellas2').style.display = 'none';
            document.getElementById('cuadradoEstrellas1').style.display = 'none';
          } else if (contador === 2) {
            // Ocultar la imagen de 2 estrellas cuando el contador está en 2
            document.getElementById('cuadradoEstrellas2').style.display = 'none';
          } else if (contador === 1) {
            // Mostrar la imagen de 2 estrellas cuando fallas 1 vez
            document.getElementById('cuadradoEstrellas2').style.display = 'block';
            document.getElementById('cuadradoEstrellas1').style.display = 'none';
          }
        }
      }

      // Asociar el clic en las imágenes de colores a la lógica de selección
      document.querySelectorAll('.verde, .azul, .amarillo, .marron').forEach(elemento => {
        elemento.addEventListener('click', function() {
          const color = elemento.classList[0] || elemento.id; // Obtener el nombre del color
          coloresSeleccionados.add(color); // Agregar el color a la lista de seleccionados
          verificarMostrarEstrellas(); // Verificar si se deben mostrar las estrellas según el contador
        });
      });
    });
  </script>



  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Lista de colores correctos que se deben seleccionar
      const coloresCorrectos = ['verde', 'azul', 'amarillo', 'marron'];

      // Lista de colores seleccionados por el usuario
      const coloresSeleccionados = new Set();

      // Función para verificar si se deben mostrar las estrellas según el contador
      function verificarMostrarEstrellas() {
        if (coloresCorrectos.every(color => coloresSeleccionados.has(color))) {
          if (contador === 3) {
            // Mostrar la imagen de 3 estrellas cuando todos los colores correctos han sido seleccionados
            document.getElementById('cuadradoEstrellas3').style.display = 'block';
            document.getElementById('cuadradoEstrellas2').style.display = 'none';
            document.getElementById('cuadradoEstrellas1').style.display = 'none';
          } else if (contador === 2) {
            // Ocultar la imagen de 2 estrellas cuando el contador está en 2
            document.getElementById('cuadradoEstrellas2').style.display = 'none';
          } else if (contador === 1) {
            // Mostrar la imagen de 2 estrellas cuando fallas 1 vez
            document.getElementById('cuadradoEstrellas2').style.display = 'block';
            document.getElementById('cuadradoEstrellas1').style.display = 'none';
          }
        }
      }

      // Asociar el clic en las imágenes de colores a la lógica de selección
      document.querySelectorAll('.verde, .azul, .amarillo, .marron').forEach(elemento => {
        elemento.addEventListener('click', function() {
          const color = elemento.classList[0] || elemento.id; // Obtener el nombre del color
          coloresSeleccionados.add(color); // Agregar el color a la lista de seleccionados
          verificarMostrarEstrellas(); // Verificar si se deben mostrar las estrellas según el contador
        });
      });
    });
  </script>







  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let segundos = 180;

      function actualizarReloj() {
        const minutos = Math.floor(segundos / 60);
        const segundosRestantes = segundos % 60;

        const minutosStr = minutos < 10 ? '0' + minutos : minutos;
        const segundosStr = segundosRestantes < 10 ? '0' + segundosRestantes : segundosRestantes;

        document.getElementById('reloj').textContent = minutosStr + ':' + segundosStr;

        // Cambiar el color de fondo a rojo a los 50 segundos
        if (segundos === 50) {
          document.getElementById('reloj-container').classList.add('rojo');
        }

        // Cambiar el color de fondo a naranja a los 110 segundos
        if (segundos === 110) {
          document.getElementById('reloj-container').classList.remove('rojo');
          document.getElementById('reloj-container').classList.add('naranja');
        }

        // Agregar la clase shake a los 59 segundos
        if (segundos === 5) {
          document.getElementById('reloj-img').classList.add('shake');
        }

        // Quitar la clase shake a 00:00
        if (segundos === 0) {
          document.getElementById('reloj-img').classList.remove('shake');

          // Mostrar la imagen 2-estrellas si el contador está en 2 segundos
          if (minutos === 0 && segundosRestantes === 2) {
            const img2Estrellas = document.createElement('img');
            img2Estrellas.src = 'ruta_de_la_imagen_2_estrellas.jpg';
            img2Estrellas.alt = 'Imagen 2 estrellas';


            document.getElementById('contenedor-imagen').appendChild(img2Estrellas);
          }
        }
      }

      function iniciarReloj() {
        actualizarReloj();
        const intervalo = setInterval(function() {
          segundos--;

          if (segundos < 0) {
            clearInterval(intervalo);

            // Crear el elemento div
            var cuadradoEstrellas = document.createElement('div');
            cuadradoEstrellas.className = 'cuadrado-estrellas';
            cuadradoEstrellas.id = 'cuadradoEstrellas';
            cuadradoEstrellas.style.display = 'flex';
            cuadradoEstrellas.style.flexDirection = 'row';
            cuadradoEstrellas.style.alignItems = 'center';
            cuadradoEstrellas.style.justifyContent = 'flex-start';
            cuadradoEstrellas.style.height = '100vh';

            // Añadir contenido al div
            cuadradoEstrellas.innerHTML = `
<div class="cuadrado-estrellas" id="cuadradoEstrellas"
style="display: grid; place-items: center; height: 100vh; position: relative;">
    <a href="niveles.php"  style="position: absolute; margin-left: 100px; margin-top: -620px;">
        <img src="imagenes/x.png" alt="Cerrar" style="width: 40px; height: 50px; margin-right: -1124%;" />
    </a>
    <img src="imagenes/gameover.png" alt="Game Over" style="width: 70%; height: auto; margin-left: 30%;" />
    <a href="niveles.php" style="margin-left: 25%; margin-top: -120px;">
        <img src="imagenes/exits.png" alt="Game Over" style="width: 25%; height: auto;" />
    </a>
    <a href="nivel2.php" style="margin-left: 25%; margin-top: -220px;">
        <img src="imagenes/restart-2.png" alt="Estrellas" style="width:40%; height: auto;" />
    </a>
</div>`;




            // Insertar el div en el documento
            document.body.appendChild(cuadradoEstrellas);


          } else {
            actualizarReloj();
          }
        }, 1000);
      }

      iniciarReloj();
    });
  </script>



  <script>
    // Función para cambiar la imagen
    function cambiarImagen() {
      // Obtener la referencia de la imagen a cambiar
      var imagenManzana = document.getElementById("contenedorImagenes").getElementsByTagName("img")[0];

      // Cambiar la fuente de la imagen
      imagenManzana.src = "imagenes/platano-check.png";

      // Cambiar el texto alternativo si es necesario
      imagenManzana.alt = "Manzana Check";
    }
  </script>

  <script>
    // Función para cambiar la imagen
    function cambiarImagen1() {
      // Obtener la referencia de la imagen a cambiar
      var imagenLata = document.getElementById("contenedorImagenes").getElementsByTagName("img")[1];

      // Cambiar la fuente de la imagen
      imagenLata.src = "imagenes/botella-check.png";

      // Cambiar el texto alternativo si es necesario
      imagenLata.alt = "Lata Check";
    }
  </script>

  <script>
    // Función para cambiar la imagen
    function cambiarImagen2() {
      // Obtener la referencia de la imagen a cambiar
      var imagenPapel = document.getElementById("contenedorImagenes").getElementsByTagName("img")[2];

      // Cambiar la fuente de la imagen
      imagenPapel.src = "imagenes/carto-check.png";

      // Cambiar el texto alternativo si es necesario
      imagenPapel.alt = "Papel Check";
    }
  </script>

  <script>
    // Función para cambiar la imagen
    function cambiarImagen3() {
      // Obtener la referencia de la imagen a cambiar
      var imagenCola = document.getElementById("contenedorImagenes").getElementsByTagName("img")[3];

      // Cambiar la fuente de la imagen
      imagenCola.src = "imagenes/choco-check.png";

      // Cambiar el texto alternativo si es necesario
      imagenCola.alt = "Cola Check";
    }
  </script>








  <script>
    var rectanguloVisible = true;

    function ocultarRectangulo() {
      var rectangulo = document.querySelector(".rectangulo");
      rectanguloVisible = !rectanguloVisible;

      if (rectanguloVisible) {
        rectangulo.style.display = "block";
      } else {
        rectangulo.style.display = "none";
      }
    }
  </script>







  <script>
    // Función para abrir el cuadro de diálogo y mostrar el fondo borroso
    function abrirDialogo() {
      var dialogBox = document.getElementById("dialogBox");
      var dialogBoxBg = document.getElementById("dialogBoxBg");

      dialogBox.style.display = "block";
      dialogBoxBg.style.display = "block";
    }

    // Función para cerrar el cuadro de diálogo y ocultar el fondo borroso
    function cerrarDialog() {
      var dialogBox = document.getElementById("dialogBox");
      var dialogBoxBg = document.getElementById("dialogBoxBg");

      dialogBox.style.display = "none";
      dialogBoxBg.style.display = "none";
    }
  </script>

  <script>
    function cambiarImagen() {
      var imagen = document.getElementById('imagen');
      imagen.src = 'imagenes/CONTINUE-HOVER.png'; // Cambia la ruta de la imagen en hover
    }

    function restaurarImagen() {
      var imagen = document.getElementById('imagen');
      imagen.src = 'imagenes/CONTINUE.png'; // Restaura la imagen original al dejar de hacer hover
    }

    function cerrarDialog() {
      // Tu función cerrarDialog() aquí
    }
  </script>







  <script>
    function playSound(audioId) {
      var audio = document.getElementById(audioId);
      if (audio) {
        audio.currentTime = 0; // Rewind to the start
        audio.play().catch(function(error) {
          console.log('Error playing audio: ', error);
        });
      } else {
        console.log('Audio element not found: ', audioId);
      }
    }

    document.getElementById('manzana').addEventListener('mouseover', function() {
      playSound('audio-manzana');
    });
    document.getElementById('papel').addEventListener('mouseover', function() {
      playSound('audio-papel');
    });
    document.getElementById('lata').addEventListener('mouseover', function() {
      playSound('audio-lata');
    });
    document.getElementById('cola').addEventListener('mouseover', function() {
      playSound('audio-cola');
    });

    document.getElementById('verde').addEventListener('mouseover', function() {
      playSound('audio-verde');
    });
    document.getElementById('azul').addEventListener('mouseover', function() {
      playSound('audio-azul');
    });
    document.getElementById('amarillo').addEventListener('mouseover', function() {
      playSound('audio-amarillo');
    });
    document.getElementById('marron').addEventListener('mouseover', function() {
      playSound('audio-marron');
    });

    // Añadir eventos para las imágenes adicionales en otros contenedores
    document.getElementById('verde-papel').addEventListener('mouseover', function() {
      playSound('audio-verde');
    });
    document.getElementById('azul-papel').addEventListener('mouseover', function() {
      playSound('audio-azul');
    });
    document.getElementById('amarillo-papel').addEventListener('mouseover', function() {
      playSound('audio-amarillo');
    });
    document.getElementById('marron-papel').addEventListener('mouseover', function() {
      playSound('audio-marron');
    });

    document.getElementById('verde-lata').addEventListener('mouseover', function() {
      playSound('audio-verde');
    });
    document.getElementById('azul-lata').addEventListener('mouseover', function() {
      playSound('audio-azul');
    });
    document.getElementById('amarillo-lata').addEventListener('mouseover', function() {
      playSound('audio-amarillo');
    });
    document.getElementById('marron-lata').addEventListener('mouseover', function() {
      playSound('audio-marron');
    });

    document.getElementById('verde-cola').addEventListener('mouseover', function() {
      playSound('audio-verde');
    });
    document.getElementById('azul-cola').addEventListener('mouseover', function() {
      playSound('audio-azul');
    });
    document.getElementById('amarillo-cola').addEventListener('mouseover', function() {
      playSound('audio-amarillo');
    });
    document.getElementById('marron-cola').addEventListener('mouseover', function() {
      playSound('audio-marron');
    });
  </script>

  <script>
    // Función para abrir el cuadro de diálogo y mostrar el fondo borroso
    function abrirDialogo() {
      var dialogBox = document.getElementById("dialogBox");
      var dialogBoxBg = document.getElementById("dialogBoxBg");

      dialogBox.style.display = "block";
      dialogBoxBg.style.display = "block";
    }

    // Función para cerrar el cuadro de diálogo y ocultar el fondo borroso
    function cerrarDialog() {
      var dialogBox = document.getElementById("dialogBox");
      var dialogBoxBg = document.getElementById("dialogBoxBg");

      dialogBox.style.display = "none";
      dialogBoxBg.style.display = "none";
    }
  </script>

 

</body>

</html>