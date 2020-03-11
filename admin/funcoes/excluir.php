<?php
require_once("conexao.php");

$origem = $_GET['origem'];
$id = $_GET['id'];

if ($origem == "clientes"){
	
	
	$sql2 = "SELECT * FROM aluguel
		        WHERE Clientes_Id = '$id' && Data_Devolucao = '0000-00-00'";
		$sqlquery = mysqli_query($conexao, $sql2);
		$count = mysqli_affected_rows($conexao);
		
		if ($count > 0){
			
			
			header("location: ../clientes.php?erro");
			exit();
		
		}
		
	

       $sql = "DELETE FROM clientes
		        WHERE id = '$id'";
		$sql_res = mysqli_query($conexao, $sql) or die ('ERRO: deletar cliente');

			
			header("location: ../clientes.php");
			exit();
	}

	if ($origem == "veiculos"){
		
		
		$sql2 = "SELECT * FROM aluguel
		        WHERE Veiculo_Id = '$id' && Data_Devolucao = '0000-00-00'";
		$sqlquery = mysqli_query($conexao, $sql2);
		$count = mysqli_affected_rows($conexao);
		
		if ($count > 0){
			
			
			header("location: ../veiculos.php?erro");
			exit();
		
		}
		

       $sql = "DELETE FROM veiculo
		        WHERE id = '$id'";
		$sql_res = mysqli_query($conexao, $sql) or die ('ERRO: deletar veiculos');

			
			header("location: ../veiculos.php");
			exit();
	}

		if ($origem == "alugueis"){
			

       $sql = "DELETE FROM aluguel
		        WHERE id = '$id'";
		$sql_res = mysqli_query($conexao, $sql) or die ('ERRO: deletar veiculos');

			
			header("location: ../alugueis.php");
			exit();
	}

	if ($origem == "administradores"){
			

       $sql = "DELETE FROM admin
		        WHERE id = '$id'";
		$sql_res = mysqli_query($conexao, $sql) or die ('ERRO: administradores');

			
			header("location: ../administradores.php");
			exit();
	}

?>