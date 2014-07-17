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
	protected $_toDeletedIds = array();
	
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
		for ($counter = 0; $counter < 4; $counter++) {
			$post['answer'][$counter] = $this->replaceDoubleQuoteFrom($post['answer'][$counter]);
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
            if(!isset($post['rightAnswer' . $counter])) {
                $post['rightAnswer' . $counter] = 0;
            }
            $pdoStatement->bindValue(':insertId', $this->_insertId, PDO::PARAM_INT);
            $pdoStatement->bindValue(':answer', $post['answer'][$counter], PDO::PARAM_STR);
            $pdoStatement->bindValue(':rightAnswer', $post['rightAnswer' . $counter], PDO::PARAM_INT);
            $pdoStatement->bindValue(':explanation', $post['explanation'][$counter], PDO::PARAM_STR);
            $pdoStatement->execute();
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
        for($counter=0; $counter< 5; $counter++){
            if(isset($post['selection'][$counter])){
                $this->_toDeletedIds[] = $post['selection'][$counter];
            }
        }
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
				WHERE FIND_IN_SET(id, :ids)"
		);
        $ids = implode(',', $this->_toDeletedIds);
		$pdoStatement->bindValue(':ids', $ids);
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
				WHERE FIND_IN_SET(examid, :ids)"
		);
		$ids = implode(',', $this->_toDeletedIds);
		$pdoStatement->bindValue(':ids', $ids);
		
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
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer0, evaluation = :evaluation0, explanation = :explanation0 WHERE id = ' . (int)$this->_answerIdArray[0]);
		$pdoStatement->bindValue(':answer0', $_POST['answer'][0], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation0', (int)$_POST['rightAnswer0'][0], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation0', htmlentities($_POST['explanation'][0]), PDO::PARAM_STR);
		$pdoStatement->execute();
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer1, evaluation = :evaluation1, explanation = :explanation1 WHERE id = ' . (int)$this->_answerIdArray[1]);
		$pdoStatement->bindValue(':answer1', $_POST['answer'][1], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation1', (int)$_POST['rightAnswer1'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation1', htmlentities($_POST['explanation'][1]), PDO::PARAM_STR);
		$pdoStatement->execute();

		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer2, evaluation = :evaluation2, explanation = :explanation2 WHERE id = ' . (int)$this->_answerIdArray[2]);
		$pdoStatement->bindValue(':answer2', $_POST['answer'][2], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation2', (int)$_POST['rightAnswer2'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation2', htmlentities($_POST['explanation'][2]), PDO::PARAM_STR);
		$pdoStatement->execute();
		
		$pdoStatement = $this->_pdo->prepare('UPDATE answers SET answer = :answer3, evaluation = :evaluation3, explanation = :explanation3 WHERE id = ' . (int)$this->_answerIdArray[3]);
		$pdoStatement->bindValue(':answer3', $_POST['answer'][3], PDO::PARAM_STR);
		$pdoStatement->bindValue(':evaluation3', (int)$_POST['rightAnswer3'], PDO::PARAM_INT);
		$pdoStatement->bindValue(':explanation3', htmlentities($_POST['explanation'][3]), PDO::PARAM_STR);
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