<? 

//BUILD RIGHT COLUMN
$RightColumnString = '';
if ($ModuleSeparation == 1) {
	$RightColumnString = '<table cellpadding="0" cellspacing="0" border="0" id="rightcolumn"><tr><td width="'.$RightColumnWidth.'" valign="top">';
} else {
	$RightColumnString .= '<table cellpadding="0" cellspacing="0" border="0" id="rightcolumn"><tr><td width="'.$RightColumnWidth.'" valign="top"><table width="'.$RightColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="modtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($RightColumnWidth-($CornerWidth*2)).'" valign="top">';
}
foreach ($RightColumModuleOrder as $module) {
	if ((is_authed()) && ($module == 'logform'))  
		$Skip = 1;
	 else  
		$Skip = 0;
		
	if (($AuthComment==0) && (($module == 'authcom') || ($module == 'authorcomment'))) 
			$Skip = 1;
	else  
			$Skip = 0;
			
	if (($MenuOneLayout != 'right') && ($module == 'menuone')) 
			$Skip = 1;
	
	if (($MenuTwoLayout != 'right') && ($module == 'menutwo')) 
			$Skip = 1;
				
	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
	if ($HeaderPlacement == 'outside') {
			$RightColumnString .=setheader($module);		
		}
		$RightColumnString.= '<table width="'.$RightColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($RightColumnWidth-($CornerWidth*2)).'" valign="top">';
	}
	if ($HeaderPlacement == 'inside') {
			$RightColumnString .= setheader($module);		
	}
	if ($ModuleSeparation == 0) 
		$RightColumnString.= "<div class='spacer'></div>";
	$RightColumnString.= setmodulehtml($module,'right');
	if ($ModuleSeparation == 0) 
		$RightColumnString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$RightColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';
	} 
}
}

if ($InsertAdThree == 1) {
	$RightColumnString.='<div class="spacer"></div><div align=\'center\'>'.$PositionThreeAdCode.'</div>';
}


if ($ModuleSeparation == 1) {
	$RightColumnString .= '</td></tr></table><div class="endofleft"></div>';
} else {
	$RightColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id=project"modbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table></td>
</tr></table><div class="endofright"></div>';
}

 ?>