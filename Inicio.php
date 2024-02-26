<!DOCTYPE html>
<html lang="en">
<?php
  if (!isset($_COOKIE['idpessoa'])) {
    // Se a cookie não estiver presente, redirecionar para a página de login
    header("Location: http://localhost/PAP/FinalProduct/Login.php");
    exit();
  } 
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inicio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/Logo.png" rel="icon">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <!--importacao links para o carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</head>

<body>
  <style>
    .search-container {
      display: flex;
      margin: 10px;
    }

    #search-input {
      padding: 10px;
      flex: 1;
    }

    button {
      background-color: #008374;
      color: white;
      cursor: pointer;
      height: 30px;
    }

    .right-align {
      display: flex;
      flex-direction: row-reverse;
      height: 30px;
    }
  </style>
  <?php include "menu.php" ?>

  <!--uso do accordion-->
  <div id="accordion" class="accordion">
    <h3><a href="https://www.youtube.com/watch?v=7zV7eYxI-bI" target="_blank">Vídeo</a></h3>
    <div>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/7zV7eYxI-bI" frameborder="0"
        allowfullscreen></iframe>
    </div>
  </div>

  <main id="main">
    <section id="Controledeacesso" class="Controledeacesso">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <div id="fade-element" class="fade-element">
            <h2 id="InicioTitle" style="display: none;">Inicio</h2>
          </div>
    </section>
    <button class="prev" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"><</button>
        <button class="next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);">></button>
        <!--uso do carousel-->
        <div id="resizable-element" class="ui-widget-content">
          <div class="owl-carousel">
            <img
              src="https://spbrindespersonalizados.com.br/wp-content/uploads/2022/06/Pulseira-de-silicone-com-brasao-circular-e-QR-Code.jpg"
              style="width: 20%;">
            <img src="https://www.promobrace.com.br/wp-content/uploads/pulseira-de-silicone-com-qr-code-min.png?x45941"
              style="width: 30%;">
            <div><img src="https://www.activecard.pt/images/ps-s003.jpg" style="width: 30%;"></div>
            <div><img src="https://www.activecard.pt/images/ps-s001.jpg" style="width: 30%;"></div>
            <div><img
                src="https://pulseirasparadiscotecas.pt/media/catalog/product/cache/984380f262ebd7808d192b0c230e78e5/p/u/pulseras-silicona-con-codigos-qr.jpg"
                style="width: 30%;"></div>
            <img
              src=" https://orakel-webplatform.s3.eu-central-1.amazonaws.com/pim/scale_550_320/media/product/dda32e37-8e05-48c2-8a84-d9a61a8d9d45/variant/030ab062-ad7c-47dd-b295-e7d7119972c9/6525466f1c6cd-dark-green-silicone-nfc-wristband-1-colour-print-6525466f12051162684798.jpg"
              style="width: 30%;">
          </div>
        </div>
  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <h2>Informações Extras</h2>
          <p>Este site explora informações médicas e promove a saúde dos alunos com nosso site dedicado. Nossa página
            inicial oferece uma visão abrangente, enquanto a secção de entrada fornece insights valiosos sobre o
            bem-estar dos estudantes.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/acces.sgate/" class="instagram"><i class="bi bi-instagram"></i></a>

          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Outros Links</h4>
          <ul>
            <li><a href="#">Início</a></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#">Termos e Condições</a></li>
            <li><a href="#">Política de Privacidade</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Outros contatos</h4>
          <p>
            Av. São João de Deus 1 <br>
            Portimão, 8500-508<br>
            Portugal <br><br>
            <strong>Telemóvel:</strong> +351 958 554 755<br>
            <strong>Email:</strong> accessgate@gmail.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Acess Gate</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by Rebeca Santos
      </div>
    </div>
  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="assets/js/main.js"></script>

  <script>
    $(document).ready(function () {
      // Exemplo de widgets: tornar o elemento com id "accordion" um acordeão e uma interacao
      $("#accordion").accordion({
        collapsible: true, // fechar todas as seções, não ensinado 
        active: false       // começam fechadas, não ensinado 
      });
      // efeito fadeIn no elemento com id "fade-element"
      $("#fade-element").fadeIn();

      // Agora você pode começar a usar outros recursos do jQuery aqui
      $("#fade-element h2").fadeIn(2000); // 2000 é a duração em milissegundos

      $("#toggle-button").on("click", function () {
        $("#toggle-element").slideToggle();
      });

      // Inicializar o Owl Carousel, widgets e plugin
      $(".owl-carousel").owlCarousel();

      // Dispara o evento "next.owl.carousel" no elemento com a classe "owl-carousel"
      $(".next").click(function () {
        $(".owl-carousel").trigger("next.owl.carousel");//dispara manualmente o evento 
      });
    });

  </script>
</body>

</html>