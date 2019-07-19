<?php
/*classe responsável por listar numero de dados*/
class Contadores extends Conn{

	//para utilizar basta Contadores::setUsuarios();
	public static function setUsuarios(){
		$conn = new Read;
		$conn->ExeRead('usuarios');
		$conn->getRowCount();
		$dado=$conn->getRowCount();
		return $dado;
	}
	//para utilizar basta Contadores::setCategorias();
	public static function setCategorias(){
		$conn = new Read;
		$conn->ExeRead('categorias');
		$conn->getRowCount();
		$dado=$conn->getRowCount();
		return $dado;
	}
	//para utilizar basta Contadores::setCargos();
	public static function setCargos(){
		$conn = new Read;
		$conn->ExeRead('cargos');
		$conn->getRowCount();
		$dado=$conn->getRowCount();
		return $dado;
	}
	//para utilizar basta Contadores::setCentroCusto();
	public static function setCentroCusto(){
		$conn = new Read;
		$conn->ExeRead('cargos');
		$conn->getRowCount();
		$dado=$conn->getRowCount();
		return $dado;
	}

}



?>