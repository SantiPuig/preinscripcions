<!DOCTYPE html>
<html>
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
		
		<section id="content">
			<h2>LLISTAT CURSOS</h2><strong>
			    <div class="llistat cursos container">
				<div class="flex">Codi curs</div>				
				<div class="flex">Nom del curs</div>				
				<div class="flex">Número d'hores</div>				
				<div class="flex">Nivell CP</div>				
				<div class="flex">Familia Professional</div>				
				<div class="flex">Horari</div>				
				<div class="flex">Torn</div>				
					
			</div></strong>
			<?php
			  foreach($cursos as $curs){
			  	    echo "<div class='contenido flex-container'>";
			  		echo "<div class='flex'>$curs->Codi curs</div>";
			  		echo "<div class='flex'>$curs>Nom del curs</div>";
			  		echo "<div class='flex'>$curs->Número d'hores</div>";
			  		echo "<div class='flex'>$curs->Nivell CP</div>";
			  		echo "<div class='flex'>$curs->Familia Professional</div>";
			  		echo "<div class='flexmac'>$curs->Horari</div>";
			  		echo "<div class='flexmac'>$curs->Torn</div>";
			  		echo "<div class='flex'>";
			  		echo "<a href='index.php?controlador=pc&operacion=ver&parametro=$curs->id_pc'>";
			  		echo "<img class='boton' src='images/botones/ver.png' height='24' width='24'></a>";  		
			  		echo "</div>";
			  	echo "</div>";	
			  }
			?>
			
			<a class='volver' href=index.php>Volver a inicio</a>			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>