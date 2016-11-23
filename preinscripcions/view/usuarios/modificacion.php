

------------------------------------------------------
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
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja&parametro=<?php echo $usuario->id;?>">Donar de baixa</a>
			
			<h2>Formulari de modificació de dades</h2>
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				
				
				
				
				<input type="hidden" name="id" value="<?php echo $usuario->id;?>"/>

				
				<label>DNI:</label>
				<input type="text" name="dni" required="required" value="<?php echo $usuario->dni;?>"/>
				<br>
				
				<label>Data de naixement:</label>
				<input type="text" name="data_naixement" required="required" 
					pattern="((19)|(20))[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))"
				value="<?php echo $usuario->data_naixement;?>"/>
				<br/>
	
				<label>Nom:</label>
				<input type="text" name="nom" required="required" 
					value="<?php echo $usuario->nom;?>"/><br/>
					
				<label>cognom1:</label>
				<input type="text" name="cognom1" required="required" 
					value="<?php echo $usuario->cognom1;?>"/><br/>
					
				<label>cognom2:</label>
				<input type="text" name="cognom2" required="required" 
					value="<?php echo $usuario->cognom2;?>"/><br>	
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$"
					value="<?php echo $usuario->email;?>"/><br>
				
				<label>Mobil:</label>
				<input type="text" name="telefon_mobil" required="required"
				    value="<?php echo $usuario->telefon_mobil;?>"/><br>
				
				<label>Fix:</label>
				<input type="text" name="telefon_fix" required="required"
				    value="<?php echo $usuario->telefon_fix;?>"/><br>
				<label>Estudis:</label>
				<select name="estudis">
				<?php 
					$estudis=array('Sense Estudis','EGB/ESO','Batxillerat/COU',
							'Diplomatura/Enginyeria tecnica','Licenciatura/Enginyeria superior','Postgrau/Master','Doctorat');
					foreach ($estudis as $v=>$estudi)
						if($usuario->estudis==$v)
							echo "<option selected='selected' value='$v'>$estudi</option>";
						else
							echo "<option value='$v'>$estudi</option>";
				?>
				</select> 
				<br>   
				<label>Prestacio</label>
				<select name="prestacio">
				<?php 
				   if ($usuario->prestacio)
				   	 echo "<option value='0'>No</option><option selected='selected' value='1'>Si</option>";
				   else 
				   	 echo "<option selected='selected' value='0'>No</option><option  value='1'>Si</option>";
				?>
				</select>
				<br>
				<label>Situacio Laboral:</label>
				<select name="situacio_laboral">
				<?php 
				  	$situacions=array("Atur","Actiu","Pensionista","Altres");
				  	foreach ($situacions as $v=>$situacio)
				  		if ($v==$usuario->situacio_laboral)
				  			echo "<option selected='selected' value='$v'>$situacio</option>";
				  		else 
				  			echo "<option value='$v'>$situacio</option>";
				
				?>
				</select>
				<br>
				<input type="submit" name="modificar" value="modificar"/><br>
			</form>
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja&parametro=<?php echo $usuario->id;?>">
			<img class='boton' src='images/botones/delete.png' >
			  		
			</a>
			
				
		</section>
		
		<?php Template::footer();?>
    </body>
</html>