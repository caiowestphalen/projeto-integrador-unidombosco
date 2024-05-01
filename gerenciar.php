<?php
include('partials/conexao.php');

$registros_por_pagina = 10;

if (isset($_GET['pagina'])) {
    $pagina_atual = $_GET['pagina'];
} else {
    $pagina_atual = 1;
}

$offset = ($pagina_atual - 1) * $registros_por_pagina;

$sql = "SELECT * FROM alunos LIMIT $offset, $registros_por_pagina";

$resultado = mysqli_query($conn, $sql);

$total_registros_sql = "SELECT COUNT(*) AS total_registros FROM alunos";
$total_registros_resultado = mysqli_query($conn, $total_registros_sql);
$total_registros_array = mysqli_fetch_assoc($total_registros_resultado);
$total_registros = $total_registros_array['total_registros'];

$total_paginas = ceil($total_registros / $registros_por_pagina);

mysqli_close($conn);

session_start();

if (isset($_SESSION['mensagemSucesso'])) {

    $mensagemSucesso = $_SESSION['mensagemSucesso'];
    
    unset($_SESSION['mensagemSucesso']);
} else {

    $mensagemSucesso = '';
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
    
    <style>
    	.icon-wrapper {
		    margin-right: 5px;
		}

		.icon-wrapper a {
		    text-decoration: none;
		    color: inherit;
		}

    </style>

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
						        <?php if (!empty($mensagemSucesso)) : ?>
						            <div class="alert alert-success alert-dismissible fade show" role="alert">
						                <?php echo $mensagemSucesso; ?>
						            </div>
						        <?php endif; ?>


                                <div class="tab-content tab-content-basic">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                            <!-- CONTEUDOS DA PAGINA AQUI -->

											<div class="col-lg-12 grid-margin stretch-card">
											    <div class="card">
											        <div class="card-body">
											            <h4 class="card-title">Gerenciamento de Alunos</h4>
											            <p class="card-description">
											                Realize alterações nos cadastros de alunos. Clique nos icones para determinadas ações.
											            </p>
											            <div class="table-responsive">
											                <table class="table table-hover">
											                    <thead>
											                        <tr>
											                            <th>Gerenciar</th>
											                            <th>Matricula</th>
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
																        while ($row = mysqli_fetch_assoc($resultado)) {
																            echo "<tr>";
																            echo "<td>"; // Início da coluna "Gerenciar"
																            echo "<span class='icon-wrapper text-info'><a href='editar_aluno.php?id=" . $row['id'] . "' title='Aqui você consegue editar os dados do aluno.'><i class='icon-sm mdi mdi-tooltip-edit'></i></a></span>"; // Editar
																            echo "<span class='icon-wrapper text-success'><a href='https://wa.me/55" . $row['telefone'] . "' target='_blank'title='Envie uma mensagem direta no whatsapp do aluno.'><i class='icon-sm mdi mdi-whatsapp'></i></a></span>"; // WhatsApp
																            echo "<span class='icon-wrapper text-warning'><a href='mailto:" . $row['email'] . "'><i class='icon-sm mdi mdi-email'title='Envie um e-mail para o aluno.'></i></a></span>"; // Email
																            echo "<a onclick='confirmarExclusao(" . $row['id'] . ")' title='Excluir o aluno.' class='text-danger' style='cursor: pointer;'><i class='icon-sm mdi mdi-delete'></i></a>"; // Excluir
																            echo "</td>"; // Fim da coluna "Gerenciar"
																            echo "<td>" . $row['id'] . "</td>";
																            echo "<td>" . $row['nome'] . "</td>";
																            echo "<td>" . $row['rg'] . "</td>";
																            $status = $row['status'];
																            $status_class = ($status == 'Visitante') ? 'text-danger fw-bold' : 'text-success fw-bold';
																            echo "<td class='$status_class'>$status</td>";
																            echo "<td>" . $row['telefone'] . "</td>";
																            echo "<td>" . $row['email'] . "</td>";
																            echo "<td>" . ($status == 'Visitante' ? '-----' : $row['plano']) . "</td>";
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
	<script>
	    function confirmarExclusao(aluno_id) {
	        if (confirm("Tem certeza de que deseja excluir este aluno?")) {
	            window.location.href = "excluir_aluno.php?id=" + aluno_id;
	        }
	    }
	</script>

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
