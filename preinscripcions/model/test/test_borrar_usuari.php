<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../UsuarioModel.php';
  
  //test recuperar un los PC concreto
  $us=UsuarioModel::getUsuario("12345678J");
  
  if ($us && $us->borrar())
  	echo "Usuari $us->nom $us->cognom1 $us->cognom2 esborrat correctament :-)";
  else 
  		"No he pogut esborrar l'usuari $us->nom $us->cognom1 $us->cognom2 :-(";
 
  	  	
  	 
?>