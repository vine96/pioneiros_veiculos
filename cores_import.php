 <!-- Cores -->
      <div class="box categories">
        <h2>Cores <span></span></h2>
        <div class="box-content">
          <ul>
		  <?php
		  
		  $sql = 'SELECT cor from veiculo group by cor';
		  $query = mysqli_query($conexao,$sql);
		  
		  
		  while ($row = mysqli_fetch_assoc($query)){

        $tem = 0;
        
        if (isset($_GET['cor'])){
          
          foreach ($_GET['cor'] as $key => $value) {

            if ($value == $row['cor'])  { 

              $tem = 1;

            } 

          }
        }

		  ?>
		 
            <li style="display: table; margin-right: 4%; width: 100%;">

  				<label style="font-size: 1.3em;">
  					<input <?php if ($tem == 1) { ?> disabled <?php } ?> type="checkbox" name="cor" class="retira_filtro" value="<?php echo ($row['cor']); ?>">

  				
  					<b><?php echo strtoupper($row['cor']); ?></b>
  				</label>

  			</li>
			
		  <?php } ?>
         
          </ul>
        </div>
      </div>
      <!-- End Categories -->