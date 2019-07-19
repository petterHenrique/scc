<?php
include "../../_app/Config.inc.php";
$id=$_POST["id"];
$nome=$_POST["nome"];
$dados["nome"]=$nome;
$upmesref=new Update;
$upmesref->ExeUpdate("mesref",$dados,"WHERE id=:id","id=".$id);
$upmesref->getResult();
if($upmesref->getResult()){
	echo "Editado com sucesso!";
}else{
	echo "Erro ao editar, entrar em contato (54) 99186-7667";
}
?>