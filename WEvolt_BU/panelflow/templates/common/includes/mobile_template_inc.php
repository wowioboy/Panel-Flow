<? 

if ($Section == 'Mobile')  { 
		$mobileMenuString = '';
		$mobileMenuString .= '<div align="left"><table cellpadding="0" cellspacing="0" border="0">'. 
							'<tr>';
	if ($Wallpapers > 0) {
		$mobileMenuString .= '<td class="tabactive" align="left" id=\'wallpaperstab\' '.
								'onMouseOver="rolloveractive(\'wallpaperstab\',\'wallpapersdiv\')" '.
								'onMouseOut="rolloverinactive(\'wallpaperstab\',\'wallpapersdiv\')"'.
								'onclick="wallpaperstab();">WALLPAPERS</td><td width="5"></td>';
	}
	if ($Ringtones >0) {
		$mobileMenuString .= '<td class="';
		if ($Ringtones == 0) 
			$mobileMenuString .= 'tabactive';
		else 
			$mobileMenuString .= 'tabinactive';
		$mobileMenuString .= '" align="left" id=\'tonestab\' '.
								'onMouseOver="rolloveractive(\'tonestab\',\'tonesdiv\')" '.
								'onMouseOut="rolloverinactive(\'tonestab\',\'tonesdiv\')"'.
								'onclick="tonestab();">RINGTONES</td><td width="5"></td>';
	}

							
	$mobileMenuString .= '</tr></table></div>';
	$MobileString .= '<table width="800" border="0" cellspacing="0" cellpadding="0">'.
						'<tr><td colspan="3">'.$mobileMenuString.'</td></tr>'.
						'<tr>'.
						'<td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(800-($CornerWidth*2)).'" valign="top">'.
						'<div id="wallpapersdiv" ';
	if ($Wallpapers == 0) 
		$MobileString .= 'style="display:none;"';
	$MobileString .= '>'.$WallpapersString.'</div>'.
						'<div id="tonesdiv" ';
	if ($Wallpapers > 0)  
		$MobileString .= 'style="display:none;"';
	$MobileString .= '>'.$TonesString.'</div>'.
						'</td>'.
						'<td id="modrightside"></td></tr>'.
						'<tr>'.
						'<td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr>'.
						'</table></div>'; 
}

 ?>