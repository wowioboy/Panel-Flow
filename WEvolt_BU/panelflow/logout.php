<?php 
session_start(); 
session_unset();
session_destroy();
	setcookie("cookname", "", time()-60*60*24*100, "/");
			setcookie("cookpass", "", time()-60*60*24*100, "/");
			setcookie("cookuser", "", time()+60*60*24*100, "/");
			setcookie("cookavatar", "", time()+60*60*24*100, "/");
			setcookie("cookuid", "", time()+60*60*24*100, "/");
			setcookie("seccode", "", time()+60*60*24*100, "/");
			setcookie("cookmd5e","", time()+60*60*24*100, "/");
header('Location: /index.php'); 	 
?>