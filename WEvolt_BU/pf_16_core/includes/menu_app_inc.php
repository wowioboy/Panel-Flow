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
			   
			   
				
					$menuString = '<div class=\'pagetitleLarge\' style="border-bottom:solid 1px #FF9900; padding-right:10px;">Menu One</div>';
$menuString .= "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td class='sender_name'>TITLE</td><td class='sender_name'>URL</td><td class='sender_name'>LINK TYPE</td><td class='sender_name'>ACTIONS</td></tr><tr><td colspan='4'>&nbsp;</td></tr>";


	if ($MenuOneCustom == 1) {			
$query = "select * from menu_links where ComicID='$ProjectID' and MenuParent=1 ORDER BY Parent, Position ASC";
			$InitDB->query($query);
            $NumLinks = $InitDB->numRows();
				while ($line = $InitDB->fetchNextObject()) { 
					$menuString .= "<tr><td class='messageinfo'>";
					if ($line->ButtonImage != '') 
						$menuString .= "<img src='/comics/".$ComicDirectory."/images/".$line->ButtonImage."'>";
					else 
					$menuString .= $line->Title;
					
					$menuString .= "</td><td class='messageinfo'>";
					
					
						$menuString .=$line->Url;
					
					
					
	
				$menuString .= "</td><td class='messageinfo'>";
				if ($line->LinkType == 'section') {
						$menuString .= 'Section - ';
						if ($line->ContentSection == '')
							$menuString .= substr($line->Target,0,strlen($line->Target)-1);					
						else 
						$menuString .= $line->ContentSection;

				} else {
					$menuString.=$line->LinkType;
				
				}
				$menuString.="</td><td class='submenu_blue'>[<a href='#' onclick=\"menulink('edit','".$line->EncryptID."');\">EDIT</a>]&nbsp;&nbsp;[<a href='#' onclick=\"removeMenuItem('".$line->EncryptID."');\">DELETE</a>]</td></tr>";

	}

} else {

$query = "select * from pf_themes_menus where ThemeID='$ProjectTheme' and MenuParent=1 ORDER BY Parent, Position ASC";
			$InitDB->query($query);
            $NumLinks = $InitDB->numRows();
			

				while ($line = $InitDB->fetchNextObject()) { 
					$menuString .= "<tr><td class='messageinfo'>";
					if ($line->ButtonImage != '') 
						$menuString .= "<img src='/themes/".$ProjectTheme."/images/".$line->ButtonImage."'>";
					else 
					$menuString .= $line->Title;
					
					$menuString .= "</td><td class='messageinfo'>";
					
					
						$menuString .=$line->Url;
					
					
					
	
				$menuString .= "</td><td class='messageinfo'>";
				if ($line->LinkType == 'section') {
						$menuString .= 'Section - ';
						if ($line->ContentSection == '')
							$menuString .= substr($line->Target,0,strlen($line->Target)-1);					
						else 
						$menuString .= $line->ContentSection;
				
					
				} else {
				$menuString.=$line->LinkType;
				
				}
				$menuString.="</td><td class='submenu_blue'>[<a href='#' onclick=\"menulink('edit','".$line->EncryptID."');\">EDIT</a>]&nbsp;&nbsp;[<a href='#' onclick=\"removeMenuItem('".$line->EncryptID."');\">DELETE</a>]</td></tr>";

	}

}	

$menuString .= "</table>";

			if ($NumLinks == 0) 
				$menuString = 'NO MENU LINKS CREATED YET';


	}
				?>