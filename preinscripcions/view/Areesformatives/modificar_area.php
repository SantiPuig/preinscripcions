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
		
		<a class="derecha" href='index.php?controlador=areaformativa&operacion=borrar&parametro=<?php echo $area->id;?>'> 
  		<img class='boton' src='images/botones/delete.png'> </a>				
			<h2>Modificació area formativa</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off" id="modificar">
			
			<label>Codi:</label> 
			<input type="text" name="id" 
					value="<?php echo $area->id;?>" disabled/><br>
						
			<label>nom:</label>
			<input type="text" name="nom" 
					value="<?php echo $area->nom;?>"/>
			<br>
			<input type="submit" name="modificar" value="modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>