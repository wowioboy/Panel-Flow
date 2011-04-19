<? 
if ($Section == 'Blog') {
		$StringCounter = 0;
		$BlogReaderString = '';
		
		///$BlogReaderString .=$SiteHeaderString;
		
		$BlogReaderString .='<table width="800" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.(800-($CornerWidth*2)).'" valign="top"><div class="boxcontent" style="padding-left:10px;color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px; height:600px; overflow:auto;"">';
		while($StringCounter <$bcounter) {
				
				$BlogReaderString .='<b>'.stripslashes($blog_array[$StringCounter]->Title).'</b><br/>';
				$CommentCounts = $blog_array[$StringCounter]->CommentCount;
				
				if ($CommentCounts == 0)
						$CommentTag ='';
				else if ($CommentCounts > 1) 
					$CommentTag = '('.$CommentCounts.') Comments &nbsp;[<a href="/'.$ComicName.'/blog/'.$blog_array[$StringCounter]->EncryptID.'/">READ</a>]';
				else 
					$CommentTag = '('.$CommentCounts.') Comment &nbsp;[<a href="/'.$ComicName.'/blog/'.$blog_array[$StringCounter]->EncryptID.'/">READ</a>]';
					
				$BlogContent = @file_get_contents('http://www.panelflow.com/'.$blog_array[$StringCounter]->Filename);
				
				
				$content = $BlogContent;
				$content_lowercase = strtolower($content);
				$currpos = 0;
				$endpos = strlen($content);
				$newcontent = '';
				$lastimgtag = 0; 

				do
				{
					$imgStart = strpos($content_lowercase, '<img', $currpos);
					if ($imgStart === false) {
						break;
					} 
						
					else 
					{
						$imgEnd = strpos($content_lowercase, '>', $imgStart);
						$imageTag = substr($content, $imgStart, $imgEnd - $imgStart + 1);
						
						$newimgtag = CreateNewImgTag($imageTag);
						$newcontent .= substr($content, $lastimgtag, $imgStart - $lastimgtag);
						$newcontent .= $newimgtag;
						
						$lastimgtag = $imgEnd + 1;
						$currpos = $lastimgtag;
					}
				} while ($currpos < $endpos);
				
				if ($currpos != $endpos) 
					$newcontent .= substr($content, $currpos, $endpos);
					
				if ($newcontent != '')
					$BlogContent = $newcontent;
					
					
				
				$BlogReaderString .= 'posted: '.$blog_array[$StringCounter]->PublishDate.' by '.$blog_array[$StringCounter]->Author.' >> '.$CommentTag.'&nbsp;[<a href="#commentbox" rel="facebox" onclick="document.getElementById(\'targetid\').value=\''.$blog_array[$StringCounter]->EncryptID.'\'";>LEAVE COMMENT</a>]<br/>';
				
				
				$BlogReaderString .= '<div style="border-bottom:dashed #'.$ContentBoxTextColor.' 1px; padding-top:5px;padding-bottom:5px;">'.$BlogContent.'</div><div class="spacer"></div>';
				
				if (isset($_GET['post'])) {
					if (($_SESSION['usertype']> 0) || ($_SESSION['email'] == 'matt@outlandentertainment.com')){
						$BlogReaderString .='COMMENTS<br/>'. getPageCommentsAdmin ($Section, $_GET['post'], $ComicID,$db_database,$db_host, $db_user, $db_pass,$PFDIRECTORY,$TEMPLATE);
					} else {
						$BlogReaderString .= 'COMMENTS<br/>'. getPageComments ($Section, $_GET['post'], $ComicID,$db_database,$db_host, $db_user, $db_pass);
					}
					
				}
				
			
				$StringCounter++;
		} 
		$BlogReaderString.= '</div></td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table><div style="display:none;"'.$CommentBoxString."</div>";
		

		


$SidebarString.= '<table width="'.$SideBarWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.($SideBarWidth-($CornerWidth*2)).'" valign="top">';

foreach ($LeftColumModuleOrder as $module) {
		if (($module =='comicinfo') || ($module =='linksbox')) {
			$SidebarString .= setheader($module);		 
			$SidebarString.= "<div class='spacer'></div>";
			$SidebarString.= setmodulehtml($module,'left');
		}
	}
foreach ($RightColumModuleOrder as $module) {
		if (($module =='comicinfo') || ($module =='linksbox')){
			$SidebarString .= setheader($module);		 
			$SidebarString.= "<div class='spacer'></div>";
			$SidebarString.= setmodulehtml($module,'right');
		}
	}
	$SidebarString.= '</td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table>';
	
}


?>