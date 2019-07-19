<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CargosModel extends CI_Model {

	public function getAll()
	{
    	$cargos = $this->db->get("cargos")->result();
        return $cargos;
	}
}
