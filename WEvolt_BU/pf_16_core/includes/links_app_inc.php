<? 
if ($_GET['section'] == 'links') {
		if ($ContentType == 'story') {
			$TargetID = $StoryID;
			$TargetName = 'StoryID';
			
		}else{
			$TargetID = $ComicID;
			$TargetName = 'ComicID';
		}	
		if (!isset($_GET['t'])) {
		
				if ((!isset($_GET['a'])) && (!isset($_POST['a']))) {
					$ComicXML = '';
					if ($ContentType != 'story')
						$query = "SELECT * from links where ComicID ='$ComicID'";
					else
						$query = "SELECT * from links where StoryID ='$StoryID'";
					$comicsDB->query($query);
			
					$TotalLinks = $comicsDB->numRows();
					$pagination->createPaging($query,$NumItemsPerPage);
					$LinksString = '';
					$Count = 1;
					
					while($line=mysql_fetch_object($pagination->resultpage)) {
					if ($line->InternalLink == 0) {
					$BoxType = 'white_box';
				
					} else {
						$BoxType = 'grey_box';
					}
						$LinksString .='<div>';
						$LinksString .='<b class="'.$BoxType.'">';
						$LinksString .='<b class="'.$BoxType.'1"><b></b></b>';
						$LinksString .='<b class="'.$BoxType.'2"><b></b></b>';
						$LinksString .='<b class="'.$BoxType.'3"></b>';
						$LinksString .='<b class="'.$BoxType.'4"></b>';
						$LinksString .='<b class="'.$BoxType.'5"></b></b>';
						$LinksString .='<div class="'.$BoxType.'fg">';
						$LinksString .='<table cellpadding="0" cellspacing="0" border="0"><tr>';
						$LinksString .='<td style="padding-left:7px;" width="250" class="pageboxtext" align="left" valign="top"><b>Title:</b><br/>'.stripslashes($line->Title).'</td><td width="300" valign="top" class="pageboxtext" align="left"><b>URL:</b><br/>';
						if ($line->InternalLink == 0) {
						$LinksString .='<a href="'.$line->Link.'" target="_blank">'.$line->Link.'</a>';
						}else {
						$LinksString .='SELF LINK';
						}
						$LinksString .='</td>';
						$LinksString .= '<td valign="top" class="pageboxtext" align="left">';
						
						if ($line->InternalLink == 0) {
						$LinksString .= '<b>DESCRIPTION:</b><div style="padding-left:3px;padding-right:2px;height:58px;width:241px;background-color:#ffffff;border:1px solid #000000;overflow:hidden">'.nl2br( $line->Description).'</div>';
						
						
						} else {
						$LinksString .= '<div style="width:241px;">BANNER IMAGE TO COMIC</div>';
						
						}
						$LinksString .= '</td>';
						if ($ContentType != 'story')
						$LinksString .= '<td width="150" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]&nbsp;';
						else 
							$LinksString .= '<td width="150" class="pageboxtext" align="center">[<a href="/story/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/story/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]&nbsp;';
						
						$LinksString .= '</td></tr>';
						$LinksString .= '</table>';
			
						$LinksString .=' </div>';
						$LinksString .='<b class="'.$BoxType.'">';
						$LinksString .='<b class="'.$BoxType.'5"></b>';
						$LinksString .=' <b class="'.$BoxType.'4"></b>';
						$LinksString .='<b class="'.$BoxType.'3"></b>';
						$LinksString .='<b class="'.$BoxType.'2"><b></b></b>';
						$LinksString .='<b class="'.$BoxType.'1"><b></b></b></b>';
						$LinksString .='</div><div class="spacer"></div>';
						$Count++;
					}
			} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
				if ($ContentType != 'story')
						$query = "SELECT * from links where ComicID ='$ComicID' and EncryptID='".$_GET['linkid']."'";	
				else
						$query = "SELECT * from links where StoryID ='$StoryID' and EncryptID='".$_GET['linkid']."'";	
					
					$LinkArray = $comicsDB->queryUniqueObject($query);
					
				 	
			} else if ($_POST['a'] == 'delete') {
					if ($ContentType != 'story')
					$query = "DELETE from links where ComicID ='$ComicID' and EncryptID='".$_GET['linkid']."'";	
					else
					$query = "DELETE from links where StoryID ='$StoryID' and EncryptID='".$_GET['linkid']."'";	
					$comicsDB->execute($query);
					$Action = 'delete';
					$LinkID =$_GET['linkid'];
					
			} else if ($_GET['a'] == 'save') {
					$Title = mysql_real_escape_string($_POST['txtTitle']);
					$Description = mysql_real_escape_string($_POST['txtDescription']);
					$Link = $_POST['txtLinkUrl'];
					$Filename = $_POST['txtFilename'];
					$DeleteImage = $_POST['txtDeleteImage'];
					$InternalLink = $_POST['txtInternalLink'];
									$query = "UPDATE links set Title='$Title', InternalLink='$InternalLink', Description='$Description', Link='$Link' where EncryptID='".$_GET['linkid']."'";	
				
					$comicsDB->execute($query);		
					if($DeleteImage == 1) {
						$query = "UPDATE links set Image='' where EncryptID='".$_GET['linkid']."'";		
						$comicsDB->execute($query);	
					
					}
					
					
					if ($Filename != '') {
						$SourceFile = $Filename;
						if ($ContentType != 'story'){
							if(!is_dir($CoreRoot."comics/".$ComicDirectory ."/images/links")) 
								mkdir($CoreRoot."comics/".$ComicDirectory ."/images/links", 0777);
							copy($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename,$CoreRoot.'comics/'.$ComicDirectory.'/images/links/'.$Filename);
							chmod($CoreRoot.'/comics/'.$ComicDirectory.'/images/links/'.$Filename,0777);
							$Filename = 'http://www.panelflow.com/comics/'.$ComicDirectory.'/images/links/'.$Filename;
							$query = "UPDATE links SET Image='$Filename' WHERE EncryptID='".$_GET['linkid']."'";
						}else{
							if(!is_dir($CoreRoot."stories/".$ComicDirectory ."/images/links")) 
								mkdir($CoreRoot."stories/".$ComicDirectory ."/images/links", 0777);
							copy($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename,$CoreRoot.'stories/'.$ComicDirectory.'/images/links/'.$Filename);
							chmod($CoreRoot.'/stories/'.$ComicDirectory.'/images/links/'.$Filename,0777);
							$Filename = 'http://www.panelflow.com/stories/'.$ComicDirectory.'/images/links/'.$Filename;
							$query = "UPDATE links SET Image='$Filename' WHERE EncryptID='".$_GET['linkid']."'";
						
						} 
							$comicsDB->execute($query);
							unlink($CoreRoot.$PFDIRECTORY.'/temp/'.$SourceFile);
					}
					
				$Action = 'edit';
				$LinkID =$_GET['linkid'];
					
			}	else if ($_GET['a'] == 'create') { 
					$Action = 'add';
					$Title = mysql_real_escape_string($_POST['txtTitle']);
					$Description = mysql_real_escape_string($_POST['txtDescription']);
					$Link = $_POST['txtLinkUrl'];
					$InternalLink = $_POST['txtInternalLink'];
					$Filename = $_POST['txtFilename'];
					$Now = date('Ymdhms');
					if ($ContentType != 'story')
					$query = "INSERT into links (Title, Description, Link,ComicID, InternalLink, CreatedDate) values ('$Title', '$Description', '$Link','$ComicID','$InternalLink','$Now')";	
					else
						$query = "INSERT into links (Title, Description, Link,StoryID, InternalLink, CreatedDate) values ('$Title', '$Description', '$Link','$StoryID','$InternalLink','$Now')";		
					$comicsDB->execute($query);	
						if ($ContentType != 'story')
					$query ="SELECT ID from links WHERE ComicID='$ComicID' and CreatedDate='$Now'";
					else
					$query ="SELECT ID from links WHERE StoryID='$StoryID' and CreatedDate='$Now'";
					$LinkID = $comicsDB->queryUniqueValue($query);
					$Encryptid = substr(md5($LinkID), 0, 8).dechex($LinkID);
					$query = "UPDATE links SET EncryptID='$Encryptid' WHERE ID='$LinkID'";
					$comicsDB->execute($query);
					
					if ($Filename != '') {
					$SourceFile = $Filename;
					if ($ContentType != 'story') {
							if(!is_dir($CoreRoot."comics/".$ComicDirectory ."/images/links")) 
								mkdir($CoreRoot."comics/".$ComicDirectory ."/images/links", 0777);
		
							copy($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename,$CoreRoot.'comics/'.$ComicDirectory.'/images/links/'.$Filename);
							chmod($CoreRoot.'comics/'.$ComicDirectory.'/images/links/'.$Filename,0777);
							$Filename = 'http://www.panelflow.com/comics/'.$ComicDirectory.'/images/links/'.$Filename;
					} else {
							if(!is_dir($CoreRoot."stories/".$ComicDirectory ."/images/links")) 
								mkdir($CoreRoot."stories/".$ComicDirectory ."/images/links", 0777);
		
							copy($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename,$CoreRoot.'stories/'.$ComicDirectory.'/images/links/'.$Filename);
							chmod($CoreRoot.'stories/'.$ComicDirectory.'/images/links/'.$Filename,0777);
							$Filename = 'http://www.panelflow.com/stories/'.$ComicDirectory.'/images/links/'.$Filename;
					
					}
							$query = "UPDATE links SET Image='$Filename' WHERE EncryptID='$Encryptid'";
							$comicsDB->execute($query);
							unlink($CoreRoot.$PFDIRECTORY.'/temp/'.$SourceFile);
					
					}
					
					$LinkID = $Encryptid;
					
			}
			
			if (($Action == 'edit') || ($Action == 'add')|| ($Action == 'delete')) {
			
				$ConnectKey = createKey();
				$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
				$comicsDB->query($query);
	///GRAB TEMPLATE INFORMATION
				 $post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'p' => $LinkID, 'a'=>$Action, 'k' => $ConnectKey,'t'=>$ContentType);
				$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_links.php", $post_data);
				unset($post_data);
				//print 'RESULT = ' . $updateresult;
				if ($ContentType != 'story') 
				header("location:/cms/edit/".$SafeFolder."/?section=links");
				else
				header("location:/story/edit/".$SafeFolder."/?section=links");

				
			}		
				
			} else {
				if (($_GET['t'] == 'menu') && ($_GET['a'] == 'create')) {
						$Inserted = 0;
						$Title = mysql_real_escape_string($_POST['txtTitle']);
						$Url = mysql_real_escape_string($_POST['txtUrl']);
						$Window = $_POST['txtWindow'];
						$SectionLink = $_POST['txtSection'];
						$PageLink = $_POST['txtPage'];
						$Published = $_POST['txtPublished'];
						$Parent = $_POST['txtParent'];
						$ButtonImage = $_POST['txtButtonImage'];
						$RolloverButtonImage = $_POST['txtRolloverButtonImage'];
						$query = "SELECT Position from menu_links WHERE Position=(SELECT MAX(Position) FROM menu_links where ComicID ='$ComicID' )";
						$NewPosition = $comicsDB->queryUniqueValue($query);
						$NewPosition++;
						
		
						$query = "INSERT into menu (Title, Url, Window, Content, Application, LinkType, Image, Position, Published,ContentID) values ('$Title','$Url','$Window','$Content','$Application','$LinkType','$Image','$NewPosition','$Published','$ContentID')";
						$comicsDB->execute($query);
		
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
					if (($_GET['t'] == 'menu') && ($_GET['a'] == 'delete')) {
						$ItemID = $_GET['id'];
						$query = "DELETE from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						$comicsDB->execute($query);
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
					
					if (($_GET['t'] == 'menu') && ($_GET['a'] == 'up')) {
						$ItemID = $_GET['id'];
						$CurrentOrder = array();
						$i=0;
						$query = "SELECT * from menu_links where ComicID='$ComicID' order by position";
						$comicsDB->query($query);
						while ($line = $comicsDB->fetchNextObject()) { 
							$CurrentOrder[] = $line->ID;
							if ($line->ID == $ItemID) {
								$ArrayPosition = $i;
							}
							$i++;
						}
						$TotalLinks = $comicsDB->numRows();
						
						$query = "SELECT Position from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						$CurrentPosition = $comicsDB->queryUniqueValue($query);
						if ($CurrentPosition != 1) {
							$NewPosition = $CurrentPosition--;
							$NewOrder = $CurrentOrder[$ArrayPosition];
							$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition-1];
							$CurrentOrder[$ArrayPosition-1] = $NewOrder;
							   for ( $counter =0; $counter < $TotalLinks; $counter++) {
								$MenuID = $CurrentOrder[$counter];
								$UpdatePosition = $counter + 1;
								$query = "UPDATE menu_links set Position='$UpdatePosition' where EncryptID ='$MenuID'"; 
								$comicsDB->execute($query);
								}
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
						
					}
					
					
					
					if (($_GET['a'] == 'menu') && ($_GET['a'] == 'down')) {
						$CurrentOrder = array();
						$ItemID = $_GET['id'];
						$i=0;
						$query = "SELECT * from menu_links where ComicID='$ComicID' order by position";
						$comicsDB->query($query);
						//print $query;
						while ($line = $comicsDB->fetchNextObject()) { 
							$CurrentOrder[] = $line->ID;
							if ($line->ID == $ItemID) {
								$ArrayPosition = $i;
								//print "MENU ID = " . $MenuID;
							}
							$i++;
						}
						$TotalLinks = $comicsDB->numRows();
						
					$query = "SELECT Position from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						//print $query;
						$CurrentPosition = $comicsDB->queryUniqueValue($query);
						//print "CURRENT POSITION = " . $CurrentPosition ;
						//print "MY Total Links = " . $TotalLinks;
						if ($CurrentPosition != $TotalLinks) {
							$NewPosition = $CurrentPosition--;
							$NewOrder = $CurrentOrder[$ArrayPosition];
							$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition+1];
							$CurrentOrder[$ArrayPosition+1] = $NewOrder;
							   for ($counter =0; $counter < $TotalLinks; $counter++) {
									$MenuID = $CurrentOrder[$counter];
									$UpdatePosition = $counter + 1;
									$query = "UPDATE menu_links set Position='$UpdatePosition' where EncryptID ='$MenuID'"; 
									$comicsDB->query($query);
								//	print $query;
								}
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
						
					}
						
					
					if (($_GET['a'] == 'menu') && ($_GET['a'] == 'save') && (isset($_GET['id']))) {
						$Title = mysql_escape_string($_POST['txtTitle']);
						$ImageRemove = $_POST['txtImageRemove'];
						$SubMenu = $_POST['txtSubmenu'];
						$ContentID = $_POST['txtContentID'];
						
						
						if ($ImageRemove == 1) {
							$query = "UPDATE menu set Image = '' where id='$MenuID'";
							$comicsDB->query($query);
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					} else if (($_GET['a'] == 'menu') && ($_GET['a'] == 'save')) {
						$Title = mysql_escape_string($_POST['txtTitle']);
						$ImageRemove = $_POST['txtImageRemove'];
						$SubMenu = $_POST['txtSubmenu'];
						$ContentID = $_POST['txtContentID'];
						
						
						if ($ImageRemove == 1) {
							$query = "UPDATE menu set Image = '' where id='$MenuID'";
							$comicsDB->query($query);
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
						
			}
}
?>