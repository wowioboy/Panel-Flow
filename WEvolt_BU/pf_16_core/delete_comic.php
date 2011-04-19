<?php 
include 'includes/init.php';
require_once("includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
 
 
include("classes/class_dirtool.php");
if (isset($_POST['txtComic'])) {
	$ComicID = $_POST['txtComic'];
}

$ComicDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query ="SELECT * from comics where comiccrypt ='$ComicID'";
//print $query;
$ComicArray = $ComicDB->queryUniqueOBject($query);
$ComicCover = $ComicArray->cover;
$AdminUser = $ComicArray->userid;
$Title = $ComicArray->title;

//print 'COMIC ID  ' . $ComicID;
if ($_SESSION['userid'] != $AdminUser) {
header("location:/cms/admin/");
}


if (isset($_POST['deleteconfirm'])) {
if ($_POST['btnsubmit'] == 'YES') {
	$query ="DELETE from comics where comiccrypt ='$ComicID'";
	$post_data = array('email' => $_SESSION['email'], 'comicid' => $_GET['comicid'],'userid'=>$_SESSION['userid']);
	$result = $curl->send_post_data("https://www.panelflow.com/processing/deletecomic_post.php", $post_data);
 	unset($post_data);
 
//$profileresult = file_get_contents ('https://www.panelflow.com/processing/deletecomic.php?email='.$_SESSION['email'].'&userid='.$_SESSION['userid'].'&comic='.$ComicID);
$ComicDB->query($query);
} 
$ComicDB ->close();
header("location:/cms/admin/");
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
<title>PANEL FLOW - DELETE A COMIC </title>
</head>
<body>
<?php include 'includes/header.php';?>
<div align="center">ARE YOU SURE YOU WANT TO DELETE THIS COMIC?<br />

<? echo $Title;?><br />

<img src="<? echo $ComicCover;?>" border="2" style="border:#000000 2px solid;" vspace="4"/><div class="spacer"></div><form method="post" action="/cms/delete/<? echo $_GET['id'];?>/"><input type="hidden" name='deleteconfirm' value="1" /><input type="hidden" name='txtComic' value="<? echo $ComicID;?>" /><input type="submit" value="YES" name='btnsubmit' style="background-color:#FF0000;"/>&nbsp;&nbsp;<input type="submit" name='btnsubmit' value="CANCEL" /></form></div>
<? include 'includes/footer.php';?>

</body>
</html>
