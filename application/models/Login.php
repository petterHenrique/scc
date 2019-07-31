<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

	public function buscarUsuarioEmailSenha($email, $senha)
	{	
		$senhaformatada = $this->md5_encrypt($senha,"123");

		$this->db->where('EMAIL_USUARIO', $email);
		//$this->db->where('SENHA_USUARIO', $senhaformatada);
		$this->db->where('TIP_ATIVO', 1);
    	$usuario = $this->db->get("usuarios")->row();


    	if(empty($usuario)){
    		throw new Exception("E-mail ou senha inválidos", 1);
    	}else{

    		$senhaTela = $senha;
    		$senhaBD = $this->md5_decrypt($usuario->SENHA_USUARIO,"");

    		if($senhaTela == $senhaBD){
    			return $usuario;
    		}else{
    			throw new Exception("E-mail ou senha inválidos", 1);
    		}
    	}
	}

	public function enviarsenhaemail($email){

		$this->db->where('EMAIL_USUARIO', $email);
		$usuario = $this->db->get("usuarios")->row();

		if(empty($usuario)){

			throw new Exception("Usuário não encontrado!", 1);

		}else{
			$this->load->library('email');
			$this->email->from("pedraobigger@gmail.com", "Lubritec Scherer");
			$this->email->subject("Recuperação de Senha");
			$this->email->to($usuario->EMAIL_USUARIO);
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->subject('Olá '.$usuario->DES_USUARIO);
			$this->email->message('Senha de acesso ao controle de contas lubritec</br></br></br> <b>'.$this->md5_decrypt($usuario->SENHA_USUARIO,"").'</b>');
			$this->email->send();
		}
	}

	public function criptografarsenha($senha){

		return $this->md5_encrypt($senha,"");

	}

	private function get_rnd_iv($iv_len){   
		$iv = '';   while ($iv_len-- > 0) {	   
			$iv .= chr(mt_rand() & 0xff);   
		}  
		return $iv;
	}

	private function md5_encrypt($plain_text, $password, $iv_len = 16){   
		$plain_text .= "\x13";   $n = strlen($plain_text);   
		if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));   
		$i = 0;   $enc_text = $this->get_rnd_iv($iv_len);  
		 $iv = substr($password ^ $enc_text, 0, 512);   
		 while ($i < $n) {	  
		  $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));	   $enc_text .= $block;	   $iv = substr($block . $iv, 0, 512) ^ $password;	   $i += 16;   }   return base64_encode($enc_text);}


	private function md5_decrypt($enc_text, $password, $iv_len = 16){   
		$enc_text = base64_decode($enc_text);   
		$n = strlen($enc_text);   
		$i = $iv_len;   
		$plain_text = '';   
		$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);   

		while ($i < $n) {	   
			$block = substr($enc_text, $i, 16);	   
			$plain_text .= $block ^ pack('H*', md5($iv));	   
			$iv = substr($block . $iv, 0, 512) ^ $password;	   
			$i += 16;   
		}   

		return preg_replace('/\\x13\\x00*$/', '', $plain_text);

	}
}
