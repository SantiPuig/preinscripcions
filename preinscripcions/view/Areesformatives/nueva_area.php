<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Alta d'arees formatives</title>
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
			
			<h2>Formulari de creació d'arees formatives</h2>
			<h3>Arees formatives actuals</h3>
			<table>
			<tr><th>codi</th><th>nom</th><th>Opcions</th></tr>
			<?php 
			   foreach($arees as $a) {
			   	  echo "<tr><td>$a->id</td><td>$a->nom</td>";
			   	  echo "<td><a href='index.php?controlador=areaformativa&operacion=ver&parametro=$a->id' title='veure alumnes preinscrits '>";
			   	  echo "<img class='boton' src='images/botones/ver.png'> </a>";
			   	  echo "<a href='index.php?controlador=areaformativa&operacion=modificar&parametro=$a->id' title='Modificar area formativa'>";
			 	  echo "<img class='boton' src='images/botones/modify.png'></a>" ; 
			  	  echo "<a href='index.php?controlador=areaformativa&operacion=borrar&parametro=$a->id' title=Donar de baixa area formativa'> ";
  		  		  echo "<img class='boton' src='images/botones/delete.png'> </a></td></tr>";
  		  		  
			   }
			?>
						   
			</table>			
			<h2>Afegir nova area formativa</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
			<label>Nom:</label>
			<input type="text" name="nom">
			
			<input type="submit" name="guardar" value="guardar"/><br/>
			</form>	
		</section>
		
		<?php Template::footer();?>
    </body>
</html>