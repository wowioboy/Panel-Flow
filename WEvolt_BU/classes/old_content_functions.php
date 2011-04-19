<? 
public function build_template ($Html, $Section) {
						global $AuthorCommentString, $PageCommentString,$ComicSynopsisString, $LoginModuleString,$CommentBoxString,$UserModuleString,$ComicModuleString,$LinksModuleString, $ProductsModuleString, $MobileModuleString,$HomecomiccreditsString,$HomecomicsynopsisString,$HomeothercreatorcomicsString,$HomecharactersString,$HomestatusString,$HomeepisodesString,$HomelinksboxString,$HomeothercreatorcomicsString,$HomeauthcommString,$TwitterString,$MenuOneString,$MenuTwoString,$StandardMenuOne,$StandardMenuTwo,$MenuOneLayout,$MenuTwoLayout,$MenuOneCustom,$MenuTwoCustom, $BlogModuleString,$PreloaderString, $MenuOneString, $MenuTwoString,$PositionFiveAdCode,$PositionOneAdCode,$PositionTwoAdCode,$PositionThreeAdCode,$PositionFourAdCode,$PageReader,$UpdateBox,$NextPage,$PrevPage,$lastpage,$ComicFolder,$BlogReaderString,$MainCreatorProfileString,$DownloadsString, $ProductsString,$MobileString,$CharactersPlayerString,$CharactersString,$EpisodesTemplateString,$ContactTemplateString,$SidebarString,$HomedownloadsString,$ArchivesString,$CustomModuleCode,$LinksString,$CharactersCustom,
$CharactersHTML,$CreditsCustom,$CreditsHTML,$DownloadsCustom,$DownloadsHTML,$EpisodesCustom,$EpisodesHTML;

$ModuleTop = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td id="projectmodtopleft"></td><td id="modtop"></td><td id="projectmodtopright"></td></tr><tr><td id="modleftside"></td><td class="projectboxcontent" valign="top">';
$ModuleBottom = '</td><td id="projectmodrightside"></td></tr><tr><td id="projectmodbottomleft"></td><td id="projectmodbottom"></td><td id="projectmodbottomright"></td></tr></table>';

$String = $Html;
if (($Section == 'Pages') || ($Section == 'Extras')){
	$String=str_replace("{content}",$PageReader,$String);
}else if ($Section == 'Products'){
	$String=str_replace("{content}",$ProductsString,$String);
}else if ($Section == 'Mobile'){
	$String=str_replace("{content}",$MobileString,$String);
}else if ($Section == 'Downloads'){
	if ($DownloadsCustom == 1) 
		$String=str_replace("{content}",$DownloadsHTML,$String);
	else
		$String=str_replace("{content}",$DownloadsString,$String);
}else if ($Section == 'Creator'){
	if ($CreditsCustom == 1) 
		$String=str_replace("{content}",$CreditsHTML,$String);	
	else
		$String=str_replace("{content}",$MainCreatorProfileString,$String);	
}else if ($Section == 'Episodes'){
	if ($EpisodesCustom == 1) 
		$String=str_replace("{content}",$EpisodesHTML,$String);
	else
		$String=str_replace("{content}",$EpisodesTemplateString,$String);
}else if ($Section == 'Contact'){
	$String=str_replace("{content}",$ContactTemplateString,$String);
}else if ($Section == 'Characters'){
	if ($CharactersCustom == 1) 
		$String=str_replace("{content}",$CharactersHTML,$String);	
	else
		$String=str_replace("{content}",$CharactersString.$CharactersPlayerString,$String);		
}else if ($Section == 'Blog'){
	$String=str_replace("{content}",$BlogReaderString,$String);	
}else if ($Section == 'Archives'){
	$String=str_replace("{content}",$ArchivesString,$String);	
}else if ($Section == 'Links'){
	$String=str_replace("{content}",$LinksString,$String);

}
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
        
		
		public function setmodulehtml($Module,$Layout='') {
							global $AuthorCommentString, $PageCommentString,$ComicSynopsisString, $LoginModuleString,$CommentBoxString,$UserModuleString,$ComicModuleString,$LinksModuleString, $ProductsModuleString, $MobileModuleString,$HomecomiccreditsString,$HomecomicsynopsisString,$HomeothercreatorcomicsString,$HomecharactersString,$HomestatusString,$HomeepisodesString,$HomelinksboxString,$HomeothercreatorcomicsString,$HomeauthcommString,$TwitterString,$TwitterString,$MenuOneString,$MenuTwoString,$StandardMenuOne,$StandardMenuTwo,$MenuOneLayout,$MenuTwoLayout,$MenuOneCustom,$MenuTwoCustom, $BlogModuleString,$HomedownloadsString,$CustomModuleCode,$LatestPageMod,$CharactersModuleString;
				
				
						
					
						if ($line->ModuleCode == 'twitter') {
							$Twittername = $line->CustomVar1;
							$TweetCount = $line->CustomVar2;
							$FollowLink = $line->CustomVar3;
							if ($Twittername == '')	
								$GetTwitter = 1;
						
						}
					
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
					return $CharactersModuleString;
					
					
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
				case 'latestpage':
					return $LatestPageMod;
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

        ?>