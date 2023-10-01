<?php
// Inclua o arquivo de configuração do banco de dados
require_once "conexao.php";

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $ra = $_POST["ra"];
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $materias = $_POST["materias"];

    // Insira os dados do aluno na tabela "Aluno"
    $sql = "INSERT INTO Aluno (RA, Nome, senha) VALUES ('$ra', '$nome','$senha')";
    if ($conn->query($sql) === TRUE) {
        $alunoID = $conn->insert_id;

        // Insira as matérias em que o aluno está matriculado na tabela "Aluno_Materia"
        foreach ($materias as $materiaID) {
            $sql = "INSERT INTO Aluno_Materia (AlunoID, MateriaID) VALUES ('$ra', '$materiaID')";
            $conn->query($sql);
        }

        echo "Aluno cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o aluno: " . $conn->error;
    }
}
?>
