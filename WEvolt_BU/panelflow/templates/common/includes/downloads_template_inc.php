<? 

if ($Section == 'Downloads')  { 
		$DownloadMenuString = '';
		$DownloadMenuString .= '<div align="left"><table cellpadding="0" cellspacing="0" border="0">'. 
							'<tr>';
	if ($DesktopItems > 0) {
		$DownloadMenuString .= '<td class="tabactive" align="left" id=\'desktopstab\' '.
								'onMouseOver="rolloveractive(\'desktopstab\',\'desktopsdiv\')" '.
								'onMouseOut="rolloverinactive(\'desktopstab\',\'desktopsdiv\')"'.
								'onclick="desktopstab();">DESKTOPS</td><td width="5"></td>';
	}
	if ($CoverItems >0) {
		$DownloadMenuString .= '<td class="';
		if ($DesktopItems == 0) 
			$DownloadMenuString .= 'tabactive';
		else 
			$DownloadMenuString .= 'tabinactive';
		$DownloadMenuString .= '" align="left" id=\'coverstab\' '.
								'onMouseOver="rolloveractive(\'coverstab\',\'coversdiv\')" '.
								'onMouseOut="rolloverinactive(\'coverstab\',\'coversdiv\')"'.
								'onclick="coverstab();">COVERS</td><td width="5"></td>';
	}
	if ($AvatarItems >0) {
		$DownloadMenuString .= '<td class="';
		if (($DesktopItems == 0) &&  ($CoverItems == 0))
			$DownloadMenuString .= 'tabactive';
		else 
			$DownloadMenuString .= 'tabinactive';
		$DownloadMenuString .= '" align="left" id=\'avatarstab\' '.
								'onMouseOver="rolloveractive(\'avatarstab\',\'avatarsdiv\')" '.
								'onMouseOut="rolloverinactive(\'avatarstab\',\'avatarsdiv\')"'.
								'onclick="avatarstab();">AVATARS</td>';
	}
							
	$DownloadMenuString .= '</tr></table></div>';
	$DownloadsString .= '<table width="'.$GlobalSiteWidth.'" border="0" cellspacing="0" cellpadding="0">'.
						'<tr><td colspan="3">'.$DownloadMenuString.'</td></tr>'.
						'<tr>'.
						'<td id="projectmodtopleft">'.
						'</td>'.
						'<td id="projectmodtop"></td>'.
						'<td id="projectmodtopright"></td>'.
						'</tr>'.
						'<tr><td id="projectmodleftside"></td>'.
						'<td class="projectboxcontent" width="'.($GlobalSiteWidth-($CornerWidth*2)).'" valign="top">'.
						'<div id="desktopsdiv" ';
	if ($DesktopItems == 0) 
		$DownloadsString .= 'style="display:none;"';
	$DownloadsString .= '>'.$deskstring.'</div>'.
						'<div id="coversdiv" ';
	if ($DesktopItems > 0)  
		$DownloadsString .= 'style="display:none;"';
	$DownloadsString .= '>'.$coverstring.'</div>'.
						'<div id="avatarsdiv" ';
	if (($DesktopItems > 0) || ($CoverItems > 0)) 
		$DownloadsString .= 'style="display:none;"';
	$DownloadsString .= '>'.$avatarstring.'</div>'.
						'</td>'.
						'<td id="projectmodrightside"></td></tr>'.
						'<tr>'.
						'<td id="projectmodbottomleft"></td>'.
						'<td id="projectmodbottom"></td>'.
						'<td id="projectmodbottomright"></td>'.
						'</tr>'.
						'</table></div>'; 
}

 ?>