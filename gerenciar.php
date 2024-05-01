<?php
// Incluindo o arquivo de conexão com o banco de dados
include('partials/conexao.php');

// Definindo o número de registros por página
$registros_por_pagina = 10;

// Verificando a página atual
if (isset($_GET['pagina'])) {
    $pagina_atual = $_GET['pagina'];
} else {
    $pagina_atual = 1;
}

// Calculando o offset para a consulta SQL
$offset = ($pagina_atual - 1) * $registros_por_pagina;

// Consulta SQL para buscar os alunos com paginação
$sql = "SELECT * FROM alunos LIMIT $offset, $registros_por_pagina";

// Executando a consulta
$resultado = mysqli_query($conn, $sql);

// Contando o número total de registros
$total_registros_sql = "SELECT COUNT(*) AS total_registros FROM alunos";
$total_registros_resultado = mysqli_query($conn, $total_registros_sql);
$total_registros_array = mysqli_fetch_assoc($total_registros_resultado);
$total_registros = $total_registros_array['total_registros'];

// Calculando o número total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Fechando a conexão
mysqli_close($conn);
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

											<div class="col-lg-12 grid-margin stretch-card">
											    <div class="card">
											        <div class="card-body">
											            <h4 class="card-title">Gerenciamento de Alunos</h4>
											            <p class="card-description">
											                Realize alterações nos cadastros de alunos.
											            </p>
											            <div class="table-responsive">
											                <table class="table table-hover">
											                    <thead>
											                        <tr>
											                            <th>Gerenciar</th>
											                            <th>Nome</th>
											                            <th>RG</th>
											                            <th>Status</th>
											                            <th>Telefone</th>
											                            <th>E-mail</th>
											                            <th>Plano</th>
											                            <th>Data do Cadastro</th>
											                        </tr>
											                    </thead>
											                    <tbody>
											                        <?php
											                        // Iterando sobre os resultados da consulta e preenchendo a tabela
											                        while ($row = mysqli_fetch_assoc($resultado)) {
											                            echo "<tr>";
											                            echo "<td><a href='editar_aluno.php?id=" . $row['id'] . "'><i class='icon-sm mdi mdi-tooltip-edit'></i></a></td>";
											                            echo "<td>" . $row['nome'] . "</td>";
											                            echo "<td>" . $row['rg'] . "</td>";
											                            echo "<td>" . $row['status'] . "</td>";
											                            echo "<td>" . $row['telefone'] . "</td>";
											                            echo "<td>" . $row['email'] . "</td>";
											                            echo "<td>" . $row['plano'] . "</td>";
											                            echo "<td>" . date('d-m-Y', strtotime($row['data_cadastro'])) . "</td>";
											                            echo "</tr>";
											                        }
											                        ?>
											                    </tbody>
															    <nav aria-label="Page navigation">
															        <ul class="pagination justify-content-center">
															            <li class="page-item <?php echo $pagina_atual == 1 ? 'disabled' : ''; ?>">
															                <a class="page-link" href="?pagina=<?php echo $pagina_atual - 1; ?>" aria-label="Anterior">
															                    <span aria-hidden="true">&laquo;</span>
															                </a>
															            </li>

															            <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
															                <li class="page-item <?php echo $pagina_atual == $i ? 'active' : ''; ?>">
															                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
															                </li>
															            <?php endfor; ?>

															            <li class="page-item <?php echo $pagina_atual == $total_paginas ? 'disabled' : ''; ?>">
															                <a class="page-link" href="?pagina=<?php echo $pagina_atual + 1; ?>" aria-label="Próxima">
															                    <span aria-hidden="true">&raquo;</span>
															                </a>
															            </li>
															        </ul>
															    </nav>
											                </table>
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
