<? 
function myTruncate($string, $limit, $break=".", $pad="...") { 

if(strlen($string) <= $limit) return $string; 

if(false !== ($breakpoint = strpos($string, $break, $limit))) { if($breakpoint < strlen($string) - 1) { $string = substr($string, 0, $breakpoint) . $pad; } } return $string; 

}
function build_popup_menus($MenuModule,$CellID,$MenuModuleTemplate,$MenuModuleType, $ContentVariable,$NotSetup='') {
global $ModuleTitleArray,$ModuleIndex, $UserID;

		$PopMenuString .='<ul id="'.$MenuModule.'_menu" style="display:none;">';
					if ($MenuModuleType == 'mod_template') {
						if ($MenuModuleTemplate == 'twitter') {

							
							$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\" onclick=\"edit_window('".$CellID.'-'.$MenuModule."','twitter','edit','myvolt');\">Edit Window</a></li>";
							
						} else if ($MenuModuleTemplate == 'rss') {
					
							$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','headlines','edit','myvolt');\">Edit Feeds</a></li>";
							$PopMenuString.="<li class=\"edit\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','headlines','new','myvolt');\">Add Feed feed</a></li>";
							
						} else if ($MenuModuleTemplate == 'excite_single') {
									$PopMenuString.='<li class="edit"><a href="javascript:void(0)" onclick="re_excite(\''.$MenuModule.'\');">Edit</a></li>';

						}
					
					
					} else if ($MenuModuleType == 'excite_box') {

					} else if ($MenuModuleType == 'html') {
					
					
					} else if ($MenuModuleType == 'list') {
							if ($_SESSION['userid'] != '')
								$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\"  onclick=\"copy_items('".$CellID.'-'.$MenuModule."');\">Copy Items</a></li>";
			
					}
					
				
				if ($_SESSION['userid'] == $UserID){
						$PopMenuString.='<li class="cut separator"><a>--ADMIN MENU--</a></li>';
						
						$PopMenuString.="<li class=\"cut separator\"><a href=\"javascript:void(0)\" onclick=\"window_wizard('edit');\">Dropdown Wizard</a></li>";
						if (($NotSetup == '') || ($NotSetup == '0')){
							$PopMenuString.="<li class=\"cut separator\"><a href='javascript:void(0)' onclick=\"edit_window('".$CellID.'-'.$MenuModule."','list','edit','wevolt');\">List All Dropdowns</a></li>";
						
							$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\" onclick=\"edit_wevolt_window('".$CellID."-".$MenuModule."');\">Edit Dropdown</a></li>";
							
							$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\" onclick=\"edit_window('".$CellID.'-'.$MenuModule."','items','add','wevolt');\">Add Item</a></li>";
							$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\" onclick=\"edit_window('".$CellID.'-'.$MenuModule."','items','edit','wevolt');\">Edit Items</a></li>";
						}
						$PopMenuString.="<li class=\"edit\"><a href=\"javascript:void(0)\" onclick=\"edit_wevolt_window_label('".$CellID."');\">Edit Window Label</a></li>";
				}
				$PopMenuString .='</ul>';
				
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
	
	global $ModuleTitleArray,$ModuleIndex, $IsFriend, $IsOwner, $IsFan; 
	$DB = new DB();
	$String = '';
	$query = "SELECT * from feed_modules where EncryptID='$ModuleID'";
	$ModuleArray = $DB->queryUniqueObject($query);
	
	$SortVariable = $ModuleArray->SortVariable;
	$NumberVariable = $ModuleArray->NumberVariable;
	$Custom = $ModuleArray->Custom;
	$ContentVariable = $ModuleArray->ContentVariable;
	$ThumbSize = $ModuleArray->ThumbSize;
	$Template = $ModuleArray->ModuleTemplate;
	$ModuleType = $ModuleArray->ModuleType;
	$ModHTML = $ModuleArray->HTMLCode;
	$Cell = $ModuleArray->CellID;

	if ($ModuleType == 'content'){
			
		if ($ContentVariable == 'comic') {
			
			if ($SortVariable == 'excites') {
				$query = "SELECT distinct ContentID, Thumb, Link from excites where ContentType='comic'  group by ContentID order by CreatedDate DESC LIMIT $NumberVariable ";
				$DB->query($query);
				while ($line = $DB->fetchNextObject()) {
						$String .= '<a href="'.$line->Link.'/">';
						$String .= '<img src="'.$line->Thumb.'" hspace="4" vspace="4" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"></a>';
					}
				
				
			} else {
				
				$query = "SELECT * from projects where Published=1 and Pages>1 and thumb!='' and ProjectType='comic' and Hosted=1 order by $SortVariable DESC LIMIT $NumberVariable ";
				$DB->query($query);
			
					while ($line = $DB->fetchNextObject()) {
						$String .= '<a href="http://www.wevolt.com/'.$line->SafeFolder.'/">';
						if ($line->WorldID=='z')
						$String .= '<img src="'.$line->thumb.'" hspace="4" vspace="4" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"></a>';
						else
						
						$String .= '<img src="http://www.wevolt.com'.$line->thumb.'" hspace="4" vspace="4" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"></a>';
					}
			}
		}

	} else if ($ModuleType == 'list'){
		
		$query = "SELECT * from feed_items 
				  where WeModule='$ModuleID' and WeFeed='$FeedID' and UserID='$UserID' and IsPublished=1";
				  
				 
		$where = " and ((PrivacySetting='public') or (PrivacySetting='')";
		 if ($IsFriend)
			$where .= " or (PrivacySetting ='friends') or (PrivacySetting ='fans') ";
		 else if ($IsFan)
			$where .= " or (PrivacySetting ='fans') ";
		 else if ($IsOwner) 
			$where .= " or (PrivacySetting ='friends') or (PrivacySetting ='fans') or (PrivacySetting ='private') ";
		 $where .=")";
			
		 $query .= $where ." order by WeModule, WePosition";
				  
		$DB->query($query);
		
	//	print '<br/>';
		$ItemCount = 0;
		$CloseTable = 0;
		$TotalItems =$DB->numRows();
		
		while ($line = $DB->fetchNextObject()) {
				$DB2 = new DB();
				$ItemCount++;
			   $ProjectID = $line->ProjectID;
			   $ContentID = $line->ContentID;
				$ModuleWidth = $ModuleTitleArray[$ModuleIndex]['Width'];
			
			   	if ($Template == 'content_thumb') {
					
						if ($line->Embed != '') {
		
							$String .= '<a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
							$Thumb = $line->Thumb;
							
							
						} else if ($line->ItemType == 'project_link') {
							
							$query = "SELECT * from projects where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeFolder;
							$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">';
							$Thumb = 'http://www.wevolt.com/'.$ProjectArray->thumb;
						} else if ($line->ItemType == 'feed_link') {
							$query = "SELECT * from feed where ProjectID='$ProjectID'";
							$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
						} else if ($line->ItemType == 'user_link') {
							$query = "SELECT * from users where encryptid='$ContentID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
								$Thumb = $ProjectArray->avatar;
						} else if ($line->ItemType == 'external_link'){
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}else {
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}
						
						$String .= '<img src="'.$Thumb.'"  hspace="3" vspace="3" border="2" style="border-color:#000000;" width="'.$ThumbSize.'">';
						
						$String .= '</a>';
						
				} else if ($Template == 'content_thumb_title') {
						$TotalItemsAvailable = floor($ModuleWidth/$ThumbSize);
				
						if ($String == '') 
							$String .= '<table  width="100%"><tr>';
						if ($ItemCount > $TotalItemsAvailable) {
							$String .= '</tr><tr>';
							$ItemCount = 1;
							
						}
						
						$String .= '<td align="center">'.$line->Title.'<br/>';
						$CloseTable = 1;
						if ($line->Embed != '') {
		
							$String .= '<a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
							$Thumb = $line->Thumb;
							
							
						} else if ($line->ItemType == 'project_link') {
							
							$query = "SELECT * from projects where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeFolder;
							$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">';
							$Thumb = 'http://www.wevolt.com/'.$ProjectArray->thumb;
						} else if ($line->ItemType == 'feed_link') {
							$query = "SELECT * from feed where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeTitle;
							$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
						} else if ($line->ItemType == 'user_link') {
							$query = "SELECT * from users where encryptid='$ContentID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
						//	print $query;
							$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
								$Thumb = $ProjectArray->avatar;
						} else if ($line->ItemType == 'external_link'){
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}else {
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}
						
						$String .= '<img src="'.$Thumb.'"  hspace="5" vspace="5" border="2" style="border-color:#000000;" width="'.$ThumbSize.'" >';
						
						$String .= '</a>';
						$String .= '</td>';
						
				}else if ($Template == 'content_thumb_title_desc') {
						
						if ($ModuleWidth < 250) {
							$TotalItemsAvailable = 1;
							$ItemWidth = '100%';
						} else if (($ModuleWidth > 250) && ($ModuleWidth < 500)) {
							$TotalItemsAvailable = 2;
							$ItemWidth = '50%';
						} else if (($ModuleWidth > 500) && ($ModuleWidth < 800)) {
							$TotalItemsAvailable = 3;
							$ItemWidth = '33%';
						} else if ($ModuleWidth >= 800) {
							$TotalItemsAvailable = 4;
							$ItemWidth = '25%';
						}
					
						
				
						if ($String == '') 
							$String .= '<table width="100%">';
						$String .= '<tr><td align="left" valign="top" width="'.$ItemWidth.'">';
						$TempString = '<span class="sender_name">'.$line->Title.'</span><br/><span class="messageinfo">'.nl2br(stripslashes($line->Description)).'</span>';
						$CloseTable = 1;
						if ($line->Embed != '') {
		
							$String .= '<a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
							$Thumb = $line->Thumb;
							
							
						} else if ($line->ItemType == 'project_link') {
							
							$query = "SELECT * from projects where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeFolder;
							$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">';
							$Thumb = 'http://www.wevolt.com/'.$ProjectArray->thumb;
						} else if ($line->ItemType == 'feed_link') {
							$query = "SELECT * from feed where ProjectID='$ProjectID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
							$ProjectType = $ProjectArray->ProjectType;
							$ProjectTarget = $ProjectArray->SafeTitle;
							$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
						} else if ($line->ItemType == 'user_link') {
							$query = "SELECT * from users where encryptid='$ContentID'";
							$ProjectArray = $DB2->queryUniqueObject($query);
						//	print $query;
							$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
								$Thumb = $ProjectArray->avatar;
						} else if ($line->ItemType == 'external_link'){
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						} else {
							$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">';
							$Thumb = $line->Thumb;
						}
						
						$String .= '<img src="'.$Thumb.'"  hspace="3" vspace="3" border="2" style="border-color:#000000;" width="'.$ThumbSize.'"  align="left">';
						
						$String .= '</a>';
						$String .= $TempString.'<div class="spacer"></div></td></tr>';
						
				} else if ($Template == 'content_list') {
						
							if ($line->Embed != '') {
		
							$String .= '<a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
							$Thumb = $line->Thumb;
							
							
						} else if ($line->ItemType == 'project_link') {
								$query = "SELECT * from projects where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">LINK</a></div><div class="medspacer"></div>';
						
							
						
							} else if ($line->ItemType == 'feed_link') {
								$query = "SELECT * from feed where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
							
							}  else if ($line->ItemType == 'user_link') {
								$query = "SELECT * from users where encryptid='$ContentID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
						
							} else if ($line->ItemType == 'external_link') {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								if ($line->Link != '')
									$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">LINK</a>';
								$String .= '</div><div class="medspacer"></div>';
							
											
							} else {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								if ($line->Link != '')
									$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">LINK</a>';
								$String .= '</div><div class="medspacer"></div>';
								
							}
						
							
				} else if ($Template == 'content_list_link') {
							
						if ($line->Embed != '') {
								$String .= '<div class="sender_name"><a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">'.$line->Title.'</a></div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
							
							
						} else if ($line->ItemType == 'project_link') {
								$query = "SELECT * from projects where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<div class="sender_name">'.$line->Title.'</div>';

								$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">LINK</a></div><div class="medspacer"></div>';
						
							
						
							} else if ($line->ItemType == 'feed_link') {
								$query = "SELECT * from feed where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
							
							}  else if ($line->ItemType == 'user_link') {
								$query = "SELECT * from users where encryptid='$ContentID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectTarget = trim($ProjectArray->username);
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/?t=profile">';
									 
							$String .= $line->Title;
							
							$String .= '</a>';
						
							} else if ($line->ItemType == 'external_link') {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">LINK</a></div><div class="medspacer"></div>';
											
							} else {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<a href="'.$line->Link.'">LINK</a></div><div class="medspacer"></div>';
								
							}
						
							
				}else if ($Template == 'content_list_desc') {
							
							if ($line->Embed != '') {
		
							$String .= '<a href="javascript:void(0)" onclick="play_embed(\''.$line->EncryptID.'\',\''.$ModuleID.'\',\''.(intval($line->EmbedWidth) +40).'\',\''.(intval($line->EmbedHeight) +100).'\');">';
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
							
							
						} else if ($line->ItemType == 'project_link') {
								$query = "SELECT * from projects where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">LINK</a></div><div class="medspacer"></div>';
						
							} else if ($line->ItemType == 'feed_link') {
								$query = "SELECT * from feed where ProjectID='$ProjectID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectType = $ProjectArray->ProjectType;
								$ProjectTarget = $ProjectArray->SafeFolder;
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="http://www.wevolt.com/'.$ProjectTarget.'/">LINK</a></div><div class="medspacer"></div>';
							
							}  else if ($line->ItemType == 'user_link') {
								$query = "SELECT * from users where encryptid='$ContentID'";
								$ProjectArray = $DB2->queryUniqueObject($query);
								$ProjectTarget = trim($ProjectArray->username);
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="http://users.wevolt.com/'.$ProjectTarget.'/">LINK</a></div><div class="medspacer"></div>';
						
							} else if ($line->ItemType == 'external_link') {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">LINK</a></div><div class="medspacer"></div>';
											
							}else {
								$String .= '<div class="sender_name">'.$line->Title.'</div>';
								$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'<br/>';
								$String .= '<a href="'.$line->Link.'" target="'.$line->Target.'">LINK</a></div><div class="medspacer"></div>';
											
							}
						
							
				} else if ($Template == 'info_list') {
							$String .= '<div class="sender_name">'.$line->Title.'</div>';
							$String .= '<div class="messageinfo">'.nl2br(stripslashes($line->Description)).'</div>';
				} 
				
			$DB2->close();	
		}

	} else if ($ModuleType == 'custom'){
				$String .='<div class="messageinfo">';
				$String .= nl2br(stripslashes($ModHTML));
				$String .='</div>';
	 		
						
	} else if ($ModuleType =='mod_template') {
				if ($Template == 'twitter') {
					
					$String .='<div id="tweet_'.$ModuleID.'" align="left" style="width:95%; padding-right:10px;" class="messageinfo">';
 					$String .='<div align=\'center\'>Please wait while my tweets load <img src="http://www.wevolt.com/images/load.gif" />';
 					$String .='<p><a href="http://twitter.com/'.$TwitterName.'">If you can\'t wait - check out what I\'ve been twittering</a></p></div>';
					$String .='<div class="menubar"><a href="http://twitter.com/'.$ContentVariable.'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a></div><script type="text/javascript" charset="utf-8">
getTwitters(\'tweet_'.$ModuleID.'\', { 
  id: \''.$ContentVariable.'\', 
  count: '.$NumberVariable.', 
  enableLinks: true, 
  ignoreReplies: true, 
  clearContents: true,
  template: \'%text% <br/><a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a><div style="height:5px;"></div>\'
});
</script>';
					
				
					
					$String .='</div>';
				
									
				} else if ($Template =='excite_status') {
				$query = "select distinct e.Blurb, e.ContentID, e.ContentType, e.CreatedDate, e.Comment, e.Link, u.avatar, u.username, e.Thumb as ExciteThumb
		 				  from excites as e
						  
		 				  left join users as u on (e.ContentID=u.encryptid and e.ContentType='user')
						 
							where e.UserID='$UserID' order by e.CreatedDate DESC limit 5";
					$DB->query($query);
					
						while ($comic = $DB->FetchNextObject()) {
						
					
							$Thumb = $comic->ExciteThumb;
								
							$Comment = preg_replace('/[^(\x20-\x7F)]*/','', $comic->Comment);

							$String.= "<table border='0' cellspacing='0' cellpadding='0' width='100%'><tr><td id=\"updateBox_TL\"></td><td id=\"updateBox_T\"></td><td id=\"updateBox_TR\"></td></tr><tr><td class=\"updateboxcontent\"></td><td valign='top' class=\"updateboxcontent\"><a href='".$comic->Link."'><img src='".$Thumb."'border='2' alt='LINK' style='border-color:#000000;' width='50' align='left' hspace='5' vspace'3'></a><div class='sender_name'><a href='".$comic->Link."'>".$comic->Blurb."</a></div><div class='messageinfo'>".nl2br($Comment)."</div></div></td><td class=\"updateboxcontent\"></td></tr><tr><td id=\"updateBox_BL\"></td><td id=\"updateBox_B\"></td><td id=\"updateBox_BR\"></td></tr></table><div class='smspacer'></div>";

						}
						//if ($_SESSION['userid'] != '')
							//$MenuString.="<a href='#' onclick=\"re_excite('".$ModuleID."');hide_layer('".$ModuleID."_menu', event);\">RE-EXCITE</a>";
					
	
	}else if ($Template =='excite_single') {
				$query = "select distinct e.Blurb, e.ContentID, e.ContentType, e.CreatedDate, e.Comment, e.Link, u.avatar, u.username, e.Thumb as ExciteThumb
		 				  from excites as e
						  
		 				  left join users as u on (e.ContentID=u.encryptid and e.ContentType='user')
						
							where e.UserID='$UserID' order by e.CreatedDate DESC limit 1";
					$DB->query($query);
					
						while ($comic = $DB->FetchNextObject()) {
						
				
										$Thumb = $comic->ExciteThumb;
				
															
															
								
							$Comment = preg_replace('/[^(\x20-\x7F)]*/','', $comic->Comment);

							$String.= "<table border='0' cellspacing='0' cellpadding='0' width='100%'><tr><td id=\"updateBox_TL\"></td><td id=\"updateBox_T\"></td><td id=\"updateBox_TR\"></td></tr><tr><td class=\"updateboxcontent\"></td><td valign='top' class=\"updateboxcontent\"><a href='".$comic->Link."'><img src='".$Thumb."'border='2' alt='LINK' style='border-color:#000000;' width='50' align='left' hspace='5' vspace'3'></a><div class='sender_name'><a href='".$comic->Link."'>".$comic->Blurb."</a></div><div class='messageinfo'>".nl2br($Comment)."</div></div></td><td class=\"updateboxcontent\"></td></tr><tr><td id=\"updateBox_BL\"></td><td id=\"updateBox_B\"></td><td id=\"updateBox_BR\"></td></tr></table><div class='smspacer'></div>";

						}
					//	if ($_SESSION['userid'] != '')
						//	$MenuString.="<a href='#' onclick=\"re_excite('".$ModuleID."');hide_layer('".$ModuleID."_menu', event);\">RE-EXCITE</a>";
					
	
	}
	
	}

	if ($CloseTable == 1)
		$String .='</tr></table>';
	
	$DB->close();
	
	return $String;
	 
}

function build_cell($Title, $Template, $ModuleID, $FeedNum, $UserID, $CellID,$SortVariable,$ContentVariable, $SearchVariable, $SearchTags, $Variable1, $Variable2, $Variable3, $Custom, $NumberVariable,$ThumbSize) {
		include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	global $ModuleTitleArray,$ModuleIndex,$TypeTarget, $TargetID,$MainWindowIDs,$ModHeight,$ModWidth, $IsFriend, $IsOwner, $IsFan,$FeedID; 
	$TabString = '';
	$NotSetup = 0;
	$DB = new DB();
	$FeedModuleArray = array(array());	
	$query = "SELECT EncryptID, Title from feed_modules where FeedID='$FeedID' and IsMain = 1";
	$MainWindowArray = $DB->queryUniqueObject($query);	
	
	$MainWindowTitle = $MainWindowArray->Title;
	$MainWindowID = $MainWindowArray->EncryptID;
	if ($MainWindowID == '') {
		$NOW = date('Y-m-d h:i:s');
		$NewTitle = $ModuleTitleArray[$ModuleIndex]['Title'];
		if ($NewTitle == '')
			$NewTitle = 'New List';
					
			 $ModuleTemplate = 'list';
			 $ModuleType = 'content_list';
			 if ($UserID == $_SESSION['userid']) 
			 	 $IntroContent = '<img src="http://www.wevolt.com/images/tuts/create_wevolt_user.jpg">';
			 else 
			 	 $IntroContent = '<img src="http://www.wevolt.com/images/tuts/create_wevolt_no_user.jpg">';
			
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
			$MainWindowTitle = 'INACTIVE<--';
			$NotSetup = 1;
		}
			
		
	
	} 
	$query = "SELECT count(*) from feed_modules where FeedID='$FeedID' order by Position"; 
	$TotalTabs = $DB->queryUniqueValue($query);
	$ModuleTabIDArray[] = $MainWindowID;
	$MainWindowIDs[] =  $MainWindowID;
	$DivString = '<div id="'.$CellID.'">'; 
	
	if ($_SESSION['IsPro'] == 1){ 
		$ModHeight = $ModuleTitleArray[$ModuleIndex]['Height'];
		    if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'SinglexSingle')
				$ModWidth = $ModuleTitleArray[$ModuleIndex]['Width']+50;
			else if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'DoublexSingle')
				$ModWidth = $ModuleTitleArray[$ModuleIndex]['Width'] + 100;
			else if ($ModuleTitleArray[$ModuleIndex]['Template'] == 'DoublexDouble')
				$ModWidth = $ModuleTitleArray[$ModuleIndex]['Width'] +50;
		
		
	}else {
			$ModTemplateArray = explode('x',$ModuleTitleArray[$ModuleIndex]['Template']);
			if ($ModTemplateArray[0] == 'Single')
				$ModHeight = $ModuleTitleArray[$ModuleIndex]['Height'] - 90;
			else if ($ModTemplateArray[0] == 'Double')
				$ModHeight = $ModuleTitleArray[$ModuleIndex]['Height'] - 45;
			else if ($ModTemplateArray[0] == 'Triple')
				$ModHeight = $ModuleTitleArray[$ModuleIndex]['Height'] - 30;
			
			$ModWidth = $ModuleTitleArray[$ModuleIndex]['Width'];
		
	}
	$ModuleString = '<table width="100%"><tr><td><div><select name="txtModuleSelect" onChange="mod_tab(this.options[this.selectedIndex].value);" style="width:95%; height:20px; font-size:12px;">'; 

	$TabString .= '<option value=\''.$CellID.'-'.$MainWindowID.'\'  selected style="background-color:#fed800;color:#000000;cursor:pointer;">-->'.$MainWindowTitle.'</option>';


		
	$query = "SELECT * from feed_modules where FeedID='$FeedID' and IsMain=0 ";
	
	$where = " and ((Privacy='public') or (Privacy='')";
	
	if ($IsFriend)
		$where .= " or (Privacy ='friends') or (Privacy ='fans') ";
	else if ($IsFan)
		$where .= " or (Privacy ='fans') ";
	else if ($IsOwner) 
			$where .= " or (Privacy ='friends') or (Privacy ='fans') or (Privacy ='private') ";
	$where .=")";
			
	$query .= $where ." order by Position";
	$DB->query($query);
	
	 $PopMenuString .= build_popup_menus($MainWindowID,$CellID,$ModuleTemplate,$ModuleType, $MainWindowArray->ContentVariable,$NotSetup);
	 $MenuStars = '<img src="http://www.wevolt.com/templates/modules/standard/action_star.png" hspace="3" vspace="3" border="0" width="15" class="navbuttons" id="'.$MainWindowID.'_star">';
		$NumSubModules = $DB->numRows();
		
	//	print $query .'<br/>';
		while ($line = $DB->fetchNextObject()) {
				$ModuleTabIDArray[] = $line->EncryptID;
				$PopMenuString .= build_popup_menus($line->EncryptID,$CellID,$line->ModuleTemplate,$line->ModuleType,$MainWindowArray->ContentVariable);
				$TabString .= '<option value=\''.$CellID.'-'.$line->EncryptID.'\'  style="background-color:#fed800;color:#000000; cursor:pointer;">-->'.$line->Title.'</option>';
				$MenuStars .= '<img src="http://www.wevolt.com/templates/modules/standard/action_star.png" hspace="3" vspace="3" border="0" width="15" class="navbuttons" id="'.$line->EncryptID.'_star" style="display:none;">';
		}
		
		
	$TabString .= '</select></div>';

	$ModuleString .= $TabString.'</td><td width="25"><div id="'.$CellID.'_menu"></div>'.$MenuStars.'
	</td></tr></table><div style="height:600px;overflow:auto;" align="center">';

	$ModCount = 0;
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
	

</div>'.
$PopMenuString.'
<!-- END MODULE  -->';
	$DB->close();
	return $ModuleString;

}

?>