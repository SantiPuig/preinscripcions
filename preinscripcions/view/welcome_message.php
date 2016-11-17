<!DOCTYPE html>
<html>
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Portada</title>
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
			<h2>Presentación</h2>
			<p>Este sitio es una práctica de Santi Puig de uso del Micro Framework de Robert Sallent,
			para familiarizarnos con la arquitectura modelo-vista-controlador.
			</p>
			<p>El ejemplo utilizado se trata de un mantenimiento de activos informáticos que pueda tener
			una organización.<P>
			<p>El caso de uso contemplado, los usuarios no registrados podrán listar los PCs, pero no pueden
			ver los detalles. Los usuarios registrados podrán ver los detalles de un PC específico.
			El administrador podrá añadir, modificar y dar de baja los equipos.
			Un usuario cualquiera puede registrarse, y pasa a ser usuario registrado en el momento que se valide.</p>
			<p>Es un ejemplo sencillo, utilizando una sola tabla, y un solo modelo (aparte del modelo de usuario
			que ya nos viene dado con el Framework, y sobre el cual no hemos tenido que hacer nada</p>
			<p>Más adelante realizaremos otro más complejo que utilice varias tablas relacionadas</p>
		</section>
		
		<?php Template::footer();?>
    </body> 
</html>