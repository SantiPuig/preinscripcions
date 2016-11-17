<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  
  //test recuperar un los PC concreto
  $c1=CursModel::getCurs(18);
  
  if ($c1 && $c1->borrar())
  		echo "Curs $c1->nom esborrat correctament";
  	else
  		echo "No puc  esborrar   :(";

  	  	
  	 
?>