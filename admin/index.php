<!DOCTYPE HTML>
<html>
<head>
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">

<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
     <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
  <style type="text/css">
  	
  	*, .btn, input {
  font-size: 14px !important;
}

h2{
  font-size: 18px !important;
}
</style>
  </style> 
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
    <!-- left side start-->
		
    <!-- left side end-->
    
    <!-- main content start-->
		<div >
			<!-- header-starts -->
			
	<!-- //header-ends -->
			<div id="page-wrapper">
				<div class="graphs">
				
						<div class="tab-content">
						<center>
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="funcoes/login.php" method="post">
								<div class="form-group">
									<div class="col-sm-12">
									<label >Usu&aacute;rio:</label><br>
										<input name="usuario" type="text" class="form-control1" id="focusedinput" placeholder="Usu&aacute;rio" required="">
									</div>
									
								</div>
								<div class="form-group">
									<div class="col-sm-12">
									<label >Senha:</label><br>
										<input name="senha" type="password" class="form-control1" id="disabledinput" placeholder="Senha" required="">
									</div>
								</div>
								
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
								<button class="btn-success btn">Entrar</button>
								</div>
							</div>

							<?php if (isset($_GET['erro'])){ ?>


							

							<div style="margin-top: 1%;">Senha ou Email inválidos!</div>

							<?php } ?> 
						 </div>
							</form>
						</div>
						</center>
					</div>
					
					
  	
					  </div>
				</div>
			</div>
		</div>
		<!--footer section start-->
			<footer>

			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>

   <script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<!--===============================================================================================-->
  <script type="text/javascript" src="bootstrap/js/popper.js"></script>
  
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>