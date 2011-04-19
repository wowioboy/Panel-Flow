<?php 
$PagePosition = $_GET['page'];
$PageID = $_GET['id'];
if ($PageID == "") {
	$PageID = $_POST['id'];
}
if ($PageID == "undefined") {
$PageID = "";
}


$CurrentDate = date('Y-m-d').' 00:00:00';
$infodb = new DB();
$pagesdb = new DB();
$query = "select * from characters where ComicID = '$ComicID'";
$infodb->query($query);
$Characters = $infodb->numRows();

$query = "select count(*) from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate='$CurrentDate'";
$TodayPage = $infodb->queryUniqueValue($query);

$query = "select PublishDate from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$CurrentDate' order by PublishDate DESC";

$LatestPage =  date('m.d.y',strtotime($infodb->queryUniqueValue($query)));

$query = "select count(*) from comic_pages where ComicID = '$ComicID' and PageType='extras' and PublishDate='$CurrentDate'";
$TodayExtra = $infodb->queryUniqueValue($query);


$query = "select * from downloads where ComicID = '$ComicID'";
$infodb->query($query);
$Downloads = $infodb->numRows();
$query = "select * from comic_pages where PageType='extras' and ComicID = '$ComicID'";
$infodb->query($query);
$Extras = $infodb->numRows();

$query = "select * from products where ComicID = '$ComicID' and IsActive=1";
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

include 'favorites_inc.php'; 
include 'comment_inc.php';
include 'links_inc.php';
 
$story_array = array(); 
$counter = 0;
if ($Section != 'Extras') {
	$query = "select * from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$CurrentDate' order by Position";
} else {
	$query = "select * from comic_pages where ComicID = '$ComicID' and PageType='extras' and PublishDate<='$CurrentDate' order by Position";
}


$pagesdb->query($query);
while ($setting = $pagesdb->fetchNextObject()) { 
	$story_array[$counter]->image = $setting->Image;
	$story_array[$counter]->id = $setting->EncryptPageID;
    $story_array[$counter]->comment = $setting->Comment;
	$story_array[$counter]->imgheight =$setting->ImageDimensions;
	$story_array[$counter]->title = $setting->Title;
	$story_array[$counter]->active = 1;
	$story_array[$counter]->datelive = $setting->Datelive;
	$story_array[$counter]->thumbsm = $setting->ThumbSm;
	$story_array[$counter]->thumbmd = $setting->ThumbMd;
	$story_array[$counter]->ThumbLg = $setting->ThumbLg;
	$story_array[$counter]->chapter = $setting->Chapter;
    $story_array[$counter]->episode =  $setting->Episode;
	$story_array[$counter]->EpisodeDesc =  $setting->EpisodeDesc;
	$story_array[$counter]->EpisodeWriter =  $setting->EpisodeWriter;
	$story_array[$counter]->EpisodeArtist =  $setting->EpisodeArtist;
	$story_array[$counter]->EpisodeColorist =  $setting->EpisodeColorist;
	$story_array[$counter]->EpisodeLetterer =  $setting->EpisodeLetterer;
    $story_array[$counter]->filename = $setting->Filename;
	$story_array[$counter]->position = $setting->Position;
	
	$counter++;
}

include 'datecheck.php'; 
$Links = '0';
$insertComment = $_POST['insert'];
$DeleteComment = $_POST['deletecomment'];
$ProfileComment = $_POST['profilecomment'];

//
if ($Section != 'Extras') {
$pageresult = file_get_contents ('https://www.panelflow.com/processing/updatecomic.php?action=getpages&comicid='.$ComicID);
$Remote = $_SERVER['REMOTE_ADDR'];
$ID = $_SESSION['userid'];
if ($pageresult != $TotalPages) {
$result = file_get_contents ('https://www.panelflow.com/processing/updatecomic.php?action=pages&userid='.$CreatorID."&comicid=".$ComicID."&pages=".$TotalPages);
}
}
//INSERT POFILE COMMENT
if ($ProfileComment == '1'){
CommentProfile($_SESSION['username'], $_SESSION['userid'], $CreatorID, $_POST['txtFeedback'], date('D M j'), $_SERVER['REMOTE_ADDR']);
} 

//DELETE COMMENT
if ($DeleteComment == '1'){
if ($Section == 'Blog') {
deleteComment('Blog',$ComicID, $_POST['id'], $_POST['commentid'],$db_database,$db_host, $db_user, $db_pass);
} else {


deleteComment('Pages',$ComicID, $PageID, $_POST['commentid'],$db_database,$db_host, $db_user, $db_pass);
}

}

//INSERT PAGE COMMENT
if ($insertComment == '1'){



 if(($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] )) || ($_SESSION['userid'] == '')) {
		unset($_SESSION['security_code']);
		setcookie("seccode", "", time()+60*60*24*100, "/");
		if ($_POST['txtFeedback'] == ''){
			$CommentError = 'You need to enter a comment';
		} else if (($_SESSION['userid'] == '') && ($_POST['txtName'] == '')){
			$CommentError = 'Please enter a name';
			
		} else {
		
		if ($_SESSION['userid'] == '')
			$CommentUserID = 'none';
		else 
			$CommentUserID = trim($_SESSION['userid']);
			
		$CommentUsername = addslashes($_POST['txtName']);
		
		if ($Section == 'Blog') {
			BlogComment($Section,$ComicID, $_POST['id'], $CommentUserID, $_POST['txtFeedback'],$db_database,$db_host, $db_user, $db_pass);
			
			  header("location:/".$ComicFolder."/blog/".$_POST['id'].'/');
		
		} else {
			Comment($Section,$ComicID, $PageID, $CommentUserID, $_POST['txtFeedback'],$db_database,$db_host, $db_user, $db_pass);
			
			if ($Section=='Extras')
			   header("location:/".$ComicFolder."/reader/extras/page/".$_POST['position'].'/');
			else 
			    header("location:/".$ComicFolder."/reader/page/".$_POST['position'].'/');
		}
			
		}
   } else {
	$CommentError = 'invalid security code. Try Again.';
   }
   

}

//ADD FAV
if ($_POST['addfav'] == 1) {
addfavorite($ComicID, $CreatorID, trim($_SESSION['userid']));
}
if ($PageID != '') {
	$query = "select Image from comic_pages where PageType='pencils' and ComicID = '$ComicID' and ParentPage='$PageID'";
	$PeelOne = $infodb->queryUniqueValue($query);
	
	$query = "select Image from comic_pages where PageType='inks' and ComicID = '$ComicID' and ParentPage='$PageID'";
	$PeelTwo = $infodb->queryUniqueValue($query);
	
	$query = "select Image from comic_pages where PageType='colors' and ComicID = '$ComicID' and ParentPage='$PageID'";
	$PeelThree = $infodb->queryUniqueValue($query);
	
	$query = "select Image from comic_pages where PageType='script' and ComicID = '$ComicID' and ParentPage='$PageID'";
	$PeelFour = $infodb->queryUniqueValue($query);
	
	if ($PeelFour != '') {
		$ScriptFileName = explode('.',$PeelFour);
		$ScriptPDF = $ScriptFileName[0].'.pdf';
		$ScriptHTML = $ScriptFileName[0].'.html';
	}
	$query = "select * from pf_hotspots where ComicID = '$ComicID' and PageID='$PageID'";
	$infodb->query($query);
	$AstArray = array();
	$MapArray = array();
	$PopupCodeArray = array();
	while ($hotspot = $infodb->FetchNextObject()){
		$AstArray[] = $hotspot->AsterickCoords;
		$MapArray[] = $hotspot->HotSpotCoords;
		$PopupCodeArray[] = $hotspot->HTMLCode;
	}
	
}

$infodb->close();
$pagesdb->close();
?>