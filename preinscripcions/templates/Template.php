<?php
	class Template{	
		
		//PONE EL HEADER DE LA PAGINA
		public static function header(){	?>
			<header>
				<!-- 
				<figure>
					<a href="index.php">
						<img alt="soc" src="images/soc.png" />
					</a>
				</figure>
				 -->
				<hgroup>
					<h1>Cursos de Formació professional</h1>
					<h2>Destinats per a aturats.</h2>
				</hgroup>
			</header>
		<?php }
		
		
		//PONE EL FORMULARIO DE LOGIN
		public static function login(){?>
			<form method="post" id="login" autocomplete="off">
				<label>DNI:</label><input type="text" name="user" required="required" />
				<label>Data de Naixement:</label><input type="text" name="password" required="required"/>
				<input type="submit" name="login" value="Login" />
			</form>
		<?php }
		
		
		//PONE LA INFO DEL USUARIO IDENTIFICADO Y EL FORMULARIOD E LOGOUT
		public static function logout($usuario){	?>
			<div id="logout">
				<span>
					Hola 
					<a href="index.php?controlador=Usuario&operacion=modificacion" title="modificar datos">
						<?php echo $usuario->nom;?></a>
					<span class="mini">
						<?php echo ' ('.$usuario->email.')';?>
					</span>
					<?php if($usuario->admin) echo ', eres administrador';?>
				</span>
								
				<form method="post">
					<input type="submit" name="logout" value="Logout" />
				</form>
				
				<div class="clear"></div>
			</div>
		<?php }
		
		
		//PONE EL MENU DE LA PAGINA
		public static function menu($usuario){ ?>
			<nav>
				<ul class="menu">
					<li><a href="index.php">Inici</a></li>
					<li><a href="index.php?controlador=curso&operacion=listar">Cursos</a></li>
				<?php if (!$usuario)	{?>
					<li><a href="index.php?controlador=Usuario&operacion=registro">Registre</a></li>
				<?php } else {?>	 
					<li><a href="index.php?controlador=Usuario&operacion=modificacion">Les meves dades</a></li>					
					<li><a href="index.php?controlador=areaformativa&operacion=listar">Arees formatives</a></li>
				<?php }	?>			
				</ul>
				<?php 
				//pone el menú del administrador
				if($usuario && $usuario->admin){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=curso&operacion=nuevo">Nou curs</a></li>
					<li><a href="index.php?controlador=areaformativa&operacion=nuevo">Arees formatives</a></li>
					<li><a href="index.php?controlador=Usuario&operacion=listar">Llistar Usuaris</a></li>
				</ul>
							
				<?php }	?>
			</nav>
		<?php }
		
		//PONE EL PIE DE PAGINA
		public static function footer(){	?>
			<footer>
				<p>  En utilitzar el cercador de cursos de formació per a una especialitat en concret, us apareixeran tots els cursos relacionats, tant de formació contínua (per a persones treballadores en actiu) com de formació ocupacional (per a persones a l'atur)

Els cursos de formació contínua estan identificats amb la icona

Si només voleu que apareguin els cursos de formació contínua marqueu la casella "Cursos".

Complementàriament, també podeu informar-vos sobre els cursos que desenvolupa la Xarxa FP.CAT. 
					
				</p>
				<p> <figure>
					<a href="index.php">
						<img alt="cefo" src="images/curso3.jpg" />
					</a>
				</figure>
				 <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d11943.020304594402!2d2.0567173999999997!3d41.55290005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1480071406532" width="300" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>	 
         		</p>
			</footer>
		<?php }
	}
?>