<? 

if (($_GET['section'] == 'characters') && ($IsPro == 1)) {
$ComicXML = '';
if ($ContentType != 'story')
	$query = "SELECT * from characters where ComicID ='$ComicID'";
else
	$query = "SELECT * from characters where StoryID ='$StoryID'";
$comicsDB->query($query);

   	$ComicXML ='<characters>';
	  while ($line = $comicsDB->fetchNextObject()) {  
	  	$ComicXML .= '<character>';
	  	$ComicXML .= '<id>'.$line->EncryptID.'</id>';
		$ComicXML .= '<name>'.addslashes($line->Name).'</name>';
		$ComicXML .= '<age>'.$line->Age.'</age>';
		$ComicXML .= '<town>'.addslashes($line->Hometown).'</town>';
		$ComicXML .= '<feet>'.addslashes($line->HeightFt).'</feet>';
		$ComicXML .= '<inches>'.addslashes($line->HeightIn).'</inches>';
		$ComicXML .= '<race>'.addslashes($line->Race).'</race>';
		$Ability = str_replace(chr(13), '\n', $line->Abilities);
		$Ability = str_replace('"', "'", $Ability);
		$Ability = str_replace(chr(10), '\n', $Ability);
		$ComicXML .= '<ability>'.addslashes($Ability).'</ability>';
		
		$Description = str_replace(chr(13), '\n', $line->Description);
		$Description = str_replace(chr(10), '\n', $Description);
		$Description = str_replace('"', "'", $Description);
		$ComicXML .= '<description>'.addslashes($Description).'</description>';
		
		$Notes = str_replace(chr(13), '\n', $line->Notes);
		$Notes = str_replace(chr(10), '\n', $Notes);
		$Notes = str_replace('"', "'", $Notes);
		$ComicXML .= '<notes>'.addslashes($Notes).'</notes>';
		$ComicXML .= '<image>'.$line->Image.'</image>';
		$ComicXML .= '<thumb>'.$line->Thumb.'</thumb>';
		$ComicXML .= '</character>';
	}
	$ComicXML .='</characters>';

}
?>