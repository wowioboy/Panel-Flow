<?
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/image_resizer.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/image_functions.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/image_converter.php';
include $_SERVER['DOCUMENT_ROOT'].'/classes/dThumbMaker.inc.php';

$target_path = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/temp/";
?>
<style type="text/css">
body, html {
background:none;
padding:0px;
margin:0px;

}
</style>
<div style="color:#000000;">

<?

	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
	//print "Target Path = ". $target_path . basename( $_FILES['uploadedfile']['name']); 
	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			$Filename = basename( $_FILES['uploadedfile']['name']);
			//print 'Filename = ' . $Filename .'<br/>';
			
			$file_extension = substr(strrchr($Filename, "."), 1);	
			$ProjectID = $_SESSION['sessionproject'];
			$UserID = $_SESSION['userid'];
			
			$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
		
			
			if ($ProjectID =='') {
				$TargetID = $UserID;
				$TargetTable = 'users';
				$TargetName = 'UploadBy';
				$EncryptName = 'encryptid';
				$TargetFolder = 'users';
			} else  {
				$TargetID = $ProjectID;
				$TargetTable = 'projects';
				$TargetName = 'ProjectID';
				$EncryptName = 'ProjectID';
				
			}
			
			$query = "SELECT * from $TargetTable WHERE ".$EncryptName."='$TargetID'";
			
			$ComicArray = $db->queryUniqueObject($query);
			
			//print $query.'<br/>';
			//print 'EX T = ' . $file_extension .'<br/>';
			$UserName = $_SESSION['username']; 
			if ($ProjectID !='') 
				$TargetFolder = $ComicArray->ProjectDirectory;
			$ComicDirectory = $ComicArray->HostedUrl;
			
			//print 'Directory = ' .$ComicDirectory .'<br/>';
			//print 'TARGET FOLDER = '.$TargetFolder .'<br/>';
			if ($ProjectID =='') {
				if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$TargetFolder."/".$_SESSION['username']."/media")) 
				mkdir($_SERVER['DOCUMENT_ROOT']."/".$TargetFolder."/".$_SESSION['username']."/media/", 0777); 
				$MediaPath = $TargetFolder.'/'.$_SESSION['username'].'/media/';
		    } else {
				if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$TargetFolder."/".$ComicDirectory ."/media")) 
				mkdir($_SERVER['DOCUMENT_ROOT']."/".$TargetFolder."/".$ComicDirectory ."/media/", 0777); 
				$MediaPath = $TargetFolder."/".$ComicDirectory ."/media/";
			
			}
		$FileOk = 1;
		
		if (($file_extension == 'jpg') || ($file_extension == 'jpeg')|| ($file_extension == 'gif')|| ($file_extension == 'png')|| ($file_extension == 'jpg')) {
				$FileType = 'image';
				$originalimage = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/temp/".$Filename;
				$TargetFile = $_SERVER['DOCUMENT_ROOT']."/".$MediaPath.$Filename;
				copy($originalimage,$TargetFile);
				$OriginalFileName = explode('.',$Filename);
				list($Width,$Height)=getimagesize($TargetFile);
				//if ($file_extension != 'bmp') {
					//new ImageConverter("../comics/".$ComicDirectory ."/media/".$Filename,'jpg');
					//$ConvertedImage = "../comics/".$ComicDirectory ."/media/".$OriginalFileName[0].'.jpg';
				//} else {
					//$ConvertedImage = "../comics/".$ComicDirectory ."/media/".$Filename;
				//}
				//$TargetFile = $ConvertedImage;
				//print "MY CONVERTED IMAGE = " . $ConvertedImage;

				@unlink($originalimage);
		
				$image = new imageResizer($TargetFile);
		
		//PF SYSTEM THUMBS
				$Thumb = $MediaPath.$OriginalFileName[0] . "_sm." . "jpg";
				$image->resize(50, 50, 50, 50);
				$image->save($_SERVER['DOCUMENT_ROOT']."/".$Thumb, JPG);
				chmod($_SERVER['DOCUMENT_ROOT']."/".$Thumb,0777);
				
				$image = null;
				
			} else {
				if (($file_extension == 'zip') || ($file_extension == 'pdf'))
					$FileType='download';
				else if ($file_extension == 'swf')
					$FileType='media';
				else if ($file_extension == 'flv')
					$FileType='media';
				else if ($file_extension == 'css')
					$FileType='webdocs';
				else 
					$FileOk = 0;	
					
				$originalfile = $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/temp/".$Filename;
				$TargetFile = $_SERVER['DOCUMENT_ROOT']."/".$MediaPath. $Filename;
				//$Filename = $randName.'.'.$file_extension;
				if ($FileOk == 1)
					copy($originalfile,$TargetFile);
					@unlink($originalfile);
			}
		
			
			if ($FileOk == 1) {
				chmod($TargetFile,0777);
				$TargetFile = $MediaPath.$Filename;
				//print 'TARGET FILE = ' . $TargetFile;
				if ($ProjectID == '')
				$query = "INSERT into pf_media (Filename, ".$TargetName.", FileType, Thumb, Height, Width, Server) values ('$TargetFile','$TargetID','$FileType','$Thumb','$Height','$Width','".$_SERVER['SERVER_NAME']."')";
				else
					
					$query = "INSERT into pf_media (Filename, ".$TargetName.", FileType, Thumb, UploadBy, Height, Width, Server) values ('$TargetFile','$TargetID','$FileType','$Thumb','$UserID','$Height','$Width','".$_SERVER['SERVER_NAME']."')";
				$db->query($query);
				//print $query.'<br/>';
				$query ="SELECT ID from pf_media WHERE ".$TargetName."='$TargetID' and Filename='$TargetFile'";
				$PageID = $db->queryUniqueValue($query);
				//print $query.'<br/>';
				$Encryptid = substr(md5($PageID), 0, 8).dechex($PageID);
				$query = "UPDATE pf_media SET EncryptID='$Encryptid' WHERE ID='$PageID'";
				$db->query($query);	
			//print $query.'<br/>';
			}
			
} else {
    	echo "There was an error uploading the file, please try again!<br/><input type='button' onclick='document.location.href=\"includes/media_upload_inc.php\";' value='GO BACK'>";
}
			
			// BUILD UPDATE STRING 
			$query = "SELECT * from pf_media where ".$TargetName."='$TargetID' and FileType='image'";
			//print $query.'<br/>';
				$db->query($query);
				$TotalImages = $db->numRows();
				$ImageCount = 0;
				$ImageMediaString = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>";
				while ($line = $db->FetchNextObject()) {
					$ImageCount++;
					if ($line->Server == '') 
						$Server = 'http://www.wevolt.com';
					else 
						$Server = 'http://'.$line->Server;

					$FileServer = explode('.',$line->Server);
					if ($FileServer[0] == 'users') 	
						$SelectFileServer = 'http://users.wevolt.com';
					else 
						$SelectFileServer = 'http://wevolt.com';	
					
					$ImageMediaString .= "<td><img src=\"/".$line->Thumb."\" id=\"thumb_".$line->ID."\" border=\"1\" style=\"border:#fffff solid 1px;\" vspace=\"2\" hspace=\"2\"><br/>[<a href=\"javascript:void(0)\" onclick=\"select_image(\'".$line->Height."\',\'".$line->Width."\',\'".$line->Filename."\',\'".$SelectFileServer."\');return false;\">SELECT</a>]</td>";

					if ($ImageCount == 3) {
							$ImageMediaString .= '</tr><tr>';
							$ImageCount = 0;
						}
						
			
				}
				if (($ImageCount < 3) && ($ImageCount != 0)) {
					while ($ImageCount < 3) {
							$ImageMediaString .= '<td></td>';
							$ImageCount++;
					}
				}
				$ImageMediaString .= '</tr></table>';
		
		/*
		$query = "SELECT * from pf_media where (".$TargetName."='$TargetID' or ((WorldID='$WorldID' and WorldID!=''))) and FileType='media'";
		$imageuploaddb->query($query);
		$MediaCount = 0;
		$TotalMedia = $imageuploaddb->numRows();
		$MediaMediaString = '<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>';
		while ($line = $imageuploaddb->FetchNextObject()) {
		$MediaCount++;
			$MediaMediaString .= '<td><img src=\"/'.$line->Thumb.'" id=\"thumb_'.$line->ID.'\"><br/>[<a href=\"#\" onclick=\"select_imedia(\''.$line->ID.'\');retun false;\">SELECT</a>]<br/>[<a href=\"'.$line->Filename.'\" rel=\"lightbox\">VIEW</a>]</td>';
			if ($MediaCount == 4) 
				$MediaMediaString .= '</tr><tr>';
			
		}
		if (($MediaCount < 4) && ($MediaCount != 0)) {
			while ($MediaCount < 4) {
				$MediaMediaString .= '<td></td>';
				$MediaCount++;
			}
		}
		$MediaMediaString .= '</tr></table>';
		
		$query = "SELECT * from pf_media where (".$TargetName."='$TargetID' or ((WorldID='$WorldID' and WorldID!=''))) and FileType='download'";
		$imageuploaddb->query($query);
		$DownloadMediaCount = 0;
		$TotalDownloads = $imageuploaddb->numRows();
		$DownloadMediaString = '<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>';
		while ($line = $imageuploaddb->FetchNextObject()) {
			$MediaCount++;
			$DownloadMediaString .= '<td align=\"center\"><img src=\"/'.$line->Thumb.'\" id="\thumb_'.$line->ID.'\"><br/>[<a href=\"#\" onclick=\"select_download(\''.$line->ID.'\');retun false;\">SELECT</a>]<br/>[<a href=\"'.$line->Filename.'\" rel=\"lightbox\">VIEW</a>]</td>';
			if ($MediaCount == 4) 
				$DownloadMediaString .= '</tr><tr>';
			
		}
		if (($MediaCount < 4) && ($MediaCount != 0)) {
			while ($MediaCount < 4) {
				$DownloadMediaString .= '<td></td>';
				$MediaCount++;
			}
		}
		$DownloadMediaString .= '</tr></table>';
		*/
		$db->close();
		?>
		<script language="javascript" type="text/javascript">
		
		from_mysql_obj          = window.parent.document.getElementById( 'imagesdiv' );
		from_mysql_obj.innerHTML = '<?php echo $ImageMediaString; ?>';
		
		//from_mysql_obj          = window.parent.document.getElementById( 'mediadiv' );
		//from_mysql_obj.innerHTML = '<?php //echo $MediaMediaString; ?>';
		
		//from_mysql_obj          = window.parent.document.getElementById( 'downloadsdiv' );
		//from_mysql_obj.innerHTML = '<?php //echo $DownloadMediaString; ?>';
		document.location.href = 'includes/media_upload_inc.php';
		</script>
	
</div>