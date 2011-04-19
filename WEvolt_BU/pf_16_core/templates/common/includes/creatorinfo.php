<?php
  $creatorarray = array();
  $c_elem = null;
  
  function startElement3( $parser, $name, $attrs ) 
  {
  global $creatorarray, $c_elem;
  if ( $name == 'CREATOR' )$creatorarray []= array();
  $c_elem = $name;
  }
  
  function endElement3( $parser, $name ) 
  {
  global $c_elem;
  $c_elem = null;
  }
  
  function textData3( $parser, $text )
  {
  global $creatorarray, $c_elem;
  if ( $c_elem == 'MYFAVS' ||
  $c_elem == 'BIO' ||
  $c_elem == 'LOCATION' ||
  $c_elem == 'CREATORNAME' ||
  $c_elem == 'WEBSITE' ||
  $c_elem == 'LINK1' ||
  $c_elem == 'LINK2' ||
  $c_elem == 'LINK3' ||
  $c_elem == 'LINK4' ||
  $c_elem == 'HOBBIES'||
  $c_elem == 'CREDITS'||
  $c_elem == 'MUSIC'||
  $c_elem == 'BOOKS'||
  $c_elem == 'ALLOWCOMMENTS'||
  $c_elem == 'SYNCINFO'||
  $c_elem == 'AVATAR')
  {$creatorarray[ count($creatorarray ) - 1 ][ $c_elem ] = $text;
  }
  }
  
  $parser = xml_parser_create();
  
  xml_set_element_handler( $parser, "startElement3", "endElement3" );
  xml_set_character_data_handler( $parser, "textData3" );
  
  $f = fopen( 'xml/creatorXML.xml', 'r' );
  
  while( $data = fread( $f, 4096 ) )
  {
  xml_parse( $parser, $data );
  }
  
  xml_parser_free( $parser );
  
  foreach($creatorarray as $creatoritem )
  {
  if ($creatoritem['MYFAVS'] != ""){
  $CreatorInfluence = $creatoritem['MYFAVS'];
 
  }
  
  if ($creatoritem['CREATORNAME'] != ""){
  $CreatorName = $creatoritem['CREATORNAME'];
  }
  
  if ($creatoritem['CREDITS'] != ""){
  $OtherCredits = $creatoritem['CREDITS'];
  }
  
  if ($creatoritem['MUSIC'] != ""){
  $Music = $creatoritem['MUSIC'];
  }
  
  if ($creatoritem['BOOKS'] != ""){
  $Books = $creatoritem['BOOKS'];
  }
  
   if ($creatoritem['BIO'] != ""){
  $Bio = htmlspecialchars($creatoritem['BIO']);
  }
  
  if ($creatoritem['WEBSITE'] != ""){
  $Website = $creatoritem['WEBSITE'];
  }
  
  if ($creatoritem['LINK1'] != ""){
  $Link1 = $creatoritem['LINK1'];
  }
  
  if ($creatoritem['LINK2'] != ""){
  $Link2 = $creatoritem['LINK2'];
  }
  
  if ($creatoritem['LINK3'] != ""){
  $Link3 = $creatoritem['LINK3'];
  }
  
  if ($creatoritem['LINK4'] != ""){
  $Link4 = $creatoritem['LINK4'];
  }
  
   if ($creatoritem['LOCATION'] != ""){
  $Location = htmlspecialchars($creatoritem['LOCATION']);
  }
  if ($creatoritem['HOBBIES'] != ""){
  $Hobbies = $creatoritem['HOBBIES'];
  }
  if ($creatoritem['ALLOWCOMMENTS'] != ""){
 	 $AllowComments = $creatoritem['ALLOWCOMMENTS'];
  }
  if ($creatoritem['SYNCINFO'] != ""){
 	 $Sync= $creatoritem['SYNCINFO'];
  }
   if ($creatoritem['AVATAR'] != ""){
 	 $CreatorAvatar= $creatoritem['AVATAR'];
  }
  }
  
function GetAvatar($ID) {
$querystring ='http://www.panelflow.com/processing/pfusers.php?action=get&item=avatar&id='.urlencode($ID);
$commentresult = file_get_contents ($querystring);
return trim($commentresult);
}
?>