<? 

if (($_GET['section'] == 'mobile')&& ($IsPro == 1)) {
$ComicXML = '';
$query = "SELECT * from mobile_content where ComicID ='$ComicID'";
$comicsDB->query($query);
   	$ComicXML ='<mobile>';
	  while ($line = $comicsDB->fetchNextObject()) {  
	  	$ComicXML .= '<content>';
	  	$ComicXML .= '<title>'.addslashes($line->Title).'</title>';
		$ComicXML .= '<image>'.addslashes($line->Image).'</image>';
		$ComicXML .= '<thumb>'.addslashes($line->Thumb).'</thumb>';
		$ComicXML .= '<filename>'.addslashes($line->Filename).'</filename>';
		$ComicXML .= '<type>'.addslashes($line->Type).'</type>';
		$ComicXML .= '<id>'.addslashes($line->EncryptID).'</id>';
		$ComicXML .= '</content>';
	}
	$ComicXML .='</mobile>';
}

if (($Section =='rsg') && ($IsPro == 1)) {
		$query = "SELECT * from pf_rg_entries where ComicID ='$ComicID'";
		$comicsDB->query($query);
		$TotalPages = $comicsDB->numRows();
		$query = "SELECT Position from comic_pages WHERE Position=(SELECT MAX(Position) FROM comic_pages where ComicID='$ComicID' and PageType='$Section')";
		$MaxPosition = $comicsDB->queryUniqueValue($query);
			if ($_GET['sub'] == 'chapters') {
			$query = "SELECT * from comic_pages where comicid ='$ComicID' and Chapter=1 and PageType ='pages' order by position DESC";
			} else if ($_GET['sub'] == 'episodes') {
			
			$query = "SELECT * from comic_pages where comicid ='$ComicID' and Episode=1 and PageType ='pages' order by position DESC";
			} else {
			$query = "SELECT * from comic_pages where comicid ='$ComicID' and PageType ='$Section' order by position DESC";
			}	
	$pagination->createPaging($query,$NumItemsPerPage);
	$PageString = '';
	 
  //  $comicsDB->query($query);
		$Count = 1;
		$EpisodeString = '';
		$ChapterString = '';
	 while($line=mysql_fetch_object($pagination->resultpage)) {
  	 	 if ($line->Episode == 1) {
	  		$BoxType = 'episode_box';
			$TypeImage = 'episode_type.jpg';
	 	 } else if ($line->Chapter == 1){
	  		$BoxType = 'chapter_box';
			$TypeImage = 'chapter_type.jpg';
	 	 } else { 
	  		$BoxType = 'page_box';
			$TypeImage = 'standard_type.jpg';
	  	}
		$PageString .='<div>';
		$PageString .=' <b class="'.$BoxType.'">';
		$PageString .=' <b class="'.$BoxType.'1"><b></b></b>';
		$PageString .=' <b class="'.$BoxType.'2"><b></b></b>';
		$PageString .=' <b class="'.$BoxType.'3"></b>';
		$PageString .='	<b class="'.$BoxType.'4"></b>';
		$PageString .='	<b class="'.$BoxType.'5"></b></b>';
		$PageString .='<div class="'.$BoxType.'fg">';
     	$PageString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
		 $PageString .= '<td width="110" rowspan="2" style="padding-left:5px;"><img src="/'.$line->ThumbSm.'" style="border:2px solid #000000;"></td>';
		$PageString .= '<td width="14" rowspan="2" valign="top"><img src="/'.$PFDIRECTORY.'/images/'.$TypeImage.'"></td>';
		$PageString .= ' <td width="75" valign="top" style="padding-left:7px;" class="pageboxtext" align="left"><b>Page #</b>'.$line->Position.'</td>';
	  	$PageString .= '<td width="125" valign="top" class="pageboxtext" align="left"><b>Active Date:</b> '.$line->Datelive.'</td>';
		$PageString .= '<td width="250" rowspan="2" valign="top" class="pageboxtext" align="left"><b>AUTHOR COMMENT:</b><div style="padding-left:3px;padding-right:2px;height:58px;width:241px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Comment).'</div></td>';
		$PageString .= '<td width="200" rowspan="2" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?pageid='.$line->EncryptPageID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?pageid='.$line->EncryptPageID.'&section='.$Section.'&a=delete">DELETE</a>]&nbsp;[<a href="/cms/mobile/'.$SafeFolder.'/?id='.$ComicID.'&url='.$ComicFolder.'&file='.$line->Image.'&title='.urlencode($line->Title).'&action=add">MOBILE</a>]&nbsp;&nbsp';
		
		if (($line->Position != $MaxPosition) && (!isset($_GET['sub']))) {
			$PageString .= '<a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&pageid='.$line->EncryptPageID.'&move=up';
		if (isset($_GET['page'])) {
			$PageString .= '&page='.$_GET['page'];
		}
		$PageString .='"><img src="/'.$PFDIRECTORY.'/images/arrow_up.png" border="0"></a>';
		}
		
		if (($line->Position != 1)  && (!isset($_GET['sub']))) {
		$PageString .= '<a href="/cms/edit/'.$SafeFolder.'/?section='.$Section.'&pageid='.$line->EncryptPageID.'&move=down';
		if (isset($_GET['page'])) {
			$PageString .= '&page='.$_GET['page'];
		}
		$PageString .= '"><img src="/'.$PFDIRECTORY.'/images/arrow_down.png" border="0"><a/></td></tr>';
		}
		   
		$PageString .= '<tr><td colspan="2" style="padding-left:7px;" width="150" class="pageboxtext" align="left" valign="top"><b>Title:</b><br/>'.stripslashes($line->Title).'</td></tr>';	
		$PageString .= '</table>';
		$idSafe = 0; 
 		$TestDate = $line->Datelive;
		$Today = date('Ymd');
		$PageDate = substr($TestDate, 6, 4). substr($TestDate, 0, 2).substr($TestDate, 3, 2);
		if ($PageDate<=$Today) {
			$ActivePages++;
		} 	  
  		$PageString .=' </div>';
  		$PageString .='<b class="'.$BoxType.'">';
  		$PageString .='<b class="'.$BoxType.'5"></b>';
  		$PageString .=' <b class="'.$BoxType.'4"></b>';
  		$PageString .='<b class="'.$BoxType.'3"></b>';
  		$PageString .='<b class="'.$BoxType.'2"><b></b></b>';
  		$PageString .='<b class="'.$BoxType.'1"><b></b></b></b>';
		$PageString .='</div><div class="spacer"></div>';
		$Count++;
		if ($line->Episode == 1) {
			$EpisodeString .= $PageString;
		} else if ($line->Chapter == 1) {
			$ChapterString .= $PageString;
		}
	}
}


?>