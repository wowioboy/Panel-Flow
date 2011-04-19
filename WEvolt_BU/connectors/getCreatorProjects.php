<? 
$User = $_GET['user'];
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$query = "select p.*, (SELECT count(*) from follows as f where f.follow_id=p.ProjectID and f.type='project') as TotalFans, u.username, u.avatar
					           from users as u
							   join projects as p on ((p.UserID=u.encryptid or p.CreatorID=u.encryptid) and p.Hosted=1 and p.Published=1)
							  
							   where u.username='$User' order by p.title";
							   
    				$db->query($query);
					
					echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
					

					while ($project = $db->fetchNextObject()) {
						
							echo '<project>';
								echo '<title>'.$project->title.'</title>';
								echo '<creator>'.$project->username.'</creator>';
								echo '<avatar>'.$project->avatar.'</avatar>';
								echo '<safefolder>'.$project->SafeFolder.'</safefolder>';
								echo '<thumb>'.$project->thumb.'</thumb>';
								echo '<pages>'.$project->pages.'</pages>';
								echo '<fans>'.$project->TotalFans.'</fans>';
								echo '<updated>'.$project->PagesUpdated.'</updated>';
								echo '<created>'.$project->createdate.'</created>';
							echo '</project>';
							
							
					}
					$db->close();