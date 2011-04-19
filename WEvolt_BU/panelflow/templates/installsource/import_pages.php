<? 
include_once("includes/comic_init.php"); 
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/includes/image_resizer.php';	
$AdminID = $_GET['id'];
$Image = $_GET['image'];
$ImageArray = explode('/',$Image);
$Filename = $ImageArray[3];
$Today = date('m-d-Y');

if (($AdminID = $CreatorID) || ($AdminID = $RealCreatorID)) {
$PageDB = new DB($db_database,$db_host, $db_user, $db_pass);

$randName = md5(rand() * time());

$FilenameArray = explode('.',$Filename);
$FileNameNoExt = $FilenameArray[0];
$ext = $FilenameArray[1];
$filePath = 'images/pages/'.$randName.'.'.$ext;
$Finalimage = $filePath;
$Filename = $randName .'.'.$ext;
$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file');
$fp  = fopen($Finalimage, 'w+') or die('Could not create the file');
fputs($fp, $gif) or die('Could not write to the file');
fclose($fp);
chmod($Finalimage,0777);



//print 'MY FILE NAME = ' . $Finalimage."<br/>";
$IphoneSmImage = 'iphone/images/pages/320/'.$randName.'.'.$ext;
$IphoneLgImage = 'iphone/images/pages/480/'.$randName.'.'.$ext;
list($width,$height)=getimagesize($Finalimage);
$ImageDimensions = $width.'x'.$height;
//Create Small Iphone Page
$convertString = "convert $Finalimage -resize 320 $IphoneSmImage";
exec($convertString);
//Create Large Iphone Page
$convertString = "convert $Finalimage -resize 480 $IphoneLgImage";
exec($convertString);

$image = new imageResizer($Finalimage);
$Thumbsm = "images/pages/thumbs/".$randName . '_sm.' . $ext;
$Thumbmd = "images/pages/thumbs/".$randName . '_md.' . $ext;
$Thumblg = "images/pages/largethumbs/".$randName . '.' . $ext;


$image->resize(110, 70, 110, 70);
$image->save($Thumbsm, JPG);
chmod($Thumbsm,0777);

$image->resize(150, 200, 150, 200);
$image->save($Thumbmd, JPG);
chmod($Thumbmd,0777);

$convertString = "convert $Finalimage -resize 480 -quality 60 $Thumblg";
exec($convertString);
chmod($Thumblg,0777);

$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID')";
$NewPosition = $PageDB->queryUniqueValue($query);
$NewPosition++;
$Title = 'Page '.$NewPosition;
$query = "INSERT into comic_pages(ComicID, Title, Comment, Image, ImageDimensions, Datelive, ThumbSm, ThumbMd, ThumbLg, Chapter, Episode, Filename, Position, UploadedBy) values ('$ComicID','$Title', '$Comment','$Filename','$ImageDimensions', '$Today','".$ComicFolder."/".$Thumbsm."','".$ComicFolder."/".$Thumbmd."','".$ComicFolder."/".$Thumblg."',0,0,'$Filename',$NewPosition,'$AdminID')";
$PageDB->query($query);

$query ="SELECT pages from comics where comiccrypt='$ComicID'";
$NumPages = $PageDB->queryUniqueValue($query);

if (($NumPages == 0) ||($NumPages < 0)) {
	$NumPages = 1;
} else {
	$NumPages++;
} 
$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
$PageDB->query($query);

$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and Position='$NewPosition'";
$PageID = $PageDB->queryUniqueValue($query);
$Encryptid = substr(md5($PageID), 0, 8).dechex($PageID);
$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
$PageDB->query($query);

$PageDB->close();

echo 'Finished';
} else {
echo 'Can\'t Complete Request';

} 
?>