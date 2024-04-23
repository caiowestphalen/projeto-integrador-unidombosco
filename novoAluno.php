<?php
include_once('./includes/header.php');
include_once('./includes/config.php');

// Função para exibir mensagem de erro em vermelho
function showError($message) {
    echo "<span style='color: red;'>$message</span>";
}

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos campos obrigatórios
    $camposObrigatorios = array('nome', 'rg', 'profissao', 'sexo', 'data_nascimento', 'estado_civil2', 'email', 'telefone', 'cep', 'endereco', 'bairro', 'cidade', 'estado', 'dia_vencimento', 'forma_pagamento', 'plano');

    $camposFaltando = array_filter($camposObrigatorios, function($campo) {
        return empty($_POST[$campo]);
    });

    if (!empty($camposFaltando)) {
        showError("<div class='alert alert-danger custom-alert' role='alert'>Todos os campos são obrigatórios!</div>");
    } else {
        // Atribuir valores dos campos do formulário a variáveis
        $nome = $_POST['nome'];
        $rg = $_POST['rg'];
        $profissao = $_POST['profissao'];
        $sexo = $_POST['sexo'];
        $data_nascimento = $_POST['data_nascimento'];
        $estado_civil = $_POST['estado_civil2'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $dia_vencimento = $_POST['dia_vencimento'];
        $forma_pagamento = $_POST['forma_pagamento'];
        $plano = $_POST['plano'];

        // Query para inserir os dados no banco de dados
        $sql = "INSERT INTO alunos (nome, rg, profissao, sexo, data_nascimento, estado_civil2, email, telefone, cep, endereco, bairro, cidade, estado, dia_vencimento, forma_pagamento, plano) 
        VALUES ('$nome', '$rg', '$profissao', '$sexo', '$data_nascimento', '$estado_civil', '$email', '$telefone', '$cep', '$endereco', '$bairro', '$cidade', '$estado', '$dia_vencimento', '$forma_pagamento', '$plano')";

        // Executa a query
        if ($conn->query($sql) === TRUE) {
            $success_message = "Dados cadastrados com sucesso!";
        } else {
            $error_message = "Erro ao cadastrar dados: " . $conn->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br" class="no-js">

<head>
    <title>Projeto Integrador - Caio Westphalen RA22202420</title>
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

<body class="sidebar-fixed topnav-fixed demo-only-page-blank">
    <?php if (!empty($success_message)) : ?>
        <div class="alert alert-success custom-alert" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <div id="wrapper" class="wrapper">
        <div id="main-content-wrapper" class="content-wrapper ">
            <div class="row">
                <div class="col-lg-4 ">
                    <ul class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                        <li><a href="#">Novo Aluno</a></li>
                        <li class="active">Cadastro</li>
                    </ul>
                </div>

            </div>
            <!-- CONTEUDO DA PAGINA -->
            <div class="content">
                <div class="main-header">
                    <h2>Cadastro de Aluno</h2>
                    <em>Faça o cadastro de um novo aluno na academia.</em>
                </div>
                <div class="main-content">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!-- DADOS PESSOAIS -->
                        <div class="widget">
                            <div class="widget-header">
                                <h3><i class="fa fa-users"></i> Dados pessoais</h3>
                            </div>
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nome" placeholder="Nome Completo" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="rg" placeholder="RG" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="profissao" placeholder="Profissão" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-top: 10px;">
                                            <label class="control-inline fancy-radio">
                                                <input type="radio" name="sexo" value="masculino">
                                                <span><i></i><label class="label label-primary"> Masculino</label></span>
                                            </label>

                                            <label class="control-inline fancy-radio">
                                                <input type="radio" name="sexo" value="feminino">
                                                <span><i></i> <label class="label" style="background-color:deeppink;"> Feminino</label> </span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="data_nascimento" placeholder="Data de Nascimento" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="estado_civil" placeholder="Estado Civil" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIM DADOS PESSOAIS -->

                        <!-- DADOS CONTATO -->
                        <div class="widget">
                            <div class="widget-header">
                                <h3><i class="fa fa-phone"></i> Informações de Contato</h3>
                            </div>
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="E-mail" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="telefone" placeholder="Whatsapp" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="bairro" placeholder="Bairro" class="form-control">
                                        </div>
                                        

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="cep" placeholder="CEP" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="endereco" placeholder="Endereço" class="form-control">
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input type="text" name="cidade" placeholder="Cidade" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="text" name="estado" placeholder="Estado" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FIM DADOS CONTATO -->

                        <!-- DADOS PAGAMENTO -->
                        <div class="widget">
                            <div class="widget-header">
                                <h3><i class="fa fa-money"></i> Dados de Pagamento</h3>
                            </div>
                            <div class="widget-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span class="text">Dia do pagamento: </span>
                                            <select name="dia_vencimento" class="form-control">
                                                <option value="">Selecione...</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <?php
                                                for ($i = 10; $i <= 30; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span class="text">Forma de pagamento: </span>
                                            <select name="forma_pagamento" class="form-control">
                                                <option value="">Selecione...</option>
                                                <option value="cartao_credito">Cartão de Crédito</option>
                                                <option value="cartao_debito">Cartão de Débito</option>
                                                <option value="pix">PIX</option>
                                                <option value="boleto">Boleto de Pagamento</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span class="text">Plano: </span>
                                            <select name="plano" class="form-control">
                                                <option value="">Selecione...</option>
                                                <option value="safira">Plano Safira - (R$ 100,00)</option>
                                                <option value="gold">Plano Gold - (R$ 190,00)</option>
                                                <option value="premium">Plano Premium - (R$ 275,00)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check-circle"></i> Cadastrar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FIM DADOS PAGAMENTO -->
            </div>
        </div>
        <!-- FIM CONTEUDO DA PAGINA -->
    </div>
    </div>

    <!-- Javascript -->
    <script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script src="assets/js/plugins/modernizr/modernizr.js"></script>
    <script src="assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
    <script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/king-common.js"></script>

</body>

</html>
