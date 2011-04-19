<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php'); 
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
if ($_GET['a'] != 'create') {

$ComicID = $_POST['txtComic'];
$SkinCode = $_POST['SkinCode'];
$StoryID = $_POST['txtStory'];
$ContentType = $_POST['txtType'];
$SafeFolder = $_POST['txtSafeFolder'];
if ($ContentType == 'story')
	$TargetID = $StoryID;
else
	$TargetID = $ComicID;

if ($_POST['ThemeID'] != '') {

$SkinTable = 'template_skins';

} else {
$SkinTable = 'project_skins';

}

$TemplateCode = $_POST['TemplateCode'];

	
$ColorDefault = 'click here for color';
//After gathering all data from the form then, I created a variable to hold all the data entered by user in string format.
$Description = mysql_escape_string($_POST['txtDescription']);
$Title = mysql_escape_string($_POST['txtTitle']);
$Published =$_POST['txtPublished'];
$Public = $_POST['txtPostCommunity']; 

//SITE
$GlobalSiteBGColor = $_POST['GlobalSiteBGColor'];
$GlobalSiteImageRepeat = $_POST['GlobalSiteImageRepeat'];
$GlobalSiteTextColor = $_POST['GlobalSiteTextColor'];
$GlobalSiteFontSize = $_POST['GlobalSiteFontSize'];
$GlobalSiteWidth = $_POST['TemplateWidth'];
$KeepWidth = $_POST['KeepWidth'];
$GlobalSiteLinkTextColor= $_POST['GlobalSiteLinkTextColor'];
$TemplateWidth = $_POST['TemplateWidth'];

$GlobalSiteLinkFontStyle= $_POST['GlobalSiteLinkFontStyle'];
$GlobalSiteHoverTextColor= $_POST['GlobalSiteHoverTextColor'];
$GlobalSiteHoverFontStyle= $_POST['GlobalSiteHoverFontStyle'];
$GlobalSiteVisitedTextColor= $_POST['GlobalSiteVisitedTextColor'];
$GlobalSiteVisitedFontStyle= $_POST['GlobalSiteVisitedFontStyle'];
$GlobalButtonLinkTextColor= $_POST['GlobalButtonLinkTextColor'];
$GlobalButtonLinkFontStyle= $_POST['GlobalButtonLinkFontStyle'];
$GlobalButtonHoverTextColor= $_POST['GlobalButtonHoverTextColor'];
$GlobalButtonHoverFontStyle= $_POST['GlobalButtonHoverFontStyle'];
$GlobalButtonVisitedTextColor= $_POST['GlobalButtonVisitedTextColor'];
$GlobalButtonVisitedFontStyle= $_POST['GlobalButtonVisitedFontStyle'];

$MobileContentImage= $_POST['MobileContentImage'];
$MobileContentBGColor= $_POST['MobileContentBGColor'];
$MobileContentImageRepeat= $_POST['MobileContentImageRepeat'];
$MobileContentTextColor= $_POST['MobileContentTextColor'];
$MobileContentFontSize= $_POST['MobileContentFontSize'];
$MobileContentFontStyle= $_POST['MobileContentFontStyle'];

$CommentEvenBGColor = $_POST['CommentEvenBGColor'];
$CommentOddBGColor =$_POST['CommentOddBGColor'];
		
$ProductsImage= $_POST['ProductsImage'];
$ProductsBGColor= $_POST['ProductsBGColor'];
$ProductsImageRepeat= $_POST['ProductsImageRepeat'];
$ProductsTextColor= $_POST['ProductsTextColor'];
$ProductsFontSize= $_POST['ProductsFontSize'];
$ProductsFontStyle= $_POST['ProductsFontStyle'];

$GlobalTabInActiveBGColor= $_POST['GlobalTabInActiveBGColor'];
$GlobalTabInActiveFontStyle= $_POST['GlobalTabInActiveFontStyle'];
$GlobalTabInActiveTextColor= $_POST['GlobalTabInActiveTextColor'];
$GlobalTabInActiveFontSize= $_POST['GlobalTabInActiveFontSize'];
			
$GlobalTabActiveBGColor= $_POST['GlobalTabActiveBGColor'];
$GlobalTabActiveFontStyle= $_POST['GlobalTabActiveFontStyle'];
$GlobalTabActiveTextColor= $_POST['GlobalTabActiveTextColor'];
$GlobalTabActiveFontSize= $_POST['GlobalTabActiveFontSize'];
			
$GlobalTabHoverBGColor= $_POST['GlobalTabHoverBGColor'];
$GlobalTabHoverFontStyle= $_POST['GlobalTabHoverFontStyle'];
$GlobalTabHoverTextColor= $_POST['GlobalTabHoverTextColor'];
$GlobalTabHoverFontSize= $_POST['GlobalTabHoverFontSize'];
			
			
			
$LeftColumnWidth = $_POST['LeftColumnWidth'];
$RightColumnWidth = $_POST['RightColumnWidth'];	
		
//BUTTONS
$ButtonBGColor= $_POST['ButtonBGColor'];
if ($ButtonBGcolor == $ColorDefault)
	$ButtonBGcolor = '';
$ButtonImageRepeat= $_POST['ButtonImageRepeat'];
$ButtonTextColor= $_POST['ButtonTextColor'];
if ($ButtonTextColor == $ColorDefault)
	$ButtonTextColor = '';
	
$ButtonFontSize= $_POST['ButtonFontSize'];
$ButtonFontStyle= $_POST['ButtonFontStyle'];
$ButtonFontFamily= $_POST['ButtonFontFamily'];		
$ButtonAlign = $_POST['ButtonAlign'];	
$ButtonPadding = $_POST['ButtonPaddingTop']. ' ' . $_POST['ButtonPaddingRight']. ' ' . $_POST['ButtonPaddingBottom']. ' ' . $_POST['ButtonPaddingLeft'];

$FirstButtonBGColor= $_POST['FirstButtonBGColor'];
if ($FirstButtonBGColor == $ColorDefault)
	$FirstButtonBGColor = '';
	
$FirstButtonTextColor= $_POST['FirstButtonTextColor'];
if ($FirstButtonTextColor == $ColorDefault)
	$FirstButtonTextColor = '';
		

$NextButtonBGColor= $_POST['NextButtonBGColor'];
if ($NextButtonBGColor == $ColorDefault)
	$NextButtonBGColor = '';
$NextButtonTextColor= $_POST['NextButtonTextColor'];
if ($NextButtonTextColor == $ColorDefault)
	$NextButtonTextColor = '';

		$BackButtonBGColor= $_POST['BackButtonBGColor'];
		if ($BackButtonBGColor == $ColorDefault)
			$BackButtonBGColor = '';
		$BackButtonTextColor= $_POST['BackButtonTextColor'];
		if ($BackButtonTextColor == $ColorDefault)
			$BackButtonTextColor = '';
		
		$LastButtonBGColor= $_POST['LastButtonBGColor'];
		if ($LastButtonBGColor == $ColorDefault)
			$LastButtonBGColor = '';
		$LastButtonTextColor= $_POST['LastButtonTextColor'];
		if ($LastButtonTextColor == $ColorDefault)
			$LastButtonTextColor = '';
		
		$HomeButtonBGColor= $_POST['HomeButtonBGColor'];
		if ($HomeButtonBGColor == $ColorDefault)
			$HomeButtonBGColor = '';
		$HomeButtonTextColor= $_POST['HomeButtonTextColor'];
		if ($HomeButtonTextColor == $ColorDefault)
			$HomeButtonTextColor = '';
		
		$CreatorButtonBGColor= $_POST['CreatorButtonBGColor'];
		if ($CreatorButtonBGColor == $ColorDefault)
			$CreatorButtonBGColor = '';
		$CreatorButtonTextColor=$_POST['CreatorButtonTextColor'];
		if ($CreatorButtonTextColor == $ColorDefault)
			$CreatorButtonTextColor = '';
		
		$CharactersButtonBGColor= $_POST['CharactersButtonBGColor'];
		if ($CharactersButtonBGColor == $ColorDefault)
			$CharactersButtonBGColor = '';
		$CharactersButtonTextColor= $_POST['CharactersButtonTextColor'];
		if ($CharactersButtonTextColor == $ColorDefault)
			$CharactersButtonTextColor = '';

		$DownloadsButtonBGColor= $_POST['DownloadsButtonBGColor'];
		if ($DownloadsButtonBGColor == $ColorDefault)
			$DownloadsButtonBGColor = '';
		$DownloadsButtonTextColor= $_POST['DownloadsButtonTextColor'];
		if ($DownloadsButtonTextColor == $ColorDefault)
			$DownloadsButtonTextColor = '';

		$ExtrasButtonBGColor= $_POST['ExtrasButtonBGColor'];
		if ($ExtrasButtonBGColor == $ColorDefault)
			$ExtrasButtonBGColor = '';
		$ExtrasButtonTextColor= $_POST['ExtrasButtonTextColor'];
		if ($ExtrasButtonTextColor == $ColorDefault)
			$ExtrasButtonTextColor = '';

		$EpisodesButtonBGColor= $_POST['EpisodesButtonBGColor'];
		if ($EpisodesButtonBGColor == $ColorDefault)
			$EpisodesButtonBGColor = '';
		$EpisodesButtonTextColor= $_POST['EpisodesButtonTextColor'];
		if ($EpisodesButtonTextColor == $ColorDefault)
			$EpisodesButtonTextColor = '';

		$MobileButtonBGColor= $_POST['MobileButtonBGColor'];
		if ($MobileButtonBGColor == $ColorDefault)
			$MobileButtonBGColor = '';
		$MobileButtonTextColor= $_POST['MobileButtonTextColor'];
		if ($MobileButtonTextColor == $ColorDefault)
			$MobileButtonTextColor = '';

		$ProductsButtonBGColor= $_POST['ProductsButtonBGColor'];
		if ($ProductsButtonBGColor == $ColorDefault)
			$ProductsButtonBGColor = '';
		$ProductsButtonTextColor= $_POST['ProductsButtonTextColor'];
		if ($ProductsButtonTextColor == $ColorDefault)
			$ProductsButtonTextColor = '';

		$CommentButtonBGColor= $_POST['CommentButtonBGColor'];
		if ($CommentButtonBGColor == $ColorDefault)
			$CommentButtonBGColor = '';
		$CommentButtonTextColor= $_POST['CommentButtonTextColor'];
		if ($CommentButtonTextColor == $ColorDefault)
			$CommentButtonTextColor = '';

		$VoteButtonBGColor= $_POST['VoteButtonBGColor'];
		if ($VoteButtonBGColor == $ColorDefault)
			$VoteButtonBGColor = '';
		$VoteButtonTextColor= $_POST['VoteButtonTextColor'];
		if ($VoteButtonTextColor == $ColorDefault)
			$VoteButtonTextColor = '';

		$LogoutButtonBGColor= $_POST['LogoutButtonBGColor'];
		if ($LogoutButtonBGColor == $ColorDefault)
			$LogoutButtonBGColor = '';
		$LogoutButtonTextColor= $_POST['LogoutButtonTextColor'];
		if ($LogoutButtonTextColor == $ColorDefault)
			$LogoutButtonTextColor = '';
		
		//CONTENT BOX
		$ModTopRightBGColor= $_POST['ModTopRightBGColor'];
		if ($ModTopRightBGColor == $ColorDefault)
			$ModTopRightBGColor = '';
		$ModTopLeftBGColor= $_POST['ModTopLeftBGColor'];
		if ($ModTopLeftBGColor == $ColorDefault)
			$ModTopLeftBGColor = '';
		$ModBottomLeftBGColor= $_POST['ModBottomLeftBGColor'];
		if ($ModBottomLeftBGColor == $ColorDefault)
			$ModBottomLeftBGColor = '';
		$ModBottomRightBGColor= $_POST['ModBottomRightBGColor'];
		if ($ModBottomRightBGColor == $ColorDefault)
			$ModBottomRightBGColor = '';
		$ModRightSideBGColor= $_POST['ModRightSideBGColor'];
		if ($ModRightSideBGColor == $ColorDefault)
			$ModRightSideBGColor = '';
		$ModLeftSideBGColor= $_POST['ModLeftSideBGColor'];
		if ($ModLeftSideBGColor == $ColorDefault)
			$ModLeftSideBGColor = '';
		$ModTopBGColor= $_POST['ModTopBGColor'];
		if ($ModTopBGColor == $ColorDefault)
			$ModTopBGColor = '';
		$ModBottomBGColor= $_POST['ModBottomBGColor'];
		if ($ModBottomBGColor == $ColorDefault)
			$ModBottomBGColor = '';
		$ContentBoxBGColor= $_POST['ContentBoxBGColor'];
		if ($ContentBoxBGColor == $ColorDefault)
			$ContentBoxBGColor = '';
		$ContentBoxImageRepeat= $_POST['ContentBoxImageRepeat'];
		$ContentBoxTextColor= $_POST['ContentBoxTextColor'];
		if ($ContentBoxTextColor == $ColorDefault)
			$ContentBoxTextColor = '';
		$ContentBoxFontSize= $_POST['ContentBoxFontSize'];
		$Corner= $_POST['Corner'];
		$HeaderPlacement = $_POST['HeaderPlacement'];
		$ModuleSeparation = $_POST['ModuleSeparation'];	
		
		//HEADERS

		$GlobalHeaderBGColor= $_POST['GlobalHeaderBGColor'];
		if ($GlobalHeaderBGColor == $ColorDefault)
			$GlobalHeaderBGColor = '497ce2';
		$GlobalHeaderImageRepeat= $_POST['GlobalHeaderImageRepeat'];
		$GlobalHeaderTextColor= $_POST['GlobalHeaderTextColor'];
		if ($GlobalHeaderTextColor == $ColorDefault)
			$GlobalHeaderTextColor = '000000';
		$GlobalHeaderFontSize= $_POST['GlobalHeaderFontSize'];
		$GlobalHeaderFontStyle= $_POST['GlobalHeaderFontStyle'];
		$GlobalHeaderFontFamily= $_POST['GlobalHeaderFontFamily'];
		
		$FlashReaderStyle= $_POST['FlashReaderStyle'];
		$NavBarPlacement= $_POST['NavBarPlacement'];
		$NavBarAlignment= $_POST['NavBarAlignment'];
		$GlobalHeaderTextTransformation= $_POST['GlobalHeaderTextTransformation'];
		//LINKS
		$GlobalSiteLinkTextColor= $_POST['GlobalSiteLinkTextColor']; 
		if ($GlobalSiteLinkTextColor == $ColorDefault)
			$GlobalSiteLinkTextColor = '497ce2';
		$GlobalSiteHoverTextColor= $_POST['GlobalSiteHoverTextColor'];
		if ($GlobalSiteHoverTextColor == $ColorDefault)
			$GlobalSiteHoverTextColor = 'FFFFFF';
		$GlobalSiteLinkTextColor= $_POST['GlobalSiteLinkTextColor'];
		if ($GlobalSiteVisitedTextColor == $ColorDefault)
			$GlobalSiteVisitedTextColor = '497ce2';
		$GlobalSiteHoverTextColor= $_POST['GlobalSiteHoverTextColor'];
		if ($GlobalSiteHoverTextColor == $ColorDefault)
			$GlobalSiteHoverTextColor = 'FFFFFF';
		$GlobalButtonLinkTextColor= $_POST['GlobalButtonLinkTextColor'];
		if (($GlobalButtonLinkTextColor == $ColorDefault) || ($GlobalButtonLinkTextColor == ''))
				$GlobalButtonLinkTextColor = $ButtonTextColor;
		$GlobalButtonLinkFontStyle= $_POST['GlobalButtonLinkFontStyle'];
		if ($GlobalButtonLinkFontStyle =='')
				$GlobalButtonLinkFontStyle = $GlobalSiteLinkFontStyle;
		$GlobalButtonHoverTextColor= $_POST['GlobalButtonHoverTextColor'];
		if (($GlobalButtonHoverTextColor == $ColorDefault) || ($GlobalButtonHoverTextColor == ''))
				$GlobalButtonHoverTextColor = $GlobalSiteHoverTextColor;
		$GlobalButtonHoverFontStyle= $_POST['GlobalButtonHoverFontStyle'];
		if ($GlobalButtonHoverFontStyle =='')
				$GlobalButtonHoverFontStyle = $GlobalSiteHoverFontStyle;
		$GlobalButtonVisitedTextColor= $_POST['GlobalButtonVisitedTextColor'];
		if (($GlobalButtonVisitedTextColor == $ColorDefault) || ($GlobalButtonVisitedTextColor == ''))
				$GlobalButtonVisitedTextColor = $GlobalSiteVisitedTextColor;
		$GlobalButtonVisitedFontStyle= $_POST['GlobalButtonVisitedFontStyle'];
		if ($GlobalButtonVisitedFontStyle =='')
			$GlobalButtonVisitedFontStyle = $GlobalSiteVisitedFontStyle;
		$GlobalSiteBGPosition = $_POST['GlobalSiteBGPosition'];
		$AuthorCommentBGColor= $_POST['AuthorCommentBGColor'];
		if ($AuthorCommentBGColor == $ColorDefault)
			$AuthorCommentBGColor = '';
		$AuthorCommentImageRepeat= $_POST['AuthorCommentImageRepeat'];
		$AuthorCommentTextColor= $_POST['AuthorCommentTextColor'];
		if ($AuthorCommentTextColor == $ColorDefault)
			$AuthorCommentTextColor = '';
		$AuthorCommentFontSize= $_POST['AuthorCommentFontSize'];
		$AuthorCommentFontStyle= $_POST['AuthorCommentFontStyle'];
		
		$ComicInfoBGColor= $_POST['ComicInfoBGColor'];
		if ($ComicInfoBGColor == $ColorDefault)
			$ComicInfoBGColor = '';
		$ComicInfoImageRepeat= $_POST['ComicInfoImageRepeat'];
		$ComicInfoTextColor= $_POST['ComicInfoTextColor'];
		if ($ComicInfoTextColor == $ColorDefault)
			$ComicInfoTextColor = '';
		$ComicInfoFontSize= $_POST['ComicInfoFontSize'];
		$ComicInfoFontStyle= $_POST['ComicInfoFontStyle'];
		
		$UserCommentsBGColor= $_POST['UserCommentsBGColor'];
		if ($UserCommentsBGColor == $ColorDefault)
			$UserCommentsBGColor = '';
		$UserCommentsImageRepeat= $_POST['UserCommentsImageRepeat'];
		$UserCommentsTextColor= $_POST['UserCommentsTextColor'];
		if ($UserCommentsTextColor == $ColorDefault)
			$UserCommentsTextColor = '';
		$UserCommentsFontSize= $_POST['UserCommentsFontSize'];
		$UserCommentsFontStyle= $_POST['UserCommentsFontStyle'];
		
		$ComicSynopsisBGColor= $_POST['ComicSynopsisBGColor'];
		if ($ComicSynopsisBGColor == $ColorDefault)
			$ComicSynopsisBGColor = '';
		$ComicSynopsisImageRepeat= $_POST['ComicSynopsisImageRepeat'];
		$ComicSynopsisTextColor= $_POST['ComicSynopsisTextColor'];
		if ($ComicSynopsisTextColor == $ColorDefault)
			$ComicSynopsisTextColor = '';
		$ComicSynopsisFontSize= $_POST['ComicSynopsisFontSize'];
		$ComicSynopsisFontStyle= $_POST['ComicSynopsisFontStyle'];
		
		//PAGE READER
		$ControlBarImageRepeat= $_POST['ControlBarImageRepeat'];
		$ControlBarBGColor= $_POST['ControlBarBGColor'];
		if ($ControlBarBGColor == $ColorDefault)
			$ControlBarBGColor = '';
		$ControlBarTextColor= $_POST['ControlBarTextColor'];
		if ($ControlBarTextColor == $ColorDefault)
			$ControlBarTextColor = '';
		$ControlBarFontSize = $_POST['ControlBarFontSize'];
		$ControlBarFontStyle = $_POST['ControlBarFontStyle'];
		$ReaderButtonBGColor = $_POST['ReaderButtonBGColor'];
		if ($ReaderButtonBGColor == $ColorDefault)
			$ReaderButtonBGColor = '';
		$ReaderButtonAccentColor = $_POST['ReaderButtonAccentColor'];
		if ($ReaderButtonAccentColor == $ColorDefault)
			$ReaderButtonAccentColor = '';
		$PageBGColor = $_POST['PageBGColor'];
		if ($PageBGColor == $ColorDefault)
			$PageBGColor = '';
			
		$PageAreaBGColor = $_POST['PageAreaBGColor'];
		if ($PageAreaBGColor == $ColorDefault)
			$PageAreaBGColor = '';
		
		$PageAreaImageRepeat = $_POST['PageAreaImageRepeat'];
	
		
		$BubbleOpen= $_POST['BubbleOpen'];
		$BubbleClose= $_POST['BubbleClose'];
		$HotSpotBGColor= $_POST['HotSpotBGColor'];
		 //MENU STUFF
		$MenuOneType = $_POST['MenuOneType'];
		$MenuOneLayout = $_POST['MenuOneLayout'];
		$MenuOneCustom = $_POST['txtCustom'];
		$MenuTwoType = $_POST['MenuTwoType'];
		$MenuTwoLayout =$_POST['MenuTwoLayout'];
		$MenuTwoCustom = $_POST['MenuTwoCustom'];
		
		
 $query = "UPDATE $SkinTable SET ".
		  "ControlBarFontStyle='$ControlBarFontStyle'".','.
		  "ControlBarFontSize='$ControlBarFontSize'".','.
		  "ControlBarBGColor='$ControlBarBGColor'".','.
		  "ControlBarTextColor='$ControlBarTextColor'".','.
		  "ControlBarImageRepeat='$ControlBarImageRepeat'".','.
		  "PageBGColor='$PageBGColor'".','.
		  "ReaderButtonBGColor='$ReaderButtonBGColor'".','.
		  "ReaderButtonAccentColor='$ReaderButtonAccentColor'".','.
		  "HeaderPlacement='$HeaderPlacement'".','.
		  "LeftColumnWidth='$LeftColumnWidth'".','.
		  "RightColumnWidth='$RightColumnWidth'".','.
		  "ComicSynopsisFontStyle='$ComicSynopsisFontStyle'".','.
		  "ComicSynopsisFontSize='$ComicSynopsisFontSize'".','.
		  "ComicSynopsisTextColor='$ComicSynopsisTextColor'".','.
		  "ComicSynopsisImageRepeat='$ComicSynopsisImageRepeat'".','.
		  "ComicSynopsisBGColor='$ComicSynopsisBGColor'".','.
		  "UserCommentsFontStyle='$UserCommentsFontStyle'".','.
		  "UserCommentsFontSize='$UserCommentsFontSize'".','.
		  "UserCommentsTextColor='$UserCommentsTextColor'".','.
		  "UserCommentsImageRepeat='$UserCommentsImageRepeat'".','.
		  "UserCommentsBGColor='$UserCommentsBGColor'".','.
		  "ComicInfoFontStyle='$ComicInfoFontStyle'".','.
		  "ComicInfoFontSize='$ComicInfoFontSize'".','.
		  "ComicInfoTextColor='$ComicInfoTextColor'".','.
		  "ComicInfoImageRepeat='$ComicInfoImageRepeat'".','.
		  "ComicInfoBGColor='$ComicInfoBGColor'".','.
		  "AuthorCommentFontStyle='$AuthorCommentFontStyle'".','.
		  "AuthorCommentFontSize='$AuthorCommentFontSize'".','.
		  "AuthorCommentTextColor='$AuthorCommentTextColor'".','.
		  "AuthorCommentImageRepeat='$AuthorCommentImageRepeat'".','.
		  "AuthorCommentBGColor='$AuthorCommentBGColor'".','.
		  "GlobalHeaderFontStyle='$GlobalHeaderFontStyle'".','.
		  "GlobalHeaderBGColor='$GlobalHeaderBGColor'".','.
		  "GlobalHeaderFontSize='$GlobalHeaderFontSize'".','.
		  "GlobalHeaderTextColor='$GlobalHeaderTextColor'".','.
		  "GlobalHeaderImageRepeat='$GlobalHeaderImageRepeat'".','.
		  "ModTopRightBGColor='$ModTopRightBGColor'".','.
		  "ModTopLeftBGColor='$ModTopLeftBGColor'".','.
		  "ModBottomLeftBGColor='$ModBottomLeftBGColor'".','.
		  "ModBottomRightBGColor='$ModBottomRightBGColor'".','.
		  "ModRightSideBGColor='$ModRightSideBGColor'".','.
		  "ModLeftSideBGColor='$ModLeftSideBGColor'".','.
		  "ModTopBGColor='$ModTopBGColor'".','.
		  "ModBottomBGColor='$ModBottomBGColor'".','.
		  "ContentBoxBGColor='$ContentBoxBGColor'".','.
		  "ContentBoxImageRepeat='$ContentBoxImageRepeat'".','.
		  "ContentBoxTextColor='$ContentBoxTextColor'".','.
		  "ContentBoxFontSize='$ContentBoxFontSize'".','.
		  "Corner='$Corner'".','.
		  "Title='$Title'".','.
		  "Published='$Published'".','.
		  "Public='$Public'".','.
		  "Description='$Description'".','.
		  "GlobalSiteBGColor='$GlobalSiteBGColor'".','.
		  "GlobalSiteBGPosition='$GlobalSiteBGPosition'".','.
		  "GlobalSiteImageRepeat='$GlobalSiteImageRepeat'".','.
		  "GlobalSiteTextColor='$GlobalSiteTextColor'".','.
		  "GlobalSiteFontSize='$GlobalSiteFontSize'".','.
		  "GlobalSiteWidth='$GlobalSiteWidth'".','.
		  "KeepWidth='$KeepWidth'".','.
		  "ButtonBGColor='$ButtonBGColor'".','.
		  "ButtonImageRepeat='$ButtonImageRepeat'".','.
		  "ButtonTextColor='$ButtonTextColor'".','.
		  "ButtonFontSize='$ButtonFontSize'".','.
		  "ButtonFontStyle='$ButtonFontStyle'".','.
		  "ButtonFontFamily='$ButtonFontFamily'".','.
		  "ButtonAlign='$ButtonAlign'".','.
		  "ButtonPadding='$ButtonPadding'".','.
		  "FirstButtonBGColor='$FirstButtonBGColor'".','.
		  "FirstButtonTextColor='$FirstButtonTextColor'".','.
		  "NextButtonBGColor='$NextButtonBGColor'".','.
		  "NextButtonTextColor='$NextButtonTextColor'".','.
		  "BackButtonBGColor='$BackButtonBGColor'".','.
		  "BackButtonTextColor='$BackButtonTextColor'".','.
		  "LastButtonBGColor='$LastButtonBGColor'".','.
		  "LastButtonTextColor='$LastButtonTextColor'".','.
		  "HomeButtonBGColor='$HomeButtonBGColor'".','.
		  "HomeButtonTextColor='$HomeButtonTextColor'".','.
		  "CreatorButtonBGColor='$CreatorButtonBGColor'".','.
		  "CreatorButtonTextColor='$CreatorButtonTextColor'".','.
		  "CharactersButtonBGColor='$CharactersButtonBGColor'".','.
		  "CharactersButtonTextColor='$CharactersButtonTextColor'".','.
		  "DownloadsButtonBGColor='$DownloadsButtonBGColor'".','.
		  "DownloadsButtonTextColor='$DownloadsButtonTextColor'".','.
		  "ExtrasButtonBGColor='$ExtrasButtonBGColor'".','.
		  "ExtrasButtonTextColor='$ExtrasButtonTextColor'".','.
		  "EpisodesButtonBGColor='$EpisodesButtonBGColor'".','.
		  "EpisodesButtonTextColor='$EpisodesButtonTextColor'".','.
		  "MobileButtonBGColor='$MobileButtonBGColor'".','.
		  "MobileButtonTextColor='$MobileButtonTextColor'".','.
		  "ProductsButtonBGColor='$ProductsButtonBGColor'".','.
		  "ProductsButtonTextColor='$ProductsButtonTextColor'".','.
		  "CommentButtonBGColor='$CommentButtonBGColor'".','.
		  "CommentButtonTextColor='$CommentButtonTextColor'".','.
		  "VoteButtonBGColor='$VoteButtonBGColor'".','.
		  "VoteButtonTextColor='$VoteButtonTextColor'".','.
		  "LogoutButtonBGColor='$LogoutButtonBGColor'".','.
		  "LogoutButtonTextColor='$LogoutButtonTextColor'".','.
		  "ModuleSeparation='$ModuleSeparation'".', '.
		  "GlobalSiteLinkTextColor='$GlobalSiteLinkTextColor'".', '. 
		  "GlobalSiteLinkFontStyle='$GlobalSiteLinkFontStyle'".', '. 
		  "GlobalSiteHoverTextColor='$GlobalSiteHoverTextColor'".', '. 
		  "GlobalSiteHoverFontStyle='$GlobalSiteHoverFontStyle'".', '. 
		  "GlobalSiteVisitedTextColor='$GlobalSiteVisitedTextColor'".', '. 
		  "GlobalSiteVisitedFontStyle='$GlobalSiteVisitedFontStyle'".', '. 
		  "GlobalButtonLinkTextColor='$GlobalButtonLinkTextColor'".', '. 
		  "GlobalButtonLinkFontStyle='$GlobalButtonLinkFontStyle'".', '. 
		  "GlobalButtonHoverTextColor='$GlobalButtonHoverTextColor'".', '. 
		  "GlobalButtonHoverFontStyle='$GlobalButtonHoverFontStyle'".', '. 
		  "GlobalButtonVisitedTextColor='$GlobalButtonVisitedTextColor'".', '. 
		  "GlobalButtonVisitedFontStyle='$GlobalButtonVisitedFontStyle'".', '.
		  "GlobalTabActiveTextColor='$GlobalTabActiveTextColor'".', '. 
		  "GlobalTabActiveFontStyle='$GlobalTabActiveFontStyle'".', '. 
		  "GlobalTabActiveBGColor='$GlobalTabActiveBGColor'".', '. 
		  "GlobalTabActiveFontSize='$GlobalTabActiveFontSize'".', '.
		  "GlobalTabInActiveTextColor='$GlobalTabInActiveTextColor'".', '. 
		  "GlobalTabInActiveFontStyle='$GlobalTabInActiveFontStyle'".', '. 
		  "GlobalTabInActiveBGColor='$GlobalTabInActiveBGColor'".', '. 
		  "GlobalTabInActiveFontSize='$GlobalTabInActiveFontSize'".', '.  
		  "GlobalTabHoverTextColor='$GlobalTabHoverTextColor'".', '. 
		  "GlobalTabHoverFontStyle='$GlobalTabHoverFontStyle'".', '. 
		  "GlobalTabHoverBGColor='$GlobalTabHoverBGColor'".', '. 
		  "GlobalTabHoverFontSize='$GlobalTabHoverFontSize'".', '.  
		  "FlashReaderStyle='$FlashReaderStyle'".', '.
		   "NavBarAlignment='$NavBarAlignment'".', '.
		  "NavBarPlacement='$NavBarPlacement'".', '. 
		  "GlobalHeaderTextTransformation='$GlobalHeaderTextTransformation'".', '. 
		   "GlobalHeaderFontFamily='$GlobalHeaderFontFamily'".', '. 
		  "CharacterReader='".$_POST['CharacterReader']."'".','.
		  "LeftColumnWidth='$LeftColumnWidth'".', '.
		   "MobileContentBGColor='$MobileContentBGColor'".', '.
		  "MobileContentImageRepeat='$MobileContentImageRepeat'".', '.
		  "MobileContentTextColor='$MobileContentTextColor'".', '.
		  "MobileContentFontSize='$MobileContentFontSize'".', '.
		  "MobileContentFontStyle='$MobileContentFontStyle'".', '.
		  "ProductsBGColor='$ProductsBGColor'".', '.
		  "ProductsImageRepeat='$ProductsImageRepeat'".', '.
		  "ProductsTextColor='$ProductsTextColor'".', '.
		  "ProductsFontSize='$ProductsFontSize'".', '.
		  "ProductsFontStyle='$ProductsFontStyle'".', '.
		  "BubbleClose='$BubbleClose'".', '.
		  "BubbleOpen='$BubbleOpen'".', '.
		  "HotSpotBGColor='$HotSpotBGColor'".', '. 
		  "PageAreaBGColor='$PageAreaBGColor'".', '. 
		  "PageAreaImageRepeat='$PageAreaImageRepeat'".', '. 
		  "PageAreaRound='".$_POST['PageAreaRound']."', ". 
		  "PageAreaPadding='".$_POST['PageAreaPadding']."', ". 
		  "PageAreaCornerRadius='".$_POST['PageAreaCornerRadius']."', ". 
		  "PageAreaWidth='".$_POST['PageAreaWidth']."', ". 
		  "CommentEvenBGColor='$CommentEvenBGColor'".', '. 
		  "CommentOddBGColor='$CommentOddBGColor'".', '. 
		  "RightColumnWidth='$RightColumnWidth' ".
		  "WHERE SkinCode='$SkinCode'";
		$db->execute($query);
		//	if ($_SESSION['username'] == 'matteblack')
		//	print 'QUERY = ' .  $query;
			
		//	print $query.'<br/>';
		if ($ContentType != 'story')
		$query = "UPDATE comic_settings set MenuOneType='$MenuOneType',MenuOneLayout='$MenuOneLayout',
		MenuOneCustom = '$MenuOneCustom',
		MenuTwoType = '$MenuTwoType',
		MenuTwoLayout ='$MenuTwoLayout',
		MenuTwoCustom = '$MenuTwoCustom' where ComicID='$TargetID'";
		else
		$query = "UPDATE story_settings set MenuOneType='$MenuOneType',MenuOneLayout='$MenuOneLayout',
		MenuOneCustom = '$MenuOneCustom',
		MenuTwoType = '$MenuTwoType',
		MenuTwoLayout ='$MenuTwoLayout',
		MenuTwoCustom = '$MenuTwoCustom' where StoryID='$TargetID'";
		$db->execute($query);
		//print $query.'<br/>';
		
		if ($ThemeID != '') 
			$query = "UPDATE templates set TemplateWidth='$TemplateWidth' where TemplateCode='$TemplateCode'";		
		else
			$query = "UPDATE template_settings set TemplateWidth='$TemplateWidth' where TemplateCode='$TemplateCode' and ProjectID='$TargetID'";		
		$db->execute($query);
//print $query.'<br/>';
/*
if ($ContentType != 'story')
$query = "SELECT *  
			FROM comics as c 
			JOIN comic_settings as cs on c.comiccrypt=cs.ComicID 
			JOIN Applications as a on c.AppInstallation=a.ID 
			WHERE c.comiccrypt='$ComicID'";
	else 
	$query = "SELECT *  
			FROM stories as c 
			JOIN story_settings as cs on c.StoryID=cs.StoryID 
			JOIN Applications as a on c.AppInstallation=a.ID 
			WHERE c.StoryID='$TargetID'";
			$SettingArray= $db->queryUniqueObject($query);
			//print $query;
			$AppInstallID= $SettingArray->AppInstallation;
			$ApplicationLink = "http://".$SettingArray->Domain."/".$SettingArray->PFPath;
			$SafeFolder = $SettingArray->SafeFolder;
$ConnectKey = createKey();
$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
$db->execute($query);
///GRAB TEMPLATE INFORMATION
$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 'k' => $ConnectKey, 's' => $SkinCode,'type'=>$ContentType);
$UpdateResult = $curl->send_post_data($ApplicationLink."/connectors/update_skins.php", $post_data);

unset($post_data);
*/


		
if ($_POST['btnsubmit'] == 'SAVE'){ 

 if ($_POST['ThemeID'] != '') {
 	header("location:/cms/admin/?t=themes&section=themes"); 
 } else {
		header("location:/cms/edit/".$SafeFolder."/?tab=design"); 
  }

}else {
	if ($_POST['ThemeID'] != '') {
		 header("location:/cms/admin/?t=themes&sa=edit&themeid=".$_POST['ThemeID']); 
 	} else {

			header("location:/cms/edit/".$SafeFolder."/?tab=design&skincode=".$SkinCode."&section=skins&a=edit");  
	}
}
	
} else if ($_GET['a'] == 'create') {
	$query ="SELECT ID from template_skins WHERE ID=(SELECT MAX(ID) FROM template_skins)";
	$MaxID = $db->queryUniqueValue($query);
	//print 'MY MAX VALUE = ' . $MaxID;
	if ($MaxID > 9) {
		if ($MaxID > 99) {
			if ($MaxID > 999) {
				if ($MaxID > 9999) {
					if ($MaxID > 99999) {
						echo 'Not Able To Add Skin Too Many IDS';
					} else {
						$NewSkinCode = 'PFSK-'.($MaxID+1);
					}
				} else {
					$NewSkinCode = 'PFSK-0'.($MaxID+1);
				}
			} else {
				$NewSkinCode = 'PFSK-00'.($MaxID+1);
				//print 'NewSkinCode' .$NewSkinCode;
			}
		} else {
			$NewSkinCode = 'PFSK-000'.($MaxID+1);
			//print 'NewSkinCode' .$NewSkinCode;
		}
	} else {
	
		$NewSkinCode = 'PFSK-0000'.($MaxID+1);
		//print 'NewSkinCode' .$NewSkinCode;
	}
	
	
	$query = "INSERT into template_skins (Title, Description, SkinCode, UserID) values ".
	"('".mysql_escape_string($_POST['txtTitle'])."',".
	"'".mysql_escape_string($_POST['txtDescription'])."',".
	"'".$NewSkinCode."',".
	"'".$_SESSION['userid']."')";
	$db->execute($query);
	@mkdir('../templates/skins/'.$NewSkinCode);
	@chmod('../templates/skins/'.$NewSkinCode,0777);
	@mkdir('../templates/skins/'.$NewSkinCode.'/images');
	@chmod('../templates/skins/'.$NewSkinCode.'/images',0777);
	$db->close();


  	header("location:/cms/edit/".$SafeFolder."/?tab=design&section=skins&skincode=".$NewSkinCode."&a=edit");

	   
}

?>
