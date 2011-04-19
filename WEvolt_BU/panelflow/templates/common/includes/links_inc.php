<?php

if ($Section == 'Links') {

$query = "select * from links where ComicID = '$ComicID' and InternalLink=0 order by Title";
$InitDB->query($query);

$LinksString = '<div style="width:800px;" align="center"><div class="globalheader">LINKS</div><div class="spacer"></div>';
while ($link = $InitDB->fetchNextObject()) { 
	if (substr($link->Link,0,7) != 'http://')
		$Link = 'http://'.$link->Link;
	else 
		$Link = $link->Link;
	if ($link->Link != '') {
		
	$LinksString .= "<div class='rectitle'><span class='pagelinks'><a href='".$Link."' target='_blank'>";
	if ($link->Image != '')
		$LinksString .= "<img src='".$link->Image."' border='0'>";
	else
	 
	$LinksString .= stripslashes($link->Title);
	 
	$LinksString .= "</a></span></div><div style='color:#".$ContentBoxTextColor."; font-size:".$ContentBoxFontSize."px;'>".stripslashes($link->Description)."</div><div class='spacer'></div>";
}
}

$query = "select * from links where ComicID = '$ComicID' and InternalLink=1 order by Title";
$InitDB->query($query);

$TotalBanners = $InitDB->numRows();

if ($TotalBanners > 0) {
$LinksString .= '<div style="width:800px;" align="center"><div class="globalheader">COMIC BANNERS</div><div class="spacer"></div><div style=\'color:#'.$ContentBoxTextColor.'; font-size:'.$ContentBoxFontSize.'px;\'>Below are banners to use on your own sites to link to this comic.<div class="spacer"></div>';
while ($link = $InitDB->fetchNextObject()) { 
	
	
		$LinksString .= "<img src='".$link->Image."' border='0'><div class='spacer'></div>";

}
$LinksString .= '</div>';
}

$LinksString .= '</div>';

} else {
$query = "select * from links where ComicID = '$ComicID' and InternalLink=0";
$InitDB->query($query);
$HomelinksboxString = '';
while ($link = $InitDB->fetchNextObject()) { 
	if (substr($link->Link,0,7) != 'http://')
		$Link = 'http://'.$link->Link;
	else 
		$Link = $link->Link;
		
	$HomelinksboxString .= "<div class='rectitle' align='left'><span class='pagelinks'><a href='".$Link."' target='_blank'>".$link->Title."</a></span></div><div style='color:#".$ContentBoxTextColor."; font-size:".$ContentBoxFontSize."px;' align='left'>".$link->Description."</div><div class='spacer'></div>";
}
$OtherComics = @file_get_contents('https://www.panelflow.com/connectors/othercomics.php?userid='.$RealComicCreator);

$HomeothercreatorcomicsString = '';
$OtherComicsArray = @explode(',',$OtherComics);
if (sizeof($OtherComicsArray) > 1) {
$otherheader .='<div class="modheader">Other Comics by Creator</div>';
$HomeothercreatorcomicsString = '<div align="center">';
	$ocount = 0;
	foreach($OtherComicsArray as $OtherComicPack) {
		$OtherComicTitleArray = explode('||',$OtherComicPack);
		$HomeothercreatorcomicsString .='<a href="'.$OtherComicTitleArray[1].'" target="_blank"><img src="'.$OtherComicTitleArray[0].'" style="border:#000000 1px solid;" width="75" height="100" vspace="3" hspace="3"></a>';
		unset($OtherComicTitleArray);
	}
	$HomeothercreatorcomicsString .='</div>';
}


	$linkstring .= $HomelinksboxString . $otherheader. $HomeothercreatorcomicsString;
	

}	

?>