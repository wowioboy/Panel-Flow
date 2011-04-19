<? 
$User = $_GET['user'];
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$CurrentDate = date('Y-m-d 00:00:00');
$query = "select cp.*, p.title as ProjectTitle, p.SafeFolder, u.username, p.thumb, u.avatar, p.pages, p.createdate, p.HostedUrl
				 from comic_pages as cp
				 
				 join projects as p on cp.ComicID=p.ProjectID
				 join users as u on u.encryptid=p.userid 
		         where cp.PageType='pages' and cp.PublishDate<='$CurrentDate' $where order by cp.PublishDate DESC, cp.SeriesNum DESC, cp.EpisodeNum DESC, cp.EpPosition DESC limit 20";
			  

							 //  print $query;
    				$db->query($query);
					
					echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
					

					while ($project = $db->fetchNextObject()) {

							$TotalPages = $project->pages;
						
							$LastPage = '';
							if (($project->SeriesNum != 1) && ($project->SeriesNum != ''))
								$LastPage ='series/'.$project->SeriesNum.'/';
							$LastPage .= 'episode/'.$project->EpisodeNum.'/page/'.$project->EpPosition;
							
							if (($project->SeriesNum != 1) && ($project->SeriesNum != ''))
								$FirstPage ='series/'.$SeriesNum.'/';
							$FirstPage .= 'episode/1/page/1';

						
							echo '<project>';
								echo '<title>'.$project->ProjectTitle.'</title>';
								echo '<creator>'.$project->username.'</creator>';
								echo '<avatar>'.$project->avatar.'</avatar>';
								echo '<safefolder>'.$project->SafeFolder.'</safefolder>';
								echo '<thumb>'.$project->thumb.'</thumb>';
								echo '<pages>'.$project->pages.'</pages>';
								echo '<fans>'.$project->TotalFans.'</fans>';
								echo '<updated>'.$project->PublishDate.'</updated>';
								
								echo '<lastpage>http://www.wevolt.com/'.$project->SafeFolder.'/'.$LastPage.'/</lastpage>';
								echo '<pageimage>http://www.wevolt.com/comics/'.$project->HostedUrl.'/images/pages/'.$project->Image.'</pageimage>';
								echo '<pageid>'.$project->EncryptPageID.'</pageid>';
								$String = preg_replace("/<script[^>]+\>/i", "", $project->Comment);
								$String = preg_replace("/<iframe[^>]+\>/i", "", $String);
								echo '<authorcomment>'.htmlentities($String).'</authorcomment>';
								echo '<pageimagename>'.$project->Image.'</pageimagename>';
							echo '</project>';
							
							
					}
					$db->close();