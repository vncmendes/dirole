<?php
require_once '../model/Conexao.php';
require_once '../model/Usuario.php';
require_once '../model/UsuarioDAO.php';

if (array_key_exists("removido", $_GET) && $_GET["removido"] == "true") {	?>
	<p>Produto apagado com sucesso ! </p>
<?php } ?>

<table>
<?php 

$usuarioDAO = new UsuarioDAO();
$usuarios = $usuarioDAO->getAll();

foreach ($usuarios as $usuario) : ?>

	<tr>
		<td><?=$usuario->nome?></td>
		<td><?=$usuario->sobrenome?></td>
		<td><?=$usuario->email?></td>

		<td>
			<form action="../controler/form-altera-user.php" method="post">
				<input type="hidden" name="alterar" value="<?=$usuario->id?>">
				<button type="submit">Alterar</button>
			</form>
		</td>

		<td>
			<form action="../controler/remove-user.php" method="post">
				<input type="hidden" name="remover" value="<?=$usuario->id?>">
				<button type="submit">Remover</button>
			</form>

		</td>
		
		
	</tr>
	<?php 
endforeach;
?>
</table>
