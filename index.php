<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <?php 

  include('funcoes/conexao.php');


  ?>
  <title>Pioneiros Veículos</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

  <link rel="icon" href="imagens/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
  <!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
  <script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
  <script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
  <script src="js/jquery-func.js" type="text/javascript"></script>

</head>
<body>
  <!-- Shell -->
  <div class="shell">
    <!-- Header -->
    <div id="header">

      <div class="row">
       <div class="col-md-4">

         <h1><a href="index.php"></a></h1>

       </div>

       <div class="col-md-4">
         <div class="titulo"><br>
          <h1>Pioneiros Veículos</h1>
        </div>

      </div> 

      <div class="col-md-4">
       <a href="admin" class="price" style="float: right; color: white; text-decoration: none; margin: 10px 10px;" target="_blank">Área do Administrador</a>

     </div>  


   </div>




   <!-- End Cart -->
   <!-- Navigation -->

   <div id="navigation">

	<!--
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">My Account</a></li>
        <li><a href="#">The Store</a></li>
        <li><a href="#">Contact</a></li>
      </ul>-->
    </div>
    <!-- End Navigation -->
  </div>
  <!-- End Header -->
  <!-- Main -->
  <div id="main">
    <div class="cl">&nbsp;</div>

    <div class="container">

       <br>
        <br>

      <div class="row">



        <div id="sidebar" class="col-lg-3 col-md-3 col-sm-12">



          <?php include('filtro_import.php'); ?>


          <?php include('categorias_import.php'); ?>

          <?php include('cores_import.php'); ?>
		  
		  <?php include('ano_import.php'); ?>
		  
		  <?php include('preco_import.php'); ?>

        </div>
        <!-- Content -->
        <div id="content" class="col-lg-9 col-md-9 col-sm-12">


   


          <?php include('veiculos_import.php'); ?>


          

        </div> 
        <!-- End Content -->
        <!-- Sidebar -->

        <!-- End Sidebar -->
        <div class="cl">&nbsp;</div>

      </div>
      <!-- End Main -->
      <!-- Side Full -->

      <!-- End Side Full -->
      <!-- Footer -->
      <div id="footer">
        <p class="left"> <a href="index.php">Home</a> <span>|</span> <a href="#">Atendimento</a> <span>|</span> <a href="#">Minha Conta</a> <span>|</span> <a href="#">Nossa Empresa</a> <span>|</span> <a href="#">Contato</a> </p>
        <p class="right"> &copy; 2018 <a href=""></a> </p>
      </div>
      <!-- End Footer -->
    </div>

  </div>
  <!-- End Shell -->
</body>

<script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
<script type="text/javascript" src="bootstrap/js/popper.js"></script>

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


<script>

  $('.retira_filtro').bind('change',function(){

    var pagina = new Array();

    $('input[name=pagina]:checked').each(function(){
     pagina.push($(this).val());
   });

    var marca = new Array();

    $('input[name=marca]:checked').each(function(){
     marca.push($(this).val());
   });

    var subcat = new Array();
    $('input[name=subcat]:checked').each(function(){
     subcat.push($(this).val());
   });

    var cor = new Array();
    $('input[name=cor]:checked').each(function(){
     cor.push($(this).val());
   }); 


    var tamanho = new Array();


    $('input[name=tamanho]:checked').each(function(){
     tamanho.push($(this).val());

   });

    var preco = new Array();


    $('input[name=preco]:checked').each(function(){
      preco.push($(this).val());

    });

    var ordem = new Array();




    $('select[name=ordem] option:selected').each(function(){


      if ($(this).val() != ''){ 
        ordem.push($(this).val());
      }

    });

    var limite = new Array();




    $('select[name=limite] option:selected').each(function(){


      if ($(this).val() != ''){ 
        limite.push($(this).val());
      }

    });








    
    var paramsArray = []
    var paginaParams = createParamList(pagina,'pagina');
    var marcaParams = createParamList(marca,'marca[]');
    var subcatParams = createParamList(subcat,'subcat[]');
    var tamanhoParams = createParamList(tamanho,'tamanho[]');
    var corParams = createParamList(cor,'cor[]');
    var precoParams = createParamList(preco,'preco');
    var ordemParams = createParamList(ordem,'ordem');
    var limiteParams = createParamList(limite,'limite');

    if (paginaParams)
    {
      paramsArray.push(paginaParams);

    }

    if (marcaParams)
    {
      paramsArray.push(marcaParams);

    }
    if (subcatParams)
    {
     paramsArray.push(subcatParams);
   }
   if (tamanhoParams)
   {
     paramsArray.push(tamanhoParams);
   }
   if (corParams)
   {
     paramsArray.push(corParams);
   }

   if (precoParams)
   {
     paramsArray.push(precoParams);
   }
   if (ordemParams)
   {
     paramsArray.push(ordemParams);
   }
   if (limiteParams)
   {
     paramsArray.push(limiteParams);
   }

   url = window.location.href;
   window.location.assign('index.php?'+paramsArray.join('&'));
 });         

  function createParamList(arrayObj, prefix)
  {
    var result = arrayObj.map(function(obj){return prefix+'='+obj;}).join('&');
    return result;

  }

</script>
<script src="https://unpkg.com/scrollreveal@3.3.2/dist/scrollreveal.min.js"></script>
<script>  


  $("input[type=checkbox]:disabled").parent().css('cursor','no-drop');
  $("input[type=checkbox]:disabled").parent().attr('title','Já está no filtro');
  $("input[type=checkbox]:disabled").attr('title','Já está no filtro');
</script>

<script type="text/javascript">
  

  $(document).ready(function(){
  // Changing the defaults
window.sr = ScrollReveal({reset: false});

sr.reveal('div.titulo h1', {

      distance: '100px',

      origin: 'top',

      duration: 900

    });   



  });
</script>




<script>

$('[name=ano]').on('change', function(){
	console.log("ok");
    $(this).closest('form').submit();
});

</script>
</html>
