<? 
if ($_GET['section'] == 'info') {
$ComicXML = '';
$CheckDB = new DB($db_database,$db_host, $db_user, $db_pass);
if ($ContentType == 'story') {
$query = "SELECT * from stories where StoryID ='$StoryID'";
$comicsDB->query($query);

$query = "SELECT * from story_settings where StoryID ='$StoryID'";
$ComicSettingArray= $CheckDB->queryUniqueObject($query);

}else {

$query = "SELECT * from comics where comiccrypt ='$ComicID'";

$comicsDB->query($query);

$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
$ComicSettingArray= $CheckDB->queryUniqueObject($query);
 }  
   	$ComicXML ='<comic>';
	  while ($line = $comicsDB->fetchNextObject()) {  
	  	$ComicXML .= '<info>';
	  	$ComicXML .= '<title>'.addslashes($line->title).'</title>';
		$Creator = str_replace('"', "'", $line->creator);
		$ComicXML .= '<creator>'.addslashes($Creator).'</creator>';
		$Writer = str_replace('"', "'", $line->writer);
		$ComicXML .= '<writer>'.addslashes($Writer).'</writer>';
		$ComicXML .= '<artist>'.addslashes($line->artist).'</artist>';
		$ComicXML .= '<colorist>'.addslashes($line->colorist).'</colorist>';
		$Synopsis = str_replace(chr(13), '\n', $line->synopsis);
		$Synopsis = str_replace(chr(10), '\n', $Synopsis);
		$Synopsis = str_replace('"', "'", $Synopsis);
		$ComicXML .= '<synopsis>'.addslashes($Synopsis).'</synopsis>';
		$ComicXML .= '<letterist>'.addslashes($line->letterist).'</letterist>';
		$Tags = str_replace('"', "'", $line->tags);
		$ComicXML .= '<tags>'.addslashes($Tags).'</tags>';
		$ComicXML .= '<genre>'.addslashes($line->genre).'</genre>';
		$ComicXML .= '<headerimage>'.$ComicSettingArray->Header.'</headerimage>';
		$ComicXML .= '<copyright>'.addslashes($ComicSettingArray->Copyright).'</copyright>';
		$ComicXML .= '</info>';
	}
	$ComicXML .='</comic>';
	$CheckDB->close();
}
?>