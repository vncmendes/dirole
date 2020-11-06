<?php

	require_once "../model/Evento.php";
	require_once '../controller/evento.php';
	$eventos = $evento->selectAll();

	?>

<html>

<head>
	<?php

	require_once 'head.php';


	?>
</head>

<body>

	<?php require_once 'navbar2.php' ?>

	<div class="principal" style="padding: 3%">
		<?php foreach ($eventos as $evento) :
			// $registra_eventocategoria = $evento->listaEventoCategoria($evento->id);
			// $registra_eventoestrutura = $evento->listaEventoEstrutura($evento->id);
			?>

			<div class="flex-container">
				<table class="table table-striped table-bordered">
					<tr>
						<td>Nome: <?= $evento->nome ?></td>
						<td>Data: <?= $evento->data ?></td>
						<td>Hora Inicial: <?= $evento->horainicial ?></td>
						<td>Hora Final: <?= $evento->horafinal ?></td>
						<td>Localizacão: <?= $evento->localizacao ?></td>
						<td>Descrição: <?= $evento->descricao ?></td>
						<td>Guarda-Volumes: <?= $evento->gv ?></td>
						<td>Ingresso: <?= $evento->ingresso ?></td>
						<td>Categoria: <?php
															foreach ($registra_eventocategoria as $categoria) :
																echo $categoria->nome ?>
							<?php endforeach; ?>
						</td>
						<td>Estrutura: <?php
															foreach ($registra_eventoestrutura as $estrutura) :
																echo $estrutura->nome ?>
							<?php endforeach; ?>
						</td>
						<td>Arquivo: <img src="/images/<?= $evento->arquivo ?>"></img></td>

						<td>
							<form action="altera-evento.php" method="post">
								<input type="hidden" name="id" value="<?= $evento->id ?>">
								<button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
							</form>
							<form action="../controller/evento.php" method="post">
								<input type="hidden" name="idE" value="<?= $evento->id ?>">
								<button class="btn btn-warning" type="submit" name="remover">Remover</button>
							</form>
							<a href="index.php" class="btn btn-dark">Voltar</a>
						</td>

					</tr>
				</table>
			</div>
		<?php
		endforeach;
		?>

	<?php include_once 'footer.php' ?>	

</body>