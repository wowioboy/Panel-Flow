<?
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
$target_path = "temp/";
$ResizeWidth = $_POST['txtResizeWidth'];
?>
<style type="text/css">
body, html {
background-color:#ffffff;
padding:0px;
margin:0px;

}
</style>
<div style="background-color:#ffffff; color:#000000;"><?

$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
	//print "Target Path = ". $target_path . basename( $_FILES['uploadedfile']['name']); 
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	
		$Filename = basename( $_FILES['uploadedfile']['name']);
		if (exif_imagetype($target_path) == IMAGETYPE_GIF) {
				$ext = 'gif';
			} else if (exif_imagetype($target_path) == IMAGETYPE_JPEG) {
				$ext = 'jpg';
			} else if (exif_imagetype($target_path) == IMAGETYPE_PNG) {
				$ext = 'png';
			}
		
		$randName = md5(rand() * time());
		copy('temp/'.$Filename, 'temp/'.$randName.'.'.$ext);
		chmod('temp/'.$randName.'.'.$ext,0777);
		unlink($target_path);
		$Filename = $randName.'.'.$ext;
		
		if ($ResizeWidth != '') {
				$convertString = "convert temp/$Filename -resize $ResizeWidth temp/$Filename";
				exec($convertString);
				chmod('temp/'.$Filename,0777);
		}
		?>
<script type="text/javascript">
<? if ($_GET['a'] == 'button') {?>
	parent.document.menuform.txtButtonFilename.value = '<? echo $Filename;?>';
	parent.document.getElementById("buttonimage").src = '/pf_16_core/temp/<? echo $Filename;?>';
<? } else if ($_GET['a'] == 'rollover') {?>
							//window.parent.document.menuform.txtRollFilename.value
		parent.document.menuform.txtRollFilename.value = '<? echo $Filename;?>';
		parent.document.getElementById("rollimage").src = '/pf_16_core/temp/<? echo $Filename;?>';
		
<? }?> 
//parent.rollupload.location.href = 'includes/file_upload_inc.php?s=menu&a=<? //echo $_GET['a'];?>';
parent.document.getElementById("savealert").innerHTML = '<div style=\"padding:5px;\ width="300px;">Your Menu has changed, you will need to save your changes to take effect</div>';
									
</script>
            
<? } else{
    	echo "There was an error uploading the file, please try again!<br/><input type='button' onclick='document.location.href=\"/pf_16_core/includes/file_upload_inc.php?compact=".$_GET['compact']."&type=".$_GET['type']."&a=".$_GET['a']."\";' value='GO BACK'>";
	} ?>
</div>