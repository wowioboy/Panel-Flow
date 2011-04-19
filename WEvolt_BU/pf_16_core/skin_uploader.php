<?
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
include 'includes/image_functions.php';
//require_once("includes/curl_http_client.php");
//require_once("includes/create_key_func.php");
//$curl = &new Curl_HTTP_Client();
//$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
//$curl->set_user_agent($useragent);
$ComicID = $_GET['comic'];
$SkinCode = $_GET['skincode'];
$SkinNameArray = explode('-',$SkinCode);

if ($SkinNameArray[0] == 'PFSK')
	$SkinTable = 'template_skins';
else if ($SkinNameArray[0] == 'PFPSK')
	$SkinTable = 'project_skins';
	
$ProjectID=$_GET['project'];
$Type = $_GET['type'];
$DBTable = $_GET['db'];
$TemplateCode = $_GET['template'];
$ThemeID=$_GET['theme'];
$ProcessAll = $_POST['txtProcessAll'];
$base_path = "templates/skins/".$SkinCode."/images/";
$SkinType = $_GET['type'];
$target_path = $_SERVER['DOCUMENT_ROOT']."/".$base_path . basename( $_FILES['uploadedfile']['name']);
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
				copy($target_path,$_SERVER['DOCUMENT_ROOT']."/".$TopLeft);
				chmod($_SERVER['DOCUMENT_ROOT']."/".$TopLeft, 0777);
				
				$TopRight = $base_path."top_right.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$TopRight,90); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$TopRight, 0777);
				
				$BottomRight = $base_path."bottom_right.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$BottomRight,180); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$BottomRight, 0777);
			
				$BottomLeft = $base_path."bottom_left.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$BottomLeft,270); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$BottomLeft, 0777);
			}
			
			if (($SkinType == 'boxside') && ($ProcessAll == 1)){
				$LeftSide = $base_path."left_side.".$ext;
				copy($target_path,$_SERVER['DOCUMENT_ROOT']."/".$LeftSide);
				chmod($_SERVER['DOCUMENT_ROOT']."/".$LeftSide, 0777);
				
				$BoxTop = $base_path."box_top.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$BoxTop,90); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$BoxTop, 0777);
				
				$RightSide = $base_path."right_side.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$RightSide,180); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$RightSide, 0777);
				
				$BoxBottom = $base_path."box_bottom.".$ext;
				rotateImage($target_path,$_SERVER['DOCUMENT_ROOT']."/".$BoxBottom,270); 
				chmod($_SERVER['DOCUMENT_ROOT']."/".$BoxBottom, 0777);
			
			}
			
			if (($SkinType != 'boxcorner') && ($SkinType != 'boxside')) {
				$randName = substr(md5(rand() * time()),0,10);
				$NewSkinFile = 'templates/skins/'.$SkinCode.'/images/'.$randName.'.'.$ext;
				$ImageFile = $randName.'.'.$ext;
				copy($target_path,$_SERVER['DOCUMENT_ROOT']."/".$NewSkinFile);
				chmod($_SERVER['DOCUMENT_ROOT']."/".$NewSkinFile,0777);	
			}
					
				
			if ($DBTable == 'template')  {
				if ($ThemeID != '') {
							$query = "UPDATE template_settings set ".$SkinType."='$ImageFile' where TemplateCode='$TemplateCode' and ThemeID='$ThemeID' and ProjectID=''";
				} else if ($ProjectID != ''){
					$query ="SELECT * from template_settings where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
					$InitDB->query($query);
				//	print $query.'<br/>';
					$Found = $InitDB->numRows();
					if ($Found == 0) {
						$query ="INSERT into template_settings (TemplateCode, ProjectID) values ('$TemplateCode','$ProjectID')";
						$InitDB->execute($query);
					//	print $query.'<br/>';
					}
						$query = "UPDATE template_settings set ".$SkinType."='$ImageFile' where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
				
				
				}
			} else {
				$query = "UPDATE $SkinTable set ".$SkinType."='$ImageFile' where SkinCode='$SkinCode'";
			}
			list($FileWidth,$FileHeight)= @getimagesize($_SERVER['DOCUMENT_ROOT']."/".$NewSkinFile);
			$InitDB->query($query);
			$InitDB->close();
			//print $query;
			/*
			$query = "SELECT AppInstallation from comics where comiccrypt ='$ComicID'";
			$AppInstallID= $updateDB->queryUniqueValue($query);
			$query = "SELECT * from comic_settings where ComicID ='$ComicID'";
			$SettingArray= $updateDB->queryUniqueObject($query);
			$query = "SELECT * from Applications where ID ='$AppInstallID'";
			$ApplicationArray = $updateDB->queryUniqueObject($query);
			$ApplicationLink = "http://".$ApplicationArray->Domain."/".$ApplicationArray->PFPath;
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$updateDB->query($query);
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey, 's' => $SkinCode, 'a'=>'file','t'=>$SkinType);
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/update_skins.php", $post_data);
			
			unset($post_data);
			*/
			
		} else {
			echo "The File must a JPG, GIF or PNG";
		}
		@unlink($target_path);
		
		?>
<script type="text/javascript">	
//window.parent.document.getElementById("<? //echo $SkinType;?>").value = '<? //echo $Filename;?>';
//window.parent.document.getElementById("txtDirectory").value = '<? //echo $SetDirectory;?>';
//window.parent.document.getElementById("pageimage").src = '/pf_16_core/images/loading.gif';
var SkinType = '<? echo $SkinType;?>';
var loadimage = '';

if ((SkinType == 'ModTopRightImage') || (SkinType == 'ModTopLeftImage')|| (SkinType == 'ModBottomLeftImage')|| (SkinType == 'ModBottomRighttImage') || (SkinType == 'ModTopImage')|| (SkinType == 'ModBottomImage')|| (SkinType == 'ModLeftSideImage')|| (SkinType == 'ModRightSideImage') || (SkinType == 'ContentBoxImage')) {
if  (SkinType != 'ContentBoxImage')
	loadimage = 'http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg';
else
	loadimage = 'http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg';
window.parent.document.getElementById("<? echo $SkinType;?>").style.backgroundImage = "url('/<? echo $NewSkinFile;?>')";
window.parent.document.getElementById("<? echo $SkinType;?>").style.height = '<? echo $FileHeight;?>px';
window.parent.document.getElementById("<? echo $SkinType;?>").style.width = '<? echo $FileWidth;?>px';

}

if (loadimage == '') 
loadimage = 'http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg';

var htmlstring = '<a href=\"javascript:void(0)\" onclick=\"removeSkinImage(\'<? echo $SkinType;?>e\');return false;\"><img src=\"'+loadimage+'\" border=\"0\" class=\"navbuttons\"></a>';
window.parent.document.getElementById("<? echo $SkinType;?>Div").innerHTML = htmlstring;
<? /*
var pos = SkinType.indexOf('Button');
if ((pos == -1)  || (SkinType == 'ButtonImage')){
window.parent.document.getElementById("<? echo $SkinType;?>Div").innerHTML = '<font color=\"green\">IMAGE SET</font><a href=\"#\" onclick=\"removeSkinImage(\'<? echo $SkinType;?>\');return false;\"><font color=\"red\">&nbsp;[x]<br/></font></a><div class=\"spacer\"></div><a href=\"#\" onclick=\"revealModal(\'uploadModal\',\'<? echo $SkinType;?>\');return false;\"><font color=\"#0099FF\">[CHANGE IMAGE]</font></a>';
} else {
var roll = SkinType.indexOf('Rollover');
if (roll == -1) {
	var AccessType = SkinType.split('Image');
} else {
	var AccessType = SkinType.split('Rollover');
}

if (loadimage == '') 
loadimage = 'http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg';

var htmlstring '<a href=\"javascript:void(0)\" onclick=\"removeSkinImage(\'ModRightSideImage\');return false;\"><img src=\"'+loadimage+'\" border=\"0\" class=\"navbuttons\"></a>';

var htmlstring = '<font color=\"green\">IMAGE SET</font><a href=\"#\" onclick="removeSkinImage(\''+AccessType[0]+'Image\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div><a href=\"#\" onclick=\"revealModal(\'uploadModal\',\''+AccessType[0]+'Image\');return false;\"><font color=\"#0099FF\">[CHANGE IMAGE]</font></a><div style=\"height:5px;\"></div><a href=\"#\" onclick=\"revealModal(\'uploadModal\',\''+AccessType[0]+'RolloverImage\');return false;\"><font color=\"#0099FF\">[';
if (roll == -1) {
	htmlstring = htmlstring + 'UPLOAD '; 
	 
} else {
htmlstring = htmlstring + 'CHANGE '; 
}
htmlstring =  htmlstring + 'ROLLOVER]</font></a>';

window.parent.document.getElementById(AccessType[0]+"ImageDiv").innerHTML = htmlstring;
*/?>

window.parent.document.getElementById("uploadModal").style.display ='none';
//alert('Your New Page Has Been Processed, you will need to still save your changes for the new page to take effect');
<? $QueryString = "?compact=".$_POST['compact']."&transparent=".$_POST['transparent']."&type=".$_GET['type']."&project=".$ProjectID."&skincode=".$SkinCode."&db=".$DBTable."&template=".$TemplateCode."&theme=".$ThemeID."&bg=".$_POST['bg'];?>
if ($ThemeID != '') {
	var redir = '/cms/admin/?t=themes&section=skins&skincode=<? echo $SkinCode;?>&a=edit&theme='.$ThemeID;
	
} else {
	var redir = '/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=design&section=skins&skincode=<? echo $SkinCode;?>&a=edit';
	
}

//document.location.href = 'includes/skin_upload_inc.php<? //echo $QueryString;?>';

	
window.parent.document.location.href = redir;


</script>
            
<?
} else{
    echo "There was an error uploading the file, please try again!";
}

?>