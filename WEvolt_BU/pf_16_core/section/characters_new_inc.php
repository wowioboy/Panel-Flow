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
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="450" align="center" valign="top"><div class="pagetitleLarge"> CHARACTER IMAGE</div>
<div><img src="/<? echo $PFDIRECTORY;?>/images/temp_char.jpg" alt="" border='1' id='pageimage'/></div></td><td width="470" height="600" valign="top"><div class="warning">NEW CHARACTER</div>
<div class="spacer"></div><center><input type="button" value ='SAVE' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=characters';"  style="width:100px;"/></center><div class="spacer"></div><div id='savealert' style="color:#FF0000; font-weight:bold;"></div><form action="/cms/edit/<? echo $SafeFolder;?>/?section=characters&a=finish" method="post" name="pageform" id="pageform">
<div class='pagetitleLarge'>CHARACTER NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" value="<? echo $Name;?>"/><div style="height:5px;"></div>

HOMETOWN:<br /> <input name="txtHomeTown" id="txtHomeTown" type="text" style="width:325px;" value="<? echo $HomeTown;?>"/><div style="height:5px;"></div>
RACE:<br /> <input name="txtRace" id="txtRace" type="text" style="width:325px;" value="<? echo $Race;?>"/><div style="height:5px;"></div>
<table width="100%">
<tr>
<td width="25%">
AGE:<br /> 
<input name="txtAge" id="txtAge" type="text" style="width:75px;" value="<? echo $Age;?>"/>
</td>
<td width="42%">
HEIGHT:<br /> 
<input name="txtHeightFt" type="text" style="width:50px;" value="<? echo $HeightFt;?>"/>&nbsp;<span style="font-size:10px;">FT</span> &nbsp;&nbsp;<input name="txtHeightIn" type="text" value="<? echo $HeightIn;?>"  style="width:50px;"/>&nbsp;<span style="font-size:10px;">IN</span>
</td>
<td width="33%">
WEIGHT:<br /> 
<input name="txtWeight" type="text" value="<? echo $Weight;?>"  style="width:75px;"/>&nbsp;<span style="font-size:10px;">lbs</span>
</td>
</tr>
</table>
<div style="height:5px;"></div>

DESCRIPTION
<br />

<textarea name='txtDescription' id='txtDescription' style="width:95%;height:50px;"><? echo $Description;?></textarea><div class="spacer"></div>
ABILTIES
<br />

<textarea name='txtAbility' id='txtAbility' style="width:95%;height:50px;"><? echo $Abilities;?></textarea><div class="spacer"></div>

OTHER NOTES:
<br />

<textarea name='txtNotes' id='txtNotes' style="width:95%;height:50px;"><? echo $Notes;?></textarea><div class="spacer"></div>

</div>
<div class="spacer"></div>

 <div id='change_image'>
<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?compact=yes&s=characters" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
<div align="center"><input type="button" value ='SAVE' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=characters';"  style="width:100px;"/><div id='savealert' style="color:#FF0000; font-weight:bold;"></div></div><input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" />
<input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" />
<input type="hidden" value="finish" name="txtAction" />
<input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/><input type="hidden" value="<? echo $Section;?>" name="txtSection" id='txtSection'/><input type="hidden" value="<? echo $ComicFolder;?>" name="txtUrl" id='txtUrl'/><input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 