<? 
function checkcomictitle($ComicTitle) {
	global $InitDB;
	$Title = mysql_real_escape_string($ComicTitle);
	$query = "SELECT * FROM projects where LOWER(title)='".mysql_real_escape_string(trim(strtolower($ComicTitle)))."'";
	$InitDB->query($query);

	$Found = $InitDB->numRows();
	if ($Found == 0) {
		$ComicResult = 'Clear';
	} else {
		$ComicResult = 'Project Exists';
	}
	return $ComicResult;
}


function CreateComic($ComicTitle,$ComicUrl,$AdminUserID, $Genres, $Cover, $Thumb) {
	global $InitDB;
	
	 $Date = date('Y-m-d H:i:s'); 
	 $ID=$_SESSION['userid'];
	 $ComicTitle = str_replace("&","and",$ComicTitle);
	 $ComicTitle = str_replace('"','',$ComicTitle);
	 $ComicTitle = mysql_real_escape_string($ComicTitle);
     $query = "INSERT into comics (userid, title, genre, url, thumb, cover, createdate, CreatorID, Hosted) values ('$AdminUserID', '$ComicTitle','$Genres','$ComicUrl','$Thumb','$Cover', '$Date','$AdminUserID',1)";
	
	 $InitDB->query($query);
     $query = "SELECT comicid FROM comics WHERE title = '$ComicTitle' AND userid = '$ID'";
	 $ComicID = $InitDB->queryUniqueValue($query);
	 $Encryptid = substr(md5($ComicID), 0, 15).dechex($ComicID);
	 
	 //MAKE SURE ENCRYPTID doesn't EXIST
	 $ComicClear = 0;
	 $Inc = 5;
	 while ($ComicClear == 0) {
		$query = "SELECT count(*) from comics where comiccrypt='$Encryptid'";
		$Found = $InitDB->queryUniqueValue($query);
		if ($Found == 1) {
			$Encryptid = substr(md5(($ComicID+$Inc)), 0, 15).dechex($ComicID+$Inc);
			$Inc++;
		} else {
			 $query = "UPDATE comics SET comiccrypt='$Encryptid' WHERE comicid='$ComicID'";
			 $InitDB->execute($query);
			$ComicClear = 1;
		}
	}
	
	 
		return $Encryptid;
}

function checkstorytitle($ComicTitle) {
	global $InitDB;

	$Title = mysql_real_escape_string($ComicTitle);
	$query = "SELECT * FROM stories where title='".trim($Title)."'";
	$InitDB->query($query);
	
	$Found = $InitDB->numRows();
	if ($Found == 0) {
		$ComicResult = 'Clear';
	} else {
		$ComicResult = 'Story Exists';
	}
	return $ComicResult;
}


function CreateStory($ComicTitle,$ComicUrl,$AdminUserID, $Genres, $Cover, $Thumb) {
	global $InitDB;
	
	 $Date = date('Y-m-d H:i:s'); 
	 $ID=$_SESSION['userid'];
	 $ComicTitle = str_replace("&","and",$ComicTitle);
	 $ComicTitle = str_replace('"','',$ComicTitle);
	 $ComicTitle = mysql_real_escape_string($ComicTitle);
     $query = "INSERT into stories (userid, title, genre, url, thumb, cover, createdate, CreatorID, Hosted) values ('$AdminUserID', '$ComicTitle','$Genres','$ComicUrl','$Thumb','$Cover', '$Date','$AdminUserID',2)";
	
	 $InitDB->query($query);
     $query = "SELECT ID FROM stories WHERE title = '$ComicTitle' AND userid = '$ID'";
	 $StoryID = $InitDB->queryUniqueValue($query);
	
	 $Encryptid = substr(md5($StoryID), 0, 8).dechex($StoryID);
	 $query = "UPDATE stories SET StoryID='$Encryptid' WHERE ID='$StoryID'";
	 	
	 $InitDB->query($query);
	
		return $Encryptid;
}


?>