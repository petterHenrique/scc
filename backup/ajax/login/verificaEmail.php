<?php
	include "../../_app/Config.inc.php";
	//include "../../_app/Library/PHPmailer/Class.phpmailer.php";
	$email=$_POST["email"];
	$dados["email"]=$email;
	$busca = new Read;
	$busca->ExeRead('usuarios','WHERE user_email=:email','email='.$email);
	$busca->getRowCount();
	$dadosUsuario=$busca->getResult()[0];
	
	$nomeuser=$dadosUsuario['user_name'];
	$emailuser=$dadosUsuario['user_email'];
	$passworduser=$dadosUsuario['user_password'];

	//echo json_encode($dadosUsuario);
	$dado=$busca->getRowCount();
	if($dado >0){
		$novaSenha="2017".time();
		$new=md5($novaSenha);
		$dado['user_password']=$new;
		$update= new Update;
		$update->ExeUpdate('usuarios',$dado,'WHERE user_email=:email','email='.$emailuser);
		$update->getResult();
		enviaSenha($emailuser,$passworduser,$nomeuser,$novaSenha);
	}else{
		echo "voce nao possui cadastro conosco";
	}
	
	function enviaSenha($emailuser,$passworduser,$nomeuser,$novaSenha){
		// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
		// O return-path deve ser ser o mesmo e-mail do remetente.
		$headers = "MIME-Version: 1.1\r\n";
		$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
		$headers .= "From: ".MAILUSER."\r\n"; // remetente
		$headers .= "Return-Path: ".MAILUSER."\r\n"; // return-path
		
		$novaS= $novaSenha;
		
		$mensagem="Olá {$nomeuser} informamos que sua senha foi alterada, utilize o texto abaixo \r\n
			{$novaS}
		";
		
		$envio = mail($emailuser, "Resetar senha", $mensagem, $headers);
		 
		if($envio)
		 echo "Mensagem enviada com sucesso";
		else
		 echo "A mensagem não pode ser enviada";

		/* Inicia a classe PHPMailer
		$mail = new PHPMailer();
		// Define os dados do servidor e tipo de conexão
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = MAILHOST; // Endereço do servidor SMTP
		//$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
		//$mail->Username = 'seumail@dominio.net'; // Usuário do servidor SMTP
		//$mail->Password = 'senha'; // Senha do servidor SMTP
		// Define o remetente
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->From = MAILUSER; // Seu e-mail
		$mail->FromName = "Lubritec Scherer"; // Seu nome
		// Define os destinatário(s)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->AddAddress($emailuser, $nomeuser);
		$mail->AddAddress('www.lubritec.com.br');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
		// Define os dados técnicos da Mensagem
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
		// Define a mensagem (Texto e Assunto)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		$mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
		$mail->Body = "Este é o corpo da mensagem de teste, em <b>HTML</b>!  :)";
		$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";
		// Define os anexos (opcional)
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
		//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		// Envia o e-mail
		$enviado = $mail->Send();
		// Limpa os destinatários e os anexos
		$mail->ClearAllRecipients();
		$mail->ClearAttachments();
		// Exibe uma mensagem de resultado
		if ($enviado) {
		  echo "E-mail enviado com sucesso!";
		} else {
		  echo "Não foi possível enviar o e-mail.";
		  echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
		}
		
		/*$enviarmail = new Email;
		$dados["Assunto"]="Senha de Acesso LUBRITEC SCHERER";
		$dados["Mensagem"]="Olá {$nomeuser} segue sua senha => {$passworduser}";
		$dados["RemetenteNome"]="Lubritec Scherer";
		$dados["RemetenteEmail"]=MAILUSER;
		$dados["DestinoNome"]=$nomeuser;
		$dados["DestinoEmail"]=$emailuser;
		if($enviarmail->Enviar($dados)){
			echo "Email Enviado com sucesso!";
		}else{
			echo "Falha ao enviar e-mail";
		}*/
	}
?>