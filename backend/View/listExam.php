<?php
function cutString($str, $n_chars, $crop_str = '...') {
    $buff = strip_tags($str);
    if (mb_strlen($buff) > $n_chars) {
        $cut_index = mb_strpos($buff, ' ', $n_chars);
        $buff = mb_substr($buff, 0, ($cut_index === false ? $n_chars : $cut_index + 1), "UTF-8") . $crop_str;
    }
    return $buff;
}
?>

<html>
<head>
    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/backend/View/paging/css/style.css" media="screen"/>
</head>
<div class="header">
    <img style="width: 88px;" alt="" src="../../exam.jpg">
		<span style="position: absolute; top: 10px; left: 111px; font-size: 31px; font-weight: 700;">
			Exam preparation Manager
		</span>

    <div class="logedUser shadow">
        Sie sind angemeldet als: <?php echo $_SESSION['user']; ?>
    </div>
</div>
<div class="menu">
    <form method="post" name="logout" action="logout.php">
        <input title="logout" class="cmsIcon" src="../../logout.png" name="logout"
               style="width:32px;float:left;margin-left:1px" type="image">
    </form>
    <input onClick="document.listExamQuestion.submit()" title="l&ouml;schen" class="cmsIcon"
           src="../../icons/delete_32.png" name="delete" type="image">

    <form method="post" name="add"
          action="http://<?php echo $_SERVER['SERVER_NAME']; ?>/index2.php?action=add&amp;page=1">
        <input title="hinzuf&uuml;gen" class="cmsIcon" src="../../icons/plus_32.png" name="add" type="image">
    </form>
</div>
<div class="content">
    <form name="listExamQuestion" method="post" action="/index2.php?action=delete&page=1">
        <table style="width:100%;">
            <tr>
                <th>#ID</th>
                <th>Titel/Frage</th>
                <th>Freischaltdatum</th>
                <th>Autor</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            foreach ($data as $row) {
                ?>
                <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php
                    if(!empty($row['topic'])) {
                        echo $row['topic'];
                    } else {
                        $row['question'] = cutString($row['question'], 120);
                        echo $row['question'];
                    }
                    ?>
                </td>
                <td>
                    <?php echo date('d.m.Y', strtotime($row['startDate'])); ?>
                </td>
                <td>
                    <?php echo $row['author']; ?>
                </td>
                <td>
                    <input type="checkbox" name="selection[]" value="<?php echo $row['id']; ?>"/>
                </td>
                <td>
                    <button onclick="location.href = '/index2.php?action=edit&id=<?php echo $row['id']; ?>';"
                            class="cmsIcon" style="border: 0; background: transparent" type="button" title="bearbeiten">
                        <img alt="edit" src="../../icons/pencil_32.png">
                    </button>
                </td>
                </tr><?php
            }
            ?>
        </table>
    </form>
</div>
</html>
		
	
