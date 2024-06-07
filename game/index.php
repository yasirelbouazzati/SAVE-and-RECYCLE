<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SAVE and RECYCLE</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="shortcut icon" href="./imagenes/favicon.png" type="image/x-icon" />

  <style>
    #container {
      text-align: right;
      margin-top: -620px;
      margin-left: 1420px;
    }

    @keyframes shake {
      0% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(2px) rotate(1deg);
      }

      50% {
        transform: translateX(-2px) rotate(-1deg);
      }

      75% {
        transform: translateX(2px) rotate(1deg);
      }

      100% {
        transform: translateX(0);
      }
    }

    #musicList {
      float: right;
      margin-top: -20px;
      margin-right: -71px;
      animation: shake 0.5s infinite;
    }

    #audioPlayer {
      width: 200px;
      opacity: 0%;
    }

    .p {
      opacity: 0%;
    }

    .title--text2 {
      margin-top: 60px;
      margin-left: 7%;
      width: 60%;
      height: auto;
    }

    .fondo {
      background-image: url(imagenes/pio.gif);
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      width: 100vh;
      height: 100%;
    }
  </style>
</head>

<body class="fondo">
  <main>
    <img class="title--text2" src="imagenes/titulo-libro.png" />

    <a href="niveles.php">
      <div class="play" style="margin-top: 80px ">
        <img class="play--btn" src="imagenes/play1.png" style="margin-left: 20%;" />
      </div>
    </a>
    <a href="options.html">
      <div class="play">
        <img class="options--btn" src="imagenes/OPTIONS1.png" style="padding-top: 30px; float: left; margin-top: -20px; height: 7vh; width: 120%; margin-left: -0%;" />
      </div>
    </a>

    <div id="container">
      <div id="musicList">
        <img id="musicButton" src="imagenes/boton-musica1.png" alt="Reproducir" onclick="togglePlayPause()" style="cursor: pointer; width: 80px; margin-top: 20%;" />
      </div>

      <audio class="player" id="audioPlayer"></audio>
    </div>

    <audio id="playAudio" src="sonidos/play.mp3"></audio>
  </main>

  <script src="https://unpkg.com/howler@2.2.3/dist/howler.min.js"></script>

  <script>
    var audioPlayer;
    document.addEventListener("DOMContentLoaded", function () {
      const playButton = document.querySelector(".play--btn");
      const optionsButton = document.querySelector(".options--btn");

      playButton.addEventListener("mouseenter", function () {
        playButton.src = "imagenes/play_hover1.png";
      });

      playButton.addEventListener("mouseleave", function () {
        playButton.src = "imagenes/play1.png";
      });

      optionsButton.addEventListener("mouseenter", function () {
        optionsButton.src = "imagenes/OPTIONS_HOVER1.png";
      });

      optionsButton.addEventListener("mouseleave", function () {
        optionsButton.src = "imagenes/OPTIONS1.png";
      });

      // Inicializa Howler y reproduce la música
      audioPlayer = new Howl({
        src: ["sonidos/musica (3).mp3"],
        volume: 1.0,
        html5: true,
        autoplay: true,
        loop: true,
        onend: function () {
          // Callback cuando la reproducción termina
        },
      });

      // Intenta reproducir el audio
      audioPlayer.play();
    });

    var musicButton = document.getElementById("musicButton");
    var isPlaying = true;

    function togglePlayPause() {
      if (isPlaying) {
        audioPlayer.pause();
        musicButton.src = "imagenes/boton-musica-cerrado1.png";
      } else {
        audioPlayer.play();
        musicButton.src = "imagenes/boton-musica1.png";
      }
      isPlaying = !isPlaying;
    }

    function toggleMusicList() {
      var musicList = document.getElementById("musicList");
      musicList.style.display = musicList.style.display === "block" ? "none" : "block";
    }
  </script>
</body>

</html>
