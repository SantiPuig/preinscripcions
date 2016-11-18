<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../UsuarioModel.php';
  
  //test recuperar un los PC concreto
  echo UsuarioModel::validar('12345678J', "2017-01-12");
  
  	  	
  	 
?>