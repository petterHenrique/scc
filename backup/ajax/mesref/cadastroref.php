<?php
include "../../_app/Config.inc.php";
$referencia=$_POST["nome_ref"];

$dados["nome"]=$referencia;
$cadref=new Create;
$cadref->ExeCreate("mesref",$dados);
$cadref->getResult();

if($cadref->getResult()){
	echo "Cadastrado com sucesso!";
}else{
	echo "Erro ao cadastrar, entrar em contato (54) 99186-7667";
}


?>