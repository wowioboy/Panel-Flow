<? $downloaddb = new DB($db_database,$db_host, $db_user, $db_pass);
$deskstring = "";
$query = "select * from downloads where ComicID = '$ComicID' and DlType = 1";
$downloaddb->query($query);
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DLDescription = stripslashes($download->Description);
	$deskstring .= "<div class='downloadimage'><img src='".$DlThumb."'  border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='".$DlImage."' target='blank'>[download]</a><div class='spacer'></div>";
}
 
$coverstring = "";
$query = "select * from downloads where ComicID = '$ComicID' and DlType = 2";
$downloaddb->query($query);
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DLDescription = stripslashes($download->Description);
	$coverstring .= "<div class='downloadimage'><img src='".$DlThumb."' width='150' height='175' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='".$DlImage."' target='blank'>[download]</a><div class='spacer'></div>";

}

$avatarstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$avatarcnt = 0;
$query = "select * from downloads where ComicID = '$ComicID' and DlType = 3";
$downloaddb->query($query);
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DLDescription = stripslashes($download->Description);
	$avatarstring .= "<td width ='100'><div class='downloadimage'><img src='".$DlThumb."' width='100' height='100' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='".$DlImage."' target='blank'>[download]</a><div class='spacer'></div></td>";
	 $avatarcnt++;
 if ($avatarcnt == 2){
 $avatarstring .= "</tr><tr>";
 $avatarcnt = 0;
 }	
}
 $avatarstring .= "</table>";
$downloaddb->close();
$Title = 'Downloads';
?>