<?php
class AreaformativaModel{
	//PROPIEDADES
	public $id, $nom;
		
	//METODOS
	//guarda area formativa
	public function guardar(){
		
		$consulta = "INSERT INTO arees_formatives (nom) VALUES ('$this->nom');";
		//echo $consulta;
		return Database::get()->query($consulta);
	}
	
	//actualiza dades arees formatives
	public function actualizar(){		
		$consulta = "UPDATE arees_formatives SET nom='$this->nom' where id=$this->id;";
		//echo $consulta;
		return Database::get()->query($consulta);
	}


	//elimina el area formatva de la BDD
	public function borrar(){
		
		$consulta = "DELETE FROM arees_formatives WHERE id=$this->id;";
		return Database::get()->query($consulta);
	}


	//retorna la area formativa a partir del seu ID
	public static function getAreaFormativa($idarea=0){
		$consulta = "SELECT * FROM arees_formatives WHERE id=$idarea;";
		$resultado = Database::get()->query($consulta);
			
		$ar = $resultado->fetch_object('AreaformativaModel');
		$resultado->free();
			
		return $ar;
	}
	/*
	 *  Donat un nom d'area, busca si hi ha algun altre 
	 */
	public static function buscaId($nom=''){
		$consulta="select id from arees_formatives where nom='$nom' limit 1;";
		$resultado = Database::get()->query($consulta);			
		$res = $resultado->fetch_object();
		$resultado->free();
		return $res;
	}
	//Este método retorna totes les arees formatives
	public static function arees_formatives(){
		$consulta = "select * from arees_formatives order by Id;";
		
		$resultado = Database::get()->query($consulta);
		
		$ars=Array();
		
		while ($ar = $resultado->fetch_object('AreaformativaModel'))
			$ars[]=$ar;
		$resultado->free();
			
		return $ars;
	}	
	
}
?>