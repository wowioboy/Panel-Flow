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
				$boxString .= "<option style='background-color:#fce4aa;' value='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'";
				if ($story_array[$k]->id==$PageID) {
					    $FoundPage = 1;
						$boxString .= 'selected'; 
					} 
				
				$boxString .="><b>EPISODE </b>".$EpisodeCount." - ".$story_array[$k]->title."</option>";
					$episodeString .= "<table cellpadding='0' cellspacing='0' border='0'><tr><td valign='top'><a href='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'><img src='images/pages/largethumbs/".$story_array[$k]->filename."' border='2' style='border-color:#000000'></a></td><td style='padding-left:5px; padding-right:5px;' valign='top'><div class='episodelinks'><b>EPISODE ".$EpisodeCount."</b><br /><a href='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'><span class='episodetitle'>".$story_array[$k]->title."</span></a><div class='episodesummary'>".$story_array[$k]->comment."</div></td></tr></table><div class='spacer'></div>";
					   $ChapterCount = 1;
					   $ChapterPageCount = 1;
			} 
			if ($story_array[$k]->episode != 1) {
				if ($story_array[$k]->chapter == 1) {
					if ($Inchapter == 1) {
			  	 		$ChapterPageCount = 1;
			   		}
				$boxString .= "<option style='background-color:#f6ecea;' value='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."' ";
					if ($story_array[$k]->id==$PageID) {
					    $FoundPage = 1;
						$boxString .= 'selected'; 
					} 
					$boxString .= "><b>CHAPTER </b>".$ChapterCount." - ".$story_array[$k]->title."</option>";  
					if ($InEpisode == 1) {
						$ChapterString .= "<div class='chaptername'><b>CHAPTER ".$ChapterCount."</b></div><div class='chapterlinks'><a href='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'>".$story_array[$k]->title."</a></div><div class='smspacer'></div>";
					}

					$Inchapter = 1;
					$ChapterCount++;
				} else {
			 		if ($Inchapter == 1) {
						$boxString .= "<option value='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'";
						if ($story_array[$k]->id==$PageID) {
							$FoundPage = 1;
							$boxString .= 'selected'; 
						} 
						$boxString .= ">&nbsp;&nbsp;&nbsp;Page ".$ChapterPageCount." - ".$story_array[$k]->title."</option>";
						//$ChapterString .= "<div class='chapterlinks'><b>CHAPTER ".$ChapterCount."</b><br /><a href='index.php?id=".$story_array[$k]->id."'>".$story_array[$k]->title."</a><div class='smspacer'></div>";
						$ChapterPageCount++;
					} else {
						$boxString .= "<option value='/".$SafeFolder."/iphone/?id=".$story_array[$k]->id."'";
						if ($story_array[$k]->id==$PageID) {
							$FoundPage = 1;
							$boxString .= 'selected'; 
						} 
					$boxString .= ">-> ".$story_array[$k]->title."</option>";
					}
			
				}
			}
			?>