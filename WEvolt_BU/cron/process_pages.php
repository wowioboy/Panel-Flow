#!/usr/bin/php -q
<? 

include_once('/var/www/httpdocs/classes/defineThis.php');
include '/var/www/httpdocs/includes/db.class.php';
$DB =  new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$DB2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$CurrentDayRange = date('Y-m-d 00:00:00');
$query = "SELECT c.ProjectID, c.pages, c.PagesUpdated 
from projects as c where c.published=1 and c.installed=1 and c.Hosted=1";
$DB->query($query);
$count = 1;
print $query.'<br/>';
while ($comic = $DB->fetchNextObject()) { 
	$ComicID = $comic->ProjectID;
	$CurrentPages = $comic->pages;
	if ($ComicID != '') {
		$query = "SELECT count(*) from comic_pages where PublishDate<='$CurrentDayRange' and PageType='pages' and ComicID='$ComicID'";
		$TotalPages = $DB2->queryUniqueValue($query);
		print $query.'<br/>';
		if ($CurrentPages != $TotalPages) {
			$query = "UPDATE projects set pages='$TotalPages', PagesUpdated='$CurrentDayRange' where ProjectID='$ComicID'";
			$DB2->execute($query);
			print $query.'<br/>';
		}
		print '<br/>';
	}
}
$DB->close();
$DB2->close();
?>