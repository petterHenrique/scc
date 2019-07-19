<?php
include "../../_app/Config.inc.php";

$id=$_GET["id"];

$listmesref=new Read;
$listmesref->ExeRead("mesref","WHERE id=:id","id=".$id);
$listmesref->getResult();

$dados=$listmesref->getResult()[0];

echo json_encode($dados);

?>