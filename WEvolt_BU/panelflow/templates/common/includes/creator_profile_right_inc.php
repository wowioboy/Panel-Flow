<? 

$MainCreatorProfileString .='<div id="maincreator_right"><div class="creatorwrapper">'.
						'<table width="367" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'. 
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(367-($CornerWidth*2)).'" valign="top">';
				if ($MainCreator['About'] != '') { 
						$MainCreatorProfileString .='<div class="modheader">BIO </div>'.
												'<div class="modtext" style="padding:5px;">'.$MainCreator['About'].'</div>';
				} 
				if ($MainCreator['CreatorInfluence'] != '') {
						$MainCreatorProfileString .='<div class="modheader">INFLUENCES </div>'.
												'<div class="modtext" style="padding:5px;">'.$MainCreator['CreatorInfluence'].'</div>';
				}
				if ($MainCreator['OtherCredits'] != '') {
						$MainCreatorProfileString .='<div class="modheader">CREDITS </div>'.
												'<div class="modtext" style="padding:5px;">'.$MainCreator['OtherCredits'].'</div>';
				}
				if ($MainCreator['Hobbies'] != '') {
						$MainCreatorProfileString .='<div class="modheader">HOBBIES </div>'.
												'<div class="modtext" style="padding:5px;">'.$MainCreator['Hobbies'].'</div>';
				}
				if ($MainCreator['Music'] != '') {
						$MainCreatorProfileString .='<div class="modheader">MUSIC </div>'.
												'<div class="modtext" style="padding:5px;">'.$MainCreator['Music'].'</div>';
				}
				if ($MainCreator['Books'] != '') {
						$MainCreatorProfileString .='<div class="modheader">BOOKS </div>'.
												'<div class="modtext">'.$MainCreator['Books'].'</div>';
				}

				 if ($AllowComments == 1) { 
					$MainCreatorProfileString .='<div>';
					$ProfileComments = getProfileComments ($CreatorID);
					$MainCreatorProfileString .=$ProfileComments;
					if (is_authed()) {
					$MainCreatorProfileString .='<div class="authornote">LEAVE A COMMENT FOR'.$CreatorName.'</div>'.
											'<form method="POST" action="/'.$ComicFolder.'/creator/">'.
	  										'<div align="center">'.
	    									'<textarea rows="5" cols="16" name="txtFeedback" id="txtFeedback"></textarea>'.
	   										'<input type="hidden" name="profilecomment" id="profilecomment" value="1">'.
											'<input type="submiy" value="Submit Comment" style="border:none;" />'.
	      									'</div>'.
											'</form>'.
											'<div class="spacer"></div>'.
											'<div align="center"><a href="logout.php">LOGOUT</a></div>';
	
				
					} else { 
					$MainCreatorProfileString .='<div class="authornote" align="center">YOU NEED TO LOG IN TO LEAVE COMMENTS </div>';
 					}

				} 
					$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table></div></div>';
						
	if (is_array($CreatorArray1)) {
	$MainCreatorProfileString .='<div id="creatorone_right" style="display:none;"><div class="creatorwrapper">'.
						'<table width="367" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'. 
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(367-($CornerWidth*2)).'" valign="top">';
				if ($CreatorArray1['About'] != '') { 
						$MainCreatorProfileString .='<div class="modheader">BIO </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray1['About'].'</div>';
				} 
				if ($CreatorArray1['CreatorInfluence'] != '') {
						$MainCreatorProfileString .='<div class="modheader">INFLUENCES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray1['CreatorInfluence'].'</div>';
				}
				if ($CreatorArray1['OtherCredits'] != '') {
						$MainCreatorProfileString .='<div class="modheader">CREDITS </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray1['OtherCredits'].'</div>';
				}
				if ($CreatorArray1['Hobbies'] != '') {
						$MainCreatorProfileString .='<div class="modheader">HOBBIES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray1['Hobbies'].'</div>';
				}
				if ($CreatorArray1['Music'] != '') {
						$MainCreatorProfileString .='<div class="modheader">MUSIC </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray1['Music'].'</div>';
				}
				if ($CreatorArray1['Books'] != '') {
						$MainCreatorProfileString .='<div class="modheader">BOOKS </div>'.
												'<div class="modtext">'.$CreatorArray1['Books'].'</div>';
				}

	
					$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table></div></div>';

	}	
	if (is_array($CreatorArray2)) {
	$MainCreatorProfileString .='<div id="creatortwo_right" style="display:none;"><div class="creatorwrapper">'.
						'<table width="367" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'. 
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(367-($CornerWidth*2)).'" valign="top">';
				if ($CreatorArray2['About'] != '') { 
						$MainCreatorProfileString .='<div class="modheader">BIO </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray2['About'].'</div>';
				} 
				if ($CreatorArray2['CreatorInfluence'] != '') {
						$MainCreatorProfileString .='<div class="modheader">INFLUENCES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray2['CreatorInfluence'].'</div>';
				}
				if ($CreatorArray2['OtherCredits'] != '') {
						$MainCreatorProfileString .='<div class="modheader">CREDITS </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray2['OtherCredits'].'</div>';
				}
				if ($CreatorArray2['Hobbies'] != '') {
						$MainCreatorProfileString .='<div class="modheader">HOBBIES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray2['Hobbies'].'</div>';
				}
				if ($CreatorArray2['Music'] != '') {
						$MainCreatorProfileString .='<div class="modheader">MUSIC </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray2['Music'].'</div>';
				}
				if ($CreatorArray2['Books'] != '') {
						$MainCreatorProfileString .='<div class="modheader">BOOKS </div>'.
												'<div class="modtext">'.$CreatorArray2['Books'].'</div>';
				}

	
					$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table></div></div>';

	}
	
	if (is_array($CreatorArray3)) {
	$MainCreatorProfileString .='<div id="creatorthree_right" style="display:none;"><div class="creatorwrapper">'.
						'<table width="367" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft">'.
						'</td>'.
						'<td id="modtop"></td>'.
						'<td id="modtopright"></td>'. 
						'</tr>'.
						'<tr><td id="modleftside"></td>'.
						'<td class="boxcontent" width="'.(367-($CornerWidth*2)).'" valign="top">';
				if ($CreatorArray3['About'] != '') { 
						$MainCreatorProfileString .='<div class="modheader">BIO </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray3['About'].'</div>';
				} 
				if ($CreatorArray3['CreatorInfluence'] != '') {
						$MainCreatorProfileString .='<div class="modheader">INFLUENCES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray3['CreatorInfluence'].'</div>';
				}
				if ($CreatorArray3['OtherCredits'] != '') {
						$MainCreatorProfileString .='<div class="modheader">CREDITS </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray3['OtherCredits'].'</div>';
				}
				if ($CreatorArray3['Hobbies'] != '') {
						$MainCreatorProfileString .='<div class="modheader">HOBBIES </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray3['Hobbies'].'</div>';
				}
				if ($CreatorArray3['Music'] != '') {
						$MainCreatorProfileString .='<div class="modheader">MUSIC </div>'.
												'<div class="modtext" style="padding:5px;">'.$CreatorArray3['Music'].'</div>';
				}
				if ($CreatorArray3['Books'] != '') {
						$MainCreatorProfileString .='<div class="modheader">BOOKS </div>'.
												'<div class="modtext">'.$CreatorArray3['Books'].'</div>';
				}

	
					$MainCreatorProfileString .='</td>'.
						'<td id="modrightside"></td>'.
						'</tr>'.
						'<tr><td id="modbottomleft"></td>'.
						'<td id="modbottom"></td>'.
						'<td id="modbottomright"></td>'.
						'</tr></table></div></div>';

	}				
						
?>