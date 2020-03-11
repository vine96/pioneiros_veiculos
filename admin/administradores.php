<!DOCTYPE html>
<html>

<?php 
include("funcoes/conexao.php");


?>
<head>

  <script type="text/javascript" src="js/mask/jquery.mask.min.js"/></script>
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
          Administradores
          <small>Gerenciamento de administradores do sistema</small> &nbsp<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Administradores-Adicionar"> Cadastrar Administradores
          </button>

          <div class="form-group">

            <form method="get">


              <label for="exampleInputName">Busca</label>
              <input type="text" name="Busca"><button type="submit" class="btn btn-primary">Buscar</button>
            

          </form>

          </div>

          
        </h1>
        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">Administradores</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <div class="row">
          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista de Administradores</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      
                      <th width="30%">Usuário</th>
                      <th width="30%">Senha</th>
                      <th width="39%">Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_GET['Busca']) && $_GET['Busca'] <> ''){
                      $pesquisa = $_GET['Busca'];
                     $sql = 'SELECT * from admin where Usuario LIKE "%'.$pesquisa.'%" order by id desc';
                    } else {

                      $sql = 'SELECT * from admin order by id desc';

                    }


                    $query = mysqli_query($conexao,$sql);
                  $linhas = mysqli_affected_rows($conexao);


                    while ($row = mysqli_fetch_assoc($query)){



                      ?>



                      <tr>


                    
                      <td><?php echo $row['Usuario']; ?></td>
                      <td><?php echo $row['Senha']; ?></td>

                      <td>
                        <form action="funcoes/excluir.php" method="GET">

                        <button type="button" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class="btn btn-primary btn-xs btn-flat editar" data-id="<?php echo $row['id']; ?>">Editar</button>

                        <input type="text" name="origem" value="administradores" hidden>
                        <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>


                        <?php if ($linhas > 1) { ?>

                        <button type="submit" class="btn btn-danger btn-xs btn-flat">Excluir</button>

                        <?php } ?>
                      </form>


                       <div class="modal fade" class="Editar" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                        </button>
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLongTitle">Editar Administradores</h2>

                        </div>
                        <div class="modal-body">

                          <!-- /.box-header -->
                          <!-- form start -->
                          <form id="form-user-create" action="funcoes/editar.php" method="POST" enctype="multipart/form-data">

                            <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id']; ?>">

                            <div class="box-body">

                              

                              <div class="form-group">
                                <label for="exampleInputName">Usuário</label>
                                <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o usuário" name="Usuario" value="<?php echo $row['Usuario']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputName">Senha</label>
                                <input type="password" class="form-control" id="exampleInputName" placeholder="Digite a senha" name="Senha" value="<?php echo $row['Senha']; ?>">
                              </div>

                              
                            </div>
                            <!-- /.box-body -->          
                            <div class="box-footer">
                              <button type="submit" name="formAdministradores" class="btn btn-success">Editar</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                          </form>

                        </div>

                      </div>
                    </div>
                  </div>


                    </td>
                      

                    
                  </tr>


                 

                  <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

        </div>
        <div class="modal fade" id="Administradores-Adicionar" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
              </button>
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Cadastramento de Administradores</h2>

              </div>

              <div class="modal-body">

                <!-- /.box-header -->
                <!-- form start -->
                  <form id="form-user-create" action="funcoes/adicionar.php" method="POST" enctype="multipart/form-data">

                            <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id']; ?>">

                            <div class="box-body">

                              

                              <div class="form-group">
                                <label for="exampleInputName">Usuário</label>
                                <input type="text" class="form-control" id="exampleInputName" placeholder="Digite o usuário" name="Usuario">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputName">Senha</label>
                                <input type="password" class="form-control" id="exampleInputName" placeholder="Digite a senha" name="Senha">
                              </div>

                              
                            </div>
                            <!-- /.box-body -->          
                            <div class="box-footer">
                              <button type="submit" name="formAdministradores" class="btn btn-success">Cadastrar</button>
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


  <script type="text/javascript">// <![CDATA[
$(document).ready(function(){



$('.fone').mask('(00) 00000-0000');


$('.cpf').mask('000.000.000-00');




});


</script>
  </html>