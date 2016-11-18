<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../UsuarioModel.php';
  
  //test Guardar
  $us=new UsuarioModel();
  $us->dni="12345678J";
  $us->nom="Nombre";
  $us->cognom1="Apellido1";
  $us->cognom2="Apellido2";
  $us->data_naixement="2017-01-12";
  $us->estudis=1;
  $us->situacio_laboral=0;
  $us->prestacio=0;
  $us->telefon_mobil="610953745";
  $us->telefon_fix="937334455";
  $us->email="emilio@dominio.com";
  	
  if (!$us->guardar())
  	echo "No s'ha pogut guardar l'usuari :'-(";
  else 
  	echo "Usuari guardat correctament :-)";
?>