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
	/**
     * @return string
     */
    public function fetchTopic()
    {
        $pdoStatement = $this->_pdo->prepare("
            SELECT
                topic
            FROM
                question
            WHERE
                startDate = :date
		");
        $pdoStatement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $pdoStatement->execute();
        $topic = $pdoStatement->fetchColumn(0);
        return $topic;
    }

    /**
     * @return array
     */
    public function fetchQuestions()
    {
        $pdoStatement = $this->_pdo->prepare("
		    SELECT
			    id,
			    question,
			    startDate
		    FROM
			    question
		    WHERE
			    startDate = :date
       ");
        $pdoStatement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $pdoStatement->execute();
        $questions = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $questions;
    }

    /**
     * @return array
     */
    public function fetchAnswers()
    {
        $pdoStatement = $this->_pdo->prepare("
            SELECT
                question.id,
                question.question,
                question.startDate,
                answers.examid,
                answers.id,
                answers.answer,
                answers.evaluation,
                answers.explanation
            FROM
                question,
                answers
            WHERE
                startDate = :date
            AND
                question.id = answers.examid"
        );
        $pdoStatement->bindValue(':date', date("Y-m-d"), PDO::PARAM_STR);
        $pdoStatement->execute();
        $answers = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $answers;
    }
}
?>
