<?php
require '../../config/Config.php';
require '../../libraries/database_library.php';
require '../PreinscripcioModel.php';

//test Guardar
	$pr=new PreinscripcioModel();
	$pr->id_usuari=3;
	$pr->id_curs=3;
	
	if($pr->borrar())
		echo "Preinscripcio esborrada correctament ";
	else
		echo "Error al esborrar preinscripcio";

?>