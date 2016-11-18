<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../UsuarioModel.php';
  
  //test Guardar
  $u='4852265f';
  $usuari=UsuarioModel::getUsuario($u);
  if (!$usuari)
  	 echo "No s'ha trobat l'alumne";
  else {
  	$usuari->dni='845265F';
  	if ($usuari->actualizar())
  		echo "Usuario $usuari->nom $usuari->cognom1 $usuari->cognom2 actualitzat correctament";
  	else 
  		echo "No he pogut modificar l'usuari";
  }  
?>