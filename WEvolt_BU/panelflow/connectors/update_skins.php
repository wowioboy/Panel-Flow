<?
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
$Completed = 0;
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
if ($ComicID == '') 
	$ComicID= $_GET['c'];
$UserID = $_POST['u'];
if ($UserID == '') 
	$UserID= $_GET['u'];
$SkinCode = $_POST['s']; 
if ($SkinCode == '') 
	$SkinCode= $_GET['s']; 
$Action = $_POST['a'];
if ($Action == '') 
	$Action= $_GET['a'];
$SkinType = $_POST['t'];
if ($SkinType == '') 
	$SkinType= $_GET['t'];
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid']; 
$PFDIRECTORY = $config['pathtopf']; 
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$key = $config['liscensekey'];
$Connect = $_POST['k'];
if ($Connect == '') 
	$Connect= $_GET['k'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'";
$ComicArray = $settings->queryUniqueObject($query);  
$ComicFolder = $ComicArray->url; 

$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {


	if (($Action == 'file')||($Action == 'install')) {
		$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $Connect, 'l'=>$key,'t'=>$SkinType,'s'=>$SkinCode,'a'=>$Action);
		$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_skin_image.php", $post_data);
		unset($post_data);

		if ($updateresult != 'Not Authorized') {
			$values = unserialize ($updateresult); 
			$Image = $values['image']; 
			$ImageNameArray = explode('/',$Image);
			$LocalName = '../templates/skins/'.$SkinCode.'/images/'. $ImageNameArray[5];
			$gif = file_get_contents('http://www.panelflow.com/'.trim($Image)) or die('Could not grab the file');
			$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
			fputs($fp, $gif) or die('Could not write to the file');
			fclose($fp);
			chmod($LocalName,0777); 
			$query = "UPDATE template_skins set ".$SkinType."='".$ImageNameArray[5]."' where SkinCode='$SkinCode'";
			$settings->execute($query);
		} else {
			echo 'Not Authorized';
		}
		
		
	} else if ($Action == 'delete') {
		$base_path = '../templates/skins/'.$SkinCode.'/images/';
		$query = "SELECT $SkinType from template_skins where SkinCode='$SkinCode'";
		$FlaggedImage = $settings->queryUniqueValue($query);
		if ((strpos($SkinType,'Button')) && ($SkinType != 'ButtonImage')) {
			$ButtonName = explode('Image',$SkinType);
			$RollOverImage = $ButtonName[0].'RolloverImage';
			$query = "SELECT $RollOverImage  from template_skins where SkinCode='$SkinCode'";
			$FlaggedRolloverImage = $settings->queryUniqueValue($query);
		}
		$query = "UPDATE template_skins set ".$SkinType."='' where SkinCode='$SkinCode'";
		$settings->execute($query);
		@unlink($base_path.$FlaggedImage);
 
		if ((strpos($SkinType,'Button')) && ($SkinType != 'ButtonImage')) {
			$ButtonName = explode('Image',$SkinType);
			$RollOverImage = $ButtonName[0].'RolloverImage';
			$query = "UPDATE template_skins set ".$RollOverImage."='' where SkinCode='$SkinCode'";
			$settings->query($query);
			@unlink($base_path.$FlaggedRolloverImage);
	
		}
		
	} else {
	
		$post_data = array('u' => $UserID, 'c' => $ComicID, 'k' => $Connect, 'l'=>$key,'s'=>$SkinCode);
		$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/update_skins.php", $post_data);
		unset($post_data);
		echo 'EXPORT RESULT = ' . $updateresult;
		if ($updateresult != 'Not Authorized') { 
			$values = unserialize ($updateresult);
			$Description = mysql_real_escape_string($values['txtDescription']);
			$Title = mysql_real_escape_string($values['txtTitle']);  
			$Published =$values['txtPublished'];
			$Public = $values['txtPostCommunity'];
			$GlobalSiteBGColor = $values['GlobalSiteBGColor'];
			$GlobalSiteImageRepeat = $values['GlobalSiteImageRepeat'];
			$GlobalSiteTextColor = $values['GlobalSiteTextColor'];
			$GlobalSiteFontSize = $values['GlobalSiteFontSize'];
			$GlobalSiteWidth = $values['GlobalSiteWidth'];
			$KeepWidth = $values['KeepWidth'];
			$LeftColumnWidth = $values['LeftColumnWidth'];
			$RightColumnWidth = $values['RightColumnWidth'];
			
			//CHARACTER	
			$CharacterReader = $values['CharacterReader'];
			//BUTTONS
			$ButtonBGColor= $values['ButtonBGColor'];
			$ButtonImageRepeat= $values['ButtonImageRepeat'];
			$ButtonTextColor= $values['ButtonTextColor'];
			$ButtonFontSize= $values['ButtonFontSize']; 
			$ButtonFontStyle= $values['ButtonFontStyle'];
			$FirstButtonBGColor= $values['FirstButtonBGColor'];
			$FirstButtonTextColor= $values['FirstButtonTextColor'];
			$NextButtonBGColor= $values['NextButtonBGColor'];
			$NextButtonTextColor= $values['NextButtonTextColor'];
			$BackButtonBGColor= $values['BackButtonBGColor'];
			$BackButtonTextColor= $values['BackButtonTextColor'];
			$LastButtonBGColor= $values['LastButtonBGColor'];
			$LastButtonTextColor= $values['LastButtonTextColor'];
			$HomeButtonBGColor= $values['HomeButtonBGColor'];
			$HomeButtonTextColor= $values['HomeButtonTextColor'];
			$CreatorButtonBGColor= $values['CreatorButtonBGColor'];
			$CreatorButtonTextColor=$values['CreatorButtonTextColor'];
			$CharactersButtonBGColor= $values['CharactersButtonBGColor'];
			$CharactersButtonTextColor= $values['CharactersButtonTextColor'];
			$BlogButtonBGColor= $values['BlogButtonBGColor'];
			$BlogButtonTextColor= $values['BlogButtonTextColor'];
			$DownloadsButtonBGColor= $values['DownloadsButtonBGColor'];
			$DownloadsButtonTextColor= $values['DownloadsButtonTextColor'];
			$ExtrasButtonBGColor= $values['ExtrasButtonBGColor'];
			$ExtrasButtonTextColor= $values['ExtrasButtonTextColor'];
			$EpisodesButtonBGColor= $values['EpisodesButtonBGColor'];
			$EpisodesButtonTextColor= $values['EpisodesButtonTextColor'];
			$MobileButtonBGColor= $values['MobileButtonBGColor'];
			$MobileButtonTextColor= $values['MobileButtonTextColor'];
			$ProductsButtonBGColor= $values['ProductsButtonBGColor'];
			$ProductsButtonTextColor= $values['ProductsButtonTextColor'];
			$CommentButtonBGColor= $values['CommentButtonBGColor'];
			$CommentButtonTextColor= $values['CommentButtonTextColor'];
			$VoteButtonBGColor= $values['VoteButtonBGColor'];
			$VoteButtonTextColor= $values['VoteButtonTextColor'];
			$LogoutButtonBGColor= $values['LogoutButtonBGColor'];
			$LogoutButtonTextColor= $values['LogoutButtonTextColor'];
			$ModTopRightBGColor= $values['ModTopRightBGColor'];
			$ModTopLeftBGColor= $values['ModTopLeftBGColor'];		
			$ModBottomLeftBGColor= $values['ModBottomLeftBGColor'];		
			$ModBottomRightBGColor= $values['ModBottomRightBGColor'];		
			$ModRightSideBGColor= $values['ModRightSideBGColor'];	
			$ModLeftSideBGColor= $values['ModLeftSideBGColor'];
			$ModTopBGColor= $values['ModTopBGColor'];
			$ModBottomBGColor= $values['ModBottomBGColor'];
			$ContentBoxBGColor= $values['ContentBoxBGColor'];
			$ContentBoxImageRepeat= $values['ContentBoxImageRepeat'];
			$ContentBoxTextColor= $values['ContentBoxTextColor'];
			$ContentBoxFontSize= $values['ContentBoxFontSize'];
			$Corner= $values['Corner'];
			$HeaderPlacement = $values['HeaderPlacement'];
			$ModuleSeparation = $values['ModuleSeparation'];	 
			$GlobalHeaderBGColor= $values['GlobalHeaderBGColor'];
			$GlobalHeaderImageRepeat= $values['GlobalHeaderImageRepeat'];
			$GlobalHeaderTextColor= $values['GlobalHeaderTextColor'];
			$GlobalHeaderFontSize= $values['GlobalHeaderFontSize'];
			$GlobalHeaderFontStyle= $values['GlobalHeaderFontStyle'];
			$AuthorCommentBGColor= $values['AuthorCommentBGColor'];
			$AuthorCommentImageRepeat= $values['AuthorCommentImageRepeat'];
			$AuthorCommentTextColor= $values['AuthorCommentTextColor'];
			$AuthorCommentFontSize= $values['AuthorCommentFontSize'];
			$AuthorCommentFontStyle= $values['AuthorCommentFontStyle'];
			$ComicInfoBGColor= $values['ComicInfoBGColor'];
			$ComicInfoImageRepeat= $values['ComicInfoImageRepeat'];
			$ComicInfoTextColor= $values['ComicInfoTextColor'];
			$ComicInfoFontSize= $values['ComicInfoFontSize'];
			$ComicInfoFontStyle= $values['ComicInfoFontStyle'];
			$UserCommentsBGColor= $values['UserCommentsBGColor'];
			$UserCommentsImageRepeat= $values['UserCommentsImageRepeat'];
			$UserCommentsTextColor= $values['UserCommentsTextColor'];
			$UserCommentsFontSize= $values['UserCommentsFontSize']; 
			$UserCommentsFontStyle= $values['UserCommentsFontStyle'];
			$ComicSynopsisBGColor= $values['ComicSynopsisBGColor'];
			$ComicSynopsisImageRepeat= $values['ComicSynopsisImageRepeat'];
			$ComicSynopsisTextColor= $values['ComicSynopsisTextColor'];
			$ComicSynopsisFontSize= $values['ComicSynopsisFontSize'];
			$ComicSynopsisFontStyle= $values['ComicSynopsisFontStyle'];
			$ControlBarImageRepeat= $values['ControlBarImageRepeat'];
			$ControlBarBGColor= $values['ControlBarBGColor'];
			$ControlBarTextColor= $values['ControlBarTextColor'];
			$ControlBarFontSize = $values['ControlBarFontSize'];
			$ControlBarFontStyle = $values['ControlBarFontStyle'];
			$ReaderButtonBGColor = $values['ReaderButtonBGColor'];
			$ReaderButtonAccentColor = $values['ReaderButtonAccentColor']; 
			$PageBGColor = $values['PageBGColor'];
			$GlobalSiteWidth = $values['GlobalSiteWidth'];
			$KeepWidth= $values['KeepWidth'];
			$GlobalSiteLinkTextColor= $values['GlobalSiteLinkTextColor'];
			$GlobalSiteLinkFontStyle= $values['GlobalSiteLinkFontStyle'];
			$GlobalSiteHoverTextColor= $values['GlobalSiteHoverTextColor'];
			$GlobalSiteHoverFontStyle= $values['GlobalSiteHoverFontStyle'];
			$GlobalSiteVisitedTextColor= $values['GlobalSiteVisitedTextColor'];
			$GlobalSiteVisitedFontStyle= $values['GlobalSiteVisitedFontStyle'];
			$GlobalButtonLinkTextColor= $values['GlobalButtonLinkTextColor'];
			$GlobalButtonLinkFontStyle= $values['GlobalButtonLinkFontStyle'];
			$GlobalButtonHoverTextColor= $values['GlobalButtonHoverTextColor'];
			$GlobalButtonHoverFontStyle= $values['GlobalButtonHoverFontStyle'];
			$GlobalButtonVisitedTextColor= $values['GlobalButtonVisitedTextColor'];
			$GlobalButtonVisitedFontStyle= $values['GlobalButtonVisitedFontStyle'];
			
			$GlobalTabInActiveBGColor= $values['GlobalTabInActiveBGColor'];
			$GlobalTabInActiveFontStyle= $values['GlobalTabInActiveFontStyle'];
			$GlobalTabInActiveTextColor= $values['GlobalTabInActiveTextColor'];
			$GlobalTabInActiveFontSize= $values['GlobalTabInActiveFontSize'];
			
			$GlobalTabActiveBGColor= $values['GlobalTabActiveBGColor'];
			$GlobalTabActiveFontStyle= $values['GlobalTabActiveFontStyle'];
			$GlobalTabActiveTextColor= $values['GlobalTabActiveTextColor'];
			$GlobalTabActiveFontSize= $values['GlobalTabActiveFontSize'];
			
			$GlobalTabHoverBGColor= $values['GlobalTabHoverBGColor'];
			$GlobalTabHoverFontStyle= $values['GlobalTabHoverFontStyle'];
			$GlobalTabHoverTextColor= $values['GlobalTabHoverTextColor'];
			$GlobalTabHoverFontSize= $values['GlobalTabHoverFontSize'];
			
			
			$MobileContentBGColor=$values['MobileContentBGColor'];
		$MobileContentImageRepeat=$values['MobileContentImageRepeat'];
		$MobileContentTextColor=$values['MobileContentTextColor'];
		$MobileContentFontSize=$values['MobileContentFontSize'];
		$MobileContentFontStyle=$values['MobileContentFontStyle'];
		$ProductsBGColor=$values['ProductsBGColor'];
		$ProductsImageRepeat=$values['ProductsImageRepeat'];
		$ProductsTextColor= $values['ProductsTextColor'];
		$ProductsFontSize= $values['ProductsFontSize'];
		$ProductsFontStyle= $values['ProductsFontStyle'];
		$BubbleClose = $values['BubbleClose'];
		$BubbleOpen = $values['BubbleOpen'];
		$HotSpotBGColor = $values['HotSpotBGColor'];
		
		$MenuOneType =$values['MenuOneType'];
		$MenuOneLayout =$values['MenuOneLayout'];
		$MenuOneCustom =$values['MenuOneCustom'];
		$MenuTwoType =$values['MenuTwoType'];
		$MenuTwoLayout =$values['MenuTwoLayout'];
		$MenuTwoCustom=$values['MenuTwoCustom'];
				
		 $GlobalHeaderTextTransformation =$values['GlobalHeaderTextTransformation'];
			$FlashReaderStyle=$values['FlashReaderStyle'];
		$NavBarPlacement=$values['NavBarPlacement'];
			 $NavBarAlignment = $values['NavBarAlignment'];
			 if ($Action == 'assign') { 
			 	$query = "SELECT ID from template_skins where SkinCode='$SkinCode'";
			 	$settings->query($query);
			 	$Found = $settings->numRows();
				if ($Found == 0) {
					$query = "INSERT into template_skins (SkinCode) values ('$SkinCode')";
			 		$settings->execute($query);
					mkdir('../templates/skins/'.$SkinCode);
					chmod('../templates/skins/'.$SkinCode,0777);
					mkdir('../templates/skins/'.$SkinCode.'/images');
					chmod('../templates/skins/'.$SkinCode.'/images',0777);
				}
				$query = "UPDATE comic_settings set Skin='$SkinCode' where ComicID='$ComicID'";
			 	$settings->execute($query);
			 }
			 
 			$query = "UPDATE template_skins SET ".
			"CharacterReader='$CharacterReader'".','.
 		  "PageBGColor='$PageBGColor'".','.
		  "ReaderButtonAccentColor='$ReaderButtonAccentColor'".','.
		  "ReaderButtonBGColor='$ReaderButtonBGColor'".','.
		  "ControlBarFontStyle='$ControlBarFontStyle'".','.
		  "ControlBarFontSize='$ControlBarFontSize'".','.
		  "ControlBarBGColor='$ControlBarBGColor'".','.
		  "ControlBarTextColor='$ControlBarTextColor'".','.
		  "ControlBarImageRepeat='$ControlBarImageRepeat'".','.
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
		  "GlobalHeaderFontSize='$GlobalHeaderFontSize'".','.
		  "GlobalHeaderTextColor='$GlobalHeaderTextColor'".','.
		  "GlobalHeaderImageRepeat='$GlobalHeaderImageRepeat'".','.
		  "GlobalHeaderBGColor='$GlobalHeaderBGColor'".','.
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
		  "BlogButtonBGColor='$BlogButtonBGColor'".','.
		  "BlogButtonTextColor='$BlogButtonTextColor'".','.
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
		  "HeaderPlacement='$HeaderPlacement'".', '.
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
		  "NavBarPlacement='$NavBarPlacement'".', '. 
		  "NavBarAlignment='$NavBarAlignment'".', '. 
		  "GlobalHeaderTextTransformation='$GlobalHeaderTextTransformation'".', '.
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
		  "ProductsFontStyle='$ProductsFontStyle'".', '.
				  
		  "RightColumnWidth='$RightColumnWidth' ".
		  "WHERE SkinCode='$SkinCode'";
		$settings->execute($query);
		print $query.'<br/>';
		$query = "UPDATE comic_settings set MenuOneType='$MenuOneType',MenuOneLayout='$MenuOneLayout',
		MenuOneCustom = '$MenuOneCustom',
		MenuTwoType = '$MenuTwoType',
		MenuTwoLayout ='$MenuTwoLayout',
		MenuTwoCustom = '$MenuTwoCustom' where ComicID='$ComicID'";
		$settings->execute($query);
		print $query.'<br/>';

		$Completed = 1; 
	} else {
		echo 'Not Authorized';
	} 
	
 } 
 	if ($Completed == 1)
  		echo 'I AM Finished';
	else 
		echo 'Did Not Update';
	$settings->close();
} else {
echo 'Can\'t Complete Request';
} 
?>