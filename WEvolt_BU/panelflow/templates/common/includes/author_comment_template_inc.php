<? 
 
//AUTHOR COMMENT MODULE 
$AuthorCommentString ='';

if ($AuthorComment != '') {
$AuthorComment =preg_replace('/(?:(?:\r\n)|\r|\n){3,}/', "\n\n", $AuthorComment);
$AuthorCommentString .='<div class="boxcontent " style="padding-left:10px;color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;">posted:'.$Date.'</div>';
$AuthorCommentString .='<div class="notespacer"></div>';
$AuthorCommentString .='<div style="padding-left:10px;"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="left" valign="top" style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;"><b>'.$CreatorName.'</b><br /><img src="'.$Avatar.'" border="2" align="left" hspace="4" vspace="2" width="50" height="50"/>'.nl2br(stripslashes($AuthorComment)).'</td></tr></table></div>';
$HomeauthcommString =$AuthorCommentString;
$AuthComment = 1;
} else {
	$AuthComment = 0;
}



?>