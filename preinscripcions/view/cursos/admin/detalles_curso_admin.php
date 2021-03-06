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
				
		?>
 			</table>	
				
		</section>
		<section id="llistat">
		<?php 
			if (!empty($alumnes)){
		?>
		<h3>Alumnes preinscrits</h3>
		<table>
			<tr>
				<th>dni</th><th>nom</th><th>telèfon mòbil</th><th>telèfon fix</th><th>email</th><th>data inscripció</th>
				<th># inscripcions</th><th class="ocultable">Opcions</th>
			</tr>
			<?php 
				foreach ($alumnes as $a) {
					echo "<tr>";
					echo "<td>$a->dni</td>";
					echo "<td>$a->nom</td>";
					echo "<td>$a->telefon_mobil</td>";
					echo "<td>$a->telefon_fix</td>";
					echo "<td>$a->email</td>";
					echo "<td>$a->data</td>";
					echo "<td>$a->inscripcions</td>";
					echo "<td class='ocultable'><a href='index.php?controlador=usuario&operacion=modificacion&parametro=$a->id'>";
					echo "<img class='boton' src='images/botones/ver.png'> </a>";
					echo "<a href='index.php?controlador=preinscripcio&operacion=borrar&parametro=$a->id_curs&usuari=$a->id&vista=detalles_curso'> ";
					echo "<img class='boton' src='images/botones/delete.png'> </a></td>";
					echo "</tr>";
						
				}
			
			?>				
				
		</table>
		<br>
			<div class="uno">
			<br>
 			<a href='index.php?controlador=curso&operacion=exportar&parametro=<?php echo $curso->id;?>'>Exportar preinscripcions</a>
 			<a href="javascript:print()";>Imprimir</a>
 			<br><br><br>
 			</div>
 		
		<?php } ?>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>