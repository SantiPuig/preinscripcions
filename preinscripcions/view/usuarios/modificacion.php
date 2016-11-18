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

			if(!$usuari) Template::login(); //pone el formulario de login
			else Template::logout($usuari); //pone el formulario de logout
			
			Template::menu($usuari); //pone el menú
		?>
		
		<section id="content">
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja">Donar_se de baixa</a>
			
			<h2>Formulari de modificació de dades</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				<figure>
					<img class="imagenactual" src="<?php echo $usuari->imagen;?>" 
						alt="<?php echo  $usuari->user;?>" />
				</figure>
				
				
				<label>User:</label>
				<input type="text" name="user" required="required" 
					readonly="readonly" value="<?php echo $usuari->user;?>" /><br/>
				
				<label>Password actual:</label>
				<input type="password" name="password" required="required" /><br/>
				
				<label>Nou password:</label>
				<input type="password" name="newpassword" pattern=".{4,16}" title="4 a 16 caracteres"/>
				<span class="mini">En blanco para no modificar el actual</span><br/>
				
				
				<label>Nom:</label>
				<input type="text" name="nom" required="required" 
					value="<?php echo $usuari->nom;?>"/><br/>
					
				<label>cognom1:</label>
				<input type="text" name="cognom1" required="required" 
					value="<?php echo $usuari->cognom1;?>"/><br/>
					
				<label>cognom2:</label>
				<input type="text" name="cognom2" required="required" 
					value="<?php echo $usuari->cognom2;?>"/><br/>	
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					value="<?php echo $usuari->email;?>"/><br/>
				
				<label>Nova imatge:</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_image_size;?>" />		
				<input type="file" accept="image/*" name="imagen" />
				<span class="mini">max <?php echo intval($max_image_size/1024);?>kb</span><br />
				
				<label></label>
				<input type="submit" name="modificar" value="modificar"/><br/>
			</form>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>