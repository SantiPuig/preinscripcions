<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Baixa de usuaris</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuari); //pone el formulario de logout
			
			Template::menu($usuari); //pone el menú
		?>
		
		<section id="content">
			<h2>Formulari de baixa de usuari</h2>
			<p>Por favor, confirma la teva solicitud de baixa introduint el password associat al teu compte.</p>
		
			<form method="post" autocomplete="off">
				<label>Usuari:</label>
				<input type="text" readonly="readonly" value="<?php echo $usuari->user;?>" /><br/>
				
				<label>Password:</label>
				<input type="password" name="password" required="required"/><br/>
				
				<label></label>
				<input type="submit" name="confirmar" value="Confirmar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>