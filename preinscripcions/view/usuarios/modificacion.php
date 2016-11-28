<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Modificació de dades de usuari</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
		  	Template::header(); //pone el header
			
			$u=Login::getUsuario();

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($u); //pone el formulario de logout
			
			Template::menu($u); //pone el menú
		?>
		
		<section id="content">
		<div class="uno">
			<a class="derecha" href="index.php?controlador=Usuario&operacion=baja&parametro=<?php echo $usuario->id;?>">Donar de baixa</a>
		</div>			
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
				<input type="submit" name="modificar" value="modificar"/>
				<a href="index.php?controlador=Usuario&operacion=baja&parametro=<?php echo $usuario->id;?>"><img class='boton' src='images/botones/delete.png' >			  		
				</a>
			
			</form>
			
				
		</section>
		<section id="llistat">
		<?php
		   if (!empty($inscripcions)){		   	  	   	
		    if (Login::isadmin())
		    	echo  "<h2>preinscripcions</h2>";
		    else
				echo "<h2>Les meves preinscripcions</h2>";
			
		?>
			<table>
			<tr>			  
			 	<th>codi</th>	
				<th>nom</th>				
				<th>data inici</th>				
				<th>data fi</th>				
				<th>horari</th>				
				<th>torn</th>			
				<th>inscrits</th>
				<th>Operacions</th>				
			 </tr>
		<?php
			
			foreach ($inscripcions as $i){
				echo "<tr>";
				echo "<td>$i->codi</td>";
				echo "<td>$i->nom</td>";
				echo "<td>$i->data_inici</td>";
				echo "<td>$i->data_fi</td>";
				echo "<td>$i->horari</td>";
				echo "<td>$i->torn</td>";
				echo "<td>$i->inscrits</td>";
				echo "<td><a href=index.php?controlador=curso&operacion=ver&parametro=$i->id_curs>";
				echo "<img class='boton' src='images/botones/ver.png'> </a>";
				echo "<a href=index.php?controlador=preinscripcio&operacion=borrar&parametro=$i->id_curs&usuari=$usuario->id> ";
				echo "<img class='boton' src='images/botones/delete.png'> </a></td>";
			  echo "</tr>";				 
			}
			echo "</table>";
		 }
		 if (Login::isAdmin())
		 	echo "<h2>Subscripcions</h2>";
		 else
			echo	"<h2>Les meves subscripcions</h2>";
		 
				if (!$subscripcions)
					echo "Encara no tinc cap suscripció";
				else { ?>
			<table>
			<tr><th>Area formativa</th><th>Data subscripció</th><th>Donar de baixa</th></tr>
			<?php 
				if (!$subscripcions)
					echo "Encara no tinc cap suscripció";
				else
				  foreach ($subscripcions as $s){
						echo "<tr><td>$s->nom</td>";
						echo "<td>$s->data</td>";
						echo "<td><a href='index.php?controlador=areaformativa&operacion=baja&parametro=$s->id_area&usuari=$usuario->id&vista=usuari'>";
						echo "<img class='boton' src='images/botones/delete.png'> </a></td></tr>";
					}
			?>
			
			</table>
			<?php }?>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>