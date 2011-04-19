<?
if (($_GET['tab'] == 'content') && ($_GET['section'] == '')) {
	 if ($_GET['sa'] == '') {
			$query = "SELECT * from content_section where ProjectID ='$ProjectID' order by Title";

	//$pagination->createPaging($query,$NumItemsPerPage);
	//$PageString = '';
	 $PostString = '';
  		 $InitDB->query($query);
		$PageCount = 0;
	 while($line=$InitDB->FetchNextObject()) {
	  			$BoxType = 'admin_box';
			$PostString .='<div>';
			$PostString .=' <b class="'.$BoxType.'">';
			$PostString .=' <b class="'.$BoxType.'1"><b></b></b>';
			$PostString .=' <b class="'.$BoxType.'2"><b></b></b>';
			$PostString .=' <b class="'.$BoxType.'3"></b>';
			$PostString .='	<b class="'.$BoxType.'4"></b>';
			$PostString .='	<b class="'.$BoxType.'5"></b></b>';
			$PostString .='<div class="'.$BoxType.'fg">'; 
			$PostString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
			 $PostString .= '<td width="200" style="padding-left:5px;" align="left" class="messageinfo_warning">'.$line->Title.'</td>';
			$PostString .= '<td width="150" valign="top"  align="left" class="messageinfo_white">Section: <span class="small_blue">'.$line->TemplateSection.'</span></td>';
			$PostString .= '<td class="messageinfo_white" align="right" style="font-size:10px;">';
			if (($line->TemplateSection != 'reader') && ($line->TemplateSection != 'custom'))
				$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&sa=edit">EDIT TEMPLATE</a>]&nbsp;&nbsp;';
			else if ($line->TemplateSection == 'custom')
			$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&sa=edit">EDIT CONTENT</a>]&nbsp;&nbsp;';
			
			if (($line->TemplateSection == 'characters') || ($line->TemplateSection == 'downloads')|| ($line->TemplateSection == 'mobile')|| ($line->TemplateSection == 'blog') || ($line->TemplateSection == 'gallery')|| ($line->TemplateSection == 'links')) {
				$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section='.$line->TemplateSection.'&a=new">ADD</a>]&nbsp;&nbsp;';
				$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section='.$line->TemplateSection.'">EDIT CONTENT</a>]&nbsp;&nbsp;';
			} else if ($line->TemplateSection == 'reader') {
				$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section=pages&a=new">ADD</a>]&nbsp;&nbsp;';
				$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&section=pages">EDIT PAGES</a>]&nbsp;&nbsp;';
			}
				
			
			if (($line->TemplateSection != 'home') &&  ($line->TemplateSection != 'reader')  && ($line->TemplateSection != 'episodes') && ($line->TemplateSection != 'credits') && ($line->TemplateSection != 'archives'))
			$PostString .= '[<a href="/cms/edit/'.$SafeFolder.'/?tab=content&sectionid='.$line->ID.'&section='.$line->TemplateSection.'&sa=delete">-</a>]&nbsp;</td></tr>';
		 
			$PostString .= '</table>';
	  
			$PostString .=' </div>';
			$PostString .='<b class="'.$BoxType.'">';
			$PostString .='<b class="'.$BoxType.'5"></b>';
			$PostString .=' <b class="'.$BoxType.'4"></b>';
			$PostString .='<b class="'.$BoxType.'3"></b>';
			$PostString .='<b class="'.$BoxType.'2"><b></b></b>';
			$PostString .='<b class="'.$BoxType.'1"><b></b></b></b>';
			$PostString .='</div><div class="spacer"></div>';
			$PageCount++;
		} 
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
			$TemplateSelect .="<option value='2_column'";
		if ((($SectionArray->Template=='2_column') && ($_GET['tpl'] == ''))  || ($_GET['tpl'] == '2_column'))
				$TemplateSelect .=" selected";
			$TemplateSelect .=">2 Column Module Layout</option>";
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
		 if ($_POST['TemplateSection'] == 'custom') {
			$IsCustom = 1;
		} else if ($_POST['templateselect'] == 'custom') {
			$IsCustom = 1;
		} else {
			$IsCustom = 0;
		}
		if ($_GET['sa'] == 'finish') {
			$query = "INSERT into content_section (Title,ProjectID,UserID,IsCustom,Template,HTMLCode,CreatedDate,TemplateSection,Variable1,Variable2) values ('$Title','$ProjectID','".$_SESSION['userid']."','$Custom','$Template','$HTMLCode','$CreatedDate','$TemplateSection','$Variable1','$Variable2')";
			$InitDB->execute($query);
		} else 	if ($_GET['sa'] == 'save') {
			$query = "UPDATE content_section set Title='$Title',ProjectID='$ProjectID',UserID='".$_SESSION['userid']."',TemplateSection='$TemplateSection', IsCustom='$Custom',Template='$Template',HTMLCode='$HTMLCode',Variable1='$Variable1',Variable2='$Variable2' where ID='".$_POST['sectionid']."'";
			$InitDB->execute($query);
			//print $query;
		}
		header("Location:/cms/edit/".$SafeFolder."/?tab=content");
	}
}
?>