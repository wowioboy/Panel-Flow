<? 

//PAGE COMMENTS MODULE 
if ($CommentSetting == 1) { 

	$PageCommentString .='<div align="left"><div class="commentwrapper" style="padding-left:10px;">';
	if (($_SESSION['usertype']> 0) || ($_SESSION['email'] == 'matt@outlandentertainment.com')){
		$PageComments = getPageCommentsAdmin ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass,$PFDIRECTORY,$TEMPLATE);
	} else {
		$PageComments = getPageComments ($Section, $PageID, $ComicID,$db_database,$db_host, $db_user, $db_pass);
	}
	$PageCommentString .=$PageComments;
	$PageCommentString .='</div>';
} 

?>