<?php
require_once '/'.$_SERVER['DOCUMENT_ROOT'] .'/db.php';
$counterResult = mysql_query("SELECT COUNT(*) AS quantity FROM question");
$result = mysql_fetch_assoc($counterResult);
$count = $result['quantity']/10;
?>
        <style>
            
            a img{
                border:none;
                outline:none;
            }
            .content{
                padding:0px;
                bottom:0px;
            }
            .about{
                width:100%;
                height:400px;
                background:transparent url(about.png) repeat-x top left;
                border-top:2px solid #ccc;
                border-bottom:2px solid #000;
            }
            .about .text{
                width:16%;
                margin:5px 2% 10px 2%;
                height:380px;
                float:left;
                color:#FCFEF3;
                font-size: 16px;
                text-align:justify;
                letter-spacing:0px;
            }
            .about .text h1{
                border-bottom: 1px dashed #ccc;
                color:#fff;
            }
            
			.pagedemo{
				border: 1px solid #CCC;
				width:310px;
				margin:2px;
                padding:50px 10px;
                text-align:center;
				background-color:white;	
			}
        </style>
            <div class="paging">
                <div id="paging">                   
                </div>
            </div>
		<script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME'];?>/backend/paging/jquery-1.3.2.js"></script>
		<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>/backend/paging/jquery.paginate.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function() {
			$("#paging").paginate({
				count 		: <?php echo $count;?>,
				start 		: 1,
				display     : 8,
				border					: true,
				border_color			: '#fff',
				text_color  			: '#fff',
				background_color    	: 'black',	
				border_hover_color		: '#ccc',
				text_hover_color  		: '#000',
				background_hover_color	: '#fff', 
				images					: false,
				mouse					: 'press'
			});
		});
		</script>

