<? 
set_time_limit(0);
//ini_set("max_execution_time","900");
//print ini_set("max_execution_time","900");
$IsPageImport = true;
require_once('includes/init.php');
include 'includes/image_resizer.php';
include 'includes/image_functions.php';
require_once("includes/ExtractTextBetweenTags.class.php");
    $extracttext  = new ExtractTextBetweenTags();
if (!isset($_SESSION['userid']))
	header("location:/login.php?ref=/comic/import/");
$TrackPage = 0;
$PageTitle .= 'Import Pages from ComicSpace';
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
$ID = $_SESSION['userid'];

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

<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="<? echo $TemplateWrapperWidth;?>">
  <tr>
    <td valign="top" align="center">
    <div class="content_bg">
		<? if ($_SESSION['userid'] != '') {?>
            <div id="controlnav">
                <?php $Site->drawControlPanel(); ?>
            </div>
        <? }?>
        <? if ($_SESSION['noads'] != 1) {?>
            <div id="ad_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;" align="center">
                <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
            </div>
        <?  }?>
       
       
        <div id="header_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;">
           <? $Site->drawHeaderWide();?>
        </div>
    </div>
    
     <div class="shadow_bg">
        	 <? $Site->drawSiteNavWide();?>
    </div>
    
     <div class="content_bg" id="content_wrapper">
         <!--Content Begin -->
         <div class="spacer"></div>
       
<?php

 if ((!isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {
 $ImportUrl = $_POST['txtUrl'];
$UrlArray1 = explode('http://www.comicspace.com/',$ImportUrl);
$UrlArray2 = explode('/',$UrlArray1[1]);
$UserString = $UrlArray2[0];
$text = file_get_contents($ImportUrl) or die('Could not grab the file');
$SelectStart = strpos($text, '<select name="jump_state" onchange="MM_jumpMenu(\'parent\',this,0)">');
$text = substr($text, $SelectStart, strlen($text));
$SelectStart = strpos($text, '<select name="jump_state" onchange="MM_jumpMenu(\'parent\',this,0)">');
$SelectStop = strpos($text, '</select>');
$text = substr($text, $SelectStart,($SelectStop+9));
$optionlist = $extracttext->extract($text,'<select name="jump_state" onchange="MM_jumpMenu(\'parent\',this,0)">','</select>');
	
} else if ((isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {?>
<div  style="padding-left:40px; padding-right:25px; height:300px; padding-top:10px;" align="center">

<div class="pageheader">Processing your pages, please wait...</div> 
<div class='spacer'></div>
<span style="font-size:12px;">Depending on the number of pages and size of images this could take several minutes</span>
<div class='spacer'></div>
<span style="font-size:12px;">COMIC URL: <? echo $_POST['txtUrl'];?></span>
<div class="spacer"></div>
<div align="center"><img src="/images/processingbar.gif" />
<div class="spacer"></div>
<div style="font-size:14px;"><b>Number of Pages Processed</b>: [<span id='imagesprocessed' style='color:#339900;'></span>]
</div>
</div>
</div>
 
<?
	$PageArray = explode(',',$_POST['txtList']);
	 $ImportUrl = $_POST['txtUrl'];
	$UrlArray1 = explode('http://www.comicspace.com/',$ImportUrl);
	$UrlArray2 = explode('/',$UrlArray1[1]);
	$UserString = $UrlArray2[0];
$randDirectory = md5(rand() * time());
if(!is_dir("imported/temp/".$randDirectory)) mkdir("imported/temp/".$randDirectory, 0755); 
if(!is_dir("imported/temp/".$randDirectory."/thumbs")) mkdir("imported/temp/".$randDirectory."/thumbs", 0755); 
	foreach ($PageArray as $page) {
		$url = 'http://www.comicspace.com'.$page;
		//print 'MY URL = ' . 	$url ;
		$string = FetchPage($url);
		$PageTitleArray = explode('ComicSpace -',$extracttext->extract($string,"<title>",'</title>'));
		$PageTitle = explode('/',$PageTitleArray[1]);
		//echo "MY TITLE = " . $PageTitle[1];
	// Regex that extracts the images (full tag)
		$image_regex_src_url = '/<img[^>]*'.'src=["|\'](.*)["|\']/Ui';

		preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);

		$img_tag_array = $out[0];
		// Regex for SRC Value
		$image_regex_src_url = '/<img[^>]*'.'src=["|\'](.*)["|\']/Ui';

		preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);

		$images_url_array = $out[1];
		foreach ($images_url_array as $Image) {
			 $UploadedFound = strpos($Image, "uploaded");
			 $UserFound = strpos($Image, $UserString);
			if (($UploadedFound) && ($UserFound)) {
				if (strlen($Count) == 2) {
					$FileName = 'page_'.$Count;
					$TimesCount = 0;
				} else if (strlen($Count) == 3) {
					$FileName = 'page__'.$Count;
				}else { 
					$FileName = 'page'.$Count;
				}
				$Count++;
			
				$gif = file_get_contents('http://www.comicspace.com/'.trim($Image)) or die('Could not grab the file');
				if (exif_imagetype('http://www.comicspace.com/'.$Image) == IMAGETYPE_GIF) {
					 $ext = 'gif';
				} else if (exif_imagetype('http://www.comicspace.com/'.$Image) == IMAGETYPE_JPEG) {
					$ext = 'jpg';
				} else if (exif_imagetype('http://www.comicspace.com/'.$Image) == IMAGETYPE_PNG) {
					$ext = 'png';
				}
				//$randName = md5(rand() * time());
			//if(!is_dir("imported/temp/".$randDirectory)) mkdir("imported/temp/".$randDirectory, 0777); 
			//if(!is_dir("imported/temp/".$randDirectory."/thumbs")) mkdir("imported/temp/".$randDirectory."/thumbs", 0777); 
				$fp  = fopen('imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext, 'w+') or die('Could not create the file');
				fputs($fp, $gif) or die('Could not write to the file');
				fclose($fp);
				chmod('imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext,0777);
				$CurrentFile = 'imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext;
				list($width,$height)=getimagesize($CurrentFile);
				
				if ($width > 1024) {
					$convertString = "convert $CurrentFile -resize 1024 $CurrentFile";
					exec($convertString);	
				}
				if ($height > 1600) {
					$convertString = "convert $CurrentFile -resize x1600 $CurrentFile";
					exec($convertString);	
				}
				
				if ($NewPages == '') 
					$NewPages =  'imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext;
				else 
					$NewPages .= '||imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext;
				
				if ($IDString == '') 
					$IDString =  'image'.$Count;
				else 
					$IDString .= ',image'.$Count;
					
				
						
				$image = new imageResizer('imported/temp/'.$randDirectory.'/'.$FileName.'.'.$ext);
				$Thumbsm = 'imported/temp/'.$randDirectory.'/thumbs/'.$FileName.'_tb.jpg';
				$image->resize(100, 100,100, 100);
				$image->save($Thumbsm, JPG);
				chmod($Thumbsm,0777);
				
				if ($ThumbString == '') 
					$ThumbString =  $Thumbsm;
				else 
					$ThumbString .= ','.$Thumbsm;?>
                    <script type="text/javascript" language="javascript">
						document.getElementById("imagesprocessed").innerHTML ='<? echo $Count;?>';
					</script>
                    <?
					
		}
	}
	
}
?>
    <form name="FinishForm" method="post" action="/comic/import/<? echo $_GET['id'];?>/" id="FinishForm">
    <input type="hidden" name="txtPageList" value="<? echo $NewPages;?>"/>
    <input type="hidden" name="txtThumbList" value="<? echo $ThumbString;?>"/>
    <input type="hidden" name="txtIDString" value="<? echo $IDString;?>"/>
    <input type="hidden" name="tempdir" value="<? echo $randDirectory;?>"/>
     <input type="hidden" name="txtUrl" value="set"/>
    </form>
    <script type="text/javascript" language="javascript">
		document.FinishForm.submit();
	</script> 
    <?
}
?>


<? if ((!isset($_POST['submitlist'])) && (!isset($_POST['txtUrl']))) {?>
Please Enter the full URL to the first page of your comic on ComicSpace
<form name="PageForm" method="post" action="/comic/import/comicspace/<? echo $_GET['id'];?>/">
<input type="text" name="txtUrl" value="" style="width:300px">
<input type="submit" value="GRAB PAGES"></form>
<? }?>


<? if ((!isset($_POST['submitlist'])) && (isset($_POST['txtUrl']))) {?>
<script type="text/javascript" language="javascript">
function getOptions() {
	var PageString = '';
	if (document.getElementById('pagelist') != null) {
		for(var i = 1; i < document.PageForm.pagelist.options.length; i++) {
		if (i == 1) {
			PageString = document.PageForm.pagelist.options[i].value;
		} else {
			PageString = PageString +','+document.PageForm.pagelist.options[i].value;
		}
	}
	
	document.getElementById('PageHolder').value = PageString;
	document.PageForm.submit();
	}
	
}
</script>
<div  style="padding-left:40px; padding-right:25px; height:300px; padding-top:10px;" align="center">

<div class="pageheader">FINDING COMIC AND PAGES</div>
<div class="spacer"></div>
Please Wait...
<div class="spacer"></div>
<img src="/images/processingbar.gif" />
<div class="spacer"></div>
<div class="spacer"></div>
</div>



<div style="display:none;">
<form name="PageForm" method="post" action="/comic/import/comicspace/<? echo $_GET['id'];?>/">
<select id='pagelist' name='pagelist'>
<? echo $optionlist;?>
</select>
<input type="hidden" value="" name="txtList" id="PageHolder">
<input type="hidden" value="1" name="submitlist">
<input type="hidden" value="<? echo $_POST['txtUrl'];?>" name="txtUrl">
</form>
</div>
<!--
<div  style="padding:15px; height:300px; padding-top:10px;" align="center">
<div class="pageheader">FINDING COMIC AND PAGES</div>
</div>-->
<script type="text/javascript" language="javascript">
getOptions();
</script>
  </div>
  <?php //include 'includes/footer_v2.php';?>
<? }?>
 
    <!--Content End -->
    </div>

	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>





