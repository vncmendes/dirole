<html>

<head>
	<?php
	// session_start();
	// session_status();
	require_once 'head.php';
	require_once "../model/Usuario.php";
	require_once "../model/UsuarioDAO.php";
	require_once '../controler/usuario.php';
	$usuario = new Usuario();
	$usuarioDAO = new UsuarioDAO();
	$usuario = $_SESSION['id'];

	?>

</head>
<body>
	<?php
  		require_once 'navbar2.php'
  	?>
	<div class="principal py-4">
		<div style="height: 57.8%;" class="container mr-5 py-5">
			<div class="row">
				<div class="col-4 col-md-3 border bg-light">
					<div class="text-center">
						<h1><?php echo $usuario->nome ?></h1>
						<form action="../controler/usuario.php" method="POST" enctype="multipart/form-data">
							<hr><img style="width: 100px; height: 100px;" src="../imagens/<?= $usuario->foto ?>" class="img-thumbnail"></hr>
							<hr><label for="arquivo">Selecione a imagem</label>
							<input type="file" class="form-control-file ml-3" name="foto"></hr>
							<hr><button type="submit" class="btn btn-success" name="uploadArc">Enviar</button></hr>
						</form>
					</div>
				</div>

				<div class="col-4 border bg-light">
					<p>Nome:</p>
					<hr>
					<p>Sobrenome:</p>
					</hr>
					<hr>
					<p>Email:</p>
					</hr>
					<hr>
					<p>Senha:</p>
					</hr>
					<div class="row">
						<form action="editar-perfil.php" method="post">
							<input type="hidden" name="id" value="<?= $usuario->id ?>">
							<button type="submit" class="btn btn-secondary mr-3 ml-3" name="editarPerfil">Alterar</button>
						</form>
						<form action="../controler/usuario.php" method="post">
							<input type="hidden" name="id" value="<?= $usuario->id ?>">
							<button class="btn btn-danger" type="submit" name="removerPerfil">Remover</button>
						</form>
					</div>
				</div>
				<div class="col-4 border bg-light">
					<p><?php echo "$usuario->nome"; ?></p>
					<hr>
					<p><?php echo "$usuario->sobrenome"; ?></p>
					</hr>
					<hr>
					<p><?php echo "$usuario->email"; ?></p>
					</hr>
					<hr>
					<p><?php echo "$usuario->senha"; ?></p>
					</hr>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php include "footer.php"; ?>