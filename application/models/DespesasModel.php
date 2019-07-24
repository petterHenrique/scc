<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DespesasModel extends CI_Model {

	public function getAll($tenantId, $codigoUsuario){
	
		$this->db->limit(15);

		$despesas = $this->db->query("SELECT * FROM `despesas` inner join categorias on categorias.COD_CATEGORIA = despesas.COD_CATEGORIA AND despesas.TENANT_ID = '".$tenantId."' AND despesas.COD_USUARIO = ".$codigoUsuario)
           ->result();
		return $despesas;
	}


	public function salvar($entidade){
		if($entidade['COD_DESPESA'] != 0){
			$this->db->where('COD_DESPESA', $entidade['COD_DESPESA']);
    		$this->db->set($entidade);
    		$this->db->update('despesas', $entidade);
		}else{
			$this->db->insert('despesas',$entidade);
		}
	}
}

