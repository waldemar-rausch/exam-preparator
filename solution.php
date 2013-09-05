<?php 
require_once 'session.php';
require_once 'db.php';

if (isset($_POST['send']) ) {
	$answerResult = mysql_query("
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
				startDate = '".date("Y-m-d") . "'
			AND 
				question.id = answers.examid 
			AND 
				answers.evaluation = 1"
	);
	while ($answerRow = mysql_fetch_assoc($answerResult)) {
		echo htmlentities('Für die Frage: ').nl2br($answerRow['question']). ' <br />';
		echo 'lautet die richtige Antwort: '.$answerRow['answer']. ' <br />' ;
		echo htmlentities('Erläuterung: ').$answerRow['explanation']. ' <br /><hr>';
	}
	
	echo '<b>Bespreche bitte die Fragen mit deinen Kollegen.</b>';
}

?>
<form action="/logout.php" method="post">
	<input type="submit" name="logout" value="logout" />
</form>