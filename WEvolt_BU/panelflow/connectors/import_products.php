<?
require_once("../includes/curl_http_client.php");
$curl = &new Curl_HTTP_Client();
$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$curl->set_user_agent($useragent);
$config = array();
include '../includes/db.class.php'; 
include '../includes/config.php';
$ComicID= $_POST['c'];
$UserID = $_POST['u'];
$ItemID = $_POST['p'];
$ProductType = $_POST['t']; 
$Action = $_POST['a'];
$FileSet = $_POST['f']; 

print 'MY ProductType  = ' . $ProductType .'<br/>';
$AdminEmail = $config['adminemail'];
$AdminUserID = $config['adminuserid']; 
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user']; 
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];  
$key = $config['liscensekey'];
$settings = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from comics where comiccrypt ='$ComicID'"; 

$ComicArray = $settings->queryUniqueObject($query); 
$ComicFolder = $ComicArray->url;
 $ComicDir = substr(trim($ComicFolder), 0, 1);
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);

$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p' => $ItemID, 'k' => $_POST['k'], 'l'=>$key,'t'=>$PageType);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_products.php", $post_data);
	unset($post_data);
	echo '<br/>export_pages RESULT = ' . $updateresult.'<br/><br/>';
	if ($updateresult != 'Not Authorized') {
			$values = unserialize ($updateresult);
		$Title = mysql_real_escape_string($values['title']);  
		$Description = mysql_real_escape_string($values['description']); 
		$ProductType = $values['producttype'];
		$Thumbsm = $values['thumbsm'];
		$Thumbmd = $values['thumbmd'];
		$Thumblg = $values['thumblg'];
		$Price = $values['price'];
		$ItemPosition = $values['position']; 
		$PageImage = $values['image'];  
		$Tags = mysql_real_escape_string($values['tags']);  
		$CreateDate = $values['CreateDate'];
		if ($CreateDate == '')
			$CreateDate = date('Y-m-d').' 00:00:00';
//GRAB SMALL THUMB 
//print "THUMBSM = " . $Thumbsm."<br/>";

	if ((($FileSet == 1) || (($Action == 'new') && ($ProductType != 'ebook'))) && ($Action != 'remove')) {
		$NameArray = explode('/',$Thumbsm);
	//	if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumbsm = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
			$NewThumbsm = 'comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbsm)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		unset($NameArray);

//GRAB MEDIUM THUMB
		$NameArray = explode('/',$Thumbmd); 
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumbmd = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
			$NewThumbmd = 'comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
			//$LocalName = '../../'.$Thumbmd;
			//$NewThumbmd = $Thumbmd;
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumbmd)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		
		unset($NameArray);

//GRAB LARGE THUMB
		$NameArray = explode('/',$Thumblg);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
			//$LocalName = '../../'.$NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
			//$NewThumblg = $NameArray[3].'/'.$NameArray[4].'/'.$NameArray[5].'/'.$NameArray[6];
		//} else {
			$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
			$NewThumblg = 'comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[4];
			//$LocalName = '../../'.$Thumblg;
		//	$NewThumblg = $Thumblg;
		//}
		print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($Thumblg)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		 
		unset($NameArray); 
	
	if (($ProductType != 'ebook') && ($ProductType != 'pdf')&& ($ProductType != 'selfpdf')) {	
//GRAB PAGE
   
		$NameArray = explode('/',$PageImage);
		//if (($ComicFolder == '') || ($ComicFolder == '/')) {
				//$LocalName = '../../images/pages/'.$Filename;
		//} else {
		$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/'.$NameArray[4];
		//$NewThumblg = 'comics/'.$ComicDir.'/'.$ComicFolder.'/images/products/thumbs/'.$NameArray[3];
		//$LocalName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$Filename;
		//} 
		 print 'MY LOCALNAME = ' . $LocalName.'<br/><br/>';
		$gif = file_get_contents('http://www.panelflow.com/'.trim($PageImage)) or die('Could not grab the file');
		$fp  = fopen($LocalName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalName,0777);
		}
		if ($PageType == 'script') {
		$FileNameArray = explode('.',$Filename);
		$FileNoExt = $FileNameArray[0];
		$RemoteFile = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.pdf';
		$RemoteHTML = 'http://www.panelflow.com/comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.html';
		
		$LocalPdfName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.pdf';
		$LocalHtmlName = '../../comics/'.$ComicDir.'/'.$ComicFolder.'/images/pages/'.$FileNoExt.'.html';
		//} 
		 print 'MY LOCALNAME = ' . $LocalPdfName.'<br/><br/>';
		$gif = file_get_contents($RemotePDF) or die('Could not grab the file');
		$fp  = fopen($LocalPdfName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalPdfName,0777);
		
		 print 'MY LOCALNAME = ' . $LocalHtmlName.'<br/><br/>';
		$gif = file_get_contents($RemoteHTML) or die('Could not grab the file');
		$fp  = fopen($LocalHtmlName, 'w+') or die('Could not create the file');
		fputs($fp, $gif) or die('Could not write to the file');
		fclose($fp);
		chmod($LocalHtmlName,0777);
				
		}
	}	
		
		
		if ($Action == 'new') {
				$query = "SELECT Position from products WHERE Position=(SELECT MAX(Position) FROM products where ComicID='$ComicID' and ProductType='$ProductType')";
					$MaxPosition = $settings->queryUniqueValue($query);
						echo '<br/>'.$query.'<br/><br/>';
						if ($MaxPosition == '') 
							$MaxPosition = 1;
						echo 'MAX POSITION = ' . $MaxPosition.'<br/>';
						
				$query = "INSERT into products(ComicID, Title, Description, Price, ThumbSm, ThumbMd, ThumbLg, GalleryImage, UploadedBy,EncryptID, ProductType, Position,Tags,CreateDate) values ('$ComicID','$Title', '$Description','$Price','$NewThumbsm','$NewThumbmd','$NewThumblg','$PageImage','$UserID','$ItemID','$ProductType','$MaxPosition','$Tags','$CreateDate')";
				$settings->query($query);
				echo '<br/>'.$query.'<br/><br/>';
				
		} else if ($Action == 'edit') {
				if ($FileSet == 1) {
						$query = "UPDATE products set ThumbSm='$NewThumbsm', ThumbMd='$NewThumbmd', ThumbLg='$NewThumblg', GalleryImage='$PageImage' where EncryptID='$ItemID'";
						$settings->query($query);	
						print '<br/>MY UPDATE QUESRY =='.$query.'<br/><br/>';
				}
				$query = "UPDATE products set Title='$Title', Price='$Price', Description='$Description',Position='$ItemPosition',Tags='$Tags' where EncryptID='$ItemID'";
				$settings->query($query);
				echo '<br/>MY UPDATE QUESRY<br/><br>'.$query.'<br/><br/>';
		} else if ($Action == 'delete') {
					$query = "SELECT Position from products where EncryptID='$ItemID'";
					$CurrentPosition = $settings->queryUniqueValue($query);
					$query = "SELECT Position from products WHERE Position=(SELECT MAX(Position) FROM products where ComicID='$ComicID' and ProductType='$ProductType')";
					$MaxPosition = $settings->queryUniqueValue($query);
					$query = "SELECT ID from products where ComicID='$ComicID' and ProductType='$ProductType' order by Position";
					$settings->query($query);
					$TotalLinks = $settings->numRows(); 
					$CurrentOrder = array();
					$query = "SELECT ID, Position from products where ComicID='$ComicID' and ProductType='$ProductType' and Position BETWEEN '$CurrentPosition' and '$MaxPosition' order by Position";
					$settings->query($query);	
					while ($line = $settings->fetchNextObject()) { 
						$CurrentOrder[] = $line->ID;
					} 
					$UpdatePosition = $CurrentPosition; 
					for ($counter =0; $counter < (sizeof($CurrentOrder)-1); $counter++) {
							$SelectItemID = $CurrentOrder[$counter+1];
							$query = "UPDATE products set Position='$UpdatePosition' where id ='$SelectItemID'";
							$UpdatePosition++; 
							$settings->query($query);
					}
					$query ="DELETE from products WHERE ComicID='$ComicID' and EncryptID='$ItemID'";
					$settings->query($query);	
					
		}
		$settings->close();
		echo 'Finished';
	} else {
		echo 'Not Authorized';
	}
} else {
	echo 'Can\'t Complete Request';
} 
?>