<style>
  table {
      width: 100%;
      border-collapse: collapse;
    }   

    table tr td {
        text-align: center;

        border: 1px solid black;
    }

    table tr:first-child td {
        color: white;
        background-color: #008374;
    }

    table tr:not(:first-child) td:first-child {
        background-color: #089f8e;
    }

    table tr:not(:first-child) td:not(:first-child) {
        background-color: #6aaca5;
    }

    table tr:not(:first-child) td:last-child {
        background-color: #639f99;
        color: darkred
    }

    table:not(.registo_es) tr:not(:first-child) td:nth-child(1), table:not(.registo_es) tr:not(:first-child) td:nth-child(5) {
        width: 5%
    }

    table button {
      all: unset;
      color: white;
      padding: 0 1em;
      background-color: #447772;
    }

    table button:hover {
      background-color: #40716c;
    }

    table td:has(.acess-btn) {
      background-color: #447772 !important;
    }
</style>
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


                  if ($id_tp != 10 && $id_tp != 2) echo '<li><a href="MedicalNotesInfos.php">Visualizar Ficha</a></li>';
                  else echo '<li><a href="controlefichamedicas.php">Controle das Fichas Medicas</a></li>';
                  
                  if ($id_tp == 10) echo '<li><a href="GeradorQR.php">Gerar QrCodes</a></li>';
                  if ($id_tp != 10 && $id_tp != 2) echo '<li><a href="MedicalNotes.php">Editar Ficha</a></li>';
                } else {
                    echo '<li><a href="MedicalNotes.php">Nova Ficha</a></li>';
                }

                $conn->close();
              ?>
            </ul>
          </li>
          <?php
                include 'ligaBD.php';

                $idPessoaCookie = $_COOKIE['idpessoa'];

                $sql = "SELECT id_tp FROM pessoa WHERE pessoa.id_pessoa = '$idPessoaCookie'";
                $result = $conn->query($sql); 

                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $id_tp = $row['id_tp'];


                  if ($id_tp == 10) echo '<li><a href="Turmas.php">Criação de Turmas</a></li>';

                }

                $conn->close();
              ?>
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