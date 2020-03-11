<?php //CADASTRO DE PRODUTRO

include_once("conexao.php");

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['formClientes'])){



	$Nome = $_POST['Nome'];
	$CPF = $_POST['CPF'];
	$DataNascimento = $_POST['DataNascimento'];
	$Telefone = $_POST['Telefone'];
	$Email = $_POST['Email'];
	$Senha = $_POST['Senha'];
	echo $Foto = $_FILES['Foto'];
	$Ativo = $_POST['Ativo'];
	$Endereco = $_POST['Endereco'];


	if ($DataNascimento == ''){
		$DataNascimento = '0000-00-00';
	}



	echo $sql2 = "INSERT INTO clientes (DataNascimento,
	Telefone,
	Email,
	CPF,
	Senha,
	Nome,
	Endereco,
	Ativo) VALUES
	('$DataNascimento',
	'$Telefone',
	'$Email',
	'$CPF',
	'$Senha',
	'$Nome',
	'$Endereco',
	'$Ativo')";



	$query = mysqli_query($conexao,$sql2) or die(mysql_error());

		$lastid = mysqli_insert_id($conexao);  //PEGA O ULTIMO ID DO PRODUTO INSERIDO

		if(!empty($_FILES['Foto']) && ($_FILES['Foto']) <> ''){
			echo "aqui";

			echo $nome = $_FILES['Foto']['name'];
			$ext = end(explode(".", $nome));

			if ($nome <> '') {


                //ADICIONA FOTO GRANDE  
				$nome  = $lastid.'.'.$ext;
				$temp = $_FILES['Foto']['tmp_name'];
				$foto_nome = new SplFileInfo($nome);

				move_uploaded_file($temp,'../../imagens/clientes/'.$foto_nome->getFilename());

				
				echo $sql2 = "UPDATE clientes SET Foto = '$foto_nome' where id = '$lastid'";


				$query2 = mysqli_query($conexao,$sql2) or die(mysql_error('ERRO: adicionar fotos')); 



			}



		}

		
		
		header("location: ../clientes.php");
		exit();

	}


	if (isset($_POST['formVeiculos'])){



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

		if ($Preco_Custo == ''){
			$Preco_Custo = 0.0;
		}
		if ($Preco_Aluguel == ''){
			$Preco_Aluguel = 0.0;
		}



		echo $sql2 = "INSERT INTO veiculo (
		Placa,
		Nome_Modelo,
		Ano_Modelo,
		Marca,
		Cor,
		Preco_Custo,
		Preco_Aluguel,
		IPVA_Pago,
		Cambio_Automatico,
		Ar_Condicionado,
		Motor,
		Combustivel,
		Ativo,
		Alugado,
		Foto) VALUES
		('$Placa',
		'$Nome_Modelo',
		'$Ano_Modelo',
		'$Marca',
		'$Cor',
		'$Preco_Custo',
		'$Preco_Aluguel',
		'$IPVA_Pago',
		'$Cambio_Automatico',
		'$Ar_Condicionado',
		'$Motor',
		'$Combustivel',
		'$Ativo',
		'0',
		'')";



		$query = mysqli_query($conexao,$sql2) or die(mysql_error());

		$lastid = mysqli_insert_id($conexao);  //PEGA O ULTIMO ID DO PRODUTO INSERIDO

		if(!empty($_FILES['Foto']) && ($_FILES['Foto']) <> ''){


			echo $nome = $_FILES['Foto']['name'];
			$ext = end(explode(".", $nome));

			if ($nome <> '') {


                //ADICIONA FOTO GRANDE  
				$nome  = $lastid.'.'.$ext;
				$temp = $_FILES['Foto']['tmp_name'];
				$foto_nome = new SplFileInfo($nome);

				move_uploaded_file($temp,'../../imagens/veiculos/'.$foto_nome->getFilename());

				
				echo $sql2 = "UPDATE veiculo SET Foto = '$foto_nome' where id = '$lastid '";


				$query2 = mysqli_query($conexao,$sql2) or die(mysql_error('ERRO: adicionar fotos')); 



			}

			header("location: ../veiculos.php");
			exit();

		}

	}

	if (isset($_POST['formAlugueis'])){



		$Clientes_id = $_POST['Clientes_id'];
		$Data_Saida = $_POST['Data_Saida'];
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

		echo $sql = "UPDATE veiculo
		SET Alugado = 1
		WHERE
		id = '$Veiculo_id'";


		$sql = mysqli_query($conexao, $sql) or die ('ERRO: cad aluguel');



		
		
		header("location: ../alugueis.php");
		exit();

	}

	if (isset($_POST['formAdministradores'])){



		$Usuario = $_POST['Usuario'];
		$Senha = $_POST['Senha'];
		;




		echo $sql2 = "INSERT INTO admin (
		Usuario, Senha) VALUES
		('$Usuario',
		'$Senha')";



		$query = mysqli_query($conexao,$sql2) or die(mysql_error());

		
		header("location: ../administradores.php");
		exit();

	}