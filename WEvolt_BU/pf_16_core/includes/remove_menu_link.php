<?
session_start();
header( 'Content-Type: text/javascript' );
if ($MenuID == "") 
	$MenuID = $_GET['id'];
$ComicID = $_SESSION['sessionproject'];
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php';
$DB = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$query = "DELETE from menu_links where EncryptID='$MenuID' and ComicID='$ComicID'";
$DB->query($query);
$DB->close();
?>
window.document.location.href="http://www.wevolt.com/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=design&section=menu";

            
     