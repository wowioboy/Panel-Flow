<? 


if (($Section =='blog') && (!isset($_GET['a'])) && (!isset($_GET['sub']))) {
		$query = "SELECT bp.*,bc.Title as CategoryTitle from pfw_blog_posts as bp
				  join pfw_blog_categories as bc on bc.EncryptID=bp.Category
		 		  where (bp.ComicID ='$ComicID' or (bp.WorldID='$WorldID' and bp.WorldID!=''))";
		$pagination    =    new pagination();  
	$pagination->createPaging($query,$NumItemsPerPage);
	$PostString = '';
	 
  //  $comicsDB->query($query);
		$PostCount = 0;
	 while($line=mysql_fetch_object($pagination->resultpage)) {
  	 	
	  	$BoxType = 'white_box';
		$TypeImage = 'standard_type.jpg';

		$PostString .='<div>';
		$PostString .=' <b class="'.$BoxType.'">';
		$PostString .=' <b class="'.$BoxType.'1"><b></b></b>';
		$PostString .=' <b class="'.$BoxType.'2"><b></b></b>';
		$PostString .=' <b class="'.$BoxType.'3"></b>';
		$PostString .='	<b class="'.$BoxType.'4"></b>';
		$PostString .='	<b class="'.$BoxType.'5"></b></b>';
		$PostString .='<div class="'.$BoxType.'fg">';
     	$PostString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
		 $PostString .= '<td width="300" style="padding-left:5px;" align="left">'.$line->Title.'</td>';
	  	$PostString .= '<td width="200" valign="top"  align="left"><b>Publish Date: </b>'.date('m-d-Y',strtotime($line->PublishDate)).'</td>';
		$PostString .= '<td width="200" valign="top" align="left"><b>AUTHOR: </b>'.$line->Author.'</td>';
		$PostString .= '<td width="200" valign="top" align="left"><b>Category: </b>'.$line->CategoryTitle.'</td>';
		$PostString .= '<td width="100" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?postid='.$line->EncryptID.'&section='.$Section.'&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?postid='.$line->EncryptID.'&section='.$Section.'&a=delete">DELETE</a>]</td></tr>';
	 
		$PostString .= '</table>';
  
  		$PostString .=' </div>';
  		$PostString .='<b class="'.$BoxType.'">';
  		$PostString .='<b class="'.$BoxType.'5"></b>';
  		$PostString .=' <b class="'.$BoxType.'4"></b>';
  		$PostString .='<b class="'.$BoxType.'3"></b>';
  		$PostString .='<b class="'.$BoxType.'2"><b></b></b>';
  		$PostString .='<b class="'.$BoxType.'1"><b></b></b></b>';
		$PostString .='</div><div class="spacer"></div>';
		$PostCount++;
		
	}
	} else if (($Section =='blog') && (!isset($_GET['a'])) && ($_GET['sub'] == 'cat')) {
		$query = "SELECT * from pfw_blog_categories where ComicID ='$ComicID' or (WorldID='$WorldID' and WorldID!='')";
		$pagination    =    new pagination();  
	$pagination->createPaging($query,$NumItemsPerPage);
	$CatString = '';
	 
  //  $comicsDB->query($query);
		$CatCount = 0;
	 while($line=mysql_fetch_object($pagination->resultpage)) {
  	 	
	  	$BoxType = 'white_box';
		$TypeImage = 'standard_type.jpg';

		$CatString .='<div>';
		$CatString .=' <b class="'.$BoxType.'">';
		$CatString .=' <b class="'.$BoxType.'1"><b></b></b>';
		$CatString .=' <b class="'.$BoxType.'2"><b></b></b>';
		$CatString .=' <b class="'.$BoxType.'3"></b>';
		$CatString .='	<b class="'.$BoxType.'4"></b>';
		$CatString .='	<b class="'.$BoxType.'5"></b></b>';
		$CatString .='<div class="'.$BoxType.'fg">';
     	$CatString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
		 $CatString .= '<td width="110" style="padding-left:5px;">'.$line->Title.'</td>';
		$CatString .= '<td width="250" valign="top" class="pageboxtext" align="left"><b>DEFAULT:</b>'.$line->IsDefault.'</td>';
		$CatString .= '<td width="200" class="pageboxtext" align="center">[<a href="/cms/edit/'.$SafeFolder.'/?postid='.$line->EncryptID.'&section='.$Section.'&sub=cat&a=edit">EDIT</a>]&nbsp;[<a href="/cms/edit/'.$SafeFolder.'/?postid='.$line->EncryptID.'&section='.$Section.'&sub=cat&a=delete">DELETE</a>]</td></tr>';
	 
		$CatString .= '</table>';
  
  		$CatString .=' </div>';
  		$CatString .='<b class="'.$BoxType.'">';
  		$CatString .='<b class="'.$BoxType.'5"></b>';
  		$CatString .=' <b class="'.$BoxType.'4"></b>';
  		$CatString .='<b class="'.$BoxType.'3"></b>';
  		$CatString .='<b class="'.$BoxType.'2"><b></b></b>';
  		$CatString .='<b class="'.$BoxType.'1"><b></b></b></b>';
		$CatString .='</div><div class="spacer"></div>';
		$CatCount++;
	
	
	}
	
	} else if (($Section =='blog') && ($_GET['a'] == 'finish') && (!isset($_GET['sub']))) {

			$HtmlContent = $_POST['content'];
			if (substr($HtmlContent,0,3) == '<p>') 
			$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);
			$Title = mysql_real_escape_string($_POST['txtTitle']);
			$PublishDate = substr($_POST['txtDatelive'],6,4).'-'.substr($_POST['txtDatelive'],0,2).'-'.substr($_POST['txtDatelive'],3,2).'-'.' 00:00:00';
			
			$Category = $_POST['txtCategory'];
			$Author = mysql_real_escape_string($_SESSION['username']);
			$Filename= date('Y_m_d_hh_mm_ss');
			$TargetFile="comics/".$ComicDirectory."/blog/".$Filename.".html";
			
			$query = "INSERT into pfw_blog_posts (Title, ComicID, Filename, Author, PublishDate,Category) values ('$Title',
			'$ComicID','$TargetFile','$Author','$PublishDate','$Category')";
			$comicsDB->execute($query);
			print $query.'<br/>';
			$query ="SELECT ID from pfw_blog_posts WHERE ComicID='$ComicID' and Filename='$TargetFile'";
			$BID = $comicsDB->queryUniqueValue($query);
			print $query.'<br/>';
			$Encryptid = substr(md5($BID), 0, 8).dechex($BID);
			$query = "UPDATE pfw_blog_posts SET EncryptID='$Encryptid' WHERE ID='$BID'";
			$comicsDB->execute($query);
			print $query.'<br/>';
			
			if(!is_dir("../comics/".$ComicDirectory ."/blog")) mkdir("../comics/".$ComicDirectory ."/blog", 0777);

			$newfile="../comics/".$ComicDirectory."/blog/".$Filename.".html";
			$file = fopen ($newfile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod($newfile,0777);
			
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$Encryptid,'a'=>'new','s'=>'post');
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//if ($_SESSION['userid'] == '9778d5d252') 
				//print 'UPDATE RESULT = ' . $updateresult;
			unset($post_data);
			//if ($_SESSION['userid'] != '9778d5d252') 
			header("location:/cms/edit/".$SafeFolder."/?section=blog");
			
			

	} else if (($Section =='blog') && ($_GET['a'] == 'save') && (!isset($_GET['sub']))) {

			$HtmlContent = $_POST['content'];
			if (substr($HtmlContent,0,3) == '<p>') 
			$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);
			$Title = mysql_real_escape_string($_POST['txtTitle']);
			$PublishDate = substr($_POST['txtDatelive'],6,4).'-'.substr($_POST['txtDatelive'],0,2).'-'.substr($_POST['txtDatelive'],3,2).' 00:00:00';
			$Category = $_POST['txtCategory'];
			$Author = mysql_real_escape_string($_SESSION['username']);
			$Filename= $_POST['txtFilename'];
			$TargetFile="comics/".$ComicDirectory."/blog/".$Filename.".html";
			
			$query = "UPDATE pfw_blog_posts set Title='$Title', Author='$Author', PublishDate='$PublishDate', Category ='$Category' where EncryptID='".$_GET['postid']."' and ComicID='$ComicID'";
			$comicsDB->execute($query);
			

			$newfile="../".$Filename;
			$file = fopen ($newfile, "w");
			fwrite($file, $HtmlContent);
			fclose ($file); 
			chmod($newfile,0777);
			
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$_GET['postid'],'a'=>'edit','s'=>'post');
			$updateresult = $curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//print 'UPDATE RESULT = ' . $updateresult;
			unset($post_data);
			header("location:/cms/edit/".$SafeFolder."/?section=blog");
			
			

	} else if (($Section =='blog') && ($_GET['a'] == 'edit') && (!isset($_GET['sub']))) {

			$query = "SELECT * from pfw_blog_posts where EncryptID='".$_GET['postid']."' and ComicID='$ComicID'";
			$PostArray = $comicsDB->queryUniqueObject($query);
			$Title = $PostArray->Title;
			$Category = $PostArray->Category;
			$PublishDate = date('m-d-Y',strtotime($PostArray->PublishDate));
			$Filename = $PostArray->Filename;
			///print $query.'<br/>';
			//print 'FILENAME = ' . $Filename.'<br/>';
			$HtmlContent = file_get_contents('../'.$Filename);
				
	} else if (($Section =='blog') && ($_GET['a'] == 'delete') && (!isset($_GET['sub']))) {

			$query = "DELETE from pfw_blog_posts where EncryptID='".$_GET['postid']."' and ComicID='$ComicID'";
			$comicsDB->execute($query);
			$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$_GET['postid'],'a'=>'delete','s'=>'post');
			$curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//print $updateresult;
			unset($post_data);
			header("location:/cms/edit/".$SafeFolder."/?section=blog");
			
	} else if (($Section =='blog') && ($_GET['a'] == 'finish') && ($_GET['sub'] == 'cat')) {
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$IsDefault = $_POST['txtDefault'];
		
		if ($WorldID == '')
			$WorldID = 0;
		$query = "INSERT into pfw_blog_categories (Title, IsDefault, ComicID, WorldID) values ('$Title','$IsDefault','$ComicID','$WorldID')";
		$comicsDB->execute($query);
		$query ="SELECT ID from pfw_blog_categories WHERE ComicID='$ComicID' and Title='$Title'";
		$CatID = $comicsDB->queryUniqueValue($query);
		$Encryptid = substr(md5($CatID), 0, 8).dechex($CatID);
		$query = "UPDATE pfw_blog_categories SET EncryptID='$Encryptid' WHERE ID='$CatID'";
		$comicsDB->execute($query);
		$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$Encryptid,'a'=>'new','s'=>'cat');
			$curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//print $updateresult;
			unset($post_data);
		header("location:/cms/edit/".$SafeFolder."/?section=blog&sub=cat");
	} else if (($Section =='blog') && ($_GET['a'] == 'edit') && ($_GET['sub'] == 'cat')) {
		$query ="SELECT * from pfw_blog_categories where EncryptID='".$_GET['postid']."'";
		$CatArray = $comicsDB->queryUniqueObject($query);
		$Title = $CatArray->Title;
		$IsDefault = $CatArray->IsDefault;
	} else if (($Section =='blog') && ($_GET['a'] == 'save') && ($_GET['sub'] == 'cat')) {
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$IsDefault = $_POST['txtDefault'];
		$query ="UPDATE pfw_blog_categories set Title='$Title', IsDefault='$IsDefault' where EncryptID='".$_GET['postid']."'";
		$comicsDB->execute($query);
		$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$_GET['postid'],'a'=>'edit','s'=>'cat');
			$curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//print $updateresult;
			unset($post_data);
		header("location:/cms/edit/".$SafeFolder."/?section=blog&sub=cat");
		
	} else if (($Section =='blog') && ($_GET['a'] == 'delete') && ($_GET['sub'] == 'cat')) {

		$query ="DELETE from pfw_blog_categories where EncryptID='".$_GET['postid']."'";
		$comicsDB->execute($query);
		$ConnectKey = createKey();
			$query = "UPDATE users set ConnectKey='$ConnectKey' where encryptid='".$_SESSION['userid']."'";
			$comicsDB->query($query);
			
			///GRAB TEMPLATE INFORMATION
			$post_data = array('u' => $_SESSION['userid'], 'c' => $ComicID, 'k' => $ConnectKey,'p'=>$_GET['postid'],'a'=>'delete','s'=>'cat');
			$curl->send_post_data($ApplicationLink."/connectors/import_blog.php", $post_data);
			//print $updateresult;
			unset($post_data);
		header("location:/cms/edit/".$SafeFolder."/?section=blog&sub=cat");
		
	} 
	
	
?>