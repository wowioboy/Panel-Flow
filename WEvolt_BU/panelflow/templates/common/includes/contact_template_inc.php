<? 

if ($Section == 'Contact')  { 

if (!isset($_GET['c'])) {
	$ArrayTarget = $MainCreator;
} else if ($_GET['c'] == 1) {
	$ArrayTarget = $CreatorArray1;

} else if ($_GET['c'] == 2) {
	$ArrayTarget = $CreatorArray2;

} else if ($_GET['c'] == 3) {
	$ArrayTarget = $CreatorArray3;

}
		$ContactTemplateString = '<table width="'.$GlobalSiteWidth.'" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>'.
						'<td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.($GlobalSiteWidth-($CornerWidth*2)).'" valign="top" align=\'center\'>						<table><tr><td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  						'<tr>'.
    					'<td width="205" valign="top" id="profileinfo">'.
						'<div class="modheader" align="left" style="font-size:12px;">'.$ArrayTarget['Creator'].'</div>'.
						'<div class="spacer"></div>';
						if ($ArrayTarget['Location'] != '') {
						$ContactTemplateString .='<div class="locationwrapper">'.
												'<div class="boxcontent"><b>LOCATION</b>: </div> '.
												'<div class="boxcontent">'.$ArrayTarget['Location'].'</div>'.
												'</div>';
						}
						
						$ContactTemplateString .='</td>'.
												'<td height="115" width="115" valign="top">';
						if ($ArrayTarget['Avatar'] != '') { 
							$ContactTemplateString .='<div align="center"><img src="'.$ArrayTarget['Avatar'].'"  border="1" width="100"'. 
												'height="100"/></div>';
 						} 
						$ContactTemplateString .='</td></tr></table>';
						if ($ArrayTarget['Website'] != '') { 
							$ContactTemplateString .='<div class="boxcontent"><b>Website:</b><br/>'.$ArrayTarget['Website'].'<br/><br/></div>';
						}
						if ($ArrayTarget['About'] != '') { 
							$ContactTemplateString .='<div class="boxcontent"><b>About: </b><br/>'.$ArrayTarget['About'].'</div>';
						}
						$ContactTemplateString .='</td><td valign="top">
						<div id="contact_form">You need to Upgrade/install flash or turn on your browser\'s javascript</div></td></tr></table>
				  </td>'.
						'<td id="modrightside"></td></tr>'.
						'<tr>'.
						'<td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr>'.
						'</table>'; 
}

 ?>