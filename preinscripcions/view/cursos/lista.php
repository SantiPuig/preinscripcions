<a name="Ancla"></a>
<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>LLISTAT CURSOS</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header();

			if(!$usuario) Template::login();
			else Template::logout($usuario);
			
			Template::menu($usuario);

		?>
		
	
		<section id="filtre">
			<h2>LLISTAT CURSOS</h2><strong>		
			<div id="filtreform" align=center>		
				<form method="post" enctype="multipart/form-data" autocomplete="off">
					<fieldset id="dates">
						<legend>Seleccio per data d'inici</legend>
						<label>Des de data</label>
						<input type="text" name="filtros[desded]" id="desded" value="<?php echo empty($filtros['desded'])?'':$filtros['desded'];?>" /><br>
						
						<label>Fins a  data</label>
						<input type="text" name="filtros[finsd]" id="finsd" value="<?php echo empty($filtros['finsd'])?'':$filtros['finsd'];?>" /><br>			
					</fieldset>
		
					<fieldset id="filtres">
						<legend>Selecció de curs</legend>
						<label>codi curs</label>
						<input type="text" name="filtros[codi]" id="codi" value="<?php echo empty($filtros['codi'])?'':$filtros['codi'];?>" />	
						<label>nom del curs</label>						
						<input type="text" name="filtros[nom]" id="nom" value="<?php echo empty($filtros['nom'])?'':$filtros['nom'];?>" /><br>		
						<label>nombre d'hores</label>						
						<input type="text" name="filtros[hores]" id="hores" value="<?php echo empty($filtros['hores'])?'':$filtros['hores'];?>" />
						<label>Tipus</label>						
						<input type="text" name="filtros[tipus]" id="tipus" list="tipos" value="<?php echo empty($filtros['tipus'])?'':$filtros['tipus'];?>" />
						<?php 
						if (!empty($tipos))
							echo "<datalist id='tipos'>";
							foreach ($tipos as $t)
								echo "<option value='$t'>";
							echo "</datalist>";
						?>
						<br>	
						<label>Area Formativa</label>
						<select name="filtros[id_area]">
						<option value=""></option>
						<?php 
							if (!empty($arees)) 
								foreach ($arees as $area)
									if ($filtros['id_area']==$area->id)
										echo "<option selected='selected' value='$area->id'>$area->nom</option>";
									else 			
										echo "<option value='$area->id'>$area->nom</option>";
									
							
						?>							
						</select>
						<br>				
					</fieldset>
					<input type="submit" value="cercar" id="cercar" autofocus/>
				</form>
				</div>
		</section>
		<section id="content">
			
		<?php if (!empty($cursos)) {?>	
		<table>
		<tr>
		<th>Codi Curs</th><th>Nom del curs</th><th>Hores</th><th>data inici</th><th>Data fi</th><th>Detalls</th>
		</tr>
				<?php
				$nom_af="zz";
			  foreach($cursos as $curs){
			  	 if($curs->nom_area!=$nom_af){			
			  	    $nom_af=$curs->nom_area;
			  	  	echo "<tr><th colspan=6 align=Center>$nom_af</th></tr>";
			  	}   
		  	    echo "<tr>";
		  		echo "<td>$curs->codi</td>";
		  		echo "<td><a href='index.php?controlador=curso&operacion=ver&parametro=$curs->id'>$curs->nom</a></td>";
		  		echo "<td>$curs->hores</td>";
		  		echo "<td>$curs->data_inici</td>";
		  		echo "<td>$curs->data_fi</td>";
		  		echo "<td>";
		  		echo "<a href='index.php?controlador=curso&operacion=ver&parametro=$curs->id'> ";
		  		echo "<img class='boton' src='images/botones/ver.png' height='24' width='24'> </a>"; 
		  		echo "</td></tr>";
			 
			  }
			  echo "</table>";
		}
			?>
			
			<a class='volver' href=index.php>Tornar a l'inici</a>			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>