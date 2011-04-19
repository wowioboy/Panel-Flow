<? 

if ($story_array[$k]->episode == 1) {
			if (($InEpisode == 1) && ($FoundPage != 1)) {
				$ChapterString = '<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td valign="top">';
				
			} else if ($InEpisode == 1){
				$InEpisode = 0;
			} else {
				$InEpisode = 1;
			}
			    $EpisodeCount++;
				$ArchiveDropDown .= "<option style='background-color:#8cc2ff;' value='/";
				//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$ArchiveDropDown .= $SafeFolder.'/inlinereader/';
				$ArchiveDropDown .= "page/".$story_array[$k]->position."/'";
				if ($story_array[$k]->id==$PageID) {
					    $FoundPage = 1;
						$ArchiveDropDown.= 'selected'; 
					} 
				
				$ArchiveDropDown .="><b>EPISODE </b>".$EpisodeCount." - ".$story_array[$k]->title."</option>";
				$episodeString .= "<div id='episodediv_".$EpisodeCount."'";
				$episodeselectString .= "<td id='episodetab_".$EpisodeCount."' onclick='episodetab_".$EpisodeCount."();' class='"; 
					if ($EpisodeCount > 1) {
						$episodeString .= "style='display:none;'";
						$episodeselectString  .= "tabinactive'";
						
					} else {
						$episodeselectString  .= "tabactive'";
					}
					$episodeselectString .= ">EPISODE ".$EpisodeCount."</td><td width='5'></td>";
					
					$episodeString .= "><table cellpadding='0' cellspacing='0' border='0'><tr><td valign='top' class='contentbox'><a href='/";
					//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$episodeString .= $SafeFolder.'/inlinereader/';
				$episodeString .= "page/".$story_array[$k]->position."/'";
					$episodeString .= "><img src='/".$story_array[$k]->ThumbLg."' border='2' style='border-color:#000000'></a></td><td valign='top' style='padding-left:5px; padding-right:5px;' class='contentbox' id='episodetd_".$EpisodeCount."'><font color='#".$ContentBoxTextColor."'>EPISODE ".$EpisodeCount."</font></div><div class='pagelinks'><div class='episodetitle'><a href='/";
					//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$episodeString .= $SafeFolder.'/inlinereader/';
				$episodeString .= "page/".$story_array[$k]->position."/'";
					
					
					$episodeString .= ">".$story_array[$k]->title."</a></div></div><div class='spacer'></div><font color='#".$ContentBoxTextColor."' style='font-size:".$ContentBoxFontSize."px;'>".$story_array[$k]->EpisodeDesc."<div class='spacer'></div>";
					if ($story_array[$k]->EpisodeWriter != '') {
						$episodeString .= "Script: ".$story_array[$k]->EpisodeWriter."<br/>";
						$EpisodeWriterTemp = $story_array[$k]->EpisodeWriter;
					}
					if ($story_array[$k]->EpisodeArtist != ''){
						$episodeString .= "Art: ".$story_array[$k]->EpisodeArtist."<br/>";
						$EpisodeArtistTemp = $story_array[$k]->EpisodeArtist;
					}
					if ($story_array[$k]->EpisodeColorist != ''){
						$episodeString .= "Colors: ".$story_array[$k]->EpisodeColorist."<br/>";
						$EpisodeColoristTemp = $story_array[$k]->EpisodeColorist;
					}
					if ($story_array[$k]->EpisodeLetterer != ''){
						$episodeString .= "Lettering: ".$story_array[$k]->EpisodeLetterer."<br/>";
						$EpisodeLettererTemp = $story_array[$k]->EpisodeLetterer;
					}
					$episodeString .= "</font></td></tr></table></div>";
					   $ChapterCount = 1;
					   $ChapterPageCount = 1;
			}
			if ($story_array[$k]->episode != 1) {
				if ($story_array[$k]->chapter == 1) {
					if ($Inchapter == 1) {
			  	 		$ChapterPageCount = 1;
			   		}
				$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/";
				//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$ArchiveDropDown .= $SafeFolder.'/inlinereader/';
				$ArchiveDropDown .= "page/".$story_array[$k]->position."/'";
					if ($story_array[$k]->id==$PageID) {
					    $FoundPage = 1;
						if ($InEpisode == 1) {
							$Writer = $EpisodeWriterTemp;
							$Artist = $EpisodeArtistTemp;
							$Colorist = $EpisodeColoristTemp;
							$Letterist = $EpisodeLettererTemp;
						}
						$ArchiveDropDown .= 'selected'; 
					} 
					$ArchiveDropDown .= "><b>CHAPTER </b>".$ChapterCount." - ".$story_array[$k]->title."</option>";  
					if ($InEpisode == 1) {
						$ChapterString .= "<div class='modheader'>Chapter ".$ChapterCount."</div><div class='pagelinks'><a href='/";
				//	if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$ChapterString .= $SafeFolder.'/inlinereader/';
				$ChapterString .= "page/".$story_array[$k]->position."/'>".$story_array[$k]->title."</a></div><div class='smspacer'></div>";
					}

					$Inchapter = 1;
					$ChapterCount++;
				} else {
			 		if ($Inchapter == 1) {
						$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/";
				//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$ArchiveDropDown .= $SafeFolder.'/inlinereader/';
				$ArchiveDropDown .= "page/".$story_array[$k]->position."/'";
						if ($story_array[$k]->id==$PageID) {
							$FoundPage = 1;
							$ArchiveDropDown .= 'selected'; 
						} 
						$ArchiveDropDown .= ">&nbsp;&nbsp;&nbsp;Page ".$ChapterPageCount." - ".$story_array[$k]->title."</option>";
						//$ChapterString .= "<div class='chapterlinks'><b>CHAPTER ".$ChapterCount."</b><br /><a href='index.php?id=".$story_array[$k]->id."'>".$story_array[$k]->title."</a><div class='smspacer'></div>";
						$ChapterPageCount++;
					} else {
						$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/";
				//if (($ComicFolder != '') && ($ComicFolder != '/')) 
					$ArchiveDropDown .= $SafeFolder.'/inlinereader/';
				$ArchiveDropDown .= "page/".$story_array[$k]->position."/'";
						if ($story_array[$k]->id==$PageID) {
							$FoundPage = 1;
							$ArchiveDropDown .= 'selected'; 
						} 
					$ArchiveDropDown .= ">-> ".$story_array[$k]->title."</option>";
					}
			
				}
			}
?>
