<?php 
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Libs/BaseController.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/Model/Exampreparation.php';
class Frontend_Controller_ExamPreparation extends Libs_BaseController
{
	/**
	 * @var Frontend_Model_Exampreparation
	 */
	protected $_exam = null;
	
	public function check()
    	{
        	parent::index();
        	$this->_exam = new Frontend_Model_Exampreparation($this->_database);
        	if (!$this->accessAllowed()) {
            		throw new Exception('Benutzername oder Password ist falsch.');
	 	}
	 
        	$this->exam();
    	}
	
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
	 * @return bool
	 */
	protected function accessAllowed()
	{
		$userCollection = $this->_exam->fetchAllUser();
		foreach($userCollection as $row) {
			if ($_POST['nickName'] == $row['nickName']
				&& $_POST['password'] == $row['password'] )
			{
				if(!isset($_SESSION['user'])){
					$_SESSION['user'] = $row['nickName'];
					$_SESSION['password'] = $row['password'];
				}
				if ($row['isAdmin']) {
					$_SESSION['isAdmin'] = true;
					$this->exam();
				}
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * @return null 
	 */
	protected function exam()
	{
		$topic = $this->_exam->fetchTopic();
        	$questionRows = $this->_exam->fetchQuestions();
	 	$answerRows = $this->_exam->fetchAnswers();
        	require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/View/Exampreparation.php';
	}
	
	protected function solution()
    	{
        	$answerRows = $this->_exam->getSolution();
        	require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Frontend/View/Solution.php';
    	}
}
?>
