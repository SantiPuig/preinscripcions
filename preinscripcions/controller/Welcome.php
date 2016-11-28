<?php
	//CONTROLADOR POR DEFECTO
	//Si el controlador frontal no recibe controlador ni operación,
	//invoca por defecto el método index() del controlador Welcome
	class Welcome extends Controller{
		
		//Método por defecto
		//Carga la portada del sitio (vista welcome_message)
		public function index(){
				//preparar los datos a pasar a la vista
				$datos = array('usuario'=>Login::getUsuario());
				
				//cargar la vista
				$this->load_view('view/welcome_message.php', $datos);
		}
		public function panel() {
			$query="select sum(usuarios) usuarios,sum(subs) subs,sum(cursos) cursos,sum(preins) preinscripcions
				from (
					select count(*) USUARIOS,0 subs,0 cursos,0 preins from usuaris
						union
						select 0 usuarios, count(*) subs,0 cursos,0 from subscripcions
						    union
						select 0,0,count(*) cursos,0 from cursos
						    union
						select 0,0,0,count(*) preins from preinscripcions
    
    				) a";
		}
	}
?>