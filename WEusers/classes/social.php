<? 
 include_once($_SERVER['DOCUMENT_ROOT'].'/models/Users.php');
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 
	class social {		
			
			
	public function getFans($UserID, $Sort='alpha') {
					if ($Sort=='')
						$Sort = 'alpha';
						
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$SELECT = "select u.encryptid, u.username, u.avatar, u.LastLogin, u.level,
					(SELECT count(*) from follows as ff where ff.follow_id=u.encryptid) as TotalFans,
					(SELECT count(*) from follows as fff where fff.follow_id=u.encryptid and user_id='".$_SESSION['userid']."') as IsFollowing,
					(SELECT count(*) from friends as fr where fr.FriendID=u.encryptid and fr.UserID='".$_SESSION['userid']."' and fr.Accepted=1 and fr.FriendType='friend') as IsFriend,
					(SELECT count(*) from friends as frf where frf.UserID=u.encryptid and frf.FriendType = 'friend' and frf.Accepted = '1' and frf.FriendID!=u.encryptid) as TotalFriends
				  	 from follows as f 
				  	 join users u on u.encryptid = f.user_id 
				     where f.follow_id='$UserID'";
					 
					 if ($Sort == 'alpha')
					 	$ORDER = " order by u.username asc";
					else if ($Sort == 'chrono')
						$ORDER = " order by u.LastLogin DESC";
					else if ($Sort == 'level')
						$ORDER = " order by u.level DESC";	
					else if ($Sort == 'fans')
						$ORDER = " order by TotalFans DESC";	
					else if ($Sort == 'friends')
						$ORDER = " order by TotalFriends DESC";	
							
					$QUERY = $SELECT . $ORDER;
			//Create a PS_Pagination object
			//The paginate() function returns a mysql result set 
					$counter = 0;
					$FCount = 0;
					//print $QUERY;
					$FriendArray = $db->query($QUERY);
					while ($friend = $db->fetchNextObject()) { 
					$RelArray = $this->getRelationship($friend->encryptid, $_SESSION['userid']);
				
					echo '<table border="0" cellspacing="0" cellpadding="0" width="400">
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="384" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3">';
						
						echo '<table width="100%"><tr><td width="40"><a href="http://users.wevolt.com/'.trim($friend->username).'/"><img src="'.$friend->avatar.'" border="2" alt="'.trim($friend->username).'" style="border-color:#000000;" width="36" height="36" vspace="5" hspace="5"></a></td><td class="blue_cell_title"><b>'.trim($friend->username).'</b><br/>Level: '.$friend->level.'</td><td width="140">';
							if (($RelArray['Fan'] == 0) && ($_SESSION['userid'] != $friend->encryptid))
								echo '<img src="http://www.wevolt.com/images/follow_button_icon.png" onclick="follow(\''.$friend->encryptid.'\',\''.$_SESSION['userid'].'\',\'user\');" class="navbuttons"/>&nbsp;';
							if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] != 1))
								echo '<img src="http://www.wevolt.com/images/friend_button.png" onclick="network_wizard(\''.trim($friend->username).'\',\''.$_SESSION['userid'].'\',\'\');" class="navbuttons"/>';							
								else if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] == 1))
								echo '&nbsp;requested';
							
							
							echo '</td></tr></table>';
							 $FCount++;
					echo '  </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table><div class="spacer"></div>';
					}
					if ($FCount == 0)
					 	echo '<center>No Fans yet.<br/>Go promote yourself!</center>';
			
					$db->close();  
				
			}
			
			public function getCelebs($UserID, $Sort='alpha') {
					if ($Sort=='')
						$Sort = 'alpha';
						
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$SELECT = "select u.encryptid, u.username, u.avatar, u.LastLogin, u.level,
					(SELECT count(*) from follows as ff where ff.follow_id=u.encryptid) as TotalFans,
					(SELECT count(*) from follows as fff where fff.follow_id=u.encryptid and user_id='".$_SESSION['userid']."') as IsFollowing,
					(SELECT count(*) from friends as fr where fr.FriendID=u.encryptid and fr.UserID='".$_SESSION['userid']."' and fr.Accepted=1 and fr.FriendType='friend') as IsFriend,
					(SELECT count(*) from friends as frf where frf.UserID=u.encryptid and frf.FriendType = 'friend' and frf.Accepted = '1' and frf.FriendID!=u.encryptid) as TotalFriends
				  	 from follows as f 
				  	 join users u on u.encryptid = f.follow_id 
				     where f.user_id='$UserID' and f.type='user'";
					 
					 if ($Sort == 'alpha')
					 	$ORDER = " order by u.username asc";
					else if ($Sort == 'chrono')
						$ORDER = " order by u.LastLogin DESC";
					else if ($Sort == 'level')
						$ORDER = " order by u.level DESC";	
					else if ($Sort == 'fans')
						$ORDER = " order by TotalFans DESC";	
					else if ($Sort == 'friends')
						$ORDER = " order by TotalFriends DESC";	
							
					$QUERY = $SELECT . $ORDER;
			//Create a PS_Pagination object
			//The paginate() function returns a mysql result set 
					$counter = 0;
					$FCount = 0;
					//print $QUERY;
					$FriendArray = $db->query($QUERY);
					while ($friend = $db->fetchNextObject()) { 
					$RelArray = $this->getRelationship($friend->encryptid, $_SESSION['userid']);
						echo '<table border="0" cellspacing="0" cellpadding="0" width="400">
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="384" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3">';
						
						echo '<table width="100%"><tr><td width="40"><a href="http://users.wevolt.com/'.trim($friend->username).'/"><img src="'.$friend->avatar.'" border="2" alt="'.trim($friend->username).'" style="border-color:#000000;" width="36" height="36" vspace="5" hspace="5"></a></td><td class="blue_cell_title"><b>'.trim($friend->username).'</b><br/>Level: '.$friend->level.'</td><td width="140">';
				
							if (($RelArray['Fan'] == 0) && ($_SESSION['userid'] != $friend->encryptid))
								echo '<img src="http://www.wevolt.com/images/follow_button_icon.png" onclick="follow(\''.$friend->encryptid.'\',\''.$_SESSION['userid'].'\',\'user\');" class="navbuttons"/>&nbsp;';
							if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] != 1))
								echo '<img src="http://www.wevolt.com/images/friend_button.png" onclick="network_wizard(\''.trim($friend->username).'\',\''.$_SESSION['userid'].'\',\'\');" class="navbuttons"/>';							
								else if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] == 1))
								echo '&nbsp;requested';
								
								echo '</td></tr></table>';
							 $FCount++;
					echo '  </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table><div class="spacer"></div>';
							 $FCount++;
					}
					if ($FCount == 0)
					 	echo '<center>No Fans yet.<br/>Go promote yourself!</center>';
			
					$db->close();  
				
			}
			
			
			public function getUserFeed($UserID) {
	
			include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
			$db = new Danb();
				$query = "select u.content_id as id, u.link, p.thumb, p.Safefolder, u.UpdateType, u.ActionID, us.username as user,  us.avatar as userthumb, actiontype as action, u.actionsection as subject, p.title, i.time
				from
				(   select max(id) as 'i', max(if(live_date is not null and live_date > `date`, `live_date`, `date`)) as 'time'
					from updates
					where ((actionsection != '')
					
					and if(live_date is not null and live_date != '0000-00-00 00:00:0000', live_date, date) <= now())
					and userid='$UserID'
					group by content_id, actionsection
					order by time desc    
					limit 7
				) as i
				left join updates u 
				on u.id = i.i 
				left join users us 
				on u.userid = us.encryptid 
				left join projects p 
				on (u.content_id = p.projectid and p.projectid != '') 
				limit 7;";
				$rows = $db->fetchAll($query);
		
				$String .='<div align="left" id="feed_holder">';
				 if (count($rows) > 0) :
					 foreach ($rows as $row) :
						$date = new DateTime($row['time']); 
						$id = $row['id'];
						if ($row['thumb'] == '')
							$thumb = $row['userthumb'];
						else
							$thumb = 'http://www.wevolt.com.'.$row['thumb'];
						/*
						$thumb = 'http://www.wevolt.com' . $row['thumb'];
						if (!is_array(@getimagesize($thumb))) {
								if ($row['userthumb'] != '')
									$thumb = $row['userthumb'];
								else
									$thumb = "http://www.wevolt.com/images/no_thumb_project.jpg";	
						}*/
						$link = $row['link'];
						$action = $row['action'];
						$subject = $row['subject'];
						$UpdateType = $row['UpdateType'];
						if ($subject == 'comment')
						$thumb = $row['userthumb'];
							
						$title = stripslashes($row['title']);
						if (strlen($title) > 27) {
							$title = substr($title, 0, 27) . '...';
						}
						$user = $row['user'];
					
						echo '<table border="0" cellspacing="0" cellpadding="0" width="290">
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="274" id="updateBox_T"></td>
                        <td  id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3"><div class="feed_item_large" user="'. $user.'">';
					
						echo'<div style="display:inline-block;">
							<img src="'.$thumb.'" width="50" height="50" />
						</div>';
						
						echo'<div style="display:inline-block;">'.$action.'<br/>';
						 
						 if ($subject == 'review')
							$link = 'http://users.wevolt.com/'.$user.'/?tab=reviews&id='.$row['ActionID'];
							
						  echo'<a href="'.$link.'"> '.$subject.'</a>';
						 
						 if (($subject == 'page') || ($subject == 'blog')|| ($subject == 'comment')) echo' to ';
						 
						 if ($UpdateType == 'project')
						 echo'<a href="http://www.wevolt.com/'.$row['Safefolder'].'/">'.$title.'</a>';
						 
						echo'<br />
								  <span class="feed_date">';
								  if ($subject == 'page')
									echo$date->format('F jS, Y');
								  else 
									 echo $date->format('F jS, Y @ g:i a');
								  
						echo'</span></div>
						
					  </div>  </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table><div style="height:10px;"></div>';
					  flush();
					endforeach; 
				 else: 
					echo'No recent updates.';
				 endif;
				 
				echo'</div>';
		
			//return $String;
			
			}
			
			public function getFriends($UserID, $Sort='alpha') {
					if ($Sort=='')
						$Sort = 'alpha';
						
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					
					$SELECT = "select u.encryptid, u.username, u.avatar, u.LastLogin, f.Created, u.level,
					(SELECT count(*) from follows as ff where ff.follow_id=u.encryptid) as TotalFans,
					(SELECT count(*) from follows as fff where fff.follow_id=u.encryptid and user_id='".$_SESSION['userid']."') as IsFollowing,
					(SELECT count(*) from friends as fr where fr.FriendID=u.encryptid and fr.UserID='".$_SESSION['userid']."' and fr.Accepted=1 and fr.FriendType='friend') as IsFriend,
					(SELECT count(*) from friends as frf where frf.UserID=u.encryptid and frf.FriendType = 'friend' and frf.Accepted = '1' and frf.FriendID!=u.encryptid) as TotalFriends
				  	 from friends f 
				  	 join users u on u.encryptid = f.FriendID 
				     where f.UserID='$UserID' and f.FriendType = 'friend' and f.Accepted = '1' and f.FriendID!='$UserID'";
					 
					 if ($Sort == 'alpha')
					 	$ORDER = " order by u.username asc";
					else if ($Sort == 'chrono')
						$ORDER = " order by u.LastLogin DESC";
					else if ($Sort == 'level')
						$ORDER = " order by u.level DESC";	
					else if ($Sort == 'fans')
						$ORDER = " order by TotalFans DESC";	
					else if ($Sort == 'friends')
						$ORDER = " order by TotalFriends DESC";	
							
					$QUERY = $SELECT . $ORDER;
			//Create a PS_Pagination object
			//The paginate() function returns a mysql result set 
					$counter = 0;
					$FCount = 0;
					//print $QUERY;
					$FriendArray = $db->query($QUERY);
					while ($friend = $db->fetchNextObject()) { 
					$RelArray = $this->getRelationship($friend->encryptid, $_SESSION['userid']);
						echo '<table border="0" cellspacing="0" cellpadding="0" width="400">
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="384" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3">';
						
						echo '<table width="100%"><tr><td width="40"><a href="http://users.wevolt.com/'.trim($friend->username).'/"><img src="'.$friend->avatar.'" border="2" alt="'.trim($friend->username).'" style="border-color:#000000;" width="36" height="36" vspace="5" hspace="5"></a></td><td class="blue_cell_title"><b>'.trim($friend->username).'</b><br/>Level: '.$friend->level.'</td><td width="140">';
						if (($RelArray['Fan'] == 0) && ($_SESSION['userid'] != $friend->encryptid))
								echo '<img src="http://www.wevolt.com/images/follow_button_icon.png" onclick="follow(\''.$friend->encryptid.'\',\''.$_SESSION['userid'].'\',\'user\');" class="navbuttons"/>&nbsp;';
							if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] != 1))
								echo '<img src="http://www.wevolt.com/images/friend_button.png" onclick="network_wizard(\''.trim($friend->username).'\',\''.$_SESSION['userid'].'\',\'\');" class="navbuttons"/>';							
								else if (($RelArray['Friend'] == 0)&& ($_SESSION['userid'] != $friend->encryptid) && ($RelArray['Requested'] == 1))
								echo '&nbsp;requested';
							
								echo '</td></tr></table>';
							 $FCount++;
					echo '  </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table><div class="spacer"></div>';
							 $FCount++;
							 unset($RelArray);
					}
					if ($FCount == 0)
					 	echo '<center>No Friends yet.<br/>Go promote yourself!</center>';
			
					$db->close();
				
			}
			
		public function getNetworks($UserID) {
			$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					
					$query = "SELECT u.encryptid, 
						      (SELECT count(*) from friends as frf where frf.UserID='$UserID' and frf.FriendType = 'friend' and frf.Accepted = '1' and frf.FriendID!='$UserID') as TotalFriends,
							  (select count(*) from follows where user_id='$UserID' and type='user') as TotalCelebs,
							  (select count(*) from follows where follow_id='$UserID' and type='user') as TotalFans,
							  (select count(*) from user_groups where UserID='$UserID') as TotalGroups
							  from users as u
							  where u.encryptid='$UserID'";
					$NetworkArray = $db->queryUniqueObject($query);
			$db->close();
			return $NetworkArray;
		}
		
		public function getUserGroups($UserID) {
			$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					
					$query = "select * from user_groups where UserID='$UserID'";
					$db->query($query);
					$GroupArray = array();
					//print $query;
					while ($group = $db->fetchNextObject()) {
							$GroupArray[] = array('Title'=>$group->Title,
												'GroupUsers'=>$group->GroupUsers,
												'GID'=>$group->ID);
						
					}
					
			$db->close();
			return $GroupArray;
		}
						
		public function getRelationship($QueryID, $UserID) {
					$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
					$query = "select count(*) from friends where (FriendID='$QueryID' and UserID='$UserID') and Accepted=1 and FriendType='friend'";
					$IsFriend = $db->queryUniqueValue($query);
					if ($IsFriend == 0) {
						$query = "select count(*) from friends where (FriendID='$QueryID' and UserID='$UserID') and Accepted=0 and FriendType='friend'";
						$Requested = $db->queryUniqueValue($query);
					}
					$query = "select count(*) from follows where user_id='$UserID' and follow_id='$QueryID' and type='user'";
					$IsFan = $db->queryUniqueValue($query);
					
				
					if ($QueryID == $UserID)
						$IsOwner = 1;
					else 
						$IsOwner = 0;
					
					$RelArray = array('Friend'=>$IsFriend,
									  'Requested'=>$Requested,
									  'Fan'=>$IsFan,
									  'Owner'=>$IsOwner);
			$db->close();
			return $RelArray;
			
		}
	}

?>