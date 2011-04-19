<script type="text/javascript">

	
	function submitpage() {
	if ((document.getElementById("txtLinkUrl").value == '') && (document.getElementById("txtInternalLink").value == '0')) {
		alert('You must first enter a URL for the link');
	} else if (document.getElementById("txtTitle").value == '') {
		alert('Please enter a title for this link');
	} else {
	document.pageform.submit();
	}
		

	}
	function switch_link (value) {
		if (value == 1)
			document.getElementById("linkdiv").style.display = 'none';
		else 
			document.getElementById("linkdiv").style.display = '';
	
	}
	
</script>

<table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" align="center" valign="top"><div class="pagetitleLarge"> BANNER IMAGE</div>
<div><img src="/<? echo $PFDIRECTORY;?>/images/temp_link.jpg" alt="" border='1' id='pageimage'/></div></td><td width="363" height="600" valign="top"><div class="warning">NEW LINK</div>
<div class="spacer"></div><form action="/cms/edit/<? echo $SafeFolder;?>/?section=links&a=create" method="post" name="pageform" id="pageform"><div class='pagetitleLarge'>TITLE:<br /> <input name="txtTitle" id="txtTitle" type="text" style="width:325px;" value="<? echo $Title;?>"/><br />

DESCRIPTION
<br />
<textarea name='txtDescription' id='txtDescription' style="width:325px;height:100px;"><? echo $Description;?></textarea><div class="spacer"></div>

LINK TO MY COMIC: <input name="txtInternalLink" id="txtInternalLink" type="radio"  value="1" onclick="switch_link('1');"/> Yes&nbsp;&nbsp;<input name="txtInternalLink" id="txtInternalLink" type="radio"  value="0" checked  onclick="switch_link('0');"/>No<div class="spacer"></div>
<div id="linkdiv">
LINK (including http://) <br />
<input name="txtLinkUrl" id="txtLinkUrl" type="text" style="width:325px;" value="<? echo stripslashes($LinkArray->Link);?>"/>
</div>
<br/>
</div>
<div class="spacer"></div>

 <div id='change_image'>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/file_upload_inc.php" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
<div align="center"><input type="button" value ='SAVE' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=links';"  style="width:100px;"/><div id='savealert' style="color:#FF0000; font-weight:bold;"></div></div><input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" /><input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" /><input type="hidden" value="add" name="txtAction" /><input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/><input type="hidden" value="<? echo $Section;?>" name="txtSection" id='txtSection'/><input type="hidden" value="<? echo $ComicFolder;?>" name="txtUrl" id='txtUrl'/><input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 