<? 

$aboutDB = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT * from creators where ComicID ='$ComicID'";
$aboutDB->query($query);
	  while ($line = $aboutDB->fetchNextObject()) {  
		$Location = $line->location;
		$Website = $line->website;
		$Creator = stripslashes($line->realname);
		$Title = $Creator;
		$Link1 = $line->link1;
		$Link2 = $line->link2;
		$Link3 = $line->link3;
		$Link4 = $line->link4;
		$About = str_replace(chr(13), '\n', $line->about);
		$About = str_replace(chr(10), '\n', $About);
		$Music = str_replace(chr(13), '\n', $line->music);
		$Music = str_replace(chr(10), '\n', $Music);
		$Books = str_replace(chr(13), '\n', $line->books);
		$Books = str_replace(chr(10), '\n', $Books);
		$Influences = str_replace(chr(13), '\n', $line->influences);
		$CreatorInfluence = str_replace(chr(10), '\n', $Influences);
		$Other = str_replace(chr(13), '\n', $line->credits);
		$OtherCredits = str_replace(chr(10), '\n', $Other);
		$Hobbies = str_replace(chr(13), '\n', $line->hobbies);
		$Hobbies = str_replace(chr(10), '\n', $Hobbies);

	}
$aboutDB->close();
?>