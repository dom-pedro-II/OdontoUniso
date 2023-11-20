<?php
//se conecta com o banco
require_once "bd/conexao.php";
//recebe o parametro ra
$ra = $_GET['ra'];

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
    <title>Tela de Aluno</title>
    <link rel="stylesheet" href="../style/inicioaluno.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-logo">
                    <img src="foto1.jpeg" alt="Logotipo" style="max-width: 100%;">
                </div>
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5">Tela de Aluno</h1>
                </div>
                <div class="modal-footer">
                    <a id="proximo-paciente" href="prox_paciente.php?ra=<?php echo $ra; ?>" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Próximo Paciente</a>
                    <a id="agenda" href="agenda.php?ra=<?php echo $ra; ?>&filtro=futuras" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Verificar Agenda</a>
                    <a type="button" href="index.php" class="btn btn-lg btn-primary" data-bs-dismiss="modal">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
