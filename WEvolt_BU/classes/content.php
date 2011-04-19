<? 
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 
	class content extends project{
		var $Section;
		var $Col2Width;
		var $Col1Width;
		var $ContentTemplate;
		var $CustomSectionContent;
		var $SectionArray;
		var $LatestPageCount = 0;
		var $EpisodeCount = 0;
		var $ChapterCount = 1;
		var $InEpisode = 0;
		var $LatestEpisode = 0;
		var $EpisodePart = 1;
		var $TotalReaderPages;
		var $PagePosition;
		var $PageID;
		var $PageLikes;
		var $readerarray; 
		var $ProjectID;
		var $SafeFolder;
		var $CurrentDate;
		var $SettingArray;
		var $AdminUserArray;
		var $ContentUrl;
		var $IsBookMarked;
		var $CurrentPageThumb;
		var $InRumble;
		var $InLord;
		var $RoundOneRank;
		var $RoundTwoRank;
		var $RoundThreeRank;
		var $RumbleDate='2010-11-29 00:00:00';
		var $RumbleRound='lord';
		var $RumbleWeek='3';
		
		function __construct($ContentUrl, $ProjectID, $SafeFolder,$NoTemplate) {
				$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					
					if ($NoTemplate == 1)
						$QuerySection = 'reader';			
					else
						$QuerySection ='home';
					
					if ($ContentUrl == '') 
						$query = "select * from content_section where ProjectID='".$ProjectID."' and TemplateSection='$QuerySection'"; 
					 else 
						$query = "select * from content_section where ProjectID='".$ProjectID."' and (LOWER(Title)='$ContentUrl' or LOWER(TemplateSection)='".strtolower($ContentUrl)."')";
				
					
					$this->ProjectID = $ProjectID;
					$this->SafeFolder = $SafeFolder;
					$this->ContentUrl = $ContentUrl;
					
					$Array = $db->queryUniqueObject($query);
					$this->Section = ucfirst($Array->TemplateSection);	
									
					if (($this->Section == 'Home') && ($NoTemplate == 1)) 
						$this->Section = 'Reader';
					
					if (($this->Section == 'Home') && ($Array->Template == 'reader')){
						unset($Array);
						$query = "select * from content_section where ProjectID='".$ProjectID."' and TemplateSection='reader'"; 
					
						$this->Section = 'Reader';
						$Array = $db->queryUniqueObject($query);
						
					} else if (($this->Section == 'Home') && ($Array->Template == 'blog')){
						unset($Array);
						$query = "select * from content_section where ProjectID='".$ProjectID."' and TemplateSection='blog'"; 
					
						$this->Section = 'Blog';
						$Array = $db->queryUniqueObject($query);
						$this->ContentUrl = $Array->Title;
						
					} 
				   
					
					if ($this->Section == 'Reader')
						$this->Section = 'Pages';
					$this->Col1Width = $Array->Variable1;
					$this->Col2Width = $Array->Variable2;
					$this->Col3Width = $Array->Variable3;
					$this->ContentTemplate = $Array->Template;
					if ($this->Section =='') {
						if ($this->ContentUrl == 'fans') {
							$this->Section = 'Fans';
							$this->ContentTemplate = 'thumb_list';	
							
						}
						
						
					}
					
					$this->CurrentDate = date('Y-m-d 00:00:00');
					if (($Array->IsCustom == 1) || ($Array->Template == 'custom')|| ($Array->TemplateSection == 'custom'))
						$this->CustomSection = 1;
					else
						$this->CustomSection = 0;
					
					$this->CustomSectionContent = $Array->HTMLCode;
						
					$this->SectionArray = array (
											'Section'=>$this->Section,
											'Template'=>$this->ContentTemplate,
											'CustomSection'=> $this->CustomSection,
											'CustomContent'=> stripslashes($this->CustomSectionContent),
											'Variable1'=> $Array->Variable1,		
											'Variable2'=> $Array->Variable2,		
											'Variable3'=> $Array->Variable3,
											'Variable4'=> $Array->Variable4,	
											'AccessType'=> $Array->AccessType							
										);
										
										
				
					unset($Array);
					
					$query = "select count(*) from follows where user_id='".$_SESSION['userid']."' and follow_id='".$this->ProjectID."' and type='project'";
					$this->IsFollowing = $db->queryUniqueValue($query);
					
					$query = "select count(*) from subscription_shares as s where (s.user_id='".$_SESSION['userid']."' and s.user_id!='') and s.project_id='".$this->ProjectID."' and s.status='active'";
					$this->IsProjectSuperFan = $db->queryUniqueValue($query);	
					if ($this->IsProjectSuperFan == 0) {
						$query = "select count(*) from fan_invitations as f where f.UserID='".$_SESSION['userid']."' and f.ProjectID = '".$this->ProjectID."' and ((f.ExpirationDate>'".date('Y-m-d h:i:s')."' and f.Status='active') or (f.IsLifetime=1 and f.Status='active'))";
						$this->IsProjectSuperFan = $db->queryUniqueValue($query);
					}
					if ($_SESSION['userid'] == ''){
						$this->IsFollowing = 0;
						$this->IsProjectSuperFan = 0;
					}
					$db->close();
							
		}
		
		public function setNoTemplate($state) {
						$this->NoTemplate = $state;
		}
		
		public function setCurrentPosition($PagePosition) {
						$this->PagePosition = $PagePosition;
		}
		
		public function setPageID($PageID) {
						$this->PageID = $PageID;
		}
		
	
		
		public function getPages($SeriesNum='1',$EpisodeNum) { 
				$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
				
				$this->TotalReaderPages = 0;
				$CurrentDate = date('Y-m-d 00:00:00');
				$query = "select count(*) from Episodes where ProjectID = '".$this->ProjectID."' and SeriesNum='$SeriesNum'";
				$this->LastEpisode = $db->queryUniqueValue($query);
				$output .= $query.'<br/>';
				
				$this->ProjectSeriesArray = array();
				$query = "select * from series where ProjectID = '".$this->ProjectID."' order by SeriesNum ASC";
				$db->query($query);
				while ($line=$db->fetchNextObject()) {
					$this->ProjectSeriesArray[] = array('Title'=>$line->Title, 'SeriesNum'=>$line->SeriesNum);	
					$this->LastSeries = $line->SeriesNum;
				}
				
				$output .= $query.'<br/>';
				$query = "select count(*) from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='$SeriesNum' and EpisodeNum='".$this->LastEpisode."' order by EpPosition";
				$EPPages = $db->queryUniqueValue($query);
				$output .= $query.'<br/>';
				if ($EPPages == 0)
					$this->LastEpisode = ($this->LastEpisode-1);
					
			$query = "select EpPosition from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='$SeriesNum' and EpisodeNum='".$this->LastEpisode."' order by EpPosition DESC";
				$this->ProjectLastPage = $db->queryUniqueValue($query);
				$output .= $query.'<br/>';
				
				$query = "select Position from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='$SeriesNum' order by Position DESC";
				$this->TotalReaderPages = $db->queryUniqueValue($query);
				
					$output .= $query.'<br/>';			
				$query = "select * from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='$SeriesNum' order by EpisodeNum, EpPosition";
				$db->query($query);
				$output .= $query.'<br/>';
				
				
				
				if ($this->PagePosition == '')	
					$this->PagePosition = $this->TotalReaderPages;
				$IndexCnt = 0;	
		
				while ($line = $db->fetchNextObject()) { 
						$this->LatestPageCount++;
						$this->readerarray[$IndexCnt]->image = $line->Image;
						$this->readerarray[$IndexCnt]->proimage = $line->ProImage;
						$this->readerarray[$IndexCnt]->id = $line->EncryptPageID;
						
						$this->readerarray[$IndexCnt]->comment = $line->Comment; 
						$this->readerarray[$IndexCnt]->imgheight =$line->ImageDimensions;
						$this->readerarray[$IndexCnt]->title = $line->Title;
						$this->readerarray[$IndexCnt]->active = 1;
						$this->readerarray[$IndexCnt]->datelive = $line->Datelive;
						$this->readerarray[$IndexCnt]->thumbsm = $line->ThumbSm;
						$this->readerarray[$IndexCnt]->thumbmd = $line->ThumbMd;
						$this->readerarray[$IndexCnt]->ThumbLg = $line->ThumbLg;
						$this->readerarray[$IndexCnt]->chapter = $line->Chapter;
						$this->readerarray[$IndexCnt]->episode =  $line->Episode;
						$this->readerarray[$IndexCnt]->EpisodeDesc =  $line->EpisodeDesc;
						$this->readerarray[$IndexCnt]->EpisodeWriter =  $line->EpisodeWriter;
						$this->readerarray[$IndexCnt]->EpisodeArtist =  $line->EpisodeArtist;
						$this->readerarray[$IndexCnt]->EpisodeColorist =  $line->EpisodeColorist;
						$this->readerarray[$IndexCnt]->EpisodeLetterer =  $line->EpisodeLetterer;
						$this->readerarray[$IndexCnt]->Filename = $line->Filename;
						$this->readerarray[$IndexCnt]->position = $line->Position;
						$this->readerarray[$IndexCnt]->FileType = $line->FileType;
						$this->readerarray[$IndexCnt]->ViewType = $line->ViewType;
						$this->readerarray[$IndexCnt]->AllowPdf = $line->AllowPdf;
						$this->readerarray[$IndexCnt]->HTMLFile = $line->HTMLFile;
						$this->readerarray[$IndexCnt]->Pdffile = $line->Pdffile;
						$this->readerarray[$IndexCnt]->PageXP = $line->PageXP;
						$this->readerarray[$IndexCnt]->SeriesNum = $line->SeriesNum;
						$this->readerarray[$IndexCnt]->EpisodeNum = $line->EpisodeNum;
						$this->readerarray[$IndexCnt]->EpPosition = $line->EpPosition;
						$this->readerarray[$IndexCnt]->PublishDate = $line->PublishDate;
						$this->readerarray[$IndexCnt]->PrivacySetting = $line->AccessType;
						if ($EpisodeNum != '') {
								if (($line->EpPosition == $this->PagePosition) && ($line->EpisodeNum == $EpisodeNum)) 
									$this->CurrentIndex =($IndexCnt);
						} else {
							if ($line->Position == $this->PagePosition) 
								$this->CurrentIndex =($IndexCnt);
						}
						
							
						if (($line->Episode == 0) && ($InEpisode == 1)) {
							if ($this->LatestPageCount > 60) {
								$this->EpisodePart++;
								$this->LatestPageCount = 1;
							}	
						} else if (($line->Episode == 1) && ($this->InEpisode == 0)) {
								$this->LatestEpisode++;	
								$this->LatestPageCount = 1;
						} else 	if (($line->Episode == 0) && ($this->InEpisode == 0)) {
							if ($LatestPageCount > 60) {
								$this->EpisodePart++;
								$this->LatestPageCount = 1;
							}	
						}	
						$IndexCnt++;
						$this->LastPage = $line->EpPosition;
				}	
				
				$this->PageID = 			$this->readerarray[$this->CurrentIndex]->id;
				$this->AuthorComment = 		$this->readerarray[$this->CurrentIndex]->Comment;
				$this->EpisodeDesc = 		$this->readerarray[$this->CurrentIndex]->EpisodeDesc;
				$this->EpisodeWriter = 		$this->readerarray[$this->CurrentIndex]->EpisodeWriter;
				$this->EpisodeArtist = 		$this->readerarray[$this->CurrentIndex]->EpisodeArtist;
				$this->EpisodeColorist = 	$this->readerarray[$this->CurrentIndex]->EpisodeColorist;
				$this->EpisodeLetterer = 	$this->readerarray[$this->CurrentIndex]->EpisodeLetterer;
				$this->Image = 				$this->readerarray[$this->CurrentIndex]->image;
				$this->CurrentPageThumb = 	$this->readerarray[$this->CurrentIndex]->thumbmd;
				$this->ProImage = 			$this->readerarray[$this->CurrentIndex]->proimage;
				$this->Title = 				$this->readerarray[$this->CurrentIndex]->title;
				$this->FileType = 			$this->readerarray[$this->CurrentIndex]->FileType;
				$this->MediaFile = 			$this->readerarray[$this->CurrentIndex]->Filename;
				$this->ImageHeight = 		$this->readerarray[$this->CurrentIndex]->imgheight;	
				$this->ViewType = 			$this->readerarray[$this->CurrentIndex]->ViewType;	
				$this->HTMLFile = 			$this->readerarray[$this->CurrentIndex]->HTMLFile;	
				$this->Pdffile = 			$this->readerarray[$this->CurrentIndex]->Pdffile;	
				$this->AllowPdf = 			$this->readerarray[$this->CurrentIndex]->AllowPdf;	
				$this->PageXP= 				$this->readerarray[$this->CurrentIndex]->PageXP;
				$this->EpisodeNum= 			$this->readerarray[$this->CurrentIndex]->EpisodeNum;	
				$this->SeriesNum= 			$this->readerarray[$this->CurrentIndex]->SeriesNum;	
				$this->EpPosition= 			$this->readerarray[$this->CurrentIndex]->EpPosition;
				$this->CurrentPageDate= 	$this->readerarray[$this->CurrentIndex]->PublishDate;	
				$this->Privacy= 			$this->readerarray[$this->CurrentIndex]->PrivacySetting;
				
				$this->getConnectedEntires('','page');
			
				if (($this->Image == '') && ($this->Filename) && ($this->ProjectLastPage != '')) {
					$NoPageRedir = "/".$this->SafeFolder."/reader/";	
					if ($this->LastSeries != 1)
						$NoPageRedir .= 'series/'.$this->LastSeries.'/';
						$NoPageRedir .= 'episode/'.$this->LastEpisode.'/';	
						$NoPageRedir .= 'page/'.$this->ProjectLastPage.'/';	
											
					header("location:".$NoPageRedir);
					
				}
				
				if ($this->CurrentIndex != ($this->TotalReaderPages-1)) {
					//if ($EpisodeNum != '') 
					 $this->NextPage = 	$this->readerarray[$this->CurrentIndex+1]->EpPosition;
					 $this->NextEpisode = 	$this->readerarray[$this->CurrentIndex+1]->EpisodeNum;
					// else
					// $this->NextPage = 	$this->readerarray[$this->CurrentIndex+1]->position;
					if (($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)){
					  $this->NextPageImage = $this->readerarray[$this->CurrentIndex+1]->proimage;
					 } else {
					  $this->NextPageImage = $this->readerarray[$this->CurrentIndex+1]->image;
					 }
				 } else {
				 	$this->NextPage = 	$this->LastPage;
				 	if (($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)){
					  $this->NextPageImage = $this->readerarray[$this->CurrentIndex+1]->proimage;
					 } else {
					  $this->NextPageImage = $this->readerarray[$this->CurrentIndex+1]->image;
					 }
				  		
						 
				 }
				//if ($_SESSION['username'] == 'matteblack')
				//	print_r($this->readerarray[$this->CurrentIndex]);
				 if ($this->CurrentIndex > 0) {
					// if ($EpisodeNum != '') 
					 $this->PrevPage = 	$this->readerarray[$this->CurrentIndex-1]->EpPosition;
					 $this->PrevEpisode = 	$this->readerarray[$this->CurrentIndex-1]->EpisodeNum;
					// else
					// $this->PrevPage = 	$this->readerarray[$this->CurrentIndex-1]->position;
				    // $this->PrevPage = $this->readerarray[$this->CurrentIndex-1]->position;
					 if (($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)){
					  $this->PrevPageImage = $this->readerarray[$this->CurrentIndex-1]->proimage;
					 } else {
					   $this->PrevPageImage = $this->readerarray[$this->CurrentIndex-1]->image;
					 }
					
				  } else { 
					$this->PrevPage = $this->LastPage;
				  }
				  
				  $query = "select AccessType from Episodes where ProjectID = '".$this->ProjectID."' and EpisodeNum='$EpisodeNum' and SeriesNum='$SeriesNum'";
				  $this->EpisodeAccess = $db->queryUniqueValue($query);
				
				  $query = "select AccessType from series where ProjectID = '".$this->ProjectID."' and SeriesNum='$SeriesNum'";
				  $this->SeriesAccess = $db->queryUniqueValue($query);
				  if ($this->Privacy == 'public') {
					  if  (($this->SeriesAccess == 'fans') || ($this->SeriesAccess == 'superfans'))
					  		$this->Privacy = $this->SeriesAccess;
					   else if  (($this->EpisodeAccess == 'fans') || ($this->EpisodeAccess == 'superfans'))
					  		$this->Privacy = $this->EpisodeAccess;
				  }
				//  $this->LastPage = ($IndexCnt);	
				  
				  $db->close();	
				 
				 /*
				 if ($_SESSION['username'] == 'matteblack') {
					print $output.'<br/>'; 
					print 'LAST PAGE = ' . $this->EpPosition.'<br/>';
					print 'Real last page = ' . $this->ProjectLastPage;
					print 'PAGE POSITION = ' .$this->PagePosition;
				 }
				 */
		}
		
		public function buildArchivesDropdown() {
						$boxString = '<form id="jumpbox" action="#" method="get">';
						$ArchiveDropDown ='<select id="dropdown" style="width:95%;" name="url" onchange="window.location = this.options[this.selectedIndex].value;"> ';
						$TotalPages = 0;
						$PreviousEpisode = '';
						for ($k=0; $k< $this->TotalReaderPages; $k++){
							if ($this->readerarray[$k]->EpisodeNum != $PreviousEpisode) {
								$PreviousEpisode = $this->readerarray[$k]->EpisodeNum;
								$ArchiveDropDown .= "<option style='background-color:#8cc2ff;' value='/";
								$ArchiveDropDown .= $this->SafeFolder.'/';
								if ($_SESSION['readerpage'] == 'inline')
									$ArchiveDropDown .= 'inline';
									$ArchiveDropDown .= 'reader/';
								if ($this->readerarray[$k]->SeriesNum != 1)
									$ArchiveDropDown .= 'series/'.$this->readerarray[$k]->SeriesNum.'/';
								$ArchiveDropDown .= 'episode/'.$this->readerarray[$k]->EpisodeNum.'/';
								$ArchiveDropDown .= "page/".$this->readerarray[$k]->EpPosition."/'";
								if ($this->readerarray[$k]->id==$this->PageID) {
					    				$FoundPage = 1;
										$ArchiveDropDown.= 'selected'; 
								} 
				
								$ArchiveDropDown .="><b>EPISODE </b>".$this->readerarray[$k]->EpisodeNum." - ".$this->readerarray[$k]->title."</option>";
								
							    $ChapterCount = 1;
					  			$ChapterPageCount = 1;
							} else {
							
							if ($this->readerarray[$k]->chapter == 1) {
									if ($Inchapter == 1) 
			  	 						$ChapterPageCount = 1;
									$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/". $this->SafeFolder."/";
									if ($_SESSION['readerpage'] == 'inline')
									$ArchiveDropDown .= 'inline';
									
									$ArchiveDropDown .= 'reader/';
									if ($this->readerarray[$k]->SeriesNum != 1)
										$ArchiveDropDown .= 'series/'.$this->readerarray[$k]->SeriesNum.'/';
									$ArchiveDropDown .= 'episode/'.$this->readerarray[$k]->EpisodeNum.'/';
									$ArchiveDropDown .= "page/".$this->readerarray[$k]->EpPosition."/'";
									if ($this->readerarray[$k]->id==$this->PageID) {
										$FoundPage = 1;
										if ($InEpisode == 1) {
											$Writer = $EpisodeWriterTemp;
											$Artist = $EpisodeArtistTemp;
											$Colorist = $EpisodeColoristTemp;
											$Letterist = $EpisodeLettererTemp;
										}
										$ArchiveDropDown .= 'selected'; 
									} 
									$ArchiveDropDown .= "><b>CHAPTER </b>".$ChapterCount." - ".$this->readerarray[$k]->title."</option>";  
									if ($InEpisode == 1)
										$ChapterString .= "<div class='modheader'>Chapter ".$ChapterCount."</div>
															<div class='pagelinks'><a href='/". $this->SafeFolder."/";
									if ($_SESSION['readerpage'] == 'inline')
									$ArchiveDropDown .= 'inline';
									$ArchiveDropDown .= 'reader/';
									$ArchiveDropDown .= 'episode/'.$this->readerarray[$k]->EpisodeNum.'/';
									$ArchiveDropDown .= "page/".$this->readerarray[$k]->EpPosition."/'>
															".$this->readerarray[$k]->title."</a></div><div class='smspacer'></div>";
						

									$Inchapter = 1;
									$ChapterCount++;
							} else {
			 					if ($Inchapter == 1) {
									$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/". $this->SafeFolder."/";
									if ($_SESSION['readerpage'] == 'inline')
									$ArchiveDropDown .= 'inline';
									$ArchiveDropDown .= 'reader/';
									if ($this->readerarray[$k]->SeriesNum != 1)
										$ArchiveDropDown .= 'series/'.$this->readerarray[$k]->SeriesNum.'/';
									$ArchiveDropDown .= 'episode/'.$this->readerarray[$k]->EpisodeNum.'/';
									$ArchiveDropDown .= "page/".$this->readerarray[$k]->EpPosition."/'";
									if ($this->readerarray[$k]->id==$this->PageID) {
										$FoundPage = 1;
										$ArchiveDropDown .= 'selected'; 
									} 
									$ArchiveDropDown .= ">&nbsp;&nbsp;&nbsp;Page ".$ChapterPageCount." - ".$this->readerarray[$k]->title."</option>";
									$ChapterPageCount++;
								} else {
									$ArchiveDropDown .= "<option style='background-color:#fce4aa;' value='/". $this->SafeFolder."/";
									if ($_SESSION['readerpage'] == 'inline')
										$ArchiveDropDown .= 'inline';
									
									$ArchiveDropDown .= 'reader/';
									if ($this->readerarray[$k]->SeriesNum != 1)
										$ArchiveDropDown .= 'series/'.$this->readerarray[$k]->SeriesNum.'/';
									$ArchiveDropDown .= 'episode/'.$this->readerarray[$k]->EpisodeNum.'/';
									$ArchiveDropDown .= "page/".$this->readerarray[$k]->EpPosition."/'";
									if ($this->readerarray[$k]->id==$this->PageID) {
										$FoundPage = 1;
										$ArchiveDropDown .= 'selected'; 
									} 
									$ArchiveDropDown .= ">-> ".$this->readerarray[$k]->title."</option>";
								}
			
							}
							}
					} // end for

				$ArchiveDropDown .='</select>';
				$boxString .= $ArchiveDropDown.'<input type="hidden" name="url" value="index.php?id=" /> </form>';
				
				return $boxString;
		}
		public function getPageTitle() {
				return $this->Title;
		
		}
		
		
		public function setheader($Module,$Title, $Image) {
						 switch ($Module['ModuleCode']) {
   		 		case 'authcom':
					$HeaderString = '<div id="AuthorComment" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Author Notes';
						} else {
							$HeaderString .=$Title;
						}
					}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'authcomm':
					$HeaderString = '<div id="AuthorComment" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Author Notes';
						} else {
							$HeaderString .=$Title;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'custommod':
				
				 if ($Module['CustomVar3'] == '1') {
					$HeaderString = '<div class="modheader">';
					
							$HeaderString .=$Title;
						
					
					$HeaderString .='</div>';
					
					}
					
					return $HeaderString;
					break;
					
				case 'superfan':
				
				 if ($Module['CustomVar3'] == '1') {
					$HeaderString = '<div class="modheader">';
					
							$HeaderString .=$Title;
						
					
					$HeaderString .='</div>';
					
					}
					
					return $HeaderString;
					break;
					
				
											
				case 'latestpage':
					$HeaderString = '<div id="AuthorComment" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Read Latest Page';
						} else {
							$HeaderString .=$Title;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'pagecom':
					$HeaderString = '<div id="UserComments" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Comments';
						} else {
							$HeaderString .=$Title;
						}
						
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
    			case 'comicinfo':
					$HeaderString .= '<div id="ComicInfo" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Comic Info';
						} else {
							$HeaderString .=$Title;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'comicsyn':
					$HeaderString .= '<div id="ComicSynopsis" class="modheader">';
					if ($Image == '') {
						if ($Title == '') {
							$HeaderString .='Synopsis';
						} else {
							$HeaderString .=$Title;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'linksbox':
					$HeaderString .= '<div id="LinksBox" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Links';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;	
				
				case 'products':
					$HeaderString .= '<div id="Products" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Products';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$this->SafeFolder."/products/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;	
				
				case 'mobile':
					$HeaderString .= '<div id="Mobile" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Mobile';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$this->SafeFolder."/mobile/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
			
				case 'characters':
					$HeaderString .= '<div id="characters" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Characters';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$this->SafeFolder."/characters/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
				case 'downloads':
					$HeaderString .= '<div id="Downloads" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Downloads';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$this->SafeFolder."/downloads/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
				case 'otherprojects':
					$HeaderString .= '<div id="Comics" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Other Projects';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'comicsynopsis':
					$HeaderString .= '<div id="Synopsis" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Synopsis';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'synopsis':
					$HeaderString .= '<div id="Synopsis" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Synopsis';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'feed':
					$HeaderString .= '<div id="feedheader" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Actvity Feed';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;	
				case 'forum':
					$HeaderString .= '<div id="Forum" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Latest Forum Topics';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'status':
					$HeaderString .= '<div id="Status" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Status';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'credits':
					$HeaderString .= '<div id="ComicCredits" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Credits';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'episodes':
					$HeaderString .= '<div id="Episodes" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Episodes';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
					case 'twitter':
					$HeaderString .= '<div id="Twitter" class="modheader">';

						if ($Title == '') {
							$HeaderString .='Twitter Updates';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
					case 'fblikebox':
					$HeaderString .= '<div class="modheader">';

						if ($Title == '') {
							$HeaderString .='Facebook Like';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
					
					case 'blog':
					$HeaderString .= '<div class="modheader">';

						if ($Title == '') {
							$HeaderString .='Recent Blog Posts <span class="pagelinks">[<a href="/'.$this->SafeFolder.'/blog/">read blog</a>]';
						} else {
							$HeaderString .=$Title;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				   default:
				   case 'episodes':
					case 'series':
					case 'chapters':
					case 'postcal':
					 if (($Module['CustomVar3'] == '1') || ($Module['CustomVar3'] == '')) {
						$HeaderString = '<div class="modheader">';
								$HeaderString .=$Title;
						$HeaderString .='</div>';
						
						}
						
						return $HeaderString;
						break;	
					
				}
		}

		
		
		public function getModules($Section,$Placement) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
				if ($Section == 'Reader') {
					$query = "SELECT * from pf_modules where ComicID='".$this->ProjectID."' and IsPublished=1 and ReaderMod=1 and ReaderPlacement='$Placement' order by ReaderPosition";
					$db->query($query);
					$TotalMods = $db->numRows();
					if ($TotalMods == 0) {
						$ModuleListArray[] = array('ModuleCode'=>'authcom');
						$ModuleListArray[] = array('ModuleCode'=>'comform');
						$ModuleListArray[] = array('ModuleCode'=>'pagecom');
					} else {
						while ($line = $db->fetchNextObject()) {
								$ModuleCode = $line->ModuleCode;
								if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo')) 
									$ModuleListArray[] = array(
																'ModuleCode'=>$ModuleCode,
																'Title'=>$line->Title,
																'Text-Align'=>$line->text_align,
																'CustomVar1'=>$line->CustomVar1,
																'CustomVar2'=>$line->CustomVar2,
																'CustomVar3'=>$line->CustomVar3,
																'CustomVar4'=>$line->CustomVar4,
																'CustomVar5'=>$line->CustomVar5,
																'ModuleTemplate'=>$line->ModuleTemplate,
																'ModuleType'=>$line->ModuleType,
																'CustomModuleCode'=>stripslashes($line->HTMLCode)
														
																);						
						}
						
					}
				} else {
						if ($Section == 'Home') 
							$query = "SELECT * from pf_modules where ComicID='".$this->ProjectID."' and Homepage=1 and IsPublished=1 and Placement='$Placement' order by Position";
						else
							$query = "SELECT * from pf_modules where ComicID='".$this->ProjectID."' and IsPublished=1 and ReaderMod=1 and ReaderPlacement='$Placement' order by ReaderPosition";
						$db->query($query);
						$TotalMods = $db->numRows();
		
						if (( $TotalMods == 0) && ($Placement == 'left')) {
							$ModuleListArray[] = array('ModuleCode'=>'latestpage');
							$ModuleListArray[] = array('ModuleCode'=>'authcom');
						} else if (( $TotalMods == 0) && ($Placement == 'right')) {
							$ModuleListArray[] = array('ModuleCode'=>'synopsis');
							$ModuleListArray[] =  array('ModuleCode'=>'credits');
						
						}
						while ($line = $db->fetchNextObject()) {
								$ModuleCode = $line->ModuleCode;
								if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo')) 
									$ModuleListArray[] = array(
																'ModuleCode'=>$ModuleCode,
																'Title'=>$line->Title,
																'Text-Align'=>$line->text_align,
																'CustomVar1'=>$line->CustomVar1,
																'CustomVar2'=>$line->CustomVar2,
																'CustomVar3'=>$line->CustomVar3,
																'CustomVar4'=>$line->CustomVar4,
																'CustomVar5'=>$line->CustomVar5,
																'ModuleTemplate'=>$line->ModuleTemplate,
																'ModuleType'=>$line->ModuleType,
																'CustomModuleCode'=>stripslashes($line->HTMLCode)
														
																);							
						}
						
				}
				$db->close();
				return $ModuleListArray;
		}
		
		public function getHomeModules() {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
				$HomeModuleArray = array();	
				$query = "SELECT * from pf_modules where ComicID='".$this->ProjectID."' and IsPublished=1 and Homepage=1";
				$db->query($query);
				while ($line = $db->fetchNextObject()) {
					$ModuleCode = $line->ModuleCode;
					if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo')) 
					$HomeModuleArray[] =  array(
																'ModuleCode'=>$ModuleCode,
																'Title'=>$line->Title,
																'Text-Align'=>$line->text_align,
																'CustomVar1'=>$line->CustomVar1,
																'CustomVar2'=>$line->CustomVar2,
																'CustomVar3'=>$line->CustomVar3,
																'CustomVar4'=>$line->CustomVar4,
																'CustomVar5'=>$line->CustomVar5,
																'ModuleTemplate'=>$line->ModuleTemplate,
																'ModuleType'=>$line->ModuleType,
																'CustomModuleCode'=>stripslashes($line->HTMLCode)
														
																);	
				}
				$db->close();	
				return $HomeModuleArray;
		}
		
		public function setSynopsis($Synopsis) {
						$this->Synopsis = $Synopsis;
		}
		
		public function setCredits($CreditsString) {
						$this->Credits = $CreditsString;
		}
		
		public function getProjectSynopsis() {
						return $this->Synopsis;
		}
		
		public function setContentWidth($value) {
						$this->ContentWidth = $value;
		}
		
		public function getCredits() {
						return $this->Credits;
		}
		
		public function setProjectInfo($array) {
						return $this->ProjectArray = $array;
		}
		
		public function setPFDIRECTORY($PFDIRECTORY){
						$this->PFDIRECTORY = $PFDIRECTORY;
		}
		
		
		public function setProjectBaseDirectoty($BaseProjectDirectory){
						$this->BaseProjectDirectory = $BaseProjectDirectory;
		}
		
		public function setOwner($value){
						$this->IsOwner = $value;
		}
		
		public function setProjectSettings($Array){
						
						$this->SettingArray = $Array;
		}
		
		public function setAdminUser($Array){
					
						$this->AdminUserArray = $Array;
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "select count(*) 
								   from friends where (FriendID='".$this->AdminUserArray['UserID']."' 
								   and UserID='".$_SESSION['userid']."') and 
								   Accepted=1 and FriendType='friend'";
						$this->IsFriend = $db->queryUniqueValue($query);

						if ($this->IsFriend == 0) {
							$query = "select count(*) 
								   from friends where (FriendID='".$this->AdminUserArray['UserID']."' 
								   and UserID='".$_SESSION['userid']."') and 
								   Accepted=0 and FriendType='friend'";
							$this->Requested = $db->queryUniqueValue($query);
						}
						$db->close();
		}
		
		public function setCreatorInfo($Array){
					
						$this->CreatorArray = $Array;
		}
		
		public function getTwitterMod($ModuleArray, $width) {
			
						$String .='<div id="tweet_'.$ModuleArray['CustomVar1'].'" align="left" style="width:'.$width.'px;overflow:hidden;" class="messageinfo">';
 					$String .='<div align=\'center\'>Please wait while my tweets load';
 					$String .='<p><a href="http://twitter.com/'.$ModuleArray['CustomVar1'].'">If you can\'t wait - check out what I\'ve been twittering</a></p></div>';
					$String .='<div class="menubar"><a href="http://twitter.com/'.$ModuleArray['CustomVar1'].'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a></div><script type="text/javascript" charset="utf-8">
getTwitters(\'tweet_'.$ModuleArray['CustomVar1'].'\', { 
  id: \''.$ModuleArray['CustomVar1'].'\', 
  count: '.$ModuleArray['CustomVar2'].', 
  enableLinks: true, 
  ignoreReplies: true, 
  clearContents: true,
  template: \'%text% <br/><a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a><div style="height:5px;"></div>\'
});
</script>';





/*
			
						$String .='<div id="tweet_'.$ModuleArray['CustomVar1'].'" align="left" style="width:95%; padding-right:10px;" class="projectboxcontent">';
 					$String .='Please wait while my tweets load <img src="http://www.wevolt.com/images/load.gif" />';
 					$String .='<p><a href="http://twitter.com/'.$ModuleArray['CustomVar1'].'">If you can\'t wait - check out what I\'ve been twittering</a></p></div>';
					$String .='<div class="menubar"><a href="http://twitter.com/'.$ModuleArray['CustomVar1'].'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a></div><script type="text/javascript">
    $(document).ready(function(){
        $("#tweet_'.$ModuleArray['CustomVar1'].'").tweet({
            username: "'.$ModuleArray['CustomVar1'].'",
            join_text: "auto",
            avatar_size: 32,
            count: '.$ModuleArray['CustomVar2'].',
            auto_join_text_default: "we said,", 
            auto_join_text_ed: "we",
            auto_join_text_ing: "we were",
            auto_join_text_reply: "we replied to",
            auto_join_text_url: "we were checking out",
            loading_text: "loading tweets..."
        });
    });
</script>';

*/
					
					/*<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$ContentVariable.'.json?callback=twitterCallback2&amp;count='.$NumberVariable.'"></script>';*/
					
					$String .='</div>';
					if ($ModuleArray['CustomVar3'] == '1')
	$String .='<a href="http://www.twitter.com/'.$ModuleArray['CustomVar1'].'" target="_blank">Follow me on twitter</a>';
					return $String;
					
		}
						
		public function drawLatestPageMod($module,$Width,$SeriesNum=1) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$EPSelect = $module['CustomVar5'];
						if ($EPSelect != '')
							$where .= " and cp.EpisodeNum='$EPSelect'";
						$SeriesSelect = $module['CustomVar4'];
						if ($SeriesSelect != '')
							$where .= " and cp.SeriesNum='$SeriesSelect'";
							
						if ($module['CustomVar1'] == '')
						$query = "select cp.ThumbLg, cp.EpPosition, cp.PublishDate, cp.Position, cp.EpisodeNum, cp.SeriesNum, cp.HTMLFile from comic_pages as cp where cp.ComicID='".$this->ProjectID."' and cp.PublishDate<='".$this->CurrentDate."'".$where." order by cp.PublishDate DESC";
						else
						$query = "select cp.ThumbLg, cp.EpPosition, cp.PublishDate, cp.Position, cp.EpisodeNum,cp.SeriesNum, cp.HTMLFile, p.SafeFolder 
						          from comic_pages as cp
								  inner join projects as p on p.ProjectID=cp.ComicID
								  where p.SafeFolder='".$module['CustomVar1']."' and cp.PublishDate<='".$this->CurrentDate."' ".$where."
								  order by cp.PublishDate DESC";
								  	
						$Array =  $db->queryUniqueObject($query);
						
						$LatestPageThumb =$Array->ThumbLg;
						$LastPage = $Array->EpPosition;
						$FBLikeURL = '%2F'.$this->SafeFolder.'%2Freader';
						 if ($this->ProjectType == 'writing') {
								$Contents = file_get_contents('http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$Array->HTMLFile);
								$Contents = substr($Contents,0,800);
								
								
								$String = '<div onclick="window.location.href=\'/'.$this->SafeFolder.'/reader';
								
								if ($Array->SeriesNum != 1){
									$String .='/series/'.$Array->SeriesNum;
									$FBLikeURL .= '%2Fseries%2F'.$Array->SeriesNum;
									
								}
								$FBLikeURL .= '%2Fepisode%2F'.$Array->EpisodeNum.'%2Fpage%2F'.$LastPage.'%2F';
								$String .='/episode/'.$Array->EpisodeNum;
								
								$String .= '/page/'.$LastPage.'/\';" class="navbuttons" style="font-size:10px;">';
								$String .=$Contents.'...<div class="spacer"></div>CLICK TO READ MORE';
								//$String .= '<div class="spacer"></div>';
								$String .="</div>";
						 } else {
						
							$String= '<a href="/'.$this->SafeFolder.'/reader';
							if ($Array->SeriesNum != 1){
										$String .='/series/'.$Array->SeriesNum;
										$FBLikeURL .= '%2Fseries%2F'.$Array->SeriesNum;
										
									}
									$FBLikeURL .= '%2Fepisode%2F'.$Array->EpisodeNum.'%2Fpage%2F'.$LastPage.'%2F';
									
							$String .='/episode/'.$Array->EpisodeNum;
							$String .= '/page/'.$LastPage.'/"><img src="http://www.wevolt.com/'.$LatestPageThumb.'" width="'.($Width-20).'" border="0"></a>';
						 }
						 
						 if ($module['CustomVar3'] == '1')

						 	$String .= '<div align="center"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.wevolt.com'.$FBLikeURL.'&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.($Width-20).'px; height:80px;" allowTransparency="true"></iframe></div>';
						$db->close();
						return $String;
		}
		
		public function getAuthorComment($module='') {
					
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						
						if ($this->Section == 'Home') {
							
								
						if ($module['CustomVar1'] == '')
						$query = "select cp.Comment,cp.ThumbLg, cp.EpPosition, cp.PublishDate, cp.Position, cp.EpisodeNum, cp.SeriesNum, cp.HTMLFile, u.avatar, u.username from comic_pages as cp
						 			 inner join projects as p on p.ProjectID=cp.ComicID
									  join users as u on p.CreatorID=u.encryptid
									   where cp.ComicID='".$this->ProjectID."' and cp.PublishDate<='".$this->CurrentDate."'".$where." order by cp.PublishDate DESC";
						else
						$query = "select cp.Comment, cp.ThumbLg, cp.EpPosition, cp.PublishDate, cp.Position, cp.EpisodeNum,cp.SeriesNum, cp.HTMLFile, p.SafeFolder, u.avatar, u.username 
						          from comic_pages as cp
								  inner join projects as p on p.ProjectID=cp.ComicID
								  join users as u on p.CreatorID=u.encryptid
								  where p.SafeFolder='".$module['CustomVar1']."' and cp.PublishDate<='".$this->CurrentDate."'
								  order by cp.PublishDate DESC";
							
							
						} else {
						
						if (($this->PageID == '') && ($module['CustomVar1'] == ''))
							$query = "select cp.Comment, cp.PublishDate, u.avatar, u.username
									  from comic_pages as cp
									  join projects as p on p.ProjectID=cp.ComicID
									  join users as u on p.CreatorID=u.encryptid
									  where cp.ComicID='".$this->ProjectID."' and cp.PublishDate<='".$this->CurrentDate."' order by cp.SeriesNum, cp.EpisodeNum,cp.EpPosition DESC";
						else if (($this->PageID != '') && ($module['CustomVar1'] == ''))
							$query = "select cp.Comment, cp.PublishDate, u.avatar, u.username
									  from comic_pages as cp
									  join projects as p on p.ProjectID=cp.ComicID
									  join users as u on p.CreatorID=u.encryptid
									  where cp.ComicID='".$this->ProjectID."' and cp.EncryptPageID='".$this->PageID."'";
						 else if (($this->PageID == '') && ($module['CustomVar1'] != ''))
							$query = "select cp.Comment, cp.PublishDate, u.avatar, u.username, p.SafeFolder
									  from comic_pages as cp
									  inner join projects as p on p.ProjectID=cp.ComicID
									  join users as u on p.CreatorID=u.encryptid
									  where p.SafeFolder='".$module['CustomVar1']."' and cp.PublishDate<='".$this->CurrentDate."' order by cp.SeriesNum, cp.EpisodeNum,cp.EpPosition DESC";
									  
						 else if (($this->PageID != '') && ($module['CustomVar1'] != ''))
							$query = "select cp.Comment, cp.PublishDate, u.avatar, u.username, p.SafeFolder
									  from comic_pages as cp
									  inner join projects as p on p.ProjectID=cp.ComicID
									  join users as u on p.CreatorID=u.encryptid
									  where p.SafeFolder='".$module['CustomVar1']."' and cp.EncryptPageID='".$this->PageID."'";
						}
						$Array =  $db->queryUniqueObject($query);
						
							$this->AuthorComment = 0;
						if ($Array->Comment != '') {
							
							$Comment =preg_replace('/(?:(?:\r\n)|\r|\n){3,}/', "\n\n", $Array->Comment);
							
							$String .='<div class="projectboxcontent" style="padding-left:10px;">posted: '.date('F j, Y',strtotime($Array->PublishDate)).'</div>';
							$String .='<div class="notespacer"></div>';
							$String .='<div style="padding-left:10px;"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="left" valign="top" class="projectboxcontent" width="75" align="center"><a href="http://users.wevolt.com/'.trim($Array->username).'/"><b>'.$Array->username.'</b><br /><img src="'.$Array->avatar.'" border="2" align="left" hspace="4" vspace="2" width="50" height="50"/></a>';
							
							
							if (($_SESSION['userid'] != '') && (($this->IsFriend==0)||(($this->Requested==0)&&($this->IsFriend==0))) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))
								$String.='<a href="javascript:void(0)" onclick="network_wizard(\''.trim($Array->username).'\',\''.$_SESSION['userid'].'\',\'\');"><img src="http://www.wevolt.com/images/add_friend_box.png" border="0"></a>&nbsp;&nbsp;';
							if (($_SESSION['userid'] != '') && ($this->IsFollowing==0) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))
								$String.='<span id="follow_project_div"><a href="javascript:void(0)" onclick="follow(\''.$this->ProjectID.'\',\''.$_SESSION['userid'].'\',\'project\');"><img src="http://www.wevolt.com/images/follow_project_box.png" border="0"></a>&nbsp;&nbsp;</span>';
							$String.='<br/>';
							
							$String.= nl2br(stripslashes($Comment)).'</td></tr></table></div>';
							$this->AuthorComment = 1;
												
						} 
						$db->close();
						return $String;
		}
		
		public function getDownloadsModule($module) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String = "<div align=\"center\">";
						
						$where .= " and (cd.PrivacySetting='public'";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((cd.PrivacySetting='superfans') or (cd.PrivacySetting='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or cd.PrivacySetting='fans') ";
						else 
								$where .= ")";	
								
						if ($module['CustomVar1'] == '')
						$query = "select * from comic_downloads as cd where (cd.ComicID = '".$this->ProjectID."' or cd.ProjectID='".$this->ProjectID."') $where order by RAND() limit 3";
						else
						$query = "select cd.*,p.SafeFolder from comic_downloads as cd
								  inner join projects as p on p.ProjectID=cd.ProjectID
								  where p.SafeFolder='".$module['CustomVar1']."' $where order by RAND() limit 3";
	
						$db->query($query);
						
						$NumDownloads = $db->numRows();

						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->ID;
								$Downname = $download->Name; 
								$DlImage = $download->Image;
								$DlThumb = $download->Thumb; 
								$DlEncryptID = $download->EncryptID; 
								$String .= "<a href='/".$this->PFDIRECTORY."/download_content.php?id=".$DlEncryptID."'><img src='";
								$String .= $this->BaseProjectDirectory.$DlThumb."'  border='1' style='border-color:#000000;' hspace='5' vspace='5'></a>";
						}
						$String .= "</div>";
						$db->close();
						return $String;
		}
		
		public function drawEpisodesModule($module,$Width) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$SelectedSeries=$module['CustomVar4'];
						if ($SelectedSeries != '')
							$where = "and e.SeriesNum='$SelectedSeries'";
						if ($module['CustomVar1'] == '')
						$query = "select e.* from Episodes as e where ProjectID = '".$this->ProjectID."' ".$where." order by e.SeriesNum,e.EpisodeNum";
						else
						$query = "select e.*,p.SafeFolder from Episodes as e
								  inner join projects as p on p.ProjectID=e.ProjectID
								  where p.SafeFolder='".$module['CustomVar1']."'".$where." order by e.SeriesNum,e.EpisodeNum";
	
						$db->query($query);
						$LastSeries = 0;
						while ($line = $db->fetchNextObject()) { 
							if ($LastSeries != $line->SeriesNum) {
									$LastSeries = $line->SeriesNum;
									$String .= "<div>Series ".$line->SeriesNum."</div>";
							}
								if ($module['CustomVar2'] == 'vertical thumbs') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/1/"><img src="http://www.wevolt.com/'.$line->ThumbMd.'" width="'.($Width-20).'" border="0"></a><div class="spacer"></div>';
								} else if ($module['CustomVar2'] == 'thumb box') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/1/"><img src="http://www.wevolt.com/'.$line->ThumbMd.'" width="75" height="75" border="0" vspace="5" hspace="5"></a>';
								} else if ($module['CustomVar2'] == 'text list') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/1/">Episode '.$line->EpisodeNum.' - '.$line->Title.'</a><div class="spacer"></div>';
								} 
								
						}

						$db->close();
						return $String;
		}
		
		public function drawSeriesModule($module,$Width) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						
						if ($module['CustomVar1'] == '')
						$query = "select * from series where ProjectID = '".$this->ProjectID."'order by SeriesNum";
						else
						$query = "select s.*,p.SafeFolder from series as s
								  inner join projects as p on p.ProjectID=s.ProjectID
								  where p.SafeFolder='".$module['CustomVar1']."' order by s.SeriesNum";
	
						$db->query($query);
						$LastSeries = 0;
						while ($line = $db->fetchNextObject()) { 
							if ($LastSeries != $line->SeriesNum) {
									$LastSeries = $line->SeriesNum;
									$String .= "<div>Series ".$line->SeriesNum." - ".$line->Title."</div>";
							}
								if ($module['CustomVar2'] == 'vertical thumbs') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/1';
									$String .= '/page/1/"><img src="http://www.wevolt.com/'.$line->Image.'" width="'.($Width-20).'" border="0"></a><div class="spacer"></div>';
								} else if ($module['CustomVar2'] == 'thumb box') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/1';
									$String .= '/page/1/"><img src="http://www.wevolt.com/'.$line->Image.'" width="75" height="75" border="0" vspace="5" hspace="5"></a>';
								} else if ($module['CustomVar2'] == 'text list') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/1';
									$String .= '/page/1/">Series '.$line->SeriesNum.' - '.$line->Title.'</a><div class="spacer"></div>';
								} 
								
						}

						$db->close();
						return $String;
		} 
		
		public function drawChapterModule($module,$Width) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						
						$SelectedSeries=$module['CustomVar4'];
						if ($SelectedSeries != '')
							$where = "and cp.SeriesNum='$SelectedSeries'";
							
						
						$SelectedEpisode=$module['CustomVar5'];
						if ($SelectedEpisode != '')
							$where .= " and cp.EpisodeNum='$SelectedEpisode'";
							
						if ($module['CustomVar1'] == '')
						$query = "select cp.*, s.Title as SeriesTitle, e.Title as EpisodeTitle 
						          from comic_pages as cp 
								  inner join series as s on (s.SeriesNum=cp.SeriesNum and s.ProjectID='".$this->ProjectID."')
								  inner join Episodes as e on (e.EpisodeNum=cp.EpisodeNum and s.ProjectID='".$this->ProjectID."' and s.SeriesNum=cp.SeriesNum)
								  where cp.comicid='".$this->ProjectID."' and cp.Chapter=1 ".$where." group by cp.SeriesNum,cp.EpisodeNum order by cp.SeriesNum,cp.EpisodeNum,cp.EpPosition group by cp.SeriesNum";
						else
						$query = "select cp.*, s.Title as SeriesTitle, e.Title as EpisodeTitle, p.SafeFolder 
								  from comic_pages as cp
								  inner join projects as p on p.ProjectID=cp.comicid
								  inner join series as s on (s.SeriesNum=cp.SeriesNum and s.ProjectID='".$this->ProjectID."')
								  inner join Episodes as e on (e.EpisodeNum=cp.EpisodeNum and e.ProjectID='".$this->ProjectID."' and e.SeriesNum=cp.SeriesNum)
								  where p.SafeFolder='".$module['CustomVar1']."' and cp.Chapter=1 ".$where." group by cp.SeriesNum,cp.EpisodeNum order by cp.SeriesNum,cp.EpisodeNum,cp.EpPosition";
	
						$db->query($query);
						
						$LastSeries = 0;
						$LastEpisode = 0;
						
						while ($line = $db->fetchNextObject()) { 
							if ($LastSeries != $line->SeriesNum) {
									$LastSeries = $line->SeriesNum;
									$String .= "<div><b>Series ".$line->SeriesNum." - ".$line->SeriesTitle."</b></div>";
									$LastEpisode = 0;
							}
							if ($LastEpisode != $line->EpisodeNum) {
									$LastEpisode = $line->EpisodeNum;
									$String .= "<div>Episode ".$line->EpisodeNum." - ".$line->EpisodeTitle."</div>";
									$LastChapter = 1;
							}
								if ($module['CustomVar2'] == 'vertical thumbs') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/'.$line->EpPosition.'/"><img src="http://www.wevolt.com/'.$line->ThumbLg.'" width="'.($Width-20).'" border="0"></a><div class="spacer"></div>';
								} else if ($module['CustomVar2'] == 'thumb box') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/'.$line->EpPosition.'/"><img src="http://www.wevolt.com/'.$line->ThumbMd.'" width="75" height="75" border="0" vspace="5" hspace="5"></a>';
								} else if ($module['CustomVar2'] == 'text list') {
									$String.= '<a href="/'.$this->SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										$String .='/series/'.$line->SeriesNum;
										
									$String .='/episode/'.$line->EpisodeNum;
									$String .= '/page/'.$line->EpPosition.'/">Chapter '.$LastChapter.' - '.$line->Title.'</a><div class="spacer"></div>';
								} 
							$LastChapter++;	
						}
						

						$db->close();
						return $String;
		}
		
		public function getMobileModule($module) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String = "<div>";
						$where .= " and (mc.AccessType='public'";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((mc.AccessType='superfans') or (mc.AccessType='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or mc.AccessType='fans') ";
						else 
								$where .= ")";	
						if ($module['CustomVar1'] == '')
							$query = "select * from mobile_content as mc where (mc.ComicID = '".$this->ProjectID."' or mc.ProjectID='".$this->ProjectID."') and mc.Type = 'Wallpaper' $where order by RAND() LIMIT 3 ";
						else
							$query = "select mc.*,p.SafeFolder from mobile_content as mc
						           inner join projects as p on p.ProjectID=mc.ProjectID
								  where p.SafeFolder='".$module['CustomVar1']."' and mc.Type = 'Wallpaper' $where order by RAND() LIMIT 3 ";
						
												
						$db->query($query);
						while ($download = $db->fetchNextObject()) { 
						$DownID = $download->EncryptID;
						$Downname = $download->Title;
						$DlType = $download->Type;
						$DlThumb = $download->Thumb;
							$String .= "<a href='http://www.wevolt.com/".$this->SafeFolder."/mobile/".$DownID."/'><img src='";
									$String .= 'http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'\'  border=\'1\' style=\'border-color:#000000;\' hspace="5" vspace="5"></a>';
							
						}
						$String .= "</div>";
		
						$db->close();
						return $String;
		}
		
		public function getCharactersModule($module) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$CharactersModuleString .="<div>";
						$where .= " and (c.AccessType='public'";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((c.AccessType='superfans') or (c.AccessType='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or c.AccessType='fans') ";
						else 
								$where .= ")";	
						if ($module['CustomVar1'] == '')
							$query = "select * from characters as c where c.ComicID =  '".$this->ProjectID."' $where order by RAND() limit 2 ";
						else
							$query = "select c.*,p.SafeFolder from characters as c
						           inner join projects as p on p.ProjectID=c.ComicID
								  where p.SafeFolder='".$module['CustomVar1']."' $where order by RAND() limit 2 ";
								  
						//$query = "select * from characters where ComicID =  '".$this->ProjectID."' order by RAND() limit 2 ";
						$db->query($query);
						while ($download = $db->fetchNextObject()) { 
							$TCharName = stripslashes($download->Name);
							$DownID = $download->ID;
							$Downname = $download->Name;
							$DlImage = $download->Image;
							$DlThumb = 'http://www.wevolt.com'.$this->BaseProjectDirectory.$download->Thumb; 
							$DlEncryptID = $download->EncryptID; 
							
							$String .= "<a href='/".$this->SafeFolder."/characters/'><img src='".$DlThumb."'  border='1' style='border-color:#000000;' hspace=\"5\" vspace=\"5\"></a>";
						}
						$String .= "</div>";
		
						$db->close();
						return $String;
		}
		
		public function getProductsModule($module) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String  ="";
						if ($module['CustomVar1'] == '')
							$query = "select * from pf_store_items where ComicID = '".$this->ProjectID."' order by RAND() limit 1";
						else
							$query = "select s.*,p.SafeFolder from pf_store_items as s
						           inner join projects as p on p.ProjectID=s.ComicID
								  where p.SafeFolder='".$module['CustomVar1']."' order by RAND() limit 1 ";
								  
						
						$db->query($query);
						while ($download = $db->fetchNextObject()) { 
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
							$String .= "<div class='downloadimage' align='center'><img src='/".$DlThumb."'  border='1' style='border-color:#000000;'><font style='font-size:".$ContentBoxFontSize."px;color:#".$ContentBoxTextColor.";'>".$Downname."<br/>".$Price."</font><div class='pagelinks'><a href='http://store.wevolt.com/".$this->SafeFolder."/products/".$DownID."/' target='blank'>[MORE INFO]</a></div></div>";
						}
						$db->close();
						return $String;
		}
		
		public function drawForumModule($module) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String  ="";
						$Limit = $module['CustomVar2'];
						if ($Limit == '')
							$Limit = 5;
						if ($module['CustomVar1'] == '')
							$query = "select * from pf_forum_topics where ProjectID = '".$this->ProjectID."' order by LastReply";
						else
							$query = "select ft.*,u.username,u.avatar from pf_forum_topics as ft
									  inner join projects as p on ft.ProjectID=p.ProjectID
									  left join users as u on ft.LastUser=u.encryptid
									  where p.SafeFolder = '".$module['CustomVar1']."' order by ft.LastReply limit ".$Limit;
								  
						
						$db->query($query);
						while ($line = $db->fetchNextObject()) { 
						
							$String .= '<a href="http://www.wevolt.com/forum/index.php?project='.$module['CustomVar1'].'&a=read&topic='.$line->ID.'&board='.$line->BoardID.'">'.$line->Subject.'</a><br/>Posted: '.date('F j, Y',strtotime($line->CreatedDate));
							if ($line->LastUser != '') {
								$String .= 'Latest Post: '.date('m-d-Y',strtotime($line->LastReply)).' by '.$line->username;
							}
							
							$String .= '<div class="spacer"></div>'; 
						}
						$db->close();
						return $String;
		}
		
		public function drawFeedModule($module) {
			
			$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
			
		
				$query = "SELECT ProjectID from projects where SafeFolder='".$module['CustomVar1']."'";	
				$ContentID = $db->queryUniqueValue($query);		
				
			
			$db->close();
			
				$db = new Danb();
				$NumItems = $module['CustomVar2'];
				if ($NumItems > 15)
					$NumItems = 15;
				$query = "select u.content_id as id, u.link, p.thumb, p.Safefolder, u.UpdateType, u.ActionID, us.username as user,  actiontype as action, u.actionsection as subject, p.title, i.time
				from
				(   select max(id) as 'i', max(if(live_date is not null and live_date > `date`, `live_date`, `date`)) as 'time'
					from updates
					where ((actionsection != '')
					
					and if(live_date is not null and live_date != '0000-00-00 00:00:0000', live_date, date) <= now())
					and content_id='$ContentID'
					group by content_id, actionsection
					order by time desc    
					limit $NumItems
				) as i
				left join updates u 
				on u.id = i.i 
				left join users us 
				on u.userid = us.encryptid 
				left join projects p 
				on (u.content_id = p.projectid and p.projectid != '') 
				limit $NumItems;";
				
				$rows = $db->fetchAll($query);
				//print $query;
				
				$String .='<div align="left" id="feed_holder">';
				 if (count($rows) > 0) :
					 foreach ($rows as $row) :
					
						$date = new DateTime($row['time']); 
						$id = $row['id'];
						//$thumb = 'http://www.wevolt.com' . $row['thumb'];
						//if (!is_array(@getimagesize($thumb))) {
							///$thumb = "http://www.wevolt.com/images/no_thumb_project.jpg";	
						//}
						$link = $row['link'];
						$action = $row['action'];
						$subject = $row['subject'];
						$UpdateType = $row['UpdateType'];
						$title = stripslashes($row['title']);
						if (strlen($title) > 27) {
							$title = substr($title, 0, 27) . '...';
						}
						$user = $row['user'];
					
						$String .='<div class="projectboxcontent" user="'. $user.'">';
					
						//<div style="display:inline-block;">
							//<img src="'.$thumb.'" width="34" height="34" />
						//</div>
						
						$String .='<div style="display:inline-block;">'.$action;
						 
						 if ($subject == 'review')
							$link = 'http://users.wevolt.com/'.$user.'/?tab=reviews&id='.$row['ActionID'];
							//print 'Link = ' . $link.'<br/>';
						  $String .= '<a href="'.$link.'"> '.$subject.'</a>';
						 
						/*if (($subject == 'page') || ($subject == 'blog')|| ($subject == 'comment')) $String .=' to ';
						 
						 if ($UpdateType == 'project')
						 $String .='<a href="http://www.wevolt.com/'.$row['Safefolder'].'/">'.$title.'</a>';
						*/ 
						 $String .='<br />
								  <span style="font-size:10px;">';
								  if ($subject == 'page')
									 $String .=$date->format('F jS, Y');
								  else 
									 $String .= $date->format('F jS, Y @ g:i a');
								  
						$String .='</span></div>
						<div style="height:5px;"></div>
					  </div>';
					endforeach; 
				 else: 
					$String .='No recent updates.';
				 endif; 
				 
				$String .='</div>';
			
			return $String;
			
		}

		
		public function drawBlogModule($module) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String  ="<div class=\"projectboxcontent\" align=\"left\">";
						$CurrentDate = date('Y-m-d').' 00:00:00';
						$ModHeight = $module['CustomVar4'];
						if ($ModHeight=='')
							$ModHeight = '400';
							
							$String .='<div class="projectboxcontent" style="padding-left:10px;height:'.$ModHeight.'px; overflow:auto;"">';
							$Limit = $module['CustomVar2'];
							if ($Limit == '')
								$Limit =2;
							
							if ($Limit >5) 
								$Limit = 5;
								
								
							
							if ($module['CustomVar1'] == '') {
								
									$query = "select distinct bp.*,bc.Title as CategoryTitle, 
											  (SELECT count(*) from blogcomments as bc where bc.PostID=bp.EncryptID and bc.ComicID=bp.ComicID) as CommentCount
											  from pfw_blog_posts as bp
											  left join pfw_blog_categories as bc on bp.Category=bc.EncryptID 
											  where bp.ComicID = '".$this->ProjectID."' and ";
											  
									$query .= "bp.PublishDate<='$CurrentDate' ";
											 
									$query .= "order by bp.PublishDate DESC limit $Limit";
							} else {
									
									$query = "select distinct bp.*,bc.Title as CategoryTitle, p.SafeFolder, 
											  (SELECT count(*) from blogcomments as bc where bc.PostID=bp.EncryptID and bc.ComicID=bp.ComicID) as CommentCount
											  from pfw_blog_posts as bp
											  left join pfw_blog_categories as bc on bp.Category=bc.EncryptID 
											  inner join projects as p on p.ProjectID=bp.ComicID
											  where p.SafeFolder = '".$module['CustomVar1']."' and ";
											  
									$query .= "bp.PublishDate<='$CurrentDate' ";
											 
									$query .= "order by bp.PublishDate DESC limit $Limit";
								
							}

						$db->query($query);
						while ($line = $db->fetchNextObject()) { 
							$String .='<b>'.stripslashes($line->Title).'</b>';
							$BlogContent = @file_get_contents('http://www.wevolt.com/'.$line->Filename);
							$BlogContent = preg_replace("/<img[^>]+\>/i", "", $BlogContent);
							//$BlogContent = truncStringLink($BlogContent,280,' ','...[more]','/'.$ComicName.'/blog/'.$blog_array[$StringCounter]->EncryptID.'/');
							$String .= '<div style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;">posted: '.date('F j, Y',strtotime($line->PublishDate)).'</div>';
							
							$String .= '<div style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;border-bottom:dashed #'.$ContentBoxTextColor.' 1px; padding-top:5px;padding-bottom:5px;">'.$BlogContent.'</div>';
						}
						$String .='</div>';
						$db->close();
						return $String;
		}
		
		public function drawCommentForm($module='') {
						
						if (($this->Privacy == 'public') || ($this->Privacy == '') ||(($this->Privacy == 'fans') && (($this->IsFollowing == 1)||($this->IsProjectSuperFan == 1)))|| (($this->Privacy == 'superfans') && ($this->IsProjectSuperFan == 1))) {	
						
						$String = '<script type="text/javascript">';
						$String .= 'function submit_comment() {';
						
					    $String .= 'document.commentform.submit();';
						
						$String .= '}';
						$String .= '</script>';
 						$String .='<div id="commentbox">';
						if ((($_SESSION['userid'] != '') && ($this->SettingArray->AllowPublicComents == 0)) || ($this->SettingArray->AllowPublicComents == 1)) { 
	 						$String .='<div class="modheader">Leave a Comment</div>';
    	 					$String .=' <form method="POST" action="http://www.wevolt.com/'.$this->SafeFolder;
							if ($this->Section == 'Blog') {
								$String .= '/'.$this->ContentUrl.'/?post='.$_GET['post'];
								$PostBack = 'http://www.wevolt.com/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?post='.$_GET['post'];
							} else { 
								$String .= '/reader/';
								$PostBack = 'http://www.wevolt.com/'.$this->SafeFolder.'/reader/';
								if (($_GET['series'] != '')&&($_GET['series'] != '1')){
		 							$String .='series/'.$_GET['series'].'/';
									$PostBack .='series/'.$_GET['series'].'/';
								}
								if ($this->EpisodeNum != ''){
		 							$String .='episode/'.$this->EpisodeNum.'/';
									$PostBack .='episode/'.$this->EpisodeNum.'/';
								}
									$String .='page/'.$this->EpPosition.'/';
									$PostBack .='page/'.$this->EpPosition.'/';
								
     				        }
							$String .= '" name="commentform" id="commentform">';
    						$String .='<textarea rows="6" style="width:98%" name="txtFeedback" onFocus="doClear(this);toggle_arrows(\'off\');" id="txtComment">';
							if ($_POST['txtFeedback']=='')
								$String .='enter a comment'; 
							else
		 						$String .=$_POST['txtFeedback'];

	  						$String .='</textarea><div class="spacer"></div>';
	  
	 					    if ($_SESSION['userid'] == '')
	   							$String .='NAME:<br/><input type="text" name="txtName" value="'.$_POST['txtName'].'"><div class="spacer"></div>';
	   
	    			 		/*if ($_SESSION['userid'] != '') 
	  							$String .='<div align="left">
								   <table cellpadding="0" cellspacing="0" border="0"><tr><td>
								   <img src="/'.$this->PFDIRECTORY.'/captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5" border=\'2\'/>'.
									'<label for="security_code"></label>'.
									'<br /></td><td style="padding-left:10px;">
									<input id="security_code" name="security_code" type="text" class="inputstyle" style="width:100px; background-color:#99FFFF; border:none;" 				
									onFocus="doClear(this)" value="enter code"/></td>
									</tr></table></div>';*/
		 
							$String .='<input type="hidden" name="insert" id="insert" value="1">'.
										'<input type="hidden" name="userid" id="userid" value="'.$_SESSION['userid'].'">
											<input type="hidden" name="txtSection" id="txtSection" value="'.$this->Section.'">
											<input type="hidden" name="targetid" id="targetid" value="';
							if ($this->Section == 'Blog')
								$String .= $_GET['post'];
							else
								$String .= $this->PageID;
	
							$String .='"><input type="hidden" name="position" id="position" value="'.$this->PagePosition.'"><input type="hidden" name="postback" id="postback" value="'.$PostBack.'"><div class="spacer"></div>';
	
							if ($_SESSION['commenterror'] != '') {
								$String .="<font style='color:red'>".$_SESSION['commenterror']."</font><div class='spacer'></div>";
								$String .= "<script type='text/javascript'>alert('There was an error submitting comment, please check your fields and try again');</script>";
								$_SESSION['commenterror'] = '';
							} 
							$String .='<div class="spacer"></div><span class="buttonlinks">';
							
							if ($this->Section != 'Blog') {	
								if ($CommentButtonImage != '') {
									$String .= '<img src="/'.$this->PFDIRECTORY.'/templates/skins/'.$this->SkinCode.'/images/'.$CommentButtonImage.'" 
												id="CommentButtonImage" style="cursor:pointer;" alt="Submit" border="0" onclick="submit_comment();"';
									if ($CommentButtonRolloverImage != '')
										$String .= 'onMouseOver="swapimage(\'CommentButtonImage\',\''.$CommentButtonRolloverImage.'\')" 
												onMouseOut="swapimage(\'CommentButtonImage\',\''.$CommentButtonImage.'\')"';
									$String .= '/>';
								} else {
									$String .= '<input type="button" onclick="submit_comment();" value="Submit Comment" class="navbuttons">'; 
								}
							} else {
								if ($CommentButtonImage != '')
									$String .= '<input type="image" src="/'.$this->PFDIRECTORY.'/templates/skins/'.$this->SkinCode.'/images/'.$CommentButtonImage.'" style="border:none;">';
								else
									$String .= '<input type="button" onclick="submit_comment();" value="Submit Comment" class="navbuttons">';
								
				 
							}
		
	 						$String .='</span></form><div class="spacer"></div>';

					} else { 
						$String .='<div class="authornote" align="center">SORRY YOU NEED TO LOG IN TO LEAVE COMMENTS </div>';
 					}
 
 					$String .='</div>';
					} else {
						$String .= 'Sorry you don\'t have access to comment on this page'; 	
						
					}
						
					return $String;
		}
		
		public function getCommentReplies($CommentID, $Section, $commenttable, $targetid, $ContentID, $ShowReply, $ShowDelete, $rowcounter) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "select c.*, u.username, u.avatar 
													from $commenttable as c 
													join users as u on u.encryptid=c.UserID
													where c.$targetid='$ContentID' and c.comicid='".$this->ProjectID."' and c.ParentComment='$CommentID' ORDER BY c.creationdate ASC";
									
  						$db->query($query);
									 while ($comment = $db->fetchNextObject()) { 
								
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment->username).'/" target="_blank">
												<img src="'.$comment->avatar.'" width="50" height="50" border="1"></a>';
												 if ($_SESSION['userid'] !='')
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment->id.'\',\''.$ContentID.'\',\''.$Section.'\',\''.trim($comment->username).'\');">reply</a>';

									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment2->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
									
									$String .= '<div style="font-size:10px;">on <i>'.$comment2->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment2->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment2->comment)).'</td>'.
  												'</tr>'.
									
												'</table><div class="spacer"></div></div>';
												$rowcounter++;
									 }
									 $db->close();
									 return $String;
			
		}
		
		public function getPageComments($module='') {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						if (($this->Privacy == 'public') || ($this->Privacy == '') ||(($this->Privacy == 'fans') && (($this->IsFollowing == 1)||($this->IsProjectSuperFan == 1)))|| (($this->Privacy == 'superfans') && ($this->IsProjectSuperFan == 1))) {	
						$String  ="";
						if ($this->Section == 'Blog') 
							$query = "select bc.*, u.username, u.avatar 
										from blogcomments as bc 
										LEFT join users as u on u.encryptid=bc.UserID
										where bc.PostID='".$_GET['post']."' and bc.comicid='".$this->ProjectID."' and bc.ParentComment=0 ORDER BY bc.creationdate ASC";
						else 
							$query = "select pc.*,u.username,u.avatar
									 from pagecomments as pc 
									 LEFT join users as u on u.encryptid=pc.userid
									 where pc.pageid='".$this->PageID."' and pc.comicid='".$this->ProjectID."' and pc.ParentComment=0 ORDER BY pc.creationdate ASC";

  						$db->query($query);
  						$nRows = $db->numRows();
  						$bgcolor = 'CommentOddBGColor';
						$rowcounter = 0; 
						$DeleteString = '/'.$this->SafeFolder.'/';
						if ($this->Section =='Blog') {
							$DeleteString .= $this->ContentUrl.'/?post='.$_GET['post'];
						} else if ($Section =='Pages') {
							$DeleteString .='reader/';
							if (($_GET['series'] != '') && ($_GET['series'] != 1))
		 						$DeleteString .='series/'.$_GET['series'].'/';
		 					if ($_GET['episode'] != '')
		 						$DeleteString .='episode/'.$_GET['episode'].'/';
							$DeleteString .='page/'.$this->PagePosition.'/';	
						}
						
						if ($this->Section =='Blog') {
  										$TargetID = $_GET['post'];
						}else {
										$TargetID = $this->PageID;
	
						}
 						if ($nRows>0) {
  							 while ($comment = $db->fetchNextObject()) { 
  	 								if ($this->Section =='Blog') {
  										$UserID = $comment->UserID;
									}else {
										$UserID = $comment->userid;
	
									}
									
									 if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
									 	$ShowDelete = 1;
								
									if ($UserID != 'none') {
 										 		$String .= '<div class="spacer"></div><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  															'<tr>'.
    														'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
															<a href="http://users.wevolt.com/'.trim($comment->username).'/" target="_blank">
															<img src="'.$comment->avatar.'" width="50" height="50" border="1"></a>';
															 if ($_SESSION['userid'] !='')
													$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment->id.'\',\''.$TargetID.'\',\''.$this->Section.'\',\''.trim($comment->username).'\');">reply</a>';
												
												$String .= "</td>".
    														"<td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
														
														if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
																$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment->id."');return false;\" />
																			<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
													$String .= '<div style="font-size:10px;">on <i>'.$comment->commentdate.'</i></div
																><div style="font-size:10px;"><b>'.$comment->username.'</b> said:</div></td>'.
 																'</tr>'.
 																'<tr>'.
    															'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment->comment)).'</td>'.
  																'</tr>'.
																'</table><div class="spacer"></div>';
																
															
									} else {
										
											 $String .= "<div class=\"spacer\"></div><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".
												"<tr>".
												 "<td height=\"10\" valign=\"top\" style=\"padding-left:5px;\" class=\"".$bgcolor."\">
												 ";
												 if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
																$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment->id."');return false;\" />
																			<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";	
												if ($_SESSION['userid'] !='')	
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment->id.'\',\''.$TargetID.'\',\''.$this->Section.'\',\''.trim($comment->username).'\');">reply</a>';
													
																	
												 $String .= "<div style='font-size:10px;'>on <i>".$comment->commentdate."</i></div>
												 <div style='font-size:10px;'><b>".stripslashes($comment->Username)."</b> said:</div></td>".
												 "</tr>".
  												 "<tr>".
    											 "<td valign='top' style='padding:5px;' class=\"".$bgcolor."\">".stripslashes($comment->comment)."</td>".
  												"</tr>".
												"</table><div class='spacer'></div>";

									}
									//$String.=$this->getCommentReplies($comment->id, $this->Section, $commenttable, $targetid, $ContentID, 1, $ShowDelete, $rowcounter);
									
									
									$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									
									
									if ($this->Section == 'Blog') 
										$query = "select bc.*, u.username, u.avatar 
													from blogcomments as bc 
													join users as u on u.encryptid=bc.UserID
													where bc.PostID='".$_GET['post']."' and bc.comicid='".$this->ProjectID."' and bc.ParentComment='".$comment->id."' ORDER BY bc.creationdate ASC";
									else 
										$query = "select pc.*,u.username,u.avatar
													 from pagecomments as pc 
													 join users as u on u.encryptid=pc.userid
													 where pc.pageid='".$this->PageID."' and pc.comicid='".$this->ProjectID."' and pc.ParentComment='".$comment->id."' ORDER BY pc.creationdate ASC";
									 
									

  									$db2->query($query);
									 while ($comment2 = $db2->fetchNextObject()) { 
								
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment2->username).'/" target="_blank">
												<img src="'.$comment2->avatar.'" width="50" height="50" border="1"></a>';
												 if ($_SESSION['userid'] !='')
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment2->id.'\',\''.$TargetID.'\',\''.$this->Section.'\',\''.trim($comment2->username).'\');">reply</a>';

									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment2->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
									
									$String .= '<div style="font-size:10px;">on <i>'.$comment2->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment2->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment2->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												
									$db3 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									if ($this->Section == 'Blog') 
										$query = "select bc.*, u.username, u.avatar 
													from blogcomments as bc 
													join users as u on u.encryptid=bc.UserID
													where bc.PostID='".$_GET['post']."' and bc.comicid='".$this->ProjectID."' and bc.ParentComment='".$comment2->id."' ORDER BY bc.creationdate ASC";
									else 
										$query = "select pc.*,u.username,u.avatar
													 from pagecomments as pc 
													 join users as u on u.encryptid=pc.userid
													 where pc.pageid='".$this->PageID."' and pc.comicid='".$this->ProjectID."' and pc.ParentComment='".$comment2->id."' ORDER BY pc.creationdate ASC";

  									$db3->query($query);
									 while ($comment3 = $db3->fetchNextObject()) { 
									 
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:50px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment3->username).'/" target="_blank">
												<img src="'.$comment3->avatar.'" width="50" height="50" border="1"></a>';
												 if ($_SESSION['userid'] !='')
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment3->id.'\',\''.$TargetID.'\',\''.$this->Section.'\',\''.trim($comment3->username).'\');">reply</a>';
									
									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment3->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
									$String .= '<div style="font-size:10px;">on <i>'.$comment3->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment3->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment3->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												$db4 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									if ($this->Section == 'Blog') 
										$query = "select bc.*, u.username, u.avatar 
													from blogcomments as bc 
													join users as u on u.encryptid=bc.UserID
													where bc.PostID='".$_GET['post']."' and bc.comicid='".$this->ProjectID."' and bc.ParentComment='".$comment3->id."' ORDER BY bc.creationdate ASC";
									else 
										$query = "select pc.*,u.username,u.avatar
													 from pagecomments as pc 
													 join users as u on u.encryptid=pc.userid
													 where pc.pageid='".$this->PageID."' and pc.comicid='".$this->ProjectID."' and pc.ParentComment='".$comment3->id."' ORDER BY pc.creationdate ASC";
  									$db4->query($query);
									 while ($comment4 = $db4->fetchNextObject()) { 
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:75px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment4->username).'/" target="_blank">
												<img src="'.$comment4->avatar.'" width="50" height="50" border="1"></a>';
									
									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment4->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
									$String .= '<div style="font-size:10px;">on <i>'.$comment4->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment4->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment4->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												
									
									
									}
									$db4->close();
												
									
									
									}
									$db3->close();
									
									}
									$db2->close();
									
									
									
									if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
  
  							}
						} else {
							$String = "No Comments yet. Be the first to Comment!";
	
						}
					
						if (($_SESSION['userid'] == $this->AdminUserArray['UserID']) || (in_array($_SESSION['userid'],$this->SiteAdmins))) {
							$String .="<script type='text/javascript'>function delete_comment(cid) {
												
												document.getElementById(\"commentid\").value = cid;
												document.getElementById(\"linkback\").value = document.getElementById(\"postback\").value;
												document.deleteform.submit();
										}</script>";
										
							 $String .="<form method='POST' action='".$DeleteString."' name='deleteform' id='deleteform'>
									<input type='hidden' name='deletecomment' id='deletecomment' value='1'>
									<input type='hidden' name='commentid' id='commentid' value=''>
									<input type='hidden' name='linkback' id='linkback' value=''>
									<input type='hidden' name='targetid' id='targetid' value='".$this->PageID."'>
									<input type='hidden' name='position' id='position' value='".$this->EpPosition."'>
									</form>";
						}

						$db->close();
						} else {
							$String .= 'Sorry you don\'t have access to see page comments on this page.';	
							
						}
						return $String;
		}
	
		public function getOtherCreatorProjects($module='') {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "SELECT p.* 
								  from projects as p
          						  join comic_settings as cs on p.ProjectID=cs.ComicID 
		  						  where (p.CreatorID = '".$this->CreatorArray['UserID']."'
								  or cs.CreatorOne='".$this->CreatorArray['Email']."'  
								  or cs.CreatorTwo='".$this->CreatorArray['Email']."' 
								  or cs.CreatorThree='".$this->CreatorArray['Email']."') 
								  and p.installed=1 and p.Published=1";
						$db->query($query);
						while ($comic = $db->FetchNextObject()) {
								$String .='<a href="http://www.wevolt.com/'.$comic->SafeFolder.'/" target="_blank">'.
									      '<img src="http://www.wevolt.com/'.$comic->thumb.'" style="border:#000000 1px solid;" width="75" height="100" vspace="3" hspace="3"></a>';
						}

						$db->close();
						return $String;
		}
		
		public function drawCustom($module) {
										
						//$String = preg_replace("/<script[^>]+\>/i", "", $module['CustomModuleCode']);
						//$String = preg_replace("/<iframe[^>]+\>/i", "", $String);
							
						return $module['CustomModuleCode'];
		}
		
		
		
	
		public function getProjectLinks($module='') {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
							if ($module['CustomVar1'] == '')
								$query = "select * from links where ComicID = '".$this->ProjectID."' and InternalLink=0";
							else
								$query = "select l.*, p.SafeFolder from links as l 
							          inner join projects as p on l.ComicID=p.ProjectID
									  where p.SafeFolder='".$module['CustomVar1']."' and l.InternalLink=0";
	
						$db->query($query);
						while ($link = $db->fetchNextObject()) { 
							if (substr($link->Link,0,7) != 'http://')
								$Link = 'http://'.$link->Link;
							else 
								$Link = $link->Link;
		
							$String .= "<div class='rectitle' align='left'>
									<span class='pagelinks'><a href='".$Link."' target='_blank'>".$link->Title."</a></span>
									</div>
									<div class='projectboxcontent' align='left'>".$link->Description."</div>
									<div class='spacer'></div>";
						}
		
						$db->close();
						return $String;
		}
		
		public function drawWowioModule($module,$width) {
						
						if (($width<='200') || ($width< '400'))
							$Image = 'http://www.wevolt.com/templates/modules/wevolt_buyonwowio_03.png';
						else if (($width>='400') || ($width< '728'))
								$Image = 'http://www.wevolt.com/templates/modules/wevolt_buyonwowio_02.png';
						else if ($width>='728') 
								$Image = 'http://www.wevolt.com/templates/modules/wevolt_buyonwowio_01.png';
						$String .= '<a href="'.$module['CustomVar1'].'" target="_blank"><img src="'.$Image.'" border="0"></a>';
						return $String;
		}
		
		public function drawSuperFan($module,$width) {
						
						if (($width<='200') || ($width< '400'))
							$Image = 'http://www.wevolt.com/templates/modules/wevolt_Superfan200x90.jpg';
						else if (($width>='400') || ($width< '728'))
							$Image = 'http://www.wevolt.com/templates/modules/wevolt_Superfan-400x90.jpg';
						else if ($width>='728') 
							$Image = 'http://www.wevolt.com/templates/modules/wevolt_Superfan-728x90.jpg';
						if ($module['CustomVar2'] == 'box')
							$Image = 'http://www.wevolt.com/templates/modules/wevolt_Superfan300x250.jpg';
							
						$String .= '<a href="http://www.wevolt.com/superfan.php?p='.$module['CustomVar1'].'"><img src="'.$Image.'" border="0"></a>';
						return $String;
		}
		
		public function drawFBLikeBox($module,$width) {
			

						 	$String .= '<div align="center"><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.wevolt.com%2F'.$this->SafeFolder.'%2F&amp;layout=standard&amp;show_faces=true&amp;width='.($width-20).'&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.($width-20).'px; height:80px;" allowTransparency="true"></iframe></div>';
							
						
						
						return $String;
		}
		
		
		public function drawCreditsModule($module) {
							$Creator = $this->ProjectArray['Creator'];
							$Writer = $this->ProjectArray['Writer'];
							$Artist = $this->ProjectArray['Artist'];
							$Colorist =$this->ProjectArray['Colorist'];
							$Letterist = $this->ProjectArray['letterist'];
							$String.='<div class="projectboxcontent" style="padding-left:10px;"><div class="halfspacer"></div>';
						 if ((isset($Creator)) && ($Creator != '')) { 
								$String.='<div class="projectboxcontent"><b>CREATED BY: </b></div><div class="projectboxcontent">'.$Creator.'</div><div style="height:5px;"></div>';
						 } 
						
						if (((isset($Writer)) && ($Writer != '')) || ($EpisodeWriter != ''))  { 
								$String.='<div class="projectboxcontent"><b>WRITTEN BY:</b> </div>';
								if ($EpisodeWriter != '') 
											$Writer = $EpisodeWriter;
									
								$String.='<div class="projectboxcontent">'.$Writer.'</div><div style="height:5px;"></div>';
						}
						
						if (((isset($Artist))&& ($Artist != ''))|| ($EpisodeArtist != ''))  { 
								$String.='<div class="projectboxcontent"><b>ILLUSTRATED BY:</b> </div>';
								if ($EpisodeArtist != '')
											$Artist= $EpisodeArtist;
										
								$String.='<div class="projectboxcontent">'.$Artist.'</div><div style="height:5px;"></div>';
						} 	
						
						if (((isset($Colorist)) && ($Colorist != ''))|| ($EpisodeColorist != ''))  { 
								$String.='<div class="projectboxcontent"><b>COLORED BY:</b> </div>';
								if ($EpisodeColorist != '')
										$Colorist= $EpisodeColorist;
								$String.='<div class="projectboxcontent">'.$Colorist.'</div><div style="height:5px;"></div>';
						} 
					
						if (((isset($Letterist))&& ($Letterist != '')) || ($EpisodeLetterer != '')) { 
								$String.='<div class="projectboxcontent"><b>LETTERED BY:</b> </div>';
								if ($EpisodeLetterer != '')
										$Letterist= $EpisodeLetterer;
								$String.='<div class="projectboxcontent">'.$Letterist.'</div><div style="height:5px;"></div>';
						}
						$String.='</div><div class="spacer"></div>';	
						
						return $String;
			
		}
		
		public function drawModules($ModuleList,$ModuleSeparation,$Width,$ModuleSizes,$HeaderPlacement,$ReaderSection='') {
						if ($Width == '100%') {
							$Width = $_SESSION['contentwidth'];
						} else {
							if (substr($Width, -1) == 'x') {
								$Width = substr($Width,0, -2);
							} else if (substr($Width, -1) == '%') {
								$Percentage = intval(substr($Width,0,(strlen($Width)-2)))/100;
								$Width = round(($_SESSION['contentwidth']*$Percentage)*10);	
									
							}
						}
						
						$String ='<table width="'.$Width.'" border="0" cellspacing="0" cellpadding="0">
					  <tr><td colspan="3">
						<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="projectmodtopleft"></td>
						<td width="'.($Width-($this->TopLeftCornerWidth+$this->TopRightCornerWidth)).'" id="projectmodtop"></td>
						<td id="projectmodtopright"></td>
						</tr></table>
						</td>
						<tr><td colspan="3">
						<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="modleftside"></td>
						<td class="projectboxcontent" width="'.($Width-($this->LeftSideWidth+$this->RightSideWidth)).'" valign="top">'.$Header;	
						
						
						$ModuleString = '';
							if ($Width == '')
								$Width = '280';
							
							if ($ModuleSeparation == 1) 
								$ModuleString = '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$Width.'" valign="top">';
							else
								$ModuleString .= '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn">
														<tr><td width="'.$Width.'" valign="top">'.$this->drawProjectModuleTop('', $Width);
														
																				
							foreach($ModuleList as $module) {
									//if ($_SESSION['username'] == 'matteblack')
										//print_r($module);
									if ($module['Text-Align'] != 'default') 
										$ModuleContent = '<div style="text-align:'.$module['Text-Align'].'">';
									//$ModuleContent = '';
									switch ($module['ModuleCode']) {
											case 'latestpage':
											
											$ModuleContent .= $this->drawLatestPageMod($module,$Width);
											break;
											
											case 'comicsynopsis':
											$ModuleContent .= $this->getProjectSynopsis($module);
											break;
											
											case 'synopsis':
											$ModuleContent .= $this->getProjectSynopsis($module);
											break;
											
											case 'credits':
											$ModuleContent .= $this->drawCreditsModule($module);
											break;
											
											case 'authcom':
											$ModuleContent .= $this->getAuthorComment($module);
											break;
											
											case 'authcomm':
											$ModuleContent .= $this->getAuthorComment($module);
											break;
											
											case 'downloads':
											$ModuleContent .= $this->getDownloadsModule($module);
											break;
											
											case 'mobile':
											$ModuleContent .= $this->getMobileModule($module);
											break;
											
											case 'episodes':
											$ModuleContent .= $this->drawEpisodesModule($module,$Width);
											break;
											
											case 'series':
											$ModuleContent .= $this->drawSeriesModule($module,$Width);
											break;
											
											case 'chapters':
											$ModuleContent .= $this->drawChapterModule($module,$Width);
											break;
											
											case 'postcal':
											$ModuleContent .= $this->drawCalendarModule($module,$Width);
											break;

											
											case 'characters':
											$ModuleContent .= $this->getCharactersModule($module);
											break;	
											
											case 'products':
											$ModuleContent .= $this->getProductsModule($module);
											break;	
											
											case 'linksbox':
											$ModuleContent .= $this->getProjectLinks($module);
											break;
											
											case 'feed':
											$ModuleContent .= $this->drawFeedModule($module);
											break;
											
											case 'otherprojects':
											$ModuleContent .= $this->getOtherCreatorProjects($module);
											break;	
											
											case 'comform':
											if ($ReaderSection != 'iphone')
											$ModuleContent .= $this->drawCommentForm($module);
											break;	
											
											case 'pagecom':
											$ModuleContent .= $this->getPageComments($module);
											break;	
											
											case 'twitter':
											if ($ReaderSection != 'iphone')
											$ModuleContent .= $this->getTwitterMod($module,$Width);
											break;	
										
											case 'blog':
											$ModuleContent .= $this->drawBlogModule($module);
											break;	
											
											case 'forum':
											$ModuleContent .= $this->drawForumModule($module);
											break;	
											
											case 'custommod1':
											$ModuleContent .= $this->drawCustom($module);
											break;
											
											case 'custommod':
											$ModuleContent .= $this->drawCustom($module);
											break;
											
											case 'custommod2':
											$ModuleContent .= $this->drawCustom($module);
											break;
											
											case 'custommod3':
											$ModuleContent .= $this->drawCustom($module);
											break;
											
											case 'custommod4':
											$ModuleContent .= $this->drawCustom($module);
											break;
											
											case 'superfan':
											$ModuleContent .= $this->drawSuperFan($module,$Width);
											break;
											
											case 'wowio':
											$ModuleContent .= $this->drawWowioModule($module,$Width);
											break;
											
											case 'fblikebox':
											$ModuleContent .= $this->drawFBLikeBox($module,$Width);
											break;
									}	
									
									
								
									if ($module['Text-Align'] != 'default') 
										$ModuleContent .= '</div>';
								
									if (($_SESSION['userid'] != '') && ($module[0] == 'logform')) 
											$Skip = 1;
									else  
											$Skip = 0;
											
									if ($ModuleContent=='')
											$Skip = 1;
									else  
											$Skip = 0;
								
								
									if ($Skip == 0) {
										if ($ModuleSeparation == 1) {
											if ($HeaderPlacement == 'outside')
												$ModuleString .=$this->setheader($module, $module['Title'], $Image);		
											
											$ModuleString.= $this->drawProjectModuleTop('', $Width); 
										}
							
										if ($HeaderPlacement == 'inside') 
											$ModuleString .= $this->setheader($module, $module['Title'], $Image);		 
										if ($ModuleSeparation == 0) 
											$ModuleString.= "<div class='spacer'></div>";
									
										$ModuleString.= $ModuleContent;
										$ModuleContent = '';
										if ($ModuleSeparation == 0) 
											$ModuleString.= "<div class='spacer'></div>";
									
										if ($ModuleSeparation == 1) {
											$ModuleString.= $this->drawProjectModuleFooter($Width);
											$ModuleString .= '<div style="height:5px;"></div>';
										}
											/*'</td><td id="projectmodrightside"></td></tr><tr>
															<td id="projectmodbottomleft"></td><td id="projectmodbottom"></td>
															<td id="projectmodbottomright"></td></tr></table>';*/
								
									}
							}
							if ($ModuleSeparation == 1) {
								$ModuleString .= '</td></tr></table><div class="endofmod"></div>';
							} else {
								$ModuleString.=  $this->drawProjectModuleFooter($Width).'</td>
							</tr></table><div class="endofmod"></div>';
							}
							
							
							return $ModuleString;		
		}
				
		public function drawEpisodeSection($Template) {
			//print 'TEMPLATE = ' . $Template;
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "SELECT * from Episodes where ProjectID='".$this->ProjectID."' order by EpisodeNum";
						$db->query($query);
						$EpisodeCount = $db->numRows();
						$String = $this->drawProjectModuleTop('<div class="modheader">Episodes</div><div class="spacer"></div>', $this->ContentWidth);
						if ($Template == 'tabbed')
							$episodeselectString = "<table><tr>";
						else if ($Template == 'dropdown')
							$episodeselectString = "<div align=\"left\">Select Episode to View:&nbsp;<select onchange='episode_tab(this.options[this.selectedIndex].value);'>";
						while ($line = $db->fetchNextObject()) { 
									$episodeString .= "<div id='episodediv_".$line->EpisodeNum."'";
									if ($Template == 'tabbed')
										$episodeselectString .= "<td id='episodetab_".$line->EpisodeNum."' onclick='episodetab_".$line->EpisodeNum."();' class='"; 
									else if ($Template == 'dropdown')
										$episodeselectString .= "<option value='episodediv_".$line->EpisodeNum."'>EPISODE ".$line->EpisodeNum."</option>";
									
										if (($Template == 'tabbed')||($Template == 'dropdown')){
											if ($line->EpisodeNum > 1) {
												$episodeString .= "style='display:none;'";
												if ($Template == 'tabbed')
													$episodeselectString  .= "tabinactive'";
						
											} else {
												if ($Template == 'tabbed')
													$episodeselectString  .= "tabactive'";
											}
											if ($Template == 'tabbed')
												$episodeselectString .= ">EPISODE ".$line->EpisodeNum."</td><td width='5'></td>";
										}
										
										$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
										$query = "SELECT Position from comic_pages where EpisodeNum='".$line->EpisodeNum."' order by Position ASC";
										$EpisodePage = $db2->queryUniqueValue($query);
										$db2->close();
										
										$episodeString .= "><table cellpadding='0' cellspacing='0' border='0'><tr><td valign='top' class='projectboxcontent'><a href='/";
										$episodeString .=  $this->SafeFolder.'/reader/episode/';
										$episodeString .= $line->EpisodeNum."/page/".$EpisodePage."/'";
										$episodeString .= "><img src='/".$line->ThumbLg."' border='2' style='border-color:#000000' width='300'></a></td><td valign='top' style='padding-left:5px; padding-right:5px;' class='projectboxcontent' id='episodetd_".$line->EpisodeNum."' align='left'>EPISODE ".$line->EpisodeNum."</font></div><div class='pagelinks'><div class='episodetitle'><a href='/". $this->SafeFolder."/reader/episode/".$line->EpisodeNum."/page/".$EpisodePage."/'>".$line->Title."</a></div></div><div class='spacer'></div>".$line->Description."<div class='spacer'></div>";
								
										if ($line->Writer != '') 
													$episodeString .= "Script: ".$line->Writer."<br/>";
			
										if ($line->Artist != '')
												$episodeString .= "Art: ".$line->Artist."<br/>";
			
										if ($line->Colorist != '')
												$episodeString .= "Colors: ".$line->Artist."<br/>";
			
										if ($line->Letterist != '')
												$episodeString .= "Lettering: ".$line->Letterist."<br/>";
			
										$episodeString .= "</font></td></tr></table></div><div class=\"spacer\"></div>";
							    
					}
					if ($Template == 'tabbed')
						$episodeselectString .= "</tr></table>";
					else if ($Template == 'dropdown')
						$episodeselectString .= "</select></div>";
					
					$Ecount = 1;
					$episodejavastring ='<script type="text/javascript">';
					if ($Template == 'tabbed') {
						while($Ecount <= $EpisodeCount) {
						$episodejavastring .= "function episodetab_".($Ecount)."() {";
						$Tcount = 1;
						
							while($Tcount <= $EpisodeCount) {
								if ($Tcount == $Ecount) {
									$episodejavastring .= "document.getElementById(\"episodediv_".$Tcount."\").style.display ='';";
									$episodejavastring .= "document.getElementById(\"episodetab_".$Tcount."\").className ='tabactive';";
									$episodejavastring .= "document.getElementById(\"episodetd_".$Tcount."\").className ='projectcontentbox';";
								} else { 
									$episodejavastring .= "document.getElementById(\"episodediv_".$Tcount."\").style.display ='none';";
									$episodejavastring .= "document.getElementById(\"episodetab_".$Tcount."\").className ='tabinactive';";
									$episodejavastring .= "document.getElementById(\"episodetd_".$Tcount."\").className ='projectcontentbox';";
									
								}
								$Tcount++;
							}
							$episodejavastring .= "}";
						$Ecount++;
						}
					} else if ($Template == 'dropdown') {
						$episodejavastring .= "function episode_tab(value) {";
						//$episodejavastring .= "alert(value);";
 						$episodejavastring .= "var mydivs = document.getElementsByTagName('div');";
  						$episodejavastring .= "var divlen = mydivs.length;";
 						
						$episodejavastring .= "for(var x=1;x<=divlen;x++) {";
   						$episodejavastring .= "var otherDiv = \"episodediv_\"+x;";
						
   						$episodejavastring .= "if (otherDiv == value){";
					//	$episodejavastring .= "alert('equals');";
						$episodejavastring .= "document.getElementById(otherDiv).style.display='block';";
						$episodejavastring .= "}else{";
						$episodejavastring .= "document.getElementById(otherDiv).style.display='none';";
						$episodejavastring .= "}";
						$episodejavastring .= "}";
						$episodejavastring .= "}";
						
					}
					$episodejavastring .='</script>';
					
					$String .=	$episodejavastring.$episodeselectString.$episodeString;
					
					$String .= $this->drawProjectModuleFooter($this->ContentWidth);
					$db->close();
					return $String;
		}
		
		public function drawMobileSection($Template) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$Count = 0;
						$where .= " and (mc.AccessType='public'";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((mc.AccessType='superfans') or (mc.AccessType='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or mc.AccessType='fans') ";
						else 
								$where .= ")";	
						$query = "select * from mobile_content as mc
								  where mc.ComicID = '".$this->ProjectID."' 
								  and mc.Type = 'Wallpaper' $where";
						$db->query($query);
						
 						$String = $this->drawProjectModuleTop('<div class="modheader">Mobile</div><div class="spacer"></div>', $this->ContentWidth);
						$String .= "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->EncryptID;
								$Downname = $download->Title;
								$DlType = $download->Type;
								$DlThumb = $download->Thumb;
								$String .= "<td align='center' class='projectboxcontent'><div class='downloadimage'>";
								$String .= "<a href='http://www.wevolt.com/".$this->SafeFolder."/mobile/".$DownID."/' >";
								$String .= "<img src='http://www.wevolt.com/";
								$String .= $this->BaseProjectDirectory.$DlThumb."'  border='1' style='border-color:#000000;'></a></div>".$Downname."<div class='pagelinks'><a href='http://www.wevolt.com/".$this->SafeFolder."/mobile/".$DownID."/'>[send to phone]</a><div class='spacer'></div></td>";
							   $Count++;
							   if ($Count == 5){
									$String .= "</tr><tr>";
									$Count = 0;
 								}
	
						}
						if 	($Count < 5){
								while($Count <5) {
									$String .= "<td></td>";
									$Count++;
								}
						}
 						$String .= "</tr></table>";
						
						$String .= $this->drawProjectModuleFooter($this->ContentWidth);

					$db->close();
					return $String;
		}
		public function drawFanSection($Template) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$Count = 0;
						$query = "select u.username,u.avatar 
								  from follows as f
								  join users as u on f.user_id=u.encryptid
								  where f.follow_id = '".$this->ProjectID."' 
								  and f.type = 'project' and f.user_id!=''";
						$db->query($query);
						
 						$String = $this->drawProjectModuleTop('<div class="modheader">Fans</div><div class="spacer"></div>', $this->ContentWidth);
						$String .= "<div align=\"center\">";
						while ($line = $db->fetchNextObject()) { 
								
								$String .= '<a href="http://users.wevolt.com/'.$line ->username.'/">';
								$String .= '<img src="'.$line ->avatar.'" class="navbuttons" tooltip="'.$line ->username.'" width="50" vspace="5" hspace="5">';
								$String .="</a>";
						}
						$String .= "</div>";
						$String .= $this->drawProjectModuleFooter($this->ContentWidth);
						
					$db->close();
					return $String;
		}
		
		public function drawCreditsSection($Template) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "SELECT * from creators where ComicID ='".$this->ProjectID."'";
						$db->query($query);
						
						while ($line = $db->fetchNextObject()) { 
									$Location = $line->location;
									$Website = $line->website;
									$Creator = stripslashes($line->realname);
									$Title = 'Creator';
									$Link1 = $line->link1;
									$Link2 = $line->link2;
									$Link3 = $line->link3;
									$Link4 = $line->link4;
									$About = str_replace(chr(13), '\n', $line->about);
									$About = str_replace(chr(10), '\n', $About);
									$Music = str_replace(chr(13), '\n', $line->music);
									$Music = str_replace(chr(10), '\n', $Music);
									$Books = str_replace(chr(13), '\n', $line->books);
									$Books = str_replace(chr(10), '\n', $Books);
									$Influences = str_replace(chr(13), '\n', $line->influences);
									$CreatorInfluence = str_replace(chr(10), '\n', $Influences);
									$Other = str_replace(chr(13), '\n', $line->credits);
									$OtherCredits = str_replace(chr(10), '\n', $Other);
									$Hobbies = str_replace(chr(13), '\n', $line->hobbies);
									$Hobbies = str_replace(chr(10), '\n', $Hobbies);
									$CreatorAvatar = $line->avatar;
								
									$MainCreator = array(
												   "Location" => $Location,
												   "Website"  => $Website,
												   "Creator" => $Creator,
												   "Title" => $Creator,
												   "Link1" => $Link1,
												   "Link2" => $Link2,
												   "Link3" => $Link3,
												   "Link4" => $Link4,
												   "About" => $About,
												   "Books" => $Books,
												   "Music" => $Music,
												   "CreatorInfluence" => $CreatorInfluence,
												   "OtherCredits" => $OtherCredits,
												   "Avatar" => $CreatorAvatar,
												   "Hobbies" => $Hobbies); 
						}
							
							
						$query = "SELECT CreatorOne, CreatorTwo, CreatorThree 
										  from comic_settings 
										  where ComicID ='".$this->ProjectID."'";
						$CreatorListArray = $db->queryUniqueObject($query);
						$CreatorCount = 0;
						foreach ($CreatorListArray as $Creator) {
								
								$profileresult = file_get_contents ('http://www.wevolt.com/processing/getprofile.php?email='.$Creator);
								$values = unserialize ($profileresult);
						
								$Name = $values['username'];
								$RealName = $values['realname'];
								$Influences = $values['influences'];
								$Bio = $values['about'];
								$Location = $values['location'];
								$Hobbies = $values['hobbies'];
										$Website = $values['website'];
										$Link1 = $values['link1'];
										$Link2 = $values['link2'];
										$Link3 = $values['link3'];
										$Link4 = $values['link4'];
										$Music = $values['music'];
										$Credits = $values['credits'];
										$Books = $values['books'];
										$CAvatar = $values['avatar'];
										if ($values['username'] != '')
											$CreatorCount++;
										if (($CreatorCount == 1) && ($Name != '')) {
									
										$CreatorArray1 = array(
												   "Location" => $Location,
												   "Website"  => $Website,
												   "Creator" => $RealName,
												   "Title" => $Name,
												   "Link1" => $Link1,
												   "Link2" => $Link2,
												   "Link3" => $Link3,
												   "Link4" => $Link4,
												   "About" => $Bio,
												   "Books" => $Books,
												   "Music" => $Music,
												   "CreatorInfluence" => $Influences,
												   "OtherCredits" => $Credits,
												   "Avatar" => $CAvatar,
												   "Hobbies" => $Hobbies); 
										
										}
										if (($CreatorCount == 2) && ($Name != '')) {
										$CreatorArray2 = array(
												   "Location" => $Location,
												   "Website"  => $Website,
												   "Creator" => $RealName,
												   "Title" => $Name,
												   "Link1" => $Link1,
												   "Link2" => $Link2,
												   "Link3" => $Link3,
												   "Link4" => $Link4,
												   "About" => $Bio,
												   "Books" => $Books,
												   "Music" => $Music,
												   "CreatorInfluence" => $Influences,
												   "OtherCredits" => $Credits,
												   "Avatar" => $CAvatar,
												   "Hobbies" => $Hobbies); 
										
										
										}
										if (($CreatorCount == 3)  && ($Name != '')) {
											$CreatorArray3 = array(
												   "Location" => $Location,
												   "Website"  => $Website,
												   "Creator" => $RealName,
												   "Title" => $Name,
												   "Link1" => $Link1,
												   "Link2" => $Link2,
												   "Link3" => $Link3,
												   "Link4" => $Link4,
												   "About" => $Bio,
												   "Books" => $Books,
												   "Music" => $Music,
												   "CreatorInfluence" => $Influences,
												   "OtherCredits" => $Credits,
												   "Avatar" => $CAvatar,
												   "Hobbies" => $Hobbies); 
										
										}
									  
						}
							  
							  
						$String = $this->drawProjectModuleTop('', $this->ContentWidth);
							
						$String .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  										'<tr>'.
    									'<td width="205" valign="top" id="profileinfo">'.
										'<div align="left" style="font-size:12px;"><b>'.$MainCreator['Creator'].'</b></div>'.
										'<div class="spacer"></div>';
						if ($MainCreator['Avatar'] != '')
							$String .='<div align="center">'.
										  '<img src="'.$MainCreator['Avatar'].'"  border="1" width="100" height="100"/></div>';		
						if ($MainCreator['Location'] != '')
							$String .='<div class="locationwrapper">'.
										  '<div class="projectboxcontent"><b>LOCATION</b>: </div> '.
										  '<div class="projectboxcontent">'.$MainCreator['Location'].'</div>'.
										  '</div>';
						if (is_array($CreatorArray1)) {	
							$String .='<div class="spacer"></div>';		  
							$String .='<div align="left" style="font-size:12px;"><b>'.$CreatorArray1['Creator'].
											'</b></div>'.
											'<div class="spacer"></div>';
							if ($CreatorArray1['Avatar'] != '') 
									$String .='<div align="center"><img src="'.$CreatorArray1['Avatar'].
									          '"  border="1" width="100" height="100"/></div>';
							if ($CreatorArray1['Location'] != '')
									$String .='<div class="locationwrapper">'.
													'<div class="projectboxcontent"><b>LOCATION</b>: </div> '.
													'<div class="projectboxcontent">'.$CreatorArray1['Location'].'</div>'.
												'</div>';
										
								
						}
						if (is_array($CreatorArray2)) {	
							$String .='<div class="spacer"></div>';			  
							$String .='<div align="left" style="font-size:12px;"><b>'.$CreatorArray2['Creator'].
											'</b></div>'.
											'<div class="spacer"></div>';
							if ($CreatorArray2['Avatar'] != '') 
									$String .='<div align="center"><img src="'.$CreatorArray2['Avatar'].
									          '"  border="1" width="100" height="100"/></div>';
							if ($CreatorArray2['Location'] != '')
									$String .='<div class="locationwrapper">'.
													'<div class="projectboxcontent"><b>LOCATION</b>: </div> '.
													'<div class="projectboxcontent">'.$CreatorArray2['Location'].'</div>'.
												'</div>';
										
								
						}
						if (is_array($CreatorArray3)) {	
							$String .='<div class="spacer"></div>';			  
							$String .='<div align="left" style="font-size:12px;"><b>'.$CreatorArray3['Creator'].
											'</b></div>'.
											'<div class="spacer"></div>';
							if ($CreatorArray3['Avatar'] != '') 
									$String .='<div align="center"><img src="'.$CreatorArray3['Avatar'].
									          '"  border="1" width="100" height="100"/></div>';
							if ($CreatorArray3['Location'] != '')
									$String .='<div class="locationwrapper">'.
													'<div class="projectboxcontent"><b>LOCATION</b>: </div> '.
													'<div class="projectboxcontent">'.$CreatorArray3['Location'].'</div>'.
												'</div>';
										
								
						}
						$String .='</td><td valign="top">';
						$String .=$this->Credits;
						$String .='</td></tr></table>';
						$String .= $this->drawProjectModuleFooter($this->ContentWidth);
						
							
 					$db->close();
						
					return $String;
		
			
		}
		
		
		public function drawGallerySection($Template) {
					
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$String = $this->drawProjectModuleTop('<div class="modheader">GALLERY</div><div class="spacer"></div>', $this->ContentWidth);
						
						if ($this->IsOwner == 0) {
						$where = " and ((g.PrivacySetting='public' or g.PrivacySetting='')";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((g.PrivacySetting='superfans') or (g.PrivacySetting='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or g.PrivacySetting='fans') ";
						else 
								$where .= ")";	
						}
						if ((!isset($_GET['gid'])) && (!isset($_GET['gitem']))) {
							$query = "SELECT g.*, gc.ThumbMd as GallThumb, (SELECT count(*) from pf_gallery_content as gc2 where gc2.GalleryID=g.EncryptID) as Items,
								  (SELECT count(DISTINCT CategoryID) from pf_gallery_content as gc3 where gc3.GalleryID=g.EncryptID) as TotalCats
			  					  from pf_galleries as g
			  					  left join pf_gallery_content as gc on (gc.GalleryID=g.EncryptID and gc.GalleryThumb=1)
			  					  where g.ProjectID ='".$this->ProjectID."' $where";
							$db->query($query);
						
							while ($line = $db->fetchNextObject()) { 
								$GalleryType = $GalleryType;
			
								if ($line->GallThumb == '')
									$Thumb = 'pf_16_core/images/no_thumb.jpg';
								else 
									$Thumb = $line->GallThumb;

								$Description = 	$line->Description;
				
								$String .='<table width="500">';
								$String .='<tr><td valign="top" class="projectboxcontent" width="150">';
								$String .='<a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?gid='.urlencode($line->EncryptID).'">';
								$String .='<img src="/'.$Thumb.'" align="left" vspace="5" hspace="5" border="0"></a>';
								$String .='</td><td valign="top" style="padding-left:10px;">';
								$String .='<div class="globalheader">'.$line->Title.'</div><br/><b>Gallery Type</b>: '.$line->GalleryType.'<br/><b>Total Items</b>: '.$line->Items.'<br/>';
								$String .='<b>Total Categories</b>: '.$line->TotalCats.'<br/>';
								$String .='<div class="pagelinks"><a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?gid='.urlencode($line->EncryptID).'">VIEW GALLERY</a></span>';
								$String .='<br/>'.$Description.'</td></tr></table><div class="spacer"></div>';
						
							}					
					 } else if ((isset($_GET['gid'])) && (!isset($_GET['item']))) {
							// SHOW READER0
							if ($this->IsOwner == 0) {
							$where = " and ((gc.PrivacySetting='public' or gc.PrivacySetting='')";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((gc.PrivacySetting='superfans') or (gc.PrivacySetting='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or gc.PrivacySetting='fans') ";
						else 
								$where .= ")";	
							}
							include_once($_SERVER['DOCUMENT_ROOT'].'/classes/content_pagination.php');
							$query = "SELECT * from pf_gallery_content as gc where gc.GalleryID='".$_GET['gid']."' and gc.ProjectID='".$this->ProjectID."' $where order by gc.Position ASC";
							$pagination    =    new pagination();  
							
							$pagination->createPaging($query,24); 
							$String .= '<a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/">BACK TO GALLERY LIST</a><br/>';
							$String .= '<div class="pagelinks" align="center">'.$pagination->displayPagingConc().'</div><div align="center">'; 
							while($line=mysql_fetch_object($pagination->resultpage)) {
								$String .= '<a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?gid='.$_GET['gid'].'&item='.$line->EncryptID.'" border="1" >';
								if ($line->Thumb100 == '')
									$Thumb = $this->PFDIRECTORY.'/images/gallery_no_thumb.jpg';
								else 
									$Thumb = $line->Thumb100;
								
								$String .= '<img src="/'.$Thumb.'" class="g_module_thumb" style="border:1px #000 solid;" vspace="5" hspace="5" tooltip="'.$line->Title.'">';
							//	if ($Count == 5) {
								//	$String .= "</tr><tr>";
									//$Count = 1;
								//} else {
								//	$Count++;
								//}
						
							}
							//if (($Count < 5) && ($Count != 1)) {
							//	while ($Count <=5) {
								//	$String .= '<td></td>';	
								//	$Count++;
								//}
						
							//}
							//$String .= '</tr></table>';	
								$String .='</div><div class="spacer"></div>';
					}  else if ((isset($_GET['gid'])) && (isset($_GET['item'])) || (isset($_GET['gitem']))) {
							
							if (isset($_GET['gitem'])) {
									$query = "SELECT gc.*,g.GalleryType
							          from pf_gallery_content as gc
									  join pf_galleries as g on gc.GalleryID=g.EncryptID
									  where gc.EncryptID='".$_GET['gitem']."' and gc.ProjectID='".$this->ProjectID."'";
							} else {
									$query = "SELECT gc.*,g.GalleryType
							          from pf_gallery_content as gc
									  join pf_galleries as g on gc.GalleryID=g.EncryptID
									  where gc.GalleryID='".$_GET['gid']."' and gc.EncryptID='".$_GET['item']."'";
								
							}
						
									  
							$ContentItemArray = $db->queryUniqueObject($query);
							if ($_GET['gitem'] != '')
								$Gitem = $_GET['gitem'];
							else 
								$Gitem = $_GET['item'];
							$ConnectedPage = $this->getConnectedEntires($Gitem,'gallery item');
							$String .='<div style="padding:10px;" align="center">';
							$String .= '<div class="pagelinks"><a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?gid='.$ContentItemArray->GalleryID.'">BACK TO GALLERY</a></div><br/>';
							if ($ConnectedPage != '')
								$String .= '<div align="center">'.$this->buildConnectedNav($this->StoryFlowArray, $Gitem).'</div><div class="spacer"></div>';
								
							
							
							$String .= '<b>'.$ContentItemArray->Title.'</b><div class="spacer"></div>';
							if (($ContentItemArray->PrivacySetting == 'public') || (($ContentItemArray->PrivacySetting == 'fans') && (($this->IsFollowing == 1)||($this->IsProjectSuperFan == 1)))|| (($ContentItemArray->PrivacySetting == 'superfans') && ($this->IsProjectSuperFan == 1)) || ($this->IsOwner==1)){
					
								if ($ContentItemArray->GalleryType == 'videos') {
									if ($ContentItemArray->Embed != '') {
										$String .= $ContentItemArray->Embed;
									} else { 
									
									//NEED TO ADD GET IMAGE SIZE FOR FLV FILE
										$String .='<div id="videodiv"></div>';
										$String .= '<script type="text/javascript">';
										$String .= 'var PlayerVars = {};';
										$String .= 'PlayerVars.videofile = "'.$this->BaseProjectDirectory.$ContentItemArray->Filename.'";';
										$String .= 'var params = {};';
										$String .= 'params.quality = "best";';
										$String .= 'params.wmode = "transparent";';
										$String .= 'params.allowfullscreen = "false";';
										$String .= 'params.allowscriptaccess = "always";';
										$String .= 'var attributes = {};';
										$String .= 'attributes.id = "videodiv";';
										$String .= 'swfobject.embedSWF("/'.$this->PFDIRECTORY.'/flash/player.swf", "pagereaderdiv", "640", "480", "9.0.0", "/'.$this->PFDIRECTORY.'/flash/expressInstall.swf", PlayerVars, params, attributes);';
										$String .'</script>';
								}
								
								} else if ($ContentItemArray->GalleryType == 'music') {
								
								
								} else if (($ContentItemArray->GalleryType == 'images') || ($ContentItemArray->GalleryType == 'image')) {
									
											$String .= '<img src="/'.$ContentItemArray->GalleryImage.'" title="'.$ContentItemArray->Title.'">';
								}
								$String .= '</div><div style="padding:10px;">'.$ContentItemArray->Description.'</div>';
							} else {
								
								if ($this->AccessType == 'fans') 
									$Wanrning= '<a href="javascript:void(0)" onclick="follow(\''.$this->ProjectID.'\',\''.$_SESSION['userid'].'\',\'project\');"><img src="/images/fan_content_warning.png" border="0"></a>';
								else if ($this->AccessType == 'superfans') 
									$Wanrning= '<a href="http://www.wevolt.com/superfan.php?p='.$this->SafeFolder.'"><img src="/images/superfan_content_warning.png" border="0"></a>';
								$String .= '<div align="center">'.$Wanrning.'</div>';
								
							}
							
							
					}
					$db->close();
					$String .= $this->drawProjectModuleFooter($this->ContentWidth);

					return $String;
		}
		
		public function drawDownloadsSection($Template) {
	
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$DeskCount = 0;
						$where .= " and ((cd.PrivacySetting='public' or cd.PrivacySetting='')";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((cd.PrivacySetting='superfans') or (cd.PrivacySetting='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or cd.PrivacySetting='fans') ";
						else 
								$where .= ")";	
						
						if ($_GET['dlid'] != '') {
								$query = "select * from comic_downloads as cd where (cd.ProjectID = '".$this->ProjectID."' or cd.ComicID='".$this->ProjectID."') and cd.EncryptID = '".$_GET['dlid']."' $where";
								$DLItemArray = $db->queryUniqueObject($query);
								$String .= '<table><tr><td>'; 
								$String .= $this->drawProjectModuleTop('<div class="modheader">DOWNLOADS</div><div class="spacer"></div>', $this->ContentWidth);
								$String .='<div style="padding:10px;" align="center"><a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/">BACK TO DOWNLOADS LIST</a><div class="spacer"></div>';
								$ConnectedPage = $this->getConnectedEntires($_GET['dlid'],'download');
								if ($ConnectedPage != '') {
									$String .= '<div align="center">'.$this->buildConnectedNav($this->StoryFlowArray, $_GET['dlid']).'</div><div class="spacer"></div>';
								}
								
								if ($DLItemArray->EncryptID != '') {
									$String .='<div style="font-size:14px;"><b>'.$DLItemArray->Name.'</b></div>';
									$String .='<div><div class="spacer"></div>'.$DLItemArray->Description.'</div>';
									
									$DlThumb = $DLItemArray->Thumb; 
									$DlEncryptID = $DLItemArray->EncryptID; 
															
									$String .= '<a href="/'.$this->PFDIRECTORY.'/download_content.php?id='.$DlEncryptID.'">';
									$String .= '<img src="http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'"  border="1" style="border-color:#000000;" tooltip="CLICK TO DOWNLOAD<br/>-------<br/>'.$DLDescription.'" hspace="5" vspace="5"><br/>[Click to Download]</a></div>';
								} else {
									$String .= '<div style="padding:10px;" align="center"><div style="font-size:14px;">Sorry you do not have access to this content</div></div>';	
								}
								$String .= $this->drawProjectModuleFooter($this->ContentWidth);
								$String.='</td></tr></table>';
								
						} else {
						$query = "select * from comic_downloads as cd where (cd.ProjectID = '".$this->ProjectID."' or cd.ComicID='".$this->ProjectID."') and cd.DlType = 1 $where";
						
						$db->query($query);
						
						$DeskString = "";
						$DesktopItems = $db->numRows();
						if ($DesktopItems > 0)
 							$DeskString .= "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->ID;
								$Downname = $download->Name;
								$DlType = $download->DlType;
								$DlResolution = $download->Resolution;
								$DlImage = $download->Image;
								$DlThumb = $download->Thumb; 
								$DlEncryptID = $download->EncryptID; 
								$DLDescription = stripslashes($download->Description);
																
								$DeskString .= '<td align="center"><a href="/'.$this->PFDIRECTORY.'/download_content.php?id='.$DlEncryptID.'">';
								$DeskString .= '<img src="http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'"  border="1" style="border-color:#000000;" tooltip="CLICK TO DOWNLOAD<br/>-------<br/>'.$DLDescription.'"  hspace="5" vspace="5" width="95%"></a>';
								$DeskString .= '<div class="dltitle">'.$Downname.'</div><div class="spacer"></div>';
								
								$DeskString .= '</td>';
								$DeskCount++;
								if ($DeskCount == 4){
									$DeskString .= "</tr><tr>";
									$DeskCount = 0;
 								}
	
						}
						if 	(($DeskCount < 4) && ($DesktopItems > 0)){
								while($DeskCount <4) {
									$DeskString .= "<td></td>";
									$DeskCount++;
								}
						}
						if ($DesktopItems > 0)
 							$DeskString .= "</tr></table>";

						$CoverCount = 0;
						$query = "select * from comic_downloads as cd where (cd.ProjectID = '".$this->ProjectID."' or cd.ComicID='".$this->ProjectID."') and cd.DlType = 2 $where";
						$db->query($query);
					
						$CoverString = "";
						$CoverItems = $db->numRows();
 						if ($CoverItems > 0)
							$CoverString .= "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->ID;
								$Downname = $download->Name;
								$DlType = $download->DlType;
								$DlResolution = $download->Resolution;
								$DlImage = $download->Image;
								$DlThumb = $download->Thumb; 
								$DlEncryptID = $download->EncryptID; 
								$DLDescription = stripslashes($download->Description);
						
								$CoverString .= '<td align="center"><a href="/'.$this->PFDIRECTORY.'/download_content.php?id='.$DlEncryptID.'">';
								$CoverString .= '<img src="http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'"  border="1" style="border-color:#000000;" tooltip="CLICK TO DOWNLOAD<br/>-------<br/>'.$DLDescription.'"></a>';
								$CoverString .= '<div class="dltitle">'.$Downname.'</div><div class="spacer"></div>';
								$CoverString .= '</td>';
								$CoverCount++;
								if ($CoverCount == 4){
									$CoverString .= "</tr><tr>";
									$CoverCount = 0;
 								}
	
						}
						if 	(($CoverCount < 4) && ($CoverItems > 0)){
								while($CoverCount <4) {
									$CoverString .= "<td></td>";
									$CoverCount++;
								}
						}
						if ($CoverItems > 0)
 							$CoverString .= "</tr></table>";
							
						$AvatarCount = 0;
						$query = "select * from comic_downloads as cd where (cd.ProjectID = '".$this->ProjectID."' or cd.ComicID='".$this->ProjectID."') and cd.DlType = 3 $where";
						$db->query($query);
						$AvatarItems = $db->numRows();
						if ($AvatarItems > 0)
 							$AvatarString .= "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->ID;
								$Downname = $download->Name;
								$DlType = $download->DlType;
								$DlResolution = $download->Resolution;
								$DlImage = $download->Image;
								$DlThumb = $download->Thumb; 
								$DlEncryptID = $download->EncryptID; 
								$DLDescription = stripslashes($download->Description);
								$AvatarString .= '<td align="center"><a href="/'.$this->PFDIRECTORY.'/download_content.php?id='.$DlEncryptID.'">';
								$AvatarString .= '<img src="http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'"  border="1" style="border-color:#000000;" tooltip="CLICK TO DOWNLOAD<br/>-------<br/>'.$DLDescription.'"></a>';
								$AvatarString .= '<div class="dltitle">'.$Downname.'</div><div class="spacer"></div>';
								$AvatarString .= '</td>';
								
								
								$AvatarCount++;
								if ($AvatarCount == 4){
									$AvatarString .= "</tr><tr>";
									$AvatarCount = 0;
 								}
	
						}
						if 	(($AvatarCount < 4) &&($AvatarItems > 0)){
								while($AvatarCount <4) {
									$AvatarString .= "<td></td>";
									$AvatarCount++;
								}
						}
						if ($AvatarItems > 0)
 							$AvatarString .= "</tr></table>";
						
						
						$FileCount = 0;
						$FileString = "";
						$query = "select * from comic_downloads as cd where (cd.ProjectID = '".$this->ProjectID."' or cd.ComicID='".$this->ProjectID."') and (cd.DlType = 4 or cd.DlType=5) $where";
						$db->query($query);
						
						$FileItems = $db->numRows();
						if ($FileItems > 0)
 							$FileString .= "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
						while ($download = $db->fetchNextObject()) { 
								$DownID = $download->ID;
								$Downname = $download->Name;
								$DlType = $download->DlType;
								$DlThumb = $download->Thumb; 
								$DlEncryptID = $download->EncryptID; 
								$DLDescription = stripslashes($download->Description);
								$FileString .= '<td align="center"><a href="/'.$this->PFDIRECTORY.'/download_content.php?id='.$DlEncryptID.'">';
								$FileString .= '<img src="http://www.wevolt.com/'.$this->BaseProjectDirectory.$DlThumb.'"  border="1" width="150" style="border-color:#000000;" tooltip="CLICK TO DOWNLOAD<br/>-------<br/>'.$DLDescription.'"></a>';
								$FileString .= '<div class="dltitle">'.$Downname.'</div><div class="spacer"></div>';
								$FileString .= '</td>';
								$FileCount++;
								if ($FileCount == 4){
									$FileString .= "</tr><tr>";
									$FileCount = 0;
 								}
	
						}
						if 	(($FileCount < 4) && ($FileItems > 0)){
								while($FileCount <4) {
									$FileString .= "<td></td>";
									$FileCount++;
								}
						}
						if ($FileItems > 0)
 							$FileString .= "</tr></table>";
							
						$MenuString = '<div align="left"><table cellpadding="0" cellspacing="0" border="0"><tr>';
						if ($DesktopItems > 0)
							$MenuString .= '<td class="tabactive" align="left" id=\'desktopstab\' '.
								'onMouseOver="project_tab_active(\'desktopstab\',\'desktopsdiv\')" '.
								'onMouseOut="project_tab_inactive(\'desktopstab\',\'desktopsdiv\')"'.
								'onclick="desktopstab();">DESKTOPS</td><td width="5"></td>';
	
						if ($CoverItems >0) {
							$MenuString .= '<td class="';
							if ($DesktopItems == 0) 
								$MenuString .= 'tabactive';
							else 
								$MenuString .= 'tabinactive';
							
							$MenuString .= '" align="left" id=\'coverstab\' '.
								'onMouseOver="project_tab_active(\'coverstab\',\'coversdiv\')" '.
								'onMouseOut="project_tab_inactive(\'coverstab\',\'coversdiv\')"'.
								'onclick="coverstab();">COVERS</td><td width="5"></td>';
						}
						if ($AvatarItems >0) {
							$MenuString .= '<td class="';
							if (($DesktopItems == 0) &&  ($CoverItems == 0))
								$MenuString .= 'tabactive';
							else 
								$MenuString .= 'tabinactive';
							$MenuString .= '" align="left" id=\'avatarstab\' '.
													'onMouseOver="project_tab_active(\'avatarstab\',\'avatarsdiv\')" '.
													'onMouseOut="project_tab_inactive(\'avatarstab\',\'avatarsdiv\')"'.
													'onclick="avatarstab();">AVATARS</td><td width="5"></td>';
						}
						if ($FileItems >0) {
							$MenuString .= '<td class="tabinactive';
							$MenuString .= '" align="left" id=\'filestab\' '.
													'onMouseOver="project_tab_active(\'filestab\',\'filesdiv\')" '.
													'onMouseOut="project_tab_inactive(\'filestab\',\'filesdiv\')"'.
													'onclick="filestab();">FILES / eBOOKS</td>';
						}
							
						$MenuString .= '</tr></table></div>';
						
						$JavaString = '<script type="text/javascript">';
						$JavaString .="function desktopstab() {";
						$JavaString .="if (document.getElementById(\"desktopstab\")!= null) {
										document.getElementById(\"desktopsdiv\").style.display ='';
										document.getElementById(\"desktopstab\").className ='tabactive';
									}";
						
		
						$JavaString .="if (document.getElementById(\"coverstab\")!= null) {
										document.getElementById(\"coversdiv\").style.display = 'none';
										document.getElementById(\"coverstab\").className ='tabinactive';
									}";
						
						$JavaString .="if (document.getElementById(\"avatarstab\") != null) {
										document.getElementById(\"avatarsdiv\").style.display = 'none';
										document.getElementById(\"avatarstab\").className ='tabinactive';
									}";
						
						$JavaString .="if (document.getElementById(\"filestab\") != null) {
										document.getElementById(\"filesdiv\").style.display = 'none';
										document.getElementById(\"filestab\").className ='tabinactive';
									}";

						$JavaString .= "}";
					
						$JavaString .= "function filestab() {";

						$JavaString .= "if (document.getElementById(\"desktopstab\")!= null) {
										document.getElementById(\"desktopsdiv\").style.display ='none';
										document.getElementById(\"desktopstab\").className ='tabinactive';
									}";
						
						$JavaString .= "if (document.getElementById(\"coverstab\")!= null) {
										document.getElementById(\"coversdiv\").style.display = 'none';
										document.getElementById(\"coverstab\").className ='tabinactive';
									}";
					
						$JavaString .= "if (document.getElementById(\"avatarstab\") != null) {
										document.getElementById(\"avatarsdiv\").style.display = 'none';
										document.getElementById(\"avatarstab\").className ='tabinactive';
									}";
					
						$JavaString .= "if (document.getElementById(\"filestab\") != null) {
										document.getElementById(\"filesdiv\").style.display = '';
										document.getElementById(\"filestab\").className ='tabactive';
									}";
										
						$JavaString .= "}";
						
						$JavaString .= "function coverstab() {";
						
						$JavaString .= "if (document.getElementById(\"desktopstab\") != null) {
										document.getElementById(\"desktopsdiv\").style.display = 'none';
										document.getElementById(\"desktopstab\").className ='tabinactive';
									}";
						
						$JavaString .= "if (document.getElementById(\"coverstab\") != null) {
										document.getElementById(\"coversdiv\").style.display = '';
										document.getElementById(\"coverstab\").className ='tabactive';
									}";
						
						$JavaString .= "if (document.getElementById(\"avatarstab\") != null) {
										document.getElementById(\"avatarsdiv\").style.display = 'none';
										document.getElementById(\"avatarstab\").className ='tabinactive';
									}";
						
						$JavaString .= "if (document.getElementById(\"filestab\") != null) {
										document.getElementById(\"filesdiv\").style.display = 'none';
										document.getElementById(\"filestab\").className ='tabinactive';
									}";
						
						$JavaString .= "}";
						
						$JavaString .= "function avatarstab() {";
						
						$JavaString .= "if (document.getElementById(\"desktopstab\") != null) {
										document.getElementById(\"desktopsdiv\").style.display = 'none';
										document.getElementById(\"desktopstab\").className ='tabinactive';
									}";
									
						$JavaString .= "if (document.getElementById(\"coverstab\") != null) {
										document.getElementById(\"coversdiv\").style.display = 'none';
										document.getElementById(\"coverstab\").className ='tabinactive';
									}";
									
						$JavaString .= "if (document.getElementById(\"avatarstab\") != null) {
										document.getElementById(\"avatarsdiv\").style.display = '';
										document.getElementById(\"avatarstab\").className ='tabactive';
									}";
									
						$JavaString .= "if (document.getElementById(\"filestab\") != null) {
										document.getElementById(\"filesdiv\").style.display = 'none';
										document.getElementById(\"filestab\").className ='tabinactive';
									}";
									
						$JavaString .= "}";
						
						$JavaString .="</script>";
						$String = $JavaString;
						
						$String .= '<table><tr><td>'; 
						$String .= $MenuString;
						$String .= '</td></tr><tr><td>';
						$String .= $this->drawProjectModuleTop('<div class="modheader">DOWNLOADS</div><div class="spacer"></div>', $this->ContentWidth);
						
						$String .= '<div id="desktopsdiv" ';
						if ($DesktopItems == 0) 
							$String .= 'style="display:none;"';
						$String .= '>'.$DeskString.'</div>';
						
						$String .= '<div id="coversdiv" ';
						if ($DesktopItems > 0)  
							$String .= 'style="display:none;"';
						$String .= '>'.$CoverString.'</div>';
						
						$String .= '<div id="avatarsdiv" ';
						if (($DesktopItems > 0) || ($CoverItems > 0)) 
							$String .= 'style="display:none;"';
						$String .= '>'.$AvatarString.'</div>';
						
						$String .='<div id="filesdiv" ';
						if (($DesktopItems > 0) || ($CoverItems > 0) || ($AvatarItems > 0)) 
							$String .= 'style="display:none;"';
						$String .= '>'.$FileString.'</div>';
 						
						$String .= $this->drawProjectModuleFooter($this->ContentWidth);
						$String.='</td></tr></table>';
						}
						$db->close();
						
						
						return $String;
					
		}
		
		public function drawCharactersSection($Template) {
			
						
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$where .= " and ((c.AccessType='public' or c.AccessType='')";
						if ($this->IsProjectSuperFan == 1)
								$where .= " or ((c.AccessType='superfans') or (c.AccessType='fans'))) ";
						else if ($this->IsFollowing == 1)
								$where .= " or c.AccessType='fans') ";
						else 
								$where .= ")";
					if ($_GET['cid'] == '') {	
						$query = "select * from characters as c where c.ComicID = '".$this->ProjectID."' $where";
						$db->query($query);
						$CharCount = 0;
					}
					$String = $this->drawProjectModuleTop('<div class="modheader">Characters</div><div class="spacer"></div>', $this->ContentWidth);
					if ($_GET['cid'] != '') {
						$String .='<div style="padding:10px;" align="center"><a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/">BACK TO CHARACTER LIST</a></div>';
	
							$ConnectedPage = $this->getConnectedEntires($_GET['cid'],'character');
							if ($ConnectedPage != '') {
								$String .= '<div align="center">'.$this->buildConnectedNav($this->StoryFlowArray, $_GET['cid']).'</div><div class="spacer"></div>';
							}
							
						$CharID = $_GET['cid'];
						$query = "select * from characters as c where c.ComicID = '".$this->ProjectID."' and c.EncryptID='$CharID' $where";
						$CharacterArray = $db->queryUniqueObject($query);
										$CharName = stripslashes($CharacterArray->Name);
										$CharAge = $CharacterArray->Age;
										$CharTown = stripslashes($CharacterArray->Hometown);
										$CharRace = stripslashes($CharacterArray->Race);
										$CharHeight = $CharacterArray->HeightFt."' ".$CharacterArray->HeightIn."''";
										$CharWeight = $CharacterArray->Weight;
										$CharAbility = stripslashes($CharacterArray->Abilities);
										$CharDesc = stripslashes($CharacterArray->Description);
										$CharNotes = stripslashes($CharacterArray->Notes);
										$CharImage .= $CharacterArray->Image;
										$String .='<table width="100%" cellspacing="5">'.
													'<tr>'.
													'<td width="325" valign="top">';
										if ($CharImage!= '') 
											$String .='<div class="charimage" align="center"><img src="'.$this->BaseProjectDirectory.$CharImage.'" border ="2"/></div>';
		
										$String .='</td>'.			
													'<td width="15">&nbsp;</td>'.	
													'<td valign="top">'.
													 '<div class="modheader">CHARACTER STATS</div>'.
													 '<div class="comiccredits"><div class="halfspacer"></div>'.
													 '<table  border="0" cellspacing="5" cellpadding="0" width="100%">';
		
										 if (($CharName != '')&& ($CharName != 'NA'))
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharName.'</div></td>'.
																'</tr>';
										 
										
										 if (($CharDesc != '')&& ($CharDesc != 'NA'))
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharDesc.'</div></td>'.
																'</tr>';
										
										 if (($CharTown != '')&& ($CharTown != 'NA'))
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharTown.'</div></td>'.
																'</tr>';
											
										 if (($CharRace != '')&& ($CharRace != 'NA')) 
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharRace.'</div></td>'.
																'</tr>';
											
										 if (($CharAge != '')&& ($CharAge != 'NA'))
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharAge.'</div></td>'.
																'</tr>';
											
										 if (($CharHeight != '')&& ($CharHeight != 'NA')&& ($CharHeight != '	
									0\' 0\'\'')) 
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$CharHeight.'</div></td>'.
																'</tr>';
											
										if (($CharWeight != '')&& ($CharWeight != 'NA')) 
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$CharWeight.'</div></td>'.
																'</tr>';
											
										if (($CharAbility != '')&& ($CharAbility != 'NA'))
											$String .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$CharAbility.'</div></td>'.
																'</tr>';
									
										if (($CharNotes != '')&& ($CharNotes != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$CharNotes.'</div></td>'.
																'</tr>';
										
										 $String .='</table>'; 
										 
										 $String .='</td></tr>'.
													'</table>';
													
						
					} else {
					$ListString = '<table width ="100%" cellspacing="5" cellpadding="0" border="0" margin ="0"><tr>';
					
					if ($Template=='html_three') 
						$ListString .= '<td>';
					while ($character = $db->fetchNextObject()) { 
							//$DLDescription = stripslashes($download->Description);
							$TCharName = stripslashes($character->Name);
							$TCharAge =$character->Age;
							$TCharTown = stripslashes($character->Hometown);
							$TCharRace = stripslashes($character->Race);
							
							if (($character->HeightFt == 0) && ($character->HeightIn == 0))
								$TCharHeight = '';
							else 
								$TCharHeight = $character->HeightFt."' ".$character->HeightIn."''";
							$TCharWeight = $character->Weight;
							$TCharAbility = stripslashes($character->Abilities);
							$TCharDesc = stripslashes($character->Description);
							$TCharNotes = stripslashes($character->Notes);
							$TCharImage = $character->Image;
							
							if ($Template == 'vertical_list') {
								$CharactersString .='<table width="100%">'.
													'<tr>';
								
						
							$CharacterImage ='<td width="325" valign="top">';
										if ($TCharImage!= '') 
											$CharacterImage .='<div class="charimage" align="center"><img src="'.$this->BaseProjectDirectory.$TCharImage.'" border ="2"/></div>';
		
										$CharacterImage .='</td>';
							
							
													
													$CharactersInfo ='<td valign="top"';
													if ($CharCount == 0) 
														 $CharactersInfo .=' align="left"';
														else 
														 $CharactersInfo .=' align="right"';
														 
														$CharactersInfo .=' >'.
													 '<div><div class="halfspacer"></div>'.
													 '<table  border="0" cellspacing="5" cellpadding="0" width="100%">';
		
										 if (($TCharName != '')&& ($TCharName != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$TCharName.'</div></td>'.
																'</tr>';
										 
										
										 if (($TCharDesc != '')&& ($TCharDesc != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$TCharDesc.'</div></td>'.
																'</tr>';
										
										 if (($TCharTown != '')&& ($TCharTown != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharTown.'</div></td>'.
																'</tr>';
											
										 if (($TCharRace != '')&& ($TCharRace != 'NA')) 
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$TCharRace.'</div></td>'.
																'</tr>';
											
										 if (($TCharAge != '')&& ($TCharAge != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td valign="top"><div class="projectboxcontent">'.$TCharAge.'</div></td>'.
																'</tr>';
											
										 if (($TCharHeight != '')&& ($TCharHeight != 'NA')&& ($TCharHeight != '0\' 0\'\'')) 
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharHeight.'</div></td>'.
																'</tr>';
											
										if (($TCharWeight != '')&& ($TCharWeight != 'NA')) 
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharWeight.'</div></td>'.
																'</tr>';
											
										if (($TCharAbility != '')&& ($TCharAbility != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharAbility.'</div></td>'.
																'</tr>';
									
										if (($TCharNotes != '')&& ($TCharNotes != 'NA'))
											$CharactersInfo .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharNotes.'</div></td>'.
																'</tr>';
										
										 $CharactersInfo .='</table>'; 
										 if ($CharCount == 0) {
											  $CharactersString .= $CharacterImage .'<td>&nbsp;</td>'.$CharactersInfo;		
											  $CharCount = 1;									 
										 } else {
											  $CharactersString .=$CharactersInfo .'<td>&nbsp;</td>'.$CharacterImage;		
											 $CharCount = 0;	
										 }
										 $CharactersString .='</td></tr>'.
													'</table>';
							
							} else 
							if ($Template=='html_three') {
							
								$CharactersString .='<table width="100%">'.
													'<tr>'.
													'<td width="325" valign="top">';
										if ($TCharImage!= '') 
											$CharactersString .='<div class="charimage" align="center"><img src="'.$this->BaseProjectDirectory.$TCharImage.'" border ="2"/></div>';
		
										$CharactersString .='</td>'.			
													'<td width="15">&nbsp;</td>'.	
													'<td valign="top">'.
													 '<div class="comiccredits"><div class="halfspacer"></div>'.
													 '<table  border="0" cellspacing="5" cellpadding="0" width="100%">';
		
										 if (($TCharName != '')&& ($TCharName != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharName.'</div></td>'.
																'</tr>';
										 
										
										 if (($TCharDesc != '')&& ($TCharDesc != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharDesc.'</div></td>'.
																'</tr>';
										
										 if (($TCharTown != '')&& ($TCharTown != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharTown.'</div></td>'.
																'</tr>';
											
										 if (($TCharRace != '')&& ($TCharRace != 'NA')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharRace.'</div></td>'.
																'</tr>';
											
										 if (($TCharAge != '')&& ($TCharAge != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharAge.'</div></td>'.
																'</tr>';
											
										 if (($TCharHeight != '')&& ($TCharHeight != 'NA')&& ($TCharHeight != '0\' 0\'\'')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharHeight.'</div></td>'.
																'</tr>';
											
										if (($TCharWeight != '')&& ($TCharWeight != 'NA')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharWeight.'</div></td>'.
																'</tr>';
											
										if (($TCharAbility != '')&& ($TCharAbility != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharAbility.'</div></td>'.
																'</tr>';
									
										if (($TCharNotes != '')&& ($TCharNotes != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$TCharNotes.'</div></td>'.
																'</tr>';
										
										 $CharactersString .='</table>'; 
										 
										 $CharactersString .='</td></tr>'.
													'</table>';
								
								
							} else {
							$ListString .= '<td width="180" style="padding-left:5px; padding-right:5px;" class="projectboxcontent">'.$character->Name.'</div>
										<div align="center" style="background-color:#000000;">';
															
							if ($Template == 'html_one')
								$ListString .= "<a href=\"#character_".$character->EncryptID."\" rel=\"facebox\" >";
							else if ($Template == 'html_two')
								$ListString .= "<a href=\"/".$this->SafeFolder."/characters/?id=".$character->EncryptID."\">";
							
							$ListString .= "<img src=\"".$this->BaseProjectDirectory.$character->Thumb."\"  border=\"1\" style=\"border-color:#000000;\" hspace=\"4\" vspace=\"4\"></a></div></td>";
							$CharCount++;
							if ($CharCount == 5){
								$ListString .= "</tr><tr><td colspan=\"5\">&nbsp;</td></tr><tr>";
								$CharCount = 0;
							}
							
							if ($Template == 'html_one') {
								$ModalString .='<div class="spacer"></div>'.
														'<div id="character_'.$character->EncryptID.'" align="center" style="display:none;">'.
														'<table width="600">'.
														'<tr>'.
														'<td width="325" valign="top">';
								if ($TCharImage!='')
									$ModalString .='<div class="charimage" align="center"><img src="'.$this->BaseProjectDirectory.$TCharImage.'" border ="2"/></div>';
								
								$ModalString .='</td>'.			
														'<td width="15">&nbsp;</td>'.	
														'<td valign="top">';
								
								$ModalString .= '<div class="modheader">CHARACTER STATS</div>'.
														 '<div class="projectboxcontent"><div class="halfspacer"></div>'.
														'<table  border="0" cellspacing="5" cellpadding="0">';
								
								 if (($TCharName != '')&& ($TCharName != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharName.'</div></td>'.
														'</tr>';
					
								if (($TCharDesc != '') && ($TCharDesc != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharDesc.'</div></td>'.
														'</tr>';
	
								if (($TCharTown != '')&& ($TCharTown != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharTown.'</div></td>'.
														'</tr>';
								
								if (($TCharRace != '')&& ($TCharRace != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharRace.'</div></td>'.
														'</tr>';
									
								if (($TCharAge != '') && ($TCharAge != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharAge.'</div></td>'.
														'</tr>';
								
								if (($TCharHeight != '')&& ($TCharHeight != 'NA')) 
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharHeight.'</div></td>'.
														'</tr>';
									
								if (($TCharWeight != '')&& ($TCharWeight != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharWeight.'</div></td>'.
														'</tr>';
								
								if (($TCharAbility != '')&& ($TCharAbility != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharAbility.'</div></td>'.
														'</tr>';
							
								if (($TCharNotes != '')&& ($TCharNotes != 'NA'))
											$ModalString .='<tr>'.
														'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
														'<td width="10" valign="top">&nbsp;</td>'.
														'<td  valign="top"><div class="projectboxcontent">'.$TCharNotes.'</div></td>'.
														'</tr>';
					
								$ModalString .='</table></div></div>';
													
								$ModalString .='</td></tr></table></div>';	
								$ModalString .= '</div></div></div></div></div>';	
							}
							} 
					}
					
					if ($Template == 'html_two') {
									if (isset($_GET['id'])) {
										$CharID = $_GET['id'];
										$query = "select * from characters as c where c.ComicID = '".$this->ProjectID."' and c.EncryptID='$CharID' $where";
										$CharacterArray = $db->queryUniqueObject($query);
										$CharName = stripslashes($CharacterArray->Name);
										$CharAge = $CharacterArray->Age;
										$CharTown = stripslashes($CharacterArray->Hometown);
										$CharRace = stripslashes($CharacterArray->Race);
										$CharHeight = $CharacterArray->HeightFt."' ".$CharacterArray->HeightIn."''";
										$CharWeight = $CharacterArray->Weight;
										$CharAbility = stripslashes($CharacterArray->Abilities);
										$CharDesc = stripslashes($CharacterArray->Description);
										$CharNotes = stripslashes($CharacterArray->Notes);
										$CharImage .= $CharacterArray->Image;
										$CharactersString .='<table width="100%">'.
													'<tr>'.
													'<td width="325" valign="top">';
										if ($CharImage!= '') 
											$CharactersString .='<div class="charimage" align="center"><img src="'.$this->BaseProjectDirectory.$CharImage.'" border ="2"/></div>';
		
										$CharactersString .='</td>'.			
													'<td width="15">&nbsp;</td>'.	
													'<td valign="top">'.
													 '<div class="modheader">CHARACTER STATS</div>'.
													 '<div class="comiccredits"><div class="halfspacer"></div>'.
													 '<table  border="0" cellspacing="5" cellpadding="0">';
		
										 if (($CharName != '')&& ($CharName != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharName.'</div></td>'.
																'</tr>';
										 
										
										 if (($CharDesc != '')&& ($CharDesc != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharDesc.'</div></td>'.
																'</tr>';
										
										 if (($CharTown != '')&& ($CharTown != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharTown.'</div></td>'.
																'</tr>';
											
										 if (($CharRace != '')&& ($CharRace != 'NA')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharRace.'</div></td>'.
																'</tr>';
											
										 if (($CharAge != '')&& ($CharAge != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharAge.'</div></td>'.
																'</tr>';
											
										 if (($CharHeight != '')&& ($CharHeight != 'NA')&& ($CharHeight != '	
									0\' 0\'\'')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharHeight.'</div></td>'.
																'</tr>';
											
										if (($CharWeight != '')&& ($CharWeight != 'NA')) 
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharWeight.'</div></td>'.
																'</tr>';
											
										if (($CharAbility != '')&& ($CharAbility != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharAbility.'</div></td>'.
																'</tr>';
									
										if (($CharNotes != '')&& ($CharNotes != 'NA'))
											$CharactersString .='<tr>'.
																'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
																'<td width="10" valign="top">&nbsp;</td>'.
																'<td  valign="top"><div class="projectboxcontent">'.$CharNotes.'</div></td>'.
																'</tr>';
										
										 $CharactersString .='</table>'; 
										 
										 $CharactersString .='</td></tr>'.
													'</table>';
	
									} 
	
							 }
					if ($Template=='html_three') {
						$ListString .= '</td>';
					} else {
						if 	($CharCount < 5){
							while($CharCount <5) {
								$ListString .= "<td></td>";
								$CharCount++;
							}
						}
					}
					$ListString .= "</tr></table>";
					
					if ($Template != 'vertical_list')
					$String .= $ListString.$CharactersString.$ModalString;
					else
					$String .= $CharactersString;
					}

					$String .= $this->drawProjectModuleFooter($this->ContentWidth);

					$db->close();
					return $String;
		}
		 
	 
			public function drawMenuLinksDropdown() {
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

					if ($this->MenuCustom == 0) 
						$query = "select * from pf_themes_menus where ThemeID='".$this->CurrentTheme."' and MenuParent=1 ORDER BY Parent, Position ASC";
					else
						$query = "select * from menu_links where ComicID='".$this->ProjectID."' and MenuParent=1 ORDER BY Parent, Position ASC";
				
					$db->query($query);
					$NumLinks = $db->numRows();
					//print $query.'<br/>';
					if ($NumLinks > 0) {
						 $String = '<option value="" style="background-color:#e1e1e1;">--=MENU LINKS=--</option>';
						while ($line = $db->fetchNextObject()) { 
					
							$ContentSection = ucfirst($line->ContentSection);
							$LinkType = $line->LinkType;
							$String .='<option value="';
								$LinkStuff .= $line->Title;
							if ($line->ContentSection == 'home'){
								$Url = '/'.$this->SafeFolder.'/';
							}else if ($line->LinkType == 'section'){
								$Url = '/'.$this->SafeFolder.'/'.$line->Url.'/';
							}else if ($line->LinkType == 'page')	{
								if ($Url == '{FirstPage}'){
									$Url = '/'.$this->SafeFolder;
								if ($this->SeriesNum != '')
									$Url = '/series/'.$this->SeriesNum;
								if ($this->EpisodeNum != '')
									$Url = '/episode/'.$this->EpisodeNum;
									
									$Url = '/reader/page/1/';
								}else if ($Url == '{NextPage}'){
									$Url = '/'.$this->SafeFolder;
								if ($this->SeriesNum != '')
									$Url = '/series/'.$this->SeriesNum;
								if ($this->EpisodeNum != '')
									$Url = '/episode/'.$this->EpisodeNum;
									
									$Url = '/reader/page/'.$this->NextPage.'/';
								}else if ($Url == '{PrevPage}'){
									$Url = '/'.$this->SafeFolder;
								if ($this->SeriesNum != '')
									$Url = '/series/'.$this->SeriesNum;
								if ($this->EpisodeNum != '')
									$Url = '/episode/'.$this->EpisodeNum;
									
									$Url = '/reader/page/'.$this->PrevPage.'/';
								}else if ($Url == '{LastPage}'){
									$Url = '/'.$this->SafeFolder;
								if ($this->SeriesNum != '')
									$Url = '/series/'.$this->SeriesNum;
								if ($this->EpisodeNum != '')
									$Url = '/episode/'.$this->EpisodeNum;
									
									$Url = '/reader/page/'.$this->LastPage.'/';
								}
							}else if ($line->LinkType == 'external')	{
									$Url = $line->Url;
									$Target= $line->Target;
							}
							$String .= $Url.'||'.$Target.'">'.$LinkStuff.'</option>';
							$LinkStuff = '';
						}

					}
				//	print 'M = ' . $String;
					$db->close();
					echo $String;
		
		}
		
		public function drawLinksSection($Section) {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$query = "select * from links where ComicID = '".$this->ProjectID."' and InternalLink=0 order by Title";
						$db->query($query);
						$numLinks =  $db->numRows();
						
						$String = $this->drawProjectModuleTop('<div class="modheader">LINKS</div><div class="spacer"></div>', $this->ContentWidth);
					
						while ($link = $db->fetchNextObject()) { 
						
							if (substr($link->Link,0,7) != 'http://')
								$Link = 'http://'.$link->Link;
							else 
								$Link = $link->Link;
							if ($link->Link != '') {
								$String .= "<div class='rectitle'><span class='pagelinks'><a href='".$Link."' target='_blank'>";
								
								if ($link->Image != '')
									$String .= "<img src='".$link->Image."' border='0'>";
								else
									$String .= stripslashes($link->Title);
	 
								$String .= "</a></span></div><div class=\"projectboxcontent\">".stripslashes($link->Description)."</div><div class='spacer'></div>";
							
							}
						}

						$query = "select * from links where ComicID = '".$this->ProjectID."' and InternalLink=1 order by Title";
						$db->query($query);

						$TotalBanners = $db->numRows();

						if ($TotalBanners > 0) {
							$String .= '<div style="width:800px;" align="center"><div class="modheader">WEB BANNERS</div>
											 <div class="spacer"></div><div class=\"projectboxcontent\">Below are banners to use on your own sites to link to this comic.
											 <div class="spacer"></div>';
							while ($link = $db->fetchNextObject()) { 
								$String .= "<img src='".$link->Image."' border='0'><div class='spacer'></div>";

							}
							$String .= '</div>';
						}

 						$String .= $this->drawProjectModuleFooter($this->ContentWidth);
						$db->close();
						return $String;
		}
		
		public function drawArchivesSection($Section) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						$Today = date('Y-m-d').' 00:00:00';
						$query = "select * from Episodes where ProjectID = '".$this->ProjectID."'";
						$db->query($query);
						$PrevEP = 0;
						$String = $this->drawProjectModuleTop('<div class=\'modheader\'>ARCHIVES</div><div class="spacer"></div>', $this->ContentWidth);
						while($line = $db->FetchNextObject()) {
							$EpisodeNum = $line->EpisodeNum;
							$SeriesNum = $line->SeriesNum;
							$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
							$CurrentDate = date('Y-m-d 00:00:00');
							$query = "select * from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition ASC";

							$db2->query($query);
							$String .= '<div ><b>EPISODE '.$EpisodeNum.' - '.$line->Title.'</b></div>';
							while($line2 = $db2->FetchNextObject()) {
									$String .='<a href="/'.$this->SafeFolder.'/reader/';
									if ($SeriesNum != 1)
										$String .= 'series/'.$SeriesNum.'/';
									$String .= 'episode/'.$EpisodeNum.'/page/'.$line2->EpPosition.'/">';
									$String .= '<img src="/'.$line2->ThumbSm.'" border="1" hspace="10" vspace="10"></a>';
							}
							$db2->close();
								$String .= '<div class="spacer"></div>';
							
						}
							
 						$String .= $this->drawProjectModuleFooter($this->ContentWidth);
						$db->close();
						return $String;
		}
		
		public function buildConnectedNav($EntryArray, $ContentID,$Template='all') {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
							$query = "select SeriesNum,EpisodeNum,EpPosition, Position from comic_pages where comicid='".$this->ProjectID."' and EncryptPageID='".$EntryArray[0]['PageID']."'";
							$ConnectedPageArray = $db->queryUniqueObject($query);
							$NextPosistion = ($ConnectedPageArray->Position + 1);
							$query = "select SeriesNum,EpisodeNum,EpPosition from comic_pages where comicid='".$this->ProjectID."' and SeriesNum='".$ConnectedPageArray->SeriesNum."' and Position='".$NextPosistion."'";
							$NextPageArray = $db->queryUniqueObject($query);
							$this->ConnectedDropdownPageOptions = '<option value="" diabled="disabled">--select--</option>';
							if ($Template == 'all') {
							$this->ConnectedDropdownPageOptions .= '<option value="/'.$this->SafeFolder.'/reader/';
							if ($ConnectedPageArray->SeriesNum != 1) 
									$this->ConnectedDropdownPageOptions .= 'series/'.$ConnectedPageArray->SeriesNum.'/';
								$this->ConnectedDropdownPageOptions .= 'episode/'.$ConnectedPageArray->EpisodeNum.'/page/'.$ConnectedPageArray->EpPosition.'/">CONNECTED PAGE</option>';	
							
							if ($NextPageArray->EpPosition != '') {
									$this->ConnectedDropdownPageOptions .= '<option value="/'.$this->SafeFolder.'/reader/';
								if ($NextPageArray->SeriesNum != 1) 
									$this->ConnectedDropdownPageOptions .= 'series/'.$NextPageArray->SeriesNum.'/';
								$this->ConnectedDropdownPageOptions .= 'episode/'.$NextPageArray->EpisodeNum.'/page/'.$NextPageArray->EpPosition.'/';	
								$this->ConnectedDropdownPageOptions .='">NEXT STORY PAGE</option>';
							}
							}
							
							$this->ConnectedDropdown ='<select id="connected" style="width:166px;" name="entry" onchange="window.location = this.options[this.selectedIndex].value;"> ';
							$this->ConnectedDropdown .=$this->ConnectedDropdownPageOptions.$this->ConnectedDropdownOptions;
							$this->ConnectedDropdown .='</select>';
							$TotalEntries = sizeof($EntryArray);
							$String = '<table cellpadding="0" cellspacing="0"><tr>';
							
								$String .='<td><img src="/images/connected/left_cap.png"></td>';
							
							$String .='<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;"><img src="/images/connected/1title.png">&nbsp;</td>';
							
							$String .='<td style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">&nbsp;&nbsp;<img src="/images/connected/2question.png" tooltip="A connected entry is additional material that is connected to this page but not a direct part of the story.">&nbsp;&nbsp;</td>';
							
							
							if ($Template == 'all') {
							$SetPrev = true;
							foreach ($EntryArray as $entry) {
								if (($ContentID != $entry['ContentID']) && ($SetPrev)) {
									$PreviousLink = $entry['Link'];
								} else if ($ContentID == $entry['ContentID']) {
									$SetPrev = false;
								} else if (($ContentID != $entry['ContentID']) && (!$SetPrev)) {
									$NextLink = $entry['Link'];
									break;
								}
							}
							$String .= '<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">';
							
							if ($PreviousLink != '')
								$String .= '<a href="/'.$this->SafeFolder.'/'.$PreviousLink .'">';
							
							$String .='<img src="/images/connected/previous_off.png"';
							
							if ($PreviousLink != '')
								$String .='onmouseover="this.src=\'/images/connected/previous_over.png\';" onmouseout="this.src=\'/images/connected/previous_off.png\';" class="navbuttons"';
							
							$String .= 'border="0">';
							
							if ($PreviousLink != '')
								$String .= '</a>';
							
							$String .='</td>';
							} else {
									$String .= '<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">';
							
		
								$String .= '<a href="/'.$this->SafeFolder.'/'.$EntryArray[0]['Link'].'"><img src="/images/connected/view_first_off.png" onmouseover="this.src=\'/images/connected/view_first_over.png\';" onmouseout="this.src=\'/images/connected/view_first_off.png\';" class="navbuttons" border="0"></a>';
							
							$String .='&nbsp;&nbsp;</td>';
								
							}
							
							$String .='<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">&nbsp;<img src="/images/connected/view.png">&nbsp;</td>';
						$String .='<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">&nbsp;'.$this->ConnectedDropdown.'&nbsp;</td>';
							
							if ($Template == 'all') {
							$String .= '<td  style="background-image:url(/images/connected/connected_entries_bar_bg.png); background-repeat: repeat-x; height:31px;">';
							if ($NextLink != '')
								$String .= '<a href="/'.$this->SafeFolder.'/'.$NextLink .'">';
							
							$String .='&nbsp;<img src="/images/connected/next_off.png"';
							
							if ($NextLink != '')
								$String .='onmouseover="this.src=\'/images/connected/next_over.png\';" onmouseout="this.src=\'/images/connected/next_off.png\';" class="navbuttons"';
							
							$String .= 'border="0">&nbsp;';
							
							if ($NextLink != '')
								$String .= '</a>';
							
							$String .='</td>';
							}
	
							$String .='<td><img src="/images/connected/end.png"></td>';
							$String .='</tr>';
							$String .= '</table>';
							$db->close();
							return $String;
		}
		public function getConnectedEntires($ContentID,$ContentType) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
							if ($ContentType == 'page') {
								$ConnectedPage = $this->PageID;
								$query = "select * from story_flow_entries where project_id='".$this->ProjectID."' and (page_id='".$ConnectedPage."' or page_id='all') order by position";
									$db->query($query);
							} else {
								$query = "select page_id from story_flow_entries where project_id='".$this->ProjectID."' and content_id='$ContentID' and content_type='$ContentType'";
								$ConnectedPage = $db->queryUniqueValue($query);
								$query = "select * from story_flow_entries where project_id='".$this->ProjectID."' and page_id='".$ConnectedPage."' order by position";
									$db->query($query);
							}
							
							
							
								if ($ConnectedPage != '') {
								
									$this->StoryFlowArray = array();
									while ($line = $db->fetchNextObject()) { 
										switch($line->content_type) {
											case 'blog':
											$link = 'blog/?post='.$line->content_id;
											break;	
											case 'download':
											$link = 'downloads/?dlid='.$line->content_id;
											break;	
											case 'gallery':
											$link = 'gallery/?gid='.$line->content_id;
											break;	
											case 'gallery item':
											$link = 'gallery/?gitem='.$line->content_id;
											break;	
											case 'character':
											$link = 'characters/?cid='.$line->content_id;
											break;
											case 'story page':
											$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
											$query = "SELECT SeriesNum, EpisodeNum, EpPosition from comic_pages where EncryptPageID='".$line->content_id."' and ComicID='".$this->ProjectID."'";
											$PageInfoArray = $db2->queryUniqueObject($query);
											$link = 'reader/';
											if ($PageInfoArray->SeriesNum != 1) 
												$link .= 'series/'.$PageInfoArray->SeriesNum.'/';
											$link .= 'episode/'.$PageInfoArray->EpisodeNum.'/page/'.$PageInfoArray->EpPosition.'/';	
											$db2->close();
											break;		
										}
										$this->ConnectedDropdownOptions .= '<option value="/'.$this->SafeFolder.'/'.$link.'"';
										if ($ContentID == $line->content_type)
											$this->ConnectedDropdownOptions .= ' selected';
											$this->ConnectedDropdownOptions .= '>'.$line->content_type.'</option>';
										$this->StoryFlowArray[] = array('ContentType'=>$line->content_type,
																		'ContentID'=>$line->content_id,
																		'Comment'=>$line->comment,
																		'Position'=>$line->position,
																		'PageID'=>$ConnectedPage,
																		'Link'=>$link);
									}
								}
		
								
								$db->close();
								return $ConnectedPage;
		}
		public function drawBlogSection($Section) {
							$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
							
							$PostID = $_GET['post'];
							if ($PostID == "") 
								$PostID = $_POST['targetid'];
						
							if ($PostID == "undefined") 
								$PostID = "";

							$SideBarWidth = 150;

							$CurrentDate = date('Y-m-d').' 00:00:00';
							if (isset($_GET['post'])) {
								$ConnectedPage = $this->getConnectedEntires($_GET['post'],'blog');
							}
							
							$String ='<table><tr><td valign="top">';		
							$String .= $this->drawProjectModuleTop('<div class=\'modheader\'>BLOG</div><div class="spacer"></div>', ($this->ContentWidth-$SideBarWidth));
							$String .='<div class="projectboxcontent" style="padding-left:10px;"">';
							
							$query = "select distinct bp.*,bc.Title as CategoryTitle, 
									  (SELECT count(*) from blogcomments as bc where bc.PostID=bp.EncryptID and bc.ComicID=bp.ComicID) as CommentCount
									  from pfw_blog_posts as bp
									  left join pfw_blog_categories as bc on bp.Category=bc.EncryptID 
									  where bp.ComicID = '".$this->ProjectID."'";
									  
							if (isset($_GET['post']))
								$query .= " and bp.EncryptID='".$_GET['post']."' ";
							else if (isset($_GET['category']))
									$query .= " and bc.Title='".$_GET['category']."' ";
							
									$query .= " and bp.PublishDate<='$CurrentDate' ";
							
							$query .= " and ((bp.AccessType='public' or bp.AccessType='')";
								
							if ($this->IsProjectSuperFan == 1)
								$query .= " or ((bp.AccessType='superfans') or (bp.AccessType='fans'))) ";
							else if ($this->IsFollowing == 1)
								$query .= " or bp.AccessType='fans') ";
							else 
								$query .= ")";	
								
							$query .= "order by bp.PublishDate DESC";
							
							//$db->query($query);
							include_once($_SERVER['DOCUMENT_ROOT'].'/classes/content_pagination.php');
							
							$pagination    =    new pagination();  
							
							$pagination->createPaging($query,2); 
							
							if (isset($_GET['post']))
							$String .='<div style="padding:10px;" align="center"><a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/">BACK TO POST LIST</a><div class="spacer"></div></div>';
							if ($ConnectedPage != '') {
								
								$String .= '<div align="center">'.$this->buildConnectedNav($this->StoryFlowArray, $_GET['post']).'</div>';
								
							}
						
							if (!isset($_GET['post']))
							$String .= '<div class="pagelinks">'.$pagination->displayPagingConc().'</div>'; 
							$String .='<div class="spacer"></div>';
							while($line=mysql_fetch_object($pagination->resultpage)) {
								
								if ($line->CommentCount == 0)
									$CommentTag ='';
								else if ($line->CommentCount > 1) 
									$CommentTag = ' >> ('.$line->CommentCount.') Comments'; 
								else 
									$CommentTag = ' >> ('.$line->CommentCount.') Comment';
								
								if ($_GET['post'] == '')
									$CommentTag .='&nbsp;<span class="pagelinks">[<a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?post='.$line->EncryptID.'">READ</a>]</span>';
								
								$String .='<b>'.stripslashes($line->Title).'</b><br/>';
								$String .= 'posted: '.date('F j, Y',strtotime($line->PublishDate)).' by '.$line->Author.'  '.$CommentTag.'&nbsp;';
								
								if ($_GET['post'] == '') 
									$String .= '<span class="pagelinks">[<a href="/'.$this->SafeFolder.'/'.$this->ContentUrl.'/?post='.$line->EncryptID.'">LEAVE COMMENT</a>]</span><br/>';
								$BlogContent = @file_get_contents('http://127.0.0.1/'.$line->Filename);
								$String .= '<div style="border-bottom:dashed #000000 1px; padding-top:5px;padding-bottom:5px;">'.$BlogContent.'</div><div class="spacer"></div>';
								if ($_GET['post'] != ''){
									$String .= $this->drawCommentForm();
									$String .= 'COMMENTS<br/>'. $this->getPageComments();
								}
							}
							$String .='</div>';
						    $String .= $this->drawProjectModuleFooter($this->ContentWidth-$SideBarWidth);
							$String .='</td><td valign="top" id="blog_sidebar">';
						    $String .= $this->drawProjectModuleTop('', $SideBarWidth);
							$query = "select * from pfw_blog_categories where ComicID = '".$this->ProjectID."'";
							$query .= " and ((AccessType='public' or AccessType='')";
							if ($this->IsProjectSuperFan == 1)
								$query .= " or ((AccessType='superfans') or (AccessType='fans'))) ";
							else if ($this->IsFollowing == 1)
								$query .= " or AccessType='fans') ";
							else 
								$query .= ")";
							$query .=" order by Title";
							$db->query($query);
							$String .='<div class="modheader">Blog Categories</div>';
							$String .='<div class="pagelinks">';
							while ($line = $db->fetchNextObject()) { 
									$String .='<a href="/'.$this->SafeFolder.'/blog/?category='.urlencode($line->Title).'">'.stripslashes($line->Title).'</a><br/>';
							}
							$String .='</div>';
							$String .= $this->drawProjectModuleFooter($SideBarWidth);
							$String .='</td></tr></table>';
							
 							
							$db->close();
							return $String;

		} 
				
		public function drawContentSection($Section) {
			
						if ($Section == 'Episodes')
							$String = $this->drawEpisodeSection($this->ContentTemplate);
						else if ($Section == 'Links')
							$String = $this->drawLinksSection($this->ContentTemplate);
						else if ($Section == 'Characters')
							$String = $this->drawCharactersSection($this->ContentTemplate);
						else if ($Section == 'Mobile')
							$String = $this->drawMobileSection($this->ContentTemplate);
						else if ($Section == 'Gallery')
							$String = $this->drawGallerySection($this->ContentTemplate);
						else if ($Section == 'Downloads')
							$String = $this->drawDownloadsSection($this->ContentTemplate);
						else if ($Section == 'Archives')
							$String = $this->drawArchivesSection($this->ContentTemplate);
						else if ($Section == 'Blog')
							$String = $this->drawBlogSection($this->ContentTemplate);
						else if ($Section == 'Credits')
							$String = $this->drawCreditsSection($this->ContentTemplate);
						else if ($Section == 'Fans') 
							
							$String = $this->drawFanSection($this->ContentTemplate);

						return $String;
		}
		
		public function drawReaderBar($Template='') {
			
			
				if ($Template == '')
					$Template = 'standard_grey';
				
					if ($Template ==''){
							echo '<table cellpadding="0" cellspacing="0" border="0">';
							echo '<tr>';
							echo '<td background="/images/reader_bar_bg_left.png" height="26" width="450" style="background-repeat:no-repeat;" align="left">';
							echo '<table><tr><td width="300" style="padding-left:10px;" align="left" >';
							echo '<select name="sectionSelect" id="sectionSelect" style="height:18px; margin:0px; padding:0px;width:250px;" onChange="open_link(this.options[this.selectedIndex].value,\''.$AdminUserArray['Name'].'\');">';
							echo '<option value="">'.$this->ProjectTitle.'</option>';
							echo '<option value="http://www.wevolt.com/'.$this->SafeFolder.'/">--> Home</option>';
							echo '<option value="credits">---> Credits</option>';
							if ($this->Synopsis != '')
								 echo '<option value="synopsis">---> Synopsis</option>';
							 echo '<option value="http://www.wevolt.com/'.$this->PFDIRECTORY.'/feed.php?feed='.$this->SafeFolder.'||_blank">RSS Feed</option>';
							  echo '<option value="http://www.wevolt.com/r3forum/'.$this->SafeFolder.'/">-->Forum</option>';
							  		echo '<option value="http://users.wevolt.com/'.$this->AdminUserArray['Name'].'/">--->'.$this->AdminUserArray['Name'].' MYvolt</option>';
							  
							  if (($_SESSION['userid'] != '') && (($this->IsFriend==0)||(($this->Requested==0)&&($this->IsFriend==0))) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))
							  		echo '<option value="friend">---> Add '.$this->AdminUserArray['Name'].' as friend</option>';
							  if (($_SESSION['userid'] != '') && ($this->IsFollowing==0) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))	
							  echo '<option value="follow">---> Follow project</option>';
								
							  
							  
							  
							echo $this->drawMenuLinksDropdown();
							echo '</select>';
						
							echo '</td><td style="font-size:12px; color:#3166a4;" align="center" width="100"><span id="like_page_'.$this->PageID.'">';
							
							if ($this->PageLikes['Total'] > 0 ) { 
								echo $this->PageLikes['Total'] .' like'; 
								if ($this->PageLikes['Total'] != 1) echo 's';
							}
							echo '</span></td>';
							if (($this->PageLikes['UserLiked'] == 0) && ($_SESSION['userid'] != ''))
								echo '<td id="like_cell"><a href="#" onClick="like_content(\''.$this->PageID.'\',\'project_page\',\'like_page_'.$this->PageID.'\',\'/'.$this->SafeFolder.'/reader/page/'.$this->PagePosition.'/\',\''.$this->ProjectID.'\');return false;"><img src="/images/reader_like_btn.png" border="0" tooltip="Like this page, boost its rating!" tooltip_position="bottom"/></a></td>';
							
							echo '<td><a href="javascript:void(0)" onClick="parent.reader_config(\''.$this->SafeFolder.'\',\''.$this->PagePosition.'\',\''.$_SESSION['refurl'].'\',\''.$this->SeriesNum.'\',\''.$this->EpisodeNum.'\');return false;">
									<img src="/images/reader_config_btn.png" border="0" tooltip="Change your reader style (Flash or HTML)" tooltip_position="bottom"/></a></td>';
									
							if ($_SESSION['userid'] != '')
										echo '<td><a href="javascript:void(0)" onClick="parent.volt_wizard(\''.$this->ProjectID.'\');return false;"><img src="/images/reader_volt_btn.png" border="0" tooltip="Volt or Excite '.str_replace('_',' ',$this->SafeFolder).'" tooltip_position="bottom"/></a></td>';
							echo '<td><a href="javascript:void(0)" onClick="parent.share_project(\''.$this->PagePosition.'\',escape(\''.str_replace("_", " ", $this->SafeFolder).'\'));return false;">
									<img src="/images/share_btn.png" border="0" tooltip="Share '.str_replace('_',' ',$this->SafeFolder).' on other websites" tooltip_position="bottom"/></a></td>';
							echo '</tr></table>';
							echo '</td>';
							echo '<td style="padding-left:5px; padding-right:5px;background-repeat:no-repeat; background-position:top right;" background="/images/reader_bar_bg_right.png" height="26" width="350" align="right"><table width="100%"><tr><td valign="top">'.$this->buildArchivesDropdown().'</td>
								<td valign="top" width="85" align="right"><a href="/'.$this->SafeFolder;
							
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
						if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
						
								echo '/episode/1';
							echo '/page/1/"><img src="/images/first_page_btn.png" border="0" tooltip="Jump to the Beginning" tooltip_position="bottom"/></a><a href="/'.$this->SafeFolder;
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							if ($this->PrevEpisode != '')
								echo '/episode/'.$this->PrevEpisode;
							echo '/page/'.$this->PrevPage.'/"><img src="/images/prev_page_btn.png" border="0"/></a><a href="/'.$this->SafeFolder;
							
											
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							if ($this->NextEpisode != '')
								echo '/episode/'.$this->NextEpisode;
							else if ($this->EpisodeNum != '')
									echo '/episode/'.$this->EpisodeNum;
								
							echo '/page/'.$this->NextPage.'/"><img src="/images/next_page_btn.png" border="0"/></a><a href="/'.$this->SafeFolder;
								
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							
								echo '/episode/'.$this->LastEpisode;
							echo '/page/'.$this->LastPage.'/"><img src="/images/last_page_btn.png" border="0" tooltip="Jump to the End" tooltip_position="bottom"/></a></td></tr></table>
								</td>
								</tr>
								</table>';
					} else if ($Template=='standard_grey') {
						if ($this->InRumble == 1) {
							if ($this->RumbleRound == 'lord') {
								$RumbleBanner = 'lord_banner.png';
							} else {
								if ($this->RoundOneRank == 1)
									$RumbleBanner = 'round_1_champ.png';
								else if ($this->RoundTwoRank == 1)
									$RumbleBanner = 'round_2_champ.png';
								else if ($this->RoundThreeRank == 1) 
										$RumbleBanner = 'round_3_champ.png';	
										
								else 
									$RumbleBanner = 'rumble_round_'.$this->RumbleRound.'_week_'.$this->RumbleWeek.'.png';
							}
						
								echo '<div style="height:101px;width:720px;background-image:url(/images/'.$RumbleBanner.'); background-repeat:no-repeat; vertical-align:bottom;"><div style="height:53px;" onclick="location.href=\'/rumble.php?s=leaderboard\';" class="navbuttons"></div>';	
						}
							
							echo '<table width="720" cellpadding="0" cellspacing="0" border="0"><tr>';
							echo '<td background="/images/reader/standard/reader_bar_grey.png" height="38" width="720" style="background-repeat:no-repeat;" align="left">';
							echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
							
							//LEFT DROPDOWN
							echo '<td width="194" style="padding-left:10px;" align="left" >';
							
							echo '<select name="sectionSelect" id="sectionSelect" style="height:18px; margin:0px; padding:0px;width:184px;" onChange="open_link(this.options[this.selectedIndex].value);">';
							echo '<option value="http://www.wevolt.com/'.$this->SafeFolder.'/reader/">'.$this->ProjectTitle.'</option>';
							
							if (($this->ProjectSeriesArray[0]['SeriesNum'] != '') && ($this->ProjectSeriesArray[1]['SeriesNum'] != ''))
								echo '<option value="" style="background-color:#bccbd1;">--=OTHER SERIES=--</option>';
							foreach($this->ProjectSeriesArray as $pseries) {
								if ($pseries['SeriesNum'] != 1){
								echo '<option value="http://www.wevolt.com/'.$this->SafeFolder.'/reader/series/'.$pseries['SeriesNum'].'/episode/1/page/1/"';
								if ($this->SeriesNum == $pseries['SeriesNum'])
									echo ' selected ';
								echo '>'.$pseries['Title'].'</option>';
								}
							}
						
							
							echo $this->drawMenuLinksDropdown();
							
							echo '<option value="" style="background-color:#f7f5b2;">--=MAIN LINKS=--</option>';
								echo '<option value="http://www.wevolt.com/'.$this->SafeFolder.'/">--> Home</option>';
							echo '<option value="credits">---> Credits</option>';
							if ($this->Synopsis != '')
								 echo '<option value="synopsis">---> Synopsis</option>';
							 echo '<option value="http://www.wevolt.com/'.$this->PFDIRECTORY.'/feed.php?feed='.$this->SafeFolder.'||_blank">--> RSS Feed</option>';
							  echo '<option value="http://www.wevolt.com/r3forum/'.$this->SafeFolder.'/">--> Forum</option>';
							  echo '<option value="http://users.wevolt.com/'.$this->AdminUserArray['Name'].'/">--->'.$this->AdminUserArray['Name'].' MYvolt</option>';
							   if (($_SESSION['userid'] != '') && (($this->IsFriend==0)||(($this->Requested==0)&&($this->IsFriend==0))) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))
							  		echo '<option value="friend">---> Add '.$this->AdminUserArray['Name'].' as friend</option>';
							  if (($_SESSION['userid'] != '') && ($this->IsFollowing==0) &&($_SESSION['userid'] != $this->AdminUserArray['UserID']))	
							  echo '<option value="follow">---> Follow project</option>';
							
							echo '</select>';
							echo '</td>';
							
							//LIKE BOX
							echo '<td style="font-size:9px; color:#ffffff;" align="left" width="38"><span id="like_page_'.$this->PageID.'">';
							
							if ($this->PageLikes['Total'] > 0 ) { 
								echo $this->PageLikes['Total'] .'<br/>like'; 
								if ($this->PageLikes['Total'] != 1) echo 's';
							}
							echo '</span></td>';
							
							//LIKE BUTTON
							echo '<td width="30">';
							if (($this->PageLikes['UserLiked'] == 0) && ($_SESSION['userid'] != ''))
								echo '<a href="javascript:void(0)" onClick="like_content(\''.$this->PageID.'\',\'project_page\',\'like_page_'.$this->PageID.'\',\'/'.$this->SafeFolder.'/reader/page/'.$this->PagePosition.'/\',\''.$this->ProjectID.'\');return false;">';
							echo '<img src="/images/reader/standard/like_icon.png" border="0"';
							if (($this->PageLikes['UserLiked'] > 0) && ($this->PageLikes['UserLiked'] != ''))
								echo 'tooltip="You like this page" tooltip_position="bottom"';
							else if ($_SESSION['userid'] != '')
								echo 'tooltip="Like this page, boost it\'s rating!" tooltip_position="bottom"';
							else
								echo 'tooltip="You need to log in to like content" tooltip_position="bottom"';
							echo '/>';
							
							if (($this->PageLikes['UserLiked'] == 0) && ($_SESSION['userid'] != ''))
								echo '</a>';
							echo '</td>';
							
							
							//REVIEW CONFIG
							echo '<td>';
							if (($_SESSION['userid'] != '') && ($_SESSION['username'] == 'matteblack'))
								echo '<a href="javascript:void(0)" onClick="parent.rate_project(\''.$this->SafeFolder.'\');return false;">';
							echo '<img src="/images/reader/standard/reader_rate_icon.png" border="0" tooltip="Rate '.str_replace('_',' ',$this->SafeFolder).'" tooltip_position="bottom"/>';
							if (($_SESSION['userid'] != '') && ($_SESSION['username'] == 'matteblack'))
								echo '</a>';
							echo '</td>';
							
							//READER CONFIG
							echo '<td><a href="javascript:void(0)" onClick="parent.reader_config(\''.$this->SafeFolder.'\',\''.$this->PagePosition.'\',\''.$_SESSION['refurl'].'\');return false;">
									<img src="/images/reader/standard/reader_config_icon.png" border="0" tooltip="Change your reader style (Flash or HTML)" tooltip_position="bottom"/></a></td>';
							echo '<td>';	
							
							// VOLT BUTTONG
							echo '<td>';	
							if ($_SESSION['userid'] != '')
								echo '<a href="javascript:void(0)" onClick="parent.volt_wizard(\''.$this->ProjectID.'\');return false;">';
							echo '<img src="/images/reader/standard/reader_volt_icon.png" border="0" tooltip="Volt or Excite '.str_replace('_',' ',$this->SafeFolder).'" tooltip_position="bottom"/>';
							if ($_SESSION['userid'] != '')
								echo '</a>';
							echo '</td>';
							
							//SHARE PROJECT BUTTON
							echo '<td>';
							echo '<a href="javascript:void(0)" onClick="parent.share_project(\''.$this->PagePosition.'\',escape(\''.str_replace("_", " ", $this->SafeFolder).'\'));return false;">
								  <img src="/images/reader/standard/reader_share_icon.png" border="0" tooltip="Share '.str_replace('_',' ',$this->SafeFolder).' on other websites" tooltip_position="bottom"/>
								  </a>';
							echo '</td>';
							
							//ARCHIVES DROPDOWN
							echo '<td width="160" align="center">'.$this->buildArchivesDropdown().'</td>';
							
							echo '<td width="160">';
							
							//DRAW FIRST PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
						
								echo '/episode/1';
							echo '/page/1/"><img src="/images/reader/standard/reader_first_page_icon.png" border="0"  tooltip="Jump to the Beginning" tooltip_position="bottom"/></a>';
							
							//PREV PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum; 
							if ($this->PrevEpisode != '')
								echo '/episode/'.$this->PrevEpisode;
							echo '/page/'.$this->PrevPage.'/"><img src="/images/reader/standard/reader_prev_page_icon.png" border="0"/></a>';
							
							//BOOKMARK BUTTON
							echo '<img src="http://www.wevolt.com/images/reader/standard/rader_bookmark_icon.png"';
							if ($_SESSION['userid'] != '') {
								echo ' tooltip="Bookmark your place" tooltip_position="bottom" class="navbuttons" onclick="bookmark_project();"';
							} else {
								echo 'tooltip="You must be logged in to bookmark your place" tooltip_position="bottom"';	
								
							}
							if ($this->IsBookMarked == 1) 	
								echo 'style="display:none;"';
							
							echo ' id="add_bookmark">';
							
							echo '<img src="http://www.wevolt.com/images/reader/standard/rader_bookmark_icon_on.png"';

							echo ' tooltip="Clear your bookmark" tooltip_position="bottom" class="navbuttons" onclick="remove_bookmark();"';
							
							if ($this->IsBookMarked != 1) 	
								echo 'style="display:none;"';
							
							echo ' id="clear_bookmark">';
							
							
							//NEXT PAGE
							echo '<a href="/'.$this->SafeFolder;			
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							if ($this->NextEpisode != '')
								echo '/episode/'.$this->NextEpisode;
							else if ($this->EpisodeNum != '')
									echo '/episode/'.$this->EpisodeNum;
								
							echo '/page/'.$this->NextPage.'/"><img src="/images/reader/standard/reader_next_page_icon.png" border="0"/></a>';
							
							//LAST PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							echo '/';
							if ($_SESSION['readerpage'] == 'inline')
								echo 'inline';
							echo 'reader';
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							
								echo '/episode/'.$this->LastEpisode;
							echo '/page/'.$this->LastPage.'/"><img src="/images/reader/standard/reader_last_page_icon.png" border="0"  tooltip="Jump to the End" tooltip_position="bottom"/></a>';
			
							echo '</td>';
							
							echo '</tr></table>';		
							echo '</td></tr></table>';
							
							if ($this->InRumble == 1) {
								echo '</div>';	
							}
							
					
					
					}
					
		}
		
		public function drawPageNav($Template='',$ReaderSection='') {
						if ($ReaderSection == '')
							$ReaderSection='reader';
													
						if (($Template == '') || ($Template == 'standard_grey')){
							
							//if (($this->InRumble == 1) && ($this->CurrentPageDate >=$this->RumbleDate) && (($this->RoundOneRank != 1) &&($this->RoundTwoRank != 1) &&($this->RoundThreeRank != 1) )) {
								if ($this->InRumble == 1) {
							echo '<div style="height:53px;width:720px;background-image:url(/images/rummble_bottom.png); background-repeat:no-repeat; vertical-align:bottom;"><div style="height:7px;"></div><table width="100%"><tr><td width="295" align="left" style="padding-left:20px;">';
							}
							echo '<table width="169" cellpadding="0" cellspacing="0" border="0"><tr>';
							echo '<td background="/images/reader/standard/!READER_BASE_SMALL.png" height="38" width="169" style="background-repeat:no-repeat;" align="center">';

							//DRAW FIRST PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo $ReaderSection;
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
						
								echo '/episode/1';
							echo '/page/1/"><img src="/images/reader/standard/reader_first_page_icon.png" border="0" /></a>';
							
							//PREV PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo $ReaderSection;
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							if ($this->PrevEpisode != '')
								echo '/episode/'.$this->PrevEpisode;
							echo '/page/'.$this->PrevPage.'/"><img src="/images/reader/standard/reader_prev_page_icon.png" border="0"/></a>';
							
												//BOOKMARK BUTTON
							echo '<img src="http://www.wevolt.com/images/reader/standard/rader_bookmark_icon.png"';
							if ($_SESSION['userid'] != '') {
								echo ' tooltip="Bookmark your place" tooltip_position="bottom" class="navbuttons" onclick="bookmark_project();"';
							} else {
								echo 'tooltip="You must be logged in to bookmark your place" tooltip_position="bottom"';	
								
							}
							if ($this->IsBookMarked == 1) 	
								echo 'style="display:none;"';
							
							echo ' id="add_bookmark">';
							
							echo '<img src="http://www.wevolt.com/images/reader/standard/rader_bookmark_icon_on.png"';

							echo ' tooltip="Clear your bookmark" tooltip_position="bottom" class="navbuttons" onclick="remove_bookmark();"';
							
							if ($this->IsBookMarked != 1) 	
								echo 'style="display:none;"';
							
							echo ' id="clear_bookmark">';
							
							//NEXT PAGE
							echo '<a href="/'.$this->SafeFolder;			
							echo '/';
								if ($_SESSION['readerpage'] == 'inline')
										echo 'inline';
							echo $ReaderSection;
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							if ($this->NextEpisode != '')
								echo '/episode/'.$this->NextEpisode;
							else if ($this->EpisodeNum != '')
									echo '/episode/'.$this->EpisodeNum;
								
							echo '/page/'.$this->NextPage.'/"><img src="/images/reader/standard/reader_next_page_icon.png" border="0"/></a>';
							
							//LAST PAGE BUTTON
							echo '<a href="/'.$this->SafeFolder;
							echo '/';
							if ($_SESSION['readerpage'] == 'inline')
								echo 'inline';
							echo $ReaderSection;
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								echo '/series/'.$this->SeriesNum;
							
								echo '/episode/'.$this->LastEpisode;
							echo '/page/'.$this->LastPage.'/"><img src="/images/reader/standard/reader_last_page_icon.png" border="0"/></a>';
			
							echo '</td>';
							
							$url = '%2F'.$this->SafeFolder.'%2F';
								
								if ($_SESSION['readerpage'] == 'inline')
										$url .='inline';
							$url .=$ReaderSection;
							if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
								$url .= '%2Fseries%2F'.$this->SeriesNum;
							if ($this->NextEpisode != '')
								$url .= '%2Fepisode%2F'.$this->NextEpisode;
							else if ($this->EpisodeNum != '')
									$url .= '%2Fepisode%2F'.$this->EpisodeNum;
								
							$url .= '%2Fpage%2F'.$this->EpPosition.'%2F';
							
							echo '</tr></table>';
							
							if ($this->InRumble == 1) {
								echo '</td><td><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.wevolt.com'.$url.'&amp;layout=button_count&amp;show_faces=false&amp;width=404&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true" id="likeframe" name="likeframe"></iframe></td></tr></table></div>';
							}	
							
							
						}
		}
				
		public function drawPeelJS() {
						echo '<script type="text/javascript">';
								echo 'function peelpage(peelid) {';
									echo 'if (peelid == \'pagediv\') { ';
											if ($this->PagePeels['pencils'] != '') {
												echo 'document.getElementById("PeelOne").style.display =\'none\';';
												echo 'document.getElementById("onetab").className =\'peeltabinactive\';';
												
											}
											if ($this->PagePeels['inks'] != '') {
												echo 'document.getElementById("PeelTwo").style.display =\'none\';';
												echo 'document.getElementById("twotab").className =\'peeltabinactive\';';
											}
											if ($this->PagePeels['colors'] != '') {
												echo 'document.getElementById("PeelThree").style.display =\'none\';';
												echo 'document.getElementById("threetab").className =\'peeltabinactive\';';
											}
											if ($this->PagePeels['script'] != '') {
												echo 'document.getElementById("PeelFour").style.display =\'none\';';
												echo 'document.getElementById("fourtab").className =\'peeltabinactive\';';
												echo 'document.getElementById("pdfcell").style.display =\'none\';';
											} 
											echo 'document.getElementById("pagediv").style.display =\'\';';
											echo 'document.getElementById("finaltab").className =\'peeltabactive\';';
									echo '} else if (peelid == \'PeelOne\') { ';
												echo 'document.getElementById("PeelOne").style.display =\'\';';
												echo 'document.getElementById("onetab").className =\'peeltabactive\';';
											 if ($this->PagePeels['inks'] != '') {
												echo 'document.getElementById("PeelTwo").style.display =\'none\';';
												echo 'document.getElementById("twotab").className =\'peeltabinactive\';';
											 } 
											 if ($this->PagePeels['colors'] != '') {
												echo 'document.getElementById("PeelThree").style.display =\'none\';';
												echo 'document.getElementById("threetab").className =\'peeltabinactive\';';
											 } 
											 if ($this->PagePeels['script'] != '') {
												echo 'document.getElementById("PeelFour").style.display =\'none\';';
												echo 'document.getElementById("fourtab").className =\'peeltabinactive\';';
												echo 'document.getElementById("pdfcell").style.display =\'none\';';
											 } 
												echo 'document.getElementById("pagediv").style.display =\'none\';';
												echo 'document.getElementById("finaltab").className =\'peeltabinactive\';';
									echo '} else if (peelid == \'PeelTwo\') { ';
											 if ($this->PagePeels['pencils'] != '') {
												echo 'document.getElementById("PeelOne").style.display =\'none\';';
												echo 'document.getElementById("onetab").className =\'peeltabinactive\';';
											 }
											
												echo 'document.getElementById("PeelTwo").style.display =\'\';';
												echo 'document.getElementById("twotab").className =\'peeltabactive\';';
									
											if ($this->PagePeels['colors'] != '') {
												echo 'document.getElementById("PeelThree").style.display =\'none\';';
												echo 'document.getElementById("threetab").className =\'peeltabinactive\';';
											 }
											if ($this->PagePeels['script'] != '') {
												echo 'document.getElementById("PeelFour").style.display =\'none\';';
												echo 'document.getElementById("fourtab").className =\'peeltabinactive\';';
												echo 'document.getElementById("pdfcell").style.display =\'none\';';
											}
												echo 'document.getElementById("pagediv").style.display =\'none\';';
												echo 'document.getElementById("finaltab").className =\'peeltabinactive\';';
									echo '} else if (peelid == \'PeelThree\') {';
										
											if ($this->PagePeels['pencils'] != '') {
												echo 'document.getElementById("PeelOne").style.display =\'none\';';
												echo 'document.getElementById("onetab").className =\'peeltabinactive\';';
											 }
											if ($this->PagePeels['inks'] != '') {
												echo 'document.getElementById("PeelTwo").style.display =\'none\';';
												echo 'document.getElementById("twotab").className =\'peeltabinactive\';';
											 } 
											if ($this->PagePeels['script'] != '') {
												echo 'document.getElementById("PeelFour").style.display =\'none\';';
												echo 'document.getElementById("pdfcell").style.display =\'none\';';
												echo 'document.getElementById("fourtab").className =\'peeltabinactive\';';
											 } 
												echo 'document.getElementById("PeelThree").style.display =\'\';';
												echo 'document.getElementById("threetab").className =\'peeltabactive\';';
												echo 'document.getElementById("pagediv").style.display =\'none\';';
												echo 'document.getElementById("finaltab").className =\'peeltabinactive\';';
												
									echo '}  else if (peelid == \'PeelFour\') {';
										
											if ($this->PagePeels['pencils'] != '') {
												echo 'document.getElementById("PeelOne").style.display =\'none\';';
												echo 'document.getElementById("onetab").className =\'peeltabinactive\';';
											}
											 if ($this->PagePeels['inks'] != '') {
												echo 'document.getElementById("PeelTwo").style.display =\'none\';';
												echo 'document.getElementById("twotab").className =\'peeltabinactive\';';
											} 
											if ($this->PagePeels['colors'] != '') {
												echo 'document.getElementById("PeelThree").style.display =\'none\';';
												echo 'document.getElementById("threetab").className =\'peeltabinactive\';';
										 	} 
											
											echo 'document.getElementById("PeelFour").style.display =\'\';';
											echo 'document.getElementById("pdfcell").style.display =\'\';';
											echo 'document.getElementById("fourtab").className =\'peeltabactive\';';
											echo 'document.getElementById("pagediv").style.display =\'none\';';
											echo 'document.getElementById("finaltab").className =\'peeltabinactive\';';
									echo '}';
	

									echo '}';


									echo '</script>';
		}
		
		public function drawReader() {
							$this->drawPeelJS();
							
								if (($_SESSION['IsPro'] == 1) &&($this->ProImage != ''))
							list($PageWidth,$PageHeight)=@getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.$this->ProImage);
						else
							list($PageWidth,$PageHeight)=@getimagesize($_SERVER['DOCUMENT_ROOT'].'/'.$this->BaseProjectDirectory.'images/pages/'.$this->Image);
							 if (($this->ProjectType == 'writing') || ($this->PageAreaWidth == 'content')) 
						 		$AreaWidth = $_SESSION['contentwidth'];
							else 
								$AreaWidth = $PageWidth;
						if (($this->Privacy == 'public') || (($this->Privacy == 'fans') && (($this->IsFollowing == 1)||($this->IsProjectSuperFan == 1)))|| (($this->Privacy == 'superfans') && ($this->IsProjectSuperFan == 1)) || ($this->IsOwner==1)) {	
						
						
						if (($this->PagePeels['pencils'] != '') || ($this->PagePeels['inks'] != '') || ($this->PagePeels['colors'] != '') || ($this->PagePeels['script'] != '')) {
							echo '<center><div id="peeldiv" align="left" style="width:'.$PageWidth.'px;"><table cellspacing="0" cellpadding="0" border="0"><tr>';
							echo '<td><div class="peeltabactive" onclick="peelpage(\'pagediv\');finaltab();" id="finaltab">FINAL</div></td><td width="5"></td>';
							if ($this->PagePeels['colors'] != '') 
								echo '<td><div class="peeltabinactive" onclick="peelpage(\'PeelThree\');threetab();" id="threetab">COLORS</div></td><td width="5"></td>';
							if ($this->PagePeels['inks'] != '') 
								echo '<td><div class="peeltabinactive" onclick="peelpage(\'PeelTwo\');twotab();" id="twotab">INKS</div></td><td width="5"></td>';
							if ($this->PagePeels['pencils'] != '')  
								echo '<td><div class="peeltabinactive" onclick="peelpage(\'PeelOne\');onetab();" id="onetab">PENCILS</div></td><td width="5"></td>';
							if ($this->PagePeels['script'] != '') 
								echo '<td><div class="peeltabinactive" onclick="peelpage(\'PeelFour\');fourtab();" id="fourtab">SCRIPT</div></td>
											  <td id="pdfcell" style="display:none;" valign="top">
											  <a href="http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->PagePeels['scriptpdf'].'" target="_blank">
											  <img src="/'.$this->PFDIRECTORY.'/templates/common/images/pdf_icon.png" border="0"></a></td>';
							echo '</tr></table></div></center>';
			  			 }
						
			   			
							
							
			   			 echo '<div id="pagediv" style="width:'.$AreaWidth.'px;" align="center"><div id="pagereaderdiv" style="z-index:1;width:'.$PageWidth.'px;">';
						 if ($this->ProjectType == 'writing') {
							 if ($this->ViewType == 'html') {
								 echo '<div style="width:'.$_SESSION['contentwidth'].'px;">';
								echo @file_get_contents('http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->HTMLFile);
								echo '</div>';				 
							 } else {
								echo '<a href="http://www.wevolt.com/'.$this->SafeFolder;
									echo '/reader';
									if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
										echo '/series/'.$this->SeriesNum;
								if ($this->NextEpisode != '')
									echo '/episode/'.$this->NextEpisode;
								else if ($this->EpisodeNum != '')
									echo '/episode/'.$this->EpisodeNum;
									
									echo '/page/'.$this->NextPage.'/"><img  id="finalpage" onLoad="resize_frame();" src="http://www.wevolt.com/';
								if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->ProImage != '')){
									echo $this->ProImage.'"';
									if ($PageWidth > 1024)
											echo 'width="1024" ';
								}else{
									echo $this->BaseProjectDirectory.'images/pages/'.$this->Image.'"';
									
									if (($PageWidth > 800) &&($_SESSION['IsPro'] != 1))
											echo 'width="800" ';
								}
								echo '" border="0"></a>';
							 }

						 } else {
							 
						 if (($this->FileType != 'flv') && ($this->FileType != 'swf')) {
													
							echo '<a href="http://www.wevolt.com/'.$this->SafeFolder;
								
									
									echo '/reader';
									if (($this->SeriesNum != '') && ($this->SeriesNum != 1))
										echo '/series/'.$this->SeriesNum;
								if ($this->NextEpisode != '')
									echo '/episode/'.$this->NextEpisode;
								else if ($this->EpisodeNum != '')
									echo '/episode/'.$this->EpisodeNum;
									echo '/page/'.$this->NextPage.'/"><img  id="finalpage" onLoad="resize_frame();" src="http://www.wevolt.com/';
							
							if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->ProImage != '')){
								
								echo $this->ProImage.'"';
								if ($PageWidth > 1024)
											echo 'width="1024" ';
							}else{
								echo $this->BaseProjectDirectory.'images/pages/'.$this->Image.'"';
								if (($PageWidth > 800) &&($_SESSION['IsPro'] != 1))
											echo 'width="800" ';
							}
						} else if ($this->FileType =='flv') {
							$this->VideoFile = 'http://www.wevolt.com'.$this->BaseProjectDirectory.'images/pages/'.$this->MediaFile;
						}else if ($this->FileType =='swf') {
							$this->FlashFile = 'http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->MediaFile;
						}
						
						 if (($_SESSION['IsPro'] != 1) && ($_SESSION['ProInvite'] != 1)){
							$this->PrevPageImage ='http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->PrevPageImage;
							$this->NextPageImage ='http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->NextPageImage;
					     } 
				
						if (sizeof($this->PageHotSpots) > 0) 
								echo 'usemap="#hotmap" ';
						if (($this->FileType != 'flv') && ($this->FileType != 'swf')) 
							echo ' border="0"></a>';
				
						echo '</div></div><div id="PeelOne" style="display:none;">';
			
						if ($this->PagePeels['pencils'] != '') {
								echo '<img src="http://www.wevolt.com/';
								
								 if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->PagePeels['pencilspro'] != '')){
								 		echo $this->PagePeels['pencilspro'].'"';
										if ($PageWidth > 1024)
											echo 'width="1024" ';
								 } else {
										echo $this->BaseProjectDirectory.'images/pages/'.$this->PagePeels['pencils'].'"';
										if ($PageWidth > 800)
											echo 'width="800" ';
								 }
								echo '>';								
						}
					
				echo '</div><div id="PeelTwo" style="display:none;">';
				if ($this->PagePeels['inks'] != '') {
								echo '<img src="http://www.wevolt.com/';
								
								if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->PagePeels['inkspro'] != '')){
								 		echo $this->PagePeels['inkspro'].'"';
										if ($PageWidth > 1024)
											echo 'width="1024" ';
								 } else {
										echo $this->BaseProjectDirectory.'images/pages/'.$this->PagePeels['inks'].'"';
										if ($PageWidth > 800)
											echo 'width="800" ';
								 }
								echo '>';
								
						}
				
				echo '</div><div id="PeelThree" style="display:none;">';
					
				if ($this->PagePeels['colors'] != '') {
								echo '<img src="http://www.wevolt.com/';
								
								 if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->PagePeels['colorspro'] != '')){
								 		echo $this->PagePeels['colorspro'].'"';
										if ($PageWidth > 1024)
											echo 'width="1024" ';
								 } else {
										echo $this->BaseProjectDirectory.'images/pages/'.$this->PagePeels['colors'].'"';
										if ($PageWidth > 800)
											echo 'width="800" ';
								 }
								echo '>';
								
						}
				
				echo '</div><div id="PeelFour" style="display:none;">';
					
				if ($this->PagePeels['script'] != '') {
								echo '<img src="http://www.wevolt.com/';
								
								if ((($_SESSION['IsPro'] == 1) || ($_SESSION['ProInvite'] == 1)) &&($this->PagePeels['scriptpro'] != '')){
								 		echo $this->PagePeels['scriptpro'].'"';
								 } else {
										echo $this->BaseProjectDirectory.'images/pages/'.$this->PagePeels['script'].'"';
										if ($PageWidth > 800)
											echo 'width="800" ';
								 }
								echo '>';
								
						}
				
				echo '</div>';

			} 
			echo '</div>';
			$ConnectedPage = $this->getConnectedEntires($this->PageID,'story page');
			if ($ConnectedPage != '')
				echo '<div class="spacer"></div><div align="center">'.$this->buildConnectedNav($this->StoryFlowArray, $this->PageID,'entries').'</div>';
				else
				
			if ((sizeof($this->StoryFlowArray) > 0)&&($this->StoryFlowArray[0]['ContentType'] != '')) {
				echo '<center><div class="spacer"></div><div class="modheader" style="width:'.$PageWidth.'px;">Connected Entries</div>';
				
								
				foreach($this->StoryFlowArray as $entry) {
					if ($entry['ContentType'] != '') {
						echo $this->drawProjectModuleTop('', $PageWidth);
						echo '<a href="/'.$this->SafeFolder.'/'.$entry['Link'].'"><b>'.ucfirst($entry['ContentType']).' Entry</b> - [MORE INFO]</a><br/>';
						echo $entry['Comment'];
						echo $this->drawProjectModuleFooter($PageWidth);
						echo '<div style="height:5px;"></div>';
											
					}
				}
				echo '</div>';
					
				
			}
						} else {
							if ($this->Privacy == 'fans') 
									$Wanrning= '<a href="javascript:void(0)" onclick="follow(\''.$this->ProjectID.'\',\''.$_SESSION['userid'].'\',\'project\');"><img src="/images/fan_content_warning.png" border="0"></a>';
								else if ($this->Privacy == 'superfans') 
									$Wanrning= '<a href="http://www.wevolt.com/superfan.php?p='.$this->SafeFolder.'"><img src="/images/superfan_content_warning.png" border="0"></a>';
						 echo '<div id="pagediv" style="width:600px;" align="center">';	
						echo $Wanrning;
						echo '</div>';
							
						}
				//return $PageArea;
		}
		
		public function drawiPhoneReader($size='320') {
  						
			   			 echo '<div id="pagediv">'; 
						 if ($this->ProjectType == 'writing') {
							echo @file_get_contents('http://www.wevolt.com/'.$this->BaseProjectDirectory.'images/pages/'.$this->HTMLFile);
			
						 } else {
								 if (($this->FileType != 'flv') && ($this->FileType != 'swf')) {
									echo '<a href="http://www.wevolt.com'.$this->BaseProjectDirectory.'images/pages/'.$this->Image.'" target="_blank">';
									echo '<img id="PageImage" src="http://www.wevolt.com'.$this->BaseProjectDirectory.'iphone/images/pages/'.$size.'/'.$this->Image.'" border="0">';
									echo ' </a>';	
								} 
					
								
						}
						echo '</div>';
		}
		
		public function getContentArea($ModuleSeparation,$ModuleSizes,$HeaderPlacement) {
					$this->RightSideWidth = $ModuleSizes['RightSideWidth'];
					$this->LeftSideWidth = $ModuleSizes['LeftSideWidth'];
					$this->TopImageHeight = $ModuleSizes['TopImageHeight'];
					$this->BottomImageHeight = $ModuleSizes['BottomImageHeight'];
					$this->BottomLeftCornerHeight = $ModuleSizes['BottomLeftCornerHeight'];
					$this->BottomLeftCornerWidth = $ModuleSizes['BottomLeftCornerWidth'];
					$this->TopLeftCornerHeight = $ModuleSizes['TopLeftCornerHeight'];
					$this->TopLeftCornerWidth = $ModuleSizes['TopLeftCornerWidth'];
					$this->TopRightCornerWidth = $ModuleSizes['TopRightCornerWidth'];
					$this->TopRightCornerHeight = $ModuleSizes['TopRightCornerHeight'];
					$this->BottomRightCornerHeight = $ModuleSizes['BottomRightCornerHeight'];
					$this->BottomRightCornerWidth = $ModuleSizes['BottomRightCornerWidth'];
					$this->RightSideWidth = $ModuleSizes['RightSideWidth'];
					$this->LeftSideWidth = $ModuleSizes['LeftSideWidth'];							
					$this->HeaderPlacement = $HeaderPlacement;
					$this->ModuleSeparation = $ModuleSeparation;
					$this->ModuleSizes = $ModuleSizes;
					
					if ($this->CustomSection == 1) {
							$ContentString= $this->CustomSectionContent;
					} else {
						switch($this->Section) {
							case 'Blog':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Links':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Creator':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Credits':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Downloads':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Products':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Mobile':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Characters':
							$ContentString=$this->drawContentSection($this->Section);
							break;
							
							case 'Episodes':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Contact':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Archives':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							case 'Fans':
							$ContentString=$this->drawContentSection($this->Section); 
							break;
							
							//PROJECT MODULES
							case 'Home':
							
							if ($this->ContentTemplate == '3_column') {
								$LeftModuleList = $this->getModules('Home','left');
								$RightModuleList = $this->getModules('Home','right');
								$MiddleModuleList = $this->getModules('Home','middle');
								$HomeTemplate ='<table width="100%"><tbody><tr><td valign="top" align="center">{COL1}</td><td width="10"></td><td valign="top">{COL2}</td><td width="10"></td><td valign="top">{COL3}</td></tr></table>';
								$HomeTemplate=str_replace("{COL1}",$this->drawModules($LeftModuleList,$ModuleSeparation,$this->SectionArray['Variable1'],$ModuleSizes,$HeaderPlacement),$HomeTemplate);
								$ContentString=str_replace("{COL2}",$this->drawModules($MiddleModuleList,$ModuleSeparation,$this->SectionArray['Variable2'],$ModuleSizes,$HeaderPlacement),$HomeTemplate);
								$ContentString=str_replace("{COL3}",$this->drawModules($RightModuleList,$ModuleSeparation,$this->SectionArray['Variable3'],$ModuleSizes,$HeaderPlacement),$ContentString);
							} else if ($this->ContentTemplate == '2_column') {
								$LeftModuleList = $this->getModules('Home','left');
								$RightModuleList = $this->getModules('Home','right');
								$HomeTemplate ='<table width="100%"><tbody><tr><td valign="top" align="center">{COL1}</td><td width="10"></td><td valign="top">{COL2}</td></tr></table>';
								$HomeTemplate=str_replace("{COL1}",$this->drawModules($LeftModuleList,$ModuleSeparation,$this->SectionArray['Variable1'],$ModuleSizes,$HeaderPlacement),$HomeTemplate);
								$ContentString=str_replace("{COL2}",$this->drawModules($RightModuleList,$ModuleSeparation,$this->SectionArray['Variable2'],$ModuleSizes,$HeaderPlacement),$HomeTemplate);
							} else if ($this->ContentTemplate == '1_column') {
								$LeftModuleList = $this->getModules('Home','left');
								$HomeTemplate ='<table width="100%"><tbody><tr><td valign="top" align="center">{COL1}</td></tr></table>';
								$ContentString=str_replace("{COL1}",$this->drawModules($LeftModuleList,$ModuleSeparation,$this->SectionArray['Variable1'],$ModuleSizes,$HeaderPlacement),$HomeTemplate);
							//$ContentString=str_replace("{COL2}",$this->drawModules($RightModuleList,$ModuleSeparation,substr($this->SectionArray['Variable2'],0,3),$ModuleSizes,$HeaderPlacement),$HomeTemplate);
								
							}
							break;
														
							case 'Gallery':
							$ContentString=$this->drawContentSection($this->Section); 
						}
					
					}
					
					return $ContentString; 
		}
		
		public function getPagePeels() {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
						
						$query = "select Image, ProImage from comic_pages where PageType='pencils' and ComicID = '".$this->ProjectID."' and ParentPage='".$this->PageID."'";
						$PeelArray = $db->queryUniqueObject($query);
						$PeelOne = $PeelArray->Image;
						$PeelOnePro = $PeelArray->ProImage;
						unset($PeelArray);
						
						$query = "select Image, ProImage from comic_pages where PageType='inks' and ComicID = '".$this->ProjectID."' and ParentPage='".$this->PageID."'";
						$PeelArray = $db->queryUniqueObject($query);
						$PeelTwo = $PeelArray->Image;
						$PeelTwoPro = $PeelArray->ProImage;
						
						unset($PeelArray);
						
						$query = "select Image, ProImage from comic_pages where PageType='colors' and ComicID = '".$this->ProjectID."' and ParentPage='".$this->PageID."'";
						$PeelArray = $db->queryUniqueObject($query);
						$PeelThree = $PeelArray->Image;
						$PeelThreePro = $PeelArray->ProImage;
						unset($PeelArray);
						
						$query = "select Image, ProImage from comic_pages where PageType='script' and ComicID = '".$this->ProjectID."' and ParentPage='".$this->PageID."'";
						$PeelArray = $db->queryUniqueObject($query);
						$PeelFour = $PeelArray->Image;
						$PeelFourPro = $PeelArray->ProImage;
						unset($PeelArray);
						
						if ($PeelFour != '') {
							$ScriptFileName = explode('.',$PeelFour);
							$ScriptPDF = $ScriptFileName[0].'.pdf';
							$ScriptHTML = $ScriptFileName[0].'.html';
						}
						
						$this->PagePeels = array(
												'pencils'=>$PeelOne,
												'pencilspro'=>$PeelOnePro,
												'inks'=>$PeelTwo,
												'inkspro'=>$PeelTwoPro,
												'colors'=>$PeelThree,
												'colorspro'=>$PeelThreePro,
												'script'=>$PeelFour, 
												'scriptpro'=>$PeelFourPro,
												'scriptfile'=>$ScriptFileName,
												'scriptpdf'=>$ScriptPDF,
												'scripthtml'=>$ScriptHTML
											);
						$db->close();
						return $this->PagePeels;
		}
		public function drawReaderModules($ReaderColumnWidth,$ReaderSection='') {
						$ModuleList = $this->getModules('Reader','left');
						if ($ReaderSection == '')
							$ReaderSection = 'site';
			
							echo $this->ReaderModules=$this->drawModules($ModuleList,$this->ModuleSeparation,$ReaderColumnWidth,$this->ModuleSizes,$this->HeaderPlacement,$ReaderSection);
		}
		
		public function setProjectTitle($ProjectTitle) {
						$this->ProjectTitle = $ProjectTitle;
		}
		public function getPageHotspots () {
						$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
		
				$query = "select * from pf_hotspots where ComicID = '".$this->ProjectID."' and PageID='".$this->PageID."'";
						$db->query($query);
						unset($this->PageHotSpots);
						$this->PageHotSpots = array(array());
						
						while ($hotspot = $db->FetchNextObject()){
							$this->PageHotSpots[] = array (
														   'AsterickCoords'=>$hotspot->AsterickCoords,
														   'MapCoords'=>$hotspot->HotSpotCoords,
														   'Content'=>$hotspot->HTMLCode
															);
						}
				
				$db->close();		
				return $this->PageHotSpots;
						
		}
		
		public function getLikes() {
								$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$query = "SELECT count(*) as NumLikes, 
						 (SELECT count(*) from likes where (ContentID='".$this->PageID."' and ProjectID='".$this->ProjectID."' and ContentType='project_page' and UserID='".$_SESSION['userid']."')) as UserLiked
						 from likes 
						 where ContentID='".$this->PageID."' and ProjectID='".$this->ProjectID."' and ContentType='project_page'";
						
						$LikeArray = $db->queryUniqueObject($query);
						$this->PageLikes = array('Total'=>$LikeArray->NumLikes, 'UserLiked'=>$LikeArray->UserLiked);
						$db->close();
						return $this->PageLikes;
						
		
		}
		 
		public function get_content_info() {

						return $this->SectionArray;
		}
		
		public function getFileType() {

						return $this->FileType;
		}
		
		public function getVideoFile() {

						return $this->VideoFile;
		}
		
		public function getFlashFile() {

						return $this->FlashFile;
		}
		
		public function getPrevPageImage() {

						return $this->PrevPageImage;
		}
		public function getNextPageImage() {

						return $this->NextPageImage;
		}
		
		public function getPrevPage() {

						return $this->PrevPage;
		}
		
		public function getNextPage() {

						return $this->NextPage;
		}
		
			public function getLastPage() {
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$CurrentDate = date('Y-m-d').' 00:00:00';
					$query = "select EpPosition from comic_pages where ComicID = '".$this->ProjectID."' and PageType='pages' and PublishDate<='$CurrentDate' and SeriesNum='".$this->SeriesNum."' order by EpPosition DESC";
					$LastPage = $db->queryUniqueValue($query);
					 $db->close();	
					return $LastPage;
		
		}
		
		

		public function get_custom_content() {

						return $this->SectionArray['CustomContent'];
		}
		
		public function iscustom_section() {

						return $this->SectionArray['CustomSection'];
		}
		
		public function setProjectType($ProjectType) {

						$this->ProjectType = $ProjectType;
		}
		
		public function get_section() {

						return $this->SectionArray['Section'];
		}
		public function setMenuSettings($CurrentTheme,$MenuCustom,$MenuLayout) {
		
						$this->CurrentTheme = $CurrentTheme;
						$this->MenuCustom = $MenuCustom;
						$this->MenuLayout = $MenuLayout;
		}
		
		public function setPageAreaWidth($PageAreaWidth) {
			$this->PageAreaWidth = $PageAreaWidth;
			
		}
		
		public function get_content_template() {

						return $this->SectionArray['Template'];
		}
		
		public function SetSiteAdmins($SiteAdmins) {
			
			$this->SiteAdmins = $SiteAdmins;
		}
		
		public function drawProjectModuleTop($Header, $Width) {
			$this->CornerWidth=15;
			//if ($_SESSION['username'] == 'wevolt')
						//print 'LEFT = ' .$this->TopLeftCornerWidth;
			$String ='<table width="'.$Width.'" border="0" cellspacing="0" cellpadding="0">
					  <tr><td colspan="3">
						<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="projectmodtopleft"></td>
						<td width="'.($Width-($this->TopLeftCornerWidth+$this->TopRightCornerWidth)).'" id="projectmodtop"></td>
						<td id="projectmodtopright"></td>
						</tr></table>
						</td>
						<tr><td colspan="3">
						<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="projectmodleftside"></td>
						<td class="projectboxcontent" width="'.($Width-($this->LeftSideWidth+$this->RightSideWidth)).'" valign="top">'.$Header;	
	
						/*$String ='<table width="'.$Width.'" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>'.
						'<td id="projectmodtopleft">'.
						'</td>'.
						'<td id="projectmodtop"></td>'.
						'<td id="projectmodtopright"></td>'.  
						'</tr>'.
						'<tr><td id="projectmodleftside"></td>'.
						'<td class="projectboxcontent" width="'.($Width-($this->CornerWidth*2)).'" valign="top">'.;
						*/
				
				return $String;
			
		}
		public function drawProjectModuleFooter($Width) {
			
			$String ='</td>
					<td id="projectmodrightside"></td>
					 </tr></table>
					</td>
					<tr><td colspan="3">
					<table width="100%" cellpadding="0" cellspacing="0"><tr>
					<td id="projectmodbottomleft"></td>
					<td width="'.($Width-($this->BottomLeftCornerWidth+$this->BottomRightCornerWidth)).'" id="projectmodbottom"></td>
					<td id="projectmodbottomright"></td>
   					 </tr></table>
   					 </td>
					</tr>
					</table>';
					/*
						$String ='<td id="projectmodrightside"></td>
                            </tr>
                            <tr>
                              <td id="projectmodbottomleft"></td>
                              <td id="projectmodbottom"></td>
                              <td id="projectmodbottomright"></td>
                            </tr>
                         </table>';
						 */
			return $String;
		}		
	}
?>