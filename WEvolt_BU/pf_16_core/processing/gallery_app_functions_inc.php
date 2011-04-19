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
	$Action = $_GET['a'];
	$Name = mysql_real_escape_string($_POST['txtName']);
	$Description = mysql_real_escape_string($_POST['txtDescription']);
	$GalleryID = $_POST['txtGallery'];
	$ItemID = $_POST['txtItem'];
	$Tags =  mysql_real_escape_string($_POST['txtTags']);
	$CreateDate = date('Y-m-d h:i:s');
	$Filename = $_POST['txtFilename'];
	$GalleryType = $_POST['GalleryType'];
	$PrivacySetting = $_POST['txtPrivacy'];
	$CategoryID= $_POST['txtCat'];
	$GalleryThumb = $_POST['txtGalleryThumb'];
	$Embed = mysql_real_escape_string($_POST['txtEmbed']);
	if ($GalleryThumb == '')
		$GalleryThumb = 0;
	if ($_GET['sub'] == '') {
				if (($_GET['a']=='') && ($_POST['a'] == '')) {
					$query = "SELECT g.*, gc.ThumbMd as GallThumb
							  from pf_galleries as g
							  left join pf_gallery_content as gc on (gc.GalleryID=g.EncryptID and gc.GalleryThumb=1)where 
							  g.ProjectID ='".$_SESSION['sessionproject']."'";
					$pagination    =    new pagination(); 
					 //print $query;
					$pagination->createPaging($query,$NumItemsPerPage); 
					$GalleryString = '';
					$TotalGalleries = 0;
					while($line=mysql_fetch_object($pagination->resultpage)) {
							if ($line->GallThumb == '')
								$Thumb = 'pf_16_core/images/no_thumb.jpg';
							else 
								$Thumb = $line->GallThumb;
								
							$BoxType = 'grey_box';
							$TotalGalleries++;
							$GalleryString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$GalleryString .= '<table width="100%"><tr>';
							$GalleryString .= '<td width="80" style="padding-left:5px;"><img src="/'.$Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$GalleryString .= '<td style="padding-left:7px;" width="200" class="grey_cmsboxcontent" align="left" valign="top"><b>Name:</b><br/>'.stripslashes($line->Title).'</td>';
							$GalleryString .= '<td width="150" valign="top" class="grey_cmsboxcontent" align="left"><div style="padding-left:3px;padding-right:2px;height:68px;width:150px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Description).'</div></td>';
							$GalleryString .= '<td  rowspan="2"  align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?gallery='.$line->EncryptID.'&sub=item&a=new"><img src="http://www.wevolt.com/images/cms/cms_grey_add_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?gallery='.$line->EncryptID.'&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?gallery='.$line->EncryptID.'&a=remove"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
							$GalleryString .= '</tr>';	
							$GalleryString .= '</table>';
							$GalleryString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

					}
				} else if ($_GET['a'] == 'finish'){
						if ($GalleryType == 'images') {
							$UpdateGallery = 'image gallery';
						} else if ($GalleryType == 'videos') {
							$UpdateGallery = 'video gallery';
						
						}else if ($GalleryType == 'media') {
							$UpdateGallery = 'media gallery';
						
						}else if ($GalleryType == 'music') {
							$UpdateGallery = 'music gallery';
						
						}else if ($GalleryType == 'sounds') {
							$UpdateGallery = 'sound gallery';
						
						}
							$query = "INSERT into pf_galleries (ProjectID, Title,Description, GalleryType, CreatedDate, PrivacySetting, Tags) values ('".$_SESSION['sessionproject']."','$Name','$Description', '$GalleryType','$CreateDate','$PrivacySetting','$Tags')";	
							$InitDB->execute($query);	
							$output .= $query.'<br/>'; 
							$query ="SELECT ID from pf_galleries WHERE ProjectID='".$_SESSION['sessionproject']."' and CreatedDate='$CreateDate'";
							$GID = $InitDB->queryUniqueValue($query);
							$output .= $query.'<br/>';
							$Encryptid = substr(md5($GID), 0, 15).dechex($GID);
							
							$IdClear = 0;
							$Inc = 5;
							while ($IdClear == 0) {
									$query = "SELECT count(*) from pf_galleries where EncryptID='$Encryptid'";
									$Found = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									if ($Found == 1) {
										$Encryptid = substr(md5(($GID+$Inc)), 0, 15).dechex($GID+$Inc);
									} else {
										$query = "UPDATE pf_galleries SET EncryptID='$Encryptid' WHERE ID='$GID'";
										$InitDB->execute($query);
										$output .= $query.'<br/>';
										$IdClear = 1;
									}
									$Inc++;
							}
							
							$GID = $Encryptid;
							InsertProjectContent('new', $_SESSION['sessionproject'], $GID, $UpdateGallery, $_SESSION['userid'],$Tags);
 							//print $output;
				} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete') || ($_GET['a'] == 'remove')|| ($_GET['a'] == 'new')) {
					$query = "SELECT * from pf_galleries where ProjectID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['gallery']."'";	
					$GalleryArray = $InitDB->queryUniqueObject($query);
					$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='".$_GET['gallery']."' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='gallery'";
				$FlowArray = $InitDB->queryUniqueObject($query);
				} else if ($_POST['a'] == 'delete') {
					$query = "DELETE from pf_galleries where projectID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtGallery']."'";	
					$InitDB->execute($query);
					$Action = 'delete';
				} else if ($_GET['a'] == 'save') {
						$query = "UPDATE pf_galleries SET Title='$Name',Description='$Description',Tags='$Tags', PrivacySetting='$PrivacySetting' WHERE EncryptID='".$_POST['txtGallery']."'";
						$InitDB->execute($query);		
				}			
	
				if (($_GET['a']== 'save') || ($_GET['a'] == 'finish')|| ($_POST['a'] == 'delete')) {
						header("location:/".$_SESSION['pfdirectory']."/section/gallery_inc.php");
							
				}
	} else {
		
		if ($_GET['sub'] == 'item') {
					
			if (($_GET['a']=='') && ($_POST['a'] == '')) {
				
					$query = "SELECT gc.*, g.Title as GalleryTitle, g.GalleryType
					          from pf_gallery_content as gc 
							  join pf_galleries as g on gc.GalleryID=g.EncryptID 
							  where g.ProjectID ='".$_SESSION['sessionproject']."'";
							  
					if ($_GET['gallery'] != '') 
						$query .= " and g.ID='".$_GET['gallery']."'";
					$pagination    =    new pagination();  
					$pagination->createPaging($query,$NumItemsPerPage); 
					$ItemString = '';
					$TotalItems = 0;
					while($line=mysql_fetch_object($pagination->resultpage)) {						
							$BoxType = 'grey_box';
							$TotalItems++;
							if (($line->ThumbMd == '') && ($line->NeedConvert == 0))
								$Thumb = 'pf_16_core/images/no_thumb.jpg';
							else if (($line->ThumbMd == '') && ($line->NeedConvert == 1))
								$Thumb = 'pf_16_core/images/processing_image.jpg';
							else
								$Thumb = $line->ThumbMd;
							
							$ItemString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$ItemString .= '<table width="100%"><tr>';
							$ItemString .= '<td width="80" style="padding-left:5px;"><img src="/'.$Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$ItemString .= '<td style="padding-left:7px;" width="200" align="left" valign="top"><div  class="grey_cmsboxcontent">'.stripslashes($line->Title).'</div><br/><div class="messageinfo">gallery: '.stripslashes($line->GalleryTitle).'</div></td>';
							$ItemString .= '<td width="150" valign="top" class="grey_cmsboxcontent" align="left"><div style="padding-left:3px;padding-right:2px;height:68px;width:150px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Description).'</div></td>';
							$ItemString .= '<td class="grey_cmsboxcontent" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?sub=item&a=edit&item='.$line->EncryptID.'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?item='.$line->EncryptID.'&a=delete&sub=item"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
						$ItemString .= '</tr>';	
							$ItemString .= '</table>';
							$ItemString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

					}
			
			} else  if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')|| ($_GET['a'] == 'new')) {
					if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
						$query = "SELECT gc.*, g.GalleryType 
						          from pf_gallery_content as gc
								  join pf_galleries as g on gc.GalleryID=g.EncryptID 
								  where gc.ProjectID ='".$_SESSION['sessionproject']."' and gc.EncryptID='".$_GET['item']."'";	
						$GalleryArray = $InitDB->queryUniqueObject($query);
						
						$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='".$_GET['item']."' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='gallery item'";
					$FlowArray = $InitDB->queryUniqueObject($query);
					
					} else if ($_GET['a'] == 'new') {
						$query = "SELECT * from pf_galleries where ProjectID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['gallery']."'";	
						$GalleryArray = $InitDB->queryUniqueObject($query);
					//	print $query; 
					}
					if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
						$query = "SELECT count(*) from pf_gallery_categories where ProjectID ='".$_SESSION['sessionproject']."'";	
						$Found = $InitDB->queryUniqueValue($query);
						//print $query;
							if ($Found == 0) {
								$CreatedDate = date('Y-m-d h:i:s');
								$query = "INSERT into pf_gallery_categories (ProjectID, Title, UserID, Position, PrivacySetting, CreatedDate) values ('".$_SESSION['sessionproject']."', 'Exrtas', '".$_SESSION['userid']."', '1', 'public', '$CreatedDate')"; 
								$InitDB->execute($query);
							} else {
								$query = "SELECT * from pf_gallery_categories where ProjectID='".$_SESSION['sessionproject']."'";
								$InitDB->query($query);
								//print $query;
								$CatSelect = '<select name="txtCat">';
								while ($line = $InitDB->FetchNextObject()) {
										$CatSelect .= "<option value ='".$line->ID."'";
										if ($line->ID == $GaleryArray->CategoryID) {
											$CatSelect .= " selected ";
										}
										$CatSelect .= ">".$line->Title."</option>";
								}
								$CatSelect .='</select>';
							
							}
						if (($_GET['a'] == 'new') && ($_GET['gallery'] == ''))	{
						
								$query = "SELECT * from pf_galleries where ProjectID='".$_SESSION['sessionproject']."'";
								$InitDB->query($query);
								$GallerySelect = '<select name="txtGallery">';
								while ($line = $InitDB->FetchNextObject()) {
										$GallerySelect .= "<option value ='".$line->EncryptID."'>".$line->Title."</option>";
								}
								$GallerySelect .='</select>';
						
						
						}
					}
				
			} else if (($_GET['a'] == 'finish') || ($_GET['a'] == 'save')){
					$MediaTypes = array ('avi', 'mov','flv','swf','mp3','wav','mpa','wmv','aiff','wma');
					//$ConvertTypes = array ('avi', 'mov','wav','mpa','wmv','aiff','wma');
					$NeedConvert =0;
					if ($Filename != '') {
						
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/", 0777);
								
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/", 0777);
								
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/pro")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/pro/", 0777);
								
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/media")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/media/", 0777);
							
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/pro")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/pro/", 0777);
						
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs/", 0777);
							
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/320")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/320/", 0777);
								
							if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/480")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/480/", 0777);
		
							$originalfile = $_SERVER['DOCUMENT_ROOT']."/temp/".$Filename;
							$ext = substr(strrchr($Filename, "."), 1);
							$randName = md5(rand() * time());
							$NewFilename = $randName . '.' . strtolower($ext);
							$FileType = strtolower($ext);
							if (in_array(strtolower($ext),$MediaTypes)) {
									$NeedConvert =1;
									copy($originalfile,$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/media/".$randName.'.'.$FileType);
									chmod($_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/media/".$randName.'.'.$FileType,0777);
							} else  {
									
									list($width,$height)=getimagesize($originalfile);
									
									$GalleryImage = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/".$randName.'.'.$ext;

									$ThumbSm = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs/".$randName.'_sm.jpg';
									$ThumbMd = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs/".$randName.'_md.jpg';
									$ThumbLg = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs/".$randName.'_lg.jpg';
									$Thumb100 = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/thumbs/".$randName.'_100.jpg';
									$iphoneSm = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/320/".$randName.'.'.$ext;
									$iphoneLg = $_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/480/".$randName.'.'.$ext;
									if ($width > 1000) {
										$GalleryImagePro =$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/pro/".$randName.'.'.$ext;
										$convertString = "convert $originalfile -resize 1000 ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImagePro";
										@exec($convertString);
										@chmod($_SERVER['DOCUMENT_ROOT']."/".$GalleryImagePro, 0777);
									}
									
									if ($width > 800) {
										$convertString = "convert $originalfile -resize 800 ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage";
										@exec($convertString);
										//print 'CONVERT = ' . $convertString.'</br>';
									} else if ($width <= 800) {
										copy($originalfile,$_SERVER['DOCUMENT_ROOT']."/".$GalleryImage);
										//print 'COPIED';
									}
									
									if ($GalleryImagePro == '')
										$GalleryImagePro =$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/gallery/images/".$randName.'.'.$ext;
									//print 'GalleryImage Pro = ' . $GalleryImagePro.'<br/>';
									chmod($_SERVER['DOCUMENT_ROOT']."/".$GalleryImage, 0777);
									//print 'GalleryImage = ' . $GalleryImage.'<br/>';
									
									//iPhone/Mobile Images
									$convertString = "convert ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage -resize 320 ".$_SERVER['DOCUMENT_ROOT']."/$iphoneSm";
									exec($convertString);
								//	print 'CONVERT = ' . $convertString.'</br>';
									chmod($_SERVER['DOCUMENT_ROOT']."/".$iphoneSm, 0777);
									
									$convertString = "convert ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage -resize 480 ".$_SERVER['DOCUMENT_ROOT']."/$iphoneLg";
									exec($convertString);
									chmod($_SERVER['DOCUMENT_ROOT']."/".$iphoneLg, 0777);
									//print 'CONVERT = ' . $convertString.'</br>';
									
									//System Proportional Thumbs
									$convertString = "convert ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage -resize 75 ".$_SERVER['DOCUMENT_ROOT']."/$ThumbSm";
									@exec($convertString);
									@chmod($_SERVER['DOCUMENT_ROOT']."/".$ThumbSm, 0777);
									//print 'CONVERT = ' . $convertString.'</br>';
									$convertString = "convert ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage -resize 150 ".$_SERVER['DOCUMENT_ROOT']."/$ThumbMd";
									@exec($convertString);
									@chmod($_SERVER['DOCUMENT_ROOT']."/".$ThumbMd, 0777);
									//print 'CONVERT = ' . $convertString.'</br>';
									$convertString = "convert ".$_SERVER['DOCUMENT_ROOT']."/$GalleryImage -resize 300 ".$_SERVER['DOCUMENT_ROOT']."/$ThumbLg";
									@exec($convertString);
									@chmod($_SERVER['DOCUMENT_ROOT']."/".$ThumbLg, 0777);
								//	print 'CONVERT = ' . $convertString.'</br>';
									 //create square thumb
									 $imgSrc = $_SERVER['DOCUMENT_ROOT']."/".$GalleryImage;   
									 list($width, $height) = getimagesize($imgSrc);   
									 $myImage = imagecreatefromjpeg($imgSrc);      
									 if($width > $height) 
										$biggestSide = $width;   
									 else 
										$biggestSide = $height;   
									 $cropPercent = .5;   
									 $cropWidth   = $biggestSide*$cropPercent;   
									 $cropHeight  = $biggestSide*$cropPercent;   
									 $c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);  
									 $thumbwidth = 100;
									 $thumbheight = 100;   
									 $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);   
									 imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], 10, $thumbwidth, $thumbheight, $cropWidth, $cropHeight);   
									 imagejpeg($thumb,$_SERVER['DOCUMENT_ROOT']."/".$Thumb100);  
									 imagedestroy($thumb); 
									 @chmod($_SERVER['DOCUMENT_ROOT']."/".$Thumb100, 0777);
									 
									$FileQuery =", ThumbLg= '$ThumbLg',ThumbMd='$ThumbMd', ThumbSm='$ThumbSm', GalleryImage='$GalleryImage', Thumb100='$Thumb100', GalleryImagePro='$GalleryImagePro'";
									 
									 
							}
						@unlink($originalfile); 
					   
					} 
						
					if ($_GET['a'] == 'save') {
						if ($GalleryThumb == 1) {
									$query = "UPDATE pf_gallery_content set GalleryThumb=0 where GalleryID='$GalleryID' and ProjectID='".$_SESSION['sessionproject']."' and GalleryThumb=1";
								    $InitDB->execute($query);	
									//print $query.'<br/>';
							}
							$query = "UPDATE pf_gallery_content set Title='$Name', Description='$Description', Tags='$Tags', Embed='$Embed', PrivacySetting='$PrivacySetting', GalleryThumb='$GalleryThumb' where EncryptID='$ItemID' and ProjectID='".$_SESSION['sessionproject']."'";
							$InitDB->execute($query);
							//print $query.'<br/>';
								
							if ($Filename != '') {
									$query = "UPDATE pf_gallery_content set Filename='$NewFilename', GalleryThumb='$GalleryThumb' ".$FileQuery." where EncryptID='$ItemID' and ProjectID='".$_SESSION['sessionproject']."'";
									$InitDB->execute($query);	
							}
					} else if ($_GET['a'] == 'finish'){
					$Embed = $_POST['txtEmbed'];
							$query ="SELECT Position from pf_gallery_content WHERE Position=(SELECT MAX(Position) FROM pf_gallery_content where ProjectID='".$_SESSION['sessionproject']."' and GalleryID='$GalleryID' and CategoryID='$CategoryID')";
									$NewPosition = $InitDB->queryUniqueValue($query);
									$NewPosition++;
									$query = "INSERT into pf_gallery_content (UserID,ProjectID, Title,Description,Tags, Filename, GalleryID, CategoryID, Position, PrivacySetting, CreatedDate, NeedConvert, FileType, Embed, GalleryThumb, ThumbLg, ThumbMd, ThumbSm, GalleryImage, Thumb100, GalleryImagePro) values ('".$_SESSION['userid']."','".$_SESSION['sessionproject']."','$Name','$Description','$Tags','$NewFilename','$GalleryID','$CategoryID','$NewPosition','$PrivacySetting','$CreateDate','$NeedConvert','$FileType','$Embed','$GalleryThumb',  '$ThumbLg', '$ThumbMd', '$ThumbSm', '$GalleryImage', '$Thumb100', '$GalleryImagePro')";	
									$InitDB->execute($query);	
									$output .= $query.'<br/>'; 
									$query ="SELECT ID from pf_gallery_content WHERE ProjectID='".$_SESSION['sessionproject']."' and CreatedDate='$CreateDate'";
									$GID = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									$Encryptid = substr(md5($GID), 0, 15).dechex($GID);
									$IdClear = 0;
									$Inc = 5;
									while ($IdClear == 0) {
											$query = "SELECT count(*) from pf_gallery_content where EncryptID='$Encryptid'";
											$Found = $InitDB->queryUniqueValue($query);
											$output .= $query.'<br/>';
											if ($Found == 1) {
												$Encryptid = substr(md5(($GID+$Inc)), 0, 15).dechex($GID+$Inc);
											} else {
												$query = "UPDATE pf_gallery_content SET EncryptID='$Encryptid' WHERE ID='$GID'";
												$InitDB->execute($query);
												$output .= $query.'<br/>';
												$IdClear = 1;
											}
											$Inc++;
									}
		
									$GID = $Encryptid;
									InsertProjectContent('added', $_SESSION['sessionproject'], $GID,'gallery content', $_SESSION['userid'],$Tags);
								///print $output;
					}
			} else if ($_POST['a'] == 'delete') {
						$query = "DELETE from pf_gallery_content where EncryptID='$ItemID' and ProjectID='".$_SESSION['sessionproject']."'";
						$InitDB->execute($query);
			}
			
			if (($_GET['a'] == 'save') || ($_GET['a'] == 'finish')|| ($_POST['a'] == 'delete')) {
				header("location:/".$_SESSION['pfdirectory']."/section/gallery_inc.php?sub=item");
							
			}
			
		} else if ($_GET['sub'] == 'cat') {
				if (($_GET['a']=='') && ($_POST['a'] == '')) {
				
					$query = "SELECT * from pf_gallery_categories where ProjectID='".$_SESSION['sessionproject']."'";
					$pagination    =    new pagination();  
					$pagination->createPaging($query,$NumItemsPerPage); 
					$CatString = '';
					$TotalCats = 0;
					while($line=mysql_fetch_object($pagination->resultpage)) {
							$BoxType = 'grey_box';
							$TotalCats++;
							$CatString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$CatString .= '<table width="100%"><tr>';
							$CatString .= '<td style="padding-left:7px;" width="200" class="sender_name" align="left" valign="top">'.stripslashes($line->Title).'</td>';
							$CatString .= '<td  class="pageboxtext" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?sub=cat&a=edit&item='.$line->ID.'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/gallery_inc.php?sub=cat&item='.$line->ID.'&a=delete"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
							$CatString .= '</tr>';	
							$CatString .= '</table>';
							$CatString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

					}
			
				} else  if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')|| ($_GET['a'] == 'new')) {
				
					$query = "SELECT * from pf_gallery_categories where ProjectID ='".$_SESSION['sessionproject']."' and ID='".$_GET['item']."'";	
					$GalleryArray = $InitDB->queryUniqueObject($query);
					
				
				} else if (($_GET['a'] == 'finish') || ($_GET['a'] == 'save')){
							if ($_GET['a'] == 'finish') {
								$query ="SELECT Position from pf_gallery_categories WHERE Position=(SELECT MAX(Position) FROM pf_gallery_categories where ProjectID='".$_SESSION['sessionproject']."')";
								$NewPosition = $InitDB->queryUniqueValue($query);
								$NewPosition++;
								$query = "INSERT into pf_gallery_categories (ProjectID, Title, UserID, Position, CreatedDate, PrivacySetting) values ('".$_SESSION['sessionproject']."','$Name','".$_SESSION['userid']."','$NewPosition','$CreateDate','$PrivacySetting')";	
								$InitDB->execute($query);	
						//	print $query;
							} else if ($_GET['a'] == 'save') {
								$query = "UPDATE pf_gallery_categories set Title='$Name', PrivacySetting='$PrivacySetting' where ID='$ItemID' and ProjectID='".$_SESSION['sessionproject']."'";
								$InitDB->execute($query);
							
							}
					
								
	
				} else if ($_POST['a'] == 'delete') {
						$query = "DELETE from pf_gallery_categories where ID='$ItemID' and ProjectID='".$_SESSION['sessionproject']."'";
						$InitDB->execute($query);
				}
			
			  
			  	if (($_GET['a'] == 'save') || ($_GET['a'] == 'finish')|| ($_POST['a'] == 'delete')) {
						header("location:/".$_SESSION['pfdirectory']."/section/gallery_inc.php?sub=cat");
							
				}
	
		}

	}
} else {

	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';

}
?>