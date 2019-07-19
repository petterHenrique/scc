<?php

include "../../_app/Config.inc.php";

$id=$_POST["id"];

$listcategoria=new Read;
$listcategoria->ExeRead("categorias","WHERE id_cat=:id","id=".$id);
$listcategoria->getResult();

$dados=$listcategoria->getResult()[0];

echo json_encode($dados);

?>