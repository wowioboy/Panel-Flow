<?  
$ComicID = $_GET['comicid'];
include_once("includes/init.php"); 
$query = "select * from comics where comiccrypt = '$ComicID'";
$GetPageDB = new DB($db_database,$db_host, $db_user, $db_pass);
$GetPageDB->query($query);
while ($setting = $GetPageDB->fetchNextObject()) { 
	$BarColor = $setting->ControlBg;
	$TextColor= $setting->TitleColor;
	$MovieColor= $setting->SiteBg;
	$ButtonColor= $setting->ButtonBg;
	$ArrowColor= $setting->ArrowBg;
	$ComicTitle = $setting->title;
	$Creator = $setting->creator;
	$Writer = $setting->writer;
	$Artist = $setting->artist;
	$Colorist = $setting->colorist;
	$Letterist = $setting->letterist;
	$Synopsis = $setting->synopsis;
	$Tags = $setting->tags;
	$Genre = $setting->genre;
	$Copyright = $setting->Copyright;
	$HeaderImage = $setting->Header;
	$ComicFolder = $setting->url;
}
$story_array = array();
$counter = 0;
$query = "select * from comic_pages where ComicID = '$ComicID' order by Position";
$GetPageDB->query($query);
while ($setting = $GetPageDB->fetchNextObject()) { 
	$story_array[$counter]->image = $setting->Image;
	$story_array[$counter]->id = $setting->EncryptPageID;
    $story_array[$counter]->comment = $setting->Comment;
	$story_array[$counter]->imgheight =$setting->ImageDimensions;
	$story_array[$counter]->title = $setting->Title;
	$story_array[$counter]->active = 1;
	$story_array[$counter]->datelive = $setting->Datelive;
	$story_array[$counter]->thumb = $setting->ThumbSm;
	$story_array[$counter]->chapter = $setting->Chapter;
    $story_array[$counter]->episode =  $setting->Episode;
    $story_array[$counter]->filename = $setting->Filename;
	$counter++;
}

$CurrentDate= date('D M j'); 
$CurrentDay = date('d');
$CurrentMonth = date('m');
$CurrentYear = date('Y');


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
				  $NextPage = $PageID;
				    if ($z > 0) {
				    $PrevPage = $story_array[$z-1]->id;
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
					$NextPage = $PageID;
			      	    if ($z > 0) {
				   		 $PrevPage = $story_array[$z-1]->id;
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
						$NextPage = $PageID;
				        if ($z > 0) {
				   		 $PrevPage = $story_array[$z-1]->id;
				    	} else { 
						$PrevPage = $PageID;
						}
				  	    
				  	    break;
			        } 
				}
			}
 	}  // end for

//print "DO YOU HAVE TO UPDATE THAT XML? 0 or 1: ".$UpdateXml."<br/>";
$TotalPages = 0;
//print "MY COUNTER = " . $counter. "<br/>";
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
							} else {
							$lastpage = $story_array[$k]->id;
							}
		   } else if ($PageYear == $CurrentYear) {
						if ($PageMonth<$CurrentMonth) {
							//print "SAFE ID = " .$SafeID."<br/>"; 
							$idSafe = 1; 
							 $TotalPages++;
if ($k == 0) {
							$firstpage = $story_array[$k]->id;
							} else {
							$lastpage = $story_array[$k]->id;
							}

							 //print "MY TOTAL PAGES MONTH LESS = " .$TotalPages."<br/>";
			} else if ($PageMonth == $CurrentMonth) {
								    if ($PageDay<=$CurrentDay) {
									//print "SAFE ID = " .$SafeID."<br/>"; 
									     $idSafe = 1; 
									     $TotalPages++;
if ($k == 0) {
							$firstpage = $story_array[$k]->id;
							} else {
							$lastpage = $story_array[$k]->id;
							}
										//print "MY TOTAL PAGES DAY LESS = " .$TotalPages."<br/>";
				  	
			        				  } // End If
						          } // End PageMonth
			  } // end TEST
		    	
} // end for


echo "&pageimage=".$Image."&pagetitle=".$Title."&emailinfo=".$Email."&barcolor=".$BarColor."&textcolor=".$TextColor."&moviecolor=".$MovieColor."&arrowcolor=".$ArrowColor."&buttoncolor=".$ButtonColor."&totalpages=".$TotalPages."&firstpage=".$firstpage."&lastpage=".$lastpage;
?>

