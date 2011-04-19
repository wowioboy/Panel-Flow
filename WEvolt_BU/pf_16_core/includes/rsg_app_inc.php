<? 

if ((!isset($_GET['entry']))&& ($Section =='rsg')) {
		if ($_POST['txtAction'] == 'new') {
		       $NOW = date('Y-m-d h:m:s');
			  $Title = mysql_real_escape_string($_POST['txtTitle']);
			  $EntryType = $_POST['txtEntryType'];
			  $LocationType = $_POST['txtLocationType'];
			  $ParentLocation = $_POST['txtParentLocation'];
			  
			  $query ="SELECT Position from pf_rg_entries WHERE Position=(SELECT MAX(Position) FROM pf_rg_entries where ComicID='$ComicID' and EntryType='$EntryType')";
			  $NewPosition = $pagedb->queryUniqueValue($query);
			  $NewPosition++;
			  
			  $query = 'INSERT into pf_rg_entries (ComicID, Title, EntryType, CreatedBy, IsActive, CreatedDate, Position';
			 
			  if ($EntryType == 'Location') 
			  	$query .=', IsLocation, ParentLocation';
			
			  $query .=") values ('$ComicID','$Title','$EntryType','$UserID',0,'$NOW',$NewPosition";
			  
			  if ($EntryType == 'Location') 
			  	$query .=", 1,'$ParentLocation'";
			  
			   $query .=")";
			   $comicsDB->execute($query);
			   
			   $query = "SELECT ID from pf_rg_entries where ComicID='$ComicID' and CreatedDate='$NOW'";
			   $NewID = $comicsDB->queryUniqueValue($query);
			
			   $Encryptid = substr(md5($NOW), 0, 8).dechex($NOW);
			   $query = "UPDATE pf_rg_entries set EncryptID='$Encryptid' where ID='$NewID'";
			   
			   $comicsDB->execute($query);
			header("location:/cms/edit/".$SafeFolder."/?section=rsg&a=edit&entry=".$Encryptid);
		} else {
			if (isset($_GET['type'])) {
				$EntryType = $_GET['type'];
				$query ="SELECT Position from pf_rg_entries WHERE Position=(SELECT MAX(Position) FROM pf_rg_entries where ComicID='$ComicID' and EntryType='$EntryType')";
				$MaxPosition = $comicsDB->queryUniqueValue($query);
				
				$query = "SELECT * from pf_rg_entries where ComicID ='$ComicID' and EntryType = '$EntryType' order by Position";
			
		//$comicsDB->query($query);
		    	$pagination->createPaging($query,$NumItemsPerPage);
				$TotalPages = $pagination->totalresult;
	   	 		$PageString = '';
	 
  //  $comicsDB->query($query);
				$Count = 1;
	   		 while($line=mysql_fetch_object($pagination->resultpage)) {
	  		$BoxType = 'page_box';
			$TypeImage = 'standard_type.jpg';
			$CurrentEntryType = $line->EntryType;
			$PageString .='<div>';
			$PageString .=' <b class="'.$BoxType.'">';
			$PageString .=' <b class="'.$BoxType.'1"><b></b></b>';
			$PageString .=' <b class="'.$BoxType.'2"><b></b></b>';
			$PageString .=' <b class="'.$BoxType.'3"></b>';
			$PageString .='	<b class="'.$BoxType.'4"></b>';
			$PageString .='	<b class="'.$BoxType.'5"></b></b>';
			$PageString .='<div class="'.$BoxType.'fg">';
     		$PageString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
		 	$PageString .= '<td width="110" style="padding-left:5px;"  align="left">'.stripslashes($line->Title).'</td>';
			$PageString .= '<td width="60" >'.$line->EntryType.'</td>';
			$PageString .= ' <td width="75"  style="padding-left:7px;" class="pageboxtext" align="left"></td>';
	  		$PageString .= '<td width="125"  class="pageboxtext" align="left"></td>';
			$PageString .= '<td width="200" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?entry='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?entry='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]';
	
			if (($line->Position != $MaxPosition) && (!isset($_GET['sub']))) {
				$PageString .= '<a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&entry='.$line->EncryptID.'&move=up';
				if (isset($_GET['page'])) 
					$PageString .= '&page='.$_GET['page'];
		
				$PageString .='"><img src="/'.$PFDIRECTORY.'/images/arrow_up.png" border="0"></a>';
			}
		
			if (($line->Position != 1)  && (!isset($_GET['sub']))) {
				$PageString .= '<a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&entry='.$line->EncryptID.'&move=down';
				if (isset($_GET['page'])) 
					$PageString .= '&page='.$_GET['page'];
		
				$PageString .= '"><img src="/'.$PFDIRECTORY.'/images/arrow_down.png" border="0"><a/></td>';
			}
		   
			$PageString .= '</tr>';	
			$PageString .= '</table>';
			
  			$PageString .=' </div>';
  			$PageString .='<b class="'.$BoxType.'">';
  			$PageString .='<b class="'.$BoxType.'5"></b>';
  			$PageString .=' <b class="'.$BoxType.'4"></b>';
  			$PageString .='<b class="'.$BoxType.'3"></b>';
  			$PageString .='<b class="'.$BoxType.'2"><b></b></b>';
  			$PageString .='<b class="'.$BoxType.'1"><b></b></b></b>';
			$PageString .='</div><div class="spacer"></div>';
			$Count++;
	 	} 
	} else {
		
		
	}
	}
	} else if ((isset($_GET['entry']))&& ($Section =='rsg')) {
		$EntryID = $_GET['entry'];
		if (!isset($_POST['action'])) {
				
				$query = "SELECT * from pf_rg_entries where EncryptID ='$EntryID'";
				$PageArray = $comicsDB->queryUniqueObject($query);
				$Title = $PageArray->Title;
				$Description = $PageArray->Description;
				$EntryType = $PageArray->EntryType;
				$IsTimeLineEvent = $PageArray->IsTimeLineEvent;
				$IsLocation = $PageArray->IsLocation;
				$LocCoordinates = $PageArray->LocCoordinates;
				$ParentLocation = $PageArray->ParentLocation;
				$MapID = $PageArray->MapID;
				$IsActive = $PageArray->IsActive;
				$IsPrivate = $PageArray->IsPrivate;	
				$Custom1 = $PageArray->Custom1;	
				$Custom2 = $PageArray->Custom2;	
				$Custom3 = $PageArray->Custom3;	
		
		} else {
			if ($_POST['action'] == 'save') {
				
				$Title = mysql_real_escape_string($_POST['txtTitle']);
				$Description = mysql_real_escape_string($_POST['txtDescription']);
				$EntryType = $_POST['txtEntryType'];
				if ($EntryType == 'location')
					$IsLocation = 1;
				else 
					$IsLocation = 0;
				$ParentLocation = $_POST['txtParentLocation'];
				$IsActive =$_POST['txtActive'];
				$IsPrivate = $_POST['txtPrivate'];
				$Filename = $_POST['txtFilename'];
				$EntryID = $_GET['entry'];
				$HTML = mysql_real_escape_string($_POST['pf_post']);
				
				if ($Filename != '') {
						if(!is_dir($CoreRoot."comics/".$ComicDirectory ."/images/rsg/images")) 
								mkdir($CoreRoot."comics/".$ComicDirectory ."/images/rsg/images", 0777);
							copy($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename,$CoreRoot.'comics/'.$ComicDirectory.'/images/rsg/images/'.$Filename);
							chmod($CoreRoot.'/comics/'.$ComicDirectory.'/images/rsg/images/'.$Filename,0777);
							$NewFilename = 'http://www.panelflow.com/comics/'.$ComicDirectory.'/images/rsg/images/'.$Filename;
							$query = "UPDATE pf_rg_entries SET Custom1='$NewFilename' WHERE EncryptID='$EntryID'";
							$comicsDB->execute($query);
							unlink($CoreRoot.$PFDIRECTORY.'/temp/'.$Filename);
				}
				
				$query = "UPDATE pf_rg_entries SET Title='$Title', Description='$Description', EntryType='$EntryType',ParentLocation='$ParentLocation', IsActive='$IsActive', IsPrivate='$IsPrivate',HTMLCode='$HTML' WHERE EncryptID='$EntryID'";
				$comicsDB->execute($query);
			
		}
		
	}
}


?>