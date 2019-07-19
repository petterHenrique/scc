<?php

include "../../_app/Config.inc.php";

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
$dataUser['user_password']=md5($senha);
$dataUser['user_level']=$nivel;
$dataUser['centrocusto']=$centrocusto;

$cadastroUser = new Create;
$cadastroUser->ExeCreate('usuarios',$dataUser);
$cadastroUser->getResult();

if($cadastroUser->getResult()){
	echo "cadastrado com sucesso";
}
else{
	echo "Erro ao cadastrar";
}

?>