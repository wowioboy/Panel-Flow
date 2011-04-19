<?php 
include 'init.php'; 

$db =  new DB($db_database,$db_host, $db_user, $db_pass);
header( 'Content-Type: text/javascript' );

$PageID = $_GET['pageid'];
$ComicID = $_GET['comicid'];  
$Movement = $_GET['move'];

if ($Movement == 'down') {
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from comic_pages where ComicID='$ComicID' order by position";
	$db->query($query);
	while ($line = $db->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptPageID;
		if ($line->EncryptPageID == $PageID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $db->numRows();
	
	$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
	$CurrentPosition = $db->queryUniqueValue($query);
	if ($CurrentPosition != 1) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition-1];
		$CurrentOrder[$ArrayPosition-1] = $NewOrder;
		   for ( $counter =0; $counter < $TotalLinks; $counter++) {
		    $MenuID = $CurrentOrder[$counter];
			$UpdatePosition = $counter + 1;
		   	$query = "UPDATE comic_pages set Position='$UpdatePosition' where EncryptPageID='$PageID'";
			$db->query($query);
			}
	}
	
}



if ($Movement == 'up') {
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from comic_pages where ComicID='$ComicID' order by position";
	$db->query($query);
	while ($line = $db->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptPageID;
		if ($line->EncryptPageID == $PageID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $db->numRows();
	$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
	$CurrentPosition = $db->queryUniqueValue($query);
	if ($CurrentPosition != $TotalLinks) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition+1];
		$CurrentOrder[$ArrayPosition+1] = $NewOrder;
		   for ($counter =0; $counter < $TotalLinks; $counter++) {
		    	$MenuID = $CurrentOrder[$counter];
				$UpdatePosition = $counter + 1;
		   		$query = "UPDATE menu comic_pages Position='$UpdatePosition' where EncryptPageID='$PageID'";
				$db->query($query);
			}
	}
	
}



?>
document.location.href='admin_php.php?id=<? echo $ComicID;?>&section=pages&page=<? echo $_GET['page'];?>';
