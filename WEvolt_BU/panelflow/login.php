<? 
include 'includes/init.php';
require_once("includes/curl_http_client.php");
	  // print 'SESSION Email = ' . $_SESSION['email'];
$curl = &new Curl_HTTP_Client();

//pretend to be IE6 on windows
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$ReturnPage = $_GET['ref'];

if (isset($_POST['email'])) {
$post_data = array('email' => $_POST['email'], 'pass' => md5($_POST['userpass']),'action' => 'logincrypt');
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 unset($post_data);
// print 'Result = ' .$logresult;
     if ((trim($logresult) != 'Not Logged') && (trim($logresult) != 'Not Verified')) 
     {
	 $_SESSION['userid'] = trim($logresult);
     $Useremail = $_POST['email']; 
	 $_SESSION['email'] = $Useremail;
	 $_SESSION['encrypted_email'] =  md5($Useremail);
	$post_data = array('item' => 'username', 'id' => $_SESSION['userid'],'action' => 'get');
	$getUser = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 	unset($post_data);
	$_SESSION['username'] = $getUser;
	$post_data = array('item' => 'avatar', 'id' => $_SESSION['userid'],'action' => 'get');
	$getUser = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 	unset($post_data);
 	   $_SESSION['avatar'] = $getUser;
	    $userdb =  new DB($db_database,$db_host, $db_user, $db_pass);
	   $UserID = trim($logresult);
	   $Username = $_SESSION['username'];
	   $UserAvatar = $_SESSION['avatar'];
			setcookie("cookname", $_POST['email'], time()+60*60*24*100, "/");
			setcookie("cookpass", md5($_POST['userpass']), time()+60*60*24*100, "/");
			setcookie("cookuser", $_SESSION['username'], time()+60*60*24*100, "/");
			setcookie("cookavatar", $_SESSION['avatar'], time()+60*60*24*100, "/");
			setcookie("cookuid", $_SESSION['userid'], time()+60*60*24*100, "/");
			setcookie("cookmd5e", md5($Useremail), time()+60*60*24*100, "/");
	   //$UserID ='65b9eea669';
	 // $_SESSION['userid'] =  $UserID;
     	//$Useremail = 'seanmjordan@gmail.com';
	 	//$_SESSION['email'] = $Useremail;
	  //$_SESSION['encrypted_email'] =  md5($Useremail);
	 	//$_SESSION['username'] = 'SJ';
		 //$getUser = file_get_contents ('http://www.panelflow.com/processing/pfusers.php?action=get&item=avatar&id='.$_SESSION['userid']);
 	  // $_SESSION['avatar'] = $getUser;
	  // $UserAvatar = $_SESSION['avatar'];
	   
	   $query ="SELECT * from users where encryptid='$UserID'";
	   $userdb->query($query);
	 //  print $query;
	   $UserCount = $userdb->numRows();
	   if ($UserCount <1) { 
			   $query = "INSERT into users (encryptid, username, avatar) values ('$UserID', '$Username','$UserAvatar')";
			   $userdb->query($query);
		} else {
			
			  $query = "SELECT timesvisited from users where encryptid='$UserID'";
			  $TimesVisited = $userdb->queryUniqueValue($query);
			  $TimesVisited++;
			  $query = "UPDATE users set timesvisited='$TimesVisited',avatar='$UserAvatar' where encryptid='$UserID'";
			  $userdb->query($query);
		}
		 $userdb->close();
		 session_write_close();
		 
	    if ($ReturnPage == ''){
			header('Location: index.php'); 
    }  else{
		if ($ReturnPage == 'admin.php') {
			header('Location:' . $ReturnPage);
		} else {
			header('Location: /' . $ReturnPage.'/');
		}
     
	 }
 } else if (trim($logresult) == 'Not Logged') { $login_error = "Could Not Log into Account. Please check your fields and try again.";
} else if (trim($logresult) == 'Not Verified') { $login_error = "<div style='padding-left:15px; padding-right:15px;'>You have not yet verified your account, please click the link that was sent to your email that you registered with. If you have not recieved the email, please goto: <a href='http://www.panelflow.com/resend.php' target='blank'>www.panelflow.com/resend.php</a></div>";
} 
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK href="http://www.panelflow.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://www.panelflow.com/scripts/swfobject.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - USER LOGIN</title>
</head>

<body>
<?php include 'includes/header.php'; ?>

<?php 

//echo $login_error;
include 'includes/login_form.inc.php';

?>
<?php include 'includes/footer.php'; ?>