<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>BAIXA DE AREES FORMATIVES</title>
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
			<h2>Confirmació de baixa d'area formativa</h2>
			<!-- 
			<?php 
			//if ($inscrits)
			//    echo "<p>En aquest curs hi ha $inscrits alumnes preinscrits";
			?>
			 -->
			<p>Segur que vols esborrar l'area formativa:
			
			<?php  echo " $area->id - $area->nom?";?>
			
			<form method="post" autocomplete="off">
				
				<input type="submit" name="borrar" value="Esborrar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>