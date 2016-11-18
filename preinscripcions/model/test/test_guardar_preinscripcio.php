<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../PreinscripcioModel.php';
  
  //test Guardar
  
  $pr=new PreinscripcioModel();
  $pr->id_usuari=3;
  $pr->id_curs=4;
  
  if(!$pr->guardar())
  	echo "No s'ha pogut guardar la preinscripcio :-(";
  else 
  	echo "Preinscripcio guardada correctament!";
 
?>