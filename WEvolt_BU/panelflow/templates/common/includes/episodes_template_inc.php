<? 

if ($Section == 'Episodes')  { 
		$EpisodesTemplateString = '<table width="'.$GlobalSiteWidth.'" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>'.
						'<td id="projectmodtopleft">'.
						'</td>'.
						'<td id="projectmodtop"></td>'.
						'<td id="projectmodtopright"></td>'.
						'</tr>'.
						'<tr><td id="projectmodleftside"></td>'.
						'<td class="projectboxcontent" width="'.($GlobalSiteWidth-($CornerWidth*2)).'" valign="top">'.
						'<div class="modheader">Episodes</div><div class="spacer"></div>'.
						$episodeselectString. 
						$episodeString.
						'</td>'.
						'<td id="projectmodrightside"></td></tr>'.
						'<tr>'.
						'<td id="projectmodbottomleft"></td>'.
						'<td id="projectmodbottom"></td>'.
						'<td id="projectmodbottomright"></td>'.
						'</tr>'.
						'</table>'; 
						
		if ($HeaderPlacement == 'outside') 
			$CModuleString .=setheader('comicinfo');		
			
		$CModuleString.= '<table width="';
		
		if ($TEMPLATE == 'TPL-002')
			$MWidth = $RightColumnWidth;
		else if ($TEMPLATE == 'TPL-003')
			$MWidth = $LeftColumnWidth;
		
		$CModuleString.= $MWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($MWidth-($CornerWidth*2)).'" valign="top">';
	
	if ($HeaderPlacement == 'inside')
			$CModuleString.= setheader('comicinfo');		 

	$CModuleString.= setmodulehtml('comicinfo');
	
		$CModuleString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';

	
}

 ?>