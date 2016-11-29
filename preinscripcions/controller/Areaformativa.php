<?php
   class Areaformativa extends Controller{
   	public function index() { //default method
   		//echo('ahora voy a listar');
   		$this->listar();
   }
   
   /*
    *   Ver las suscripciones que hay de cada area formativa
    */
   private function AreaRepetida($nom) {
   	  $ar=AreaformativaModel::buscaId($nom);
   	  if ($ar)
   	      return $ar->id;
   	  else 
   	  	return null;
   }
   public function listar() {
    /*	if (!Login::isAdmin())
   		Throw new Exception("Aquesta operació només està disponible per la l'administrador<br>
   				<p><a href='index.php?controlador=curso'>Sortir</a>");*/
    if (!Login::getUsuario())
    	throw new Exception("Opció restringida per a usuaris registrats");
     
   	$this->load('model/AreaformativaModel.php');   	
   	$datos=array();
   	$datos['usuario']=Login::getUsuario();
   	$datos['arees']=AreaformativaModel::arees_formatives();
   	$datos['subscripcions']=SubscripcioModel::suscripcions_alumne(Login::getUsuario()->id);
   	$this->load_view('view/Areesformatives/llistar_af.php',$datos);
   }
   /*
    *  Opció de l'usuari quan s'inscriu en un curs.
    */
   public function subscripcio($idarea){
   	   if (Login::isAdmin())
   	   	 throw new Exception("Operació no contemplada per a l'administrador");
   	   if (!Login::getUsuario())
   	   	  throw new Exception("Operació només per a usuaris registrats");
	   $id=intval($idarea);
	   if ($id!=$idarea)  //per evitar que no passin un literal, i sigui interpretat com 0
	   	 throw new Exception("Area desconeguda");
	   
	   $this->load("model/AreaformativaModel.php");
	   
	   $af=AreaformativaModel::getAreaFormativa($id);
	   if (!$af)
	   	  throw new Exception("No existeix l'area formativa $idarea");
	   
   	   $subs=new SubscripcioModel();
   	   $subs->id_area=$id;
   	   $subs->id_usuari=Login::getUsuario()->id;
   	   if (!$subs->guardar())
   	   	  throw new Exception("Ja estaves preinscrit en el curs en aquesta area formativa $af->nom");
   	   // $datos=['usuari']=Login::getUsuario();
   	   header("location:index.php?controlador=Areaformativa");
   	   
   	   
   }
   /*
    *  Operació per que l'usuari es doni de baixa d'una subscripció
    */
   public function baja($idarea){
  	   if (Login::isAdmin()) {
  	   	 if (empty($_GET['usuari']))
   	   	     throw new Exception("Operació no contemplada per a l'administrador");  	   	 	
  	   	 $idus=intval($_GET['usuari']);
  	     if(!$idus)
   	   	     throw new Exception("Operació no contemplada per a l'administrador");
  	   } else {
	   	   if (!Login::getUsuario())
	   	   	  throw new Exception("Operació només per a usuaris registrats");
	   	   $idus=intval(Login::getUsuario()->id);
  	   }
   	   //printf("El codigo de usuario es %d",$idus);
   	   $id=intval($idarea);
   	   if ($id!=$idarea)  //per evitar que no passin un literal, i sigui interpretat com 0
   	   	  	throw new Exception("Area desconeguda");

   	   $this->load("model/AreaformativaModel.php");
   	   $subs=new SubscripcioModel();
   	   $subs->id_area=$id;
   	   $subs->id_usuari=$idus;
   	   if (!$subs->borrar())
   	   	  throw new Exception("Error en intentar donar de baixa de la subscripció");
   	   if (empty($_GET['vista']))
   	      header("location:index.php?controlador=Areaformativa");
   	   elseif ($_GET['vista']=='usuari')
   	      header("location:index.php?controlador=usuario&operacion=modificacion&parametro=$idus");
   	   elseif ($_GET['vista']=='detalles_curso')
   	   	  header("location:index.php?controlador=areaformativa&operacion=ver&parametro=$id");
   	 /* var_dump($_GET);
   	  echo $idus;
   	  echo "<br> ahora me dirigia a: index.php?controlador=usuario&operacion=modificacion&parametro=$idus";
   	  */ 	  
   }
   
   //OPERACIONS DE L'ADMINISTRADOR
   //Donar d'alta una nova area formativa
   public function nuevo(){
   	//Cal comprovar si l'usuari és Admin
   	if(!Login::isAdmin())
   		throw new Exception("Alta de arees formatives restringida només per a l'administrador<br>
   				<p><a href='index.php?controlador=curso'>Sortir</a>");
   	
   		// comprovar si no m'arriven les dades de l'area formativa
   	$this->load('model/AreaformativaModel.php');
   	if (empty($_POST['guardar'])){
   		//si no envien dades, cal mostrar formulari perque les omplin  	
   		
   		$datos=array();   		
   		$datos['arees']=AreaformativaModel::arees_formatives();
   		$datos['usuario']=login::getUsuario();
   		$this->load_view('view/Areesformatives/nueva_area.php',$datos);
   	}else{
   		$conexion = Database::get();
   		$area=new AreaformativaModel();
   		$area->nom=$conexion->real_escape_string($_POST['nom']);
   		//echo "Miro si l'area ja existeix...<br>";
   		if (($idarea=$this->AreaRepetida($area->nom)))
   			throw new Exception("Aquesta area formativa ja existia amb el codi $idarea!");
   		
   		if (!$area->guardar())
   			throw new Exception("No s'ha pogut guardar l'area formativa $area->nom");
   		
   		/*// mostrar la vista de èxit
   		$datos=array();
   		$datos['usuario']=login::getUsuario();
   		$datos['mensaje']="Area formativa  $area->nom desada correctament";
   		$this->load_view('view/exito.php',$datos);*/
   		header("location:index.php?controlador=areaformativa&operacion=nuevo");
   			
   	} 	
   }
  /*
   * Opció de modificar una area formativa (només administrador)
   */ 
  public function modificar($id=0){
   	//comprovar si l'usuari es admin
   	if (!Login::isAdmin())
   		throw new Exception("Opció restringida per a l'administrador");
   	
   		//Recuperar dades 
   	$this->load('model/AreaformativaModel.php');
   	$ar=AreaformativaModel::getAreaFormativa($id);
   	
   	if (empty($ar))
   		throw new Exception("No s'ha trobat cap area formativa amb Id $id");
   	
   		// si no hi ha dades
   	if(empty($_POST['modificar'])){
   		//pintar formulari
   		$datos=array();
   		$datos['usuario']=Login::getUsuario();
   		$datos['area']=$ar;
   		$this->load_view('view/Areesformatives/modificar_area.php',$datos);
   	  		
   	}else{ //si que m'envien dades
   		//recuperar les dades que m'arriven via POST
   		$conexion = Database::get();
   		$nounom=$conexion->real_escape_string($_POST['nom']);
   		$idarea=$this->AreaRepetida($nounom);
   		$area=AreaformativaModel::getAreaFormativa($id);
   		if (($idarea) && ($idarea!=$id))
   			throw new Exception("Ja existeix l'area formativa $nounom amb el codi $idarea");
   		$area=AreaformativaModel::getAreaFormativa($id);
   		$area->nom=$nounom;
   		if (!$area->actualizar())
   			throw new Exception("No s'ha pogut modificar l'area formativa");
   			
   			// carregar la vista d'èxit
   		$datos=array();
   		$datos['usuario']=Login::getUsuario();
   		$datos['mensaje']="Area formativa $area->id - $area->nom modificada correctament.";
   		$this->load_view('view/exito.php',$datos);	   		
   	}
   }
   public function ver($id=0){
	   	//comprovar si l'usuari es admin
	   	if (!Login::isAdmin())
	   		throw new Exception("Opció restringida per a l'administrador");
	   
   		//Recuperar dades
   		$this->load('model/AreaformativaModel.php');
   		$ar=AreaformativaModel::getAreaFormativa($id);
   
   		if (empty($ar))
   			throw new Exception("No s'ha trobat cap area formativa amb Id $id");
  				//pintar formulari
  		
  		$datos=array();
   		$datos['usuario']=Login::getUsuario();
   		$datos['area']=$ar;
   		$datos['subscripcions']=SubscripcioModel::alumnes_subscrits($id);
   		$this->load_view('view/Areesformatives/veure_area.php',$datos);   
   	}
   /*
    *  Esborrar area formativa. Comprova que no hi hagi cursos, i després esborra
    *  opció només per a l'administrador.
    */
   	public function borrar($id=0){
   		//comprovar si es administrador
   		if(!Login::isAdmin())
   			throw new Exception ("Opció restringida només per a l'administrador");
   		// recuperar curs de la BD
   		$this->load('model/AreaformativaModel.php');
   		//echo "curs $id";
   		$area=AreaformativaModel::getAreaFormativa($id);
   		
   		if (empty($area))
   			throw  new Exception("No es troba l'area formativa");

   		$this->load('model/cursmodel.php');
   		$filtre=array();
   		$filtre['id_area']=$id;
   		$cursos=count(CursModel::cursos_filtrats($filtre));
   		//var_dump($_POST);

   		if ($cursos)
   			throw new Exception("No es pot esborrar aquesta area formativa. Actualment hi ha $cursos cursos amb aquesta area formativa <br>
   					<form method='post' action=index.php?controlador=curso&operacion=listar >
   					<input type=hidden name=filtros[id_area] value=$id>
   					<input type='submit' name='quinson' value='veure quins son'/></form>  ");
   			
   		//si encara no han confirmat esborrar
   		if(empty($_POST['borrar'])){
   			//mira si hi cursos amb aquella area formativa
   			//mostrar la vista de confirmació   			
   			$datos=array();
   			$datos['usuario']=Login::getUsuario();
   			$datos['area']=$area;   			
   			$this->load_view('view/Areesformatives/borrar_areaformativa.php',$datos);
   		}else{ //si ja m'estan confirmant la baixa
   			// esborrar la area formativa de la BDD
   			if(!$area->borrar())
   				throw new Exception('Error al intentar donar de baixa la area formativa ID $id');

   			// redirigir al llistat d'arees: index.php?controlador=areaformativa&operacion=nuevo
   			header("location:index.php?controlador=areaformativa&operacion=nuevo");
   			/*
   			//carregar la vista d'exit
   			
   				
   			$datos = array();
   			$datos['usuario'] = Login::getUsuario();
   			$datos['mensaje'] = 'Area formativa esborrada correctament';
   			$this->load_view('view/exito.php', $datos);*/   			
   		}
   	}
   	public function exportar($id)
   	{
   		if(!Login::isAdmin())
   			throw new Exception ("Opció restringida només per a l'administrador");
   			// recuperar curs de la BD
   			$this->load('model/AreaformativaModel.php');
   			$this->load('model/PreinscripcioModel.php');
   			$this->load('libraries/xml_library.php');
   	
   			$alumnes=SubscripcioModel::alumnes_subscrits($id);
   			if (empty($alumnes))
   				throw new Exception("No es troben alumnes en aquesta area");   			
   			$xml=XML::toXML($alumnes);
   			$datos = array();
   			$datos['usuario'] = Login::getUsuario();
   			$datos['xml']=$xml;
   			$datos['filename']="alumnes_subscrits_area-$id";
   				//echo $xml;
   			$this->load_view('view/export_xml.php',$datos);
   					
   	}
}
   		
?>