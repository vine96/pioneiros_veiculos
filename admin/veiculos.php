<!DOCTYPE html>
<html>



<?php 
include("funcoes/conexao.php");

session_start();

if (!isset($_SESSION['usuario_session'])){
	header ('location: index.php');
}	

if (isset($_GET['erro'])){
echo "<script>alert ('Você não pode deletar um veículo que está alugado');</script>";
}

?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administrador</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<style type="text/css">

*, .btn, input {
  font-size: 14px !important;
}

h2{
  font-size: 18px !important;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">PIONEIROS VEÍCULOS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">PIONEIROS VEÍCULOS</span>
      </a>


    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
        
          <div>
            <p style="color: white; font-size: 19px;">Administrador<a href="funcoes/logout.php"> [Sair]</a></p>
            <!-- Status -->
          
          </div>
        </div>

        <!-- Sidebar Menu -->
       <?php include("menu.php"); ?>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Veículos
          <small>Gerenciamento de veículos do sistema</small>   &nbsp<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Veiculos-Adicionar">
 Cadastrar Veículos
</button>
        </h1>

        <div class="form-group">

            <form method="get">


              <label for="exampleInputName">Busca</label>
              <input type="text" name="Busca"><button type="submit" class="btn btn-primary">Buscar</button>
            

          </form>

          </div>

        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">Veículos</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <div class="row">
          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista de Veículos</h3> 

             

              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">Foto</th>
                      <th>Modelo</th>
                      <th>Ano</th>
                      <th>Marca</th>
                      <th>Cor</th>
                      <th>Preço Aluguel</th>
                      <th>IPVA Pago</th>
                      <th>Cambio Auto.</th>
                      <th>Ar Cond.</th>
                      <th>Motor</th>
                      
                      <th>Ativo</th>
                      <th>Situação</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_GET['Busca']) && $_GET['Busca'] <> ''){
                      $pesquisa = $_GET['Busca'];
                     $sql = 'SELECT * from veiculo where Nome_Modelo LIKE "%'.$pesquisa.'%" order by id desc';
                    } else {

                    $sql = 'SELECT * from veiculo order by veiculo.id desc';

                  }
                    $query = mysqli_query($conexao,$sql);




                    while ($row = mysqli_fetch_assoc($query)){




                      ?>

                      <tr>
                        <td>

                          <?php if($row['Foto'] <> '' && $row['Foto'] <> 'Array') { ?>

                          <a href="#" data-toggle="modal" data-target="<?php echo '#Imagens'.$row['id'] ?>">
                          <img src="../imagens/veiculos/<?php echo $row['Foto']; ?>" class="img-circle img-sm"> <?php } ?>

                          </a>

                          </td>



                        <td><?php echo $row['Nome_Modelo']; ?></td>
                        <td><?php echo $row['Ano_Modelo']; ?></td>
                        <td><?php echo $row['Marca']; ?></td>
                        <td><?php echo $row['Cor']; ?></td>
                        <td><?php echo 'R$ '.$row['Preco_Aluguel']; ?></td>
                        <td><?php if ($row['IPVA_Pago']) { echo "Sim"; } else { echo "Não"; } ?></td>
                        <td><?php if ($row['Cambio_Automatico']) { echo "Sim"; } else { echo "Não"; } ?></td>
                        <td><?php if ($row['Ar_Condicionado']) { echo "Sim"; } else { echo "Não"; } ?></td>

                        <td><?php echo $row['Motor']; ?></td>
                      
                        <td><?php if ($row['Ativo']) { echo "Sim"; } else { echo "Não"; } ?></td>
                        <td><?php if ($row['Alugado']) { echo "<span style='color: red;'><b>Alugado</b></span>"; } else { echo "<span style='color: green;'><b>Disponível</b></span>"; } ?></td>
                        <td>

                          <div class="modal about-modal fade" id="Imagens<?php echo $row['id'] ?>" tabindex="-2" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-body" style="color: black">

                                 <DIV STYLE="margin-bottom: 10px; width: 100%;">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                  <div style="width: 100%; aborder: 1px solid black; margin: 0 auto;">

                                    <img style="margin: 0 0; aborder: 1px solid black; max-width: 100%;" src="../imagens/veiculos/<?php echo $row['Foto']; ?>">


                                  </div>
                                </DIV>                   
                              </div> 
                            </div>
                          </div>
                        </div>

                        <div class="modal fade" class="Editar" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">


                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                              </button>
                              <div class="modal-header">

                                <h2 class="modal-title" id="exampleModalLongTitle">Editar Veículos</h2>

                              </div>
                              <div class="modal-body">

                                <!-- /.box-header -->
                                <!-- form start -->
                                <form id="form-user-create" action="funcoes/editar.php" method="POST" enctype="multipart/form-data">

                                  <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id']; ?>">

                                  <div class="box-body">

                                    <div class="form-group">
                                      <label for="exampleInputFile">Foto</label>
                                      <input type="file" id="exampleInputFile" name="Foto">
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleInputName">Modelo</label>
                                      <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o modelo" name="Nome_Modelo" value="<?php echo $row['Nome_Modelo']; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputName">Ano</label>
                                      <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o ano" name="Ano_Modelo" value="<?php echo $row['Ano_Modelo']; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Placa</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite a placa" name="Placa" value="<?php echo $row['Placa']; ?>">
                                    </div>

                                    
                                    <div class="form-group">
									<label for="exampleInputFile">Marca</label>
									<br>
									<select name="Marca" class="form-control">

                                    <?php $sql2 = 'SELECT * from marcas order by Nome asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
                                      <option value="<?php echo $row2['Nome']; ?>" <?php if ($row['Marca'] == $row2['Nome']) { ?> selected <?php } ?>>

                                        <?php echo $row2['Nome'] ?></option>

                                      <?php } ?>
                                    </select>

                        </div>


                                      <div class="form-group">
                        <label for="exampleInputFile">Cores</label>
                        <br>
                        <select name="Cor" class="form-control">

                                    <?php $sql2 = 'SELECT * from cores group by Nome order by Nome asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
									<option value="<?php echo $row2['Nome']; ?>" <?php if ($row['Cor'] == $row2['Nome']) { ?> selected <?php } ?>">

                                        <?php echo $row2['Nome'] ?></option>

                                      <?php } ?>
                                    </select>

                        </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Preço Custo</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite o preço de custo" name="Preco_Custo" value="<?php echo $row['Preco_Custo']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Preço Aluguel</label>
                                      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Digite o preço do aluguel" name="Preco_Aluguel" value="<?php echo $row['Preco_Aluguel']; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputFile">IPVA Pago</label>
                                      <br>
                                      <select name="IPVA_Pago" class="form-control">
                                        <option value="1" <?php if ($row['IPVA_Pago'] == 1) { ?> selected <?php } ?>>Sim</option>
                                        <option value="0" <?php if ($row['IPVA_Pago'] == 0) { ?> selected <?php } ?>>Não</option>
                                      </select>

                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputFile">Cambio Automático</label>
                                      <br>
                                      <select name="Cambio_Automatico" class="form-control">
                                        <option value="0" <?php if ($row['Cambio_Automatico'] == 0) { ?> selected <?php } ?>>Não</option>
                                        <option value="1" <?php if ($row['Cambio_Automatico'] == 1) { ?> selected <?php } ?>>Sim</option>
                                      </select>

                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputFile">Ar_Condicionado</label>
                                      <br>
                                      <select name="Ar_Condicionado" class="form-control">
                                        <option value="0" <?php if ($row['Ar_Condicionado'] == 0) { ?> selected <?php } ?>>Não</option>
                                        <option value="1" <?php if ($row['Ar_Condicionado'] == 1) { ?> selected <?php } ?>>Sim</option>
                                      </select>

                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Motor</label>
                                      <select name="Motor" class="form-control">
                                       <option value="1.0" <?php if ($row['Motor'] == '1.0') { ?> selected <?php } ?>>1.0</option>

                                       <option value="1.4" <?php if ($row['Motor'] == '1.4') { ?> selected <?php } ?>>1.4</option>
                                       <option value="1.6" <?php if ($row['Motor'] == '1.6') { ?> selected <?php } ?>>1.6</option>
                                       <option value="1.8" <?php if ($row['Motor'] == '1.8') { ?> selected <?php } ?>>1.8</option>
                                       <option value="2.0" <?php if ($row['Motor'] == '2.0') { ?> selected <?php } ?>>2.0</option>
                                     </select>
                                   </div>

                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Combustível</label>
                                    <select name="Combustivel" class="form-control">
                                      <option value="Gasolina" <?php if ($row['Combustivel'] == 'Gasolina') { ?> selected <?php } ?>>Gasolina</option>
                                      <option value="Gás" <?php if ($row['Combustivel'] == 'Gás') { ?> selected <?php } ?>>Gás</option>
                                      <option value="Etanol" <?php if ($row['Combustivel'] == 'Etanol') { ?> selected <?php } ?>>Etanol</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputFile">Situação</label>
                                    <br>
                                    <select name="Ativo" class="form-control">
                                      <option value="1" <?php if ($row['Ativo'] == 1) { ?> selected <?php } ?>>Ativo</option>
                                      <option value="0" <?php if ($row['Ativo'] == 0) { ?> selected <?php } ?>>Inativo</option>
                                    </select>

                                  </div>

                                </div>

                                <div class="box-footer">
                                  <button type="submit" name="formVeiculos" class="btn btn-success">Editar</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>

                              </form>

                            </div>
                          </div>
                        </div>
                      </div>
                    


                   

                             <form action="funcoes/excluir.php" method="GET">

                            <button type="button" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class="btn btn-primary btn-xs btn-flat editar" data-id="<?php echo $row['id']; ?>">Editar</button>

                            <input type="text" name="origem" value="veiculos" hidden>
                            <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>

                            <button type="submit" class="btn btn-danger btn-xs btn-flat">Excluir</button>
                          </form>
                           
                          </td>
                        </tr>


                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>

              </div>
              <div class="col-md-8">



                <div class="row">

                  <!-- Button trigger modal -->


                  
                

              </div>
            </div>

          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    

      </div>

 <div class="modal fade" id="Veiculos-Adicionar" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                    </button>
                  <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLongTitle">Cadastramento de Veículos</h2>
                    
                  </div>

                  <div class="modal-body">

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="form-user-create" action="funcoes/adicionar.php" method="POST" enctype="multipart/form-data">




                      <div class="box-body">

                        <div class="form-group">
                          <label for="exampleInputFile">Foto</label>
                          <input type="file" id="exampleInputFile" name="Foto">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputName">Modelo</label>
                          <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o modelo" name="Nome_Modelo">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputName">Ano</label>
                          <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o ano" name="Ano_Modelo">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Placa</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite a Placa" name="Placa">
                        </div>

                         <div class="form-group">
                        <label for="exampleInputFile">Marca</label>
                        <br>
                        <select name="Marca" class="form-control">

                                    <?php $sql2 = 'SELECT * from marcas order by Nome asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
                                      <option value="<?php echo $row2['Nome']; ?>">

                                        <?php echo $row2['Nome'] ?></option>

                                      <?php } ?>
                                    </select>

                        </div>


                        <div class="form-group">
                        <label for="exampleInputFile">Cores</label>
                        <br>
                        <select name="Cor" class="form-control">

                                    <?php $sql2 = 'SELECT * from cores group by Nome order by Nome asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
                                      <option value="<?php echo $row2['Nome']; ?>">

                                        <?php echo $row2['Nome'] ?></option>

                                      <?php } ?>
                                    </select>

                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Preço Custo</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite o preço de custo" name="Preco_Custo">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Preço Aluguel</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Digite o preço do aluguel" name="Preco_Aluguel">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputFile">IPVA Pago</label>
                          <br>
                          <select name="IPVA_Pago" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                          </select>

                        </div>

                        <div class="form-group">
                          <label for="exampleInputFile">Ar Condicionado</label>
                          <br>
                          <select name="Ar_Condicionado" class="form-control">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                          </select>

                        </div>

                        <div class="form-group">
                          <label for="exampleInputFile">Câmbio Automático</label>
                          <br>
                          <select name="Cambio_Automatico" class="form-control">
                             <option value="0">Não</option>
                            <option value="1">Sim</option>
                          </select>

                        </div>

                         <div class="form-group">
                          <label for="exampleInputPassword1">Motor</label>
                          <select name="Motor" class="form-control">
                         <option value="1.0">1.0</option>

                         <option value="1.4">1.4</option>
                         <option value="1.6">1.6</option>
                         <option value="1.8">1.8</option>
                         <option value="2.0">2.0</option>
						 <option value="2.0">2.8</option>
						 <option value="2.0">3.0</option>
						 <option value="2.0">3.5</option>
						 <option value="2.0">4.0</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Combustível</label>
                          <select name="Combustivel" class="form-control">
                            <option value="Gasolina">Gasolina</option>
                            <option value="Gás">Gás</option>
                            <option value="Etanol">Etanol</option>
                          </select>
                        </div>

                    
                        <div class="form-group">
                          <label for="exampleInputFile">Situação</label>
                          <br>
                          <select name="Ativo" class="form-control">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                          </select>

                        </div>


                      </div>
                      <!-- /.box-body -->          
                      <div class="box-footer">
                        <button type="submit" name="formVeiculos" class="btn btn-success">Cadastrar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      </div>
                    </form>

                  </div>

                </div>
              </div>
            </div>

            

    </body>

        <!--===============================================================================================-->
  <script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
  <script type="text/javascript" src="bootstrap/js/popper.js"></script>
  
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  
  
   <!-- Adicionando Javascript -->
    
    </html>