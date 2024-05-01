<?php

include('partials/conexao.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $aluno_id = $_POST['aluno_id'];
    $estado_civil = $_POST['estado_civil'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $dia_pagamento = $_POST['dia_pagamento'];

    // Atualizar os dados do aluno no banco de dados
    $sql = "UPDATE alunos SET estado_civil = '$estado_civil', forma_pagamento = '$forma_pagamento', dia_pagamento = '$dia_pagamento' WHERE id = $aluno_id";

    // Executar a consulta
    if (mysqli_query($conn, $sql)) {
        $mensagem = "Dados atualizados com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar os dados: " . mysqli_error($conn);
    }

    // Fechar a conexão
    mysqli_close($conn);
}

if(isset($_GET['id'])) {
    $aluno_id = $_GET['id'];

    $sql = "SELECT * FROM alunos WHERE id = $aluno_id";

    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) > 0) {

        $aluno = mysqli_fetch_assoc($resultado);

        mysqli_close($conn);
    } else {
        header("Location: gerenciar.php");
        exit();
    }
} else {
    header("Location: gerenciar.php");
    exit();
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
                                                        <h4 class="card-title">Editar Aluno</h4>
                                                        <form class="form-sample" method="POST" action="atualizar_aluno.php">
                                                            <input type="hidden" name="aluno_id" value="<?php echo $aluno['id']; ?>">

                                                            <p class="card-description text-primary">
                                                                DADOS PESSOAIS
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Nome
                                                                            Completo</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="nome" value="<?php echo $aluno['nome']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">RG</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="rg" value="<?php echo $aluno['rg']; ?>" readonly>
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
                                                                            <select class="form-control" name="sexo" id="sexo">
                                                                                <option value="Masculino" <?php if ($aluno['sexo'] == "Masculino") echo "selected"; ?>>Masculino</option>
                                                                                <option value="Feminino" <?php if ($aluno['sexo'] == "Feminino") echo "selected"; ?>>Feminino</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Data de
                                                                            Nascimento</label>
                                                                        <div class="col-sm-9">
                                                                            <input class="form-control" type="text" id="data_cadastro" name="data_cadastro" value="<?php echo date('d-m-Y', strtotime($aluno['data_cadastro'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="estado_civil">Estado Civil</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="estado_civil" id="estado_civil">
                                                                                <option value="Solteiro(a)" <?php if ($aluno['estado_civil'] == "Solteiro(a)") echo "selected"; ?>>Solteiro(a)</option>
                                                                                <option value="Casado(a)" <?php if ($aluno['estado_civil'] == "Casado(a)") echo "selected"; ?>>Casado(a)</option>
                                                                                <option value="Divorciado(a)" <?php if ($aluno['estado_civil'] == "Divorciado(a)") echo "selected"; ?>>Divorciado(a)</option>
                                                                                <option value="Viúvo(a)" <?php if ($aluno['estado_civil'] == "Viúvo(a)") echo "selected"; ?>>Viúvo(a)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="status">Membro</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="status">
                                                                                <option value="Ativo" <?php if ($aluno['status'] == "Ativo") echo "selected"; ?>>Ativo</option>
                                                                                <option value="Visitante" <?php if ($aluno['status'] == "Visitante") echo "selected"; ?>>Visitante</option>
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
                                                                            <input type="text" class="form-control" name="endereco" value="<?php echo $aluno['endereco']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Bairro</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="bairro" value="<?php echo $aluno['bairro']; ?>">
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
                                                                            <input type="text" class="form-control" name="cep" value="<?php echo $aluno['cep']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Complemento</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="complemento" value="<?php echo $aluno['complemento']; ?>">
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
                                                                            <input type="text" class="form-control" name="cidade" value="<?php echo $aluno['cidade']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Nacionalidade</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="nacionalidade" value="<?php echo $aluno['nacionalidade']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">Telefone</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="telefone" value="<?php echo $aluno['telefone']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-sm-3 col-form-label">E-mail</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" name="email" value="<?php echo $aluno['email']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <p class="card-description text-primary">
                                                                DADOS DO PLANO
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label" for="plano">Plano</label>
                                                                        <div class="col-sm-9">
                                                                            <select class="form-control" name="plano">
                                                                                <option value="Mensal" <?php if ($aluno['plano'] == "Mensal") echo "selected"; ?>>Mensal</option>
                                                                                <option value="Trimestral" <?php if ($aluno['plano'] == "Trimestral") echo "selected"; ?>>Trimestral</option>
                                                                                <option value="Anual" <?php if ($aluno['plano'] == "Anual") echo "selected"; ?>>Anual</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        <button type="submit" class="btn btn-outline-primary btn-cadastrar me-2">Atualizar</button>
                                                        <a href="gerenciar.php" class="btn btn-outline-danger">Cancelar</a>
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
