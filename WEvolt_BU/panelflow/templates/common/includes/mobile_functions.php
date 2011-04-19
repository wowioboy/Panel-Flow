<? 


$WallpapersString = "";
$WallpaperCount = 0;
$query = "select * from mobile_content where ComicID = '$ComicID' and Type = 'Wallpaper'";
$InitDB->query($query);
$Wallpapers = $InitDB->numRows();
 $WallpapersString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->Type;
$DlThumb = $download->Thumb;
	$WallpapersString .= "<td align='center'><div class='downloadimage'><a href='http://www.panelflow.com/".$SafeFolder."/mobile/".$DownID."/' target='blank'><img src='http://www.panelflow.com/";
			$WallpapersString .= 'comics/'.$ComicDir.'/'.$SafeFolder.'/'.$DlThumb."'  border='1' style='border-color:#000000;'></a></div><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/mobile/".$DownID."/' target='blank'>[send to phone]</a><div class='spacer'></div></td>";
	$WallpaperCount++;
	if ($WallpaperCount == 5){
 			$WallpapersString .= "</tr><tr>";
 			$WallpaperCount = 0;
 	}
	
}
if 	($WallpaperCount < 5){
		while($WallpaperCount <5) {
			$WallpapersString .= "<td></td>";
			$WallpaperCount++;
		}
	}
 $WallpapersString .= "</tr></table>";
 
 $TonesString = "";
$TonesCount = 0;
$query = "select * from mobile_content where ComicID = '$ComicID' and Type = 'Ringtone'";
$InitDB->query($query);
$Prints = $InitDB->numRows();
 $TonesString = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->ProductType;
$DlThumb = $download->ThumbMd;

	$TonesString .= "<td align='center'><div class='downloadimage'><img src='http://www.panelflow.com/";
			$TonesString .= 'comics/'.$ComicDir.'/'.$DlThumb."'  border='1' style='border-color:#000000;'></div><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/mobile/".$DownID."/' target='blank'>[send to phone]</a><div class='spacer'></div></td>";
	$TonesCount++;
	if ($TonesCount == 5){
 			$TonesString .= "</tr><tr>";
 			$TonesCount = 0;
 	}
	
}
if 	($TonesCount < 5){
		while($TonesCount <5) {
			$TonesString .= "<td></td>";
			$TonesCount++;
		}
	}
 $TonesString .= "</tr></table>";
 
$Title = 'Mobile Content';
?>