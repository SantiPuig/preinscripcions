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
		
	
		<section id="content">
			
		<h2>Detalls del curs <?php echo $curso->codi;?></h2>	
		<table>
		<?php 
			$torns=array('M'=>'Mati', 'T'=>'Tarda','C'=>'Complert');
			//var_dump($torns);
			
			echo "<tr><th>codi</th><td>:$curso->codi</td></tr>";
			echo "<tr><th>Area formativa:</th><td>$areaformativa</td></tr>";
			echo "<tr><th>Nom:</th><td>$curso->nom</td></tr>";
			echo "<tr><th>Descripció:</th><td>$curso->descripcio</td></tr>";
			echo "<tr><th>hores:</th><td>$curso->hores</td></tr>";
			echo "<tr><th>data inici:</th><td>$curso->data_inici</td></tr>";
			echo "<tr><th>data fi:</th><td>$curso->data_fi</td></tr>";
			echo "<tr><th>horari:</th><td>$curso->horari</td></tr>";
			//var_dump($curso);
			if (!$curso->torn)
				$torn="Sense definir";
			else 
				$torn=$torns[strtoupper($curso->torn)];			
		
			echo "<tr><th>torn:</th><td>$torn</td></tr>";
			echo "<tr><th>tipus:</th><td>$curso->tipus</td></tr>";
			echo "<tr><th>requisits d'accés:</th><td>$curso->requisits</td></tr>";
			echo "</table><br>";
			if ($usuario)
				echo "<input type='button' onclick='location.href=\"index.php?controlador=Preinscripcio&operacion=nuevo&parametro=$curso->id\";' value='Inscriure'/><br>";
				
				
		?>
 			<br>
 			<div class="uno">
 			<a href='index.php?controlador=curso&operacion=exportar&parametro=<?php echo $curso->id;?>'>Exportar preinscripcions</a>
 			<a href='javascript:alert('Volem imprimir el curs <?php echo $curso->id;?>');>Imprimir</a>
 			</div>
 			<br>
 			
			<a class='volver' href=index.php>Tornar a l'inici</a>			
		</section>
		
		<?php Template::footer();?>
    </body>
</html>