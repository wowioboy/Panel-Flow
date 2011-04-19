<? 
//BUILD LEFT COLUMN
$ReaderPageModuleString = '';
$ReaderPageModuleWidth = $Width;
$ReaderPageModuleArray = array('authcom','logform','comform','pagecom');
if ($ModuleSeparation == 1) {
	$ReaderPageModuleString = '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$ReaderPageModuleWidth.'" valign="top">';
} else {
	$ReaderPageModuleString .= '<table cellpadding="0" cellspacing="0" border="0" id="leftcolumn"><tr><td width="'.$ReaderPageModuleWidth.'" valign="top"><table width="'.$ReaderPageModuleWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.($ReaderPageModuleWidth-($CornerWidth*2)).'" valign="top">';
}

foreach ($ReaderPageModuleArray as $module) {
$Skip = 0;

	if ((is_authed()) && ($module == 'logform')) 
			$Skip = 1;
	
	
	//print 'AuthComment = ' . $AuthComment.'<br/>';
	if (($module == 'authcom') && ($AuthorComment == 0)) 
			$Skip = 1;
	
	//if (($MenuOneLayout != 'left') && ($module == 'menuone')) 
			//$Skip = 1;
	
	//if (($MenuTwoLayout != 'left') && ($module == 'menutwo')) 
		//	$Skip = 1;
	

	if ($Skip == 0) {
	if ($ModuleSeparation == 1) {
		if ($HeaderPlacement == 'outside') {
			$ReaderPageModuleString .=setheader($module);		
		}
		$ReaderPageModuleString.= '<table width="'.$ReaderPageModuleWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.($ReaderPageModuleWidth-($CornerWidth*2)).'" valign="top">';
	}
	if ($HeaderPlacement == 'inside') 
			$ReaderPageModuleString .= setheader($module);		 
	if ($ModuleSeparation == 0) 
		$ReaderPageModuleString.= "<div class='spacer'></div>";
	$ReaderPageModuleString.= setmodulehtml($module,'left');
	
	if ($ModuleSeparation == 0) 
		$ReaderPageModuleString.= "<div class='spacer'></div>";
	
	if ($ModuleSeparation == 1) {
		$ReaderPageModuleString.= '</td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table>';
	} 
}
//print $ReaderPageModuleString.'<br/>';
}

if ($ModuleSeparation == 1) {
	$ReaderPageModuleString .= '</td></tr></table><div class="endofleft"></div>';
} else {
	$ReaderPageModuleString.= '</td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table></td>
</tr></table><div class="endofleft"></div>';
}
 ?>