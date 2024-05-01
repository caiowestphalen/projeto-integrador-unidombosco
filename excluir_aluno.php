<?php
include('partials/conexao.php');

if(isset($_GET['id'])) {
    $aluno_id = $_GET['id'];

    $sql = "DELETE FROM alunos WHERE id = $aluno_id";

    if(mysqli_query($conn, $sql)) {
        header("Location: gerenciar.php?excluido=1");
        exit();
    } else {
        // Se houver algum erro ao excluir o aluno, redirecionar de volta para a página de gerenciamento com uma mensagem de erro
        header("Location: gerenciar.php?erro_excluir=1");
        exit();
    }
} else {
    // Redirecionar de volta para a página de gerenciamento de alunos se o parâmetro 'id' não for fornecido
    header("Location: gerenciar.php");
    exit();
}

if (mysqli_query($conn, $sql)) {
    $_SESSION['mensagemSucesso'] = "Aluno <b>$aluno_id - $nome</b> excluído com sucesso.";
    header("location: gerenciar.php");
} else {
    echo "Erro ao excluir o cadastro do aluno: " . mysqli_error($conn);
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
