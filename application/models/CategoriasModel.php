<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasModel extends CI_Model {

	public function getAll($tenantId)
	{
		$this->db->where('TENANT_ID', $tenantId);
    	$categorias = $this->db->get("categorias")->result();
        return $categorias;
	}

	public function salvar($entidade){
		if($entidade['COD_CATEGORIA'] != 0){
			$this->db->where('COD_CATEGORIA', $entidade['COD_CATEGORIA']);
    		$this->db->set($entidade);
    		$this->db->update('categorias', $entidade);
		}else{
			$this->db->insert('categorias',$entidade);
		}
	}

	public function buscarCategoriaId($codCategoria){
		$this->db->where('COD_CATEGORIA', $codCategoria);
    	return $this->db->get("categorias")->row();
	}

	public function excluir($codigo, $tenantId){
		$this->db->where('COD_CATEGORIA', $codigo);
		$this->db->where('TENANT_ID', $tenantId);
   		$this->db->delete('categorias'); 
	}
}
