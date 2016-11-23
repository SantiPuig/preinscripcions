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
    public static function preinscripcions_alumne($alumne=""){
    	
    	if(!$alumne)    		
    		return null;
    	else {
    		$consulta="SELECT c.codi,c.nom,c.data_inici,c.data_fi,c.horari, 
    					case c.torn when 'T' then 'TARDA' when 'M' Then 'MATI' when 'C' then 'COMPLERT' END torn,count(*) inscrits
				 		FROM cursos c INNER JOIN preinscripcions p on p.id_curs=c.id 
   							left join preinscripcions p2 on p.id_curs=p2.id_curs
   						where p.id_usuari=$alumne
						group by c.codi,c.nom,c.data_inici,c.data_fi,c.horari, 
							case c.torn when 'T' then 'TARDA' when 'M' Then 'MATI' when 'C' then 'COMPLERT' END 
    					order by data_inici;";
    		
    		$resultado=Database::get()->query($consulta);
    		if (!$resultado)
    			throw new Exception("Error en la consulta: $consulta");
    		//echo $consulta;
    		$preins=array();
    		while ($pre=$resultado->fetch_object())
    			$preins[]=$pre;
    		$resultado->free();
    		return $preins;
   				
    	}
    	
    }
}
?>