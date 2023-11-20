<?php
// Conecta com o banco
require_once "bd/conexao.php";

$ra = $_GET['ra'];

if (isset($_GET['consulta_id'])) {
    $consultaID = $_GET['consulta_id'];

    // Consulta SQL para obter os detalhes da consulta com base no ID da consulta
    $sqlConsulta = "SELECT * FROM Consulta WHERE ID = $consultaID";
    $resultConsulta = $conn->query($sqlConsulta);

    if ($resultConsulta->num_rows > 0) {
        $rowConsulta = $resultConsulta->fetch_assoc();
        $dataConsulta = $rowConsulta['DataConsulta'];
        $horaConsulta = $rowConsulta['HoraConsulta'];
        $pacienteID = $rowConsulta['PacienteID'];

        // Consulta SQL para obter o nome do paciente com base no ID do paciente
        $sqlPaciente = "SELECT Nome FROM Paciente WHERE ID = $pacienteID";
        $resultPaciente = $conn->query($sqlPaciente);

        if ($resultPaciente->num_rows > 0) {
            $rowPaciente = $resultPaciente->fetch_assoc();
            $nomePaciente = $rowPaciente['Nome'];
        } else {
            $nomePaciente = "Paciente não encontrado";
        }
    } else {
        echo "Consulta não encontrada.";
    }
} else {
    echo "ID da consulta não especificado.";
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link rel="stylesheet" href="../style/editarconsulta.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</head>

<body>        
    <div class="container">
        <h2>Editar Consulta</h2>
        <p><strong>Data da Consulta:</strong> <?php echo $dataConsulta; ?></p>
        <p><strong>Hora da Consulta:</strong> <?php echo $horaConsulta; ?></p>
        <p><strong>Paciente:</strong> <?php echo $nomePaciente; ?></p>
        
        <form method="POST" action="bd/atualizar_consulta.php?id=<?php echo $consultaID; ?>&ra=<?php echo $ra ?>&type=atualizar">
            <div class="form-group">
                <label for="data_consulta">Nova Data da Consulta:</label>
                <input type="date" class="form-control" id="data_consulta" name="data_consulta" required>
            </div>
            <div class="form-group">
                <label for="hora_consulta">Nova Hora da Consulta:</label>
                <input type="time" class="form-control" id="hora_consulta" name="hora_consulta" required>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Atualizar Consulta</button>
                <a href="agenda.php?ra=<?php echo $ra; ?>&filtro=futuras" class="btn btn-secondary">Cancelar/Voltar</a>
                <button type="submit" class="btn btn-danger" name="excluir_consulta">Desmarcar Consulta</button>
            </div>
        </form>
    </div>
</body>
</html>
