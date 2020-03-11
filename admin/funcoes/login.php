<?php

require_once("conexao.php");


session_start();

if (isset($_POST['usuario']) && isset($_POST['senha'])) {


$usuario= $_POST['usuario'];
$senha= $_POST['senha'];


	$sql = "SELECT * from admin WHERE usuario = '$usuario' AND senha = '$senha'"
			;
			$query = mysqli_query($conexao,$sql);

			$linhas = mysqli_affected_rows($conexao);

			echo $linhas;



			if ($linhas > 0) {

				while ($row = mysqli_fetch_assoc($query)) {
					$idsession = $row['Id'];
					$usuario = $row['Usuario'];
					$senha = $row['Senha'];
				}
					
				session_start(); 	

				$_SESSION['usuario_session'] = $usuario;
				$_SESSION['senha_session'] = $senha;
				$_SESSION['id_session'] = $idsession;
			

			
				header ('Location: ../home.php');
				exit();
			}

		
			     
			    else 
				header ('Location: ../index.php?erro=1');
			exit();

		}
		

           
?>