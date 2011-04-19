<?php 

$PageID = $_GET['id'];
if ($PageID == "") {
$PageID = $_POST['id'];
}
if ($PageID == "undefined") {
$PageID = "";
}

$infodb = new DB($db_database,$db_host, $db_user, $db_pass);
$pagesdb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from characters where ComicID = '$ComicID'";
$infodb->query($query);
$Characters = $infodb->numRows();
$query = "select * from downloads where ComicID = '$ComicID'";
$infodb->query($query);
$Downloads = $infodb->numRows();
$query = "select * from extra_pages where ComicID = '$ComicID'";
$infodb->query($query);
$Extras = $infodb->numRows();

if ($Characters > 0) {
$Characters = 1;
}

if ($Downloads > 0) {
$Downloads = 1;
}
if ($Extras > 0) {
$Extras = 1;
}

include 'favorites_inc.php'; 
include 'comment_inc.php';
include 'links_inc.php';

$story_array = array();
$counter = 0;
$query = "select * from extra_pages where ComicID = '$ComicID' order by Position";
$pagesdb->query($query);
while ($setting = $pagesdb->fetchNextObject()) { 
	$story_array[$counter]->image = $setting->Image;
	$story_array[$counter]->id = $setting->EncryptPageID;
    $story_array[$counter]->comment = $setting->Comment;
	$story_array[$counter]->imgheight =$setting->ImageDimensions;
	$story_array[$counter]->title = $setting->Title;
	$story_array[$counter]->active = 1;
	$story_array[$counter]->datelive = $setting->Datelive;
	$story_array[$counter]->thumb = $setting->ThumbSm;
	$story_array[$counter]->chapter = $setting->Chapter;
    $story_array[$counter]->episode =  $setting->Episode;
    $story_array[$counter]->filename = $setting->Filename;
	$counter++;
}

include 'datecheck.php'; 
$Links = '0';
$insertComment = $_POST['insert'];
$DeleteComment = $_POST['deletecomment'];
$ProfileComment = $_POST['profilecomment'];

//INSERT POFILE COMMENT
if ($ProfileComment == '1'){
CommentProfile($_SESSION['username'], $_SESSION['userid'], $CreatorID, $_POST['txtFeedback'], date('D M j'), $_SERVER['REMOTE_ADDR']);
} 

//DELETE COMMENT
if ($DeleteComment == '1'){
deleteComment('Extras',$ComicID, $PageID, $_POST['commentid'],$db_database,$db_host, $db_user, $db_pass);
}

//INSERT PAGE COMMENT
if ($insertComment == '1'){
 if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
		unset($_SESSION['security_code']);
		if ($_POST['txtFeedback'] == ''){
			$CommentError = 'You need to enter a comment';
		} else {
			Comment('Extras',$ComicID, $PageID, trim($_SESSION['userid']), $_POST['txtFeedback'],$db_database,$db_host, $db_user, $db_pass);
			header("location:extras.php?id=".$PageID);
		}
   } else {
	$CommentError = 'invalid security code. Try Again.';
   }
   

}

//ADD FAV
if ($_POST['addfav'] == 1) {
addfavorite($ComicID, $CreatorID, trim($_SESSION['userid']));
}
$infodb->close();
$pagesdb->close();
?>