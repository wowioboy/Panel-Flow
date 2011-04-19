<? 
require_once('includes/init.php');
$ShowForm = 1;

//SUPRISE CODE
$_SESSION['suprise_code'] ='forget_40';
$_SESSION['suprise_redirect'] =$_SESSION['refurl'];
//include 'includes/functions.php';
if (isset($_POST['email'])) { 
	$ShowForm = 0;
	$emailresult = file_get_contents ('http://www.wevolt.com/processing/pfusers.php?action=resend&email='.$_POST['email']);
	//print "MY LOG RESULT = ". $emailresult."<br/>";
     if (trim($emailresult) == 'Sent') {
			$Message =  "An New email has been sent to your account with the authentication link.";
	     // print "MY LOG RESULT = ". $logresult."<br/>";
	 
     } else if (trim($emailresult) == 'Verified' ) {
	 	$Message =  "Your account has already been verified, there is no need to do it again. ";
	 } else {     //$myUsername = 'John';
		 $Message = "That email is not in our system. Please try again.";
		 $ShowForm = 1;
	}
}
	$PageTitle .= 'resend verification';

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
        <div class="messageinfo" style="padding-left:40px;" align="center">
        <div align="center">

     <div class="spacer"></div>
        <div class="spacer"></div>Need us to resend your account verification?<div class="spacer"></div>

That's ok, we lose stuff all the time too... I mean, misplace stuff.&nbsp;&nbsp;<a href="http://www.wevolt.com/suprise_me.php"><span style="font-size:10px; font-style:italic; color:#0099FF;">well, Jason does anyway.</span></a><div class="spacer"></div>

So just enter the email you registered with below:<div class="spacer"></div>


<form action="/resend.php" method="post">
 <div class="spacer"></div>


 <? echo $Message;?>

 <? if ($ShowForm == 1) {?>
&nbsp;&nbsp;&nbsp;<strong>EMAIL: </strong><input type="text" size="50" maxlength="100" name="email"
<?php if (isset($_POST['email'])) { ?> value="<?php echo $_POST['email']; ?>" <?php } ?>/><div class="spacer"></div>
 <? }?>
       
       
    <? if ($ShowForm == 1) {?>
   <div class="spacer"></div> <input type="image" name="submit" src="http://www.wevolt.com/images/resend_btn.png" style="cursor:pointer; background:none; border:none;"/>
    <? }?>

</form>
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




