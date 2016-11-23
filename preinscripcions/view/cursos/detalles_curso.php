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
			
		<h2>Detalls del curs <?php echo $curso->codi;?></h2>	
		<?php 
			$torns=array('M'=>'Mati', 'T'=>'Tarda','C'=>'Complert');
			//var_dump($torns);
			
			echo "<b>codi</b>:$curso->codi<br>";
			echo "<b>Area formativa:</b>$areaformativa<br>";
			echo "<b>Nom:</b>$curso->nom<br>";
			echo "<b>Descripció:</b>$curso->descripcio<br>";
			echo "<b>hores:</b>$curso->hores<br>";
			echo "<b>data inici:</b>$curso->data_inici<br>";
			echo "<b>data fi:</b>$curso->data_fi<br>";
			echo "<b>horari:</b>$curso->horari<br>";
			//var_dump($curso);
			if (!$curso->torn)
				$torn="Sense definir";
			else 
				$torn=$torns[$curso->torn];			
		
			echo "<b>torn:</b>$torn<br>";
			echo "<b>tipus:</b>$curso->tipus<br>";
			echo "<b>requisits d'accés:</b>$curso->requisits<br>";
			
			if ($usuario)
				echo "<input type='button' onclick='location.href=\"index.php?controlador=Preinscripcio&operacion=nuevo&parametro=$curso->id\";' value='Inscriure'/><br>";
			
				
				
		?>
 				
			<a class='volver' href=index.php>Volver a inicio</a>			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>