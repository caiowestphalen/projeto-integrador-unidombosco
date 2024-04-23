<?php
include_once('./includes/header.php');
include_once('./includes/config.php');

// Verifica se o ID do aluno foi enviado via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtém o ID do aluno da query string
    $id_aluno = $_GET['id'];

    // Query SQL para buscar as informações do aluno com base no ID
    $sql = "SELECT * FROM alunos WHERE id = $id_aluno";

    // Executa a query
    $result = $conn->query($sql);

    // Verifica se o aluno foi encontrado
    if ($result->num_rows > 0) {
        // Obtém os dados do aluno
        $aluno = $result->fetch_assoc();
    } else {
        // Se o aluno não foi encontrado, redireciona de volta para a página de gerenciar alunos
        header("Location: gerenciarAlunos.php");
        exit();
    }
} else {
    // Se o ID do aluno não foi fornecido, redireciona de volta para a página de gerenciar alunos
    header("Location: gerenciarAlunos.php");
    exit();
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos (você pode adicionar mais validações aqui)

    // Atribuir os novos valores aos campos do aluno, apenas se estiverem preenchidos
    $nome = !empty($_POST['nome']) ? $_POST['nome'] : $aluno['nome'];
    $rg = !empty($_POST['rg']) ? $_POST['rg'] : $aluno['rg'];
    $profissao = !empty($_POST['profissao']) ? $_POST['profissao'] : $aluno['profissao'];
    $sexo = !empty($_POST['sexo']) ? $_POST['sexo'] : $aluno['sexo'];
    $data_nascimento = !empty($_POST['data_nascimento']) ? $_POST['data_nascimento'] : $aluno['data_nascimento'];
    $estado_civil = !empty($_POST['estado_civil']) ? $_POST['estado_civil'] : $aluno['estado_civil'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $aluno['email'];
    $telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : $aluno['telefone'];
    $cep = !empty($_POST['cep']) ? $_POST['cep'] : $aluno['cep'];
    $endereco = !empty($_POST['endereco']) ? $_POST['endereco'] : $aluno['endereco'];
    $bairro = !empty($_POST['bairro']) ? $_POST['bairro'] : $aluno['bairro'];
    $cidade = !empty($_POST['cidade']) ? $_POST['cidade'] : $aluno['cidade'];
    $estado = !empty($_POST['estado']) ? $_POST['estado'] : $aluno['estado'];
    $dia_vencimento = !empty($_POST['dia_vencimento']) ? $_POST['dia_vencimento'] : $aluno['dia_vencimento'];
    $forma_pagamento = !empty($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : $aluno['forma_pagamento'];
    $plano = !empty($_POST['plano']) ? $_POST['plano'] : $aluno['plano'];

    // Query SQL para atualizar os dados do aluno
    $sql_update = "UPDATE alunos SET 
        nome = '$nome',
        rg = '$rg',
        profissao = '$profissao',
        sexo = '$sexo',
        data_nascimento = '$data_nascimento',
        estado_civil = '$estado_civil',
        email = '$email',
        telefone = '$telefone',
        cep = '$cep',
        endereco = '$endereco',
        bairro = '$bairro',
        cidade = '$cidade',
        estado = '$estado',
        dia_vencimento = '$dia_vencimento',
        forma_pagamento = '$forma_pagamento',
        plano = '$plano'
        WHERE id = $id_aluno";

    // Executa a query de atualização
    if ($conn->query($sql_update) === TRUE) {
        // Redireciona de volta para a página de gerenciar alunos com uma mensagem de sucesso
        header("Location: gerenciarAlunos.php?msg=Aluno atualizado com sucesso");
        exit();
    } else {
        // Se houver um erro na atualização, exibe uma mensagem de erro
        echo "Erro ao atualizar o aluno: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="no-js">

<head>
    <title>Editar Aluno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="assets/css/my-custom-styles.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
</head>

<body class="sidebar-fixed topnav-fixed demo-only-page-blank">
    <div id="wrapper" class="wrapper">
        <div id="main-content-wrapper" class="content-wrapper ">
            <div class="row">
                <div class="col-lg-4 ">
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                        <li><a href="#">Gerenciar Alunos</a></li>
                        <li class="active">Editar Aluno</li>
                    </ul>
                </div>
            </div>
            <!-- CONTEUDO DA PAGINA -->
            <div class="content">
                <div class="main-header">
                    <h2>Editar Aluno</h2>
                    <em>Edite as informações do aluno abaixo.</em>
                </div>
                <div class="main-content">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_aluno; ?>">
                        <!-- Campos do formulário para editar informações do aluno -->
                        <!-- Você pode adicionar campos adicionais conforme necessário -->
                        <div class="widget">
                            <div class="widget-header">
                                <h3><i class="fa fa-users"></i> Dados pessoais</h3>
                            </div>
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nome" placeholder="Nome Completo" class="form-control" value="<?php echo $aluno['nome']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="rg" placeholder="RG" class="form-control" value="<?php echo $aluno['rg']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="profissao" placeholder="Profissão" class="form-control" value="<?php echo $aluno['profissao']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label class="control-inline fancy-radio">
                                                <input type="radio" name="sexo" value="masculino" <?php if ($aluno['sexo'] == 'masculino') echo 'checked'; ?>>
                                                <span><i></i><label class="label label-primary"> Masculino</label></span>
                                            </label>

                                            <label class="control-inline fancy-radio">
                                                <input type="radio" name="sexo" value="feminino" <?php if ($aluno['sexo'] == 'feminino') echo 'checked'; ?>>
                                                <span><i></i> <label class="label" style="background-color:deeppink;"> Feminino</label> </span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="data_nascimento" placeholder="Data de Nascimento" class="form-control" value="<?php echo $aluno['data_nascimento']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="estado_civil" placeholder="Estado Civil" class="form-control" value="<?php echo $aluno['estado_civil']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fim dos campos do formulário -->
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Atualizar</button>
                            </div>
                            <div class="col-md-6">
                                <a href="gerenciarAlunos.php" class="btn btn-danger btn-block"><i class="fa fa-times-circle"></i> Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM CONTEUDO DA PAGINA -->

    <!-- Javascript -->
    <script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/plugins/modernizr/modernizr.js"></script>
    <script src="assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
    <script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/king-common.js"></script>

</body>

</html>
