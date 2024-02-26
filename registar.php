<!DOCTYPE html>
<html>
<head>
	<title>Registar novo utilizador</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
		
		
		body {
			background-color: #009D71;
			text-align: left;

		}
		.panel {
            background-color: white;
            position: absolute;
            top: 60%;
            left: 20%;
            padding: 70px;
            border-radius: 15px;
            color: black;
			
        }
		
         button{
           
            border: none;
            padding: 5px;
            width: 100%;
            border-radius: 10px;
            color: black;
            font-size: 15px;
            
        }
		.panel-heading{
			border: 0px;

		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class="panel-heading"><center><h3>Cadastro</center><h3></div>
			  		<div class="panel-body">
						<form action='trata_registo.php' method='post'>
						<div class="row">
							<label for="Nome">Nome</label>
								<input type='text' id = 'Nome' name='nome' placeholder='Nome'>
								</div>
							<div class="row">
								<label for="Morada">Morada</label>
								<input type='text' id = 'morada' name='morada' placeholder='Morada'>
							</div>
							<div class="row">
								<label for="Data_nascimento">Data de Nascimento</label>
								<input type='date' id = 'Data_nascimento' name='Data_nascimento' placeholder='Data_nascimento'>
								</div>
							<div class="row">
								<label for="NIF">NIF</label>
								<input type='text' id = 'NIF' name='NIF' placeholder='NIF'>
							</div>
							<div class="row">
								<label for="CC">CC</label>
								<input type='text' id = 'CC' name='CC' placeholder='CC'>
								</div>
							<div class="row">
								<label for="NIS">NIS</label>
								<input type='text' id = 'NIS' name='NIS' placeholder='NIS'>
							</div>
							<div class="row">
								<label for="Telemovel">Telemóvel</label>
								<input type='text' id = 'Telemovel' name='Telemovel' placeholder='Telemóvel'>
								</div>
							<div class="row">
								<label for="Código postal">Código Postal</label>
								<input type='text' id = 'cod_postal' name='cod_postal' placeholder='Código Postal'>
							</div>
							<div class="row">
								<label for="email">Email</label>
								<input type='text' id = 'email' name='email' placeholder='Email'>
							</div>
							<div class="row">
								<label for="username">Username</label>
								<input type='text' id = 'usernamex' name='usernamex' placeholder='Username'>
							</div>
							<div class="row">
								<label for="password">Password</label>
								<input type="password" name="password1" id="password" placeholder='Password'>
							</div>
							<div class="row">
								<label for="password">Confirme a password</label>
								<input type="password" name="password2" id="password" placeholder='Password'>
							</div>
							<button type="submit">Cadastrar</button>
							<button type="submit">Limpar</button>
							
							 <center><a href="index.html">Login utilizador existente</a></center>
							
						</form>
</div>
</body>
</html>