<?  
include_once("includes/init.php"); 
$ComicID = $_GET['comicid'];
$GetPageDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
$ComicArray = $GetPageDB->queryUniqueObject($query);
//print $query;
$TitleList = '';
$ImageList = '';
$query = "select * from comic_pages where ComicID = '$ComicID' order by Position";
$GetPageDB->query($query);
while ($comic = $GetPageDB->fetchNextObject()) { 
if ($TitleList == '')
	$TitleList = $comic->Title;
else 
	$TitleList .= '||'.$comic->Title;
if ($ImageList == '')
	$ImageList = $_SERVER['SERVER_NAME'].'/'.$ComicArray->url.'/images/pages/'.$comic->Image;
else 
	$ImageList .= '||'.$_SERVER['SERVER_NAME'].'/'.$ComicArray->url.'/images/pages/'.$comic->Image;
}
echo $ImageList;
?>

