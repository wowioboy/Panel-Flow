<? 
include_once( $_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/facebook_config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/facebook-platform/php/facebook.php');
global $api_key,$secret;
$fb=new Facebook($api_key,$secret);
 try {   
         $fb_user=$fb->get_loggedin_user();
    }
    catch (Exception $e) {
     
    }   


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
 <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script type="text/javascript"> 		
function initFB() {
FB.init("<? echo $api_key;?>", "/channel/xd_receiver.htm", {"ifUserConnected" : update_user_box});
}


function update_user_box() { 
window.location.href='/connectors/facebook_auth.php?r=<? echo urlencode($_GET['r']);?>&form=<? echo $Form;?>';

//var user_box = document.getElementById("user"); 
// add in some XFBML. note that we set useyou=false so it doesn't display "you" 
//attach_file('http://www.wevolt.com/connectors/facebook_auth.php');
//user_box.innerHTML = "<span>" + "<fb:profile-pic uid='loggedinuser' facebook-logo='true'></fb:profile-pic><br/>" + "<b>SUCCESS!</b> <br/>You are signed in with your Facebook account. You can now sync or import your Facebook profile with W3VOLT!<br/><br/>" + "</span><a href=\"/facebook/faceimport.php?a=sync\">CLICK HERE TO SYNC YOUR PROFLILE</a><br/>(this will replace all profile information in your W3VOLT profile with your Facebook info)<br/><br/><a href=\"/facebook/faceimport.php?a=import\">CLICK HERE TO IMPORT YOUR PROFLILE </a><br/>(this will append your Facebook information to the end of any current profile information in your W3VOLT profile)"; 
// because this is XFBML, we need to tell Facebook to re-process the document 
//FB.XFBML.Host.parseDomTree(); 
 //document.getElementById("status_perm").style.display=''; 
} 

 </script>
<style type="text/css">
body,html {
margin:0px;
padding:0px;
}

</style>
</head>
<body onload="initFB();">
<div style="background-image:url(http://www.wevolt.com/images/login_bg.jpg); width:314px; height:396px; padding:3px;">

<div id="login_div" align="center">
<div id="user" align="center" style="padding-top:15px;">
<img src="http://www.wevolt.com/images/login_with_logo.png" /><br />

<? if ($Form == 'page') {?>
<form action="http://www.wevolt.com/connectors/login_auth.php" method="post" style="padding:0px;">
<? } else {?>
<form action="http://www.wevolt.com/connectors/login_auth_frame.php" method="post" style="padding:0px;">
<? }?>
<table width="75%"><tr><td class="sender_name" width="75" align="right"  style="font-size:14px;">Email:</td><td style="padding:3px;" align="left">
<input type="text" value="EMAIL" name="email" style="width:125px;" onfocus="doClear(this);" onblur="setDefault(this);"/></td>
</tr>
<tr>
<td class="sender_name" width="75" align="right" style="font-size:14px;">Password:</td><td style="padding:3px;" align="left">
<input type="password" name="userpass" value="PASSWORD" style="width:125px;" onfocus="doClear(this);" onblur="setDefault(this);"/></td></tr>
<tr>
<td class="messageinfo_white" width="75" align="right" style="font-size:14px;"></td><td style="padding:3px;" align="left"><input type="image" src="http://www.wevolt.com/images/login_btn_yellow.png" style="border:none;" /></td></tr>
</table>
Forgot password? <a href="<? if ($_GET['f'] != 'iframe') {?>http://www.wevolt.com/forgot.php<? } else {?>#<? }?>" <? if ($_GET['f'] == 'iframe') {?>onClick="parent.window.location.href='http://www.wevolt.com/forgot.php';"<? }?>>Click here</a>
<input type="hidden" value="<? echo $_GET['r'];?>" name="refurl">
<input type="hidden" name="from" value="<? echo $_GET['f'];?>">
</form>
<div style="height:10px;"></div>

<div class="messageinfo" align="center" style="padding-left:15px;">
<div style="background-image:url(http://www.wevolt.com/images/create_free.png); width:278px;height:75px;" align="center">
<div style="height:40px;"></div>
 
<a href="<? if ($_GET['f'] != 'iframe') {?>http://www.wevolt.com/register.php<? } else {?>#<? }?>" <? if ($_GET['f'] == 'iframe') {?>onClick="parent.window.location.href='http://www.wevolt.com/register.php';"<? }?>><img src="http://www.wevolt.com/images/create_blue_button.png"  class="navbuttons"/></a>
 
 </div> 


<div style="height:10px;"></div>
<div style="background-image:url(http://www.wevolt.com/images/fb_bg_box.png); width:278px;height:59px;" align="center">
<div style="height:25px;"></div>

 <fb:login-button onlogin="update_user_box();"></fb:login-button> 
 </div> 
</div> 

</div>
