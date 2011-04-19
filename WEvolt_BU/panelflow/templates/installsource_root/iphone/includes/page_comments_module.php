<div align="left">
<div class="authornote"><img src="images/radiobtn.jpg" />COMMENTS:</div>
<div class="spacer"></div><div class="commentwrapper" style="padding-left:10px;">

<?php 
if ($_SESSION['usertype'] == 1){
	$PageComments = getPageCommentsAdmin ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass);
} else {
$PageComments = getPageComments ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass);}

echo $PageComments;?></div>
</div>		