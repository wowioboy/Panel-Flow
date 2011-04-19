<? 

//PAGE COMMENTS MODULE 
if ($CommentSetting == 1) { 

	$BlogCommentString .='<div align="left"><div class="commentwrapper" style="padding-left:10px;">';
	if (($_SESSION['usertype']> 0) || ($_SESSION['email'] == 'matt@outlandentertainment.com')){
		$BlogComments = getPageCommentsAdmin ($Section, $_GET['post'], $ComicID,$db_database,$db_host, $db_user, $db_pass,$PFDIRECTORY,$TEMPLATE);
	} else {
		$BlogComments = getPageComments ($Section, $_GET['post'], $ComicID,$db_database,$db_host, $db_user, $db_pass);
	}
	$BlogCommentString .=$BlogComments;
	$BlogCommentString .='</div>';
} 

?>