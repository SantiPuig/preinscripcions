<?php
	class Template{	
		
		//PONE EL HEADER DE LA PAGINA
		public static function header(){	?>
			<header>
				<figure>
					<a href="index.php">
						<img alt="cefo" src="images/CEFO.jpg" />
					</a>
				</figure>
				<hgroup>
					<h1>Cursos per aturats</h1>
					<h2>Cursos de Formació professional</h2>
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
					<li><a href="index.php?controlador=Usuario&operacion=modificacion">Consultar</a></li>
				<?php }	?>			
				</ul>
				<?php 
				//pone el menú del administrador
				if($usuario && $usuario->admin){	?>
				<ul class="menu">
					<li><a href="index.php?controlador=curso&operacion=nuevo">Nou curs</a></li>
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
					 
         		</p>
			</footer>
		<?php }
	}
?>