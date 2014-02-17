<?php
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/Model/ExamPreparation.php';
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/Libs/BaseController.php';
class ExamPrepartationController extends Libs_BaseController
{	
	/**
	 * @var ExamPreparation
	 */
	protected $_exam = null;
	
	public function index()
	{
		parent::index();

		$this->_exam = new ExamPreparation($this->_database);
		if (method_exists($this, $_GET['action'])) {
			call_user_method($_GET['action'], $this);
		}
	}
	
	protected function listAll()
	{
		$factor = 10;
		$offset = ($_GET["page"] * $factor) - $factor;
		$max = ($_GET["page"] * $factor);
		
		$data = $this->_exam->listBy($offset, $max);
		require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/View/listExam.php';
		require_once '/'.$_SERVER['DOCUMENT_ROOT'] . '/backend/View/paging/paging.php';
	}
	
	/**
	 * @return null
	 */
	protected function add()
	{
		if (isset($_POST['action'])
			&& $_POST['action'] == 'send') {
			$this->_exam->addQuestionBy($_POST);
			$this->reDirectTo('/index2.php?action=listAll&page=1');
		}
		require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/View/add.php';
	}
	
	/**
	 * @return null
	 */
	protected function edit()
	{
		$this->_exam->loadDataFormBy((int)$_GET['id']);
		$question = $this->_exam->getQuestion();
		
		$answer1 = $this->_exam->getAnswer1();
		$answer2 = $this->_exam->getAnswer2();
		$answer3 = $this->_exam->getAnswer3();
		$answer4 = $this->_exam->getAnswer4();
			
		$evaluation1 = $this->_exam->getEvaluation1();
		$evaluation2 = $this->_exam->getEvaluation2();
		$evaluation3 = $this->_exam->getEvaluation3();
		$evaluation4 = $this->_exam->getEvaluation4();
			
		$explanation1 = $this->_exam->getExplanation1();
		$explanation2 = $this->_exam->getExplanation2();
		$explanation3 = $this->_exam->getExplanation3();
		$explanation4 = $this->_exam->getExplanation4();
				
		if (isset($_POST['action'])
				&& $_POST['action'] == 'send') {
			$this->_exam->editBy((int)$_GET['id']);
			$this->reDirectTo('/index2.php?action=listAll&page=1');
		} else {
			require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/backend/View/edit.php';
		}	
		
	}
	
	/**
	 * @return null
	 */
	protected function delete()
	{
		$this->_exam->deleteEntryBy($_POST);
		$this->reDirectTo('/index2.php?action=listAll&page=1');
	}
} 
?>
