<?php 
include '../includes/db.class.php'; 
include '../includes/config.php';
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  

$db = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from panel_panel.comics as c
						join panel_panel.rankings as r on c.comiccrypt=r.ComicID
				        where c.installed = 1 and c.Published = 1 and c.pages>0 and c.NeedFeatured=1 ORDER BY r.ID ASC";

	$db->query($query);

	$ComicXML = '<comics>';

	while ($comic = $db->fetchNextObject()) { 
	 
	if (substr($comic->thumb,0,4) != 'http')
		 $ComicThumb = 'http://www.panelflow.com'. $comic->thumb;
	else 
	     $ComicThumb = $comic->thumb;
		 
			$ComicXML .= '<comic>';
			//$ComicXML .='<comicid>'.$comic->comiccrypt.'</comicid>';
			$ComicXML .='<title>'.addslashes($comic->title).'</title>';
			$ComicXML .='<writer>'.addslashes($comic->writer).'</writer>';
			$ComicXML .='<thumbnail>'.$ComicThumb.'</thumbnail>';
			$ComicXML .='<comiclink>'.$comic->SafeFolder.'</comiclink>';
			$ComicXML .= '</comic>';	
					
		} 
$ComicXML .= '</comics>';
$db->close();
echo '&contentxml='.$ComicXML;
?>


