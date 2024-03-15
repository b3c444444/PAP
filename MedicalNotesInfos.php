<!DOCTYPE html>
<html lang="en">
<?php

?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ficha Médica</title>
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


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


  <link href="assets/css/main.css" rel="stylesheet">
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

    p {
      color: white;
    }

    #formularioAtualizacao form .form-group {
      width: 100%;
    }

    #formularioAtualizacao form input,
    #formularioAtualizacao form textarea {
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    #infoatua {
      color: white;
    }
  </style>
    <?php if (isset($_COOKIE['idpessoa'])) { ?>
      <?php include "menu.php" ?>

  <?php } ?>

  <main id="main">
    <section id="FichaMedica" class="FichaMedica">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Ficha Médica</h2>
          <p>Insira os seus dados médicos na ficha abaixo.</p>
        </div>
        <div class="row gx-lg-0 gy-4">
          <div class="col-lg-12">
            <div class="info-container d-flex flex-column align-items-center justify-content-center"
              style="border-radius: 10px">
              <div class="d-flex">
                <h2 id="important-title">Informações Atuais</h2>
              </div>
              <?php
              //conexao com a base de dados
              include 'ligaBD.php';
              if (isset($_POST['ID_PessoaX'])) {
                $idPessoa = $_POST['ID_PessoaX'];
              } else {
                
                $idPessoa = $_COOKIE['idpessoa'];
              }      

              echo $idPessoa;

              //faz a a consulta
              $GetInfosQuery = "SELECT informacoesmedicas.*, pessoa.Nome, pessoa.Data_nascimento FROM informacoesmedicas, pessoa WHERE pessoa.id_pessoa = '" . $idPessoa . "' and pessoa.id_pessoa = informacoesmedicas.id_pessoa";
              //execucao da consulta
              $GetInfos = mysqli_query($conn, $GetInfosQuery);

              //verifica os resultados e atribui a variaveis
              if ($GetInfos) {
                $result = mysqli_fetch_assoc($GetInfos);

                $id_informacoes_medicas = $result['id_informacoes_medicas'];
                $nome = $result["Nome"];
                $genero = $result['genero'];
                $altura = $result['altura'];
                $peso = $result['peso'];
                $dataRegistro = $result['dataRegistro'];
                $dataNascimento = $result["Data_nascimento"];
                $pressaoarterial = $result['pressaoarterial'];
                $tipo_sanguineo = $result['tipo_sanguineo'];
                $contatoEmergenciaNome = $result['contatoEmergenciaNome'];
                $contatoEmergenciaTelefone = $result['contatoEmergenciaTelefone'];
                $medicacaoatual = $result['medicacaoatual'];
                $historicoclinico = $result['historicoclinico'];
                $alergias = $result['alergias'];
                $cirurgiasanteriores = $result['cirurgiasanteriores'];

              } else {
                echo "Erro na consulta: " . mysqli_error($conn);
              }
              //fecha a conexao
              mysqli_close($conn);
              ?>
              <div class="row col-lg-12 d-flex justify-content-center">
                <div class="col-lg-5 info-item-resized">
                  <i class="bi bi-person flex-shrink-0"></i>
                  <div>
                    <!--mostra o nome do utilizador-->
                    <h4>Nome:</h4>
                    <p>
                      <?php echo $nome; ?>
                    </p>
                  </div>
                </div>
                <div class="col-lg-5 info-item-resized ">
                  <i class="bi bi-gender-ambiguous flex-shrink-0"></i>
                  <div>
                    <!--mostra o genero do utilizador-->
                    <h4>Género:</h4>
                    <p>
                      <?php echo $genero ?>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-11 info-item-resized d-flex">
                <i class="bi bi-calendar flex-shrink-0"></i>
                <div>
                  <h4>Data de Nascimento:</h4>
                  <p>
                    <?php echo $dataNascimento ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-11 info-item-resized d-flex">
                <i class="bi bi-calendar flex-shrink-0"></i>
                <div>
                  <h4>Data de Registo:</h4>
                  <p>
                    <?php echo $dataRegistro ?>
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Altura:</h4>
                  <p>
                    <?php echo $altura ?> cm
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Peso:</h4>
                  <p>
                    <?php echo $peso ?> KG
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Pressão Arterial:</h4>
                  <p>
                    <?php echo $pressaoarterial ?>
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Tipo Sanguineo:</h4>
                  <p>
                    <?php echo $tipo_sanguineo ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Nome do Contato de Emergência:</h4>
                  <p>
                    <?php echo $contatoEmergenciaNome ?>
                  </p>
                </div>
              </div>
              <div class="col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Telefone do Contato de Emergência:</h4>
                  <p>
                    <?php echo $contatoEmergenciaTelefone ?>
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Medicação Atual:</h4>
                  <p>
                    <?php echo $medicacaoatual ?> cm
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Histórico Clínico:</h4>
                  <p>
                    <?php echo $historicoclinico ?> cm
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Alergias:</h4>
                  <p>
                    <?php echo $alergias ?> cm
                  </p>
                </div>
              </div>
              <div class=" col-lg-11 info-item-resized d-flex">
                <i class="bi bi-person-arms-up flex-shrink-0"></i>
                <div>
                  <h4>Cirurgias Anteriores:</h4>
                  <p>
                    <?php echo $cirurgiasanteriores ?> cm
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </main>
  <?php if (isset($_COOKIE['idpessoa'])) { ?>
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
  <?php } ?>

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

</body>
<script>
  $(document).ready(function () {
    // Manipulação do clique no botão "Editar"
    $("#editarInformacoesBtn").click(function () {
      $("#formularioAtualizacao").show();
    });

    // Manipulação do clique no botão "Atualizar Informações"
    $("#enviar-ficha-button").click(function () {
      //  AJAX para enviar os novos dados para o servidor
      // AJAX para enviar os dados para o arquivo atualizar_informacoes.php
      $.ajax({
        type: "POST",
        url: "atualizar_informacoes.php",
        data: $("#formAtualizacao").serialize(), // Serializa os dados do formulário
        success: function (response) {
          alert("Informações atualizadas com sucesso!");
          // Esconda o formulário de atualização após o sucesso
          $("#formularioAtualizacao").hide();
          // Atualize as informações na página conforme necessário
          // Isso pode envolver recarregar as informações médicas ou atualizar seções específicas
        },
        error: function (error) {
          alert("Erro ao atualizar informações. Tente novamente.");
        }
      });
    });
  });
</script>

</html>