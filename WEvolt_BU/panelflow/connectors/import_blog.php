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
$Section = $_POST['s']; 
$Action = $_POST['a'];
$ItemID = $_POST['p'];

//print "MY DownID ID + " . $ItemID."<br/>";
//print "MY Section ID + " . $Section."<br/>";
//print "MY Action ID + " . $Action."<br/>";
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
//print $query."<br/>";
//print "USER = " . $UserID."<br/>";
$ComicArray = $settings->queryUniqueObject($query);
$ComicFolder = $ComicArray->url; 
$ComicDirectory = substr($ComicFolder,0,1).'/'.$ComicFolder;
//print "MY COMIC FOLDER = " . $ComicFolder."<br/>";
//print "admin = " . $ComicArray->userid."<br/>";
//print "creator = " . $ComicArray->CreatorID."<br/>";
$post_data = array('u' => $UserID, 'c' => $ComicID, 'l'=>$key, 'k' => $_POST['k']);
$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/get_assistants.php", $post_data);
unset($post_data);
$AssistantArray = explode(',',$updateresult);	
if (($UserID == $ComicArray->userid) || ($UserID == $ComicArray->CreatorID) || (in_array($UserID,$AssistantArray))) {
	$post_data = array('u' => $UserID, 'c' => $ComicID,'p'=>$ItemID, 'k' => $_POST['k'], 'l'=>$key,'s'=>$Section);
	$updateresult = $curl->send_post_data("https://www.panelflow.com/connectors/export_blog.php", $post_data);
	unset($post_data);
	 echo 'EXPORT BLOG = ' . $updateresult.'<br/>';
	if ($updateresult != 'Not Authorized') { 
	    $values = unserialize ($updateresult);
		
		$PublishDate = $values['PublishDate']; 
		$Title = mysql_real_escape_string($values['Title']); 
		$Category = $values['Category']; 
		$Author = mysql_real_escape_string($values['Author']); 
		$Filename = 'http://www.panelflow.com/'.$values['Filename']; 
		$TargetFile = $values['Filename'];
		$HtmlContent = @file_get_contents($Filename);
		print 'MY ACTION = ' . 	$Action.'<br/><br/>';
	if ($Section == 'post') {	
			if ($Action == 'new') {
			 $query = "INSERT into pfw_blog_posts (Title, ComicID, Filename, Author, PublishDate,Category,EncryptID) values ('$Title','$ComicID','$TargetFile','$Author','$PublishDate','$Category','$ItemID')";
					$settings->execute($query);
					print $query.'<br/>';
								
					if(!is_dir("../../comics/".$ComicDirectory ."/blog")) mkdir("../../comics/".$ComicDirectory ."/blog", 0777);
		
					$newfile="../../".$TargetFile;
					$file = fopen ($newfile, "w");
					fwrite($file, $HtmlContent);
					fclose ($file); 
					chmod($newfile,0777);
					
					print $query.'<br/><br/>';
					
			} else if ($Action == 'edit') {
				$query = "UPDATE pfw_blog_posts set Title='$Title', Author='$Author', PublishDate='$PublishDate', Category ='$Category' where EncryptID='$ItemID' and ComicID='$ComicID'";
				$settings->query($query);
				print $query.'<br/><br/>';
				$newfile="../../".$TargetFile;
				$file = fopen ($newfile, "w");
				
				fwrite($file, $HtmlContent);
				fclose ($file); 
				chmod($newfile,0777);
			}  else if ($Action == 'delete') {
				   $query = "DELETE from pfw_blog_posts WHERE EncryptID='$ItemID' and ComicID='$ComicID'";
					$settings->query($query);
				print $query.'<br/><br/>';
			}
	} else if ($Section == 'cat') {
			if ($Action == 'new') {
				 $query = "INSERT into pfw_blog_categories(Title, ComicID, EncryptID) values ('$Title','$ComicID','$ItemID')";
				$settings->execute($query);
				print $query.'<br/>';
			} else if ($Action == 'edit') {
				$query = "UPDATE pfw_blog_categories set Title='$Title' where EncryptID='$ItemID' and ComicID='$ComicID'";
				$settings->query($query);
				print $query.'<br/><br/>';
		
			}  else if ($Action == 'delete') {
				    $query = "DELETE from pfw_blog_categories WHERE EncryptID='$ItemID' and ComicID='$ComicID'";
					$settings->query($query);
					print $query.'<br/><br/>';
 			}
	
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