<? 
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_GET['c'];
$UserID = $_GET['u'];
$Image = $_GET['image'];
$PageID = $_GET['p'];

//print "MY COMIC ID + " . $ComicID."<br/>";
//print "MY UserID ID + " . $UserID."<br/>"; 
//print "MY PageID ID + " . $PageID."<br/>";
//print "MY Section ID + " . $Section."<br/>";
//print "MY Action ID + " . $Action."<br/>";
$AdminUserID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  

$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
//print $query."<br/>";
//print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
$ComicFolder = $ComicArray->url;
$CreatorID = $ComicArray->CreatorID;
$ImageArray = explode('/',$Image);
$Filename = $ImageArray[5];
$FilenameArray = explode('.',$Filename);
$ext = $FilenameArray[1];
$FileNoExt = $FilenameArray[0];
$Today = date('m-d-Y');
$ComicDir = substr(trim($ComicFolder), 0, 1);
if (($UserID = $AdminUserID) || ($UserID = $CreatorID)) {
$PageDB = new DB($db_database,$db_host, $db_user, $db_pass);

//if (($ComicFolder == '') || ($ComicFolder == '/')) {
	//$ComicFolder = '';
	//$Finalimage = '../../images/pages/'.$FileNoExt.'.'.$ext;
	//$Thumbsm = '../../images/pages/thumbs/'.$FileNoExt . '_sm.' . $ext;
	//$Thumbmd = '../../images/pages/thumbs/'.$FileNoExt . '_md.' . $ext;
	//$Thumblg = '../../images/pages/largethumbs/'.$FileNoExt . '.' . $ext;
//} else {


	$Finalimage = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.'.$ext;
	$Thumbsm = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/thumbs/'.$FileNoExt . '_sm.' . $ext;
	$Thumbmd = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/thumbs/'.$FileNoExt . '_md.' . $ext;
	$Thumblg = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/thumbs/'.$FileNoExt . '.lg' . $ext;

//	$Finalimage = '../../'.$ComicFolder.'/images/pages/'.$FileNoExt.'.'.$ext;
	//$Thumbsm = '../../'.$ComicFolder.'/images/pages/thumbs/'.$FileNoExt . '_sm.' . $ext;
	//$Thumbmd = '../../'.$ComicFolder.'/images/pages/thumbs/'.$FileNoExt . '_md.' . $ext;
	//$Thumblg = '../../'.$ComicFolder.'/images/pages/largethumbs/'.$FileNoExt . '.' . $ext;
//}
//GET PAGE	
$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file at : http://www.panelflow.com/'.trim($Image));
$fp  = fopen($Finalimage, 'w+') or die('Could not create the file');
fputs($fp, $gif) or die('Could not write to the file');
fclose($fp);
chmod($Finalimage,0777);

//GET SMALL THUMB
$gif = file_get_contents('http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_sm.' . $ext) or die('Could not grab the file at : http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_sm.' . $ext);
$fp  = fopen($Thumbsm, 'w+') or die('Could not create the file');
fputs($fp, $gif) or die('Could not write to the file');
fclose($fp);
chmod($Thumbsm,0777);

//GET MED THUMB
$gif = file_get_contents('http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_md.' . $ext) or die('Could not grab the file at : http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_md.' . $ext);
$fp  = fopen($Thumbmd, 'w+') or die('Could not create the file');
fputs($fp, $gif) or die('Could not write to the file');
fclose($fp);
chmod($Thumbmd,0777); 

//GET LARGE THUMB
$gif = file_get_contents('http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_lg.' . $ext) or die('Could not grab the file at : http://www.panelflow.com/'.$ImageArray[0].'/'.$ImageArray[1].'/'.$ImageArray[2].'/images/pages/thumbs/'.$FileNoExt . '_lg.' . $ext);
$fp  = fopen($Thumblg, 'w+') or die('Could not create the file');
fputs($fp, $gif) or die('Could not write to the file');
fclose($fp);
chmod($Thumblg,0777);

list($width,$height)=getimagesize($Finalimage);
$ImageDimensions = $width.'x'.$height;

$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='pages')";
$NewPosition = $PageDB->queryUniqueValue($query);
$NewPosition++;
$Title = 'Page '.$NewPosition;
$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, Filename, Position, UploadedBy,EncryptPageID, PageType) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Today','comics/".$ComicDir."/".$ComicFolder."/".$Thumbsm."','comics/".$ComicDir."/".$ComicFolder."/".$Thumbmd."','comics/".$ComicDir."/".$ComicFolder."/".$Thumblg."',0,0,'$Filename',$NewPosition,'$UserID','$PageID','pages')";
$PageDB->query($query);
// print $query.'<br/><br/><br/>';
$query ="SELECT pages from comics where comiccrypt='$ComicID'";
$NumPages = $PageDB->queryUniqueValue($query);
if (($NumPages == 0) ||($NumPages < 0)) {
	$NumPages = 1;
} else {
	$NumPages++;
} 
$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
$PageDB->query($query);

$PageDB->close();

echo 'Finished';
} else {
echo 'Can\'t Complete Request';

} 
?>