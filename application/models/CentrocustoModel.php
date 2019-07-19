<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centrocusto extends CI_Model {

	public function getAll(){
		$centrocusto = $this->db->get("centrocusto")->result_row();
		return $centrocusto;
	}
}
