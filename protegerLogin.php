<?php 
	session_start();
	if (isset($_GET['sair']) && $_GET['sair'] == 1){
		session_destroy();
		header("location:index.html");
	}
	if(!isset($_SESSION["entrada"])){
		header("location:index.html");
	};
?>