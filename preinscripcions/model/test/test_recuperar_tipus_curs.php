<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  

  //test recuperar un curs concret
  	   	 
  	 //tiene que retornar null
 	 $ts=CursModel::tipus();  	 
  	 var_dump($ts);
?>