<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>BAIXA DE USUARIS</title>
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
			<h2>Formulari de baixa de usuari</h2>
			<p>Si us plau, confirma la teva solicitud de baixa introduint el DNI associat al teu compte.</p>
		
			<form method="post" autocomplete="off">

				
				<label>DNI:</label>
				<input type="text" name="DNI" required="required"/><br/>
				
				<label></label>
				<input type="submit" name="confirmar" value="Confirmar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>