<? 

$query = "select * from characters where ComicID = '$ComicID'";
$InitDB->query($query);
$CharCount = 0;

$CharacterXML = "<characters>";
$CharacterListString = "<table width ='600' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$CharacterModalString = '<div id="characterModal" style="display:none;">
    <div class="modalBackground">
    </div>
    <div class="characterContainer"> 
        <div class="modalcharacter">
            <div class="characterTop"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="left"><b>CHARACTER - <span id="charactername"></span></b></td><td align="right" width="100"><span id="closelink"><a href="javascript:hideModal(\'characterModal\')">[close window]</a></span></td></tr></table></div>
            <div class="characterBody">
           		<div align="center">';

while ($character = $InitDB->fetchNextObject()) { 
//$DLDescription = stripslashes($download->Description);
$TCharName = stripslashes($character->Name);
$TCharAge =$character->Age;
$TCharTown = stripslashes($character->Hometown);
$TCharRace = stripslashes($character->Race);

if (($character->HeightFt == 0) && ($character->HeightIn == 0))
	$TCharHeight = '';
else 
	$TCharHeight = $character->HeightFt."' ".$character->HeightIn."''";
$TCharWeight = $character->Weight;
$TCharAbility = stripslashes($character->Abilities);
$TCharDesc = stripslashes($character->Description);
$TCharNotes = stripslashes($character->Notes);
$TCharImage = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/';
$TCharImage .= $character->Image;

$CharacterModalString .='<div class="spacer"></div>'.
	'<div id="character_'.$character->ID.'" align="center" style="display:none;">'.
	'<table width="'.$GlobalSiteWidth.'">'.
	'<tr>'.
	'<td width="325" valign="top">';
	if (isset($TCharImage)) {
	$CharacterModalString .='<div class="charimage" align="center"><img src="'.$TCharImage.'" border ="2"/></div>';
	} 
	$CharacterModalString .='</td>'.			
	'<td width="15">&nbsp;</td>'.	
	'<td valign="top">';
	$CharacterModalString .=
	'<div class="modheader">CHARACTER STATS</div>'.
	 '<div class="comiccredits"><div class="halfspacer"></div>'.
	'<table  border="0" cellspacing="0" cellpadding="0">';
 	
	 if (($TCharName != '')&& ($TCharName != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>NAME: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharName.'</div></td>'.
    						'</tr>';
 		} 
	if (($TCharDesc != '') && ($TCharDesc != 'NA')) {

		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>ABOUT:</b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharDesc.'</div></td>'.
    						'</tr>';
 		} 
	if (($TCharTown != '')&& ($TCharTown != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>HOMETOWN:</b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharTown.'</div></td>'.
    						'</tr>';
 		} 
	if (($TCharRace != '')&& ($TCharRace != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>RACE:</b> </div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharRace.'</div></td>'.
    						'</tr>';
 		} 
	if (($TCharAge != '') && ($TCharAge != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>AGE: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharAge.'</div></td>'.
    						'</tr>';
 		}
	if (($TCharHeight != '')&& ($TCharHeight != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>HEIGHT: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharHeight.'</div></td>'.
    						'</tr>';
 		}
	if (($TCharWeight != '')&& ($TCharWeight != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>WEIGHT: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharWeight.'</div></td>'.
    						'</tr>';
 		}
	if (($TCharAbility != '')&& ($TCharAbility != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>ABILITIES: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharAbility.'</div></td>'.
    						'</tr>';
 		}
		if (($TCharNotes != '')&& ($TCharNotes != 'NA')) {
		$CharacterModalString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="boxcontent"><b>OTHER NOTES: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="boxcontent">'.$TCharNotes.'</div></td>'.
    						'</tr>';
 		}	


	$CharacterModalString .='</table></div></div>';
						


$CharacterModalString .='</td></tr></table></div>';	

	$CharacterListString .= "<td width='180' style='padding-left:5px; padding-right:5px;'><div style='background-color:#".$GlobalHeaderBGColor.";color:#".$GlobalHeaderTextColor.";font-size:".$ContentBoxFontSize."px;'>".$character->Name."</div><div align='center' style='background-color:#000000;'>";
	if ($CharacterReader == 'html_one') {
			$CharacterListString .= "<a href=\"#character_".$character->ID."\" rel=\"facebox\" >";
	} else if ($CharacterReader == 'html_two') {
		$CharacterListString .= "<a href='/".$SafeFolder."/characters/?id=".$character->ID."'>";
	}
	
	

	
	
	//<a href='/".$ComicFolder."/characters/?id=".$character->ID."'>
	$CharacterListString .= "<img src='http://www.panelflow.com/comics/";
	
			$CharacterListString .= $ComicDir.'/'.$SafeFolder.'/';

		$CharacterListString .=  $character->Thumb."'  border='1' style='border-color:#000000;' hspace='4' vspace='4'></a></div></td>";
	$CharCount++;
	if ($CharCount == 5){
 			$CharacterListString .= "</tr><tr><td colspan='5'>&nbsp;</td></tr><tr>";
 			$CharCount = 0;
 	}
	



 
$CharacterXML .="<character>";
$CharacterXML .="<id>".$character->ID."</id>";
$CharacterXML .="<name>".$character->Name."</name>";
$CharacterXML .="<thumb>http://www.panelflow.com/";
//if (($ComicFolder != '') && ($ComicFolder != '/')) 
	$CharacterXML .= $SafeFolder.'/'; 
 
$CharacterXML .= $character->Thumb."</thumb>";
$CharacterXML .="</character>";
}
$CharacterXML .= "</characters>";
if 	($CharCount < 5){
		while($CharCount <5) {
			$CharacterListString .= "<td></td>";
			$CharCount++;
		}
	}
	 $CharacterListString .= "</tr></table>";
	$CharacterModalString .= '</div></div></div></div></div>';
if (isset($_GET['id'])) {
$CharID = $_GET['id'];
$query = "select * from characters where ComicID = '$ComicID' and ID='$CharID'";
$CharacterArray = $InitDB->queryUniqueObject($query);
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
			$CharImage = 'http://www.panelflow.com/comics/';
			//if (($ComicFolder != '') && ($ComicFolder != '/')) 
			$CharImage .= $ComicDir.'/'.$SafeFolder.'/';
			$CharImage .= $CharacterArray->Image;

}

?>