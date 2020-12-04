<?php
session_start();
require_once "../model/Evento.php";
require_once "../model/Categoria.php";
require_once "../model/Estrutura.php";
require_once "../controller/evento.php";
$categoria = new Categoria();
$estrutura = new Estrutura();
$categorias = $categoria->selectAll();
$estruturas = $estrutura->selectAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php
	require_once 'head.php';
	?>
</head>

<body>
	<header id="main1-header">
		<div class="content2">
			<nav>
				<ul>
					<li>
						<a href="eventos.php" class="nodecore1 navlinks1">Eventos</a>
					</li>
					<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
						<li>
							<a href="lista-evento.php" class="nodecore1 navlinks1">Todos Eventos</a>
						</li>
						<li>
							<a href='lista-usuario.php' class='nodecore1 navlinks1'>Lista Usuários</a>
						</li>
					<?php } ?>
					<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) { ?>
						<li>
							<a href="lista-evento.php" class="nodecore1 navlinks1">Meus Eventos</a>
						</li>
					<?php } ?>
					<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
						<li>
							<a href="perfil.php" class="nodecore1 navlinks1">Perfil</a>
						</li>
					<?php } ?>
					<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
						<li>
							<a href="perfilAdm.php" class="nodecore1 navlinks1">Perfil</a>
						</li>
					<?php } else { ?>
						<li>
							<a href="perfilP.php" class="nodecore1 navlinks1">Perfil</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
			<!-- <img class="navicons" src="images/logo.svg" alt="" /> -->
			<div>
				<h1><a class="dirole1" href="index.php">DiRolê</a></h1>
			</div>
			<div class="side1">
				<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
					<a href="perfil.php">
						<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
					</a>
				<?php } ?>

				<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) { ?>
					<a href="perfilP.php">
						<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
					</a>
				<?php } ?>

				<?php if (isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
					<a href="perfilAdm.php">
						<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
					</a>
				<?php } ?>

				<form style="margin: 0" ; method="POST" action="pesquisa.php">
					<input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
				</form>
				<?php if (isset($_SESSION['logado'])) { ?>
					<a href="logout.php" class="nodecore1 navlinks1">Sair</a>
				<?php } ?>
			</div>
		</div>
	</header>



	<div class="principal">
		<div style="max-width: 800px" class="container py-5">
			<div class="row">
				<div class="col-12 border bg-light">
					<font face="DancingScript" class="py-2 display-4">Adicionando Evento</font>
					<div class="conteudo flex-container bg-light" class="col-12">

						<form action="" method="POST" name="formReg" id="formId" enctype="multipart/form-data">
							<table class="mx-5 py-5">
								<tr class="mx-5 py-5">
									<td class="byeBorder py-1"><b>Nome do Evento</b>:</td>
									<td class="byeBorder py-1"><input class="form-control" type="text" name="nome"></td>
								</tr>
								<tr class="mx-5 py-5">
									<td class="byeBorder py-1"><b>Data</b>:</td>
									<td class="byeBorder py-1"><input class="form-control" type="date" max="2999-12-31" name="data"></td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Hora Inicial</b>:</td>
									<td class="byeBorder py-1"><input class="form-control" type="time" name="horai"></td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Hora Final</b>:</td>
									<td class="byeBorder py-1"><input class="form-control" type="time" name="horaf"></td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Localização</b>:</td>
									<td class="byeBorder py-1"><input class="form-control" type="text" name="localizacao"></td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Descrição</b>:</td>
									<td class="byeBorder py-1"> <textarea class="form-control" name="descricao"></textarea></td>
								</tr>
								<tr>
									<td class="byeBorder py-2"><b>Guarda-Volumes</b></td>
									<td class="byeBorder py-2"><input type="radio" value="1" name="gv">Sim <input type="radio" value="0" name="gv" checked>Não</td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Ingresso</b>:</td>
									<td class="byeBorder"><input class="form-control" type="number" name="ingresso"></td>
								</tr>

								<tr>
									<td class="byeBorder py-1" id="ce"><b>Categoria</b><br>
										<?php foreach ($categorias as $categoria) : ?>
											<input type="checkbox" name="categoria[]" value="<?= $categoria->id ?>"><?= $categoria->nome ?><br>
										<?php endforeach; ?>
									</td>
									<td class="byeBorder py-1"></td>

									<td class="byeBorder py-1"><b>Estrutura</b><br>
										<?php foreach ($estruturas as $estrutura) : ?>
											<input type="checkbox" name="estrutura[]" value="<?= $estrutura->id ?>"><?= $estrutura->nome ?><br>
										<?php endforeach; ?>
									</td>
								</tr>
								<tr>
									<td class="byeBorder py-1"><b>Foto:</td>
									<td class="byeBorder py-1"><input type="file" name="arquivo"></td>
								</tr>

								<input type="hidden" name="max_file_size" value="200000">
								<td class="byeBorder py-3"><input class="btn btn-success" type="submit" name="cadastrarEvento" value="Submeter"></td>
								<td class="byeBorder py-3"><a class="btn btn-primary" href="index.php">Voltar</a></td>

							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script> -->
	<!-- < ?php require_once '../controller/evento.php'; -->
	<?php require_once 'footer.php'; ?>
</body>

</html>