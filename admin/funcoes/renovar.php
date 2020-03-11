<?php

include('conexao.php');


date_default_timezone_set('America/Sao_Paulo');

	$Id = $_POST['Id'];
	$Data_Devolucao = date('Y-m-d');
	$Data_Saida = $_POST['Data_Saida']; 


	

	echo $sql = "UPDATE aluguel
	SET
	Data_Devolucao = '$Data_Devolucao'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die ('ERRO: finalizar');


		$Clientes_id = $_POST['Clientes_id'];
		$Data_Saida = date('Y-m-d');
		$Veiculo_id = $_POST['Veiculo_id'];
		$Forma_Pagamento = $_POST['Forma_Pagamento'];
		$Observacoes = $_POST['Observacoes'];
		$Dias = $_POST['Dias'];



		echo $sql2 = 'SELECT * from veiculo where id ='.$Veiculo_id.'';
		$query = mysqli_query($conexao,$sql2);
		$row = mysqli_fetch_array($query);

		echo $Preco_Aluguel = $row['Preco_Aluguel'];

		$Total = $Dias * $Preco_Aluguel;




		echo $sql2 = "INSERT INTO aluguel (
		Clientes_id,
		Veiculo_id,
		Data_Saida,
		Data_Devolucao,
		Forma_Pagamento,
		Dias,
		Observacoes,
		Total) VALUES
		('$Clientes_id',
		'$Veiculo_id',
		'$Data_Saida',
		'0000-00-00',
		'$Forma_Pagamento',
		'$Dias',
		'$Observacoes',
		'$Total')";



		$query = mysqli_query($conexao,$sql2) or die(mysql_error());


	
	

	header("location: ../alugueis.php");			
	exit();
	


	?>	