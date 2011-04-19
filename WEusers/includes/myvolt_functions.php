<? 
function myTruncate($string, $limit, $break=".", $pad="...") { 
// return with no change if string is shorter than $limit  
if(strlen($string) <= $limit) return $string; 
// is $break present between $limit and the end of the string?  
if(false !== ($breakpoint = strpos($string, $break, $limit))) { if($breakpoint < strlen($string) - 1) { $string = substr($string, 0, $breakpoint) . $pad; } } return $string; 

}

function wordwrapURI($str, $width = 75, $break = "\n", $cut = false)
{
    $newText = array();
    $words = explode(' ', str_replace("\n", "\n ", $str));
    foreach($words as $word) {
        if(strpos($word, 'http://') === false && strpos($word, 'www.') === false) {
            $word = wordwrap($word, $width, $break, $cut);
        }
        $newText[] = $word;
    }
    return implode(' ', $newText);
}

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
		$NewPath = 'http://www.wevolt.com/comics/'.$FilenameArray[$ArrayLength-4].'/'.$FilenameArray[$ArrayLength-3].'/'.$FilenameArray[$ArrayLength-2].'/'.$FilenameArray[$ArrayLength-1];
		// this is a realtive path make it correct
		$src = $NewPath;
	}
	
	list($width,$height)=@getimagesize($src);
	if ($width > 50)
	{
		$ImageWidth = "width='50'";// need to wrap click img tag
		$wrapper = '<center>';
		$endwrapper = '</center>';
		$border ="style='border:#000000 1px solid;'";
	} else  {
			$ImageWidth = '';
	}
		
	
	$newImageTag = $wrapper.'<img src="' . $src . '" alt="' . $alt . '" '.$ImageWidth.' '.$border.'/>'.$endwrapper;
	return $newImageTag;
}

function build_popup_menus($MenuModule,$CellID,$MenuModuleTemplate,$MenuModuleType,$NotSetup='') {
global $ModuleTitleArray,$ModuleIndex;

if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'excite') {
			 $MenuModuleTemplate = 'excite_single';
			 $MenuModuleType = 'mod_template';
			
		
		} else if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'headlines') {
		 	 $MenuModuleTemplate = 'rss';
			 $MenuModuleType = 'mod_template';

		
		}  else {
		
		 $MenuModuleTemplate = 'box_list';
			 $MenuModuleType = 'list';
		}
		
		$PopMenuString .='<ul id="'.$MenuModule.'_menu" style="display:none;">';

	//$PopMenuString.="<div id='".$MenuModule."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$MenuModule."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$MenuModule."_menu', event);\" width='5'></td><td>";
					
					if ($MenuModuleType == 'mod_template') {
						if ($MenuModuleTemplate == 'twitter') {
					

							$PopMenuString.='<li class="edit"><a href="javascript:void(0)" onclick=\"edit_window(\''.$CellID.'-'.$MenuModule.'\',\'twitter\',\'edit\',\'myvolt\');">Edit Window</a></li>';
							
						} else if ($MenuModuleTemplate == 'rss') {
					
							$PopMenuString.="<li class=\"cut separator\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','headlines','edit','myvolt');\">Edit Feeds</a></li>";
							$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','headlines','new','myvolt');\">Add Feed</a></li>";
							
						} else if ($MenuModuleTemplate == 'excite_single') {
					
							$PopMenuString.='<li class="edit"><a href="javascript:void(0)" onclick="update_excite(\'\');">Edit Status</a></li>';
							$PopMenuString.='<li class="cut separator"><a href="javascript:void(0)" onclick="document.location.href=\'/'.trim($_SESSION['username']).'/?t=excites\';">View Archives</a></li>';
							
						}
					
					
					} else if ($MenuModuleType == 'excite_box') {
						$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"update_excite('');\">Edit Status</a></li>";
						$PopMenuString.='<li class="cut separator"><a href="javascript:void(0)" onclick="document.location.href=\'/'.trim($_SESSION['username']).'/?t=excites\';">View Archives</a></li>';
					
					} else if ($MenuModuleType == 'html') {
					
						$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','myvolt','edit','myvolt');\">Edit Content</a></li>";
					} else if ($MenuModuleType == 'list') {
						
							     $PopMenuString.="<li class=\"cut separator\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','ref','new','myvolt');\">New Dropdown</a></li>";
								 if (($NotSetup == '') || ($NotSetup == '0')){
									 $PopMenuString.="<li class=\"cut separator\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','ref','edit','myvolt');\">List All Dropdowns</a></li>";
									$PopMenuString.="<li class=\"cut separator\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','ref','edit','myvolt');\">Edit Dropdown</a></li>";
									$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','ref','add','myvolt');\">Add Item</a></li>";
									$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','ref_items','edit','myvolt');\">Edit Items</a></li>";
								 }
					
					}
			//$PopMenuString.="</td><td onmouseover=\"hide_layer('".$MenuModule."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$MenuModule."_menu', event);\" style='height:5px;'></div></div>";
			
			
			
			$PopMenuString .='</ul>';
				//$PopMenuString.='<div id="'.$MenuModule.'_menu_wrapper" style="display:none;"><img src="http://www.wevolt.com/templates/modules/standard/action_star.png" hspace="3" vspace="3" border="0" width="15" class="navbuttons" id="'.$MenuModule.'_star"></div>';
				
				$PopMenuString .= '<script>
									$(document).ready(function(){
										$(\'#'.$MenuModule.'_star\').contextMenu({
											menu: \''.$MenuModule.'_menu\',
											leftClick: true
										});	
									});
									</script>';

return $PopMenuString;
}
function get_feed_items($ModuleID, $FeedID, $UserID) {
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	global $ModuleTitleArray,$ModuleIndex; 
	
	$String = '';
	$DB = new DB();
	$query = "SELECT * from feed_modules where EncryptID='$ModuleID'";
	$ModuleArray = $DB->queryUniqueObject($query);
	
	$SortVariable = $ModuleArray->SortVariable;
	$NumberVariable = $ModuleArray->NumberVariable;
	$Custom = $ModuleArray->Custom;
	$ContentVariable = $ModuleArray->ContentVariable;
	$SearchVariable = $ModuleArray->SearchVariable;
	$ThumbSize = $ModuleArray->ThumbSize;
	$Template = $ModuleArray->ModuleTemplate;
	$ModuleType = $ModuleArray->ModuleType;
	$ModHTML = $ModuleArray->HTMLCode;
	$Cell = $ModuleArray->CellID;

	if ($ModuleType == 'content'){
		
		if ($ContentVariable == 'comics') {
			
			$query = "SELECT * from projects where Published=1 and Pages>1 and thumb!='' and ProjectType='comic' and Hosted=1 order by $SortVariable DESC LIMIT $NumberVariable ";
			$DB->query($query);
			//print $query.'<br/><br/>';
				while ($line = $DB->fetchNextObject()) {
					$String .= '<a href="http://www.wevolt.com/'.$line->SafeFolder.'/">';
					$String .= '<img src="http://www.wevolt.com'.$line->thumb.'" hspace="4" vspace="4" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"  height="'.$ThumbSize.'" ></a>';
				}
		
		}
	
	} else if ($ModuleType == 'list'){
		
		$query = "SELECT * from feed_items 
				  where MyModule='$ModuleID' and MyFeed='$FeedID' and UserID='$UserID' and IsPublished=1
				  order by MyModule, MyPosition";
				  
		$DB->query($query);
		
	//	print '<br/>';
		$TotalItems =$DB->numRows();
		//print 'Total Items = ' .  $TotalItems.'<br/>';
		
		while ($line = $DB->fetchNextObject()) {
				$DB2 = new DB();
			   $ProjectID = $line->ProjectID;
			   $ContentID = $line->ContentID;
				//print_r($line);
				//print '<br/>';
				//print 'Template '.$Template.'<br/>';
				
			   	if ($Template == 'content_thumb') {
					
						if ($line->ItemType == 'project_link') {
							
							$query = "SELECT * from projects where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeFolder;
							$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">';
							$Thumb = 'http://www.wevolt.com/'.$ProjectArray->thumb;
						} else if ($line->ItemType == 'feed_link') {
							$query = "SELECT * from feed where ProjectID='$ProjectID'";
							//$ProjectArray = $DB2->queryUniqueObject($query);
							//$ProjectType = $ProjectArray->ProjectType;
							//$ProjectTarget = $ProjectArray->SafeTitle;
							$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
						} else if ($line->ItemType == 'creator_link') {
							$query = "SELECT * from users where encryptid='$ContentID'";
							//$ProjectArray = $DB2->queryUniqueObject($query);
							//$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/?t=profile">';
								$Thumb = 'http://www.wevolt.com/'.$ProjectArray->avatar;
						} else if ($line->ItemType == 'external_link'){
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}
						
						$String .= '<img src="'.$Thumb.'"  hspace="3" vspace="3" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"  height="'.$ThumbSize.'">';
						
						$String .= '</a>';
						
						
						
				} else if ($Template == 'content_list') {
							
							if ($line->ItemType == 'project_link') {
								$query = "SELECT * from projects where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.$line->Description.'<br/>';
								$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">http://www.wevolt.com/'.$ProjectTarget.'/</a></div><div class="medspacer"></div>';
						
							
						
							} else if ($line->ItemType == 'feed_link') {
								$query = "SELECT * from feed where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
							
							}  else if ($line->ItemType == 'creator_link') {
								$query = "SELECT * from users where encryptid='$ContentID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/?t=profile">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
						
							} else if ($line->ItemType == 'external_link') {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.$line->Description.'<br/>';
								$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">'.$line->Link.'/</a></div><div class="medspacer"></div>';
											
							}
						
							 
				} else if ($Template == 'info_list') {
							$String .= '<div class="sender_name">'.$line->Title.'</div>';
							$String .= '<div class="messageinfo">'.$line->Description.'</div>';
				
				}  else if ($Template == 'box_list') {
							$String .= "<table border='0' cellspacing='0' cellpadding='0' width='".($ModuleTitleArray[$ModuleIndex]['Width']-55)."'><tr>
										<td id=\"updateBox_TL\"></td>
										<td id=\"updateBox_T\"></td>
										<td id=\"updateBox_TR\"></td></tr>
										<tr><td class=\"updateboxcontent\"></td>
										<td valign='top' class=\"updateboxcontent\" width='".($ModuleTitleArray[$ModuleIndex]['Width']-16)."'>";
										
								$Description = wordwrapURI($line->Description, 10,"<br/>",true); 			
									//$Description = wordwrap($line->Description, 8, "<br/>", true);
										if ($line->Thumb != '') {
												if ($line->Embed != '')
														$String .= '<a href="#" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +60).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
												else 
													$String .= "<a href='".$line->Link."' target='".$line->Target."'>";

												$String .= "<img src='".$line->Thumb."' alt='LINK' width='50' align='left' hspace='3' vspace='3' style='border:2px #000000 solid;'></a>";
												$String .= "<div class='sender_name'>";
												if ($line->Embed != '')
														$String .= '<a href="#" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +60).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
												else 
													$String .= "<a href='".$line->Link."' target='".$line->Target."'>";
													
													$String .= $line->Title."</a></div><div class='messageinfo' ";
									
											if (strlen($line->Description) > 25)
												$String .= 'tooltip="'.$line->Description.'" tooltip_position="bottom" style="cursor:help;"';
											
											$String .= "
											
											>".myTruncate($Description, 25, ' ')."</div>";
											
											//$String .= "</td></tr></table>";
									
										} else {
											
											$String .= "<div class='sender_name'>";
											
											if ($line->Embed != '')
														$String .= '<a href="#" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
												else 
													$String .= "<a href='".$line->Link."' target='".$line->Target."'>";

												$String .= $line->Title."</a></div><div class='messageinfo' ";
							
											if (strlen($line->Description) > 25)
												
												$String .= 'tooltip="'.$line->Description.'" tooltip_position="bottom" style="cursor:help;"';
											
											$String .= "
											
											>".myTruncate($Description, 25, ' ')."</div>";
							
										}
						$String .= "</td><td class=\"updateboxcontent\"></td>
						</tr><tr><td id=\"updateBox_BL\"></td><td id=\"updateBox_B\"></td>
						<td id=\"updateBox_BR\"></td>
						</tr></table>
						<div class='spacer'></div>";
				} 
			$DB2->close();	
		}
		
		//	$String.="<div id='".$ModuleID."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td><td>";
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','ref','new','myvolt');hide_layer('".$ModuleID."_menu', event);\">new dropdown</a><br/>";
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','ref','edit','myvolt');hide_layer('".$ModuleID."_menu', event);\">edit dropdowns</a><br/>";
							
							//	$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','ref','add','myvolt');hide_layer('".$ModuleID."_menu', event);\">add item</a><br/>";
							//	$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','ref_items','edit','myvolt');hide_layer('".$ModuleID."_menu', event);\">edit items</a>";
								
							//$String.="</td><td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div></div>";
	
	} else if ($ModuleType == 'html'){
				$String .='<div class="messageinfo">';
				$String .= nl2br(stripslashes($ModHTML));
				$String .='</div>';
					//$String.="<div id='".$ModuleID."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td><td>";
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','myvolt','edit','myvolt');hide_layer('".$ModuleID."_menu', event);\">edit window</a>";
							
							//$String.="</td><td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div></div>";
	
	} else if ($ModuleType =='mod_template') {

				if ($Template == 'twitter') {
					$String .='<div id="twitter_div" style="width:95%; padding-right:10px;" class="messageinfo">';
					$String .='<div id="twitter_update_list"></div>';
					$String .='<div class="menubar"><a href="http://twitter.com/'.$ContentVariable.'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a></div><script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$ContentVariable.'.json?callback=twitterCallback2&amp;count='.$NumberVariable.'"></script>';
					$String .='</div>';
					
					//$String.="<div id='".$ModuleID."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td><td>";
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','twitter','edit','myvolt');hide_layer('".$ModuleID."_menu', event);\">edit window</a>";
							
							//$String.="</td><td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div></div>";
							
				} else if ($Template == 'excite_single') {
							$query = "select e.Blurb, e.ContentID, e.ContentType, e.Comment, e.Link, u.avatar, u.username, p.thumb as ProjectThumb, e.Thumb as ExciteThumb
		 				 			 from excites as e
		 				 			 left join users as u on (e.ContentID=u.encryptid and e.ContentType='user')
						 			left join projects as p on (e.ContentID=p.ProjectID)
									where e.UserID='$UserID' order by e.CreatedDate DESC";
									$ExciteArray = $DB->queryUniqueObject($query);
									
									if ($ExciteArray->Link == '') {
									
									$String = '<img src="http://www.wevolt.com/images/tuts/create_exite_info.jpg">';
									
									} else {
								
										$Thumb = $ExciteArray->ExciteThumb;
					
								list($width, $height) = @getimagesize($Thumb); 	
								if (($width > 100)  || ($width == ''))
									$width=100;
							$String.='<div align="left"><img src="'.$Thumb.'" border="0" alt="LINK" style="border:none;" align="right" hspace="3" vspace="3" width="'.$width.'"></a><span class="sender_name"><a href="'.$ExciteArray->Link.'">'.$ExciteArray->Blurb.'</a></span><br/><span class="messageinfo">'.$ExciteArray->Comment.'</span></div>';
							}
							
						//	$String.="<div id='".$ModuleID."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td><td>";
							//$String.="<a href='javascript:void(0)' onclick=\"update_excite('');hide_layer('".$ModuleID."_menu', event);\">edit</a><br/><a href='/".trim($_SESSION['username'])."/?t=excites'>archives</a>";
							
						
							//$String.="</td><td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div></div>";
				
				} else if ($Template == 'rss') {
			//	print 'GOT HERE'.'<br/>';
			              include_once($_SERVER['DOCUMENT_ROOT'].'/classes/class.rssnews.php');
							if ($ContentVariable == 'custom')
								$FeedString = @new rssnews('custom',$SearchVariable);
							else
								$FeedString = @new rssnews($ContentVariable,'');
							
						
							$TempString = $FeedString->showFeed();
							
							$content_lowercase = strtolower($TempString);
							$currpos = 0;
							$endpos = strlen($TempString);
							$newcontent = '';
							$lastimgtag = 0;
							$TotalCount = 0;
							//if ($_SESSION['userid'] == '53c0411841f')
							//print $TempString;
							/*
							do
							{
								$imgStart = strpos($content_lowercase, '<img', $currpos);
								if ($imgStart === false) {
									break;

								} else {

									$imgEnd = strpos($content_lowercase, '>', $imgStart);
									$imageTag = substr($TempString, $imgStart, $imgEnd - $imgStart + 1);
									
									$newimgtag = CreateNewImgTag($imageTag);
									$newcontent .= substr($TempString, $lastimgtag, $imgStart - $lastimgtag);
									$newcontent .= $newimgtag;
									$lastimgtag = $imgEnd + 1;
									$currpos = $lastimgtag;
									
									if ($TotalCount == 20)
										$newcontent = preg_replace("/<img[^>]+\>/i", "", $TempString);
									$TotalCount++;
								}
							} while (($currpos < $endpos) && ($TotalCount <21 ));
				
							*/
							if ($newcontent != '')
								$String .= $newcontent;
							else 
								$String .= $TempString;
							
							//print 'STRING = ' . $FeedString->showFeed();
							//	$String.="<div id='".$ModuleID."_menu' style='display:none; position:absolute;' class='action_pop'><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div><table width='100%'><tr>
							//<td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td><td>";
							
						
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','headlines','edit','myvolt');hide_layer('".$ModuleID."_menu', event);\">edit feeds</a><br/>";
							//$String.="<a href='javascript:void(0)' onclick=\"edit_window('".$Cell.'-'.$ModuleID."','headlines','new','myvolt');hide_layer('".$ModuleID."_menu', event);\">add feed</a>";
							
							//$String.="</td><td onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" width='5'></td></tr></table><div  onmouseover=\"hide_layer('".$ModuleID."_menu', event);\" style='height:5px;'></div></div>";
							
	
							
				}
	} else if ($ModuleType =='excite_box') {
	
				$query = "select distinct e.Blurb, e.ContentID, e.ContentType, e.Comment, e.Link, u.avatar, u.username, p.thumb
		 				  from excites as e
						  
		 				  left join users as u on (e.ContentID=u.encryptid and e.ContentType='user')
						  left join projects as p on (e.ContentID=p.ProjectID)
							where e.UserID='$UserID'";
					$DB->query($query);
					
						while ($comic = $DB->FetchNextObject()) {
							if ($comic->ContentType == 'user') 
								$Thumb = $comic->avatar;
							else 
								$Thumb = "http://www.wevolt.com".$comic->thumb;
								
							$String.= "<table border='0' cellspacing='0' cellpadding='0' width='100%'><tr><td id=\"updateBox_TL\"></td><td id=\"updateBox_T\"></td><td id=\"updateBox_TR\"></td></tr><tr><td class=\"updateboxcontent\"></td><td valign='top' class=\"updateboxcontent\"><table width='100%'><tr><td width='55'><img src='/includes/round_images_inc.php?source=".$Thumb."&radius=20&colour=e9eef4' border='2' alt='LINK' style='border-color:#000000;' width='50' height='50'></a></td><td valign='top'><div class='sender_name'><a href='".$comic->Link."'>".$comic->Blurb."</a></div><div class='messageinfo'>".$comic->Comment."</div></div></td></tr></table></td><td class=\"updateboxcontent\"></td></tr><tr><td id=\"updateBox_BL\"></td><td id=\"updateBox_B\"></td><td id=\"updateBox_BR\"></td></tr></table><div class='smspacer'></div>";
						}
		
						
	}

$DB->close();
	
	return $String;
	
}

function build_cell($Title, $Template, $ModuleID, $FeedID, $UserID, $CellID,$SortVariable,$ContentVariable, $SearchVariable, $SearchTags, $Variable1, $Variable2, $Variable3, $Custom, $NumberVariable,$ThumbSize) {
		
	global $ModuleTitleArray,$ModuleIndex,$TypeTarget, $TargetID, $MainWindowIDs;
	$TabString = '';
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	$FeedModuleArray = array(array());	
	$DB = new DB();
	$query = "SELECT * from feed_modules where FeedID='$FeedID' and CellID = '$CellID' and IsMain = 1";
	$MainWindowArray = $DB->queryUniqueObject($query);

	$MainWindowTitle = $MainWindowArray->Title;
	$MainWindowID = $MainWindowArray->EncryptID;
	//print 'Main Title = ' . $MainWindowTitle;
	
	$ModuleTemplate = $MainWindowArray->ModuleTemplate;
	$ModuleType = $MainWindowArray->ModuleType;

	
	if ($MainWindowID == '') {
		$NOW = date('Y-m-d h:i:s');
		$NewTitle = $ModuleTitleArray[$ModuleIndex]['Title'];
		if ($NewTitle == '')
			$NewTitle = 'New List';
		
		if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'excite') {
				 $ModuleTemplate = 'excite_single';
				 $ModuleType = 'mod_template';
				 $NewTitle = 'Excite';
				  $IntroContent = '<img src="http://www.wevolt.com/images/tuts/create_headlines.jpg">';
		} else if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'headlines') {
				 $ModuleTemplate = 'rss';
				 $ModuleType = 'mod_template';
				$IntroContent = '<img src="http://www.wevolt.com/images/tuts/create_headlines.jpg">';
		} else {
			 $ModuleTemplate = 'list';
			 $ModuleType = 'box_list';
			  $IntroContent = '<img src="http://www.wevolt.com/images/tuts/create_list.jpg">';
		}
		
			
		if ($ModuleTemplate == 'excite_single') {
			$query = "INSERT into feed_modules (Title,FeedID, CellID, IsMain, ModuleType, ModuleTemplate,CreateDate) values ('$NewTitle', '$FeedID', '$CellID', 1, '$ModuleType', '$ModuleTemplate','$NOW')";
			$DB->execute($query);
			$query ="SELECT ID from feed_modules WHERE FeedID='$FeedID' and CellID='$CellID' and CreateDate='$NOW'";
			$NewID = $DB->queryUniqueValue($query);
			$Encryptid = substr(md5($NewID), 0, 12).dechex($NewID);
			$query = "UPDATE feed_modules SET EncryptID='$Encryptid' WHERE ID='$NewID'";
			$DB->execute($query);
			$query = "SELECT * from feed_modules where FeedID='$FeedID' and CellID = '$CellID' and IsMain = 1";
			$MainWindowArray = $DB->queryUniqueObject($query);
			$MainWindowTitle = $MainWindowArray->Title;
			$MainWindowID = $MainWindowArray->EncryptID;
		} else {
			$MainWindowID = 'noneset-'.$ModuleIndex;
			$MainWindowTitle = '-----------------';
			$NotSetup = 1;
		}
			
		
	
	} 
	$ModuleTabIDArray[] = $MainWindowID;
	$MainWindowIDs[] =  $MainWindowID;
	$query = "SELECT count(*) from feed_modules where FeedID='$FeedID' and CellID = '$CellID' order by Position"; 
	$TotalTabs = $DB->queryUniqueValue($query);
	
	$DivString = '<div id="'.$CellID.'">'; 
		
	$ModuleString = '
	
	<!-- MODULE  -->
<table width="'.$ModuleTitleArray[$ModuleIndex]['Width'].'" height="'
.$ModuleTitleArray[$ModuleIndex]['Height'].'" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="fatmodtopleft"></td>

	<td id="fatmodtop" width="'.($ModuleTitleArray[$ModuleIndex]['Width']-40).'" valign="bottom">';
	
	//$ModuleTabIDArray = array($ModuleID);


	  $PopMenuString .= build_popup_menus($MainWindowID,$CellID,$ModuleTemplate,$ModuleType,$NotSetup);
	   $MenuStars = '<img src="http://www.wevolt.com/templates/modules/standard/action_star.png" hspace="3" vspace="3" border="0" width="15" class="navbuttons" id="'.$MainWindowID.'_star">';
	if ($ModuleTitleArray[$ModuleIndex]['Tabs'] == 0) {
		$TabString .='<div class="mod_title">'.$ModuleTitleArray[$ModuleIndex]['Title'].'</div><div style="height:2px;"></div>';	
	
	} else {
		$TabString .= '<table border="0" cellpadding="0" cellspacing="0"><tbody><tr>';
	
		$TabString .= '<td><select name="txtModuleSelect" onChange="mod_tab(this.options[this.selectedIndex].value);" style="width:125px; height:20px; font-size:12px;">'; 
		
		$query = "SELECT * from feed_modules where FeedID='$FeedID' and CellID = '$CellID' and IsMain=0 order by Position"; 
		$DB->query($query);

		$NumSubModules = $DB->numRows();
	//	print 'Main Window title = ' . $MainWindowTitle.'<br/>';

		$TabString .= '<option value=\''.$CellID.'-'.$MainWindowID.'\'>'.$MainWindowTitle.'</option>';
		
		while ($line = $DB->fetchNextObject()) {
				$ModuleTabIDArray[] = $line->EncryptID;
				//print 'SUB TITLE = ' .$line->Title .'<br/>';
				//print 'SUB MOD = ' .$line->EncryptID .'<br/>';
				$PopMenuString .= build_popup_menus($line->EncryptID,$CellID,$line->ModuleTemplate,$line->ModuleType);
				$TabString .= '<option value=\''.$CellID.'-'.$line->EncryptID.'\'>'.$line->Title.'</option>';
				$MenuStars .= '<img src="http://www.wevolt.com/templates/modules/standard/action_star.png" hspace="3" vspace="3" border="0" width="15" class="navbuttons" id="'.$line->EncryptID.'_star" style="display:none;">';
		}
	
		$TabString .= '</select></td></tr></table>';
	
	}
	

	$ModuleString .= $TabString.'<div style="height:4px;"></div></td><td id="fatmodtopright" valign="top" align="left"><div style="height:2px; "></div><div id="'.$CellID.'_menu"></div>'.$MenuStars.'</td>

</tr>
<tr>
	
	<td valign="top" colspan="3"  width="'.($ModuleTitleArray[$ModuleIndex]['Width']-2).'">
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" height="'.$ModuleTitleArray[$ModuleIndex]['Height'].'"  width="'.($ModuleTitleArray[$ModuleIndex]['Width']-2).'">
	<div style="height:'.$ModuleTitleArray[$ModuleIndex]['Height'].'px;overflow:auto;" align="center">';

	
	
	//$DivString .= $TabString;
	$ModCount = 0;
	//print_r($ModuleTabIDArray);
	foreach($ModuleTabIDArray as $module) {
		if ($ModCount > 0) {
			$Display = 'none';
			$ModuleTabList .= ','.$module;
		} else {
			$Display = 'block';
			$ModuleTabList = $module;
		}		
			$ModuleString .= '<div id="'.$module.'_div" style="display:'.$Display.';">';
		
		if ($TotalTabs == 0) 
			$ModuleString .= $IntroContent;
		else
			$ModuleString .= get_feed_items($module, $FeedID, $UserID);
		
		$ModuleString .= '</div>';
		$ModCount++;
	}
	
	
	$ModuleString .= '<input id="'.$CellID.'_tabs" value="'.$ModuleTabList.'" type="hidden"></div>';
	
	$ModuleString .='
	<div class="spacer"></div>
	</td>
	<td id="modrightside"></td>

	</tr>
	<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
	</table>
	
	</td>
</tr>


</table>'.
$PopMenuString.'
<!-- END MODULE  -->';
	$DB->close();
	return $ModuleString;

}

?>