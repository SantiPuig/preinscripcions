<!DOCTYPE html>
<html lang="cat">
	<head>
		<base href="<?php echo Config::get()->url_base;?>" />
		<meta charset="UTF-8">
		<title>Alta d'arees formatives</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::get()->css;?>" />
	</head>
	
	<body>
		<?php 
			function inscrit($idarea,$subscripcions){				
			   
			    //var_dump($subscripcions);
				if (empty($subscripcions) || !$subscripcions)
				   return false;
				//return true;
				foreach ($subscripcions as $s)
					if ($s->id_area==$idarea)
						return true;
				return false;
			}
			
			Template::header(); //pone el header

			if(!$usuario) Template::login(); //pone el formulario de login
			else Template::logout($usuario); //pone el formulario de logout
			
			Template::menu($usuario); //pone el menú
		?>
				<section id="content">
			
			<h2>Arees formatives disponibles</h2>
			<table>
			<tr><th>Area formativa</th><th>Subscriure's</th></tr>
			<?php 
			   foreach($arees as $a) {
			   	  echo "<tr><td>$a->nom</td>";
			   	  //echo "<td align=center><a href='index.php?controlador=areaformativa&operacion=subscripcio&parametro=$a->id'>";
			 	 // echo "<img class='boton' src='images/botones/modify.png'></a></tr>" ; 
			 	  if (inscrit($a->id,$subscripcions))
			 	  {
			 	  		echo "<td align=center><a href='index.php?controlador=areaformativa&operacion=baja&parametro=$a->id'>";
						echo "<input type='checkbox' value='$a->id' checked /></a></tr>";
			 	  	  
			 	  } else {
			 	  	echo "<td align=center><a href='index.php?controlador=areaformativa&operacion=subscripcio&parametro=$a->id'>";
			 	  	echo "<input type='checkbox' value='$a->id' /></a></tr>";
			 	  }
			 	}

			   //var_dump($subscripcions);
			?>		   
			</table id="subscripcions">			
			<h2>Les meves subscripcions</h2>
			<?php 
				if (!$subscripcions)
					echo "Encara no tinc cap suscripció";
				else { ?>
				<a name="Ancla"></a>
				
			<table>
			<tr><th>Area formativa</th><th>Data subscripció</th><th>Donar de baixa</th></tr>
			<?php 
				if (!$subscripcions)
					echo "Encara no tinc cap suscripció";
				else
				  foreach ($subscripcions as $s){
						echo "<tr><td>$s->nom</td>";
						echo "<td>$s->data</td>";
						echo "<td align=center><a href='index.php?controlador=areaformativa&operacion=baja&parametro=$s->id_area&usuari=$s->id_usuari'>";
						echo "<img class='boton' src='images/botones/delete.png'> </a></td></tr>";
					}
			?>
			
			</table>
			<?php }?>
		</section>
		
		<?php Template::footer();?>
    </body>
</html>