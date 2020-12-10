<?php
require_once('dbconnect.php');
class CRUD extends DB{ //CRUD処理まとめ用クラス

	public function SelectAllEmp(){		//一覧取得関数
		$sql = "select * from employee";
		$res = parent::executeSQL($sql,null);
		$empdata = $res->fetchAll(PDO::FETCH_ASSOC);
		return $empdata;
	}
	
	public function InsertEmp(){

	}

	public function UpdateEmp(){

	}

	public function DeleteEmp(){

	}

}

?>
