 <?php
  $comic = array();
  $g_elem = null;
  
  function startElement( $parser, $name, $attrs ) 
  {
  global $comic, $g_elem;
  if ( $name == 'COMIC' )$comic []= array();
  $g_elem = $name;
  }
  
  function endElement( $parser, $name ) 
  {
  global $g_elem;
  $g_elem = null;
  }
  
  function textData( $parser, $text )
  {
  global $comic, $g_elem;
  if ( $g_elem == 'TITLE' ||
  $g_elem == 'CREATOR' ||
  $g_elem == 'WRITER' ||
  $g_elem == 'ARTIST'||
  $g_elem == 'COLORIST'||
  $g_elem == 'LETTERIST'||
  $g_elem == 'SYNOPSIS'||
  $g_elem == 'TEXTCOLOR' ||
  $g_elem == 'MOVIECOLOR' ||
  $g_elem == 'BARCOLOR' ||
  $g_elem == 'BUTTONCOLOR' ||
  $g_elem == 'ARROWCOLOR' ||
  $g_elem == 'TAGS' ||
  $g_elem == 'GENRE'||
  $g_elem == 'COPYRIGHT'||
  $g_elem == 'HEADERIMAGE')

  {$comic[ count($comic ) - 1 ][ $g_elem ] = $text;

  }
  }
  
  $parser = xml_parser_create();
  
  xml_set_element_handler( $parser, "startElement", "endElement" );
  xml_set_character_data_handler( $parser, "textData" );
  
  $f = fopen( '../xml/infoXML.xml', 'r' );
  
  while( $data = fread( $f, 4096 ) )
  {
 //print $data;
  // $data = htmlspecialchars($data);
  //echo "<br><br>";
  // print html_entity_decode(htmlentities($data));
	
  xml_parse( $parser, $data );
  }
  
  xml_parser_free( $parser );
  
  foreach($comic as $book )
  {
  if ($book['TITLE'] != ""){
  //$String = html_entity_decode($book['TITLE']);
  // print "MY COMIC TITLE 1= " .$String."<br>";
  //$ComicTitle = str_replace('$amp;', '&', $String);
 $ComicTitle = $book['TITLE'];
//  print "MY COMIC TITLE = " . $ComicTitle;
  }
   if ($book['CREATOR'] != ""){
  $Creator = htmlspecialchars($book['CREATOR']);
  }
   if ($book['WRITER'] != ""){
  $Writer = htmlspecialchars($book['WRITER']);
  }
  if ($book['ARTIST'] != ""){
  $Artist = $book['ARTIST'];
  }
  if ($book['COLORIST'] != ""){
  $Colorist = $book['COLORIST'];
  }
  if ($book['LETTERIST'] != ""){
  $Letterist = $book['LETTERIST'];
  }
  if ($book['SYNOPSIS'] != ""){
  $Synopsis = $book['SYNOPSIS'];
  }
  if ($book['TEXTCOLOR'] != ""){
  $TextColor = $book['TEXTCOLOR'];
  }
  if ($book['MOVIECOLOR'] != ""){
   $MovieColor = $book['MOVIECOLOR'];
  }
  if ($book['BARCOLOR'] != ""){
   $BarColor = $book['BARCOLOR'];
  }
  if ($book['BUTTONCOLOR'] != ""){
   $ButtonColor = $book['BUTTONCOLOR'];
  }
   if ($book['ARROWCOLOR'] != ""){
   $ArrowColor = $book['ARROWCOLOR'];
  }
  if ($book['TAGS'] != ""){
   $Tags = $book['TAGS'];
  }
  if ($book['GENRE'] != ""){
     $Genre = $book['GENRE'];
  }
    if ($book['COPYRIGHT'] != ""){
     $Copyright = $book['COPYRIGHT'];
  }
   if ($book['HEADERIMAGE'] != ""){
     $HeaderImage = $book['HEADERIMAGE'];
  }
  }

  ?>