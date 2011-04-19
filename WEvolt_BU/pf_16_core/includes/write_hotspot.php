<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
header( 'Content-Type: text/javascript' ); 
$UserID = $_SESSION['userid'];
$HotSpotID = $_GET['id'];
$MapCoords = $_GET['map'];
$PageID = $_GET['pageid'];
$Action = $_GET['action'];
$HSID = $_GET['hsid'];
$ComicID = $_SESSION['sessionproject'];
$AsterickCoords = $_GET['as'];

if ($Action == 'new') {
$query = "INSERT into pf_hotspots (ComicID, PageID, AsterickCoords, HotSpotCoords,  CreatedBy) values ('$ComicID','$PageID','$AsterickCoords','$MapCoords','$UserID') ";
$InitDB->execute($query);
$output .=$query."\n\r\n\r";
$query = "SELECT ID from pf_hotspots where ComicID='$ComicID' and PageID='$PageID' and  AsterickCoords='$AsterickCoords'";
$output .=$query."\n\r\n\r";
$NewID = $InitDB->queryUniqueValue($query);
$HotSpotID = substr(md5($NewID), 0, 15).dechex($NewID);
$Encryptid = $HotSpotID; 
$IdClear = 0;
$Inc = 5;
while ($IdClear == 0) {
		$query = "SELECT count(*) from pf_hotspots where EncryptID='$Encryptid'";
		$Found = $InitDB->queryUniqueValue($query);
		$output .= $query.'<br/>';
		if ($Found == 1) {
			$Encryptid = substr(md5(($NewID+$Inc)), 0, 15).dechex($NewID+$Inc);
		} else {
			$query = "UPDATE pf_hotspots SET EncryptID='$Encryptid' WHERE ID='$NewID'";
			$InitDB->execute($query);
			$output .= $query.'<br/>';
			$IdClear = 1;
							
		}
		$Inc++;
}

$output .=$query."\n\r\n\r";
?>

<?
} 

if ($Action == 'delete') {
$query = "DELETE from pf_hotspots where EncryptID='$HotSpotID' and ComicID='$ComicID'";
$InitDB->execute($query);
$output .=$query."\n\r\n\r";
} 
			
?>
document.getElementById("newhotspot").value = '<? echo $HotSpotID;?>';
document.location = '/cms/hotspots/<? echo $_SESSION['safefolder'];?>/?page=<? echo $PageID;?>';