<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificació detalls del curs</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
		<a class="derecha" href="index.php?controlador=curso&operacion=borrar&parametro=<?php echo $curs->id;?>">Esborrar</a>
				
			<h2>Modificació de curs</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off" id="modificar">
				
								
			
			<label>Codi:</label> 
			<input type="text" name="codi" 
					value="<?php echo $curs->codi;?>"/><br>
						
			<label>Area:</label>
			<select name="id_area" required="required">
			<?php 
				//var_dump($arees);
				if (!empty($arees)) 
					foreach ($arees as $area)
						if ($curs->id_area==$area->id)
							echo "<option selected='selected' value='$area->id'>$area->nom</option>";
						else 			
							echo "<option value='$area->id'>$area->nom</option>";
						
				
			?>	          
		    </select>	          
				          
			<br>			
			<label>Nom:</label>
			<input type="text" name="nom" 
					value="<?php echo $curs->nom;?>"/>
			<br>			
			<label>Descripcio:</label><br>
			<textarea rows="8" cols="60" name="descripcio" form="modificar"><?php 	echo $curs->descripcio;?>
			</textarea>
			<br>
			<label>Hores:</label>
			<input type="number" name="hores" 
					pattern="^[0-9]{,3}" title="Valor numérico en horas"
					value="<?php echo $curs->hores;?>"/>
			<br>		
			<label>Data inici:</label>
			<input type="date" name="data_inici" 
					pattern="20[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))" 
					title="Data d'inici: quatre digits per l'any, dos pel mes i dos per al dia"
					placeholder="Introduir la data en format AAAA-MM-DD"
					value="<?php echo $curs->data_inici;?>"/>
			<br>				
			<label>Data fi:</label>
			<input type="date" name="data_fi" 
					pattern="20[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))" 
					title="Data fi de curs: quatre digits per l'any, dos pel mes i dos per al dia"
					placeholder="Introduir la data en format AAAA-MM-DD"
					value="<?php echo $curs->data_fi;?>"/>
			<br>				
			<label>Horari:</label>
			<input type="text" name="horari"
					value="<?php echo $curs->horari;?>"/>
			<br>				
			<label>Torn:</label>
			<select name="torn">
			<?php 
				$torns=array(M=>'Mati', T=>'Tarda',C=>'Complert');
				/*$torns['M']="Mati";
				$torns["T"]="Tarda";
				$torns["C"]="Complert";*/
				
				foreach($torns as $t=>$tn)
					if ($t==$curs->torn)
						echo "<option selected='selected' value='$t'>$tn</option>";
					else
						echo "<option value='$t'>$tn</option>";
					
			?>
			</select>
			<br>
			<label>Tipus:</label>
			<input type="text" name="tipus" value="<?php echo $curs->tipus; ?>"/>
			<br>
			<label>Requisits:</label><br>
			<textarea rows="8" cols="60" name="requisits" form="modificar"><?php 	echo $curs->requisits;?>
			</textarea>	
			<br>
			
			<input type="submit" name="modificar" value="modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>