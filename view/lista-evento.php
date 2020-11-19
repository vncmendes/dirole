<?php
	session_start();
	require_once "../model/Evento.php";
	require_once '../controller/evento.php';
	if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) {
		$todosEventos = $eventos->selectAllWithIdProv();
	}
	if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) {
		$todosEventos = $eventos->selectAll();
	}

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
				<li>
					<a href="adiciona-evento.php" class="nodecore1 navlinks1">Add Evento</a>
				</li>
				<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
				<li> 
					<a href='lista-usuario.php' class='nodecore1 navlinks1'>Lista Usuários</a>
				</li>
				<?php } ?>
				<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
				<li>
					<a href="perfil.php" class="nodecore1 navlinks1">Perfil</a>
				</li>
				<?php } ?>

				<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
				<li>
					<a href="perfilAdm.php" class="nodecore1 navlinks1">Perfil</a>
				</li>
				<?php } 

					else { ?>
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
			
			<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 0) { ?>
				<a href="perfil.php">
				<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
				</a>
			<?php } ?>
				
			<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1) { ?>
				<a href="perfilP.php">
				<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
				</a>
			<?php } ?>

			<?php if(isset($_SESSION['logado']) && $_SESSION['nivel'] == 1000) { ?>
				<a href="perfilAdm.php">
				<img class="avatarlogo1" src="<?php echo $_SESSION['foto']; ?>">
				</a>
			<?php } ?>

			<form style="margin: 0"; method="POST" action="pesquisa.php">
				<input type="text" name="pesquisar" onKeyPress="return goSearch(this, event)" placeholder="Procurar Evento" />
			</form>
			<?php if(isset($_SESSION['logado'])) { ?>
				<a href="logout.php" class="nodecore1 navlinks1">Sair</a>
			<?php } ?>
			</div>
		</div>
	</header>

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
									<li>Produtor: <?= $_SESSION['nome']?>
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
</html>