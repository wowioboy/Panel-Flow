<? 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/module_arrays_inc.php');

$comicsDB = new DB();
$Column1 = $_GET['1'];
$Column2 = $_GET['2'];
$ProjectID = $_SESSION['sessionproject'];
	//print 'SESSION PROJECT = ' . $_SESSION['sessionproject'];
			$TargetName = 'ComicID';	
			$TargetID = $ProjectID;	
			if ($_POST['a'] == 'save') {
		
			$LeftColumnOrder = explode(',',$_POST['LeftColumnOrder']);
			$RightColumnOrder = explode(',',$_POST['RightColumnOrder']); 
			$InactiveColumnOrder = explode(',',$_POST['InactiveColumnOrder']);
			$AssignedMods = array();
			

				$Count=1;
				foreach ($LeftColumnOrder as $module) {
					$query ="UPDATE pf_modules set ReaderPosition='$Count', ReaderPlacement='left' where ".$TargetName."='$TargetID' and EncryptID='".$module."'";
					$comicsDB->execute($query);
					$AssignedMods[] = $module;
					$Count++;
				}
				 
				//$Count=1;
				//foreach ($RightColumnOrder as $module) {
					//$query ="UPDATE pf_modules set ReaderPosition='$Count', ReaderPlacement='right' where ".$TargetName."='$TargetID' and EncryptID='".$module."'";
					//$comicsDB->execute($query);
					//$AssignedMods[] = $module;
					//$Count++;
				//}
			
				$query ="SELECT * from pf_modules where ".$TargetName."='$TargetID' and ReaderMod=1";
				$comicsDB->query($query);
				while ($line = $comicsDB->fetchNextObject()) {
					if (!in_array($line->EncryptID,$AssignedMods)) {
						$query ="UPDATE pf_modules set ReaderPosition='', ReaderPlacement='' where ".$TargetName."='$TargetID' and EncryptID='".$line->EncryptID."'";
						$comicsDB->execute($query);
					}
				}

			
			
			 
	}
	
			$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and ReaderPlacement ='left' and ReaderMod=1 order by ReaderPosition";
		//	print $query."<br/>";
			$comicsDB->query($query); 
			$LeftColumModuleOrder = array();
			$RightColumModuleOrder = array();
			$InactiveColumnOrder = array();
		//	if ($_SESSION['username'] == 'matteblack')
					//print $query;
			$LeftColumnDiv = '<div id="left" class="section"><span class="handle">COLUMN 1</span>';
			while ($line = $comicsDB->fetchNextObject()) {
				if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					$Class='homemod';
				else 
					$Class='homemod';
					if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') || (($_SESSION['IsPro'] != 1) && ((substr($line->ModuleCode,0,6) != 'custom')))) {
				        $LeftColumnDiv .= '<div id="item_'.$line->EncryptID.'" class="'.$Class.'">'.$line->Title;
						
							$LeftColumnDiv .= '&nbsp;&nbsp;[<a href="#" onclick="parent.module_wizard(\''.$line->ModuleCode.'\',\''.$line->EncryptID.'\',\'1\');return false;">EDIT</a>]';
						
						
			
						$LeftColumnDiv .= '</div>';
						if ($LeftColumnOrder == '')
							$LeftColumnOrder = $line->EncryptID;
						else 
							$LeftColumnOrder .= ','.$line->EncryptID;
					
						//$AvailableModuleArray = remove_element($AvailableModuleArray, $line->ModuleCode);
					}	
			} 
			$LeftColumnDiv .= '</div>';
			
			$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and ReaderPlacement ='right' and ReaderMod=1 order by ReaderPosition";
			$comicsDB->query($query);
			$RightColumnDiv = '<div id="right" class="section"><span class="handle">COLUMN 2</span>';
			while ($line = $comicsDB->fetchNextObject()) {
			if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					$Class='homemod';
				else 
					$Class='homemod';
					if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') || (($_SESSION['IsPro'] != 1) && ((substr($line->ModuleCode,0,6) != 'custom')))) {
				$RightColumnDiv .= '<div id="item_'.$line->EncryptID.'" class="'.$Class.'">'.$line->Title;
				
							$RightColumnDiv .= '&nbsp;&nbsp;[<a href="#" onclick="parent.module_wizard(\''.$line->ModuleCode.'\',\''.$line->EncryptID.'\',\'1\');return false;">EDIT</a>]';
						
					//if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					//$RightColumnDiv .= '&nbsp;&nbsp;[<a href="#" onclick="parent.edit_module(\''.$line->ModuleCode.'\',\''.$TargetID.'\',\'home\',\'right\');return false;">EDIT</a>]';
				
				
				$RightColumnDiv .= '</div>';
				if ($RightColumnOrder == '')
					$RightColumnOrder = $line->EncryptID;
				else 
					$RightColumnOrder .= ','.$line->EncryptID;
					//$AvailableModuleArray = remove_element($AvailableModuleArray, $line->ModuleCode);	
					}
			}
		
			$RightColumnDiv .= '</div>';
		
			
			$InactiveModules = '<div id="inactive" class="avail"><span class="handle">AVAILABLE MODULES</span></br>';
			$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and ReaderPlacement ='' and ReaderMod=1 order by Title";
			$comicsDB->query($query);
			//print $query;
			while ($line = $comicsDB->fetchNextObject()) {
				if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') || (($_SESSION['IsPro'] != 1) && ((substr($line->ModuleCode,0,6) != 'custom')))) {
				$InactiveModules .= '<div id="item_'.$line->EncryptID.'" class="homemod">'.$line->Title;
			
				
						$InactiveModules .=  '&nbsp;&nbsp;[<a href="#" onclick="parent.module_wizard(\''.$line->ModuleCode.'\',\''.$line->EncryptID.'\',\'1\');return false;">EDIT</a>]'; 
				
			
				
				$InactiveModules .= '</div>';
				if ($InactiveColumnOrder == '')
					$InactiveColumnOrder = $line->EncryptID;
				else 
					$InactiveColumnOrder .= ','.$line->EncryptID;
				}
			}
		
			$InactiveModules .= '</div>';


	$comicsDB->close();
		
		/*
		if ($_POST['a'] == 'save') {
		
			$LeftColumnOrder = explode(',',$_POST['LeftColumnOrder']);
			$InactiveColumnOrder = explode(',',$_POST['InactiveColumnOrder']);
			$Count = 1;
			foreach ($LeftColumnOrder as $module) {
				$ModulePublished = $_POST[$module];
				$CustomVar1 = $_POST[$module.'Var1'];
				$HtmlCode = mysql_real_escape_string($_POST[$module.'HTML']);
				$query = "SELECT ID from pf_modules where ModuleCode='$module' and ComicID ='".$ProjectID."' and ReaderMod=1";	
				$comicsDB->query($query);
			//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					foreach($AvailableModuleArray as $mod) {
							if ($mod[0] == $module) {
								$Title = $mod[1];
								break;
							}
					}
					$query = "INSERT into pf_modules (Title, ReaderPosition,IsPublished,ReaderPlacement,ModuleCode,".$TargetName.",Homepage) values ('$Title','$Count',1,'left','$module','$TargetID',0)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished=1, Placement='left' where ModuleCode='$module' and ".$TargetName."='$TargetID' and Homepage=0";
				$comicsDB->query($query);
				//print $query."<br/>";
				$AvailableModuleArray = remove_element($AvailableModuleArray, $module);	
				}
				
				$Count++;
				//print $query."<br/>";
			}
			
			/*
			$Count = 1;
			foreach ($RightColumnOrder as $module) {
				$ModulePublished = $_POST[$module];
				//$CustomVar1 = $_POST[$module.'Var1'];
				//$HtmlCode = mysql_real_escape_string($_POST[$module.'HTML']);
				//$CustomVar1 = $_POST[$module.'Var1'];
			//	$HtmlCode = mysql_real_escape_string($_POST[$module.'HTML']);
				$query = "SELECT ID from pf_modules where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";	
				$comicsDB->query($query);
				//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					foreach($AvailableModuleArray as $mod) {
							if ($mod[0] == $module) {
								$Title = $mod[1];
								break;
							}
					}
					$query = "INSERT into pf_modules (Title, Position,IsPublished,Placement,ModuleCode,".$TargetName.",Homepage) values ('$Title', '$Count',1,'right','$module','$TargetID',1)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished=1, Placement='right' where ModuleCode='$module' and ".$TargetName." ='".$TargetID."' and Homepage=1";
				$comicsDB->query($query);
				//print $query."<br/>";
				}
				$Count++;
				$AvailableModuleArray = remove_element($AvailableModuleArray, $module);	
	
			}
			
			
			foreach ($AvailableModuleArray as $module) {
			
				$query = "SELECT ID from pf_modules where ModuleCode='".$module[0]."' and ".$TargetName." ='".$TargetID."' and Homepage=0";	
				$comicsDB->query($query);
				//print $query."<br/>";
				$Found = $comicsDB->numRows();
				if ($Found == 0) {
					$query = "INSERT into pf_modules (Title,Position,IsPublished,Placement,ModuleCode,".$TargetName.",Homepage) values ('".$module[1]."','$Count',0,'','".$module[0]."','$TargetID',0)";
				$comicsDB->query($query);
				//print $query."<br/>";
				
				} else {
				$query = "UPDATE pf_modules set Position='$Count', IsPublished='1', Placement='' where ModuleCode='".$module[0]."' and ".$TargetName." ='".$TargetID."' and Homepage=0";
				$comicsDB->query($query);
				//print $query."<br/>";
				}

	//print $query."<br/>";
			}
			
			
			 
	}
	
			$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='left' and Homepage=0 order by Position";
		//	print $query."<br/>";
			$comicsDB->query($query); 
			$LeftColumModuleOrder = array();
			$RightColumModuleOrder = array();
			$InactiveColumnOrder = array();
			
			$LeftColumnDiv = '<div id="left" class="section"><span class="handle" align="center">UNDER READER PAGE</span>';
			while ($line = $comicsDB->fetchNextObject()) {
				if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					$Class='homemod';
				else 
					$Class='homemod';
					
					if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') &&($line->ModuleCode !='custommod')) {
				        $LeftColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="'.$Class.'">'.$line->Title;
						if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
							$LeftColumnDiv .= '&nbsp;&nbsp;[<a href="#" onclick="parent.edit_module(\''.$line->ModuleCode.'\',\''.$TargetID.'\',\'reader\',\'left\');return false;">EDIT</a>]';
			
						$LeftColumnDiv .= '</div>';
						if ($LeftColumnOrder == '')
							$LeftColumnOrder = $line->ModuleCode;
						else 
							$LeftColumnOrder .= ','.$line->ModuleCode;
					
						$AvailableModuleArray = remove_element($AvailableModuleArray, $line->ModuleCode);
					}	
			} 
			$LeftColumnDiv .= '</div>';
			
			$query = "SELECT * from pf_modules where ".$TargetName." ='".$TargetID."' and Placement ='right' and Homepage=0 order by Position";
			$comicsDB->query($query);
			$RightColumnDiv = '<div id="right" class="section"><span class="handle">COLUMN 2</span>';
			while ($line = $comicsDB->fetchNextObject()) {
			if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					$Class='homemod';
				else 
					$Class='homemod';
					if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') &&($line->ModuleCode !='custommod')) {
				$RightColumnDiv .= '<div id="item_'.$line->ModuleCode.'" class="'.$Class.'">'.$line->Title;
					if (($line->ModuleCode == 'twitter')||(substr($line->ModuleCode,0,6) == 'custom'))
					$RightColumnDiv .= '&nbsp;&nbsp;[<a href="#" onclick="parent.edit_module(\''.$line->ModuleCode.'\',\''.$TargetID.'\',\'reader\',\'right\');return false;">EDIT</a>]';
				
				
				$RightColumnDiv .= '</div>';
				if ($RightColumnOrder == '')
					$RightColumnOrder = $line->ModuleCode;
				else 
					$RightColumnOrder .= ','.$line->ModuleCode;
					$AvailableModuleArray = remove_element($AvailableModuleArray, $line->ModuleCode);	
					}
			}
		
			$RightColumnDiv .= '</div>';
		
			
			$InactiveModules = '<div id="inactive" class="avail"><span class="handle">AVALABLE MODULES</span></br>';
			foreach($AvailableModuleArray as $module) {
				//$query = "SELECT Title from pf_modules where ".$TargetName." ='$TargetID' and ModuleCode='$module' and Homepage=1";
				$Modtitle = $module[1];
				$comicsDB->queryUniqueValue($query);
				if (($line->ModuleCode != 'menuone')&&($line->ModuleCode != 'menutwo') &&($line->ModuleCode !='custommod')) {
				$InactiveModules .= '<div id="item_'.$module[0].'" class="homemod">'.$Modtitle;

				if (($module[0] == 'twitter')||(substr($module[0],0,6) == 'custom'))
					$InactiveModules .= '&nbsp;&nbsp;[<a href="#" onclick="parent.edit_module(\''.$module[0].'\',\''.$TargetID.'\',\'reader\',\'\');return false;">EDIT</a>]';
				
				$InactiveModules .= '</div>';
				if ($InactiveColumnOrder == '')
					$InactiveColumnOrder = $module[0];
				else 
					$InactiveColumnOrder .= ','.$module[0];
				}
			}
		
			$InactiveModules .= '</div>';


	$comicsDB->close();
	*/
	
	
?>
<LINK href="/<? echo $PFDIRECTORY;?>/css/cms_css.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="/pf_16_core/scripts/prototype.js"></script>
<script language="JavaScript" src="/pf_16_core/scripts/scriptaculous.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">

div.section span {
		cursor: move;
		

	
	}
	div.section  {
	
		background-color:#CCCCCC;
		padding:5px;
		border:#0066FF 2px dashed;
	
	}
	div.avail  {
	
		background-color: #FFCC00;
		padding:5px;
		border:#000000 1px solid;
	
	}
	
div.homemod {
		margin: 3px 0px;
		width:100%;
		font-size:10px;
		color:#FFFFFF;
		font-weight:600;
		
	height:20px;
		text-align:center;
		cursor: move;
		padding-top:5px;
		border:#000000 1px solid;
		background-color:#144e92;

		
	}
div.homemod a {
font-size:10px;
color:#FFFFFF;
text-decoration:underline;
	font-weight:normal;

		
	}	
div.homemod a:link {
font-size:10px;
color:#FFFFFF;
text-decoration:underline;
font-weight:normal;
		
	}		
	.handle {
	color: #0066FF;
	
	}
	h1 {
		margin-bottom: 0;
		font-size: 14px;
	}

</style>

<script type="text/javascript">
sections = ['inactive','left','right'];
	function createLineItemSortables() {
		for(var i = 0; i < sections.length; i++) {
			Sortable.create(sections[i],{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
		}
	}
	function destroyLineItemSortables() {
		for(var i = 0; i < sections.length; i++) {
			Sortable.destroy(sections[i]);
		}
	}
	function createGroupSortable() {
		Sortable.create('page',{tag:'div',only:'section',handle:'handle'});
	}
	/*
	Debug Functions for checking the group and item order
	*/
	function getGroupOrder() {
		var sections = document.getElementsByClassName('section');
		var alerttext = '';

		sections.each(function(section) {
		
			var sectionID = section.id;
			var order = Sortable.serialize(sectionID);
			//alert('ID = ' + sectionID);
			if (sectionID == 'inactive') {
				document.getElementById("InactiveColumnOrder").value = Sortable.sequence(section);
				//alert(document.getElementById("InactiveColumnOrder").value);
			}
			if (sectionID == 'left') {
				document.getElementById("LeftColumnOrder").value = Sortable.sequence(section);
				//alert(document.getElementById("LeftColumnOrder").value);
			}
			//if (sectionID == 'right') {
				//document.getElementById("RightColumnOrder").value = Sortable.sequence(section);
			//	alert(document.getElementById("RightColumnOrder").value);
			//}
			
		});
		document.SaveModules.submit();
		return false;
	}
	</script>
    
    <form method="post" action="#" name="SaveModules" id="SaveModules"> 
    <div align="center"> 
<div id="page">

<div class="pagetitle">You can drag and drop modules between columns to re-arrange the ordering of the modules. <br />

You must click -><input type="button" onClick="getGroupOrder()" value="Save Order" style="border:#0066FF 1px solid; background-color:#FFCC00; cursor:pointer;"><- to save your changes.
</div>
<input type="hidden" value="<? echo $LeftColumnOrder;?>" name="LeftColumnOrder" id="LeftColumnOrder" />
<input type="hidden" value="<? echo $InactiveColumnOrder;?>" name="InactiveColumnOrder" id="InactiveColumnOrder" />
<input type="hidden" value="<? echo $RightColumnOrder;?>" name="RightColumnOrder" id="RightColumnOrder" />
<input type="hidden" value="<? echo $TopRowOrder;?>" name="TopRowOrder" id="TopRowOrder" />
<input type="hidden" value="<? echo $BottomRowOrder;?>" name="BottomRowOrder" id="BottomRowOrder" />
<input type="hidden" value="save" name="a" id="a" />


<div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0" width="99%"><tr>
<td valign="top" width="200">
<div align="center" style="font-size:14px;"><a onclick="parent.module_wizard('','','');return false;" href="#">CREATE NEW MODULE</a></div>
<div align="center" style="font-size:14px;"><a onclick="parent.module_wizard('','','1');return false;" href="#">EDIT MODULES</a></div>
<div class="spacer"></div>

<? echo $InactiveModules;?>
</td><td valign="top" style="padding-left:10px;" align="center">

<table cellpadding="0" cellspacing="0" border="0" width="<? 
$HomePageWidth = 400;
echo $HomePageWidth;?>">
<tr><td valign="top" style="padding-right:10px;" width="50%">
<? echo $LeftColumnDiv;?></td>
<? /*
<td width="10"></td>
<td valign="top" width="50%"><? echo $RightColumnDiv;?></td><? ?*/?>
</tr>
</table>

</td></tr></table>

</div>
<script type="text/javascript">
	// <![CDATA[
	Sortable.create('left',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	//Sortable.create('right',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	Sortable.create('inactive',{tag:'div',dropOnEmpty: true, containment: sections,only:'homemod'});
	// ]]>
 </script>
</div>
</div>
    
    </form>