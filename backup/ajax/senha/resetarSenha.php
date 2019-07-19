<?php

include "../../_app/Config.inc.php";
try{
	$cpf = $_POST["cpf"];
	$cadastroUser = new Read;
	$cadastroUser->ExeRead('usuarios','WHERE user_cpf=:cpf','cpf='.$cpf);
	$cadastroUser->getResult();
	$listar=$cadastroUser->getResult()[0];
	//senha segura
	$senhaRandomica = "lubritec@".rand(4567, 8765).$listar["user_name"];
	//dados para serem atualizados
	$dados["user_password"] = md5($senhaRandomica);
	$dados["atualizaSenha"] = 1;	
	//atualiza os dados do cliente
	$atualizarSenha = new Update();
	$atualizarSenha->ExeUpdate("usuarios",$dados,"WHERE user_cpf=:user_cpf","user_cpf=".$cpf);
	$atualizarSenha->getResult();
	//mensagem a ser exibida no momento de enviar o email
	$msg = "Olá {$listar['user_name']} sua nova senha é {$senhaRandomica}, e Lubritec Scherer agradece sua disposição";
	
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
	$headers .= "From: {MAILUSER}\r\n"; // remetente
	$headers .= "Return-Path: {MAILUSER}\r\n"; // return-path
	$envio = mail($listar["user_email"], "Atualização de Senha", $msg, $headers);
	 
	if($envio)
	  echo "E-mail enviado com sucesso";
	else
	  echo "A mensagem não pode ser enviada";

}catch(Exception $e){
	echo json_encode("Ocorreu um erro! => ".$e->getMessage());
}
?>