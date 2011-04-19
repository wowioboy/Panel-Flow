<?php 

function addfavorite($ComicID, $CreatorID, $UserID) {
$querystring ='https://www.panelflow.com/processing/pfusers.php?action=add&item=favorite&creatorid='.urlencode($CreatorID).'&comicid='.urlencode($ComicID).'&id='.urlencode($UserID);
//print $querystring;

$commentsresult = file_get_contents ($querystring);

}

function deletefavorite($ComicID, $FavID, $UserID) {
$querystring ='https://www.panelflow.com/processing/pfusers.php?action=delete&item=favorite&favid='.urlencode($FavID).'&comicid='.urlencode($ComicID).'&id='.urlencode($UserID);


$commentsresult = file_get_contents ($querystring);

}
?>