<? 

include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

$ItemID = $_POST['txtItem'];
$ComicID = $_SESSION['sessionproject'];

$SafeFolder = $_SESSION['safefolder'];
$scripts = '	<script src="lib/prototype.js" type="text/javascript"></script>
	<script src="lib/show_rotated.js" type="text/javascript"></script>';

$styles = '<link type="text/css" rel="stylesheet" href="css/imig.css" media="screen, projection" />';

if(isset($_POST['imageFileName'])) { 

	$imageWidth			 = $_POST['imageWidth'];
	$imageHeight		 = $_POST['imageHeight'];
	$imageFileName		 = $_POST['imageFileName'];
	$cropX				 = $_POST['cropX'];
	$cropY				 = $_POST['cropY'];
	$cropWidth			 = $_POST['cropWidth'];
	$cropHeight			 = $_POST['cropHeight'];
	$Title = $_POST['txtTitle'];
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
		 // print    $convertString ;
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);
	
	} else {
		// CROP WAS SKIPPED -- MOVE TO CROPPED FOLDER ANYWAY	
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}
    $resizeWidth		 = '500';
	$sourceFile			 = "working/cropped/". $imageFileName;
	$destinationFile = "working/finished/" . $imageFileName;
	//print  'SOURCE = ' . $sourceFile."<br/>";
	//print  'destinationFile = ' . $destinationFile."<br/>";

	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }	// delete if existing

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $resizeWidth) {
		$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
		//print    $convertString ;
		exec($convertString);
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);

	} else { // RESIZE WAS SKIPPED
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}

	$fileName = explode(".",$imageFileName);
	$fileName = $fileName[0];
	$randName = substr(md5(rand() * time()),0,10);
		   copy($destinationFile,$_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/mobile/wallpapers/'.$randName.'.jpg');
		   $mobilethumb = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/mobile/wallpapers/'.$randName.'_tb.jpg';
		   $convertString = "convert $destinationFile -resize 100 $mobilethumb";
		   exec($convertString);
		 //  print  $convertString."<br/>";
		   chmod($mobilethumb,0777);
		 // print $mobilethumb;
		  //print 'DESTINATION = ' .$destinationFile; 
		    chmod($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/mobile/wallpapers/'.$randName.'.jpg',0777);
		   

		   $Wallpaper = 'mobile/wallpapers/'.$randName.'.jpg';
		   $Thumb = 'mobile/wallpapers/'.$randName.'_tb.jpg';
		   if (($_POST['txtAction'] == 'add') || ($_POST['txtAction'] == '')){
		  	 if ($Title == '') {
		   		$Title = 'untitled';
		   	}
			$Now = date('Y-m-d h:i:s');
		  	$query = "INSERT into mobile_content (Title, ComicID, Image, Thumb, Type, CreateDate) values ('$Title', '$ComicID', '$Wallpaper','$Thumb','Wallpaper', '$Now')";
 			$InitDB->query($query);
			 $query = "SELECT ID from mobile_content where Image='$Wallpaper' and CreateDate='$Now'";
 			$ItemID = $InitDB->queryUniqueValue($query);
			//print $query."<br/>";
  			$Encryptid = substr(md5($ItemID), 0, 15).dechex($ItemID);
			$IdClear = 0;
				$Inc = 5;
				while ($IdClear == 0) {
						$query = "SELECT count(*) from mobile_content where EncryptID='$Encryptid'";
						$Found = $InitDB->queryUniqueValue($query);
						$output .= $query.'<br/>';
						if ($Found == 1) {
							$Encryptid = substr(md5(($ItemID+$Inc)), 0, 15).dechex($ItemID+$Inc);
						} else {
							$query = "UPDATE mobile_content SET EncryptID='$Encryptid' WHERE ID='$ItemID'";
							$InitDB->execute($query);
							$output .= $query.'<br/>';
							$IdClear = 1;
							
						}
						$Inc++;
				}
			$ItemID = $Encryptid ;
			//print $query."<br/>";
			 
		   } else  if ($_POST['txtAction'] == 'edit') {
		   		$ComicID = $_POST['txtComic'];
		   	 	$query = "UPDATE mobile_content set Title='$Title', Thumb ='$Thumb', Image='$Wallpaper' where EncryptID='$ItemID'"; 
		  	 	$InitDB->execute($query);
			 
			   //$mobileresult = file_get_contents ("http://www.panelflow.com/processing/pf_mobile.php?action=edit&type=wallpaper&server=".$_SERVER['SERVER_NAME']."&filename=".$Wallpaper."&id=".$EncryptID."&title=".urlencode($Title));
			   
		   }
		  }
		  $InitDB->close();
		header("location:/cms/edit/".$_SESSION['safefolder']."/?tab=content&section=mobile");
?>
