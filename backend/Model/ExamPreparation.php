<?php
require_once 'Base.php';
class ExamPreparation extends Base
{
	/**
	 * @var int
	 */
	protected $_insertId = 0;
	
	/**
	 * @var string
	 */
	protected $_toDeletedIds = '';
	
	/**
	 * @var array
	 */
	protected $_answerIdArray = array();
	
	/**
	 *
	 * @var string
	 */
	protected $_question = '';
	
	/**
	 * 
	 * @var string
	 */
	protected $_answer1 = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_answer2 = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_answer3 = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_answer4 = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_evaluation1  = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_evaluation2  = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_evaluation3  = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_evaluation4  = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_explanation1 = '';
	
	/**
	 *
	 * @var string
	 */
	protected $_explanation2 = '';
	
	
	/**
	 *
	 * @var string
	 */
	protected $_explanation3 = '';
	
	
	/**
	 *
	 * @var string
	 */
	protected $_explanation4 = '';
	

	/**
	 * 
	 * @param array $post
	 */
	public function addQuestionBy(array $post)
	{
		$pdoStatement = $this->_pdo->prepare(
					'INSERT INTO 
						question (
							question, 
							startDate, 
							author
						) 
					 VALUES(
						:question,
						:startDate,
						:author
					);
		');
		
		$pdoStatement->bindValue(
				':question', 
				$post['question'], 
				PDO::PARAM_STR
		);
		
		$pdoStatement->bindValue(
				':startDate', 
				date('Y-m-d', strtotime($post['startDate'])), 
				PDO::PARAM_STR
		);
		
		$pdoStatement->bindValue(
				':author', 
				$_SESSION['user'], 
				PDO::PARAM_STR
		);
		
		$pdoStatement->execute();
		
		$this->_insertId = $this->_pdo->lastInsertId();
		$this->addAnswerBy($post);
	}

	/**
	 * 
	 * @param array $post
	 */
	protected function addAnswerBy(array $post)
	{
		for ($counter = 0; $counter < count($post['explanation']); $counter++) {
			$post['answer' . $counter + 1] = $this->replaceDoubleQuoteFrom($post['answer' . $counter + 1]);
            $pdoStatement = $this->_pdo->prepare('
                INSERT INTO answers (
                    examid,
                    answer,
                    evaluation,
                    explanation
				) VALUES (
                    :insertId,
                    :answer,
                    :rightAnswer,
                    :explanation
                );

			');
            $pdoStatement->bindValue(':insertId', $this->_insertId, PDO::PARAM_INT);
            $pdoStatement->bindValue(':answer', $post['answer'.($counter + 1)], PDO::PARAM_STR);
            $pdoStatement->bindValue(':rightAnswer', $post['rightAnswer'.($counter + 1)], PDO::PARAM_INT);
            $pdoStatement->bindValue(':explanation', $post['explanation'][$counter], PDO::PARAM_STR);
		}
	}

    /**
     * @param $postValue
     * @return mixed
     */
    protected function replaceDoubleQuoteFrom($postValue)
	{
		$postValue = str_replace('"', '&rdquo;', $postValue);
		
		return $postValue;
	}
	
	/**
	 * 
	 * @param int $id
	 * @throws InvalidArgumentException
	 * @return array
	 */
	public function fetchBy($id)
	{
		if (!is_int($id)) {
			throw new InvalidArgumentException();
		}
		
		$pdoStatement = $this->_pdo->prepare('
				SELECT 
					* 
				FROM 
					question 
				WHERE id = :id'
		);
		
		$pdoStatement->bindValue(':id', $id);
		$pdoStatement->execute();
		
		return $pdoStatement->fetchAll();
	}
	
	/**
	 * 
	 * @param array $post
	 */
	public function deleteEntryBy(array $post)
	{
		$this->_toDeletedIds = implode(",", $post['selection']);
		$this->deleteQuestionsBy($post);
		$this->deleteAnswersBy($post);
	}
	
	/**
	 * 
	 * @param array $post
	 */
	protected function deleteQuestionsBy(array $post)
	{
		$pdoStatement = $this->_pdo->prepare("
				DELETE FROM 
					question 
				WHERE id IN(:ids)"
		);
		
		$pdoStatement->bindValue(':ids', $this->_toDeletedIds);
		$pdoStatement->execute();
		
	}
	
	/**
	 *
	 * @param array $post
	 */
	protected function deleteAnswersBy(array $post)
	{
		$pdoStatement = $this->_pdo->prepare("
				DELETE FROM 
					answers 
				WHERE examid IN(:ids)"
		);
		
		$pdoStatement->bindValue(':ids', $this->_toDeletedIds);
		
		$pdoStatement->execute();
	}
	
	public function listBy($offset, $max)
	{
		if (!is_int($offset)
			|| !is_int($max)) {
			throw new InvalidArgumentException();
		}
		
		$pdoStatement = $this->_pdo->prepare('
			SELECT 
				id,
			 	topic, 	
				question, 	
				startDate, 	
				author 
			FROM 
				question 
			ORDER BY 
				startDate DESC 
			LIMIT 
				:offset,:max;');
		$pdoStatement->bindValue(':offset', $offset, PDO::PARAM_INT);
		$pdoStatement->bindValue(':max', $max, PDO::PARAM_INT);
		$pdoStatement->execute();
		
		return $pdoStatement->fetchAll();
	}
	
	/**
	 * 
	 * @param int $id
	 * @throws InvalidArgumentException
	 * @return null
	 */
	public function loadDataFormBy($id)
	{
		if (!is_int($id)) {
			throw new InvalidArgumentException();	
		}
		
		$pdoStatement = $this->_pdo->prepare('SELECT * FROM question WHERE id = :id');
		$pdoStatement->bindValue(':id', $_GET['id']);
		$pdoStatement->execute();
		$this->_question = $pdoStatement->fetch();
		
		
		$pdoStatement = $this->_pdo->prepare('SELECT * FROM answers WHERE examid = :id ORDER BY id');
		$pdoStatement->bindValue(':id', $_GET['id']);
		$pdoStatement->execute();
		$answers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
		$returnValue = array();
		for ($counter = 0; $counter < count($_POST['explanation']); $counter++) {
			$this->_answerIdArray[] = $answers[$counter]['id'];
		} 
		
		$this->_answer1 = $answers[0]['answer'];
		$this->_explanation1 = $answers[0]['explanation'];
		$this->_evaluation1 = $answers[0]['evaluation'];
		
		$this->_answer2 = $answers[1]['answer'];
		$this->_explanation2 = $answers[1]['explanation'];
		$this->_evaluation2 = $answers[1]['evaluation'];
		
		$this->_answer3 = $answers[2]['answer'];
		$this->_explanation3 = $answers[2]['explanation'];
		$this->_evaluation3 = $answers[2]['evaluation'];
		
		$this->_answer4 = $answers[3]['answer'];
		$this->_explanation4 = $answers[3]['explanation'];
		$this->_evaluation4 = $answers[3]['evaluation'];
	}
	
	/**
	 * 
	 * @param int $id
	 * @throws InvalidArgumentException
	 */
	public function editBy($id)
	{
		if (!is_int($id)) {
			throw new InvalidArgumentException();
		}
		$pdoStatement = $this->_pdo->prepare('UPDATE question SET question = :question, startDate = :startDate, author = :author WHERE id = '.$_GET['id']);
		$pdoStatement->bindValue(':question', $_POST['question'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':startDate', date('Y-m-d', strtotime($_POST['startDate'])), PDO::PARAM_STR);
		$pdoStatement->bindValue(':author', $_SESSION['user'], PDO::PARAM_STR);
		$pdoStatement->execute();
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer1, evaluation = :evaluation1, explanation = :explanation1 WHERE id = ' . (int)$this->_answerIdArray[0]);
		$pdoStatement->bindValue(':answer1', $_POST['answer1'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation1', $_POST['rightAnswer1'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation1', htmlentities($_POST['explanation'][0]), PDO::PARAM_STR);
		$pdoStatement->execute();
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer2, evaluation = :evaluation2, explanation = :explanation2 WHERE id = ' . (int)$this->_answerIdArray[1]);
		$pdoStatement->bindValue(':answer2', $_POST['answer2'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation2', $_POST['rightAnswer2'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation2', htmlentities($_POST['explanation'][1]), PDO::PARAM_STR);
		$pdoStatement->execute();

		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer3, evaluation = :evaluation3, explanation = :explanation3 WHERE id = ' . (int)$this->_answerIdArray[2]);
		$pdoStatement->bindValue(':answer3', $_POST['answer3'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation3', $_POST['rightAnswer3'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation3', htmlentities($_POST['explanation'][2]), PDO::PARAM_STR);
		$pdoStatement->execute();
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer4, evaluation = :evaluation4, explanation = :explanation4 WHERE id = ' . (int)$this->_answerIdArray[3]);
		$pdoStatement->bindValue(':answer4', $_POST['answer4'], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation4', $_POST['rightAnswer4'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation4', htmlentities($_POST['explanation'][3]), PDO::PARAM_STR);
		$pdoStatement->execute();
	}
	
	public function getQuestion()
	{
		return $this->_question;
	}
	
	/**
	 * @return string
	 */
	public function getAnswer1()
	{
		return $this->_answer1;
	}
	
	/**
	 * @return string
	 */
	public function getAnswer2()
	{
		return $this->_answer2;
	}
	
	/**
	 * @return string
	 */
	public function getAnswer3()
	{
		return $this->_answer3;
	}
	
	/**
	 * @return string
	 */
	public function getAnswer4()
	{
		return $this->_answer4;
	}
	
	/**
	 * @return string
	 */
	public function getEvaluation1()
	{
		return $this->_evaluation1;
	}
	
	/**
	 * @return string
	 */
	public function getEvaluation2()
	{
		return $this->_evaluation2;
	}
	
	/**
	 * @return string
	 */
	public function getEvaluation3()
	{
		return $this->_evaluation3;
	}
	
	/**
	 * @return string
	 */
	public function getEvaluation4()
	{
		return $this->_evaluation4;
	}
	
	/**
	 * @return string
	 */
	public function getExplanation1()
	{
		return $this->_explanation1;
	}
	
	/**
	 * @return string
	 */
	public function getExplanation2()
	{
		return $this->_explanation2;
	}
	
	/**
	 * @return string
	 */
	public function getExplanation3()
	{
		return $this->_explanation3;
	}
	
	/**
	 * @return string
	 */
	public function getExplanation4()
	{
		return $this->_explanation4;
	}
}
?>