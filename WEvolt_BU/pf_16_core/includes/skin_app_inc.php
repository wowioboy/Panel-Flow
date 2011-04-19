<? 

if ($_GET['section']== 'skins') {
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$UserSkins .='';
if ((!isset($_GET['skincode'])) && ($_GET['a'] != 'create')) {
	if ($ContentType == 'story')
		$query = "SELECT Skin from story_settings where StoryID='$StoryID'";
	else
		$query = "SELECT Skin from comic_settings where ComicID='$ComicID'";
	$CurrentSkin = $db->queryUniqueValue($query);
	if (!isset($_GET['st'])) {
		$query = "SELECT ID from project_skins where UserID='$UserID'";
		$db->query($query);
		$TotalSkins = $db->numRows();
		$query = "SELECT * from project_skins where UserID='$UserID'";
	} else {
		if ($_GET['st'] =='community') {
			$query = "SELECT ID from template_skins where Public=1";
			$db->query($query);
			$TotalSkins = $db->numRows();
			$query = "SELECT * from template_skins where Public=1";
		} else if ($_GET['st'] =='premium') {
			$query = "SELECT ID from template_skins where Premium=1";
			$db->query($query);
			$TotalSkins = $db->numRows();
			$query = "SELECT * from template_skins where Premium=1";
		} else if ($_GET['st'] =='featured') {
			$query = "SELECT ID from template_skins where Featured=1";
			$db->query($query);
			$TotalSkins = $db->numRows();
			$query = "SELECT * from template_skins where Featured=1";
		}
	}
	if ($NumItemsPerPage == 7)
		$NumItemsPerPage = 20;
		include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
		$pagination    =    new pagination();  
	$pagination->createPaging($query,$NumItemsPerPage);

	
	//print 'My CURRENT SKIN = ' . $CurrentSkin."<br/>";
	$Count = 0;
	$UserSkinString .='<table cellpadding="0" cellspacing="0" border="0"><tr>';
	 	 while($line=mysql_fetch_object($pagination->resultpage)) {
	 	if ($line->SkinCode == $CurrentSkin) {
			$BoxType = 'admin_box';
		} else {
			$BoxType = 'admin_box';
		}
	//	print 'MY BOX TYPE = ' . $BoxType;
	 	$UserSkinString .='<td width="150" height="75"><div>';
		$UserSkinString .=' <b class="'.$BoxType.'">';
		$UserSkinString .=' <b class="'.$BoxType.'1"><b></b></b>';
		$UserSkinString .=' <b class="'.$BoxType.'2"><b></b></b>';
		$UserSkinString .=' <b class="'.$BoxType.'3"></b>';
		$UserSkinString .='	<b class="'.$BoxType.'4"></b>';
		$UserSkinString .='	<b class="'.$BoxType.'5"></b></b>';
		$UserSkinString .='<div class="'.$BoxType.'fg">';
		
		
		$UserSkinString .= '<b>'.$line->Title.'</b>';
		$UserSkinString .= '<div style="padding-left:3px;padding-right:2px;font-weight:100;height:50px;overflow:hidden">'.nl2br($line->Description).'</div><div align="center">';
		if ($line->UserID == $UserID) {
		if ($ContentType == 'story')
		$UserSkinString .= '[<a href="/story/edit/'.$SafeFolder.'/?tab=design&skincode='.$line->SkinCode.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;'; 
		else
		$UserSkinString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=design&skincode='.$line->SkinCode.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;'; 
		}
		if ($line->SkinCode == $CurrentSkin) {
			$UserSkinString .= '[<img src="/'.$PFDIRECTORY.'/images/green_check.png">]';
		}else{
			if ($ContentType =='story')
			$UserSkinString .= '[<a href="/story/edit/'.$SafeFolder.'/?tab=design&skincode='.$line->SkinCode.'&section='.$Section.'&a=assign">USE</a>]';
			else
			$UserSkinString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=design&skincode='.$line->SkinCode.'&section='.$Section.'&a=assign">USE</a>]';
		}
		$UserSkinString .='</div></div>';
  		$UserSkinString .='<b class="'.$BoxType.'">';
  		$UserSkinString .='<b class="'.$BoxType.'5"></b>';
  		$UserSkinString .=' <b class="'.$BoxType.'4"></b>';
  		$UserSkinString .='<b class="'.$BoxType.'3"></b>';
  		$UserSkinString .='<b class="'.$BoxType.'2"><b></b></b>';
  		$UserSkinString .='<b class="'.$BoxType.'1"><b></b></b></b>';
		$UserSkinString .='</div><div class="spacer"></div></td><td width="5"></td>';
		$Count++;
		
		if ($Count == 5) {
			$UserSkinString .='</tr><tr>';
			$Count = 0;
		}
	 }
$UserSkinString .='</table>';
}  else if((isset($_GET['skincode'])) && ($_GET['a'] != 'create')) {
		$SkinCode= $_GET['skincode'];
		if ($_GET['tab'] == 'design'){
			$query = "SELECT CurrentTheme from comic_settings where ProjectID='".$_SESSION['sessionproject']."'";
			$CurrentTheme = $db->queryUniqueValue($query);
			$query = "SELECT * from project_skins where SkinCode='$SkinCode'";
		}else {
			$CurrentTheme=$_GET['theme'];
			$query = "SELECT * from template_skins where SkinCode='$SkinCode'";
		}
		$SkinArray =  $db->queryUniqueObject($query);
		
		
		
		$query = "SELECT * from pf_themes where ID='$CurrentTheme'";
		$ThemeArray =  $db->queryUniqueObject($query);
		$TemplateCode = $ThemeArray->TemplateCode;
		
		$BaseSkinDir = '/templates/skins/'.$SkinCode.'/images/';
		if ($SkinArray->UserID != $_SESSION['userid']) {
			if ($ContentType == 'story')
				header("location:/story/admin/".$SafeFolder."/?tab=design&section=skins");
			else
				header("location:/cms/admin/".$SafeFolder."/?tab=design&section=skins");
		}
		
		//INFO 
		$Description = stripslashes($SkinArray->Description);
		$Title = stripslashes($SkinArray->Title);
		$Tags = stripslashes($ThemeArray->Tags);
		$Published = $SkinArray->Published;
		$Public = $SkinArray->Public;
		
		//SITE
		$GlobalSiteBGColor = $SkinArray->GlobalSiteBGColor;
		$GlobalSiteBGImage = $SkinArray->GlobalSiteBGImage;
		$GlobalSiteImageRepeat = $SkinArray->GlobalSiteImageRepeat;
		$GlobalSiteTextColor = $SkinArray->GlobalSiteTextColor;
		$GlobalSiteFontSize = $SkinArray->GlobalSiteFontSize;
		$GlobalSiteBGPosition = $SkinArray->GlobalSiteBGPosition;
		
	
		//BUTTONS
		$ButtonImage= $SkinArray->ButtonImage;
		$ButtonBGColor= $SkinArray->ButtonBGColor;
		$ButtonImageRepeat= $SkinArray->ButtonImageRepeat;
		$ButtonTextColor= $SkinArray->ButtonTextColor;
		$ButtonFontSize= $SkinArray->ButtonFontSize;
		$ButtonFontStyle= $SkinArray->ButtonFontStyle;
		$ButtonFontFamily = $SkinArray->ButtonFontFamily;
		$ButtonAlign = $SkinArray->ButtonAlign;
		$ButtonPaddingArray = explode(' ',$SkinArray->ButtonPadding);
		$ButtonPaddingTop = $ButtonPaddingArray[0];
		$ButtonPaddingRight = $ButtonPaddingArray[1];
		$ButtonPaddingBottom = $ButtonPaddingArray[2];
		$ButtonPaddingLeft = $ButtonPaddingArray[3];
		
		$FirstButtonImage= $SkinArray->FirstButtonImage;
		$FirstButtonRolloverImage= $SkinArray->FirstButtonRolloverImage;
		$FirstButtonBGColor= $SkinArray->FirstButtonBGColor;
		$FirstButtonTextColor= $SkinArray->FirstButtonTextColor;
		
		$NextButtonImage= $SkinArray->NextButtonImage;
		$NextButtonRolloverImage= $SkinArray->NextButtonRolloverImage;
		$NextButtonBGColor= $SkinArray->NextButtonBGColor;
		$NextButtonTextColor= $SkinArray->NextButtonTextColor;
		
		$CommentEvenBGColor = $SkinArray->CommentEvenBGColor;
		$CommentOddBGColor = $SkinArray->CommentOddBGColor;
		
		$BackButtonImage= $SkinArray->BackButtonImage;
		$BackButtonRolloverImage= $SkinArray->BackButtonRolloverImage;
		$BackButtonBGColor= $SkinArray->BackButtonBGColor;
		$BackButtonTextColor= $SkinArray->BackButtonTextColor;
		
		$LatestPageHeader = $SkinArray->LatestPageHeader;
		
		$LastButtonImage= $SkinArray->LastButtonImage;
		$LastButtonRolloverImage= $SkinArray->LastButtonRolloverImage;
		$LastButtonBGColor= $SkinArray->LastButtonBGColor;
		$LastButtonTextColor= $SkinArray->LastButtonTextColor;
		
				
		//CONTENT BOX
		if ($SkinArray->ModTopRightImage != '') 
			$ModTopRightImage= $BaseSkinDir.$SkinArray->ModTopRightImage;
		$ModTopRightBGColor= $SkinArray->ModTopRightBGColor;

		if ($SkinArray->ModTopLeftImage != '') 
			$ModTopLeftImage= $BaseSkinDir.$SkinArray->ModTopLeftImage;
		$ModTopLeftBGColor= $SkinArray->ModTopLeftBGColor;
		
		if ($SkinArray->ModBottomLeftImage != '') 
			$ModBottomLeftImage= $BaseSkinDir.$SkinArray->ModBottomLeftImage;
		$ModBottomLeftBGColor= $SkinArray->ModBottomLeftBGColor;
		
		if ($SkinArray->ModBottomRightImage != '') 
			$ModBottomRightImage= $BaseSkinDir.$SkinArray->ModBottomRightImage;
		$ModBottomRightBGColor= $SkinArray->ModBottomRightBGColor;
		
		if ($SkinArray->ModRightSideImage != '') 
			$ModRightSideImage= $BaseSkinDir.$SkinArray->ModRightSideImage;
		$ModRightSideBGColor= $SkinArray->ModRightSideBGColor;
		
		if ($SkinArray->ModLeftSideImage != '') 
			$ModLeftSideImage= $BaseSkinDir.$SkinArray->ModLeftSideImage;
		$ModLeftSideBGColor= $SkinArray->ModLeftSideBGColor;
		
		if ($SkinArray->ModTopImage != '') 
			$ModTopImage= $BaseSkinDir.$SkinArray->ModTopImage;
		$ModTopBGColor= $SkinArray->ModTopBGColor;
		
		if ($SkinArray->ModBottomImage != '') 
			$ModBottomImage= $BaseSkinDir.$SkinArray->ModBottomImage;
		$ModBottomBGColor= $SkinArray->ModBottomBGColor;
		
		if ($SkinArray->ContentBoxImage != '') 
			$ContentBoxImage= $BaseSkinDir.$SkinArray->ContentBoxImage;
		$ContentBoxBGColor= $SkinArray->ContentBoxBGColor;
		$ContentBoxImageRepeat= $SkinArray->ContentBoxImageRepeat;
		$ContentBoxTextColor= $SkinArray->ContentBoxTextColor;
		$ContentBoxFontSize= $SkinArray->ContentBoxFontSize;
		$Corner= $SkinArray->Corner;
		$ModuleSeparation = $SkinArray->ModuleSeparation;
		$RightColumnWidth = $SkinArray->RightColumnWidth;
		$LeftColumnWidth = $SkinArray->LeftColumnWidth;
		
		//HEADERS
		$GlobalHeaderImage= $SkinArray->GlobalHeaderImage;
		$GlobalHeaderBGColor= $SkinArray->GlobalHeaderBGColor;
		$GlobalHeaderImageRepeat= $SkinArray->GlobalHeaderImageRepeat;
		$GlobalHeaderTextColor= $SkinArray->GlobalHeaderTextColor;
		$GlobalHeaderFontSize= $SkinArray->GlobalHeaderFontSize;
		$GlobalHeaderFontStyle= $SkinArray->GlobalHeaderFontStyle;
		$GlobalHeaderFontStyle= $SkinArray->GlobalHeaderFontStyle;
		$HeaderPlacement = $SkinArray->HeaderPlacement;
		$GlobalHeaderFontFamily = $SkinAarray->GlobalHeaderFontFamily;
		$query = "SELECT GlobalHeaderTextTransformation from template_skins where SkinCode='$SkinCode'";
		$GlobalHeaderTextTransformation =  $db->queryUniqueValue($query);
			
		//PAGE READER
		$ControlBarImage= $SkinArray->ControlBarImage;
		$ControlBarImageRepeat= $SkinArray->ControlBarImageRepeat;
		$ControlBarBGColor= $SkinArray->ControlBarBGColor;
		$ControlBarTextColor= $SkinArray->ControlBarTextColor;
		$ControlBarFontSize = $SkinArray->ControlBarFontSize;
		$ControlBarFontStyle = $SkinArray->ControlBarFontStyle;
		$ReaderButtonBGColor = $SkinArray->ReaderButtonBGColor;
		$ReaderButtonAccentColor = $SkinArray->ReaderButtonAccentColor;
		$PageBGColor = $SkinArray->PageBGColor;
		$NavBarPlacement= $SkinArray->NavBarPlacement;
		$NavBarAlignment= $SkinArray->NavBarAlignment;
		$FlashReaderStyle= $SkinArray->FlashReaderStyle;
		$ReaderBGImage = $SkinArray->ReaderBGImage;
		
		//HotSpot Settings
		$BubbleClose = $SkinArray->BubbleClose;
		$BubbleOpen = $SkinArray->BubbleOpen;
		$HotSpotImage = $SkinArray->HotSpotImage;
		$HotSpotBGColor = $SkinArray->HotSpotBGColor;
		
		//CHARACTERS
		$CharacterReader = $SkinArray->CharacterReader;
		
		$GlobalSiteWidth = $SkinArray->GlobalSiteWidth;
		$KeepWidth= $SkinArray->KeepWidth;
		$GlobalSiteLinkTextColor= $SkinArray->GlobalSiteLinkTextColor;
		$GlobalSiteLinkFontStyle= $SkinArray->GlobalSiteLinkFontStyle;
		$GlobalSiteHoverTextColor= $SkinArray->GlobalSiteHoverTextColor;
		$GlobalSiteHoverFontStyle= $SkinArray->GlobalSiteHoverFontStyle;
		$GlobalSiteVisitedTextColor= $SkinArray->GlobalSiteVisitedTextColor;
		$GlobalSiteVisitedFontStyle= $SkinArray->GlobalSiteVisitedFontStyle;
		
		$GlobalButtonLinkTextColor= $SkinArray->GlobalButtonLinkTextColor;
		$GlobalButtonLinkFontStyle= $SkinArray->GlobalButtonLinkFontStyle;
		$GlobalButtonHoverTextColor= $SkinArray->GlobalButtonHoverTextColor;
		$GlobalButtonHoverFontStyle= $SkinArray->GlobalButtonHoverFontStyle;
		$GlobalButtonVisitedTextColor= $SkinArray->GlobalButtonVisitedTextColor;
		$GlobalButtonVisitedFontStyle= $SkinArray->GlobalButtonVisitedFontStyle;
		
		//if ($_SESSION['username'] == 'matteblack')
			//print_r($SkinArray);
			
			$GlobalTabInActiveBGColor= $SkinArray->GlobalTabInActiveBGColor;
			$GlobalTabInActiveFontStyle= $SkinArray->GlobalTabInActiveFontStyle;
			$GlobalTabInActiveTextColor= $SkinArray->GlobalTabInActiveTextColor;
			$GlobalTabInActiveFontSize= $SkinArray->GlobalTabInActiveFontSize;
			
			$GlobalTabActiveBGColor= $SkinArray->GlobalTabActiveBGColor;
			$GlobalTabActiveFontStyle= $SkinArray->GlobalTabActiveFontStyle;
			$GlobalTabActiveTextColor= $SkinArray->GlobalTabActiveTextColor;
			$GlobalTabActiveFontSize= $SkinArray->GlobalTabActiveFontSize;
			
			$GlobalTabHoverBGColor= $SkinArray->GlobalTabHoverBGColor;
			$GlobalTabHoverFontStyle= $SkinArray->GlobalTabHoverFontStyle;
			$GlobalTabHoverTextColor= $SkinArray->GlobalTabHoverTextColor;
			$GlobalTabHoverFontSize= $SkinArray->GlobalTabHoverFontSize;

			
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

				$query = "select * from comic_settings where ProjectID='$ProjectID'";
			
				$MenuArray = $db->queryUniqueObject($query);
				$MenuOneType = $MenuArray->MenuOneType;
				$MenuOneLayout = $MenuArray->MenuOneLayout;
				$MenuOneCustom = $MenuArray->MenuOneCustom;
				$ProjectTheme = $MenuArray->CurrentTheme;
			   
			   
				
					$menuString = '<div class=\'pagetitleLarge\' style="border-bottom:solid 1px #FF9900; padding-right:10px;">Menu One</div>';
$menuString .= "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td class='sender_name'>TITLE</td><td class='sender_name'>URL</td><td class='sender_name'>LINK TYPE</td><td class='sender_name'>ACTIONS</td></tr><tr><td colspan='4'>&nbsp;</td></tr>";


	if ($MenuOneCustom == 1) {			
$query = "select * from menu_links where ComicID='$ProjectID' and MenuParent=1 ORDER BY Parent, Position ASC";
			$db->query($query);
            $NumLinks = $db->numRows();
		

				while ($line = $db->fetchNextObject()) { 
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
				$menuString.="</td><td class='submenu_blue'>[<a href='#' onclick=\"menulink('edit','".$line->EncryptID."','');\">EDIT</a>]&nbsp;&nbsp;[<a href='#' onclick=\"removeMenuItem('".$line->EncryptID."');\">DELETE</a>]</td></tr>";

	}

} else {

$query = "select * from pf_themes_menus where ThemeID='$ProjectTheme' and MenuParent=1 ORDER BY Parent, Position ASC";
			$db->query($query);
            $NumLinks = $db->numRows();
			

				while ($line = $db->fetchNextObject()) { 
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
				$menuString.="</td><td class='submenu_blue'>[<a href='#' onclick=\"menulink('edit','".$line->EncryptID."','".$ProjectTheme."');\">EDIT</a>]&nbsp;&nbsp;[<a href='#' onclick=\"removeMenuItem('".$line->EncryptID."');\">DELETE</a>]</td></tr>";

	}

}	

$menuString .= "</table>";

			if ($NumLinks == 0) 
				$menuString = 'NO MENU LINKS CREATED YET';


	}
			
		list($TopRightCornerWidth,$TopRightCornerHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModTopRightImage);
		if ($TopRightCornerWidth == '')
			$TopRightCornerWidth = '15';
		
		
		if ($TopRightCornerHeight == '')
			$TopRightCornerHeight = '15';
		
		list($TopLeftCornerWidth,$TopLeftCornerHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModTopLeftImage);
		if ($TopLeftCornerWidth == '')
			$TopLeftCornerWidth = '15';
	
		
		if ($TopLeftCornerHeight == '')
			$TopLeftCornerHeight = '15';
	
		list($BottomRightCornerWidth,$BottomRightCornerHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModBottomRightImage);
		if ($BottomRightCornerWidth == '')
			$BottomRightCornerWidth = '15';
		
		
		if ($BottomRightCornerHeight == '')
			$BottomRightCornerHeight = '15';
		
		list($BottomLeftCornerWidth,$BottomLeftCornerHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModBottomLeftImage);
		if ($BottomLeftCornerWidth == '')
			$BottomLeftCornerWidth = '15';
		
			
		list($LeftSideWidth,$LeftSideHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModLeftSideImage);
		if ($LeftSideWidth == '')
			$LeftSideWidth = $TopLeftCornerWidth;
	
		
		list($RightSideWidth,$RightSideHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModRightSideImage);
		if ($RightSideWidth == '')
			$RightSideWidth = $TopRightCornerWidth;

		
		list($TopImageWidth,$TopImageHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModTopImage);
		
		if ($TopImageHeight == '')
			$TopImageHeight = $TopRightCornerHeight;
		
		list($BottomImageWidth,$BottomImageHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModBottomImage);
		
		if ($BottomImageHeight == '')
			$BottomImageHeight  = $BottomRightCornerHeight;
				$db->close();	
}




?>