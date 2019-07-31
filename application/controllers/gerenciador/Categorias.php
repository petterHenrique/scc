<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Categorias extends MasterLogado {

	public function __construct()
    {
        parent::__construct();
        $this->verificaAdministrador();
    }

	public function index()
	{
		$this->load->model('CategoriasModel');
		$dados['categorias'] = $this->CategoriasModel->getAll($this->usuario->TENANT_ID);
		$this->load->view('/gerenciador/categorias/index', $dados);
	}

	public function buscarCategoriaId(){
		try{

			$codigocategoria = $this->input->post('codigocategoria');

			$this->load->model('CategoriasModel');

			$categoria = $this->CategoriasModel->buscarCategoriaId($codigocategoria);

			if(empty($categoria)){
				throw new Exception("Categoria não encontrada", 1);
			}else{
				   $this->output
		        	->set_status_header(200)
		        	->set_content_type('application/json', 'utf-8')
		        	->set_output(json_encode(
		        		array(
		        			'sucesso' => true,
		        			'dados' => $categoria
		        		)
		        	));
			}

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

	public function salvar(){
		try{

			$codigo = $this->input->post('codigocategoria');
			$descategoria = $this->input->post('descategoria');
			$contacontabil = $this->input->post('contacontabil');
			$limitegasto =  $this->input->post('limitegasto');

			$entidade = array(
				'COD_CATEGORIA' => $codigo,
				'DES_CATEGORIA' => $descategoria,
				'CONTA_CONTABIL' => $contacontabil,
				'LIMITE_GASTO' => number_format((float)$limitegasto, 2, ',', ''),
				'TENANT_ID' => $this->usuario->TENANT_ID
			);

			$this->load->model('CategoriasModel');

			$salvar = $this->CategoriasModel->salvar($entidade);

			
			$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		array(
	        			'sucesso' => true,
	        			'msg' => "Categoria salva com sucesso!"
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

			$this->load->model('CategoriasModel');

			$excluir = $this->CategoriasModel->excluir($codigoExclusao, $this->usuario->TENANT_ID);

			$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		array(
	        			'sucesso' => true,
	        			'msg' => "Categoria excluida com sucesso!"
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

	public function listarTodasCategorias(){
		$this->load->model('CategoriasModel');
		$dados['categorias'] = $this->CategoriasModel->getAll($this->usuario->TENANT_ID);
		$this->load->view('/gerenciador/categorias/viewModel', $dados);
	}

	public function getAllJson(){
		$this->load->model('CategoriasModel');
		$dados = $this->CategoriasModel->getAll($this->usuario->TENANT_ID);

		$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		$dados
	        	));
	}
}
