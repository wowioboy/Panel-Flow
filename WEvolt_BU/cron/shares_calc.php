<? 
include 'includes/init.php';

$query = "SELECT ProjectID from projects where userid='".$_SESSION['userid']."' or CreatorID='".$_SESSION['userid']."'";
	$InitDB->query($query);
	$ProjectList = array();
	while ($project = $InitDB->fetchNextObject()) { 
		$ProjectList[] = $project->ProjectID;	
	}
	$LastProject='';
	foreach ($ProjectList as $project) {
			$query = "SELECT s.user_id, u.username,p.title, (SELECT count(*) from subscription_shares as ss where s.user_id=ss.user_id) as TotalShares
				  from subscription_shares as s
				  join users as u on s.user_id=u.encryptid
				  join projects as p on p.ProjectID=s.project_id
				  where s.project_id='$project' and s.status ='active'";
			$InitDB->query($query);
			
			while ($subshare = $InitDB->fetchNextObject()) {
				
				if ($LastProject != $subshare->title) {
					echo '<div><b>'.$subshare->title.'</b></div>';
					$LastProject = $subshare->title;
				}
				echo '<table>';
				
						echo '<tr>';
						echo '<td width="200">'.$subshare->username.'</td>';
						echo '<td>Share: ';
						if ($subshare->TotalShares == 1) {
							echo '$1.00';
							$Total = $Total + 1.00;
						} else if ($subshare->TotalShares == 2) {
							echo '$.50';
							$Total = $Total + .50;
						}
						echo '</td>';
						echo '</tr>'; 
				
				echo '</table>'; 
			}
	
	if ($Total != 0)
		echo '<b>Total</b>: $'. $Total;
	$Total = 0;
	
	}
	?>