<?php 
include 'includes/init.php';
include_once(CLASSES.'/site.php');
include_once(CLASSES.'/tutorial.php');
if ($_GET['tid'] == '')
	$TID = 1;
else 
	$TID = $_GET['tid'];
$Tutorial = new tutorial($TID);

if ($_GET['tid'] != '')
	$PageTitle .= $Tutorial->get_title();
else 
	$PageTitle .= 'tutorials';
 
if ($_GET['step'] != '')
	$PageTitle .= ' - Step '. $_GET['step'];
	 
$TrackPage = 1;

$Site = new site();

include_once('includes/pagetop_inc.php');
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
         <div style="padding:10px;">
          <div class="spacer"></div>

          		<? if ($TID == '') 
					$Tutotial->getTutorials();
				else 
					$Tutorial->buildStep($_GET['step']);?>
					

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


<?php include 'includes/pagefooter_inc.php';

?>


