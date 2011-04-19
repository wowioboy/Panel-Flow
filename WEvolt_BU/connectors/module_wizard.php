<?php 

include  $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';


$ReturnLink = $_GET['returnlink'];
$RePost = 0;
$UserID = $_SESSION['userid'];

$ModuleCode = $_GET['module'];
if ($ModuleCode == '')
	$ModuleCode = $_POST['ModuleCode'];

if ($ModuleCode == '')
	$ModuleCode = $_REQUEST['ModuleCode'];
	
$ProjectID = $_SESSION['sessionproject'];

if ($ProjectID == '' )
	$ProjectID = $_POST['ProjectID'];

//if ($ProjectID == '')
	//$ProjectID = '8bf1211f17a';	

$ModuleID = $_REQUEST['mid'];	
$Placement = $_GET['placement'];
$ModuleType = $_GET['type'];

$HomeModule = $_POST['HomeModule'];
$UserHome = $_POST['UserHome'];	
$ReaderModule = $_POST['ReaderMod'];	

if ($ModuleType == '' )
	$ModuleType = $_POST['ModuleType'];
if ($ModuleType == 'home') 
	$Homepage = 1;
else 
	$Homepage = 0;	
$CloseWindow = 0;
$UserID = $_SESSION['userid'];
$query = "SELECT p.userid, p.CreatorID, p.SafeFolder, p.title, u.username,
		  (SELECT u2.username from users as u2 where u2.encryptid=p.CreatorID) as CreatorName 
		  from projects as p 
		  join users as u on p.userid=u.encryptid
		  where p.ProjectID='$ProjectID'"; 
$ProjectArray = $InitDB->queryUniqueObject($query);
$OwnerID = $ProjectArray->userid;
$CreatorID = $ProjectArray->CreatorID;
$OwnerUsername = $ProjectArray->username;
$ProjectTitle = $ProjectArray->title; 
$SafeFolder = $ProjectArray->SafeFolder; 
$CreatorName = $ProjectArray->CreatorName; 
if (($UserID == $CreatorID) || ($UserID == $OwnerID))
	$Auth = 1;
else 
	//$Auth = 0;
		
if (($_SESSION['userid'] == '') || ($Auth == 0))
	$CloseWindow = 1;
//print_r($_POST);
if (($_POST['save'] == 1) && ($_GET['step'] != 1) &&($Auth == 1)) { 
		$CustomVar1 = mysql_real_escape_string($_POST['CustomVar1']);
		$CustomVar2 = mysql_real_escape_string($_POST['CustomVar2']);
		$CustomVar3 = mysql_real_escape_string($_POST['CustomVar3']);
		$CustomVar4 = mysql_real_escape_string($_POST['CustomVar4']);
		$CustomVar5 = mysql_real_escape_string($_POST['CustomVar5']);
		$text_align = mysql_real_escape_string($_POST['text_align']);
		$HTMLCode = mysql_real_escape_string($_POST['HTMLCode']);
		if ($_SESSION['IsPro'] != 1) {
			$HTMLCode = preg_replace("/<script[^>]+\>/i", "", $HTMLCode);
			$HTMLCode = preg_replace("/<iframe[^>]+\>/i", "", $HTMLCode);
			$HTMLCode = preg_replace("/<object[^>]+\>/i", "", $HTMLCode);
			$HTMLCode = preg_replace("/<embed[^>]+\>/i", "", $HTMLCode);	
		}
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$HomeModule = $_POST['HomeModule'];
		$UserHome = $_POST['UserHome'];	
		$ReaderModule = $_POST['ReaderMod'];
		
		if ($ReaderModule == '')
			$ReaderModule = 0;
				
		if ($UserHome == '')
			$UserHome = 0;
		if ($HomeModule == '')
			$HomeModule = 0;	
			
		if ($_GET['step'] == 'save') {
		$query = "UPDATE pf_modules set Title='$Title', text_align='$text_align', CustomVar1='$CustomVar1', CustomVar2='$CustomVar2',CustomVar3='$CustomVar3', CustomVar4='$CustomVar4',CustomVar5='$CustomVar5',HTMLCode='$HTMLCode',Homepage='$HomeModule',ReaderMod='$ReaderModule', text_align='$text_align', UserHome='$UserHome' where ModuleCode='$ModuleCode' and ComicID ='$ProjectID' and EncryptID='$ModuleID'";	
		
		//print $query.'<br/>';
		$InitDB->execute($query);
		$CloseWindow = 1;
		} else if ($_GET['step'] == 'finish') {
			$query = "INSERT into pf_modules (Title, ModuleCode, ComicID, IsPublished, Homepage, HTMLCode, CustomVar1, CustomVar2, CustomVar3, CustomVar4,CustomVar5,UserID, ReaderMod, UserHome,text_align) values ('$Title', '$ModuleCode', '$ProjectID', 1, '$HomeModule', '$HTMLCode', '$CustomVar1', '$CustomVar2', '$CustomVar3', '$CustomVar4', '$CustomVar5', '".$_SESSION['userid']."', '$ReaderModule', '$UserHome','$text_align')";
			$InitDB->execute($query);
			//print $query.'<br/>';
			
			$query ="SELECT ID from pf_modules WHERE ComicID='$ProjectID' and ModuleCode='$ModuleCode' and EncryptID is NULL";
					$MID = $InitDB->queryUniqueValue($query);
					//print $query.'<br/>';
					$Encryptid = substr(md5($MID), 0, 15).dechex($MID);
					$IdClear = 0;
					$Inc = 5;
					while ($IdClear == 0) {
									$query = "SELECT count(*) from pf_modules where EncryptID='$Encryptid'";
									$Found = $InitDB->queryUniqueValue($query);
									$output .= $query.'<br/>';
									if ($Found == 1) {
										$Encryptid = substr(md5(($MID+$Inc)), 0, 15).dechex($MID+$Inc);
									} else {
										$query = "UPDATE pf_modules SET EncryptID='$Encryptid' WHERE ID='$MID'";
										$InitDB->execute($query);
									//print $query.'<br/>';
										$output .= $query.'<br/>';
										$IdClear = 1;
									}
									$Inc++;
					}
					$CloseWindow = 1;
		}
		
}
if ($CloseWindow == 0) {
	 //print 'MODULE CODE = ' .$ModuleCode;
		if (($ModuleCode == '') || ($_GET['step'] == 1)) {
			$query = "SELECT * from pf_module_types where active=1 order by title";
			$InitDB->query($query);
			$AvailableModuleArray = array();
			while ($module = $InitDB->fetchNextObject()) {
					$AvailableModuleArray[] = array($module->module_code,$module->title,$module->module_vars);
			}
		} else {
			$query = "SELECT * from pf_module_types where module_code='$ModuleCode'";
			$ModuleStuff = $InitDB->queryUniqueObject($query);
			
		}
		
		
		if (($_GET['edit'] == 1) && ($ModuleCode != '')) {
			$query =  "SELECT *  from pf_modules where ModuleCode='$ModuleCode' and ComicID ='$ProjectID' and EncryptID='$ModuleID'";
			$ModuleArray = $InitDB->queryUniqueObject($query);
			
			if ($_POST['HomeModule'] == '')
				$HomeModule = $ModuleArray->Homepage;
			if ($_POST['UserHome'] == '')
				$UserHome = $ModuleArray->UserHome;
			if ($_POST['ReaderMod'] == '')
				$ReaderMod = $ModuleArray->ReaderMod;
			
		
			$Title = $ModuleArray->Title;
			/*if ($ModuleArray->ID == '') {
				foreach($AvailableModuleArray as $mod) {
						if ($mod[0] == $ModuleCode) {
							$Title = $mod[1];
							break;
						}
				}
				$query = "INSERT into pf_modules (Title, Position,IsPublished,Placement,ModuleCode,ComicID,Homepage) values ('$Title','10',1,'$Placement','$ModuleCode','$ProjectID','$Homepage')";
				$InitDB->execute($query);
				
			}*/
	
			$Var1 = false;
			$Var2 = false;
			$Var3 = false;
			$Var4 = false;
			$Html = false;
			$Var1Message='';
			$Var2Message='';
			$Var2Message='';
			
			if ($ModuleCode == 'twitter') {
				$Var1 = true;
				$Var1Message = 'Enter your a twitter username';
				$Var2 = true;
				$Var2Message = 'Enter number of tweets to show';
				$Var3 = true;
				$Var3Message = 'Show Follow Link';
				$Var3Input .= '<input type="radio" name="CustomVar3" value="1"';
				if (($ModuleArray->CustomVar3 == 1) || ($ModuleArray->CustomVar3 == ''))
					$Var3Input .= 'checked';
				$Var3Input .= '> Yes&nbsp;&nbsp;';
				$Var3Input .= '<input type="radio" name="CustomVar3" value="0"';
				if ($ModuleArray->CustomVar3 == 0)
					$Var3Input .= 'checked';
				$Var3Input .= '> No';
			}
			
			if (substr($ModuleCode,0,6) == 'custom') {
				$Html = true;
				$HTMLMessage = 'Enter plain text or HTML code to create your own module';
			}
			
		} else if (($_GET['edit'] == 1) && ($ModuleCode == '')) {
				$query = "SELECT * from pf_modules where ComicID='$ProjectID' order by Title";
				$InitDB->query($query);
				$ModuleDropDown = '<select name="module_select" onchange="select_module(this.options[this.selectedIndex].value);">';
				while ($line = $InitDB->fetchNextObject()) {
					$ModuleDropDown .='<option value="'.$line->ModuleCode.'-'.$line->EncryptID.'">'.$line->Title.'</option>';
				}
				$ModuleDropDown .= '</select>';
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<script type="text/javascript">
function submit_form(step) {
	document.modform.action = '/connectors/module_wizard.php?step='+step;
	document.modform.submit();
}
function select_module(value) {
	var namearray = value.split('-');
	
	document.location.href = '/connectors/module_wizard.php?edit=1&mid='+namearray[1]+'&module='+namearray[0];
	//document.modform.submit();
}
</script>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Edit Module</title>
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
 <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">

</head>
<body>
<style type="text/css">
body,html {
margin:0px;
padding:0px;

}

</style>
<div class="wizard_wrapper" align="center" style="height:500px; width:700px;">
<div class="spacer"></div>
<div align="center">
<img src="http://www.wevolt.com/images/edit_modules.png" />
<div class="spacer"></div>

<table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="484" align="center">
                                       


<? if ($CloseWindow == 1) {?>
<script type="text/javascript">

<? if ($_GET['step'] == 'save') {?>
parent.$.modal().close();
<? } else {?>
if (window.parent.document.getElementById("ReUrl") != null)
	window.parent.document.location.href=window.parent.document.getElementById("ReUrl").value;
parent.$.modal().close();
<? }?>
//document.location.href=document.getElementById("redirurl").value;
//parent.window.document.SaveModules.submit();
</script>
 <? } else {?>
 

<form name="modform" id="modform" method="post" action="#">

<?
  
if ((($ModuleCode == '') || ($_GET['step'] == 1)) &&($_REQUEST['edit'] != 1)) {?>
What type of Module do you want to create? <div class="spacer"></div>
<select name="ModuleCode">
<? foreach ($AvailableModuleArray as $module) {
			echo '<option value="'.$module[0].'"';
			if ($module[0] == $ModuleCode)
				echo 'selected';
			echo '>'.$module[1].'</option>';	

	}?>

</select>
 
<? } 

if (($ModuleCode == '') &&($_REQUEST['edit'] == 1)) {
	
echo 'Select which module you would like to edit';
echo $ModuleDropDown;	
}

if (($ModuleCode != '') && ($_GET['step'] != 1)) {
	$ModVars = explode(',',$ModuleStuff->module_vars);
	echo 'Enter a title for module<br/>';
	?><input type="text" id="txtTitle" name="txtTitle" value="<? if ($_POST['txtTitle'] != '') echo $_POST['txtTitle']; else if ($ModuleArray->Title != '') echo $ModuleArray->Title; else echo $ModuleStuff->title;?>" /><div class="spacer"></div>
	<? echo 'Enter a alignment, leave alone for default<br/>';
	?>
    <div align="center" style="padding-left:100px;">
    <select id="text_align" name="text_align">
    <option value="default" <? if ((($_POST['text_align'] == '') && ($ModuleArray->text_align == '') && ($ModuleStuff->text_align == '')) || (($_POST['text_align'] == 'default')||(($ModuleArray->text_align == 'default')&&($_POST['text_align'] == '')))) echo 'selected';?>>Default (defaults to module box alignment)</option>
	<option value="center" <? if (($_POST['text_align'] == 'center') || (($ModuleArray->text_align == 'center')&&($_POST['text_align'] == ''))|| (($ModuleStuff->text_align == 'center')&&($_POST['text_align'] == ''))) echo 'selected';?>>Center</option>	
   <option value="right" <? if (($_POST['text_align'] == 'right') || (($ModuleArray->text_align == 'right')&&($_POST['text_align'] == ''))|| (($ModuleStuff->text_align == 'right')&&($_POST['text_align'] == ''))) echo 'selected';?>>Right</option>	
     <option value="left" <? if (($_POST['text_align'] == 'left') || (($ModuleArray->text_align == 'left')&&($_POST['text_align'] == ''))|| (($ModuleStuff->text_align == 'left')&&($_POST['text_align'] == ''))) echo 'selected';?>>Left</option>	
     </select>
     </div>
	<div align="left" style="padding-left:100px;"> <div class="spacer"></div>
    Available on:    
	<input type="checkbox" name="HomeModule" value="1" <? if (($HomeModule == 1)||(($HomeModule == '')&&($_REQUEST['edit'] != 1))) echo ' checked ';?>/>Project Home&nbsp;
	<? /*<input type="checkbox" name="UserHome" value="1" <? if ($UserHome == 1) echo ' checked ';?>/>Show on Creator's WEvolt Homepage<br /><? */?>
	<input type="checkbox" name="ReaderMod" value="1" <? if (($ReaderMod == 1) ||(($ReaderMod == '')&&($_REQUEST['edit'] != 1)))echo ' checked ';?>/>Page Reader<div class="spacer"></div>
	</div>
	<?
		//print_r($ModuleStuff);
		if ($ModVars[0] == '') {
			echo 'No further information is needed, just hit SAVE!';
			
			
		} else {
			foreach($ModVars as $variable) {
				
					$VariableArray = explode('||',$variable);
					$VarName = explode('-',$VariableArray[0]);  
					
					
					echo $VariableArray[1].'<br/>';
					
					if ($ModuleCode != 'wowio'){
						if (($VariableArray[3] == '') && ($VarName[0] == 'CustomVar1'))
							$Default = $SafeFolder; 
						else if ($VariableArray[3] == 'user')
							$Default = $CreatorName;
						else if ($VariableArray[3] != 'blank')
							$Default =  $VariableArray[3];
						else if ($VariableArray[3] == 'blank')
							$Default =  '';
					}
					if ($_GET['edit'] == 1) {
						if ($VarName[0] == 'CustomVar1')
							$Default = $ModuleArray->CustomVar1;
						else if ($VarName[0] == 'CustomVar2')
							$Default = $ModuleArray->CustomVar2;
						else if ($VarName[0] == 'CustomVar3')
							$Default = $ModuleArray->CustomVar3;
						else if ($VarName[0] == 'CustomVar4')
							$Default = $ModuleArray->CustomVar4;
						else if ($VarName[0] == 'CustomVar5')
							$Default = $ModuleArray->CustomVar5;
									
					}
					
						
					if ($VariableArray[2] == 'text') {
						echo '<input type="text" name="'.$VarName[0].'" id="'.$VarName[0].'" value="'.$Default.'"><div class="spacer"></div>';
					} else if ($VariableArray[2] == 'radio') {
						$ValueArray = explode('-',$VariableArray[3]); 
						$Value1 = $ValueArray[0];
						$Value2 = $ValueArray[1];
						echo '<input type="radio" name="'.$VarName[0].'" id="'.$VarName[0].'" value="'.$Value1.'"';
						
						if ((($_GET['edit'] == 1) && ($Default == $Value1)) || ($_GET['edit'] != 1))
							echo 'checked';
							
						echo '>&nbsp;Yes&nbsp;';
						
						echo '<input type="radio" name="'.$VarName[0].'" id="'.$VarName[0].'" value="'.$Value2.'"';
						if (($_GET['edit'] == 1) && ($Default == $Value2))
							echo 'checked';
							
						echo '>&nbsp;No&nbsp;<div class="spacer"></div>';
					} else if ($VariableArray[2] == 'select') {
						$ValueArray = explode('-',$VariableArray[3]); 						
						echo '<center><select name="'.$VarName[0].'" id="'.$VarName[0].'">';
						foreach($ValueArray as $value) {
							echo '<option value="'.$value.'"';
							if (($_GET['edit'] == 1) && ($Default == $value))
								echo 'selected';
							echo '>'.$value.'</option>';
						}
						echo '</select><div class="spacer"></div></center>';
						
					} else if ($VariableArray[2] == 'textarea') {
						if ($_GET['edit'] == 1)
							$Default = $ModuleArray->HTMLCode;
						else
							$Default = '';
						echo '<textarea name="'.$VarName[0].'" id="'.$VarName[0].'" style="width:100%;height:85px;">'.$Default.'</textarea><div class="spacer"></div>';
					}
				
				
				
			}
			?>
			
			
			<?
		}
		?>
        <input type="hidden" name="save" value="1" /><?
}
?>





 <? /* if ($_REQUEST['edit'] == 1) {?>
              EDIT MODULE: <? echo $Title;?>
            <div style="height:5px;"></div>
            <? if ($Var1) {?>
            <div class="messageinfo_white"><? echo $Var1Message;?></div>
            <input type="text" name="CustomVar1" style="width:280px;"  value="<? echo  stripslashes($ModuleArray->CustomVar1);?>"/>
            <? }?>
            <div style="height:5px;"></div>
            <? if ($Var2) {?>
            <div class="messageinfo_white"><? echo $Var2Message;?></div>
            <input type="text" name="CustomVar2" style="width:280px;"  value="<? echo stripslashes($ModuleArray->CustomVar2);?>"/>
            <? }?>
            <div style="height:5px;"></div>
            <? if ($Var3) {?>
            <div class="messageinfo_white"><? echo $Var3Message;?></div>
            <? if ($Var3Input != '') {echo $Var3Input; } else {?>
            <input type="text" name="CustomVar3" style="width:280px;" value="<? echo stripslashes($ModuleArray->CustomVar3);?>"/>
            <? }?>
            <? }?>
            <? if ($Html) {?>
            <div class="messageinfo_white"><? echo $HTMLMessage;?></div>
            <textarea style="width:280px; height:250px;" name="HTMLCode" id="HTMLCode"><? echo stripslashes($ModuleArray->HTMLCode);?></textarea><br>
            <? }?>
            <input type="hidden" name="save" value="1" />
   <? } */?>
 
                      
<input type="hidden" id ="ModuleType" name="ModuleType" value="<? echo $ModuleType;?>">
<input type="hidden" name="ProjectID" id="ProjectID" value="<? echo $ProjectID;?>">
<? if ((($_GET['step'] != '') && ($_GET['step'] != '1')) || (($_REQUEST['edit'] == '1'))){?>
<input type="hidden" name="ModuleCode" id="ModuleCode" value="<? echo $ModuleCode;?>">

<? } ?>

<? if (($_GET['step'] != 2) && ($_REQUEST['edit'] != '1')) {?>
<input type="hidden" name="Homepage" value="<? echo $HomeModule;?>" />
<input type="hidden" name="Reader" value="<? echo $ReaderModule;?>" />
<input type="hidden" name="UserHome" value="<? echo $UserHomeModule;?>" />
<? }?>

<input type="hidden" name="edit" id="edit" value="<? echo $_REQUEST['edit'];?>" />
<input type="hidden" name="mid" id="mid" value="<? echo $ModuleID;?>" />

</form>

 </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>
                        <div class="spacer"></div>


<? if ((($_GET['step'] == '2')&& ($ModuleCode != '')) || (($_REQUEST['edit'] == 1)&& ($ModuleCode != ''))) {?>

<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.png" onclick="submit_form('<? if ($_REQUEST['edit'] == 1) echo 'save'; else echo 'finish';?>');" class="navbuttons" />
<? }?>
<? if ((($_GET['step'] == '')|| ($_GET['step'] == '1') || ($ModuleCode == '')) && ($_REQUEST['edit'] != 1)){?>
<img src="http://www.wevolt.com/images/cms/cms_grey_next_btn.png" onclick="submit_form('2');" class="navbuttons" />
<? }?>

<? if (($_GET['step'] == '2') && ($ModuleCode != '')){?>
<img src="http://www.wevolt.com/images/cms/cms_grey_back_btn.png" onclick="submit_form('1');" class="navbuttons" />
<? }?>

<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.png" onclick="parent.$.modal().close();" class="navbuttons"/></div> 
</div> 
<? }?>


</body>
</html>