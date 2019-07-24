<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RelatoriosModel extends CI_Model {

	public function buscarUsuarioEmailSenha($email, $senha)
	{
		$this->db->where('EMAIL_USUARIO', $email);
		$this->db->where('SENHA_USUARIO', md5($senha));
		$this->db->where('TIP_ATIVO', 1);
    	$usuario = $this->db->get("usuarios")->row();
        return $usuario;
	}

	public function buscarRelatorioHome($tenantId){

		return $this->db->query("SELECT
			SUM(despesas.VLR_DESPESA) as 'TOTAL',
			MONTH(despesas.DTA_DESPESA) as 'MES',
			YEAR(despesas.DTA_DESPESA) as 'ANO'
			from despesas
			WHERE (DTA_DESPESA BETWEEN DATE_ADD(CURDATE(),INTERVAL -1 YEAR) AND CURDATE())
			AND despesas.TENANT_ID = '".$tenantId."'
			GROUP by MONTH(despesas.DTA_DESPESA)")->result();
	}
}
