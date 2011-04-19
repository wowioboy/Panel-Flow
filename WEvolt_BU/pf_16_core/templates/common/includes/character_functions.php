<? 
$chardb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from characters where ComicID = '$ComicID'";
$chardb->query($query);
$CharacterXML = "<characters>";
while ($character = $chardb->fetchNextObject()) { 
$CharacterXML .="<character>";
$CharacterXML .="<id>".$character->ID."</id>";
$CharacterXML .="<name>".$character->Name."</name>";
$CharacterXML .="<thumb>".$character->Thumb."</thumb>";
$CharacterXML .="</character>";
}
$CharacterXML .= "</characters>";

if (isset($_GET['id'])) {
$CharID = $_GET['id'];
$query = "select * from characters where ComicID = '$ComicID' and ID='$CharID'";
$CharacterArray = $chardb->queryUniqueObject($query);
			$CharName = stripslashes($CharacterArray->Name);
			$Title = ' Characters | '.$CharName;
			$CharAge = $CharacterArray->Age;
			$CharTown = stripslashes($CharacterArray->Hometown);
			$CharRace = stripslashes($CharacterArray->Race);
			$CharHeight = $CharacterArray->HeightFt."' ".$CharacterArray->HeightIn."''";
			$CharWeight = $CharacterArray->Weight;
			$CharAbility = stripslashes($CharacterArray->Abilities);
			$CharDesc = stripslashes($CharacterArray->Description);
			$CharNotes = stripslashes($CharacterArray->Notes);
			$CharImage = $CharacterArray->Image;

}
$chardb->close();
?>