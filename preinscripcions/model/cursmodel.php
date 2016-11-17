<?php
class CursModel{
	//PROPIEDADES
	public $id_pc, $marca, $model, $Serial, $RAM, $HD, $MAC,$fecha_compra,$fin_garantia;
		
	//METODOS
	//guarda el PC en la BDD
	public function guardar(){
		
		$consulta = "INSERT INTO pcs(id_pc, marca, model, serial, RAM, HD, MAC,fecha_compra,fin_garantia)
		VALUES ('$this->id_pc','$this->marca','$this->model','$this->Serial',
		 '$this->RAM', '$this->HD','$this->MAC','$this->fecha_compra','$this->fin_garantia');";

		return Database::get()->query($consulta);
	}


	//actualiza los datos del PC
	public function actualizar(){		
		$consulta = "UPDATE pcs
		SET	marca='$this->marca',
		    model='$this->model',
		    Serial='$this->Serial', 
		    RAM='$this->RAM',
		    HD='$this->HD',
		    MAC='$this->MAC',
		    fecha_compra='$this->fecha_compra',
		    fin_garantia='$this->fin_garantia'		
		WHERE id_pc='$this->id_pc';";
		return Database::get()->query($consulta);
	}


	//elimina el PC de la BDD
	public function borrar(){
		
		$consulta = "DELETE FROM pcs WHERE id_pc='$this->id_pc';";
		return Database::get()->query($consulta);
	}


	//este método debería retornar un pc a partir de su Id
	public static function getPc($idpc=0){
		$consulta = "SELECT * FROM pcs WHERE id_pc=$idpc;";
		$resultado = Database::get()->query($consulta);
			
		$pc = $resultado->fetch_object('PcModel');
		$resultado->free();
			
		return $pc;
	}
	
	//Este método retorna todos los PCs de la base de datos
	public static function getPcs(){
		$consulta = "SELECT * FROM pcs ;";
		$resultado = Database::get()->query($consulta);
		
		$pcs=Array();
		
		while ($pc = $resultado->fetch_object('PcModel'))
			$pcs[]=$pc;
		$resultado->free();
			
		return $pcs;
	}
}
?>