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
if (($_GET['a'] == 'finish') || ($_GET['a'] == 'save')) {
					$Action = $_GET['a'];
					$Name = mysql_real_escape_string($_POST['txtName']);
					$Age = mysql_real_escape_string($_POST['txtAge']);
					$Hometown = mysql_real_escape_string($_POST['txtHomeTown']);
					$Race = mysql_real_escape_string($_POST['txtRace']);
					$HeightFt = mysql_real_escape_string($_POST['txtHeightFt']);
					$HeightIn = mysql_real_escape_string($_POST['txtHeightIn']);
					$Weight = mysql_real_escape_string($_POST['txtWeight']);
					$Abilities = mysql_real_escape_string($_POST['txtAbility']);
					$Description = mysql_real_escape_string($_POST['txtDescription']);
					$Notes = mysql_real_escape_string($_POST['txtNotes']);
					$CharID = $_POST['txtItem'];
					if ($Hometown == '') 
						$Hometown = 'NA';
					if ($Race == '') 
						$Race = 'NA';
					if ($HeightFt == '') 
						$HeightFt = 0;
					if ($HeightIn == '') 
						$HeightIn = 0;
					if ($Weight == '') 
						$Weight = 'NA';
					if ($Abilities == '') 
						$Abilities = 'NA';
					if ($Description == '') 
						$Description = 'NA'; 
					if ($Notes == '') 
						$Notes = 'NA';
					$CreateDate = date('Y-m-d h:i:s');
					$Filename = $_POST['txtFilename'];
					
					//IF IMAGE HAS BEEN UPLOADED 
					if ($Filename != '') {
					
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters/", 0777);
						
						if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters/thumbs")) 
								mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters/thumbs/", 0777);
		
						$originalimage = $_SERVER['DOCUMENT_ROOT']."/temp/".$Filename;
						$ext = substr(strrchr($Filename, "."), 1);
						$randName = md5(rand() * time());
						$NewFilename = $randName . '.' . $ext;
						//print 'original = ' . $originalimage.'<br/>';
						$characterimage = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters/".$Filename;
					  //  print 'characterimage = ' . $characterimage.'<br/>';
						$characterthumb = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/images/characters/thumbs/".$Filename;
						$iphoneCharacterSm = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/characters/320/".$Filename;
						$iphoneCharacterLg = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/iphone/images/characters/480/".$Filename;
						
						$convertString = "convert $originalimage -resize 350 $characterimage";
						exec($convertString);
						chmod($characterimage, 0777);
						
						$convertString = "convert $originalimage -resize 100 $characterthumb";
						exec($convertString);
						chmod($characterthumb, 0777);
						
						$convertString = "convert $originalimage -resize 320 $iphoneCharacterSm";
						exec($convertString);
						chmod($iphoneCharacterSm, 0777);
						
						$convertString = "convert $originalimage -resize 480 $iphoneCharacterLg";
						exec($convertString);
						chmod($iphoneCharacterLg, 0777);
						
						chmod($iphoneCharacterLg,0777);
						chmod($iphoneCharacterSm,0777);
						@unlink($originalimage); 
						$characterthumb = "images/characters/thumbs/".$Filename;
						$characterimage = "images/characters/".$Filename;
					
					/*	$imgSrc = $characterimage;   
						   
						//getting the image dimensions  
						 list($width, $height) = getimagesize($imgSrc);   
						 //saving the image into memory (for manipulation with GD Library)  
						 $myImage = imagecreatefromjpeg($imgSrc);      
						 ///--------------------------------------------------------  
						 //setting the crop size  
						 //--------------------------------------------------------  
						 if($width > $height) 
							$biggestSide = $width;   
						 else 
							$biggestSide = $height;   
							
						 //The crop size will be half that of the largest side   
						 $cropPercent = .5;   
						 $cropWidth   = $biggestSide*$cropPercent;   
						 $cropHeight  = $biggestSide*$cropPercent;   
							
							
						 //getting the top left coordinate  
						 $c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);  
							
						  //--------------------------------------------------------  
						 // Creating the thumbnail  
						 //--------------------------------------------------------  
						 $thumbwidth = 134;
						 $thumbheight = 124;   
						 $thumb = imagecreatetruecolor($thumbwidth, $thumbheight);   
						 imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], 10, $thumbwidth, $thumbheight, $cropWidth, $cropHeight);   
						 imagejpeg($thumb,$characterthumb);  
						 imagedestroy($thumb); 
						 @chmod($characterimage, 0777);
						 @chmod($characterthumb, 0777);
						 @unlink($originalimage); 
						 $characterthumb = "images/characters/thumbs/".$Filename;
						 $characterimage = "images/characters/".$Filename;
					  //print 'Character characterimage =  ' . $characterimage;
					  // print 'Character characterthumb =  ' . $characterthumb;
					  */
					   	if ($_GET['a'] == 'save') {
							$query = "UPDATE characters set Image='$characterimage', Thumb= '$characterthumb',Filename='$Filename' where EncryptID='$CharID' and ComicID='".$_SESSION['sessionproject']."'";
							$InitDB->execute($query);	
							$FileSet = 'yes';
						
						}
					   
					}
					
					$Now = date('Y-m-d h:i:s');
					if ($_GET['a'] == 'finish'){
							if ($ContentType != 'story')
								$query = "INSERT into characters (ComicID, Name, Hometown, Race, Age, HeightFt, HeightIn, Weight, Abilities, Description, Notes, Image, Thumb,Filename,CreateDate, AccessType) values ('".$_SESSION['sessionproject']."','$Name','$Hometown','$Race','$Age','$HeightFt', '$HeightIn', '$Weight', '$Abilities','$Description', '$Notes','$characterimage', '$characterthumb', '$Filename','$CreateDate', '".$_POST['txtAccessType']."')";
							else
								$query = "INSERT into characters (StoryID, Name, Hometown, Race, Age, HeightFt, HeightIn, Weight, Abilities, Description, Notes, Image, Thumb,Filename,CreateDate) values ('".$_SESSION['sessionproject']."','$Name','$Hometown','$Race','$Age','$HeightFt', '$HeightIn', '$Weight', '$Abilities','$Description', '$Notes','$characterimage', '$characterthumb', '$Filename','$CreateDate')";	
							$InitDB->execute($query);	
								
							$output .= $query.'<br/>'; 
						//print $query;
							if ($ContentType != 'story')
								$query ="SELECT ID from characters WHERE ComicID='".$_SESSION['sessionproject']."' and CreateDate='$CreateDate'";
							else
								$query ="SELECT ID from characters WHERE StoryID='".$_SESSION['sessionproject']."' and CreateDate='$CreateDate'";
							$CharID = $InitDB->queryUniqueValue($query);
							$output .= $query.'<br/>';
							$Encryptid = substr(md5($CharID), 0, 15).dechex($CharID);
							
							$IdClear = 0;
							$Inc = 5;
							while ($IdClear == 0) {
									$query = "SELECT count(*) from characters where EncryptID='$Encryptid'";
									$Found = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									if ($Found == 1) {
										$Encryptid = substr(md5(($CharID+$Inc)), 0, 15).dechex($CharID+$Inc);
									} else {
										$query = "UPDATE characters SET EncryptID='$Encryptid' WHERE ID='$CharID'";
										$InitDB->execute($query);
										$output .= $query.'<br/>';
										$IdClear = 1;
									}
									$Inc++;
							}
							$CharID = $Encryptid;
							if (in_array($_SESSION['userid'],$SiteAdmins)){
								
								echo saveProjectContent('new', $_SESSION['sessionproject'], $CharID, 'characters', $_SESSION['userid']);
							} else{
									saveProjectContent('new', $_SESSION['sessionproject'], $CharID, 'characters', $_SESSION['userid']);
 							}
				} 
		} 
	
if (($_GET['a']=='') && ($_POST['a'] == '')) {
					$ComicXML = '';
					if ($ContentType != 'story')
						$query = "SELECT * from characters where ComicID ='$ProjectID'";
					else
						$query = "SELECT * from characters where StoryID ='$StoryID'";
			
					
					$pagination    =    new pagination();  
					//print $query;
					
					$pagination->createPaging($query,$NumItemsPerPage); 
					$TotalCharacters = $pagination->totalresult;
					$CharactersString = '';
					$Count = 1;
					$ComicXML ='<characters>';
					while($line=mysql_fetch_object($pagination->resultpage)) {
						
							$CharactersString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$CharactersString .= '<table width="100%"><tr>';
							$CharactersString .= '<td width="80" style="padding-left:5px;"><img src="/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/'.$line->Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$CharactersString .= '<td style="padding-left:7px;" width="400" class="grey_cmsboxcontent" align="left" valign="top"><b>Name:</b><br/>'.stripslashes($line->Name).'</td>';
							$CharactersString .= '<td class="grey_cmsboxcontent" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/characters_inc.php?charid='.$line->EncryptID.'&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/characters_inc.php?charid='.$line->EncryptID.'&section='.$Section.'&a=delete"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
							
							
							   
							$CharactersString .= '</tr>';	
							$CharactersString .= '</table>';
							
							$CharactersString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
										
							$ComicXML .= '<character>';
							$ComicXML .= '<id>'.$line->EncryptID.'</id>';
							$ComicXML .= '<name>'.addslashes($line->Name).'</name>';
							$ComicXML .= '<age>'.$line->Age.'</age>';
							$ComicXML .= '<town>'.addslashes($line->Hometown).'</town>';
							$ComicXML .= '<feet>'.addslashes($line->HeightFt).'</feet>';
							$ComicXML .= '<inches>'.addslashes($line->HeightIn).'</inches>';
							$ComicXML .= '<race>'.addslashes($line->Race).'</race>';
							$Ability = str_replace(chr(13), '\n', $line->Abilities);
							$Ability = str_replace('"', "'", $Ability);
							$Ability = str_replace(chr(10), '\n', $Ability);
							$ComicXML .= '<ability>'.addslashes($Ability).'</ability>';
							
							$Description = str_replace(chr(13), '\n', $line->Description);
							$Description = str_replace(chr(10), '\n', $Description);
							$Description = str_replace('"', "'", $Description);
							$ComicXML .= '<description>'.addslashes($Description).'</description>';
							
							$Notes = str_replace(chr(13), '\n', $line->Notes);
							$Notes = str_replace(chr(10), '\n', $Notes);
							$Notes = str_replace('"', "'", $Notes);
							$ComicXML .= '<notes>'.addslashes($Notes).'</notes>';
							$ComicXML .= '<image>'.$line->Image.'</image>';
							$ComicXML .= '<thumb>'.$line->Thumb.'</thumb>';
							$ComicXML .= '</character>';
							
					}
					
					$ComicXML .='</characters>';
					
	} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
				
				if ($ContentType != 'story')
					$query = "SELECT * from characters where ComicID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['charid']."'";	
				else
					$query = "SELECT * from characters where StoryID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['charid']."'";	
					
				$CharArray = $InitDB->queryUniqueObject($query);
				$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='".$_GET['charid']."' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='character'";
				$FlowArray = $InitDB->queryUniqueObject($query);
				 	$output .= $query.'<br/>';
	} else if ($_POST['a'] == 'delete') {
				if ($ContentType != 'story')
					$query = "DELETE from characters where ComicID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtItem']."'";	
				else
					$query = "DELETE from characters where StoryID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtItem']."'";	
					$InitDB->execute($query);
					$Action = 'delete';
					$CharID =$_POST['txtItem'];
					$output .= $query.'<br/>';
	} else if ($_GET['a'] == 'save') {

		$query = "UPDATE characters SET Name='$Name', Hometown='$Hometown', Race='$Race', Age='$Age', HeightFt='$HeightFt', HeightIn='$HeightIn', Weight='$Weight',Abilities='$Abilities',Description='$Description',Notes='$Notes', AccessType='".$_POST['txtAccessType']."' WHERE EncryptID='$CharID'";
		$InitDB->execute($query);		
		//print $query.'<br/>';
	}			
	
	if (($Action == 'save') || ($Action == 'finish')|| ($Action == 'delete')) {
			/*
				$ConnectKey = createKey();
				$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
				$InitDB->query($query);
								
				$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'s' => $Section,'p' => $CharID, 'a'=>$Action, 'k' => $ConnectKey,'t'=>$ContentType,'f' => $FileSet,);
				$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_characters.php", $post_data);
				unset($post_data);
				$output .= 'UPDATE RESULT = ' . $updateresult.'<br/>';
				
				if (in_array($_SESSION['userid'],$SiteAdmins)) {
					print 'FULL OUTPUT = <br><br>'.$output; 
				
				} else {
				*/
			header("location:/".$_SESSION['pfdirectory']."/section/characters_inc.php");
				
				//}
				
	}
} else {
	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';
}
?>