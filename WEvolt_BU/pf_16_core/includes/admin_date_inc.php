<?php $UpdateXml = 0;

$CurrentDate= date('D M j'); 
$CurrentDay = date('d');
$CurrentMonth = date('m');
$CurrentYear = date('Y');


$TotalPages = 0;

for ($k=0; $k< $counter; $k++){
 	$Date = $story_array[$k]->datelive;
	$Active = $story_array[$z]->active;
	$SafeID = $story_array[$k]->id;
	$ImageHeight = $story_array[$k]->imgheight;	
	$PageDay = substr($Date, 3, 2); 
	$PageMonth = substr($Date, 0, 2); 
	$PageYear = substr($Date, 6, 4);
	
		if ($PageYear<$CurrentYear) {

			$idSafe = 1; 
			$TotalPages++;
		   } else  
		if ($PageYear == $CurrentYear) {
						if ($PageMonth<$CurrentMonth) {

							$idSafe = 1; 
							 $TotalPages++;
						   } else 
					    if ($PageMonth == $CurrentMonth) {
								if ($PageDay<=$CurrentDay) {
									$idSafe = 1; 
									$TotalPages++;
				  	
			        				} // End If
						   } // End PageMonth
		   } // end TEST
 	if (($Active == 0) && ($idSafe = 1)){
 			$PageID = $story_array[$z]->id;
                 $TotalPages++;
				 $UpdateXml = 1;
   } 
		   
} // end for
?>