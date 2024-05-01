<?php
include('partials/conexao.php');

// Consulta SQL para contar o número total de cadastros na tabela alunos
$sql_total_alunos = "SELECT COUNT(*) AS total_alunos FROM alunos";
$resultado_total_alunos = mysqli_query($conn, $sql_total_alunos);
$total_alunos = 0;

if (mysqli_num_rows($resultado_total_alunos) > 0) {
    $row = mysqli_fetch_assoc($resultado_total_alunos);
    $total_alunos = $row['total_alunos'];
}

mysqli_free_result($resultado_total_alunos);

// Consulta SQL para contar o número de cadastros com status "Ativo"
$sql_total_ativos = "SELECT COUNT(*) AS total_ativos FROM alunos WHERE status = 'Ativo'";
$resultado_total_ativos = mysqli_query($conn, $sql_total_ativos);
$total_ativos = 0;

if (mysqli_num_rows($resultado_total_ativos) > 0) {
    $row = mysqli_fetch_assoc($resultado_total_ativos);
    $total_ativos = $row['total_ativos'];
}

mysqli_free_result($resultado_total_ativos);

// Consulta SQL para contar o número de cadastros com status "Visitante"
$sql_total_visitantes = "SELECT COUNT(*) AS total_visitantes FROM alunos WHERE status = 'Visitante'";
$resultado_total_visitantes = mysqli_query($conn, $sql_total_visitantes);
$total_visitantes = 0;

if (mysqli_num_rows($resultado_total_visitantes) > 0) {
    $row = mysqli_fetch_assoc($resultado_total_visitantes);
    $total_visitantes = $row['total_visitantes'];
}

mysqli_free_result($resultado_total_visitantes);

// Consulta SQL para obter os últimos 5 cadastros
$sql_ultimos_cadastros = "SELECT * FROM alunos ORDER BY id DESC LIMIT 5";
$resultado_ultimos_cadastros = mysqli_query($conn, $sql_ultimos_cadastros);
$ultimos_cadastros = array();

if (mysqli_num_rows($resultado_ultimos_cadastros) > 0) {
    while ($row = mysqli_fetch_assoc($resultado_ultimos_cadastros)) {
        $ultimos_cadastros[] = $row;
    }
}

mysqli_free_result($resultado_ultimos_cadastros);

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


                                            <div class="row flex-grow">

                                                <!-- ULTIMOS CADASTROS -->
                                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body card-rounded">
                                                            <h4 class="card-title  card-title-dash">Últimos Cadastros</h4>
                                                            <div class="wrapper w-100">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Aluno</th>
                                                                                <th>Data</th>
                                                                                <th>Plano</th>
                                                                                <th>Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                          <?php foreach ($ultimos_cadastros as $cadastro) { ?>
                                                                              <tr>
                                                                                  <td><?php echo $cadastro['nome']; ?></td>
                                                                                  <td><?php echo date('d/m/Y', strtotime($cadastro['data_cadastro'])); ?></td>
                                                                                  <?php if ($cadastro['status'] === 'Visitante') { ?>
                                                                                      <td> ------ </td>
                                                                                      <td><label class="badge badge-danger"><?php echo $cadastro['status']; ?></label></td>
                                                                                  <?php } else { ?>
                                                                                      <td><?php echo $cadastro['plano']; ?></td>
                                                                                      <td><label class="badge badge-success"><?php echo $cadastro['status']; ?></label></td>
                                                                                  <?php } ?>
                                                                              </tr>
                                                                          <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- ALUNOS ATIVOS -->
                                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body card-rounded">
                                                            <h4 class="card-title  card-title-dash">Alunos Ativos</h4>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="wrapper w-100">
                                                                        <i class="icon-lg mdi mdi-account-check"></i>
                                                                        <h1><?php echo $total_alunos; ?></h1>
                                                                        <h4> Alunos</h4>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="wrapper w-100">
                                                                        <i class="icon-lg mdi mdi-account-card-details"></i>
                                                                        <h1><?php echo $total_ativos; ?></h1>
                                                                        <h4> Planos</h4>
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="wrapper w-100">
                                                                        <i class="icon-lg mdi mdi-account-multiple"></i>
                                                                        <h1><?php echo $total_visitantes; ?></h1>
                                                                        <h4> Visitantes</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                            <!-- CONTROLE DE ENTRADA E AGENDAMENTO -->
                                            <div class="row flex-grow">
                                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                  <div class="card card-rounded">
                                                    <div class="card-body card-rounded">
                                                      <h4 class="card-title  card-title-dash">Agendamentos</h4>
                                                      <div class="list align-items-center border-bottom py-2">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-2 font-weight-medium">
                                                            Ministração de Muay Thai
                                                          </p>
                                                          <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                              <i class="mdi mdi-calendar text-muted me-1"></i>
                                                              <p class="mb-0 text-small text-muted">14/04/2024</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="list align-items-center border-bottom py-2">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-2 font-weight-medium">
                                                            Exame de Faixa Jiu Jitsu
                                                          </p>
                                                          <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                              <i class="mdi mdi-calendar text-muted me-1"></i>
                                                              <p class="mb-0 text-small text-muted">15/04/2024</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="list align-items-center border-bottom py-2">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-2 font-weight-medium">
                                                            Zumba Terceira Idade
                                                          </p>
                                                          <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                              <i class="mdi mdi-calendar text-muted me-1"></i>
                                                              <p class="mb-0 text-small text-muted">16/04/2024</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="list align-items-center border-bottom py-2">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-2 font-weight-medium">
                                                            Palestra Personal Trainer
                                                          </p>
                                                          <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                              <i class="mdi mdi-calendar text-muted me-1"></i>
                                                              <p class="mb-0 text-small text-muted">17/04/2024</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    
                                                      <div class="list align-items-center pt-3">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-0">
                                                            <a href="#" class="fw-bold text-primary">Ver mais <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                          </p>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>



                                                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                                                  <div class="card card-rounded">
                                                    <div class="card-body">
                                                      <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <h4 class="card-title card-title-dash">Controle de Acesso</h4>
                                                        <p class="mb-0">Entrada / Saída</p>
                                                      </div>
                                                      <ul class="bullet-line-list">
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Helena</span> acessou com a biometria</div>
                                                            <p>Agora</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Pedro</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">José</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Kátia</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Thais</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Jessica</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                        <li>
                                                          <div class="d-flex justify-content-between">
                                                            <div><span class="text-light-green">Cleber</span> acessou com a biometria</div>
                                                            <p>1h</p>
                                                          </div>
                                                        </li>
                                                      </ul>
                                                      <div class="list align-items-center pt-3">
                                                        <div class="wrapper w-100">
                                                          <p class="mb-0">
                                                            <a href="#" class="fw-bold text-primary">Ver mais <i class="mdi mdi-arrow-right ms-2"></i></a>
                                                          </p>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            <!-- FIM CONTROLE DE ENTRADA E AGENDAMENTO -->

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
