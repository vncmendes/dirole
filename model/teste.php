<?php 

	public function logaUsuario($email) {
			$_SESSION['autentica_usuario'] = $email;
		}

	public function estaLogado() {
			echo $_SESSION['autentica_usuario'];
		}

	public function deslogar() {
			$_SESSION['autentica_usuario'] "Deslogado !";
			session_destroy();
			session_start();
		}

		



















