<? 
if ($Section == 'modules') {
if ($ContentType == 'story') {
			$TargetID = $StoryID;
			$TargetName = 'StoryID';
			
		}else{
			$TargetID = $ComicID;
			$TargetName = 'ComicID';
		}
if ($_GET['a'] == 'save') {
	$LeftColumnOrder = explode(',',$_POST['LeftColumnOrder']);
	$RightColumnOrder = explode(',',$_POST['RightColumnOrder']);
	
	$Count = 1;
		foreach ($LeftColumnOrder as $module) {
		$ModulePublished = $_POST[$module];
		$CustomVar1 = $_POST[$module.'Var1'];
		$HtmlCode = mysql_real_escape_string($_POST[$module.'HTML']);
		$query = "UPDATE pf_modules set Position='$Count', CustomVar1='$CustomVar1',Placement='left',IsPublished='$ModulePublished',HTMLCode='$HtmlCode' where ModuleCode='$module' and ".$TargetName." ='".$TargetID."'";
		$comicsDB->query($query);
		$Count++;
	//print $query."<br/>";
	}
	$Count = 1;
	foreach ($RightColumnOrder as $module) {
		$ModulePublished = $_POST[$module];
		$CustomVar1 = $_POST[$module.'Var1'];
		$HtmlCode = mysql_real_escape_string($_POST[$module.'HTML']);
		$query = "UPDATE pf_modules set Position='$Count', CustomVar1='$CustomVar1', IsPublished='$ModulePublished', Placement='right' ,HTMLCode='$HtmlCode' where ModuleCode='$module' and ".$TargetName." ='".$TargetID."'";
		$comicsDB->query($query);
		$Count++;
		//print $query."<br/>";
	}
	$ConnectKey = createKey();
	$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
	$comicsDB->query($query);
	$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 'k' => $ConnectKey,'t'=>$ContentType);
	$Result= $curl->send_post_data($ApplicationLink."/connectors/update_modules.php", $post_data);
	unset($post_data);
	if ($ContentType == 'story') 
	//print 'UPDATE RESULT = ' . $Result;
	
	header("location:/story/edit/".$SafeFolder."/");
	else
	header("location:/cms/edit/".$SafeFolder."/");
	
}
if ($ContentType != 'story')
$query = "SELECT Template from comic_settings where ".$TargetName." ='".$TargetID."'";
else
$query = "SELECT Template from story_settings where ".$TargetName." ='".$TargetID."'";
$Template = $comicsDB->queryUniqueValue($query);
$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='left' and Homepage=0 order by Position";
$comicsDB->query($query);
$LeftColumModuleOrder = array();
$RightColumModuleOrder = array();
$LeftColumnDiv = '<div id="left" class="section"><h3 class="handle">LEFT COLUMN</h3>';
while ($line = $comicsDB->fetchNextObject()) {
		if ($line->ModuleCode == 'custommod') 
			$ItemClass = 'lineitem';
		else
			$ItemClass = 'lineitem';
			
		$LeftColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="'.$ItemClass.'">'.$line->Title.'<br/>Published? <input type="radio" name="'.$line->ModuleCode.'" value="1"';
		if ($line->IsPublished == 1)
			$LeftColumnDiv .= 'checked';
		
		$LeftColumnDiv .= '>Yes&nbsp;<input type="radio" name="'.$line->ModuleCode.'" value="0"';
		if ($line->IsPublished == 0)
			$LeftColumnDiv .= 'checked';
		
		$LeftColumnDiv .= '>No';
		
		if ($line->ModuleCode == 'twitter')
			$LeftColumnDiv .= '<br/>Username: <input type="text" name="'.$line->ModuleCode.'Var1" value="'.$line->CustomVar1.'" size="15">';
				
				if ($line->ModuleCode == 'custommod') {
					$LeftColumnDiv .= '<br/>[<a href="#" onclick="edit_custom();return false;">EDIT CODE</a>]';
					$CustomModCode = $line->HTMLCode;
				}
		$LeftColumnDiv .= '</div>';
		if ($LeftColumnOrder == '')
			$LeftColumnOrder = $line->ModuleCode;
		else 
			$LeftColumnOrder .= ','.$line->ModuleCode;
		
} 

$LeftColumnDiv .= '</div>';

$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='right' and Homepage=0 order by Position";
$comicsDB->query($query);
$RightColumnDiv = '<div id="right" class="section"><h3 class="handle">RIGHT COLUMN</h3>';
while ($line = $comicsDB->fetchNextObject()) {

if ($line->ModuleCode == 'custommod') 
			$ItemClass = 'lineitem';
		else
			$ItemClass = 'lineitem';

		$RightColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="'.$ItemClass.'">'.$line->Title.'<br/>Published? <input type="radio" name="'.$line->ModuleCode.'" value="1"';
		if ($line->IsPublished == 1)
			$RightColumnDiv .= 'checked';
		
		$RightColumnDiv .= '>Yes&nbsp;<input type="radio" name="'.$line->ModuleCode.'" value="0"';
		if ($line->IsPublished == 0)
			$RightColumnDiv .= 'checked';
		
		$RightColumnDiv .= '>No';
		
		if ($line->ModuleCode == 'twitter')
			$RightColumnDiv .= '<br/>Twitter Username: <input type="text" name="'.$line->ModuleCode.'Var1" value="'.$line->CustomVar1.'" size="15">';
			
			if ($line->ModuleCode == 'custommod') {
			$RightColumnDiv .= '<br/>[<a href="#" onclick="edit_custom();return false;">EDIT CODE</a>]';
				$CustomModCode = $line->HTMLCode;
		}
		$RightColumnDiv .= '</div>';
		if ($RightColumnOrder == '')
			$RightColumnOrder = $line->ModuleCode;
		else 
			$RightColumnOrder .= ','.$line->ModuleCode;

}

$RightColumnDiv .= '</div>';
}
?>