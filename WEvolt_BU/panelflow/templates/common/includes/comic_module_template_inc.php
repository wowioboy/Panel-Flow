<? 
//COMIC INFO MODULE 
$ComicModuleString='';

if (($_SESSION['usertype'] == 1) || ($_SESSION['usertype'] == 2))
$ComicModuleString.='<div class="pagelinks" align="center">[<a href="http://www.panelflow.com/cms/edit/'.$ComicFolder.'/" target="_blank">CMS ADMIN</a>]</div>';



if ($EpisodeSetting == 1) { 
	 if ($EpisodeCount > 0) { 
			$ComicModuleString.='<div class="spacer"></div><div align="center">';
			$ComicModuleString.='<span id="EpisodesButton" class="buttonlinks"><a href="/';
			if (($ComicFolder != '') && ($ComicFolder != '/')) 
				$ComicModuleString .= $ComicFolder.'/';
			
			$ComicModuleString .= 'episodes/">';
			if ($EpisodesButtonImage != '') {
				$ComicModuleString .= '<img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$EpisodesButtonImage.'" id="EpisodesButtonImage" alt="Episodes" border="0"';
 				if ($EpisodesButtonRolloverImage != '') {
 					$ComicModuleString .= 'onMouseOver="swapimage(\'EpisodesButtonImage\',\''.$EpisodesButtonRolloverImage.'\')" onMouseOut="swapimage(\'EpisodesButtonImage\',\''.$EpisodesButtonImage.'\')"';
 				}
				$ComicModuleString .= '/>'; 
			} else { 
				$ComicModuleString .= 'Episodes'; 
			}
			$ComicModuleString .= '</a></span></div>';
	}
}

$ArchiveSetting = 0;
if ($ArchiveSetting == 1) { 
$ComicModuleString.='<div class="jumpbox">'.$boxString.'</div><div class="spacer"></div>';
 }
if ($ShowSchedule == 1) { 
$ComicModuleString.='<div class="schedule">UPDATES: <br/><div style="font-size:10px;">'.$ScheduleString.'</div></div><div class="spacer"></div>';
 }
if ($ChapterSetting == 1) { 
$ComicModuleString.='<div class="chapters">'.$ChapterString.'</div><div class="spacer"></div>';
 } 
$HomecomiccreditsString =''; 
$HomecomiccreditsString.='<div class="comiccredits" style="padding-left:10px;"><div class="halfspacer"></div>';
	 if ((isset($Creator)) && ($Creator != '')) { 
			$HomecomiccreditsString.='<div class="comicinfo">CREATED BY: </div><div class="infotext">'.$Creator.'</div>';
	 } 
	
	if (((isset($Writer)) && ($Writer != '')) || ($EpisodeWriter != ''))  { 
			$HomecomiccreditsString.='<div class="comicinfo">WRITTEN BY: </div>';
			if ($EpisodeWriter != '') 
						$Writer = $EpisodeWriter;
				
			$HomecomiccreditsString.='<div class="infotext">'.$Writer.'</div>';
 }
	
 if (((isset($Artist))&& ($Artist != ''))|| ($EpisodeArtist != ''))  { 
			$HomecomiccreditsString.='<div class="comicinfo">ILLUSTRATED BY: </div>';
			if ($EpisodeArtist != '')
						$Artist= $EpisodeArtist;
					
			$HomecomiccreditsString.='<div class="infotext">'.$Artist.'</div>';
} 	
	
if (((isset($Colorist)) && ($Colorist != ''))|| ($EpisodeColorist != ''))  { 
			$HomecomiccreditsString.='<div class="comicinfo">COLORED BY: </div>';
			if ($EpisodeColorist != '')
					$Colorist= $EpisodeColorist;
			$HomecomiccreditsString.='<div class="infotext">'.$Colorist.'</div>';
} 

if (((isset($Letterist))&& ($Letterist != '')) || ($EpisodeLetterer != '')) { 
			$HomecomiccreditsString.='<div class="comicinfo">LETTERED BY: </div>';
			if ($EpisodeLetterer != '')
					$Letterist= $EpisodeLetterer;
			$HomecomiccreditsString.='<div class="infotext">'.$Letterist.'</div>';
}
	$HomecomiccreditsString.='</div><div class="spacer"></div>';
$ComicModuleString .= $HomecomiccreditsString;
		 if ($CalendarSetting == 1) {
	$ComicModuleString.='<div class="modheader">Update Calendar</div><center>'.
	'<div id="pagecalendar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
</center>';
}
$ComicModuleString.='<div class="pagelinks" align="center" style="padding-top:5px;"><table cellspacing="0" cellpadding="0" border="0" ><tr><td>SUBSCRIBE</td><td style="padding-left:3px;"><a href="http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/feed.php?feed='.$ComicFolder.'" target="_blank"><img src="/'.$PFDIRECTORY.'/images/rss.png" border="0" width="30" height="30"></a></td></tr></table></div>';

?>