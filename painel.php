<?php
	include('protegerLogin.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Painel</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		.painel-button {background: #bdb9b9; padding: 20px; margin: 5px; text-align: center; border-radius: 10px}
	</style> 
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div> username: <?php echo $_SESSION['entrada'] ?> <a href="?sair=1">[logout]</a></div>
				<div class="panel panel-success">
					<div class="panel-heading">Painel de gestão do site</div>
			  		<div class="panel-body" style=" ">
			  			<div class="row" style="width: auto;height: auto;margin: 0 auto;  position: relative;">
			  				<div class="col-md-3 painel-button" ><a href="registoUtilizador.html">Gestão de utilizadores</a></div>
			  				<div class="col-md-3 painel-button"><a href="inserirNoticia.php">Gestão de notícias</a></div>
			  				<div class="col-md-3 painel-button"><a href="#">Gestão de seções</a></div>
			  			</div>

			  		</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
</div>
</body>
</html>