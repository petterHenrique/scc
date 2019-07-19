<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CargosModel extends CI_Model {

	public function getAll($tenantId)
	{
		$this->db->where('TENANT_ID', $tenantId);
    	$cargos = $this->db->get("cargos")->result();
        return $cargos;
	}
}
