<? 
require_once('includes/init.php');
$PageTitle .= 'about';
$TrackPage = 1;
$NoBackground = 1;

require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

?>
<div class="spacer"></div>
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
     
     <div style="padding:10px;" ><img src="http://www.wevolt.com/images/wevolt_about.png" />
        <div class="spacer"></div> <div class="spacer"></div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.wevolt.com/tutorial/?tid=1&step=1"><img src="http://www.wevolt.com/images/quick_tour.png" border="0" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.wevolt.com/register.php"><img src="http://www.wevolt.com/images/sc_sign_up.png" border="0" /></a><div class="spacer"></div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.wevolt.com/origin.php"><img src="http://www.wevolt.com/images/origin_story_btn.png" border="0" /></a></div> 

	</td>
  </tr>

</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>




