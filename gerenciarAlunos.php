<?php
include_once('./includes/header.php');
include_once('./includes/config.php');

// Verifico a numeração da página.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Limitei a 10 registros por página.
$records_per_page = 10;

// Ponto de partida do SQL
$offset = ($page - 1) * $records_per_page;

// Consulto para obter a paginação.
$sql = "SELECT *, DATE_FORMAT(data_cadastro, '%d-%m-%Y') AS data_cadastro_formatada FROM alunos LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

if (isset($_GET['msg']) && !empty($_GET['msg'])) {
    // Exibe a mensagem
    echo "<div class='alert alert-success custom-alert' role='alert'>" . $_GET['msg'] . "</div>";
}

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
	<div id="wrapper" class="wrapper">
		<div id="main-content-wrapper" class="content-wrapper ">
			<div class="row">
				<div class="col-lg-4 ">
					<ul class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="#">Home</a></li>
						<li><a href="#">Gerenciar Alunos</a></li>
						<li class="active">Lista</li>
					</ul>
				</div>

			</div>
			<!-- CONTEUDO DA PAGINA -->
			<div class="content">
				<div class="main-header">
					<h2>Gerenciar Alunos</h2>
					<em>Gerencie as informações dos alunos da academia.</em>
				</div>
				<div class="main-content">

					<div class="widget widget-table">
						<div class="widget-header">
							<h3><i class="fa fa-table"></i> Lista de Alunos</h3>
						</div>
						<div class="widget-content">
							<div id="datatable-column-filter_wrapper" class="dataTables_wrapper form-inline no-footer">
								<table id="datatable-column-filter" class="table table-sorting table-striped table-hover datatable dataTable no-footer" role="grid" aria-describedby="datatable-column-filter_info">
									<thead>
										<tr role="row">
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 339px;">Gerenciar</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 339px;">Nome</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 397px;">RG</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 173px;">Endereço</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 173px;">Status</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 261px;">Whatsapp</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 304px;">E-mail</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-column-filter" rowspan="1" colspan="1" style="width: 304px;">Data de Cadastro</th>
										</tr>
									</thead>
									<tbody>

									<?php
									if ($result->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {

											// Valido o status se for INATIVO deixo em vermelho.
											$background_color = $row['status'] == 'ATIVO' ? 'greenyellow' : 'red';
											$color_fonte = $row['status'] == 'ATIVO' ? 'black' : 'white';
											echo "<tr>";
										    echo "<td>
										        <a href='editar.php?id=" . $row['id'] . "'>
										            <button class='btn btn-mini btn-info'><i class='fa fa-edit'></i></button>
										        </a>

										        <button class='btn btn-mini btn-danger' onclick='confirmDelete(" . $row['id'] . ")'><i class='fa fa-trash'></i></button> |
										        <a href='https://wa.me/55" . $row['whatsapp'] . "' target='_blank'>
										            <button class='btn btn-mini btn-success'><i class='fa fa-whatsapp'></i></button>
										        </a>

										        <button class='btn btn-mini btn-warning'><i class='fa fa-stethoscope'></i></button>
										    </td>";
											echo "<td>" . $row['nome'] . "</td>";
											echo "<td>" . $row['rg'] . "</td>";
											echo "<td>" . $row['endereco'] . "</td>";
											echo "<td style='background-color: $background_color; color: $color_fonte;'>" . $row['status'] . "</td>";
											echo "<td>" . $row['telefone'] . "</td>";
											echo "<td>" . $row['email'] . "</td>";
											echo "<td>" . $row['data_cadastro_formatada'] . "</td>";
											echo "</tr>";
										}
									} else {
										echo "<tr><td colspan='8'>Nenhum aluno encontrado</td></tr>";
									}
									?>

									</tbody>
								</table>
								<div class="row">
									<div class="col-sm-6">
										<div class="dataTables_info" id="datatable-column-filter_info" role="status" aria-live="polite">Mostrando 1 a <?php echo $result->num_rows; ?> de <?php echo $result->num_rows; ?> registros</div>
									</div>
									<div class="col-sm-6">
										<div class="dataTables_paginate paging_simple_numbers" id="datatable-column-filter_paginate">
											<ul class="pagination">
												<?php if ($page > 1) : ?>
													<li class="paginate_button previous" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_previous"><a href="?page=<?php echo ($page - 1); ?>">Anterior</a></li>
												<?php endif; ?>
												<?php if ($result->num_rows > $records_per_page * $page) : ?>
													<li class="paginate_button next" aria-controls="datatable-column-filter" tabindex="0" id="datatable-column-filter_next"><a href="?page=<?php echo ($page + 1); ?>">Próximo</a></li>
												<?php endif; ?>
											</ul>
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

	<!-- Javascript -->
	<script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.js"></script>
	<script src="assets/js/plugins/modernizr/modernizr.js"></script>
	<script src="assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
	<script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/king-common.js"></script>

	<script>
	    function confirmDelete(id) {
	        if (confirm("Tem certeza que deseja deletar este aluno?")) {
	            window.location.href = "delete_aluno.php?id=" + id;
	        }
	    }
	</script>

</body>

</html>
