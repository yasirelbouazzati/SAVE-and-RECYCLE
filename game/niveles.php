<?php
require_once 'classes/conexionDB.php';

$conexion = new ConexionDB();

session_start();

?>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LEVELS</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="shortcut icon" href="./imagenes/favicon.png" type="image/x-icon" />
  <style>
    body {
      overflow: hidden;
      /* Esto ocultará las barras de desplazamiento del cuerpo del documento */
    }

    /* Si quieres ocultar solo las barras de desplazamiento horizontal o vertical, puedes usar las siguientes reglas */
    body {
      overflow-x: hidden;
      /* Esto ocultará la barra de desplazamiento horizontal */
    }

    body {
      overflow-y: hidden;
      /* Esto ocultará la barra de desplazamiento vertical */
    }



    main {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 50vh;
    }

    .nivel-container {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      grid-gap: 50px;
      justify-content: center;
      margin-top: 20%;
    }

    .nivel {
      width: 10vw;
      height: 10vw;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 90px;
      color: #fff;
      font-weight: bold;
      border-radius: 10px;
      transition: box-shadow 0.3s;
    }

    .numero {
      display: block;
      text-align: center;
    }

   

    .nivel_bloqueado:hover {
      animation: vibrar 0.5s ease infinite;
    }

    .nivel1_link {
      text-decoration: none;
      color: #fff;
    }

    @keyframes vibrar {
      0% {
        transform: translate(0, 0);
      }

      10% {
        transform: translate(-5px, 5px);
      }

      20% {
        transform: translate(5px, -5px);
      }

      30% {
        transform: translate(-5px, -5px);
      }

      40% {
        transform: translate(5px, 5px);
      }

      50% {
        transform: translate(-5px, 5px);
      }

      60% {
        transform: translate(5px, -5px);
      }

      70% {
        transform: translate(-5px, -5px);
      }

      80% {
        transform: translate(5px, 5px);
      }

      90% {
        transform: translate(-5px, 5px);
      }

      100% {
        transform: translate(0, 0);
      }
    }

    .nivel_bloqueado {
      position: relative;
      width: 10vw;
      height: 10vw;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 90px;
      color: #fff;
      font-weight: bold;
      border-radius: 10px;
      transition: box-shadow 0.3s;
    }

    .nivel_bloqueado img {
      position: absolute;
      top: 10;
      left: 0;
      max-width: 120%;
      max-height: 22vh;
    }

    .cerrar-link {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 999;
    }

    .title {
      position: absolute;
      top: 20px;
      left: 655px;
      z-index: 999;
    }

  



   .dialog-box {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100vh;
  padding: 20px;
  z-index: 1000;
}

.dialog-box::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
 background: linear-gradient(45deg, #9370db, #ff69b4, #ffa07a);
  filter: blur(4.5px); /* Aplicar un desenfoque de 10px a la imagen de fondo */
  z-index: -1;
  pointer-events: none; /* Asegura que el pseudo-elemento no capture eventos de ratón */
}




    .dialog-box p {
      color: #fff;
      font-size: 24px;
      /* Tamaño del texto ajustado */
      font-weight: bold;
      /* Negrita */
      margin-top:240px;
      /* Espacio después del texto */
    }

    .dialog-buttons {
      margin-top: 120px;
      margin-left:37%
    }

    .dialog-buttons button {
      margin: 0 10px;
      padding: 10px 90px;
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

    /* Agrega estilos adicionales para el menú desplegable */
    /* Agrega estilos adicionales para el menú desplegable */
    .reseña {
      position: absolute;
      top: 20px;
      left: 1299px;
      z-index: 999;
    }

    .reseña select {
      font-size: 16px;
      padding: 5px;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Estilos para la sección de reseñas */

    .reseña-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .emoji-container {
      text-align: right;
      /* Alinea todos los elementos a la derecha */
    }

    .emoji {
      display: inline-block;
      font-size: 24px;
      cursor: pointer;
      margin: 5px;
      padding: 10px;
      border-radius: 50%;
      transition: transform 0.3s ease-in-out;
    }

    .emoji:hover {
      transform: scale(1.2);
      /* Ajusta según sea necesario */
    }

    .feliz {
      background-color: #2ecc71;
      /* Color verde para feliz */
    }

    .neutro {
      background-color: #f39c12;
      /* Color naranja para neutro */
    }

    .triste {
      background-color: #e74c3c;
      /* Color rojo para triste */
    }

    .reseña-emoji {
      font-size: 24px;
      margin-right: 10px;
    }

    /* Alinea todo a la derecha */
    .container {
      float: right;
    }

    .puntos-container {
      position: absolute;
      top: 20px;
      left: 1490px;
      display: flex;
      align-items: center;
      font-size: 18px;
      color: #fff;
      z-index: 999;
      color: white;
    }

    .puntos-icon {
      margin-right: -60px;
      width: 35px;
      /* Ajusta el tamaño según sea necesario */
      height: 30px;
      
    }

    /* Aplica la fuente Pixelify Sans a los números */
    .pixelify-sans-font {
      font-family: "Pixelify Sans", sans-serif;
      /* Reemplaza 'Pixelify Sans' con el nombre real de la fuente que has descargado */
      font-size: 16px;
      /* Ajusta el tamaño de la fuente según tus necesidades */
      image-rendering: pixelated;
      /* Aplica la apariencia pixelada */
    }

    #cubo1-2 {
      width: 150%;
      height: 22vh;
    }


    .fondo {
  background-image: url(imagenes/pio.gif);
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  width: 100vh;
  height: 100%;
}
 

.nivel_bloqueado {
  cursor: pointer;
}

.mensaje-oculto {
  display: none;
  position: fixed;
  top:90%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: black;
  color: white;
  padding: 20px;
  border-radius: 10px;
  z-index: 1000;
}

.mensaje-visible {
  display: block;
}

  </style>
</head>

<body class="fondo">
  <main>

  <audio autoplay loop>
      <source src="sonidos/musica (3).mp3" type="audio/mp3">
    </audio>

    <a href="index.html" class="cerrar-link">
      <img src="imagenes/xxx.png" alt="Cerrar" style="
            width: 100px;
            height: 100px;
            margin-top: -24px;
            margin-left: -22px;
          " />
    </a>

    <div class="title">
      <img src="imagenes/levels1.png" style="width: 200px; height: 65px" />
    </div>

    <!-- Contenido del archivo niveles.html -->
    <div class="puntos-container">
      <img src="imagenes/moneda.png" alt="Puntos" class="puntos-icon" />
      <span class="pixelify-sans-font" id="score2"><?php echo $_SESSION['puntos'] ?></span>
    </div>

    <div class="nivel-container">
      <a href="libro.html" class="nivel1_link">
        <div class="nivel">
          <span class="numero" href="nivel1.html">

            <img id="cubo1.1" src="imagenes/cubo1.1.png" style="width: 150%; height: 22vh; opacity: 1;" alt="" onmouseover="cambiarImagen1(); reproducirSonido();" onmouseout="restaurarImagen1()">
            <audio id="sonido-coco" src="sonidos/coco.mp3"></audio>


          </span>
        </div>
      </a>


      <a href="libro2.html" class="nive1_link">
        <div class="nivel">
          <span class="numero" href="nivel2.php">
            <img id="cubo1-2" src="imagenes/cubo222.png" style="width: 150%; height: 22vh;" alt="" onmouseover="cambiarImagen2(); reproducirSonido();" onmouseout="restaurarImagen2()" />
            <audio id="sonido-coco" src="sonidos/coco.mp3"></audio>
          </span>
        </div>
      </a><audio id="sonido-coco" src="sonidos/coco.mp3"></audio>



      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img id="cubo1-2" src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
      <div class="nivel_bloqueado">
        <span class="numero"></span>
        <img src="imagenes/cubo1su.-png.png" style="width: 150%; height: 22vh; margin-top: -13px;" alt="" />
        <img src="imagenes/candado.png" alt="" style="width: 125px; margin-top: 20px; margin-left: 22%;" />
      </div>
    </div>

 <div id="mensaje" class="mensaje-oculto">
   This level is not available. It's coming soon
  </div>

<div class="dialog-box-bg" id="dialogBoxBg"></div>
    <div class="dialog-box" id="dialogBox">
      <img src="imagenes/are you sure.png" alt="" style=" margin-top:240px; margin-left:20%">
      <div class="dialog-buttons">
        <button class="sí" onclick="cerrarVentana()">Yes</button>
        <button class="no" onclick="cerrarDialog()">No</button>
      </div>
    </div>

  </main>
</body>
<script>
  // Funciones para mostrar/ocultar el diálogo
  function mostrarDialog() {
    document.getElementById("dialogBox").style.display = "block";
  }

  function cerrarDialog() {
    document.getElementById("dialogBox").style.display = "none";
  }

  // Esta función podría redirigirte a la página de inicio, por ejemplo.
  function cerrarVentana() {
    // Simplemente redirigir a la página de inicio por ejemplo
    window.location.href = "index.php";
  }

  // Evento al hacer clic en el botón "x"
  document
    .querySelector(".cerrar-link")
    .addEventListener("click", function(event) {
      event.preventDefault(); // Evita el comportamiento predeterminado del enlace
      mostrarDialog(); // Muestra el cuadro de diálogo
    });
</script>

<script>
  function seleccionarEstadoAnimo(nivel) {
    var emojiSeleccionado = document.getElementById("estadoAnimo").value;
    enviarReseña(nivel, emojiSeleccionado);
  }

  function enviarReseña(nivel, emoji) {
    var confirmacion = confirm("¿Quieres enviar esta reseña?");

    if (confirmacion) {
      fetch("guardar_resena.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            nivel: nivel,
            emoji: emoji,
          }),
        })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Reseña enviada exitosamente.");
          } else {
            console.error("Error al enviar la reseña:", data.error);
            alert("Error al enviar la reseña.");
          }
        });
    }
  }
</script>

<script>
  function cambiarImagen1() {
    var imagen = document.getElementById('cubo1.1');
    imagen.style.opacity = '0'; // Cambia la opacidad a 0 para desvanecer la imagen
    setTimeout(function() {
      imagen.src = 'imagenes/cubo1.2.png'; // Cambia la imagen después de la animación
      imagen.style.opacity = '1'; // Restaura la opacidad a 1 para mostrar la nueva imagen
    }, ); // Espera 500 milisegundos antes de cambiar la imagen
  }

  function restaurarImagen1() {
    var imagen = document.getElementById('cubo1.1');
    imagen.style.opacity = '0'; // Cambia la opacidad a 0 para desvanecer la imagen
    setTimeout(function() {
      imagen.src = 'imagenes/cubo1.1.png'; // Cambia la imagen después de la animación
      imagen.style.opacity = '1'; // Restaura la opacidad a 1 para mostrar la imagen original
    }, ); // Espera 500 milisegundos antes de cambiar la imagen
  }
</script>

<script>
  function cambiarImagen2() {
    document.getElementById('cubo1-2').src = 'imagenes/cubo2.2.png';
  }

  function restaurarImagen2() {
    document.getElementById('cubo1-2').src = 'imagenes/cubo222.png';
  }
</script>




<script>
  var sonidoCoco = new Audio('sonidos/coco.mp3');

  function reproducirSonido() {
    sonidoCoco.currentTime = 0; // Reiniciar el sonido al principio
    sonidoCoco.play(); // Reproducir el sonido
  }

  function cambiarImagen1() {
    document.getElementById("cubo1.1").src = "imagenes/cubo1.2.png"; // Cambiar la imagen al hacer hover
  }

  function restaurarImagen1() {
    document.getElementById("cubo1.1").src = "imagenes/cubo1.1.png"; // Restaurar la imagen al quitar el mouse
  }
</script>




<script>
  var sonidoCoco = new Audio('sonidos/coco.mp3');

  function reproducirSonido() {
    sonidoCoco.currentTime = 0; // Reiniciar el sonido al principio
    sonidoCoco.play(); // Reproducir el sonido
  }

  function cambiarImagen2() {
    document.getElementById("cubo1-2").src = "imagenes/cubo2.2.png"; // Cambiar la imagen al hacer hover
  }

  function restaurarImagen2() {
    document.getElementById("cubo1-2").src = "imagenes/cubo222.png"; // Restaurar la imagen al quitar el mouse
  }
</script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    var sonidoCadena = new Audio('sonidos/cadena.mp3');
    sonidoCadena.preload = 'auto'; // Cargar el audio de antemano
    sonidoCadena.load(); // Forzar la carga del audio

    var sonidoEnCurso = false; // Para controlar si el sonido está en curso

    function reproducirSonido() {
      if (!sonidoEnCurso) { // Si el sonido no está en curso
        sonidoCadena.currentTime = 0; // Reiniciar el sonido al principio
        sonidoCadena.play(); // Reproducir el sonido
        sonidoEnCurso = true; // Actualizar el estado del sonido
      }
    }

    function detenerSonido() {
      sonidoCadena.pause(); // Pausar el sonido
      sonidoCadena.currentTime = 0; // Reiniciar al principio
      sonidoEnCurso = false; // Actualizar el estado del sonido
    }

    var imgs = document.querySelectorAll(".nivel_bloqueado img");

    imgs.forEach(function(img) {
      img.addEventListener("mouseenter", function() {
        reproducirSonido(); // Reproducir el sonido al hacer hover
      });
      img.addEventListener("mouseleave", function() {
        detenerSonido(); // Detener el sonido al quitar el mouse
      });
    });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {
  const nivelesBloqueados = document.querySelectorAll('.nivel_bloqueado');
  const mensaje = document.getElementById('mensaje');

  nivelesBloqueados.forEach(nivel => {
    nivel.addEventListener('click', function() {
      mensaje.classList.add('mensaje-visible');
      setTimeout(() => {
        mensaje.classList.remove('mensaje-visible');
      }, 2000); // Oculta el mensaje después de 2 segundos
    });
  });
});

</script>






</html>