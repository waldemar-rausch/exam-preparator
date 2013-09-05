<?php 
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/Model/Base.php';
class Frontend_Model_Exampreparation extends Base
{
	public function fetchAllUser()
	{

		$pdoStatement = $this->_pdo->query('
				SELECT
				id,
				nickName,
				password,
				isAdmin
				FROM user'
		);
		
		return $pdoStatement->fetchAll();
	}	
}
?>