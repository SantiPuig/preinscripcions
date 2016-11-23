<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Creació de nou curs</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			/*
			 * Necesita ser llamado, pasando los siguientes datos en parametros:
			 * arees: array con las distintas areas. Array bidimensional de tipo clave=>valor
			 * 
			 */
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
		
		<section id="content">
			
			<h2>Formulari d'alta de nou curs</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off" id="modificar">
				
								
			
			<label>Codi:</label> 
			<input type="text" name="codi"/><br>
						
			<label>Area:</label>
		
			<select name="id_area" required="required">
			<?php 
				//var_dump($arees);
				if (!empty($arees)) 
					foreach ($arees as $area)
						echo "<option value='$area->id'>$area->nom</option>";			
			?>	          
		    </select>	          
				          
			<br>			
			<label>Nom:</label>
			<input type="text" name="nom" />
			<br>			
			<label>Descripcio:</label><br>
			<textarea rows="8" cols="60" name="descripcio" form="modificar">
			</textarea>
			<br>
			<label>Hores:</label>
			<input type="number" name="hores" 
					pattern="^[0-9]{,3}" title="Valor numérico en horas"/>
			<br>		
			<label>Data inici:</label>
			<input type="date" name="data_inici" 
					pattern="20[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))" 
					title="Data d'inici: quatre digits per l'any, dos pel mes i dos per al dia"
					placeholder="AAAA-MM-DD"/>
			<br>				
			<label>Data fi:</label>
			<input type="date" name="data_fi" 
					pattern="20[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))" 
					title="Data fi de curs: quatre digits per l'any, dos pel mes i dos per al dia"
					placeholder="AAAA-MM-DD"/>
			<br>				
			<label>Horari:</label>
			<input type="text" name="horari"/>
			<br>				
			<label>Torn:</label>
			<select name="torn">
			<?php 
				$torns=array(M=>'Mati', T=>'Tarda',C=>'Complert');							
				foreach($torns as $t=>$tn)
						echo "<option value='$t'>$tn</option>";					
			?>
			</select>
			<br>
			<label>Tipus:</label>
			<input type="text" name="tipus" "/>
			<br>
			<label>Requisits:</label><br>
			<textarea rows="8" cols="60" name="requisits" form="modificar"></textarea>	
			<br>			
			<input type="submit" name="guardar" value="guardar"/><br/>
			</form>	
		</section>
		
		<?php Template::footer();?>
    </body>
</html>