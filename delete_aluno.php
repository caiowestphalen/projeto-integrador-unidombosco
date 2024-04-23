<?php
// Verifica se o ID do aluno a ser excluído foi enviado
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Conecta ao banco de dados
    include_once('./includes/config.php');

    // Obtém o ID do aluno da query string
    $id_aluno = $_GET['id'];

    // Query SQL para excluir o aluno
    $sql = "DELETE FROM alunos WHERE id = $id_aluno";

    // Executa a query
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a página de listagem de alunos com a mensagem de sucesso
        header("Location: gerenciarAlunos.php?msg=Aluno excluído com sucesso");
        exit();
    } else {
        // Se houver um erro na exclusão, exibe uma mensagem de erro
        echo "Erro ao excluir o aluno: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
} else {
    // Se o ID do aluno não foi fornecido, redireciona de volta para a página de listagem de alunos
    header("Location: gerenciarAlunos.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
    .custom-alert {
        position: fixed;
        top: 50px;
        right: 20px;
        z-index: 9999;
        width: 900px;
    }
    </style>
</head>
<body>

</body>
</html>
