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

    .search-container {
      display: flex;
      margin: 10px;
    }

    #search-input {
      padding: 10px;
      flex: 1;
      height: 30px;
      border: 2px solid darkgray;
      border-right: none;
    }

    #search-button {
      background-color: #008374;
      color: white;
      height: 30px;
      border: 2px solid darkgray;
      border-left: none;
      cursor: pointer;
    }

    .right-align {
      display: flex;
      flex-direction: row-reverse;
      height: 30px;
    }

    .highlight {
      background-color: yellow;
    }

    .logo:hover {
      animation: rotateLogo 1s ease infinite;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    #InfoTable {
      border: 2px solid black;
    }

    /*definicoes da caixa que contem info sobre o utilizador */
    .elegant-info {
      font-family: 'Kanit', sans-serif;
      display: flex;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    /* definicoes dos elementos dentro das caixinhas de pesquisa*/
    .elegant-info span {
      padding: 8px 20px;
      border-right: 2px solid black;
      background-color: #ADD8E6;
      flex-grow: 1;
      text-align: center;
    }

    /* filho do span*/
    .elegant-info span:first-child {
      font-weight: bold;
      border-radius: 6px 0 0 6px;
      background-color: #4682B4;
    }

    /*definicoes do botão de acesso da pesquisa*/
    .elegant-info button.acess-btn {
      font-weight: bold;
      flex-grow: 0;
      width: 200px;
      text-align: center;
      background-color: #6fbad3;
      height: 100%;
    }

    /*definicoes do botão do lixo da pesquisa*/
    .elegant-info span:last-child {
      border: none;
      background-color: #ca1e1e;
      color: white;
      border-radius: 0 6px 6px 0;
      flex-grow: 0;
      height: 100%;
      display: inline-block;
    }

    td:has(.Enter) {
      background-color: green;
    }

    td:has(.Exit) {
      background-color: red;
    }

    .TimeInfo {
      color: black;
      border-radius: 12px;
      font-size: 20px;
    }
  </style>
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
</head>

<body>
  <?php include "menu.php" ?>
  
  <main id="main">
    <section id="Controledeacesso" class="Controledeacesso">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Gerador de Qrcode</h2>
        </div>
            <?php 
              include 'ligaBD.php';

              $idpessoa = $_COOKIE['idpessoa'];

              $stmtx = $conn->prepare("SELECT id_tp FROM pessoa WHERE id_pessoa = ?");
              $stmtx->bind_param("i", $idpessoa);
              $stmtx->execute();
              $result = $stmtx->get_result();

              $Admin = false;

              if ($result === false) {
                  // Se houver um erro na consulta SQL, exiba a mensagem de erro
                  die("Erro na consulta SQL: " . $conn->error);
              }

              if ($result->num_rows > 0) {
                  // Existe uma linha, obtenha o valor de id_tp
                  $row = $result->fetch_assoc();
                  $id_tp = $row['id_tp'];

                  // Verifique se id_tp é igual a 10
                  if ($id_tp == 10) {
                      // Se sim, imprima o formulário HTML
                      echo '<div class="search-container right-align" style="margin-bottom: 5%">';
                      echo '<form class="search-container" style="width: 100%" method="post">';
                      echo '<input type="text" id="search-input" name="searchinput" value="';
                      if (isset($_POST["searchinput"])) {
                          echo $_POST["searchinput"];
                      }
                      echo '" placeholder="Pesquisar...">';
                      echo '<button id="search-button" onclick="search()">Pesquisar</button>';
                      echo '</form>';
                      echo '</div>';

                      $Admin = true;
                  } 
              } else {
                  // Se não houver resultados, exiba uma mensagem indicando isso
                  echo "Nenhum resultado encontrado.";
              }
              
              if (!$Admin) {
                echo "<script>window.location.href = 'registo_es.php'</script>";
              }

        
                  // Verifica se o campo de pesquisa não está vazio
        if (isset($_POST['searchinput']) && $_POST['searchinput'] != "") {
          // Adiciona "%" antes e depois do valor do campo de pesquisa para correspondência parcial
          $searchInput = "%" . $_POST["searchinput"] . "%";

          //selecionar usuários com base no nome que contém o valor de pesquisa
          $sql = "SELECT id_pessoa, nome FROM pessoa WHERE Nome LIKE ?";
          $stmt = $conn->prepare($sql);

          // Associa o parâmetro ao valor de pesquisa
          $stmt->bind_param("s", $searchInput);

          // Executa a consulta                
          $stmt->execute();

          // Obtém o resultado da consulta
          $result = $stmt->get_result();

          // se existir ao menos uma linha correspondente a consulta
          if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<td> ID </td>";
            echo "<td> Nome </td>";
            echo "<td> Qrcode </td>";
            echo "</tr>";
            //para cada linha os resultados sao atribuidos as variaveis 
            while ($row = $result->fetch_assoc()) {
              $ID = $row["id_pessoa"]; //recebe o valor da coluna
              $Name = $row["nome"]; //recebe o valor da coluna
              //o formulario e criado para o envio dos dados
              echo "<tr>";
              //um  campo de entrada escondido
              echo "<td>";
              //mostra o id do utilizador 
              echo "$ID";
              echo "</td>";
              echo "<td>";
              //mostra o nome do utilizador 
              echo "$Name";
              echo "</td>";
              //um botao para o acesso  
              echo "<td><form method='post' action='qrcodex.php'><input type='hidden' name='userid' value='$ID'><button class='acess-btn'>";
              echo "Qrcode";
              echo "</button></form></td>";
              echo "</tr>";
              }

              echo "</table>";
            } else {
                echo "Nenhum resultado encontrado.";
            }
          
          // fecha o statement para liberar recursos
          $stmt->close();
          //fecha a conexao com o banco
          $conn->close();
        } else {
            $sqlRecentUsers = "SELECT id_pessoa, nome FROM pessoa ORDER BY id_pessoa DESC LIMIT 8";
            $resultRecentUsers = $conn->query($sqlRecentUsers);

            if ($resultRecentUsers->num_rows > 0) {
              echo "<table>";
              echo "<tr>";
              echo "<td> ID </td>";
              echo "<td> Nome </td>";
              echo "<td> Qrcode </td>";
              echo "</tr>";              
            //para cada linha os resultados sao atribuidos as variaveis 
              while ($row = $resultRecentUsers->fetch_assoc()) {
                $ID = $row["id_pessoa"]; //recebe o valor da coluna
                $Name = $row["nome"]; //recebe o valor da coluna
                echo "<tr>";
                //um  campo de entrada escondido
                echo "<td>";
                //mostra o id do utilizador 
                echo "$ID";
                echo "</td>";
                echo "<td>";
                //mostra o nome do utilizador 
                echo "$Name";
                echo "</td>";
                //um botao para o acesso  
                echo "<td><form method='post' action='qrcodex.php'><input type='hidden' name='userid' value='$ID'><button class='acess-btn'>";
                echo "Qrcode";
                echo "</button></form></td>";
                echo "</tr>";
                }
  
                echo "</table>";
            } else {
                echo "Nenhum resultado encontrado.";
            }
       
        }

        ?>

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