<? 
include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
	 include_once(INCLUDES.'/db.class.php');
function insertUpdate($ActionSection, $ActionType, $ActionID, $UpdateType, $UserID,$Link,$ContentID,$LiveDate='',$ContentTitle='') {
		 $DB=new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
	 
			$NOW = date('Y-m-d h:i:s');
			$UDate = date('Y-m-d');
			if ($LiveDate == '') {
				$query = "INSERT into updates (ActionSection, ActionType, ActionID, UpdateType, UserID, Link,content_id,content_title) values ('$ActionSection', '$ActionType', '$ActionID', '$UpdateType', '$UserID','$Link','$ContentID','".mysql_real_escape_string($ContentTitle)."')";
				
			} else {
				$query = "INSERT into updates (ActionSection, ActionType, ActionID, UpdateType, UserID, Link,content_id,live_date,content_title) values ('$ActionSection', '$ActionType', '$ActionID', '$UpdateType', '$UserID','$Link','$ContentID','$LiveDate','".mysql_real_escape_string($ContentTitle)."')";
				
			}
			$DB->execute($query);
			$Output = $query;
			$DB->close();
return $Output;


}
function saveProjectContent($Action, $ProjectID, $ContentID, $ContentType, $UserID) {
 	
	
$db=new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
	$query = "SELECT * from projects where ProjectID='$ProjectID'";
	$ProjectArray = $db->queryUniqueObject($query);
	$HostedUrl = $ProjectArray->HostedUrl;
	$SafeFolder = $ProjectArray->SafeFolder;
	$ProjectDirectory = $ProjectArray->ProjectDirectory;				
		if (($Action == 'add')||($Action == 'new')) {
			if (($ContentType == 'pages') || ($ContentType == 'pencils')|| ($ContentType == 'inks')|| ($ContentType == 'letters')|| ($ContentType == 'colors')|| ($ContentType == 'script')|| ($ContentType == 'extras')){
					$query = "SELECT * from comic_pages where EncryptPageID='$ContentID' and ComicID='$ProjectID'";
					$ContentArray = $db->queryUniqueObject($query);
					//print $query.'<br/>';
					$ContentTitle =  mysql_real_escape_string($ContentArray->Title);
					$ContentThumb = $ContentArray->ThumbMd;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
				//	print $query.'<br/>';
					$ContentURL = 'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/reader/';
					if ($ContentArray->SeriesNum != 1)
						$ContentURL .= 'series/'.$ContentArray->SeriesNum.'/';
					$ContentURL .= 'episode/'.$ContentArray->EpisodeNum.'/';
					$ContentURL .= 'page/'.$ContentArray->EpPosition.'/';
					insertUpdate('page', 'posted', $ContentID, 'project', $UserID,$ContentURL,$ProjectID,$ContentArray->PublishDate,$ContentArray->Title);
			} else if ($ContentType == 'characters') {
					$query = "SELECT * from characters where EncryptID='$ContentID' and (ComicID='$ProjectID' or ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
					$ContentTitle =  mysql_real_escape_string($ContentArray->Name);
					$ContentThumb = $ProjectDirectory.'/'.$HostedUrl.'/'.$ContentArray->Thumb;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
					insertUpdate('characters', 'posted', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/characters/',$ProjectID,$ContentArray->Name);

			} else if ($ContentType == 'downloads') {
					$query = "SELECT * from comic_downloads where EncryptID='$ContentID' and (ComicID='$ProjectID' or ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
					
					$ContentTitle =  mysql_real_escape_string($ContentArray->Name);
					$ContentThumb = $ProjectDirectory.'/'.$HostedUrl.'/'.$ContentArray->Thumb;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
					insertUpdate('downloads', 'posted', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/downloads/',$ProjectID,$ContentArray->Name);
					
			} else if ($ContentType == 'link') {
					$query = "SELECT * from links where EncryptID='$ContentID' and (ComicID='$ProjectID' or ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
					
					$ContentTitle =  mysql_real_escape_string($ContentArray->Title);
					$ContentThumb = $ContentArray->Image;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
					insertUpdate('link', 'created', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/links/',$ProjectID,$ContentArray->Title);
					
			}else if ($ContentType == 'section') {
					$query = "SELECT * from content_section where EncryptID='$ContentID' and (ComicID='$ProjectID' or ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
					$ContentTitle =  mysql_real_escape_string($ContentArray->Title);
					
					insertUpdate('section', 'created', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/'.$ContentTitle.'/',$ProjectID,$ContentArray->Title);
					
			}else if ($ContentType == 'mobile') {
					$query = "SELECT * from mobile_content where EncryptID='$ContentID' and (ComicID='$ProjectID' or ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
					$ContentTitle =  mysql_real_escape_string($ContentArray->Name);
					$ContentThumb = $ContentArray->Thumb;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
				//	print $query.'<br/>';
					insertUpdate('mobile wallpaper', 'posted', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/mobile/',$ProjectID,$ContentArray->Name);
			} else if ($ContentType == 'blog post') {
					$query = "SELECT bp.*,p.Thumb from pfw_blog_posts as bp
							  JOIN projects as p on p.ProjectID=(bp.ProjectID or bp.ComicID)
							  where bp.EncryptID='$ContentID' and (bp.ComicID='$ProjectID' or bp.ProjectID = '$ProjectID')";
					$ContentArray = $db->queryUniqueObject($query);
				//	print $query.'<br/>';
					$ContentTitle =  mysql_real_escape_string($ContentArray->Title);
					$ContentThumb = $ContentArray->Thumb;
					$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ProjectID', '".$_SESSION['userid']."', '$ContentTitle', '$ContentType', '$ContentID','$ContentThumb')";
					$db->execute($query);
				//	print $query.'<br/>';
					insertUpdate('blog', 'posted', $ContentID, 'project', $UserID,'http://'.$_SERVER['SERVER_NAME'].'/'.$SafeFolder.'/blog/?post='.$ContentID,$ProjectID,$ContentArray->Title);
			}
			
		} else if ($Action == 'delete') {
			$query = "DELETE from project_content where ContentID='$ContentID' and ProjectID = '$ProjectID'";
			$db->execute($query);
		//	print $query.'<br/>';
		}


$db->close();

}


 function sendPageConnect($Section, $PageID, $Action, $Fileset,$Status,$PageType) {
 global $AppInstallID, $ApplicationLink, $Section, $ComicID;
 	//require_once("includes/curl_http_client.php"); 
 	//require_once("includes/create_key_func.php");
	////$curl = &new Curl_HTTP_Client();
	//$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
	//$ConnectKey = createKey();
$db=new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
	//$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
	//$db->query($query);
	//$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'s' => $Section,'p' => $PageID,'a' => $Action,'f' => $Fileset,'t'=>$PageType);
	//print_r($post_data);
//	echo ($curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data));
	//print 'c = ' . $ComicID."<br/>";
	//print 's = ' . $Section."<br/>";
	//print 'a = ' . $Action."<br/>";
	//print 'f = ' . $Fileset."<br/>";
	//print 't = ' . $PageType."<br/>";
	//print 'p = ' . $PageID."<br/>";
	saveProjectContent($Action, $ComicID, $PageID, $PageType, $_SESSION['userid']);
	/*
	if ($Action == 'new') {
		$query = "SELECT * from comic_pages where EncryptPageID='$PageID' and ComicID='$ComicID'";
	    $ContentArray = $db->queryUniqueObject($query);
		$ContentTitle =  mysql_real_escape_string($ContentArray->Title);
		$ContentThumb = $ContentArray->ThumbMd;
		$query = "INSERT into project_content (ProjectID, UserID, Title, ContentType, ContentID, Thumb) values ('$ComicID', '".$_SESSION['userid']."', '$ContentTitle', '$PageType', '$PageID','$ContentThumb')";
		$db->execute($query);
		
	} else if ($Action == 'delete') {
		$query = "DELETE from project_content where EncryptPageID='$PageID' and ComicID='$ComicID'";
	    $db->execute($query);
	}*/
//$curl->send_post_data($ApplicationLink."/connectors/import_pages.php", $post_data);
	$db->close();

 }
 
 
 function sendProductConnect($ProductType, $FileChanged, $Action, $ItemID) {
 	global $ApplicationLink, $Section, $ComicID;
		require_once("includes/curl_http_client.php"); 
		$curl = &new Curl_HTTP_Client();
		$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
		$ConnectKey = updateKey();
		$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'a'=>$Action,'f'=>$FileChanged,'t'=>$ProductType,'p'=>$ItemID);
		$ReturnResult = 'APPLINK  = ' . $ApplicationLink .'<br/>COMICID TYPE = ' . $ComicID .'<br/>PRODUCT TYPE = ' . $ProductType .'<br/>ACtion  = '.$Action.'<br/>ITEM ID = ' .$ItemID.'<br/><br/> CONNECT RESULT = ';
		$ReturnResult .= $curl->send_post_data($ApplicationLink."/connectors/import_products.php", $post_data);
		unset($post_data);
		return $ReturnResult;
 }

function updateKey() {
	global $AppInstallID, $ApplicationLink,$db_database,$db_host, $db_user, $db_pass;
		require_once("includes/create_key_func.php");
		$ConnectKey = createKey();
		$db =  new DB($db_database,$db_host, $db_user, $db_pass);
		require_once("includes/create_key_func.php");
		$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
		$db->query($query);
		$db->close();
		
		return $ConnectKey;
}
?>