#!/usr/bin/php -q
<? 
include_once('/var/www/httpdocs/classes/defineThis.php');
include '/var/www/httpdocs/includes/db.class.php';
$QueryDate=$_GET['date'];
$DB =  new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$DB2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$query = "SELECT count(*) FROM panel_analytics.viewsbreakdown_".$QueryDate." where ProView=0";
$OveralViews = $DB->queryUniqueValue($query); 

$query = "SELECT total_rev from panel_analytics.ad_rev_totals where rev_date='".$QueryDate."'";
$TotalRev = $DB->queryUniqueValue($query); 

if ($TotalRev != '') {
print 'Total Rev = ' . $TotalRev.'<br/>';
$query = "SELECT count(*) as TotalViews, vb.ProjectID
FROM panel_analytics.viewsbreakdown_".$QueryDate." as vb
where vb.ProView=0 and vb.ProjectID!='' GROUP BY vb.ProjectID";
$DB->query($query); 

$count = 1;
print $query.'<br/>';
while ($comic = $DB->fetchNextObject()) {  
	$ComicID = $comic->ProjectID;
	$TotalViews = $comic->TotalViews;
	print $comic->title.'<br/>';
	$Percentage = round(($TotalViews/$OveralViews) * 100,2);
	print 'Project Percent = ' . $Percentage.'<br/>';
	
	$PercentOfRevTotal = $TotalRev * round(($TotalViews/$OveralViews),2);
	print 'Percent of Rev = ' . $PercentOfRevTotal.'<br/>';
	$FinalRev = round($PercentOfRevTotal*.60,2);
	print 'Final Rev = ' . $FinalRev.'<br/>';
	
	//print 'Percentage = ' . $Percentage.'<br/>'; 
	if ($ComicID != '') {
		$query = "INSERT into panel_analytics.project_analytics_totals (project_id,query_date,total_views,rev_percentage,total_revenue) values ('$ComicID','$QueryDate','$TotalViews','$Percentage','$FinalRev')";
		$DB2->execute($query);
		print $query.'<br/>';
		print '<br/>';
		$count++;
	}

}
} else {
	
	print ' Total Revenue has not been entered from Ad partner yet.';
}


$DB->close();
$DB2->close();
?>