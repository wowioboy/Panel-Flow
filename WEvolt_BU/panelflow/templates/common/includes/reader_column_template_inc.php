<? 
//BUILD LEFT COLUMN
$ReaderColumnString = '';

if ($ModuleSeparation == 1) {
	$ReaderColumnString = '<table cellpadding="0" cellspacing="0" border="0" id="readercolumn"><tr><td width="'.$ReaderColumnWidth.'" valign="top">';
} else {
	$ReaderColumnString .= '<table cellpadding="0" cellspacing="0" border="0" id="readercolumn"><tr><td width="'.$ReaderColumnWidth.'" valign="top"><table width="'.$ReaderColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($ReaderColumnWidth-($CornerWidth*2)).'" valign="top">';
}

foreach ($ReaderModuleOrder as $module) {
	if ((is_authed()) && ($module == 'logform')) 
			$Skip = 1;
	else  
			$Skip = 0;
	
	if (($MenuOneLayout != 'left') && ($module == 'menuone')) 
			$Skip = 1;
	
	if (($MenuTwoLayout != 'left') && ($module == 'menutwo')) 
			$Skip = 1;
	if (($AuthComment==0) && (($module == 'authcomm') || ($module == 'authorcomment'))) 
			$Skip = 1;
	else  
			$Skip = 0;
	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
		if ($HeaderPlacement == 'outside') {
			$ReaderColumnString .=setheader($module);		
		}
		$ReaderColumnString.= '<table width="'.$ReaderColumnWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="projectmodtop"></td><td id="projectmodtopright"></td></tr><tr><td id="projectmodleftside"></td><td class="projectboxcontent" width="'.($ReaderColumnWidth-($CornerWidth*2)).'" valign="top">';
	}
	if ($HeaderPlacement == 'inside') 
			$ReaderColumnString .= setheader($module);		 
	if ($ModuleSeparation == 0) 
		$ReaderColumnString.= "<div class='spacer'></div>";
	$ReaderColumnString.= setmodulehtml($module,'left');
	
	if ($ModuleSeparation == 0) 
		$ReaderColumnString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$ReaderColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';
	} 
}
}

if ($ModuleSeparation == 1) {
	$ReaderColumnString .= '</td></tr></table><div class="end"></div>';
} else {
	$ReaderColumnString.= '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table></td>
</tr></table><div class="end"></div>';
}
 ?>