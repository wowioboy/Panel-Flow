<?php 
 if(!isset($_SESSION)) {
    session_start();
  } 
  require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 
$scripts = '	<script src="lib/prototype.js" type="text/javascript"></script>
	<script src="lib/show_rotated.js" type="text/javascript"></script>';

$styles = '<link type="text/css" rel="stylesheet" href="css/imig.css" media="screen, projection" />';

include 'finalheader.php';

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
		chmod($destinationFile, 0777);
		chmod($sourceFile, 0777);
		chmod($destinationFile, 0777);
	
	} else {
		// CROP WAS SKIPPED -- MOVE TO CROPPED FOLDER ANYWAY	
		copy($sourceFile,$destinationFile);
		chmod($destinationFile, 0777);
	}
    $resizeWidth		 = '200';
	$sourceFile			 = "working/cropped/". $imageFileName;
	$destinationFile = "working/finished/" . $imageFileName;

	if(file_exists($destinationFile)) { chmod($destinationFile, 0777); unlink($destinationFile); }	// delete if existing

	// CHECK TO SEE IF WE NEED TO CROP
	if($imageWidth != $resizeWidth) {
		$convertString = "convert $sourceFile -resize $resizeWidth $destinationFile";
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
	
		echo "<div style='padding:20px;'><div class='errormsg'><div class='spacer'</div><h1 style='color:yello'>CONGRATUALTIONS!</h1><div class='spacer'></div>INSTALLATION COMPLETE. YOU CAN NOW LOG INTO YOUR SITE AND ACCESS THE ADMIN SECTION TO START YOUR COMIC. <div style='height:5px;'></div><a href='../../".$_POST['txtUrl']."/index.php'> CLICK HERE </a>TO START UPLOADING PAGES! <div class='spacer'></div>IF YOU CURRENTLY HAVE THIS COMIC ON ANOTHER WEBCOMIC HOST LIKE, DRUNKDUCK, SMACKJEEVES or COMICSPACE, YOU CAN IMPORT ALL YOUR PAGES INTO PANEL FLOW BY CLICKING <a href='https://www.panelflow.com/import_pages.php?id=".$_POST['txtComic']."' target='_blank'>HERE</a></div></div>";
		   copy('images/pf_temp.jpg','../../'.$_POST['txtUrl'].'/images/pf_temp.jpg');
		   copy($destinationFile,'../../'.$_POST['txtUrl'].'/images/comiccover.jpg');
		   $comicthumb = '../../'.$_POST['txtUrl'].'/images/comicthumb.jpg';
		   $convertString = "convert $destinationFile -resize 100 $comicthumb";
		    copy('htaccess','../../'.$_POST['txtUrl'].'/.htaccess');
		   exec($convertString);
		   @unlink("../../".$_POST['txtUrl']."/urltest.php");
		   $post_data = array('comicid' => $_POST['txtComic'], 'action' => 'comicinstalled');
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$comicresult = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 unset($post_data);
		   //$comicresult = file_get_contents ('http://www.panelflow.com/processing/pfusers.php?action=comicinstalled&comicid='.urlencode($_POST['txtComic']));
		   
		   
?>

	
<div id="completedImage" align="center">
<div class="spacer"></div>
	<?php
	echo '<img src="' . $destinationFile . '" id="theImage" alt="Final Image" border="2"/><br />';
	?>
</div> <!-- completedImage -->


<?php } else { ?> 

	<div class="info">
		<h1>Error</h1>
		<p>There was an error.</p> 
	</div>

<?php } include 'includes/footer.php' ?>