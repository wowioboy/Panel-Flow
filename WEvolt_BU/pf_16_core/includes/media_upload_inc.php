<style type="text/css">
body, html {
background:none;
padding:0px;
margin:0px;

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
<div style="color:#000000;">
<div id='uploaddiv'>

<form enctype="multipart/form-data" action="../media_uploader.php" method="POST" id='UploadForm' name='UploadForm'>


<input type="hidden" name="MAX_FILE_SIZE" value="2000000000" />

<div id='localupload'>

<input name="uploadedfile" type="file" style="width:250px;" id="uploadedfile"/>&nbsp;&nbsp;
</div>

<input type="button" value="Upload File" onClick='submit_form();'/> 
</form>
</div>

<div id='progressdiv' align="center" style="display:none;">Please Wait your media is being uploaded<div style="height:10px;"></div>
<img src='../images/processingbar.gif'></div>
</div>
</div>