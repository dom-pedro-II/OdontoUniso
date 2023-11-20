<?php
// se conecta com o banco
require_once "bd/conexao.php";
//recebe o parametro ra
$ra = $_GET['ra'];

// Consulta SQL para obter todas as matérias
$sql = "SELECT ID, NomeMateria FROM Materia";
$result = $conn->query($sql);

$matarias = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $matarias[] = $row;
    }
}

// Consulta SQL para obter o nome do aluno com base no RA
$sql = "SELECT Nome FROM Aluno WHERE RA = $ra";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomeAluno = $row['Nome'];
} else {
    $nomeAluno = "Aluno não encontrado";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecionar Matéria</title>
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>
<body>
    <div class="container">
        <h1>Selecione uma Matéria</h1>
        <ul>
            <?php foreach ($matarias as $materia) : ?>
                <li><a href="prox_paciente_2.php?ra=<?php echo $ra; ?>&materia_id=<?php echo $materia['ID']; ?>"><?php echo $materia['NomeMateria']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
