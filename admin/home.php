<!DOCTYPE html>
<html>

<?php 
include("funcoes/conexao.php");

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

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <style type="text/css">


    *, .btn, input {
      font-size: 14px !important;
    }

    h2{
      font-size: 18px !important;
    }
  </style>
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
        Home
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="/"><i class="fa fa-home"></i> Home</a></li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div class="col-md-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">


              <?php 
              $sql = 'SELECT count(*) as count from admin';
              $query = mysqli_query($conexao,$sql);
              $row_admin = mysqli_fetch_assoc($query);

              $sql = 'SELECT count(*) as count from clientes';
              $query = mysqli_query($conexao,$sql);
              $row_clientes = mysqli_fetch_assoc($query);

              $sql = 'SELECT count(*) as count from veiculo';
              $query = mysqli_query($conexao,$sql);
              $row_veiculo = mysqli_fetch_assoc($query);

              $sql = 'SELECT count(*) as count from aluguel';
              $query = mysqli_query($conexao,$sql);
              $row_aluguel = mysqli_fetch_assoc($query);


              ?>

              <style type="text/css">
                
                .row .col-md-3 { height: 100px; width: 100%; background: green; color: white; 

                                 

                display: flex;
                display: -webkit-flex; /* Garante compatibilidade com navegador Safari. */
                justify-content: center;
                align-items: center;

                 }

                 .itens{
                  font-size: 20px;
                 }
              </style>

              <div class="container-fluid">

             

                <div class="col-md-2 col-sm-4 ml-2"><div class="itens"> Administradores <?php echo '['.$row_admin['count'].']'?></div></div>
                <div class="col-md-2 col-sm-4 ml-2"> <div class="itens">Clientes <?php echo '['.$row_clientes['count'].']'?></div></div>
                <div class="col-md-2 col-sm-4 ml-2"> <div class="itens">Veículos <?php echo '['.$row_veiculo['count'].']'?></div></div>
                <div class="col-md-2 col-sm-2 ml-2"> <div class="itens">Alugueis <?php echo '['.$row_aluguel['count'].']'?></div></div>

                <!--
                <div class="col-md-3 col-sm-2 ml-2"> <div class="itens">Lucro Total <?php echo '['.$row_lucrototal['total'].']'?></div></div>
                <div class="col-md-3 col-sm-2 ml-2 mt-2"> <div class="itens">Lucro no Mês <?php echo '['.$row_lucromes['mes'].']'?></div></div>-->


              </div>

            
              

        <!--
              <input type="text" name="cpf" id="cpf">
              <input type="text" name="cvv" id="cvv">

			    <input type="text" oninput="mascara(this)" name="cpf" id="cpfcnpj">-->




           <br>
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

  <script>
  
function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

}
  
  </script>
  
  
  <script type="text/javascript">
  
  
  


    $("#cvv").focus(function(){
		
		var n = $("#cpf").val().length;
		
		console.log(n);
		
      if (n != 10) {
            //alert("This field is required");
            $("#cpf").attr("placeholder", "Preencha o número do cartão!");
            $("#cpf").css('border','2px solid red');
            $("#cpf").focus();
          } else{
           $("#cpf").removeAttr('style');
         }
       });

     </script>



     </html>