<?php 
function Comment($Section, $ComicID, $PageID, $UserID, $Comment,$db_database,$db_host, $db_user, $db_pass){

 
global $CommentUsername,$InitDB;
if ($CommentUsername == '')
	$CommentUsername = $_SESSION['username'];
	
$CommentDate = date('D M j');
$Comment = mysql_real_escape_string($Comment);

$query = "SELECT c.CreatorID, c.url, (SELECT email from users as u2 where u2.encryptid=c.CreatorID) as CreatorEmail
           from comics as c where c.comiccrypt='$ComicID'";
$CreatorArray = $InitDB->queryUniqueObject($query);
$Email = $CreatorArray->CreatorEmail;
$UID = $CreatorArray->CreatorID;
$Url = $CreatorArray->url;

$query = "SELECT AllowPublicComents from comic_settings where ComicID='$ComicID'";
$AllowPublicComents  = $InitDB->queryUniqueValue($query); 

$query = "SELECT CommentNotify from panel_panel.users where email='$Email'";
$CommentNotify  = $InitDB->queryUniqueValue($query);

if (($AllowPublicComents == 0) && ($UserID == 'none'))
	$PostComment = 0;
else
	$PostComment = 1;
	
if ($PostComment == 1) {	
		if ($Section == 'Extras') {
		$query = "INSERT into extracomments (comicid, pageid, userid, comment, commentdate, Username) values ('$ComicID', '$PageID','$UserID','$Comment','$CommentDate','$CommentUsername')";
		} else {
		$query = "INSERT into pagecomments (comicid, pageid, userid, comment, commentdate, Username) values ('$ComicID', '$PageID','$UserID','$Comment','$CommentDate','$CommentUsername')";
		}
		$InitDB->execute($query);
		
		
		
		$query = "SELECT * from comic_pages where EncryptPageID='$PageID' and ComicID='$ComicID'";
		$PageArray = $InitDB->queryUniqueObject($query);
		$PagePosition = $PageArray->Position;
		
		$PageLink = '<a href="http://'.$_SERVER['SERVER_NAME'].'/'.$Url.'/page/'.$PagePosition.'/">http://'.$_SERVER['SERVER_NAME'].'/'.$Url.'/page/'.$PagePosition.'/</a>';
		$to = $Email;
		$subject = 'A New Comment has been posted to your comic';
		$body .= "------NEW COMMENT ----\nComment Date: ".$CommentDate."\nPage: ".$PageLink."\n\n".$CommentUsername." said: ".$Comment;
		
		if (($CommentNotify == 'both') || ($CommentNotify == 'email'))
			mail($to, $subject, $body, "From: NO-REPLY@panelflow.com");
		
		$body = mysql_real_escape_string($body);
		$DateNow = date('m-d-Y');
		
		$query = "INSERT into panel_panel.messages (userid, sendername, senderid, subject, message, date) values ('$UID','PanelFlow','0','New Comment posted to your comic','$body','$DateNow')";
		
		if (($CommentNotify == 'both') || ($CommentNotify == 'pfbox'))
			$InitDB->execute($query);
}


} 

function BlogComment($Section, $ComicID, $PageID, $UserID, $Comment,$db_database,$db_host, $db_user, $db_pass){

global $CommentUsername,$InitDB;
$CommentDate = date('D M j');
$Comment = mysql_real_escape_string($Comment);

$query = "INSERT into blogcomments (ComicID, PostID, UserID, comment, commentdate, Username) values ('$ComicID', '$PageID','$UserID','$Comment','$CommentDate','$CommentUsername')";


$InitDB->execute($query);

}


function CommentProfile($CommentUser, $CommentUserID, $CreatorID, $comment, $time, $IP){
$Site = $_SERVER['SERVER_NAME'];
$querystring ='http://www.panelflow.com/processing/pfusers.php?action=profilecomment&commentuser='. urlencode($CommentUser).'&cuserid='.urlencode($CommentUserID).'&creatorid='.urlencode($CreatorID).'&comment='.urlencode($comment).'&commentdate='.urlencode($time).'&site='.urlencode($Site);
$commentresult = file_get_contents ($querystring);

$insertComment = '0';

}

function getProfileComments ($CreatorID){
$querystring ='http://www.panelflow.com/processing/pfusers.php?action=get&item=profilecomments&creatorid='.urlencode($CreatorID);

$commentsresult = file_get_contents ($querystring);

echo $commentsresult;

}


function getPageComments ($Section, $PageID, $ComicID, $db_database,$db_host, $db_user, $db_pass){
global $ContentBoxTextColor, $ContentBoxFontSize,$InitDB;


if ($Section == 'Blog') 
	$query = "select bc.*, u.username, u.avatar 
	from blogcomments as bc 
	LEFT join users as u on u.encryptid=bc.UserID
	where bc.PostID='$PageID' and bc.comicid='$ComicID' ORDER BY bc.creationdate ASC";
	
else if ($Section == 'Extras') 
	$query = "select ec.*, u.username, u.avatar 
	from extracomments as ec 
	LEFT join users as u on u.encryptid=ec.userid
	where ec.pageid='$PageID' and ec.comicid='$ComicID' ORDER BY ec.creationdate ASC";
else 
	$query = "select pc.*,u.username,u.avatar
			 from pagecomments as pc 
			 LEFT join users as u on u.encryptid=pc.userid
			 where pc.pageid='$PageID' and pc.comicid='$ComicID' ORDER BY pc.creationdate ASC";

 //print  $query;
  $InitDB->query($query);
  $nRows = $InitDB->numRows();
  $bgcolor = '#FFFFFF';
$rowcounter = 0; 
 $CommentString = '';
 if ($nRows>0) {
   while ($comment = $InitDB->fetchNextObject()) { 
  	 if ($Section =='Blog') 
  		$UserID = $comment->UserID;
	else 
	$UserID = $comment->userid;
	if ($UserID != 'none') {
 // print "MY USER ID = " .$UserID;

  $CommentString .= "<div class='spacer'></div><table width='100%' border='0' cellspacing='0' cellpadding='0'>".
  "<tr>".
    "<td width='50' rowspan='2' valign='top' style='color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><a href='http://users.wevolt.com/".trim($comment->username)."/' target='_blank'><img src='".$comment->avatar."' width='50' height='50' border='1'></a></td>".
    "<td height='10' valign='top'style='padding-left:5px; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><div style='font-size:10px;'>on <i>".$comment->commentdate."</i></div><div style='font-size:10px;'><b>".$comment->username."</b> said:</div></td>".
 "</tr>".
  "<tr>".
    "<td valign='top' style='padding:5px; background-color:".$bgcolor."; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px;'>".stripslashes($comment->comment)."</td>".
  "</tr>".
"</table><div class='spacer'></div>";
} else {

 $CommentString .= "<div class='spacer'></div><table width='100%' border='0' cellspacing='0' cellpadding='0'>".
  "<tr>".
    "<td height='10' valign='top'style='padding-left:5px; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><div style='font-size:10px;'>on <i>".$comment->commentdate."</i></div><div style='font-size:10px;'><b>".stripslashes($comment->Username)."</b> said:</div></td>".
 "</tr>".
  "<tr>".
    "<td valign='top' style='padding:5px; background-color:".$bgcolor."; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px;'>".stripslashes($comment->comment)."</td>".
  "</tr>".
"</table><div class='spacer'></div>";

}
		if ($rowcounter == 0) {
			$bgcolor = '#CCCCCC';
			$rowcounter = 1;
		} else {
			$bgcolor = '#FFFFFF';
			$rowcounter = 0;
		}
  
  	}
	} else {
	$CommentString = "No Comments yet. Be the first to Comment!";
	
	}

return  $CommentString;

}

function getPageCommentsAdmin ($Section, $PageID, $ComicID, $db_database,$db_host, $db_user, $db_pass, $PFDIRECTORY, $TEMPLATE){
global $ContentBoxTextColor, $ContentBoxFontSize, $SafeFolder, $PagePosition, $ComicFolder,$InitDB;

$DeleteString = 'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/';
		


 if ($Section =='Blog') {
	$DeleteString .='blog/'.$PageID.'/';
} else if ($Section =='Pages') {
		$DeleteString .='reader/';
		 if ($_GET['episode'] != '')
		 	$DeleteString .='episode/'.$_GET['episode'].'/';
			
			$DeleteString .='page/'.$PagePosition.'/';	
}
if ($Section == 'Blog') 
	$query = "select bc.*, u.username, u.avatar 
	from blogcomments as bc 
	LEFT join users as u on u.encryptid=bc.UserID
	where bc.PostID='$PageID' and bc.comicid='$ComicID' ORDER BY bc.creationdate ASC";
	
else if ($Section == 'Extras') 
	$query = "select ec.*, u.username, u.avatar 
	from extracomments as ec 
	LEFT join users as u on u.encryptid=ec.userid
	where ec.pageid='$PageID' and ec.comicid='$ComicID' ORDER BY ec.creationdate ASC";
else 
	$query = "select pc.*,u.username,u.avatar
			 from pagecomments as pc 
			 LEFT join users as u on u.encryptid=pc.userid
			 where pc.pageid='$PageID' and pc.comicid='$ComicID' ORDER BY pc.creationdate ASC";
  $InitDB->query($query);
  $nRows = $InitDB->numRows();
  $bgcolor = '#FFFFFF';
$rowcounter = 0; 
 $CommentString = '';
 if ($nRows>0) {
   while ($comment = $InitDB->fetchNextObject()) { 
   if ($Section =='Blog') {
  		$UserID = $comment->UserID;
		$CommentID = $comment->ID;
	} else { 
	$UserID = $comment->userid;
	$CommentID = $comment->id;
	}
	if ($UserID != 'none') {

  $CommentString .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
   <td width='50' rowspan='2' valign='top' style='color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><a href=\"#\" onclick=\"delete_comment('".$CommentID."');return false;\" /><img src='/$PFDIRECTORY/templates/$TEMPLATE/images/delete.jpg' border='0'></a><br /><a href='http://users.wevolt.com/".trim($comment->username)."/' target='_blank'><img src='".$comment->avatar."' width='50' height='50' border='1'></a></td>
    <td height='10' valign='top'style='padding-left:5px; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><div style='font-size:10px;'>on <i>".$comment->commentdate."</i></div><div style='font-size:10px;'><a href='http://www.panelflow.com/profile/".trim($comment->username)."/' target='_blank'><b>".$comment->username."</b></a> said:</div></td>
  </tr>
  <tr>
    <td valign='top' style='padding:5px; background-color:".$bgcolor."; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px;'>".stripslashes($comment->comment)."</td>
  </tr><tr><td valign='top'>
  
	</td></tr>
</table><div class='spacer'></div>";
}else {

 $CommentString .= "<div class='spacer'></div><table width='100%' border='0' cellspacing='0' cellpadding='0'>".
  "<tr>".
    "<td height='10' valign='top'style='padding-left:5px; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px; background-color:".$bgcolor.";'><a href=\"#\" onclick=\"delete_comment('".$CommentID."');return false;\" /><img src='/$PFDIRECTORY/templates/$TEMPLATE/images/delete.jpg' border='0'></a><div style='font-size:10px;'>on <i>".$comment->commentdate."</i></div><div style='font-size:10px;'><b>".stripslashes($comment->Username)."</b> said:</div></td>".
 "</tr>".
  "<tr>".
    "<td valign='top' style='padding:5px; background-color:".$bgcolor."; color:#".$ContentBoxTextColor.";font-size:".$ContentBoxFontSize."px;'>".stripslashes($comment->comment)."</td>".
  "</tr>".
"</table><div class='spacer'></div>";

}

		if ($rowcounter == 0) {
			$bgcolor = '#CCCCCC';
			$rowcounter = 1;
		} else {
			$bgcolor = '#FFFFFF';
			$rowcounter = 0;
		}
  
  	}
	} else {
	$CommentString = "No Comments yet. Be the first to Comment!";
	
	}
	 $CommentString .="<form method='POST' action='".$DeleteString."' name='deleteform' id='deleteform'>
	<input type='hidden' name='deletecomment' id='deletecomment' value='1'>
	<input type='hidden' name='commentid' id='commentid' value=''>
	<input type='hidden' name='id' id='id' value='".$PageID."'>
	<input type='hidden' name='position' id='position' value='".$PagePosition."'>
	</form>";

return  $CommentString;

}




function deleteComment($Section, $ComicID, $PageID, $CommentID, $db_database,$db_host, $db_user, $db_pass) {
global $InitDB;
if ($Section == 'Extras') {
$query = "DELETE from extracomments WHERE id ='$CommentID' and comicid='$ComicID' and pageid='$PageID'";
} else if ($Section == 'Blog') {
$query = "DELETE from blogcomments WHERE ID='$CommentID' and ComicID='$ComicID' and PostID='$PageID'";
} else {
$query = "DELETE from pagecomments WHERE id ='$CommentID' and comicid='$ComicID' and pageid='$PageID'";
}
$InitDB->execute($query);
 
}
?>