<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DespesasModel extends CI_Model {

	public function getAll(){
		$this->db->limit(15);
		$despesas = $this->db->get("despesas")->result();
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
