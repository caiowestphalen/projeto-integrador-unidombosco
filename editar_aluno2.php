<?php

include('partials/conexao.php');

// Verificar se o parâmetro 'id' foi passado na URL
if(isset($_GET['id'])) {
    // Obter o ID do aluno a ser editado
    $aluno_id = $_GET['id'];

    // Consulta SQL para selecionar os dados do aluno com o ID especificado
    $sql = "SELECT * FROM alunos WHERE id = $aluno_id";

    // Executar a consulta
    $resultado = mysqli_query($conn, $sql);

    // Verificar se o aluno com o ID especificado existe
    if(mysqli_num_rows($resultado) > 0) {
        // Obter os dados do aluno da consulta
        $aluno = mysqli_fetch_assoc($resultado);

        // Fechar a conexão
        mysqli_close($conn);
    } else {
        // Redirecionar de volta para a página de gerenciamento de alunos se o aluno não for encontrado
        header("Location: gerenciar.php");
        exit();
    }
} else {
    // Redirecionar de volta para a página de gerenciamento de alunos se o parâmetro 'id' não for fornecido
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
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Painel modelo para Projeto Integrador Analise e Desenvolvimento de Sistema - UniDomBosco</p>
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
                                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                                <div class="row">
                                                    <!-- CONTEUDOS DA PAGINA AQUI -->
                                                    <div class="col-12 grid-margin">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h4 class="card-title">Editar Aluno</h4>
                                                                    <form class="form-sample" method="POST" action="atualizar_aluno.php">
                                                                        <input type="hidden" name="aluno_id" value="<?php echo $aluno['id']; ?>">
                                                                        


                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="nome">Nome:</label>
                                                                                    <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $aluno['nome']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="rg">RG:</label>
                                                                                    <input class="form-control" type="text" id="rg" name="rg" value="<?php echo $aluno['rg']; ?>" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="status">Status:</label>
                                                                                        <select class="form-control" id="status" name="status">
                                                                                            <option value="Ativo" <?php if ($aluno['status'] == "Ativo") echo "selected"; ?>>ATIVO</option>
                                                                                            <option value="Visitante" <?php if ($aluno['status'] == "Visitante") echo "selected"; ?>>VISITANTE</option>
                                                                                        </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="plano">Plano:</label>
                                                                                        <select class="form-control" id="plano" name="plano">
                                                                                            <option value="Mensal" <?php if ($aluno['plano'] == "Mensal") echo "selected"; ?>>MENSAL</option>
                                                                                            <option value="Trimestral" <?php if ($aluno['plano'] == "Trimestral") echo "selected"; ?>>TRIMESTRAL</option>
                                                                                            <option value="Anual" <?php if ($aluno['plano'] == "Anual") echo "selected"; ?>>ANUAL</option>
                                                                                        </select>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="email">E-mail:</label>
                                                                                    <input class="form-control" type="email" id="email" name="email" value="<?php echo $aluno['email']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="telefone">Telefone:</label>
                                                                                    <input class="form-control" type="text" id="telefone" name="telefone" value="<?php echo $aluno['telefone']; ?>">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group row">
                                                                                    <div>
                                                                                        <label for="data_cadastro">Data de Cadastro:</label>
                                                                                        <input class="form-control" type="text" id="data_cadastro" name="data_cadastro" value="<?php echo date('d-m-Y', strtotime($aluno['data_cadastro'])); ?>" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                            <div class="form-group row">
                                                                                <div>
                                                                                    <label for="email">Endereço:</label>
                                                                                    <input class="form-control" type="endereco" id="endereco" name="endereco" value="<?php echo $aluno['endereco']; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        </div>

                                                                        
                                                                        <button type="submit" class="btn btn-outline-primary btn-cadastrar me-2">Atualizar</button>
                                                                        <button class="btn btn-light">Cancelar</button>
                                                                    </form>
                                                </div>
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
