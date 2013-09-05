<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<link href="../style.css" type="text/css" rel="stylesheet">
		<script src="../ckeditor.js"></script> 
	</head>
	<div class="header"> 
		<img style="width: 88px;" alt="" src="../exam.jpg">
		<span style="position: absolute; top: 10px; left: 111px; font-size: 31px; font-weight: 700;">
			Exam preparation Manager
		</span> 
		<div class="logedUser shadow">
			Sie sind angemeldet als: <?php echo $_SESSION['user'];?>
		</div>
	</div>
	<div class="menu">
		<form method="post" name="logout" action="../logout.php">
			<input title="logout" class="cmsIcon" src="../logout.png" name="logout" style="width:32px;float:left;margin-left:1px" type="image">
		</form>
		<form method="post" name="add" action="add.php">
			<button title="speichern" onClick="document.newEntry.submit()" class="cmsIcon" type="button" style="border: 0; background: transparent">
			    <img src="../icons/save_32.png" alt="save" />
			</button>
		</form>
	</div>
	<div class="content">
		<form name="newEntry" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
			<label for="question">Frage:</label><br/>
			<textarea class="ckeditor" cols="80" id="question" name="question" rows="10">
			<?php echo $question['question'];?>
			</textarea>
			<br /><br />
			<b>Antwortmöglichkeiten</b>
			<br /><br />
			Antwort 1
			<input type="text" name="answer1" id="1" value="<?php echo $answer1; ?>"/>
			<br />
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer1" value="1" <?php if($evaluation1 == 1) {echo 'checked="checked"'; }?> />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation1; ?></textarea>
			<hr/>
			<br/>
			Antwort 2
			<input type="text" name="answer2" id="2" value="<?php echo $answer2; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer2" value="1" <?php if($evaluation2 == 1) {echo 'checked="checked"'; }?> />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation2; ?></textarea>
			<hr/>
			<br/>
			Antwort 3
			<input type="text" name="answer3" id="3" value="<?php echo $answer3; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer3" value="1" <?php if($evaluation3 == 1) {echo 'checked="checked"'; }?>/>
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation3; ?></textarea>
			<hr/>
			<br/>
			Antwort 4
			<input type="text" name="answer4" id="4" value="<?php echo $answer4; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer4" value="1" <?php if($evaluation4 == 1) {echo 'checked="checked"'; }?>/>
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation4; ?></textarea>
			<hr/>
			<br/>
			<br>
			Start Datum:
			<input type="text" value="<?php echo date('d.m.Y',strtotime($question['startDate']));?>" name="startDate" maxlength="10">
			<input type="hidden" name="action" value="send"/>
		</form>
	</div>
</html>	