<?php
require_once "bd/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Relatórios</title>
    <link rel="stylesheet" href="../style/relatorio.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>

<body>
    <div class="container">
        <div class="modal-container">
            <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1" role="dialog" id="modalSheet">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="logo">
                            <img src="foto1.jpeg" alt="Logo">
                        </div>
                        <div class="modal-header border-bottom-0">
                            <h1 class="modal-title fs-5">Tela de Relatórios</h1>
                        </div>
                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <a type="button" href="relatorios1.php?tipo=aluno" class="btn btn-lg btn-primary btn-block">Consultas Alunos</a>
                        </div>

                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <a type="button" href="relatorios2.php?tipo=tentativa" class="btn btn-lg btn-secondary btn-block" data-bs-dismiss="modal">Tentativas de Contato</a>
                        </div>

                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <a type="button" href="relatorios2.php?tipo=paciente" class="btn btn-lg btn-secondary btn-block" data-bs-dismiss="modal">Histórico Paciente</a>
                        </div>

                        <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                            <a type="button" href="inicio_prof.php" class="btn btn-lg btn-secondary btn-block" data-bs-dismiss="modal">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
