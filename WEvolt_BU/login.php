<?php 

include 'includes/init.php';

$Pass = $_POST['userpass'];
$Ref = $_GET['ref'];
if (isset($_POST['email'])) { 
$logresult = file_get_contents ('https://www.wevolt.com/processing/pfusers.php?action=logincrypt&email='.$_POST['email'].'&pass='.md5($Pass));
     if ((trim($logresult) != 'Not Logged') && (trim($logresult) != 'Not Verified'))
     {
	// session_start();
	// print "MY LOG RESULT = ". $logresult."<br/>";
	$NOW = date('Y-m-d h:m:s');
	$query = "UPDATE users set LastLogin = '$NOW' where encryptid='".trim($logresult)."'";
	$InitDB->execute($query);
	
	 $_SESSION['userid'] = trim($logresult);
     $Useremail = $_POST['email']; 
	 $_SESSION['email'] = $Useremail;
	 $_SESSION['lastlogin'] = $NOW;
	 $_SESSION['encrypted_email'] =  md5($Useremail);
	 	 
$getUser = file_get_contents ('https://www.wevolt.com/processing/pfusers.php?action=get&item=username&id='.trim($_SESSION['userid']));

$_SESSION['username'] = trim($getUser);
$getUser = file_get_contents ('https://www.wevolt.com/processing/pfusers.php?action=get&item=avatar&id='.trim($_SESSION['userid']));
 	   $_SESSION['avatar'] = $getUser;
	   if($_POST['txtRemember'] == 1){
			setcookie("cookname", $_SESSION['email'], time()+60*60*24*100, "/");
			setcookie("cookpass", md5($Pass), time()+60*60*24*100, "/");
		}
	    // $_SESSION['username'] = 'rbr';
	    // $_SESSION['avatar'] = 'http://www.panelflow.com/users/rbr/avatars/rbr.jpg';
	    // $_SESSION['email'] = 'shakawhenthewallsfell@yahoo.com';
		// $_SESSION['userid'] = '38b3eff865';
		// $_SESSION['encrypted_email'] =  md5($_SESSION['email']);
		 session_write_close();
		  
		 $query = "SELECT ShowWelcome from users_settings where UserID='".trim($logresult)."'";
	     $ShowWelcome = $InitDB->queryUniqueValue($query);
		 

	   		if (($ShowWelcome == 1) || ($ShowWelcome == ''))	
				header("Location:http://users.wevolt.com/welcome.php"); 
			else	
	   			header("Location:http://users.wevolt.com/myvolt/".trim($_SESSION['username'])."/"); 

	   	exit();  

     } else if (trim($logresult) == 'Not Verified'){     //$myUsername = 'John';
	 
	   $login_error = "Your account is not yet Verified. Please click the link sent to the email you registered with. If you did not recieve your email, please click <a href='resend.php'>HERE</a>";
		
     } else if ($logresult == 'Not Logged'){     //$myUsername = 'John';
	 
	   $login_error = "Could Not Log into Account. Please check your fields and try again.";
	 	  
     } else {
	 $login_error = "There was an error logging into your account. Please check your fields and try again.";
	 }
}
$PageTitle .= 'login';

if ($_SESSION['userid'] != '') 
	header("Location:http://users.wevolt.com/".trim($_SESSION['username'])."/"); 
?>

<?php require_once('includes/pagetop_inc.php'); ?>



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
    
   <div style="width:<? echo $SiteTemplateWidth;?>px;">
 <div class="spacer"></div>
    <div class="messageinfo_warning">
    <?  if ($_GET['error'] == 'not_verified'){  ?>
      <div class="spacer"></div>
Sorry we could not log you in because your account has not been verified.
  <div class="spacer"></div>
<? } else if ($_GET['error'] == 'not_logged'){  ?>
  <div class="spacer"></div>
Sorry we could not log you in because of an error, please check your fields and try again.
  <div class="spacer"></div>
<? }?>
</div>
    <? $Form = 'page';
    include 'connectors/login_form.php';?>
 </div>

	</td>
  </tr>
 
</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>



