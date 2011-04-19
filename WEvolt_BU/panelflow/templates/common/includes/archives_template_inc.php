<? 


//DOWNLOADS MODULE
$Today = date('Y-m-d').' 00:00:00';
$ArchivesString = "<div align=\"left\" style='width:800px;'><div class='globalheader'>ARCHIVES</div>";
$query = "select * from comic_pages where PublishDate<='$Today' and ComicID = '$ComicID' and PageType='pages' order by Position ASC";
$InitDB->query($query);
$LastEpisode = 0;
$LastChapter = 0;
while($line = $InitDB->FetchNextObject()) {
$EpisodeCount = 1;
if ($line->Episode == 1) {
	$ArchivesString .='<div class="spacer"></div><div style="color:#'.$GlobalHeaderBGColor.';"><b>Episode '.$EpisodeCount.' - '.stripslashes($line->Title).'</b></div><div class="spacer"></div>'; 
	$EpisodeCount++;
	}
$ArchivesString .='<a href="/'.$ComicName.'/page/'.$line->Position.'/"><img src="/'.$line->ThumbSm.'" border="1" hspace="10" vspace="10" style="border:#'.$GlobalHeaderBGColor.' 2px solid;"></a>';
}

$ArchivesString .='</div>';


 ?>