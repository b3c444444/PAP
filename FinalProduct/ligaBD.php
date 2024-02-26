<?php
$servername = "localhost";
$username = "root";
$password = "";

// Cria conexão
$conn = mysqli_connect($servername, $username, $password);
//ou $con=mysqli_connect("localhost","root","root","bd");
//conecta ao Host e à base de dados num só comando

// Verifica conexão
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else { //Conexão estabelecida com o Host
	$escolheBD = mysqli_select_db($conn, 'access');
	if (!$escolheBD) {
		echo "<br> Erro: Erro ao escolher a BD";
		exit;
	}
}
?>