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
  <title>Controle de Acesso</title>
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');


.team-info {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.team-info h3 {
  color: #333;
  margin-bottom: 15px;
}

.team-members {
  list-style-type: none;
  padding: 0;
}

.team-members li {
  margin-bottom: 10px;
}

#Controledeacesso h3 {
  color: black;
}

#Controledeacesso p {
  color: #555;
  line-height: 1.6;
}

  </style>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
</head>

<body>

  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a
            href="mailto:rebecasantos030904@gmail.com">accessgate@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+351 925-239-735</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/acces.sgate/" class="instagram"><i class="bi bi-instagram"></i></a>
      </div>
    </div>
  </section>

  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <h1>Access Gate<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <script src="script.js"></script>
        <ul>
          <li><a href="Inicio.php">Inicio</a></li>
          <li><a href="controledeacesso.php">Controle de Acesso</a></li>
          <li><a href="controledeacesso.php">Criação de turmas</a></li>
          <li class="dropdown"><a href="#"><span>Ficha Médica</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <?php
                include 'ligaBD.php';

                $idPessoaCookie = $_COOKIE['idpessoa'];

                $sql = "SELECT informacoesmedicas.*, pessoa.id_tp FROM informacoesmedicas, pessoa WHERE pessoa.id_pessoa = informacoesmedicas.id_pessoa AND pessoa.id_pessoa = '$idPessoaCookie'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $id_tp = $row['id_tp'];

                  if ($id_tp != 10) echo '<li><a href="MedicalNotesInfos.php">Visualizar Ficha</a></li>';
                  else echo '<li><a href="controlefichamedicas.php">Controle das Fichas Medicas</a></li>';
                  
                  if ($id_tp == 10) echo '<li><a href="GeradorQR.php">Gerar QrCodes</a></li>';
                  if ($id_tp != 10) echo '<li><a href="MedicalNotes.php">Editar Ficha</a></li>';
                } else {
                    echo '<li><a href="MedicalNotes.php">Nova Ficha</a></li>';
                }

                $conn->close();
              ?>
            </ul>
          </li>
          <li><a href="Sobre.php">Sobre</a></li>
          <?php
              include 'ligaBD.php';

              $idPessoaCookie = $_COOKIE['idpessoa'];

              $sql = "SELECT * FROM informacoesmedicas, pessoa WHERE informacoesmedicas.id_pessoa = pessoa.id_pessoa and informacoesmedicas.id_pessoa = '$idPessoaCookie' and id_tp = 10";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  echo '<li><a href="Register.php">Registo</a></li>';
              } 
          ?>
          <li style="transform: translateX(45px)"><a href="Login.php">Logout</a></li>
        </ul>
      </nav>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
  </header>
  <main id="main">
  <section id="Controledeacesso" class="Controledeacesso">
    <div class="container" data-aos="fade-up">
      <div class="section-header">
        <h2>Sobre</h2>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <p>
            Bem-vindo ao Access Gate, sua solução completa para controle de acesso e informações médicas. Nosso
            compromisso é oferecer uma plataforma inovadora que não só simplifica o gerenciamento de acesso, mas também
            prioriza a segurança e a privacidade dos usuários.
          </p>
          <p>
            O Access Gate foi projetado para atender às necessidades de diferentes setores, desde instituições educacionais
            até empresas. Oferecemos um sistema robusto e intuitivo, permitindo um controle eficiente e seguro do acesso
            às instalações.
          </p>
          <h3>Missão</h3>
          <p>
            Nossa missão é criar uma experiência segura e transparente para o controle de acesso, ao mesmo tempo em que
            promovemos a integridade e a confidencialidade das informações médicas dos usuários.
          </p>
          <h3>Visão</h3>
          <p>
            Queremos ser líderes na inovação de sistemas de controle de acesso, proporcionando tranquilidade aos
            utilizadores, garantindo o acesso seguro e a gestão eficaz de informações médicas.
          </p>
        </div>
        <div class="col-lg-4">
          <div class="team-info">
            <h3>Nossa Equipe</h3>
            <p>
              Conheça as mentes por trás do Access Gate. Nossa equipe é composta por profissionais dedicados e
              especialistas em segurança e tecnologia, trabalhando para garantir a excelência em nossos serviços.
            </p>
            <ul class="team-members">
              <li><strong>Rebeca Santos</strong> - Fundadora e Desenvolvedora</li>
              
              <!-- Adicione mais membros conforme necessário -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</body>

</html>