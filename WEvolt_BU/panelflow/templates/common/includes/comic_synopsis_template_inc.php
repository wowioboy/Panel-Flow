<? 
//COMMENT SYNOPSIS MODULE 
$ComicSynopsisString='<div class="comiccredits" style="padding-left:10px;"><div class="halfspacer"></div>';
if (isset($Synopsis)) { 
		$ComicSynopsisString.='<div class="infotext">'.stripslashes($Synopsis).'</div>';
		if ($EpisodeDesc != '') {
			$ComicSynopsisString.='<div class="infotext"><b>Episode Summary: </b><br/>'.stripslashes($EpisodeDesc).'</div>';
		}
		
} 
$ComicSynopsisString.='</div>';
$HomecomicsynopsisString = $ComicSynopsisString;
?>