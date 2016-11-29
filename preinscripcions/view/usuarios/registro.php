<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Registro de usuarios</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
		
		<script type="text/javascript">
		function valida_dni(dni) {
			  var numero
			  var letr
			  var letra
			  var expresion_regular_dni
			 
			  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
			 
			  if(expresion_regular_dni.test (dni) == true){
			     numero = dni.substr(0,dni.length-1);
			     letr = dni.substr(dni.length-1,1);
			     numero = numero % 23;
			     letra='TRWAGMYFPDXBNJZSQVHLCKET';
			     letra=letra.substring(numero,numero+1);
			    if (letra!=letr.toUpperCase()) {
			       alert('Dni erroni, la lletra no es correspon');
				   document.getElementById('boton').setAttribute('disabled','disabled');
			     }else{
						document.getElementById('boton').removeAttribute('disabled');
			     }
			  }else{ 
			     	alert('Dni erroni, format no vàlid');
					document.getElementById('boton').setAttribute('disabled','disabled');
			   }
			}
		function mayuscula(obj,id){
			obj=obj.toUpperCase();
			document.getElementById(id).value=obj;
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
				<input type="text" id="dni1" name="dni" required="required" placeholder="Introduir el vostre DNI"
					onblur="mayuscula(this.value,this.id)"
					pattern="^\d{8}[a-zA-Z]$" onchange="valida_dni(this.value);"/>
				<br>
				
				<label>Data de naixement:</label>
				<input type="text" name="data_naixement" required="required" 
					pattern="((19)|(20))[1-9][0-9]-((0[1-9])|(1[0-2]))-((0[1-9])|([1-2][0-9])|(3[01]))"
					placeholder="format AAAA-MM-DD"
				/>
				<br/>
	
				<label>Nom:</label>
				<input type="text" id="nom" name="nom" required="required" 
					onblur="mayuscula(this.value,this.id)"
				/><br/>
					
				<label>cognom1:</label>
				<input type="text" id="cognom1" name="cognom1" required="required" 
					onblur="mayuscula(this.value,this.id)"
					"/><br/>
					
				<label>cognom2:</label>
				<input type="text" id="cognom2" name="cognom2" required="required" 
					onblur="mayuscula(this.value,this.id)"
					/><br>	
				
				<label>Email:</label>
				<input type="email" name="email" required="required" 
					pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$"
					/><br>
				
				<label>Mobil:</label>
				<input type="text" name="telefon_mobil" required="required"
					pattern="^[0-9]{9}$"
				    /><br>
				
				<label>Fix:</label>
				<input type="text" name="telefon_fix" 
					pattern="^[0-9]{9}$"
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