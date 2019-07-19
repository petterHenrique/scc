<?php
include "../../_app/Config.inc.php";
$id=$_POST["id"];
$delmesref=new Delete;
$delmesref->ExeDelete("mesref","WHERE id=:id","id=".$id);
$delmesref->getResult();

if($delmesref->getResult()){
	echo "Excluído com sucesso!";
}else{
	echo "Erro ao excluir, entrar em contato (54) 99186-7667";
}
?>