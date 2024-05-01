<?php

$servername = "localhost";
$username = "capsulif_unidombosco";
$password = "@C0sta000";
$dbname = "capsulif_projetointegrador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    $error_log = fopen("error.log", "a");
    fwrite($error_log, date("d-m-Y H:i:s") . " Erro de conexão: " . $conn->connect_error . "\n");
    fclose($error_log);
    
    // Mensagem de erro para exibição ao usuário
    die("Erro de conexão com o banco de dados. Entre em contato com Caio!");
}

mysqli_set_charset($conn, "utf8mb4");
?>
