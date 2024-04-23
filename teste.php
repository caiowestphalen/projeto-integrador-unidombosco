<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Conexão</title>
</head>
<body>
    <h1>Teste de Conexão com o Banco de Dados</h1>
    <?php
    // Configurações de conexão ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gymhub";

    // Tentativa de conexão ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erros na conexão
    if ($conn->connect_error) {
        echo "<p>Erro ao conectar ao banco de dados: " . $conn->connect_error . "</p>";
    } else {
        echo "<p>Conexão bem-sucedida ao banco de dados!</p>";
        // Fecha a conexão
        $conn->close();
    }
    ?>
</body>
</html>
