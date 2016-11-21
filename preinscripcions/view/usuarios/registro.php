<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
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
			<h2>Formulari de registre</h2>
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				<label>D.N.I:</label>
				<input type="text" name="user" required="required" 
					pattern="^[a-zA-Z]\w{2,9}" title="3 a 10 caracters (numeros, lletres o guió baix), començant per lletra"/><br/>
					
				<label>Data de Naixement:</label>
				<input type="text" name="data de naixement" required="required"/><br/>
				
				<label>Nom:</label>
				<input type="text" name="nom" required="required"/><br/>
				
				<label>Cognom1:</label>
				<input type="text" name="cognom1" required="required"/><br/>
				
				<label>Cognom2:</label>
				<input type="text" name="cognom2" required="required"/><br/>
				
				<label>Estudis:</label>
				<input type="text" name="estudis" required="required"/><br/>
				
				<label>Situació laboral:</label>
				<input type="text" name="situació laboral" required="required"/><br/>
				
				<label>Prestació:</label>
				<input type="text" name="prestació" required="required"/><br/>
				
				<label>Email:</label>
				<input type="email" name="email" required="required"/><br/>
				
				<label>Mobil:</label>
				<input type="text" name="mobil" required="required"/><br/>
				
				<label>Fix:</label>
				<input type="text" name="fix" required="required"/><br/>
				
				
				
				
				
				
		        <label></label>
				<input type="submit" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>