<? 
require_once('includes/init.php');
$TrackPage = 1;
$PageTitle .= 'share subscription'; 
 
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

	$query = "SELECT * from pf_subscriptions where UserID='".$_SESSION['userid']."' and (SubscriptionType ='hosted' or SubscriptionType ='hosted_no_ads' or SubscriptionType ='fan')";
	$SubArray = $InitDB->queryUniqueObject($query);
	if ($SubArray->ID != '') {
			$SubType = $SubArray->SubscriptionType;
			$UserID = $SubArray->UserID;
			$query = "SELECT * from users where encryptid='$UserID'"; 
			$UserArray = $InitDB->queryUniqueObject($query);
			
			if ($_GET['p'] != '') {
				$query = "SELECT ProjectID, title, thumb from projects where SafeFolder='".$_GET['p']."'"; 
				$ProjectArray = $InitDB->queryUniqueObject($query);
			}
			
		
			//$query = "UPDATE pf_subscriptions set Status='active' where ID='".$SubArray->ID."'";
			//$InitDB->execute($query);
			
			//$query = "UPDATE users set HostedAccount='1' where encryptid='".$_SESSION['userid']."'";
			//$InitDB->execute($query);
			//$ShowShares = 0;
		
			$query = "SELECT count(*) from subscription_shares where user_id='".$_SESSION['userid']."'";
			$Found = $InitDB->queryUniqueValue($query);
			$ShowShares = 1;
			
			
			
			
			/*
			$to = $_SESSION['email'];
			$SellerEmail = 'info@wevolt.com';
			
			$header = "From: NO-REPLY@wevolt.com  <NO-REPLY@wevolt.com >\n";
			$header .= "Reply-To: NO-REPLY@wevolt.com <NO-REPLY@wevolt.com>\n";
			$header .= "X-Mailer: PHP/" . phpversion() . "\n";
			$header .= "X-Priority: 1";
				
			$subject = "Your Pro Subscription is now active!";
			$SellerSubject ="A ".$SubType." subscription has processed";
			$Sellerbody = "A user has paid for a hosted subscription at WEvolt. No further action is needed.";
			$body = "Your Pro WEvolt subscription is now active. \n\nAny questions or concerns, you can send an email to: info@wevolt.com.";
			
			$Server = substr($_SERVER['SERVER_NAME'],4,strlen($_SERVER['SERVER_NAME'])-1);
			mail($to, $subject, $body, $header);
			mail($SellerEmail, $SellerSubject, $Sellerbody, $header); 
			include_once($_SERVER['DOCUMENT_ROOT'].'/models/Users.php');
			$XPMaker = new Users();
			$XPMaker->addxp($InitDB, $_SESSION['userid'], 2600);
			$query = "INSERT into suprise_codes_redeem (Code, UserID) values ('register_2600', '$UserID')"; 
			$InitDB->execute($query);	*/
		}

?>
<script type="text/javascript">
function do_search(sortvalue) {
	var Keywords = document.getElementById('keywords').value;
	var CatID = document.getElementById('txtCat').value;
	document.searchForm.submit();
}
</script>

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
         <table cellspacing="0" cellpadding="0" width="<? echo $SiteTemplateWidth;?>">
             <tr>
               
                        
                <td valign="top" style="padding-left:10px;padding-top:20px;">

					   <div align="center">
                        <div class="spacer"></div>
            <img src="http://www.wevolt.com/images/supporting_creators.jpg" />
     <div class="spacer"></div>
                        <img src="http://www.wevolt.com/images/welcome_pro.png" />
              <div class="spacer"></div>
        



<iframe src="/connectors/subscription_share.php?p=<? echo $_GET['p'];?>&avail=<? echo ($Found-2);?>" scrolling="no" allowtransparency="true" frameborder="no" style="width:800px; height:500px;" /></iframe>


</div>
					
		 <div class="spacer"></div>			
				
 </div>
                       
                </td>
            
            </tr>
         </table>       
 

	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>

</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>


