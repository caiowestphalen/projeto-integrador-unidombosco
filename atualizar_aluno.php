<?php
session_start();

include('partials/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno_id = $_POST['aluno_id'];
    $nome = $_POST['nome'];
    $rg = $_POST['rg'];
    $status = $_POST['status'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $plano = $_POST['plano'];

    $sql = "UPDATE alunos SET nome='$nome', rg='$rg', status='$status', telefone='$telefone', email='$email', plano='$plano' WHERE id='$aluno_id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagemSucesso'] = "Aluno $aluno_id - $nome editado com sucesso.";
        header("location: gerenciar.php");
    } else {
        echo "Erro ao atualizar o cadastro do aluno: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
