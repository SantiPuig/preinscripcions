<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  

  //test recuperar un curs concret
  	 $c1=CursModel::getCurs(19);  	 
  	 var_dump($c1);
  	 
  	 //tiene que retornar null
 	 $c1=CursModel::getCurs(18);  	 
  	 var_dump($c1);
?>