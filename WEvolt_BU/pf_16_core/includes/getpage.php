<?  include_once("init.php"); 
$xml_file = "../xml/pageXML.xml";
  include_once("parser.php"); 
$ComicInfo = array(); 
include_once("syndicate_info.php"); 

//GET PAGE NUMBER IF NONE GIVEN
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
 			if ($Active == 1){
 				$PageID = $story_array[$z]->id;
 				$AuthorComment = $story_array[$z]->comment;
				$Image = $story_array[$z]->image;
				$Title = $story_array[$z]->title;
				$ImageHeight = $story_array[$z]->imgheight;	
				list($Width, $Height) = split('[x]', $ImageHeight);	
 				$CurrentIndex = $z;
				break;
 			 }  else if ($PageYear<$CurrentYear) {
				  $PageID = $story_array[$z]->id;
 				  $AuthorComment = $story_array[$z]->comment;
				  $Image = $story_array[$z]->image;
				  $Title = $story_array[$z]->title;
				  $ImageHeight = $story_array[$z]->imgheight;
				  list($Width, $Height) = split('[x]', $ImageHeight);	
 				  $CurrentIndex = $z;
				  $UpdateXml = 1;
				  break;
			 } else if ($PageYear == $CurrentYear) {
				if ($PageMonth<$CurrentMonth) {
					$PageID = $story_array[$z]->id;
 				 	$AuthorComment = $story_array[$z]->comment;
				 	$Image = $story_array[$z]->image;
				  	$Title = $story_array[$z]->title;
					$ImageHeight = $story_array[$z]->imgheight;	
					list($Width, $Height) = split('[x]', $ImageHeight);
 				  	$CurrentIndex = $z;
				  	$UpdateXml = 1;
				  	break;
				} else if ($PageMonth == $CurrentMonth) {
					if ($PageDay<=$CurrentDay) {
						$PageID = $story_array[$z]->id;
 				 	    $AuthorComment = $story_array[$z]->comment;
				 	    $Image = $story_array[$z]->image;
				  	    $Title = $story_array[$z]->title;
						$ImageHeight = $story_array[$z]->imgheight;
						list($Width, $Height) = split('[x]', $ImageHeight);	
 				  	    $CurrentIndex = $z;
				  	    $UpdateXml = 1;
				  	    break;
			        } 
				}
			}
 	}  // end for


$TotalPages = 0;
for ($k=0; $k< $counter; $k++){
$idSafe = 0; 
 	$Date = $story_array[$k]->datelive;
	$Active = $story_array[$k]->active;
	$SafeID = $story_array[$k]->id;
	$PageDay = substr($Date, 3, 2); 
	$PageMonth = substr($Date, 0, 2); 
	$PageYear = substr($Date, 6, 4);
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
							if ($k == 0) {
							$firstpage = $story_array[$k]->id;
							} else {
							$lastpage = $story_array[$k]->id;
							}
							$idSafe = 1; 
							 $TotalPages++;
						   } else if ($PageMonth == $CurrentMonth) {
								    if ($PageDay<=$CurrentDay) {
									     $idSafe = 1; 
									     $TotalPages++;
										 if ($k == 0) {
							$firstpage = $story_array[$k]->id;
							} else {
							$lastpage = $story_array[$k]->id;
							}
				  	
			        				  } // End If
						          } // End PageMonth
			     
		   } // end TEST
		   
} // end for
echo "&pageimage=".$Image."&pagetitle=".$Title."&emailinfo=".$Email."&barcolor=".$BarColor."&textcolor=".$TextColor."&moviecolor=".$MovieColor."&arrowcolor=".$ArrowColor."&buttoncolor=".$ButtonColor."&totalpages=".$TotalPages."&firstpage=".$firstpage."&lastpage=".$lastpage;
?>