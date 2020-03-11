<?php

include('conexao.php');

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['formClientes'])){   //EDITAR ESTOQUE


	
	$Id = $_POST['Id'];
	$Nome = $_POST['Nome'];
	$CPF = $_POST['CPF'];
	$DataNascimento = $_POST['DataNascimento'];
	$Telefone = $_POST['Telefone'];
	$Email = $_POST['Email'];
	$Senha = $_POST['Senha'];
	$Foto = $_FILES['Foto'];
	$Ativo = $_POST['Ativo'];
	$Endereco = $_POST['Endereco'];


	echo $sql = "UPDATE clientes
	SET Nome = '$Nome',
	CPF = '$CPF',
	DataNascimento = '$DataNascimento',
	Telefone = '$Telefone',
	Email = '$Email',
	Senha = '$Senha',
	Ativo = '$Ativo',
	Endereco = '$Endereco'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die ('ERRO: editar clientes');


	if(!empty($_FILES['Foto']) && ($_FILES['Foto']) <> ''){
		echo "aqui";

		echo $nome = $_FILES['Foto']['name'];
		$ext = end(explode(".", $nome));

		if ($nome <> '') {


                //ADICIONA FOTO GRANDE  
			$nome  = $Id.'.'.$ext;
			$temp = $_FILES['Foto']['tmp_name'];
			$foto_nome = new SplFileInfo($nome);

			move_uploaded_file($temp,'../../imagens/clientes/'.$foto_nome->getFilename());


			echo $sql2 = "UPDATE clientes SET Foto = '$foto_nome' where id = '$Id'";


			$query2 = mysqli_query($conexao,$sql2) or die(mysql_error('ERRO: adicionar fotos')); 



		}



	}




	header("location: ../clientes.php");			
	exit();
	

} 


if (isset($_POST['formVeiculos'])){   //EDITAR ESTOQUE


	$Id = $_POST['Id'];
	$Nome_Modelo = $_POST['Nome_Modelo'];
	$Ano_Modelo = $_POST['Ano_Modelo'];
	$Placa = $_POST['Placa'];
	$Marca = $_POST['Marca'];
	$Cor = $_POST['Cor'];
	$Cambio_Automatico = $_POST['Cambio_Automatico'];
	$Motor = $_POST['Motor'];
	$IPVA_Pago = $_POST['IPVA_Pago'];
	$Combustivel = $_POST['Combustivel'];
	$Foto = $_FILES['Foto'];
	$Preco_Custo = $_POST['Preco_Custo'];
	$Preco_Aluguel = $_POST['Preco_Aluguel'];
	$Ativo = $_POST['Ativo'];
	$Ar_Condicionado = $_POST['Ar_Condicionado'];


	echo $sql = "UPDATE veiculo
	SET Nome_Modelo = '$Nome_Modelo',
	Ano_Modelo = '$Ano_Modelo',
	Placa = '$Placa',
	Marca = '$Marca',
	Cor = '$Cor',
	Cambio_Automatico = '$Cambio_Automatico',
	Motor = '$Motor',
	IPVA_Pago = '$IPVA_Pago',
	Combustivel = '$Combustivel',
	Ar_Condicionado = '$Ar_Condicionado',
	Preco_Custo = '$Preco_Custo',
	Preco_Aluguel = '$Preco_Aluguel',
	Ativo = '$Ativo'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die ('ERRO: editar clientes');


	if(!empty($_FILES['Foto']) && ($_FILES['Foto']) <> ''){
		echo "aqui";

		echo $nome = $_FILES['Foto']['name'];
		$ext = end(explode(".", $nome));

		if ($nome <> '') {


                //ADICIONA FOTO GRANDE  
			$nome  = $Id.'.'.$ext;
			$temp = $_FILES['Foto']['tmp_name'];
			$foto_nome = new SplFileInfo($nome);

			move_uploaded_file($temp,'../../imagens/veiculos/'.$foto_nome->getFilename());


			echo $sql2 = "UPDATE veiculo SET Foto = '$foto_nome' where id = '$Id'";


			$query2 = mysqli_query($conexao,$sql2) or die(mysql_error('ERRO: adicionar fotos')); 



		}



	}




	header("location: ../veiculos.php");			
	exit();
	

} 


if (isset($_POST['formAlugueis'])){


	$Id = $_POST['Id'];
	$Dias = $_POST['Dias'];
	$Clientes_id = $_POST['Clientes_id'];
	$Data_Saida = $_POST['Data_Saida'];
	$Data_Devolucao = $_POST['Data_Devolucao'];
	$Veiculo_id = $_POST['Veiculo_id'];
	$Forma_Pagamento = $_POST['Forma_Pagamento'];
	$Observacoes = $_POST['Observacoes'];

	if ($Data_Devolucao == ''){
		$Data_Devolucao = NULL;
	}


	echo $sql = "UPDATE aluguel
	SET Clientes_id = '$Clientes_id',
	Data_Saida = '$Data_Saida',
	Data_Devolucao = '$Data_Devolucao',
	Veiculo_id = '$Veiculo_id',
	Forma_Pagamento = '$Forma_Pagamento',
	Dias = '$Dias',
	Observacoes = '$Observacoes'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die ('ERRO: editar clientes');

	header("location: ../alugueis.php");			
	exit();
	

} 

if (isset($_POST['formAdministradores'])){


	$Usuario = $_POST['Usuario'];
	$Senha = $_POST['Senha'];
	$Id = $_POST['Id'];



	echo $sql = "UPDATE admin
	SET Usuario = '$Usuario',
	Senha = '$Senha'
	WHERE
	id = '$Id'";


	$sql = mysqli_query($conexao, $sql) or die (mysql_error());


	header("location: ../administradores.php");			
	exit();
	

} 

?>	