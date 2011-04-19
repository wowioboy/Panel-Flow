<? 

function getStatsModule($UserID, $UserType='user') {
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	$DB = new DB();
	$query ="SELECT u.*,
						(SELECT count(*) from follows as f where f.follow_id=u.encryptid and f.type='user') as Fans,
						(SELECT count(*) from projects as p where ((p.userid=u.encryptid) or (p.CreatorID=u.encryptid))) as TotalProjects,
						(SELECT count(*) from pf_forum_boards as fb where ((fb.UserID=u.encryptid) and (fb.ProjectID=''))) as TotalForumBoards,
						(SELECT count(*) from pf_forum_topics as ft where ((ft.UserID=u.encryptid) and (ft.ProjectID=''))) as TotalForumTopics,
						(SELECT count(*) from pf_forum_messages as fm where ((fm.UserID=u.encryptid) and (fm.ProjectID=''))) as TotalForumPosts,
						(SELECT count(*) from pagecomments as pc where pc.userid=u.encryptid) as TotalComments,
						(SELECT count(*) from feed_items as fi where fi.UserID=u.encryptid) as TotalVolts,
						(SELECT count(*) from excites as e where e.UserID=u.encryptid) as TotalExcites
						from users as u
						where u.encryptid='$UserID'";
	
	$StatArray = $DB->queryUniqueObject($query);
	$String ='<table width="100%" cellspacing="5" cellpadding="5">
				<tr>
					<td class="blue_cell_title" width="150"><b>Last Login</b></td>
					<td class="blue_cell_text">'.date('m-d-Y',strtotime($StatArray->LastLogin)).'</td>
				</tr>
				<tr>
					<td class="blue_cell_title" width="150">Rank</td>
					<td class="blue_cell_text">'.$StatArray->level.' ('.$StatArray->xp.' xp)</td>
				</tr>';
				if ($StatArray->TotalProjects != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150"># Projects</td>
						<td class="blue_cell_text"><a href="http://users.wevolt.com/'.$StatArray->username.'/?tab=projects">'.$StatArray->TotalProjects.'</a></td>
					</tr>';
				if ($StatArray->TotalFans != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150"># Fans</td>
						<td class="blue_cell_text"><a href="http://users.wevolt.com/'.$StatArray->username.'/?tab=networks">'.$StatArray->TotalFans.'</a></td>
					</tr>';
					
				if ($StatArray->TotalForumBoards != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150">Forum Boards</td>
						<td class="blue_cell_text"><a href="http://www.wevolt.com/w3forum/'.$StatArray->username.'/">'.$StatArray->TotalForumBoards.'</a></td>
					</tr>';
					
				if ($StatArray->TotalForumTopics != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150">Total Topics</td>
						<td class="blue_cell_text">'.$StatArray->TotalForumTopics.'</td>
					</tr>';
				
				if ($StatArray->TotalForumPosts != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150">Total Posts</td>
						<td class="blue_cell_text">'.$StatArray->TotalForumPosts.'</td>
					</tr>';
				
				if ($StatArray->TotalComments != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150">Comments Left</td>
						<td class="blue_cell_text">'.$StatArray->TotalComments.'</td>
					</tr>';
					
				/*if ($StatArray->TotalVolts != 0)
					$String .='<tr>
						<td class="blue_cell_title" width="150"># Volts</td>
						<td class="blue_cell_text">'.$StatArray->TotalVolts.'</td>
					</tr>';*/
				
				$String .='</table>';
				
	$DB->close();
	return $String;
	
}


function getShoutBoxModule($UserID, $UserType='user') {
		$CellString .= build_cell($line->Title,$line->ModuleTemplate, $line->EncryptID, $FeedID, $UserID, 'Celll1', $line->SortVariable,$line->ContentVariable, $line->SearchVariable, $line->SearchTags, $line->Variable1, $line->Variable2, $line->Variable3, $line->Custom, $line->NumberVariable, $line->ThumbSize);
				
		return $CellString;	
}

function getTwitterModule($Twittername) {
	
$String .='<div id="tweets" align="left" style="width:95%; padding-right:10px;" class="grey_text">';
 					$String .='<div align=\'center\'>Please wait while my tweets load...';
 					$String .='<p><a href="http://twitter.com/'.$Twittername.'">If you can\'t wait - check out what I\'ve been twittering</a></p></div>';
					$String .='<div class="menubar"><a href="http://twitter.com/'.$Twittername.'" id="twitter-link" style="display:block;text-align:right;">follow me on Twitter</a></div><script type="text/javascript" charset="utf-8">
getTwitters(\'tweets\', { 
  id: \''.$Twittername.'\', 
  count: 5, 
  enableLinks: true, 
  ignoreReplies: true, 
  clearContents: true,
  template: \'%text% <div style="height:5px;"></div><div align="right"><a href="http://twitter.com/%user_screen_name%/statuses/%id%/">%time%</a></div><div style="height:10px;"></div>\'
});
</script>';
					$String .='</div>';	
					
					return $String;
	
	
}
function getCreatorProjectsModule($UserID, $UserType='user') {
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	$DB = new DB();
	$query = "select * from projects where installed = 1 and Hosted=1 and IsPublic=1 and (CreatorID ='$UserID' or userid='$UserID') and ProjectType !='forum' ORDER BY title ASC";
//GET LIST OF COMICS USER ASSISTS
$counter = 0;
$String = "<table width=\"100%\"><tr>";
$DB->query($query);
$NumComics = $DB->numRows();
    while ($line = $DB->fetchNextObject()) {  
	  		$UpdateDay = substr($line->PagesUpdated, 5, 2); 
			$UpdateMonth = substr($line->PagesUpdated, 8, 2); 
			$UpdateYear = substr($line->PagesUpdated, 0, 4);
			$Updated = $UpdateDay.".".$UpdateMonth.".".$UpdateYear;
			$SafeFolder = $line->SafeFolder; 
			$ComicDir = $line->HostedUrl; 
 			$String .= "<td valign=\"top\" width=\"55\"><a href=\"http://www.wevolt.com/".$SafeFolder."/\"><img src=\"http://www.wevolt.com/".$line->thumb."\" border=\"2\" style=\"border-color:#000000;\" width=\"50\" height=\"50\" vspace=\"2\" hspace=\"3\"></a></td><td valign=\"top\"><div class=\"blue_cell_title\">".stripslashes($line->title)."</div><div class=\"updated\">".$line->ProjectType."<br/>last updated: <br />
<b>".$Updated."</b></div></td>"; 
 $counter++;
 				if ($counter == 2){
 					$String .= "</tr><tr>";
 					$counter = 0;
 				}
			
    }
	if ($counter <2) {
		while($counter <= 2) {
			$String .='<td></td><td></td>';	
			$counter++;
		}
	}

	$String .= "</tr></table>";
				
	$DB->close();
	
	if ($NumComics == 0)
		$String = ' This user has not created any public projects yet. ';
	return $String;
	
}

function getUserFeed($ContentID, $NumItems, $ContentType) {
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	$DB = new DB();
	

	if ($ContentType == 'user') {
		$query = "SELECT encryptid from users where username='$ContentID'";	
		$ContentID = $DB->queryUniqueValue($query);		
		
	}
	$DB->close();
	
		$db = new Danb();
		$query = "select u.content_id as id, u.link, p.thumb, p.Safefolder, u.UpdateType, u.ActionID, us.username as user,  actiontype as action, u.actionsection as subject, p.title, i.time
		from
		(   select max(id) as 'i', max(if(live_date is not null and live_date > `date`, `live_date`, `date`)) as 'time'
			from updates
			where ((actionsection != '')
			
			and if(live_date is not null and live_date != '0000-00-00 00:00:0000', live_date, date) <= now())
			and userid='$ContentID'
			group by content_id, actionsection
			order by time desc    
			limit $NumItems
		) as i
		left join updates u 
		on u.id = i.i 
		left join users us 
		on u.userid = us.encryptid 
		left join projects p 
		on (u.content_id = p.projectid and p.projectid != '') 
		limit $NumItems;";
		$rows = $db->fetchAll($query);
		//print $query;
		
		$String .='<div align="left" id="feed_holder">';
		 if (count($rows) > 0) :
			 foreach ($rows as $row) :
			
				$date = new DateTime($row['time']); 
				$id = $row['id'];
				//$thumb = 'http://www.wevolt.com' . $row['thumb'];
				//if (!is_array(@getimagesize($thumb))) {
					///$thumb = "http://www.wevolt.com/images/no_thumb_project.jpg";	
				//}
				$link = $row['link'];
				$action = $row['action'];
				$subject = $row['subject'];
				$UpdateType = $row['UpdateType'];
				$title = stripslashes($row['title']);
				if (strlen($title) > 27) {
					$title = substr($title, 0, 27) . '...';
				}
				$user = $row['user'];
			
				$String .='<div class="feed_item" user="'. $user.'">';
			
				//<div style="display:inline-block;">
					//<img src="'.$thumb.'" width="34" height="34" />
				//</div>
				
				$String .='<div style="display:inline-block;">'.$action;
				 
				 if ($subject == 'review')
				 	$link = 'http://users.wevolt.com/'.$user.'/?tab=reviews&id='.$row['ActionID'];
					
				  $String .= '<a href="'.$link.'"> '.$subject.'</a>';
				 
				if (($subject == 'page') || ($subject == 'blog')|| ($subject == 'comment')) $String .=' to ';
				 
				 if ($UpdateType == 'project')
				 $String .='<a href="http://www.wevolt.com/'.$row['Safefolder'].'/">'.$title.'</a>';
				 
				 $String .='<br />
						  <span class="feed_date">';
						  if ($subject == 'page')
							 $String .=$date->format('F jS, Y');
						  else 
							 $String .= $date->format('F jS, Y @ g:i a');
						  
				$String .='</span></div>
				<div style="height:5px;"></div>
			  </div>';
			endforeach; 
		 else: 
			$String .='No recent updates.';
		 endif;
		 
		$String .='</div>';

	return $String;
	
}



function get_modules($UserID,$UserType='user') {
	include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
	global $IsFriend, $IsOwner, $IsFan, $FeedOfTitle;
	
	$DB = new DB();
	$String = '';
	$query = "SELECT * from pf_modules where UserID='$UserID' and UserHome=1 and IsPublished=1  order by UserHomePlacement, UserHomePosition";
	$DB->query($query);
	
	$TotalMods = $DB->numRows();
	
	if ($TotalMods == 0) {
			$query = "INSERT into pf_modules (Title, ModuleCode, UserHomePlacement, UserHomePosition, CustomVar1, CustomVar2, CustomVar3, UserID, UserHome, EncryptID, ModuleTemplate, ModuleType, IsPublished) values ('Site Stats', 'stats', 'left','1','','','','$UserID',1,'$UserID"."stats','site_stats', 'user',1)";
			$DB->execute($query);
			$query = "INSERT into pf_modules (Title, ModuleCode, UserHomePlacement, UserHomePosition, CustomVar1, CustomVar2, CustomVar3, UserID, UserHome, EncryptID, ModuleTemplate, ModuleType, IsPublished) values ('Projects', 'projects', 'left','2','','','','$UserID',1,'$UserID"."projects','projects', 'user',1)";
			$DB->execute($query);
			$query = "INSERT into pf_modules (Title, ModuleCode, UserHomePlacement, UserHomePosition, CustomVar1, CustomVar2, CustomVar3, UserID, UserHome, EncryptID, ModuleTemplate, ModuleType, IsPublished) values ('My Feed', 'feed', 'right','1','$FeedOfTitle','10','user','$UserID',1,'$UserID"."feed','feed', 'user',1)";
			$DB->execute($query);
			$query = "SELECT * from pf_modules where UserID='$UserID' and UserHome=1 and IsPublished=1  order by UserHomePlacement, UserHomePosition";
			$DB->query($query);
	}
	
	while ($module = $DB->fetchNextObject()) {
		$Placement = $module->UserHomePlacement;
		$ModuleString = '<div id="'.$module->ModuleCode.'_module">';
		$ModuleString .= '<div class="light_blue_module_title">'.$module->Title.'</div>';
		$ModuleString .= '<table border="0" cellspacing="0" cellpadding="0" width="{'.$Placement.'_MODULE_WIDTH}">
          			<tr>
                        <td id="updateBox_TL"></td>
                        <td id="updateBox_T" width="{'.$Placement.'_TOPBAR_WIDTH}"></td>
                        <td  id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3"><div style="padding-left:5px;padding-right:5px;">';
                               
                                  
                            
			switch ($module->ModuleCode) {
				
				case 'stats':
						$ModuleString .= getStatsModule($UserID,$UserType);
						break;	
				case 'projects':
						$ModuleString .= getCreatorProjectsModule($UserID,$UserType);
						break;	
				case 'feed':
						$ModuleString .= getUserFeed($module->CustomVar1, $module->CustomVar2,$module->CustomVar3);
						break;
				case 'shout':
						$ModuleString .= getShoutBoxModule($UserID);
						break;
						
			}
		$ModuleString .= '</div></td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>';
		$ModuleString .="</div><div class=\"spacer\"></div>";
		
			if ($module->UserHomePlacement == 'left')  {
				
				$LeftColumn .= $ModuleString;
				
				
			} else if ($module->UserHomePlacement == 'right')  {
						
				
						
				$RightColumn .= $ModuleString;
				
			
			}
	}
	//
	$TemplateString = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="90%" valign="top">{LEFT}</td><td width="1%"></td><td width="45%" valign="top">{RIGHT}</td></tr></table>';
	$RightModuleWidth = ceil(($_SESSION['contentwidth']-130) * .42);
	$RightBarWidth = $RightModuleWidth-16;
	$LeftModuleWidth = ceil(($_SESSION['contentwidth']-130) * .52);
	$LeftBarWidth = $LeftModuleWidth-16;
	
	$TemplateString = str_replace("{LEFT}",$LeftColumn, $TemplateString);
	$TemplateString = str_replace("{left_MODULE_WIDTH}",$LeftModuleWidth, $TemplateString);
	$TemplateString = str_replace("{left_TOPBAR_WIDTH}",$LeftBarWidth, $TemplateString);
	
	$TemplateString = str_replace("{RIGHT}",$RightColumn, $TemplateString);
	$TemplateString = str_replace("{right_MODULE_WIDTH}",$RightModuleWidth, $TemplateString);
	$TemplateString = str_replace("{right_TOPBAR_WIDTH}",$RightBarWidth, $TemplateString);
	
		$DB->close();
	return $TemplateString;
	
}

	function feed_stuff($UserID,$UserType='user') {
	
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
				
									
				} 
	
	}

	
	
	$DB->close();
	
	return $String;
	 
}


?>