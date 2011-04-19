<?

function get_server() {
	$protocol = 'http';
	if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') {
		$protocol = 'https';
	}
	$host = $_SERVER['HTTP_HOST'];
	$baseUrl = $protocol . '://' . $host;
	if (substr($baseUrl, -1)=='/') {
		$baseUrl = substr($baseUrl, 0, strlen($baseUrl)-1);
	}
	return $baseUrl;
}

function verify_email($email){

    if(!preg_match('/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/',$email)){
        return false;
    } else {
        return $email;
    }
}

function SendCreatorInvitation($Email, $ComicID, $PFDIRECTORY, $db_database,$db_host, $db_user, $db_pass) {
$inviteDB = new DB($db_database,$db_host, $db_user, $db_pass);
$Server = get_server();
$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEFGHIJKLMNOPQRSTUV";
			srand((double)microtime()*1000000);
			$i = 0;
			$authode = '';
				while ($i <= 11) {

       					$num = rand() % 33;

        				$tmp = substr($chars, $num, 1);

        				$authode = $authode . $tmp;

        				$i++;
				}

			$query = "insert into creatorinvites (InviteCode, Email, ComicID) values ('$authode', '$Email','$ComicID')";
  			$inviteDB->query($query);
			$query ="SELECT * from comics where comiccrypt='$ComicID'";
	
			$CArray = $inviteDB->queryUniqueObject($query);
//Send Account Email
	$to = $Email;
	$subject = "You've Been Invited to be the Creator of " . stripslashes(trim($CArray->title));
	$body = "In order to accept this invitation, first follow the link below to register for a free account at Panel Flow. This will allow you to sign into ". stripslashes(trim($CArray->title))." at http://www.panelflow.com/ and have access to edit the comics details, update pages, authors comments and more.\n\nLINK: http://www.wevolt.com/register.php?ref=". urlencode(trim($CArray->title))."\n\nOnce you have completed your account verification and your Panel Flow account is active, simply click this link to accept this invitation.\n\nINVITATION LINK: http://www.wevolt.com/creator/invitation/".$authode."/".$Email."/";
	$inviteDB->close();
    if (mail($to, $subject, $body, "From: ".$_SESSION['email'])) {
		
		$msg ='sent';
	
  
 	} else {
			$msg ='error';
 	}
return $msg;

}

function SendPostCode($ComicID, $Code) {
global $InitDB;

			$query = "SELECT u.email as Admin ,cr.Email as Creator, c.title as Comic from projects as c
					  join creators as cr on cr.ComicID=c.comiccrypt
					  join users as u on c.userid=u.encryptid
					  where c.comiccrypt ='$ComicID'";
  					$InitDB->query($query);
			$CArray = $InitDB->queryUniqueObject($query);
//Send Account Email
	$to = $CArray->Admin;
	$subject = "Post by Email has been activated on ".$CArray->Comic;
	$body = "Below is your Email Code that you must put in the subject line on each email. Do not give this code out, only pages that come from the email registered on the project will be accepted. \n\nPlease email all your page updates to pages@wevolt.com. See below on how to format the subject line of your email \n\nYour Email Code: ".$Code."\n\nAlways put your code at the start of the subject line, further options can be used after, but the code is all you need to email a page. All options must follow the code with a || and each option must be separated by ||\n\nOptions\nPost Title\nPost Date (mm/dd/yyyy)\n\nSUBJECT LINE: ".$Code."||My Page Title||05/01/2009\n\nNow put anything you want to appear in the Author Comment section of the comic in the Email body. finally attach the images you want to post. You can post multiple pages in one email, but they will take on the same page title and posting date.\n\nIf you lose your code, it can always be found in the settings section of your project in the REvolt CMS.\n\n";
    if (mail($to, $subject, $body, "From: NO-REPLY@wevolt.com")) {
		if ($CArray->Admin != $CArray->Creator) {
		mail($CArray->Creator, $subject, $body, "From: NO-REPLY@wevolt.com");
		}
		$msg ='sent';
	
   
 	} else {
			$msg ='error';
 	}
return $msg;
$DB->close();
}

function SendPageReport($Subject,$ComicID) {
global $db_database,$db_host, $db_user, $db_pass;
$DB = new DB($db_database,$db_host, $db_user, $db_pass);

			$query = "SELECT u.email as Admin ,cr.Email as Creator, c.title as Comic from comics as c
					  join creators as cr on cr.ComicID=c.comiccrypt
					  join users as u on c.userid=u.encryptid
					  where c.comiccrypt ='$ComicID'";
  					$DB->query($query);
			$CArray = $DB->queryUniqueObject($query);
//Send Account Email
	$to = $CArray->Admin;
	$subject = "Your pages have been processed for your comic ".$CArray->Comic;
	$body = "EMAIL SUBJECT:".$Subject."\n\n Your emailed pages have been added to your comic. If you did not make this update, please inform us as info@panelflow.com\n\n";
    if (mail($to, $subject, $body, "From: NO-REPLY@wevolt.com")) {
		if ($CArray->Admin != $CArray->Creator) {
			mail($CArray->Creator, $subject, $body, "From:NO-REPLY@wevolt.com");
		}
		$msg ='sent';
	
   
 	} else {
			$msg ='error';
 	}
return $msg;
$DB->close();
}
?>
