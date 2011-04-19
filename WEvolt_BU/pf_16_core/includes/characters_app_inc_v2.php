<? 

if (($_GET['section'] == 'characters') && ($IsPro == 1)) {
	$ComicXML = '';
	if ($ContentType != 'story') {
		$query = "SELECT * from characters where ComicID ='$ComicID'";
		$TargetID = $ComicID;
		$TargetName = 'ComicID';
	} else{
		$query = "SELECT * from characters where StoryID ='$StoryID'";
		$TargetID = $StoryID;
		$TargetName = 'StoryID';
	}
	$comicsDB->query($query);
	$FileSet = 'no';
	
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
					$CreateDate = date('Y-m-d h:m:s');
					$Filename = $_POST['txtFilename'];
					
					//IF IMAGE HAS BEEN UPLOADED 
					if ($Filename != '') {
					
						if(!is_dir($CoreRoot."comics/".$ComicDirectory ."/images/characters/")) 
								mkdir($CoreRoot."comics/".$ComicDirectory ."/images/characters/", 0777);
						
						if(!is_dir($CoreRoot."comics/".$ComicDirectory ."/images/characters/thumbs")) 
								mkdir($CoreRoot."comics/".$ComicDirectory ."/images/characters/thumbs/", 0777);
		
						$originalimage = $CoreRoot.$PFDIRECTORY.'/temp/'.$Filename;
						$ext = substr(strrchr($Filename, "."), 1);
						$randName = md5(rand() * time());
						$NewFilename = $randName . '.' . $ext;
						
						$characterimage = $CoreRoot."comics/".$ComicDirectory ."/images/characters/".$randName.'.jpg';
					
						$characterthumb = $CoreRoot."comics/".$ComicDirectory ."/images/characters/thumbs/".$randName.'.jpg';
						$iphoneCharacterSm = $CoreRoot."comics/".$ComicDirectory ."/iphone/images/characters/320/".$randName.'.jpg';
						$iphoneCharacterLg = $CoreRoot."comics/".$ComicDirectory ."/iphone/images/characters/480/".$randName.'.jpg';
						@copy($originalimage,$characterimage);
						$convertString = "convert $originalimage -resize 350 $characterimage";
						@exec($convertString);
						@chmod($characterimage, 0777);
						$convertString = "convert $originalimage -resize 320 $iphoneCharacterSm";
						@exec($convertString);
						@chmod($iphoneCharacterSm, 0777);
						$convertString = "convert $originalimage -resize 480 $iphoneCharacterLg";
						@exec($convertString);
						@chmod($iphoneCharacterLg, 0777);
						chmod($iphoneCharacterLg,0777);
						chmod($iphoneCharacterSm,0777);
						$imgSrc = $characterimage;   
						   
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
						 @unlink($originalimage); 
						 $characterthumb = "images/characters/thumbs/".$randName.'.jpg';
						 $characterimage = "images/characters/".$randName.'.jpg';
					  //print 'Character characterimage =  ' . $characterimage;
					  // print 'Character characterthumb =  ' . $characterthumb;
					   	if ($_GET['a'] == 'save') {
							$query = "UPDATE characters set Image='$characterimage', Thumb= '$characterthumb',Filename='".$randName.".jpg' where EncryptID='$CharID' and ComicID='$ComicID'";
							$comicsDB->execute($query);	
							$FileSet = 'yes';
						
						}
					   
					}
					
					$Now = date('Ymdhms');
					if ($_GET['a'] == 'finish'){
							if ($ContentType != 'story')
								$query = "INSERT into characters (ComicID, Name, Hometown, Race, Age, HeightFt, HeightIn, Weight, Abilities, Description, Notes, Image, Thumb,Filename,CreateDate) values ('$TargetID','$Name','$Hometown','$Race','$Age','$HeightFt', '$HeightIn', '$Weight', '$Abilities','$Description', '$Notes','$characterimage', '$characterthumb', '".$randName.".jpg','$CreateDate')";
							else
								$query = "INSERT into characters (StoryID, Name, Hometown, Race, Age, HeightFt, HeightIn, Weight, Abilities, Description, Notes, Image, Thumb,Filename,CreateDate) values ('$TargetID','$Name','$Hometown','$Race','$Age','$HeightFt', '$HeightIn', '$Weight', '$Abilities','$Description', '$Notes','$characterimage', '$characterthumb', '".$randName.".jpg','$CreateDate')";	
							$comicsDB->execute($query);	
								
							$output .= $query.'<br/>'; 
							
							if ($ContentType != 'story')
								$query ="SELECT ID from characters WHERE ComicID='$ComicID' and CreateDate='$CreateDate'";
							else
								$query ="SELECT ID from characters WHERE StoryID='$StoryID' and CreateDate='$CreateDate'";
							$CharID = $comicsDB->queryUniqueValue($query);
							$output .= $query.'<br/>';
							$Encryptid = substr(md5($CharID), 0, 8).dechex($CharID);
							$query = "UPDATE characters SET EncryptID='$Encryptid' WHERE ID='$CharID'";
							$comicsDB->execute($query);
							$output .= $query.'<br/>';
							$CharID = $Encryptid;
							if (in_array($_SESSION['userid'],$SiteAdmins)){
								print 'CONTENT UPDATE = ';
								echo saveProjectContent('new', $ComicID, $CharID, 'characters', $_SESSION['userid']);
							} else{
									saveProjectContent('new', $ComicID, $CharID, 'characters', $_SESSION['userid']);
 							}
				} 
		} 
	
	if ((!isset($_GET['a'])) && (!isset($_POST['a']))) {
					$ComicXML = '';
					if ($ContentType != 'story')
						$query = "SELECT * from characters where ComicID ='$ComicID'";
					else
						$query = "SELECT * from characters where StoryID ='$StoryID'";
					$comicsDB->query($query);
					
			
					$TotalCharacters = $comicsDB->numRows();
					$pagination->createPaging($query,$NumItemsPerPage);
					$CharactersString = '';
					$Count = 1;
					$ComicXML ='<characters>';
					while($line=mysql_fetch_object($pagination->resultpage)) {
						
							$BoxType = 'white_box';
							$CharactersString .='<div>';
							$CharactersString .=' <b class="'.$BoxType.'">';
							$CharactersString .=' <b class="'.$BoxType.'1"><b></b></b>';
							$CharactersString .=' <b class="'.$BoxType.'2"><b></b></b>';
							$CharactersString .=' <b class="'.$BoxType.'3"></b>';
							$CharactersString .='	<b class="'.$BoxType.'4"></b>';
							$CharactersString .='	<b class="'.$BoxType.'5"></b></b>';
							$CharactersString .='<div class="'.$BoxType.'fg">';
							$CharactersString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
							$CharactersString .= '<td width="80" style="padding-left:5px;"><img src="/comics/'.$ComicFolder.'/'.$line->Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$CharactersString .= '<td style="padding-left:7px;" width="200" class="pageboxtext" align="left" valign="top"><b>Name:</b><br/>'.stripslashes($line->Name).'</td>';
							$CharactersString .= '<td width="400" valign="top" class="pageboxtext" align="left"><b>DESCRIPTION:</b><div style="padding-left:3px;padding-right:2px;height:58px;width:400px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Description).'</div></td>';
							$CharactersString .= '<td width="200" rowspan="2" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?charid='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?charid='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]&nbsp;</td>';
							
							
							   
							$CharactersString .= '</tr>';	
							$CharactersString .= '</table>';
							
							$CharactersString .=' </div>';
							$CharactersString .='<b class="'.$BoxType.'">';
							$CharactersString .='<b class="'.$BoxType.'5"></b>';
							$CharactersString .=' <b class="'.$BoxType.'4"></b>';
							$CharactersString .='<b class="'.$BoxType.'3"></b>';
							$CharactersString .='<b class="'.$BoxType.'2"><b></b></b>';
							$CharactersString .='<b class="'.$BoxType.'1"><b></b></b></b>';
							$CharactersString .='</div><div class="spacer"></div>';
										
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
					$query = "SELECT * from characters where ComicID ='$ComicID' and EncryptID='".$_GET['charid']."'";	
				else
					$query = "SELECT * from characters where StoryID ='$StoryID' and EncryptID='".$_GET['charid']."'";	
					
				$CharArray = $comicsDB->queryUniqueObject($query);
				 	$output .= $query.'<br/>';
	} else if ($_POST['a'] == 'delete') {
				if ($ContentType != 'story')
					$query = "DELETE from characters where ComicID ='$ComicID' and EncryptID='".$_POST['txtItem']."'";	
				else
					$query = "DELETE from characters where StoryID ='$StoryID' and EncryptID='".$_POST['txtItem']."'";	
					$comicsDB->execute($query);
					$Action = 'delete';
					$CharID =$_POST['txtItem'];
					$output .= $query.'<br/>';
	} else if ($_GET['a'] == 'save') {

		$query = "UPDATE characters SET Name='$Name', Hometown='$Hometown', Race='$Race', Age='$Age', HeightFt='$HeightFt', HeightIn='$HeightIn', Weight='$Weight',Abilities='$Abilities',Description='$Description',Notes='$Notes' WHERE EncryptID='$CharID'";
		$comicsDB->execute($query);		
		$output .= $query.'<br/>';
	}			
			
	if (($Action == 'save') || ($Action == 'finish')|| ($Action == 'delete')) {
			
				$ConnectKey = createKey();
				$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
				$comicsDB->query($query);
								
				$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID,'s' => $Section,'p' => $CharID, 'a'=>$Action, 'k' => $ConnectKey,'t'=>$ContentType,'f' => $FileSet,);
				$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_characters.php", $post_data);
				unset($post_data);
				$output .= 'UPDATE RESULT = ' . $updateresult.'<br/>';
				
				if (in_array($_SESSION['userid'],$SiteAdmins)) {
					print 'FULL OUTPUT = <br><br>'.$output; 
				
				} else {
				
					if ($ContentType != 'story') 
						header("location:/cms/edit/".$SafeFolder."/?section=characters");
					else
						header("location:/story/edit/".$SafeFolder."/?section=characters");
				}
				
	}

}
?>