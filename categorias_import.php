  <!-- Categories -->
      <div class="box categories">
        <h2>Marcas <span></span></h2>
        <div class="box-content">
          <ul>
		  <?php
		  
		  $sql = 'SELECT marca from veiculo group by marca';
		  $query = mysqli_query($conexao,$sql);
		  
		  
		  while ($row = mysqli_fetch_assoc($query)){

		  	$tem = 0;
  			
  			if (isset($_GET['marca'])){
  				
  				foreach ($_GET['marca'] as $key => $value) {

  					if ($value == $row['marca'])  { 

  						$tem = 1;

  					} 

  				}
  			}
  	

		  ?>
		 

            <li style="display: table; margin-right: 4%; width: 100%;">

  				<label style="font-size: 1.3em;">
  					<input <?php if ($tem == 1) { ?> disabled <?php } ?> type="checkbox" name="marca" class="retira_filtro" value="<?php echo $row['marca']; ?>">

  				
  					<b><?php echo $row['marca']; ?></b>
  				</label>

  			</li>

           
			
		  <?php } ?>
         
          </ul>
        </div>
      </div>
	  
	 
      <!-- End Categories -->