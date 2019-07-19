<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Model {

	public function getAll()
	{
    	$categorias = $this->db->get("categorias")->result_row();
        return $categorias;
	}
}
