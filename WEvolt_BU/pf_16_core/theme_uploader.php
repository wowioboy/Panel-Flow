<?
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
$DB = new DB();

$ComicID = $_GET['comic'];
$SkinCode = $_GET['skincode'];
$SkinNameArray = explode('-',$SkinCode);

if ($SkinNameArray == 'PFSK')
	$SkinTable = 'template_skins';
else if ($SkinNameArray == 'PFPSK')
	$SkinTable = 'project_skins';
	
$ProjectID=$_GET['project'];
$Type = $_GET['type'];
$DBTable = $_GET['db'];
$TemplateCode = $_GET['template'];
$ThemeID=$_GET['theme'];
$ProcessAll = $_POST['txtProcessAll'];
$base_path ="templates/skins/".$SkinCode.'/images/';
$SkinType = $_GET['type'];
$target_path =  $_SERVER['DOCUMENT_ROOT']."/".$base_path . basename( $_FILES['uploadedfile']['name']);
$output .= 'TARGET PATH = ' . $target_path .'<br/>';
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
		$NotValidFileType = 0;
		$Filename = basename( $_FILES['uploadedfile']['name']);
		if (exif_imagetype($target_path) == IMAGETYPE_GIF) {
			$ext = 'gif';
		} else if (exif_imagetype($target_path) == IMAGETYPE_JPEG) {
			$ext = 'jpg';
		} else if (exif_imagetype($target_path) == IMAGETYPE_PNG) {
			$ext = 'png';
		} else {
			$NotValidFileType = 1;
		}
		if ($NotValidFileType == 0) {
			if (($SkinType == 'boxcorner') && ($ProcessAll == 1)){
				$TopLeft = $base_path."ModTopLeft.".$ext;
				copy($target_path,$TopLeft);
				chmod($TopLeft, 0777);
				
				$TopRight = $base_path."top_right.".$ext;
				rotateImage($target_path,$TopRight,90); 
				chmod($TopRight, 0777);
				
				$BottomRight = $base_path."bottom_right.".$ext;
				rotateImage($target_path,$BottomRight,180); 
				chmod($BottomRight, 0777);
			
				$BottomLeft = $base_path."bottom_left.".$ext;
				rotateImage($target_path,$BottomLeft,270); 
				chmod($BottomLeft, 0777);
			}
			
			if (($SkinType == 'boxside') && ($ProcessAll == 1)){
				$LeftSide = $base_path."left_side.".$ext;
				copy($target_path,$LeftSide);
				chmod($LeftSide, 0777);
				
				$BoxTop = $base_path."box_top.".$ext;
				rotateImage($target_path,$BoxTop,90); 
				chmod($BoxTop, 0777);
				
				$RightSide = $base_path."right_side.".$ext;
				rotateImage($target_path,$RightSide,180); 
				chmod($RightSide, 0777);
				
				$BoxBottom = $base_path."box_bottom.".$ext;
				rotateImage($target_path,$BoxBottom,270); 
				chmod($BoxBottom, 0777);
			
			}
			
			if (($SkinType != 'boxcorner') && ($SkinType != 'boxside')) {
				$randName = substr(md5(rand() * time()),0,10);
				$NewSkinFile = $base_path.$randName.".".$ext;
				$ImageFile = $NewSkinFile; //$randName.".".$ext;
				copy($target_path, $_SERVER['DOCUMENT_ROOT']."/".$NewSkinFile);
				chmod( $_SERVER['DOCUMENT_ROOT']."/".$NewSkinFile,0777);	
			}
					
			//$updateDB = new DB;
			
			if ($DBTable == 'template')  {
				if ($ThemeID != '') {
							$query = "UPDATE template_settings set ".$SkinType."='$ImageFile' where TemplateCode='$TemplateCode' and ThemeID='$ThemeID' and ProjectID=''";
				} else if ($ProjectID != ''){
					$query ="SELECT * from template_settings where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
					$DB->query($query);
				     $output .= $query.'<br/>';
					$Found = $DB->numRows();
					if ($Found == 0) {
						$query ="INSERT into template_settings (TemplateCode, ProjectID) values ('$TemplateCode','$ProjectID')";
						$DB->execute($query);
					$output .= $query.'<br/>';
					}
						$query = "UPDATE template_settings set ".$SkinType."='$ImageFile' where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
				
				
				}
			} else {
				$query = "UPDATE $SkinTable set ".$SkinType."='$ImageFile' where SkinCode='$SkinCode'";
			}
				$output .= $query.'<br/>';
			$DB->query($query);
			$DB->close();
			
		
			
		} else {
			echo "The File must a JPG, GIF or PNG";
		}
		@unlink($target_path);
	if ($_SESSION['username'] =='matteblack') 
		echo $output;
			
		?>
<script type="text/javascript">	

var SkinType = '<? echo $SkinType;?>';
var htmlstring = '<font color=\"green\">IMAGE SET</font><a href=\"javascript:void(0)\" onclick="removeSkinImage(\''+SkinType+'\');return false;"><font color="red">&nbsp;remove[x]</font></a>';
window.parent.document.getElementById(SkinType+"Div").innerHTML = htmlstring;

<? $QueryString = "?compact=".$_POST['compact']."&transparent=".$_POST['transparent']."&type=".$_GET['type']."&project=".$ProjectID."&skincode=".$SkinCode."&db=".$DBTable."&template=".$TemplateCode."&theme=".$ThemeID."&bg=".$_POST['bg'];?>

<? //if ($_SESSION['username'] != 'matteblack') {?>
document.location.href = 'includes/template_upload_inc.php<? echo $QueryString;?>';
<? //} ?>

</script>
            
<?
} else{
    echo "There was an error uploading the file, please try again!";
}

?>