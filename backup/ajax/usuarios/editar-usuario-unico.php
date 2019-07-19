<?php

include "../../_app/Config.inc.php";

$id=$_POST['id'];
$nome=$_POST['nome'];
$email=$_POST['email'];
$telefone=$_POST['telefone'];
$cpf=$_POST['cpf'];
$cargo=$_POST['cargo'];
$senha=$_POST['senha'];
$nivel=$_POST['nivel'];
$centrocusto=$_POST['centrocusto'];


$dataUser['user_name']=$nome;
$dataUser['user_email']=$email;
$dataUser['user_phone']=$telefone;
$dataUser['user_cpf']=$cpf;
$dataUser['user_codcargo']=$cargo;
$dataUser['user_password']=$senha;
$dataUser['user_level']=$centrocusto;
$dataUser['centrocusto']=$centrocusto;

$updateUser = new Update;
$updateUser->ExeUpdate('usuarios',$dataUser,"WHERE user_id=:idUser","idUser=".$id);
$updateUser->getResult();

if($updateUser->getResult()){
	echo "Atualizado com sucesso";
}
else{
	echo "Erro ao atualizar, contate o suporte (54) 99186-7667";
}

?>