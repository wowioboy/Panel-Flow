<? // PROFILE IMAGE AND INFO BOX
	
	$MainCreatorProfileString .='<div id="maincreator_left"><table width="320" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>
							<td id="modtopleft"></td>'.
							'<td id="modtop"></td>'.
							'<td id="modtopright"></td>
						</tr>'.
						'<tr>
							<td id="modleftside"></td>'.
							'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
								'<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  								'<tr>'.
    								'<td width="205" valign="top" id="profileinfo">'.
										'<div class="modheader" align="left" style="font-size:12px;">'.$MainCreator['Creator'].'</div>'.
										'<div class="spacer"></div>';
										if ($MainCreator['Location'] != '') {
											$MainCreatorProfileString .='
												  <div class="locationwrapper">'.
													'<div class="boxcontent"><b>LOCATION</b>: </div> '.
													'<div class="boxcontent">'.$MainCreator['Location'].'</div>'.
												'</div>';
										}
										if ($ContactSetting == 1) { 
											$MainCreatorProfileString .='<div class="pagelinks" style="padding-left:3px;padding-top:5px;">'.
												'<a href="/';
												if (($ComicFolder != '') && ($ComicFolder != '/')) 
													$MainCreatorProfileString .= $ComicFolder.'/';
												$MainCreatorProfileString .= 'creator/contact/">CONTACT CREATOR</a></div>';
										} 
		$MainCreatorProfileString .='</td>'.
								'<td height="115" width="115" valign="middle">';
		if ($MainCreator['Avatar'] != '') { 
			$MainCreatorProfileString .='<div align="center"><img src="'.$MainCreator['Avatar'].'"  border="1" width="100" height="100"/>	`		</div>';
 		} 
		$MainCreatorProfileString .='</td>
		</tr>
		</table>
		</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';	
	
	//WEBSITE BOX		
	if ($MainCreator['Website'] != '') { 
		$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td id="modtopleft"></td>
								<td id="modtop"></td>
								<td id="modtopright"></td>
								</tr>
								<tr>
								<td id="modleftside"></td>
								<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  									'<div class="GlobalHeader">PERSONAL WEBSITE</div>'.
   									'<div class="modtext" style="padding:5px;">
									<a href="'.$MainCreator['Website'].'" target="_blank" style="color:#FF6600;">'.
									$MainCreator['Website'].'</a>
									</div>
									</td>
								<td id="modrightside"></td>
								</tr>
								<tr>
								<td id="modbottomleft"></td>
								<td id="modbottom"></td>
								<td id="modbottomright"></td>
								</tr>
								</table>';
   
 	} 
//LINK BOX
 if ($linkstring != '') {
$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td id="modtopleft"></td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  							'<div class="GlobalHeader">RECOMMENDED LINKS</div>'.
   							'<div class="modtext" style="padding:5px;">'.
							$linkstring.'</div>
						</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';

 } 
//LINKS 

if (($MainCreator['Link1'] != '') || ($MainCreator['Link2'] != '') || ($MainCreator['Link3'] != '') || ($MainCreator['Link4'] != '')) {
$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  						'<div class="GlobalHeader">OTHER LINKS</div>';

		if ($MainCreator['Link1'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$MainCreator['Link1'].'" target="_blank" style="color:#FF6600;">'.
										$MainCreator['Link1'].'</a></div>';
 		} 
		

		if ($MainCreator['Link2'] != ''){ 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$MainCreator['Link2'].'" target="_blank" style="color:#FF6600;">'.
										$MainCreator['Link2'].'</a></div>';
 		} 
		if ($MainCreator['Link3'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$MainCreator['Link3'].'" target="_blank" style="color:#FF6600;">'.
										$MainCreator['Link3'].'</a></div>';
 		} 
		if ($MainCreator['Link4'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$MainCreator['Link4'].'" target="_blank" style="color:#FF6600;">'.
										$MainCreator['Link4'].'</a></div>';
 		} 



		$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';
						
						
	}	
	$MainCreatorProfileString .='</div>';				
					
if (is_array($CreatorArray1)) {
		$MainCreatorProfileString .='<div id="creatorone_left" style="display:none;">
						<table width="320" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>
							<td id="modtopleft"></td>'.
							'<td id="modtop"></td>'.
							'<td id="modtopright"></td>
						</tr>'.
						'<tr>
							<td id="modleftside"></td>'.
							'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
								
								'<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  								'<tr>'.
    								'<td width="205" valign="top" id="profileinfo">'.
										'<div class="modheader" align="left" style="font-size:12px;">'.$CreatorArray1['Creator'].'</div>'.
										'<div class="spacer"></div>';
										if ($CreatorArray1['Location'] != '') {
											$MainCreatorProfileString .='
												  <div class="locationwrapper">'.
													'<div class="boxcontent"><b>LOCATION</b>: </div> '.
													'<div class="boxcontent">'.$CreatorArray1['Location'].'</div>'.
												'</div>';
										}
										if ($ContactSetting == 1) { 
											$MainCreatorProfileString .='<div class="pagelinks" style="padding-left:3px;padding-top:5px;">'.
												'<a href="/';
												if (($ComicFolder != '') && ($ComicFolder != '/')) 
													$MainCreatorProfileString .= $ComicFolder.'/';
												$MainCreatorProfileString .= 'creator/contact/?c=1"> CONTACT CREATOR </a></div>';
										} 
		$MainCreatorProfileString .='</td>'.
								'<td height="115" width="115" valign="middle">';
		if ($CreatorArray1['Avatar'] != '') { 
			$MainCreatorProfileString .='<div align="center"><img src="'.$CreatorArray1['Avatar'].'"  border="1" width="100" height="100"/>	`		</div>';
 		} 
		$MainCreatorProfileString .='</td>
		</tr>
		</table>
		</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';	
	
	//WEBSITE BOX		
	if ($CreatorArray1['Website'] != '') { 
		$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td id="modtopleft"></td>
								<td id="modtop"></td>
								<td id="modtopright"></td>
								</tr>
								<tr>
								<td id="modleftside"></td>
								<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  									'<div class="GlobalHeader">PERSONAL WEBSITE</div>'.
   									'<div class="modtext" style="padding:5px;">
									<a href="'.$CreatorArray1['Website'].'" target="_blank" style="color:#FF6600;">'.
									$CreatorArray1['Website'].'</a>
									</div>
									</td>
								<td id="modrightside"></td>
								</tr>
								<tr>
								<td id="modbottomleft"></td>
								<td id="modbottom"></td>
								<td id="modbottomright"></td>
								</tr>
								</table>';
   
 	} 


if (($CreatorArray1['Link1'] != '') || ($CreatorArray1['Link2'] != '') || ($CreatorArray1['Link3'] != '') || ($CreatorArray1['Link4'] != '')) {
$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  						'<div class="GlobalHeader">OTHER LINKS</div>';

		if ($CreatorArray1['Link1'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray1['Link1'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray1['Link1'].'</a></div>';
 		} 
		

		if ($CreatorArray1['Link2'] != ''){ 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray1['Link2'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray1['Link2'].'</a></div>';
 		} 
		if ($CreatorArray1['Link3'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray1['Link3'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray1['Link3'].'</a></div>';
 		} 
		if ($CreatorArray1['Link4'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray1['Link4'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray1['Link4'].'</a></div>';
 		} 
		


		$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';
						
		}				
		$MainCreatorProfileString .='</div>';


}	
if (is_array($CreatorArray2)) {
		$MainCreatorProfileString .='<div id="creatortwo_left" style="display:none;"><table width="320" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>
							<td id="modtopleft"></td>'.
							'<td id="modtop"></td>'.
							'<td id="modtopright"></td>
						</tr>'.
						'<tr>
							<td id="modleftside"></td>'.
							'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
								'<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  								'<tr>'.
    								'<td width="205" valign="top" id="profileinfo">'.
										'<div class="modheader" align="left" style="font-size:12px;">'.$CreatorArray2['Creator'].'</div>'.
										'<div class="spacer"></div>';
										if ($CreatorArray2['Location'] != '') {
											$MainCreatorProfileString .='
												  <div class="locationwrapper">'.
													'<div class="boxcontent"><b>LOCATION</b>: </div> '.
													'<div class="boxcontent">'.$CreatorArray2['Location'].'</div>'.
												'</div>';
										}
										if ($ContactSetting == 1) { 
											$MainCreatorProfileString .='<div class="pagelinks" style="padding-left:3px;padding-top:5px;">'.
												'<a href="/';
												if (($ComicFolder != '') && ($ComicFolder != '/')) 
													$MainCreatorProfileString .= $ComicFolder.'/';
												$MainCreatorProfileString .= 'creator/contact/?c=2">CONTACT CREATOR</a></div>';
										} 
		$MainCreatorProfileString .='</td>'.
								'<td height="115" width="115" valign="middle">';
		if ($CreatorArray2['Avatar'] != '') { 
			$MainCreatorProfileString .='<div align="center"><img src="'.$CreatorArray2['Avatar'].'"  border="1" width="100" height="100"/>	`		</div>';
 		} 
		$MainCreatorProfileString .='</td>
		</tr>
		</table>
		</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';	
	
	//WEBSITE BOX		
	if ($CreatorArray2['Website'] != '') { 
		$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td id="modtopleft"></td>
								<td id="modtop"></td>
								<td id="modtopright"></td>
								</tr>
								<tr>
								<td id="modleftside"></td>
								<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  									'<div class="GlobalHeader">PERSONAL WEBSITE</div>'.
   									'<div class="modtext" style="padding:5px;">
									<a href="'.$CreatorArray2['Website'].'" target="_blank" style="color:#FF6600;">'.
									$CreatorArray2['Website'].'</a>
									</div>
									</td>
								<td id="modrightside"></td>
								</tr>
								<tr>
								<td id="modbottomleft"></td>
								<td id="modbottom"></td>
								<td id="modbottomright"></td>
								</tr>
								</table>';
   
 	} 


if (($CreatorArray2['Link1'] != '') || ($CreatorArray2['Link2'] != '') || ($CreatorArray2['Link3'] != '') || ($CreatorArray2['Link4'] != '')) {
$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  						'<div class="GlobalHeader">OTHER LINKS</div>';

		if ($CreatorArray2['Link1'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray2['Link1'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray2['Link1'].'</a></div>';
 		} 
		

		if ($CreatorArray2['Link2'] != ''){ 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray2['Link2'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray2['Link2'].'</a></div>';
 		} 
		if ($CreatorArray2['Link3'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray2['Link3'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray2['Link3'].'</a></div>';
 		} 
		if ($CreatorArray2['Link4'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray2['Link4'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray2['Link4'].'</a></div>';
 		} 
		

		$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';
}				
		$MainCreatorProfileString .='</div>';

}
if (is_array($CreatorArray3)) {
		$MainCreatorProfileString .='<div id="creatorthree_left" style="display:none;"><table width="320" border="0" cellspacing="0" cellpadding="0">'.
						'<tr>
							<td id="modtopleft"></td>'.
							'<td id="modtop"></td>'.
							'<td id="modtopright"></td>
						</tr>'.
						'<tr>
							<td id="modleftside"></td>'.
							'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
								'<table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  								'<tr>'.
    								'<td width="205" valign="top" id="profileinfo">'.
										'<div class="modheader" align="left" style="font-size:12px;">'.$CreatorArray3['Creator'].'</div>'.
										'<div class="spacer"></div>';
										if ($CreatorArray3['Location'] != '') {
											$MainCreatorProfileString .='
												  <div class="locationwrapper">'.
													'<div class="boxcontent"><b>LOCATION</b>: </div> '.
													'<div class="boxcontent">'.$CreatorArray3['Location'].'</div>'.
												'</div>';
										}
										if ($ContactSetting == 1) { 
											$MainCreatorProfileString .='<div class="pagelinks" style="padding-left:3px;padding-top:5px;">'.
												'<a href="/';
												if (($ComicFolder != '') && ($ComicFolder != '/')) 
													$MainCreatorProfileString .= $ComicFolder.'/';
												$MainCreatorProfileString .= 'creator/contact/?c=3">CONTACT CREATOR</a></div>';
										} 
		$MainCreatorProfileString .='</td>'.
								'<td height="115" width="115" valign="middle">';
		if ($CreatorArray3['Avatar'] != '') { 
			$MainCreatorProfileString .='<div align="center"><img src="'.$CreatorArray3['Avatar'].'"  border="1" width="100" height="100"/>	`		</div>';
 		} 
		$MainCreatorProfileString .='</td>
		</tr>
		</table>
		</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';	
	
	//WEBSITE BOX		
	if ($CreatorArray3['Website'] != '') { 
		$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td id="modtopleft"></td>
								<td id="modtop"></td>
								<td id="modtopright"></td>
								</tr>
								<tr>
								<td id="modleftside"></td>
								<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  									'<div class="GlobalHeader">PERSONAL WEBSITE</div>'.
   									'<div class="modtext" style="padding:5px;">
									<a href="'.$CreatorArray3['Website'].'" target="_blank" style="color:#FF6600;">'.
									$CreatorArray3['Website'].'</a>
									</div>
									</td>
								<td id="modrightside"></td>
								</tr>
								<tr>
								<td id="modbottomleft"></td>
								<td id="modbottom"></td>
								<td id="modbottomright"></td>
								</tr>
								</table>';
   
 	} 


if (($CreatorArray3['Link1'] != '') || ($CreatorArray3['Link2'] != '') || ($CreatorArray3['Link3'] != '') || ($CreatorArray3['Link4'] != '')) {
$MainCreatorProfileString .='<table width="320" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'.
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(320-($CornerWidth*2)).'" valign="top">'.
  						'<div class="GlobalHeader">OTHER LINKS</div>';

		if ($CreatorArray3['Link1'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray3['Link1'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray3['Link1'].'</a></div>';
 		} 
		

		if ($CreatorArray3['Link2'] != ''){ 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray3['Link2'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray3['Link2'].'</a></div>';
 		} 
		if ($CreatorArray3['Link3'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray3['Link3'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray3['Link3'].'</a></div>';
 		} 
		if ($CreatorArray3['Link4'] != '') { 
				$MainCreatorProfileString .='<div class="modtext" style="padding:5px;">'.
										'<a href="'.$CreatorArray3['Link4'].'" target="_blank" style="color:#FF6600;">'.
										$CreatorArray3['Link4'].'</a></div>';
 		} 
		


		$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table>';
}				
		$MainCreatorProfileString .='</div>';

}	

?>