<?php
   class Curso extends Controller{
   	public function index() { //default method
   		//echo('ahora voy a listar');
   		$this->listar();
   }
   
   public function listar() {
 
   	$this->load('model/cursmodel.php');
   	$this->load('model/AreaformativaModel.php');
   	
   	$datos=array();
   	$datos['usuario']=Login::getUsuario();
   	
    //var_dump($_POST); 
   	// Si llego al form via GET, no me han metido nada en los filtros
   	// si no hi ha filtres, es la primera vegada que accedeixen, i només caldra mostrar
   	//formulari de filtre. Si no, caldrà buscar les dades i passar-li a la vista.
   	
    if ($_SERVER["REQUEST_METHOD"]=='GET' || empty($_POST['filtros']))
    	$filtros=array();
   	else {
	    //echo "entro en else";
   		$filtros=$_POST['filtros'];
   		$conexion = Database::get();
   		$filtrar=array();
   		//para impedir las sqlinjection, tratamos una a una las cadenas que nos llega por post
   		//y preservamos el array de filtros para devolverlo a la vista
        foreach ($filtros as $cl=>$v)
        	if (strlen($v))
        		$filtrar[$cl]=$conexion->real_escape_string($v); 
        //Si no se indica ningún filtro, llamar al método que nos retorna todos los cursos
        // que no tengan fecha de inicio, o cuya fecha de inicio sea futura.
        // var_dump($filtrar);
        if (count($filtrar))
        	$cs=CursModel::cursos_filtrats($filtrar);
        else 
        	$cs=CursModel::cursos();
        
     
   		$datos['cursos']=$cs;
   		
   	}
   	
   	$datos['arees']=AreaformativaModel::arees_formatives();
   		
   	/*
   	 *  La vista haurà de mirar si li arriven cursos.
   	 *  Si l'arrai cursos no existeix, haurà de posar només formulari
   	 *  Si l'arrai concursos existeix, pintarà capçalera llistat, i les dades que arribin
   	 */
    $datos['tipos']=CursModel::tipus(); //pasar los tipos de curso que hay, para el datalist de la vista
   	$datos['filtros']=$filtros;  //volver a pasar los mismos filtros que llegaron del form.

   	//var_dump($datos);
   	
   	if (!Login::isAdmin())  //L'administrador tindrà una vista diferent
   	  $this->load_view('view/cursos/lista.php',$datos);
   	else 
   		$this->load_view('view/cursos/admin/lista_admin.php',$datos);
   	
   }
   	
   //metode per veure un curs en concret.
   //només els usuaris tindran la opció de registrar-se, els alumnes d'inscriure's, 
   // i els administrador de llistar les preinscripcions 
   
   public function ver($id=0){
   /*	// comprovar si l'usuari està registrat 
   	if (!Login::getUsuario())
   		throw new Exception('Solo para usuarios registrados');*/
   	
   		//demanar al model que ens passi el curs en questió
   	$this->load('model/cursmodel.php');
   	$this->load('model/AreaformativaModel.php');
   	$c=CursModel::getCurs($id);
   	
   	if (!$c)
   		throw new Exception('No se encuentra el Curso :-(');
   	
   		   	
   	//passar el pc a la vista
   	$datos=array();
   	$datos['usuario']=Login::getUsuario();
   	$datos['curso']=$c;
   	$datos['areaformativa']=AreaformativaModel::getAreaFormativa($c->id_area)->nom;
   	
   	if (Login::isAdmin()){
   		$this->load('model/PreinscripcioModel.php');
   		$datos['alumnes']=PreinscripcioModel::alumnes_preinscrits($id);
   		$this->load_view('view/cursos/admin/detalles_curso_admin.php',$datos);
   	} else	
   		$this->load_view('view/cursos/detalles_curso.php',$datos);   	
   	
   }
   //OPERACIONS DE L'ADMINISTRADOR
   //Donar d'alta un nou curs
   public function nuevo(){
   	//Cal comprovar si l'usuari és Admin
   	if(!Login::isAdmin())
   		throw new Exception("Alta de Cursos restringida només per a l'administrador");
   	
   		// comprovar si no m'arriven les dades del nou curs
   	if (empty($_POST['guardar'])){
   		//si no envien dades, cal mostrar formulari perque les omplin
   		$this->load('model/AreaformativaModel.php');
   		
   		$datos=array();
   		$datos['arees']=AreaformativaModel::arees_formatives();
   		$datos['usuario']=login::getUsuario();
   		$this->load_view('view/cursos/admin/nuevo.php',$datos);
   	}else{
   		$this->load('model/cursmodel.php');
   		$conexion = Database::get();
   		$c=new CursModel();
   		   		
   		$c->codi=$conexion->real_escape_string($_POST['codi']);
   		$c->id_area=$_POST['id_area'];
   		$c->nom=$conexion->real_escape_string($_POST['nom']);
   		$c->descripcio=$conexion->real_escape_string($_POST['descripcio']);
   		$c->hores=$_POST['hores'];
   		$c->data_inici=$_POST['data_inici'];
   		$c->data_fi=$_POST['data_fi'];
   		$c->horari=$conexion->real_escape_string($_POST['horari']);
   		$c->torn=$_POST['torn'];
   		$c->tipus=$conexion->real_escape_string($_POST['tipus']);
   		$c->requisits=$conexion->real_escape_string($_POST['requisits']);
   		
   		if (!$c->guardar())
   			throw new Exception("No s'ha pogut guardar");
   		
   		// mostrar la vista de èxit
   		$datos=array();
   		$datos['usuario']=login::getUsuario();
   		$datos['mensaje']="Curs $c->codi - $c->nom desat correctament";
   		$this->load_view('view/exito.php',$datos);
   		
   	} 	
   }
  /*
   * Opció de modificar un curs (només administrador)
   */ 
  public function modificar($id=0){
   	//comprovar si l'usuari es admin
   	if (!Login::isAdmin())
   		throw new Exception("Opció restringida per a l'administrador");
   	
   		//Recuperar dades del curs
   	$this->load('model/cursmodel.php');
   	$c=CursModel::getCurs($id);
   	
   	//mira si el curs s'ha carregat correctament
   	if(empty($c))
   		throw new Exception ('No es troba el curs');
   	
   		// si no hi ha dades
   	if(empty($_POST['modificar'])){
   		//pintar formulari
   		$datos=array();
   		$datos['usuario']=Login::getUsuario();
   		$datos['curs']=$c;
   		$this->load('model/AreaformativaModel.php');
   		$arees=AreaformativaModel::arees_formatives();
   		$datos['arees']=$arees;
   		$this->load_view('view/cursos/admin/modificar.php',$datos);
   	  		
   	}else{ //si que m'envien dades
   		//recuperar les dades que m'arriven via POST
   		$conexion = Database::get();
   		$c->codi=$conexion->real_escape_string($_POST['codi']);
   		$c->id_area=$_POST['id_area'];
   		$c->nom=$conexion->real_escape_string($_POST['nom']);
   		$c->descripcio=$conexion->real_escape_string($_POST['descripcio']);
   		$c->hores=$_POST['hores'];
   		$c->data_inici=$_POST['data_inici'];
   		$c->data_fi=$_POST['data_fi'];
   		$c->horari=$conexion->real_escape_string($_POST['horari']);
   		$c->torn=$_POST['torn'];
   		$c->tipus=$conexion->real_escape_string($_POST['tipus']);
   		$c->requisits=$conexion->real_escape_string($_POST['requisits']);
   		
   		//actualitzar la BDD
   		if(!$c->actualizar())
   			throw new Exception("No s'ha pogut modificar el curs");
   		
   			// carregar la vista d'èxit
   		$datos=array();
   		$datos['usuario']=Login::getUsuario();
   		$datos['mensaje']="Curs $c->codi - $c->nom modificat correctament.";
   		$this->load_view('view/exito.php',$datos);
	   		
   	}
   }
   /*
    *  Esborrar el curs. Comprova que no hi hagi preinscripcions, i després esborra
    *  opció només per a l'administrador.
    */
   	public function borrar($id=0){
   		//comprovar si es administrador
   		if(!Login::isAdmin())
   			throw new Exception ("Opció restringida només per a l'administrador");
   		// recuperar curs de la BD
   		$this->load('model/cursmodel.php');
   		//echo "curs $id";
   		$c=CursModel::getCurs($id);
   		
   		//comprovar que el curs s'ha carregat correctament
   		if (empty($c))
   			throw new Exception("No es troba el curs");
   		//si encara no han confirmat esborrar
   		//var_dump($_POST);
   		if(empty($_POST['borrar'])){
   			//mira si hi ha preinscripcions al curs.
   			$this->load('model/PreinscripcioModel.php');
   			$filtre=array();
   			$filtre['id_curs']=$id;
   			$inscrits=count(PreinscripcioModel::preinscripcions($filtre));
   			
   			//mostrar la vista de confirmació   			
   			$datos=array();
   			$datos['usuario']=Login::getUsuario();
   			$datos['curs']=$c;
   			$datos['inscrits']=$inscrits;
   			
   			$this->load_view('view/cursos/admin/borrar.php',$datos);
   		}else{ //si ja m'estan confirmant la baixa
   			// mirar si el DNI que arriba via POST coincideix amb el de l'administrador
   			$usr=Login::getUsuario();
   			if (strtoupper($_POST['DNI'])!=strtoupper($usr->dni))
   				throw new exception("El DNI no coincideix amb el de l'administrador. Operació cancelada");
   			// esborrar el curs de la BDD
   			if(!$c->borrar())
   				throw new Exception('Error al intentar donar de baixa el curs');
   			//carregar la vista d'exit
   			$datos = array();
   			$datos['usuario'] = Login::getUsuario();
   			$datos['mensaje'] = 'Curs esborrat correctament';
   			$this->load_view('view/exito.php', $datos);
   			
   		}
   	}
   	/*
   	 *  Exporta dades del curs a un fitxer XML
   	 */
   	public function exportar($id)
   	{
   		if(!Login::isAdmin())
   			throw new Exception ("Opció restringida només per a l'administrador");
   			// recuperar curs de la BD
   		$this->load('model/cursmodel.php');
   		$this->load('model/PreinscripcioModel.php');
   		$this->load('libraries/xml_library.php');
   			
   		$c=CursModel::getCurs($id);
   		if (empty($c))
   			throw new Exception("No es troba el curs");
   		$alumnes=PreinscripcioModel::alumnes_preinscrits($id);
   		$xml=XML::toXML($alumnes);
   		$datos = array();
   		$datos['usuario'] = Login::getUsuario();
   		$datos['xml']=$xml;
   		$datos['filename']="alumnes_preinscrits_curs_$c->codi-$c->nom";
   		//echo $xml;
   		$this->load_view('view/export_xml.php',$datos);   		
   			 
   	}
}
   		
?>