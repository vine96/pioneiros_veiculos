<!DOCTYPE html>
<html lang="pt-br">

<?php 
include("funcoes/conexao.php");
date_default_timezone_set('America/Sao_Paulo');

session_start();

if (!isset($_SESSION['usuario_session'])){
	header ('location: index.php');
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
      <a href="../index.php" class="logo">
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
          Aluguel
          <small>Gerenciamento de aluguéis do sistema</small> &nbsp<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Alugueis-Adicionar"> Cadastrar Aluguel de Veículo
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
          <li class="active">Aluguel</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <div class="row">
          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista de Aluguéis</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <thead>
                    <tr>

                      <th>Cliente</th>
                      <th>Veículo</th>
                      <th>Placa</th>
                      <th>Data Saída</th>
                      <th>Data Devolução</th>

                      <th>Diárias</th>
                      <th>Total</th>
                      <th>Situação</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php



                    $sql = 'SELECT *, aluguel.id as id_aluguel, veiculo.id as id_veiculo, clientes.id as id_cliente FROM `aluguel` 
                    left join clientes on aluguel.Clientes_id= clientes.id
                    left join veiculo on aluguel.Veiculo_id = veiculo.id';

                    if (isset($_GET['Busca']) && $_GET['Busca'] <> ''){
                      $pesquisa = $_GET['Busca'];
                      $sql .= ' where clientes.Nome LIKE "%'.$pesquisa.'%" OR veiculo.Nome_Modelo LIKE "%'.$pesquisa.'%"'; 

                    }
                    
                    $sql .= ' order by aluguel.id desc';
                    $query = mysqli_query($conexao,$sql);


                    while ($row = mysqli_fetch_assoc($query)){

                      if (isset($row['Data_Devolucao']) && $row['Data_Devolucao'] <> '0000-00-00') {
                       $data_devolucao = date('d/m/Y', strtotime($row['Data_Devolucao'])); 
                     } else{
                      $data_devolucao = '';
                    }

                    if (isset($row['Data_Saida'])) {
                      $data_saida = date('d/m/Y', strtotime($row['Data_Saida']));
                    }

                    $hj = date('Y-m-d');
                    $dias = $row['Dias'];
                    $prazo = date('Y-m-d', strtotime("+".$dias." days",strtotime($row['Data_Saida']))); 


                    if($row['Data_Devolucao'] == '0000-00-00' || $row['Data_Devolucao'] == ''){
                      $situacao = "<strong style='color: blue;'>Alugado</strong>";
                    }
                    if($row['Data_Devolucao'] <> '0000-00-00' && $row['Data_Devolucao'] <> ''){
                      $situacao = "<strong style='color: green;'>Entregue</strong>";
                    }
                    if(strtotime($hj) > strtotime($prazo) && $row['Data_Devolucao'] == '0000-00-00'){
                      $situacao = "<strong style='color: red;'>Em atraso</strong>";
                    }

                    $total = $row['Total'];

                    $total = number_format($total, 2, ',', '.');

                    ?>

                    <tr>

                      <td><?php echo $row['Nome']; ?></td>
                      <td><?php echo $row['Nome_Modelo'].' '.$row['Ano_Modelo'].' '.$row['Motor'] ; ?></td>
                      <td><?php echo $row['Placa']; ?></td>
                      <td><?php echo $data_saida; ?></td>
                      <td><?php echo $data_devolucao; ?></td>

                      <td><?php echo $row['Dias']; ?></td>
                      <td><?php echo 'R$ '.$total; ?></td>      
                      <td><?php echo $situacao; ?></td>

                      <td>




                        <form action="funcoes/excluir.php" method="GET">



                          <button type="button" data-toggle="modal" data-target="#<?php echo $row['id_aluguel']; ?>" class="btn btn-primary btn-xs btn-flat editar" data-id="<?php echo $row['id']; ?>">Editar</button>



                          <input type="text" name="origem" value="alugueis" hidden>
                          <input type="text" name="id" value="<?php echo $row['id_aluguel']; ?>" hidden>

                          <button type="submit" class="btn btn-danger btn-xs btn-flat">Excluir</button>

                          <?php if ($data_devolucao == '') { ?>

                          <a href="funcoes/finalizar.php?id=<?php echo $row['id_aluguel']; ?>&id_veiculo=<?php echo $row['id_veiculo'] ?>"><button type="button" class="btn btn-warning btn-xs btn-flat">Devolver</button></a>

                          <button type="button" data-toggle="modal" data-target="#Renovar<?php echo $row['id_aluguel']; ?>" class="btn btn-dark btn-xs btn-flat editar" data-id="<?php echo $row['id']; ?>">Renovar</button>

                          <?php } ?>



                        </form>
                      </td>
                    </tr>

                    <div class="modal fade" id="Renovar<?php echo $row['id_aluguel']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                    </button>
                    <div class="modal-header">
                      <h2 class="modal-title" id="exampleModalLongTitle">Renovação de Aluguel</h2>

                    </div>

                    <div class="modal-body">

                      <!-- /.box-header -->
                      <!-- form start -->
                      <form id="form-user-create" action="funcoes/renovar.php" method="POST" enctype="multipart/form-data">

                        <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id_aluguel']; ?>">


                        <div class="box-body">

                           <div class="form-group">
                                <label for="exampleInputFile">Cliente</label>
                                <br>
                                <select name="Clientes_id" class="form-control veiculo_cliente" readonly style="pointer-events': none;">
                                 <?php $sql2 = 'SELECT * from clientes order by Nome asc';
                                 $query2 = mysqli_query($conexao,$sql2);
                                 while ($row2 = mysqli_fetch_assoc($query2)){


                                  ?>
                                  <option value="<?php echo $row2['id']; ?>" 
                                    <?php if ($row2['id'] == $row['id_cliente']) { ?> selected <?php } ?>>

                                    <?php echo $row2['Nome'];  ?></option>

                                    <?php } ?>
                                  </select>

                                </div>

                                <div class="form-group">
                                  <label for="exampleInputFile">Veículo</label>
                                  <br>
                                  <select name="Veiculo_id" class="form-control veiculo_cliente" readonly style="'pointer-events':'none';">

                                    <?php $sql2 = 'SELECT * from veiculo order by Nome_Modelo asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
                                      <option value="<?php echo $row2['id']; ?>" <?php if ($row2['id'] == $row['id_veiculo']) { ?> selected <?php } ?>>

                                        <?php echo $row2['Nome_Modelo'].' '.$row2['Ano_Modelo'].' '.$row2['Motor'] ; ?></option>

                                        <?php } ?>
                                      </select>

                                    </div>

                            <div class="form-group">
                              <label for="exampleInputName">Forma de Pagamento</label>
                              <select name="Forma_Pagamento" class="form-control">
                                <option value="Boleto">Boleto Bancário</option>
                                <option value="Crédito">Cartão de Crédito</option>
                                <option value="Débito">Cartão de Débito</option> 
                                <option value="Dinheiro" selected="">Dinheiro</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputName">Diária</label>
                              <select name="Dias" class="form-control">
                                <option value="5">5 Dias</option>
                                <option value="10">10 Dias</option>
                                <option value="15">15 Dias</option> 
                                <option value="30">30 Dias</option>
                                <option value="45">45 Dias</option>
                                <option value="60">60 Dias</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Observações</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite alguma observação" name="Observacoes">
                            </div>


                          </div>
                          <!-- /.box-body -->          
                          <div class="box-footer">
                            <button type="submit" name="formAlugueis" class="btn btn-success">Renovar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          </div>
                        </form>

                      </div>

                    </div>
                  </div>
                </div>


                    <div class="modal fade" class="Editar" id="<?php echo $row['id_aluguel']; ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                          </button>
                          <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLongTitle">Editar Aluguel</h2>

                          </div>
                          <div class="modal-body">

                            <!-- /.box-header -->
                            <!-- form start -->


                            <form id="form-user-create" action="funcoes/editar.php" method="POST" enctype="multipart/form-data">

                              <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id_aluguel']; ?>">


                              <div class="box-body">

                               <div class="form-group">
                                <label for="exampleInputFile">Cliente</label>
                                <br>
                                <select name="Clientes_id" class="form-control">
                                 <?php $sql2 = 'SELECT * from clientes order by Nome asc';
                                 $query2 = mysqli_query($conexao,$sql2);
                                 while ($row2 = mysqli_fetch_assoc($query2)){


                                  ?>
                                  <option value="<?php echo $row2['id']; ?>" 
                                    <?php if ($row2['id'] == $row['id_cliente']) { ?> selected <?php } ?>>

                                    <?php echo $row2['Nome'];  ?></option>

                                    <?php } ?>
                                  </select>

                                </div>

                                <div class="form-group">
                                  <label for="exampleInputFile">Veículo</label>
                                  <br>
                                  <select name="Veiculo_id" class="form-control">

                                    <?php $sql2 = 'SELECT * from veiculo order by Nome_Modelo asc';
                                    $query2 = mysqli_query($conexao,$sql2);
                                    while ($row2 = mysqli_fetch_assoc($query2)){
                                      ?>
                                      <option value="<?php echo $row2['id']; ?>" <?php if ($row2['id'] == $row['id_veiculo']) { ?> selected <?php } ?>>

                                        <?php echo $row2['Nome_Modelo'].' '.$row2['Ano_Modelo'].' '.$row2['Motor'] ; ?></option>

                                        <?php } ?>
                                      </select>

                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputBirth">Data Saída</label>
                                      <input type="date" class="form-control" id="exampleInputBirth" name="Data_Saida" value="<?php echo $row['Data_Saida']; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputBirth">Data Devolução</label>
                                      <input type="date" class="form-control" id="exampleInputBirth" name="Data_Devolucao" value="<?php echo $row['Data_Devolucao']; ?>">
                                    </div>

                                    <div class="form-group">
                                      <label for="exampleInputName">Diária</label>
                                      <select name="Dias" class="form-control">
                                        <option value="5" <?php if ($row['Dias'] == '5') { ?> selected <?php } ?>>5 Dias</option>
                                        <option value="10"<?php if ($row['Dias'] == '10') { ?> selected <?php } ?>>10 Dias</option>
                                        <option value="15"<?php if ($row['Dias'] == '15') { ?> selected <?php } ?>>15 Dias</option> 
                                        <option value="30"<?php if ($row['Dias'] == '30') { ?> selected <?php } ?>>30 Dias</option>
                                        <option value="45"<?php if ($row['Dias'] == '45') { ?> selected <?php } ?>>45 Dias</option>
                                        <option value="60"<?php if ($row['Dias'] == '60') { ?> selected <?php } ?>>60 Dias</option>
                                      </select>
                                    </div>


                                    <div class="form-group">
                                      <label for="exampleInputName">Forma de Pagamento</label>
                                      <select name="Forma_Pagamento" class="form-control">
                                        <option value=""></option>
                                        <option value="Boleto" <?php if ($row['Forma_Pagamento'] == 'Boleto') { ?> selected <?php } ?>>Boleto Bancário</option>
                                        <option value="Crédito" <?php if ($row['Forma_Pagamento'] == 'Crédito') { ?> selected <?php } ?> >Cartão de Crédito</option>
                                        <option value="Débito" <?php if ($row['Forma_Pagamento'] == 'Débito') { ?> selected <?php } ?>>Cartão de Débito</option> 
                                        <option value="Dinheiro" <?php if ($row['Forma_Pagamento'] == 'Dinheiro') { ?> selected <?php } ?> >Dinheiro</option>
                                      </select>
                                    </div>



                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Observações</label>
                                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite alguma observação" name="Observacoes" value="<?php echo $row['Observacoes']; ?>">
                                    </div>


                                  </div>
                                  <!-- /.box-body -->          
                                  <div class="box-footer">
                                    <button type="submit" name="formAlugueis" class="btn btn-success">Editar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                  </div>
                                </form>

                              </div>

                            </div>
                          </div>
                        </div>



                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>

              </div>
              
              

              <div class="modal fade" id="Alugueis-Adicionar" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                    </button>
                    <div class="modal-header">
                      <h2 class="modal-title" id="exampleModalLongTitle">Cadastramento de Aluguel</h2>

                    </div>

                    <div class="modal-body">

                      <!-- /.box-header -->
                      <!-- form start -->
                      <form id="form-user-create" action="funcoes/adicionar.php" method="POST" enctype="multipart/form-data">


                        <div class="box-body">

                         <div class="form-group">
                          <label for="exampleInputFile">Cliente</label>
                          <br>
                          <select name="Clientes_id" class="form-control">
                           <?php $sql2 = 'SELECT * from clientes order by Nome asc';
                           $query2 = mysqli_query($conexao,$sql2);
                           while ($row2 = mysqli_fetch_assoc($query2)){

                            ?>
                            <option value="<?php echo $row2['id']; ?>"><?php echo $row2['Nome']; ?></option>

                            <?php } ?>
                          </select>

                        </div>



                        <div class="form-group">
                          <label for="exampleInputFile">Veículo</label>
                          <br>
                          <select name="Veiculo_id" class="form-control">

                            <?php $sql2 = 'SELECT * from veiculo where Alugado <> 1 order by Nome_Modelo asc';
                            $query2 = mysqli_query($conexao,$sql2);
                            while ($row2 = mysqli_fetch_assoc($query2)){
                              ?>
                              <option value="<?php echo $row2['id']; ?>">

                                <?php echo $row2['Nome_Modelo'].' '.$row2['Ano_Modelo'].' '.$row2['Motor'] ; ?></option>

                                <?php } ?>
                              </select>

                            </div>

                            <?php 
                          $hj = date('Y-m-d'); 

                            ?>

                            <div class="form-group">
                              <label for="exampleInputBirth">Data Saída</label>
                              <input type="date" class="form-control" id="exampleInputBirth" name="Data_Saida" value="<?php echo $hj; ?>">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputName">Forma de Pagamento</label>
                              <select name="Forma_Pagamento" class="form-control">
                                <option value="Boleto">Boleto Bancário</option>
                                <option value="Crédito">Cartão de Crédito</option>
                                <option value="Débito">Cartão de Débito</option> 
                                <option value="Dinheiro" selected="">Dinheiro</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputName">Diária</label>
                              <select name="Dias" class="form-control">
                                <option value="5">5 Dias</option>
                                <option value="10">10 Dias</option>
                                <option value="15">15 Dias</option> 
                                <option value="30">30 Dias</option>
                                <option value="45">45 Dias</option>
                                <option value="60">60 Dias</option>
                              </select>
                            </div>



                            <div class="form-group">
                              <label for="exampleInputEmail1">Observações</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Digite alguma observação" name="Observacoes">
                            </div>


                          </div>
                          <!-- /.box-body -->          
                          <div class="box-footer">
                            <button type="submit" name="formAlugueis" class="btn btn-success">Cadastrar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          </div>
                        </form>

                      </div>

                    </div>
                  </div>
                </div>




              </section>
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->



          </div>

        </body>

        <!--===============================================================================================-->
        <script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <!--===============================================================================================-->
        <script type="text/javascript" src="bootstrap/js/popper.js"></script>

        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


        <script type="text/javascript">


     /* $(".editar").click(function(){

      var id = $(this).data('id');

      $("[name=ID]").val(id);

     $.ajax({
      url: 'clientes.php',
      type: "POST",

      data: {
        id : id
      },
      success: function (resultado) {

        $('[name=Nome]').val(id);



   


      }
    });


    


    });
  </script>


  <script type="text/javascript">
    
    $('.veiculo_cliente').on('mousedown', function(e) {
   e.preventDefault();
   this.blur();
   window.focus();
});
  </script>
  </html>