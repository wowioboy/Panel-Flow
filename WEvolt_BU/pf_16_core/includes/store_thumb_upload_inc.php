<script type="text/javascript">
function submit_form() {
		
		document.getElementById('uploaddiv').style.display ='none';
		document.getElementById('progressdiv').style.display ='';
		document.UploadForm.submit();
}

</script>
<style type="text/css">
body, html {
background-color:#000000;
padding:0px;
margin:0px;

}


.uploadwrapper {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;

}
</style>
<div class="uploadwrapper">
<div style="color:#FFFFFF;">
<div id='uploaddiv'>
CHANGE IMAGE: 
<form enctype="multipart/form-data" action="../uploader.php?id=<? $_GET['itemid'];?>&type=store" method="POST" id='UploadForm' name='UploadForm'>

<input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
<div id='localupload'><div  style="height:10px;"></div>
<b>Choose your new image file:</b><br />
<input name="uploadedfile" type="file" style="width:250px;" id="uploadedfile"/>&nbsp;&nbsp;
</div>
<div  style="height:10px;"></div>
<input type="button" value="Upload Image" onClick='submit_form();'/> 
</form>
</div>

<div id='progressdiv' align="center" style="display:none;">Please wait your image is being uploaded<div style="height:10px;"></div>
<img src='../images/processingbar.gif'></div>
</div>
</div>