<? 
if (($_GET['section'] == 'ads') && ($IsPro == 1)) {
if ($ContentType != 'story')
	$query = "SELECT Template from comic_settings where ComicID ='$ComicID'";
else
	$query = "SELECT Template from story_settings where StoryID ='$StoryID'";
	$Template = $comicsDB->queryUniqueValue($query);
	if (!isset($_GET['a'])) {
		if ($ContentType != 'story')
		$query = "SELECT * from adspaces where ComicID='$ComicID' and Template='$Template' and Active=1 order by Position";
		else
		$query = "SELECT * from adspaces where StoryID='$StoryID' and Template='$Template' and Active=1 order by Position";
		$comicsDB->query($query);
		//print $query;
		$PositionOne = 0;
		$PositionTwo = 0;
		$PositionThree = 0;
		$PositionFour = 0;
		$PositionFive = 0;
		 while ($line = $comicsDB->fetchNextObject()) {  
	 			switch ($line->Position) {
   		 				case 1:
        					$PositionOne = 1;
							$PositionOnePublished = $line->Published;
       		 				break;
						case 2:
        					$PositionTwo = 1;
							$PositionTwoPublished = $line->Published;
       		 				break;
    					case 3:
        					$PositionThree = 1;
							$PositionThreePublished = $line->Published;
        					break;
						case 4:
        					$PositionFour = 1;
							$PositionFourPublished = $line->Published;
        					break;
						case 5:
        					$PositionFive = 1;
							$PositionFivePublished = $line->Published;
        					break;
				}
		
	 	}
	 
   	} else {
		$Position= $_GET['p'];
		if ($ContentType != 'story')
		$query = "SELECT * from adspaces where ComicID='$ComicID' and Template='$Template' and Position='$Position'";
		else
		$query = "SELECT * from adspaces where StoryID='$StoryID' and Template='$Template' and Position='$Position'";

		$AdSpaceArray =  $comicsDB->queryUniqueObject($query);
		$AdCode = stripslashes($AdSpaceArray->AdCode);
		$SpacePublished = $AdSpaceArray->Published;
	}
}
?>