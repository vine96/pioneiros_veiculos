 <!-- Cores -->
      <div class="box categories">
        <h2>Ano <span></span></h2>
        <div class="box-content">
          <ul>
		  
		
            <li style="display: table; margin-right: 4%; width: 100%;">
			
			
			<form method="get" action="">

  			   <select name="ano">
			   
			   <option value="">Selecione o ano</option>
			   
			   <?php
			   
			   $sql = "SELECT * from veiculo group by Ano_Modelo";
				$query = mysqli_query($conexao,$sql);
				
				
				while ($row = mysqli_fetch_array($query)){
			   
			   
			   
			   ?>
			   
			   <option value="<?php echo $row['Ano_Modelo']; ?>" <?php if (isset($_GET['ano']) && $_GET['ano'] == $row['Ano_Modelo']) { ?> selected <?php } ?>><?php echo $row['Ano_Modelo']; ?></option>
			   
			   
			   
				<?php } ?>
			   
			   
			   </select>
			   
			   </form>
					

  			</li>
		
         
          </ul>
        </div>
      </div>
      <!-- End Categories -->