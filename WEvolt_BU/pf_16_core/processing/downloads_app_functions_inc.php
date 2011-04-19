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

if ($Auth == 1) {	
include_once(INCLUDES.'/content_functions.php');

if (($_GET['a'] == 'finish') || ($_GET['a'] == 'save')){
					$Action = $_GET['a'];
				//	print_r($_POST);
					$Name = mysql_real_escape_string($_POST['txtName']);
					$Description = mysql_real_escape_string($_POST['txtDescription']);
					$Tags = mysql_real_escape_string($_POST['txtTags']);
					$DLID = $_POST['txtItem'];
					$Privacy = $_POST['txtPrivacy'];
					$CreateDate = date('Y-m-d h:i:s');
					$Filename = $_POST['txtFilename'];
					$Tags =  mysql_real_escape_string($_POST['txtTags']);
					$DLType = $_POST['DLType'];
					if ($DLType == '1') {
						$DownloadsImage = 'desktops';
						$Resize = 250;
					} else if ($DLType == '2'){
						$DownloadsImage = 'covers';
						$Resize = 200;
					} else if ($DLType == '3'){
						$DownloadsImage = 'avatars';
						$Resize = 100;
					} else if ($DLType == '4'){
						$DownloadsImage = 'files';
						$Resize = 0;
						$Thumb = $_POST['txtThumb'];
					} else if ($DLType == '5'){
						$DownloadsImage = 'other';
						$Resize = 200;
					}
					//IF IMAGE HAS BEEN UPLOADED 
					if ($Filename != '') {
					
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/thumbs")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/thumbs/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/", 0777);
								
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage)) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/320")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/320/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/480")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/480/", 0777);
						
								$originalimage = $_SERVER['DOCUMENT_ROOT']."/temp/".$Filename;
								$ext = substr(strrchr($Filename, "."), 1);
								$randName = md5(rand() * time());
								$NewFilename = $randName . '.' . $ext;
								if ($DLType != 4) {
								//print 'original = ' . $originalimage.'<br/>';
									$DLImage = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/".$randName.'.jpg';
								//print 'characterimage = ' . $characterimage.'<br/>';
									$DLThumb = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/thumbs/".$randName.'.jpg';
									$iphoneDLSm = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/320/".$randName.'.jpg';
									$iphoneDLLg = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/downloads/".$DownloadsImage."/480/".$randName.'.jpg';
									$convertString = "convert $originalimage $DLImage";
									exec($convertString);
									chmod($DLImage, 0777);
									$convertString = "convert $originalimage -resize $Resize $DLThumb";
									exec($convertString);
									chmod($DLThumb, 0777);
									$convertString = "convert $originalimage -resize 320 $iphoneDLSm";
									exec($convertString);
									chmod($iphoneDLSm, 0777);
									$convertString = "convert $originalimage -resize 480 $iphoneDLLg";
									exec($convertString);
									chmod($iphoneDLLg, 0777);
									 $DLImage = "images/downloads/".$DownloadsImage."/".$randName.'.jpg';
									 $DLThumb = "images/downloads/".$DownloadsImage."/thumbs/".$randName.'.jpg';
			
							 } else {
								 
								 copy($_SERVER['DOCUMENT_ROOT'].'/images/temps/'.$Thumb,$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/thumbs/".$randName.'.jpg');
								 chmod($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/thumbs/".$randName.'.jpg', 0777);
								 
								 copy($originalimage,$_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/".$NewFilename);
								 chmod($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/downloads/".$DownloadsImage."/".$NewFilename, 0777);
								 
								  $DLImage = "images/downloads/".$DownloadsImage."/".$NewFilename;  
								   $DLThumb = "images/downloads/".$DownloadsImage."/thumbs/".$randName.'.jpg';
								 
							 }
						 unlink($originalimage); 
						
							if ($_GET['a'] == 'save') {
								$query = "UPDATE comic_downloads set Image='$DLImage', Thumb= '$DLThumb',Filename='$NewFilename' where EncryptID='$DLID' and ProjectID='".$_SESSION['sessionproject']."'";
								$InitDB->execute($query);	
								$FileSet = 'yes';
							
							}
					   
					}
					
					$Now = date('Y-m-d h:i:s');
					if ($_GET['a'] == 'finish'){
								$query = "INSERT into comic_downloads (ProjectID, Name,Description, DLType, Image, Thumb, Filename, CreateDate, PrivacySetting, Tags) values ('".$_SESSION['sessionproject']."','$Name','$Description', '$DLType','$DLImage', '$DLThumb', '$NewFilename','$CreateDate','".$_POST['txtPrivacy']."','$Tags')";	
							$InitDB->execute($query);	
						//	print $query.'<br/>';	
							$output .= $query.'<br/>'; 
							
							if ($ContentType != 'story')
								$query ="SELECT ID from comic_downloads WHERE ProjectID='".$_SESSION['sessionproject']."' and CreateDate='$CreateDate'";
							else
								$query ="SELECT ID from comic_downloads WHERE ProjectID='".$_SESSION['sessionproject']."' and CreateDate='$CreateDate'";
							$DLID = $InitDB->queryUniqueValue($query);
							$output .= $query.'<br/>';
							$Encryptid = substr(md5($DLID), 0, 15).dechex($DLID);
							$IdClear = 0;
							$Inc = 5;
							while ($IdClear == 0) {
									$query = "SELECT count(*) from comic_downloads where EncryptID='$Encryptid'";
									$Found = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									if ($Found == 1) {
										$Encryptid = substr(md5(($DLID+$Inc)), 0, 15).dechex($DLID+$Inc);
									} else {
										$query = "UPDATE comic_downloads SET EncryptID='$Encryptid' WHERE ID='$DLID'";
										$InitDB->execute($query);
										$output .= $query.'<br/>';
										$IdClear = 1;
									}
									$Inc++;
							}
							$DLID = $Encryptid;
						//	print $query.'<br/>';
							InsertProjectContent('new', $_SESSION['sessionproject'], $DLID, 'downloads', $_SESSION['userid'],$Tags);
 							
				} 
		} 
	
if (($_GET['a']=='') && ($_POST['a'] == '')) {
					$ComicXML = '';
					$query = "SELECT * from comic_downloads where ProjectID ='".$_SESSION['sessionproject']."'";
					//$DB->query($query);
					
					$pagination    =    new pagination();  
					
					//$TotalDownloads = $DB->numRows();
					$pagination->createPaging($query,$NumItemsPerPage); 
					$DownloadsString = '';
					$TotalDownloads = $pagination->totalresult;
					while($line=mysql_fetch_object($pagination->resultpage)) {
						//$TotalDownloads++;
							$DownloadsString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$DownloadsString .= '<table width="100%"><tr>';
							$DownloadsString .= '<td width="80" style="padding-left:5px;"><img src="/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/'.$line->Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$DownloadsString .= '<td style="padding-left:7px;" width="200" align="left" class="grey_cmsboxcontent"><b>Name: </b></div>'.stripslashes($line->Name).'<div class="spacer"></div><b>Type: </b>';
							switch($line->DlType) {
								case 1:
								$DownloadsString .= 'Desktop Wallpaper';	
								break;
								case 2:
								$DownloadsString .= 'Cover';	
								break;
								case 3:
								$DownloadsString .= 'Avatar';	
								break;
								case 4:
								$DownloadsString .= 'File';	
								break;
								case 5:
								$DownloadsString .= 'Other';	
								break;
							}
							
							
							$DownloadsString .= '</td>';
							$DownloadsString .= '<td width="150" valign="top" class="grey_cmsboxcontent" align="left"><div style="padding-left:3px;padding-right:2px;height:68px;width:150px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Description).'</div></td>';
							$DownloadsString .= '<td rowspan="2" class="grey_cmsboxcontent" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/downloads_inc.php?dlid='.$line->EncryptID.'&a=edit&project='.$_SESSION['safefolder'].'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/downloads_inc.php?dlid='.$line->EncryptID.'&section='.$Section.'&a=delete&project='.$_SESSION['safefolder'].'"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
							
							
							   
							$DownloadsString .= '</tr>';	
							$DownloadsString .= '</table>';
							
							$DownloadsString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

					}
					
	} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
				
				if ($ContentType != 'story')
					$query = "SELECT * from comic_downloads where ProjectID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['dlid']."'";	
				else
					$query = "SELECT * from comic_downloads where StoryID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['dlid']."'";	
					
				$DownloadsArray = $InitDB->queryUniqueObject($query);
				$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='".$_GET['dlid']."' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='download'";
				$FlowArray = $InitDB->queryUniqueObject($query);
				
				 	$output .= $query.'<br/>';
	} else if ($_POST['a'] == 'delete') {
				if ($ContentType != 'story')
					$query = "DELETE from comic_downloads where ProjectID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtItem']."'";	
				else
					$query = "DELETE from comic_downloads where StoryID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtItem']."'";	
					$InitDB->execute($query);
					$Action = 'delete';
					$DLID =$_POST['txtItem'];
					$output .= $query.'<br/>';
	} else if ($_GET['a'] == 'save') {

		$query = "UPDATE comic_downloads SET Name='$Name',Description='$Description', PrivacySetting='".$_POST['txtPrivacy']."',Tags='$Tags', DlType='$DLType' WHERE EncryptID='".$_POST['txtItem']."'";
		$InitDB->execute($query);		
		//print $query.'<br/>';
	}			
	
	if (($Action == 'save') || ($Action == 'finish')|| ($Action == 'delete')) {
			/*
				$ConnectKey = createKey();
				$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
				$DB->query($query);
								
				$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'s' => $Section,'p' => $CharID, 'a'=>$Action, 'k' => $ConnectKey,'t'=>$ContentType,'f' => $FileSet,);
				$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_characters.php", $post_data);
				unset($post_data);
				$output .= 'UPDATE RESULT = ' . $updateresult.'<br/>';
				
				if (in_array($_SESSION['userid'],$SiteAdmins)) {
					print 'FULL OUTPUT = <br><br>'.$output; 
				
				} else {
				//*/
				header("location:/".$_SESSION['pfdirectory']."/section/downloads_inc.php");
				
				//}
				
	}
} else {

	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';

}
?>