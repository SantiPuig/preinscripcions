<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificació de dades de usuari</title>
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
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja">Donar_se de baixa</a>
			
			<h2>Formulari de modificació de dades</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				
				
				

				
				<label>DNI:</label>
				<input type="text" name="DNI" required="required" /><br/>
				
				<label>Data de naixement:</label>
				<input type="text" name="data de naixement" required="required" /><br/>
		
				<label>Nom:</label>
				<input type="text" name="nom" required="required" 
					value="<?php echo $usuario->nom;?>"/><br/>
					
				<label>cognom1:</label>
				<input type="text" name="cognom1" required="required" 
					value="<?php echo $usuario->cognom1;?>"/><br/>
					
				<label>cognom2:</label>
				<input type="text" name="cognom2" required="required" 
					value="<?php echo $usuario->cognom2;?>"/><br/>	
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					value="<?php echo $usuario->email;?>"/><br/>
				
				<label>Mobil:</label>
				<input type="text" name="mobil" required="required"
				    value="<?php echo $usuario->telefon_mobil;?>"/><br/>
				
				<label>Fix:</label>
				<input type="text" name="fix" required="required"
				    value="<?php echo $usuario->telefon_fix;?>"/><br/>
				
				
				<label></label>
				<input type="submit" name="modificar" value="modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>