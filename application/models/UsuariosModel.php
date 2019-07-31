<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model {

	public function getAll($ativo = false, $tenantId){

		if($ativo){
			$this->db->where("TIP_ATIVO", 1);
		}

		$this->db->where("TIP_MASTER", 0);
		$this->db->where("TENANT_ID", $tenantId);
		$usuarios = $this->db->get("usuarios")->result();
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

	public function salvar($entidade){
		if($entidade['COD_USUARIO'] != 0){
			$this->db->where('COD_USUARIO', $entidade['COD_USUARIO']);
    		$this->db->set($entidade);
    		$this->db->update('usuarios', $entidade);
		}else{
			$this->db->insert('usuarios',$entidade);
		}
	}
}
