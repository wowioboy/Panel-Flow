<?
include_once("includes/init.php");
//include_once("includes/comic_functions.php"); 
$ComicID = $_GET['comicid'];
$aboutDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT * from creators where ComicID ='$ComicID'";
$aboutDB->query($query);
	  while ($line = $aboutDB->fetchNextObject()) {  
		$Creator = $line->realname;
	 }
	 
$query = "select * from comics where comiccrypt = '$ComicID'";
$aboutDB->query($query);
while ($setting = $aboutDB->fetchNextObject()) { 
	$ComicTitle = $setting->title;
}
$aboutDB->close();

if(!empty($HTTP_POST_VARS['sender_mail']) || !empty($HTTP_POST_VARS['sender_message']) || !empty($HTTP_POST_VARS['sender_subject']) || !empty($HTTP_POST_VARS['sender_name']))
{

$to = $AdminEmail;
	$subject = stripslashes($HTTP_POST_VARS['sender_subject']);
	$body = stripslashes($HTTP_POST_VARS['sender_message']);
	$body .= "\n\n------CONTACT FROM YOUR PANEL FLOW COMIC ".$ComicTitle."----\n";
	$body .= "Mail sent by: " . $HTTP_POST_VARS['sender_name'] . " <" . $HTTP_POST_VARS['sender_mail']  . ">\n";
	$body .= "IP ADDRESS: " . $_SERVER['REMOTE_ADDR']. "\n";
	$header = "From: " . $HTTP_POST_VARS['sender_name'] . " <" . $HTTP_POST_VARS['sender_mail'] . ">\n";
	$header .= "Reply-To: " . $HTTP_POST_VARS['sender_name'] . " <" . $HTTP_POST_VARS['sender_mail'] . ">\n";
	$header .= "X-Mailer: PHP/" . phpversion() . "\n";
	$header .= "X-Priority: 1";
	if(@mail($to, $subject, $body, $header))
	{
		echo "output=sent";
	} else {
		echo "output=error";
	}
} else {
	echo "output=error";
}
?>