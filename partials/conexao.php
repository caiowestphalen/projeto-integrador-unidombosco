<?php

$servername = "localhost";
$username = "unidombosco";
$password = "@unidombosco";
$dbname = "unidombosco_projetointegrador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    $error_log = fopen("error.log", "a");
    fwrite($error_log, date("d-m-Y H:i:s") . " Erro de conexão: " . $conn->connect_error . "\n");
    fclose($error_log);
    
    
    die("Erro de conexão com o banco de dados. Entre em contato com Caio!");
}

mysqli_set_charset($conn, "utf8mb4");
?>
