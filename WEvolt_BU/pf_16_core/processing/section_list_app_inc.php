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
if (($_GET['tab'] == 'content') && ($_GET['section'] == '')) {
	 if ($_GET['sa'] == '') {
			$query = "SELECT * from content_section where ProjectID ='$ProjectID' order by Title";

	//$pagination->createPaging($query,$NumItemsPerPage);
	//$PageString = '';
	 $PostString = '';
  		 $InitDB->query($query);
		$PageCount = 0;
		$PostString = '<div style="overflow:auto;height:600px;">';
	 while($line=$InitDB->FetchNextObject()) {
	  		$PostString .= '<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">';
											
				$PostString .= '<table width="100%"><tr><td class="grey_cmsboxcontent" width="250">';
			if ($line->Title == 'Reader')
				$Title = 'Pages / Reader';
			else 
				$Title = $line->Title;
			 $PostString .= '<b>'.$Title.'</b><div class="spacer"></div>';
			  $PostString .= 'Section: '.$line->TemplateSection;
			 
			 $PostString .=' </td>';
			$PostString .= '<td class="grey_cmsboxcontent" align="left" style="font-size:10px;">';
			if ($line->TemplateSection != 'custom')
				$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&sa=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_edit_template_settings_box.jpg" border="0"></a>&nbsp;&nbsp;';
			else if ($line->TemplateSection == 'custom')
			$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&sa=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_list_content_box.jpg" border="0"></a>&nbsp;&nbsp;';
			
			if (($line->TemplateSection == 'characters') || ($line->TemplateSection == 'downloads')|| ($line->TemplateSection == 'mobile')|| ($line->TemplateSection == 'blog') || ($line->TemplateSection == 'gallery')|| ($line->TemplateSection == 'links')) {
				if ($line->TemplateSection == 'mobile')
				$PostString .= '<a href="/cms/mobile/start/'.$SafeFolder.'/"><img src="http://www.wevolt.com/images/cms/cms_grey_add_box.jpg" border="0"></a>&nbsp;&nbsp;';
				else
				$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section='.$line->TemplateSection.'&a=new"><img src="http://www.wevolt.com/images/cms/cms_grey_add_box.jpg" border="0"></a>&nbsp;&nbsp;';
				$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section='.$line->TemplateSection.'"><img src="http://www.wevolt.com/images/cms/cms_grey_list_content_box.jpg" border="0"></a>&nbsp;&nbsp;';
			} else if ($line->TemplateSection == 'reader') {
				$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section=pages&a=new"><img src="http://www.wevolt.com/images/cms/cms_grey_add_box.jpg" border="0"></a>&nbsp;&nbsp;';
				$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section=pages"><img src="http://www.wevolt.com/images/cms/cms_grey_list_content_box.jpg" border="0"></a>&nbsp;&nbsp;';
			}
				
			
			if (($line->TemplateSection != 'home') &&  ($line->TemplateSection != 'reader')  && ($line->TemplateSection != 'episodes') && ($line->TemplateSection != 'credits') && ($line->TemplateSection != 'archives'))
			$PostString .= '<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&section='.$line->TemplateSection.'&sa=delete"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"></a>&nbsp;</td></tr>';
		 
			$PostString.='</td></tr></table>';
						
				$PostString .= '</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>';
			$PageCount++;
		} 
		$PostString .'</div>';
	} else if (($_GET['sa'] == 'edit')||($_GET['sa'] == 'new')) {
	
		if ($_GET['sa'] == 'edit') {
			$query = "SELECT * from content_section where ProjectID ='$ProjectID' and ID='".$_GET['sectionid']."'";
			$SectionArray = $InitDB->queryUniqueObject($query);
		}
		
		$TemplateSelect ='<select name="templateselect" id="templateselect" onchange="select_template(this.options[this.selectedIndex].value);">';
			$TemplateSelect .="<option value=''>--SELECT TEMPLATE--</option>";
		
	if ((($SectionArray->TemplateSection == 'characters') &&($_GET['sec'] == ''))  || ($_GET['sec'] == 'characters')) {
			
			$TemplateSelect .="<option value='html_one'";
		if ((($SectionArray->Template=='html_one') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'html_one'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnail w/ Reveal</option>";
			
			$TemplateSelect .="<option value='html_two'";
		if ((($SectionArray->Template=='html_two') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'html_two'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnail w/ Pop up</option>";
			
			$TemplateSelect .="<option value='html_three'";
		if ((($SectionArray->Template=='html_three') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'html_three'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Vertical List</option>";
			$TemplateSelect .="<option value='vertical_list'";
		if ((($SectionArray->Template=='vertical_list') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'vertical_list'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Vertical List (Alternating)</option>";
		}
		
		if (((($SectionArray->TemplateSection == 'downloads') || ($SectionArray->TemplateSection == 'mobile')|| ($SectionArray->TemplateSection == 'products'))&&($_GET['sec'] == '')) || ($_GET['sec'] == 'downloads') || ($_GET['sec'] == 'mobile') || ($_GET['sec'] == 'products')) {
			$TemplateSelect .="<option value='tabbed'";
		if ((($SectionArray->Template=='tabbed') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'tabbed'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnail list with tabs for each section</option>";
		
		}
		if ((($SectionArray->TemplateSection == 'archives') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'archives')) {

			$TemplateSelect .="<option value='thumb_list'";
		if ((($SectionArray->Template=='thumb_list') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'thumb_list'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnail list</option>";
			
			$TemplateSelect .="<option value='thumb_list_title'";
		if ((($SectionArray->Template=='thumb_list_title') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'thumb_list_title'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnail list with Page Titles</option>";
			
		}
		
		if ((($SectionArray->TemplateSection == 'reader') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'reader')) {

			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Two Column (Pro Readers Only)</option>";
			
			$TemplateSelect .="<option value='single_column'";
		if ((($SectionArray->Template=='single_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'single_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Single Column</option>";
			
		}
		
		if ((($SectionArray->TemplateSection == 'credits') &&($_GET['sec'] == ''))  ||   ($_GET['sec'] == 'credits'))  {
			$TemplateSelect .="<option value='tabbed'";
		if ((($SectionArray->Template=='tabbed') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'tabbed'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Each creator has own tab with Avatar and bio</option>";
			
			$TemplateSelect .="<option value='vertical_list'";
		if ((($SectionArray->Template=='vertical_list') && ($_GET['tpl'] == ''))  ||  ($_GET['tpl'] == 'vertical_list'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Creators veritcally with name,thumb, bio and website</option>";

		}
		if ((($SectionArray->TemplateSection == 'links') &&($_GET['sec'] == ''))  ||   ($_GET['sec'] == 'links')){
			$TemplateSelect .="<option value='vertical_list'";
		if ((($SectionArray->Template=='vertical_list') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'vertical_list'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Links veritcally with a description underneath.</option>";
			
		}
		if ((($SectionArray->TemplateSection == 'gallery') &&($_GET['sec'] == ''))  ||   ($_GET['sec'] == 'gallery')){
			$TemplateSelect .="<option value='lightbox'";
		if ((($SectionArray->Template=='lightbox') && ($_GET['tpl'] == ''))  ||  ($_GET['tpl'] == 'lightbox'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnails are clicked to launch viewer in lightbox.</option>";
			
			$TemplateSelect .="<option value='standard'";
		if ((($SectionArray->Template=='standard') && ($_GET['tpl'] == ''))  ||  ($_GET['tpl'] == 'standard'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Thumbnails are clicked to launch viewer in new page.</option>";
			
				$TemplateSelect .="<option value='flash_gallery_one'";
		if ((($SectionArray->Template=='flash_gallery_one') && ($_GET['tpl'] == ''))  ||  ($_GET['tpl'] == 'flash_gallery_one'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Flash Gallery - Thumbnails appear on the side, image loads in center.</option>";
			
		
		}
		
		if ((($SectionArray->TemplateSection == 'episodes') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'episodes')){
			$TemplateSelect .="<option value='tabbed'";
		if ((($SectionArray->Template=='tabbed') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'tabbed'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Each episode has it's own tab.</option>";
			
			$TemplateSelect .="<option value='vertical_list'";
		if ((($SectionArray->Template=='vertical_list') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'vertical_list'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Episodes are shown in veritcal list</option>";
			
				$TemplateSelect .="<option value='dropdown'";
		if (($SectionArray->Template=='dropdown') || ($_GET['tpl'] == 'dropdown'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Dropdown Selectbox</option>";
			
				
		}
		
			

		
		if ((($SectionArray->TemplateSection == 'news') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'news')){
			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Content on Left / Post lists on right.</option>";
		}
		if ((($SectionArray->TemplateSection == 'blog') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'blog')){
			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Content on Left / sidebar on right.</option>";
		}
		if ((($SectionArray->TemplateSection == 'faq') &&($_GET['sec'] == ''))  ||  ($_GET['sec'] == 'faq')){
			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Questions on Left / Answers on Right.</option>";
		}
		
		if ((($SectionArray->TemplateSection == 'home') &&($_GET['sec'] == ''))  || ($_GET['sec'] == 'home')){
			if ($_SESSION['IsPro'] == 1) {
			$TemplateSelect .="<option value='3_column'";
		if ((($SectionArray->Template=='3_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '3_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">3 Column Module Layout</option>";
			}
			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">2 Column Module Layout</option>";
		$TemplateSelect .="<option value='1_column'";
		if ((($SectionArray->Template=='1_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '1_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">1 Column Module Layout</option>";
			$TemplateSelect .="<option value='reader'";
		if ((($SectionArray->Template=='reader') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'reader'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Reader</option>";
			$TemplateSelect .="<option value='blog'";
		if ((($SectionArray->Template=='blog') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'blog'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Blog</option>";
				$TemplateSelect .="<option value='gallery'";
		if ((($SectionArray->Template=='gallery') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'gallery'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">Gallery</option>";
		}
		$TemplateSelect .="<option value=''>----</option>";
		$TemplateSelect .="<option value='custom'";
		
		if ((($SectionArray->Template=='custom') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == 'custom'))
				$TemplateSelect .=" selected";
		$TemplateSelect .=">--Custom HTML--</option>";
		$TemplateSelect .='</select>';
		$Variable1 = $SectionArray->Variable1;
		$Variable2 = $SectionArray->Variable2;
		$Variable3 = $SectionArray->Variable3;
		$Variable4 = $SectionArray->Variable4;
	}else if ($_GET['sa'] == 'delete') {
		$query = "DELETE from content_section where ID='".$_GET['sectionid']."'";
			$InitDB->execute($query);
			header("Location:/cms/edit/".$SafeFolder."/?tab=content");
	} else if (($_GET['sa'] == 'finish') || ($_GET['sa'] == 'save')) {
		
		$Title = mysql_real_escape_string($_POST['txtTitle']);
		$HTMLCode = mysql_real_escape_string($_POST['content']);
		$Template = $_POST['templateselect'];
		//print_r($_POST);
		$CreatedDate = date('Y-m-d h:i:s');
		$TemplateSection = $_POST['txtTemplateSection'];
		$Variable1 = $_POST['Variable1'];
		$Variable2 = $_POST['Variable2'];
		$Variable3 = $_POST['Variable3'];
		$Variable4 = $_POST['Variable4'];
		$AccessType = $_POST['txtAccessType'];
		 if ($_POST['TemplateSection'] == 'custom') {
			$IsCustom = 1;
		} else if ($_POST['templateselect'] == 'custom') {
			$IsCustom = 1;
		} else {
			$IsCustom = 0;
		}
		if ($_GET['sa'] == 'finish') {
			$query = "INSERT into content_section (Title,ProjectID,UserID,IsCustom,Template,HTMLCode,CreatedDate,TemplateSection,Variable1,Variable2,Variable3,Variable4,AccessType) values ('$Title','$ProjectID','".$_SESSION['userid']."','$Custom','$Template','$HTMLCode','$CreatedDate','$TemplateSection','$Variable1','$Variable2','$Variable3','$Variable4','$AccessType')";
			$InitDB->execute($query);
			$query ="SELECT ID from content_section WHERE ProjectID='$ProjectID' and CreatedDate='$CreatedDate'";
			$SID = $InitDB->queryUniqueValue($query);
			$Encryptid = substr(md5($SID), 0, 15).dechex($SID);
			$IdClear = 0;
			$Inc = 5;
			while ($IdClear == 0) {
					$query = "SELECT count(*) from content_section where EncryptID='$Encryptid'";
					$Found = $InitDB->queryUniqueValue($query);
					$output .= $query.'<br/>';
					if ($Found == 1) {
						$Encryptid = substr(md5(($SID+$Inc)), 0, 15).dechex($SID+$Inc);
					} else {
						$query = "UPDATE content_section SET EncryptID='$Encryptid' WHERE ID='$SID'";
						$InitDB->execute($query);
						$output .= $query.'<br/>';
						$IdClear = 1;
					}
					$Inc++;
			}
			
			//InsertProjectContent('new', $_SESSION['sessionproject'], $Encryptid, 'section', $_SESSION['userid'],$Tags);
		} else 	if ($_GET['sa'] == 'save') {
			$query = "UPDATE content_section set Title='$Title',ProjectID='$ProjectID',UserID='".$_SESSION['userid']."',TemplateSection='$TemplateSection', IsCustom='$Custom',Template='$Template',HTMLCode='$HTMLCode',Variable1='$Variable1',Variable2='$Variable2' ,Variable3='$Variable3',Variable4='$Variable4', AccessType='$AccessType' where ID='".$_POST['sectionid']."'";
			$InitDB->execute($query);
			//print $query;
		}
		header("Location:/cms/edit/".$SafeFolder."/?tab=content");
	}
}
}
?>