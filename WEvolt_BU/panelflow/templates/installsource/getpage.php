<? 
$config = array();
@include 'includes/config.php';
$ComicID = $config['comicid'];
$PFDIRECTORY = $config['pathtopf'];
$SERVER = $_SERVER['SERVER_NAME'];
$result = file_get_contents('http://'.$SERVER.'/'.$PFDIRECTORY.'/getpage.php?comicid='.$ComicID);
echo $result;
?>