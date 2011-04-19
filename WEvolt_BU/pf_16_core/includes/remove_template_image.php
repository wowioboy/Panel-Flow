<?php 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
//require_once("curl_http_client.php");
//require_once("create_key_func.php");
//$curl = &new Curl_HTTP_Client();
//$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
//$curl->set_user_agent($useragent);
$SkinCode = $_GET['skincode'];
$base_path = "templates/skins/".$SkinCode.'/images/';
$SkinType = $_GET['type'];
$ProjectID = $_GET['project'];
$ThemeID = $_GET['theme'];
$UserID = $_SESSION['userid'];


header( 'Content-Type: text/javascript' );
$updateDB = new DB;


if ($ProjectID == '') {
$query = "SELECT UserID from pf_themes where ID='$ThemeID'";
$OwnerID = $updateDB->queryUniqueValue($query);
}else {
$query = "SELECT p.userid, p.CreatorID, cs.CurrentTheme
  from projects as p 
  join comic_settings as cs on cs.ComicID=p.ProjectID
  where p.ProjectID='$ProjectID'";
$ProjectArray = $updateDB->queryUniqueObject($query);
$OwnerID = $ProjectArray->userid;
$CreatorID = $ProjectArray->CreatorID;
$ThemeID = $ProjectArray->CurrentTheme;
}

$query = "SELECT * from pf_themes where ID='$ThemeID'";
$ThemeArray = $updateDB->queryUniqueObject($query);
$TemplateCode = $ThemeArray->TemplateCode;

if (($OwnerID == $UserID) || ($CreatorID == $UserID))
	$Auth = 1;
else 
	$Auth = 0;

if ($Auth == 1) {
	if ($ProjectID == '') 
		$query = "UPDATE template_settings set ".$SkinType."='' where ThemeID='$ThemeID' and ProjectID='' and TemplateCode='$TemplateCode'";
	else
		$query = "UPDATE template_settings set ".$SkinType."='' where ProjectID='$ProjectID' and TemplateCode='$TemplateCode'";
 

}	
//print $query;
$updateDB->execute($query);
			$updateDB->close();
?>

document.getElementById("<? echo $SkinType;?>Div").innerHTML = 'NONE SET';
