<?
function CreateNewImgTag($imageTag)
{
	$imageTag_lowercase = strtolower($imageTag);
	$startpos = strpos($imageTag_lowercase, 'src=');
	if ($startpos > 0)
	{
		$containsdoublequot = false;
		$containssinglequot = false;		
		if ($imageTag_lowercase[$startpos + 4] == '"')
			$containsdoublequot = true;
		else if ($imageTag_lowercase[$startpos + 4] == "'")
			$containssinglequot = true;		
		
		if (($containsdoublequot) || ($containssinglequot))
			$startpos += 5;
		else
			$startpos += 4;
		
		if ($containsdoublequot)
			$endpos = strpos($imageTag_lowercase, '"', $startpos);
		else if ($containssinglequot)
			$endpos = strpos($imageTag_lowercase, "'", $startpos);
		else
			$endpos = strpos($imageTag_lowercase, " ", $startpos);
			
		$src = 	substr($imageTag, $startpos, $endpos - $startpos);
	}
	
	$startpos = strpos($imageTag_lowercase, 'alt=');
	if ($startpos > 0)
	{
		$containsdoublequot = false;
		$containssinglequot = false;		
		if ($imageTag_lowercase[$startpos + 4] == '"')
			$containsdoublequot = true;
		else if ($imageTag_lowercase[$startpos + 4] == "'")
			$containssinglequot = true;		
		
		if (($containsdoublequot) || ($containssinglequot))
			$startpos += 5;
		else
			$startpos += 4;
		
		if ($containsdoublequot)
			$endpos = strpos($imageTag_lowercase, '"', $startpos);
		else if ($containssinglequot)
			$endpos = strpos($imageTag_lowercase, "'", $startpos);
		else
			$endpos = strpos($imageTag_lowercase, " ", $startpos);
			
		$alt = 	substr($imageTag, $startpos, $endpos - $startpos);
	}
	
	$httpsrc = strpos($src, 'http://');
	if ($httpsrc === false) 
	{
		$FilenameArray = explode('/',$src);
		$ArrayLength = sizeof($FilenameArray);
		$NewSource = $FilenameArray[$ArrayLength-1];
		$NewPath = 'http://www.panelflow.com/comics/'.$FilenameArray[$ArrayLength-4].'/'.$FilenameArray[$ArrayLength-3].'/'.$FilenameArray[$ArrayLength-2].'/'.$FilenameArray[$ArrayLength-1];
		// this is a realtive path make it correct
		$src = $NewPath;
	}
	
	list($width,$height)=getimagesize($src);
	if ($width > 700)
	{
		$ImageWidth = "width='700'";// need to wrap click img tag
		$wrapper = '<center><a href="'.$src.'" rel="facebox">';
		$endwrapper = '</a></center>';
		$border ="style='border:#000000 1px solid;'";
	} else  {
			$ImageWidth = '';
	}
		
	
	$newImageTag = $wrapper.'<img src="' . $src . '" alt="' . $alt . '" '.$ImageWidth.' '.$border.'/>'.$endwrapper;
	return $newImageTag;
}
function setmodulehtml($Module,$Layout='') {
global $AuthorCommentString, $PageCommentString,$ComicSynopsisString, $LoginModuleString,$CommentBoxString,$UserModuleString,$ComicModuleString,$LinksModuleString, $ProductsModuleString, $MobileModuleString,$HomecomiccreditsString,$HomecomicsynopsisString,$HomeothercreatorcomicsString,$HomecharactersString,$HomestatusString,$HomeepisodesString,$HomelinksboxString,$HomeothercreatorcomicsString,$HomeauthcommString,$TwitterString,$TwitterString,$MenuOneString,$MenuTwoString,$StandardMenuOne,$StandardMenuTwo,$MenuOneLayout,$MenuTwoLayout,$MenuOneCustom,$MenuTwoCustom, $BlogModuleString,$HomedownloadsString,$CustomModuleCode;
 switch ($Module) {
   		 		case 'authcom':
					return $AuthorCommentString;
					break;
				case 'twitter':
					return $TwitterString;
					break;
				case 'pagecom':
					return $PageCommentString;
					break;
    			case 'comicinfo':
					return $ComicModuleString;
					break;
				case 'comicsyn':
					return $ComicSynopsisString;
					break;
				case 'comform':
					return $CommentBoxString;
					break;
				case 'logform':
					return $LoginModuleString;
					break;
				case 'usermod':
					return $UserModuleString;
					break;
				case 'linksbox':
					return $LinksModuleString;
					break;	
				case 'products':
					return $ProductsModuleString;
					break;
				case 'mobile':
					return $MobileModuleString;
					break;	
				case 'comiccredits':
					return $HomecomiccreditsString;
					break;
				case 'comicsynopsis':
					return $HomecomicsynopsisString;
					break;		
				case 'characters':
					return $HomecharactersString;
					break;	
				case 'othercreatorcomics':
					return $HomeothercreatorcomicsString;
					break;	
				case 'episodes':
					return $HomeepisodesString;
					break;	
				case 'status':
					return $HomestatusString;
					break;		
				case 'downloads':
					return $HomedownloadsString;
					break;
				case 'authcomm':
					return $AuthorCommentString;
					break;
				case 'blog':
					return $BlogModuleString;
					break;
				case 'menuone':
					$ReturnString = '';
					if (($MenuOneCustom == 1) && ($MenuOneLayout == $Layout)) 
						$ReturnString .= $MenuOneString;
					else if (($MenuOneCustom == 0) && ($MenuOneLayout == $Layout)) 
						$ReturnString .= $StandardMenuOne;
					return $ReturnString;
					break;
				case 'menutwo':
					$ReturnString = '';
					if (($MenuTwoCustom == 1) && ($MenuTwoLayout == $Layout)) 
						$ReturnString .= $MenuTwoString;
					else if (($MenuTwoCustom == 0) && ($MenuTwoLayout == $Layout)) 
						$ReturnString .= $StandardMenuTwo;
					return $ReturnString;
					break;
					
					case 'custommod':
					return $CustomModuleCode;
					break;
		}

}

function setheader($Module) {
global $AuthorCommentImage, $UserCommentsImage, $ComicInfoImage, $ComicSynopsisImage,$ComicSynopsisTitle,$ComicInfoTitle,$AuthorCommentTitle, $UserCommentsTitle,$LinksBoxTitle,$ProductsTitle, $ProductsImage, $MobileTitle, $MobileImage, $LinksBoxImage, $LinksBoxTitle, $ComicFolder,$TwitterTitle,$CustomModuleCode;
 switch ($Module) {
   		 		case 'authcom':
					$HeaderString = '<div id="AuthorComment">';
					if ($AuthorCommentImage == '') {
						if ($AuthorCommentTitle == '') {
							$HeaderString .='Author Notes';
						} else {
							$HeaderString .=$AuthorCommentTitle;
						}
					}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'authcomm':
					$HeaderString = '<div id="AuthorComment">';
					if ($AuthorCommentImage == '') {
						if ($AuthorCommentTitle == '') {
							$HeaderString .='Author Notes';
						} else {
							$HeaderString .=$AuthorCommentTitle;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'pagecom':
					$HeaderString = '<div id="UserComments">';
					if ($UserCommentsImage == '') {
						if ($UserCommentsTitle == '') {
							$HeaderString .='Comments';
						} else {
							$HeaderString .=$UserCommentsTitle;
						}
						
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
    			case 'comicinfo':
					$HeaderString .= '<div id="ComicInfo">';
					if ($ComicInfoImage == '') {
						if ($ComicInfoTitle == '') {
							$HeaderString .='Comic Info';
						} else {
							$HeaderString .=$ComicInfoTitle;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'comicsyn':
					$HeaderString .= '<div id="ComicSynopsis">';
					if ($ComicSynopsisImage == '') {
						if ($ComicSynopsisTitle == '') {
							$HeaderString .='Synopsis';
						} else {
							$HeaderString .=$ComicSynopsisTitle;
						}
					}
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'linksbox':
					$HeaderString .= '<div id="LinksBox">';

						if ($LinksBoxTitle == '') {
							$HeaderString .='Links';
						} else {
							$HeaderString .=$LinksBoxTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;	
				
				case 'products':
					$HeaderString .= '<div id="Products" class="globalheader">';

						if ($ProductsTitle == '') {
							$HeaderString .='Products';
						} else {
							$HeaderString .=$ProductsTitle;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$ComicFolder."/products/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;	
				
				case 'mobile':
					$HeaderString .= '<div id="Mobile" class="globalheader">';

						if ($MobileTitle == '') {
							$HeaderString .='Mobile';
						} else {
							$HeaderString .=$MobileTitle;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$ComicFolder."/mobile/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
			
				case 'characters':
					$HeaderString .= '<div id="characters" class="globalheader">';

						if ($CharactersTitle == '') {
							$HeaderString .='Characters';
						} else {
							$HeaderString .=$CharactersTitle;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$ComicFolder."/characters/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
				case 'downloads':
					$HeaderString .= '<div id="Downloads" class="globalheader">';

						if ($DownloadsTitle == '') {
							$HeaderString .='Downloads';
						} else {
							$HeaderString .=$DownloadsTitle;
						}
			
					$HeaderString .="&nbsp;&nbsp;[<span class='pagelinks'><a href='/".$ComicFolder."/downloads/' >SEE MORE</a></span>]</div>";
					return $HeaderString;
					break;
				case 'othercreatorcomics':
					$HeaderString .= '<div id="Comics" class="globalheader">';

						if ($OtherComicsTitle == '') {
							$HeaderString .='Creator\'s Comics';
						} else {
							$HeaderString .=$OtherComicsTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'comicsynopsis':
					$HeaderString .= '<div id="Synopsis" class="globalheader">';

						if ($SynopsisTitle == '') {
							$HeaderString .='Synopsis';
						} else {
							$HeaderString .=$SynopsisTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
				case 'status':
					$HeaderString .= '<div id="Status" class="globalheader">';

						if ($StatusTitle == '') {
							$HeaderString .='Status';
						} else {
							$HeaderString .=$StatusTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'comiccredits':
					$HeaderString .= '<div id="ComicCredits" class="globalheader">';

						if ($CreditsTitle == '') {
							$HeaderString .='Credits';
						} else {
							$HeaderString .=$CreditsTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				case 'episodes':
					$HeaderString .= '<div id="Episodes" class="globalheader">';

						if ($EpisodesTitle == '') {
							$HeaderString .='Episodes';
						} else {
							$HeaderString .=$EpisodesTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
					case 'twitter':
					$HeaderString .= '<div id="Twitter" class="globalheader">';

						if ($TwitterTitle == '') {
							$HeaderString .='Twitter Updates';
						} else {
							$HeaderString .=$TwitterTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					case 'blog':
					$HeaderString .= '<div class="globalheader">';

						if ($BlogTitle == '') {
							$HeaderString .='Recent Blog Posts <span class="pagelinks">[<a href="/'.$ComicFolder.'/blog/">read blog</a>]';
						} else {
							$HeaderString .=$BlogTitle;
						}
			
					$HeaderString .='</div>';
					return $HeaderString;
					break;
					
				
					
		}

}


function build_template ($Html, $Section) {
global $AuthorCommentString, $PageCommentString,$ComicSynopsisString, $LoginModuleString,$CommentBoxString,$UserModuleString,$ComicModuleString,$LinksModuleString, $ProductsModuleString, $MobileModuleString,$HomecomiccreditsString,$HomecomicsynopsisString,$HomeothercreatorcomicsString,$HomecharactersString,$HomestatusString,$HomeepisodesString,$HomelinksboxString,$HomeothercreatorcomicsString,$HomeauthcommString,$TwitterString,$MenuOneString,$MenuTwoString,$StandardMenuOne,$StandardMenuTwo,$MenuOneLayout,$MenuTwoLayout,$MenuOneCustom,$MenuTwoCustom, $BlogModuleString,$PreloaderString, $MenuOneString, $MenuTwoString,$PositionFiveAdCode,$PositionOneAdCode,$PositionTwoAdCode,$PositionThreeAdCode,$PositionFourAdCode,$PageReader,$UpdateBox,$NextPage,$PrevPage,$lastpage,$ComicFolder,$BlogReaderString,$MainCreatorProfileString,$DownloadsString, $ProductsString,$MobileString,$CharactersPlayerString,$CharactersString,$EpisodesTemplateString,$ContactTemplateString,$SidebarString,$HomedownloadsString,$ArchivesString,$CustomModuleCode,$LinksString;

$ModuleTop = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" valign="top">';
$ModuleBottom = '</td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table>';

$String = $Html;
if (($Section == 'Pages') || ($Section == 'Extras'))
	$String=str_replace("{content}",$PageReader,$String);
else if ($Section == 'Products')
	$String=str_replace("{content}",$ProductsString,$String);
else if ($Section == 'Mobile')
	$String=str_replace("{content}",$MobileString,$String);
else if ($Section == 'Downloads')
	$String=str_replace("{content}",$DownloadsString,$String);
else if ($Section == 'Creator')
	$String=str_replace("{content}",$MainCreatorProfileString,$String);	
else if ($Section == 'Episodes')
	$String=str_replace("{content}",$EpisodesTemplateString,$String);
else if ($Section == 'Contact')
	$String=str_replace("{content}",$ContactTemplateString,$String);
else if ($Section == 'Characters')
	$String=str_replace("{content}",$CharactersString.$CharactersPlayerString,$String);		
else if ($Section == 'Blog')
	$String=str_replace("{content}",$BlogReaderString,$String);	
else if ($Section == 'Archives')
	$String=str_replace("{content}",$ArchivesString,$String);	
else if ($Section == 'Links')
	$String=str_replace("{content}",$LinksString,$String);


$String=str_replace("{menuone}",$MenuOneString,$String); 
if (($Section == 'Pages') || ($Section == 'Extras'))
	$String=str_replace("{menutwo}",$MenuTwoString,$String); 
else 
	$String=str_replace("{menutwo}",'',$String); 
	
$String=str_replace("{UPDATE_BOX}",$UpdateBox,$String); 
$String=str_replace("{first_page}",'/'.$ComicFolder.'/page/1/',$String); 
$String=str_replace("{next_page}",'/'.$ComicFolder.'/page/'.$NextPage.'/',$String); 
$String=str_replace("{last_page}",'/'.$ComicFolder.'/page/'.$lastpage.'/',$String); 
$String=str_replace("{previous_page}",'/'.$ComicFolder.'/page/'.$PrevPage.'/',$String); 

$String=str_replace("{downloads}",$ModuleTop.setheader('downloads').$HomedownloadsString.$ModuleBottom ,$String); 

$String=str_replace("{custommod}",$ModuleTop.$CustomModuleCode.$ModuleBottom ,$String); 
$String=str_replace("{characters}",$ModuleTop.setheader('characters').$HomecharactersString.$ModuleBottom,$String); 
$String=str_replace("{status}",$ModuleTop.setheader('status').$HomestatusString.$ModuleBottom,$String); 
if (($Section == 'Pages') || ($Section == 'extras')) {
$String=str_replace("{synopsis}",$ModuleTop.setheader('comicsynopsis').$ComicSynopsisString.$ModuleBottom,$String);

$String=str_replace("{pagecomments}",$ModuleTop.setheader('pagecom').$PageCommentString.$ModuleBottom,$String); 
$String=str_replace("{authorcomment}",$ModuleTop.setheader('authcomm').$AuthorCommentString.$ModuleBottom,$String);
$String=str_replace("{commentbox}",$ModuleTop.$CommentBoxString.$ModuleBottom,$String);  
$String=str_replace("{comiccredits}",$ModuleTop.setheader('comicinfo').$ComicModuleString.$ModuleBottom,$String); 	
} else {
$String=str_replace("{synopsis}",'',$String); 
$String=str_replace("{pagecomments}",'',$String);
$String=str_replace("{authorcomment}",'',$String);
$String=str_replace("{commentbox}",'',$String);
$String=str_replace("{comiccredits}",'',$String);
}
$String=str_replace("{login}",$ModuleTop.$LoginModuleString.$ModuleBottom,$String); 	

$String=str_replace("{twitter}",$ModuleTop.setheader('twitter').$TwitterString.$ModuleBottom,$String); 
$String=str_replace("{linksbox}",$ModuleTop.setheader('linksbox').$LinksModuleString.$ModuleBottom,$String); 

$String=str_replace("{products}",$ModuleTop.setheader('products').$ProductsModuleString.$ModuleBottom,$String); 
$String=str_replace("{mobile}",$ModuleTop.setheader('mobile').$MobileModuleString.$ModuleBottom,$String); 
$String=str_replace("{othercomics}",$ModuleTop.setheader('othercreatorcomics').$HomeothercreatorcomicsString.$ModuleBottom,$String); 

if ($Section == 'Blog') {
	$String=str_replace("{blogsidebar}",$ModuleTop.$SidebarString.$ModuleBottom,$String); 
	$String=str_replace("{blog}",'',$String);
}else {
	$String=str_replace("{blog}",$ModuleTop.setheader('blog').$BlogModuleString.$ModuleBottom,$String); 
}	

$String=str_replace("{moduletop}",$ModuleTop,$String); 
$String=str_replace("{modulebottom}",$ModuleBottom,$String); 
return $String;

}
if ($Section == 'Characters') {
include 'character_functions.php';
}
if ($Section == 'Downloads') {
include 'downloads_functions.php';
}
if ($Section == 'Creator') {
include 'about_functions.php';
}
if ($Section == 'Products') {
include 'products_functions.php';
}
if ($Section == 'Mobile') {
include 'mobile_functions.php';
}
if ($Section == 'Extras') {
include 'extras_functions.php';
}
include 'string_functions.php';
include 'blog_functions.php';
include 'adbox_inc.php';
include 'menu_template_inc.php';
include 'reader_template_inc_blog.php';
include 'preloader_template_inc.php';

include 'author_comment_template_inc.php';

include_once('links_inc.php');

include 'page_comment_template_inc.php';

include 'user_module_template_inc.php';

include 'comic_module_template_inc.php';

include 'links_template_inc.php';

include 'comic_synopsis_template_inc.php';
include 'comment_box_template_inc.php';
include 'login_template_inc.php'; 
include 'contact_template_inc.php';
include 'products_template_inc.php';
include 'mobile_template_inc.php';
include 'download_content_functions.php';
include 'creator_template_inc.php';
include 'blog_display_inc.php';
include 'twitter_module_template_inc.php';
include 'blog_module_template_inc.php';

if ($Section == 'Archives') {
include 'archives_template_inc.php';

}



if ($PositionFive == 1) { 
	$PositionFiveString ='<div align="center"><div>'.$PositionFiveAdCode."</div></div>";
}
 if (($Homepage == 1) && ($HomepageActive == 1)) {
include 'home_page_template_inc.php';

} else {
//include 'left_column_template_inc.php';
//include 'right_column_template_inc.php';
include 'reader_page_modules_inc.php';

include 'characters_template_inc.php';
include 'downloads_template_inc.php';
include 'episodes_template_inc.php';
}

if ($Section == 'Links')
$Title = 'Links';

$UpdateBox = '';
if (($TodayBlog == 1) && ($TodayPage == 0) && ($Homepage == 1) && ($HomepageActive == 1))
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

 if (($Homepage != 1) && ($LayoutType == 'custom')) {

 		$TemplateString = build_template($LayoutHTML,$Section);
		
 } else {
 
 if (($Section == 'Pages') || ($Section == 'Extras')) {

 if (($Homepage == 1) && ($HomepageActive == 1)) {
 
 	if ($HomepageType == 'standard') {
		$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/homepage.html');
		$TemplateString=str_replace("{HOME_READER_PACKAGE_AND_TOPADS}",$HomeReaderString,$TemplateString); 
		//$TemplateString=str_replace("{LEFT_COLUMN}",$LeftColumnString,$TemplateString); 
		$TemplateString=str_replace("{LEFT_COLUMN}",'',$TemplateString); 
		$TemplateString=str_replace("{RIGHT_COLUMN}",$ReaderPageModuleString,$TemplateString);
	    $TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
		$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
		
	} else {
		$TemplateString = $HomepageHTML;
	    foreach($HomeModuleArray as $module) {
			if ($module == 'downloads') 
				$String = $HomedownloadsString;
			if ($module == 'characters') 
				$String = $HomecharactersString;
			if ($module == 'status') 
				$String = $HomestatusString;
			if ($module == 'linksbox') 
				$String = $HomelinksboxString;
			if ($module == 'products') 
				$String = $HomeproductsString;
			if ($module == 'comicsynopsis') 
				$String = $HomecomicsynopsisString;
			if ($module == 'comiccredits') 
				$String = $HomecomiccreditsString;
			if ($module == 'othercreatorcomics') 
				$String = $HomeothercreatorcomicsString;
			if ($module == 'mobile') 
				$String = $HomemobileString;
			if ($module == 'authcomm') 
				$String = $AuthorCommentString;
			if ($module == 'menuone') 
				$String = $MenuOneString;
			if ($module == 'menutwo') 
				$String = $MenuTwoString;
			if ($module == 'blog') 
				$String = $BlogModuleString;
			if ($module == 'twitter') 
				$String = $TwitterString;
			if ($module == 'custommod') 
				$String = $CustomModuleCode;	
			
				
			$TemplateString=str_replace("{".$module."}",$String, $TemplateString);
		}
		
		$TemplateString=str_replace("{pagemodule}",$PageReader,$TemplateString); 
		$TemplateString=str_replace("{menuone}",$MenuOneString,$TemplateString); 
		$TemplateString=str_replace("{menutwo}",$MenuTwoString,$TemplateString); 
		$TemplateString=str_replace("{UPDATE_BOX}",$UpdateBox,$TemplateString); 
		$TemplateString=str_replace("{first_page}",'/'.$ComicFolder.'/reader/page/1/',$TemplateString); 
		$TemplateString=str_replace("{next_page}",'/'.$ComicFolder.'/reader/page/'.$NextPage.'/',$TemplateString); 
		$TemplateString=str_replace("{last_page}",'/'.$ComicFolder.'/reader/page/'.$lastpage.'/',$TemplateString); 
		$TemplateString=str_replace("{previous_page}",'/'.$ComicFolder.'/reader/page/'.$PrevPage.'/',$TemplateString); 
		$TemplateString=str_replace("{fullpagereader}",$HomeReaderString,$TemplateString); 
		
	} 
 

 //$TemplateString=str_replace("{POSITION_ONE_AD}",$PositionFOneString,$TemplateString);
// $TemplateString=str_replace("{POSITION_TWO_AD}",$PositionTwoString,$TemplateString);
 //$TemplateString=str_replace("{POSITION_THREE_AD}",$PositionThreeString,$TemplateString);
  //$TemplateString=str_replace("{POSITION_FOUR_AD}",$PositionFourString,$TemplateString);
 } else {

$TemplateString = $ReaderString.$ReaderPageModuleString.$PreloaderString;


/*
file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/index.html');
$TemplateString=str_replace("{LEFT_COLUMN}",$LeftColumnString,$TemplateString); 
$TemplateString=str_replace("{RIGHT_COLUMN}",$ReaderPageModuleString,$TemplateString);
$TemplateString=str_replace("{READER_PACKAGE_AND_TOPADS}",$ReaderString,$TemplateString); 
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
*/
}
} 

if ($Section == 'Blog') {

$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/blog.html');
$TemplateString=str_replace("{BLOG_READER}",$BlogReaderString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{BLOG_SIDEBAR}",$SidebarString,$TemplateString);
} 
if ($Section == 'Links') {
$Title = 'Links';
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/links.html');
$TemplateString=str_replace("{LINKS_LIST}",$LinksString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
} 

if ($Section == 'Creator') {
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/creator.html');
$TemplateString=str_replace("{CREATOR_INFO}",$MainCreatorProfileString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
$TemplateString=str_replace("{AUTHOR_COMMENT}",$ACModuleString,$TemplateString);
} 

if ($Section == 'Downloads') {
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/downloads.html');
$TemplateString=str_replace("{DOWNLOADS_PLAYER}",$DownloadsString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
$TemplateString=str_replace("{COMIC_MODULE}",$CModuleString,$TemplateString);
} 

if ($Section == 'Products') {
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/products.html');
$TemplateString=str_replace("{PRODUCTS_PLAYER}",$ProductsString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
}

if ($Section == 'Mobile') {
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/mobile.html');
$TemplateString=str_replace("{MOBILE_PLAYER}",$MobileString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
}

if ($Section == 'Characters') {
$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/characters.html');
$TemplateString=str_replace("{CHARACTER_LIST}",$CharactersPlayerString,$TemplateString);
$TemplateString=str_replace("{CHARACTER_INFO}",$CharactersString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{PRELOAD_BLOCK}",$PreloaderString,$TemplateString);
$TemplateString=str_replace("{COMIC_MODULE}",$CModuleString,$TemplateString);
} 

if ($Section == 'Episodes') {

$TemplateString = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/episodes.html');
$TemplateString=str_replace("{EPISODE_LIST}",$EpisodesTemplateString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);
$TemplateString=str_replace("{COMIC_MODULE}",$CModuleString,$TemplateString);

} 

if ($Section == 'Contact') {

$TemplateString = @file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/contact.html');
//print 'TEMPALTE STRING = ' . $ContactTemplateString;
$TemplateString=str_replace("{CONTACT_FORM}",$ContactTemplateString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);

} 

if ($Section == 'Archives') {

$TemplateString = @file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/'.$PFDIRECTORY.'/templates/'.$TEMPLATE.'/archives.html');
//print 'TEMPALTE STRING = ' . $ArchivesString;
$TemplateString=str_replace("{ARCHIVES}",$ArchivesString,$TemplateString);
$TemplateString=str_replace("{SITE_HEADER}",$SiteHeaderString,$TemplateString);
$TemplateString=str_replace("{POSITION_FIVE_AD}",$PositionFiveString,$TemplateString);

} 
}
?>
<script type="text/javascript">
if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))){
	location.href='http://www.panelflow.com/<? echo $SafeFolder;?>/iphone/';
}

var SafeFolder = '<? echo $SafeFolder;?>';
	var NextPage = '<? echo $NextPage;?>';
	var LastPage = '<? echo $lastpage;?>';
	var PrevPage = '<? echo $PrevPage;?>';
	var SkinCode = '<? echo $SkinCode;?>';
	var PFDIRECTORY = '<? echo $PFDIRECTORY;?>';
	var PrevPageImage = '<? echo $PrevPageImage;?>';
	var NextPageImage = '<? echo $NextPageImage;?>';

		
<? if ($Section == 'Downloads')  {?>

function desktopstab() {

	if (document.getElementById("desktopstab")!= null) {
			document.getElementById("desktopsdiv").style.display ='';
			document.getElementById("desktopstab").className ='tabactive';
	}
		
	if (document.getElementById("coverstab")!= null) {
			document.getElementById("coversdiv").style.display = 'none';
			document.getElementById("coverstab").className ='tabinactive';
	}
if (document.getElementById("avatarstab") != null) {
	document.getElementById("avatarsdiv").style.display = 'none';
	document.getElementById("avatarstab").className ='tabinactive';
}

}
function coverstab() {
if (document.getElementById("desktopstab") != null) {
	document.getElementById("desktopsdiv").style.display = 'none';
	document.getElementById("desktopstab").className ='tabinactive';
}
if (document.getElementById("coverstab") != null) {
	document.getElementById("coversdiv").style.display = '';
	document.getElementById("coverstab").className ='tabactive';
}
if (document.getElementById("avatarstab") != null) {
	document.getElementById("avatarsdiv").style.display = 'none';
	document.getElementById("avatarstab").className ='tabinactive';
}
}

function avatarstab() {
if (document.getElementById("desktopstab") != null) {
	document.getElementById("desktopsdiv").style.display = 'none';
	document.getElementById("desktopstab").className ='tabinactive';
}
if (document.getElementById("coverstab") != null) {
	document.getElementById("coversdiv").style.display = 'none';
	document.getElementById("coverstab").className ='tabinactive';
}
if (document.getElementById("avatarstab") != null) {
	document.getElementById("avatarsdiv").style.display = '';
	document.getElementById("avatarstab").className ='tabactive';
}
}

<? }?>

<? if ($Section == 'Products')  {?>

function pdfstab() {

	if (document.getElementById("pdfstab")!= null) {
			document.getElementById("pdfsdiv").style.display ='';
			document.getElementById("pdfstab").className ='tabactive';
	}
		
	if (document.getElementById("printstab")!= null) {
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printstab").className ='tabinactive';
	}
	if (document.getElementById("bookstab") != null) {
		document.getElementById("booksdiv").style.display = 'none';
		document.getElementById("bookstab").className ='tabinactive';
	}
	if (document.getElementById("merchtab") != null) {
		document.getElementById("merchdiv").style.display = 'none';
		document.getElementById("merchtab").className ='tabinactive';
	}
	if (document.getElementById("digitaltab") != null) {
		document.getElementById("digitaldiv").style.display = 'none';
		document.getElementById("digitaltab").className ='tabinactive';
	}

}
function printstab() {
if (document.getElementById("pdfstab")!= null) {
			document.getElementById("pdfsdiv").style.display ='none';
			document.getElementById("pdfstab").className ='tabinactive';
	}
		
	if (document.getElementById("printstab")!= null) {
			document.getElementById("printsdiv").style.display = '';
			document.getElementById("printstab").className ='tabactive';
	}
	if (document.getElementById("bookstab") != null) {
		document.getElementById("booksdiv").style.display = 'none';
		document.getElementById("bookstab").className ='tabinactive';
	}
	if (document.getElementById("merchtab") != null) {
		document.getElementById("merchdiv").style.display = 'none';
		document.getElementById("merchtab").className ='tabinactive';
	}
	if (document.getElementById("digitaltab") != null) {
		document.getElementById("digitaldiv").style.display = 'none';
		document.getElementById("digitaltab").className ='tabinactive';
	}
}

function bookstab() {
if (document.getElementById("pdfstab")!= null) {
			document.getElementById("pdfsdiv").style.display ='none';
			document.getElementById("pdfstab").className ='tabinactive';
	}
		
	if (document.getElementById("printstab")!= null) {
			document.getElementById("printsdiv").style.display = 'none';
			document.getElementById("printstab").className ='tabinactive';
	}
	if (document.getElementById("bookstab") != null) {
		document.getElementById("booksdiv").style.display = '';
		document.getElementById("bookstab").className ='tabactive';
	}
	if (document.getElementById("merchtab") != null) {
		document.getElementById("merchdiv").style.display = 'none';
		document.getElementById("merchtab").className ='tabinactive';
	}
	if (document.getElementById("digitaltab") != null) {
		document.getElementById("digitaldiv").style.display = 'none';
		document.getElementById("digitaltab").className ='tabinactive';
	}
}

function merchtab() {

	if (document.getElementById("pdfstab")!= null) {
		document.getElementById("pdfsdiv").style.display ='none';
		document.getElementById("pdfstab").className ='tabinactive';
	}
		
	if (document.getElementById("printstab")!= null) {
		document.getElementById("printsdiv").style.display = 'none';
		document.getElementById("printstab").className ='tabinactive';
	}
	
	if (document.getElementById("bookstab") != null) {
		document.getElementById("booksdiv").style.display = 'none';
		document.getElementById("bookstab").className ='tabinactive';
	}
	if (document.getElementById("merchtab") != null) {
		document.getElementById("merchdiv").style.display = '';
		document.getElementById("merchtab").className ='tabactive';
	}
	
	if (document.getElementById("digitaltab") != null) {
		document.getElementById("digitaldiv").style.display = 'none';
		document.getElementById("digitaltab").className ='tabinactive';
	}
}
function digitaltab() {
	if (document.getElementById("pdfstab")!= null) {
		document.getElementById("pdfsdiv").style.display ='none';
		document.getElementById("pdfstab").className ='tabinactive';
	}
		
	if (document.getElementById("printstab")!= null) {
		document.getElementById("printsdiv").style.display = 'none';
		document.getElementById("printstab").className ='tabinactive';
	}
	if (document.getElementById("bookstab") != null) {
		document.getElementById("booksdiv").style.display = 'none';
		document.getElementById("bookstab").className ='tabinactive';
	}
	if (document.getElementById("merchtab") != null) {
		document.getElementById("merchdiv").style.display = 'none';
		document.getElementById("merchtab").className ='tabinactive';
	}
	if (document.getElementById("digitaltab") != null) {
		document.getElementById("digitaldiv").style.display = '';
		document.getElementById("digitaltab").className ='tabactive';
	}
}
<? }?>

<? if ($Section == 'Mobile')  {?>

function wallpaperstab() {

	if (document.getElementById("wallpaperstab")!= null) {
			document.getElementById("wallpapersdiv").style.display ='';
			document.getElementById("wallpaperstab").className ='tabactive';
	}
		
	if (document.getElementById("tonestab")!= null) {
			document.getElementById("tonesdiv").style.display = 'none';
			document.getElementById("tonestab").className ='tabinactive';
	}
	

}
function tonestab() {
	if (document.getElementById("wallpaperstab")!= null) {
			document.getElementById("wallpapersdiv").style.display ='none';
			document.getElementById("wallpaperstab").className ='tabinactive';
	}
		
	if (document.getElementById("tonestab")!= null) {
			document.getElementById("tonesdiv").style.display = '';
			document.getElementById("tonestab").className ='tabactive';
	}
}



<? }?>
function roll_over(img_name, img_src)
   {
   document[img_name].src = img_src;
   }

</script>
<? if ($Section == 'Episodes')  
		 echo $episodejavastring;
 ?>
 
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/scripts/swfobject2.js"></script>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/scripts/reader_functions.js"></script>
 <link href="/<? echo $PFDIRECTORY;?>/scripts/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="/<? echo $PFDIRECTORY;?>/scripts/jquery.js" type="text/javascript"></script>
<script src="/<? echo $PFDIRECTORY;?>/scripts/facebox/facebox.js" type="text/javascript"></script>
<script src="/<? echo $PFDIRECTORY;?>/scripts/bubble-tooltip.js" type="text/javascript"></script>
  <script type="text/javascript">
 	
	
	
  jQuery(document).ready(function($) {
   $('a[rel*=facebox]').facebox({
 loading_image : '/panelflow/scripts/facebox/loading.gif',
   close_image   : '/panelflow/scripts/facebox/closelabel.gif'
     }) 
   })
	



<? if ($Section == 'Contact') { ?>

	var Contactvars = {};
			Contactvars.pfdirectory = "<? echo $PFDIRECTORY; ?>";
			Contactvars.server = "<? echo $_SERVER['SERVER_NAME']; ?>";
			Contactvars.comicid = "<? echo $SafeFolder;?>";
			Contactvars.barcolor = "0x<? echo $ControlBarBGColor; ?>";
			Contactvars.textcolor = "0x<? echo $ControlBarTextColor;?>";
			Contactvars.moviecolor = "<? echo $MovieColor?>";
			Contactvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
			Contactvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
			Contactvars.creatorcontact = "<? echo $_GET['c'];?>";
			
			var params = {};
			params.quality = "best";
			params.wmode = "transparent";
			params.allowfullscreen = "false";
			params.allowscriptaccess = "always";
			var attributes = {};
			attributes.id = "emailer";
			swfobject.embedSWF("/<? echo $PFDIRECTORY?>/flash/email_db.swf", "contact_form", "437", "239", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", Contactvars, params, attributes);
<? } ?>

<? if ($ReaderType == 'flash') {?>
			var topbarvars = {};
			topbarvars.pfdirectory = "<? echo $PFDIRECTORY; ?>";
			topbarvars.usertype = "<? echo $_SESSION['usertype']; ?>";
			topbarvars.backID = "<? echo $PrevPage; ?>";
			topbarvars.nextID = "<? echo $NextPage; ?>";
			topbarvars.currentindex = "<? echo $CurrentIndex; ?>";
			topbarvars.barcolor = "0x<? echo $ControlBarBGColor; ?>";
			topbarvars.textcolor = "0x<? echo $ControlBarTextColor;?>";
			topbarvars.moviecolor = "<? echo $MovieColor?>";
			topbarvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
			topbarvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
			topbarvars.totalpages = "<? echo $TotalPages; ?>";
			topbarvars.loggedin = "<? echo $loggedin;?>";
			topbarvars.extras = "<? echo $Extras?>";
			topbarvars.characters = "<? echo $Characters?>";
			topbarvars.downloads = "<? echo $Downloads?>";
			topbarvars.mobile = "<? echo $MobileContent; ?>";
			topbarvars.products = "<? echo $Products;?>";
			topbarvars.biosetting = "<? echo $ShowBio?>";
			topbarvars.section = "<? echo $Pagetracking?>";
			topbarvars.pathtopf = "<? echo $PFDIRECTORY?>";
			topbarvars.baseurl = "<? echo $ComicFolder; ?>";
			topbarvars.pageid = "<? echo $_GET['id'];?>";
			topbarvars.safefolder = "<? echo $SafeFolder?>";
			topbarvars.navabar = "<? echo $NavBarPlacement?>";

			var topparams = {};
			topparams.quality = "best";
			topparams.wmode = "transparent";
			topparams.allowfullscreen = "false";
			topparams.allowscriptaccess = "always";

			var topattributes = {};
			topattributes.id = "top";
			swfobject.embedSWF("/<? echo $PFDIRECTORY?>/flash/<? echo $FlashReaderStyle;?>_top.swf", "topbar", "<? echo $Width; ?>", "40", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", topbarvars, topparams, topattributes);
		<? }?>			
<? if (($Section == 'Pages') || $Section == 'Extras') {?>

<? if ($ReaderType == 'flash') {?>
/*
var pagevars = {};
	pagevars.pfdirectory = "<? //echo $PFDIRECTORY; ?>";
	pagevars.barcolor = "0x<? //echo $ControlBarBGColor; ?>";
	pagevars.moviecolor = "<? //echo $MovieColor?>";
	pagevars.baseurl = "comics/<? //echo $ComicDir;?>/<? //echo $ComicName;?>";

	pagevars.pageimage = "<? //echo $Image; ?>";
	pagevars.pagebase = "images/pages/";
			
	var pageparams = {};
	pageparams.quality = "best";
	pageparams.wmode = "transparent";
	pageparams.allowfullscreen = "false";
	pageparams.allowscriptaccess = "always";

	var pageattributes = {};
	pageattributes.id = "pfreader";
	swfobject.embedSWF("/<? //echo $PFDIRECTORY;?>/flash/pf_reader_dbpro_v1-6.swf", "pagereaderdiv", "<? //echo $Width; ?>", "<? //echo $Height;?>", "9.0.0", "/<? //echo $PFDIRECTORY?>/flash/expressInstall.swf", pagevars, pageparams, pageattributes);
*/
var bottomvars = {};
	bottomvars.pfdirectory = "<? echo $PFDIRECTORY; ?>";
	bottomvars.pagetitle = "<? echo addslashes($Title); ?>";
	bottomvars.totalpages = "<? echo $TotalPages; ?>";
	bottomvars.baseurl = "<? echo $ComicFolder; ?>";
	bottomvars.currentindex = "<? echo $CurrentIndex; ?>";
	bottomvars.barcolor = "0x<? echo $ControlBarBGColor; ?>";
	bottomvars.textcolor = "0x<? echo $ControlBarTextColor;?>";
	bottomvars.moviecolor = "<? echo $MovieColor?>";
	bottomvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
	bottomvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
	bottomvars.ControlXML = "<? echo $ControlXML; ?>";
	bottomvars.section = "<? echo $Pagetracking; ?>";
	bottomvars.navabar = "<? echo $NavBarPlacement; ?>";

	var bottomparams = {};
	bottomparams.quality = "best";
	bottomparams.wmode = "transparent";
	bottomparams.allowfullscreen = "false";
	bottomparams.allowscriptaccess = "always";

	var bottomattributes = {};
	bottomattributes.id = "bottomcontrols";
	swfobject.embedSWF("/<? echo $PFDIRECTORY;?>/flash/<? echo $FlashReaderStyle;?>_bottom.swf", "bottombar", "<? echo $Width; ?>", "40", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", bottomvars, bottomparams, bottomattributes);
<? } ?>

function GetElementPostion(xElement){

  var selectedPosX = 0;
  var selectedPosY = 0;
  var theElement = document.getElementById(xElement);
     // alert(xElement);        
  while(theElement != null){
    selectedPosX += theElement.offsetLeft;
    selectedPosY += theElement.offsetTop;
    theElement = theElement.offsetParent;
  }
      // alert('X='+ selectedPosX);               		      		      
  return selectedPosX + "," + selectedPosY;
  

}


function create_spot(asttop,asleft,count) {

var iposition = GetElementPostion('pagereaderdiv');

var dimarray = iposition.split(',');
asttop = (parseInt(asttop) + parseInt(dimarray[1]));
asleft = (parseInt(asleft) + parseInt(dimarray[0]));

element = document.createElement("div");
element.setAttribute("id","asterickloc_"+count);

<? if ($HotSpotImage == '') {?>
element.setAttribute("style", "background-color:#<? echo $HotSpotBGColor;?>;width:<? echo $HotSpotWidth;?>px;height:<? $HotSpotHeight;?>px;border:2px solid #000;position:absolute;top:"+asttop+"px;left:"+asleft+"px;cursor:default;");
element.style.cssText ="background-color:#<? echo $HotSpotBGColor;?>;width:<? echo $HotSpotWidth;?>px;height:<? echo $HotSpotHeight;?>px;border:2px solid #000;position:absolute;top:"+asttop+"px;left:"+asleft+"px;cursor:default;";

<? } else { ?>
element.setAttribute("style", "background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $HotSpotImage;?>);width:<? echo $HotSpotWidth;?>px;height:<? $HotSpotHeight;?>px;position:absolute;top:"+asttop+"px;left:"+asleft+"px;cursor:default;");
element.style.cssText ="background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $HotSpotImage;?>);width:<? echo $HotSpotWidth;?>px;height:<? echo $HotSpotHeight;?>px;position:absolute;top:"+asttop+"px;left:"+asleft+"px;cursor:default;";
<? }?>
document.getElementById('pagereaderdiv').appendChild(element);
} 



<? } ?>	
<? if (!is_authed()) { ?>
var loginvars = {};
	loginvars.loggedin = "<? echo $loggedin ?>";
	loginvars.pathtopf = "<? echo $PFDIRECTORY; ?>";
	loginvars.baseurl = "<? echo $ComicFolder; ?>";
	loginvars.barcolor = "0x<? echo $ContentBoxBGColor; ?>";
	loginvars.textcolor = "0x<? echo $ContentBoxTextColor;?>";
	loginvars.moviecolor = "<? echo $MovieColor?>";
	loginvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
	loginvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
	loginvars.pageid = "<? echo $_GET['id']; ?>";


	var loginparams = {};
	loginparams.quality = "best";
	loginparams.wmode = "transparent";
	loginparams.allowfullscreen = "false";
	loginparams.allowscriptaccess = "always";
	var loginattributes = {};
	loginattributes.id = "mpl";
	swfobject.embedSWF("/<? echo $PFDIRECTORY;?>/flash/loginmod.swf", "login", "171", "77", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", loginvars, loginparams, loginattributes);

<? }?>
	

<?  if ($CalendarSetting == 1) {?>
var calendarvars = {};
	calendarvars.currentday = "<? echo $PFDIRECTORY; ?>";
	calendarvars.currentmonth = "<? echo addslashes($Title); ?>";
	calendarvars.activepages = "<? echo $TotalPages; ?>";
	calendarvars.baseurl = "<? echo $ComicFolder; ?>";
	calendarvars.currentyear = "<? echo $CurrentYear; ?>";
	calendarvars.barcolor = "0x<? echo $ContentBoxBGColor; ?>";
	calendarvars.textcolor = "0x<? echo $ContentBoxTextColor;?>";
	calendarvars.moviecolor = "<? echo $MovieColor?>";
	calendarvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
	calendarvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
	calendarvars.calXML = "<? echo $CalXML; ?>";
	calendarvars.pageday = "<? echo $CurrentPageDay; ?>";
	calendarvars.pagemonth = "<? echo $CurrentPageMonth; ?>";
	calendarvars.pageyear  = "<? echo $CurrentPageYear; ?>";

	var calparams = {};
	calparams.quality = "best";
	calparams.wmode = "transparent";
	calparams.allowfullscreen = "false";
	calparams.allowscriptaccess = "always";
	calparams.bgcolor = "#<? echo $BGcolor;?>";
	var callattributes = {};
	callattributes.id = "postcalendar";
	swfobject.embedSWF("/<? echo $PFDIRECTORY;?>/flash/page_calendar_db_16.swf", "pagecalendar", "210", "150", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", calendarvars, calparams, callattributes);
<? }?>

<? if ($Section == 'Characters') { 

if ($CharacterReader == 'flash_one') {?>
var charvars = {};
	charvars.loggedin = "<? echo $PFDIRECTORY; ?>";
	charvars.baseurl = "<? echo $ComicFolder; ?>";
	charvars.barcolor = "0x<? echo $ContentBoxBGColor; ?>";
	charvars.textcolor = "0x<? echo $ContentBoxTextColor;?>";
	charvars.moviecolor = "<? echo $MovieColor?>";
	charvars.buttoncolor = "0x<? echo $ButtonBGColor?>";
	charvars.arrowcolor = "0x<? echo $ButtonTextColor?>";
	charvars.CharactersXML = "<? echo $ComicFolder; ?>";


	var charparams = {};
	charparams.quality = "best";
	charparams.wmode = "transparent";
	charparams.allowfullscreen = "false";
	charparams.allowscriptaccess = "always";
	var charattributes = {};
	charattributes.id = "chardiv";
	swfobject.embedSWF("/<? echo $PFDIRECTORY;?>/flash/charlist_db.swf", "characters", "<? echo $Width;?>", "225", "9.0.0", "/<? echo $PFDIRECTORY?>/flash/expressInstall.swf", charvars, charparams, charattributes);
<? }?>
<? }?>

<? if ($Section == 'Creator') { ?>	
function switch_creators(creatorID) {

		if (creatorID == 'main') {
			document.getElementById("maincreator_right").style.display = '';
			document.getElementById("maincreator_left").style.display = '';
			document.getElementById('maintab').className ='tabactive';
			
			if (document.getElementById("creatorone_left") != null) {
				document.getElementById("creatorone_right").style.display = 'none';
				document.getElementById("creatorone_left").style.display = 'none';
				document.getElementById('onetab').className ='tabinactive';
			}
			if (document.getElementById("creatortwo_left") != null) {
				document.getElementById("creatortwo_right").style.display = 'none';
				document.getElementById("creatortwo_left").style.display = 'none';
				document.getElementById('twotab').className ='tabinactive';
			}
			if (document.getElementById("creatorthree_left") != null) {
				document.getElementById("creatorthree_right").style.display = 'none';
				document.getElementById("creatorthree_left").style.display = 'none';
				document.getElementById('threetab').className ='tabinactive';
			}
		}
		
		if (creatorID == 'one') {
			document.getElementById("maincreator_right").style.display = 'none';
			document.getElementById("maincreator_left").style.display = 'none';
			document.getElementById('maintab').className ='tabinactive';
			

				document.getElementById("creatorone_right").style.display = '';
				document.getElementById("creatorone_left").style.display = '';
				document.getElementById('onetab').className ='tabactive';

			if (document.getElementById("creatortwo_left") != null) {
				document.getElementById("creatortwo_right").style.display = 'none';
				document.getElementById("creatortwo_left").style.display = 'none';
				document.getElementById('twotab').className ='tabinactive';
			}
			if (document.getElementById("creatorthree_left") != null) {
				document.getElementById("creatorthree_right").style.display = 'none';
				document.getElementById("creatorthree_left").style.display = 'none';
				document.getElementById('threetab').className ='tabinactive';
			}
		}
		if (creatorID == 'two') {
			document.getElementById("maincreator_right").style.display = 'none';
			document.getElementById("maincreator_left").style.display = 'none';
			document.getElementById('maintab').className ='tabinactive';
			
			if (document.getElementById("creatorone_left") != null) {
				document.getElementById("creatorone_right").style.display = 'none';
				document.getElementById("creatorone_left").style.display = 'none';
				document.getElementById('onetab').className ='tabinactive';
			}
			if (document.getElementById("creatortwo_left") != null) {
				document.getElementById("creatortwo_right").style.display = '';
				document.getElementById("creatortwo_left").style.display = '';
				document.getElementById('twotab').className ='tabactive';
			}
			
			if (document.getElementById("creatorthree_left") != null) {
				document.getElementById("creatorthree_right").style.display = 'none';
				document.getElementById("creatorthree_left").style.display = 'none';
				document.getElementById('threetab').className ='tabinactive';
			}
		}
		
		if (creatorID == 'three') {
				document.getElementById("maincreator_right").style.display = 'none';
				document.getElementById("maincreator_left").style.display = 'none';
				document.getElementById('maintab').className ='tabinactive';
			
			if (document.getElementById("creatorone_left") != null) {
				document.getElementById("creatorone_right").style.display = 'none';
				document.getElementById("creatorone_left").style.display = 'none';
				document.getElementById('onetab').className ='tabinactive';
			}
			if (document.getElementById("creatortwo_left") != null) {
				document.getElementById("creatortwo_right").style.display = 'none';
				document.getElementById("creatortwo_left").style.display = 'none';
				document.getElementById('twotab').className ='tabinactive';
			}
			
			if (document.getElementById("creatorthree_left") != null) {
				document.getElementById("creatorthree_right").style.display = '';
				document.getElementById("creatorthree_left").style.display = '';
				document.getElementById('threetab').className ='tabactive';
			}
		}

}	
<? }?>
function right(e) {
if (navigator.appName == 'Netscape' && 
(e.which == 3 || e.which == 2))
return false;
else if (navigator.appName == 'Microsoft Internet Explorer' && 
(event.button == 2 || event.button == 3)) {
//alert("Sorry, you do not have permission to right click.");
return false;
}
return true;
}

document.onmousedown=right;
document.onmouseup=right;
if (document.layers) window.captureEvents(Event.MOUSEDOWN);
if (document.layers) window.captureEvents(Event.MOUSEUP);
window.onmousedown=right;
window.onmouseup=right;
//  End -->

  </script>
  
<meta name="description" content="<?php echo $Synopsis ?>"></meta>
<meta name="keywords" content="Panel Flow, Digital Publishing Software and community for Webcomic creators and publishers.<?php echo $Genre;?>, <?php echo $Tags;?>, <?php echo $Creator;?>, <?php echo $Writer;?>, <?php echo $Letterist;?>, <?php echo $Artist;?>, <?php echo $Colorist;?>"></meta>

<LINK href="/<? echo $PFDIRECTORY;?>/templates/<? echo $TEMPLATE;?>/css/pf_css.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<head>
<title><?php echo $ComicTitle; ?> - <?php echo $Title; ?></title>
<style type="text/css" media="screen">
    #top { 
	outline:none; 
	background-color:#<? echo $ControlBarBGColor;?>;
	}
	#bottomcontrols { 
	outline:none;
	display:block;  
	}
	#mpl {
	outline:none;
	display:block;  
	}
	
	#emailer {
	outline:none;
	display:block;  
	}
	
	#postcalendar {
	outline:none;
	display:block;  
	}
	
	#chardiv {
	outline:none;
	display:block;
	}
	
	#pfreader {
	outline:none;
	display:block;
	}
	#pagediv {
	outline:none;
	display:block;
	}
#bubble_tooltip{
	width:300px;
	position:absolute;
	display:none;
	z-index:3;
}

#bubble_tooltip .bubble_top{
	background-image: url('/<? echo $PFDIRECTORY;?>/images/bubble_top.png');
	background-repeat:no-repeat;
	height:16px;	
}
#bubble_tooltip .bubble_middle{
	background-image: url('/<? echo $PFDIRECTORY;?>/images/bubble_middle.png');
	background-repeat:repeat-y;	
	background-position:bottm left;
	padding-left:7px;
	padding-right:7px;
}
#bubble_tooltip .bubble_middle span{
	position:relative;
	top:-8px;
	font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	font-size:11px;
}
#bubble_tooltip .bubble_bottom{
	background-image: url('/<? echo $PFDIRECTORY;?>/images/bubble_bottom.png');
	background-repeat:no-repeat;
	background-repeat:no-repeat;	
	height:44px;
	position:relative;
	top:-6px;
}

.smalltext {
font-size:10px;
color:#000000;
padding-left:73px;
font-weight:bold; 
}
</style>

<style type="text/css">
#facebox .body {
  padding: 10px;
  background: #<? echo $ContentBoxBGColor;?>;
  width: 370px;
}

#facebox .b {
  background:url(/<? echo $PFDIRECTORY;?>/scripts/facebox/b.png);
}

#facebox .tl {
  background:url(/<? echo $PFDIRECTORY;?>/scripts/facebox/tl.png);
}

#facebox .tr {
  background:url(/<? echo $PFDIRECTORY;?>/scripts/facebox/tr.png);
}

#facebox .bl {
  background:url(/<? echo $PFDIRECTORY;?>/scripts/facebox/bl.png);
}

#facebox .br {
  background:url(/<? echo $PFDIRECTORY;?>/scripts/facebox/br.png);
} 



.tabactive {
height:12px;
background-color:#<? echo $GlobalTabActiveBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;
<? if ($GlobalTabActiveFontStyle != '') {
if ($GlobalTabActiveFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalTabActiveFontStyle == 'regular')  
	$StyleTag = 'font-style:normal;';
if ($GlobalTabActiveFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';
echo $StyleTag;	
	?>
<? }?>
font-size:<? echo $GlobalTabActiveFontSize;?>px;
width:100px;
color:#<? echo $GlobalTabActiveTextColor;?>;
}
.tabinactive { 
height:12px;
background-color:#<? echo $GlobalTabInActiveBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;
<? if ($GlobalTabInActiveFontStyle != '') {
if ($GlobalTabInActiveFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalTabInActiveFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalTabInActiveFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';
echo $StyleTag;	
	?>
<? }?>
font-size:<? echo $GlobalTabInActiveFontSize;?>px;
width:100px;
color:#<? echo $GlobalTabInActiveTextColor;?>;
}
.tabhover{
height:12px;
background-color:#<? echo $GlobalTabHoverBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;
<? if ($GlobalTabHoverFontStyle != '') {
if ($GlobalTabHoverFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalTabHoverFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalTabHoverFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';
echo $StyleTag;	
	?>
<? }?>
font-size:<? echo $GlobalTabHoverFontSize;?>px;
width:100px;
color:#<? echo $GlobalTabHoverTextColor;?>;
}

.peeltabactive {
height:10px;
background-color:#<? echo $GlobalTabActiveBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;

font-size:10px;
width:50px;
color:#<? echo $GlobalTabActiveTextColor;?>;
}
.peeltabinactive {
height:10px;
background-color:#<? echo $GlobalTabInActiveBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;
font-size:10px;
width:50px;
color:#<? echo $GlobalTabInActiveTextColor;?>;
}
.peeltabhover{
height:10px;
background-color:#<? echo $GlobalTabHoverBGColor;?>;
text-align:center;
padding:5px;
cursor:pointer;
font-size:10px;
width:50px;
color:#<? echo $GlobalTabHoverTextColor;?>;
}

#modrightside { 
<? if ($ModRightSideImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModRightSideImage;?>);
background-repeat:repeat-y;
<? }?>
<? if ($ModRightSideBGColor != '') {?>
background-color:#<? echo $ModRightSideBGColor;?>;
<? } ?>
width: <? echo $CornerWidth;?>px;

}

#modleftside {
<? if ($ModLeftSideImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModLeftSideImage;?>);
background-repeat:repeat-y;
<? }?>
<? if ($ModLeftSideBGColor != '') {?>
background-color:#<? echo $ModLeftSideBGColor;?>;
<? } ?>
width: <? echo $CornerWidth;?>px;
}

#modtop {
<? if ($ModTopImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopImage;?>);
background-repeat:repeat-x;
<? }?>
<? if ($ModTopBGColor != '') {?>
background-color:#<? echo $ModTopBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
}

.boxcontent {
<? if ($ContentBoxImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ContentBoxImage;?>);
background-repeat:<? echo $ContentBoxImageRepeat;?>;
<? }?>
<? if ($ContentBoxBGColor != '') {?>
background-color:#<? echo $ContentBoxBGColor;?>;
<? } else { ?>
background-color:#ffffff;
<? }?>
<? if ($ContentBoxTextColor != '') {?>
color:#<? echo $ContentBoxTextColor;?>;
<? } else {?>
color:#000000;
<? }?>
<? if ($ContentBoxFontSize != '') {?>
font-size:<? echo $ContentBoxFontSize;?>px;
<? } else {?>
font-size:12px;
<? }?>

}

#modbottom {
<? if ($ModBottomImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomImage;?>);
background-repeat:repeat-x;
<? }?>
<? if ($ModBottomBGColor != '') {?>
background-color:#<? echo $ModBottomBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;

}

#modbottomleft{
<? if ($ModBottomLeftImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomLeftImage;?>);
background-repeat:none;
<? }?>
<? if ($ModBottomLeftBGColor != '') {?>
background-color:#<? echo $ModBottomLeftBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#modtopleft{
<? if ($ModTopLeftImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopLeftImage;?>);
background-repeat:none;
<? }?>
<? if ($ModTopLeftBGColor != '') {?>
background-color:#<? echo $ModTopLeftBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#modtopright{
<? if ($ModTopRightImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopRightImage;?>);
background-repeat:none;
<? }?>
<? if ($ModTopRightBGColor != '') {?>
background-color:#<? echo $ModTopRightBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#modbottomright{
<? if ($ModBottomRightImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomRightImage;?>);
background-repeat:none;
<? }?>
<? if ($ModBottomRightBGColor != '') {?>
background-color:#<? echo $ModBottomRightBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}



#bubblerightside { 
<? if ($ModRightSideImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModRightSideImage;?>);
background-repeat:repeat-y;
<? }?>
<? if ($ModRightSideBGColor != '') {?>
background-color:#<? echo $ModRightSideBGColor;?>;
<? } ?>
width: <? echo $CornerWidth;?>px;

}

#bubbleleftside {
<? if ($ModLeftSideImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModLeftSideImage;?>);
background-repeat:repeat-y;
<? }?>
<? if ($ModLeftSideBGColor != '') {?>
background-color:#<? echo $ModLeftSideBGColor;?>;
<? } ?>
width: <? echo $CornerWidth;?>px;
}

#bubbletop {
<? if ($ModTopImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopImage;?>);
background-repeat:repeat-x;
<? }?>
<? if ($ModTopBGColor != '') {?>
background-color:#<? echo $ModTopBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
}

#bubble_tooltip_content {
<? if ($ContentBoxImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ContentBoxImage;?>);
background-repeat:<? echo $ContentBoxImageRepeat;?>;
<? }?>
<? if ($ContentBoxBGColor != '') {?>
background-color:#<? echo $ContentBoxBGColor;?>;
<? } else { ?>
background-color:#ffffff;
<? }?>
<? if ($ContentBoxTextColor != '') {?>
color:#<? echo $ContentBoxTextColor;?>;
<? } else {?>
color:#000000;
<? }?>
<? if ($ContentBoxFontSize != '') {?>
font-size:<? echo $ContentBoxFontSize;?>px;
<? } else {?>
font-size:12px;
<? }?>
}

#bubblebottom {
<? if ($ModBottomImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomImage;?>);
background-repeat:repeat-x;
<? }?>
<? if ($ModBottomBGColor != '') {?>
background-color:#<? echo $ModBottomBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;

}

#bubblebottomleft{
<? if ($ModBottomLeftImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomLeftImage;?>);
background-repeat:none;
<? }?>
<? if ($ModBottomLeftBGColor != '') {?>
background-color:#<? echo $ModBottomLeftBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#bubbletopleft{
<? if ($ModTopLeftImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopLeftImage;?>);
background-repeat:none;
<? }?>
<? if ($ModTopLeftBGColor != '') {?>
background-color:#<? echo $ModTopLeftBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#bubbletopright{
<? if ($ModTopRightImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModTopRightImage;?>);
background-repeat:none;
<? }?>
<? if ($ModTopRightBGColor != '') {?>
background-color:#<? echo $ModTopRightBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}

#bubblebottomright{
<? if ($ModBottomRightImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ModBottomRightImage;?>);
background-repeat:none;
<? }?>
<? if ($ModBottomRightBGColor != '') {?>
background-color:#<? echo $ModBottomRightBGColor;?>;
<? } ?>
height:<? echo $CornerHeight;?>px;
width:<? echo $CornerWidth;?>px;
}


#ControlBar{

<? if ($ControlBarImage != '') {?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $ControlBarImage;?>);
background-repeat:<? echo $ControlBarImageRepeat;?>;
height:<? echo $ControlHeight;?>px;
<? }?>
background-color:#<? echo $ControlBarBGColor;?>;
<? if ($ControlBarFontSize != '') {?>
font-size:<? echo $ControlBarFontSize;?>px;
<? }?>
<? if ($ControlBarFontStyle != '') {
if ($ControlBarFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($ControlBarFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($ControlBarFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';
echo $StyleTag;	
	?>
<? }?>
}


#AuthorComment{

<? if (($AuthorCommentTextColor == 'global') || ($AuthorCommentTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $AuthorCommentTextColor;
?>
color:#<? echo $TextColor;?>;

text-transform:<? echo $GlobalHeaderTextTransformation;?>;
<? if (($AuthorCommentImage != '') || ($GlobalHeaderImage != '')) {
		 if ($AuthorCommentImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat; 
		} else {
			$CSSImage =$AuthorCommentImage;
			$CSSRepeat = $AuthorCommentImageRepeat;
		} 
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
		
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($AuthorCommentBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($AuthorCommentBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$AuthorCommentBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($AuthorCommentFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($AuthorCommentFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$AuthorCommentFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? 


if (($AuthorCommentFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($AuthorCommentFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$AuthorCommentFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	

?>
<? echo $StyleTag;?>
<? }?>

}

#LinksBox {
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
		
padding:2px;
<? if ($GlobalHeaderImage != '') {
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$GlobalHeaderImage);
	if ($GlobalHeaderImageRepeat == 'none') 
			$GlobalHeaderImageRepeat = 'no-repeat';
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $GlobalHeaderImage;?>);
background-repeat:<? echo $GlobalHeaderImageRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $GlobalHeaderBGColor;?>; 
font-size:<? echo $GlobalHeaderFontSize;?>px;
color:#<? echo $GlobalHeaderTextColor;?>;
<? 
$GlobalHeaderFontStyle;
	if ($GlobalHeaderFontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
	if ($GlobalHeaderFontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
	if ($GlobalHeaderFontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
}

.modheader{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
		
padding:2px;
<? if ($GlobalHeaderImage != '') {
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$GlobalHeaderImage);
			if ($GlobalHeaderImageRepeat == 'none') 
			$GlobalHeaderImageRepeat = 'no-repeat';
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $GlobalHeaderImage;?>);
background-repeat:<? echo $GlobalHeaderImageRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $GlobalHeaderBGColor;?>; 
font-size:<? echo $GlobalHeaderFontSize;?>px;
text-align:left;
color:#<? echo $GlobalHeaderTextColor;?>;
<? 
	if ($GlobalHeaderFontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
	if ($GlobalHeaderFontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
	if ($GlobalHeaderFontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
}

#ComicSynopsis{
padding:3px;
<? if (($ComicSynopsisTextColor == 'global') || ($ComicSynopsisTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $ComicSynopsisTextColor;
?>
color:#<? echo $TextColor;?>;
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
<? if (($ComicSynopsisImage != '') || ($GlobalHeaderImage != '')) {
		 if ($ComicSynopsisImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$ComicSynopsisCommentImage;
			$CSSRepeat = $ComicSynopsisImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($ComicSynopsisBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($ComicSynopsisBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$ComicSynopsisBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($ComicSynopsisFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($ComicSynopsisFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$ComicSynopsisFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($ComicSynopsisFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($ComicSynopsisFontStyle == '') {
		 	$FontStyle = $GlobalHeaderFontStyle;
		} else {
			$FontStyle =$ComicSynopsisFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}

#ComicInfo{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($ComicInfoTextColor == 'global')  || ($ComicInfoTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $ComicInfoTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($ComicInfoImage != '') || ($GlobalHeaderImage != '')) {
		 if ($ComicInfoImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$ComicInfoImage;
			$CSSRepeat = $ComicInfoImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($ComicInfoBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($ComicInfoBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$ComicInfoBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($ComicInfoFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($ComicInfoFontSize == '') { 
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$ComicInfoFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($ComicInfoFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($ComicInfoFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$ComicInfoFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}		

#UserComments{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($UserCommentsTextColor == 'global')  || ($UserCommentsTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $UserCommentsTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($UserCommentsImage != '') || ($GlobalHeaderImage != '')) {
		 if ($UserCommentsImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$UserCommentsImage;
			$CSSRepeat = $UserCommentsImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($UserCommentsBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($UserCommentsBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$UserCommentsBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($UserCommentsFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($UserCommentsFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$UserCommentsFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($UserCommentsFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($UserCommentsFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$UserCommentsFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}			
	
#ComicSynopsis{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($ComicSynopsisTextColor == 'global') || ($ComicSynopsisTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $ComicSynopsisTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($ComicSynopsisImage != '') || ($GlobalHeaderImage != '')) {
		 if ($ComicSynopsisImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$ComicSynopsisImage;
			$CSSRepeat = $ComicSynopsisImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($ComicSynopsisBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($ComicSynopsisBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$ComicSynopsisBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($ComicSynopsisFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($ComicSynopsisFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$ComicSynopsisFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($ComicSynopsisFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($ComicSynopsisFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$ComicSynopsisFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}	

#Products{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($ProductsTextColor == 'global') || ($ProductsTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $ProductsTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($ProductsImage != '') || ($GlobalHeaderImage != '')) {
		 if ($ProductsImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$ProductsImage;
			$CSSRepeat = $ProductsImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($ProductsBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($ProductsBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$ProductsBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($ProductsFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($ProductsFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$ProductsFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($ProductsFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($ProductsFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$ProductsFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}	
	
#MobileContent{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($MobileContentTextColor == 'global') || ($MobileContentTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $MobileContentTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($MobileContentImage != '') || ($GlobalHeaderImage != '')) {
		 if ($MobileContentImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$MobileContentImage;
			$CSSRepeat = $MobileContentImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($MobileContentBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($MobileContentBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$MobileContentBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($MobileContentFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($MobileContentFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$MobileContentFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($MobileContentFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($MobileContentFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$MobileContentFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}	


	
#MobileContent{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
<? if (($MobileContentTextColor == 'global') || ($MobileContentTextColor == ''))
	$TextColor = $GlobalHeaderTextColor;
  else 
  	$TextColor = $MobileContentTextColor;
?>
color:#<? echo $TextColor;?>;
<? if (($MobileContentImage != '') || ($GlobalHeaderImage != '')) {
		 if ($MobileContentImage == '') {
		 	$CSSImage =$GlobalHeaderImage;
			$CSSRepeat = $GlobalHeaderImageRepeat;
		} else {
			$CSSImage =$MobileContentImage;
			$CSSRepeat = $MobileContentImageRepeat;
		} 
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
<? if (($MobileContentBGColor != '') || ($GlobalHeaderBGColor != '')) {
		 if ($MobileContentBGColor == '') {
		 	$BgColor =$GlobalHeaderBGColor;

		} else {
			$BgColor =$MobileContentBGColor;
		} 
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if (($MobileContentFontSize != '') || ($GlobalHeaderFontSize != '')) {
		 if ($MobileContentFontSize == '') {
		 	$FontSize =$GlobalHeaderFontSize;

		} else {
			$FontSize =$MobileContentFontSize;
		} 
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if (($MobileContentFontStyle != '') || ($GlobalHeaderFontStyle != '')) {
		 if ($MobileContentFontStyle == '') {
		 	$FontStyle =$GlobalHeaderFontStyle;
		} else {
			$FontStyle =$MobileContentFontStyle;
		} 
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}	
.latestpageheader  {
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
color:#<? echo $GlobalHeaderTextColor;?>;
<? if ($GlobalHeaderImage != '') {
$CSSImage =$GlobalHeaderImage;
$CSSRepeat = $GlobalHeaderImageRepeat;
list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $ControlBarBGColor;?>;
font-size:<? echo $GlobalHeaderFontSize;?>px;
<?
	$FontStyle =$GlobalHeaderFontStyle;
	 if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>

}
.latestpageheader a:link{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
color:#<? echo $GlobalHeaderTextColor;?>;
<? if ($GlobalHeaderImage != '') {
$CSSImage =$GlobalHeaderImage;
$CSSRepeat = $GlobalHeaderImageRepeat;
list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $GlobalHeaderBGColor;?>;
font-size:<? echo $GlobalHeaderFontSize;?>px;
<?
	$FontStyle =$GlobalHeaderFontStyle;
	 if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>

}
.latestpageheader a:visited{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
color:#<? echo $GlobalHeaderTextColor;?>;
<? if ($GlobalHeaderImage != '') {
$CSSImage =$GlobalHeaderImage;
$CSSRepeat = $GlobalHeaderImageRepeat;
list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $GlobalHeaderBGColor;?>;
font-size:<? echo $GlobalHeaderFontSize;?>px;
<?
	$FontStyle =$GlobalHeaderFontStyle;
	 if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>

}

.blogtitle {
font-size:14px;
font-weight:bold;


}

.blogdate {
font-size:12px;
}
.globalheader{
text-transform:<? echo $GlobalHeaderTextTransformation;?>;
padding:3px;
text-align:left;
color:#<? echo $GlobalHeaderTextColor;?>;
<? if ($GlobalHeaderImage != '') {
$CSSImage =$GlobalHeaderImage;
$CSSRepeat = $GlobalHeaderImageRepeat;
list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>
background-color:#<? echo $GlobalHeaderBGColor;?>;
font-size:<? echo $GlobalHeaderFontSize;?>px;
<?
	$FontStyle =$GlobalHeaderFontStyle;
	 if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
}	
 
.global_button{
padding:3px;
<? if ($ButtonImage != '') {
		 	$CSSImage =$ButtonImage;
			$CSSRepeat = $ButtonImageRepeat;
		if ($CSSRepeat == 'none') 
			$CSSRepeat = 'no-repeat';
		list($HeaderWidth,$HeaderHeight)=@getimagesize($PFDIRECTORY.'/templates/skins/'.$SkinCode.'/templates/skins/'.$SkinCode.'/images/'.$CSSImage);
?>
background-image:url(/<? echo $PFDIRECTORY;?>/templates/skins/<? echo $SkinCode;?>/images/<? echo $CSSImage;?>);
background-repeat:<? echo $CSSRepeat;?>;
height:<? echo $HeaderHeight;?>px;
<? }?>

<? if ($ButtonBGColor != '') {
			$BgColor =$ButtonBGColor;
		
?>
background-color:#<? echo $BgColor;?>;
<? }?>
<? if ($ButtonFontSize != '') {
			$FontSize =$ButtonFontSize;
		
?>
font-size:<? echo $FontSize;?>px;
<? }?>
<? if ($ButtonFontStyle != '') {
		$FontStyle =$ButtonFontStyle;
		if ($FontStyle == 'bold') 
			$StyleTag = 'font-weight:bold;';
		if ($FontStyle == 'regular') 
			$StyleTag = 'font-style:normal;';
		if ($FontStyle == 'underline') 
			$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
<? }?>

}	

#FirstButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($FirstButtonBGColor != '') { ?>
background-color:#<? echo $FirstButtonBGColor;?>;
<? }?>
<? if ($FirstButtonTextColor != '') { ?>
color:#<? echo $FirstButtonTextColor;?>;
<? }?>
}

#NextButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($NextButtonBGColor != '') { ?>
background-color:#<? echo $NextButtonBGColor;?>;
<? }?>
<? if ($NextButtonTextColor != '') { ?>
color:#<? echo $NextButtonTextColor;?>;
<? }?>
}

#BackButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($BackButtonBGColor != '') { ?>
background-color:#<? echo $BackButtonBGColor;?>;
<? }?>
<? if ($BackButtonTextColor != '') { ?>
color:#<? echo $BackButtonTextColor;?>;
<? }?>
}
#LastButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($LastButtonBGColor != '') { ?>
background-color:#<? echo $LastButtonBGColor;?>;
<? }?>
<? if ($LastButtonTextColor != '') { ?>
color:#<? echo $LastButtonTextColor;?>;
<? }?>
}	
#HomeButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($HomeButtonBGColor != '') { ?>
background-color:#<? echo $HomeButtonBGColor;?>;
<? }?>
<? if ($HomeButtonTextColor != '') { ?>
color:#<? echo $HomeButtonTextColor;?>;
<? }?>
}	
#CreatorButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($CreatorButtonBGColor != '') { ?>
background-color:#<? echo $CreatorButtonBGColor;?>;
<? }?>
<? if ($CreatorButtonTextColor != '') { ?>
color:#<? echo $CreatorButtonTextColor;?>;
<? }?>
}		
#CharactersButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($CharactersButtonBGColor != '') { ?>
background-color:#<? echo $CharactersButtonBGColor;?>;
<? }?>
<? if ($CharactersButtonTextColor != '') { ?>
color:#<? echo $CharactersButtonTextColor;?>;
<? }?>
}	

#DownloadsButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($DownloadsButtonBGColor != '') { ?>
background-color:#<? echo $DownloadsButtonBGColor;?>;
<? }?>
<? if ($DownloadsButtonTextColor != '') { ?>
color:#<? echo $DownloadsButtonTextColor;?>;
<? }?>
}		
#ExtrasButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($ExtrasButtonBGColor != '') { ?>
background-color:#<? echo $ExtrasButtonBGColor;?>;
<? }?>
<? if ($ExtrasButtonTextColor != '') { ?>
color:#<? echo $ExtrasButtonTextColor;?>;
<? }?>
}

#EpisodesButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($EpisodesButtonBGColor == '') { 
		$BGColor = $GlobalButtonBGColor;
		
	} else {
		$BGColor = $EpisodesButtonBGColor;
	}
?>
background-color:#<? echo $BGColor;?>;

<? if ($EpisodesButtonTextColor == '') {
		$Color = $GlobalButtonTextColor;
	} else {
		$Color = $EpisodesButtonTextColor;
	}

 ?>
color:#<? echo $Color;?>;

}
#MobileButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($MobileButtonBGColor != '') { ?>
background-color:#<? echo $MobileButtonBGColor;?>;
<? }?>
<? if ($MobileButtonTextColor != '') { ?>
color:#<? echo $MobileButtonTextColor;?>;
<? }?>
}		
#ProductsButton{
<? if ($HomeButtonImage == '') {?>padding:5px;<? }?>
<? if ($ProductsButtonBGColor != '') { ?>
background-color:#<? echo $ProductsButtonBGColor;?>;
<? }?>
<? if ($ProductsButtonTextColor != '') { ?>
color:#<? echo $ProductsButtonTextColor;?>;
<? }?>
}	
		
#CommentButton{

<? if ($CommentButtonBGColor != '') { ?>
background-color:#<? echo $CommentButtonBGColor;?>;
<? }?>
<? if ($CommentButtonBGColor != '') { ?>
color:#<? echo $CommentButtonTextColor;?>;
<? }?>
}	
#VoteButton{

<? if ($VoteButtonBGColor != '') { ?>
background-color:#<? echo $VoteButtonBGColor;?>;
<? }?>
<? if ($VoteButtonTextColor != '') { ?>
color:#<? echo $VoteButtonTextColor;?>;
<? }?>
}			

#LogoutButton{

<? if ($LogoutButtonBGColor != '') { ?>
background-color:#<? echo $LogoutButtonBGColor;?>;
<? }?>
<? if ($LogoutButtonTextColor != '') { ?>
color:#<? echo $LogoutButtonTextColor;?>;
<? }?>
}			
.pagelinks {
<? 
if ($GlobalSiteLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalSiteLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalSiteLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalSiteLinkTextColor;?>;
}
.pagelinks a{
<? 
if ($GlobalSiteLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalSiteLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalSiteLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalSiteLinkTextColor;?>;
}
.pagelinks a:link{
	<? 
if ($GlobalSiteLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalSiteLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalSiteLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalSiteLinkTextColor;?>;
}
.pagelinks a:visited { 
<? 
if ($GlobalSiteVisitedFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalSiteVisitedFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;'; 
if ($GlobalSiteVisitedFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
color:#<?php echo $GlobalSiteVisitedTextColor;?>;
}
.pagelinks a:hover{
	<? 
if ($GlobalSiteHoverFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalSiteHoverFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalSiteHoverFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalSiteHoverTextColor;?>;
}

.buttonlinks {
<? 
if ($GlobalButtonLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalButtonLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalButtonLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalButtonLinkTextColor;?>;
}
.buttonlinks a{
<? 
if ($GlobalButtonLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalButtonLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalButtonLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalButtonLinkTextColor;?>;
}
.buttonlinks a:link{
	<? 
if ($GlobalButtonLinkFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalButtonLinkFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalButtonLinkFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalButtonLinkTextColor;?>;
}
.buttonlinks a:visited{ 
<? 
if ($GlobalButtonVisitedFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalButtonVisitedFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;'; 
if ($GlobalButtonVisitedFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
color:#<?php echo $GlobalButtonVisitedTextColor;?>;
}
.buttonlinks a:hover{
	<? 
if ($GlobalButtonHoverFontStyle == 'bold') 
	$StyleTag = 'font-weight:bold;';
if ($GlobalButtonHoverFontStyle == 'regular') 
	$StyleTag = 'font-style:normal;';
if ($GlobalButtonHoverFontStyle == 'underline') 
	$StyleTag = 'text-decoration:underline;';	
?>
<? echo $StyleTag;?>
	color:#<?php echo $GlobalButtonHoverTextColor;?>;
}
</style>
</head>
<? 
?>
	<body onload="onResize()" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


<? //if ($PositionOne == 1) { 

	//echo '<div align=\'center\'>'.$PositionOneAdCode.'</div>';
//}?>

<div class="wrapper" align="center">

<input type="hidden" value="<? echo $PFDIRECTORY;?>" id="pfdirectory" />
<? //echo print 'TEMPLATE = ' . $TemplateString;?>