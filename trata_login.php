<?php

	include 'ligaBD.php'; 

	session_start();

	$user=$_POST['username'];
	$pass = $_POST['password'];
    
	if (strlen($user)<1 || strlen($pass)< 1){
		if(strlen($user)< 1)
			echo '<p align="center">Não digitou o username<BR></p>';
		if(strlen($pass)< 1)
			echo '<p align="center">Não digitou a password<BR></p>';
		echo '<p align="center"><a href="javascript:history.back(1);">tente denovo</a></p>';
	}
	else {
		$sql = "SELECT username, password FROM utilizadores WHERE username = '$user' AND password = '$pass'";
		$result = mysqli_query($conn, $sql);
		// ou $result = $conn->query($sql);
		if ( !$result ){
			echo 'Erro: Erro na Query SQL'; 
			exit;
		} else {

			$row = mysqli_num_rows($result);
			if ($row == 1){
              	$registos=mysqli_fetch_array($result); //Coloca o registo na variável Session_start();
				$_SESSION["entrada"]=$user; // Cria a sessão com o conteúdo da var user
				header("location:painel.php"); //direciona para a página de entrada
        	} else {
                echo '<p align="center">Utilizador inexistente ou Username e password não coincidem<BR><a href="javascript:history.back(1);">tente denovo</a></p>';
                  echo '<p align="center"><a href="registar.php">Registar novo utilizador</a></p>';
              }
    	}
    }

?>