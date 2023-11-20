<?php
require_once "bd/conexao.php";

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    if ($tipo == "aluno") {
        if (isset($_GET['materia_id'])) {
            $materia_id = $_GET['materia_id'];
        
            $sql = "SELECT Aluno.RA, Aluno.Nome FROM Aluno
                    INNER JOIN Aluno_Materia ON Aluno.RA = Aluno_Materia.AlunoID
                    WHERE Aluno_Materia.MateriaID = $materia_id";

            $result = $conn->query($sql);

            $alunos = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $alunos[] = $row;
                }
            }
        }else {
            // Redirecionar de volta para a página anterior ou mostrar uma mensagem de erro
            echo "erro materia";
        }
    } elseif ($tipo == "tentativa" || $tipo == "paciente") {
        $sql = "SELECT Paciente.ID, Paciente.Nome FROM Paciente";

        $result = $conn->query($sql);

        $pacientes = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pacientes[] = $row;
            }
        }
    } else {
        echo "erro";
    }
} else {
    echo "erro tipo";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matéria Selecionada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Itens Vinculados à Matéria</h1>
        <ul>
        <?php
            if ($tipo == "aluno") {
                foreach ($alunos as $aluno) {
                    echo "<li><a href='relatorios3.php?id={$aluno['RA']}&tipo=aluno'>{$aluno['RA']} - {$aluno['Nome']}</a></li>";
                }
            } elseif ($tipo == "tentativa" || $tipo == "paciente") {
                foreach ($pacientes as $paciente) {
                    echo "<li><a href='relatorios3.php?id={$paciente['ID']}&tipo=$tipo'>{$paciente['ID']} - {$paciente['Nome']}</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
