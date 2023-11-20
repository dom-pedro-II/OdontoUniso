<?php
// Se conecta com o banco de dados
require_once "bd/conexao.php";

// Recebe o parâmetro ra e materia_id
$ra = $_GET['ra'];
$materia_id = $_GET['materia_id'];

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
    <title>Próximo Paciente da Fila</title>
    <link rel="stylesheet" href="../style/proximopaciente.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
  
</head>

<body>
    <div class="container mt-5">
        <div class="logo">
            <img src="foto1.jpeg" alt="Logo">
        </div>
        <h1 class="display-4">Próximo Paciente da Fila</h1>
        <p class="lead">Aluno: <?php echo $nomeAluno; ?></p>
        <div class="card">
            <div class="card-body">
            <?php
                    // Consulta para obter o próximo paciente da fila com base na matéria selecionada
                    $consulta = "SELECT p.ID, p.Nome, p.email, p.tel, p.tel2 FROM Fila AS f
                                 JOIN Paciente AS p ON f.PacienteID = p.ID
                                 WHERE p.MateriaID = $materia_id
                                 ORDER BY f.ID ASC LIMIT 1";
                    $resultado = mysqli_query($conn, $consulta);

                    // Exibe o resultado da consulta 
                    if (mysqli_num_rows($resultado) > 0) {
                        $paciente = mysqli_fetch_assoc($resultado);
                ?>
                    <h5 class="card-title">Paciente:</h5>
                    <p><strong>Nome:</strong> <?php echo $paciente['Nome']; ?></p>
                    <p><strong>Email:</strong> <?php echo $paciente['email']; ?></p>
                    <p><strong>Telefone:</strong> <?php echo $paciente['tel']; ?></p>
                    <p><strong>Telefone:</strong> <?php echo $paciente['tel2']; ?></p>

                    <form method="post" action="marcar_consulta.php">
                        <input type="hidden" name="paciente_id" value="<?php echo $paciente['ID']; ?>">
                        <input type="hidden" name="ra" value="<?php echo $ra; ?>">
                        <div class="form-group">
                            <label for="ra2">RA do Segundo Aluno:</label>
                            <input type="text" name="ra2" id="ra2" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="data">Data da Consulta:</label>
                            <input type="date" name="data" id="data" class="form-control">
                        </div>
                        <div class="btn-container">
                            <button type="submit" name="marcar_consulta" class="btn btn-success btn-marcar">Marcar Consulta</button>
                            <a href="motivo_nao_marcar.php?ra=<?php echo $ra; ?>&paciente_id=<?php echo $paciente['ID']; ?>" class="btn btn-danger btn-nao-retornou">Não Retornou Contato</a>
                            <a id="voltar" class="btn btn-primary" data-bs-dismiss="modal" href="inicio_aluno.php?ra=<?php echo $ra; ?>">Voltar</a>
                        </div>
                    </form>
                <?php
                } else {
                    echo "<p>Nenhum paciente na fila nesta matéria.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
