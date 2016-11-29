<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificació area formativa</title>
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
		
			
			<a class="derecha" href='index.php?controlador=areaformativa&operacion=modificar&parametro=<?php echo $area->id;?>'> 
 			 	  <img class='boton' src='images/botones/modify.png'></a>
  			
			<h2>Consulta area formativa</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off" id="modificar">
			
			<label>Codi:</label> 
			<input type="text" name="id" 
					value="<?php echo $area->id;?>" disabled/><br>
						
			<label>nom:</label>
			<input type="text" name="nom" 
					value="<?php echo $area->nom;?>" disabled/>
			<br>
			</form>
			<?php  if (empty($subscripcions)) { ?>
				<h2>No hi ha susbcripcions d'aquesta area</h2>
			<?php } else {?>
				<h2>Suscripcions d'aquesta area</h2>
				<table>
			<tr>
				<th>dni</th><th>nom</th><th>telèfon mòbil</th><th>telèfon fix</th><th>email</th><th>data inscripció</th>
				<th># inscripcions</th><th>Opcions</th>
			</tr>
			<?php 
				foreach ($subscripcions as $a) {
					echo "<tr>";
					echo "<td>$a->dni</td>";
					echo "<td>$a->nom</td>";
					echo "<td>$a->telefon_mobil</td>";
					echo "<td>$a->telefon_fix</td>";
					echo "<td>$a->email</td>";
					echo "<td>$a->data</td>";
					echo "<td>$a->subscripcions</td>";
					echo "<td><a href='index.php?controlador=usuario&operacion=modificacion&parametro=$a->id_usuari'>";
					echo "<img class='boton' src='images/botones/ver.png'> </a>";
					echo "<a href='index.php?controlador=Areaformativa&operacion=baja&parametro=$area->id&usuari=$a->id_usuari&vista=detalles_curso'> ";
					echo "<img class='boton' src='images/botones/delete.png'> </a></td>";
					echo "</tr>";
						
				}
			
			?>
				
				</table>
				<br>
				<div class=uno>
				<a href="index.php?controlador=areaformativa&operacion=exportar&parametro=<?php echo $area->id; ?>">
				Exportar a XML</a>
				</div>
			<?php }?>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>