<?php
require_once "bd/conexao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        if ($tipo == "aluno") {
            // Lógica para consultar as consultas marcadas pelo aluno
            $sql = "SELECT Consulta.*, Paciente.Nome AS NomePaciente
                    FROM Consulta
                    INNER JOIN Paciente ON Consulta.PacienteID = Paciente.ID
                    WHERE Consulta.Aluno1RA = $id OR Consulta.Aluno2RA = $id";
            $result = $conn->query($sql);

            $consultas = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $consultas[] = $row;
                }
            }
        } elseif ($tipo == "tentativa") {
            // Lógica para consultar as tentativas de contato com o paciente
            $sql = "SELECT Motivo_Nao_Marcar.*, Aluno.Nome AS NomeAluno
                    FROM Motivo_Nao_Marcar
                    INNER JOIN Aluno ON Motivo_Nao_Marcar.RA_Aluno = Aluno.RA
                    WHERE Motivo_Nao_Marcar.PacienteID = $id";
            $result = $conn->query($sql);

            $tentativas = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tentativas[] = $row;
                }
            }
        } elseif ($tipo == "paciente") {
            // Lógica para consultar as consultas que o paciente passou
            $sql = "SELECT Consulta.*, Aluno1.Nome AS NomeAluno1, Aluno2.Nome AS NomeAluno2
                    FROM Consulta
                    INNER JOIN Aluno AS Aluno1 ON Consulta.Aluno1RA = Aluno1.RA
                    INNER JOIN Aluno AS Aluno2 ON Consulta.Aluno2RA = Aluno2.RA
                    WHERE Consulta.PacienteID = $id";
            $result = $conn->query($sql);

            $consultas_paciente = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $consultas_paciente[] = $row;
                }
            }
        } else {
            echo "erro";
        }
    } else {
        echo "erro tipo";
    }
} else {
    echo "erro id";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Relatório</h1>
        <ul>
            <?php
            if ($tipo == "aluno") {
                foreach ($consultas as $consulta) {
                    echo "<li>Consulta ID: {$consulta['ID']}, Data: {$consulta['DataConsulta']}, Hora: {$consulta['HoraConsulta']}, Realizada: {$consulta['realizada']}, Atendimento: {$consulta['atendimento']}, Paciente: {$consulta['NomePaciente']}</li>";
                }
            } elseif ($tipo == "tentativa") {
                foreach ($tentativas as $tentativa) {
                    echo "<li>Motivo Não Marcar ID: {$tentativa['ID']}, Motivo: {$tentativa['Motivo']}, Data Registro: {$tentativa['DataRegistro']}, Aluno: {$tentativa['NomeAluno']}</li>";
                }
            } elseif ($tipo == "paciente") {
                foreach ($consultas_paciente as $consulta_paciente) {
                    echo "<li>Consulta ID: {$consulta_paciente['ID']}, Data: {$consulta_paciente['DataConsulta']}, Hora: {$consulta_paciente['HoraConsulta']}, Realizada: {$consulta_paciente['realizada']}, Atendimento: {$consulta_paciente['atendimento']}, Aluno1: {$consulta_paciente['NomeAluno1']}, Aluno2: {$consulta_paciente['NomeAluno2']}</li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
