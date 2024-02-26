<!DOCTYPE html>
<html lang="en">

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

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

    div.container {
      margin: 0;
      padding: 0;
    }
    
    main {
      display: flex;
      height: 100vh;
      padding-top: 4em;
      justify-content: center;
    }

    footer { 
      width: 100vw;
    }

    table {
      width: 100%;

      text-align: center;

      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #665c5c;
      color: white;
      width: 9%;
    }

    .todaybox {
      background-color: #b9dcd6 !important
    }

    .circle {
      width: 2vw;
      aspect-ratio: 1/1;
      border-radius: 50%;
      transform: translateX(150%);
      background-color: white;
    }

    .Enter {
      background-color: green;
    }

    .Exit {
      background-color: #ad2a2a;
    }

    .atraso {
      background-color: orange;
      color: white
    }

    .presente {
      background-color: #046f04 !important; 
      color: white
    }

    .falta {
      background-color: #ad2a2a !important;
      color: white
    }

    .edit-button {
      all: unset;
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
      <div class="container" data-aos="fade-up">
        <div>
          <div class="section-header">
            <h2>Registo Entradas e Saídas</h2>
          </div>
          <?php
            if (isset($_POST["userid"])) {
              $idpessoa = $_POST["userid"];
            } else {
              $idpessoa = $_COOKIE['idpessoa'];
            }
            
            include 'ligaBD.php';

            $Cookie_IdPessoa = $_COOKIE['idpessoa'];

            $stmt = $conn->prepare("SELECT pessoa.id_tp FROM pessoa WHERE id_pessoa = $Cookie_IdPessoa");

            $stmt->execute();
            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            $is_admin = false;

            if ($row["id_tp"] == 10) {
              $is_admin = true;
            }

            $currentDayOfWeek = date("w");

            $stmt = $conn->prepare("SELECT disciplina.nome_disciplina, horario.dia, horario.horario_inicio, horario.horario_final
            FROM disciplina, pessoa, horario
            WHERE pessoa.id_turma = horario.id_turma AND
            disciplina.id_disciplina = horario.id_disciplina AND
            pessoa.id_pessoa = $idpessoa");

            $stmt->execute();
            $result = $stmt->get_result();

            $horarios = array();
            $acessos = array();

            $tempos = array(
              array("08:25", "09:15"),
              array("09:25", "10:15"),
              array("10:30", "11:20"),
              array("11:25", "12:15"),
              array("12:20", "13:10"),
              array("13:20", "14:10"),
              array("14:15", "15:05"),
              array("15:20", "16:10"),
              array("16:15", "17:05"),
              array("17:10", "18:00"),
            );

            while ($row = $result->fetch_assoc()) {
              $horarios[] = $row;
            }

            $stmt_movimentacao = $conn->prepare("SELECT movimentacao.datahora, movimentacao.id_portao
            FROM movimentacao, pessoa
            WHERE movimentacao.id_cartao = pessoa.id_cartao AND
            pessoa.id_pessoa = $idpessoa");

            $stmt_movimentacao->execute();
            $result_movimentacao = $stmt_movimentacao->get_result();

            while ($row = $result_movimentacao->fetch_assoc()) {
              $acessos[] = $row;
            }

            if ($result->num_rows > 0) {
              if ($is_admin) {
                echo "<div style='display: flex; justify-content: space-between; margin-bottom: 0.3em'>
                  <div></div>
                  <div>
                  <form action='editar_turma.php' method='post'>
                  <input type='hidden' name='userid' value=' $idpessoa'>
                  <button type='submit' style='background: none; border: none; padding: 0; margin: 0;'>
                      <i class='fa-lg fa-solid fa-pen-to-square' style='color: #035148'></i>
                  </button>
              </form>
                                </div>
                </div>";
              }

              echo "
                <table>
                  <tr>
                    <th style='background-color: #008374'>Horas</th>
                    <th style='background-color: #019987'>Segunda-Feira</th>
                    <th style='background-color: #008374'>E/S</th>
                    <th style='background-color: #019987'>Terça-Feira</th>
                    <th style='background-color: #008374'>E/S</th>
                    <th style='background-color: #019987'>Quarta-Feira</th>
                    <th style='background-color: #008374'>E/S</th>
                    <th style='background-color: #019987'>Quinta-Feira</th>
                    <th style='background-color: #008374'>E/S</th>
                    <th style='background-color: #019987'>Sexta-Feira</th>
                    <th style='background-color: #008374'>E/S</th>
                  </tr>
              ";

              $chegadas = array();

              while ($row = $result_movimentacao->fetch_assoc()) {
                  $dateTime = new DateTime($row["datahora"]);
                  $horaMinutos = $dateTime->format('H:i');

                  $chegadas[$row["dia"]][$horaMinutos] = $row["id_portao"];
              }

              $tempo_num = 0;

              for ($hora = 8; $hora < 18; $hora++) {
                echo "<tr>";
                echo "<td style='background-color: #019987'>" . $tempos[$tempo_num][0] . " - " . $tempos[$tempo_num][1] . "</td>";

                for ($dia = 1; $dia <= 5; $dia++) {
                    $hashorario = false;
                    foreach ($horarios as $horario) {
                      if ($horario["horario_inicio"] == $tempos[$tempo_num][0] . ":00" && $horario["dia"] == $dia) {                                                  
                          foreach ($horarios as $horario) {
                            if ($horario["horario_inicio"] == $tempos[$tempo_num][0] . ":00" && $horario["dia"] == $dia) {                        
                              $entradaEncontrada = false;
                              $saidaEncontrada = false;
      
                                foreach ($acessos as $acesso) {
                                  $dateTime = new DateTime($acesso["datahora"]);
                                  $horaMinutos = $dateTime->format('H:i');
                                  $acessodia = date("w", strtotime($acesso["datahora"]));
                          
                                  if ((strtotime($horaMinutos) <= strtotime($tempos[$tempo_num][0]) || strtotime($horaMinutos) <= strtotime($tempos[$tempo_num][1])) && $acessodia == $dia) {
                                      if ($acesso["id_portao"] == 1) {
                                          $entradaEncontrada = true;
                                      }
                                      if ($acesso["id_portao"] == 2) {
                                          $saidaEncontrada = true;
                                      }
                                  }
                              }
                              if ($entradaEncontrada && !$saidaEncontrada) {
                                $cellClass = "presente";
                              } else {
                                $cellClass = "falta";
                              }
                            
                          echo "<td class='" . $cellClass . "'>";

                          echo $horario["nome_disciplina"] . $dia;
                          $hashorario = true;
                            }
                          }
                        }
                    }
                    if (!$hashorario) echo "<td style='background-color: #d3e5e2' class='" . ($dia == $currentDayOfWeek ? 'todaybox ' : '') ."'>";

                    echo "</td>";
                    echo "<td style='background-color: #9de5dc'>";
                    if ($result_movimentacao->num_rows > 0) {
                      foreach ($acessos as $acesso) { 
                        $dateTime = new DateTime($acesso["datahora"]);
                        $horaMinutos = $dateTime->format('H:i');
                        $acessodia = date("w", strtotime($acesso["datahora"]));

                        if ($horaMinutos >= $tempos[$tempo_num][0] && $horaMinutos <= $tempos[$tempo_num][1] && $acessodia == $dia) {
                          echo "<div class='circle tollinfo " . ($acesso["id_portao"] == 1 ? "Enter" : "Exit") . "' title=' Passou pelo portão ás $horaMinutos'></div>";
                        }

                      }
                    }
                    echo "</td>";
                }
                echo "</tr>";
                $tempo_num++; 
              }              
            } else {
              echo "Este utilizador está associado a uma turma na qual não tem horario. <br>";
              
              if ($is_admin) {
                echo '
                  <form action="editar_turma.php" method="post">
                    <input type="hidden" name="userid" value="'.$idpessoa.'">
                    <button type="submit" style="all: unset; cursor: pointer; color: #035148; ">Clique aqui para criar um horario para a turma</button>
                  </form>
                ';
              }
            }
            echo "</table>";
          
          ?>
          <script>
            $(document).ready(function() {
              $(".tollinfo").tooltip({
                  position: {
                      my: "center bottom-20",
                      at: "center top",
                      collision: "none"
                  },
                  classes: {
                      "ui-tooltip": "custom-tooltip"
                  }
              });
          });
          </script>
        </div>
      </div>  
  </main>


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