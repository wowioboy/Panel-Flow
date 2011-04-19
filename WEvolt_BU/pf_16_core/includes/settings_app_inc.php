<? 
if ($_GET['section'] == 'settings') {
if ($ContentType == 'story') {
			$TargetID = $StoryID;
			$TargetName = 'StoryID';
			$TargetTable = 'story_settings';
			
		}else{
			$TargetID = $ComicID;
			$TargetName = 'ComicID';
			$TargetTable = 'comic_settings';
		}
	if ($_GET['t'] == 'homepage') {
		if ($_GET['a'] == 'save') {
			$LeftColumnOrder = explode(',',$_POST['LeftColumnOrder']);
			$RightColumnOrder = explode(',',$_POST['RightColumnOrder']);
			$InactiveColumnOrder = explode(',',$_POST['InactiveColumnOrder']);
			$HomepageHTML = mysql_real_escape_string($_POST['txtCustom']);
			$HomePageType = $_POST['txtHomePageType'];
			$HomepageActive = $_POST['HomepageActive'];
	
			$Count = 1;
			foreach ($LeftColumnOrder as $module) {
				$ModulePublished = $_POST[$module];
				$query = "SELECT ID from pf_modules where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";	$comicsDB->query($query);
				//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					$query = "INSERT into pf_modules (Position,IsPublished,Placement,ModuleCode,".$TargetName.",Homepage) values ('$Count',1,'left','$module','$TargetID',1)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished=1, Placement='left' where ModuleCode='$module' and ".$TargetName."='$TargetID' and Homepage=1";
				$comicsDB->query($query);
			//	print $query."<br/>";
				}
				$Count++;
	//print $query."<br/>";
			}
			

			foreach ($InactiveColumnOrder as $module) {
				$ModulePublished = $_POST[$module];
				$query = "SELECT ID from pf_modules where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";	$comicsDB->query($query);
				//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					$query = "INSERT into pf_modules (Position,IsPublished,Placement,ModuleCode,".$TargetName.",Homepage) values ('$Count',0,'','$module','$TargetID',1)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished='1', Placement='' where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";
				$comicsDB->query($query);
				//print $query."<br/>";
				}

	//print $query."<br/>";
			}
			
			$Count = 1;
			foreach ($RightColumnOrder as $module) {
				$ModulePublished = $_POST[$module];
				$query = "SELECT ID from pf_modules where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";	$comicsDB->query($query);
				//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					$query = "INSERT into pf_modules (Position,IsPublished,Placement,ModuleCode,".$TargetName.",Homepage) values ('$Count',1,'right','$module','$TargetID',1)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished=1, Placement='right' where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";
				$comicsDB->query($query);
				//print $query."<br/>";
				}
				$Count++;
		//print $query."<br/>";
			}
			
			
			//print 'HTML CODE = ' . $_POST['txtCustom']."<br/>";
			$query = "UPDATE ".$TargetTable." set HomepageType='$HomePageType',HomepageHTML='$HomepageHTML',HomepageActive='$HomepageActive' where ".$TargetName." ='".$TargetID."'";
			$comicsDB->execute($query);
	//print $query."<br/>"; 
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 'k' => $ConnectKey,'t'=>$ContentType);
			//$curl->send_post_data($ApplicationLink."/connectors/update_homepage.php", $post_data);
			$UpdateResult = $curl->send_post_data($ApplicationLink."/connectors/update_homepage.php", $post_data);
			unset($post_data);
			
			//print 'RESULT = ' .$UpdateResult;
			//exit;
			//header("location:/cms/edit/".$SafeFolder."/");
		}
	$query = "SELECT HomepageType,HomepageHTML,HomepageActive from ".$TargetTable." where ".$TargetName." ='".$TargetID."'";
	$HomeArray = $comicsDB->queryUniqueObject($query);
	$HomePageType = $HomeArray->HomepageType;
	$HomepageHTML = $HomeArray->HomepageHTML;
	$HomepageActive = $HomeArray->HomepageActive;
	if ($HomePageType == '')
		$HomePageType =standard;
	
	$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='left' and Homepage=1 order by Position";

	$comicsDB->query($query);
	$LeftColumModuleOrder = array();
	$RightColumModuleOrder = array();
	$InactiveColumnOrder = array();
	$LeftColumnDiv = '<div id="left" class="section"><h3 class="handle">LEFT COLUMN</h3>';
	while ($line = $comicsDB->fetchNextObject()) {
		$LeftColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="homemod">HTML CODE: {'.$line->ModuleCode.'}<br/><br/>'.$line->Title.'</div>';
		if ($LeftColumnOrder == '')
			$LeftColumnOrder = $line->ModuleCode;
		else 
			$LeftColumnOrder .= ','.$line->ModuleCode;
	} 
	$LeftColumnDiv .= '</div>';
	
	$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='right' and Homepage=1 order by Position";
	$comicsDB->query($query);
	$RightColumnDiv = '<div id="right" class="section"><h3 class="handle">RIGHT COLUMN</h3>';
	while ($line = $comicsDB->fetchNextObject()) {
		$RightColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="homemod">HTML CODE: {'.$line->ModuleCode.'}<br/><br/>'.$line->Title.'</div>';
		if ($RightColumnOrder == '')
			$RightColumnOrder = $line->ModuleCode;
		else 
			$RightColumnOrder .= ','.$line->ModuleCode;
	}

	$RightColumnDiv .= '</div>';

	$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='' and Homepage=1 order by Position";
	$comicsDB->query($query);
	$InactiveModules = '<div id="inactive" class="section"><h3 class="handle">AVALABLE MODULES</h3>';
	while ($line = $comicsDB->fetchNextObject()) {
		if ($line->ModuleCode != '') {
			$InactiveModules .= '<div id="item_'.$line->ModuleCode.'" class="homemod">HTML CODE: {'.$line->ModuleCode.'}<br/><br/>'.$line->Title.'</div>';
			if ($InactiveColumnOrder == '')
				$InactiveColumnOrder = $line->ModuleCode;
			else 
				$InactiveColumnOrder .= ','.$line->ModuleCode;
		}
	}

	$InactiveModules .= '</div>';

} else if ($_GET['t'] == 'layout') {
		if ($_GET['a'] == 'save') {
			$LayoutType = $_POST['LayoutType'];
			$LayoutHTML = mysql_real_escape_string($_POST['LayoutHTML']);			
			//print 'HTML CODE = ' . $_POST['txtCustom']."<br/>";
			$query = "UPDATE ".$TargetTable." set LayoutType='$LayoutType',LayoutHTML='$LayoutHTML' where ".$TargetName." ='".$TargetID."'";
			$comicsDB->execute($query);
	//print $query."<br/>";
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			$post_data = array('u' => $_SESSION['userid'], 'c' => $TargetID, 'k' => $ConnectKey,'t'=>$ContentType);
			//$curl->send_post_data($ApplicationLink."/connectors/update_homepage.php", $post_data);
			$ThisResult = $curl->send_post_data($ApplicationLink."/connectors/update_layout.php", $post_data);
			unset($post_data);
			//print 'RESULT = ' . $ThisResult;
			
		}
		$query = "SELECT LayoutType,LayoutHTML from ".$TargetTable." where ".$TargetName." ='".$TargetID."'";
		$HomeArray = $comicsDB->queryUniqueObject($query);
		$LayoutType = $HomeArray->LayoutType;
		$LayoutHTML = $HomeArray->LayoutHTML;
		if ($LayoutType == '')
			$LayoutType =standard;
	
} else {

	$ComicXML = '';

///GRAB TEMPLATE INFORMATION

	$TemplateArray = @explode(',',trim(@file_get_contents($ApplicationLink.'/connectors/get_templates.php')));
 	$TemplateXML ='<template>'; 
 	$TemplatesFound = 0;
 	foreach($TemplateArray as $templateitem ) {
  		$query = "SELECT * from templates where TemplateCode='$templateitem'";
		$TemplateInfoArray = $comicsDB->queryUniqueObject($query);
	
  		$TemplatesFound = 1;
 	 	$TemplateXML .= '<information>';
	 	$TemplateXML .= '<title>'.$TemplateInfoArray->Title.'</title>';
	 	$TemplateXML .= '<templatecode>'.$templateitem.'</templatecode>';
	 	$TemplateXML .= '<image>'.$TemplateInfoArray->Image.'</image></information>';
	 } 
	 $TemplateXML .='</template>';


   	$ComicXML ='<settings>';
	$ComicXML .= '<setting>';
	$ComicXML .= '<contact>'.$SettingArray->Contact.'</contact>';
	$ComicXML .= '<pagecomments>'.$SettingArray->AllowComments.'</pagecomments>';
	$ComicXML .= '<archive>'.$SettingArray->ShowArchive.'</archive>';
	$ComicXML .= '<calendar>'.$SettingArray->ShowCalendar.'</calendar>';
	$ComicXML .= '<showschedule>'.$SettingArray->ShowSchedule.'</showschedule>';
	$ComicXML .= '<chapterlist>'.$SettingArray->ShowChapter.'</chapterlist>';
	$ComicXML .= '<episodelist>'.$SettingArray->ShowEpisode.'</episodelist>';
	$ComicXML .= '<assistant1>'.$SettingArray->Assistant1.'</assistant1>';
	$ComicXML .= '<assistant2>'.$SettingArray->Assistant2.'</assistant2>';
	$ComicXML .= '<assistant3>'.$SettingArray->Assistant3.'</assistant3>';
	$ComicXML .= '<showbio>'.$SettingArray->BioSetting.'</showbio>';
	$ComicXML .= '<template>'.$SettingArray->Template.'</template>';
	$ComicXML .= '<emailpost>'.$SettingArray->EmailPost.'</emailpost>';
	$ComicXML .= '<homepageactive>'.$SettingArray->HomepageActive.'</homepageactive>';
	$ComicXML .= '<emailpostasst>'.$SettingArray->EmailPostAsst.'</emailpostasst>';
	$ComicXML .= '<publiccomments>'.$SettingArray->AllowPublicComents.'</publiccomments>';
	$ComicXML .= '<postcode>'.$SettingArray->PostCode.'</postcode>';
	if ($SettingArray->ReaderType == '') 
		$ReaderType = 'flash';
	else 
		$ReaderType=$SettingArray->ReaderType;
	$ComicXML .= '<readertype>'.$ReaderType.'</readertype>';
	$ComicXML .= '</setting>';

	$ComicXML .='</settings>';
	if ($TemplatesFound == 0) {
		$TemplateXML = "<template><information><title>standard</title><image>/".$PFDIRECTORY."/templates/standard.jpg</image></information><information><title>righthand</title><image>/".$PFDIRECTORY."/templates/righthand.jpg</image></information><information><title>lefthand</title><image>/".$PFDIRECTORY."/templates/lefthand.jpg</image></information></template>";
  	} 
}
}
?>