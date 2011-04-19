<script type="text/javascript">
	function submitpage() {
	
	if (document.getElementById("txtTitle").value == '') {
		alert('Your entry must have a title');
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
			
	function rolloveractive(tabid, divid) {
	var divstate = document.getElementById(divid).style.display;
	//alert('TABID = '+tabid+' and DIVID='+divid);
	//if (divstate == 'none') {
		//alert(divid+ 'state = hidden');
	//} else {
		//alert(divid+ 'state = active');
	//}
			if (document.getElementById(divid).style.display != '') {
			//alert('TABID = '+tabid+' and DIVID='+divid);
				document.getElementById(tabid).className ='profiletabhover';
			} 
	}
	function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}
	
	function mediatab()
	{
			document.getElementById("medialist").style.display = '';
			document.getElementById("uploaddiv").style.display = '';
			document.getElementById("mediatab").className ='profiletabactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("entrydiv").style.display = 'none';
	}
	function infotab()
	{
			document.getElementById("medialist").style.display = 'none';
			document.getElementById("uploaddiv").style.display = 'none';
			document.getElementById("mediatab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = '';
			document.getElementById("infotab").className ='profiletabactive';	
			document.getElementById("entrydiv").style.display = '';											
	}
	
	function imagestab()
	{
			document.getElementById("imageslist").style.display = '';
			document.getElementById("imagestab").className ='profiletabactive';
			document.getElementById("videoslist").style.display = 'none';
			document.getElementById("videostab").className ='profiletabinactive';
			document.getElementById("soundlist").style.display = 'none';
			document.getElementById("soundtab").className ='profiletabinactive';
			document.getElementById("docslist").style.display = 'none';
			document.getElementById("docstab").className ='profiletabinactive';
	}
	function videostab()
	{
			document.getElementById("imageslist").style.display = 'none';
			document.getElementById("imagestab").className ='profiletabinactive';
			document.getElementById("videoslist").style.display = '';
			document.getElementById("videostab").className ='profiletabactive';
			document.getElementById("soundlist").style.display = 'none';
			document.getElementById("soundtab").className ='profiletabinactive';
			document.getElementById("docslist").style.display = 'none';
			document.getElementById("docstab").className ='profiletabinactive';
	}
	function soundtab()
	{
			document.getElementById("imageslist").style.display = 'none';
			document.getElementById("imagestab").className ='profiletabinactive';
			document.getElementById("videoslist").style.display = 'none';
			document.getElementById("videostab").className ='profiletabinactive';
			document.getElementById("soundlist").style.display = '';
			document.getElementById("soundtab").className ='profiletabactive';
			document.getElementById("docslist").style.display = 'none';
			document.getElementById("docstab").className ='profiletabinactive';
	}
	function docstab()
	{
			document.getElementById("imageslist").style.display = 'none';
			document.getElementById("imagestab").className ='profiletabinactive';
			document.getElementById("videoslist").style.display = 'none';
			document.getElementById("videostab").className ='profiletabinactive';
			document.getElementById("soundlist").style.display = 'none';
			document.getElementById("soundtab").className ='profiletabinactive';
			document.getElementById("docslist").style.display = '';
			document.getElementById("docstab").className ='profiletabactive';
	}
	
	

</script>
<div style="padding-left:25px; padding-right:25px;">
<form action="/cms/edit/<? echo $SafeFolder;?>/?section=rsg&a=edit" method="post" name="pageform" id="pageform">
<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="48%" valign="top" style="padding-left:10px;"><div class="warning">EDIT RESOURCE GUIDE ENTRY</div>
<table cellpadding="0" cellspacing="0" border="0" width="368"> <tr>
<td class="profiletabactive" align="left" width="50%" id='infotab' onMouseOver="rolloveractive('infotab','infodiv')" onMouseOut="rolloverinactive('infotab','infodiv')" onclick="infotab();">INFORMATION</td>
<td width="5"></td>
<td class="profiletabinactive" align="left" width="50%" id='mediatab' onMouseOver="rolloveractive('mediatab','medialist')" onMouseOut="rolloverinactive('mediatab','medialist')" onclick="mediatab();"> MEDIA</td>
</tr>
</table>

<div id="infodiv">
<div class="spacer"></div><div class='pagetitleLarge'>TITLE:<br />
<input type="text" name="txtTitle" id='txtTitle' value="<? echo $Title;?>"  style="width:350px;"/><div class="spacer"></div>
ACTIVE<br />

<input type="radio" name="txtActive" value='1' <? if ($IsActive == 1) echo 'checked';?>/>YES&nbsp;<input type="radio" name="txtActive" value='0'  <? if ($IsActive == 0) echo 'checked';?>/>NO
<div class="spacer"></div>
PRIVATE<br />
<input type="radio" name="txtPrivate" value='1' <? if ($IsPrivate == 1) echo 'checked';?>/>YES&nbsp;<input type="radio" name="txtPrivate" value='0'  <? if ($IsPrivate == 0) echo 'checked';?>/>NO
<div class="spacer"></div>
ENTRY TYPE: 
<? 
echo '<select name="txtEntryType" onChange="setEntryType(this.options[this.selectedIndex].value)"><option value="0">SELECT --</option>';
$query = 'SELECT * from pf_rg_entry_types order by Title';
$comicsDB->query($query);
while ($type = $comicsDB->FetchNextObject()) {
echo "<option value='".$type->Title."'";

if ($EntryType == $type->Title)
	echo 'selected';

echo ">".$type->Title."</option>";
}
echo '</select>';?>
</div>

<div id="locationdiv" style="display:none;">
<div class="spacer"></div>
Location Type:
<select name="txtLocationType" id='locationTypeBox' onChange="setLocationType(this.options[this.selectedIndex].value);">
</select>

<div <? if ($ParentLocation == 0) {?>style="display:none;"<? }?> id='baselocations'><div class="spacer"></div>
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
if ($ParentLocation == $type->EncryptID)
	echo 'selected';

echo ">".$type->Title."</option>";
}

?>

</select>


</div>
 <div id='change_image' style="color:#FFFFFF;">
  <div class="spacer"></div>
 <div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">MAP INFORMATION</div>
 <? 
$query = "SELECT * from pf_rg_maps where ComicID='$ComicID' and LocationID='$EntryID'";
$comicsDB->query($query);

$HasMap = $comicsDB->numRows();

if ($HasMap == 0) {
	echo "No map image set for this location yet. [<a href=\"#\" onclick=\"add_map('".$EntryID."');\">ADD MAP</a>]";
} else {
	while ($Map = $comicsDB->FetchNextObject()) {
		echo "<img src='//'>[EDIT MAP]";
	
	}
}
 

?>
 <div class="spacer"></div>
  <? 
$query = "SELECT * from pf_rg_coordinates where LocationID='$EntryID'";
$comicsDB->query($query);

$HasCoordinates = $comicsDB->numRows();

if ($HasCoordinates == 0) {
	echo "No map coordinates set for location [<a href=\"#\" onclick=\"add_coordinates('".$EntryID."');\">ADD  COODINATES</a>]";
} else {
	while ($Map = $comicsDB->FetchNextObject()) {
		echo "<img src='//'>[EDIT MAP]";
	
	}
}
 

?>
 <div class="spacer"></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">LOCATION BANNER</div>

<? if ($Custom1 == '') { ?>
 <img src="/<? echo $PFDIRECTORY;?>/images/blank.jpg" alt="" border='0' id='pageimage'/>

<? } else { ?>
 <img src="/comics/<? echo $PFDIRECTORY;?>/images/blank.jpg" alt="" border='1' id='pageimage'/>
<? } ?>

<iframe src="/<? echo $PFDIRECTORY;?>/includes/file_upload_inc.php?type=rgbanner" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
</div>
</div>

<div id='savealert' style="color:#FF0000; font-weight:bold;"></div>
<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="edit" name="txtAction" /><input type="hidden" value="<? echo $_GET['entry'];?>" name="txtItem" />
<div id="uploaddiv" style="display:none;color:#FFFFFF;">
<div class="spacer"></div>
UPLOAD CONTENT:<div class="spacer"></div>
<? $_SESSION['uploadtype'] = 'rg';

$_SESSION['comic'] = $ComicID; ?>
 <iframe id='loaderframe' name='loaderframe' src="/<? echo $PFDIRECTORY;?>/includes/rg_media_upload_inc.php?id=<? echo $EntryID; ?>" width="100%" style="height:350px;" frameborder="no" scrolling="auto"></iframe>
</div>


</td><td width="52%" valign="top"><div align="center"><input type="button" value ='SAVE ENTRY' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=rsg';"  style="width:100px;"/></div><div class="spacer"></div>
  <div id="entrydiv">
  <div class='pagetitleLarge'>ENTRY TEXT:</div>
  <? include("editor/fckeditor.php") ;?>
<?php
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

$oFCKeditor = new FCKeditor('pf_post') ;
$oFCKeditor->BasePath	= '/'.$PFDIRECTORY.'/editor/';
//$oFCKeditor.Config['CustomConfigurationsPath'] = '/'.$PFDIRECTORY.'/editor/hot_spot_config.js' 
$oFCKeditor->ToolbarSet = 'Basic' ;
$oFCKeditor->Height = '400';
$oFCKeditor->Width = '415';
$oFCKeditor->Value		= $Description;
$oFCKeditor->Create() ;
?>
</div>
<div id="medialist" style="display:none; padding-left:10px;padding-top:10px;"><table cellpadding="0" cellspacing="0" border="0" width="100%"> <tr>
<td class="profiletabactive" align="left" width="25%" id='imagestab' onMouseOver="rolloveractive('imagestab','imagesdiv')" onMouseOut="rolloverinactive('imagestab','imagesdiv')" onclick="imagestab();">IMAGES</td>
<td width="5"></td>
<td class="profiletabinactive" align="left" width="25%" id='videostab' onMouseOver="rolloveractive('videostab','videoslist')" onMouseOut="rolloverinactive('videostab','videoslist')" onclick="videostab();"> VIDEO</td>
<td width="5"></td>
<td class="profiletabinactive" align="left" width="25%" id='soundtab' onMouseOver="rolloveractive('soundtab','soundlist')" onMouseOut="rolloverinactive('soundtab','soundlist')" onclick="soundtab();"> SOUNDS</td>
<td width="5"></td>
<td class="profiletabinactive" align="left" width="25%" id='docstab' onMouseOver="rolloveractive('docstab','docslist')" onMouseOut="rolloverinactive('docstab','docslist')" onclick="docstab();"> DOCS</td>
</tr>
</table>
<div class="spacer"></div>
<div id="imageslist">
<? 
$query = "SELECT * from pf_rg_entries_media where EntryID ='$EntryID' and MediaType='image'";
		$comicsDB->query($query);
	?>
    
    	
		
</div>
<div id="videoslist" style="display:none;">
<? 
$query = "SELECT * from pf_rg_entries_media where EntryID ='$EntryID' and MediaType='video'";
		$comicsDB->query($query);
	?>	
	
</div>
<div id="soundlist" style="display:none;">
	<? $query = "SELECT * from pf_rg_entries_media where EntryID ='$EntryID' and MediaType='sound'";
		$comicsDB->query($query);
		?>
        
        
		
</div>
<div id="docslist" style="display:none;">

<? $query = "SELECT * from pf_rg_entries_media where EntryID ='$EntryID' and MediaType='document'";
		$comicsDB->query($query);
		
		$query = "SELECT * from pf_rg_entries_media where EntryID ='$EntryID' and MediaType='html'";
		$comicsDB->query($query);
		?>
</div>
</div>

</td></tr></table>  <input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" name="action" value="save" /></form>
</div>
<div class="spacer"></div>
<script type="text/javascript">
setEntryType('<? echo $EntryType;?>');
<? if (($IsLocation == 1) && ($ParentLocation != 0)) {?>
setLocationType('sub');
<? } else if (($IsLocation == 1) && ($ParentLocation == 0))  {?>
setLocationType('base');
<? }?>
</script>