<? 
if ($Section == 'homepage') {
if ($_GET['a'] == 'save') {
	$LeftColumnOrder = explode(',',$_POST['LeftColumnOrder']);
	$RightColumnOrder = explode(',',$_POST['RightColumnOrder']);
	
	$Count = 1;
		foreach ($LeftColumnOrder as $module) {
		$ModulePublished = $_POST[$module];
		$query = "UPDATE pf_modules set Position='$Count', Placement='left',IsPublished='$ModulePublished' where ModuleCode='$module' and ComicID ='$ComicID'";
		$comicsDB->query($query);
		$Count++;
	//print $query."<br/>";
	}
	$Count = 1;
	foreach ($RightColumnOrder as $module) {
		$ModulePublished = $_POST[$module];
		$query = "UPDATE pf_modules set Position='$Count', IsPublished='$ModulePublished', Placement='right' where ModuleCode='$module' and ComicID ='$ComicID'";
		$comicsDB->query($query);
		$Count++;
		//print $query."<br/>";
	}
	$ConnectKey = createKey();
	$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
	$comicsDB->query($query);
	$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey);
	$curl->send_post_data($ApplicationLink."/connectors/update_modules.php", $post_data);
	unset($post_data);
	header("location:/cms/edit/".$SafeFolder."/");
}
$query = "SELECT Template from comic_settings where ComicID ='$ComicID'";
$Template = $comicsDB->queryUniqueValue($query);
$query = "SELECT * from pf_modules where ComicID='$ComicID' and Placement ='left' and Homepage=0 order by Position";
$comicsDB->query($query);
$LeftColumModuleOrder = array();
$RightColumModuleOrder = array();
$LeftColumnDiv = '<div id="left" class="section"><h3 class="handle">LEFT COLUMN</h3>';
while ($line = $comicsDB->fetchNextObject()) {
		$LeftColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="lineitem">'.$line->Title.'<div class="spacer"></div>Show Module? <input type="radio" name="'.$line->ModuleCode.'" value="1"';
		if ($line->IsPublished == 1)
			$LeftColumnDiv .= 'checked';
		
		$LeftColumnDiv .= '>Yes&nbsp;<input type="radio" name="'.$line->ModuleCode.'" value="0"';
		if ($line->IsPublished == 0)
			$LeftColumnDiv .= 'checked';
		
		$LeftColumnDiv .= '>No</div>';
		if ($LeftColumnOrder == '')
			$LeftColumnOrder = $line->ModuleCode;
		else 
			$LeftColumnOrder .= ','.$line->ModuleCode;
} 
$LeftColumnDiv .= '</div>';

$query = "SELECT * from pf_modules where ComicID='$ComicID' and Placement ='right' and Homepage=0 order by Position";
$comicsDB->query($query);
$RightColumnDiv = '<div id="right" class="section"><h3 class="handle">RIGHT COLUMN</h3>';
while ($line = $comicsDB->fetchNextObject()) {
		$RightColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="lineitem">'.$line->Title.'<div class="spacer"></div>Show Module? <input type="radio" name="'.$line->ModuleCode.'" value="1"';
		if ($line->IsPublished == 1)
			$RightColumnDiv .= 'checked';
		
		$RightColumnDiv .= '>Yes&nbsp;<input type="radio" name="'.$line->ModuleCode.'" value="0"';
		if ($line->IsPublished == 0)
			$RightColumnDiv .= 'checked';
		
		$RightColumnDiv .= '>No</div>';
		if ($RightColumnOrder == '')
			$RightColumnOrder = $line->ModuleCode;
		else 
			$RightColumnOrder .= ','.$line->ModuleCode;
}

$RightColumnDiv .= '</div>';
}
?>