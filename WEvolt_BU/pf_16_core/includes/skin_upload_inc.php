<? include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');?>
<script type="text/javascript">

function submit_form() {
		
		document.getElementById('uploaddiv').style.display ='none';
		document.getElementById('progressdiv').style.display ='';
		document.UploadForm.action = '../skin_uploader.php?type=<? echo $_GET['type'];?>&skincode=<? echo $_GET['skincode'];?>&comic=<? echo $_GET['comic'];?>&db=<? echo $_GET['db'];?>&template=<? echo $_GET['template']?>&project=<? echo $_GET['project'];?>&theme=<? echo $_GET['theme'];?>';
		document.UploadForm.submit();
}

</script>
<style type="text/css">
.uploadwrapper {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
background-color:#<? echo $_GET['bg']?>;

}
</style>

<div class="uploadwrapper">

<div style="color:#000000;">

<div id='uploaddiv'>
<form enctype="multipart/form-data" method="POST" id='UploadForm' name='UploadForm'>
<input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
<table><tr><td>
<input name="uploadedfile" type="file" style="width:220px;" id="uploadedfile"/>
</td><td valign="top" style="padding-left:5px;"><input type="button" value="UPLOAD" onClick='submit_form();'/>
<input type="hidden" value="<? echo $_GET['bg'];?>" name="bg" />
<input type="hidden" value="<? echo $_GET['compact'];?>" name="compact" />
<input type="hidden" value="<? echo $_GET['transparent'];?>" name="transparent" /> </td></tr></table>
</form>
</div>


<div id='progressdiv' align="center" style="display:none;">Please Wait your Image is being uploaded<br />
<img src='/<? echo $PFDIRECTORY;?>/images/processingbar.gif' vspace="5">
</div>

</div>
</div>