<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Usuarios extends MasterLogado {

	public function __construct()
    {
        parent::__construct();
        $this->verificaAdministrador();
    }

	public function index()
	{
		$this->load->model('UsuariosModel');
		$dados['usuarios'] = $this->UsuariosModel->getAll(false, $this->usuario->TENANT_ID);
		$this->load->view('/gerenciador/usuarios/index', $dados);
	}

	public function salvar(){
		try{

			$codigo = $this->input->post('codigousuario');
			$desusuario = $this->input->post('desusuario');
			$emailusuario = $this->input->post('emailusuario');
			$senhausuario = $this->input->post('senhausuario');
			$nivelusuario =  $this->input->post('nivelusuario');
			$codigocargo = $this->input->post('codigocargo');
			$codigocentrocusto = $this->input->post('codigocentrocusto');
			$tipativo = $this->input->post('tipativo');

			$this->load->model("Login");

			$entidade = array(
				'COD_USUARIO' => $codigo,
				'DES_USUARIO' => $desusuario,
				'EMAIL_USUARIO' => $emailusuario,
				'SENHA_USUARIO' => $this->Login->criptografarsenha($senhausuario),
				'NIVEL_USUARIO' => $nivelusuario,
				'COD_CARGO' => $codigocargo,
				'COD_CENTROCUSTO' => $codigocentrocusto,
				'COD_USUARIO_PAI' => $this->usuario->COD_USUARIO_PAI,
				'TIP_ATIVO' => (boolean)$tipativo,
				'TENANT_ID' => $this->usuario->TENANT_ID,
				'TIP_MASTER' => 0
			);

			$this->load->model('UsuariosModel');

			$salvar = $this->UsuariosModel->salvar($entidade);

			
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

	public function listarTodosUsuarios(){
		$this->load->model('UsuariosModel');
		$dados['usuarios'] = $this->UsuariosModel->getAll(false,$this->usuario->TENANT_ID);
		$this->load->view('/gerenciador/usuarios/viewModel', $dados);
	}

	public function getAllJson(){
		$this->load->model('UsuariosModel');
		$dados = $this->UsuariosModel->getAll(false, $this->usuario->TENANT_ID);
		$this->output
	        	->set_status_header(200)
	        	->set_content_type('application/json', 'utf-8')
	        	->set_output(json_encode(
	        		$dados
	        	));
	}
}
