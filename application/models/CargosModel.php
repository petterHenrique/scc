<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CargosModel extends CI_Model {

	public function getAll($tenantId)
	{
		$this->db->where('TENANT_ID', $tenantId);
    	$cargos = $this->db->get("cargos")->result();
        return $cargos;
	}

	public function salvar($entidade){
		if($entidade['COD_CARGO'] != 0){
			$this->db->where('COD_CARGO', $entidade['COD_CARGO']);
    		$this->db->set($entidade);
    		$this->db->update('cargos', $entidade);
		}else{
			$this->db->insert('cargos',$entidade);
		}
	}

	public function buscarCargoId($codCargo){
		$this->db->where('COD_CARGO', $codCargo);
    	return $this->db->get("cargos")->row();
	}

	public function excluir($codigo, $tenantId){
		$this->db->where('COD_CARGO', $codigo);
		$this->db->where('TENANT_ID', $tenantId);
   		$this->db->delete('cargos'); 
	}
}
