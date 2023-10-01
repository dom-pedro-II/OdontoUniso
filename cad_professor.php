<?php
require_once "bd/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Professor</title>
    <script src="js/index.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h2>Cadastro de Professor</h2>
        <form action="bd/cadastro_professor.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="ra">codigo Professor:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <div class="form-group">
                <label for="confirmarSenha">Confirmar Senha:</label>
                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
            </div>

            <div class="form-group">
                <label for="materias">Matérias:</label>
                <select multiple class="form-control" id="materias" name="materias[]" required>
        
                    <?php
                        // Consulta SQL para buscar as matérias
                        $sql = "SELECT ID, NomeMateria FROM Materia";
                        $result = $conn->query($sql);

                        // Preencha as opções do select com as matérias
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