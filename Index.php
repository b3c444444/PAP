<?php
if (isset($_COOKIE['idpessoa'])) {
  // Se a cookie não estiver presente, redirecionar para a página de login
  $cookie_name = "idpessoa";

  // Define o tempo de expiração para um valor no passado (por exemplo, 1 minuto)
  $expire_time = time() - 3600;
  //  
  setcookie($cookie_name, "", $expire_time, "/");

  // Você também pode unset a variável global $_COOKIE se desejar
  unset($_COOKIE[$cookie_name]);
} 
include 'ligaBD.php';

$mensagemErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Email = $_POST["Email"];
  $senha = $_POST["password"];

  if (empty($Email) || empty($senha)) {
    $mensagemErro = "Por favor, forneça tanto o email quanto a senha estão incorretos.";
  } else {
    // Consulta no banco de dados
    $sql = "SELECT * FROM pessoa WHERE Email = '$Email' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $hashArmazenado = $row['Senha'];

      // Verifica se a senha fornecida corresponde ao hash armazenado
      if (password_verify($senha, $hashArmazenado)) {
        $sql = "SELECT id_pessoa FROM pessoa WHERE Email = '$Email'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        // Cria a cookie
        setcookie("idpessoa", $row['id_pessoa'], time() + (365 * 24 * 3600), "/");


        header("Location: http://localhost/PAP/FinalProduct/Inicio.php");
        exit();
      } else {
        $mensagemErro = "Senha incorreta. Tente novamente.";
      }

    } else {
      $mensagemErro = "Email incorreto. Tente novamente.";
    }
  }
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <link href="assets/img/Logo.png" rel="icon">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="wrapper">
    <div class="logo">
      <img src="assets/img/Logo-xs2.png" alt="Logo">
    </div>
    <div class="text-center mt-4 name">
      Login | Access Gate
    </div>
    <form class="p-3 mt-3" id="loginForm" method="POST" action="">
      <div class="form-field d-flex align-items-center">
        <input type="text" name="Email" id="userName" placeholder="Email">
      </div>
      <div class="form-field d-flex align-items-center">
        <input type="password" name="password" id="pwd" placeholder="Password">
      </div>
      <button class="btn mt-3" id="loginBtn">Login</button>
    </form>


    <?php

    if (!empty($mensagemErro)) {
      echo "<div class='alert alert-danger'>$mensagemErro</div>";
    }
    ?>
  </div>

</body>

</html>