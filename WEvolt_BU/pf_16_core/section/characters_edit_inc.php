<script type="text/javascript">

	
	function submitpage() {
	if (document.getElementById("txtName").value == '') {
			alert('Please enter a name for your character');
	} else if (document.getElementById("txtDescription").value == '') {
			alert('Please enter a short description for your character');
	} else{
		document.pageform.submit();
	}
		

	}
		
</script>
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="300" align="center" valign="top">
<div id='savealert' style="color:#FF0000; font-weight:bold; font-size:10px;"></div>
<? if ($CharArray->Image == '') {?>
<img src="/images/cms/no_content.png" alt="" border='0' id='pageimage' width="250"/>

<? } else { ?>
<img src="/<? echo $_SESSION['basefolder'];?>/<? echo $_SESSION['projectfolder'];?>/<? echo stripslashes($CharArray->Image);?>" alt="" border='1' id='pageimage'  width="250"/>

<? }?>

</td><td width="350" valign="top">

<form action="/<? echo $_SESSION['pfdirectory'];?>/section/characters_inc.php?a=<? if ($_GET['a'] == 'new') echo 'finish'; else echo 'save';?>&project=<? echo $_SESSION['safefolder'];?>" method="post" name="pageform" id="pageform">
<center>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/characters_inc.php';" class="navbuttons" />
</center><div class="spacer"></div>
<table width="380" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="364" align="center">


<div class='sender_name'>
CHARACTER NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:300px;" class="inputstyle" value="<? echo stripslashes($CharArray->Name);?>"/>
<div style="height:5px;"></div>

HOMETOWN:<br /> <input name="txtHomeTown" id="txtHomeTown" type="text" class="inputstyle" style="width:300px;" value="<? echo stripslashes($CharArray->Hometown);?>"/>
<div style="height:5px;"></div>
RACE:<br /> <input name="txtRace" id="txtRace" type="text" class="inputstyle" style="width:325px;" value="<? echo stripslashes($CharArray->Race);?>"/>
<div style="height:5px;"></div>
<table width="100%">
<tr>
<td width="25%" class="sender_name">
AGE:<br /> 
<input name="txtAge" id="txtAge" type="text" class="inputstyle" style="width:75px;" value="<? echo stripslashes($CharArray->Age);?>"/>
</td>
<td width="42%" class="sender_name">
HEIGHT:<br /> 
<input name="txtHeightFt" type="text" class="inputstyle" style="width:50px;" value="<? echo stripslashes($CharArray->HeightFt);?>"/>&nbsp;<span style="font-size:10px;">FT</span> &nbsp;&nbsp;<input name="txtHeightIn" type="text" value="<? echo stripslashes($CharArray->HeightIn);?>"   class="inputstyle" style="width:50px;"/>&nbsp;<span style="font-size:10px;">IN</span>
</td>
<td width="33%" class="sender_name">
WEIGHT:<br /> 
<input name="txtWeight" type="text" class="inputstyle" value="<? echo stripslashes($CharArray->Weight);?>"  style="width:75px;"/>&nbsp;<span style="font-size:10px;">lbs</span>
</td>
</tr>
</table>
<div style="height:5px;"></div>

DESCRIPTION
<br />

<textarea name='txtDescription' id='txtDescription' class="inputstyle" style="width:95%;height:30px;"><? echo stripslashes($CharArray->Description);?></textarea><div class="spacer"></div>
ABILTIES
<br />

<textarea name='txtAbility' id='txtAbility' class="inputstyle" style="width:95%;height:30px;"><? echo stripslashes($CharArray->Abilities);?></textarea><div class="spacer"></div>
 
OTHER NOTES:
<br />

<textarea name='txtNotes' id='txtNotes' class="inputstyle" style="width:95%;height:30px;"><? echo stripslashes($CharArray->Notes);?></textarea><div class="spacer"></div>

</div>

<? if (($_SESSION['IsPro'] == 1) &&($_GET['a']=='edit')) {?>
	<? if ($FlowArray->id =='') {?>
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['charid'];?>','character','0');">[Connect to Page]</a>
    <? } else {?>
    Content Connected to Page:<br />
    <? echo $FlowArray->title;?><br />
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['charid'];?>','character','1');">[Edit Page Connection]</a>
    <? }?>
	<div class="spacer"></div>
<? }?>
Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? if (($CharArray->AccessType == 'public') || ($CharArray->AccessType == 'public')) echo 'selected';?>>Everyone</option>
<option value="fans" <? if ($CharArray->AccessType == 'fans') echo 'selected';?>>Fans Only</option>
<option value="superfans" <? if ($CharArray->AccessType == 'superfans') echo 'selected';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>
<div class="spacer"></div>

 <div id='change_image'>
 <iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?compact=yes&s=characters" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
<? /*<iframe id='loaderframe' name='loaderframe' height='300' width="300" frameborder="no" scrolling="no" src="/product_file_upload.php"></iframe>*/?>
</div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
<input type="hidden" value="<? echo $_SESSION['sessionproject'];?>" name="txtComic" /><input type="hidden" value="<? echo $_GET['charid'];?>" name="txtItem" /><input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" />
<input type="hidden" value="finish" name="txtAction" />
<input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/><input type="hidden" value="<? echo $_SESSION['projectfolder'];?>" name="txtUrl" id='txtUrl'/><input type="hidden" value="<? echo $_SESSION['safefolder'];?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 