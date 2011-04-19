<?php

# Database Connector
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
$db = new DB;
$db2 = new DB();
$NextRound = 'round_two';

$query ="select sum(re.likes) as total, p.ProjectID,re.project from rumble_entries_stats as re 
               inner join projects as p on p.SafeFolder=re.project 
			   where re.week='round1' group by re.project order by total desc";
$db->query($query);
print $query;
$Count=1; 
while ($line = $db->fetchNextObject()) {
		$ProjectID = $line->ProjectID;
		$query ="UPDATE rumble_entries set round_one_rank='$Count' where project_id='$ProjectID'";
		$db2->execute($query);
		print $query.'<br/>';
		if ($Count != 1) {
			$query ="UPDATE rumble_entries set $NextRound='1' where project_id='$ProjectID'";
			$db2->execute($query);
			print $query.'<br/>';
			
		}
		$Count++; 
			
}