<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registo</title>

    <link href="assets/img/Logo.png" rel="icon">

    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

</head>
<style>
    .success-message,
    .error-message {
        background-color: #d4edda; /* Cor de fundo */
        border-color: #c3e6cb; /* Cor da borda */
        color: #155724; /* Cor do texto */
        padding: 10px; /* Espaçamento interno */
        margin-bottom: 20px; /* Espaçamento inferior */
        text-align: center; /* Alinhamento do texto */
    }

    .error-message {
        background-color: #f8d7da; /* Cor de fundo para mensagens de erro */
        border-color: #f5c6cb; /* Cor da borda para mensagens de erro */
        color: #721c24; /* Cor do texto para mensagens de erro */
    }

    select {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}


</style>

<body>
    <?php
    $nome = "";
    $email = "";
    $username = "";
    $passwordx = "";
    $confirmarpassword = "";
    $data_nascimento = "";
    $morada = "";
    $cod_postal = "";
    $telemovel = "";
    $nif = "";
    $cc_nis = "";
    $cargo = "";
    $codturma = 0;

    if (isset($_POST["registarbtn"])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $passwordx = $_POST['passwordx'];
        $confirmarpassword = $_POST['confirmarPassword'];
        $data_nascimento = $_POST['datanascimento'];
        $morada = $_POST['morada'];
        $cod_postal = $_POST['codpostal'];
        $telemovel = $_POST['telemovel'];
        $nif = $_POST['nif'];
        $cc_nis = $_POST['cc_nis'];
        $cargo = $_POST['cargo'];
        if (isset($_POST['CodTurma'])) $codturma = $_POST["CodTurma"];
    }

    if (isset($_POST["registarbtn"])) {
        include 'ligaBD.php';

        $algumerro = false;
        if ($passwordx != $confirmarpassword) {
            echo '<div class="message error-message">A senhas não coicidem.</div>';
            $algumerro = true;
        }



        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="message error-message">Endereço de email não valido.</div>';
            $algumerro = true;
        }

        $password_hashed = password_hash($passwordx, PASSWORD_DEFAULT);

        $verifica_email = "SELECT * FROM pessoa WHERE email = '$email'";
        $resultado_email = mysqli_query($conn, $verifica_email);

        if (mysqli_num_rows($resultado_email) > 0) {
            echo '<div class="message error-message">Já existe um utilizador com este endereço de e-mail.</div>';
            $algumerro = true;
        }
        
        if (!$algumerro) {
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
    
            $insere_username = $conn->prepare("INSERT INTO pessoa VALUES (NULL, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, NULL)");
    
            $tipos = obterTiposVariaveis($cargo, $nome, $morada, $data_nascimento, $nif, $cc_nis, $telemovel, $cod_postal, $email, $password_hashed, $codturma);
            $insere_username->bind_param($tipos, $cargo, $nome, $morada, $data_nascimento, $nif, $cc_nis, $telemovel, $cod_postal, $email, $password_hashed, $codturma);
    
            $faz_insere_aluno = $insere_username->execute();
    
            if (!$faz_insere_aluno) {
                echo '<div class="message error-message"><?php echo $mensagem_erro; ?></div>';
            } else {
                echo '<div class="message success-message">Utilizador inserido com sucesso</div>';
            }
    
            $insere_username->close();
            mysqli_close($conn);
    
        }
    }
   
 
?>
    <div class="wrapper">
        <div class="logo">
            <img src="assets/img/Logo-xs2.png" alt="Logo">
        </div>
        <div class="text-center mt-4 name">
            Register | Access Gate
        </div>
        <form class="p-3 mt-3" method="post">
            <div class="form-field d-flex align-items-center">
                <input type="text" name="nome" id="nome" placeholder="Nome" value="<?php echo $nome ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php echo $username ?>">
            </div>
            <div class="dividebox">
                <div class="form-field d-flex align-items-center">
                    <input type="password" name="passwordx" id="passwordx" placeholder="Password"
                        value="<?php echo $passwordx ?>">
                </div>
                <div class="form-field d-flex align-items-center">
                    <input type="password" name="confirmarPassword" id="confirmarPassword"
                        placeholder="Confirm Password" value="<?php echo $confirmarpassword ?>">
                </div>
            </div>
            <span class="infolabel name">Data de Nascimento: </span>
            <div class="form-field d-flex align-items-center labelajust">
                <input type="date" name="datanascimento" id="datanascimento" placeholder="Data de Nascimento"
                    value="<?php echo $data_nascimento ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <input type="text" name="morada" id="morada" placeholder="Morada" value="<?php echo $morada ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <input type="text" name="codpostal" id="codpostal" pattern="[0-9]{4}-[0-9]{3}"
                    placeholder="Codigo Postal: 0000-000" value="<?php echo $cod_postal ?>">
            </div>
            <div class="form-field d-flex align-items-center">
                <input type="tel" name="telemovel" id="telemovel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}"
                    placeholder="Telemovel: 000-000-000" value="<?php echo $telemovel ?>">
            </div>
            <div class="dividebox">
                <div class="form-field d-flex align-items-center">
                    <input type="number" name="nif" id="nif" min="0" placeholder="NIF" value="<?php echo $nif ?>">
                </div>
                <div class="form-field d-flex align-items-center">
                    <input type="number" name="cc_nis" id="cc_nis" min="0" placeholder="CC/NIS"
                        value="<?php echo $cc_nis ?>">
                </div>
            </div>
            <div class="dividebox-3" style="display: flex;justify-content: center;">
                <div class="form-field d-flex align-items-center">
                    <label>Aluno</label>
                    <input type="radio" name="cargo" value="1" id="AlunoRadio">
                </div>
                <div class="form-field d-flex align-items-center">
                    <label>Professor</label>
                    <input type="radio" name="cargo" value="2" id="ProfessorRadio">
                </div>
            </div>
            
            <button class="btn mt-3" name="registarbtn" id="registarbtn">Registar</button>
            <div class="text-center mt-3">
                Já tem uma conta? <a href="Login.php">Faça login aqui</a>
            </div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        <?php
        include 'ligaBD.php';

            $consulta_turmas = "SELECT id_turma, cd_turma, letra FROM turma";
            $resultado_turmas = mysqli_query($conn, $consulta_turmas);
            $select_options = '<select name="CodTurma" id="CodTurma" required>';
            while ($row = mysqli_fetch_assoc($resultado_turmas)) {
                $value = $row['id_turma'];
                $text = $row['cd_turma'] . $row['letra'];
                $select_options .= '<option value="' . $value . '">' . $text . '</option>';
            }
            $select_options .= '</select>';
            
        ?>
        var CodTurmaElement = '<?php echo $select_options ?>'
        
        $("#registarbtn").click(function(event) {
        var senha = $("#passwordx").val();
        if (senha.length < 8) {
            alert("Erro: A senha deve ter pelo menos 8 caracteres. Escolha uma senha mais longa para aumentar a segurança da sua conta.");
            event.preventDefault(); // Impede o envio do formulário
        }
      
     });


        $(".dividebox-3 input").change(function(){
            if ($("#AlunoRadio").is(":checked")) {
                $(".dividebox-3").after(CodTurmaElement);
            } else {
                $("#CodTurma").remove();
            }
        });

        $("#AlunoRadio").prop("checked", true)
        $(".dividebox-3").after(CodTurmaElement);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.7.2/css/all.css"></script>
    
</body>

</html>