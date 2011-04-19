<style type="text/css">
.CommentEvenBGColor {
	
	background-color:#e5e5e5;
	color:#000;
}

.CommentOddBGColor {
	background-color:#FFF;
	color:#000;
}


</style>
<table width="100%">
<tr>
<td width="441" style="padding-right:10px;" valign="top">
<? $String = '<script type="text/javascript">';
						$String  .= 'function submit_comment() {';
						
					    $String .= 'document.commentform.submit();';
						
						$String .= '}';
						$String .= '</script>';
 						$String .='<div id="commentbox">';
						if ($_SESSION['userid'] != '')  { 
	 						$String .='<div class="modheader">Leave a Comment</div>';
    	 					$String .=' <form method="POST" action="/project/'.$SafeFolder.'/?tab=social';
							$PostBack = '/project/'.$SafeFolder.'/?tab=social';
							$String .= '" name="commentform" id="commentform">';
    						$String .='<textarea rows="6" style="width:98%" name="txtFeedback" onFocus="doClear(this);toggle_arrows(\'off\');" id="txtComment">';
							if ($_POST['txtFeedback']=='')
								$String .='enter a comment'; 
							else
		 						$String .=$_POST['txtFeedback'];

	  						$String .='</textarea><div class="spacer"></div>';
							$String .='<input type="hidden" name="insert" id="insert" value="1">'.
										'<input type="hidden" name="userid" id="userid" value="'.$_SESSION['userid'].'">
											<input type="hidden" name="targetid" id="targetid" value="'.$ProjectID.'"><input type="hidden" name="postback" id="postback" value="'.$PostBack.'"><div class="spacer"></div>';
	
									$String .= '<input type="button" onclick="submit_comment();" value="Submit Comment" class="navbuttons">'; 
							
	 						$String .='</form><div class="spacer"></div>';

					} else { 
						$String .='<div class="authornote" align="center">SORRY YOU NEED TO LOG IN TO LEAVE COMMENTS </div>';
 					}
 
 					$String .='</div>';
					
					echo $String;
					$String ='';?>

<? 
$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
	
							$query = "select pc.*,u.username,u.avatar
									 from project_comments as pc 
									  join users as u on u.encryptid=pc.userid
									 where pc.comicid='".$ProjectID."' and pc.ParentComment=0 ORDER BY pc.creationdate ASC";

  						$db->query($query);
  						$nRows = $db->numRows();
  						$bgcolor = 'CommentOddBGColor';
						$rowcounter = 0; 
						$DeleteString = '/project/'.$SafeFolder.'/?tab=social';
						$TargetID = $ProjectID;
 						if ($nRows>0) {
  							 while ($comment = $db->fetchNextObject()) { 
  	 							
										$UserID = $comment->userid;
	
									
									 if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) 
									 	$ShowDelete = 1;
								
								
 										 		$String .= '<div class="spacer"></div><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  															'<tr>'.
    														'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
															<a href="http://users.wevolt.com/'.trim($comment->username).'/" target="_blank">
															<img src="'.$comment->avatar.'" width="50" height="50" border="1"></a>';
															 if ($_SESSION['userid'] !='')
													$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment->id.'\',\''.$TargetID.'\',\'index\',\''.trim($comment->username).'\');">reply</a>';
												
												$String .= "</td>".
    														"<td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
														
														if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) 
																$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment->id."');return false;\" />
																			<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
													$String .= '<div style="font-size:10px;">on <i>'.$comment->commentdate.'</i></div
																><div style="font-size:10px;"><b>'.$comment->username.'</b> said:</div></td>'.
 																'</tr>'.
 																'<tr>'.
    															'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment->comment)).'</td>'.
  																'</tr>'.
																'</table><div class="spacer"></div>';
									
									$db2 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									
									
							$query = "select pc.*,u.username,u.avatar
									 from project_comments as pc 
									  join users as u on u.encryptid=pc.userid
									 where pc.comicid='".$ProjectID."' and pc.ParentComment='".$comment->id."'ORDER BY pc.creationdate ASC";
									

  									$db2->query($query);
									 while ($comment2 = $db2->fetchNextObject()) { 
								
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:25px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment2->username).'/" target="_blank">
												<img src="'.$comment2->avatar.'" width="50" height="50" border="1"></a>';
												 if ($_SESSION['userid'] !='')
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment2->id.'\',\''.$TargetID.'\',\'index\',\''.trim($comment2->username).'\');">reply</a>';

									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment2->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
									
									$String .= '<div style="font-size:10px;">on <i>'.$comment2->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment2->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment2->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												
									$db3 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									
									$query = "select pc.*,u.username,u.avatar
									 from project_comments as pc 
									  join users as u on u.encryptid=pc.userid
									 where pc.comicid='".$ProjectID."' and pc.ParentComment='".$comment2->id."' ORDER BY pc.creationdate ASC";
									 

  									$db3->query($query);
									 while ($comment3 = $db3->fetchNextObject()) { 
									 
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:50px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment3->username).'/" target="_blank">
												<img src="'.$comment3->avatar.'" width="50" height="50" border="1"></a>';
												 if ($_SESSION['userid'] !='')
												$String .= '<br/><a href="javascript:void(0);" onclick="reply_comment(\''.$comment3->id.'\',\''.$TargetID.'\',\'index\',\''.trim($comment3->username).'\');">reply</a>';
									
									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment3->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
									$String .= '<div style="font-size:10px;">on <i>'.$comment3->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment3->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment3->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												$db4 = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
									$query = "select pc.*,u.username,u.avatar
									 from project_comments as pc 
									  join users as u on u.encryptid=pc.userid
									 where pc.comicid='".$ProjectID."' and pc.ParentComment='".$comment3->id."' ORDER BY pc.creationdate ASC";
  									$db4->query($query);
									 while ($comment4 = $db4->fetchNextObject()) { 
									 if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
									$String .= '<div align="right" style="padding-left:75px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">'.
  												'<tr>'.
    											'<td width="50" rowspan="2" valign="top" class="projectboxcontent" align="center">
												<a href="http://users.wevolt.com/'.trim($comment4->username).'/" target="_blank">
												<img src="'.$comment4->avatar.'" width="50" height="50" border="1"></a>';
									
									$String .= "</td><td height=\"10\" valign=\"top\" class=\"".$bgcolor."\" style=\"padding-left:5px;\">";
															
									if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) 
										$String .= "<a href=\"javascript:void(0)\" onclick=\"delete_comment('".$comment4->id."');return false;\" />
													<img src='/panelflow/templates/TPL-001/images/delete.jpg' border='0'></a>";
														
									$String .= '<div style="font-size:10px;">on <i>'.$comment4->commentdate.'</i></div
												><div style="font-size:10px;"><b>'.$comment4->username.'</b> said:</div></td>'.
 												'</tr>'.
 												'<tr>'.
    											'<td valign="top" style="padding:5px;" class="'.$bgcolor.'">'.stripslashes(nl2br($comment4->comment)).'</td>'.
  												'</tr>'.
												'</table><div class="spacer"></div></div>';
												
									
									
									}
									$db4->close();
												
									
									
									}
									$db3->close();
									
									}
									$db2->close();
									
									
									
									if ($rowcounter == 0) {
										$bgcolor = 'CommentEvenBGColor';
										$color = '#00000';
										$rowcounter = 1;
									} else {
										$bgcolor = 'CommentOddBGColor';
										$rowcounter = 0;
										$color = '#00000';
									}
  
  							}
						} else {
							$String = "No Comments yet. Be the first to Comment!";
	
						}
					
						if (($_SESSION['userid'] == $AdminUserID) || (in_array($_SESSION['userid'],$SiteAdmins))) {
							$String .="<script type='text/javascript'>function delete_comment(cid) {
												
												document.getElementById(\"commentid\").value = cid;
												document.getElementById(\"linkback\").value = document.getElementById(\"postback\").value;
												document.deleteform.submit();
										}</script>";
										
							 $String .="<form method='POST' action='".$DeleteString."' name='deleteform' id='deleteform'>
									<input type='hidden' name='deletecomment' id='deletecomment' value='1'>
									<input type='hidden' name='commentid' id='commentid' value=''>
									<input type='hidden' name='linkback' id='linkback' value=''>
									<input type='hidden' name='targetid' id='targetid' value='".$ProjectID."'>

									</form>";
						}

						$db->close();
						
						echo $String;
		
		?>
</td>
<td width="200"></td>
</tr>
</table>
