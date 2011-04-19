<?php 
set_time_limit(0);
//ini_set("max_execution_time","900");
//print ini_set("max_execution_time","900");
$IsPageImport = true;
require_once('includes/init.php');
include 'includes/image_resizer.php';
include 'includes/image_functions.php';
if (!isset($_SESSION['userid']))
	header("location:/login.php?ref=/comic/import/");
$TrackPage = 0;
$PageTitle .= 'Import Pages';
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
$ID = $_SESSION['userid'];


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
         <div class='contentwrapper'>
<div style="padding:30px;">
<? if (((!isset($_GET['id'])) && (!isset($_POST['txtUrl']))) || ($_GET['id'] == '')) {
echo "<div class='pageheader'>Please Select which comic you would like to import pages into</div>";
$query = "select * from projects where (CreatorID='$ID' or userid='$ID') and installed=1 and Hosted=1 and ProjectType='comic' ORDER BY title DESC";
//print $query;
  $result = mysql_query($query);
  $nRows = mysql_num_rows($result);
  $counter =0;
  $comicString = "<table width='99%' cellspacing='0' cellpadding='0' border='0'><tr>";
   for ($i=0; $i< $nRows; $i++){
   	$row = mysql_fetch_array($result);
	$UpdateDay = substr($row['PagesUpdated'], 5, 2); 
			$UpdateMonth = substr($row['PagesUpdated'], 8, 2); 
			$UpdateYear = substr($row['PagesUpdated'], 0, 4);
			$Updated = $UpdateDay.".".$UpdateMonth.".".$UpdateYear;

	
	$comicString .= "<td valign='top'><div align='center'><div class='comictitlelist'>".stripslashes($row['title'])."</div><a href='/comic/import/".$row['SafeFolder']."/'>";
	$ProjectThumb = 'http://www.wevolt.com'.$row['thumb'];
	if (!is_array(@getimagesize($ProjectThumb))) {
			$ProjectThumb ="/images/no_thumb_project.jpg";	
		}

				$comicString .="<img src='".$ProjectThumb."' border='2' alt='LINK' style='border-color:#000000;' width='100' height='134'>";

	$comicString .="</a><div class='smspacer'></div>";
	
		
	$comicString .="<div class='pages'>Pages: ".$row['pages']."</div></div><div class='lgspacer'></div></td>"; 
			 $counter++;
 				if ($counter == 5){
 					$comicString .= "</tr><tr>";
 					$counter = 0;
 				}
	}
		if ($counter < 5){
 					while($counter < 5) {
					$comicString .= "<td></td>";
					$counter++;
					}
 				}
	 $comicString .= "</tr></table>";
	echo  $comicString;
} else if (!isset($_POST['txtUrl'])) {?>
<div style="padding:50px;">
<div class="pageheader">Please Enter the full URL to the first page of your comic on either Drunk Duck, Comicspace or Smackjeeves. </div> 
<div class="spacer"></div>
<span style="font-size:12px;">NOTE: This will only work if you have the archive/select box showing on your comic pages. Also some SmackJeeves sites do not import correctly. If you run into an issue just shoot us an email <a href="/contact/">HERE</a> and we'll look into it. </span>
<div class="spacer"></div>
<form name="PageForm" method="post" action="/comic/import/<? echo $_GET['id'];?>/">
<input type="text" id='txtUrl' name="txtUrl" value="<? echo $_POST['txtUrl'];?>" style="width:300px">
<input type="button" value="GRAB PAGES" onclick="check_host();"></form></div>
<? } else if ((isset($_POST['txtUrl']))&&(isset($_GET['id'])) && (isset($_POST['txtPageList']))&& (!isset($_POST['reorder']))&& (!isset($_POST['process']))){

$images_url_array = explode('||',$_POST['txtPageList']);
$IdArray =  explode(',',$_POST['txtIDString']);
$Thumbarray =  explode(',',$_POST['txtThumbList']);
$randDirectory = $_POST['tempdir'];
//$IdArray = array_reverse($IdArray2);
//$Thumbarray = array_reverse($Thumbarray2);
//$images_url_array = array_reverse($images_url_array2);

?>
<form name="PageForm" method="post" action="/comic/import/process/<? echo $_GET['id'];?>/">

<div id='finishdiv' class="pageheader" style="padding:15px;">Below are the pages imported, please remove any unwanted pages and click FINISH IMPORT.
<div align="center" style="padding:5px;">
<input type="hidden" name="txtUrl" value="set" >
<input type="hidden" name="finish" value="1" >
<input type="hidden" name="txtComic" value="<? echo $_GET['id'];?>" >
<input type="hidden" name="txtSafeFolder" value="<? echo $_GET['id'];?>" id='txtSafeFolder'>
<input type="hidden" name="tempdir" value="<? echo $randDirectory;?>" >
<input type="submit" value="FINISH IMPORT"></div>
</div>
 <div id='projectimages' style="padding-left:5px;padding-right:5px;">
   <span style="font-size:14px;">  You can reorder your images by dragging into place, make sure you click HERE -> <input class="inspector" type="button" value="SAVE ORDER" onclick="junkdrawer.inspectListOrder('boxes','<? echo $_POST['tempdir'];?>','pages')"/> before deleting or continuing, or you will lose your order.<br />
 <br /><br />
<div class='warning'>If your images are reversed, click here:<input class="inspector" type="button" value="REVERSE ORDER" onclick="junkdrawer.reverseListOrder('boxes','<? echo $_POST['tempdir'];?>','pages')"/></div></span>
     <div id='imagelisting'>
<?php

$Count=0;
$Times=0;
$TimesCount = 0;
	$NewPages = '';
	$IDString = '';
	echo '<ul id="boxes">';
		foreach ($Thumbarray as $Thumb) {	
		$ThumbNameArray = explode('/',$Thumb);
		$ThumbName = $ThumbNameArray[4];
		$ImageArray = explode('/',$images_url_array[$Count]);
		$ImageName = $ImageArray[3];
				echo  "<li class=\"box\" id='box".$Count."'><span id=\"image".$Count."--".$ThumbName."--".$ImageName."\"></span><img src=\"/".$Thumb."\" vspace=\"3\" hspace=\"3\"><a href=\"javascript:void(0)\" onClick=\"deleteimage('image".$Count."');\">[delete]</a></li>";
				 if ($IDString == '') 
					$IDString =  'image'.$Count;
				else 
					$IDString .= ',image'.$Count;
		 			$Count++;
			}
			echo "</ul></div>";
			?>
</div>
<div style="clear: left;"><br/></div>
<input type="hidden" name="txtPages" value="<? echo $_POST['txtPageList'];?>" id='txtPages'>
<input type="hidden" name="txtThumbs" value="<? echo $_POST['txtThumbList'];?>" id='txtThumbs'>
<input type="hidden" name="txtIDs" value="<? echo $IDString;?>" id='IdString'>
<input type="hidden" name="reorder" value="1" />
</form>
<? } else {?>
<form name="PageForm" method="post" action="/comic/import/process/<? echo $_GET['id'];?>/">

<div id='finishdiv' class="pageheader" style="padding:15px;">Below are the pages imported, please remove any unwanted pages and click FINISH IMPORT.

<div align="center" style="padding:5px;">

<input type="hidden" name="txtUrl" value="<? echo $_POST['txtUrl'];?>" >
<input type="hidden" name="finish" value="1" >
<input type="hidden" name="txtSafeFolder" value="<? echo $_GET['id'];?>" id='txtSafeFolder'>
<input type="hidden" name="txtComic" value="<? echo $_GET['id'];?>" >
<input type="hidden" name="tempdir" value="<? echo $_POST['tempdir'];?>" >

<input type="submit" value="FINISH IMPORT"></div>
</div>

 <div id='projectimages' style="padding-left:5px;padding-right:5px;">
   <span style="font-size:14px;">  You can reorder your images by dragging into place, make sure you click HERE -> <input class="inspector" type="button" value="SAVE ORDER" onclick="junkdrawer.inspectListOrder('boxes','<? echo $_POST['tempdir'];?>','pages')"/> before deleting or continuing, or you will lose your order. <br /><br />

<div class='warning'>If your images are reversed, click here:<input class="inspector" type="button" value="REVERSE ORDER" onclick="junkdrawer.reverseListOrder('boxes','<? echo $_POST['tempdir'];?>','pages')"/></div></span>
     <div id='imagelisting'>
     <? 
	// echo 'MY THUMBS = ' . $_POST['txtThumbs'];
	 $ThumbArray = explode(',',$_POST['txtThumbs']);
	 $images_url_array = explode('||',$_POST['txtPages']);
	 
	 $Count = 0;
	 $IDString = '' ;
	 echo '<ul id="boxes">';
	foreach ($ThumbArray as $Thumb) {	
		$ThumbNameArray = explode('/',$Thumb);
		$ThumbName = $ThumbNameArray[4];
		$ImageArray = explode('/',$images_url_array[$Count]);
		$ImageName = $ImageArray[3];
				echo  "<li class=\"box\" id='box".$Count."'><span id=\"image".$Count."--".$ThumbName."--".$ImageName."\"></span><img src=\"/".$Thumb."\" vspace=\"3\" hspace=\"3\"><a href=\"javascript:void(0)\" onClick=\"deleteimage('image".$Count."');\">[delete]</a></li>";
				 if ($IDString == '') 
					$IDString =  'image'.$Count;
				else 
					$IDString .= ',image'.$Count;
		 			$Count++;
			}
	 	echo '</ul>';
	 
	 ?>
     </div>
</div>
<div style="clear: left;"><br/></div>
<input type="hidden" name="txtPages" value="<? echo $_POST['txtPages'];?>" id='txtPages'>
<input type="hidden" name="txtThumbs" value="<? echo $_POST['txtThumbs'];?>" id='txtThumbs'>
<input type="hidden" name="txtIDs" value="<? echo  $IDString;?>" id='IdString'>
<input type="hidden" name="reorder" value="1" />
</form>
<? }?>

</div>
  </div>
          
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







