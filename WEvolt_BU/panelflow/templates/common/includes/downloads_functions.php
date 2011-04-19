<? 

$deskstring = "";
$DeskCount = 0;
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 1";
$InitDB->query($query);

$DesktopItems = $InitDB->numRows();
 $deskstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb; 
$DlEncryptID = $download->EncryptID; 
$DLDescription = stripslashes($download->Description);
	$deskstring .= "<td ><div class='downloadimage'><img src='http://www.panelflow.com/";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			$deskstring .= 'comics/'.$ComicDir.'/'.$SafeFolder.'/';

		$deskstring .= $DlThumb."'  border='1' style='border-color:#000000;' width='150' height='120'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='/".$PFDIRECTORY."/download_content.php?id=".$DlEncryptID."'>[download]</a><div class='spacer'></div></td>";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			//$deskstring .= 'comics/'.$ComicDir.'/'.$ComicFolder.'/';
			
	//$deskstring .= "";
	$DeskCount++;
	if ($DeskCount == 4){
 			$deskstring .= "</tr><tr>";
 			$DeskCount = 0;
 	}
	
}
if 	($DeskCount < 4){
		while($DeskCount <4) {
			$deskstring .= "<td></td>";
			$DeskCount++;
		}
	}
 $deskstring .= "</tr></table>";
 
$coverstring = "";
$CoverCount = 0;
 $coverstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 2";

$InitDB->query($query);
$CoverItems = $InitDB->numRows();
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DlEncryptID = $download->EncryptID; 
$DLDescription = stripslashes($download->Description);
	//$coverstring .= "<td ><div class='downloadimage'><img src='/";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
		//	$coverstring .= $ComicFolder.'/';
		$coverstring .= "<td ><div class='downloadimage'><img src='http://www.panelflow.com/";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			$coverstring .= 'comics/'.$ComicDir.'/'.$SafeFolder.'/';
		$coverstring .= $DlThumb."' width='150' height='175' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='/".$PFDIRECTORY."/download_content.php?id=".$DlEncryptID."'>[download]</a><div class='spacer'></div></td>";

$CoverCount++;
	if ($CoverCount == 4){
 			$coverstring .= "</tr><tr>";
 			$CoverCount = 0;
 	}	
}
if 	($CoverCount < 4){
		while($CoverCount <4) {
			$coverstring .= "<td></td>";
			$CoverCount++;
		}
	}
 $coverstring .= "</tr></table>";

$avatarstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$avatarcnt = 0;
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 3";
$InitDB->query($query);
$AvatarItems = $InitDB->numRows();
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DlEncryptID = $download->EncryptID; 
$DLDescription = stripslashes($download->Description);
		//	$coverstring .= $ComicFolder.'/';
		$avatarstring .= "<td ><div class='downloadimage'><img src='http://www.panelflow.com/";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			$avatarstring .= 'comics/'.$ComicDir.'/'.$SafeFolder.'/';
			
			 $avatarstring .= $DlThumb."' width='100' height='100' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='/".$PFDIRECTORY."/download_content.php?id=".$DlEncryptID."'>[download]</a><div class='spacer'></div></td>";
	 $avatarcnt++;
 if ($avatarcnt == 5){
 $avatarstring .= "</tr><tr>";
 $avatarcnt = 0;
 }	
}
if 	($avatarcnt < 5){
		while($avatarcnt <5) {
			$avatarstring .= "<td></td>";
			$avatarcnt++;
		}
	}
 $avatarstring .= "</tr></table>";

$Title = 'Downloads';
?>