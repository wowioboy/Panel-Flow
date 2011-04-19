<?php
include '../includes/db.class.php'; 
include 'includes/config.php';
$PFDIRECTORY = 'panelflow';
$RSSID = $_GET['feed'];
$db = new DB();
$Current = date('Y-m-d h:i:s');
$query = "select * from projects as c
		  join creators as cr on c.ProjectID=cr.ComicID
		  join comic_settings as cs on c.ProjectID=cs.ComicID
		  where c.SafeFolder='$RSSID'";
$RSSSettings = $db->queryUniqueObject($query);

	
	$ComicTitle = $RSSSettings->title;
	$Creator = $RSSSettings->realname;
	$ComicID = $RSSSettings->ProjectID;
	$query = "select * from comic_pages where ComicID = '$ComicID' and PageType='pages' and PublishDate<='$Current' order by PublishDate DESC limit 25";
	$TotalPages = 0;
	$db->query($query);
	$now = date("D, d M Y H:i:s T");
	$CurrentDate= date('D M j'); 
	$CurrentDay = date('d');
	$CurrentMonth = date('m');
	$CurrentYear = date('Y');
	if (substr($RSSSettings->thumb,0,7) != 'http://')
		$Thumb = 'http://'.$_SERVER['SERVER_NAME'].'/'.$RSSSettings->thumb;
	else 
		$Thumb = $RSSSettings->thumb;
		 
		
		
	$output = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <rss xmlns:atom=\"http://www.w3.org/2005/Atom\" version=\"2.0\">


			<channel>
                    <title>".$ComicTitle."</title>
                    <link>http://".$_SERVER['SERVER_NAME']."/".$PFDIRECTORY."/rss.php?feed=".$RSSID."</link>
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
 			//$Date = $line->datelive;
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
			$PagePath = '/'.$RSSSettings->ProjectDirectory.'/'.substr($RSSID,0,1).'/'.$RSSID.'/images/pages/'.$line->Image;
			$PagePath = '/'.$line->ThumbMd;
			if ($idSafe == 1) {
				$output .= "<item>
				<title>".htmlentities($line->Title)." </title>
				<description>$PublishDate&lt;br/&gt;&lt;b&gt;";
				if ($line->Comment != '')
					$output .= "Author Comment:&lt;/b&gt; &lt;br/&gt;".htmlentities($line->Comment)."&lt;/b&gt; &lt;br/&gt;";
				$output .= "<![CDATA[<img src=\"http://".$_SERVER['SERVER_NAME'].$PagePath."\">]]>";
				
				
				$output .= "</description>";
				$output .= "<link>http://".htmlentities($_SERVER['SERVER_NAME'])."/".$RSSID."/reader/";
				if ($line->SeriesNum != 1)
					$output .= "series/".$line->SeriesNum."/";
				$output .= "episode/".$line->EpisodeNum."/";
				$output .= "page/".$line->EpPosition."/";
				
				$output .= "</link>
           		<pubDate>".date('D, d M Y H:i:s T',strtotime($line->PublishDate))."</pubDate>
            	</item>";
			}
	}

$output .= "</channel></rss>";
header("Content-Type: application/rss+xml");
echo $output;
?>
