<?php

include "../../_app/Config.inc.php";

$id=$_POST['id'];

$cadastroUser = new Read;
$cadastroUser->ExeRead('usuarios','WHERE user_id=:idUser','idUser='.$id);
$cadastroUser->getResult();
$listar=$cadastroUser->getResult()[0];

//var_dump($listar);
echo json_encode($listar);

?>