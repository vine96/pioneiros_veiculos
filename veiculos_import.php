   <!-- End Content Slider -->
   <!-- VEICULOS -->
   <div class="products">


    <div class="row">
      <ul>

        <?php

if($_SERVER['REQUEST_METHOD']=='GET'){   //FILTRO
  $where = Array();
  $cate = Array();
  $sub = Array();
  $vl = Array();
  $tm = Array();
  $cr = Array();
  $ord = Array();
  $an = Array();


  if (isset($_GET['tamanho'])) {

    foreach ($_GET['tamanho'] as $key => $value) {

      $tamanho = $_GET['tamanho'][$key];
      $tm[] = " para_nome = '{$tamanho}'";

    }

  }

  if (isset($_GET['marca'])) {

    foreach ($_GET['marca'] as $key => $value) {

      $marca = $_GET['marca'][$key];
      $cate[] = " Marca = '{$marca}'";

    }

  }

  if (isset($_GET['cor'])) {
    foreach ($_GET['cor'] as $key => $value) {

      $cor = $_GET['cor'][$key];
      $cr[] = " Cor = '{$cor}'";
    }
  }

  if (isset($_GET['valor_de']) && isset($_GET['valor_ate'])) {

        $valor_de = $_GET['valor_de'];
		 $valor_ate = $_GET['valor_ate'];
   
      $vl[] = " Preco_Aluguel >= '{$valor_de}' && Preco_Aluguel <= '{$valor_ate}'";
    }
	
	
	if (isset($_GET['ano'])) {

        $ano = $_GET['ano'];
   
      $an[] = " Ano_Modelo = '{$ano}'";
    }


}


$sql2 = 'SELECT * from veiculo where Ativo = 1';

if (isset($_GET['Busca'])){

  $pesquisa = $_GET['Busca'];

  $sql2 .= ' AND prod_id LIKE "%'.$pesquisa.'%" OR prod_nome LIKE "%'.$pesquisa.'%"'; 

}

if(sizeof( $an ))
  $sql2 .= ' AND '.'('.implode( ' OR ',$an ).')'; 

if(sizeof( $vl ))
  $sql2 .= ' AND '.'('.implode( ' OR ',$vl ).')'; 

if(sizeof($cate))
  $sql2 .= ' AND '.'('.implode( ' OR ',$cate ).')';

if(sizeof( $cr ))
  $sql2 .= ' AND '.'('.implode( ' OR ',$cr ).')'; 

if(!(sizeof($ord))){
  $sql2 .= ' ORDER BY id DESC';
}

$query = mysqli_query($conexao,$sql2);
$total_geral = mysqli_num_rows($query);

$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;

//Seta a quantidade por pagina

if (isset($_GET['limite'])){
  $quantidade_pg = $_GET['limite'];
}
else {
      $quantidade_pg = 100; //padrao por página sem escolha no select
    }

    if ($quantidade_pg > $total_geral)
      $num_pagina = 1;
else//calcular o número de pagina necessárias para apresentar
$num_pagina = ceil($total_geral/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$sql = $sql2." LIMIT $incio, $quantidade_pg";
$query = mysqli_query($conexao,$sql);




$total = mysqli_num_rows($query);



while ($row = mysqli_fetch_assoc($query)){



  if ($row['Alugado'] == 0){
    $situacao = '<span style="color: green;">Disponível</span>';
  } else {
    $situacao = '<span style="color: red;">Alugado</span>';
  }


  ?>
  <li class="col-md-6 col-lg-4 col-sm-12"> <a href="#">

    <div class="imagem-product">

      <a href="#" data-toggle="modal" data-target="<?php echo '#Imagem'.$row['id'] ?>"><img class="centralizarImagem" src="imagens/veiculos/<?php echo $row['Foto']; ?>" alt="" /></a>

    </div>

  </a>
  <div class="product-info">
    <center><h3><?php echo $row['Nome_Modelo']; ?></h3></center>
    <div class="product-desc">
      <h4><?php echo $row['Ano_Modelo']; ?></h4>
      <h4><?php echo $row['Marca']; ?></h4>

      <strong class="price"><?php echo 'R$ '.$row['Preco_Aluguel']; ?></strong> </div>
      <center><b><h2 style="font-size: 2.0em;"><?php echo $situacao; ?></h2></b></center>

      <br>
      <center><a href="#" data-toggle="modal" data-target="<?php echo '#Detalhes'.$row['id'] ?>"><button class="btn btn-success">Ver Mais detalhes</button></a></center>
      <br>
    </div>
  </li>
  
  <div class="modal about-modal fade" id="Imagem<?php echo $row['id'] ?>" tabindex="-2" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" style="color: black">

         <DIV STYLE="margin-bottom: 10px; width: 100%;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  
		  <div style="width: 100%;">
		  <img style="max-width: 100%;" src="imagens/veiculos/<?php echo $row['Foto']; ?>" alt="" />
          </div>
          
        </DIV>                   
      </div> 
    </div>
  </div>
</div>
  
  
  

  <div class="modal about-modal fade" id="Detalhes<?php echo $row['id'] ?>" tabindex="-2" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" style="color: black">

         <DIV STYLE="margin-bottom: 10px; width: 100%;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          <div class="detalhes" style="width: 100%; aborder: 1px solid black; margin: 0 auto;">

           <center><h2><?php echo $row['Nome_Modelo'] ?></h2></center>
           <br>
           <strong>Ano: </strong><span><?php echo $row['Ano_Modelo'] ?></span><br>
           <strong>Placa: </strong><span><?php echo $row['Placa'] ?></span><br>
           <strong>Marca: </strong><span><?php echo $row['Marca'] ?></span><br>
            <strong>Cor: </strong><span><?php echo $row['Cor'] ?></span><br>
            <strong>Preço Custo: </strong><span><?php echo $row['Preco_Custo'] ?></span><br>
            <strong>Preço Aluguel: </strong><span><?php echo $row['Preco_Aluguel'] ?></span><br>
            <strong>IPVA Pago:</strong><span><?php if ($row['IPVA_Pago']) echo 'Sim'; else echo 'Não'; ?></span><br>
            <strong>Câmbio Automático: </strong><span><?php if ($row['Cambio_Automatico']) echo 'Sim'; else echo 'Não'; ?></span><br>
            <strong>Ar Condicionado: </strong><span><?php if ($row['Ar_Condicionado']) echo 'Sim'; else echo 'Não'; ?></span><br>
            <strong>Motor: </strong><span><?php echo $row['Motor'] ?></span><br>
            <strong>Combustível: </strong><span><?php echo $row['Combustivel'] ?></span><br>


          </div>
        </DIV>                   
      </div> 
    </div>
  </div>
</div>







<?php } ?>

</ul>
</div>
<!-- Pagination -->

<?php
        //Verificar a pagina anterior e posterior
$pagina_anterior = $pagina - 1;
$pagina_posterior = $pagina + 1;


?>



<div class="cl">&nbsp;</div>



</div>

<div style="width: 100%; padding-top: 3%;">
  <center>
    <ul class="pagination" style="width: 33%;">

      <?php if($num_pagina >= 1 && $total_geral > 0){ ?>

      <li>
        <?php

        if($pagina_anterior != 0){ ?>
        <label label style="cursor: pointer;" class="item-pagination flex-c-m trans-0-4" aria-label="Previous">
          <input type="radio" hidden name="pagina" class="retira_filtro" value="<?php echo $num_pagina/$num_pagina ?>"><span aria-hidden="true" style="font-size: 3.2em;">«</span>
        </label>
        <?php } else{ ?>
        <span aria-hidden="true" style="font-size: 3.2em;">«</span>
        <?php }  ?>
      </li>


      <?php 

            $lim = 3; //limite de links da direita e esquerda

            $inicio = ((($pagina - $lim) > 1) ? $pagina - $lim : 1);
            $fim = ((($pagina+$lim) < $num_pagina) ? $pagina+$lim : $num_pagina);


            

            for ($i = $inicio; $i <= $fim; $i++) { ?>
            <label style="cursor: pointer;" class="item-pagination flex-c-m trans-0-4 ">
              <li <?php if ($i == $pagina) { ?> class="btn btn-dark" <?php } else { ?> class="btn btn-light" <?php } ?>">

                <input type="radio" hidden name="pagina" class="retira_filtro" value="<?php echo $i ?>" <?php if (isset($_GET['pagina']) && $_GET['pagina'] == $i) { ?> checked <?php } ?>>

                <?php echo $i; ?>

              </li>
            </label>
            <?php } ?>
            <li>
              <?php
              if($pagina_posterior <= $num_pagina){ ?>
              <label class="item-pagination flex-c-m trans-0-4" href="#" aria-label="Previous">
                <input type="radio" hidden name="pagina" class="retira_filtro" value="<?php echo $num_pagina ?>"><span aria-hidden="true" style="font-size: 3.2em;">»</span>
              </label>
              <?php }else{ ?>
              <span aria-hidden="true" style="font-size: 3.2em;">»</span>
              <?php }  ?>
            </li>


            <?php } ?>

          </ul>
        </center>

      </div> 


      <!-- End Products -->