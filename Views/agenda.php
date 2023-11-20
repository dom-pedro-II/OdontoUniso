<?php
// Conecta com o banco
require_once "bd/conexao.php";

// Recebe o parâmetro ra
$ra = $_GET['ra'];
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'futuras';

// Consulta SQL para obter o nome do aluno com base no RA
$sqlAluno = "SELECT Nome FROM Aluno WHERE RA = $ra";
$resultAluno = $conn->query($sqlAluno);

if ($resultAluno->num_rows > 0) {
    $rowAluno = $resultAluno->fetch_assoc();
    $nomeAluno = $rowAluno['Nome'];
} else {
    $nomeAluno = "Aluno não encontrado";
}

// Construir a condição para filtrar consultas com base no valor de $filtro
if ($filtro === 'futuras') {
    $condicaoFiltro = "Consulta.DataConsulta >= CURDATE()";
} else {
    $condicaoFiltro = "Consulta.DataConsulta < CURDATE()";
}

// Consulta SQL para obter as consultas marcadas para o aluno com base no RA e na condição de filtro
$sqlConsultas = "SELECT Consulta.*, Paciente.Nome AS NomePaciente, Materia.NomeMateria AS NomeMateria
                FROM Consulta
                LEFT JOIN Paciente ON Consulta.PacienteID = Paciente.ID
                LEFT JOIN Materia ON Paciente.MateriaID = Materia.ID
                WHERE (Consulta.Aluno1RA = $ra OR Consulta.Aluno2RA = $ra)
                AND $condicaoFiltro";
$resultConsultas = $conn->query($sqlConsultas);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="../style/agenda.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>

<body>
    <div class="container">
        <h2>Consultas Marcadas para o aluno: <?php echo $nomeAluno; ?></h2>
        <p>
            <a href="?ra=<?php echo $ra; ?>&filtro=futuras">Consultas Futuras</a> |
            <a href="?ra=<?php echo $ra; ?>&filtro=passadas">Consultas Antigas</a>
        </p>
        <ul>
            <?php
            if ($resultConsultas->num_rows > 0) {
                while ($rowConsulta = $resultConsultas->fetch_assoc()) {
                    $dataConsulta = $rowConsulta['DataConsulta'];
                    $horaConsulta = $rowConsulta['HoraConsulta'];
                    $pacienteNome = $rowConsulta['NomePaciente'];
                    $materiaNome = $rowConsulta['NomeMateria'];
                    $consultaID = $rowConsulta['ID'];

                    echo "<li>Consulta em $dataConsulta às $horaConsulta com Paciente: $pacienteNome, Matéria: $materiaNome ";
                    echo "<a class='edit-link' href='editar_consulta.php?consulta_id=$consultaID&ra=$ra'>Editar</a>";
                    echo "<a class='finish-link' href='finalizar_consulta.php?consulta_id=$consultaID&ra=$ra'>Encerrar Atendimento</a></li>";
                }
            } else {
                echo "<li>Nenhuma consulta marcada para este aluno.</li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>
