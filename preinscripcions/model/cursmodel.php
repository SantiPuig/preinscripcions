<?php
class CursModel{
	//PROPIEDADES
	public $id, $codi, $id_area, $nom, $descripcio, $hores, $data_inici,$data_fi,$horari,
		$torn,$tipus,$requisits;
		
	//METODOS
	//guarda el curs en la BDD
	public function guardar(){
		
		$consulta = "INSERT INTO cursos(
			codi, id_area, nom, descripcio, hores, data_inici,data_fi,horari,
			torn,tipus,requisits)  VALUES
			('$this->codi',$this->id_area,'$this->nom','$this->descripcio',$this->hores,'$this->data_inici','$this->data_fi','$this->horari',
			'$this->torn','$this->tipus','$this->requisits');";
		//echo $consulta;
		return Database::get()->query($consulta);
	}

	
	//actualiza los datos del CURSO
	public function actualizar(){		
		$consulta = "UPDATE cursos
		SET	codi='$this->codi', 
			id_area=$this->id_area, 
			nom='$this->nom', 
			descripcio='$this->descripcio', 
			hores=$this->hores, 
			data_inici='$this->data_inici',
			data_fi='$this->data_fi',
			horari='$this->horari',
			torn='$this->torn',
			tipus='$this->tipus',
			requisits='$this->requisits'		
		WHERE id=$this->id;";
		//echo $consulta;
		return Database::get()->query($consulta);
	}


	//elimina el curso de la BDD
	public function borrar(){
		
		$consulta = "DELETE FROM cursos WHERE id=$this->id;";
		return Database::get()->query($consulta);
	}


	//este método debería retornar un curso a partir de su Id
	public static function getCurs($idcurs=0){
		$consulta = "SELECT * FROM cursos WHERE id=$idcurs;";
		$resultado = Database::get()->query($consulta);
			
		$curs = $resultado->fetch_object('CursModel');
		$resultado->free();
			
		return $curs;
	}
	
	//Este método retorna todos los cursos de la base de datos
	public static function cursos(){
		$consulta = "select c.*,af.nom nom_area,count(*) preinscrits
						from cursos c left join arees_formatives af on af.id=c.id_area
							left join preinscripcions p on p.id_curs=c.id 
						where data_inici is null
						or data_inici=''
						or data_inici>now()
					group by c.id,c.codi,c.id_area,c.nom,c.descripcio,c.hores,c.data_inici,
						c.data_fi,c.horari,c.torn,c.tipus,c.requisits,af.nom
						order by af.nom,data_inici;";
	
		//echo $consulta;
		$resultado = Database::get()->query($consulta);
		
		$cursos=Array();
		
		while ($curs = $resultado->fetch_object('CursModel'))
			$cursos[]=$curs;
		$resultado->free();
			
		return $cursos;
	}
	//Este método retorna todos los cursos que coincidan con el filtro pasado.
	// se pasará por parámetro un array tipo campo:valor que definirá el campo a filtrar y el valor a filtrar
	public static function cursos_filtrats($filtros=array()){
		$consulta = "
			select c.*,af.nom nom_area,count(*) preinscrits
						from cursos c left join arees_formatives af on af.id=c.id_area
							left join preinscripcions p on p.id_curs=c.id ";
		$where="";
		if (is_array($filtros) || is_object($filtros))
			foreach ($filtros as $campo=>$valor) {
				if ($campo=='desded')
					$where.=" and data_inici>='$valor'";
				elseif ($campo=='finsd')
					$where.=" and data_inici<='$valor'";
				elseif (($campo=='id_area')||($campo=='hores'))
					$where.=" and c.$campo=$valor";
				else
					$where.=" and upper(c.$campo) like upper('%$valor%')";
			}
		if ($where)
			$consulta.=" where ".substr($where, 5);
		$consulta.=" group by c.id,c.codi,c.id_area,c.nom,c.descripcio,c.hores,c.data_inici,
						c.data_fi,c.horari,c.torn,c.tipus,c.requisits,af.nom ";
		$consulta.=" order by af.nom;";
		
			
		//echo $consulta;
		$resultado = Database::get()->query($consulta);
	
		$cursos=Array();
	
		while ($curs = $resultado->fetch_object())
			$cursos[]=$curs;
			$resultado->free();	
		return $cursos;
	}
	public static function tipus(){
		$consulta="SELECT DISTINCT tipus from cursos order by 1;";
		
		$resultado= Database::get()->query($consulta);
		$ts=array();
		while ($t=$resultado->fetch_array())
			$ts[]=$t[0];
		$resultado->free();
		return $ts;
	
	}
	
	
}
?>