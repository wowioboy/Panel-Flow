<? 

if ($Section == 'Creator') {
$MainCreatorProfileString = '';
$MainCreatorProfileString .='<span id="STARTOFCREATORSTRING"></span><div class="spacer"></div>'.
						'<div class="contentwrapper" align="center">'.
						'<table cellpadding="0" cellspacing="0" border="0">'.
						'<tr>'.
						'<td valign="top">'.
						'<div class="leftwrapper">'.
						$CreatorSelectTable.'
						<table width="800" cellpadding="0" cellspacing="0" border="0">'.
						'<tr>'.
						'<td valign="top">';
						
						include 'creator_profile_left_inc.php';
							$MainCreatorProfileString .='</td>'.
							'<td width="367" valign="top">';
							include 'creator_profile_right_inc.php';			
							$MainCreatorProfileString .='</td></tr></table>
				
				
				</div></td></tr></table></div><span id="ENDOFCREATORSTRING"></span>';
				
				if ($HeaderPlacement == 'outside') 
			$ACModuleString .=setheader('authcom');		
			
		$ACModuleString.= '<table width="';
		
		if ($TEMPLATE == 'TPL-002')
			$MWidth = $RightColumnWidth;
		else if ($TEMPLATE == 'TPL-003')
			$MWidth = $LeftColumnWidth;
		
		$ACModuleString.= $MWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.($MWidth-($CornerWidth*2)).'" valign="top">';
	
	if ($HeaderPlacement == 'inside')
			$ACModuleString.= setheader('authcom');		 

	$ACModuleString.= setmodulehtml('authcom');
	
		$ACModuleString.= '</td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table>';
				
				
				
				
}

 ?>