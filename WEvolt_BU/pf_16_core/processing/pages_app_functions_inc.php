<? 
$SeriesNum = $_GET['series'];
if ($SeriesNum == '')
	$SeriesNum = 1;
$EpisodeNum = $_GET['ep'];
if ($EpisodeNum == '') {
	$query = "SELECT EpisodeNum from Episodes where ProjectID ='".$_SESSION['sessionproject']."'  and SeriesNum='$SeriesNum' order by EpisodeNum DESC";
	$EpisodeNum = $InitDB->queryUniqueValue($query);	
}

function move_pages_to_episode($Pages, $Episode) {
				global $InitDB;
				$SelectArray = explode('-',$Episode);
				$SeriesNum = $SelectArray[0];
				$EpisodeNum = $SelectArray[1];
				$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
				$NewEpPosition = $InitDB->queryUniqueValue($query);
				$Output .= $query.'<br/>';
				$NewEpPosition++;
				foreach ($Pages as $page) {
					  	$query = "UPDATE comic_pages set EpPosition='".$NewEpPosition."',EpisodeNum='$EpisodeNum', SeriesNum='$SeriesNum' where ComicID='".$_SESSION['sessionproject']."' and EncryptPageID='$page'";
						$InitDB->execute($query);
						$NewEpPosition++;
						$Output .= $query.'<br/>';
				}
				
				$query = "SELECT * from comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' order by SeriesNum, EpisodeNum, EpPosition";
				 $InitDB->query($query);
				 $ResetPos = 1;
				 $LastEpisode = 0 ;
				 $LastSeries = 0;
				 while ($line = $InitDB->fetchNextObject()) {
						 if ($line->SeriesNum != $LastSeries) {
							$LastEpisode = 0; 
							$LastSeries = $line->SeriesNum;
							$ResetPos = 1;
						 }
						 if ($line->EpisodeNum != $LastEpisode) {
							$EpisodeNum = $line->EpisodeNum; 
							$LastEpisode = $line->EpisodeNum;
							$EpPosition = 1;
						 }
						 $SPageID = $line->EncryptPageID;
						 $query = "update comic_pages set Position='$ResetPos', EpPosition='$EpPosition' where ComicID='".$_SESSION['sessionproject']."' and EpisodeNum='$EpisodeNum' and EncryptPageID='$SPageID'";
							$InitDB->execute($query);
							$Output .= $query .'<br/>';
							$ResetPos++;
							$EpPosition++;
				}
				//print $Output;
}
		
function move_down($ComicID, $PageID) {

	 global $InitDB, $Section,$EpisodeNum,$SeriesNum;
	
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
	$InitDB->query($query);
	while ($line = $InitDB->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptPageID;
		if ($line->EncryptPageID == $PageID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $InitDB->numRows();
	$query = "SELECT EpPosition from comic_pages where EncryptPageID='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' and PageType='pages'";
	$CurrentPosition = $InitDB->queryUniqueValue($query);
	if ($CurrentPosition != 1) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition-1];
		$CurrentOrder[$ArrayPosition-1] = $NewOrder;
		   for ( $counter =0; $counter < $TotalLinks; $counter++) {
		    $PageID = $CurrentOrder[$counter];
			$UpdatePosition = $counter + 1;
		   	$query = "UPDATE comic_pages set EpPosition='$UpdatePosition' where EncryptPageID='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
			$InitDB->query($query);
			
			}	
	 }
	 $query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='pages' and SeriesNum='$SeriesNum' order by SeriesNum, EpisodeNum, EpPosition";
	 $InitDB->query($query);
	 $ResetPos = 1;
	 while ($line = $InitDB->fetchNextObject()) {
		   $SPageID = $line->EncryptPageID;
			$query = "update comic_pages set Position='$ResetPos' where ComicID='$ComicID' and EncryptPageID='$SPageID' and SeriesNum='$SeriesNum'";
			$InitDB->execute($query);
			$ResetPos++;
	}
}


function process_series_thumb($OGFilename) {
				$ext = substr(strrchr($OGFilename, "."), 1);
				$randName = md5(rand() * time());
				//print 'File = ' .$OGFilename.'<br/>';
				$filePath = 'temp/' . $OGFilename;
				$Filename = $randName . '.' . $ext;
				$OG = $_SERVER['DOCUMENT_ROOT'].'/'.$filePath;
				$FinalPageImage = $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/images/pages/'.$Filename;
				$convertString = "convert $OG -resize 400 -quality 60  $FinalPageImage";
				//print 'convertString = ' .$convertString.'<br/>';
				@exec($convertString);
				
				@chmod($FinalPageImage, 0777);
				//@unlink($OG);	
				$SeriesThumb = 	'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/images/pages/'.$Filename;	
				//print 'SeriesThumb = ' .$SeriesThumb.'<br/>';
				return $SeriesThumb;
				
}


function move_up($ComicID, $PageID) {
global $InitDB, $Section,$EpisodeNum,$SeriesNum;
	$CurrentOrder = array();
	$i=0;
	$query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
	$InitDB->query($query);
	while ($line = $InitDB->fetchNextObject()) { 
		$CurrentOrder[] = $line->EncryptPageID;
		if ($line->EncryptPageID == $PageID) {
			$ArrayPosition = $i;
		}
		$i++;
	}
	$TotalLinks = $InitDB->numRows();
	$query = "SELECT EpPosition from comic_pages where EncryptPageID='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' and PageType='pages'";
	$CurrentPosition = $InitDB->queryUniqueValue($query);
	if ($CurrentPosition != $TotalLinks) {
		$NewPosition = $CurrentPosition--;
		$NewOrder = $CurrentOrder[$ArrayPosition];
		$CurrentOrder[$ArrayPosition] = $CurrentOrder[$ArrayPosition+1];
		$CurrentOrder[$ArrayPosition+1] = $NewOrder;
		   for ($counter =0; $counter < $TotalLinks; $counter++) {
		    	$PageID = $CurrentOrder[$counter];
				$UpdatePosition = $counter + 1;
		   		$query = "UPDATE comic_pages set EpPosition='$UpdatePosition' where EncryptPageID='$PageID' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' and PageType='pages'";
				$InitDB->query($query);
				
			}
	}
	
	 $query = "SELECT * from comic_pages where ComicID='$ComicID' and PageType='pages' and SeriesNum='$SeriesNum' order by SeriesNum, EpisodeNum, EpPosition";
	 $InitDB->query($query);
	 $ResetPos = 1;
	 while ($line = $InitDB->fetchNextObject()) {
		   $SPageID = $line->EncryptPageID;
			$query = "update comic_pages set Position='$ResetPos' where ComicID='$ComicID' and EncryptPageID='$SPageID' and SeriesNum='$SeriesNum'";
			$InitDB->execute($query);
			$ResetPos++;
	}

} 

$query ="SELECT p.userid, p.CreatorID, cs.Assistant1, cs.Assistant2, cs.Assistant3, cs.CreatorOne, cs. CreatorTwo, cs.CreatorThree
         from projects as p
		 join comic_settings as cs on cs.ComicID=p.ProjectID 
		 where p.ProjectID='".$_SESSION['sessionproject']."'";
	
$ProjectArray = $InitDB->queryUniqueObject($query);

if (
		($ProjectArray->userid == $_SESSION['userid']) || 
		($ProjectArray->CreatorID == $_SESSION['userid']) || 
		(($ProjectArray->Assistant1 == $_SESSION['userid'])||($ProjectArray->Assistant1 == trim($_SESSION['username']))) ||
		(($ProjectArray->Assistant2 == $_SESSION['userid'])||($ProjectArray->Assistant2 == trim($_SESSION['username']))) ||
		(($ProjectArray->Assistant3 == $_SESSION['userid'])||($ProjectArray->Assistant3 == trim($_SESSION['username']))) ||
		(($ProjectArray->CreatorOne == $_SESSION['userid'])||($ProjectArray->CreatorOne == trim($_SESSION['username']))) ||
		(($ProjectArray->CreatorTwo == $_SESSION['userid'])||($ProjectArray->CreatorTwo == trim($_SESSION['username']))) ||
		(($ProjectArray->CreatorThree == $_SESSION['userid'])||($ProjectArray->CreatorThree == trim($_SESSION['username'])))
	)
	$Auth = 1;
else
	$Auth = 0;
	
unset($ProjectArray);

if ($Auth == 1) {	

if (isset($_GET['move'])) {
	if ($_GET['move'] == 'up') {
		move_up($_SESSION['sessionproject'], $_GET['pageid']);
	} else if ($_GET['move'] == 'down') {
		move_down($_SESSION['sessionproject'], $_GET['pageid']);
	}
	$HeaderString = "/".$_SESSION['pfdirectory']."/section/pages_inc.php";
	if (isset($_GET['page'])) {
		$QueryString = "?page=".$_GET['page'];
	}
	if (isset($_GET['sub'])) {
		if ($QueryString == '')
			$QueryString = "?";
		else
			$QueryString .= "&";
		
		$QueryString .= "sub=".$_GET['sub'];
	}
	if (isset($_GET['c'])) {
		if ($QueryString == '')
			$QueryString = "?";
		else
			$QueryString .= "&";
		$QueryString .= "c=".$_GET['c'];
	}
	if ($QueryString == '')
			$QueryString = "?";
		else
			$QueryString .= "&";
			
	$QueryString .='ep='.$EpisodeNum.'&series='.$SeriesNum;
	header("location:".$HeaderString.$QueryString);
}

if (($_POST['txtAction'] == 'delete') && (isset($_POST['txtEpisode'])) && ($_POST['txtEpisode'] != 1)) {
	$PageAction = $_POST['txtPageAction'];
	//print_r($_POST);
	$Output .= 'PAGE ACTION ='.$PageAction.' <br/>' ;
	if ($PageAction == 'delete') {
		
		$query = "DELETE from comic_pages where ComicID='".$_SESSION['sessionproject']."' and SeriesNum='".$_GET['series']."' and EpisodeNum='".$_POST['txtEpisode']."'";
		$InitDB->execute($query);
		$Output .= $query.'<br/>';
	} else if ($PageAction == 'moveprev') {
				 
				$NewEPNum = (intval($_POST['txtEpisode']) - 1);
				$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$NewEPNum')";
				$NewEpPosition = $InitDB->queryUniqueValue($query);
				$NewEpPosition++;
				$Output .= $query.'<br/>';
				$query = "SELECT * from comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='".$_POST['txtEpisode']."'";
				$InitDB->query($query);
				$Output .= $query.'<br/>';
				$DB2 = new DB();
				while ($page = $InitDB->fetchNextObject()) {
					  	$query = "UPDATE comic_pages set EpPosition='".$NewEpPosition."',EpisodeNum='$NewEPNum' where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum'";
						$NewEpPosition++;
						$Output .= $query.'<br/>';
						$DB2->query($query);
					
				}
				$DB2->close();
				
	} else if ($PageAction == 'movenext') {
		
				$NewEPNum = (intval($_POST['txtEpisode']) + 1);
				$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$NewEPNum')";
				$NewEpPosition = $InitDB->queryUniqueValue($query);
				$Output .= $query.'<br/>';
				$query = "SELECT * from comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='".$_POST['txtEpisode']."'";
				$InitDB->query($query);
				$Output .= $query.'<br/>';
				$DB2 = new DB();
				while ($page = $InitDB->fetchNextObject()) {
					  	$query = "UPDATE comic_pages set EpPosition='".$NewEpPosition."',EpisodeNum='$NewEPNum' where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum'";
						$Output .= $query.'<br/>';
						$DB2->query($query);
					
				}
				$DB2->close();
	}
	$query = "DELETE from Episodes where ProjectID='".$_SESSION['sessionproject']."' and SeriesNum='".$_GET['series']."' and EpisodeNum='".$_POST['txtEpisode']."'";
	$InitDB->execute($query);
	$Output .= $query.'<br/>';
	
	$query = "SELECT e.*
			  from Episodes as e 
			  where e.EpisodeNum !='".$_POST['txtEpisode']."' and e.ProjectID='".$_SESSION['sessionproject']."' and e.SeriesNum='".$_GET['series']."'";
	$InitDB->query($query);
	$Output .= $query.'<br/>';
	$NewEPOrder = array();	
	$NewPos = 1;
	while ($episode = $InitDB->fetchNextObject()) {
				$NewEPOrder[] = array(
									'PrevNum'=>$episode->EpisodeNum,
									'NewNum'=>$NewPos
									);	
				$NewPos++;
	}
	//if ($_SESSION['username'] == 'matteblack')
	// print_r($NewEPOrder);
	foreach($NewEPOrder as $Episode) {
			$query = "UPDATE comic_pages set EpisodeNum='".$Episode['NewNum']."' 
					  where EpisodeNum='".$Episode['PrevNum']."' and SeriesNum='".$_GET['series']."' and ComicID='".$_SESSION['sessionproject']."'";
			$InitDB->execute($query);
			$Output .= $query.'<br/>';
			
			$query = "UPDATE Episodes set EpisodeNum='".$Episode['NewNum']."' 
					  where EpisodeNum='".$Episode['PrevNum']."' and SeriesNum='".$_GET['series']."' and ProjectID='".$_SESSION['sessionproject']."'";
			$InitDB->execute($query);
			$Output .= $query.'<br/>';
	} 
	$query = "SELECT * from comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' order by EpisodeNum, EpPosition";
    $InitDB->query($query);
	$Output .= $query.'<br/>';
	$ResetPos = 1;
	while ($line = $InitDB->fetchNextObject()) {
		   $SPageID = $line->EncryptPageID;
		   $query = "update comic_pages set Position='$ResetPos' where ComicID='".$_SESSION['sessionproject']."' and EncryptPageID='$SPageID' and SeriesNum='".$_GET['series']."'";
		   $InitDB->execute($query);
		   $Output .= $query.'<br/>';
		   $ResetPos++;
	}
	
	//if ($_SESSION['username'] == 'matteblack')
		//print $Output;
	//else
	header("location:/".$_SESSION['pfdirectory']."/section/pages_inc.php?series=".$_GET['series']);
}

if (!isset($_GET['pageid'])) {
	$pagination    =    new pagination();  
	
	$query = "SELECT * from Episodes where ProjectID ='".$_SESSION['sessionproject']."'  and SeriesNum='$SeriesNum' order by EpisodeNum ASC";
	$InitDB->query($query);
	
	$EpisodeSelect = '<select name="EpisodeSelect" onchange="switch_episode(\''.$SeriesNum.'\',this.options[this.selectedIndex].value);">';
	while ($line = $InitDB->fetchNextObject()) {
	//	print 'EPISODE = ' . $EpisodeNum.'<br/>';
		//print 'EPISODE = ' .$line->EpisodeNum.'<br/>';
			$EpisodeSelect .= '<option value="'.$line->EpisodeNum.'"';
			if ($EpisodeNum == $line->EpisodeNum)
				$EpisodeSelect .= ' selected ';
			$EpisodeSelect .='>'.$line->EpisodeNum.': '.$line->Title.'</option>';
	}
	$EpisodeSelect .= '</select>';
	$query = "SELECT * from series where ProjectID ='".$_SESSION['sessionproject']."'  order by SeriesNum ASC";
	$InitDB->query($query);
	$TotalSeries = $InitDB->numRows();
	if ($TotalSeries == 0) {
			$query = "INSERT into series (Title, SeriesNum,ProjectID) values ('".str_replace('_',' ',$_SESSION['safefolder'])."',1,'".$_SESSION['sessionproject']."')"; 
			$InitDB->execute($query);
			$query = "SELECT * from series where ProjectID ='".$_SESSION['sessionproject']."'  order by SeriesNum ASC";
			$InitDB->query($query);
	}
	$SeriesSelect = '<select name="SeriesSelect" onchange="switch_series(this.options[this.selectedIndex].value);" style="width:150px;">';
	while ($line = $InitDB->fetchNextObject()) {
			$SeriesSelect .= '<option value="'.$line->SeriesNum.'"';
			if ($SeriesNum == $line->SeriesNum)
				$SeriesSelect .= ' selected';
			$SeriesSelect .='>'.$line->Title.'</option>';
	}
	$SeriesSelect .= '</select>';
	
	if ($_GET['sub'] == 'series') {
		$query = "SELECT count(*) from series where ProjectID ='".$_SESSION['sessionproject']."'";
	$TotalPages = $InitDB->queryUniqueValue($query);
	
	} else if ($_GET['sub'] == 'episodes') {
		$query = "SELECT count(*) from Episodes where ProjectID ='".$_SESSION['sessionproject']."' and SeriesNum='$SeriesNum'";
	$TotalPages = $InitDB->queryUniqueValue($query);
	
	} else {
		$query = "SELECT count(*) from comic_pages where ComicID ='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
			$TotalPages = $InitDB->queryUniqueValue($query);
		
	}
	
	
	if ($_GET['sub'] != 'series') {
		$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
		$MaxPosition = $InitDB->queryUniqueValue($query);
		
	} 
		
		//print $query;
			if ($_GET['sub'] == 'chapters') {
				$query = "SELECT * from comic_pages where comicid ='".$_SESSION['sessionproject']."' and Chapter=1 and PageType ='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition DESC";
			} else if ($_GET['sub'] == 'episodes') {
			
				$query = "SELECT * from Episodes where ProjectID ='".$_SESSION['sessionproject']."'  and SeriesNum='$SeriesNum' order by EpisodeNum  DESC";
			}else if ($_GET['sub'] == 'series') {
			
				$query = "SELECT * from series where ProjectID ='".$_SESSION['sessionproject']."' order by SeriesNum  DESC";
			} else {
				$query = "SELECT * from comic_pages where comicid ='".$_SESSION['sessionproject']."' and PageType ='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition DESC";
			}	
			if ($NumItemsPerPage == 7)
				$NumItemsPerPage = 6;
			$pagination->createPaging($query,$NumItemsPerPage);
			$PageString = '';
	 
  //  $DB->query($query);
		$Count = 1;
		//if ($_SESSION['username'] == 'matteblack')
		//	print $query;
		$EpisodeString = '';
		$ChapterString = '';
		$PageString ='<div>';
	 while($line=mysql_fetch_object($pagination->resultpage)) {
  	 	 if (($line->Episode == 1)&& ($line->Chapter != 1)) {
	  		$BoxType = 'episode_box';
			$TypeImage = '';
	 	 } else if ($line->Chapter == 1){
	  		$BoxType = 'chapter_box';
			$TypeImage = 'chapter_type.jpg';
	 	 } else { 
	  		$BoxType = 'episode_box';
			$TypeImage = '';
	  	}
		$PageString .= '<table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="704" align="center">';
												
				$PageString .= '<table width="100%"><tr>';
				if ($_GET['sub'] != 'series')
		 $PageString .= '<td width="110"  style="padding-left:5px;" align="left"><img src="/'.$line->ThumbSm.'" style="border:2px solid #000000;" height="70"></td>';
		  if ($_GET['sub'] == 'episodes')
			$PageString .= ' <td width="250" valign="top" style="padding-left:3px;" class="grey_cmsboxcontent" align="left"><b>Episode #</b>'.$line->EpisodeNum.'<br/><b>Title:</b>'.stripslashes($line->Title).'<br/><b></td>';
		if ($_GET['sub'] == 'series')
			$PageString .= ' <td width="250" valign="top" style="padding-left:3px;" class="grey_cmsboxcontent" align="left"><b>Series #</b>'.$line->SeriesNum.'<br/><b>Title:</b>'.stripslashes($line->Title).'<br/><b></td>';
		if (($_GET['sub'] != 'episodes') &&($_GET['sub'] != 'series'))
			$PageString .= '<td width="300" valign="top" class="grey_cmsboxcontent" align="left">Page: '.$line->EpPosition.'<div class="spacer"></div><b>Title: </b>'.stripslashes($line->Title).'<div class="spacer"></div><b>Active Date:</b> '.$line->Datelive.'</td>';
		
		if (($_GET['sub'] != 'episodes') &&($_GET['sub'] != 'series')){
			
			$PageString .= '<td align="right"><table><tr><td>';
			
			if (($line->EpPosition != $MaxPosition) && (!isset($_GET['sub']))) {
				$PageString .= '<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?pageid='.$line->EncryptPageID.'&move=up&series='.$line->SeriesNum.'&ep='.$line->EpisodeNum;
				if (isset($_GET['page']))
					$PageString .= '&page='.$_GET['page'];
		
				$PageString .='"><img src="/'.$_SESSION['pfdirectory'].'/images/arrow_up.png" border="0"></a>';
			}
			
			if (($line->EpPosition != 1)  && (!isset($_GET['sub']))) {
				$PageString .= '<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?pageid='.$line->EncryptPageID.'&move=down&series='.$line->SeriesNum.'&ep='.$line->EpisodeNum;
				if (isset($_GET['page']))
					$PageString .= '&page='.$_GET['page'];
			
				$PageString .= '"><img src="/'.$_SESSION['pfdirectory'].'/images/arrow_down.png" border="0"><a/>';
			}
			$PageString .= '</td><td>';
			$PageString .= '<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?pageid='.$line->EncryptPageID.'&a=edit&series='.$line->SeriesNum.'&ep='.$line->EpisodeNum.'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?pageid='.$line->EncryptPageID.'&a=delete&series='.$line->SeriesNum.'&ep='.$line->EpisodeNum.'"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a></td><td>';
			
			$PageString .= '</tr></table></td>';
		} else {
			if ($_GET['sub'] == 'episodes') {
			$PageString .= '<td width="200" align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?episode='.$line->EpisodeNum.'&series='.$line->SeriesNum.'&a=edit&sub=episodes"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>';
			if ($line->EpisodeNum != 1) 
			$PageString .= '&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?episode='.$line->EpisodeNum.'&series='.$line->SeriesNum.'&a=delete&sub=episodes"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;&nbsp;';
			else
			$PageString .= '&nbsp; Edit Only';
			
			$PageString .='</td>';
			} else if ($_GET['sub'] == 'series') {
				$PageString .= '<td width="200" align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?series='.$line->SeriesNum.'&a=edit&sub=series"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>';
			if ($line->SeriesNum != 1) 
			$PageString .= '&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?series='.$line->SeriesNum.'&a=delete&sub=series"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;&nbsp;';
			else
			$PageString .= '&nbsp; Edit Only';
			
			$PageString .='</td>';
				
			}
		}
		   
		$PageString .= '</tr>';	
		$PageString .= '</table>';
		$idSafe = 0; 
 		$TestDate = $line->Datelive;
		$Today = date('Ymd');
		$PageDate = substr($TestDate, 6, 4). substr($TestDate, 0, 2).substr($TestDate, 3, 2);
		if ($PageDate<=$Today)
			$ActivePages++;
		  
  		$PageString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
		$Count++;
		if ($line->Episode == 1)
			$EpisodeString .= $PageString;
		else if ($line->Chapter == 1) 
			$ChapterString .= $PageString;
		
	}
	$PageString .= '</div>';


	} else if (isset($_GET['pageid'])) {
		$PageID = $_GET['pageid'];
		
		$query = "SELECT * from comic_pages where EncryptPageID ='$PageID' and PageType='pages'  and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum' order by EpPosition";
		$PageArray = $InitDB->queryUniqueObject($query);
		$Title = $PageArray->Title;
		$ThumbSm = $PageArray->ThumbSm;
		$ThumbLg = $PageArray->ThumbLg;
		$Chapter = $PageArray->Chapter;
		$Episode = $PageArray->Episode;
		$EpisodeNum = $PageArray->EpisodeNum;
		$SeriesNum = $PageArray->SeriesNum;
		$EpisodeDesc = stripslashes($PageArray->EpisodeDesc);
		$EpisodeWriter = stripslashes($PageArray->EpisodeWriter);
		$EpisodeArtist = stripslashes($PageArray->EpisodeArtist);
		$EpisodeColorist = stripslashes($PageArray->EpisodeColorist);
		$EpisodeLetterer = stripslashes($PageArray->EpisodeLetterer);
		$Position = $PageArray->EpPosition;
		$Comment = $PageArray->Comment;
		$ComicID = $PageArray->ComicID;
		$Datelive = $PageArray->Datelive;
		$query = "SELECT * from comic_pages where ParentPage ='$PageID' and PageType='pencils'  and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
		$PeelOneArray = $InitDB->queryUniqueObject($query);
		$query = "SELECT * from comic_pages where ParentPage ='$PageID' and PageType='inks'  and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
		$PeelTwoArray = $InitDB->queryUniqueObject($query);
		$query = "SELECT * from comic_pages where ParentPage ='$PageID' and PageType='colors'  and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
		$PeelThreeArray = $InitDB->queryUniqueObject($query);
		$query = "SELECT * from comic_pages where ParentPage ='$PageID' and PageType='script'  and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum'";
		$PeelFourArray = $InitDB->queryUniqueObject($query);
			$query = "SELECT EpPosition from comic_pages WHERE EpPosition=(SELECT MAX(EpPosition) FROM comic_pages where ComicID='".$_SESSION['sessionproject']."' and PageType='pages' and SeriesNum='$SeriesNum' and EpisodeNum='$EpisodeNum')";
		$MaxPosition = $InitDB->queryUniqueValue($query);
		$TestDate = $PageArray->Datelive;
		$Today = date('Ymd');
		$PageDate = substr($TestDate, 6, 4). substr($TestDate, 0, 2).substr($TestDate, 3, 2);
		$HTMLFile = $PageArray->HTMLFile;
		
	
		
		if ($HTMLFile != '') 
			$HtmlContent = @file_get_contents($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/images/pages/'.$HTMLFile);
		if ($PageDate<=$Today) {
			$AddedBefore = 1;
		} else {
			$AddedBefore = 0;
		}	
			$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='$PageID' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='story page'";
					$FlowArray = $InitDB->queryUniqueObject($query);
	}
	
	if (($_GET['a'] == 'new') || (isset($_GET['pageid']))) {
		$query = "SELECT * from Episodes where ProjectID ='".$_SESSION['sessionproject']."'  and SeriesNum='$SeriesNum' order by EpisodeNum DESC";
		$InitDB->query($query);
		$EpisodeSelect = '<select name="txtEpisode" onchange="toggleepisode(this.options[this.selectedIndex].value);">';
		while ($line = $InitDB->fetchNextObject()) {
	//	print 'EPISODE = ' . $EpisodeNum.'<br/>';
		//print 'EPISODE = ' .$line->EpisodeNum.'<br/>';
			$EpisodeSelect .= '<option value="'.$line->EpisodeNum.'"';
			if ($EpisodeNum == $line->EpisodeNum)
				$EpisodeSelect .= ' selected ';
			$EpisodeSelect .='>'.$line->EpisodeNum.': '.$line->Title.'</option>';
		}
		if (!isset($_GET['pageid'])) {
			$EpisodeSelect .= '<option value="">-------------</option>';
			$EpisodeSelect .= '<option value="new">Start New Episode</option>';
		}
		$EpisodeSelect .= '</select>';
		
	}
	if ((($_GET['a'] == 'delete') ||($_GET['a'] == 'edit'))&& ($_GET['sub'] == 'episodes')) {
		$query = "SELECT e.*, s.Title as SeriesTitle, 
				(select count(*) from comic_pages as cp where cp.EpisodeNum=e.EpisodeNum and cp.SeriesNum = e.SeriesNum and cp.ComicID=e.ProjectID) as TotalPages,
		        (select EpisodeNum from Episodes as e2 where e.SeriesNum = e2.SeriesNum and e2.ProjectID=e.ProjectID order by EpisodeNum ASC Limit 1) as FirstEpisode,
				(select EpisodeNum from Episodes as e3 where e.SeriesNum = e3.SeriesNum and e3.ProjectID=e.ProjectID order by EpisodeNum DESC Limit 1) as LastEpisode
		          from Episodes as e 
				  join series as s on e.SeriesNum=s.SeriesNum and s.ProjectID=e.ProjectID
				  where e.EpisodeNum ='".$_GET['episode']."' and e.ProjectID='".$_SESSION['sessionproject']."' and e.SeriesNum='".$_GET['series']."'";
		$PageArray = $InitDB->queryUniqueObject($query);
		
		
		$Title = $PageArray->Title;
		$ThumbSm = $PageArray->ThumbSm;
		$ThumbLg = $PageArray->ThumbLg;
		$Chapter = $PageArray->Chapter;
		$Episode = $PageArray->Episode;
		$EpisodeNum = $PageArray->EpisodeNum;
		$SeriesNum = $PageArray->SeriesNum;
		$SeriesTitle = $PageArray->SeriesTitle;
		$TotalPages = $PageArray->TotalPages;
		$FirstEpisode = $PageArray->FirstEpisode;
		$LastEpisode = $PageArray->LastEpisode;
		
		$EpisodeDesc = stripslashes($PageArray->EpisodeDesc);
		if ($EpisodeDesc == '')
			$EpisodeDesc = stripslashes($PageArray->Description);
		
		$EpisodeWriter = stripslashes($PageArray->EpisodeWriter);
		if ($EpisodeWriter == '')
			$EpisodeWriter = stripslashes($PageArray->Writer);
		
		$EpisodeArtist = stripslashes($PageArray->EpisodeArtist);
		if ($EpisodeArtist == '')
			$EpisodeArtist = stripslashes($PageArray->Artist);
		
		$EpisodeColorist = stripslashes($PageArray->EpisodeColorist);
		if ($EpisodeColorist == '')
			$EpisodeColorist = stripslashes($PageArray->Colorist);
		
		$EpisodeLetterer = stripslashes($PageArray->EpisodeLetterer);
		if ($EpisodeLetterer == '')
			$EpisodeLetterer = stripslashes($PageArray->Letterist);
		
		$Editor = stripslashes($PageArray->Editor);
		if ($Editor == '')
			$Editor = stripslashes($PageArray->Editor);
		
		$Publisher = stripslashes($PageArray->Publisher);
		if ($Publisher == '')
			$Publisher = stripslashes($PageArray->Publisher);
		
		
	} else if ((($_GET['a'] == 'delete') ||($_GET['a'] == 'edit'))&& ($_GET['sub'] == 'series')) {
		$query = "SELECT e.*, 
				(select count(*) from comic_pages as cp where cp.SeriesNum=e.SeriesNum and cp.ComicID=e.ProjectID) as TotalPages,
		        (select SeriesNum from series as e2 where e.SeriesNum = e2.SeriesNum order by SeriesNum ASC Limit 1) as FirstSeries,
				(select SeriesNum from series as e3 where e.SeriesNum = e3.SeriesNum order by SeriesNum DESC Limit 1) as LastSeries
		          from series as e 
				  
				  where e.SeriesNum ='".$_GET['series']."' and e.ProjectID='".$_SESSION['sessionproject']."'";
		$PageArray = $InitDB->queryUniqueObject($query);
	
		
	} else if ($_GET['a'] == 'move')  {
		if ($_POST['txtAction'] == 'move') {
				move_pages_to_episode($_POST['pageselect'],$_POST['toEpisode']);
				header("location:/".$_SESSION['pfdirectory']."/section/pages_inc.php");
			
		} else {
				$query = "SELECT * from Episodes where ProjectID='".$_SESSION['sessionproject']."' order by SeriesNum,EpisodeNum";
				$InitDB->query($query);
				$EpisodeSelect = '<select name="toEpisode">';
				while ($line = $InitDB->fetchNextObject()) {
					$EpisodeSelect .= '<option value="'.$line->SeriesNum.'-'.$line->EpisodeNum.'">Series '.$line->SeriesNum.' Episode -'.$line->Title.'</option>';
		
				}
				$EpisodeSelect .= '</select>';
		
				$query ="SELECT distinct s.Title as SeriesTitle, e.Title as EpisodeTitle, cp.* 
						   from comic_pages as cp
						   join series as s on (s.SeriesNum=cp.SeriesNum and s.ProjectID=cp.comicid)
						   join Episodes as e on (e.EpisodeNum=cp.EpisodeNum and cp.SeriesNum=e.SeriesNum and e.ProjectID=cp.comicid)
							where cp.comicid='".$_SESSION['sessionproject']."' and cp.PageType='pages' group by cp.EncryptPageID order by cp.SeriesNum,cp.EpisodeNum,cp.EpPosition";
				$InitDB->query($query);
			
				$PageSelect = '<select name="pageselect[]" id="pageselect[]" multiple="yes" count="10" style="width:100%">';
				$LastSeriesNum = 0;
				while ($page = $InitDB->fetchNextObject()) {
						if ($LastSeriesNum != $page->SeriesNum) {
							$LastSeriesNum =$page->SeriesNum;
							
							$LastEpisodeNum=0;	
							$PageSelect .= '<option value="" disabled="disabled" style="background-color:#e5e5e5;color:#000;">SERIES :'.$page->SeriesTitle.'</option>';
						}
							if ($LastEpisodeNum !=$page->EpisodeNum){
								$PageSelect .= '<option value=""  disabled="disabled">--EPISODE '.$page->EpisodeNum.' - '.$page->EpisodeTitle.'</option>';
								$LastEpisodeNum =$page->EpisodeNum;
							}
							$PageSelect .= '<option value="'.$page->EncryptPageID.'"';
							
							$PageSelect .= '>---->PAGE '.$page->EpPosition.' - '.$page->Title.'</option>';
				} 
				$PageSelect .= '</select>';
		}
		
	} else if ((($_GET['a'] == 'save') ||($_GET['a'] == 'finish')|| ($_POST['a'] == 'delete'))&& ($_GET['sub'] == 'series')) {
		if ($_POST['txtFilename'] != '') {
			$SeriesThumb = process_series_thumb($_POST['txtFilename']);	
		}
		if ($_GET['a'] == 'finish') {
			$query ="SELECT SeriesNum from series WHERE SeriesNum=(SELECT MAX(SeriesNum) FROM series where ProjectID='".$_SESSION['sessionproject']."')";
			$NewSeriesNum = $InitDB->queryUniqueValue($query);
			$NewSeriesNum++;
			$SeriesThumb = process_series_thumb($_POST['txtFilename']);
			$query = "INSERT into series (
								  ProjectID,
								  Title,
								  SeriesNum,
								  Synopsis,
								  Writer,
								  Artist,
								  Colorist,
								  Letterist,
								  Image,
								  AccessType) 
								  values (
								  '".$_SESSION['sessionproject']."',
								  '".mysql_real_escape_string($_POST['txtTitle'])."',
								  '$NewSeriesNum',
								  '".mysql_real_escape_string($_POST['txtDesc'])."',
								  '".mysql_real_escape_string($_POST['txtWriter'])."',
								  '".mysql_real_escape_string($_POST['txtArtist'])."',
								  '".mysql_real_escape_string($_POST['txtColorist'])."',
								  '".mysql_real_escape_string($_POST['txtLetterer'])."',
								  '".$SeriesThumb."',
								   '".mysql_real_escape_string($_POST['txtAccessType'])."')";
			$InitDB->query($query);
			//print $query;
		} else if ($_GET['a'] == 'save') {
			
			$query ="UPDATE series set 
								Title='".mysql_real_escape_string($_POST['txtTitle'])."',
								Synopsis='".mysql_real_escape_string($_POST['txtDesc'])."',
								Writer= '".mysql_real_escape_string($_POST['txtWriter'])."',
								Artist='".mysql_real_escape_string($_POST['txtArtist'])."',
								Colorist='".mysql_real_escape_string($_POST['txtColorist'])."',
								AccessType='".mysql_real_escape_string($_POST['txtAccessType'])."',
								Letterist='".mysql_real_escape_string($_POST['txtLetterer'])."'";
								
					if ($SeriesThumb != '')
						$query .= ",Image='$SeriesThumb'";
						
					$query .=" where ProjectID='".$_SESSION['sessionproject']."' and SeriesNum='".$_POST['txtSeries']."'";
					$InitDB->execute($query);
					
		}else if (($_POST['a'] == 'delete')&& ($_POST['dl'] == 1)) {
			
			$query ="DELETE from series where ProjectID='".$_SESSION['sessionproject']."' and SeriesNum='".$_POST['txtSeries']."'";
			$InitDB->execute($query);
			//print $query.'<br/>';
			
			$query ="DELETE from Episodes where ProjectID='".$_SESSION['sessionproject']."' and SeriesNum='".$_POST['txtSeries']."'";
			$InitDB->execute($query);
			//print $query.'<br/>';
			
			$query ="DELETE from comic_pages where comicid='".$_SESSION['sessionproject']."' and SeriesNum='".$_POST['txtSeries']."'";
			$InitDB->execute($query);
			//print $query.'<br/>';
					
		}
		$InitDB->close();
		header("location:/".$_SESSION['pfdirectory']."/section/pages_inc.php?sub=series");
		
	}
	
	
} else {
	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';
}
?>