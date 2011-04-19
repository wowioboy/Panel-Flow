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
include_once(INCLUDES.'/content_functions.php');
	
if (($_GET['a']=='') && ($_POST['a'] == '')) {
					$ComicXML = '';
					$query = "SELECT * from mobile_content where ComicID ='".$_SESSION['sessionproject']."'";
					
					$pagination    =    new pagination();  
					$pagination->createPaging($query,$NumItemsPerPage); 
					$DownloadsString = '';
					$TotalDownloads = $pagination->totalresult;
					while($line=mysql_fetch_object($pagination->resultpage)) {
						//$TotalDownloads++;
							$DownloadsString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
	
				$DownloadsString .= '<table width="100%"><tr>';
							$DownloadsString .= '<td width="80" style="padding-left:5px;"><img src="/'.$_SESSION['basefolder'].'/'.$_SESSION['projectfolder'].'/'.$line->Thumb.'" style="border:2px solid #000000;" width="75" height="75"></td>';
							$DownloadsString .= '<td style="padding-left:7px;" width="200" align="left" class="grey_cmsboxcontent"><b>Name: </b></div>'.stripslashes($line->Title).'<div class="spacer"></div><b>Type: </b>'.$line->Type;
														
							$DownloadsString .= '</td>';
							$DownloadsString .= '<td width="150" valign="top" class="grey_cmsboxcontent" align="left"><div style="padding-left:3px;padding-right:2px;height:68px;width:150px;background-color:#ffffff;overflow:hidden">'.nl2br($line->Description).'</div></td>';
							$DownloadsString .= '<td rowspan="2" class="grey_cmsboxcontent" align="right"><a href="/'.$_SESSION['pfdirectory'].'/section/mobile_inc.php?dlid='.$line->EncryptID.'&a=edit&project='.$_SESSION['safefolder'].'"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_box.jpg" border="0"></a>&nbsp;<a href="/'.$_SESSION['pfdirectory'].'/section/mobile_inc.php?dlid='.$line->EncryptID.'&section='.$Section.'&a=delete&project='.$_SESSION['safefolder'].'"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td>';
							
							
							   
							$DownloadsString .= '</tr>';	
							$DownloadsString .= '</table>';
							
							$DownloadsString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';

					}
					
	} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'delete')) {
				
				$query = "SELECT * from mobile_content where ComicID ='$ComicID'";
				
					$query = "SELECT * from mobile_content where ComicID ='".$_SESSION['sessionproject']."' and EncryptID='".$_GET['dlid']."'";	
					
					$DownloadsArray = $InitDB->queryUniqueObject($query);
				 	$output .= $query.'<br/>';
	} else if ($_POST['a'] == 'delete') {
				if ($ContentType != 'story')
					$query = "DELETE from mobile_content where ComicID ='".$_SESSION['sessionproject']."' and EncryptID='".$_POST['txtItem']."'";	

					$InitDB->execute($query);
					$Action = 'delete';
					$DLID =$_POST['txtItem'];
					$output .= $query.'<br/>';
	} else if ($_GET['a'] == 'save') {

		$query = "UPDATE mobile_content SET Title='".mysql_real_escape_string($_POST['txtName'])."',Description='".mysql_real_escape_string($_POST['txtDescription'])."', PrivacySetting='".$_POST['txtPrivacy']."',Tags='".mysql_real_escape_string($_POST['txtTags'])."' WHERE EncryptID='".$_POST['txtItem']."' and ComicID='".$_SESSION['sessionproject']."'";
		$InitDB->execute($query);		

	}			
	
	if (($Action == 'save') || ($_GET['a'] == 'save')||($Action == 'finish')|| ($Action == 'delete')) {

				header("location:/".$_SESSION['pfdirectory']."/section/mobile_inc.php");

	}
} else {

	echo 'You do not have access to this section of the CMS. Please log in under your own account and try again';

}
?>