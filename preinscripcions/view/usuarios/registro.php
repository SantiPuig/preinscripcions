<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
		
		<script type="text/javascript">	
		function validar_dni(dni){
			alert(dni);
			letra = substr(dni, -1);
			numeros = substr(dni, 0, -1);
			if(substr("TRWAGMYFPDXBNJZSQVHLCKE", numeros%23, 1) == letra && strlen(numeros)==8 ){
				document.getElementById('boton').removeAttribute('disabled');
			}else{	
				alert("DNI no válido. No coincide la letra ");
				document.getElementById('boton').setAttribute('disabled','disabled');
			}
		}
		</script>
	
	</head>
	
	<body>
		<?php 
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
	
		<section id="content" onsubmit=validar_dni()>
			<h2>Formulari de registre</h2>
			<form method="post" name="usuari" enctype="multipart/form-data" autocomplete="off">
			
				<label>DNI:</label>
				<input type="text" name="dni" required="required" placeholder="Introduir el vostre DNI"
					pattern="^\d{8}[a-zA-Z]$" onchange="validar_dni(this.value);"/>
				<br>
				
				<label>Data de naixement:</label>
				<input type="text" name="data_naixement" required="required" 
					pattern="((19)|(20))[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))"
					placeholder="format AAAA-MM-DD"
				/>
				<br/>
	
				<label>Nom:</label>
				<input type="text" name="nom" required="required" 
				/><br/>
					
				<label>cognom1:</label>
				<input type="text" name="cognom1" required="required" 
					"/><br/>
					
				<label>cognom2:</label>
				<input type="text" name="cognom2" required="required" 
					/><br>	
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$"
					/><br>
				
				<label>Mobil:</label>
				<input type="text" name="telefon_mobil" required="required"
				    /><br>
				
				<label>Fix:</label>
				<input type="text" name="telefon_fix" 
				    /><br>
				<label>Estudis:</label>
				<select name="estudis">
				<?php 
					$estudis=array('Sense Estudis','EGB/ESO','Batxillerat/COU',
							'Diplomatura/Enginyeria tecnica','Licenciatura/Enginyeria superior','Postgrau/Master','Doctorat');
					foreach ($estudis as $v=>$estudi)				
							echo "<option value='$v'>$estudi</option>";
				?>
				</select> 
				<br>   
				<label>Prestacio</label>
				<select name="prestacio">
				<?php 
				   	 echo "<option value='0'>No</option><option selected='selected' value='1'>Si</option>";
				?>
				</select>
				<br>
				<label>Situacio Laboral:</label>
				<select name="situacio_laboral">
				<?php 
				  	$situacions=array("Atur","Actiu","Pensionista","Altres");
				  	foreach ($situacions as $v=>$situacio)
				  			echo "<option value='$v'>$situacio</option>";
				
				?>
				</select>
				<br>
		
				<input id="boton" type="submit" disabled="disabled" name="guardar" value="guardar"/><br/>
			</form>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>