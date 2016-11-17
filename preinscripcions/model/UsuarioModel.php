<?php
	class UsuarioModel{
		//PROPIEDADES
	// antic:	public $user, $password, $nombre, $privilegio=100, $admin=0, $email, $imagen='';
		// New By Santi Puig
		public $id,$dni,$nom,$cognom1,$cognom2,$data_naixement,$estudis,$sitaucio_laboral,
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
	 		$consulta = "INSERT INTO $user_table(dni,nom,cognom1,cognom2,data_naixement,estudis,sitaucio_laboral,
	 			prestacio,telefon_mobil,telefon_fix,email,admin,imatge)
	 		VALUES ('$this->dni','$this->nom','$this->cognom1','$this->cognom2','$this->data_naixement',$this->estudis,$this->sitaucio_laboral
	 		   ,'$this->prestacio','$this->telefon_mobil','$this->telefon_fix','$this->email',0,'$this->imatge');";
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
				estudis=$this->estudies,
				sitaucio_laboral='$this->situacio_laboral,
	 			prestacio=$this->prestacio,
	 			telefon_mobil='$this->telefon_mobil',
	 			telefon_fix='$this->telefon_fix',
	 			email='$this->email',
	 			imatge='$this->imatge'
				WHERE id=$this->id;";
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
			$consulta = "SELECT * FROM $user_table WHERE user='$u';";
			$resultado = Database::get()->query($consulta);
			
			$us = $resultado->fetch_object('UsuarioModel');
			$resultado->free();
			
			return $us;
		}	
	}
?>