<?php 
include_once(CLASSES.'/project.php');
include_once(CLASSES.'/module.php');
include_once(CLASSES.'/content.php');
include_once(CLASSES.'/template.php');
include_once(CLASSES.'/comment.php');
$CurrentDate = date('Y-m-d').' 00:00:00';

$PageID = $_GET['id'];
if ($PageID == "") {
	$PageID = $_POST['id'];
}
if ($PageID == "undefined") {
	$PageID = "";
}

$GetTwitter = 0;

if ($_GET['project'] == 'Insta-Dinner!') 
	header("Location:/Insta-Dinner/");

$Project = new project($ComicName);
	
$ProjectID=$Project->get_projectID();

$PFCOMMON = $_SERVER['DOCUMENT_ROOT'].'/'.$PFDIRECTORY.'/templates/common/includes/';
$User->getInviteStatus($_SESSION['userid'],$ProjectID);
	
$ProjectType = $Project->get_project_type();
$ComicID = $ProjectID;
$_SESSION['viewingproject'] = $ProjectID;
$_SESSION['viewing_project_type'] = $ProjectType ;
$ProjectArray = $Project->get_project_info();
	
//GET PROJECT ADMIN INFO
$AdminUserArray = $Project->get_admin_info();
$AdminUser = $AdminUserArray['Name'];
$AdminEmail = $AdminUserArray['Email'];
$AdminUserID = $AdminUserArray['UserID'];
$IsProProject = $Project->IsProProject;

//GET CREATOR INFO
$CreatorArray = $Project->get_admin_info();

$CreatorName = $CreatorArray['Name'];
$Avatar =$CreatorArray['Avatar'];
$CreatorEmail =$CreatorArray['Email'];
$CreatorID = $CreatorArray['UserID'];
$ComicDir = $ProjectArray['ComicDir'];
$ComicName = $ProjectArray['SafeFolder'];
$InRumble = $ProjectArray['InRumble'];
$InLord = $ProjectArray['InLord'];
$RoundOneRank = $ProjectArray['RoundOneRank'];
$RoundTwoRank = $ProjectArray['RoundTwoRank'];
$RoundThreeRank = $ProjectArray['RoundThreeRank'];
$BaseComicDirectory = '/'.$ProjectArray['ProjectDirectory'].'/'.$ComicDir.'/'.$ComicName.'/';

$Creator = $ProjectArray['Creator'];
$Ranking = $ProjectArray['Ranking'];
$Writer = $ProjectArray['Writer'];
$Artist = $ProjectArray['Artist'];
$Colorist = $ProjectArray['Colorist'];
$Letterist = $ProjectArray['letterist'];
$Synopsis = $ProjectArray['Synopsis'];
$Tags = $ProjectArray['Tags'];
$Genre = $ProjectArray['Genre'];
$ComicFolder = $ProjectArray['ComicFolder'];
$RealComicCreator = $ProjectArray['CreatorID'];
$LatestPage =  $ProjectArray['LatestPage'];
$Character= $ProjectArray['CharacterCount'];
$Downloads= $ProjectArray['DownloadCount'];
$MobileContent= $ProjectArray['MobileCount'];
$TodaysPage=$ProjectArray['TodaysPage'];
$LatestPageThumb=$ProjectArray['LatestPageThumb'];
$RedirectOn = $ProjectArray['redirect'];

if ($RedirectOn != '') 
	header("Location:".$RedirectOn);


$ProjectThumb=$ProjectArray['Thumb'];
$ProjectCover=$ProjectArray['cover'];
$Rating = $ProjectArray['Rating'];
$CreditsString =''; 
$CreditsString.='<div class="infobox" style="padding-left:10px;"><div class="halfspacer"></div>';
	 if ((isset($Creator)) && ($Creator != '')) { 
			$CreditsString.='<div class="infobox"><b>CREATED BY: </b></div><div class="infobox">'.$Creator.'</div><div style="height:5px;"></div>';
	 } 
	
	if (((isset($Writer)) && ($Writer != '')) || ($EpisodeWriter != ''))  { 
			$CreditsString.='<div class="infobox"><b>WRITTEN BY:</b> </div>';
			if ($EpisodeWriter != '') 
						$Writer = $EpisodeWriter;
				
			$CreditsString.='<div class="infobox">'.$Writer.'</div><div style="height:5px;"></div>';
 	}
	
 	if (((isset($Artist))&& ($Artist != ''))|| ($EpisodeArtist != ''))  { 
			$CreditsString.='<div class="infobox"><b>ILLUSTRATED BY:</b> </div>';
			if ($EpisodeArtist != '')
						$Artist= $EpisodeArtist;
					
			$CreditsString.='<div class="infobox">'.$Artist.'</div><div style="height:5px;"></div>';
	} 	
	
	if (((isset($Colorist)) && ($Colorist != ''))|| ($EpisodeColorist != ''))  { 
			$CreditsString.='<div class="infobox"><b>COLORED BY:</b> </div>';
			if ($EpisodeColorist != '')
					$Colorist= $EpisodeColorist;
			$CreditsString.='<div class="infobox">'.$Colorist.'</div><div style="height:5px;"></div>';
	} 

	if (((isset($Letterist))&& ($Letterist != '')) || ($EpisodeLetterer != '')) { 
			$CreditsString.='<div class="infobox"><b>LETTERED BY:</b> </div>';
			if ($EpisodeLetterer != '')
					$Letterist= $EpisodeLetterer;
			$CreditsString.='<div class="infobox">'.$Letterist.'</div><div style="height:5px;"></div>';
	}
	$CreditsString.='</div><div class="spacer"></div>';


$ComicTitle = stripslashes($ProjectArray['Title']);
$SafeFolder = $ProjectArray['SafeFolder'];
$ProjectTitle = $ComicTitle;
$DefaultReader =  $ProjectArray['ReaderType'];
$CopyRight =$ProjectArray['Copyright']; 
		
//INITITALIZE PROJECT SETTINGS
$SettingArray = $Project->get_settings();	
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
$TEMPLATE = $SettingArray->Template;
$ReaderType = $SettingArray->ReaderType;
$SkinCode = $SettingArray->Skin;
$MenuOneLayout = $SettingArray->MenuOneLayout;
$MenuOneType = $SettingArray->MenuOneType;
$MenuOneCustom = $SettingArray->MenuOneCustom;
$CurrentTheme = $SettingArray->CurrentTheme;
$PageDefault = $SettingArray->PageDefault;
$WowioLink = $SettingArray->wowoio_link;

if ($CurrentTheme == '')
	$CurrentTheme = 1;
//BUILD TEMPLATE

//FORCE PRO
if ($ComicName == 'MITH') {
	$_SESSION['IsPro'] = 1;
	$_SESSION['contentwidth'] = '1024';
	$_SESSION['sidebar'] = 'closed';
}

$ProjectTemplate = new template($ProjectID,$CurrentTheme,$SkinCode,$TEMPLATE,$MenuOneCustom);
$NoTemplate = $ProjectTemplate->NoTemplate;

$ProjectTemplate->SetProjectDirectory($BaseComicDirectory);



 
//	if (in_array($_SESSION['userid'],$SiteAdmins)) 
		//echo 'TEMPLATE = ' . print_r($ProjectTemplate).'<br/>';
if ($NoTemplate != 1)
	$NoTemplate = 0;

$ProjectTemplate->setTemplate();
$ContentWidth = $ProjectTemplate->ContentWidth;
if ($ContentWidth == '') {
	if ($_SESSION['IsPro'] == 1)
		$ContentWidth = '1000';
	else
		$ContentWidth = '750';
}



if ($ReaderSection == 'iphone')
	$ContentUrl = 'reader';
//GET CONTENT SECTION 
$ContentSection = new content($ContentUrl, $ProjectID, $SafeFolder,$NoTemplate);
	//if (in_array($_SESSION['userid'],$SiteAdmins)) 
		//echo 'TEMPLATE = ' . print_r($ContentSection).'<br/>';
$ContentSection->setProjectInfo($ProjectArray); 
$SectionArray = $ContentSection->get_content_info();
$ContentSection->setSynopsis($Synopsis);
$ContentSection->SetSiteAdmins($SiteAdmins);
$ContentSection->setCredits($CreditsString);
$ContentSection->setPFDIRECTORY($PFDIRECTORY);
$ContentSection->setProjectBaseDirectoty($BaseComicDirectory);
$ContentSection->setProjectTitle($ProjectTitle);
$ContentSection->setProjectSettings($SettingArray);
$ContentSection->setAdminUser($AdminUserArray);
$ContentSection->setCreatorInfo($CreatorArray);
$ContentSection->setProjectType($ProjectType);
$ContentSection->InRumble = $InRumble;
$ContentSection->InLord = $InLord;
$ContentSection->RoundOneRank = $RoundOneRank;
$ContentSection->RoundTwoRank = $RoundTwoRank;
$ContentSection->RoundThreeRank = $RoundThreeRank;
if (($_SESSION['userid'] == $AdminUserID) || ($_SESSION['userid'] == $CreatorID) )
	$ContentSection->setOwner(1) ;
else
	$ContentSection->setOwner(0) ;

$LastPage = $ContentSection->getLastPage();
$Section = $SectionArray['Section'];

$ContentTemplate = $SectionArray['Template'];
$CustomSection = $SectionArray['CustomSection'];
$CustomSectionContent = $SectionArray['CustomContent'];
$ContentAccess = $SectionArray['AccessType'];
$ProjectTemplate->AccessType = $ContentAccess;
$ProjectTemplate->IsProjectSuperFan = $ContentSection->IsProjectSuperFan;
$ProjectTemplate->IsFollowing = $ContentSection->IsFollowing;

if ($_SESSION['userid'] != ''){
	$query = "SELECT * from user_bookmarks where user_id='".$_SESSION['userid']."' and project_id='".$ProjectID."'";
	$UserBookmark = $InitDB->queryUniqueObject($query);
	if ($UserBookmark->position != '')
		$ContentSection->IsBookMarked = 1;
	else
		$ContentSection->IsBookMarked = 0;
}

if (($_GET['page'] == '') || ($_GET['page'] == 'choice')) {
	
	if ($UserBookmark->position != '') {
		 $Page = $UserBookmark->position;
		 	$ContentSection->IsBookMarked = 1;
		 //$SeriesNum = $UserBookmark->series_num;
		 //$EpisodeNum = $UserBookmark->episode_num;
	//	print 'APGE = ' . $Page.'<br/>';
		//print 'EP = ' . $EpisodeNum.'<br/>';
		//print 'SERIES = ' . $SeriesNum.'<br/>';
	} else {
		 if ($PageDefault == 'latest')
			 $Page = $LastPage;
		else
			$Page = 1;
			
			
	}
} else{
     $Page = $_GET['page'];
}

//GET ALL PAGE INFO
if (($Section == 'Pages') &&(($_SESSION['readerpage'] == 'norm')||($_SESSION['readerpage'] == ''))) {
	
	if (($UserBookmark->series_num != '') && (($_GET['page'] == '') || ($_GET['page'] == 'choice')))
		$SeriesNum = $UserBookmark->series_num;
	else if ($_GET['series'] == '')
		$SeriesNum= 1;
	else if ($_GET['series'] != '')
		$SeriesNum = $_GET['series'];
	
	if (($UserBookmark->episode_num != '') && (($_GET['page'] == '') || ($_GET['page'] == 'choice'))) {
		$EpisodeNum = $UserBookmark->episode_num;
	
	}	else if (($_GET['episode'] == '') && (($_GET['page'] != '') && ($_GET['page'] != 'choice'))){
		$EpisodeNum= 1;
		
	}	else if ($_GET['episode'] != ''){
		$EpisodeNum = $_GET['episode'];
		
	}else {
		$EpisodeNum = '';
		
	}

	
	$ContentSection->setCurrentPosition($Page);
	
	$ContentSection->setMenuSettings($CurrentTheme,$MenuOneCustom,$MenuOneLayout);
	$ContentSection->setPageID($PageID);
	
	$ContentSection->getPages($SeriesNum,$EpisodeNum);
	
	if ($ContentSection->CurrentPageThumb != '')
	$CurrentPageThumb = $ContentSection->CurrentPageThumb;
	$ContentSection->getLikes();
	$PageXP = $ContentSection->PageXP;
	$ArchiveDropDown = $ContentSection->buildArchivesDropdown();
	$HotSpots = $ContentSection->getPageHotspots();
	
$ReaderMenu =  $ProjectTemplate->build_menus($CurrentTheme,$ProjectID,$MenuOneCustom,'horizontal');

	
	
	$PagePeels = $ContentSection->getPagePeels();
	$ReaderPageTitle =  $ContentSection->getPageTitle();

} else if ($Section == 'Blog') {
	$ContentSection->setPageID($_GET['post']);

}

if ($ReaderSection != 'iphone'){
	$ContentSection->setContentWidth($ContentWidth);	
	$ContentArea = $ContentSection->getContentArea($ProjectTemplate->ModuleSeparation,$ProjectTemplate->getModuleSizes(),$ProjectTemplate->HeaderPlacement);
	$TemplateHTML = $ProjectTemplate->insertTemplateContent($ContentArea);
}
if (!$IsIndex) {
//DELETE COMMENT
if ($_POST['deletecomment'] == '1'){
	if (($AdminUserID == $_SESSION['userid']) || ($CreatorID == $_SESSION['userid']) || (in_array($_SESSION['userid'],$SiteAdmins))){
	$Comment = new comment();
	
	if ($Section == 'Blog'){
	
		$Comment->deleteComment($Section,$ProjectID,$_POST['targetid'], $_POST['commentid']);
		?>
		 <script type="text/javascript">
					window.parent.location = 'http://www.wevolt.com/<? echo $SafeFolder;?>/<? echo $ContentUrl;?>/?post=<? echo $_GET['post'];?>';
                    </script>
		
		<? 
	}else{ 
		$Comment->deleteComment($Section,$ProjectID, $_POST['targetid'], $_POST['commentid']);?>
		 <script type="text/javascript">
			window.parent.location = '<? echo $_POST['linkback'];?>';
		 </script>
         
<?  }} else {
if ($Section == 'Blog'){?>
		 <script type="text/javascript">
					window.parent.location = 'http://www.wevolt.com/<? echo $SafeFolder;?>/<? echo $ContentUrl;?>/?post=<? echo $_GET['post'];?>';
                    </script>
				<? }else{ ?>
		 <script type="text/javascript">
			window.parent.location = '<? echo $_POST['linkback'];?>';
		 </script>

<?  }	
	
}}
//INSERT PAGE COMMENT
if (($_POST['insert'] == '1') && ($_SESSION['userid'] != '')){
	$Comment = new comment();
	//if(($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] )) || ($_SESSION['userid'] == '')) {
		//unset($_SESSION['security_code']);
		//setcookie("seccode", "", time()+60*60*24*100, "/");
		if ($_POST['txtFeedback'] == ''){
			$_SESSION['commenterror'] = 'You need to enter a comment';
		} else if (($_SESSION['userid'] == '') && ($_POST['txtName'] == '')){
			$_SESSION['commenterror'] = 'Please enter a name';
		} else {
			if ($_SESSION['userid'] == '')
				$CommentUserID = 'none'; 
			else  
				$CommentUserID = trim($_SESSION['userid']);
			
			$CommentUsername = addslashes($_POST['txtName']);
		
			if ($Section == 'Blog') {
				$Comment->pageComment($Section,$ProjectID, $_POST['targetid'], $CommentUserID, $_POST['txtFeedback'],$CommentUsername,$_POST['postback']);?>
                 <script type="text/javascript">
					window.parent.location = '<? echo $_POST['postback'];?>';
                    </script>
                <?
				
		
			} else {
			
				$Comment->pageComment($Section,$ProjectID, $_POST['targetid'], $CommentUserID, $_POST['txtFeedback'],$CommentUsername,$_POST['postback']);?>
       
                 <script type="text/javascript">
					window.parent.location = '<? echo $_POST['postback'];?>';
                    </script>
		<? }
			
		}
  // } else {
		//$_SESSION['commenterror'] = 'invalid security code. Try Again.';
  // }
}
} else {
	if ($_POST['deletecomment'] == '1'){
			$Comment = new comment();
		$Comment->deleteComment('index',$ProjectID,$_POST['targetid'], $_POST['commentid']);
		?>
		 <script type="text/javascript">
					window.parent.location = 'http://www.wevolt.com/project/<? echo $SafeFolder;?>/?tab=social';
         </script><?
	}
	
	if (($_POST['insert'] == '1') && ($_SESSION['userid'] != '')){
				$Comment = new comment();
				if ($_POST['txtFeedback'] == ''){
					$_SESSION['commenterror'] = 'You need to enter a comment';
				} else {
						$CommentUserID = trim($_SESSION['userid']);
						$CommentUsername = trim($_SESSION['username']);
						$Comment->pageComment('index',$ProjectID, $_POST['targetid'], $CommentUserID, $_POST['txtFeedback'],$CommentUsername,$_POST['postback']);?>
						<script type="text/javascript">
							window.parent.location = 'http://www.wevolt.com/project/<? echo $SafeFolder;?>/?tab=social';
         				</script>
                          <?
			}
	
	}
}
	
?>