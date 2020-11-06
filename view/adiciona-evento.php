<html>

<head>
	<?php
	require_once 'head.php';
	require_once "../model/Evento.php";
	require_once "../model/Categoria.php";
	require_once "../model/Estrutura.php";
	// require_once "../model/EventoDAO.php";
	// require_once "../model/CategoriaDAO.php";
	// require_once "../model/EstruturaDAO.php";
	?>

</head>
<body>
<?php
  require_once 'navbar2.php'
  ?>

<?php
// $categoriaDAO = new CategoriaDAO();
$categoria = new Categoria();
$estrutura = new Estrutura();
$categorias = $categoria->selectAll();
$estruturas = $estrutura->selectAll();
// $estruturaDAO = new EstruturaDAO();
?>

<div class="principal">
	<div class="container py-5">
		<div class="row">
			<div class="col-12 border bg-light">
				<font face="DancingScript" class="py-2 display-4">Adicionando Evento</font>
				<div class="conteudo flex-container bg-light" class="col-12">

					<form action="" method="POST" name="formReg" id="formId" enctype="multipart/form-data">
						<table class="table mx-5 py-5">
							<tr>
								<td class="byeBorder">Nome do Evento:</td>
								<td class="byeBorder"><input class="form-control" type="text" name="nome"></td>
							</tr>
							<tr>
								<td class="byeBorder">Data:</td>
								<td class="byeBorder"><input class="form-control" type="date" name="data"></td>
							</tr>
							<tr>
								<td class="byeBorder">Hora Inicial:</td>
								<td class="byeBorder"><input class="form-control" type="time" name="horai"></td>
							</tr>
							<tr>
								<td class="byeBorder">Hora Final:</td>
								<td class="byeBorder"><input class="form-control" type="time" name="horaf"></td>
							</tr>
							<tr>
								<td class="byeBorder">Localização:</td>
								<td class="byeBorder"><input class="form-control" type="text" name="localizacao"></td>
							</tr>
							<tr>
								<td class="byeBorder">Descrição:</td>
								<td class="byeBorder"> <textarea class="form-control" name="descricao"></textarea></td>
							</tr>
							<tr>
								<td class="byeBorder">Guarda-Volumes</td>
								<td class="byeBorder"><input type="radio" value="1" name="gv">Sim</td>
								<td class="byeBorder"><input type="radio" value="0" name="gv" checked>Não</td>
							</tr>
							<tr>
								<td class="byeBorder">Ingresso:</td>
								<td class="byeBorder"><input class="form-control" type="number" name="ingresso"></td>
							</tr>

							<tr>
								<td class="byeBorder" id="ce">Categoria<br>

									<?php foreach ($categorias as $categoria) : ?>
										<input type="checkbox" name="categoria[]" value="<?= $categoria->id ?>"><?= $categoria->nome ?><br>
									<?php endforeach; ?>
								</td>
								<td class="byeBorder">

								</td>

								<td class="byeBorder">Estrutura<br>

									<?php foreach ($estruturas as $estrutura) : ?>
										<input type="checkbox" name="estrutura[]" value="<?= $estrutura->id ?>"><?= $estrutura->nome ?><br>
									<?php endforeach; ?>
								</td>


							</tr>
							<td class="byeBorder">Foto:</td>
							<td class="byeBorder"><input type="file" name="arquivo"></td>

							<input type="hidden" name="max_file_size" value="200000">
							<td class="byeBorder"><input class="btn btn-success" type="submit" name="cadastrar" value="Submeter"></td>
							<td class="byeBorder"><a class="btn btn-primary" href="index.php">Voltar</a></td>


						</table>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>

</body>
<?php require_once '../controller/evento.php';
require_once 'footer.php'; ?>

</html>