<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {

	public function getAll(){
		$usuarios = $this->db->get("usuarios")->result_row();
		return $usuarios;
	}

	public function buscarUsuarioEmailSenha($email, $senha)
	{
		$this->db->where('EMAIL_USUARIO', $email);
		$this->db->where('SENHA_USUARIO', md5($senha));
		$this->db->where('TIP_ATIVO', 1);
    	$usuario = $this->db->get("usuarios")->row();
        return $usuario;
	}
}
