<?php
    if ($_GET["id"]) {
        $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecionamento com POST</title>
</head>
<body>

    <form id="redirectForm" action="MedicalNotesInfos.php" method="post">
        <input type="hidden" name="ID_PessoaX" value="<?php echo $id; ?>">
    </form>

    <script>
        document.getElementById('redirectForm').submit();
    </script>

</body>
</html>

<?php
    }
?>
