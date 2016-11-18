<?php
  require '../../config/Config.php';
  require '../../libraries/database_library.php';
  require '../cursmodel.php';
  


  	 //test recuperar todos los PCs
  	 $cs=CursModel::cursos();  	 
  	 var_dump($cs);
?>