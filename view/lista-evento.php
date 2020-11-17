<?php
	session_start();
	require_once "../model/Evento.php";
	require_once '../controller/evento.php';
	$todosEventos = $eventos->selectAllWithIdProv();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php
		require_once 'head.php';
	?>
</head>

<body>

<?php require_once 'navbar2.php' ?>

<section class="eventcards">
	<div class="eventcardscontent">
		<?php foreach ($todosEventos as $evento) :
		$registra_eventocategoria = $eventos->listaEventoCategoria($evento->id);
		$registra_eventoestrutura = $eventos->listaEventoEstrutura($evento->id);
		?>

		<div class="cardsMy">
			<a href="#">
				<ul>
					<div class="cardimage">
						<!-- <li><img src="/images/< ?= $evento->arquivo ?>"></li> // mais ou menos certo -->
						<li><img src="images/01.jpg" alt=""></li>
					</div>

					<div class="cardinfoMy">
							<li>Nome: <?= $evento->nome ?></li>
							<li>Data: <?= $evento->data ?></li>
							<li>Hora Inicial: <?= $evento->horainicial ?></li>
							<li>Hora Final: <?= $evento->horafinal ?></li>
							<li>Localizacão: <?= $evento->localizacao ?></li>
							<li>Descrição: <?= $evento->descricao ?></li>
							<li>Guarda-Volumes: <?= $evento->gv ?></li>
							<li>Ingresso: <?= $evento->ingresso ?></li>
							<li>Categoria: 
								<?php
									foreach ($registra_eventocategoria as $categoria) :
										echo $categoria->nome ?>
								<?php endforeach; ?>
							</li>
							<li>Estrutura: 
								<?php
									foreach ($registra_eventoestrutura as $estrutura) :
										echo $estrutura->nome ?>
								<?php endforeach; ?>
							</li>

							<!-- <li>Arquivo:<img src="/images/< ?= $evento->arquivo ?>"></img></li> -->

							<div class="break">
								<li style="padding: 3% 5% 0 0">
									<form action="altera-evento.php" method="post">
										<input type="hidden" name="id" value="<?= $evento->id ?>">
										<button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
									</form>
								</li>
								<li style="padding: 3% 5% 0 0">
									<form action="../controller/evento.php" method="post">
										<input type="hidden" name="idE" value="<?= $evento->id ?>">
										<button class="btn btn-warning" type="submit" name="remover">Remover</button>
									</form>
								</li>
								<li style="padding: 3% 5% 0 0">
									<span href="index.php" class="btn btn-dark">Voltar</span>
								</li>
							</div>
					</div>
				</ul>
			</a>
	</div>
    <?php endforeach ?>
</section>

<?php require_once 'footer.php' ?>	

</body>