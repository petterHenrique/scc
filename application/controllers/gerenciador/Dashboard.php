<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Dashboard extends MasterLogado {

	public function index()
	{
		$this->load->view('/gerenciador/index');
	}

	public function graficohome(){
		$this->load->model('RelatoriosModel');

		$dados = $this->RelatoriosModel->buscarRelatorioHome($this->usuario->TENANT_ID);

		$this->output
        	->set_status_header(200)
        	->set_content_type('application/json', 'utf-8')
        	->set_output(json_encode($dados));
	}
}
