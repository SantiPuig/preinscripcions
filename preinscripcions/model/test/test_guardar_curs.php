<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  
  //test Guardar
  $curs= new CursModel();
  $curs->data_fi='2017-07-01';
  $curs->data_inici='2016-12-22';
  $curs->descripcio="Curs de desenvolupament d\'aplicacions Android amb Adobe Flash Mx";
  $curs->horari="Dll a Dv de 16:00 a 19:00";
  $curs->hores=250;
  $curs->id_area=2;
  $curs->nom="Desenvolupament aplicacions per a mòvils i tablets";
  $curs->requisits="Coneixements de programació Java o llenguatges orientats a objectes";
  $curs->tipus="CP Nv2";
  $curs->torn='T';
  
  if (!$curs->guardar())
      echo "No s'ha pogut guardar! :-(";
  else 
  	echo "Curs guardat correctament! :-)";
  
?>