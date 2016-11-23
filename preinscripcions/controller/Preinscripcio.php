<?php
   class Preinscripcio extends Controller{
   	public function index() { //default method
   		//echo('ahora voy a listar');
   		$this->listar();
   }
   
   
   
   public function listar() {
   	//demanar al model que recuperi tots els cursos
   	$this->load('model/cursmodel.php');
   	$cs=CursModel::cursos();
   	
   	//passar els pcs a la vista
   	$datos=array();
   	$datos['usuario']=Login::getUsuario();
   	$datos['cursos']=$cs;
   	
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
   	$c=CursModel::getCurs($id);
   	
   	if (!$c)
   		throw new Exception('No se encuentra el Curso :-(');
   	
   		   	
   	//passar el pc a la vista
   	$datos=array();
   	$datos['usuario']=Login::getUsuario();
   	$datos['curs']=$c;
   	$this->load_view('view/cursos/detalles.php',$datos);   	
   	
   }
   //OPERACIONS DE L'ADMINISTRADOR
   //Donar d'alta un nou curs
   public function nuevo($idcurs){
   	//Cal comprovar si l'usuari és Admin
   	if(Login::isAdmin())
   		throw new Exception("L'administrador no es pot inscriure als cursos");
   	
   	if(!Login::getUsuario())
   		throw new Exception("Opció només per a usuaris registrats");
   	if (!$idcurs)
   		throw new Exception("No s'ha indicat cap curs");
   	
   	$this->load('model/cursmodel.php');
   	$c=CursModel::getCurs($idcurs);
   	if(!$c)
   		throw new Exception("Curs inexistent");   		
   	
   	$u=Login::getUsuario();
   	$this->load('model/PreinscripcioModel.php');
   	$pre=new PreinscripcioModel();   	
   	$pre->id_curs=$idcurs;
   	$pre->id_usuari=$u->id;
   	if(!$pre->guardar())
   		throw new Exception("Ja estaves inscrit al curs!");
   		
   		// mostrar la vista de èxit
   	$datos=array();

   	$datos['usuario']=login::getUsuario();
   	$datos['mensaje']="T'has inscrit al curs $c->codi - $c->nom correctament";
   	$this->load_view('view/exito.php',$datos);
   		
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
   		$this->load_view('view/pcs/admin/modificar.php',$datos);
   	  		
   	}else{ //si que m'envien dades
   		//recuperar les dades que m'arriven via POST
   		
   		$c->codi=$conexion->real_escape_string($POST['codi']);
   		$c->id_area=$POST['id_area'];
   		$c->nom=$conexion->real_escape_string($POST['nom']);
   		$c->descripcio=$conexion->real_escape_string($POST['descripcio']);
   		$c->hores=$POST['hores'];
   		$c->data_inici=$conexion->real_escape_string($POST['data_inici']);
   		$c->data_fi=$conexion->real_escape_string($POST['data_fi']);
   		$c->horari=$conexion->real_escape_string($POST['horari']);
   		$c->torn=$POST['torn'];
   		$c->tipus=$POST['tipus'];
   		$c->requisits=$conexion->real_escape_string($POST['requisits']);
   		
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
   		$c=CursModel::getCurs($id);
   		
   		//comprovar que el curs s'ha carregat correctament
   		if (empty($c))
   			throw new Exception("No es troba el curs");
   		//si encara no han confirmat esborrar
   		if(empty($_POST['borrar'])){
   			//mira si hi ha preinscripcions al curs.
   			$this->load('model/PreinscripcioModel.php');
   			$filtre=array();
   			$filtre['id_curs']=$id;
   			$inscrits=count(PreinscripcioModel::preinscripcions(filtre));
   			
   			//mostrar la vista de confirmació   			
   			$datos=array();
   			$datos['usuario']=Login::getUsuario();
   			$datos['curs']=$c;
   			$datos['inscrits']=$inscrits;
   			
   			$this->load_view('view/pcs/admin/borrar.php',$datos);
   		}else{ //si ja m'estan confirmant la baixa
   			// esborrar el curs de la BDD
   			if(!$c->borrar())
   				throw new Exception('Error al intentar donar de baixa el curs');
   			//carregar la vista d'exit
   			//$datos[''] ...
   			
   			//tornar a carregar el llistat de PCs
   			//$datos=array();
   			//$datos['usuario']=Login::getUsuario();
   			$this->listar();   			
   			
   		}
   	}
}
   		
?>