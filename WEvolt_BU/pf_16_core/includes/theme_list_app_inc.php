<?
if (($_GET['tab'] == 'design') || ($_GET['t'] == 'themes')) {
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
	 if ($_GET['sa'] == '') {
			$_SESSION['contentpost'] = '';
			if ($_GET['st'] == 'my')
			$query = "SELECT t.*, c.Title as CatTitle 
			          from pf_themes as t
					  join pf_themes_categories as c on t.CategoryID =c.ID
					  where t.UserID ='".$_SESSION['userid']."' order by t.Title";
			else if ($_GET['st'] == 'community')
				$query = "SELECT t.*, c.Title as CatTitle, u.username, u.avatar 
			          from pf_themes as t
					  join pf_themes_categories as c on t.CategoryID =c.ID
					  join users as u on t.UserID=u.encryptid
					  where t.IsPublic ='1' and t.IsPublished='1' order by t.Title";
			else if (($_GET['st'] == 'project') || (($_GET['st'] == '') && ($_GET['t'] != 'themes')))
				$query = "SELECT t.*, c.Title as CatTitle 
			          from pf_themes as t
					  join pf_themes_categories as c on t.CategoryID =c.ID
					  where t.UserID ='".$_SESSION['userid']."' order by t.Title";
				
			else if (($_GET['st'] == 'w3')|| (($_GET['st'] == '') && ($_GET['t'] == 'themes')))
				$query = "SELECT t.*, c.Title as CatTitle, u.username, u.avatar 
			          from pf_themes as t
					  join pf_themes_categories as c on t.CategoryID =c.ID
					  join users as u on t.UserID=u.encryptid
					  where t.IsPublished='1' and t.IsW3='1' order by t.Title";
	
	//$pagination->createPaging($query,$NumItemsPerPage);
	//$PageString = '';
	 $PostString = '';
	
  		 $db->query($query);
		$PageCount = 0;
		$counter = 0;
			$PostString = "<table cellspacing=\"10\"><tr>";
	 while($line=$db->FetchNextObject()) {
	  		$PostString .= '<td><table width="216" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="200" align="center">';
												
				$PostString .= '<table width="100%"><tr>';
			 $PostString .= '<td style="padding-left:5px;" align="center" class="grey_cmsboxcontent" colspan="2">';
			 $PostString .= '<b>'.$line->Title.'</b>';
			 $PostString .= '<div class="spacer"></div>';
			  $PostString .='<div style="border-bottom:dotted 1px #bababa;"></div>';
			  $PostString .= '<div class="spacer"></div>';
			$PostString .= 'Created Date: '.date('m-d-Y',strtotime($line->CreatedDate)).'<div class="spacer"></div>';
			
			if ($_GET['st'] == 'community')
				$PostString .= 'Created by: '.$line->username.'&nbsp;&nbsp;<img src="'.$line->avatar.'" width="25"><div class="spacer"></div>';
			$PostString .= '</td></tr><tr>';
			$PostString .= '<td align="center">';
			
			
			if ($line->UserID == $_SESSION['userid'])
				$PostString .= '<a href="/cms/admin/?t=themes&sa=edit&themeid='.$line->ID.'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a><br/>';
			
			if ($line->IsPublic ==0)
				$PostString .= '<a href="/cms/admin/?t=themes&sa=delete&themeid='.$line->ID.'"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>';
				
				
			$PostString .= '</td>';	
			$PostString .= '<td align="center">';	
			$PostString .= '<a href="javascript:void(0)" onclick="preview_theme(\''.$line->ID.'\',\''.$ProjectID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_preview_btn.jpg" border="0"></a><br/>';
			$PostString .= '<a href="javascript:void(0)" onclick="install_theme(\''.$line->ID.'\',\''.$ProjectID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_use_btn.jpg" border="0"></a>';
			 $PostString .= '</td></tr>';	
			$PostString .= '</table>';
	  
			$PostString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table></td>';
			$PageCount++;
			$counter++;
 			if ($counter == 3){
 				$PostString .= "</tr><tr>";
 				$counter = 0;
 			}

		}
		while (($counter < 3) && ($counter != 0)) {
									$PostString .= "<td></td>";
									$counter++;
									
								}
								$PostString .= "</tr><table>";
	} else if ($_GET['sa'] == 'edit') {
		$query = "SELECT t.*,tp.* 
			          from pf_themes as t
					  join templates as tp on t.TemplateCode=tp.TemplateCode
					  where t.ID='".$_GET['themeid']."'";
					  
		$ThemeArray = $db->queryUniqueObject($query);
		$SkinCode= $ThemeArray->SkinCode;
		$query = "SELECT * from template_skins where SkinCode='$SkinCode'";
		$SkinArray =  $db->queryUniqueObject($query);
		$TemplateCode = $ThemeArray->TemplateCode;
	//	print $query;
		$BaseSkinDir = '/templates/skins/'.$SkinCode.'/images/';
		
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
		$AuthorCommentImage= $SkinArray->AuthorCommentImage;
		$AuthorCommentBGColor= $SkinArray->AuthorCommentBGColor;
		$AuthorCommentImageRepeat= $SkinArray->AuthorCommentImageRepeat;
		$AuthorCommentTextColor= $SkinArray->AuthorCommentTextColor;
		$AuthorCommentFontSize= $SkinArray->AuthorCommentFontSize;
		$AuthorCommentFontStyle= $SkinArray->AuthorCommentFontStyle;
		
		$ComicInfoImage= $SkinArray->ComicInfoImage;
		$ComicInfoBGColor= $SkinArray->ComicInfoBGColor;
		$ComicInfoImageRepeat= $SkinArray->ComicInfoImageRepeat;
		$ComicInfoTextColor= $SkinArray->ComicInfoTextColor;
		$ComicInfoFontSize= $SkinArray->ComicInfoFontSize;
		$ComicInfoFontStyle= $SkinArray->ComicInfoFontStyle;
		
		$UserCommentsImage= $SkinArray->UserCommentsImage;
		$UserCommentsBGColor= $SkinArray->UserCommentsBGColor;
		$UserCommentsImageRepeat= $SkinArray->UserCommentsImageRepeat;
		$UserCommentsTextColor= $SkinArray->UserCommentsTextColor;
		$UserCommentsFontSize= $SkinArray->UserCommentsFontSize;
		$UserCommentsFontStyle= $SkinArray->UserCommentsFontStyle;
		
		$MobileContentImage= $SkinArray->MobileContentImage;
		$MobileContentBGColor= $SkinArray->MobileContentBGColor;
		$MobileContentImageRepeat= $SkinArray->MobileContentImageRepeat;
		$MobileContentTextColor= $SkinArray->MobileContentTextColor;
		$MobileContentFontSize= $SkinArray->MobileContentFontSize;
		$MobileContentFontStyle= $SkinArray->MobileContentFontStyle;
		
		$ProductsImage= $SkinArray->ProductsImage;
		$ProductsBGColor= $SkinArray->ProductsBGColor;
		$ProductsImageRepeat= $SkinArray->ProductsImageRepeat;
		$ProductsTextColor= $SkinArray->ProductsTextColor;
		$ProductsFontSize= $SkinArray->ProductsFontSize;
		$ProductsFontStyle= $SkinArray->ProductsFontStyle;
		
		$ComicSynopsisImage= $SkinArray->ComicSynopsisImage;
		$ComicSynopsisBGColor= $SkinArray->ComicSynopsisBGColor;
		$ComicSynopsisImageRepeat= $SkinArray->ComicSynopsisImageRepeat;
		$ComicSynopsisTextColor= $SkinArray->ComicSynopsisTextColor;
		$ComicSynopsisFontSize= $SkinArray->ComicSynopsisFontSize;
		$ComicSynopsisFontStyle= $SkinArray->ComicSynopsisFontStyle;
		
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
			list($CornerWidth,$CornerHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModTopRightImage);
		if ($CornerWidth == '') {
			$CornerWidth = '15';
		}
		
		if ($CornerHeight == '') {
			$CornerHeight = '15';
		}	
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

			$query = "select * from pf_themes_menus where ThemeID='".$_GET['themeid']."' and MenuParent=1 ORDER BY Parent, Position ASC";
			$db->query($query);
            $NumLinks = $db->numRows();
			
				$menuString = '<div class=\'pagetitleLarge\' style="border-bottom:solid 1px #FF9900; padding-right:10px;">Menu One</div>';
$menuString .= "<table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td class='sender_name'>TITLE</td><td class='sender_name'>URL</td><td class='sender_name'>LINK TYPE</td><td class='sender_name'>ACTIONS</td></tr><tr><td colspan='4'>&nbsp;</td></tr>";
				while ($line = $db->fetchNextObject()) { 
					$menuString .= "<tr><td class='messageinfo'>";
					if ($line->ButtonImage != '') 
						$menuString .= "<img src='/themes/".$_GET['themeid']."/images/".$line->ButtonImage."'>";
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
				$menuString.="</td><td class='submenu_blue'>[<a href='#' onclick=\"menulink('edit','".$line->EncryptID."','".$_GET['themeid']."');\">EDIT</a>]&nbsp;&nbsp;[<a href='#' onclick=\"removeMenuItem('".$line->	EncryptID."');\">DELETE</a>]</td></tr>";

			}

			$menuString .= "</table>";
			

			if ($NumLinks == 0) 
				$menuString = 'NO MENU LINKS CREATED YET';
		
	} else if ($_GET['sa'] == 'delete') {
		$query = "DELETE from pf_themes where ID='".$_GET['themeid']."'";
			$db->execute($query);
			if ($ProjectID != '')
				header("Location:/cms/edit/".$SafeFolder."/?tab=design&section=themes");
			else 
				header("Location:/cms/admin/?t=themes");
	} else if (($_GET['sa'] == 'finish') || ($_GET['sa'] == 'save')) {
		
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$Description = mysql_real_escape_string($_POST['txtDescription']);
		$Tags = mysql_real_escape_string($_POST['txtTags']);
		$HTMLCode = mysql_real_escape_string($_SESSION['contentpost']);
		$_SESSION['contentpost'] = '';
		$Template = $_POST['txtTemplate'];
		$CreatedDate = date('Y-m-d h:i:s');

		if ($_GET['sa'] == 'finish') {
			$query = "INSERT into pf_themes (Title,UserID,TemplateCode,CreatedDate, IsPublic, TemplateHTML, CategoryID, Description, Tags) values ('$Title','".$_SESSION['userid']."','$Template','$CreatedDate',0,'$HTMLCode',2,'$Description', '$Tags')";
		//	print $query;
			$db->execute($query);
			$query ="SELECT ID from pf_themes where CreatedDate='$CreatedDate' and UserID='$UserID'";
			$ThemeID = $db->queryUniqueValue($query);

			$query ="SELECT ID from template_skins WHERE ID=(SELECT MAX(ID) FROM template_skins)";
			$MaxID = $db->queryUniqueValue($query);
			
			$query = "SELECT * from templates where TemplateCode='$Template'";
			$TemplateArray = $db->queryUniqueObject($query);
			//print $query.'<br/>';
			//print_r($TemplateArray);
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID);
			@chmod($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID,0777);
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID.'/images');
			@chmod($_SERVER['DOCUMENT_ROOT'].'/themes/'.$ThemeID.'/images',0777);
			$query = "INSERT into template_settings (ThemeID, TemplateCode, TemplateWidth, HeaderImage, HeaderBackground, HeaderBackgroundRepeat, HeaderWidth, HeaderHeight, HeaderContent, HeaderLink, HeaderRollover, HeaderAlign, HeaderVAlign, HeaderPadding, HeaderBackgroundImagePosition, MenuAlign, MenuVAlign, MenuPadding, MenuBackground, MenuBackgroundRepeat, MenuHeight, MenuWidth, MenuContent, MenuBackgroundImagePosition, ContentAlign, ContentVAlign, ContentPadding, ContentBackgroundImagePosition, ContentBackground,ContentBackgroundRepeat, ContentWidth, ContentHeight, ContentScroll, FooterAlign, FooterVAlign, FooterPadding, FooterBackgroundImagePosition, FooterImage, FooterBackground, FooterBackgroundRepeat, FooterWidth, FooterHeight, FooterContent) values ('$ThemeID','$Template',
			'".$TemplateArray->TemplateWidth."', '".$TemplateArray->HeaderImage."', '".$TemplateArray->HeaderBackground."',  '".$TemplateArray->HeaderBackgroundRepeat."', '".$TemplateArray->HeaderWidth."', '".$TemplateArray->HeaderHeight."','".$TemplateArray->HeaderContent."', '".$TemplateArray->HeaderLink."','".$TemplateArray->HeaderRollover."' ,'".$TemplateArray->HeaderAlign."' , '".$TemplateArray->HeaderVAlign."', '".$TemplateArray->HeaderPadding."', '".$TemplateArray->HeaderBackgroundImagePosition."', '".$TemplateArray->MenuAlign."', '".$TemplateArray->MenuVAlign."', '".$TemplateArray->MenuPadding."', '".$TemplateArray->MenuBackground."','".$TemplateArray->MenuBackgroundRepeat."' , '".$TemplateArray->MenuHeight."', '".$TemplateArray->MenuWidth."', '".$TemplateArray->MenuContent."', '".$TemplateArray->MenuBackgroundImagePosition."', '".$TemplateArray->ContentAlign."','".$TemplateArray->ContentVAlign."' , '".$TemplateArray->ContentPadding."', '".$TemplateArray->ContentBackgroundImagePosition."',  '".$TemplateArray->ContentBackground."','".$TemplateArray->ContentBackgroundRepeat."','".$TemplateArray->ContentWidth."' ,'".$TemplateArray->ContentHeight."' , '".$TemplateArray->ContentScroll."', '".$TemplateArray->FooterAlign."',  '".$TemplateArray->FooterVAlign."', '".$TemplateArray->FooterPadding."' ,'".$TemplateArray->FooterBackgroundImagePosition."'  , '".$TemplateArray->FooterImage."' , '".$TemplateArray->FooterBackground."' , '".$TemplateArray->FooterBackgroundRepeat."',  '".$TemplateArray->FooterWidth."', '".$TemplateArray->FooterHeight."', '".$TemplateArray->FooterContent."')";
			$db->execute($query);
			$query = "INSERT into template_settings_locks (ThemeID, TemplateCode) values ('$ThemeID','$Template')";
			$db->execute($query);
		//print 'MY query = ' . $query;
			if ($MaxID > 9) {
				if ($MaxID > 99) {
					if ($MaxID > 999) {
						if ($MaxID > 9999) {
							if ($MaxID > 99999) {
								if ($MaxID > 999999) {
									echo 'Not Able To Add Skin Too Many IDS';
								} else {
									$NewSkinCode = 'PFSK-'.($MaxID+1);
								}
							} else {
								$NewSkinCode = 'PFSK-0'.($MaxID+1);
							}
						} else {
							$NewSkinCode = 'PFSK-00'.($MaxID+1);
						}
					} else {
						$NewSkinCode = 'PFSK-000'.($MaxID+1);
						//print 'NewSkinCode' .$NewSkinCode;
					}
				} else {
					$NewSkinCode = 'PFSK-0000'.($MaxID+1);
					//print 'NewSkinCode' .$NewSkinCode;
				}
			} else {
			
				$NewSkinCode = 'PFSK-00000'.($MaxID+1);
				//print 'NewSkinCode' .$NewSkinCode;
			}
			

			function COPY_RECURSIVE_DIRS($dirsource, $dirdest) 
			{ // recursive function to copy 
			  // all subdirectories and contents: 
			  if(is_dir($dirsource))$dir_handle=opendir($dirsource); 
				 @mkdir($dirdest, 0777); 
			  while($file=readdir($dir_handle)) 
			  { 
				if($file!="." && $file!="..") 
				{ 
				  if(!is_dir($dirsource."/".$file)) 
					copy ($dirsource."/".$file, $dirdest."/".$file); 
				  else 
						COPY_RECURSIVE_DIRS($dirsource."/".$file, $dirdest."/".$file); 
						
					@chmod ($dirdest."/".$file,0777);	
				  chmod ($dirdest,0777);
				} 
			  } 
			  closedir($dir_handle); 
			  return true; 
			}
			
			
			
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode);
			//print 'DIRECTORY = ' . $_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode;
			@chmod($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode,0777);
			@mkdir($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode.'/images');
			@chmod($_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode.'/images',0777);
			
			$query ="UPDATE pf_themes set SkinCode='$NewSkinCode' where ID='$ThemeID'";
			$db->execute($query);
			
				$query = 'SHOW COLUMNS FROM template_skins;';
				$results = mysql_query($query);

				// Generate the duplication query with those fields except the key
				$query = 'INSERT INTO template_skins(SELECT ';

				while ($row = mysql_fetch_array($results)) {
					if ($row[0] == 'ID') {
						$query .= 'NULL, ';
					} else if ($row[0] == 'Title') {
						$query .= 'NULL, ';
					} else if ($row[0] == 'SkinCode') {
						$query .= 'NULL, ';
					}else if ($row[0] == 'UserID') {
						$query .= 'NULL, ';
					} else {
						$query .= $row[0] . ', ';
					} // END IF
				} // END WHILE
		
				$query = substr($query, 0, strlen($query) - 2);
				$query .= ' FROM template_skins WHERE SkinCode = "PFSK-00001")';
				
				mysql_query($query);
				//print $query.'<br/><br/>';
				$new_id = mysql_insert_id();
				$query = "UPDATE template_skins set Title='".mysql_escape_string($_POST['txtTitle'])."', Description='".mysql_escape_string($_POST['txtDescription'])."',SkinCode='$NewSkinCode', UserID='".$_SESSION['userid']."', ThemeID='$ThemeID' WHERE ID='$new_id'";
				$db->execute($query);
				
			
				//print $query;
				$dirsource = $_SERVER['DOCUMENT_ROOT'].'/templates/skins/PFSK-00001';
				$dirdest = $_SERVER['DOCUMENT_ROOT'].'/templates/skins/'.$NewSkinCode;
				COPY_RECURSIVE_DIRS($dirsource, $dirdest);
				
			
		} else 	if ($_GET['sa'] == 'save') {
			$query = "UPDATE pf_themes set Title='$Title',TemplateCode='$Template',TemplateHTML='$HTMLCode', Description='$Description', Tags='$Tags' where ID='".$_GET['themeid']."' and UserID='".$_SESSION['userid']."'";
			$db->execute($query);
			if ($ProjectID != '')
				header("Location:/cms/edit/".$SafeFolder."/?tab=design");
			else 
				header("Location:/cms/admin/?t=themes");
		
		}
		
	}
	$db->close();
}
?>