<html>

<head>
	<?php
	require_once '../view/header.php';
	require_once "../model/Usuario.php";
	require_once "../model/UsuarioDAO.php";
	require_once '../controler/usuario.php';
	?>
</head>

<div class="principal pt-5 pb-5">
	<div class="container py-4 border">
		<table class="table" style="text">
			<?php
			$usuarios = $usuarioDAO->getAll(); //  para montar o vetor do listar_usuario 
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
			<?php foreach ($usuarios as $usuario) : ?>

				<tr>
					<td><?= $usuario->nome ?></td>
					<td><?= $usuario->sobrenome ?></td>
					<td><?= $usuario->email ?></td>

					<td>
						<form action="altera-usuario.php" method="post">
							<input type="hidden" name="id" value="<?= $usuario->id ?>">
							<button class="btn btn-primary" type="submit" name="alterar">Alterar</button>
						</form>
					</td>

					<td>
						<form action="../controler/usuario.php" method="post">
							<input type="hidden" name="idR" value="<?= $usuario->id ?>">
							<button class="btn btn-danger" type="submit" name="remover">Remover</button>
						</form>

					</td>
					<td>
						<a href="../view/index.php" class="btn btn-dark">Voltar</a>
					</td>

				</tr>
			<?php
			endforeach;
			?>
		</table>
	</div>
</div>
<?php require_once 'footer.php'; ?>

</html>