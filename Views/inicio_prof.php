<?php
require_once "bd/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de ADM</title>
    <link rel="stylesheet" href="../style/inicio_profinicioprofessor.css">
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
                    <h1 class="modal-title fs-5">Tela de ADM</h1>
                </div>
                <div class="modal-footer">
                    <a type="button" href="cad_aluno.php" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Cadastrar Aluno</a>
                    <a type="button" href="cad_professor.php" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Cadastrar Professor/Adm</a>
                    <a type="button" href="cad_paciente.php" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Cadastrar Paciente</a>
                    <a type="button" href="relatorios.php" class="btn btn-lg btn-primary" data-bs-dismiss="modal">Gerar Relatórios</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
