<?php
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
$UserID = $_POST['u'];
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host']; 
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
//print $query."<br/>";
//print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>";
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $_POST['k'], 'l'=>$key);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/update_settings.php", $post_data);
	unset($post_data);
			if ($updateresult != 'Not Authorized') {
				$values = unserialize ($updateresult); 
				$Contact = $values['contact'];
				$Comments = $values['allowcomments'];
				$Archive = $values['archive'];
				$Chapter = $values['chapter']; 
				$Episode = $values['episode'];
				$Calendar = $values['calendar'];
				$BioSetting = $values['biosetting'];
				$Assistant1 = $values['assistant1'];
				$Assistant2 = $values['assistant2'];
				$Assistant3 = $values['assistant3'];
				$Template = $values['template']; 
				$PublicComments = $values['publiccomments'];
				$ShowSchedule = $values['ShowSchedule']; 
				$ReaderType = $values['readertype'];

				
				 $query = "SELECT Template from comic_settings where ComicID='$ComicID'";
				 $CurrentTemplate = $settings->queryUniqueValue($query);
				$query = "UPDATE comic_settings SET Contact='$Contact', AllowComments='$Comments', ShowArchive='$Archive', ShowChapter='$Chapter', ShowEpisode='$Episode', ShowCalendar='$Calendar',ShowSchedule='$ShowSchedule', BioSetting = '$BioSetting', Assistant1='$Assistant1', Assistant2='$Assistant2', Assistant3='$Assistant3', Template='$Template', ReaderType='$ReaderType', AllowPublicComents='$PublicComments' where ComicID='$ComicID'";
				$settings->query($query); 
				if ($CurrentTemplate != $Template) {
						$templatearray = array(); 
						$c_elem = null;
  
			function startElement3( $parser, $name, $attrs ) {
					global $templatearray, $c_elem;
  				if ( $name == 'INFORMATION' )$templatearray []= array();
  					$c_elem = $name;
 				 }
  
 		 	function endElement3( $parser, $name ){
 			 global $c_elem;
  			$c_elem = null;
 		 }
  
		function textData3( $parser, $text ){
  				global $templatearray, $c_elem;
				if ( $c_elem == 'CONTROLCOLOR' ||
						$c_elem == 'TITLECOLOR' ||
						$c_elem == 'BACKGROUNDCOLOR' ||
						$c_elem == 'BUTTONARROWCOLOR' ||
						$c_elem == 'ADPOSITIONS' ||
						$c_elem == 'BUTTONCOLOR') {
					$templatearray[ count($templatearray ) - 1 ][ $c_elem ] = $text;
 				 }
 		 }
  
		 $parser = xml_parser_create();
  
  		xml_set_element_handler( $parser, "startElement3", "endElement3" );
  		xml_set_character_data_handler( $parser, "textData3" );
  
  		$f = fopen('../templates/'.$Template.'/template.xml', 'r' );
  
		while( $data = fread( $f, 4096 ) ) {
  				xml_parse( $parser, $data );
 		 }
  
 		 xml_parser_free( $parser );
  
 		 foreach($templatearray as $templateitem ) {
  				$ControlColor = $templateitem['CONTROLCOLOR'];
  				$TitleColor = $templateitem['TITLECOLOR'];
  				$BackgroundColor = $templateitem['BACKGROUNDCOLOR'];
  				$ButtonArrowColor = $templateitem['BUTTONARROWCOLOR'];
  				$ButtonColor = $templateitem['BUTTONCOLOR'];
				$Adpositions = $templateitem['ADPOSITIONS'];
 		} 
 
		$query ="SELECT * from adspaces where ComicID='$ComicID' and Template='$Template'";
		$settings->query($query);
		$AdsFound = $settings->numRows();
		if ($AdsFound == 0) {
			$TemplateAds = explode(',',$Adpositions);
				foreach ($TemplateAds as $AdPosition) {
						 $query = "INSERT into adspaces (ComicID, Template, Position, Active) values ('$ComicID','$Template','$AdPosition',1)";
						$settings->query($query);
				}
			
		} 

 
	}
} else {
echo 'Not Authorized';

}
echo 'Updated';
}



?>