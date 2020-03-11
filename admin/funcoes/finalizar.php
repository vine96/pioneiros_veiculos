<?php

include('conexao.php');

date_default_timezone_set('America/Sao_Paulo');


	$Id = $_GET['id'];
	$Veiculo_id = $_GET['id_veiculo'];
	$Data_Devolucao = date('Y-m-d');

	echo $sql = "UPDATE aluguel
	SET
	Data_Devolucao = '$Data_Devolucao'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die ('ERRO: finalizar');


	echo $sql = "UPDATE veiculo
		SET Alugado = 0
		WHERE
		id = '$Veiculo_id'";


		$sql = mysqli_query($conexao, $sql) or die ('ERRO: editar veiuclos');

	

	header("location: ../alugueis.php");			
	exit();
	


?>	