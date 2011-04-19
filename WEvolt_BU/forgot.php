<? 
require_once('includes/init.php');

	$PageTitle .= ' - forgot password';

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
         <img src="http://www.wevolt.com/images/pass_request.jpg" />
         <div class="spacer"></div><div class="spacer"></div>
        <?php
//include 'includes/functions.php';
if (!isset($_POST['email']))
{  include 'includes/pass_form.inc.php'; } 
else
{

$emailresult = file_get_contents ('http://www.wevolt.com/processing/pfusers.php?action=resetpass&email='.$_POST['email']);
//print "MY LOG RESULT = ". $emailresult."<br/>";
     if ($emailresult != 'Not Found')
     {
	 echo "An Email has been sent to your account with your new password.<br/><br/>Once you get your new password you can reset your password in the 'SETTINGS' section of your profile";
	     // print "MY LOG RESULT = ". $logresult."<br/>";
	 
     }
     else
	 
     {     //$myUsername = 'John';

	   $found_error = "That email is not in our system. Please try again.";
	   include 'includes/pass_form.inc.php';
     }
}

?>   
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


