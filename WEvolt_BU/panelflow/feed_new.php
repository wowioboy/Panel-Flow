<?php
include 'includes/db.class.php'; 
include 'includes/config.php';
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$RSSID = $_GET['feed'];
$db = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics as c
		  join creators as cr on c.comiccrypt=cr.ComicID
		  join comic_settings as cs on c.comiccrypt=cs.ComicID
		  where c.SafeFolder='$RSSID'";
$RSSSettings = $db->queryUniqueObject($query);

	
	$ComicTitle = $RSSSettings->title;
	$Creator = $RSSSettings->realname;
	$ComicID = $RSSSettings->comiccrypt;

		$query = "select * from comic_pages where PageType='pages' and ComicID='$ComicID' order by Position DESC";

	$TotalPages = 0;
	$db->query($query);
	$now = date("D, d M Y H:i:s T");
	$CurrentDate= date('D M j'); 
	$CurrentDay = date('d');
	$CurrentMonth = date('m');
	$CurrentYear = date('Y');
	if (substr($RSSSettings->thumb,0,7) != 'http://')
		$Thumb = 'http://'.$RSSSettings->thumb;
	else 
		$Thumb = $RSSSettings->thumb;
		
		
		
	$output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <rss xmlns:atom=\"http://www.w3.org/2005/Atom\" version=\"2.0\">


			<channel>
                    <title>".$ComicTitle."</title>
                    <link>".$_SERVER['SERVER_NAME']."/".$PFDIRECTORY."/rss.php?feed=".$RSSID."</link>
                    <description>".htmlentities($RSSSettings->synopsis)."</description>
                    <language>en-us</language>
                    <generator>Feeder 2.0.4(1155) http://reinventedsoftware.com/feeder/</generator>
        			<docs>http://blogs.law.harvard.edu/tech/rss</docs>

					<copyright>".htmlentities($RSSSettings->Copyright)."</copyright>
                    <pubDate>$now</pubDate>
                    <lastBuildDate>$now</lastBuildDate>
                    <atom:link href=\"http://".$_SERVER['SERVER_NAME']."/".$PFDIRECTORY."/feed.php?feed=".$RSSID."\" rel=\"self\" type=\"application/rss+xml\"/>
					<image>
						<url>".$Thumb."</url>
      					<title>".$ComicTitle."</title>
      					<link>http://".$_SERVER['SERVER_NAME']."/".$RSSID."/</link>
						<description>".htmlentities($RSSSettings->synopsis)."</description>
					</image>

					
            ";
            
	while ($line = $db->fetchNextObject()) { 
			$Title = $line->Title;
			$PageTitle = $Comment;
			$PublishDate = 	$line->Datelive;
			$Position = $line->Position;
			$idSafe =0;
 			$Date = $line->datelive;
			$PageDay = substr($PublishDate, 3, 2); 
			$PageMonth = substr($PublishDate, 0, 2); 
			$PageYear = substr($PublishDate, 6, 4);
			if ($PageYear<$CurrentYear) {
							//print "SAFE ID = " .$SafeID."<br/>";
				$idSafe = 1; 
				$TotalPages++;
		   	} else if ($PageYear == $CurrentYear) {
						if ($PageMonth<$CurrentMonth) {
									//print "SAFE ID = " .$SafeID."<br/>"; 
							$idSafe = 1; 
							 $TotalPages++;
						   } else if ($PageMonth == $CurrentMonth) {
									if ($PageDay<=$CurrentDay) {
											//print "SAFE ID = " .$SafeID."<br/>"; 
										$idSafe = 1; 
										$TotalPages++;
			        				} // End If
						   	} // End PageMonth
		   	}
				//print "MY IDSAFE = " . $idSafe."<br/>";
			$PagePath = '/comics/'.substr($RSSID,0,1).'/'.$RSSID.'/images/pages/'.$line->Image;
			
			if ($idSafe == 1) {
				$output .= "<item>
				<title>".htmlentities($line->Title)." </title>
				<description>$PublishDate&lt;br/&gt;&lt;b&gt;";
				$output .= "<![CDATA[<img src=\"http://".$_SERVER['SERVER_NAME'].$PagePath."\">]]>&lt;/b&gt; &lt;br/&gt;";
				if ($line->Comment != '')
					$output .= "Author Comment:&lt;/b&gt; &lt;br/&gt;".htmlentities($line->Comment);
				
				$output .= "</description>
				<link>http://".htmlentities($_SERVER['SERVER_NAME']."/".$RSSID."/page/".$Position)."/</link>
           		<pubDate>".$PublishDate."</pubDate>
            	</item>";
			}
	}

$output .= "</channel></rss>";
header("Content-Type: application/rss+xml");
echo $output;
?>
