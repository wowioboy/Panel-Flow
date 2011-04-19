<?php 

$PageID = $_GET['id'];
if ($PageID == "") {
$PageID = $_POST['id'];
}
if ($PageID == "undefined") {
$PageID = "";
}

$infodb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from characters where ComicID = '$ComicID'";
$infodb->query($query);
$Characters = $infodb->numRows();
$query = "select * from downloads where ComicID = '$ComicID'";
$infodb->query($query);
$Downloads = $infodb->numRows();
$query = "select * from extra_pages where ComicID = '$ComicID'";
$infodb->query($query);
$Extras = $infodb->numRows();

$query = "select * from products where ComicID = '$ComicID'";
$infodb->query($query);
$Products = $infodb->numRows();
 
$query = "select * from mobile_content where ComicID = '$ComicID'";
$infodb->query($query);
$MobileContent= $infodb->numRows();

if ($Characters > 0) {
$Characters = 1;
}

if ($Downloads > 0) {
$Downloads = 1;
}
if ($Extras > 0) {
$Extras = 1;
}

if ($Products > 0) {
$Products = 1;
}

if ($MobileContent > 0) {
$MobileContent = 1;
}

$infodb->close();
include 'favorites_inc.php'; 
include 'comment_inc.php';
//include 'links_inc.php';

$story_array = array();
$counter = 0;
$pagesdb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comic_pages where ComicID = '$ComicID' order by Position";
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
$pagesdb->close();
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
deleteComment($ComicID, $_GET['id'], $_POST['commentid'],trim($_SESSION['userid']));
}

//INSERT PAGE COMMENT
if ($insertComment == '1'){
Comment($ComicID, $_GET['id'], trim($_SESSION['userid']), $_POST['txtFeedback']);
}

//ADD FAV
if ($_POST['addfav'] == 1) {
addfavorite($ComicID, $CreatorID, trim($_SESSION['userid']));
}
?>