<? 
$query ="SELECT p.userid, p.CreatorID, cs.Assistant1, cs.Assistant2, cs.Assistant3, cs.CreatorOne, cs. CreatorTwo, cs.CreatorThree
         from projects as p
		 join comic_settings as cs on cs.ComicID=p.ProjectID 
		 where p.ProjectID='".$_SESSION['sessionproject']."'";
	
$AccessArray = $InitDB->queryUniqueObject($query);

if (
		($AccessArray->userid == $_SESSION['userid']) || 
		($AccessArray->CreatorID == $_SESSION['userid']) || 
		(($AccessArray->Assistant1 == $_SESSION['userid'])||($AccessArray->Assistant1 == trim($_SESSION['username']))) ||
		(($AccessArray->Assistant2 == $_SESSION['userid'])||($AccessArray->Assistant2 == trim($_SESSION['username']))) ||
		(($AccessArray->Assistant3 == $_SESSION['userid'])||($AccessArray->Assistant3 == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorOne == $_SESSION['userid'])||($AccessArray->CreatorOne == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorTwo == $_SESSION['userid'])||($AccessArray->CreatorTwo == trim($_SESSION['username']))) ||
		(($AccessArray->CreatorThree == $_SESSION['userid'])||($AccessArray->CreatorThree == trim($_SESSION['username'])))
	)
	$Auth = 1;
else
	$Auth = 0;
	
unset($AccessArray);

if ($Auth == 1) {	
if (($_GET['a'] == '') && ($_GET['sub'] == '')) {
		$query = "SELECT bp.*,bc.Title as CategoryTitle from pfw_blog_posts as bp
				  left join pfw_blog_categories as bc on bc.EncryptID=bp.Category
		 		  where (bp.ComicID ='".$_SESSION['sessionproject']."' or (bp.WorldID='$WorldID' and bp.WorldID!='')) order by bp.PublishDate DESC";
		$pagination    =    new pagination();  
		
	$pagination->createPaging($query,$NumItemsPerPage);
	$PostString = '';
	 
  //  $InitDB->query($query);
		$PostCount = 0;
	 while($line=mysql_fetch_object($pagination->resultpage)) {

	  			$PostString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$PostString .= '<table width="100%"><tr><td class="grey_cmsboxcontent" width="300">';
			 $PostString .= $line->Title.'</td>';
			$PostString .= '<td width="300" align="left" class="grey_cmsboxcontent"><b>Publish Date: </b>'.date('m-d-Y',strtotime($line->PublishDate)).'<br/><b>Category: </b>'.$line->CategoryTitle.'</td>';
			$PostString .= '<td class="grey_cmsboxcontent" align="right" style="font-size:10px;"><a href="/'.$_SESSION['pfdirectory'].'/section/blog_inc.php?postid='.$line->EncryptID.'&section='.$Section.'&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="javascript:void(0);" onclick="delete_post(\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a></td>';
		 
			$PostString.='</tr></table>';
						
				$PostString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
			$PostCount++;
		} 
		
		
		
		
		
	} else if (($_GET['a']=='') && ($_GET['sub'] == 'cat')) {
		$query = "SELECT * from pfw_blog_categories where ComicID ='".$_SESSION['sessionproject']."' or (WorldID='$WorldID' and WorldID!='')";
		$pagination    =    new pagination();  
	$pagination->createPaging($query,$NumItemsPerPage);
	$CatString = '';
	 
  //  $InitDB->query($query);
		$CatCount = 0;
	 while($line=mysql_fetch_object($pagination->resultpage)) {
  	 	
	  	$PostString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
												
				$PostString .= '<table width="100%"><tr><td class="grey_cmsboxcontent" width="300">';
			 $PostString .= $line->Title.'</td>';
			$PostString .= '<td width="300" align="left" class="grey_cmsboxcontent"><b>DEFAULT:</b>'.$line->IsDefault.'</td>';
			$PostString .= '<td class="grey_cmsboxcontent" align="right" style="font-size:10px;"><a href="/'.$_SESSION['pfdirectory'].'/section/blog_inc.php?cid='.$line->EncryptID.'&section='.$Section.'&sub=cat&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="javascript:void(0);" onclick="delete_cat(\''.$line->EncryptID.'\');"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a></td>';
		 
			$PostString.='</tr></table>';
						
				$PostString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
			$PostCount++;
			
		
	}
	
	} else if ( ($_GET['a'] == 'finish') && ($_GET['sub']=='')) {

			$HtmlContent = $_POST['content'];
			if (substr($HtmlContent,0,3) == '<p>') 
			$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);
			$Title = mysql_real_escape_string($_POST['txtTitle']);
			$PublishDate = substr($_POST['txtDatelive'],6,4).'-'.substr($_POST['txtDatelive'],0,2).'-'.substr($_POST['txtDatelive'],3,2).'-'.' 00:00:00';			
			$Category = $_POST['txtCategory'];
			$Author = mysql_real_escape_string($_SESSION['username']);
			$Filename= date('Y_m_d_h_i_d');
			$TargetFile=$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/blog/".$Filename.".html";
			
			//print 'TARGET = ' . $TargetFile;
			
			if(!is_dir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/blog")) 
					mkdir($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/blog", 0777);

			$query = "INSERT into pfw_blog_posts (Title, ComicID, ProjectID, Filename, Author, PublishDate,Category, Tags, AccessType) values ('$Title',
			'".$_SESSION['sessionproject']."',
			'".$_SESSION['sessionproject']."','$TargetFile','$Author','$PublishDate','$Category','".mysql_real_escape_string($_POST['txtTags'])."','".$_POST['txtAccessType']."')";
			$InitDB->execute($query);
			//print $query.'<br/>';
			$query ="SELECT ID from pfw_blog_posts WHERE ComicID='".$_SESSION['sessionproject']."' and Filename='$TargetFile'";
			$BID = $InitDB->queryUniqueValue($query);
			//print $query.'<br/>';
			$Encryptid = substr(md5($BID), 0, 15).dechex($BID);
			$IdClear = 0;
			$Inc = 5;
			while ($IdClear == 0) {
					$query = "SELECT count(*) from pfw_blog_posts where EncryptID='$Encryptid'";
					$Found = $InitDB->queryUniqueValue($query);
					$output .= $query.'<br/>';
					if ($Found == 1) {
						$Encryptid = substr(md5(($BID+$Inc)), 0, 15).dechex($BID+$Inc);
					} else {
						$query = "UPDATE pfw_blog_posts SET EncryptID='$Encryptid' WHERE ID='$BID'";
						$InitDB->execute($query);
						$output .= $query.'<br/>';
						$IdClear = 1;
					}
					$Inc++;
			}
			//print $query.'<br/>';

			$newfile= $_SERVER['DOCUMENT_ROOT']."/".$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/blog/".$Filename.".html";
			$file = fopen ($newfile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod($newfile,0777);		
			InsertProjectContent('new', $_SESSION['sessionproject'], $Encryptid, 'blog post', $_SESSION['userid'],'');
			header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php");
	} else if (($_GET['a'] == 'save') && ($_GET['sub'] == '')) {

			$HtmlContent = $_POST['content'];
			if (substr($HtmlContent,0,3) == '<p>') 
			$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);
			$Title = mysql_real_escape_string($_POST['txtTitle']);
			$PublishDate = substr($_POST['txtDatelive'],6,4).'-'.substr($_POST['txtDatelive'],0,2).'-'.substr($_POST['txtDatelive'],3,2).' 00:00:00';
			$Category = $_POST['txtCategory'];
			$Author = mysql_real_escape_string($_SESSION['username']);
			$Filename= $_POST['txtFilename'];
			//$TargetFile=$_SESSION['basefolder']."/".$_SESSION['projectfolder']."/blog/".$Filename.".html";
			
			$query = "UPDATE pfw_blog_posts set Title='$Title', Author='$Author', PublishDate='$PublishDate', Category ='$Category', AccessType='".$_POST['txtAccessType']."',Tags='".mysql_real_escape_string($_POST['txtTags'])."' where EncryptID='".$_GET['postid']."' and ComicID='".$_SESSION['sessionproject']."'";
			$InitDB->execute($query);
			
			$query = "UPDATE projects set PagesUpdated='$PublishDate' where ProjectID='".$_SESSION['sessionproject']."'";
			$InitDB->execute($query);
			

			$newfile=$_SERVER['DOCUMENT_ROOT'].'/'.$Filename;
			$file = fopen ($newfile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod($newfile,0777);
			
			header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php");
	} else if (($_GET['a'] == 'edit') && ($_GET['sub'] == '')) {

			$query = "SELECT * from pfw_blog_posts where EncryptID='".$_GET['postid']."' and ComicID='".$_SESSION['sessionproject']."'";
			$PostArray = $InitDB->queryUniqueObject($query);
			$query = "SELECT cp.title, cp.ThumbSm,se.* from story_flow_entries as se 
			          join comic_pages as cp on (cp.EncryptPageID=se.page_id and cp.comicid=se.project_id)
					  where se.content_id='".$_GET['postid']."' and se.project_id='".$_SESSION['sessionproject']."' and se.content_type='blog'";
			$FlowArray = $InitDB->queryUniqueObject($query);
			$Title = $PostArray->Title;
			$Category = $PostArray->Category;
			$PublishDate = date('m-d-Y',strtotime($PostArray->PublishDate));
			$Filename = $PostArray->Filename;
			//print_r($PostArray);
			$HtmlContent = file_get_contents('http://www.wevolt.com/'.$Filename);
				
	} else if (($_GET['a'] == 'delete') && ($_GET['sub'] == '')) {

			$query = "DELETE from pfw_blog_posts where EncryptID='".$_GET['postid']."' and ComicID='".$_SESSION['sessionproject']."'";
			$InitDB->execute($query);
			
			header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php");
			
	} else if (($_GET['a'] == 'finish') && ($_GET['sub'] == 'cat')) {
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$IsDefault = $_POST['txtDefault'];
		
		if ($WorldID == '')
			$WorldID = 0;
		$query = "INSERT into pfw_blog_categories (Title, IsDefault, ComicID, WorldID, AccessType) values ('$Title','$IsDefault','".$_SESSION['sessionproject']."','$WorldID','".$_POST['txtAccessType']."')";
		$InitDB->execute($query);
		$query ="SELECT ID from pfw_blog_categories WHERE ComicID='".$_SESSION['sessionproject']."' and Title='$Title'";
		$CatID = $InitDB->queryUniqueValue($query);
		$Encryptid = substr(md5($CatID), 0, 8).dechex($CatID);
		$query = "UPDATE pfw_blog_categories SET EncryptID='$Encryptid' WHERE ID='$CatID'";
		$InitDB->execute($query);
	
header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php?sub=cat");
	} else if ( ($_GET['a'] == 'edit') && ($_GET['sub'] == 'cat')) {
		$query ="SELECT * from pfw_blog_categories where EncryptID='".$_GET['cid']."'";
		$CatArray = $InitDB->queryUniqueObject($query);
		$Title = $CatArray->Title;
		$IsDefault = $CatArray->IsDefault;
		
	} else if (($_GET['a'] == 'save') && ($_GET['sub'] == 'cat')) {
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$IsDefault = $_POST['txtDefault'];
		$query ="UPDATE pfw_blog_categories set Title='$Title', IsDefault='$IsDefault', AccessType='".$_POST['txtAccessType']."' where EncryptID='".$_GET['cid']."'";
		$InitDB->execute($query);
		
		header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php?sub=cat");
		
	} else if (($_GET['a'] == 'delete') && ($_GET['sub'] == 'cat')) {

		$query ="DELETE from pfw_blog_categories where EncryptID='".$_GET['cid']."'";
		$InitDB->execute($query);
		header("location:/".$_SESSION['pfdirectory']."/section/blog_inc.php?sub=cat");
		
	} 
	
}
?>