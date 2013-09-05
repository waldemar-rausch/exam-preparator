<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="content-type">
		<link href="../style.css" type="text/css" rel="stylesheet">
		<script src="../ckeditor.js"></script>
		<link rel="stylesheet" href="sample.css">
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
		<form method="post" name="add" action="/index2.php?action=add&page=1">
			<button title="speichern" onClick="document.newEntry.submit()" class="cmsIcon" type="button" style="border: 0; background: transparent">
			    <img src="../icons/save_32.png" alt="save" />
			</button>
		</form>
	</div>
	<div class="content">
		<form name="newEntry" method="post" action="#">
			<label for="question">Frage:</label><br/>
			<textarea class="ckeditor" cols="80" id="question" name="question" rows="10"></textarea>
			<br /><br />
			<b>Antwortmöglichkeiten</b>
			<br /><br />
			Antwort 1:
			<input type="text" name="answer1" id="1" value=""/>
			<br/>
			
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer1" value="1" />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="" style="width:100%" name="explanation[]" rows="10"></textarea>
			<hr/>
			<br/>
			Antwort 2:
			<input type="text" name="answer2" id="2" value=""/>
			<br/>
			
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer2" value="1" />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="" style="width:100%" name="explanation[]" rows="10"></textarea>
			<hr/>
			<br/>
			Antwort 3:
			<input type="text" name="answer3" id="3" value=""/>
			<br/>
			
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer3" value="1" />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="" style="width:100%" name="explanation[]" rows="10"></textarea>
			<hr/>
			<br/>
			Antwort 4:
			<input type="text" name="answer4" id="4" value=""/>
			<br/>
			
			Antwort ist richtig:
			<input type="checkbox" name="rightAnswer4" value="1" />
			<br/>
			<label for="explanation">Erläuterung:</label>
			<br/>
			<textarea class="" style="width:100%" name="explanation[]" rows="10"></textarea>
			<br/>
			<br>
			Start Datum:
			<input type="text" value="" name="startDate" maxlength="10">
			<input type="hidden" name="action" value="send"/>
		</form>
	</div>
</html>