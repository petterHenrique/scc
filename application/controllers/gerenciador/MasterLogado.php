<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MasterLogado extends CI_Controller {

	protected $usuario;

	public function __construct()
    {
        parent::__construct();
        $this->verificaAcesso();
        $this->setarUsuario();
    }

    private function verificaAcesso(){

    	$bool = empty($_SESSION['usuarioLogado']) ? false : true;

    	if(!$bool){
    		session_destroy();
			header("Location: ".base_url()."index.php/Home");
    	}
    }

    private function setarUsuario(){
    	$this->usuario = $_SESSION['usuarioLogado'];
    }

    public function verificaAdministrador(){

    	$usuario = $_SESSION['usuarioLogado'];

    	if(empty($usuario)){
    		header("Location: ".base_url()."index.php/gerenciador/Dashboard");
    	}else if($usuario->NIVEL_USUARIO == EnumAdminstrador::usuario){
    		header("Location: ".base_url()."index.php/gerenciador/Dashboard");
    	}

    }

    public function verificaAcessoDespesas(){
    	$usuario = $_SESSION['usuarioLogado'];
    	if(empty($usuario)){
    		header("Location: ".base_url()."index.php/gerenciador/Dashboard");
    	}else if(!$usuario->NIVEL_USUARIO == EnumAdminstrador::usuario
    		|| !$usuario->NIVEL_USUARIO == EnumAdminstrador::administrador){
    		header("Location: ".base_url()."index.php/gerenciador/Dashboard");
    	}
    }
}

abstract class EnumAdminstrador{

	public const administrador = 1;
	public const usuario = 2;


}
