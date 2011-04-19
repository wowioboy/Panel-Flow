<? 
$query ="SELECT p.userid, p.CreatorID, cs.Assistant1, cs.Assistant2, cs.Assistant3, cs.CreatorOne, cs. CreatorTwo, cs.CreatorThree
         from projects as p
		 join comic_settings as cs on cs.ComicID=p.ProjectID 
		 where p.ProjectID='".$_SESSION['sessionproject']."'";
	
$AccessArray = $InitDB->queryUniqueObject($query);

if (
		($AccessArray->userid == $_SESSION['userid']) || 
		($AccessArray->CreatorID == $_SESSION['userid']) || 
		(($AccessArray->Assistant1 == $_SESSION['userid'])||($AccessArray->Assistant1 == trim($_SESSION['username']))) ||
		(($AccessArray->Assistant2 == $_SESSION['userid'])||($AccessArray->Assistant2 == trim($_SESSION['username']))) ||
		(($AccessArray->Assistant3 == $_SESSION['userid'])||($AccessArray->Assistant3 == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorOne == $_SESSION['userid'])||($AccessArray->CreatorOne == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorTwo == $_SESSION['userid'])||($AccessArray->CreatorTwo == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorThree == $_SESSION['userid'])||($AccessArray->CreatorThree == trim($_SESSION['username'])))
	)
	$Auth = 1;
else
	$Auth = 0;
	
unset($AccessArray);

function move_up($ComicID, $LinkID) {

	 global $InitDB;
	
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from links where ComicID='$ComicID' order by Position";
	$InitDB->query($query);
	while ($line = $InitDB->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptID;
		if ($line->EncryptID == $LinkID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $InitDB->numRows();
	$query = "SELECT Position from links where EncryptID='$LinkID'  and ComicID='$ComicID'";
	$CurrentPosition = $InitDB->queryUniqueValue($query);
	if ($CurrentPosition != 1) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition-1];
		$CurrentOrder[$ArrayPosition-1] = $NewOrder;
		   for ( $counter =0; $counter < $TotalLinks; $counter++) {
		    $LinkID = $CurrentOrder[$counter];
			$UpdatePosition = $counter + 1;
		   	$query = "UPDATE links set Position='$UpdatePosition' where EncryptID='$LinkID' and ComicID='$ComicID'";
			$InitDB->query($query);
			
			}	
	 }
	 $query = "SELECT * from links where ComicID='$ComicID' order by Position";
	 $InitDB->query($query);
	 $ResetPos = 1;
	 while ($line = $InitDB->fetchNextObject()) {
		   $SLinkID = $line->EncryptID;
			$query = "update links set Position='$ResetPos' where ComicID='$ComicID' and EncryptID='$SLinkID'";
			$InitDB->execute($query);
			$ResetPos++;
	}
}

function move_down($ComicID, $LinkID) {
global $InitDB;
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from links where ComicID='$ComicID' order by Position";
	$InitDB->query($query);
	while ($line = $InitDB->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptID;
		if ($line->EncryptID == $LinkID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $InitDB->numRows();
	$query = "SELECT Position from links where EncryptID='$LinkID' and ComicID='$ComicID'";
	$CurrentPosition = $InitDB->queryUniqueValue($query);
	if ($CurrentPosition != $TotalLinks) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition+1];
		$CurrentOrder[$ArrayPosition+1] = $NewOrder;
		   for ($counter =0; $counter < $TotalLinks; $counter++) {
		    	$LinkID = $CurrentOrder[$counter];
				$UpdatePosition = $counter + 1;
		   		$query = "UPDATE links set Position='$UpdatePosition' where EncryptID='$LinkID' and ComicID='$ComicID'";
				$InitDB->query($query);
				
			}
	}
	
	 $query = "SELECT * from links where ComicID='$ComicID' order by Position";
	 $InitDB->query($query);
	 $ResetPos = 1;
	 while ($line = $InitDB->fetchNextObject()) {
		   $SLinkID = $line->EncryptID;
			$query = "update links set Position='$ResetPos' where ComicID='$ComicID' and EncryptID='$SLinkID'";
			$InitDB->execute($query);
			$ResetPos++;
	}

} 

if ($Auth == 1) {	
include_once(INCLUDES.'/content_functions.php');
if (isset($_GET['move'])) {
	if ($_GET['move'] == 'up') {
		move_up($_SESSION['sessionproject'], $_GET['linkid']);
	} else if ($_GET['move'] == 'down') {
		move_down($_SESSION['sessionproject'], $_GET['linkid']);
	}
	$HeaderString = "/".$_SESSION['pfdirectory']."/section/links_inc.php";
	if (isset($_GET['page'])) {
		$QueryString = "?page=".$_GET['page'];
	}
	if (isset($_GET['sub'])) {
		if ($QueryString == '')
			$QueryString = "?";
		else
			$QueryString .= "&";
		
		$QueryString .= "sub=".$_GET['sub'];
	}
	if (isset($_GET['c'])) {
		if ($QueryString == '')
			$QueryString = "?";
		else
			$QueryString .= "&";
		$QueryString .= "c=".$_GET['c'];
	}
	
	header("location:".$HeaderString.$QueryString);
}


		if ($ContentType == 'story') {
			$TargetID = $_SESSION['sessionproject'];
			$TargetName = 'StoryID';
			
		}else{
			$TargetID = $_SESSION['sessionproject'];
			$TargetName = 'ComicID';
		}	
		if (!isset($_GET['t'])) {
				if (($_GET['a']=='') && ($_POST['a']=='')) {
					$query = "SELECT Position from links WHERE Position=(SELECT MAX(Position) FROM links where ComicID='".$_SESSION['sessionproject']."')";
					$MaxPosition = $InitDB->queryUniqueValue($query);
					
				    $query = "SELECT * from links where ".$TargetName." ='$TargetID' order by Position";
			
			
					$pagination    =    new pagination();  
					$pagination->createPaging($query,$NumItemsPerPage);
					$TotalLinks = 0;
					$LinksString = '';
					//print 'TOTAL = ' . $TotalLinks;
					while($line=mysql_fetch_object($pagination->resultpage)) {
					$LinksString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
						$LinksString .= '<table width="100%"><tr>';
						$LinksString .='<td style="padding-left:7px;" width="250" class="grey_cmsboxcontent" align="left" valign="top"><b>Title:</b><br/>'.stripslashes($line->Title).'</td><td width="300" valign="top" class="grey_cmsboxcontent" align="left"><b>URL:</b><br/>';
						if ($line->InternalLink == 0) {
						$LinksString .='<a href="'.$line->Link.'" target="_blank">'.$line->Link.'</a>';
						}else {
						$LinksString .='SELF LINK';
						}
						
						//$LinksString .= '<div>BANNER IMAGE TO PROJECT</div>';
						
						
						$LinksString .='</td>';
						
						$LinksString .= '<td>';
			
			if ($line->Position != 1) {
				$LinksString .= '<a href="/'.$_SESSION['pfdirectory'].'/section/links_inc.php?linkid='.$line->EncryptID.'&move=up';
				if (isset($_GET['page']))
					$LinksString .= '&page='.$_GET['page'];
		
				$LinksString .='"><img src="/'.$_SESSION['pfdirectory'].'/images/arrow_up.png" border="0"></a>';
			}
			
			if ($line->Position != $MaxPosition) {
				$LinksString .= '<a href="/'.$_SESSION['pfdirectory'].'/section/links_inc.php?linkid='.$line->EncryptID.'&move=down';
				if (isset($_GET['page']))
					$LinksString .= '&page='.$_GET['page'];
			
				$LinksString .= '"><img src="/'.$_SESSION['pfdirectory'].'/images/arrow_down.png" border="0"><a/>';
			}
			$LinksString .='</td>';

						//if ($ContentType != 'story')
						//$LinksString .= '<td width="150" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?linkid='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]&nbsp;';
						//else 
							$LinksString .= '<td class="pageboxtext" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/links_inc.php?linkid='.$line->EncryptID.'&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/links_inc.php?linkid='.$line->EncryptID.'&section='.$Section.'&a=delete"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;';
						
						$LinksString .= '</td></tr>';
						$LinksString .= '</table>';
			
							$LinksString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
				$TotalLinks++;
					}
				
			} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
			
					$query = "SELECT * from links where ".$TargetName." ='$TargetID' and EncryptID='".$_GET['linkid']."'";			
					$LinkArray = $InitDB->queryUniqueObject($query);
					
				 	
			} else if ($_POST['a'] == 'delete') {
					$query = "DELETE from links where ".$TargetName." ='$TargetID' and EncryptID='".$_POST['txtItem']."'";		
					$InitDB->execute($query);
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
				
					$InitDB->execute($query);		
					if($DeleteImage == 1) {
						$query = "UPDATE links set Image='' where EncryptID='".$_GET['linkid']."'";		
						$InitDB->execute($query);	
					
					}
					if ($Filename != '') {
						$SourceFile = $Filename;
							if(!is_dir($PathToProject."/images/links")) 
								mkdir($PathToProject."/images/links", 0777);
							copy($_SERVER['DOCUMENT_ROOT']."/temp/".$Filename,$PathToProject."/images/links/".$Filename);
							chmod($PathToProject."/images/links/".$Filename,0777);
							$Filename = "http://".$_SERVER['SERVER_NAME']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/links/".$Filename;
							
							$query = "UPDATE links SET Image='$Filename' WHERE EncryptID='".$_GET['linkid']."'";
							$InitDB->execute($query);
							
							unlink($_SERVER['DOCUMENT_ROOT']."/temp/".$SourceFile);
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
					$Now = date('Y-m-d h:i:s');
					$query = "SELECT Position from links WHERE Position=(SELECT MAX(Position) FROM links where ComicID='".$_SESSION['sessionproject']."')";
					$MaxPosition = $InitDB->queryUniqueValue($query);
					$MaxPosition++;
					$query = "INSERT into links (Title, Description, Link,".$TargetName.", InternalLink, CreatedDate,Position) values ('$Title', '$Description', '$Link','$TargetID','$InternalLink','$Now','$MaxPosition')";	
					$InitDB->execute($query);	
					//	print $query.'<br/>';
					$query ="SELECT ID from links WHERE ".$TargetName."='$TargetID' and CreatedDate='$Now'";
					$LinkID = $InitDB->queryUniqueValue($query);
					//print $query.'<br/>';
					$Encryptid = substr(md5($LinkID), 0, 15).dechex($LinkID);
					$IdClear = 0;
					$Inc = 5;
					while ($IdClear == 0) {
									$query = "SELECT count(*) from links where EncryptID='$Encryptid'";
									$Found = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									if ($Found == 1) {
										$Encryptid = substr(md5(($LinkID+$Inc)), 0, 15).dechex($LinkID+$Inc);
									} else {
										$query = "UPDATE links SET EncryptID='$Encryptid' WHERE ID='$LinkID'";
										$InitDB->execute($query);
										$output .= $query.'<br/>';
										$IdClear = 1;
									}
									$Inc++;
					}
					
					if ($Filename != '') {
						$SourceFile = $Filename;
						if(!is_dir($PathToProject."/images/links")) 
							mkdir($PathToProject."/images/links", 0777);
		
						copy($_SERVER['DOCUMENT_ROOT']."/temp/".$Filename,$PathToProject."/images/links/".$Filename);
						chmod($PathToProject."/images/links/".$Filename,0777);
						$Filename = "http://".$_SERVER['SERVER_NAME']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/links/".$Filename;
						$query = "UPDATE links SET Image='$Filename' WHERE EncryptID='$Encryptid'";
						$InitDB->execute($query);
						unlink($_SERVER['DOCUMENT_ROOT']."/temp/".$SourceFile);
						//print $query.'<br/>';
					
					}
					
					$LinkID = $Encryptid;
					InsertProjectContent('new', $_SESSION['sessionproject'], $LinkID, 'link', $_SESSION['userid'],$Tags);
					
			} 
			
			if (($Action == 'edit') || ($Action == 'add')|| ($Action == 'delete')) {
			   /*
				$ConnectKey = createKey();
				$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
				$InitDB->query($query);
	///GRAB TEMPLATE INFORMATION
				 $post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'p' => $LinkID, 'a'=>$Action, 'k' => $ConnectKey,'t'=>$ContentType);
				$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_links.php", $post_data);
				unset($post_data);
				//print 'RESULT = ' . $updateresult;
				if ($ContentType != 'story') 
				header("location:/cms/edit/".$SafeFolder."/?section=links");
				else
				header("location:/story/edit/".$SafeFolder."/?section=links");
				*/
				//if ($_SESSION['userid'] != 'fc221309b5')
				header("location:/".$_SESSION['pfdirectory']."/section/links_inc.php");
				
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
						$NewPosition = $InitDB->queryUniqueValue($query);
						$NewPosition++;
						
		
						$query = "INSERT into menu (Title, Url, Window, Content, Application, LinkType, Image, Position, Published,ContentID) values ('$Title','$Url','$Window','$Content','$Application','$LinkType','$Image','$NewPosition','$Published','$ContentID')";
						$InitDB->execute($query);
		
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
					if (($_GET['t'] == 'menu') && ($_GET['a'] == 'delete')) {
						$ItemID = $_GET['id'];
						$query = "DELETE from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						$InitDB->execute($query);
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
					
					if (($_GET['t'] == 'menu') && ($_GET['a'] == 'up')) {
						$ItemID = $_GET['id'];
						$CurrentOrder = array();
						$i=0;
						$query = "SELECT * from menu_links where ComicID='$ComicID' order by position";
						$InitDB->query($query);
						while ($line = $InitDB->fetchNextObject()) { 
							$CurrentOrder[] = $line->ID;
							if ($line->ID == $ItemID) {
								$ArrayPosition = $i;
							}
							$i++;
						}
						$TotalLinks = $InitDB->numRows();
						
						$query = "SELECT Position from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						$CurrentPosition = $InitDB->queryUniqueValue($query);
						if ($CurrentPosition != 1) {
							$NewPosition = $CurrentPosition--;
							$NewOrder = $CurrentOrder[$ArrayPosition];
							$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition-1];
							$CurrentOrder[$ArrayPosition-1] = $NewOrder;
							   for ( $counter =0; $counter < $TotalLinks; $counter++) {
								$MenuID = $CurrentOrder[$counter];
								$UpdatePosition = $counter + 1;
								$query = "UPDATE menu_links set Position='$UpdatePosition' where EncryptID ='$MenuID'"; 
								$InitDB->execute($query);
								}
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
						
					}
					
					
					
					if (($_GET['a'] == 'menu') && ($_GET['a'] == 'down')) {
						$CurrentOrder = array();
						$ItemID = $_GET['id'];
						$i=0;
						$query = "SELECT * from menu_links where ComicID='$ComicID' order by position";
						$InitDB->query($query);
						//print $query;
						while ($line = $InitDB->fetchNextObject()) { 
							$CurrentOrder[] = $line->ID;
							if ($line->ID == $ItemID) {
								$ArrayPosition = $i;
								//print "MENU ID = " . $MenuID;
							}
							$i++;
						}
						$TotalLinks = $InitDB->numRows();
						
					$query = "SELECT Position from menu_links where EncryptID='$ItemID' and ComicID='$ComicID'";
						//print $query;
						$CurrentPosition = $InitDB->queryUniqueValue($query);
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
									$InitDB->query($query);
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
							$InitDB->query($query);
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					} else if (($_GET['a'] == 'menu') && ($_GET['a'] == 'save')) {
						$Title = mysql_escape_string($_POST['txtTitle']);
						$ImageRemove = $_POST['txtImageRemove'];
						$SubMenu = $_POST['txtSubmenu'];
						$ContentID = $_POST['txtContentID'];
						
						
						if ($ImageRemove == 1) {
							$query = "UPDATE menu set Image = '' where id='$MenuID'";
							$InitDB->query($query);
						}
						header("location:/cms/edit/".$SafeFolder."/?section=".$Section."&t=menu");
					}
					
						
			}
} else {

	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';

}
?>