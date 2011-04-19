<? 
function ProcessPage($PageType,$PageID, $Filename,$Position,$DateLive, $Episode, $Chapter, $Title, $Comment,$Action, $Fileset) {
	
	global $Source_dir, $ComicFolder, $ComicID, $UserID,$Section,$KeepWidth,$GlobalSiteWidth,$Addedbefore,$db_database,$db_host, $db_user, $db_pass,$ApplicationLink;
	
	$pagedb = new DB($db_database,$db_host, $db_user, $db_pass);
	include_once('connect_functions.php');
	include_once('image_resizer.php');
	include_once('image_functions.php');
	$NewPageDate = substr($DateLive,6,4).'-'.substr($DateLive,0,2).'-'.substr($DateLive,3,2);
	$todays_date = date("Y-m-d"); 
	$Today = strtotime($todays_date); 
	$TestPageDate = strtotime($NewPageDate); 
							
	if ($TestPageDate <= $Today) {
			$AddPage = 1;
		} else {
			$AddPage = 0;
	}
	if ($Fileset == 'yes') {
		list($width,$height)=getimagesize($Source_dir.$Filename);
		$originalimage = $Source_dir.$Filename;
		
		$ext = substr(strrchr($Filename, "."), 1);
		$randName = md5(rand() * time());
		$filePath = $Source_dir . $randName . '.' . $ext;
		$Filename = $randName . '.' . $ext;
		$Finalimage = $filePath;
		$FinalPageImage = '../comics/'.$ComicFolder .'/images/pages/'.$Filename;
		$IphoneSmImage = '../comics/'.$ComicFolder .'/iphone/images/pages/320/'.$Filename;
		$IphoneLgImage = '../comics/'.$ComicFolder .'/iphone/images/pages/480/'.$Filename;
		if (($width > 1024) && ($KeepWidth == 0)){
			$convertString = "convert $originalimage -resize 1024 $Finalimage";
			exec($convertString);
			list($width,$height)=getimagesize($Finalimage);
		} else if (($KeepWidth == 1) && ($width > $GlobalSiteWidth)){
			$convertString = "convert $originalimage -resize $GlobalSiteWidth $Finalimage";
			exec($convertString);
			list($width,$height)=getimagesize($Finalimage);
		} else {
			copy($originalimage,$Finalimage);
			$ImageDimensions = $width.'x'.$height;
		}
		$ImageDimensions = $width.'x'.$height;
		copy($Finalimage,$FinalPageImage);
		$convertString = "convert $originalimage -resize 320 $IphoneSmImage";
		exec($convertString);
		$convertString = "convert $originalimage -resize 480 $IphoneLgImage";
		exec($convertString);
		$image = new imageResizer($Finalimage);
		$Thumbsm = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_sm.' . $ext;
		$Thumbmd = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName . '_md.' . $ext;
		$Thumblg = 'comics/'.$ComicFolder ."/images/pages/thumbs/".$randName .'_lg.' . $ext;
		$image->resize(110, 70, 110, 70);
		$image->save('../'.$Thumbsm, JPG);
		chmod('../'.$Thumbsm,0777);
		$image->resize(150, 200, 150, 200);
		$image->save('../'.$Thumbmd, JPG);
		chmod('../'.$Thumbmd,0777);
		$convertString = "convert $Finalimage -resize 480 -quality 60 ../$Thumblg";
		exec($convertString);
		chmod('../'.$Thumblg,0777);
		$FileSet = 'yes';
		$Date = date('Y-m-d H:i:s'); 
	}
	
	if (($PageType == 'pencils') || ($PageType == 'colors')|| ($PageType == 'inks')){
		$query = "SELECT * from comic_pages where ParentPage='$PageID' and PageType='$PageType'";
		$pagedb->query($query);
		$Action = 'add';
		$PageFound = $pagedb->numRows();
		if ($PageFound == 1) {
			$query = "UPDATE comic_pages set Image='$Filename',ImageDimensions='$ImageDimensions', ThumbSm='$Thumbsm',ThumbMd='$Thumbmd',ThumbLg='$Thumblg', Filename='$Filename' where ParentPage='$PageID' and PageType='$PageType'";
			$pagedb->execute($query);
		} else {
			$query = "INSERT into comic_pages(ComicID, Image, ImageDimensions,ThumbSm, ThumbMd, ThumbLg, Filename, UploadedBy, PageType, ParentPage) values ('$ComicID','$Filename','$ImageDimensions', '$Thumbsm','$Thumbmd','$Thumblg','$Filename','$UserID','$PageType','$PageID')";
			$pagedb->execute($query);
		}
	} else {
       if ($Action == 'add') {
				$query ="SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType')";
			$NewPosition = $pagedb->queryUniqueValue($query);
			$NewPosition++;
			
			$query = "INSERT into comic_pages(".
					 "ComicID, ". 
					 "Title, ".
					 "Comment, ".
					 "Image, ".
					 "ImageDimensions, ".
					 "Datelive, ".
					 "ThumbSm, ".
					 "ThumbMd, ".
					 "ThumbLg, ".
					 "Chapter, ".
					 "Episode, ".
					 "Filename, ".
					 "Position, ".
					 "UploadedBy, ".
					 "PageType)".
					 " values (".
					 "'$ComicID',".
					 "'$Title', ".
					 "'$Comment',".
					 "'$Filename',".
					 "'$ImageDimensions', ".
					 "'$DateLive',".
					 "'$Thumbsm',".
					 "'$Thumbmd',".
					 "'$Thumblg',".
					 "$Chapter,".
					 "$Episode, ".
					 "'$Filename', ".
					 "$NewPosition,".
					 "'$UserID',".
					 "'$PageType')";
			$pagedb->execute($query);
			print $query;
			if ($AddPage == 1) {
				$query ="SELECT pages from comics where comiccrypt='$ComicID'";
				$NumPages = $pagedb->queryUniqueValue($query);
				if (($NumPages == 0) ||($NumPages < 0)) {
					$NumPages = 1;
				} else {
					$NumPages++;
				}
				$Status = 'add';
				$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
				$pagedb->execute($query);
			}
			$query ="SELECT ID from comic_pages WHERE ComicID='$ComicID' and Position='$NewPosition'";
			$PageID = $pagedb->queryUniqueValue($query);
			$Encryptid = substr(md5($PageID), 0, 8).dechex($PageID);
			$query = "UPDATE comic_pages SET EncryptPageID='$Encryptid' WHERE ID='$PageID'";
			$pagedb->execute($query);
			$PageID = $Encryptid ;
	} else if ($Action == 'edit') {
			$query ="SELECT Datelive from comic_pages WHERE EncryptPageID='$PageID'";
			$CurrentPageDate = $pagedb->queryUniqueValue($query);
			$CurrentPageDate =  strtotime(substr($CurrentPageDate,6,4).'-'.substr($CurrentPageDate,0,2).'-'.substr(			$CurrentPageDate,3,2));
			if ($CurrentPageDate <= $Today) {
				$AddedBefore = 1;
			} else {
				$AddedBefore = 0;
			}
			if ($Fileset == 'yes') {
			$query = "UPDATE comic_pages set 
				          ThumbSm='$Thumbsm', 
						  ThumbMd='$Thumbmd', 
						  ThumbLg='$Thumblg', 
						  Filename='$Filename',
						  Image='$Filename',
						  ImageDimensions='$ImageDimensions' 
						  where EncryptPageID='$PageID'";
			$pagedb->execute($query);	
			} 
		$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='$PageType' order by position";
		$pagedb->query($query);
		$TotalLinks = $pagedb->numRows();
		$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType')";
		$MaxPosition = $pagedb->queryUniqueValue($query);
		$NewItemPosition = $Position;
		$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
		$CurrentPosition = $pagedb->queryUniqueValue($query);
		if ($NewItemPosition != $CurrentPosition) {
			$CurrentOrder = array();
			if ($NewItemPosition < $CurrentPosition) {
				$query = "SELECT EncryptPageID, Position from comic_pages where ComicID='$ComicID' and Position BETWEEN '$NewItemPosition' and '$CurrentPosition' order by Position";
			} else {
					$query = "SELECT EncryptPageID, Position from comic_pages where ComicID='$ComicID' and Position BETWEEN '$CurrentPosition' and '$NewItemPosition' order by Position";
			}
			$pagedb->query($query);

			while ($line = $pagedb->fetchNextObject()) { 
				 	$CurrentOrder[] = $line->EncryptPageID;
			}

			if ($NewItemPosition < $CurrentPosition) {
				if ($CurrentPosition != 1) {
					$UpdatePosition = $CurrentPosition;
					for ( $counter =(sizeof($CurrentOrder)-1); $counter > 0; $counter--) {
		   		 		$SelectItemID = $CurrentOrder[$counter-1];
		   				$query = "UPDATE comic_pages set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
						$UpdatePosition--;
						$pagedb->execute($query);
					
					}
				$query = "UPDATE comic_pages set Position='$NewItemPosition' where EncryptPageID='$PageID'";
				$pagedb->execute($query);
				}
	
			} else if ($NewItemPosition > $CurrentPosition) {
					$UpdatePosition = $CurrentPosition;
					if ($CurrentPosition != $TotalLinks) {
						for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 				$SelectItemID = $CurrentOrder[$counter+1];
		   					$query = "UPDATE comic_pages set Position='$UpdatePosition' where EncryptPageID ='$SelectItemID'";
							$UpdatePosition++; 
							$pagedb->query($query);
						}
					$query = "UPDATE comic_pages set Position='$NewItemPosition' where EncryptPageID='$PageID'";
					$pagedb->execute($query);
					}
			}
	  }
	  $query = "UPDATE comic_pages set Title='$Title', Comment='$Comment', Datelive='$DateLive', Chapter='$Chapter', Episode='$Episode' where EncryptPageID='$PageID'";
      $pagedb->query($query);
	  
	  if (($AddPage == 0) && ($AddedBefore == 1)) {
			$query ="SELECT pages from comics where ComicID='$ComicID'";
			$NumPages = $pagedb->queryUniqueValue($query);
			$NumPages--;
			$Status = 'remove';
			$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
			$pagedb->execute($query);	
	 } else if (($AddPage == 1) && ($AddedBefore == 0)) {
			$query ="SELECT pages from comics where comiccrypt='$ComicID'";
			$NumPages = $pagedb->queryUniqueValue($query);
			if (($NumPages == 0) ||($NumPages < 0))  {
				$NumPages = 1;
			} else {
				$NumPages++;
			}
			$Status = 'add';
			$query = "UPDATE comics SET pages='$NumPages',PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
			$pagedb->execute($query);			
	}

  }
}
if (($Action == 'delete') && (($PageType == 'pages') || ($PageType =='extras'))) { 
			$query ="SELECT Datelive from comic_pages WHERE EncryptPageID='$PageID'";
			$CurrentPageDate = $pagedb->queryUniqueValue($query);
			$CurrentPageDate =  strtotime(substr($CurrentPageDate,6,4).'-'.substr($CurrentPageDate,0,2).'-'.substr(		$CurrentPageDate,3,2));
			if ($CurrentPageDate <= $Today) {
				$AddedBefore = 1;
			} else {
				$AddedBefore = 0;
			}
		$query = "SELECT Position from comic_pages where EncryptPageID='$PageID'";
		$CurrentPosition = $pagedb->queryUniqueValue($query);
		$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$PageType')";
		$MaxPosition = $pagedb->queryUniqueValue($query);
		$query = "SELECT ID from comic_pages where ComicID='$ComicID' and PageType ='$PageType' order by Position";
		$pagedb->query($query);
		$TotalLinks = $pagedb->numRows();
		$CurrentOrder = array();
		$query = "SELECT ID, Position from comic_pages where ComicID='$ComicID' and PageType='$PageType' and Position BETWEEN '$CurrentPosition' and '$MaxPosition' order by Position";
		$pagedb->query($query);	
		while ($line = $pagedb->fetchNextObject()) { 
			$CurrentOrder[] = $line->ID;
		}
		$UpdatePosition = $CurrentPosition;
		for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
		   	 	$SelectItemID = $CurrentOrder[$counter+1];
				$query = "UPDATE comic_pages set Position='$UpdatePosition' where id ='$SelectItemID'";
				$UpdatePosition++; 
				$pagedb->execute($query);
		}
		$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and (EncryptPageID='$PageID' or ParentPage='$PageID')";
		$pagedb->execute($query);	
		if ($AddedBefore == 1) {
			$query ="SELECT pages from comics where comiccrypt='$ComicID'";
			$NumPages = $pagedb->queryUniqueValue($query);
			$NumPages--;
			$Status = 'remove';
			$query = "UPDATE comics SET pages='$NumPages', PagesUpdated='$Date' WHERE comiccrypt='$ComicID'";
			$pagedb->execute($query);	
		}
	
      $query ="DELETE from pagecomments WHERE comicid='$ComicID' and pageid='$PageID'";
	  $pagedb->execute($query);
	} else {
		$query ="DELETE from comic_pages WHERE ComicID='$ComicID' and ParentPage='$PageID' and PageType='$PageType'";
		$pagedb->execute($query);	
	}
	$pagedb->close();
echo 'MY CONNECT = ' .  sendPageConnect($Section, $PageID, $Action,$Fileset,$Status,$PageType);	
}?>