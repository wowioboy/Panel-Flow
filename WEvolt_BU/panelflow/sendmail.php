<?
include_once("includes/init.php");
//include_once("includes/comic_functions.php"); 
$ComicID = $_GET['comicid'];
$CreatorTarget = $_GET['creator'];
$aboutDB = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "SELECT c.SafeFolder, c.title, c.CreatorID,cs.CreatorOne, cs.CreatorTwo,cs.CreatorThree, cr.Email as Email
		 from creators as cr
		 join comics as c on cr.ComicID=c.comiccrypt
		 join comic_settings as cs on cr.ComicID=cs.ComicID
		
         where c.SafeFolder ='$ComicID'";
$CreatorArray = $aboutDB->queryUniqueObject($query);

	    
		$ComicTitle = $CreatorArray->title;
		
		if ($CreatorTarget == '') 
			$CreatorEmail = $CreatorArray->Email;
	 	else if ($CreatorTarget == 1) 
			$CreatorEmail = $CreatorArray->CreatorOne;
		else if ($CreatorTarget == 2) 
			$CreatorEmail = $CreatorArray->CreatorTwo;
		else if ($CreatorTarget == 3) 
			$CreatorEmail = $CreatorArray->CreatorThree;
		else 
			$CreatorEmail = $CreatorArray->Email;
		
		//print $CreatorArray->Email;
		//print 'EMAIL = ' . $CreatorEmail;
//print 'EMComicTitleAIL = ' . $ComicTitle ;
	 
if(!empty($_POST['sender_mail']) || !empty($_POST['sender_message']) || !empty($_POST['sender_subject']) || !empty($_POST['sender_name']))
{

	$to = $CreatorEmail;
	$subject = $_POST['sender_subject'];
	$body = $_POST['sender_message'];
	$body .= "\n\n------CONTACT FROM YOUR PANEL FLOW COMIC ".$ComicTitle."----\n\n\n";
	$body .= "Mail sent by: " . $_POST['sender_name'] . " <" . $_POST['sender_mail']  . ">\n";
	$body .= "IP ADDRESS: " . $_SERVER['REMOTE_ADDR']. "\n";
	$header = "From: " . $_POST['sender_name'] . " <" . $_POST['sender_mail'] . ">\n";
	$header .= "Reply-To: " . $_POST['sender_name'] . " <" . $_POST['sender_mail'] . ">\n";
	$header .= "X-Mailer: PHP/" . phpversion() . "\n";
	$header .= "X-Priority: 1";
	
	if(@mail($to, $subject, $body, $header))
	{
		echo "output=sent";
		//mail('matt@outlandentertainment.com', $subject, $body, $header);
	} else {
		echo "output=send error";
	}
} else {
	echo "output=no post";
}
?>