<?php
$nome = $_POST['nome'];
$genero = $_POST['genero'];
$altura = $_POST['altura'];
$peso = $_POST['peso'];
$pressaoarterial = $_POST['pressaoarterial'];
$historico_clinico = $_POST['historicoclinico'];
$alergias = $_POST['alergias'];
$tipo_sanguineo = $_POST['tiposanguineo'];
$medicacao_atual = $_POST['medicacao'];
$cirurgias_anteriores = $_POST['cirugiasanteriores'];
$contato_emergencia_nome = $_POST['nom5econtactoemergencia'];
$contato_emergencia_telefone = $_POST['numerocontactoemergencia'];

// Preparar a declaração SQL para atualização
$sql = "UPDATE informacoesmedicas SET
            genero = '$genero',
            altura = '$altura',
            peso = '$peso',
            pressaoarterial = '$pressaoarterial',
            historicoclinico = '$historico_clinico',
            alergias = '$alergias',
            tipo_sanguineo = '$tipo_sanguineo',
            medicacaoatual = '$medicacao_atual',
            cirurgiasanteriores = '$cirurgias_anteriores',
            contatoEmergenciaNome = '$contato_emergencia_nome',
            contatoEmergenciaTelefone = '$contato_emergencia_telefone'
            WHERE nome = '$nome'";

// Executar a declaração SQL
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>