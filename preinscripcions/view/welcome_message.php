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
			<h2>CURSOS CIFO</h2>
			
			<p>Els cursos de formació professional per a l'ocupació són programes formatius teòrico - pràctics</p>
			
			<p> que tenen per finalitat millorar la qualificació professional i/o la capacitat d'inserció laboral</p>
			
			<p> mitjançant l'assoliment i el perfeccionament de les competències professionals de les persones treballadores.</p>
			
			<p> S'adrecen a persones treballadores en situació d'atur.També hi ha la possibilitat de realitzar formació</p>
			
			<p> a distància mitjançant el programa e-formació, que consta de més de 80 especialitats, d'entre 250 i 600 hores de durada.</p>
			
            <p> La formació contínua pretén millorar la qualificació professional de les persones treballadores per tal d'adaptar els </p>
            
            <p> seus perfils a les necessitats empresarials. Va dirigida principalment a treballadors/ores en actiu, tot i que permet</p>
            
            <p> també l'accés de treballadors/ores en situació d'atur.

			</p>
		</section>
		
		<?php Template::footer();?>
    </body> 
</html>