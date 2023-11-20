<?php
// Se conecta com o banco de dados
require_once "bd/conexao.php";

// Recebe os parâmetros ra e paciente_id da URL
$ra = $_GET['ra'];
$paciente_id = $_GET['paciente_id'];

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o motivo do não agendamento da consulta do formulário
    $motivo = $_POST['motivo'];

    // Atualiza a tabela Motivo_Nao_Marcar
    $sql_motivo = "INSERT INTO Motivo_Nao_Marcar (PacienteID, Motivo, RA_Aluno) VALUES ($paciente_id, '$motivo', $ra)";
    if ($conn->query($sql_motivo) === TRUE) {
        // Atualiza a tabela Fila para realocar o paciente no último lugar
        $sql_fila = "UPDATE Fila SET ID = (SELECT MAX(ID) + 1 FROM Fila) WHERE PacienteID = $paciente_id";
        if ($conn->query($sql_fila) === TRUE) {
            echo "Motivo registrado com sucesso e paciente realocado no final da fila.";
            header("Location: inicio_aluno.php?ra=" . $ra);
        } else {
            echo "Erro ao realocar o paciente na fila: " . $conn->error;
        }
    } else {
        echo "Erro ao registrar o motivo: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivo para Não Marcar Consulta</title>
    <link rel="stylesheet" href="../style/motivonaomarcar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
</head>

<body>
    <div class="container mt-5">
        <div class="logo">
            <img src="foto1.jpeg" alt="Logo">
        </div>
        <h1 class="display-4">Motivo para Não Marcar Consulta</h1>
        <form method="post" action="">
            <input type="hidden" name="ra" value="<?php echo $ra; ?>">
            <input type="hidden" name="paciente_id" value="<?php echo $paciente_id; ?>">
            <div class="form-group">
                <label for="motivo">Informe o motivo pelo qual você não marcou a consulta:</label>
                <textarea class="form-control" name="motivo" id="motivo" rows="5" required></textarea>
            </div>
            <button type="submit" name="registrar_motivo" class="btn btn-success">Registrar Motivo</button>
            <a id="voltar" class="btn btn-lg btn-primary" href="inicio_aluno.php?ra=<?php echo $ra; ?>">Voltar</a>
        </form>
    </div>
</body>

</html>
