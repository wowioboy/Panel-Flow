<? 

if ($Section == 'Characters') {

if ($CharacterReader == 'flash_one') {

$CharactersPlayerString ='<div id="characters">To listen this track, you will need to have Javascript turned on and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 8</a> or better installed.</div>';
} else if (($CharacterReader == 'html_one')|| ($CharacterReader == 'html_two')){

$CharactersPlayerString = '<table width="800" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>'.
						'<td id="projectmodtopleft">'.
						'</td>'.
						'<td id="projectmodtop"></td>'.
						'<td id="projectmodtopright"></td>'.
						'</tr>'.
						'<tr><td id="projectmodleftside"></td>'.
						'<td class="projectboxcontent" width="'.(800-($CornerWidth*2)).'" valign="top">'.
						'<div class="modheader">Characters</div><div class="spacer"></div>'.
						$CharacterListString.
						'</td>'.
						'<td id="projectmodrightside"></td></tr>'.
						'<tr>'.
						'<td id="projectmodbottomleft"></td>'.
						'<td id="projectmodbottom"></td>'.
						'<td id="projectmodbottomright"></td>'.
						'</tr>'.
						'</table>'.$CharacterModalString ;


}

if ($CharacterReader == 'html_two'){
	$CharactersString .='<div class="spacer"></div>'.
	'<div class="contentwrapper" align="center">'.
	'<table width="800">'.
	'<tr>'.
	'<td width="325" valign="top">';
	if (isset($CharImage)) {
	$CharactersString .='<div class="charimage" align="center"><img src="http://www.panelflow.com/comics/'.$ComicDir.$CharImage.'" border ="2"/></div>';
	} 
	$CharactersString .='</td>'.			
	'<td width="15">&nbsp;</td>'.	
	'<td valign="top">';
    if (isset($_GET['id'])) {
	$CharactersString .=
	'<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
	'<tr>'.
	'<td id="projectmodtopleft">'.
	'</td>'.
	'<td id="projectmodtop"></td>'.
	'<td id="projectmodtopright"></td>'.
	'</tr>'.
	'<tr><td id="projectmodleftside"></td>'.
	'<td class="projectboxcontent" valign="top">'.
	 '<div class="modheader">CHARACTER STATS</div>'.
	 '<div class="comiccredits"><div class="halfspacer"></div>'.
	'<table  border="0" cellspacing="0" cellpadding="0">';
 	
	 if (($CharName != '')&& ($CharName != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>NAME: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharName.'</div></td>'.
    						'</tr>';
 		} 
	
	 if (($CharDesc != '')&& ($CharDesc != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABOUT:</b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharDesc.'</div></td>'.
    						'</tr>';
 		} 
	 if (($CharTown != '')&& ($CharTown != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HOMETOWN:</b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharTown.'</div></td>'.
    						'</tr>';
 		} 
	 if (($CharRace != '')&& ($CharRace != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>RACE:</b> </div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharRace.'</div></td>'.
    						'</tr>';
 		} 
	 if (($CharAge != '')&& ($CharAge != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>AGE: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharAge.'</div></td>'.
    						'</tr>';
 		}
	 if (($CharHeight != '')&& ($CharHeight != 'NA')&& ($CharHeight != '	
0\' 0\'\'')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>HEIGHT: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharHeight.'</div></td>'.
    						'</tr>';
 		}
	if (($CharWeight != '')&& ($CharWeight != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>WEIGHT: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharWeight.'</div></td>'.
    						'</tr>';
 		}
	if (($CharAbility != '')&& ($CharAbility != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>ABILITIES: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharAbility.'</div></td>'.
    						'</tr>';
 		}
			if (($CharNotes != '')&& ($CharNotes != 'NA')) {
		$CharactersString .='<tr>'.
						 	'<td width="87" align="right" valign="top"><div class="projectboxcontent"><b>OTHER NOTES: </b></div></td>'.
    						'<td width="10" valign="top">&nbsp;</td>'.
     						'<td width="203" valign="top"><div class="projectboxcontent">'.$CharNotes.'</div></td>'.
    						'</tr>';
 		}	


	$CharactersString .='</table></div></div>'.
						'</td>'.
						'<td id="projectmodrightside"></td></tr>'.
						'<tr>'.
						'<td id="projectmodbottomleft"></td>'.
						'<td id="projectmodbottom"></td>'.
						'<td id="projectmodbottomright"></td>'.
						'</tr>'.
						'</table>'; 

} 
$CharactersString .='</td></tr></table>';	
}

}

 ?>