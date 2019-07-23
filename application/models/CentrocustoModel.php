<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CentrocustoModel extends CI_Model {

	public function getAll($tenantId){
		$this->db->where('TENANT_ID', $tenantId);
		$centrocusto = $this->db->get("centrocusto")->result();
		return $centrocusto;
	}
}
