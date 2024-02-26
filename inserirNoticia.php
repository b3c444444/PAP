<?php
	include('protegerLogin.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inserir Notícia</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				username: <?= $_SESSION['entrada'] ?> <a href="?sair=1">[logout]</a></div>
				<div class="panel panel-success">
					<div class="panel-heading">Adicionar Notícia</div>
			  		<div class="panel-body">
			  			<form action="calcular.php" method='post'>
			  				<div class="row">
			  					<label for="nome">Nome de utilizador</label>
			  					<input type="text" name="nome" id="nome"  class="form-control">
			  				</div>
			  				<div class="row">
			  					<label for="titulo">Título</label>
			  					<input type="text" name="titulo" id="titulo"  class="form-control">
			  				</div>
			  				
			  				<div class="row">
			  					<label for="morada">Notícia
			  					</label>
			  					<textarea  name="noticia" id='morada' class="form-control" rows=10></textarea>
			  				</div>
			  			
			  				<div class="row">
			  					<label for="dataPublicacao">Data de Publicação</label>
			  					<input type="datetime-local" name="dataPublicacao" id ="dataNascimento" class="form-control">
			  				</div>
			  				<div class="row">
			  					<label for="seccao">Seccao</label>
			  					<select name="secao" id ="dataNascimento" class="form-control">
			  						<option value="desporto">Desporto</option>
			  						<option value="atualidade">Atualidade</option>
			  						<option value="sociedade">Socidade</option>
			  						<option value=""></option>
			  					</select>
			  				</div>
			  				<br>
			  				<div class="row">
			  						<input type="submit" value="[Enviar]" class="btn btn-danger">
			  				</div>  
			  			</form>

			  		</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
</div>
</body>
</html>