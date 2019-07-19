<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Categorias extends MasterLogado {

	public function index()
	{
		$this->load->view('/gerenciador/index');
	}
}
