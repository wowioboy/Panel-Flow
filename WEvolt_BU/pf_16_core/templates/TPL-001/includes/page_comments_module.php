<div align="left">
<div class="authornote"><img src="/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/images/radiobtn.jpg" />COMMENTS:</div>
<div class="spacer"></div><div class="commentwrapper" style="padding-left:10px;">

<?php 

if (($_SESSION['usertype'] == 1) || ($_SESSION['email'] == $CreatorEmail)){

	$PageComments = getPageCommentsAdmin ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass,$PFDIRECTORY,$TEMPLATE);
} else {
$PageComments = getPageComments ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass);}

echo $PageComments;?></div>
</div>		