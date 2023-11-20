<?php
require_once "bd/conexao.php";
// Verificar se o ID do paciente foi passado na URL
if (isset($_POST['paciente_id'])) {
    $pacienteID = $_POST['paciente_id'];
    $ra = $_POST['ra'];
    $ra2 = $_POST['ra2'];
    $DataConsulta = $_POST['data'];
    $aluno2RA = $ra2;
    $aluno1RA = $ra;
    
    // Consulta para obter o nome do paciente com base no ID
    $consultaPaciente = "SELECT Nome FROM Paciente WHERE ID = $pacienteID";
    $resultadoPaciente = mysqli_query($conn, $consultaPaciente);

    if (mysqli_num_rows($resultadoPaciente) > 0) {
        $dadosPaciente = mysqli_fetch_assoc($resultadoPaciente);
        $nomePaciente = $dadosPaciente['Nome'];
    } else {
        $nomePaciente = "Paciente não encontrado";
    }
} else {
    // Se o ID do paciente não foi passado, redirecione de volta para a página anterior ou faça alguma outra ação
    header("Location: inicio_aluno.php");
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Consulta</title>
    <link rel="stylesheet" href="../style/marcarconsulta.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    
</head>

<body>
    <div class="container mt-5">
        <div class="content">
            <div class="logo">
                <img src="foto1.jpeg" alt="Logo">
            </div>
            <h1>Marcar Consulta para <?php echo $nomePaciente; ?></h1>
            <form method="post" action="bd/processar_consulta.php?ra1=<?php echo $aluno1RA ?>&ra2=<?php echo $aluno2RA ?>&data=<?php echo $DataConsulta?>">
                <div class="form-group">
                    <label for="horaConsulta">Escolha um horário disponível</label>
                    <select class="form-control" id="horaConsulta" name="horaConsulta" required>
                    <?php
                        $horariosDisponiveis = array();
                        $horarioAtual = strtotime('09:00:00');
                        $horarioFim = strtotime('19:00:00');
                        $intervalo = 60 * 60; // 1 hora em segundos

                        while ($horarioAtual < $horarioFim) {
                            $horarioFormatado = date('H:i', $horarioAtual);

                            // Verificar se o horário já foi agendado para algum dos alunos
                            $consultaHorario = "SELECT * FROM Consulta WHERE DataConsulta = '$DataConsulta' AND HoraConsulta = '$horarioFormatado' AND (Aluno1RA = '$aluno1RA' OR Aluno2RA = '$aluno2RA')";
                            $resultadoHorario = mysqli_query($conn, $consultaHorario);

                            if (mysqli_num_rows($resultadoHorario) == 0) {
                                $horariosDisponiveis[] = $horarioFormatado;
                            }

                            $horarioAtual += $intervalo;
                        }
                        foreach ($horariosDisponiveis as $horario) {
                            echo "<option value='$horario'>$horario</option>";
                        }
                    ?>
                    </select>
                </div>
                <input type="hidden" name="pacienteID" value="<?php echo $pacienteID; ?>">
                <button type="submit" class="btn btn-primary">Marcar Consulta</button>
            </form>
            <a type="button" href="inicio_aluno.php" class="btn btn-lg btn-primary btn-back">Voltar</a>
        </div>
    </div>
</body>

</html>
