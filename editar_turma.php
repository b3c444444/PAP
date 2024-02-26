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
    }

    .todaybox {
      background-color: #b9dcd6 !important
    }

    .circle {
      width: 65%;
      aspect-ratio: 1/1;
      border-radius: 50%;
      transform: translateX(27.5%);
      background-color: white;
    }

    .Enter {
      background-color: green;
    }

    .Exit {
      background-color: red;
    }

    .atraso {
      background-color: orange;
      color: white
    }

    .presente {
      background-color: #046f04;
      color: white
    }

    .falta {
      background-color: #ad2a2a;
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
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idTurma"])) {    
              //quando eu seleciono uma disciplina estou selecionando um codigo da disciplina, isso é feito quando atualizo         
                $selectedDiscipline = $_POST["disciplinaSelect"];
           
                
                if (!empty($selectedDiscipline)) {
                    include 'ligaBD.php'; 
                
                    $idTurma = $_POST["idTurma"]; 
                    $idProfessor = $_POST["idProfessor"]; 
                    $horarioInicio = $_POST["horarioInicio"];
                    $horarioFinal = $_POST["horarioFinal"]; 
                    $dia = $_POST["dia"];
                  
                    $stmt_verificar = $conn->prepare("SELECT * FROM horario 
                                          WHERE id_turma = ? 
                                          AND ((horario_inicio <= ? AND horario_final >= ?) 
                                          OR (horario_inicio <= ? AND horario_final >= ?)) 
                                          AND dia = ?");
                    $stmt_verificar->bind_param("issssi", $idTurma, $horarioInicio, $horarioFinal, $horarioInicio, $horarioFinal, $dia);
                    $stmt_verificar->execute();
                    $result_verificar = $stmt_verificar->get_result();

                    if ($result_verificar->num_rows == 0) { {
                        $stmt = $conn->prepare("INSERT INTO `horario` (`id_turma`, `id_professor`, `id_disciplina`, `horario_inicio`, `horario_final`, `dia`)
                                                VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("iiissi", $idTurma, $idProfessor, $selectedDiscipline, $horarioInicio, $horarioFinal, $dia);
                        $stmt->execute();

                    }
                
                    $stmt->close();
                    $conn->close();              
                    } 
                }
            }

            if (isset($_POST["turmaid"])) {
              $idturma = $_POST["turmaid"];
            } else if (isset($_POST["userid"])) {
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

            if (isset($idturma)) {
              $stmt = $conn->prepare("SELECT disciplina.nome_disciplina, horario.dia, horario.horario_inicio, horario.horario_final
              FROM disciplina, horario
              WHERE $idturma = horario.id_turma AND
              disciplina.id_disciplina = horario.id_disciplina");
            } else {
              $stmt = $conn->prepare("SELECT disciplina.nome_disciplina, horario.dia, horario.horario_inicio, horario.horario_final
              FROM disciplina, pessoa, horario
              WHERE pessoa.id_turma = horario.id_turma AND
              disciplina.id_disciplina = horario.id_disciplina AND
              pessoa.id_pessoa = $idpessoa");
            }


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

            if (isset($idturma)) {
              $stmt_movimentacao = $conn->prepare("SELECT movimentacao.datahora, movimentacao.id_portao
              FROM movimentacao, pessoa
              WHERE movimentacao.id_cartao = pessoa.id_cartao AND
              pessoa.id_pessoa = $idturma");
            } else {
              $stmt_movimentacao = $conn->prepare("SELECT movimentacao.datahora, movimentacao.id_portao
              FROM movimentacao, pessoa
              WHERE movimentacao.id_cartao = pessoa.id_cartao AND
              pessoa.id_pessoa = $idpessoa");
            }

            $stmt_movimentacao->execute();
            $result_movimentacao = $stmt_movimentacao->get_result();

            while ($row = $result_movimentacao->fetch_assoc()) {
              $acessos[] = $row;
            }

            $stmt_disciplina = $conn->prepare("SELECT cod_disciplina, nome_disciplina FROM disciplina");
            $stmt_disciplina->execute();
            $result_disciplina = $stmt_disciplina->get_result();

            $disciplinas = array();

            while ($row_disciplina = $result_disciplina->fetch_assoc()) {
                $disciplinas[] = $row_disciplina;
            }

            echo "
              <table class='registo_es'>
                <tr>
                  <th style='background-color: #008374'>Horas</th>
                  <th style='background-color: #019987'>Segunda-Feira</th>
                  <th style='background-color: #019987'>Terça-Feira</th>
                  <th style='background-color: #019987'>Quarta-Feira</th>
                  <th style='background-color: #019987'>Quinta-Feira</th>
                  <th style='background-color: #019987'>Sexta-Feira</th>
                </tr>
            ";

            $chegadas = array();

            while ($row = $result_movimentacao->fetch_assoc()) {
                $dateTime = new DateTime($row["datahora"]);
                $horaMinutos = $dateTime->format('H:i');

                $chegadas[$row["dia"]][$horaMinutos] = $row["id_portao"];
            }

            $tempo_num = 0;

            if (!isset($turmaid)) {
              // Prepara a query para buscar o id_turma com base no id_pessoa
              $stmt = $conn->prepare("SELECT id_turma FROM pessoa WHERE id_pessoa = ?");
              $stmt->bind_param("i", $idpessoa);
              $stmt->execute();
              $result = $stmt->get_result();

              // Verifica se algum resultado foi encontrado
              if ($result->num_rows > 0) {
                  // Extrai o id_turma do resultado
                  $row = $result->fetch_assoc();
                  $turmaid = $row["id_turma"];
              } else {
                  // Handle caso não encontre o id_turma (opcional)
                  // Por exemplo, definir $turmaid como null ou lançar um erro
                  $turmaid = null;
              }
              $stmt->close();
          }
          
            for ($hora = 8; $hora < 18; $hora++) {
              echo "<tr>";
              echo "<td style='background-color: #019987'>" . $tempos[$tempo_num][0] . " - " . $tempos[$tempo_num][1] . "</td>";

              for ($dia = 1; $dia <= 5; $dia++) {
                  $hashorario = false;
                  foreach ($horarios as $horario) {
                      if ($horario["horario_inicio"] == $tempos[$tempo_num][0] . ":00" && $horario["dia"] == $dia) { 
                        echo "<td style='background-color: #d3e5e2; color: black' class='" . ($dia == $currentDayOfWeek ? 'todaybox ' : '') ."'>";
                        ?>
                            <form method='post'>
                                <input type="hidden" name="userid" value="<?php echo $idpessoa ?> ">
                                <input type="text" style="display: none" name="idTurma" value="<?php echo $turmaid ?>">
                                <input type="text" style="display: none" name="idProfessor" value="53">
                                <input type="text" style="display: none" name="dia" value="<?php echo $dia ?>">
                                <input type="text" style="display: none" name="horarioInicio" value="<?php echo $tempos[$tempo_num][0] . ":00" ?>">
                                <input type="text" style="display: none" name="horarioFinal" value="<?php echo $tempos[$tempo_num][1] . ":00" ?>">
                                
                                <select style='width: 100%; background-color: transparent; outline: none; border: none; all: unset;' name='disciplinaSelect'>
                                    <option value=''>Selecione Disciplina</option>
                                    <?php
                                    foreach ($disciplinas as $disciplina) {
                                      echo "<option value='{$disciplina["cod_disciplina"]}'" . (($disciplina["nome_disciplina"] == $horario["nome_disciplina"]) ? "selected" : "") . ">{$disciplina["nome_disciplina"]}</option>";
                                    }
                                    ?>
                                </select>
                            </form>
                        <?php
                        $hashorario = true;
                      }
                  }
                  if (!$hashorario) {
                      echo "<td style='background-color: #d3e5e2; color: black' class='" . ($dia == $currentDayOfWeek ? 'todaybox ' : '') ."'>";
                      ?>
                          <form method='post'>
                              <input type="hidden" name="userid" value="<?php echo $idpessoa ?> ">
                              <input type="text" style="display: none" name="idTurma" value="<?php echo $turmaid ?>">
                              <input type="text" style="display: none" name="idProfessor" value="53">
                              <input type="text" style="display: none" name="dia" value="<?php echo $dia ?>">
                              <input type="text" style="display: none" name="horarioInicio" value="<?php echo $tempos[$tempo_num][0] . ":00" ?>">
                              <input type="text" style="display: none" name="horarioFinal" value="<?php echo $tempos[$tempo_num][1] . ":00" ?>">
                              
                              <select style='width: 100%; background-color: transparent; outline: none; border: none; all: unset;' name='disciplinaSelect'>
                                  <option value=''>Selecione Disciplina</option>
                                  <?php
                                  foreach ($disciplinas as $disciplina) {
                                      echo "<option value='{$disciplina["cod_disciplina"]}'>{$disciplina["nome_disciplina"]}</option>";
                                  }
                                  ?>
                              </select>
                          </form>
                      <?php
                  }
                  echo "</td>";
              }

              echo "</tr>";

              $tempo_num++; 
            }              

            echo "</table> ";

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

              $('select').on('change', function() {
                $(this).closest('form').submit();
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