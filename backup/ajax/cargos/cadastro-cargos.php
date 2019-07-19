<?php
include "../../_app/Config.inc.php";
$nome_cargo=$_POST["nomecargo"];

$dados["nome_cargo"]=$nome_cargo;
$cadcargo=new Create;
$cadcargo->ExeCreate("cargos",$dados);
$cadcargo->getResult();

if($cadcargo->getResult()){
	echo "Cadastrado com sucesso!";
}else{
	echo "Erro ao cadastrar, entrar em contato (54) 99186-7667";
}


?>