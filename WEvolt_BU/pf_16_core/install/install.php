<?php require("install_functions.php"); 
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 
$Version ='Pro1-5';
function db_connect($server, $username, $password, $link = 'db_link') {
	global $$link, $db_error;
	$db_error = false;
	if (!$server) {
		$db_error = 'No Server selected.';
		return false;
	}
	$$link = @mysql_connect($server, $username, $password) or $db_error = mysql_error();
	return $$link;
}
# FUNCTION TO SELECT DATABASE ACCESS
function db_select_db($database) {
	echo mysql_error();
	return mysql_select_db($database);
}
# FUNCTION TO TEST DATABASE ACCESS
function db_test_create_db_permission($database) {
	global $db_error;
	$db_created = false;
	$db_error = false;
	if (!$database) {
		$db_error = 'No Database selected.';
		return false;
	}
	if ($db_error) {
		return false;
	} else {
		if (!@db_select_db($database)) {
			$db_error = mysql_error();
			return false;
		}else {
			return true;
		}
	return true;
	}
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="http://www.panelflow.com/lib/prototype.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/lib/scriptaculous.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/lib/init_wait.js"></script>
<script type="text/javascript" src="http://www.panelflow.com/scripts/swfobject.js"></script>
<meta name="description" content="Flash Web Comic Content Management System"></meta>
<meta name="keywords" content="Webcomics, Comics, Flash"></meta>
<LINK href="http://www.panelflow.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PANEL FLOW - INSTALL </title>
</head>
<body>
<?php include 'includes/header.php';?>
<?php 
$usercreated =$_POST['usercreated']; 
$configcreated = $_POST['configcreated']; 
$keyset = $_POST['keyset']; 
if (!isset($_POST['email']) && ($usercreated != 1)) {
     // Show the form
      include 'install_user_inc.php';
	  include 'includes/footer.php';
     exit;
} else {
if ($usercreated != 1){
$post_data = array('email' => $_POST['email'], 'pass' => md5($_POST['userpass']),'action' => 'logincrypt');
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/pfusers_post.php", $post_data);
 unset($post_data);
//$logresult = file_get_contents ('http://www.panelflow.com/processing/pfusers.php?action=logincrypt&email='.$_POST['email'].'&pass='.md5($_POST['userpass']));
       if ((trim($logresult) == 'Not Logged') || (trim($logresult) == 'Not Verified'))  {
	      if (trim($logresult) == 'Not Logged') {
	     print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>There was an error logging into your account. Please check your login information and try again. If you've forgotten your Panel Flow Account information. <a href='http://www.panelflow.com/forgotaccount.php'>CLICK HERE</a></b><div class='spacer'></div> <div class='spacer'></div></div>";
		 } else if (trim($logresult)  == 'Not Verified') {
		 print  "<div style='padding-left:15px; padding-right:15px;'>You have not yet verified your account, please click the link that was sent to your email that you registered with. If you have not recieved the email, please goto: <a href='http://www.panelflow.com/resend.php' target='blank'>www.panelflow.com/resend.php</a></div>";
		 
		 }
		 include 'install_user_inc.php';
		 include 'includes/footer.php';
		 exit;
      }  else {
	        $ID = trim($logresult);
			include 'pf_key_inc.php';
			include 'includes/footer.php';
	  }// Close Login result check 

} else if ($keyset != 1){ 
$post_data = array('key' => $_POST['txtKey'], 'userid' => $_POST['id']);
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/liscense_post.php", $post_data);
 unset($post_data);
 
//$logresult = file_get_contents ('http://www.panelflow.com/processing/liscense.php?key='.$_POST['txtKey'].'&userid='.$_POST['id']);
//print 'http://www.panelflow.com/processing/liscense.php?key='.$_POST['txtKey'].'&userid='.$_POST['id'];

if (trim($logresult) == 'Verified')  {
 	include 'db_form_inc.php';
	include 'includes/footer.php';
//VERIFIED GO TO DATABASE FORM

} else if (trim($logresult) == 'Not Verified'){
 print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>There was an error verifying your Liscense Key, please check your key with the one emailed to you and try again.</div> <div class='spacer'></div></div>";
//DIDN'T WORK
include 'pf_key_inc.php';
include 'includes/footer.php';
} else if (trim($logresult) == 'Exceeded'){
 print "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>It appears that you have exceeded the number of domains licenses. If you need to purchase more liscenses, please click here <a href='http://www.panelflow.com/purchase_liscense.php' target='blank'>GET LICESNSE</a></b><div class='spacer'></div> <div class='spacer'></div></div>";
include 'includes/footer.php';
}

}else if ($configcreated != 1){

$db_error = false;
db_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass']);
if ($db_error == false) {
	if (!db_test_create_db_permission($_POST['db_database'])) {
			$error = $db_error;
	    }
} else {
  $error = $db_error;
}

if ($db_error != false) {
   echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>Could Not Connect to the Database, Please check your settings and try again!</div></b>";
		 include 'db_form_inc.php';
		 include 'includes/footer.php';
} else {
	
$connect=mysql_connect($_POST['db_host'],$_POST['db_user'],$_POST['db_pass']); 
$tableconnect = mysql_select_db($_POST['db_database']); 

$query = 'CREATE TABLE IF NOT EXISTS characters ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Name varchar(100) NOT NULL,'.
  'Hometown varchar(100) NOT NULL,'.
  'Race varchar(50) NOT NULL,'.
  'Age varchar(20) NOT NULL,'.
  'HeightFt int(11) NOT NULL,'.
  'HeightIn int(11) NOT NULL,'.
  'Weight varchar(20) NOT NULL,'.
  'Abilities longtext NOT NULL,'.
  'Description longtext NOT NULL,'.
  'Notes longtext NOT NULL,'.
  'Image varchar(100) NOT NULL,'.
  'Thumb varchar(100) NOT NULL,'.
  'PRIMARY KEY (ID))';
$result = mysql_query($query);
$query = 'CREATE TABLE IF NOT EXISTS comics ('.
  'comicid int(5) NOT NULL auto_increment,'.
 'userid varchar(100) NOT NULL default \'0\','.
  'title varchar(100) NOT NULL default \'\','.
  'genre text NOT NULL,'.
  'tags text NOT NULL,'.
  'synopsis longtext NOT NULL,'.
  'short varchar(150) NOT NULL default \'\','.
  'writer varchar(100) NOT NULL default \'\','.
  'creator varchar(100) NOT NULL default \'\','.
  'artist varchar(100) NOT NULL default \'\','.
  'colorist varchar(100) NOT NULL default \'\','.
  'letterist varchar(100) NOT NULL default \'\','.
  'url varchar(60) NOT NULL default \'\','.
  'thumb varchar(255) NOT NULL default \'\','.
  'cover varchar(255) NOT NULL default \'\','.
  'pages int(11) NOT NULL default \'0\','.
  'createdate varchar(30) NOT NULL default \'\','.
  'updated timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,'.
  'votes int(11) NOT NULL default \'0\','.
  'comiccrypt varchar(100) NOT NULL default \'\','.
  'installed int(11) NOT NULL default \'0\','.
  'hits int(11) NOT NULL default \'0\','.
  'version varchar(50) NOT NULL default \'\','.
  'Footer varchar(100) NOT NULL,'.
  'Header varchar(100) NOT NULL,'.
  'ControlBg varchar(10) NOT NULL default \'0x000000\','.
  'TitleColor varchar(10) NOT NULL default \'0xFFFFFF\','.
  'ButtonBg varchar(10) NOT NULL default \'0xFDA96D\','.
  'SiteBg varchar(10) NOT NULL default \'0xFFFFFF\','.
  'ArrowBg varchar(10) NOT NULL default \'0x000000\','.
  'Copyright varchar(100) NOT NULL,'.
  'CreatorID varchar(50) NOT NULL,'.
  'CreatorEmail varchar(100) NOT NULL,'.
  'PagesUpdated varchar(50) NOT NULL,'.
  'PRIMARY KEY  (comicid))';
$result = mysql_query($query);

$query ='CREATE TABLE IF NOT EXISTS comic_pages ('.
  'ID int(11) NOT NULL auto_increment,'.
  'EncryptPageID varchar(50) NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Title varchar(100) NOT NULL,'.
  'Comment longtext NOT NULL,'.
  'Image varchar(100) NOT NULL,'.
  'ImageDimensions varchar(20) NOT NULL,'.
  'Datelive varchar(20) NOT NULL,'.
  'ThumbSm varchar(100) NOT NULL,'.
  'ThumbMd varchar(100) NOT NULL,'.
  'ThumbLg varchar(100) NOT NULL,'.
  'Chapter int(11) NOT NULL,'.
  'Episode int(11) NOT NULL,'.
  'Filename varchar(100) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'UploadedBy varchar(50) NOT NULL,'.
  'PRIMARY KEY  (ID))';
  $result = mysql_query($query);
  
 $query = 'CREATE TABLE IF NOT EXISTS comic_settings ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Contact int(11) NOT NULL,'.
  'AllowComments int(11) NOT NULL,'.
  'ShowArchive int(11) NOT NULL,'.
  'ShowChapter int(11) NOT NULL,'.
  'ShowEpisode int(11) NOT NULL,'.
  'ShowCalendar int(11) NOT NULL,'.
  'Assistant1 varchar(50) NOT NULL,'.
  'Assistant2 varchar(50) NOT NULL,'.
  'Assistant3 varchar(50) NOT NULL,'.
  'BioSetting int(11) NOT NULL,'.
  'ProfileSync int(11) NOT NULL default \'1\','.
  'Template varchar(50) NOT NULL default \'standard\','.
  'ReaderType varchar(50) NOT NULL default \'flash\','.
  'ButtonSet int(11) NOT NULL ,'.
  'PRIMARY KEY  (ID))';
  $result = mysql_query($query);
  
  $query='CREATE TABLE IF NOT EXISTS creators ('.
  'ID int(10) NOT NULL auto_increment,'.
  'avatar text NOT NULL,'.
  'realname varchar(80) NOT NULL default \'\','.
  'location varchar(60) NOT NULL default \'\','.
  'about longtext NOT NULL,'.
  'website varchar(100) NOT NULL default \'\','.
  'music longtext NOT NULL,'.
  'books longtext NOT NULL,'.
  'hobbies longtext NOT NULL,'.
  'influences longtext NOT NULL,'.
  'credits longtext NOT NULL,'.
  'link1 text NOT NULL,'.
  'link2 text NOT NULL,'.
  'link3 text NOT NULL,'.
  'link4 text NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Email varchar(100) NOT NULL,'.
  'PRIMARY KEY  (ID))';
   $result = mysql_query($query);

$query ='CREATE TABLE IF NOT EXISTS downloads ('.
  'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(25) NOT NULL,'.
  'Name varchar(100) NOT NULL,'.
  'Description longtext NOT NULL,'.
  'DlType varchar(25) NOT NULL,'.
  'Resolution varchar(25) NOT NULL,'.
  'Image varchar(60) NOT NULL,'.
  'Thumb varchar(60) NOT NULL,'.
  'PRIMARY KEY  (ID))';
   $result = mysql_query($query);
   
  $query ='CREATE TABLE IF NOT EXISTS extracomments ('.
  'comicid varchar(50) NOT NULL default \'\','.
  'pageid varchar(50) NOT NULL default \'\','.
  'userid varchar(50) NOT NULL default \'\','.
 'comment longtext NOT NULL,'.
  'site varchar(100) NOT NULL default \'\','.
  'commentdate varchar(20) NOT NULL default \'\','.
  'creationdate timestamp NOT NULL default CURRENT_TIMESTAMP,'.
  'id int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (id))';
     $result = mysql_query($query);
	 
	$query ='CREATE TABLE IF NOT EXISTS extra_pages ('.
  'ID int(11) NOT NULL auto_increment,'.
  'EncryptPageID varchar(50) NOT NULL,'.
  'ComicID varchar(50) NOT NULL,'.
  'Title varchar(100) NOT NULL,'.
  'Comment longtext NOT NULL,'.
  'Image varchar(100) NOT NULL,'.
  'ImageDimensions varchar(20) NOT NULL,'.
  'Datelive varchar(20) NOT NULL,'.
  'ThumbSm varchar(100) NOT NULL,'.
  'ThumbMd varchar(100) NOT NULL,'.
  'ThumbLg varchar(100) NOT NULL,'.
  'Chapter int(11) NOT NULL,'.
  'Episode int(11) NOT NULL,'.
  'Filename varchar(100) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'UploadedBy varchar(50) NOT NULL,'.
  'PRIMARY KEY  (ID))';
	   $result = mysql_query($query);
	   
	    $query ='CREATE TABLE IF NOT EXISTS adspaces ('.
   'ID int(11) NOT NULL auto_increment,'.
  'ComicID varchar(50) NOT NULL,'.
  'Template varchar(50) NOT NULL,'.
  'Position int(11) NOT NULL,'.
  'Active int(11) NOT NULL default \'0\','.
  'Published int(11) NOT NULL default \'0\','.
  'AdCode longtext NOT NULL,'.
  'PRIMARY KEY  (ID))';
     $result = mysql_query($query);
	 
	 $query ='CREATE TABLE IF NOT EXISTS button_sets ('.
'ID INT NOT NULL ,'.
'ComicID VARCHAR( 20 ) NOT NULL ,'.
'Title VARCHAR( 100 ) NOT NULL ,'.
'PublicSet int(11) NOT NULL ,'.
'FirstPageImage VARCHAR( 100 ) NOT NULL ,'.
'PrevPageImage VARCHAR( 100 ) NOT NULL ,'.
'NextPageImage VARCHAR( 100 ) NOT NULL ,'.
'LastPageImage VARCHAR( 100 ) NOT NULL ,'.
'CreatorImage VARCHAR( 100 ) NOT NULL ,'.
'HomeImage VARCHAR( 100 ) NOT NULL ,'.
'ExtrasImage VARCHAR( 100 ) NOT NULL ,'.
'CharactersImage VARCHAR( 100 ) NOT NULL ,'.
'MobileImage VARCHAR( 100 ) NOT NULL ,'.
'ProductsImage VARCHAR( 100 ) NOT NULL ,'.
'DownloadsImage VARCHAR( 100 ) NOT NULL ,'.
'ArchiveImage VARCHAR( 100 ) NOT NULL ,'.
'VoteImage VARCHAR( 100 ) NOT NULL ,'.
'BlogImage VARCHAR( 100 ) NOT NULL ,'.
'PRIMARY KEY ( ID ))';
	 $result = mysql_query($query);  
	  
	   $query= 'CREATE TABLE IF NOT EXISTS links (
  ID int(11) NOT NULL auto_increment,
  ComicID varchar(50) NOT NULL,
  Title varchar(100) NOT NULL,
  Description longtext NOT NULL,
  Link varchar(100) NOT NULL,
  PRIMARY KEY  (ID))';
	     $result = mysql_query($query);
		 
		 $query ='CREATE TABLE IF NOT EXISTS pagecomments ('.
  'comicid varchar(50) NOT NULL default \'\','.
  'pageid varchar(50) NOT NULL default \'\','.
  'userid varchar(50) NOT NULL default \'\','.
 'comment longtext NOT NULL,'.
  'site varchar(100) NOT NULL default \'\','.
  'commentdate varchar(20) NOT NULL default \'\','.
  'creationdate timestamp NOT NULL default CURRENT_TIMESTAMP,'.
  'id int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (id))';
		  $result = mysql_query($query);
		  
		  $query ='CREATE TABLE IF NOT EXISTS creatorinvites ('.
  'InviteCode varchar(100) NOT NULL default \'\','.
  'Email varchar(100) NOT NULL default \'\','.
  'ComicID varchar(100) NOT NULL default \'\','.
   'ID int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (ID))';
		  $result = mysql_query($query);
		  
		   $query ='CREATE TABLE IF NOT EXISTS users ('.
  'username varchar(50) NOT NULL default \'\','.
  'avatar varchar(255) NOT NULL default \'\','.
  'encryptid varchar(50) NOT NULL default \'\','.
  'timesvisited int(11) NOT NULL default \'1\','.
  'lastvisited timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,'.
  'id int(11) NOT NULL auto_increment,'.
  'PRIMARY KEY  (id))';
		  $result = mysql_query($query);
		  
mysql_close($connect) ; 

       $file_to_write = 'tempconfig.php';
			$content = "<?php \n$";
			$content .= "email='".$_POST['email']."';\n";
			$content .= "$";
			$content .= "userid ='".$_POST['id']."';\n";
			$content .= "$";
			$content .= "db_user ='".$_POST['db_user']."';\n";
			$content .= "$";
			$content .= "db_pass ='".$_POST['db_pass']."';\n";
			$content .= "$";
			$content .= "db_database ='".$_POST['db_database']."';\n";
			$content .= "$";
			$content .= "db_host ='".$_POST['db_host']."';\n";
			$content .= "?>";
			$fp = fopen($file_to_write, 'w');
			fwrite($fp, $content);
			fclose($fp);
			$configcreated = 1;
			include 'app_form_inc.php';
		    include 'includes/footer.php';
			exit;
			
			   
	   } // end config else
	   
} else if (($configcreated == 1) && ($usercreated == 1) && ($keyset == 1)) {
   if ($_POST['appfolder'] == "") {
     // Show the form
	  echo "<div class='errormsg'><div class='spacer'></div> <div class='spacer'></div><b>You must enter the full path to the folder</div></b>";
      include 'app_form_inc.php';
	  include 'includes/footer.php';
     exit;
} else {
			include 'tempconfig.php';
	        $file_to_write = 'config.php';
			$content ="<?php \n";
			$content .="\$config['adminemail'] = '".$email."';\n";
			$content .="\$config['adminuserid'] = '".$userid."';\n";
			$content .="\$config['pathtopf'] = '".$_POST['appfolder']."';\n";
			$content .="\$config['db_user'] = '".$db_user."';\n";
			$content .="\$config['db_pass'] = '".$db_pass."';\n";
			$content .="\$config['db_database'] = '".$db_database."';\n";
			$content .="\$config['db_host'] = '".$db_host."';\n";
			$content .="\$config['liscensekey'] = '".$_POST['txtKey']."';\n";
			$content .="?>";
			$fp = fopen($file_to_write, 'w');
			fwrite($fp, $content);
			fclose($fp);
			rename($file_to_write, '../includes/config.php');
			chmod('../includes/config.php', 0644);
			@copy('htaccess','../.htaccess');
			@copy('index2.html','index.html');
			echo '<div class="errormsg"><div class="spacer"</div><h1 style="color:yello">CONGRATUALTIONS!</h1><div class="spacer"></div>INSTALLATION COMPLETE. YOU CAN NOW LOG INTO YOUR SITE AND ACCESS THE ADMIN SECTION TO START YOUR COMICS. <a href="../admin.php"> CLICK HERE </a>TO START<br></div>';
			// INSTALL APP with URL, 
			$post_data = array('key' => $_POST['txtKey'], 'userid' => $userid,'action'=>'add','domain'=>$_SERVER['SERVER_NAME'],'version'=>$Version);
//and send request to http://www.foo.com/login.php. Result page is stored in $html_data string
$logresult = $curl->send_post_data("https://www.panelflow.com/processing/liscense_post.php", $post_data);
 unset($post_data);
			//$logresult = file_get_contents ('http://www.panelflow.com/processing/liscense.php?action=add&key='.$_POST['txtKey'].'&userid='.$userid.'&domain='.$_SERVER['SERVER_NAME'].'&version='.$Version);
			include 'includes/footer.php';
} 
			
}
			
			
} // Comic Information Else 

?>

</body>
</html>
