<?php
include('partials/conexao.php');


// Defino as variaveis que vão armazenar os dados
$nome = $rg = $data_nascimento = $sexo = $estado_civil = $status = $endereco = $cep = $bairro = $cidade = $complemento = $nacionalidade = $telefone = $email = $data_cadastro = $forma_pagamento = $plano = $dia_pagamento = "";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupero as informações via POST
    $nome = $_POST["nome"];
    $rg = $_POST["rg"];
    $data_nascimento = $_POST["data_nascimento"];
    $sexo = $_POST["sexo"];
    $estado_civil = $_POST["estado_civil"];
    $status = $_POST["status"];
    $endereco = $_POST["endereco"];
    $cep = $_POST["cep"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];
    $complemento = $_POST["complemento"];
    $nacionalidade = $_POST["nacionalidade"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $data_cadastro = date("Y-m-d");
    $forma_pagamento = $_POST["forma_pagamento"];
    $plano = $_POST["plano"];
    $dia_pagamento = $_POST['dia_pagamento'];

    // Alimento com os dados do painel no SQL
    $sql = "INSERT INTO alunos (nome, rg, data_nascimento, sexo, estado_civil, status, endereco, cep, bairro, cidade, complemento, nacionalidade, telefone, email, data_cadastro, forma_pagamento, plano, dia_pagamento) 
            VALUES ('$nome', '$rg', '$data_nascimento', '$sexo', '$estado_civil', '$status', '$endereco', '$cep', '$bairro', '$cidade', '$complemento', '$nacionalidade', '$telefone', '$email', '$data_cadastro', '$forma_pagamento', '$plano', '$dia_pagamento')";

    if (mysqli_query($conn, $sql)) {
        $mensagem = "Aluno cadastrado com sucesso.";
    } else {
        $mensagem = "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Projeto Integrador - Caio Westphalen</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="js/select.dataTables.min.css">
    <!-- End plugin -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />

</head>

<body>
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
            <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                <div class="ps-lg-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium me-3 buy-now-text">Painel modelo para Projeto Integrador
                            Analise e Desenvolvimento de Sistema - UniDomBosco</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('partials/_navbar.php')?> <!-- BARRA TOPO -->

    <div class="container-fluid page-body-wrapper">
        <?php include('partials/_sidebar.php')?> <!-- MENU -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-tab">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <!-- DIVISOR -->
                            </div>


                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                    aria-labelledby="overview">
                                    <div class="row">
                                        <!-- CONTEUDOS DA PAGINA AQUI -->
                                        <?php if (!empty($mensagem)): ?>
                                            <div class="alert alert-primary" role="alert">
                                                <?php echo $mensagem; ?>
                                            </div>
                                        <?php endif; ?>

                                            <div class="col-12 grid-margin">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Cadastro do Aluno</h4>
                                                        <form class="form-sample" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                                            <p class="card-description text-primary">
                                                                DADOS PESSOAIS
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Nome
                                                                            Completo</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="nome">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">RG</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="rg">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Sexo</label>
                                                                        <div class="col-sm-9" for="sexo">
                                                                            <select class="form-control" name="sexo">
                                                                                <option>Masculino</option>
                                                                                <option>Feminino</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Data de
                                                                            Nascimento</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="data_nascimento">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="estado_civil">Estado
                                                                            Civil</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="estado_civil">
                                                                                <option>Solteiro(a)</option>
                                                                                <option>Casado(a)</option>
                                                                                <option>Divorciado(a)</option>
                                                                                <option>Viúvo(a)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="status">Membro</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="status">
                                                                                <option>Ativo</option>
                                                                                <option>Visitante</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <p class="card-description text-primary">
                                                                DADOS DE CONTATO
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Endereço
                                                                        </label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="endereco">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Bairro</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="bairro">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">CEP</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="cep">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Complemento</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="complemento">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Cidade</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="cidade">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Nacionalidade</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="nacionalidade">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Telefone</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="telefone">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">E-mail</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="email">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <p class="card-description text-primary">
                                                                DADOS DE PAGAMENTO
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="plano">Plano</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="plano">
                                                                                <option>Mensal</option>
                                                                                <option>Trimestral</option>
                                                                                <option>Anual</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="forma_pagamento">Forma</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="forma_pagamento">
                                                                                <option>PIX</option>
                                                                                <option>Cartão de Crédito</option>
                                                                                <option>Dinheiro</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="dia_pagamento">Dia</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="dia_pagamento">
                                                                                <?php
                                                                                for ($i = 1; $i <= 31; $i++) {
                                                                                    echo "<option value='$i'>$i</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <button type="submit" class="btn btn-outline-primary btn-cadastrar me-2">Cadastrar</button>
                                                        <button class="btn btn-light">Cancelar</button>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>

                                        
                                        <!-- FIM DOS CONTEUDOS -->
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>