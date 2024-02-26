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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>Ficha Médica</title>

  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/Logo.png" rel="icon">
  <!-- link adicionado por conta própria para animacao !-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>

<body>
  <style>
    input:hover {
      background-color: #f5f5f5;
      transition: background-color 0.3s ease;
    }

    .search-container {
      display: flex;
      margin: 16px;
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

    button[type='submit']:hover {
      background-color: #008374;
      /* Destaque de cor quando o mouse passa sobre o botão de enviar */
      transition: background-color 0.3s ease;
    }

    .success-message {
      color: green;
      font-weight: bold;
      margin-top: 10px;
      animation: fadeIn 2s ease;
      /* Adicionando animação de fade in */
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* Adicionando animação de rotação para o logotipo */
    .logo:hover {
      animation: rotateLogo 1s ease infinite;
    }

    #notification-widget {
      display: none;
      width: 200px;
      top: 10px;
      right: 10px;
      background-color: #008374;
      color: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.9);
    }

    #enviar-ficha-button {
      width: 300px;
      vertical-align: top;
      line-height: 1;
      padding: 20px;
      height: auto; 
    }
  </style>
    <?php include "menu.php" ?>

  <main id="main">
    <section id="FichaMedica" class="FichaMedica">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Editar Ficha Médica</h2>
          <p>Insira os seus dados médicos na ficha abaixo.</p>
        </div>
        <div class="row gx-lg-0 gy-4">
          <!--
          <div class="col-lg-4">
            <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex">
                <h2 id="important-title">Informações Atuais</h2>
              </div>
              <?php

              include 'ligaBD.php';
              // vai buscar as informacoes na tabela informacoesmedicas quando o id pessoa for o correspondente ao que esta na cookie
              $result = mysqli_query($conn, "SELECT * FROM informacoesmedicas WHERE id_pessoa = " . $_COOKIE['idpessoa']);
              //verifica se existe resultados na consulta
              if ($result->num_rows === 0) {
                //senão houver insere valores padrao
                mysqli_query($conn, "INSERT INTO informacoesmedicas (id_pessoa, genero, altura, peso, pressaoarterial, historicoclinico, alergias, tipo_sanguineo, medicacaoatual, cirurgiasanteriores, contatoEmergenciaNome, contatoEmergenciaTelefone) VALUES (" . $_COOKIE['idpessoa'] . ", 'M', 0.00, 0.00, '', '', '', '', '', '', '', '')");
              }
              //Query para obter informacoes pessoais e medicas
              $GetInfosQuery = "SELECT informacoesmedicas.*, pessoa.* FROM informacoesmedicas, pessoa WHERE pessoa.id_pessoa = " . $_COOKIE['idpessoa'] . " and pessoa.id_pessoa = informacoesmedicas.id_pessoa";
              $GetInfos = mysqli_query($conn, $GetInfosQuery);
              // se a consulta foi bem sucedida
              if ($GetInfos) {
                //retira os resutados da consulta
                $result = mysqli_fetch_assoc($GetInfos);
                //atribui os resultados a variaveis
                $id_informacoes_medicas = $result['id_informacoes_medicas'];
                $genero = $result['genero'];
                $altura = $result['altura'];
                $peso = $result['peso'];
                $dataRegistro = $result['dataRegistro'];
                $dataNascimento = $result["Data_nascimento"];
                $nome = $result["Nome"];
              } else {
                echo "Erro na consulta: " . mysqli_error($conn);
              }
              mysqli_close($conn);
              ?>
              <div class="info-item d-flex">
                <i class="bi bi-person flex-shrink-0"></i>
                <div>
                  <h4>Nome:</h4>
                  <p>
                    <?php echo $nome ?>
                  </p>
                </div>
              </div>
              <div class="info-item d-flex">
                <i class="bi bi-gender-ambiguous flex-shrink-0"></i>
                <div>
                  <h4>Género:</h4>
                  <p>
                    <?php echo $genero ?>
                  </p>
                </div>
              </div>
              <div class="info-item d-flex">
                <i class="bi bi-calendar flex-shrink-0"></i>
                <div>
                  <h4>Data de Nascimento:</h4>
                  <p>
                    <?php echo $dataNascimento ?>
                  </p>
                  <h4>Data de Registo:</h4>
                  <p>
                    <?php echo $dataRegistro ?>
                  </p>
                </div>
              </div>
              <div class="info-item d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Altura:</h4>
                  <p>
                    <?php echo $altura ?> cm
                  </p>
                  <h4>Peso:</h4>
                  <p>
                    <?php echo $peso ?> KG
                  </p>
                </div>
              </div>
              <div class="info-item d-flex justify-content-center" style="margin-top: 10px" onclick="abrirPagina()">
                <button style="all:unset">
                  <h4>Ver mais +</h4>
                </button>
              </div>
              <script>
                function abrirPagina() {
                  window.location.href = "MedicalNotesInfos.php";
                }
              </script>
            </div>
          </div>
          -->
          <div class="medicalnotes col-lg-12">
            <form method="post" class="php-email-form">
              <div class="row bb">
                <div class="col-md-12 form-group">
                  <!--preenheci com o nome do utilizador -->
                  <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $nome ?>"
                    placeholder="O teu nome [João / Maria]" required>
                </div>
                <div class="col-md-12 form-group">
                  <!--preenheci com o genero do utilizador -->
                  <input type="text" name="genero" value="<?php echo $genero ?>" class="form-control" id="genero"
                    placeholder="O teu género [M/F ou Outro]" required>
                  <!--
                    <select name="genero" id="genero">
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                      <option value="Outro">Outro</option>
                    </select> -->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="number" name="altura" class="form-control" id="altura"
                    placeholder="A tua altura [165 cm por exemplo]" required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="number" name="peso" class="form-control" id="peso"
                    placeholder="O teu peso [60 KG por exemplo]" required>
                </div>
              </div>
              <div class="row bb">
                <div class="col-md-6 form-group">
                  <input type="text" name="pressaoarterial" class="form-control" id="pressaoarterial"
                    placeholder="A tua pressão arterial " required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="text" name="tiposanguineo" class="form-control" id="tiposanguineo"
                    placeholder="O teu tipo sanguíneo " required>
                </div>
              </div>
              <div class="row bb">
                <div class="col-md-6 form-group">
                  <p>Data de Nascimento:</p>
                  <input type="date" name="datanascimento" value="<?php echo $dataNascimento ?>" class="form-control" id="datanascimento"
                    placeholder="A tua data de nascimento" required>
                </div>
                <div class="col-md-6 form-group">
                  <p>Data de Registo:</p>
                  <input type="date" name="dataregistro" class="form-control" id="dataregistro"
                    placeholder="A data do teu registo" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="alergias" class="form-control" id="alergias"
                    placeholder="A alguma alergia que tenhas " required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="text" name="medicacao" class="form-control" id="medicacao"
                    placeholder="Tomas algum medicamento, se sim qual " required>
                </div>
              </div>
              <div class="row bb">
                <div class="col-md-12 form-group">
                  <input type="text" name="cirugiasanteriores" class="form-control" id="cirugiasanteriores"
                    placeholder="Cirurgias realizadas anteriormente" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="nomecontactoemergencia" class="form-control" id="nomecontactoemergencia"
                    placeholder="O nome do contacto de emergência" required>
                </div>
                <div class="col-md-6 form-group">
                  <input type="text" name="numerocontactoemergencia" class="form-control" id="numerocontactoemergencia"
                    placeholder="O número do contacto de emergência" required>
                </div>
              </div>
              <div class="row">
                <div class="form-group mt-3">
                  <textarea class="form-control" name="historicoclinico" rows="7" placeholder="Histórico Clínico"
                    required></textarea>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" id="enviar-ficha-button" name="enviarfichabutton">Enviar ficha médica</button>
              </div>

              <!-- Adicione o widget de notificação -->

              <div id="notification-widget" style="display: none;">
                <p>A sua ficha foi enviada com sucesso!</p>
                <button id="close-notification-button">Fechar</button>
              </div>
            </form>
          </div>
          <?php
          if (isset($_POST["enviarfichabutton"])) {
            include 'ligaBD.php';

            $nome = $_POST['nome'];
            $peso = $_POST['peso'];
            $genero = $_POST['genero'];
            $altura = $_POST['altura'];
            $pressaoarterial = $_POST['pressaoarterial'];
            $tiposanguineo = $_POST['tiposanguineo'];
            $datanascimento = $_POST['datanascimento'];
            $dataregistro = $_POST['dataregistro'];
            $alergias = $_POST['alergias'];
            $medicacao = $_POST['medicacao'];
            $nomecontactoemergencia = $_POST['nomecontactoemergencia'];
            $numerocontactoemergencia = $_POST['numerocontactoemergencia'];
            $historicoclinico = $_POST['historicoclinico'];
            $cirugiasanteriores = $_POST['cirugiasanteriores'];
            $idpessoa = 1;

            function obterTiposVariaveis(...$variaveis)
            {
              $tipos = '';
              foreach ($variaveis as $variavel) {
                if (is_int($variavel)) {
                  $tipos .= 'i';
                } elseif (is_float($variavel)) {
                  $tipos .= 'd';
                } else {
                  $tipos .= 's';
                }
              }
              return $tipos;
            }

            $insere_fichamedica = $conn->prepare("UPDATE `informacoesmedicas` SET `genero`=?, `altura`=?, `peso`=?, `pressaoarterial`=?, `historicoclinico`=?, `alergias`=?, `tipo_sanguineo`=?, `medicacaoatual`=?, `cirurgiasanteriores`=?, `dataRegistro`=?, `contatoEmergenciaNome`=?, `contatoEmergenciaTelefone`=? WHERE `id_pessoa`=?");
            $insere_fichamedica->bind_param("sddsssssssssi", $genero, $altura, $peso, $pressaoarterial, $historicoclinico, $alergias, $tiposanguineo, $medicacao, $cirugiasanteriores, $dataregistro, $nomecontactoemergencia, $numerocontactoemergencia, $idpessoa);
            $faz_insere_fichamedica = $insere_fichamedica->execute();

            if (!$faz_insere_fichamedica) {
              echo "<script>console.log('Erro na inserção: $insere_fichamedica->error')</script>";
            }
            $insere_fichamedica->close();
            mysqli_close($conn);
          }

          ?>
          <script>
            $(document).ready(function () {
              // Evento de mouseover para destacar informações é um evento mouser
        
              $("form").on("submit", function (event) {
                setTimeout(function () {
                  $(".success-message").text("Ficha médica atualizada com sucesso!").show(); // Manipulação do DOM
                }, 2000);
              });

            });

          </script>

    </section>

  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <h2>Informações extras</h2>
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

  <script src="assets/js/main.js"></script>

</body>


</html>