<? 
if ($_GET['section'] == 'menu') {

		function create_section_dropdown ($value, $ID) {
					$SectionArray = array('Archives','Characters','Credits','Downloads','Episodes','Links','Mobile','Products','Custom')	;	
				
				$String = '<select name="'.$ID.'">';
					foreach($SectionArray as $Section) {
							$String .= '<option value="'.strtolower($Section);
							if ($value == strtolower($Section))
								$String .= ' selected';
							$String .= '>'.$Section.'</option>';
					
					}
				$String .='</select>';
				
				return $String;
		
		}
		
		if ($_POST['changemenu'] != '') {
			$Custom = $_POST['txtCustom'];
				$query = "update comic_settings set MenuOneCustom='$Custom' where ProjectID='$ProjectID'";
					$InitDB->execute($query);
					
		}
						
						
		$query = "select * from comic_settings where ProjectID='$ProjectID'";
					
		$MenuArray = $InitDB->queryUniqueObject($query);
		$MenuOneType = $MenuArray->MenuOneType;
		$MenuOneLayout = $MenuArray->MenuOneLayout;
		$MenuOneCustom = $MenuArray->MenuOneCustom;
		$ProjectTheme = $MenuArray->CurrentTheme;
		
		$menuString .= "<div>";
		
		if ($MenuOneCustom == 1)			
			$query = "select * from menu_links where ComicID='$ProjectID' and MenuParent=1 ORDER BY Parent, Position ASC";
		else 
			$query = "select * from pf_themes_menus where ThemeID='$ProjectTheme' and MenuParent=1 ORDER BY Parent, Position ASC";
			
		$InitDB->query($query);
		$NumLinks = $InitDB->numRows();
		while ($line = $InitDB->fetchNextObject()) { 
				$menuString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$menuString .= '<table width="100%" id="menu_'.$line->EncryptID.'"><tr><td class="grey_cmsboxcontent" width="300">';
							
				if ($line->ButtonImage != '') {
					if ($MenuOneCustom == 1)
						$menuString .= '<img src="/'.$_SESSION['basefolder'].'/'.$ComicDirectory.'/images/'.$line->ButtonImage.'">';
					else
						$menuString .= '<img src="/themes/'.$ProjectTheme.'/images/'.$line->ButtonImage.'">';
				}else{ 
						$menuString .= '<strong>TITLE</strong>: '.$line->Title;
				}
							
				$menuString .='<div class="spacer"></div>';
				$menuString .='<strong>URL</strong>: ' .$line->Url;
				$menuString .= '</td><td class="grey_cmsboxcontent">';
				
				if ($line->LinkType == 'section') {
					$menuString .= '<strong>LINK TYPE</strong> - ';
					if ($line->ContentSection == '')
						$menuString .= substr($line->Target,0,strlen($line->Target)-1);					
					else 
						$menuString .= $line->ContentSection;
		
				} else {
						$menuString.=$line->LinkType;
						
				}
				$menuString.='</td><td align="right">';
				
				if ($MenuOneCustom == 1)
						$menuString.='<a href="javascript:void(0)" onclick="menulink(\'edit\',\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="removeMenuItem(\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>';
						
				$menuString.='</td></tr></table>';
						
				$menuString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
		} 
		
		$menuString .= "</div>";
		
		if ($NumLinks == 0) 
			$menuString = 'NO MENU LINKS CREATED YET';


}
?>