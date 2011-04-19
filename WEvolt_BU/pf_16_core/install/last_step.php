<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';

  //require_once("../includes/curl_http_client.php");
//$curl = &new Curl_HTTP_Client();
//require_once("../includes/create_key_func.php");
//$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
//$curl->set_user_agent($useragent);
 
$scripts = '	<script src="lib/prototype.js" type="text/javascript"></script>
	<script src="lib/show_rotated.js" type="text/javascript"></script>';

$styles = '<link type="text/css" rel="stylesheet" href="css/imig.css" media="screen, projection" />';

//include 'finalheader.php';

if(isset($_POST['imageFileName'])) { 


$ComicID = $_POST['txtComic'];




$ContentID = $ComicID;
//$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
//$AppInstallID= $settingsinfoDB->queryUniqueValue($query);
$query = "SELECT cs.*,p.ProjectDirectory
          from comic_settings as cs
		  join projects as p on cs.ComicID=p.ProjectID
		  where cs.ProjectID ='$ComicID'";
$SettingArray= $InitDB->queryUniqueObject($query);

//$query = "SELECT * from Applications where ID ='$AppInstallID'";
//$ApplicationArray = $settingsinfoDB->queryUniqueObject($query);
//$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
//$settingsinfoDB->close();
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
	$sourceFile			 = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/covercrop/working/uploads/". $imageFileName;
	$destinationFile = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/covercrop/working/cropped/" . $imageFileName;
@chmod($sourceFile, 0777);
	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $cropWidth || $imageHeight != $cropHeight) {
		$convertString = "convert $sourceFile -crop " . $cropWidth . "x" . $cropHeight . "+" . $cropX . "+" . $cropY . " $destinationFile";
		@exec($convertString);
		 // print    $convertString.'<br/>';
		@chmod($destinationFile, 0777);
	
	} else {
		// CROP WAS SKIPPED -- MOVE TO CROPPED FOLDER ANYWAY	
		@copy($sourceFile,$destinationFile);
		@chmod($destinationFile, 0777);
	}
	 $resizeWidth		 = '400';
	$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
     // print    $convertString.'<br/>';
	  
	$sourceFile			 = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/covercrop/working/cropped/". $imageFileName;
	$destinationFile = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/covercrop/working/finished/" . $imageFileName;
	$avatardestination = "users/".trim($_SESSION['username'])."/avatars/" . $imageFileName;
    
	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }	// delete if existing

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $resizeWidth) {
		$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
		 //  print    $convertString ;
		exec($convertString);
		@chmod($destinationFile, 0777);
		@chmod($sourceFile, 0777);
		@chmod($destinationFile, 0777);

	} else { // RESIZE WAS SKIPPED
		@copy($sourceFile,$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/covercrop/".$destinationFile);
		@chmod($destinationFile, 0777);
	}
	

		$CoverDest = $_SERVER['DOCUMENT_ROOT'].'/'.$SettingArray->ProjectDirectory.'/'.$_POST['txtUrl'].'/images/comiccover.jpg';
		$comicthumb =  $_SERVER['DOCUMENT_ROOT'].'/'.$SettingArray->ProjectDirectory.'/'.$_POST['txtUrl'].'/images/comicthumb.jpg';

			@copy($destinationFile,$CoverDest);
		   $convertString = "convert $destinationFile -resize 100 $comicthumb";
		   
		   exec($convertString);
		   @chmod($comicthumb,0777);
		   @chmod($CoverDest,0777);
		   @unlink($sourceFile);
		   @unlink($destinationFile);
		   $CoverDest = '/'.$SettingArray->ProjectDirectory.'/'.$_POST['txtUrl'].'/images/comiccover.jpg';
		   	//$ConnectKey = createKey();
			//$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			//$settingsinfoDB->query($query);
			//print 'CONNECTION QUERY = ' . $query. "<br/><br/>";
		   // $post_data = array('u' => $_SESSION['userid'], 'c' => $ContentID, 'k' => $ConnectKey, 's' => $Section);
			//$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_cover.php", $post_data);
			//print 'MY UPDATE RESULT = ' . $updateresult;
			//unset($post_data);
		   
		  
		  
		echo "<div class='blue_med' align='center'>Your project is ready!</div><div class='messageinfo_black' align='center'><div style='height:10px;'></div><a href='#' onclick='parent.window.document.location.href=\"/cms/edit/".$_GET['comic']."/\";'>CLICK HERE </a> to go enter the Project Admin section.</div>";
		
		 		   
?>
<?php if($styles) echo $styles; ?>

<?php if($scripts) echo $scripts; ?>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
	
<div id="completedImage" align="center">
<div class="spacer"></div>
	<?php
	echo '<img src="'.$CoverDest. '" id="theImage" alt="Final Image" border="2" width="300"/><br />';
	?>
</div> <!-- completedImage -->


<?php } else { ?> 

	<div class="info">
		<h1>Error</h1>
		<? echo "<div style='padding:10px;'><div class='messageinfo_white'><h1 style='color:yello'>CONGRATULATIONS!</h1><div class='spacer'></div>Your project is ready! There was error making your cover though. But you can revist this in the admin section under SETTINGS.<div style='height:10px;'></div><a href='' onclick='parent.window.document.location.href=\"/cms/edit/".$_GET['comic']."/\";'> CLICK HERE </a> to go enter the Project Admin section.</div></div>";?>
	</div>

<?php }  ?>