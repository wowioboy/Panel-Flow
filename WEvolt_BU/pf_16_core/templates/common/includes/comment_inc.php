<?php 
function Comment($Section, $ComicID, $PageID, $UserID, $Comment,$db_database,$db_host, $db_user, $db_pass){
$commentDB = new DB($db_database,$db_host, $db_user, $db_pass);
$CommentDate = date('D M j');
if ($Section == 'Extras') {
$query = "INSERT into extracomments (comicid, pageid, userid, comment, commentdate) values ('$ComicID', '$PageID','$UserID','$Comment','$CommentDate')";
} else {
$query = "INSERT into pagecomments (comicid, pageid, userid, comment, commentdate) values ('$ComicID', '$PageID','$UserID','$Comment','$CommentDate')";
}

$commentDB->query($query);
$commentDB->close();
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
$commentDB = new DB($db_database,$db_host, $db_user, $db_pass);
if ($Section == 'Extras') {
$query = "select id, comment, userid, commentdate, creationdate from extracomments where pageid='$PageID' and comicid='$ComicID' ORDER BY creationdate DESC";
} else {
$query = "select id, comment, userid, commentdate, creationdate from pagecomments where pageid='$PageID' and comicid='$ComicID' ORDER BY creationdate DESC";
}

 //print  $query;
  $commentDB->query($query);
  $nRows = $commentDB->numRows();
  $bgcolor = '#FFFFFF';
$rowcounter = 0;
 $CommentString = '';
 if ($nRows>0) {
   while ($comment = $commentDB->fetchNextObject()) { 
  	$UserID = $comment->userid;
 // print "MY USER ID = " .$UserID;
 	$avatarDB = new DB($db_database,$db_host, $db_user, $db_pass);
   $query = "SELECT username, avatar from users where encryptid='$UserID'";

   $UserArray = $avatarDB->queryUniqueObject($query);
  $CommentString .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='50' rowspan='2' valign='top' bgcolor='".$bgcolor."'><img src='".$UserArray->avatar."' width='50' height='50' border='1'></td>
    <td height='10' valign='top'style='padding-left:5px;' bgcolor='".$bgcolor."'><div>on <i>".$comment->commentdate."</i></div><b>".$UserArray->username."</b> said:</td>
  </tr>
  <tr>
    <td valign='top' style='padding:5px;' bgcolor='".$bgcolor."'>".stripslashes($comment->comment)."</td>
  </tr>
</table><div class='spacer'></div>";

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
  $commentDB->close();
  $avatarDB ->close();
}

function getPageCommentsAdmin ($Section, $PageID, $ComicID, $db_database,$db_host, $db_user, $db_pass, $PFDIRECTORY, $TEMPLATE){
$commentDB = new DB($db_database,$db_host, $db_user, $db_pass);
if ($Section == 'Extras') {
$query = "select id, comment, userid, commentdate, creationdate from extracomments where pageid='$PageID' and comicid='$ComicID' ORDER BY creationdate DESC";
} else {
$query = "select id, comment, userid, commentdate, creationdate from pagecomments where pageid='$PageID' and comicid='$ComicID' ORDER BY creationdate DESC";
}

 //print  $query;
  $commentDB->query($query);
  $nRows = $commentDB->numRows();
  $bgcolor = '#FFFFFF';
$rowcounter = 0;
 $CommentString = '';
 if ($nRows>0) {
   while ($comment = $commentDB->fetchNextObject()) { 
  		$UserID = $comment->userid;
 // print "MY USER ID = " .$UserID;
 	$avatarDB = new DB($db_database,$db_host, $db_user, $db_pass);
   $query = "SELECT username, avatar from users where encryptid='$UserID'";
   $UserArray=  $avatarDB->queryUniqueObject($query);
  $CommentString .= "<form method='POST' action='index.php?id=".$PageID."'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='50' rowspan='2' valign='top' bgcolor='".$bgcolor."'><input type='image' src='/$PFDIRECTORY/templates/$TEMPLATE/images/delete.jpg' style='border:none;' value='DELETE' /><br /><img src='".$UserArray->avatar."' width='50' height='50' border='1'></td>
    <td height='10' valign='top'style='padding-left:5px;' bgcolor='".$bgcolor."'><div>on <i>".$comment->commentdate."</i></div><b>".$UserArray->username."</b> said:</td>
  </tr>
  <tr>
    <td valign='top' style='padding:5px;' bgcolor='".$bgcolor."'>".stripslashes($comment->comment)."</td>
  </tr><tr><td valign='top'>
  
	<input type='hidden' name='deletecomment' id='deletecomment' value='1'>
	<input type='hidden' name='commentid' id='commentid' value='".$comment->id."'>
	<input type='hidden' name='id' id='id' value='".$PageID."'>
	
	</td></tr>
</table><div class='spacer'></div>";

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
  $commentDB->close();
  $avatarDB ->close();
}


function deleteComment($Section, $ComicID, $PageID, $CommentID, $db_database,$db_host, $db_user, $db_pass) {
$commentDB = new DB($db_database,$db_host, $db_user, $db_pass);
if ($Section == 'Extras') {
$query = "DELETE from extracomments WHERE id ='$CommentID' and comicid='$ComicID' and pageid='$PageID'";
} else {
$query = "DELETE from pagecomments WHERE id ='$CommentID' and comicid='$ComicID' and pageid='$PageID'";
}

  $commentDB->query($query);
  $commentDB->close();
}
?>