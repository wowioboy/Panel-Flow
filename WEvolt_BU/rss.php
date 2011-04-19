<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
include 'includes/db.class.php'; 
$PFDIRECTORY = 'panelflow';
$RSSID = $_GET['feed'];
$db = new DB();
$RSSID = 'The_WEvolt_Blog';
$Current = date('Y-m-d h:i:s');
$query = "select * from projects as c
		  join creators as cr on c.ProjectID=cr.ComicID
		  join comic_settings as cs on c.ProjectID=cs.ComicID
		  where c.SafeFolder='$RSSID'";
$RSSSettings = $db->queryUniqueObject($query);  

	
	$ComicTitle = $RSSSettings->title; 
	$Creator = $RSSSettings->realname; 
	$ComicID = $RSSSettings->ProjectID;
		
			
	$query = "select * from pfw_blog_posts where  (ComicID='$ComicID' or ProjectID = '$ComicID') and PublishDate<='$Current' order by PublishDate DESC limit 25";
	$TotalPages = 0;

	$db->query($query);
	$now = date("D, d M Y H:i:s T");
	$CurrentDate= date('D M j'); 
	$CurrentDay = date('d');
	$CurrentMonth = date('m');
	$CurrentYear = date('Y');
	if (substr($RSSSettings->thumb,0,7) != 'http://')
		$Thumb = 'http://'.$_SERVER['SERVER_NAME'].$RSSSettings->thumb;
	else 
		$Thumb = $RSSSettings->thumb;
		 
		
		
	$output = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
            <rss xmlns:atom=\"http://www.w3.org/2005/Atom\" version=\"2.0\">
 

			<channel>
                    <title>".$ComicTitle."</title>
                    <link>http://".$_SERVER['SERVER_NAME']."/".$PFDIRECTORY."/rss.php?feed=".$RSSID."</link>
                    <description>".htmlentities($RSSSettings->synopsis)."</description>
                    <language>en-us</language>
                    <generator>Feeder 2.0.4(1155) http://reinventedsoftware.com/feeder/</generator>
        			<docs>http://blogs.law.harvard.edu/tech/rss</docs>

					<copyright>".htmlentities($RSSSettings->Copyright)."</copyright>
             
                    <lastBuildDate>$now</lastBuildDate>
                    <atom:link href=\"http://".$_SERVER['SERVER_NAME']."/rss.php\" rel=\"self\" type=\"application/rss+xml\"/>
					<image>
						<url>".$Thumb."</url>
      					<title>".$ComicTitle."</title>
      					<link>http://".$_SERVER['SERVER_NAME']."/".$PFDIRECTORY."/rss.php?feed=".$RSSID."</link>
						<description>".htmlentities($RSSSettings->synopsis)."</description>
					</image>
 
					
            ";
	while ($line = $db->fetchNextObject()) { 
			$Filename = $line->Filename;
			//print_r($PostArray);
			$HtmlContent = file_get_contents('http://www.wevolt.com/'.$Filename);
			
			$Title = $line->Title;
			$PublishDate = 	date('m-d-Y',strtotime($line->PublishDate));
      $date = date(strtotime($line->PublishDate));
		
				$output .= "<item> 
				<title>".htmlentities($line->Title)." </title>
				<description>Post date: $PublishDate";
				
				//$output .= "<![CDATA[".$HtmlContent ."]]>";
				
				
				$output .= "</description>";
				$output .= "<link>http://".htmlentities($_SERVER['SERVER_NAME'])."/".$RSSID."/blog/?post=".$line->EncryptID;

				$output .= "</link>
           		<pubDate>".date('D, d M Y H:i:s T',strtotime($line->PublishDate))."</pubDate>
            	</item>";

	}

$output .= "</channel></rss>";
header("Content-Type: application/rss+xml");
echo $output;
?>
