<?php
require '../../config/Config.php';
require '../../libraries/database_library.php';
require '../PreinscripcioModel.php';

//test recuperar preinscripcions
	

	$filtre=array();
	$filtre['id_usuari']=3;
	$filtre['id_curs']=14;
	

	$prs=PreinscripcioModel::preinscripcions($filtre);
	var_dump($prs);

?>