<?php
require_once "bd/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
</head>

<body>
    <div class="container mt-5">
        <div class="text-center">
            <img src="foto1.jpeg" alt="Logo da Empresa" class="img-fluid" />
            <h1>Cadastro de Paciente</h1>
        </div>
        <form action="bd/cadastro.php?type=paciente" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="tel" name="tel" required>
            </div>
            <div class="mb-3">
                <label for="tel2" class="form-label">Telefone 2</label>
                <input type="tel" class="form-control" id="tel2" name="tel2">
            </div>
            <div class="form-group">
                <label for="materias">Clínica:</label>
                <select class="form-control" id="materias" name="materias" required>
                    <?php
                        // Consulta SQL para buscar as clínicas
                        $sql = "SELECT ID, NomeMateria FROM Materia";
                        $result = $conn->query($sql);

                        // Preencha as opções do select com as clínicas
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['ID'] . "'>" . $row['NomeMateria'] . "</option>";
                            }
                        }

                        // Feche a conexão com o banco de dados
                        $conn->close();
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>

</html>
