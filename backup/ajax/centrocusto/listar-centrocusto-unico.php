<?php
include "../../_app/Config.inc.php";

$id=$_POST["id"];

$listcentrocusto=new Read;
$listcentrocusto->ExeRead("centrocusto","WHERE id_cent=:id","id=".$id);
$listcentrocusto->getResult();

$dados=$listcentrocusto->getResult()[0];

echo json_encode($dados);

?>