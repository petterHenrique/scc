<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Cargos extends MasterLogado {

	public function __construct()
    {
        parent::__construct();
        $this->verificaAdministrador();
    }

	public function index()
	{

		$this->load->model('CargosModel');

		$dados['cargos'] = $this->CargosModel->getAll($this->usuario->TENANT_ID);

		$this->load->view('/gerenciador/cargos', $dados);
	}
}
