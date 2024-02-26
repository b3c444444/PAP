<?php

	 
	//captar dados do formulário
	// foreach($_POST as $chave=>$valor) ou
	
	$nome=$_POST['nome'];
	$morada=$_POST['morada'];
	$data_nascimento=$_POST['Data_nascimento'];
	$nif=$_POST['NIF'];
	$cc=$_POST['CC'];
	$nis=$_POST['NIS'];
	$telemovel=$_POST['Telemovel'];
	$cod_postal=$_POST['cod_postal'];
	$email=$_POST['email'];
	$usernamex=$_POST['usernamex'];
	$pass1=$_POST['password1'];
	$pass2=$_POST['password2'];
	//verifica se as duas passwords são iguais 
	if($pass1!=$pass2) {
		echo '<p align="center">As passwords têm que ser iguais<BR><a href="javascript:history.back(1);">tente denovo</a></p>';
	}
	else {
		include 'ligaBD.php';
		//início de acções sobre a BD
		$existe="select * from pessoa where utilizador = '$username'";
		$faz_existe = mysqli_query($conn, $existe);
		//inicio de verificação se o utilizador já está registado
		$row = mysqli_num_rows($faz_existe);
		if( $row == 1){ //se existe resultado da query
			echo '<p align="center">O utilizador já se encontra registado!! Pretende fazer login? <a href="index.html">Login</a><BR><a href="javascript:history.back(1);"> ou tente um novo o registo</a></p>';
		}
		else
		{
			echo "<script>console.log('$nome','$morada','$data_nascimento','$nif','$cc','$nis','$telemovel','$cod_postal','$email','$usernamex','$pass1') </script>";
			$insere_username = "insert into pessoa(nome, morada, data_nascimento, NIF, cc, nis, telemovel, cod_postal, email, utilizador, senha) values( '$nome','$morada','$data_nascimento','$nif','$cc','$nis','$telemovel','$cod_postal','$email','$username','$pass1')"; //ou ($_POST['username']….)
			$faz_insere_aluno =mysqli_query($conn, $insere_username); 
			echo '<p align="center"> O utilizador foi registado com sucesso!!! Efectue login.<a href="index.html">Login </a><BR><a href="javascript:history.back(1);"> ou tente um novo o registo</a></p>';
		}
	}
?>