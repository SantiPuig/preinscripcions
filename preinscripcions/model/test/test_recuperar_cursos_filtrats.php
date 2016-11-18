<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  


  	 //test recuperar todos los PCs
  	 $datos=array();
  	 $datos['hores']=250;
  	 $datos['descripcio']='teclas';
  	 //$datos['nom']='Oh yeah!';
  	 $cs=CursModel::cursos_filtrats($datos); 
  	// $cs=CursModel::cursos_filtrats();
  	  
  	 var_dump($cs);
?>