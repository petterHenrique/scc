<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";

class Despesas extends MasterLogado {

	public function __construct()
    {
        parent::__construct();
        $this->verificaAcessoDespesas();
    }

	public function index()
	{
		$this->load->model('DespesasModel');
		$dados['despesas'] = $this->DespesasModel
			->getAll($this->usuario->TENANT_ID,
					 $this->usuario->COD_USUARIO);
		$this->load->view('/gerenciador/despesas/index', $dados);
	}

	public function salvar(){
		try{

			$codigo = $this->input->post('codigodespesa');
			$desdespesa = $this->input->post('desdespesa');
			$valordespesa = $this->input->post('valordespesa');
			$categoriadespesa =  $this->input->post('categoriadespesa');
			$datadespesa =  $this->input->post('datadespesa');

			if(isset($_FILES['arquivo'])){

				$codigoUsuario = $this->usuario->COD_USUARIO;

				$urlAnexo = $_SERVER['DOCUMENT_ROOT']."/scc/uploads/".$codigoUsuario."".$_FILES['arquivo']['name'];

				//verifico se existe a pasta senão cria
				if (!is_dir($_SERVER['DOCUMENT_ROOT']."/scc/uploads/")) {
				    mkdir($_SERVER['DOCUMENT_ROOT']."/scc/uploads/");       
				}

				//verifico se não existe o arquivo
				if(!file_exists($urlAnexo)){
					if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $urlAnexo)){
					}else{
						throw new Exception("Falha ao realizar upload do arquivo", 1);
					}
				}

				$entidade = array(
					'COD_DESPESA' => $codigo,
					'DES_DESPESA' => $desdespesa,
					'VLR_DESPESA' => $valordespesa,
					'COD_CATEGORIA' => $categoriadespesa,
					'DTA_DESPESA' => date("Y-m-d", strtotime($datadespesa)),
					'COD_USUARIO' => $this->usuario->COD_USUARIO,
					'COD_CENTROCUSTO' => $this->usuario->COD_CENTROCUSTO,
					'ANEXO_DESPESA' => $codigoUsuario."".$_FILES['arquivo']['name'],
					'TENANT_ID' => $this->usuario->TENANT_ID
				);

				$this->load->model('DespesasModel');

				$salvar = $this->DespesasModel->salvar($entidade);
			
				$this->output
		        	->set_status_header(200)
		        	->set_content_type('application/json', 'utf-8')
		        	->set_output(json_encode(
		        		array(
		        			'sucesso' => true,
		        			'msg' => "Despesa salva com sucesso!"
		        		)
		        	));
			}else{
				throw new Exception("Arquivo não enviado!", 1);
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
}
