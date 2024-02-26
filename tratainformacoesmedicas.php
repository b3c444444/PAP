<?php
// Captar dados do formulário
$nome = $_POST['nome'];
$data_nascimento = $_POST['Data_nascimento'];
$genero = $_POST['genero'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$pressaoarterial = $_POST['pressaoarterial'];
$historicoclinico = $_POST['historicoclinico'];
$alergias = $_POST['alergias'];
$tipo_sanguineo = $_POST['tipo_sanguineo'];
$medicacaoatual = $_POST['medicacaoatual'];
$cirurgiasanteriores = $_POST['cirurgiasanteriores'];
$dataregistro = $_POST['dataregistro'];
$contatoEmergenciaNome = $_POST['contatoEmergenciaNome'];
$contatoEmergenciaTelefone = $_POST['contatoEmergenciaTelefone'];

include 'ligaBD.php';

echo "<script>console.log('$nome','$data_nascimento','$genero','$altura','$peso','$pressaoarterial','$historicoclinico','$alergias','$tipo_sanguineo','$medicacaoatual','$cirurgiasanteriores','$dataregistro','$contatoEmergenciaNome','$contatoEmergenciaTelefone')</script>";

$insere_info = "INSERT INTO informacoesmedicas (nome, data_nascimento, genero, altura, peso, pressaoarterial, historicoclinico, alergias, tipo_sanguineo, medicacaoatual, cirurgiasanteriores, dataregistro, contatoEmergenciaNome, contatoEmergenciaTelefone) VALUES ('$nome','$data_nascimento','$genero','$altura','$peso','$pressaoarterial','$historicoclinico','$alergias','$tipo_sanguineo','$medicacaoatual','$cirurgiasanteriores','$dataregistro','$contatoEmergenciaNome','$contatoEmergenciaTelefone')";

$faz_insere_info = mysqli_query($conn, $insere_info);

if (!$faz_insere_info) {
    die('Erro: ' . mysqli_error($conn));
} else {
    echo '<p align="center">Dados foram enviados com sucesso!!! Efectue login. <a href="index.html">Login </a><BR><a href="javascript:history.back(1);"> ou tente um novo registo</a></p>';
}
?>

