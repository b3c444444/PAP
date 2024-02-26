<!DOCTYPE html>
<html>
<head>
	<title>Informações Médicas</title>
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
					<div class="panel-heading"><center><h3>Informações Médicas</center><h3></div>
			  		<div class="panel-body">
						<form action='tratainformacoesmedicas.php' method='post'>
						<div class="row">
							<label for="Nome">Nome</label>
								<input type='text' id = 'Nome' name='nome' >
								</div>
							<div class="row">
								<label for="Data_nascimento">Data de Nascimento</label>
								<input type='date' id = 'Data_nascimento' name='Data_nascimento'>
								</div>
							<div class="row">
								<label for="genero">Género</label>
								<input type='text' id = 'genero' name='genero'>
							</div>
							<div class="row">
								<label for="altura">Altura</label>
								<input type='text' id = 'altura' name='altura' >
								</div>
							<div class="row">
								<label for="peso">Peso</label>
								<input type='text' id = 'peso' name='peso' >
							</div>
							<div class="row">
								<label for="pressaoarterial">Pressão Arterial</label>
								<input type='text' id = 'pressaoarterial' name='pressaoarterial'>
								</div>
							<div class="row">
								<label for="historicoclinico">Histórico Clínico</label>
								<input type='text' id = 'historicoclinico' name='historicoclinico' >
							</div>
							<div class="row">
								<label for="alergias">Alergias</label>
								<input type='text' id = 'alergias' name='alergias'>
							</div>
							<div class="row">
								<label for="tipo_sanguineo">Tipo Sanguineo</label>
								<input type='text' id = 'tipo_sanguineo' name='tipo_sanguineo'>
							</div>
							<div class="row">
								<label for="medicacaoatual">Medicação Atual</label>
								<input type="medicacaoatual" name="medicacaoatual" id="medicacaoatual" >
							</div>
							<div class="row">
								<label for="cirurgiasanteriores">Cirurgias Anteriores</label>
								<input type="cirurgiasanteriores" name="cirurgiasanteriores" id="cirurgiasanteriores" >
							</div>
                            <div class="row">
								<label for="dataregistro">Data Registo</label>
								<input type='date' name="dataregistro" id="dataregistro">
							</div>
                            <div class="row">
								<label for="contatoEmergenciaNome">Nome do contato de emergência</label>
								<input type="contatoEmergenciaNome" name="contatoEmergenciaNome" id="contatoEmergenciaNome" >
							</div>
                            <div class="row">
								<label for="contatoEmergenciaTelefone">Telefone do contato de emergência</label>
								<input type="contatoEmergenciaTelefone" name="contatoEmergenciaTelefone" id="contatoEmergenciaTelefone">
							</div>
							<button type="submit">Enviar ficha</button>
							<button type="submit">Limpar</button>
							
							
						</form>
</div>
</body>
</html>