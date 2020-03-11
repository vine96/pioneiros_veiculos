<!DOCTYPE html>
<html>

<?php 
include("funcoes/conexao.php");

session_start();

if (!isset($_SESSION['usuario_session'])){
	header ('location: index.php');
}	

if (isset($_GET['erro'])){
echo "<script>alert ('Você não pode deletar um cliente que já tem um veículo alugado');</script>";
}

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
          Clientes
          <small>Gerenciamento de usuários do sistema</small> &nbsp<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Clientes-Adicionar"> Cadastrar Clientes
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
          <li class="active">Clientes</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <div class="row">
          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Lista de Clientes</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">Foto</th>
                      <th>Nome</th>
                      <th>CPF</th>
                      <th>Telefone</th>
                      <th>Endereço</th>
                      <th>E-mail</th>
                      <th>Ativo</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if (isset($_GET['Busca']) && $_GET['Busca'] <> ''){
                      $pesquisa = $_GET['Busca'];
                     $sql = 'SELECT * from clientes where Nome LIKE "%'.$pesquisa.'%" order by id desc';
                    } else {

                      $sql = 'SELECT * from clientes order by id desc';

                    }


                    $query = mysqli_query($conexao,$sql);


                    while ($row = mysqli_fetch_assoc($query)){



                      ?>



                      <tr>
                       <td>

                        <?php if($row['Foto'] <> '' && $row['Foto'] <> 'Array') { ?>

                        <a href="#" data-toggle="modal" data-target="<?php echo '#Imagens'.$row['id'] ?>">
                          <img src="../imagens/clientes/<?php echo $row['Foto']; ?>" class="img-circle img-sm"> <?php } ?>

                        </a>

                      </td>
                      <td><?php echo $row['Nome']; ?></td>
                      <td><?php echo $row['CPF']; ?></td>
                      <td><?php echo $row['Telefone']; ?></td>
                      <td><?php echo $row['Endereco']; ?></td>      
                      <td><?php echo $row['Email']; ?></td>
                      <td><?php if ($row['Ativo']) { echo "Sim"; } else { echo "Não"; } ?></td>

                      <td>

                        <div class="modal about-modal fade" id="Imagens<?php echo $row['id'] ?>" tabindex="-2" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-body" style="color: black">

                               <DIV STYLE="margin-bottom: 10px; width: 100%;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                <div style="width: 100%; aborder: 1px solid black; margin: 0 auto;">

                                  <img style="margin: 0 0; aborder: 1px solid black; max-width: 100%;" src="../imagens/clientes/<?php echo $row['Foto']; ?>">


                                </div>
                              </DIV>                   
                            </div> 
                          </div>
                        </div>
                      </div>



                      <form action="funcoes/excluir.php" method="GET">

                        <button type="button" data-toggle="modal" data-target="#<?php echo $row['id']; ?>" class="btn btn-primary btn-xs btn-flat editar" data-id="<?php echo $row['id']; ?>">Editar</button>

                        <input type="text" name="origem" value="clientes" hidden>
                        <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>

                        <button type="submit" class="btn btn-danger btn-xs btn-flat">Excluir</button>
                      </form>
                    </td>
                  </tr>


                  <div class="modal fade" class="Editar" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
                        </button>
                        <div class="modal-header">
                          <h2 class="modal-title" id="exampleModalLongTitle">Editar Clientes</h2>

                        </div>
                        <div class="modal-body">

                          <!-- /.box-header -->
                          <!-- form start -->
                          <form id="form-user-create" action="funcoes/editar.php" method="POST" enctype="multipart/form-data">

                            <input type="text" hidden class="form-control" name="Id" value="<?php echo $row['id']; ?>">

                            <div class="box-body">

                              <div class="form-group">
                                <label for="exampleInputFile">Foto</label>
                                <input type="file" name="Foto">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputName">Nome</label>
                                <input type="text" class="form-control" placeholder="Digite um nome" name="Nome" value="<?php echo $row['Nome']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputName">Endereço</label>
                                <input type="text" class="form-control" placeholder="Digite o endereço" name="Endereco" value="<?php echo $row['Endereco']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputCPF">CPF</label>
                                <input type="text" class="form-control" oninput="mascara(this)" placeholder="Digite o CPF" name="CPF" value="<?php echo $row['CPF']; ?>">
                                
							  
							  </div>

                              <div class="form-group">
                                <label for="exampleInputBirth">Nascimento</label>
                                <input type="date" class="form-control" name="DataNascimento" value="<?php echo $row['DataNascimento']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Telefone</label>
                                <input type="text" class="form-control fone" placeholder="Digite o telefone" name="Telefone" value="<?php echo $row['Telefone']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control" placeholder="Digite o e-mail" name="Email" value="<?php echo $row['Email']; ?>">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Senha</label>
                                <input type="password" class="form-control" placeholder="Digite uma senha" name="Senha" value="<?php echo $row['Senha']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="exampleInputFile">Situação</label>
                                <br>
                                <select name="Ativo">
                                  <option value="1" <?php if ($row['Ativo'] == 1) { ?> selected <?php } ?>>Ativo</option>
                                  <option value="0" <?php if ($row['Ativo'] == 0) { ?> selected <?php } ?>>Inativo</option>
                                </select>

                              </div>
                            </div>
                            <!-- /.box-body -->          
                            <div class="box-footer">
                              <button type="submit" name="formClientes" class="btn btn-success">Editar</button>
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
        <div class="modal fade" id="Clientes-Adicionar" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="float: right; margin-right: 20px; margin-top: 20px;">X</span>
              </button>
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">Cadastramento de Clientes</h2>

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
                      <label for="exampleInputName">Nome</label>
                      <input type="text" class="form-control" placeholder="Digite um nome" name="Nome">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName">CEP</label>
                      <input type="text" class="form-control" placeholder="Digite o seu CEP" name="CEP">
                    </div>
					
					
                    <div class="form-group">
                      <label for="exampleInputName">Endereço</label>
                      <input type="text" class="form-control" placeholder="Digite um endereço" name="Endereco">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">CPF</label>
                      <input type="text" class="form-control cpf" oninput="mascara(this)" id="exampleInputEmail1" placeholder="Digite o CPF" name="CPF">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputBirth">Nascimento</label>
                      <input type="date" class="form-control" name="DataNascimento">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Telefone</label>
                      <input type="text" class="form-control fone" placeholder="Digite o telefone" name="Telefone">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">E-mail</label>
                      <input type="email" class="form-control" placeholder="Digite o e-mail" name="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Senha</label>
                      <input type="password" class="form-control" placeholder="Digite uma senha" name="Senha">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">Situação</label>
                      <br>
                      <select name="Ativo">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                      </select>

                    </div>
                  </div>
                  <!-- /.box-body -->          
                  <div class="box-footer">
                    <button type="submit" name="formClientes" class="btn btn-success">Cadastrar</button>
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
<script type="text/javascript" src="mask/dist/jquery.mask.js">

</script>

<script>

$(document).ready(function(){
// jQuery Mask Plugin v1.14.11
// github.com/igorescobar/jQuery-Mask-Plugin

var cpfMascara = function (val) {
   return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
},
cpfOptions = {
   onKeyPress: function(val, e, field, options) {
      field.mask(cpfMascara.apply({}, arguments), options);
   }
};
$('.cpf').mask(cpfMascara, cpfOptions);

});
</script>


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





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js">

</script>


<script>

$(document).ready(function(){
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

  $('.fone').mask(SPMaskBehavior, spOptions);
});

</script>





<script>

        $(document).ready(function() {

            //Quando o campo cep perde o foco.
            $("[name=CEP]").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');
				
				
				console.log(cep);

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {


                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
								
								$("[name=Endereco]").val(dados.bairro+' - '+dados.localidade+' - '+dados.uf+' - '+dados.logradouro+', ');
                              
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
		
	

    </script>

              

  </html>