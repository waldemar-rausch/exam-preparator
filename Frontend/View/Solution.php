<?php
/**
 * Short description
 *
 * Long description
 * Proprietary software created by hygi.de is closed source code. No licence is offered.
 *
 * @category
 * @package
 * @subpackage
 * @copyright Copyright (c) 2004-2012 Hygi.de GmbH & Co. KG, Telgte, Germany
 * @author wrausch
 * @created 25.02.14 13:16
 */
foreach ($answerRows as $answerRow) {
    echo htmlentities('Für die Frage: ').nl2br($answerRow['question']). ' <br />';
    echo 'lautet die richtige Antwort: '.$answerRow['answer']. ' <br />' ;
    echo htmlentities('Erläuterung: ').$answerRow['explanation']. ' <br /><hr>';
}
?>
<form action="/logout.php" method="post">
	<input type="submit" name="logout" value="logout" />
</form>
