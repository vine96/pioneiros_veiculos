 <!-- FILTRO -->
   
<?php if (!(empty($_GET))){ ?>   
      <div class="box categories">

        <h2>Filtro <span></span></h2>
        <div class="box-content">
<!--FILTROS ATIVADOS -->

<?php if (!(empty($_GET))){ ?>

<div class="filtro col-sm-12 col-md-12 col-lg-12" style="font-size: 1.5em;">
	<div class="">
		Filtrando Por: <a href="index.php" class="limpatamanho" style="color: red; float: right;">Limpar Filtro</a><br>
		
	</div>
	 <br>

	<ul style="font-size: 0.9em;">
	

<?php

if (isset($_GET['Busca'])) { 

$pesquisa = $_GET['Busca'];

?>

<li>
			<input type="checkbox" name="pesquisa" class="retira_filtro" 
			value=""
			<?php if (isset($_GET['Busca'])) { ?> checked <?php } ?>>
			<?php echo 'Pesquisa: <b>'.$pesquisa;  ?></b></li>

			<?php } 


	if (isset($_GET['marca'])) { 

foreach ($_GET['marca'] as $key => $value) {

$marca = $_GET['marca'][$key];

		?>

		<li>
			<input type="checkbox" name="marca" class="retira_filtro" 
			value="<?php echo $marca ?>"
			<?php if (isset($_GET['marca'])) { ?> checked <?php } ?>>
			<?php echo 'Marca: '.$marca ?></li>

			<?php } }	

if (isset($_GET['cor'])) {

foreach ($_GET['cor'] as $key => $value) { 

			?>

		<li>
			<input type="checkbox" name="cor" class="retira_filtro" 
			value="<?php echo $value ?>"
			<?php if ($_GET['cor'][$key] == $value) { ?> checked <?php } ?>>
			<?php echo "Cor: ".$value."" ?></li>

<?php } } 

if (isset($_GET['valor_de']) && isset($_GET['valor_ate'])) {

			?>

		<li>
			
			
			<?php echo "Preço: De R$".$_GET['valor_de']." Até R$".$_GET['valor_ate']; ?>
			
			</li>

<?php  } 


if (isset($_GET['ano'])) {

			?>

			<li>
		
			<?php echo "Ano: ".$_GET['ano']; ?>
			
			</li>

<?php  } 

			?>

			</ul>



			</div>

<?php } ?>
        </div>
      </div>
 <?php }  ?>   
      <!-- End Search -->