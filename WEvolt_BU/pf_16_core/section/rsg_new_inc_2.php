<script type="text/javascript">
		
	
	function submitpage() {
	if (document.getElementById("txtFilename").value == '') {
		alert('You must first upload an image before saving');
	} else if (document.getElementById("txtTitle").value == '') {
		alert('Please enter a title for this page');
	} else {
	document.pageform.submit();
	}
		

	}
	
</script>
<form action="/cms/enter/" method="post" name="pageform" id="pageform">
<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td width="100%" valign="top" style="padding-left:10px;"><div class="warning">NEW ENTRY</div>
<div class="spacer"></div><div class='pagetitleLarge'>TITLE:<br />
<input type="text" name="txtTitle" id='txtTitle' value="<? echo stripslashes($Title);?>"  style="width:325px;"/><div class="spacer"></div>RSG ENTRY<br />
ENTRY TYPE: <? echo $entryString;?>
<div align="center"><input type="button" value ='SAVE' onClick="submitpage();" style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>&nbsp;<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=rsg';"  style="width:100px;"/><div id='savealert' style="color:#FF0000; font-weight:bold;"></div></div><input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="add" name="txtAction" /><input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $ComicFolder;?>" name="txtUrl" id='txtUrl'/><input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 