<?php 
$UpdateXml = 0;
$CurrentDate= date('D M j'); 
$ControlXML = "<pages>";
$CalXML = "<pages>";
$CurrentDay = date('d');
$CurrentMonth = date('m');
$CurrentYear = date('Y');

if ($PageID == ''){
	for ($z=$counter-1; $z>= 0; $z--){
		$Date = $story_array[$z]->datelive;
		$Active = $story_array[$z]->active;
		$PageDay = substr($Date, 3, 2); 
		$PageMonth = substr($Date, 0, 2); 
		$PageYear = substr($Date, 6, 4);
 			if ($PageYear<$CurrentYear) {
				  $PageID = $story_array[$z]->id;
 				  $AuthorComment = $story_array[$z]->comment;
				  $Image = $story_array[$z]->image;
				  $Title = $story_array[$z]->title;
				  $ImageHeight = $story_array[$z]->imgheight;
				  list($Width, $Height) = split('[x]', $ImageHeight);	
				 $CurrentPageDay = $PageDay;
				$CurrentPageMonth = $PageMonth;
				$CurrentPageYear = $PageYear;	
 				  $CurrentIndex = $z;
				  if ($z != ($counter-1)) {
				  		$NextPage = $story_array[$z+1]->id;
						$PrevPageImage = $story_array[$z+1]->image;
				  } else {
				  		$NextPage = $PageID;
						$PrevPageImage = $story_array[$z]->image;
				  }
				    if ($z > 0) {
				     $PrevPage = $story_array[$z-1]->id;
					 $PrevPageImage = $story_array[$z-1]->image;
				    } else { 
					$PrevPage = $PageID;
					}
			
				  break;
			 } else if ($PageYear == $CurrentYear) {
				if ($PageMonth<$CurrentMonth) {
					$PageID = $story_array[$z]->id;
 				 	$AuthorComment = $story_array[$z]->comment;
				 	$Image = $story_array[$z]->image;
				  	$Title = $story_array[$z]->title;
					$ImageHeight = $story_array[$z]->imgheight;	
					list($Width, $Height) = split('[x]', $ImageHeight);
					$CurrentPageDay = $PageDay;
				$CurrentPageMonth = $PageMonth;
				$CurrentPageYear = $PageYear;
 				  	$CurrentIndex = $z;
					 if ($z != ($counter-1)) {
				  		$NextPage = $story_array[$z+1]->id;
						$NextPageImage = $story_array[$z+1]->image;
				  } else {
				  		$NextPage = $PageID;
						$NextPageImage = $story_array[$z]->image;
				  }
			      	    if ($z > 0) {
				   		 $PrevPage = $story_array[$z-1]->id;
						  $PrevPageImage = $story_array[$z-1]->image;
				    	} else { 
						$PrevPage = $PageID;
						}
			
				  	break;
				} else if ($PageMonth == $CurrentMonth) {
					if ($PageDay<=$CurrentDay) {
						$PageID = $story_array[$z]->id;
 				 	    $AuthorComment = $story_array[$z]->comment;
				 	    $Image = $story_array[$z]->image;
				  	    $Title = $story_array[$z]->title;
						$ImageHeight = $story_array[$z]->imgheight;
						list($Width, $Height) = split('[x]', $ImageHeight);	
						$CurrentPageDay = $PageDay;
						$CurrentPageMonth = $PageMonth;
						$CurrentPageYear = $PageYear;
 				  	    $CurrentIndex = $z;
						 if ($z != ($counter-1)) {
				  		$NextPage = $story_array[$z+1]->id;
						$NextPageImage = $story_array[$z+1]->image;
				  } else {
				  		$NextPage = $PageID;
						$NextPageImage = $story_array[$z]->image;
				  }
				        if ($z > 0) {
				   		 $PrevPage = $story_array[$z-1]->id;
						 $PrevPageImage = $story_array[$z-1]->image;
				    	} else { 
						$PrevPage = $PageID;
						}
				  	    
				  	    break;
			        } 
				}
			}
 	}  // end for
}else {
 for ($z=0; $z < $counter; $z++){
 		$Pagetest = $story_array[$z]->id;
 			if ($PageID == $Pagetest){
 			$AuthorComment = $story_array[$z]->comment;
			$Image = $story_array[$z]->image;
			$Title = $story_array[$z]->title;
			$ImageHeight = $story_array[$z]->imgheight;	
			list($Width, $Height) = split('[x]', $ImageHeight);
			$Date = $story_array[$z]->datelive;	
			$PageDay = substr($Date, 3, 2); 
			$PageMonth = substr($Date, 0, 2); 
			$PageYear = substr($Date, 6, 4);
			$CurrentPageDay = $PageDay;
			$CurrentPageMonth = $PageMonth;
			$CurrentPageYear = $PageYear;	
 			$CurrentIndex = $z;
			if ($z == ($counter - 1)){ 
			$NextPage = $PageID;
			$NextPageImage = $story_array[$z]->image;
			} else if ($story_array[$z+1]->active == '1'){
			$NextPage = $story_array[$z+1]->id;
			$NextPageImage = $story_array[$z+1]->image;
			} else {
			$NextPage = $PageID;
			}
			if ($z > 0) {
			$PrevPage = $story_array[$z-1]->id;
			$PrevPageImage = $story_array[$z-1]->image;
			} else { 
			$PrevPage = $PageID;
			$PrevPageImage = $story_array[$z]->image;
			}
 			break;
			}
 }
}
$ChapterCount = 1;
$ChapterPageCount = 1;
$PageCount = 1;
$Inchapter = 0;
$EpisodeCount = 0;
$ChapterString = '<table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td valign="top">';
$boxString = '<form id="jumpbox" action="#" method="get">ARCHIVES<br/>
<select id="dropdown" style="width:100%;" name="url" onchange="window.location = this.options[this.selectedIndex].value; ">';

$TotalPages = 0;

for ($k=0; $k< $counter; $k++){
$idSafe = 0; 
 	$TestDate = $story_array[$k]->datelive;
	$Thumb = $story_array[$k]->thumb;
	$Active = $story_array[$k]->active;
	$SafeID = $story_array[$k]->id;
	$PageDay = substr($TestDate, 3, 2); 
	$PageMonth = substr($TestDate, 0, 2); 
	$PageYear = substr($TestDate, 6, 4);
		if ($PageYear<$CurrentYear) {
			$idSafe = 1; 
			$TotalPages++;
			if ($k == 0) {
				$firstpage = $story_array[$k]->id;
				$FirstPageImage = $story_array[$k]->image;
			} else {
				$lastpage = $story_array[$k]->id;
				$LastPageImage = $story_array[$k]->image;
			}
			$ControlXML .= "<page><id>".$SafeID."</id></page>";
			$CalXML .= "<page><id>".$SafeID."</id><datelive>".$TestDate."</datelive></page>";
			include 'string_builder.php';
		   } else if ($PageYear == $CurrentYear) {
						if ($PageMonth<$CurrentMonth) {
					
							$idSafe = 1; 
							 $TotalPages++;
							 if ($k == 0) {
				$firstpage = $story_array[$k]->id;
				$FirstPageImage = $story_array[$k]->image;
			} else {
				$lastpage = $story_array[$k]->id;
				$LastPageImage = $story_array[$k]->image;
			}
							 $ControlXML .= "<page><id>".$SafeID."</id></page>";
							 $CalXML .= "<page><id>".$SafeID."</id><datelive>".$TestDate."</datelive></page>";
				include 'string_builder.php';
							 
			} else if ($PageMonth == $CurrentMonth) {
								    if ($PageDay<=$CurrentDay) {
								
									     $idSafe = 1; 
										 if ($k == 0) {
											$firstpage = $story_array[$k]->id;
											$FirstPageImage = $story_array[$k]->image;
										} else {
											$lastpage = $story_array[$k]->id;
											$LastPageImage = $story_array[$k]->image;
										}
									     $TotalPages++;
										 $ControlXML .= "<page><id>".$SafeID."</id></page>";
										 $CalXML .= "<page><id>".$SafeID."</id><datelive>".$TestDate."</datelive></page>";
				include 'string_builder.php';
													  	
			        				  } // End If
						          } // End PageMonth
			  } // end TEST
		    	
} // end for

$ControlXML .= "</pages>";
$CalXML .= "</pages>";
$boxString .= '</select><input type="hidden" name="url" value="index.php?id=" /> </form>';
$ChapterString .="</td></tr></table>";


@list($Width,$Height)=getimagesize("images/pages/".$Image);


if ($Width == "") {
$Width = 850;
}
if ($Height == "") {
$Height = 675;
}
if ($Width < 550) {
$Width = 550;
}

if ($Width > 1024) {
$Width = 1024;
}
$AuthorComment = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $AuthorComment);
$db = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comic_pages where ParentPage = '$PageID' and ComicID = '$ComicID' order by PageType";
$db->query($query);
$NumExtraPages = $db->numRows();
$PeelPageTypeArray = array();
$PeelPageImageArray = array();
while ($peelpage = $pagesdb->fetchNextObject()) { 
		$PeelPageTypeArray[] = $peelpage->PageType;
		$PeelPageImageArray[] = $peelpage->PageType;
		$setting->Filename;
		
	}
$db->close();
?>