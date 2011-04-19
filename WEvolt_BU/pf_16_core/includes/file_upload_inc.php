<script type="text/javascript">
<? if (($_GET['s'] != 'menu') && ($_GET['compact'] != 'yes')){?>
function select_upload_type(value) {
	if (value == 'local') {
		document.getElementById("localupload").style.display = '';
		document.getElementById("urlupload").style.display = 'none';
		document.getElementById("fileurl").value = '';
		document.getElementById("localtab").className ='tabactive';
		document.getElementById("urltab").className ='tabinactive';
		
	} else if (value == 'url') {
		document.getElementById("localupload").style.display = 'none';
		document.getElementById("urlupload").style.display = '';
		document.getElementById("uploadedfile").value = '';
		document.getElementById("localtab").className ='tabinactive';
		document.getElementById("urltab").className ='tabactive';
		
	}



}
<? }?>
function rolloveractive(tabid, divid) {
	var divstate = document.getElementById(divid).style.display;
		if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='tabhover';
		} 
}

function rolloverinactive(tabid, divid) {
		if (document.getElementById(divid).style.display != '') {
			document.getElementById(tabid).className ='tabinactive';
		} 
}

function submit_form() {
		
		document.getElementById('uploaddiv').style.display ='none';
		document.getElementById('progressdiv').style.display ='';
		document.UploadForm.submit();
}

</script>
<style type="text/css">
body, html {
<? if ($_GET['s'] == 'menu') {?>
 	
 <? } else {?>
	background-color:#fffff;
	color:#000000;
<? }?>
padding:0px;
margin:0px;

}

.tabactive {
height:12px;
background-color:#f58434;
text-align:center;
padding:5px;
cursor:pointer;
font-weight:bold;
font-size:12px;
}
.tabinactive {
height:12px;
background-color:#dc762f;
text-align:center;
padding:5px;
cursor:pointer;
color:#FFFFFF;
font-size:12px;
}
.tabhover{
height:12px;
background-color:#ffab6f;
color:#000000;
text-align:center;
padding:5px;
cursor:pointer;
font-size:12px;
}

.uploadwrapper {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;

}

</style>
<div class="uploadwrapper">
<div> 
<div id='uploaddiv'> 
<? if (isset($_GET['type'])) { ?>
<form enctype="multipart/form-data" action="/uploader.php?a=pages&id=<? echo $ItemID;?>&action=change&type=<? echo $_GET['type'];?>&compact=<? echo $_GET['compact'];?>" method="POST" id='UploadForm' name='UploadForm'>
<? } else {
if ($_GET['s'] != '') {?>
<? if ($_GET['s'] == 'menu') {?>
<form enctype="multipart/form-data" action="../menu_uploader.php?s=<? $_GET['s'];?>&id=<? echo $ItemID;?>&a=<? echo $_GET['a'];?>&compact=<? echo $_GET['compact'];?>" method="POST" id='UploadForm' name='UploadForm'>
<? } else {?>
<form enctype="multipart/form-data" action="/uploader.php?s=<? $_GET['s'];?>&id=<? echo $ItemID;?>&action=<? echo $_GET['a'];?>&compact=<? echo $_GET['compact'];?>" method="POST" id='UploadForm' name='UploadForm'>
<? }?>
<? } else {?>
<form enctype="multipart/form-data" action="/uploader.php?a=pages&id=<? echo $ItemID;?>&action=change&compact=<? echo $_GET['compact'];?>" method="POST" id='UploadForm' name='UploadForm'>

<? }}?>
<input type="hidden" name="MAX_FILE_SIZE" value="30971520" />
<? if (($_GET['s'] != 'menu') && ($_GET['compact'] != 'yes')){?>
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="50%" id='localtab' class='tabactive' height="30" onClick="select_upload_type('local')" onMouseOver="rolloveractive('localtab','localupload')" onMouseOut="rolloverinactive('localtab','localupload')" >UPLOAD FROM COMPUTER</td><td width="50%" id='urltab' class='tabinactive' height="30" onClick="select_upload_type('url')" onMouseOver="rolloveractive('urltab','urlupload')" onMouseOut="rolloverinactive('urltab','urlupload')" >UPLOAD FROM LOCATION</td></tr></table>
<? }?> 
<div id='localupload'>
<? if (($_GET['s'] != 'menu') && ($_GET['compact'] != 'yes')){?>
<div  style="height:10px;"></div>
<b>Choose your new image file:</b><br />
<? }?>
<? if ($_GET['l'] != 'v') {?>
<table><tr><td><? }?>
<input name="uploadedfile" type="file" style="width:200px;" id="uploadedfile"/>
<? if ($_GET['l'] != 'v') {?></td><td valign="top"><? }?>&nbsp;<? if ($_GET['l'] == 'v') {?><br/><? }?><input type="button" value="UPLOAD" onClick='submit_form();'/> <? if ($_GET['l'] != 'v') {?></td></tr></table><? }?>
</div>
<? if (($_GET['s'] != 'menu') && ($_GET['compact'] != 'yes')){?>
<div  style="height:10px;"></div>
<? }?>
<? if ($_GET['s'] != 'menu'){?>
(optional) Resize width to: <input type="text" name="txtResizeWidth" style="width:50px;"/>
<? }?>
</form>
</div>
<div id='progressdiv' align="center" style="display:none;">Please Wait your content is being uploaded<div style="height:10px;"></div>
<img src='../images/processingbar.gif'></div>
</div>
</div>