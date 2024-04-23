<?php
include_once('includes/header.php');
include_once('includes/config.php');

/*
// Consulta SQL para obter informações sobre os últimos cadastros de alunos ativos
$sql = "SELECT nome, data_cadastro, plano, foto FROM alunos WHERE status = 'ativo' ORDER BY data_cadastro DESC LIMIT 5";

// Executar a consulta SQL e armazenar os resultados em $result
$result = $conn->query($sql);

$result = $conn->query($sql);

if (!$result) {
	die("Erro na consulta SQL: " . $conn->error);
}

$sql = "SELECT nome, rg, profissao, sexo, data_nascimento, nacionalidade, estado_civil, email, telefone, endereco, bairro, cep, estado, cidade, plano, dia_vencimento, forma_pagamento, foto, data_cadastro FROM alunos";
*/

?>


<!DOCTYPE html>
<html lang="pt-br" class="no-js">

<head>
	<title>Projeto Integrador - Caio Westphalen RA22202420</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="KingAdmin - Bootstrap Admin Dashboard Theme">
	<meta name="author" content="The Develovers">
	<!-- CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/main.css" rel="stylesheet" type="text/css">
	<link href="assets/css/my-custom-styles.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="assets/ico/favicon.png">
</head>

<body class="sidebar-fixed topnav-fixed dashboard">
	<!-- WRAPPER -->
	<div id="wrapper" class="wrapper">


		<div id="main-content-wrapper" class="content-wrapper ">
			<!-- ALERT -->
			<div class="alert alert-danger top-general-alert">
				<span>Este painel é um modelo de estudo do Projeto Integrador do UniDomBosco - Analise e Desenvolvimento
					de Sistemas - Caio Westphalen</span>
				<button type="button" class="close">&times;</button>
			</div>
			<!-- FIM ALERT -->




			<div class="row">
				<div class="col-md-4 ">
					<ul class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="#">Home</a></li>
						<li class="active">Painel de Controle</li>
					</ul>
				</div>
				<div class="col-md-8 ">
					<div class="top-content">
						<!-- COLOCAR ITENS NO TOPO DIREITO -->
					</div>
				</div>
			</div>



			<div class="content">
				<div class="main-header">
					<h2>Painel de Controle</h2>
				</div>

				<!-- INICIO INFORMAÇÕES INDEX -->
				<div class="main-content">
					<div class="row">


						<div class="col-md-9">
							<!-- INFORMAÇÃO INICIAL -->
						</div>



						<div class="col-md-3">
							<!-- INFORMAÇÃO FINAL 12 GRID-->
						</div>

					</div>



					<div class="row">
						<div class="col-md-6">
							<div class="widget">
								<div class="widget-header">
									<h3><i class="fa fa-user"></i> Alunos ativos</h3>

									<div class="btn-group widget-header-toolbar">
										<a href="#" title="Expand/Collapse" class="btn-borderless btn-toggle-expand"><i class="fa fa-chevron-up"></i></a>
									</div>
								</div>
								<div class="widget-content">

									<div class="chart-content">
										<!-- COLOCAR CONTEUDO AQUI -->
										<div class="row">
											<div class="col-md-6">
												<div class="contextual-summary-info">
													<i class="fa fa-users"></i>
													<p class="pull-right"><span>Alunos</span> 235</p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="contextual-summary-info">
													<i class="fa fa-tags"></i>
													<p class="pull-right"><span>Planos</span> 135</p>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-6">
							<div class="widget widget-table">
								<div class="widget-header">
									<h3><i class="fa fa-calendar"></i> Últimos Cadastros</h3>
								</div>
								<div class="widget-content">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center"><i class="fa fa-cog"></i></th>
												<th>Aluno(a)</th>
												<th>Data</th>
												<th>Plano</th>
											</tr>
										</thead>
										<tbody>

										</tbody>

									</table>
								</div>
							</div>
						</div>



					</div>

					<div class="col">
						<div class="widget widget-table">
							<div class="widget-header">
								<h3><i class="fa fa-money"></i> Mensalidades a vencer</h3>
							</div>
							<div class="widget-content">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Aluno</th>
											<th>Plano</th>
											<th>Data do Vencimento</th>
											<th>Dias Vencidos</th>
											<th>Último Valor Pago</th>
											<th><i class="fa fa-cog"></i></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Steve</td>
											<td>Infinity</td>
											<td>18/03/2024</td>
											<td>152 dias</td>
											<td>R$ 189,90</td>
											<td><button type="button" class="btn btn-success btn-xs"><i class="fa fa-money"></i> Renovar</button></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>













				</div>
				<!-- FIM INFORMAÇÕES INDEX -->
			</div>
		</div>
	</div>

	<!-- Javascript -->
	<script>
		$(document).ready(function() {
			$(".open-modal").click(function() {
				var imgSrc = $(this).data("img");
				$("#modalImg").attr("src", imgSrc);
				$("#myModal").css("display", "block");
			});

			$(".close").click(function() {
				$("#myModal").css("display", "none");
			});
		});
	</script>


	<script src="./assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="./assets/js/bootstrap/bootstrap.js"></script>
	<script src="./assets/js/plugins/modernizr/modernizr.js"></script>
	<script src="./assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
	<script src="./assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="./assets/js/king-common.js"></script>
	<script src="./assets/js/plugins/stat/jquery.easypiechart.min.js"></script>
	<script src="./assets/js/plugins/raphael/raphael-2.1.0.min.js"></script>
	<script src="./assets/js/plugins/stat/flot/jquery.flot.min.js"></script>
	<script src="./assets/js/plugins/stat/flot/jquery.flot.resize.min.js"></script>
	<script src="./assets/js/plugins/stat/flot/jquery.flot.time.min.js"></script>
	<script src="./assets/js/plugins/stat/flot/jquery.flot.pie.min.js"></script>
	<script src="./assets/js/plugins/stat/flot/jquery.flot.tooltip.min.js"></script>
	<script src="./assets/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
	<script src="./assets/js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="./assets/js/plugins/datatable/dataTables.bootstrap.js"></script>
	<script src="./assets/js/plugins/jquery-mapael/jquery.mapael.js"></script>
	<script src="./assets/js/plugins/raphael/maps/usa_states.js"></script>
	<script src="./assets/js/king-chart-stat.js"></script>
	<script src="./assets/js/king-table.js"></script>
	<script src="./assets/js/king-components.js"></script>
</body>

</html>