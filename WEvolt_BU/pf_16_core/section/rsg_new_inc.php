
<script type="text/javascript">
		
	
	function submitpage() {
	
	if (document.getElementById("txtTitle").value == '') {
		alert('You must first enter a title');
	} else if (document.pageform.txtEntryType.value == '0') {
		alert('Please select the type of Entry you want to create.');
	} else {
		if ((document.pageform.txtEntryType.value == 'Location') && (document.pageform.txtLocationType.value == 'sub') && (document.pageform.txtParentLocation.value == '0')) {
		alert('You cannot create a sub location until you have created a Base Location.');
		
		} else {
			document.pageform.submit();
		}
	}
		

	}
	function setEntryType(value) {
			
				if (value == 'Location') {
					document.getElementById("locationdiv").style.display ='';
					document.pageform.locationTypeBox.length = 0;
					document.pageform.locationTypeBox.options[0] = new Option("Base/Parent Location", "base", false, false);
					document.pageform.locationTypeBox.options[1] = new Option("Sub Location", "sub", false, false);
				} else {
				document.getElementById("locationdiv").style.display ='none';
				}
			}
function setLocationType(value) {
			
				if (value == 'sub') {
					document.getElementById("baselocations").style.display ='';
				} else if (value == 'base') {
					document.getElementById("baselocations").style.display ='none';
				
				}
			}
</script>
<div style="padding-left:25px; padding-right:25px;">
<form action="/cms/edit/<? echo $SafeFolder;?>/?section=rsg&a=new" method="post" name="pageform" id="pageform">
<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="66%" valign="top" style="padding-left:10px;" align="left"><div class="warning">NEW RESOURCE GUIDE ENTRY</div>
<div class="spacer"></div><div class='pagetitleLarge'>TITLE:<br />
<input type="text" name="txtTitle" id='txtTitle' value="<? echo $_POST['txtTitle'];?>"  style="width:500px;"/><div class="spacer"></div>
ENTRY TYPE: 
<? 
echo '<select name="txtEntryType" onChange="setEntryType(this.options[this.selectedIndex].value)"><option value="0">SELECT --</option>';
$query = 'SELECT * from pf_rg_entry_types order by Title';
$comicsDB->query($query);
while ($type = $comicsDB->FetchNextObject()) {
echo "<option value='".$type->Title."'";
if ($_POST['txtEntryType'] == $type->Title)
	echo 'selected';

echo ">".$type->Title."</option>";
}
echo '</select>';?>
<div id="locationdiv" style="display:none;">
<div class="spacer"></div>
Location Type:
<select name="txtLocationType" id='locationTypeBox' onChange="setLocationType(this.options[this.selectedIndex].value);">
</select>

<div <? if (!isset($_POST['txtParentLocation'])) {?>style="display:none;"<? }?> id='baselocations'><div class="spacer"></div>
Select Parent Location:
<select name="txtParentLocation" id="txtParentLocation">
<? 

$query = "SELECT * from pf_rg_entries where ComicID='$ComicID' and IsLocation=1 and ParentLocation=0 order by Title";
$comicsDB->query($query);
$TotalLocations = $comicsDB->numRows();
if ($TotalLocations == 0) {
echo "<option value='0'>NO BASE LOCATIONS AVAILABLE - CREATE ONE FIRST</option>";
} else {
echo "<option value='0'>SELECT --</option>";
}

while ($type = $comicsDB->FetchNextObject()) {
echo "<option value='".$type->EncryptID."'";
if ($_POST['txtParentLocation'] == $type->EncryptID)
	echo 'selected';

echo ">".$type->Title."</option>";
}

 


?>

</select>
</div>
</div>
</div>
<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="new" name="txtAction" /></td><td width="34%" valign="top"><div align="center"><input type="button" value ='NEXT STEP' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=rsg';"  style="width:100px;"/></div></td></tr></table>  </form>
</div>
<div class="spacer"></div>
 