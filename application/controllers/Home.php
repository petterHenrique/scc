<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(!empty($_SESSION['usuarioLogado'])){
			redirect('/gerenciador/Dashboard');
		}else{
			$this->load->view('gerenciador/index');
		}
	}

	public function auth(){

		header('Access-Control-Allow-Origin: *');  
		
		try {
		    
			$email = $this->input->post('email');
			$senha = $this->input->post('senha');

			if(empty($email) || empty($senha)){
				throw new Exception("Preencha os campos E-mail ou Senha!", 1);
			}

			$this->load->model("Login");

			$usuario = $this->Login->buscarUsuarioEmailSenha($email, $senha);


			if(is_null($usuario)){
				throw new Exception("E-mail ou senha inválidos", 1);
			}

			$dadosAcesso['usuarioLogado'] = $usuario;

			$_SESSION = $dadosAcesso;

		    $this->output
        	->set_status_header(200)
        	->set_content_type('application/json', 'utf-8')
        	->set_output(json_encode(
        		array(
        			'sucesso' => true,
        			'msg' => "Usuário logado com sucesso!"
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

		} finally {
		     
		}

	}
}
