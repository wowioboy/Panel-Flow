<? 
require_once('includes/init.php');

	$PageTitle .= ' - 404 PAGE NOT FOUND';

 $DB = new DB();
include 'includes/dbconfig.php';
//$path = trim(str_replace("/", " ", $_SERVER[REQUEST_URI]));

$patharray = explode("/", $_SERVER['REDIRECT_URL']);
$PathSize = sizeof($patharray);
//print 'SIZE = ' . $PathSize;
//print '1 = ' . $patharray[0]."<br/>";
//print '2 = ' . $patharray[1];
if ($PathSize == 2) {
	$CheckComic = 1;
	$Searchterm = $patharray[1];
} else {
	$CheckComic = 0;

}

if ($CheckComic == 1) {
$ComicTable ='';

 $query = "select * from $comicstable where title like '%$Searchterm%' and Published=1 and installed=1 and Hosted=1";
  $DB->query($query);
  $NumComicsResult = $DB->numRows();
  $ComicTable = "<table width='100%'><tr>";
			$counter = 0;
			while ($line = $DB->fetchNextObject()) {  
			$Results = 1;
			$UpdateDay = substr($line->PagesUpdated, 5, 2); 
			$UpdateMonth = substr($line->PagesUpdated, 8, 2); 
			$UpdateYear = substr($line->PagesUpdated, 0, 4);
			$Updated = $UpdateDay.".".$UpdateMonth.".".$UpdateYear;
 		    $fileUrl = $line->thumb;
			$comicURL = $line->url;
				
			
		
					$ComicTable .= "<td valign='top' width='150'><div align='center'><div class='comictitlelist'>".stripslashes($line->title)."</div><a href='/".$line->SafeFolder."/' >";
		    	
				$ComicTable .=  "<img src='http://www.wevolt.com".$fileUrl."' border='2' alt='LINK' style='border-color:#000000;' width='100' height='100'>";
			
			$ComicTable .=  "</a></td>"; 
			 $counter++;
 				if ($counter == 4){
 					$ComicTable .=  "</tr><tr>";
 					$counter = 0;
 				}
 			}
	//Display the full navigation in one go
	$ComicTable .=  "</tr></table>";
}
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

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
         <div class="spacer"></div>  <div class="spacer"></div>  <div class="spacer"></div>
        <div style="padding:10px;" align="center">
        <div class="spacer"></div>
        <div class="spacer"></div>
        <div class="spacer"></div>
            
        <img src="/images/bailey_sm.jpg" /> 
         <div class='contentwrapper'>
<div class="contentdiv" style="height:300px; padding-right:25px;">
<div class="spacer"></div><div class="spacer"></div>
<div style="color:#FFFFFF;"> If you're trying to reach a comic, please make sure you have the '/' at the end of the comic name and a '_' for each space in the title. <br />
<br />
For instance: www.wevolt.com/My_Comic/ </div>
<div class="spacer"></div>
<? if ($NumComicsResult > 0) {?>
Were you looking for one of these comics? <div class="spacer"></div> <? echo $ComicTable;?>
<? }?>
</div>
  </div>
        </div>
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


