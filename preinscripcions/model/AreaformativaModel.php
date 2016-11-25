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
		$idarea=intval($idarea);
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
class SubscripcioModel{
	public $id_usuari,$id_area,$data;
	public function guardar(){
	
		$consulta = "INSERT INTO subscripcions (id_usuari,id_area) VALUES ($this->id_usuari,$this->id_area);";
		//echo $consulta;
		return Database::get()->query($consulta);
	}
	public function borrar(){
	
		$consulta = "DELETE FROM subscripcions WHERE id_usuari=$this->id_usuari and id_area=$this->id_area;";
		return Database::get()->query($consulta);
	}
	public static function suscripcions_alumne($id_alumne){
		$consulta="Select a.nom,s.id_area,s.data 
					FROM subscripcions s 
						inner join arees_formatives a on a.id=s.id_area
					where s.id_usuari=$id_alumne";
		$subs=array();
		$resultado = Database::get()->query($consulta);
		while ($s = $resultado->fetch_object())
			$subs[]=$s;
		$resultado->free();
				
		return $subs;			
	}
	
}
?>