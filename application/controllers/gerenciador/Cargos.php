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

		$this->load->view('/gerenciador/cargos/index', $dados);
	}

	public function salvar(){
		try{

			$codigo = $this->input->post('codigocargo');
			$descargo = $this->input->post('descargo');

			$entidade = array(
				'COD_CARGO' => $codigo,
				'DES_CARGO' => $descargo,
				'TENANT_ID' => $this->usuario->TENANT_ID
			);

			$this->load->model('CargosModel');

			$salvar = $this->CargosModel->salvar($entidade);

			
			$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		array(
	        			'sucesso' => true,
	        			'msg' => "Cargo salvo com sucesso!"
	        		)
	        	));
		} catch (Exception $e) {

		    $this->output
        	->set_status_header(200)
        	->set_content_type('application/json', 'utf-8')
        	->set_output(json_encode(
        		array(
        			'sucesso' => false,
        			'msg' => $e->getMessage()
        		)
        	));
        }
	}
	
	public function excluir(){

		try{

			$codigoExclusao = $this->input->post('codigo');

			$this->load->model('CargosModel');

			$excluir = $this->CargosModel->excluir($codigoExclusao, $this->usuario->TENANT_ID);

			$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		array(
	        			'sucesso' => true,
	        			'msg' => "Cargo salvo com sucesso!"
	        		)
	        	));

		} catch (Exception $e) {

		    $this->output
        	->set_status_header(200)
        	->set_content_type('application/json', 'utf-8')
        	->set_output(json_encode(
        		array(
        			'sucesso' => false,
        			'msg' => $e->getMessage()
        		)
        	));
        }
	}

	public function listarTodosCargos(){
		$this->load->model('CargosModel');
		$dados['cargos'] = $this->CargosModel->getAll($this->usuario->TENANT_ID);
		$this->load->view('/gerenciador/cargos/viewModel', $dados);
	}

	public function getAllJson(){
		$this->load->model('CargosModel');
		$dados = $this->CargosModel->getAll($this->usuario->TENANT_ID);

		$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		$dados
	        	));
	}
}
