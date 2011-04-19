<? 
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');

	class comment {
		
				
	
					public function pageComment($Section, $ProjectID, $PageID, $UserID, $Comment,$CommentUsername,$PostBack='',$ParentComment='0'){
											$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
											if (($_SESSION['userid'] != '') && ($UserID!='none')) {
											$BannedUsers = array('cjpuw','nizpw','qxqug','gligaclb','lshky','lribg','rbnrp','lady_sonia','vimax');
											if ($CommentUsername == '') 
												$CommentUsername = $_SESSION['username'];
												
											if (!in_array($CommentUsername,$BannedUsers)) {
												
												$CommentDate = date('D M j');
												$Comment = mysql_real_escape_string($Comment);
												$query = "SELECT c.CreatorID, c.SafeFolder, (SELECT email from users as u2 where u2.encryptid=c.CreatorID) as CreatorEmail
															from projects as c 
															where c.ProjectID='$ProjectID'";
												$CreatorArray = $db->queryUniqueObject($query);	
												$Email = $CreatorArray->CreatorEmail;
												$UID = $CreatorArray->CreatorID;
												$SafeFolder = $CreatorArray->SafeFolder;
												$query = "SELECT AllowPublicComents from comic_settings where ComicID='$ProjectID'";
												$AllowPublicComents  = $db->queryUniqueValue($query); 
												$query = "SELECT CommentNotify from users_settings where UserID='$UID'";
												$CommentNotify  = $db->queryUniqueValue($query);
												
												if (($AllowPublicComents == 0) && ($UserID == 'none'))
													$PostComment = 0;
												else
													$PostComment = 1;
		
												if ($PostComment == 1) {
													
														if ($Section =='Pages'){ 
																$query = "INSERT into pagecomments 
																		  (comicid, pageid, userid, comment, commentdate, Username,ParentComment) 
																		   values 
																		   ('$ProjectID', '$PageID','$UserID','$Comment','$CommentDate','$CommentUsername','$ParentComment')";
														
																
															
														} else if ($Section == 'Blog') {
																$query = "INSERT into blogcomments 
																		  (comicid, PostID, userid, comment, commentdate, Username,ParentComment) 
																		   values 
																		   ('$ProjectID', '$PageID','$UserID','$Comment','$CommentDate','$CommentUsername','$ParentComment')";
													
														}else if ($Section == 'index') {
																$query = "INSERT into project_comments 
																		  (comicid, userid, comment, commentdate, Username,ParentComment) 
																		   values 
																		   ('$ProjectID','$UserID','$Comment','$CommentDate','$CommentUsername','$ParentComment')";
													
														}
														
														$db->execute($query);
														
														if ($ParentComment != '0') {
															if ($Section =='Pages')
																$TargetTable = 'pagecomments';
															else if ($Section == 'Blog')
																$TargetTable = 'blogcomments';
															else if ($Section == 'index')
																$TargetTable = 'project_comments';	
																		   
															$query = "SELECT * from $TargetTable where id='$ParentComment'";
															$CommentArray  = $db->queryUniqueObject($query);
															
															$og_user = $CommentArray->userid;
															if ($og_user != $_SESSION['userid']) {
																$query = "SELECT us.CommentNotify, u.email from panel_panel.users as u
																inner join panel_panel.users_settings as us on us.UserID=u.encryptid
																 where u.encryptid='".$og_user."'";
																$NotifyArray  = $db->queryUniqueObject($query);
																
																$CommentNotify = $NotifyArray->CommentNotify;
																
																if (($CommentNotify == 'both') || ($CommentNotify == 'email')) {
																															
																
																$PageLink = $PostBack;
																$WePageLink = '<a href="javascript:void(0)" onclick="parent.window.location.href=\''.$PostBack.'\';"></a>';
																$to = $NotifyArray->email;
																$subject = $CommentUsername. ' has replied to your comment';
																$body = "------COMMENT REPLY ----\nComment Date: ".$CommentDate."\nPage: ".$PageLink."\n\n".$CommentUsername." said: ".$Comment;
																$Webody = "------COMMENT REPLY ----\nComment Date: ".$CommentDate."\nPage: ".$WePageLink."\n\n".$CommentUsername." said: ".$Comment;
																$header = "From: NO-REPLY@wevolt.com  <NO-REPLY@wevolt.com >\n";
																$header .= "X-Mailer: PHP/" . phpversion() . "\n";
																$header .= "X-Priority: 1";
																mail($to, $subject, $body, $header);
																
																
															}
															
															if (($CommentNotify == 'both') || ($CommentNotify == 'pfbox')) {
																$body = mysql_real_escape_string($body);
																$DateNow = date('m-d-Y');
																$query = "INSERT into panel_panel.messages 
																				(userid, sendername, senderid, subject, message, date) 
																				values 
																				('$UID','wevolt','64223ccf3b0','".mysql_real_escape_string($subject)."','".mysql_real_escape_string($Webody)."','$DateNow')";
																$db->execute($query);
															}
																
															}
														}
														
														if (($_SESSION['userid'] != $UID) && ($og_user != $UID)){
														//SEND AN EMAIL ALERT	
															if (($CommentNotify == 'both') || ($CommentNotify == 'email')) {
																
																$PageLink = $PostBack;
																$WePageLink = '<a href="javascript:void(0)" onclick="parent.window.location.href=\''.$PostBack.'\';"></a>';
																$to = $Email;
																if ($Section == 'index')
																$subject = $CommentUsername.' has posted a comment to your project social wall';
																else
																$subject = $CommentUsername.' has posted a comment on your page';
																$body = "------NEW COMMENT ----\nComment Date: ".$CommentDate."\nPage: ".$PageLink."\n\n".$CommentUsername." said: ".$Comment;
																$Webody = "------NEW COMMENT ----\nComment Date: ".$CommentDate."\nPage: ".$WePageLink."\n\n".$CommentUsername." said: ".$Comment;
																$header = "From: NO-REPLY@wevolt.com  <NO-REPLY@wevolt.com >\n";
																$header .= "X-Mailer: PHP/" . phpversion() . "\n";
																$header .= "X-Priority: 1";
																mail($to, $subject, $body, $header);
															}
															
															if (($CommentNotify == 'both') || ($CommentNotify == 'pfbox')) {
																$body = mysql_real_escape_string($body);
																$DateNow = date('m-d-Y');
																$query = "INSERT into panel_panel.messages 
																				(userid, sendername, senderid, subject, message, date) 
																				values 
																				('$UID','wevolt','64223ccf3b0','$subject','".mysql_real_escape_string($Webody)."','$DateNow')";
																$db->execute($query);
															}
														}
														
												}
											}
											}
											
											include_once($_SERVER['DOCUMENT_ROOT'].'/includes/content_functions.php');
											insertUpdate('comment', 'posted', $ProjectID, 'project', $UserID,$PostBack,$ProjectID,'');

											$db->close();			
					}
					
					
					public function deleteComment($Section, $ProjectID, $PageID, $CommentID) {
								$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
								if ($Section == 'Extras')
									$query = "DELETE from extracomments WHERE id ='$CommentID' and comicid='$ProjectID' and pageid='$PageID'";
								else if ($Section == 'Blog')
									$query = "DELETE from blogcomments WHERE ID='$CommentID' and ComicID='$ProjectID' and PostID='$PageID'";
								else if ($Section == 'index')
									$query = "DELETE from project_comments WHERE id ='$CommentID' and comicid='$ProjectID'";
								else
									$query = "DELETE from pagecomments WHERE id ='$CommentID' and comicid='$ProjectID' and pageid='$PageID'";
								
								$db->execute($query);
								if ($Section == 'Extras')
										$query = "DELETE from pagecomments WHERE ParentComment ='$CommentID' and comicid='$ProjectID' and pageid='$PageID'";
								else if ($Section == 'Blog')
									$query = "DELETE from blogcomments WHERE ParentComment='$CommentID' and ComicID='$ProjectID' and PostID='$PageID'";
								else if ($Section == 'index')
									$query = "DELETE from project_comments WHERE ParentComment ='$CommentID' and comicid='$ProjectID'";
								else
									$query = "DELETE from pagecomments WHERE ParentComment ='$CommentID' and comicid='$ProjectID' and pageid='$PageID'";
									
							
								
								$db->execute($query);
								//print $query;
								$db->close();	
 
					}
	
	
	}



?>