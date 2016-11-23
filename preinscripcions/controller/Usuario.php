<?php
	//CONTROLADOR USUARIO 
	// implementa las operaciones que puede realizar el usuario
	class Usuario extends Controller{

		//PROCEDIMIENTO PARA REGISTRAR UN USUARIO
		public function registro(){

			//si no llegan los datos a guardar
			if(empty($_POST['guardar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['max_image_size'] = Config::get()->user_image_max_size;
				$this->load_view('view/usuarios/registro.php', $datos);
			
			//si llegan los datos por POST
			}else{
				//crear una instancia de Usuario
				$u = new UsuarioModel();
				$conexion = Database::get();
				
				//tomar los datos que vienen por POST
				//real_escape_string evita las SQL Injections
				$u->dni = $conexion->real_escape_string($_POST['dni']);
				$u->data_naixement = $conexion->real_escape_string($_POST['data_naixement']);
				$u->nom= $conexion->real_escape_string($_POST['nom']);
				$u->cognom1= $conexion->real_escape_string($_POST['cognom1']);
				$u->cognom2= $conexion->real_escape_string($_POST['cognom2']);
				$u->estudis= $conexion->real_escape_string($_POST['estudis']);
				$u->situacio_laboral= $conexion->real_escape_string($_POST['situacio_laboral']);
				$u->prestacio= $conexion->real_escape_string($_POST['prestacio']);
				$u->telefon_mobil= $conexion->real_escape_string($_POST['telefon_mobil']);
				$u->telefon_fix= $conexion->real_escape_string($_POST['telefon_fix']);
				$u->email= $conexion->real_escape_string($_POST['email']);
				/*
				$u->imatge= Config::get()->default_user_image;
				
				//recuperar y guardar la imagen (solamente si ha sido enviada)
				if($_FILES['imatge']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
						
					$upload = new Upload($_FILES['imatge'], $dir, $tam);
					$u->imatge = $upload->upload_image();
				}
				*/
				/*
				 * OLD
				 *		
				$u->nombre = $conexion->real_escape_string($_POST['nombre']);
				$u->email = $conexion->real_escape_string($_POST['email']);
				$u->imagen = Config::get()->default_user_image;
				
				//recuperar y guardar la imagen (solamente si ha sido enviada)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					$u->imagen = $upload->upload_image();
				}
				*/				
				//guardar el usuario en BDD
				if(!$u->guardar())
					throw new Exception('No se pudo registrar el usuario');
				
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Operación de registro completada con éxito';
				$this->load_view('view/exito.php', $datos);
			}
		}
		

		//PROCEDIMIENTO PARA MODIFICAR UN USUARIO
		public function modificacion(){
			//si no hay usuario identificado... error
			if(!Login::getUsuario())
				throw new Exception('Debes estar identificado para poder modificar tus datos');
				
			//si no llegan los datos a modificar
			if(empty($_POST['modificar'])){
				
				//mostramos la vista del formulario
				$datos = array();
				//var_dump($_GET);
				if (empty($_GET['parametro']) || !Login::isAdmin())
					$datos['usuario'] = Login::getUsuario();
				else 
					$datos['usuario']= UsuarioModel::getUsuario($_GET['parametro']);

				//var_dump($datos);	
				//$datos['max_image_size'] = Config::get()->user_image_max_size;
				
				$dni=$datos['usuario']->id;
				$this->load('model/PreinscripcioModel.php');
				$datos['inscripcions']=PreinscripcioModel::preinscripcions_alumne($dni);
				//var_dump($datos);
				$this->load_view('view/usuarios/modificacion.php', $datos);
					
				//si llegan los datos por POST
			}else{
				//recuperar los datos actuales del usuario
				$u = UsuarioModel::getUsuario($_POST['id']);
				$conexion = Database::get();
				
				//comprueba que el usuario se valide correctamente
								
				//recupera los nuevos datos del formulario
				$u->nom = $conexion->real_escape_string($_POST['nom']);
				$u->cognom1 = $conexion->real_escape_string($_POST['cognom1']);
				$u->cognom2 = $conexion->real_escape_string($_POST['cognom2']);
				$u->data_naixement = $_POST['data_naixement'];
				$u->dni = $conexion->real_escape_string($_POST['dni']);
				$u->email = $conexion->real_escape_string($_POST['email']);
				$u->estudis = $conexion->real_escape_string($_POST['estudis']);
				$u->prestacio = $conexion->real_escape_string($_POST['prestacio']);
				$u->situacio_laboral = $conexion->real_escape_string($_POST['situacio_laboral']);		
				$u->telefon_fix = $conexion->real_escape_string($_POST['telefon_fix']);
				
				$u->telefon_mobil = $conexion->real_escape_string($_POST['telefon_mobil']);
					
				/*
				 * OLD  - No hacemos tratamiento de imagenes
				 *
				//TRATAMIENTO DE LA NUEVA IMAGEN DE PERFIL (si se indicó)
				if($_FILES['imagen']['error']!=4){
					//el directorio y el tam_maximo se configuran en el fichero config.php
					$dir = Config::get()->user_image_directory;
					$tam = Config::get()->user_image_max_size;
					
					//prepara la carga de nueva imagen
					$upload = new Upload($_FILES['imagen'], $dir, $tam);
					
					//guarda la imagen antigua en una var para borrarla 
					//después si todo ha funcionado correctamente
					$old_img = $u->imagen;
					
					//sube la nueva imagen
					$u->imagen = $upload->upload_image();
				} */
				
				//modificar el usuario en BDD
				//var_dump($u);
				if(!$u->actualizar())
					throw new Exception('No se pudo modificar');
		
							
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = Login::getUsuario();
				$datos['mensaje'] = 'Modificación OK';
				$this->load_view('view/exito.php', $datos);
			}
		}
		
		
		//PROCEDIMIENTO PARA DAR DE BAJA UN USUARIO
		//solicita confirmación
		public function baja($p){		
			//recuperar usuario
			if (Login::isAdmin()) //si es el administrador
				$u=UsuarioModel::getUsuario($p); //traer el usuario que llega por parametro
			else 
				$u = Login::getUsuario(); //se traera el usuario que este logeado
			throw new Exception("Intentas dar de baja al usuario con ID=$p");
			//asegurarse que el usuario está identificado
			if(!$u) throw new Exception('Debes estar identificado para poder darte de baja');
			
			//si no nos están enviando la conformación de baja
			if(empty($_POST['confirmar'])){	
				//carga el formulario de confirmación
				$datos = array();
				$datos['usuario'] = $u;
				$this->load_view('view/usuarios/baja.php', $datos);
		
			//si nos están enviando la confirmación de baja
			}else{
				//validar password
				$p = MD5(Database::get()->real_escape_string($_POST['password']));
				if($u->password != $p) 
					throw new Exception('El password no coincide, no se puede procesar la baja');
				
				//de borrar el usuario actual en la BDD
				if(!$u->borrar())
					throw new Exception('No se pudo dar de baja');
					
					/*
				//borra la imagen (solamente en caso que no sea imagen por defecto)
				if($u->imagen!=Config::get()->default_user_image)
					@unlink($u->imagen);  */
			
				//cierra la sesion si no es el admin				
				if (!Login::isAdmin())
					Login::log_out();
					
				//mostrar la vista de éxito
				$datos = array();
				$datos['usuario'] = null;
				$datos['mensaje'] = 'Eliminado OK';
				$this->load_view('view/exito.php', $datos);
			}
		}
		public function listar(){
			if (!Login::isAdmin())
				throw new Exception("Opció restringida per a l'administrador");
			else {
				$alumnes=UsuarioModel::getUsuarios();
				$datos=array();
				$datos['usuario'] = Login::getUsuario();
				$datos['alumnes']=$alumnes;
				$this->load_view('view/usuarios/admin/listado.php',$datos);
				
			}
				
		}
		
	}
?>