<?php 
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Libs/BaseController.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Model/Exampreparation.php';
class Frontend_Controller_ExamPrepartation extends Libs_BaseController
{
	/**
	 * @var Frontend_Model_Exampreparation
	 */
	protected $_exam = null;
	
	public function index()
	{
		parent::index();

		$this->_exam = new Frontend_Model_Exampreparation($this->_database);
		
		if (!$this->accessAllowed()) {
		    throw new Exception('Benutzername oder Password ist falsch.');
		}
		
		if (method_exists($this, $_GET['action'])) {
			call_user_method($_GET['action'], $this);
		}
	}
	
	/**
	 * 
	 */
	protected function accessAllowed()
	{
		$userCollection = $this->_exam->fetchAllUser();
		foreach($userCollection as $row) {
			if ($_POST['nickName'] == $row['nickName']
				&& $_POST['password'] == $row['password'] )
			{
				$error = '';
				if(!isset($_SESSION['user'])){
					$_SESSION['user'] = $row['nickName'];
					$_SESSION['password'] = $row['password'];
				}
				if ($row['isAdmin']) {
					header("Location: /exam.php");
					$_SESSION['isAdmin'] = true;
				}
				return true;
			}
		}
		
		return false;
	}
	
	protected function exam()
	{
		//Put the exam here
	}
}
?>
