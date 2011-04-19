<?  

// EDIT THE COLORS BY CHANGING THE VALUES BELOW
$BackgroundColor = '#FF9900';
$BorderColor = '#000000';

include $PFDIRECTORY.'/includes/db.class.php'; 
include $PFDIRECTORY.'/includes/config.php';
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
$PFDIRECTORY = $config['pathtopf'];
$randomDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = 'select * from comics order by rand()'; 
$RandomComic = $randomDB->queryUniqueObject($query);
$UpdateDay = substr($RandomComic->updated, 5, 2); 
$UpdateMonth = substr($RandomComic->updated, 8, 2); 
$UpdateYear = substr($RandomComic->updated, 0, 4);
$Updated = $UpdateDay.".".$UpdateMonth.".".$UpdateYear;
$comicString = "<table width='100'><tr><td valign='top' style='background-color:".$BackgroundColor.";'><div align='center'><div style='font-size:12px; padding:2px;'>".stripslashes($RandomComic->title)."</div><a href='".$RandomComic->url."'><img src='http://".$RandomComic->thumb."' border='2' alt='LINK' style='border-color:".$BorderColor.";'></a><div style='font-size:10px;'>updated: <b>".$Updated."</b></div>READ IT NOW!</div></td></tr></table>";
$randomDB->close();
echo $comicString;
?> 