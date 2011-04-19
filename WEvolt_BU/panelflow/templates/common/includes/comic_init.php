<?php

if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
	$_SESSION['email'] = $_COOKIE['cookname'];
	$_SESSION['password'] = $_COOKIE['cookpass'];
	$_SESSION['avatar'] = $_COOKIE['cookavatar'];
	$_SESSION['userid'] = $_COOKIE['cookuid'];
	$_SESSION['username'] = $_COOKIE['cookuser']; 
	$_SESSION['security_code'] = $_COOKIE['seccode'];
	$_SESSION['encrypted_email'] = $_COOKIE['cookmd5e'];
	$logresult = @file_get_contents ('https://www.panelflow.com/processing/pfusers.php?action=logincrypt&email='.$_SESSION['email'].'&pass='.$_SESSION['password']);
	 if ((trim($logresult) == 'Not Logged') || (trim($logresult) == 'Not Verified')){
		 session_unset();
		 session_destroy(); 
		 if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
			setcookie("cookname", "", time()-60*60*24*100, "/");
			setcookie("cookpass", "", time()-60*60*24*100, "/");
			setcookie("cookuser", "", time()+60*60*24*100, "/");
			setcookie("cookavatar", "", time()+60*60*24*100, "/");
			setcookie("cookuid", "", time()+60*60*24*100, "/");
			setcookie("seccode", "", time()+60*60*24*100, "/");
			setcookie("cookmd5e","", time()+60*60*24*100, "/");
		}
		
	} 
}
$Version = 'Pro1-6';
$config = array();
$GetTwitter = 0;

//include 'comics/'.$ComicDir.'/'.$ComicName.'/includes/config.php';



$settingsdb = new DB();
$query = "SELECT * from comic_settings where ComicID='$ComicID'";

$SettingArray= $settingsdb->queryUniqueObject($query);
$ContactSetting = $SettingArray->Contact;
$CommentSetting = $SettingArray->AllowComments;
$PublicComments = $SettingArray->AllowPublicComents;
$ArchiveSetting = $SettingArray->ShowArchive;
$CalendarSetting = $SettingArray->ShowCalendar;
$ChapterSetting = $SettingArray->ShowChapter;
$EpisodeSetting = $SettingArray->ShowEpisode;
$Assistant1 = $SettingArray->Assistant1;
$Assistant2 = $SettingArray->Assistant2; 
$Assistant3 = $SettingArray->Assistant3;  
$ShowBio = $SettingArray->BioSetting;
$TEMPLATE = $SettingArray->Template;
$ReaderType = $SettingArray->ReaderType;
$SkinCode = $SettingArray->Skin;
$Copyright = $SettingArray->Copyright;
$HeaderImage = $SettingArray->Header;
$HomepageType = $SettingArray->HomepageType;
$HomepageHTML = stripslashes($SettingArray->HomepageHTML);
$HomepageActive = $SettingArray->HomepageActive;
$MenuOneLayout = $SettingArray->MenuOneLayout;
$MenuOneType = $SettingArray->MenuOneType;
$MenuOneCustom = $SettingArray->MenuOneCustom;
$MenuTwoLayout = $SettingArray->MenuTwoLayout;
$MenuTwoType = $SettingArray->MenuTwoType;
$MenuTwoCustom = $SettingArray->MenuTwoCustom;
$LayoutType = $SettingArray->LayoutType;
$LayoutHTML = stripslashes($SettingArray->LayoutHTML);

$UpdateScheduleArray = explode(',',$SettingArray->UpdateSchedule);
$ScheduleString == '';
$StringSet = 0;
if (in_array('mon',$UpdateScheduleArray)) {
	$ScheduleString .= 'Monday';
	$StringSet = 1;
}

if (in_array('tues',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Tuesday';
	$StringSet = 1;
}

if (in_array('wed',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Wednesday';
	$StringSet = 1;
}

if (in_array('thur',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Thursday';
	$StringSet = 1;
}

if (in_array('fri',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Friday';
	$StringSet = 1;
}

if (in_array('sat',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Saturday';
	$StringSet = 1;
}

if (in_array('sun',$UpdateScheduleArray)) {
	if ($StringSet == 1)
		$ScheduleString .= ', ';
	$ScheduleString .= 'Sunday';
}

if ((!isset($_GET['page'])) && (($Section == 'Pages') || ($Section == 'Extras')))
	$Homepage = 1;
else 
	$Homepage = 0;
	
$query = "SELECT * from adspaces where ComicID='$ComicID' and Template='$TEMPLATE' and Published=1";
$settingsdb->query($query);
$PositionOne = 0;
$PositionTwo = 0;
$PositionThree = 0;
$PositionFour = 0;
$PositionFive = 0;
while ($line = $settingsdb->fetchNextObject()) {  
	 	switch ($line->Position) {
   		 		case 1:
        			$PositionOne = 1;
					$PositionOneAdCode = stripslashes($line->AdCode);
					break;
				case 2:
        			$PositionTwo = 1;
					$PositionTwoAdCode = stripslashes($line->AdCode);
       		 		break;
    			case 3:
        			$PositionThree = 1;
					$PositionThreeAdCode = stripslashes($line->AdCode);
        			break;
				case 4:
        			$PositionFour = 1;
					$PositionFourAdCode = stripslashes($line->AdCode);
        			break;
				case 5:
        			$PositionFive = 1;
					$PositionFiveAdCode = stripslashes($line->AdCode);
        			break;
		}
		
}
$Remote = $_SERVER['REMOTE_ADDR'];
$Referal = urlencode(substr($_SERVER['HTTP_REFERER'],7,strlen($_SERVER['HTTP_REFERER'])-1));
$RemoteID = $_SESSION['userid'];
 
@file_get_contents ('https://www.panelflow.com/processing/updatecomic.php?action=tracking&comicid='.$ComicID.'&page='.$Pagetracking.'&remote='.$Remote.'&id='.$RemoteID.'&l='.$key.'&referal='.$Referal);

$IsPro = @file_get_contents ('https://www.panelflow.com/connectors/checkuser.php?comicid='.$ComicID.'&l='.$key);
 
//$AdBox = @file_get_contents ('https://www.panelflow.com/connectors/getads.php?comicid='.$ComicID.'&server='.$_SERVER['SERVER_NAME'].'&l='.$key);

$query = "select * from comics where comiccrypt = '$ComicID'";
$settingsdb->query($query);
while ($setting = $settingsdb->fetchNextObject()) { 
	$ComicTitle = $setting->title;
	$Creator = $setting->creator;
	$Writer = $setting->writer;
	$Artist = $setting->artist;
	$Colorist = $setting->colorist;
	$Letterist = $setting->letterist;
	$Synopsis = $setting->synopsis;
	$Tags = $setting->tags;
	$Genre = $setting->genre;
	$ComicFolder = $setting->url;
	$RealComicCreator = $setting->CreatorID;
	$SafeFolder = $setting->SafeFolder;
}
$query = "SELECT * from template_skins where SkinCode='$SkinCode'";
$SkinArray= $settingsdb->queryUniqueObject($query);
$BodyStyle = '';
		$GlobalSiteBGColor = $SkinArray->GlobalSiteBGColor; 
		$GlobalSiteBGImage = $SkinArray->GlobalSiteBGImage; 
		$GlobalSiteImageRepeat = $SkinArray->GlobalSiteImageRepeat;
		$GlobalSiteTextColor = $SkinArray->GlobalSiteTextColor;
		$GlobalSiteFontSize = $SkinArray->GlobalSiteFontSize;
		$GlobalSiteWidth = $SkinArray->GlobalSiteWidth;
		$KeepWidth = $SkinArray->KeepWidth;  
		$GlobalSiteLinkTextColor = $SkinArray->GlobalSiteLinkTextColor;  
		$GlobalSiteLinkFontStyle = $SkinArray->GlobalSiteLinkFontStyle;  
		$GlobalSiteHoverTextColor = $SkinArray->GlobalSiteHoverTextColor;  
		$GlobalSiteHoverFontStyle = $SkinArray->GlobalSiteHoverFontStyle;  
		$GlobalSiteVisitedTextColor = $SkinArray->GlobalSiteVisitedTextColor; 
		$GlobalSiteVisitedFontStyle = $SkinArray->GlobalSiteVisitedFontStyle;
		$GlobalButtonLinkTextColor = $SkinArray->GlobalButtonLinkTextColor;  
		$GlobalButtonLinkFontStyle = $SkinArray->GlobalButtonLinkFontStyle;  
		$GlobalButtonHoverTextColor = $SkinArray->GlobalButtonHoverTextColor;  
		$GlobalButtonHoverFontStyle = $SkinArray->GlobalButtonHoverFontStyle;  
		$GlobalButtonVisitedTextColor = $SkinArray->GlobalButtonVisitedTextColor; 
		$GlobalButtonVisitedFontStyle = $SkinArray->GlobalButtonVisitedFontStyle; 
		  
  		//Tab Active
		$GlobalTabActiveBGColor = $SkinArray->GlobalTabActiveBGColor; 
		$GlobalTabActiveFontStyle = $SkinArray->GlobalTabActiveFontStyle;
		$GlobalTabActiveTextColor = $SkinArray->GlobalTabActiveTextColor;
		$GlobalTabActiveFontSize = $SkinArray->GlobalTabActiveFontSize;
		//Tab InActive
		$GlobalTabInActiveBGColor = $SkinArray->GlobalTabInActiveBGColor;
		$GlobalTabInActiveFontStyle = $SkinArray->GlobalTabInActiveFontStyle;
		$GlobalTabInActiveTextColor = $SkinArray->GlobalTabInActiveTextColor;
		$GlobalTabInActiveFontSize = $SkinArray->GlobalTabInActiveFontSize;
		//Tab Hover
		$GlobalTabHoverBGColor = $SkinArray->GlobalTabHoverBGColor;
		$GlobalTabHoverFontStyle = $SkinArray->GlobalTabHoverFontStyle;
		$GlobalTabHoverTextColor = $SkinArray->GlobalTabHoverTextColor;
		$GlobalTabHoverFontSize = $SkinArray->GlobalTabHoverFontSize;
		
		if ($GlobalSiteBGImage != '') {
		$BodyStyle .= 'background-image:url(/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$GlobalSiteBGImage.');';
		$BodyStyle .= 'background-repeat:'.$GlobalSiteImageRepeat.';';
		}
		$BodyStyle .= 'color:#'.$GlobalSiteTextColor.';';
		$BodyStyle .= 'font-size:'.$GlobalSiteFontSize.'px;';
		$BodyStyle .= 'background-color:#'.$GlobalSiteBGColor.';';
	
		//BUTTONS
		$ButtonImage= $SkinArray->ButtonImage;
		$ButtonBGColor= $SkinArray->ButtonBGColor;
		$ButtonImageRepeat= $SkinArray->ButtonImageRepeat;
		$ButtonTextColor= $SkinArray->ButtonTextColor;
		$ButtonFontSize= $SkinArray->ButtonFontSize;
		$ButtonFontStyle= $SkinArray->ButtonFontStyle;
		
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
		
		$LastButtonImage= $SkinArray->LastButtonImage;
		$LastButtonRolloverImage= $SkinArray->LastButtonRolloverImage;
		$LastButtonBGColor= $SkinArray->LastButtonBGColor;
		$LastButtonTextColor= $SkinArray->LastButtonTextColor;
		
		$HomeButtonImage= $SkinArray->HomeButtonImage;  
		$HomeButtonRolloverImage= $SkinArray->HomeButtonRolloverImage;

		$HomeButtonBGColor= $SkinArray->HomeButtonBGColor;
		$HomeButtonTextColor= $SkinArray->HomeButtonTextColor;
		
		$CreatorButtonImage= $SkinArray->CreatorButtonImage;
		$CreatorButtonRolloverImage= $SkinArray->CreatorButtonRolloverImage;
		$CreatorButtonBGColor= $SkinArray->CreatorButtonBGColor;
		$CreatorButtonTextColor= $SkinArray->CreatorButtonTextColor;
		
		$CharactersButtonImage=$SkinArray->CharactersButtonImage;
		$CharactersButtonRolloverImage= $SkinArray->CharactersButtonRolloverImage;
		$CharactersButtonBGColor= $SkinArray->CharactersButtonBGColor;
		$CharactersButtonTextColor= $SkinArray->CharactersButtonTextColor;
		
		$DownloadsButtonImage= $SkinArray->DownloadsButtonImage;
		$DownloadsButtonRolloverImage= $SkinArray->DownloadsButtonRolloverImage;
		$DownloadsButtonBGColor= $SkinArray->DownloadsButtonBGColor;
		$DownloadsButtonTextColor= $SkinArray->DownloadsButtonTextColor;
		
		$ExtrasButtonImage= $SkinArray->ExtrasButtonImage;
		$ExtrasButtonRolloverImage= $SkinArray->ExtrasButtonRolloverImage;
		$ExtrasButtonBGColor= $SkinArray->ExtrasButtonBGColor;
		$ExtrasButtonTextColor= $SkinArray->ExtrasButtonTextColor;
		
		$EpisodesButtonImage= $SkinArray->EpisodesButtonImage;
		$EpisodesButtonRolloverImage= $SkinArray->EpisodesButtonRolloverImage;
		$EpisodesButtonBGColor= $SkinArray->EpisodesButtonBGColor; 
		$EpisodesButtonTextColor= $SkinArray->EpisodesButtonTextColor;
		
		$MobileButtonImage= $SkinArray->MobileButtonImage;
		$MobileButtonRolloverImage= $SkinArray->MobileButtonRolloverImage;
		$MobileButtonBGColor= $SkinArray->MobileButtonBGColor;
		$MobileButtonTextColor= $SkinArray->MobileButtonTextColor;
		
		$ProductsButtonImage= $SkinArray->ProductsButtonImage;
		$ProductsButtonRolloverImage= $SkinArray->ProductsButtonRolloverImage;
		$ProductsButtonBGColor= $SkinArray->ProductsButtonBGColor;
		$ProductsButtonTextColor= $SkinArray->ProductsButtonTextColor;
		
		$CommentButtonImage= $SkinArray->CommentButtonImage;
		$CommentButtonRolloverImage= $SkinArray->CommentButtonRolloverImage;
		$CommentButtonBGColor= $SkinArray->CommentButtonBGColor;
		$CommentButtonTextColor= $SkinArray->CommentButtonTextColor;
		
		$VoteButtonImage= $SkinArray->VoteButtonImage;
		$VoteButtonRolloverImage= $SkinArray->VoteButtonRolloverImage;
		$VoteButtonBGColor= $SkinArray->VoteButtonBGColor;
		$VoteButtonTextColor= $SkinArray->VoteButtonTextColor;
		
		$LogoutButtonImage= $SkinArray->LogoutButtonImage;
		$LogoutButtonRolloverImage= $SkinArray->LogoutButtonRolloverImage;
		$LogoutButtonBGColor= $SkinArray->LogoutButtonBGColor;
		$LogoutButtonTextColor= $SkinArray->LogoutButtonTextColor;
		
		//CONTENT BOX
		$ModTopRightImage= $BaseSkinDir.$SkinArray->ModTopRightImage;
		$ModTopRightBGColor= $SkinArray->ModTopRightBGColor;
		$ModTopLeftImage= $BaseSkinDir.$SkinArray->ModTopLeftImage;
		$ModTopLeftBGColor= $SkinArray->ModTopLeftBGColor;
		$ModBottomLeftImage= $BaseSkinDir.$SkinArray->ModBottomLeftImage;
		$ModBottomLeftBGColor= $SkinArray->ModBottomLeftBGColor;
		$ModBottomRightImage= $BaseSkinDir.$SkinArray->ModBottomRightImage;
		$ModBottomRightBGColor= $SkinArray->ModBottomRightBGColor;
		$ModRightSideImage= $BaseSkinDir.$SkinArray->ModRightSideImage;
		$ModRightSideBGColor= $SkinArray->ModRightSideBGColor;
		$ModLeftSideImage= $BaseSkinDir.$SkinArray->ModLeftSideImage;
		$ModLeftSideBGColor= $SkinArray->ModLeftSideBGColor;
		$ModTopImage= $BaseSkinDir.$SkinArray->ModTopImage; 
		$ModTopBGColor= $SkinArray->ModTopBGColor;
		$ModBottomImage= $BaseSkinDir.$SkinArray->ModBottomImage;
		$ModBottomBGColor= $SkinArray->ModBottomBGColor;
		$ContentBoxImage= $BaseSkinDir.$SkinArray->ContentBoxImage;
		$ContentBoxBGColor= $SkinArray->ContentBoxBGColor;
		$ContentBoxImageRepeat= $SkinArray->ContentBoxImageRepeat; 
		$ContentBoxTextColor= $SkinArray->ContentBoxTextColor;
		$ContentBoxFontSize= $SkinArray->ContentBoxFontSize;
		$ReaderCorner= $SkinArray->Corner;
		if ($ReaderCorner == '') {
			$ReaderCorner = 'round';
		}
		$ModuleSeparation = $SkinArray->ModuleSeparation;
		$RightColumnWidth = $SkinArray->RightColumnWidth;
		$LeftColumnWidth = $SkinArray->LeftColumnWidth;
		$HeaderPlacement = $SkinArray->HeaderPlacement;
		//HEADERS
		$GlobalHeaderImage= $SkinArray->GlobalHeaderImage;
		$GlobalHeaderBGColor= $SkinArray->GlobalHeaderBGColor;
		$GlobalHeaderImageRepeat= $SkinArray->GlobalHeaderImageRepeat; 
		$GlobalHeaderTextColor= $SkinArray->GlobalHeaderTextColor;
		$GlobalHeaderFontSize= $SkinArray->GlobalHeaderFontSize;
		$GlobalHeaderFontStyle= $SkinArray->GlobalHeaderFontStyle;
		 $GlobalHeaderTextTransformation = $SkinArray->GlobalHeaderTextTransformation;
		$FlashReaderStyle= $SkinArray->FlashReaderStyle;
		$NavBarPlacement= $SkinArray->NavBarPlacement; 
		$NavBarAlignment = $SkinArray->NavBarAlignment;
		
		$AuthorCommentImage= $SkinArray->AuthorCommentImage;
		$AuthorCommentBGColor= $SkinArray->AuthorCommentBGColor;
		$AuthorCommentImageRepeat= $SkinArray->AuthorCommentImageRepeat;
		$AuthorCommentTextColor= $SkinArray->AuthorCommentTextColor;
		$AuthorCommentFontSize= $SkinArray->AuthorCommentFontSize;
		$AuthorCommentFontStyle= $SkinArray->AuthorCommentFontStyle;
		
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
		$BarColor = '0x'.$ControlBarBGColor;
		$ControlBarTextColor= $SkinArray->ControlBarTextColor;
		$TextColor = '0x'.$ControlBarTextColor;
		$ControlBarFontSize = $SkinArray->ControlBarFontSize;
		$ControlBarFontStyle = $SkinArray->ControlBarFontStyle;
		$ReaderButtonBGColor = $SkinArray->ReaderButtonBGColor;
		
		$CharacterReader = $SkinArray->CharacterReader;
		
		//Bubble tip Settings
		$BubbleClose = $SkinArray->BubbleClose;
		$BubbleOpen = $SkinArray->BubbleOpen;
		$HotSpotImage = $SkinArray->HotSpotImage; 
		$HotSpotBGColor = $SkinArray->HotSpotBGColor;
		if ($HotSpotImage != '') {
		list($HotSpotWidth,$HotSpotHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->HotSpotImage);
		}else {
			$HotSpotHeight = 5;
			$HotSpotWidth = 5;
		}
		
		if ($ReaderButtonBGColor == '') {
			$ReaderButtonBGColor = 'ffbd72';
		}
		$ButtonColor = '0x'.$ReaderButtonBGColor;
		$ReaderButtonAccentColor = $SkinArray->ReaderButtonAccentColor;
		if ($ReaderButtonAccentColor == '') {
			$ReaderButtonAccentColor = '000000';
		}
		$ArrowColor = '0x'.$ReaderButtonAccentColor;
		if ($SkinArray->PageBGColor == '') {
			$PageBGColor = $BarColor;
		} else {
			$PageBGColor = $SkinArray->PageBGColor; 
		}
		if ($ReaderCorner == 'round') {
			$MovieColor= '0x'.$GlobalSiteBGColor;
		} else {
			$MovieColor= $BarColor;
		}
		
		$BGcolor = $GlobalSiteBGColor;
		$Text = $TextColor; 
		list($CornerWidth,$CornerHeight)=getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ModTopLeftImage);

		if ($ControlBarImage != '') {
			list($ControlWidth,$ControlHeight)=getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$SkinArray->ControlBarImage);
		}
		if ($CornerWidth == '') {
			$CornerWidth = '15';
		}
		
		if ($CornerHeight == '') {
			$CornerHeight = '15';
		}

		$query = "select Avatar from creators where ComicID = '$ComicID'"; 
		$Avatar = $settingsdb->queryUniqueValue($query);
		$query = "select realname from creators where ComicID = '$ComicID'";
		$CreatorName = $settingsdb->queryUniqueValue($query);
		$query = "select Email from creators where ComicID = '$ComicID'";
		$CreatorEmail = $settingsdb->queryUniqueValue($query);

		$LeftColumModuleOrder = array();
		$RightColumModuleOrder = array();
		 if (($Homepage == 1) && ($HomepageActive == 1)) {
		$query = "SELECT * from pf_modules where ComicID='$ComicID' and Homepage=1 and IsPublished=1 and Placement='left' order by Position";
		} else {
		$query = "SELECT * from pf_modules where ComicID='$ComicID' and IsPublished=1 and Homepage=0 and Placement='left' order by Position";
		}
		$settingsdb->query($query);
		while ($line = $settingsdb->fetchNextObject()) {
				$LeftColumModuleOrder[] = $line->ModuleCode;
				if ($line->ModuleCode == 'twitter') {
					$Twittername = $line->CustomVar1;
					if ($Twittername == '')	
						$GetTwitter = 1;
				
				}
				if ($line->ModuleCode == 'custommod') {
					$CustomModuleCode = stripslashes($line->HTMLCode);
				
				}
		}	
		 if (($Homepage == 1) && ($HomepageActive == 1)) {
		$query = "SELECT * from pf_modules where ComicID='$ComicID' and Homepage=1 and IsPublished=1 and Placement='right' order by Position";
		} else {
		$query = "SELECT * from pf_modules where ComicID='$ComicID' and IsPublished=1 and Homepage=0 and Placement='right' order by Position";
		}
		$settingsdb->query($query);
		while ($line = $settingsdb->fetchNextObject()) {
				$RightColumModuleOrder[] = $line->ModuleCode; 
				if ($line->ModuleCode == 'twitter') {
					$Twittername = $line->CustomVar1;
					if ($Twittername == '')	
						$GetTwitter = 1;
				
				}
				
				if ($line->ModuleCode == 'custommod') {
					$CustomModuleCode = stripslashes($line->HTMLCode);
					
				}
		
		}	
			
		 if (($Homepage == 1) && ($HomepageActive == 1) && ($HomepageType == 'custom')) {	
		    $HomeModuleArray = array();		
		 	$query = "SELECT * from pf_modules where ComicID='$ComicID' and IsPublished=1 and Homepage=1";
			$settingsdb->query($query);
				while ($line = $settingsdb->fetchNextObject()) {
					$HomeModuleArray[] = $line->ModuleCode;
			}	
		 
		 
		 } 
		 
		 //GET MENU LINKS
		 $MenuOneLinks = array();
		 $MenuTwoLinks = array();
		
		$query = "SELECT * from menu_links where ComicID='$ComicID' and MenuParent=1 and IsPublished=1 order by Position";
		$settingsdb->query($query);
		while ($line = $settingsdb->fetchNextObject()) {
				$MenuOneLinks[] = array('Url'=>$line->Url, 'Title'=>$line->Title,'ButtonImage'=>$line->ButtonImage,'RolloverImage'=>$line->RolloverButtonImage,'Target'=>$line->Target,'LinkType'=>$line->LinkType);
				
		}	
		
		$query = "SELECT * from menu_links where ComicID='$ComicID' and MenuParent=2 and IsPublished=1 order by Position";
		$settingsdb->query($query);
		while ($line = $settingsdb->fetchNextObject()) {
				$MenuTwoLinks[] = array('Url'=>$line->Url, 'Title'=>$line->Title,'ButtonImage'=>$line->ButtonImage,'RolloverImage'=>$line->RolloverButtonImage,'Target'=>$line->Target,'LinkType'=>$line->LinkType);
				
		}
		// print_r($MenuOneLinks);
		 
if ($GetTwitter == 1) 
	$Twittername = @file_get_contents ('https://www.panelflow.com/connectors/user_info.php?a=twitter&u='.$CreatorID.'&l='.$key);
	
function is_authed()
{

  if (isset($_SESSION['email']) && (md5($_SESSION['email']) == $_SESSION['encrypted_email']))
     {
          return true;
     }
     else
     {
          return false;
     }

}

if (is_authed()) {  
	$loggedin = 1; 
} else {
	$loggedin = 0;
} 

if ($_SESSION['email'] == $AdminEmail){
	 $_SESSION['usertype'] = '1';
} else if (($_SESSION['email'] == $Assistant1)|| ($_SESSION['email'] == $Assistant2) || ($_SESSION['email'] == $Assistant3) || ($_SESSION['email'] == $CreatorEmail)) {
$_SESSION['usertype'] = '2';
$_SESSION['comicassist'] = $ComicID;
} else {
$_SESSION['usertype'] = '0';
}

if ($_SESSION['email'] == "") {
$_SESSION['usertype'] = '0';
} 
$settingsdb->close();
?>