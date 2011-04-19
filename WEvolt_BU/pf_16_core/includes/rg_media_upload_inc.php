<style type="text/css">
body, html {
	background-color:#000000;

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
<script type="text/javascript">
function submit_form() {
		
		document.getElementById('uploaddiv').style.display ='none';
		document.getElementById('progressdiv').style.display ='';
		document.UploadForm.submit();
}
</script>

<div class="uploadwrapper">
<div style="color:#FFFFFF;">
<div id='uploaddiv'>

<form enctype="multipart/form-data" action="../rg_uploader.php?rgid=<? echo $_GET['id'];?>" method="POST" id='UploadForm' name='UploadForm'>


<input type="hidden" name="MAX_FILE_SIZE" value="20971520" />

<div id='localupload'>

<input name="uploadedfile" type="file" style="width:250px;" id="uploadedfile"/>&nbsp;&nbsp;
</div>

<input type="button" value="Upload File" onClick='submit_form();'/> 
</form>
</div>

<div id='progressdiv' align="center" style="display:none;">Please Wait your file is being uploaded<div style="height:10px;"></div>
<img src='../images/processingbar.gif'></div>
</div>
</div>