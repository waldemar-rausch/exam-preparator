<?php
if ($_SESSION['isAdmin']) {
    echo '<a href="http://'.$_SERVER['SERVER_NAME'].'/myProject/index2.php?action=listAll&amp;page=1">zur Verwaltung</a><br /><br />';
}
    $memoAnswer = '';
    $counter = 0;
    ?>
    <fieldset>
        <legend>Thema: <?php echo $topic;?></legend>
        <form class="examForm" action="/solution.php" method="post">
            <?php
            foreach ($questionRows as $questionRow) {
                $counter++;
                echo $questionRow['question'];
                echo $memoAnswer.'<br>';
                $memoAnswer = '';
                foreach ($answerRows as $answerRow) {
                    if($answerRow['examid'] != $questionRow['id']) {
                        //but the answer must be shown
                        $memoAnswer = '<br>'.$answerRow['answer'].'<input type="checkbox" value="'.$answerRow['id'].'" name="answer[]" id="'.$answerRow['id'].'" />';
                        break;
                    }
                    echo $answerRow['answer'].'<input type="checkbox" value="'.$answerRow['id'].'" name="answer[]" id="'.$answerRow['id'].'" />'.'<br>';
                }
                echo '<hr>';
            }
            if($counter < 1) {
                echo 'Es sind keine Fragen freigeschaltet.<br />';
            }
            if($counter > 0) {
                ?>
                <input type="submit" name="send" value="senden" />
            <?php
            }
            ?>
        </form>
    </fieldset>
    <style>
        body {
            background: none repeat scroll 0 0 #39413D;
            color:#fff;
        }
        a{
            color:#fff;
        }
        fieldset{
            background: none repeat scroll 0 0 #1E1E1E;
            border-radius: 6px 6px 6px 6px;
        }

        legend{
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            background: none repeat scroll 0 0 #349E92;
            border-color: #4EB2A8 -moz-use-text-color #161616;
            border-image: none;
            border-radius: 6px 6px 6px 6px;
            border-style: solid none;
            border-width: 1px medium;
            color: #FFFFFF;
            display: block;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            height: 12px;
            min-width: 300px;
            padding-bottom: 14px;
            padding-top: 14px;
            text-align: left;
            text-decoration: none;
            text-shadow: 0 -1px #1D7464, 0 1px #7BB8B3;
        }
        .examForm{
            padding: 10px;
        }

    </style>
