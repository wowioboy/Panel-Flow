<?

if ($Section == 'Links')
$Title = 'Links';

$UpdateBox = '';
if (($TodayBlog == 1) && ($TodayPage == 0) && ($Section == 'Home'))
	$Title = stripslashes($TodayBlogArray->Title);
	
if (($TodayBlog == 1) && ($TodayPage == 0)) {
$UpdateBox .= '<div style="background-image:url(http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/images/blog_update.jpg); background-repeat:none; height:24px;width:142px;padding-left:5px;cursor:pointer;" onclick="window.location=\'/'.$SafeFolder.'/blog/\';"><div class="smspacer"></div>
<span class="smalltext">'.trim($LatestBlog).'</span>

</div><div class="smspacer"></div>
<div style="background-image:url(http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/images/webcomic_update.jpg); background-repeat:none;height:24px;width:142px;padding-left:5px;line-height:14px; cursor:pointer;" onclick="window.location=\'/'.$SafeFolder.'/page/'.$lastpage.'/\';"><div class="smspacer"></div>
<span class="smalltext">'.trim($LatestPage).'</span></div>';
 
} else {
$UpdateBox .= '<div style="background-image:url(http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/images/webcomic_update.jpg); cursor:pointer;background-repeat:none;height:24px;width:142px; padding-left:5px;" onclick="window.location=\'/'.$SafeFolder.'/page/'.$lastpage.'/\';"><div class="smspacer"></div><span class="smalltext">'.$LatestPage.'</span></div>

<div class="smspacer"></div>
<div style="background-image:url(http://www.panelflow.com/comics/'.$ComicDir.'/'.$SafeFolder.'/images/blog_update.jpg); background-repeat:none; height:24px;width:142px;padding-left:5px;cursor:pointer;" onclick="window.location=\'/'.$SafeFolder.'/blog/\';"><div class="smspacer"></div><span class="smalltext">'.trim($LatestBlog).'</span>
</div>';

}




$TemplateWidthBase = str_replace("px",'',$TemplateWidth);
$TemplateWidthBase = intval(str_replace("%",'',$TemplateWidthBase));
/*
if( ($_SESSION['IsPro'] == 0) && ((TemplateWidthBase > 800) || ($TemplateWidth == '100%')|| ($TemplateWidth == '')))  {
	$TemplateWidth = '800px';
} else if (($_SESSION['IsPro'] == 1) && ($TemplateWidth == '100%')|| ($TemplateWidth == ''))  {
$TemplateWidth = '1000px';
}  
$TemplateWidth = 'width:'.$TemplateWidth.'; text-align=center;';
$TemplateHTML=str_replace("{TemplateStyle}",$TemplateWidth,$TemplateHTML);

$TemplateHTML=str_replace("{MenuContent}",$MenuContent,$TemplateHTML);

$TemplateHTML=str_replace("{HeaderStyle}",$HeaderStyle,$TemplateHTML);
$TemplateHTML=str_replace("{HeaderContent}",$HeaderContent,$TemplateHTML);

$TemplateHTML=str_replace("{MenuStyle}",$MenuStyle,$TemplateHTML);

				
$TemplateHTML=str_replace("{ContentStyle}",$ContentStyle,$TemplateHTML);

				
$TemplateHTML=str_replace("{FooterStyle}",$FooterStyle,$TemplateHTML);
$TemplateHTML=str_replace("{FooterContent}",$FooterContent,$TemplateHTML);
*/
if ($CustomSection == 1) {
		$ContentString= $CustomSectionContent;
} else {

	switch($Section) {
		case 'Blog':
		$BlogTemplate=str_replace("{BLOG_SIDEBAR}",$SidebarString,$BlogTemplate);
		$ContentString=str_replace("{BLOG_READER}",$BlogReaderString,$BlogTemplate);
		break;
		
		case 'Links':
		$ContentString=$LinksString;
		break;
		
		case 'Creator':
		$ContentString=$MainCreatorProfileString;
		break;
		
		case 'Downloads':
		$ContentString = $DownloadsString;
		break;
		
		case 'Products':
		$ContentString = $ProductsString;
		break;
		
		case 'Mobile':
		$ContentString = $MobileString;
		break;
		
		case 'Characters':
		$CharactersTemplate=str_replace("{CHARACTER_LIST}",$CharactersPlayerString,$CharactersTemplate);
		$ContentString=str_replace("{CHARACTER_INFO}",$CharactersString,$CharactersTemplate);
		break;
		
		case 'Episodes':
		$ContentString=$EpisodesTemplateString;
		break;
		
		case 'Contact':
		$ContentString=$ContactTemplateString;
		break;
		
		case 'Archives':
		$ContentString=$ArchivesString;
		break;
		
		case 'Home':
		$HomeTemplate ='<table><tr><td valign="top">{COL1}</td><td width="10"></td><td valign="top">{COL2}</td></tr></table>';
		$HomeTemplate=str_replace("{COL1}",$LeftColumnString,$HomeTemplate);
		$ContentString=str_replace("{COL2}",$RightColumnString,$HomeTemplate);
		break;
		
		case 'Gallery':
		$GTemplate ='<table><tr><td valign="top">{SIDEBAR}</td><td width="10"></td><td valign="top">{CONTENT}</td></tr></table>';
		$GTemplate=str_replace("{SIDEBAR}",$GallerySideBarString,$GTemplate);
		$ContentString=str_replace("{CONTENT}",$GalleryContentString,$GTemplate);
		break;
		
	
	
	}

}
$TemplateHTML=str_replace("{ContentContent}",$ContentString,$TemplateHTML);
