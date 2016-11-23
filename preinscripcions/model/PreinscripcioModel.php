<?php
class PreinscripcioModel{
	//PROPIEDADES
	public $id_usuari,$id_curs,$data;
		
	//METODOS
	//afegir preinscripcio en la BDD
	public function guardar(){
		
		$consulta = "INSERT INTO preinscripcions(id_usuari,id_curs)
			VALUES ($this->id_usuari,$this->id_curs);";			
		//echo $consulta;
		return Database::get()->query($consulta);
	}

	
	//elimina una preinscripció de la BDD
	public function borrar(){
		
		$consulta = "DELETE FROM preinscripcions WHERE id_usuari=$this->id_usuari and id_curs=$this->id_curs;";
		//echo $consulta;
		return Database::get()->query($consulta);
	}

	/*
	 * Llistat de preinscripcions. Retorna les preinscripcions filtrant per
	 * 	- alumne: si indica l'alumne, retorna totes les preinscripcions de l'alumne
	 * 	- curs_ si indica el curs, retorna tots els alumnes preinscrits al curs
	 * 	- si no indica res, retorna totes les preinscripcions de la B.D.
	 * 	accepta un paràmetre opcional de filtre, que pot estar buit.
	 *  El paràmetre és un arrai associatiu, on la clau és el nom del camp, i el valor es el valor a filtrar.
	 */
    public static function preinscripcions($filtre=array()){
    	$consulta="SELECT * from preinscripcions ";
    	$where="";
    	if (is_array($filtre) || is_object($filtre))
    		foreach ($filtre as $camp=>$valor)
    			$where.=" and $camp=$valor";
    		
    	if ($where)
    		$consulta.=" where ".substr($where,5);
    	$consulta.=";";
    	//echo $consulta;
    	$resultado=Database::get()->query($consulta);
    	$preins=array();
    	while ($pre=$resultado->fetch_object('PreinscripcioModel'))
    		$preins[]=$pre;
  		$resultado->free();
    	return $preins;
    }	
    /*
     *  Obté totes les preinscripcions de l'alumne amb un DNI determinat
     */
    public static function preinscripcions_alumne($dni=""){
    	
    	if(!$dni)    		
    		return null;
    	else {
    		$consulta="select * from v_alumnes_preinscrits where dni='$dni';";
    		$resultado=Database::get()->query($consulta);
    		$preins=array();
    		while ($pre=$resultado->fetch_object())
    			$preins[]=$pre;
    		$resultado->free();
    		return $preins;
   				
    	}
    	
    }
}
?>