<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>LLISTAT ALUMNES</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header();

			if(!$usuario) Template::login();
			else Template::logout($usuario);
			
			Template::menu($usuario);
			/*
			 * En alumnes m'arriba un array bidimensional amb les columnes:
			 *  0->Id alumno
			 *  1->Nombre y apellidos
			 *  2->Edat
			 *  3->email
			 *  4->prestacion(SI/no)
			 *  5->Situacion laboral (int)
			 *  6->Telefono fijo
			 *  7->Telefono mobil
			 *  8->Numero de preinscripciones a cursos
			 */

		?>
		
		<section id="content">
			<h2>LLISTAT ALUMNES</h2>
			
		    <div class="llistat flex-container">
				<div class="flexgran">Nom</div>				
				<div class="flex centrado">Edat</div>				
				<div class="flexgran">Email</div>				
				<div class="flex">Prestacio</div>				
				<div class="flex">Tel. fix</div>				
				<div class="flex">Tel. Mòbil</div>				
				<div class="flex">inscripcions</div>				
			</div>
			<?php
			//<a href="index.php?controlador=Usuario&operacion=ver&parametro=
			  foreach($alumnes as $a){
			  	    echo "<div class='contenido flex-container'>";
			  		echo "<div class='flexgran'><a href='index.php?controlador=Usuario&operacion=modificacion&parametro=$a->id'>$a->nom</a></div>";
			  		echo "<div class='flex centrado'>$a->edat</div>";
			  		echo "<div class='flexgran'>$a->email</div>";
			  		echo "<div class='flex'>$a->prestacio</div>";
			  		echo "<div class='flex'>$a->telefon_fix</div>";
			  		echo "<div class='flex'>$a->telefon_mobil</div>";
			  		echo "<div class='flex'>$a->inscripcions</div>";		
			  	echo "</div>";	
			  }
			?>
			
			<a class='volver' href=index.php>Tornar a l'inici</a>			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>