<? 

if (($_GET['section'] == 'downloads') && ($IsPro == 1)) {
$ComicXML = '';
$query = "SELECT * from comic_downloads where ComicID ='$ComicID'";
$comicsDB->query($query);
   	$ComicXML ='<downloads>';
	  while ($line = $comicsDB->fetchNextObject()) {  
	  	$ComicXML .= '<item>';
	  	$ComicXML .= '<id>'.$line->EncryptID.'</id>';
		$ComicXML .= '<name>'.addslashes($line->Name).'</name>';
		$ComicXML .= '<dltype>'.$line->DlType.'</dltype>';
		$ComicXML .= '<resolution>'.$line->Resolution.'</resolution>';
		$ComicXML .= '<image>'.$line->Image.'</image>';
		$ComicXML .= '<thumb>'.$line->Thumb.'</thumb>';
		$Description = str_replace(chr(13), '\n', $line->Description);
		$Description = str_replace(chr(10), '\n', $Description);
		$ComicXML .= '<description>'.addslashes($Description).'</description>';
		$ComicXML .= '</item>';
	}
	$ComicXML .='</downloads>';

}
?>