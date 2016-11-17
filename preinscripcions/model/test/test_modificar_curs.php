<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  
  //test Guardar
  $curs= CursModel::getCurs(19);
  if (!$curs)
  	echo "No s'ha pogut trobar el curs";
  else {
	  
	  $curs->data_fi='2017-07-06';
	  $curs->data_inici='2016-12-12';
	  $curs->descripcio="Curs de desenvolupament d\'aplicacions Android amb Adobe Flash Mx";
	  $curs->horari="Dll a Dv de 16:00 a 21:00";
	  $curs->hores=250;
	  $curs->id_area=2;
	  $curs->nom="Desenvolupament aplicacions per a mòvils i tablets";
	  $curs->requisits="Coneixements de programació Java o llenguatges orientats a objectes";
	  $curs->tipus="CP Nv3";
	  $curs->torn='T';
	  
	  if  ($curs->actualizar())
	  	echo "Curs actualitzat correctament";
	  else 
	  	echo "No he pogut modificar el curs";
  }	  
  
?>