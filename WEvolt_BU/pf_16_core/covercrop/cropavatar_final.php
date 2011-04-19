<?   
$ComicID=$_POST['txtComic'];
include '../includes/init.php';
include '../includes/image_resizer.php';
include '../includes/image_functions.php';

if(isset($_POST['imageFileName'])) { 
	$imageWidth			 = $_POST['imageWidth'];
	$imageHeight		 = $_POST['imageHeight'];
	$imageFileName		 = $_POST['imageFileName'];
	$cropX				 = $_POST['cropX'];
	$cropY				 = $_POST['cropY'];
	$cropWidth			 = $_POST['cropWidth'];
	$cropHeight			 = $_POST['cropHeight'];
	// DEFINE VARIABLES
	if($cropWidth == 0) { $cropWidth = $imageWidth; }
	if($cropHeight == 0) { $cropHeight = $imageHeight; }
	$sourceFile			 = "working/uploads/". $imageFileName;
	$destinationFile = "working/cropped/" . $imageFileName;

	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $cropWidth || $imageHeight != $cropHeight) {
		$convertString = "convert $sourceFile -crop " . $cropWidth . "x" . $cropHeight . "+" . $cropX . "+" . $cropY . " $destinationFile";
		exec($convertString);
		 //  print    $convertString ;
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);
	
	} else {
		// CROP WAS SKIPPED -- MOVE TO CROPPED FOLDER ANYWAY	
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}
    $resizeWidth		 = '100';
	$sourceFile			 = "working/cropped/". $imageFileName;
	$destinationFile = "working/finished/" . $imageFileName;
	//$avatardestination = "users/".trim($_SESSION['username'])."/avatars/" . $imageFileName;

	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }	// delete if existing

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $resizeWidth) {
		$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
		 //  print    $convertString ;
		exec($convertString);
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);

	} else { // RESIZE WAS SKIPPED
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}
	$fileNamearray = explode(".",$imageFileName);
	$fileName = $fileNamearray[0];
	$ext = $fileNamearray[1]; 
	$randName = substr(md5(rand() * time()),0,10); 
	$AvatarFile = "../../creators/".$randName.'.'.$ext;
	copy($destinationFile, $AvatarFile);
	chmod($AvatarFile, 0777);
	$SyncAvatar = $_SERVER['SERVER_NAME']."/creators/".$randName.'.'.$ext;
	$Avatar = 'http://'.$_SERVER['SERVER_NAME']."/creators/".$randName.'.'.$ext;
	$comicinfoDB = new DB($db_database,$db_host, $db_user, $db_pass);
	$query = "UPDATE creators set avatar='$Avatar' where ComicID='$ComicID'";
	//print $query;
	$comicinfoDB->query($query);
	$query = "UPDATE users set avatar='$Avatar' where encryptid='$CreatorID'";
	//print $query; 
	$comicinfoDB->query($query);
//$result = file_get_contents ('http://www.panelflow.com/processing/pfusers.php?action=avatar&email='.urlencode($CreatorEmail).'&avatar='.urlencode($Avatar));

$comicinfoDB->close();
header("location:/cms/edit/".$_GET['comic']."/?section=creator");

}