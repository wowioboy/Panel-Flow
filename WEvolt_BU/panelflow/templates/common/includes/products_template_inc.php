<? 

if ($Section == 'Products')  { 
		$ProductMenuString = '';
		$ProductMenuString .= '<div align="left"><table cellpadding="0" cellspacing="0" border="0">'. 
							'<tr>';
	if ($PDFs > 0) {
		$ProductMenuString .= '<td class="tabactive" align="left" id=\'pdfstab\' '.
								'onMouseOver="rolloveractive(\'pdfstab\',\'pdfsdiv\')" '.
								'onMouseOut="rolloverinactive(\'pdfstab\',\'pdfsdiv\')"'.
								'onclick="pdfstab();">E-BOOKS</td><td width="5"></td>';
	}
	if ($Prints >0) {
		$ProductMenuString .= '<td class="';
		if ($PDFs == 0) 
			$ProductMenuString .= 'tabactive';
		else 
			$ProductMenuString .= 'tabinactive';
		$ProductMenuString .= '" align="left" id=\'printstab\' '.
								'onMouseOver="rolloveractive(\'printstab\',\'printsdiv\')" '.
								'onMouseOut="rolloverinactive(\'printstab\',\'printsdiv\')"'.
								'onclick="printstab();">PRINTS</td><td width="5"></td>';
	}
	
	if ($Books >0) {
		$ProductMenuString .= '<td class="';
		if (($PDFs == 0)  && ($Prints ==0))
			$ProductMenuString .= 'tabactive';
		else 
			$ProductMenuString .= 'tabinactive';
		$ProductMenuString .= '" align="left" id=\'bookstab\' '.
								'onMouseOver="rolloveractive(\'bookstab\',\'booksdiv\')" '.
								'onMouseOut="rolloverinactive(\'bookstab\',\'booksdiv\')"'.
								'onclick="bookstab();">BOOKS</td><td width="5"></td>';
	}
	
	if ($Merch >0) {
		$ProductMenuString .= '<td class="';
		if (($PDFs == 0)  && ($Prints ==0) && ($Books == 0))
			$ProductMenuString .= 'tabactive';
		else 
			$ProductMenuString .= 'tabinactive';
		$ProductMenuString .= '" align="left" id=\'merchtab\' '.
								'onMouseOver="rolloveractive(\'merchtab\',\'merchdiv\')" '.
								'onMouseOut="rolloverinactive(\'merchtab\',\'merchdiv\')"'.
								'onclick="merchtab();">MERCHANDISE</td><td width="5"></td>';
	}
	
	if ($Digital >0) {
		$ProductMenuString .= '<td class="';
		if (($PDFs == 0)  && ($Prints ==0) && ($Books == 0) && ($Merch == 0))
			$ProductMenuString .= 'tabactive';
		else 
			$ProductMenuString .= 'tabinactive';
		$ProductMenuString .= '" align="left" id=\'digitaltab\' '.
								'onMouseOver="rolloveractive(\'digitaltab\',\'digitaldiv\')" '.
								'onMouseOut="rolloverinactive(\'digitaltab\',\'digitaldiv\')"'.
								'onclick="digitaltab();">LICENSING</td><td width="5"></td>';
	}

							
	$ProductMenuString .= '</tr></table></div>';
	$ProductsString .= '<table width="'.$GlobalSiteWidth.'" border="0" cellspacing="0" cellpadding="0">'.
						'<tr><td colspan="3">'.$ProductMenuString.'</td></tr>'.
						'<tr>'.
						'<td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.($GlobalSiteWidth-($CornerWidth*2)).'" valign="top">'.
						'<div id="pdfsdiv" ';
	if ($PDFs == 0) 
		$ProductsString .= 'style="display:none;"';
	$ProductsString .= '>'.$PDFsString.'</div>'.
						'<div id="printsdiv" ';
	if ($PDFs > 0)  
		$ProductsString .= 'style="display:none;"';
	$ProductsString .= '>'.$PrintsString.'</div>'.
						'<div id="booksdiv" ';
	if (($PDFs > 0) || ($Prints > 0))
		$ProductsString .= 'style="display:none;"';
	$ProductsString .= '>'.$BooksString.'</div>'.
						'<div id="merchdiv" ';
	if (($PDFs > 0) || ($Prints > 0) && ($Books > 0))
		$ProductsString .= 'style="display:none;"';
	$ProductsString .= '>'.$OtherMerchString.'</div>'.
						'<div id="digitaldiv" ';
	if (($PDFs > 0) || ($Prints > 0) && ($Books > 0) && ($Merch > 0))
		$ProductsString .= 'style="display:none;"';
	$ProductsString .= '>'.$DigitalString.'</div>'.
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