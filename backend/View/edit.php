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
        &nbsp;&nbsp;&nbsp;<a class="historyBack" href="javascript:history.back()">zurück</a>
		<form method="post" name="add" action="add.php">
			<button style="background: none repeat scroll 0 center rgba(0, 0, 0, 0); border: 0 none;margin-top:-13px;" title="speichern" onClick="document.newEntry.submit()" class="cmsIcon" type="button" style="border: 0; background: transparent">
			    <img src="../icons/save_32.png" alt="save" />
			</button>
		</form>
	</div>
	<div class="content">
		<form name="newEntry" method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
            <label for="topic">Thema</label><br/>
            <input id="topic" name="topic" value="<?php echo $question['topic'];?>" type="text"/><br/><br/>
            <label for="question">Frage:</label><br/>
			<textarea class="ckeditor" cols="80" id="question" name="question" rows="10">
			<?php echo $question['question'];?>
			</textarea>
			<br /><br />
			<b>Antwortmöglichkeiten</b>
			<br /><br />
			Antwort 1
			<input type="text" name="answer[]" value="<?php echo $answer1; ?>"/>
			<br />
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer0" value="1" <?php if($evaluation1 == 1) {echo 'checked="checked"'; }?> />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation1; ?></textarea>
			<hr/>
			<br/>
			Antwort 2
			<input type="text" name="answer[]" value="<?php echo $answer2; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer1" value="1" <?php if($evaluation2 == 1) {echo 'checked="checked"'; }?> />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation2; ?></textarea>
			<hr/>
			<br/>
			Antwort 3
			<input type="text" name="answer[]" value="<?php echo $answer3; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer2" value="1" <?php if($evaluation3 == 1) {echo 'checked="checked"'; }?>/>
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation3; ?></textarea>
			<hr/>
			<br/>
			Antwort 4
			<input type="text" name="answer[]" value="<?php echo $answer4; ?>"/>
			<br/>
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer3" value="1" <?php if($evaluation4 == 1) {echo 'checked="checked"'; }?>/>
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="padding10" style="width:100%" name="explanation[]" rows="10"><?php echo $explanation4; ?></textarea>
			<hr/>
			<br/>
			<br>
            <div>Start Datum:</div>
            <input style="float:left;" type="text" value="<?php echo date('d.m.Y',strtotime($question['startDate']));?>" name="startDate" maxlength="10">
            &nbsp;&nbsp;
            <button style="margin-top:-5px;float:left;border: 0; background: transparent" type="button" class="cmsIcon" onclick="document.newEntry.submit()" title="speichern">
                <img alt="save" src="../icons/save_32.png">
            </button>
			<input type="hidden" name="action" value="send"/>
		</form>
	</div>
</html>	