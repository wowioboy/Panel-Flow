<? 


$query = "SELECT * from creators where ComicID ='$ComicID'";
$InitDB->query($query);

	  while ($line = $InitDB->fetchNextObject()) { 
	  $Location = $line->location;
		$Website = $line->website;
		$Creator = stripslashes($line->realname);
		$Title = 'Creator';
		$Link1 = $line->link1;
		$Link2 = $line->link2;
		$Link3 = $line->link3;
		$Link4 = $line->link4;
		$About = str_replace(chr(13), '\n', $line->about);
		$About = str_replace(chr(10), '\n', $About);
		$Music = str_replace(chr(13), '\n', $line->music);
		$Music = str_replace(chr(10), '\n', $Music);
		$Books = str_replace(chr(13), '\n', $line->books);
		$Books = str_replace(chr(10), '\n', $Books);
		$Influences = str_replace(chr(13), '\n', $line->influences);
		$CreatorInfluence = str_replace(chr(10), '\n', $Influences);
		$Other = str_replace(chr(13), '\n', $line->credits);
		$OtherCredits = str_replace(chr(10), '\n', $Other);
		$Hobbies = str_replace(chr(13), '\n', $line->hobbies);
		$Hobbies = str_replace(chr(10), '\n', $Hobbies);
		$CreatorAvatar = $line->avatar;
		
	    $MainCreator = array(
					   "Location" => $Location,
					   "Website"  => $Website,
					   "Creator" => $Creator,
					   "Title" => $Creator,
					   "Link1" => $Link1,
					   "Link2" => $Link2,
					   "Link3" => $Link3,
					   "Link4" => $Link4,
					   "About" => $About,
					   "Books" => $Books,
					   "Music" => $Music,
					   "CreatorInfluence" => $CreatorInfluence,
					   "OtherCredits" => $OtherCredits,
					   "Avatar" => $CreatorAvatar,
					   "Hobbies" => $Hobbies); 
	}
	
	
	$query = "SELECT CreatorOne, CreatorTwo, CreatorThree from comic_settings where ComicID ='$ComicID'";
	$CreatorListArray = $InitDB->queryUniqueObject($query);
	$CreatorCount = 0;
	 foreach ($CreatorListArray as $Creator) {
	// print_r($CreatorListArray);
	  		$profileresult = file_get_contents ('https://www.panelflow.com/processing/getprofile.php?email='.$Creator);
			
			$values = unserialize ($profileresult);

			$Name = $values['username'];
			$RealName = $values['realname'];
			$Influences = $values['influences'];
			$Bio = $values['about'];
			$Location = $values['location'];
			$Hobbies = $values['hobbies'];
			$Website = $values['website'];
			$Link1 = $values['link1'];
			$Link2 = $values['link2'];
			$Link3 = $values['link3'];
			$Link4 = $values['link4'];
			$Music = $values['music'];
			$Credits = $values['credits'];
			$Books = $values['books'];
			$CAvatar = $values['avatar'];
			if ($values['username'] != '')
				$CreatorCount++;
			if (($CreatorCount == 1) && ($Name != '')) {
			
			$CreatorArray1 = array(
					   "Location" => $Location,
					   "Website"  => $Website,
					   "Creator" => $RealName,
					   "Title" => $Name,
					   "Link1" => $Link1,
					   "Link2" => $Link2,
					   "Link3" => $Link3,
					   "Link4" => $Link4,
					   "About" => $Bio,
					   "Books" => $Books,
					   "Music" => $Music,
					   "CreatorInfluence" => $Influences,
					   "OtherCredits" => $Credits,
					   "Avatar" => $CAvatar,
					   "Hobbies" => $Hobbies); 
			
			}
			if (($CreatorCount == 2) && ($Name != '')) {
			$CreatorArray2 = array(
					   "Location" => $Location,
					   "Website"  => $Website,
					   "Creator" => $RealName,
					   "Title" => $Name,
					   "Link1" => $Link1,
					   "Link2" => $Link2,
					   "Link3" => $Link3,
					   "Link4" => $Link4,
					   "About" => $Bio,
					   "Books" => $Books,
					   "Music" => $Music,
					   "CreatorInfluence" => $Influences,
					   "OtherCredits" => $Credits,
					   "Avatar" => $CAvatar,
					   "Hobbies" => $Hobbies); 
			
			
			}
			if (($CreatorCount == 3)  && ($Name != '')) {
			$CreatorArray3 = array(
					   "Location" => $Location,
					   "Website"  => $Website,
					   "Creator" => $RealName,
					   "Title" => $Name,
					   "Link1" => $Link1,
					   "Link2" => $Link2,
					   "Link3" => $Link3,
					   "Link4" => $Link4,
					   "About" => $Bio,
					   "Books" => $Books,
					   "Music" => $Music,
					   "CreatorInfluence" => $Influences,
					   "OtherCredits" => $Credits,
					   "Avatar" => $CAvatar,
					   "Hobbies" => $Hobbies); 
			
			}
			  
	  }
	  
	  $CreatorSelectTable = '';
	  if ($CreatorCount > 0) {
		$CreatorSelectTable .= '<div align="left"><table cellpadding="0" cellspacing="0" border="0">'. 
							'<tr>';
	
		$CreatorSelectTable .= '<td class="tabactive" align="left" id=\'maintab\' '.
								'onMouseOver="rolloveractive(\'maintab\',\'maincreator_right\')" '.
								'onMouseOut="rolloverinactive(\'maintab\',\'maincreator_right\')"'.
								'onclick="switch_creators(\'main\');">'.$MainCreator['Creator'].'</td><td width="5"></td>';

	if (is_array($CreatorArray1)) {
		$CreatorSelectTable .= '<td class="tabinactive" align="left" id=\'onetab\' '.
								'onMouseOver="rolloveractive(\'onetab\',\'creatorone_right\')" '.
								'onMouseOut="rolloverinactive(\'onetab\',\'creatorone_right\')"'.
								'onclick="switch_creators(\'one\');">'.$CreatorArray1['Creator'].'</td><td width="5"></td>';
	}
	if (is_array($CreatorArray2)) {
		$CreatorSelectTable .= '<td class="tabinactive" align="left" id=\'twotab\' '.
								'onMouseOver="rolloveractive(\'twotab\',\'creatortwo_right\')" '.
								'onMouseOut="rolloverinactive(\'twotab\',\'creatortwo_right\')"'.
								'onclick="switch_creators(\'two\');">'.$CreatorArray2['Creator'].'</td><td width="5"></td>';
	}
	if (is_array($CreatorArray3)) {
		$CreatorSelectTable .= '<td class="tabinactive" align="left" id=\'threetab\' '.
								'onMouseOver="rolloveractive(\'threetab\',\'creatorthree_right\')" '.
								'onMouseOut="rolloverinactive(\'threetab\',\'creatorthree_right\')"'.
								'onclick="switch_creators(\'three\');">'.$CreatorArray3['Creator'].'</td><td width="5"></td>';
	}
	$CreatorSelectTable .= '</tr></table>';
	  
	}
	


?>