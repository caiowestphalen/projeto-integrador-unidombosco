<?php
$servername = "localhost"; // Endereço do servidor MySQL (normalmente é localhost)
$username = "root"; // Nome de usuário do MySQL (padrão no XAMPP é root)
$password = ""; // Senha do MySQL (padrão no XAMPP é vazia)
$dbname = "gymhub"; // Nome do banco de dados que você está usando

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
