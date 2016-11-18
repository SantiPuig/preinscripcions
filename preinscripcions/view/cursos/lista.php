<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Listado de PCs</title>
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
			<h2>Detalles PCs</h2><strong>
			<div class="pcs flex-container">
				<div class="flex">Marca</div>				
				<div class="flex">Model</div>				
				<div class="flex">S/Tag</div>				
				<div class="flex">RAM (GB)</div>				
				<div class="flex">HD (GB)</div>				
				<div class="flex">Fecha compra</div>				
				<div class="flex">Fin garantia</div>				
				<div class="flex">MAC</div>	
				<div class="flex">Operaciones</div>	
			</div></strong>
			<?php
			  foreach($pcs as $pc){
			  	echo "<div class='contenido flex-container'>";
			  		echo "<div class='flex'>$pc->marca</div>";
			  		echo "<div class='flex'>$pc->model</div>";
			  		echo "<div class='flex'>$pc->Serial</div>";
			  		echo "<div class='flex'>$pc->RAM</div>";
			  		echo "<div class='flex'>$pc->HD</div>";
			  		echo "<div class='flexmac'>$pc->fecha_compra</div>";
			  		echo "<div class='flexmac'>$pc->fin_garantia</div>";
			  		echo "<div class='flexmac'>$pc->MAC</div>";
			  		echo "<div class='flex'>";
			  		echo "<a href='index.php?controlador=pc&operacion=ver&parametro=$pc->id_pc'>";
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