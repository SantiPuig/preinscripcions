<?php
	class UsuarioModel{
		//PROPIEDADES
	// antic:	public $user, $password, $nombre, $privilegio=100, $admin=0, $email, $imagen='';
		// New By Santi Puig
		public $id,$dni,$nom,$cognom1,$cognom2,$data_naixement,$estudis,$situacio_laboral,
	 	$prestacio,$telefon_mobil,$telefon_fix,$email,$admin=0,$imatge='';
			
		//METODOS
		//guarda el usuario en la BDD
	/*	public function guardar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "INSERT INTO $user_table(user, password, nombre, privilegio, admin, email, imagen)
			VALUES ('$this->user','$this->password','$this->nombre',100,0,'$this->email', '$this->imagen');";
				
			return Database::get()->query($consulta);
		}*/
	 	// New By Santi Puig	 	
	 	public function guardar(){
	 		$user_table = Config::get()->db_user_table;
	 		$consulta = "INSERT INTO $user_table(dni,nom,cognom1,cognom2,data_naixement,estudis,situacio_laboral,
	 			prestacio,telefon_mobil,telefon_fix,email,admin,imatge)
	 		VALUES ('$this->dni','$this->nom','$this->cognom1','$this->cognom2','$this->data_naixement',$this->estudis,$this->situacio_laboral
	 		   ,'$this->prestacio','$this->telefon_mobil','$this->telefon_fix','$this->email',0,'$this->imatge');";
	 		//echo $consulta;
	 		return Database::get()->query($consulta); 			
	 	}
		
		
		//actualiza los datos del usuario en la BDD
		/* Versió old
		public function actualizar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "UPDATE $user_table
							  SET password='$this->password', 
							  		nombre='$this->nombre', 
							  		email='$this->email', 
							  		imagen='$this->imagen'
							  WHERE user='$this->user';";
			return Database::get()->query($consulta);
		} */
	 	// New By Santi Puig
		public function actualizar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "UPDATE $user_table
			SET	dni='$this->dni',
				nom='$this->nom',
				cognom1='$this->cognom1',
				cognom2='$this->cognom2',
				data_naixement='$this->data_naixement',
				estudis=$this->estudis,
				situacio_laboral=$this->situacio_laboral,
	 			prestacio=$this->prestacio,
	 			telefon_mobil='$this->telefon_mobil',
	 			telefon_fix='$this->telefon_fix',
	 			email='$this->email',
	 			imatge='$this->imatge'
				WHERE id=$this->id;";
			//echo $consulta;
			return Database::get()->query($consulta);
		}
		
		
		//elimina el usuario de la BDD
		/*
		 * OLD
		 public function borrar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "DELETE FROM $user_table WHERE user='$this->user';";
			return Database::get()->query($consulta);
		} */
		
		// New By Santi Puig
		public function borrar(){
			$user_table = Config::get()->db_user_table;
			$consulta = "DELETE FROM $user_table WHERE id=$this->id;";
			return Database::get()->query($consulta);
		}		
		
		//este método sirve para comprobar user y password (en la BDD)
		/* Versió Old 
		public static function validar($u, $p){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE user='$u' AND password='$p';";
			$resultado = Database::get()->query($consulta);
			
			//si hay algun usuario retornar true sino false
			$r = $resultado->num_rows;
			$resultado->free(); //libera el recurso resultset
			return $r;
		}
		// New By Santi Puig
		 * 
		 * 
		 */
		public static function validar($u, $p){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE DNI='$u' AND data_naixement='$p';";
			$resultado = Database::get()->query($consulta);
				
			//si hay algun usuario retornar true sino false
			$r = $resultado->num_rows;
			$resultado->free(); //libera el recurso resultset
			return $r;
		}
		//este método debería retornar un usuario creado con los datos 
		//de la BDD (o NULL si no existe), a partir de un nombre de usuario
		public static function getUsuario($u){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE id='$u';";
			$resultado = Database::get()->query($consulta);
			
			$us = $resultado->fetch_object('UsuarioModel');
			$resultado->free();
			
			return $us;
		}	
		// retorna el usuario a partir de su DNI
		public static function getUsuario_ByDni($u){
			$user_table = Config::get()->db_user_table;
			$consulta = "SELECT * FROM $user_table WHERE dni='$u';";
			$resultado = Database::get()->query($consulta);
				
			$us = $resultado->fetch_object('UsuarioModel');
			$resultado->free();
				
			return $us;
		}
		// obtiene un array con todos los usuarios
		public static function getUsuarios(){
			/*
			 * Retorna un array bidimensional con las siguientes columnas:
			 *  0->ID Alumno
			 *  1->Nombre y apellidos
			 *  2->Edat
			 *  3->email
			 *  4->prestacion(SI/no)
			 *  5->Situacion laboral (int)
			 *  6->Telefono fijo
			 *  7->Telefono mobil
			 *  8->Numero de preinscripciones a cursos
			 */
			$user_table = Config::get()->db_user_table;
			$consulta = "select u.id,concat(nom,' ', cognom1,' ',cognom2) as nom,
					    year(curdate())-year(u.data_naixement)+if(date_format(curdate(),'%m-%d')>date_format(u.data_naixement,'%m-%d'),0,1) as edat,
						u.email,
						if(prestacio,'','Si') prestacio,
						situacio_laboral,telefon_fix,telefon_mobil,
						count(*) as inscripcions						
					from usuaris u
					  left join preinscripcions p on p.id_usuari=u.id
					group by u.id,concat(nom,' ', cognom1,' ',cognom2) ,
					   	year(curdate())-year(u.data_naixement)+if(date_format(curdate(),'%m-%d')>date_format(u.data_naixement,'%m-%d'),0,1),
						u.email,prestacio,situacio_laboral,	telefon_fix,telefon_mobil;";
			
			$resultado = Database::get()->query($consulta);
			
			$usuaris=array();
			
			while($us = $resultado->fetch_object())
				$usuaris[]=$us;
			$resultado->free();				
			return $usuaris;
		}
	}
?>