
<? 
function FetchPage($path)
{
$file = fopen($path, "r"); 

if (!$file)
{
exit("The was a connection error!");
} 
$data = '';

while (!feof($file))
{
// Extract the data from the file / url
$data .= fgets($file, 1024);
}
return $data;
}
?>
<?php
require_once("includes/ExtractTextBetweenTags.class.php");
    $extracttext  = new ExtractTextBetweenTags();
 if ((!isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {
 $ImportUrl = $_POST['txtUrl'];

$text = file_get_contents($ImportUrl) or die('Could not grab the file');
//echo $text;
	//echo  $ImportUrl;
    
    $optionlist = $extracttext->extract($text,"<select id=\"dropdown\" style=\"width:100%;\" name=\"url\" onchange=\"window.location = this.options[this.selectedIndex].value; \">",'</select>');
	//echo "MY LIST = " . $optionlist;
	//$SelectPosition = strpos($optionlist, "</SELECT>");
	//$optionlist =  substr($optionlist, 0, $SelectPosition);
} else if ((isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {
$ImportUrl = $_POST['txtUrl'];
	$PageArray = explode(',',$_POST['txtList']);
	
	foreach ($PageArray as $page) {
		$url = $ImportUrl.'/'.$page;
		$string = FetchPage($url);
		print "MY URL = " .$url; 
		print 'MY PAGE = ' . $page;
    	$PageTitle = explode('-',$extracttext->extract($string,"<title>",'</title>'));
		echo "MY TITLE = " . $PageTitle[1];
		
	// Regex that extracts the images (full tag)
		$image_regex_src_url = '/<img[^>]*'.'src=["|\'](.*)["|\']/Ui';

		preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);

		$img_tag_array = $out[0];
		// Regex for SRC Value
		$image_regex_src_url = '/<img[^>]*'.'src=["|\'](.*)["|\']/Ui';

		preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);

		$images_url_array = $out[1];
		foreach ($images_url_array as $Image) {
		print  'my Image = ' . $Image."<br/>";
			 $UploadedFound = strpos($Image, "pages");
			// $ServerFound = strpos($Image, "comics.drunkduck.com");
			// $UserFound = strpos($Image, $UserString);
			if ($UploadedFound == true){
				print  "Found!<br/>";
				$gif = file_get_contents($Image) or die('Could not grab the file');
				if (exif_imagetype($Image) == IMAGETYPE_GIF) {
					 $ext = 'gif';
				} else if (exif_imagetype($Image) == IMAGETYPE_JPEG) {
					$ext = 'jpg';
				} else if (exif_imagetype($Image) == IMAGETYPE_PNG) {
					$ext = 'png';
				}
				$randName = md5(rand() * time());
				$fp  = fopen('imported/temp/'.$randName.'.'.$ext, 'w+') or die('Could not create the file');
				fputs($fp, $gif) or die('Could not write to the file');
				fclose($fp);
				chmod('imported/temp/'.$randName.'.'.$ext,0777);
			}
	}
}
}
?>


<script type="text/javascript" language="javascript">
function getOptions() {
	var PageString = '';
	for(var i = 1; i < pagelist.options.length; i++) {
		if (i == 1) {
			PageString = pagelist.options[i].value;
		} else {
			PageString = PageString +','+pagelist.options[i].value;
		}
	}
	document.getElementById('PageHolder').value = PageString;
	document.PageForm.submit();
}
</script>
<? if ((!isset($_POST['submitlist'])) && (!isset($_POST['txtUrl']))) {?>
Please Enter the full URL to your Panel Flow Comic
<form name="PageForm" method="post" action="extract_panelflow.php">
<input type="text" name="txtUrl" value="" style="width:300px">
<input type="submit" value="GRAB PAGES"></form>
<? }?>


<? if ((!isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {?>
<form name="PageForm" method="post" action="extract_panelflow.php">
<select id='pagelist' name='pagelist'>
<? echo $optionlist;?>
</select>
<input type="hidden" value="" name="txtList" id="PageHolder">
<input type="hidden" value="1" name="submitlist">
<input type="hidden" value="<? echo $_POST['txtUrl'];?>" name="txtUrl">
<script type="text/javascript" language="javascript">
getOptions();
</script>

<? }?>