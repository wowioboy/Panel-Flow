<? 
//BUILD LEFT COLUMN
$LeftColumnString = '';
if ($LeftColumnWidth == '')
	$LeftColumnWidth = '280';
if ($ModuleSeparation == 1) {
	$LeftColumnString = '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$LeftColumnWidth.'" valign="top">';
} else {
	$LeftColumnString .= '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$LeftColumnWidth.'" valign="top"><table width="'.$LeftColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($LeftColumnWidth-($CornerWidth*2)).'" valign="top">';
}

foreach ($LeftColumModuleOrder as $module) {
	if ((is_authed()) && ($module == 'logform')) 
			$Skip = 1;
	else  
			$Skip = 0;
			
	if (($AuthComment==0) && (($module == 'authcom') || ($module == 'authorcomment'))) 
			$Skip = 1;
	else  
			$Skip = 0;

	if (($MenuOneLayout != 'left') && ($module == 'menuone')) 
			$Skip = 1;
	
	if (($MenuTwoLayout != 'left') && ($module == 'menutwo')) 
			$Skip = 1;
	

	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
		if ($HeaderPlacement == 'outside') {
			$LeftColumnString .=setheader($module);		
		}
		$LeftColumnString.= '<table width="'.$LeftColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($LeftColumnWidth-($CornerWidth*2)).'" valign="top">';
	}

	if ($HeaderPlacement == 'inside') 
			$LeftColumnString .= setheader($module);		 
	if ($ModuleSeparation == 0) 
		$LeftColumnString.= "<div class='spacer'></div>";
	$LeftColumnString.= setmodulehtml($module,'left');
	
	if ($ModuleSeparation == 0) 
		$LeftColumnString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$LeftColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';
	} 
}
}
if ($ModuleSeparation == 1) {
	$LeftColumnString .= '</td></tr></table><div class="endofleft"></div>';
} else {
	$LeftColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table></td>
</tr></table><div class="endofleft"></div>';
}
 ?>