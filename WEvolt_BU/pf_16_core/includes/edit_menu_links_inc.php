<?
session_start();
 include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php');
$DB = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

if ($MenuID == "") 
$MenuID = $_GET['id'];

if ($MenuID == "") 
$MenuID = $_POST['txtMenu'];


$ComicID = $_GET['comic'];

$StoryID = $_GET['story'];

if ($ComicID == '') 
	$ComicID = $_POST['txtComic'];
	
if ($StoryID == '') 
	$StoryID = $_POST['txtStory'];

if ($StoryID == ''){
		$TargetFolder = 'comics';
		$TargetName = 'ComicID';
		$TargetID = $ComicID;
		$EncryptName = 'comiccrypt';
		$ContentType = 'comic';
		$TargetTable = 'menu_links';
				
}else{
		$TargetFolder = 'stories';
		$TargetName = 'StoryID';
		$TargetID = $StoryID;
		$EncryptName = 'StoryID';
		$ContentType = 'story';
		$TargetTable = 'menu_links';
}

$ThemeID = $_GET['theme'];
if (($ThemeID == '') || ($ThemeID == 'undefined'))
	$ThemeID = $_POST['txtTheme'];

if ($ThemeID != '') {
	$TargetTable = 'pf_themes_menus';
	$TargetName = 'ThemeID'; 
	$TargetID = $ThemeID;
}
$Action = $_GET['a'];



$PFDIRECTORY = 'pf_16_core';
if ($ComicID != '') {
	$query = "SELECT HostedUrl,ProjectDirectory,SafeFolder from projects where ProjectID='$TargetID'";
	$ProjectArray = $DB->queryUniqueObject($query);
	$ComicDirectory = $ProjectArray->HostedUrl;
	$TargetFolder = $ProjectArray->ProjectDirectory;
	$SafeFolder = $ProjectArray->SafeFolder;
	
}
//print 'USERID = ' . $_SESSION['userid'];
if ($_POST['save'] == 1) {
			$Title = mysql_real_escape_string($_POST['txtTitle']);
			$LinkType = mysql_real_escape_string($_POST['txtLinkType']);
			$Target = mysql_real_escape_string($_POST['txtLink']);
			$Url = mysql_real_escape_string($_POST['txtUrl']);
			$SafeFolder = $_POST['txtSafeFolder'];
			$ComicDir = $_POST['txtComicDirectory'];
			$RemoveButton = $_POST['txtRemoveButton'];
			$RemoveRollover = $_POST['txtRemoveRollover'];
			$CustomUrl = $_POST['txtCustomUrl'];
			
			if ($LinkType == 'section') {
				$SectionLink = $Target;
				$ContentSection = $Target;
				if ($CustomUrl == ''){
					$Url = $Target;
				}else {
					$ContentLink = str_replace(' ', '',$CustomUrl);
					$ContentLink  = str_replace('/', '',$ContentLink);
					$ContentLink  = str_replace('"', '',$ContentLink);
					$ContentLink  = str_replace("'", "",$ContentLink);
					$ContentLink  = str_replace("&", "",$ContentLink);
					$ContentLink  = str_replace("@", "",$ContentLink);
					$ContentLink  = str_replace("?", "",$ContentLink);
					$ContentLink  = str_replace("!", "",$ContentLink);
					$Url = $ContentLink;
				}	
			} else { 
				$SectionLink = '';
				$PageLink = '';
			
			}	
			
			if ($LinkType == 'blog'){
				$SectionLink = $Target;
				$Url = $Target;
			} else { 
				$SectionLink = '';
				$PageLink = '';
			
			}	
			
			if ($LinkType == 'page'){
				$PageLink = $Target;
				$Url = $Target;
			} else { 
				$PageLink = '';
				$SectionLink = '';
			
			}
			
			if ($LinkType == 'page'){
				$PageLink = $Target;
				$Url = $Target;
			} else { 
				$PageLink = '';
				$SectionLink = '';
			
			}
			
			if ($LinkType == 'external'){
					$PageLink = '';
				$SectionLink = '';
			} 
					
			
			$Published = mysql_real_escape_string($_POST['txtPublished']);
			$MenuParent = $_POST['MenuSelect'];
			$ParentOne = $_POST['txtParent1'];
			$ParentTwo = $_POST['txtParent2'];
			$AccessType = $_POST['txtAccessType'];
			if ($MenuParent == 1) 
				$Parent = $ParentOne;
			else if ($MenuParent == 2) 
				$Parent = $ParentTwo;
			$Parent = 0;
			$MenuParent = 1;
			$ButtonFilename = $_POST['txtButtonFilename'];
			$RollFilename = $_POST['txtRollFilename'];
			$Source_dir = 'pf_16_core/temp/';
			
			if ($LinkType == 'section') {
			
			
			
			}
			$Base = $_SERVER['DOCUMENT_ROOT'];
			
			if ($Theme == '')
				$FullPath = $Base.'/'.$TargetFolder.'/'.$ComicDirectory.'/images/';
			
			else 
				$FullPath = $Base.'/themes/'.$ThemeID.'/images/';
			
		
				
			if ($ButtonFilename != '') {
					$randName = md5(rand() * time());
					$ext = substr(strrchr($ButtonFilename, "."), 1);
					$filePath =   $Base.'/'. $Source_dir . $ButtonFilename;
					
					$ButtonImage = $randName . '.' . $ext;
					$Filename = $FullPath.$ButtonImage;
					copy($filePath, $Filename);
				//	print 'FILENAME = '.$Filename.'<br/>';
					chmod($Filename, 0777);
					unlink($filePath);
			}
			
			if ($RollFilename != '') {
					$randName = md5(rand() * time());
					$ext = substr(strrchr($RollFilename, "."), 1);
					$filePath =  $Base.'/'. $Source_dir . $RollFilename;
					$RolloverButtonImage = $randName . '.' . $ext;
					$Filename = $FullPath.$RolloverButtonImage;
					copy($filePath, $Filename);
					chmod($filePath, 0777);
					unlink($filePath);
			}
		
			if ($_POST['action'] == 'new') {
				
				if ($ThemeID == '')
					$query ="SELECT Position from menu_links WHERE Position=(SELECT MAX(Position) FROM menu_links where ".$TargetName."='$TargetID' and MenuParent='$MenuParent')";
				else 
					$query ="SELECT Position from pf_themes_menus WHERE Position=(SELECT MAX(Position) FROM pf_themes_menus where ThemeID='".$ThemeID."')";
					
					$NewPosition = $DB->queryUniqueValue($query);
					$NewPosition++;
					
					
				//	print $query.'<br/>';
						if ($ThemeID == '')
					$query = "INSERT into menu_links(".$TargetName.", Title, Url, LinkType, SectionLink, PageLink, IsPublished, Parent, Position, ButtonImage, RolloverButtonImage, MenuParent,Target, ContentSection, AccessType) values ('$TargetID', '$Title', '$Url', '$LinkType','$SectionLink', '$PageLink', '$Published', '$Parent', '$NewPosition', '$ButtonImage', '$RolloverButtonImage', '$MenuParent','$Target','$ContentSection','$AccessType')";
					else	
						$query = "INSERT into pf_themes_menus(ThemeID, Title, Url, LinkType, SectionLink, PageLink, IsPublished, Parent, Position, ButtonImage, RolloverButtonImage, MenuParent,Target,ContentSection) values ('".$ThemeID."', '$Title', '$Url', '$LinkType','$SectionLink', '$PageLink', '$Published', '$Parent', '$NewPosition', '$ButtonImage', '$RolloverButtonImage', '$MenuParent','$Target','$ContentSection')";
						
						$DB->execute($query);
				//print $query.'<br/>';
					if ($ThemeID == '')
					$query ="SELECT ID from menu_links WHERE ".$TargetName."='$TargetID' and Position='$NewPosition' and Title='$Title'";//print $query.'<br/>';
					else
					$query ="SELECT ID from pf_themes_menus WHERE ThemeID='".$ThemeID."' and Position='$NewPosition' and Title='$Title'";//print $query.'<br/>';
					
					$ID = $DB->queryUniqueValue($query);
			//	print $query.'<br/>';
					
					$Encryptid = substr(md5($ID), 0, 8).dechex($ID);
						if ($ThemeID == '')
					$query = "UPDATE menu_links SET EncryptID='$Encryptid' WHERE ID='$ID'";
					else
						$query = "UPDATE pf_themes_menus SET EncryptID='$Encryptid' WHERE ID='$ID'";
				
					$DB->query($query);
					$MenuID = $Encryptid;
				//	print $query.'<br/>';
		//	print $query.'<br/>';
			} else {
				if ($ThemeID == '')
					$query = "UPDATE menu_links set Title='$Title', Url='$Url', LinkType='$LinkType', SectionLink='$SectionLink', PageLink='$PageLink', IsPublished='$Published', Parent='$Parent', MenuParent='$MenuParent', Target='$Target', AccessType='$AccessType' where EncryptID='$MenuID'";
				else 
					$query = "UPDATE pf_themes_menus set Title='$Title', Url='$Url', LinkType='$LinkType', SectionLink='$SectionLink', PageLink='$PageLink', IsPublished='$Published', Parent='$Parent', MenuParent='$MenuParent', Target='$Target' where EncryptID='$MenuID'";
					
					$DB->execute($query);
			//	print $query.'<br/>';
					if ($ButtonFilename != '') {
						if ($ThemeID == '')
							$query = "UPDATE menu_links set ButtonImage='$ButtonImage' where EncryptID='$MenuID'";
						else
							$query = "UPDATE pf_themes_menus set ButtonImage='$ButtonImage' where EncryptID='$MenuID'";
						
						$DB->execute($query);
				//	print $query.'<br/>';
					}
					
					if ($RollFilename != '') {
						if ($ThemeID == '')
							$query = "UPDATE menu_links set RolloverButtonImage='$RolloverButtonImage' where EncryptID='$MenuID'";
						else
							$query = "UPDATE pf_themes_menus set RolloverButtonImage='$RolloverButtonImage' where EncryptID='$MenuID'";
						
						$DB->execute($query);
				//print $query.'<br/>';
					}
					
					if ($RemoveButton == 1) {
						if ($ThemeID == '')
							$query = "UPDATE menu_links set ButtonImage='' where EncryptID='$MenuID'";
						else
							$query = "UPDATE pf_themes_menus set ButtonImage='' where EncryptID='$MenuID'";
						
						$DB->execute($query);
					//print $query.'<br/>';
					}
					
					if ($RemoveRollover == 1) {
						if ($ThemeID == '')
							$query = "UPDATE menu_links set RolloverButtonImage='' where EncryptID='$MenuID'";
						else
							$query = "UPDATE pf_themes_menus set RolloverButtonImage='' where EncryptID='$MenuID'";
						
						$DB->execute($query);
					//	print $query.'<br/>';
					}
					
			
				}
			
				
				$query = "select * from $TargetTable where ".$TargetName."='$TargetID' and MenuParent=1 ORDER BY Parent, Position ASC";

			$DB->query($query);
		//print $query.'<br/>';
            $NumLinks = $DB->numRows();
			//$menuString .= "<div class=\'pagetitleLarge\' style=\'border-bottom:solid 1px #FF9900; padding-right:10px;\'>Menu One</div>";
			$menuString .= "<div>";
		

					



				while ($line = $DB->fetchNextObject()) { 
					$menuString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$menuString .= '<table width="100%"><tr><td class="grey_cmsboxcontent" width="300">';
							
				if ($line->ButtonImage != '') {
					if ($MenuOneCustom == 1)
						$menuString .= '<img src="/'.$_SESSION['basefolder'].'/'.$ComicDirectory.'/images/'.$line->ButtonImage.'">';
					else
						$menuString .= '<img src="/themes/'.$ProjectTheme.'/images/'.$line->ButtonImage.'">';
				}else{ 
						$menuString .= '<strong>TITLE</strong>: '.$line->Title;
				}
							
				$menuString .='<div class="spacer"></div>';
				$menuString .='<strong>URL</strong>: ' .$line->Url;
				$menuString .= '</td><td class="grey_cmsboxcontent">';
				
				if ($line->LinkType == 'section') {
					$menuString .= '<strong>LINK TYPE</strong> - ';
					if ($line->ContentSection == '')
						$menuString .= substr($line->Target,0,strlen($line->Target)-1);					
					else 
						$menuString .= $line->ContentSection;
		
				} else {
						$menuString.=$line->LinkType;
						
				}
				$menuString.='</td><td align="right">';
				
			    $menuString.='<a href="javascript:void(0)" onclick="menulink(\'edit\',\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="removeMenuItem(\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>';
						
				$menuString.='</td></tr></table>';
						
				$menuString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

				}

	

				$menuString .= "</div>";


			
		?>
            
            <script type="text/javascript">
			parent.document.location.href='http://www.wevolt.com/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=design&section=menu';
		</script>
            
            
            <?
			
} else {
		if ($Action == 'edit') {
			$query = "select ml.*,c.SafeFolder, c.HostedUrl from $TargetTable as ml
					  left join projects as c on ml.".$TargetName."=c.ProjectID
					   where ml.EncryptID='$MenuID'";
			$DB->query($query);
			//print $query;
			while ($line = $DB->fetchNextObject()) { 
				$Title = $line->Title;
				$Target = $line->Target;
				$StoryID = $line->StoryID;
				$ComicID = $line->ComicID;
				$WorldID = $line->WorldID;
				$Published = $line->IsPublished;
				$SectionLink = $line->SectionLink;
				$PageLink = $line->PageLink;
				$ButtonImage = $line->ButtonImage;
				$MenuParent = $line->MenuParent;
				$RolloverButtonImage= $line->RolloverButtonImage;
				$SafeFolder = $line->SafeFolder;
				$ComicDir = $line->HostedUrl;
				$Parent = $line->Parent;
				$Url = $line->Url;
				$ContentSection =  $line->ContentSection;
			
				if ($_GET['type'] == "") 
					$LinkType = $line->LinkType;
				 else 
					$LinkType = $_GET['type'];
					
						if (($Url != $ContentSection) && ($LinkType == 'section')) 
					$CustomURL = $Url;
			
			}
		
			
			$ParentOneString = '';
			$query = "select * from $TargetTable where ".$TargetName."='$TargetID' and MenuParent=1 and Parent=0 order by Parent, Position";
			$DB->query($query);
			$NumOneParents = $DB->numRows($query);
			
			$ParentOneString .= '<select name="txtParent1" id="txtParent1"><option value="0"';
			if (($Parent == 0) || ($Parent == '')) 
				$ParentOneString .= ' selected ';
			
			$ParentOneString .= '>None</option>';
			while ($line = $DB->fetchNextObject()) { 
					$ParentOneString .= '<option value="'.$line->EncryptID.'"';
					if ($Parent == $line->EncryptID) 
						$ParentOneString .= ' selected ';
					
					$ParentOneString .= '>'.$line->Title.'</option>';	
			}
			$ParentOneString .='</select>';
			
			
			
			
			
			$contentString = "";
			$query = "select * from pages where published=1 ORDER BY ID ASC ";
			$DB->query($query);
			$contentString = "<select name='txtStatic' style='width:200px;'><OPTION VALUE='0'>Select Page</OPTION>";
			
			while ($line = $DB->fetchNextObject()) { 
					$contentString .= "<OPTION VALUE='".$line->Title."'>".$line->Title."</OPTION>";
			}
			$contentString .= "</select>";
			
			
			$categoryString = "";
			$query = "select * from categories ORDER BY Title ASC ";
			$DB->query($query);
			$categoryString = "<select name='txtCategory' style='width:200px;'><OPTION VALUE='0'>Select Category</OPTION>";
			
			while ($line = $DB->fetchNextObject()) { 
					$categoryString .= "<OPTION VALUE='".$line->ID."'";
					if ($Category == $line->ID) {
						$categoryString .= 'selected ';
					}
					$categoryString .= ">".$line->Title."</OPTION>";
			}
			$categoryString .= "</select>";
			
			$sectionString = "";
			$query = "select * from sections ORDER BY Title ASC ";
			$DB->query($query);
			$sectionString = "<select name='txtSection' style='width:200px;'><OPTION VALUE='0'>Select Section</OPTION>";
			
			while ($line = $DB->fetchNextObject()) { 
				$sectionString .= "<OPTION VALUE='".$line->ID."'";
			
			
				if ($Section == $line->ID) 
					$sectionString .= 'selected ';
				
				$sectionString .= ">".$line->Title."</OPTION>";
			}
			$sectionString .= "</select>";
			
			$newsString = "";
			
			$query = "select * from content where published=1 ORDER BY ID ASC ";
			$DB->query($query);
			$newsString = "<select name='txtContent' style='width:200px;'><OPTION VALUE='0'>Select Content</OPTION>";
			
			while ($line = $DB->fetchNextObject()) { 
					$newsString .= "<OPTION VALUE='".$line->ID."'>".$line->Title."</OPTION>";
			}
			$newsString .= "</select>";
			}

} 

$query = "SELECT * from content_section where ProjectID='".$_SESSION['sessionproject']."'";
$DB->query($query);
$JSDropDown = 'document.menuform.typeSelectBox.options[1] = new Option("--YOUR CONTENT SECTIONS--", "", false, false);';
$Count=0;
	while ($line = $DB->fetchNextObject()) { 
	$Count++;
		$ContentSectionSelect .='<option value="'.strtolower($line->TemplateSection).'" ';
		 if ($Target == strtolower($line->TemplateSection))
	 		$ContentSectionSelect .=' selected';
		$ContentSectionSelect .='>'.$line->Title.'</option>';
		$JSDropDown .= 'document.menuform.typeSelectBox.options['.$Count.'] = new Option("'.$line->Title.'", "'.strtolower($line->TemplateSection).'", false, false);';
	}
	
$DB->close();
?>
  <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
    <LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript">
			function ddSelect(value) {
			document.menuform.typeSelectBox.length = 0;
				if (value == 'section') {
				<? echo $JSDropDown;?>
					document.getElementById("customUrl").style.display = '';
					
					
						
				}  else {
					document.getElementById("customUrl").style.display = 'none';
				
				}
				if (value == 'page') {
					document.menuform.typeSelectBox.options[0] = new Option("First Page", "{FirstPage}", false, false);
					document.menuform.typeSelectBox.options[1] = new Option("Next Page", "{NextPage}", false, false);
					document.menuform.typeSelectBox.options[2] = new Option("Previous Page", "{PrevPage}", false, false);	        document.menuform.typeSelectBox.options[3] = new Option("Last Page", "{LastPage}", false, false);
					}
				
				if (value == 'external') {
					document.menuform.typeSelectBox.options[0] = new Option("Same Page", "_parent", false, false);
					document.menuform.typeSelectBox.options[1] = new Option("Blank Page", "_blank", false, false); 
					
					
				}
				if (value == 'blog') {
					document.menuform.typeSelectBox.options[0] = new Option("Recent Posts", "blog/", false, false);
					document.menuform.typeSelectBox.options[1] = new Option("Archives", "blog/archives/", false, false);
					
				}
				if (value == 'external') {
					document.getElementById("extUrl").style.display = '';
				} else {
					document.getElementById("extUrl").style.display = 'none';
				}
			}
			
			function switch_menu(value) {
				if (value == 1) {
					document.getElementById("ParentOneDiv").style.display = '';
					document.getElementById("ParentTwoDiv").style.display = 'none';
				}
			
			}
			function save_menu() {
			
				document.menuform.submit();
			
			}
		</script>
        <style type="text/css">
		.spacer {
			height:10px;
		}
		.inputspacer {
			height:5px;
		}
		body,html {
			margin:0px;
			padding:0px;	
		}
		</style>
        <form method='post' action='#' name="menuform" id="menuform">
        <center>
       <table><tr><td>
     
        
        <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="284" align="left">
                                Edit a Menu Item
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>  
                        <div class="spacer"></div>
                <table width="310" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="294" align="left">
         <table><tr><td class="grey_text">
         Title: </td>
         <td><input type="text" style="width:150px;"  name="txtTitle" value="<? echo $Title;?>"/></td>
         </tr>
         <tr>
         <td colspan="2" class="grey_text" style="font-size:10px;"><div class="spacer"></div>This title will appear if you don't upload an image.<div style="border-bottom:dotted 1px #bababa;"></div>
<div class="spacer"></div></td></tr>
<tr>
<td class="grey_text">
         Link Type: </td>
         <td><select name="txtLinkType" onChange="ddSelect(this.options[this.selectedIndex].value)">
                <option value="section" <? if (($LinkType  == 'section') || ($LinkType == '')) echo 'selected';?>>Content Section</option>
                <option value="page"<? if ($LinkType  == 'page') echo 'selected';?>>Page</option>
                <option value="external"<? if ($LinkType  == 'external') echo 'selected';?>>URL</option> 
        </select></td>
         </tr>
          <tr>
         <td colspan="2" class="grey_text" style="font-size:10px;"><div class="spacer"></div>Choose from the dropdown whether it's:<br />

- a link to a pre-made section under CONTENT.<br />

- a specific PAGE you have uploaded<br />

- the URL address of a website exterior to WEvolt.<div class="spacer"></div>
 <div style="border-bottom:dotted 1px #bababa;"></div>
<div class="spacer"></div></td></tr>
<tr>
<td class="grey_text" colspan="2">
         Link Target: </td></tr><tr>
         <td class="grey_text" colspan="2"> <select name="txtLink" id='typeSelectBox'>
              <? if (($LinkType  == 'section')|| ($LinkType == '')) {?>
 <option value="" >-- YOUR CONTENT SECTION -- </option>
           <? echo $ContentSectionSelect;?>
                   <? } else if ($LinkType  == 'blog') {?>  
                    <option value="blog/" <? if ($Target == 'blog') echo 'selected';?>>Recent Posts</option>
                 <option value="blog/archives/" <? if ($Target == 'blog/archives') echo 'selected';?>>Archives</option>
                    <? } else if ($LinkType  == 'external') {?>  
                    <option value="_parent" <? if ($Target == '_parent') echo 'selected';?>>Same Window</option>
                 <option value="_blank" <? if ($Target == '_blank') echo 'selected';?>>New Window</option>
                     <? } else if ($LinkType  == 'page') {?>  
                      <option value="{FirstPage}" <? if ($Target == '{FirstPage}') echo 'selected';?>>First Page</option>
                 <option value="{NextPage}" <? if ($Target == '{NextPage}') echo 'selected';?>>Next Page</option>
                  <option value="{PrevPage}" <? if ($Target == '{PrevPage}') echo 'selected';?>>Previous Page</option>
                 <option value="{LastPage}" <? if ($Target == '{LastPage}') echo 'selected';?>>Last Page</option>
                     <? }?>
                      </select>
                      <table><tr><td id="extUrl" class="grey_text" style="display:none;">URL (including http://): <br />
		<input type="text" name="txtUrl" style="width:200px;"  value="<? echo $Url;?>"/></td><td id="customUrl" class="grey_text" style="display:<? if (($LinkType == 'section') || ($LinkType == '')){?> block<? } else {?>block<? } ?>;"></td></tr></table>
       
            </td>
         </tr>
          <tr>
         <td colspan="2" class="grey_text" style="font-size:10px;"><div class="spacer"></div>When they click on this menu button which
content section will they be taken to?
<div class="spacer"></div>
 <div style="border-bottom:dotted 1px #bababa;"></div>
<div class="spacer"></div></td></tr>

<tr>
<td class="grey_text">
       Published: </td>
         <td class="grey_text" ><input type="radio" name="txtPublished" value="1" <? if (($Published == 1) || ($Published == '')) {echo 'checked'; }?> />Yes  <input type="radio" name="txtPublished" value="0" <? if (($Published == 0) && ($Published != '')) {echo 'checked'; }?> />No
         
                      </td>
         </tr>
          <tr>
         <td colspan="2" class="grey_text" style="font-size:10px;"><div class="spacer"></div>Set this to "NO" if you want to create the menu link but don't want people to go there yet.
         <div class="spacer"></div>
         <strong>         Access Control</strong><br />
<select name="txtAccessType" id="txtAccessType">
<option value="public"<? if (($_GET['access'] == '')|| ($SectionArray->AccessType == 'public')) echo ' selected ';?>>Everyone</option>
<option value="fans" <? if ($SectionArray->AccessType == 'fans') echo ' selected ';?>>Fans Only</option>
<option value="superfans" <? if ($SectionArray->AccessType == 'superfans') echo ' selected ';?>>SuperFans Only</option>
</select>
</td></tr>


         </table>
         

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>          
       </td>
       <td>  <div id="savealert"></div> 
              <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="left">
MENU IMAGE:<br />
<? if ($ButtonImage != '') {?> 

	<? if ($ThemeID == '') {?>
        <img src='/<? echo $TargetFolder;?>/<? echo $ComicDirectory;?>/images/<? echo $ButtonImage; ?>'  name="buttonimage" id="buttonimage"/>
    <? } else {?>
        <img src='/themes/<? echo $ThemeID;?>/images/<? echo $ButtonImage; ?>'  name="buttonimage" id="buttonimage"/>
    <? }?>

<? } else {?>
    <img src='/<? echo $_SESSION['pfdirectory'];?>/images/blank2.gif'  name="buttonimage" id="buttonimage"/>
<? }?><br/>

<? if ($ButtonImage != '') {?> <input type='checkbox' name='txtRemoveButton' value='1' />Remove Image<? }?><br />

<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?s=menu&a=button&l=v" style="width:284px;height:50px;" frameborder="0" scrolling="no" id='imageupload' name='imageupload'></iframe>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>   
                                <div class="spacer"></div>
                                   <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="left">
ROLLOVER IMAGE:<br />
<? if ($RolloverButtonImage != '') {?> 
	<? if ($ThemeID == '') {?>
    <img src='/<? echo $TargetFolder;?>/<? echo $ComicDirectory;?>/images/<? echo $RolloverButtonImage; ?>'  name="rollimage" id="rollimage"/><br/>
    
    <? } else {?>
    <img src='/themes/<? echo $ThemeID;?>/images/<? echo $RolloverButtonImage; ?>'  name="rollimage" id="rollimage"/>
    <? }?>
<? } else {?>
<img src='/pf_16_core/images/blank2.gif'  name="rollimage" id="rollimage"/><br/>
<? }?>
<? if ($RolloverButtonImage != '') {?> <input type='checkbox' name='txtRemoveRollover' value='1' />Remove Rollover<? }?><br />


<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?s=menu&a=rollover&l=v" style="width:284px;height:50px;" frameborder="0" scrolling="no" id='rollupload' name='rollupload'></iframe>
    </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>                              
        <div align="center">
                                  <div class="spacer"></div> 
<img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_save_box.jpg" onclick="save_menu();" class="navbuttons" />     <img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_cancel_box.jpg" onclick="parent.$.modal().close();" class="navbuttons"/></div>   </td>
       </tr>
       </table>
                        

<input type="hidden" name="txtType" value="<? echo $LinkType;?>" />
<input type="hidden" name="txtButtonFilename" id="txtButtonFilename" />
<input type="hidden" name="txtRollFilename" id="txtRollFilename" />
<input type="hidden" name="txtMenu" value="<? echo $MenuID;?>" />
<input type="hidden" name="txtComic" value="<? echo $_GET['comic'];?>" />
<input type="hidden" name="txtStory" value="<? echo $_GET['story'];?>" />
<input type="hidden" name="action" value="<? echo $_GET['a'];?>" />
<input type="hidden" name="save" id="save" value="1" />
<input type="hidden" value="" name="txtSafeFolder" id='txtSafeFolder'/>
<input type="hidden" value="" name="txtComicDirectory" id='txtComicDirectory'/>
<input type="hidden" value="<? echo $ThemeID;?>" name="txtTheme" id='txtTheme'/>
</form>
</center>
<script type="text/javascript">	
document.getElementById("txtSafeFolder").value = parent.document.getElementById("txtSafeFolder").value;
document.getElementById("txtComicDirectory").value = parent.document.getElementById("txtUrl").value;
</script>