<?php
	session_start();
	require_once "../model/Usuario.php";
	require_once '../controller/usuario.php';
	$todos = $usuario->selectAll();
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
					<a href="lista-evento.php" class="nodecore1 navlinks1">Todos Eventos</a>
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

	<div class="box-user">
		<div class="box-second">
			<div class="box-user-conteudo">
				<h1 class="text-center py-2 px-2">
					Lista Usuários
				</h1>

				<ul>
					<div class="box-infos">
						<li>Nome:</li>
						<li>Sobrenome:</li>
						<li>Email:</li>
					</div>
				</ul>
			
				<?php foreach ($todos as $usuario) : ?>
				<ul>
					<div class="box-user-infos">
						<li><?= $usuario->nome ?></li>
						<li><?= $usuario->sobrenome ?></li>
						<li><?= $usuario->email ?></li>
					</div>
				</ul>
				<ul>
					<!-- <div style="display: flex"> -->
					<div class="user-button">
						<li>
							<form action="altera-usuario.php" method="POST">
								<input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
								<button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
							</form>
						</li>
						<li>
							<form action="../controller/usuario.php" method="POST">
								<input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
								<button class="btn btn-danger" type="submit" name="remover">Remover</button>
							</form>

						</li>
						<li>
							<a href="../view/index.php" class="btn btn-dark">Voltar</a>
						</li>
					</div>
				</ul>

				<?php
				endforeach;
				?>

			</div>
		</div>
	</div>

	<!-- <div class="principal pt-5 pb-5">
		<div class="container py-4 border">
			<table class="table" style="text">
				< ?php
				$usuarios = $usuario->selectAll(); //  para montar o vetor do listar_usuario 
				?>
				<h1>Lista Usuários</h1>
				<td style="border-top: none">
					<h3>Nome:</h3>
				</td>
				<td style="border-top: none">
					<h3>Sobrenome:</h3>
				</td>
				<td style="border-top: none">
					<h3>Email:</h3>
				</td><br>
				< ?php foreach ($usuarios as $usuario) : ?>

					<tr>
						<td>< ?= $usuario->nome ?></td>
						<td>< ?= $usuario->sobrenome ?></td>
						<td>< ?= $usuario->email ?></td>

						<td>
							<form action="altera-usuario.php" method="post">
								<input type="hidden" name="id" value="< ?= $usuario->id ?>">
								<button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
							</form>
						</td>

						<td>
							<form action="../controller/usuario.php" method="post">
								<input type="hidden" name="idR" value="< ?= $usuario->id ?>">
								<button class="btn btn-danger" type="submit" name="remover">Remover</button>
							</form>

						</td>
						<td>
							<a href="../view/index.php" class="btn btn-dark">Voltar</a>
						</td>

					</tr>
				< ?php
				endforeach;
				?>
			</table>
		</div>
	</div> -->

</body>
<?php require_once 'footer.php'; ?>

</html>