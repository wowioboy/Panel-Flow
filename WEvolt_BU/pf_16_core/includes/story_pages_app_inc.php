<? 
if (($Section =='pages') && (isset($_GET['a']))) {
$RunConnect = 0;
$TodayDate = date('Y-m-d').' 00:00:00';
if (($_GET['a'] == 'finish') || ($_GET['a'] == 'save')) {
	$Title = mysql_real_escape_string($_POST['txtTitle']);
	$PublishDate = substr($_POST['txtDatelive'],6,4).'-'.substr($_POST['txtDatelive'],0,2).'-'.substr($_POST['txtDatelive'],3,2).'-'.' 00:00:00';
	$Filename = $_POST['txtFilename'];
	if ($Filename == '') {
		$Filename= date('Y_m_d_h_m_s').".html";
		$TargetFile="stories/".$ComicDirectory."/images/pages/".$Filename;
	} else {
	$TargetFile = $Filename;
	}
	
	
	$Chapter = $_POST['txtChapter'];
	$Episode = $_POST['txtEpisode'];
	if ($Chapter == '')
		$Chapter = 0;
	if ($Episode == '')
		$Episode =0;
	
	$UserID = $_SESSION['userid'];
	$Action = $_GET['a'];
	$PageID = $_GET['pageid'];
	$HtmlContent = $_POST['content'];
	
	if (substr($HtmlContent,0,3) == '<p>') 
		$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);


	
	if ($Action == 'finish') {		
		$query ="SELECT Position from story_pages WHERE Position=(SELECT MAX(Position) FROM story_pages where StoryID='$StoryID')";
		print $query.'<br/>';
		$NewPosition = $comicsDB->queryUniqueValue($query);
		$NewPosition++;
		
		$query = "INSERT into story_pages (Title, StoryID, Filename, UploadedBy, PublishDate, Position, Chapter, Episode) values ('$Title',
			'$StoryID','$TargetFile','$UserID','$PublishDate','$NewPosition', '$Chapter', '$Episode')";
		$comicsDB->execute($query);
			print $query.'<br/>';
		$query ="SELECT ID from story_pages WHERE StoryID='$StoryID' and Filename='$TargetFile'";
			$ID = $comicsDB->queryUniqueValue($query);
			print $query.'<br/>';
			$PageID = substr(md5($ID), 0, 8).dechex($ID);
			$query = "UPDATE story_pages SET EncryptPageID='$PageID' WHERE ID='$ID'";
			$comicsDB->execute($query);
			print $query.'<br/>';
			if ($PublishDate <= $TodayDate){
				$query = "UPDATE stories SET PagesUpdated='$TodayDate' WHERE ID='$ID'";
				$comicsDB->execute($query);
			}
			$file = fopen ('../'.$TargetFile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod('../'.$TargetFile,0777);
			$RunConnect = 1;
			
		
	} else if ($Action == 'save') {
			
			$query ="SELECT PublishDate from story_pages where StoryID='$StoryID'";
			$CurrentPublish = $comicsDB->queryUniqueValue($query);
			
			if (($CurrentPublish != $PublishDate) && (($PublishDate <= $TodayDate) && ($CurrentPublish > $TodayDate))){
				$query = "UPDATE stories SET PagesUpdated='$TodayDate' WHERE ID='$ID'";
				$comicsDB->execute($query);
			}
						
			$query = "UPDATE story_pages set Title='$Title', PublishDate='$PublishDate',Chapter='$Chapter', Episode='$Episode' where EncryptPageID='$PageID' and StoryID='$StoryID'";
			print $query.'<br/>';
			$comicsDB->execute($query);
			
			$file = fopen ('../'.$TargetFile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod('../'.$TargetFile,0777);
			$RunConnect = 1;
		
		
	}
			///GRAB TEMPLATE INFORMATION
	
			//if ($_SESSION['userid'] != '9778d5d252') 
	
} else if ($_POST['delete'] == 1) {
	$PageID = $_POST['txtPage'];
	$query ="DELETE from story_pages where EncryptPageID='$PageID' and StoryID='$StoryID'";
	$comicsDB->execute($query);
	$RunConnect = 1;
	$Action = 'delete';
}


if ($RunConnect == 1) {
	$ConnectKey = createKey();
	$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
	$comicsDB->query($query);
	print $query.'<br/>';
	$post_data = array('u' => $_SESSION['userid'], 'c' => $StoryID, 'k' => $ConnectKey,'p'=>$PageID,'a'=>$Action);
	$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_story_page.php", $post_data);
			//if ($_SESSION['userid'] == '9778d5d252') 
	///////////////////////////////////////print 'UPDATE RESULT = ' . $updateresult;
	unset($post_data);
	header("location:/story/edit/".$SafeFolder."/?section=pages");
	}
}
?>