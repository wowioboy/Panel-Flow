<? 
//DOWNLOADS MODULE
if ($Col1Width == '')
	$Col1Width = '450';
if ($Col2Width == '')
	$Col2Width = '350';
$HomedownloadsString = "<div align=\"center\">";
$selector = rand(1,3);
$query = "select * from comic_downloads where ComicID = '$ComicID' order by RAND() limit 3";
$InitDB->query($query);
$NumDownloads = $InitDB->numRows();

while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name; 
$DlImage = $download->Image;
$DlThumb = $download->Thumb; 
$DlEncryptID = $download->EncryptID; 
	$HomedownloadsString .= "<a href='/".$PFDIRECTORY."/download_content.php?id=".$DlEncryptID."'><img src='/";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			$HomedownloadsString .= 'comics/'.$ComicDir.'/'.$SafeFolder.'/';

		$HomedownloadsString .= $DlThumb."'  border='1' style='border-color:#000000;' hspace='5' vspace='5'></a>";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
	
	
}
$HomedownloadsString .= "</div>";

//PRODUCTS MODULE
$HomeproductsString  ="<div align=\"center\">";
$query = "select * from pf_store_items where ComicID = '$ComicID' order by RAND() limit 1";
$InitDB->query($query);
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Name;
$DlImage = $download->Image;
$DlThumb = $download->ThumbMd; 
$Price = $download->Price;
if ($Price == '') 
	$Price = 'FREE';
else 
	$Price = '$'.$Price;
$DlEncryptID = $download->EncryptID; 
	$HomeproductsString .= "<div class='downloadimage' align='center'><img src='/".$DlThumb."'  border='1' style='border-color:#000000;'><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://www.panelflow.com/".$SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div></div>";
	//if (($ComicFolder != '') && ($ComicFolder != '/')) 
	
}
$HomeproductsString  .="</div>";
//STATUS BOX
$StatusResult = @file_get_contents("https://www.panelflow.com/processing/getstatus.php?email=".$CreatorEmail);
$StatusArray = unserialize ($StatusResult);
$HomestatusString .= "<font style=\'font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".stripslashes($StatusArray['Status'])."</font>"; 
 

//CHARACTERS MODULE
$CharactersModuleString .="<div align=\"center\">";
$query = "select * from characters where ComicID = '$ProjectID' order by RAND() limit 2 ";
$InitDB->query($query);
while ($download = $InitDB->fetchNextObject()) { 
$TCharName = stripslashes($download->Name);
$DownID = $download->ID;
$Downname = $download->Name;
$DlImage = $download->Image;
$DlThumb = 'http://www.panelflow.com/comics/'. $ComicDir.'/'.$SafeFolder.'/'.$download->Thumb; 
$DlEncryptID = $download->EncryptID; 

$CharactersModuleString .= "<a href='/".$SafeFolder."/characters/'><img src='".$DlThumb."'  border='1' style='border-color:#000000;' hspace=\"5\" vspace=\"5\"></a>";
}
$CharactersModuleString .= "</div>";
//MOBILE MODULE 
$HomemobileString = "<div align=\"center\">";
$query = "select * from mobile_content where ComicID = '$ComicID' and Type = 'Wallpaper' order by RAND() LIMIT 3 ";
$InitDB->query($query);
while ($download = $InitDB->fetchNextObject()) { 
$DownID = $download->EncryptID;
$Downname = $download->Title;
$DlType = $download->Type;
$DlThumb = $download->Thumb;
	$HomemobileString .= "<a href='http://www.panelflow.com/".$SafeFolder."/mobile/".$DownID."/' target='blank'><img src='";
			$HomemobileString .= 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/'.$DlThumb.'\'  border=\'1\' style=\'border-color:#000000;\' hspace="5" vspace="5"></a>';
	
}
$HomemobileString .= "</div>";



//BUILD LEFT COLUMN
$LeftColumnString = '';

if ($ModuleSeparation == 1) {
	$LeftColumnString = '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$Col1Width.'" valign="top">';
} else {
	$LeftColumnString .= '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$Col1Width.'" valign="top"><table width="'.$Col1Width.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($Col1Width-($CornerWidth*2)).'" valign="top">';
}


foreach ($LeftColumModuleOrder as $projectmodule) {

if ((is_authed()) && ($projectmodule == 'logform')) 
		$Skip = 1;
else if (($AuthComment==0) && ($projectmodule == 'authcomm'))
		$Skip = 1;
else 
		$Skip = 0;
		
	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
		if ($HeaderPlacement == 'outside') {
		   
			$LeftColumnString .=setheader($projectmodule);		
		}
		$LeftColumnString.= '<table width="'.$Col1Width.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($Col1Width-($CornerWidth*2)).'" valign="top">';
	}
	if ($HeaderPlacement == 'inside') 
			$LeftColumnString .= setheader($projectmodule);		 
	if ($ModuleSeparation == 0) 
		$LeftColumnString.= "<div class='spacer'></div>";
		
			//print 'projectmodule HERE'.$projectmodule.'<br/>';
		 if ($projectmodule == 'linksbox'){
				$LeftColumnString.=$HomelinksboxString;
		} else if ($projectmodule == 'mobile'){ 
		 		 $LeftColumnString.= $HomemobileString;
		} else if ($projectmodule == 'products'){
		 		 $LeftColumnString.= $HomeproductsString;
		  }else if ($projectmodule == 'downloads'){
		 		 $LeftColumnString.= $HomedownloadsString;
			}else if ($projectmodule == 'othercreatorcomics'){
		 		 $LeftColumnString.= $HomeothercreatorcomicsString;	 
		} else if ($projectmodule =='LatestPageMod'){
	
		 		if ((($_SESSION['readerstyle'] == 'flash') && ($_SESSION['currentreader'] == '')) || ($_SESSION['currentreader'] == 'flash'))  {
					$LeftColumnString .= '<a href="/'.$SafeFolder.'/reader/';
					if ($LatestEpisode != 0)
						$LeftColumnString .= 'episode/'.$LatestEpisode.'/';
					if ($EpisodePart > 1)
						$LeftColumnString .= 'pages/'.$PagesPagination.'/';
					$LeftColumnString .= '#/'.($LatestPageCount-1);
			
				} else {
					$LeftColumnString .= '<a href="/'.$SafeFolder.'/reader/episode/'.$LatestEpisode.'/page/'.$lastpage.'/';
				
				}
				$LeftColumnString .= '"><img src="http://www.panelflow.com/'.$LatestPageThumb.'" width="'.($Col1Width-20).'" border="0"></a><br/>';
		 		

		}else{
		 $LeftColumnString.= setmodulehtml($projectmodule);
	}
	if ($ModuleSeparation == 0) 
		$LeftColumnString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$LeftColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';
	} 
}
}
if ($InsertAdTwo == 1) {
	$LeftColumnString.='<div class="spacer"></div><div align=\'center\'>'.$PositionTwoAdCode.'</div>';
}
if ($ModuleSeparation == 1) {
	$LeftColumnString .= '</td></tr></table><div class="endofleft"></div>';
} else {
	$LeftColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table></td>
</tr></table><div class="endofleft"></div>';
}


//BUILD RIGHT COLUMN
$RightColumnString = '';
if ($ModuleSeparation == 1) {
	$RightColumnString = '<table cellpadding="0" cellspacing="0" border="0" id="rightcolumn"><tr><td width="'.$Col2Width.'" valign="top">';
} else {
	$RightColumnString .= '<table cellpadding="0" cellspacing="0" border="0" id="rightcolumn"><tr><td width="'.$Col2Width.'" valign="top"><table width="'.$Col2Width.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($Col2Width-($CornerWidth*2)).'" valign="top">';
}

foreach ($RightColumModuleOrder as $projectmodule) {

	if ((is_authed()) && ($projectmodule == 'logform'))  {
		$Skip = 1;
	} else { 
		$Skip = 0;
	}
	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
	if ($HeaderPlacement == 'outside') {
			$RightColumnString .=setheader($projectmodule);		
		}
		$RightColumnString.= '<table width="'.$Col2Width.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($Col2Width-($CornerWidth*2)).'" valign="top">';
	}
	if ($HeaderPlacement == 'inside') {
			$RightColumnString .= setheader($projectmodule);		
	}
	if ($ModuleSeparation == 0) 
		$RightColumnString.= "<div class='spacer'></div>";
	
	 	if ($projectmodule == 'linksbox')
				$RightColumnString.=$HomelinksboxString;
		 else if ($projectmodule == 'mobile')
		 		 $RightColumnString.= $HomemobileString;
		 else if ($projectmodule == 'products')
		 		 $RightColumnString.= $HomeproductsString;
		 else if ($projectmodule == 'downloads')
		 		 $RightColumnString.= $HomedownloadsString; 
		 else if ($projectmodule == 'othercreatorcomics')
		 		 $RightColumnString.= $HomeothercreatorcomicsString;	 
		 else 
		 $RightColumnString.= setmodulehtml($projectmodule);
	if ($ModuleSeparation == 0) 
		$RightColumnString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$RightColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';
	} 
}
}


if ($ModuleSeparation == 1) {
	$RightColumnString .= '</td></tr></table><div class="endofright"></div>';
} else {
	$RightColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table></td>
</tr></table><div class="endofright"></div>';
}
//print 'RIGHT COLUM STRING = ' . $RightColumnString;
 ?>