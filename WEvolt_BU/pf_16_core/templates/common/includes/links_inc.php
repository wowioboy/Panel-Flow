<?php
$linksdb = new DB($db_database,$db_host, $db_user, $db_pass);
 $query = "select * from links where ComicID = '$ComicID'";
$linksdb->query($query);
while ($link = $linksdb->fetchNextObject()) { 
	$linkstring .= "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr>
    <td valign='middle'></td>
    <td width='50%' valign='top' class='rectitle'><a href='".$link->Link."' target='blank'>".$link->Title."</a></td><td width='49%' valign='top' class='recdescription'>".$link->Description."</td>
  </tr></table><div class='spacer'></div>";
}
 $linksdb->close();
?>