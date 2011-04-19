<?php
//include("editor/fckeditor.php") ;
$ReUrl = '/cms/edit/'.$SafeFolder.'/?tab=content&sa='.$_GET['sa'];
if ($_GET['sectionid'] != '')
	$ReUrl .= '&sectionid='.$_GET['sectionid'];
?> 
<? if (($SectionArray->Template == 'custom') ||($SectionArray->TemplateSection == 'blog') || ($_GET['tpl'] == 'custom') || ($_GET['sec'] == 'blog') || ($_GET['sec'] == 'custom') || ($SectionArray->TemplateSection == 'custom')) {?>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<? }?>
<script type="text/javascript">
function save_form() {
	if (document.getElementById("txtTitle").value == '')
		alert('You must enter a title for this section');
	else 
		document.contentform.submit();
}
function select_section(value) {

			<? /*document.contentform.templateselect.length = 0;
					document.contentform.templateselect.options[0] = new Option("--SELECT TEMPLATE--", "lightbox", false, false);
				if (value == 'gallery') {
					document.contentform.templateselect.options[1] = new Option("Each gallery item listed in thumbnails and enlarged image pops up in a lightbox", "lightbox", false, false);
					document.contentform.templateselect.options[2] = new Option("Each gallery item listed in thumbnails and enlarged image is loaded in a new page", "standard", false, false);
					document.contentform.templateselect.options[3] = new Option("Flash Gallery - Thumbnails appear on the side, image loads in center", "flash_gallery_one", false, false);
					document.contentform.templateselect.options[4] = new Option("---", "", false, false);
					document.contentform.templateselect.options[5] = new Option("Custom HTML", "custom", false, false);
				}
				if ((value == 'downloads') || (value == 'mobile')|| (value == 'products')) {
					document.contentform.templateselect.options[1] = new Option("Thumbnail list with tabs for each section", "tabbed", false, false);
					document.contentform.templateselect.options[2] = new Option("---", "", false, false);
					document.contentform.templateselect.options[3] = new Option("Custom HTML", "custom", false, false);
				}
				if (value == 'characters') {
					document.contentform.templateselect.options[1] = new Option("Thumbnail w/ Reveal", "html_one", false, false);
					document.contentform.templateselect.options[2] = new Option("Thumbnail w/ Pop Up", "html_two", false, false);
					document.contentform.templateselect.options[3] = new Option("Vertical List", "html_three", false, false);
					document.contentform.templateselect.options[4] = new Option("---", "", false, false);
					document.contentform.templateselect.options[5] = new Option("Custom HTML", "custom", false, false);
				}
				if (value == 'blog') {
					document.contentform.templateselect.options[1] = new Option("2 Column w/ Module Sidebar", "column_split", false, false);
					document.getElementById("savebutton").style.display = '';
				}
				if (value == 'archives') {
					document.contentform.templateselect.options[1] = new Option("Thumbnail list", "thumb_list", false, false);
					document.contentform.templateselect.options[2] = new Option("Thumbnail list with Page Titles", "thumb_list_title", false, false);
					document.contentform.templateselect.options[3] = new Option("---", "", false, false);
					document.contentform.templateselect.options[4] = new Option("Custom HTML", "custom", false, false);
					
				}
				if (value == 'episodes') {
					document.contentform.templateselect.options[1] = new Option("Tabbed - Each episode has thumb and synopsis", "tabbed", false, false);
					document.contentform.templateselect.options[2] = new Option("Vertical list of each episode", "vertical_list", false, false);
					document.contentform.templateselect.options[3] = new Option("---", "", false, false);
					document.contentform.templateselect.options[4] = new Option("Custom HTML", "custom", false, false);
					
				}
				if (value == 'credits') {
					document.contentform.templateselect.options[1] = new Option("Each creator has own tab with Avatar and bio", "tabbed", false, false);
					document.contentform.templateselect.options[2] = new Option("Each creator is listed veritcally with name,thumb, bio and website", "vertical_list", false, false);	
					document.contentform.templateselect.options[3] = new Option("---", "", false, false);
					document.contentform.templateselect.options[4] = new Option("Custom HTML", "custom", false, false);																		}
				if (value == 'links') {
					document.contentform.templateselect.options[1] = new Option("Links listed veritcally with a description and image.", "vertical_list", false, false);
					document.contentform.templateselect.options[2] = new Option("---", "", false, false);
					document.contentform.templateselect.options[3] = new Option("Custom HTML", "custom", false, false);
				
				}
				
				if (value == 'home') {
					document.contentform.templateselect.options[1] = new Option("2 Column Layout.", "2_column", false, false);
					document.contentform.templateselect.options[2] = new Option("Page Reader", "reader", false, false);
					document.contentform.templateselect.options[3] = new Option("---", "", false, false);
					document.contentform.templateselect.options[4] = new Option("Custom HTML", "custom", false, false);
					
				
				} else {
				
					document.getElementById("home_settings").style.display = 'none';
					
					
					
				}
			
				if (value != '') 
								document.getElementById("section_settings").style.display = '';
					
				if (value != 'custom') 
					document.getElementById("tempateselect_div").style.display = '';
				if (value == 'custom') {
					 init_tiny();
						document.getElementById("customdiv").style.display = '';
						document.getElementById("tempateselect_div").style.display = 'none';
						document.getElementById("savebutton").style.display = '';
						
						

				} else {
						document.getElementById("tempateselect_div").style.display = '';
						document.getElementById("customdiv").style.display = 'none';
				}<? */?>
			var title = escape(document.getElementById("txtTitle").value);
				window.location.href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=<? echo $_GET['sa'];?><? if ($_GET['sectionid'] != ''){?>&sectionid=<? echo $_GET['sectionid'];?><? }?>&sec="+value+"&title="+title;
			}
			
			function select_template(value){
			
				<? /*if (value == 'custom') {
						document.getElementById("customdiv").style.display = '';
						document.getElementById("savebutton").style.display = '';
						document.getElementById("home_settings").style.display = 'none';
						
						
				} else {
						document.getElementById("customdiv").style.display = 'none';
						document.getElementById("savebutton").style.display = '';
				
				}
				if (value == '2_column') {
					document.getElementById("home_settings").style.display = '';
				}<? */?>
				var title = escape(document.getElementById("txtTitle").value);
				window.location.href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=<? echo $_GET['sa'];?><? if ($_GET['sectionid'] != ''){?>&sectionid=<? echo $_GET['sectionid'];?><? }?>&tpl="+value+"&sec=<? if ($_GET['sec'] != '') echo $_GET['sec']; else echo $SectionArray->TemplateSection;?>&title="+title;
				
			
			}
<? if (($SectionArray->Template == 'custom') ||($SectionArray->TemplateSection == 'blog') || ($_GET['tpl'] == 'custom') || ($_GET['sec'] == 'blog')|| ($_GET['sec'] == 'custom') || ($SectionArray->TemplateSection == 'custom')) {?>
function imagestab() {
		if (document.getElementById("imagesdiv")!= null) {
			document.getElementById("imagesdiv").style.display = '';
			document.getElementById("imagestab").className ='profiletabactive';
		}
		if (document.getElementById("mediadiv")!= null) {
			document.getElementById("mediadiv").style.display = 'none';
			document.getElementById("mediatab").className ='profiletabinactive';
		}
		if (document.getElementById("downloadsdiv")!= null) {
			document.getElementById("downloadsdiv").style.display = 'none';
			document.getElementById("downloadstab").className ='profiletabinactive';
		}
				
	}

function mediatab() {
		if (document.getElementById("imagesdiv")!= null) {
			document.getElementById("imagesdiv").style.display = 'none';
			document.getElementById("imagestab").className ='profiletabinactive';
		}
		if (document.getElementById("mediadiv")!= null) {
			document.getElementById("mediadiv").style.display = '';
			document.getElementById("mediatab").className ='profiletabactive';
		}
		if (document.getElementById("downloadsdiv")!= null) {
			document.getElementById("downloadsdiv").style.display = 'none';
			document.getElementById("downloadstab").className ='profiletabinactive';
		}
				
	}

function downloadstab() {
		if (document.getElementById("imagesdiv")!= null) {
			document.getElementById("imagesdiv").style.display = 'none';
			document.getElementById("imagestab").className ='profiletabinactive';
		}
		if (document.getElementById("mediadiv")!= null) {
			document.getElementById("mediadiv").style.display = 'none';
			document.getElementById("mediatab").className ='profiletabinactive';
		}
		if (document.getElementById("downloadsdiv")!= null) {
			document.getElementById("downloadsdiv").style.display = '';
			document.getElementById("downloadstab").className ='profiletabactive';
		}
				
	}


tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
	skin : "o2k7",
	spellchecker_rpc_url : '/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/plugins/spellchecker/rpc.php',

    theme_advanced_buttons1 : "mybutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,blockquote,|,link,unlink,anchor,cleanup,help,code,|,fullscreen",
    theme_advanced_buttons3 : "formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,image,media,|,preview",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
    setup : function(ed) {
        // Add a custom button
        ed.addButton('mybutton', {
            title : 'My button',
            image : 'img/example.gif',
            onclick : function() {
				// Add you own code to execute something on click
				ed.focus();
                ed.selection.setContent('<strong>Hello world!</strong>');
            }
        });
    }
});
<? }?>
</script>

<? if (($SectionArray->Template == 'custom') ||($SectionArray->TemplateSection == 'blog') || ($_GET['tpl'] == 'custom') || ($_GET['sec'] == 'blog') || ($_GET['sec'] == 'custom') || ($SectionArray->TemplateSection == 'custom')) {?>
<script type="text/javascript">
<!--
function insert_media() {
var MediaType = document.getElementById("media_type").value;
var MediaPath = document.getElementById("media_path").value;
var Width = document.getElementById("media_width").value;
var Height = document.getElementById("media_height").value;
var IsPopup = document.getElementById("media_popup").value;
var SiteWidth = document.getElementById("SiteWidth").value;
var Border = document.getElementById("Border").value;
var Vspace = document.getElementById("Vspace").value;
var Hspace = document.getElementById("Hspace").value;
var Align = document.getElementById("Align").value;
var Custom1 = document.getElementById("Custom1").value;
var Custom2 = document.getElementById("Custom2").value;
var Custom3 = document.getElementById("Custom3").value;
var Custom4 = document.getElementById("Custom4").value;

var MediaCount = document.getElementById("MediaCount").value;


if (SiteWidth == '')
	SiteWidth =  600;
	
if (MediaCount == '') 
	MediaCount = 1
else 	
	MediaCount = MediaCount + 1;	
var MediaString = '';

if (MediaType == 'image') {

attach_file("/<? echo $PFDIRECTORY;?>/includes/add_media.php?type"+MediaType+"&path="+MediaPath+"&height="+Height+"&width="+Width+"&popup="+IsPopup+"&border="+Border+"&vspace="+Vspace+"&hspace="+Hspace+"&align="+Align+"&position="+MediaCount);

MediaString = '{IMAGE:'+MediaCount+'}';

} else if (MediaType == 'flash') {

attach_file("/<? echo $PFDIRECTORY;?>/includes/add_media.php?type"+MediaType+"&path="+MediaPath+"&height="+Height+"&width="+Width+"&position="+MediaCount);
MediaString = '{EMBED:'+MediaCount+'}';
	
} else if (MediaType == 'download') {

attach_file("/<? echo $PFDIRECTORY;?>/includes/add_media.php?type"+MediaType+"&path="+MediaPath+"&position="+MediaCount);
MediaString = '{DOWNLOAD:'+MediaCount+'}';
	
}

tinyMCE.execCommand('mceInsertContent',false,MediaString);

}

function select_image(Height, Width, Filename,Server) {
	document.getElementById("mediainfo").style.display = '';
		document.getElementById("mediapath").style.display = '';
		document.getElementById("mediaheight").style.display = '';
		document.getElementById("mediawidth").style.display = '';
		
		document.getElementById("mediapath").innerHTML = '<b>MEDIA PATH:</b><br/>'+Server+'/'+Filename;
		ImagePath = Server+'/'+Filename;
		
		document.getElementById("mediaheight").innerHTML = '<b>Height:</b> '+ Height;
		document.getElementById("mediawidth").innerHTML = '<b>Width:</b> ' + Width;
		
		ImageString = '<img src="'+ImagePath+'">';
		tinyMCE.execCommand('mceInsertContent',false,ImageString);
}
//myField accepts an object reference, myValue accepts the text strint to add
function insertAtcursor(myValue) {
//IE support

if (document.getElementById("tester") == null) alert("NOT FOUND");
TargetField = document.getElementById("tester");

if (document.selection) {
TargetField.focus();
if (document.getElementById("tester") != null) alert("FOUND");
//in effect we are creating a text range with zero
//length at the cursor location and replacing it
//with myValue
sel = document.selection.createRange();
alert(sel);
sel.text = myValue;

}

//Mozilla/Firefox/Netscape 7+ support
else if (TargetField.selectionStart || TargetField.selectionStart == '0') {

//Here we get the start and end points of the
//selection. Then we create substrings up to the
//start of the selection and from the end point
//of the selection to the end of the field value.
//Then we concatenate the first substring, myValue,
//and the second substring to get the new value.
var startPos = TargetField.selectionStart;
var endPos = TargetField.selectionEnd;
TargetField.value = TargetField.value.substring(0, startPos)+ myValue+ TargetField.value.substring(endPos, TargetField.value.length);
} else {
TargetField.value += myValue;
}
}

//-->

function reload_section() {
		window.location.href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=<? echo $_GET['sa'];?><? if ($_GET['sectionid'] != ''){?>&sectionid=<? echo $_GET['sectionid'];?><? }?>";
	
}
</script>  
<?


/*
$query = "SELECT * from pf_media where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !='')) and FileType='media'";
$db->query($query);
$MediaCount = 0;
$TotalMedia = $db->numRows();
$MediaMediaString = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';
while ($line = $db->FetchNextObject()) {
$MediaCount++;
	$MediaMediaString .= '<td align="center" width="60"><img src="/'.$line->Thumb.'" id="thumb_'.$line->ID.'"><br/>[<a href="#" onclick="select_media('.$line->ID.');return false;">SELECT</a>]<br/>[<a href="'.$line->Filename.'" rel="lightbox">VIEW</a>]<div style="height:5px;"></div></td>';
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

$query = "SELECT * from pf_media where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !='')) and FileType='download'";
$db->query($query);
$DownloadMediaCount = 0;
$TotalDownloads = $db->numRows();
$DownloadMediaString = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';
while ($line = $db->FetchNextObject()) {
$MediaCount++;
	$DownloadMediaString .= '<td>'.$line->Filename.'<br/>[<a href="#" onclick="select_download('.$line->ID.');return false;">SELECT</a>]<br/>[<a href="'.$line->Filename.'" target="_blank">VIEW</a>]</td>';
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

$query = "SELECT * from pfw_blog_categories where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !=''))";
$db->query($query);
$CatString = '<select name="txtCategory">';
while ($line = $db->FetchNextObject()) {
$CatString .= '<option value="'.$line->EncryptID.'">'.$line->Title.'</option>';
}
$CatString .= '</select>';*/
/*
$query = "select HTMLCode,ComicID from pf_hotspots where EncryptID='$ContentID' and PageID='$PageID'";
$HotArray = $db->queryUniqueObject($query);
$HtmlContent = $HotArray->HTMLCode;
$ComicID = $HotArray->ComicID;
*/

 }?>
<div align="center">

<form action="/cms/edit/<? echo $SafeFolder;?>/?tab=content<? if (isset($_GET['sectionid'])) {?>&sa=save<? } else {?>&sa=finish<? }?>" method="post" id="contentform" name="contentform">
<div class="spacer"></div>  
<div id="savebutton"  align="center" style="display:<? if (($_GET['sectionid'] != '') || (($_GET['sec'] != '') && ($_GET['tpl'] != '')) || (($_GET['sec'] == 'blog') || ($_GET['sec'] == 'custom'))) {?>block<? } else {?>none<? }?>;">
<? if (($_GET['sec'] != 'reader') && ($SectionArray->TemplateSection != 'reader')) {?>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="save_form();" class="navbuttons"/>&nbsp;<? }?><img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?tab=content';" class="navbuttons" />
<div class="spacer"></div>
</div>
<table><tr><td valign="top" style="padding-left:10px;" width="550">
<table width="550" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="534" align="left">
<? if ($_GET['sa'] != 'edit') {?> <strong>Available Sections:</strong>
<select name="txtTemplateSection" onchange="select_section(this.options[this.selectedIndex].value);" style="width:430px;">
<option value="">--SELECT A SECTION TYPE --</option>
<option value="">--CONTENT SECTIONS--</option>
<? if (($ProjectType == 'comic') || ($ProjectType != 'writing')){?>
<? if (!in_array('characters',$InstalledSections)) {?>
<option value="characters" <? if (($SectionArray->TemplateSection == 'characters')  || ($_GET['sec'] == 'characters'))echo 'selected';?>>Characters - A place for bios/pictures of your characters</option>
<? }?>
<? if (!in_array('downloads',$InstalledSections)) {?>
<option value="downloads" <? if (($SectionArray->TemplateSection == 'downloads') || ($_GET['sec'] == 'downloads')) echo 'selected';?>>Downloads - give readers downloadable media</option>
<? }?>
<? if (!in_array('episodes',$InstalledSections)) {?>
<option value="episodes" <? if (($SectionArray->TemplateSection == 'episodes') || ($_GET['sec'] == 'episodes')) echo 'selected';?>>Episodes - List all the episodes for your project</option>
<? }?>
<? if (!in_array('mobile',$InstalledSections)) {?>
<option value="mobile" <? if (($SectionArray->TemplateSection == 'mobile') || ($_GET['sec'] == 'mobile')) echo 'selected';?>>Mobile - Make mobile wallpapers for your readers</option>
<? }?>
<? }?>
<? if (($ProjectType != 'blog') && (!in_array('blog',$InstalledSections))) {?>
<option value="blog" <? if (($SectionArray->TemplateSection == 'blog') || ($_GET['sec'] == 'blog')) echo 'selected';?>>Blog - Blog away!</option>
<? }?>
<? if (($ProjectType != 'portfolio')&& (!in_array('portfolio',$InstalledSections))) {?>
<option value="gallery" <? if (($SectionArray->TemplateSection == 'gallery') || ($_GET['sec'] == 'gallery')) echo 'selected';?>>Gallery / Extras - Create gallerys</option>
<? }?>
<? if (($_SESSION['IsPro'] == 1) && ($_SESSION['StoreSub'] == 1)) {?>
<? if (!in_array('products',$InstalledSections)) {?>
<option value="products" <? if (($SectionArray->TemplateSection == 'products') || ($_GET['sec'] == 'products')) echo 'selected';?>>Products - E-Commerce Section / Print on Demand</option>
<? }?>
<? }?>
<? if (!in_array('links',$InstalledSections)) {?>
<option value="links" <? if (($SectionArray->TemplateSection == 'links') || ($_GET['sec'] == 'links')) echo 'selected';?>>Links / Banners - Add links or downloabable banners</option>
<? }?>

<? /*
<option value="home" <? if (($SectionArray->TemplateSection == 'home')  || ($_GET['sec'] == 'home'))echo 'selected';?>>Homepage / Landing Page</option>
<option value="archives" <? if (($SectionArray->TemplateSection == 'archives') || ($_GET['sec'] == 'archives')) echo 'selected';?>>Archives - Lists all your updates</option>
<option value="credits" <? if (($SectionArray->TemplateSection == 'credits') || ($_GET['sec'] == 'credits')) echo 'selected';?>>Credits - List the bios/info for the creators</option>
<? */?>
<? if (!in_array('news',$InstalledSections)) {?>
<option value="news" <? if (($SectionArray->TemplateSection == 'news')  || ($_GET['sec'] == 'news'))echo 'selected';?>>News / Press</option>
<? }?>
<? if (!in_array('faq',$InstalledSections)) {?>
<option value="faq" <? if (($SectionArray->TemplateSection == 'faq')  || ($_GET['sec'] == 'faq'))echo 'selected';?>>F.A.Q.</option>
<? }?>
<option value="">--</option>
<option value="custom" <? if (($SectionArray->TemplateSection == 'custom') || ($_GET['sec'] == 'custom')) echo 'selected';?>>Create Custom Section</option>
</select>
<? } else {?>
<strong>Section Type:</strong> <? echo $SectionArray->TemplateSection;?><div class="spacer"></div>
<input type="hidden" name="txtTemplateSection" value="<? echo $SectionArray->TemplateSection;?>" />
<? }?>

<div id="section_settings">
<? if (($_GET['sec'] != 'reader') && ($SectionArray->TemplateSection != 'reader')) {?>
<div id="tempateselect_div" <? if ((($_GET['sec'] == '') && ($_GET['sectionid'] == '')) || ((($SectionArray->TemplateSection == 'custom') || ($SectionArray->TemplateSection == 'blog')||($_GET['sec'] == 'custom') || ($_GET['sec'] == 'blog')) )){?>style="display:none;"<? }?>>

<table><tr><td><strong>Template: </strong></td><td><? echo $TemplateSelect;?></td></tr></table>


</div>

<? }?>
</div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
</td><td style="padding-left:15px;<? if (($_GET['sec'] == 'reader') || ($SectionArray->TemplateSection == 'reader')) {?>display:none;<? }?>" valign="top" ><table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="left">
<strong>Section Title/URL:</strong><br />
<input type="text" name="txtTitle"  id="txtTitle" value="<? if (($_GET['title'] == '') && ($_GET['sec'] == '')) echo $SectionArray->Title; else if (($_GET['title'] == '') && ($_GET['sec'] != '')) echo ucfirst($_GET['sec']); else echo $_GET['title'];?>" style="width:200px;" class="inputstyle"/><br />
Privacy Setting<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public"<? if (($_GET['access'] == '')|| ($SectionArray->AccessType == 'public')) echo ' selected ';?>>Everyone</option>
<option value="fans" <? if ($SectionArray->AccessType == 'fans') echo ' selected ';?>>Fans Only</option>
<option value="superfans" <? if ($SectionArray->AccessType == 'superfans') echo ' selected ';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
</td></tr></table>


<div class="spacer"></div>
<div id="home_settings" style="display:<? if ((($_GET['sec'] == 'home') || ($SectionArray->TemplateSection == 'home')) && (($_GET['tpl'] == '2_column') || ($_GET['tpl'] == '1_column')|| ($_GET['tpl'] == '3_column')|| ((($SectionArray->Template == '2_column')|| ($SectionArray->Template == '1_column')|| ($SectionArray->Template == '3_column'))&&($_GET['tpl'] == '')))) {?>block<? } else {?>none<? }?>;">
<strong>Module Column Widths:</strong>
<? if (($_GET['tpl'] == '2_column') || (($SectionArray->Template == '2_column')&&($_GET['tpl'] == '')))
		$ColLayout = 2;
	else if (($_GET['tpl'] == '1_column') || (($SectionArray->Template == '1_column')&&($_GET['tpl'] == '')))
		$ColLayout = 1;
	else if (($_GET['tpl'] == '3_column') || (($SectionArray->Template == '3_column')&&($_GET['tpl'] == '')))
        $ColLayout = 3;?>
Column 1: <input type="text" style="width:75px;" name="Variable1" value="<? echo $Variable1;?>" class="inputstyle"/><? if (($ColLayout ==2)||($ColLayout ==3)) {?>&nbsp;&nbsp;Column 2: <input type="text" style="width:75px;"  name="Variable2"  value="<? echo $Variable2;?>" class="inputstyle"/><? }?><? if ($ColLayout ==3) {?>&nbsp;&nbsp;Column 3: <input type="text" style="width:75px;"  name="Variable3"  value="<? echo $Variable3;?>" class="inputstyle"/><? }?>
<div style="font-size:10px;">(must include the px or % at the end of number, ex: 300px or 50%)</div>
<? if ((($_GET['sec'] == 'home') || ($SectionArray->TemplateSection == 'home')) && ((($_GET['tpl'] == '2_column') || ($_GET['tpl'] == '1_column')|| ($_GET['tpl'] == '3_column')) ||((($SectionArray->Template == '2_column') || ($SectionArray->Template == '1_column')|| ($SectionArray->Template == '3_column'))&&($_GET['tpl'] == '')))) {
	
	
	
	?>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/homepage_layout_inc.php?layout=<? echo $ColLayout;?>" frameborder="0" allowtransparency="true" scrolling="no" width="800" height="600" name="moduleframe" id="moduleframe"></iframe>

<? }?>
</div>
<? if ($_SESSION['IsPro'] == 1) {?>
<div id="reader_settings" style="display:<? if (($_GET['sec'] == 'reader') || ($SectionArray->TemplateSection == 'reader')) {?>block<? } else {?>none<? }?>;">
<? if (($_GET['sec'] == 'reader') || ($SectionArray->TemplateSection == 'reader'))  {?>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/reader_layout_inc.php" frameborder="0" allowtransparency="true" scrolling="no" width="650" height="600" name="moduleframe" id="moduleframe"></iframe>

<? }?>
</div>
<? }?>


<div id="customdiv" <? if (($SectionArray->Template != 'custom') && ($_GET['tpl'] != 'custom') && ($_GET['sec'] != 'custom') && ($SectionArray->TemplateSection != 'custom')) {?>style="display:none;"<? }?>>
<div align="center">
<table><tr><td valign="top" width="550">
<div style="font-size:12px; color:#000000;font-family:Verdana, Arial, Helvetica, sans-serif;padding-bottom:5px;">
You can enter just text, or paste HTML code by clicking the [html] button


<textarea name="content" id="content" style="width:550px; height:450px;"><? echo $SectionArray->HTMLCode;?></textarea>
<div class="spacer"></div>
<?php
/*
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

$oFCKeditor = new FCKeditor('pf_post') ;
$oFCKeditor->BasePath	= '/'.$PFDIRECTORY.'/editor/';
//$oFCKeditor.Config['CustomConfigurationsPath'] = '/'.$PFDIRECTORY.'/editor/hot_spot_config.js' 
$oFCKeditor->ToolbarSet = 'hotspot' ;

$oFCKeditor->Height = '600';
$oFCKeditor->Width = '600';
$oFCKeditor->Value		= $HtmlContent;
$oFCKeditor->Create() ;
*/
?>

<input type="hidden" name="txtEdit" value="1">

</div>
</td>
<td valign="top" style="padding-left:20px; color:#00000" width="300" align="left">
<table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="left">
                                                
<div class="spacer"></div>
<div style="display:none;">
<div id="mediainfo" style="display:none">
 <div class="warning">MEDIA INFO</div>
 <div id="mediapath" style="display:none;"></div>
<div id="mediawidth" style="display:none;"></div>
<div id="mediaheight" style="display:none;"></div>	
<div class="spacer"></div>	
</div>
</div>
<div class="messageinfo">
UPLOAD MEDIA <br />
</div>
<? $_SESSION['uploadtype'] = 'media';
   $_SESSION['comic'] = $ComicID;
   $_SESSION['story'] = '';
   $_SESSION['world'] = $WorldID;
   $_SESSION['safefolder'] = $SafeFolder;
   $_SESSION['dir'] = $ComicDir;
?>
<? if (($SectionArray->Template == 'custom') ||($SectionArray->TemplateSection == 'blog') || ($_GET['tpl'] == 'custom') || ($_GET['sec'] == 'blog') || ($_GET['sec'] == 'custom') || ($SectionArray->TemplateSection == 'custom')) {?>
<iframe id='loaderframe' name='loaderframe' allowtransparency="true" height='160px' width="250px" frameborder="no" scrolling="no" src="/<? echo $PFDIRECTORY;?>/includes/media_upload_inc.php"></iframe>
<div class="sender_name">CURRENT MEDIA</div>
<!--
<table cellpadding="0" cellspacing="0" border="0"> 
<tr>
<td class="profiletabactive" align="left" id='imagestab' onMouseOver="rolloveractive('imagestab','imagesdiv')" onMouseOut="rolloverinactive('imagestab','imagesdiv')" onclick="imagestab();"> IMAGES</td>

<td width="5"></td>

<td class="profiletabinactive" align="left" id='mediatab' onMouseOver="rolloveractive('mediatab','mediadiv')" onMouseOut="rolloverinactive('mediatab','mediadiv')" onclick="mediatab();"> MEDIA</td>
<td width="5"></td>


<td class="profiletabinactive" align="left" id='downloadstab' onMouseOver="rolloveractive('downloadstab','downloadsdiv')" onMouseOut="rolloverinactive('downloadstab','downloadsdiv')" onclick="downloadstab();"> DOWNLOADS</td>
</tr>
</table>-->

<div id="imagesdiv" style="height:250px;overflow:auto;"><? 

$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$query = "SELECT * from pf_media where (ProjectID='".$_SESSION['sessionproject']."' or (WorldID='$WorldID' and WorldID !='')) and FileType='image'";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
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

echo '<td align="center" width="60" valign="bottom"><img src="'.$Server.'/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2" width="50">[<a href="javascript:void(0);" onclick="select_image(\''.$line->Height.'\',\''.$line->Width.'\',\''.$line->Filename.'\',\''.$SelectFileServer .'\');return false;">SELECT</a>]<div style="height:5px;"></div></td>';
	if ($ImageCount == 3) {
		echo'</tr><tr>';
		$ImageCount = 0;
	}
	}


if (($ImageCount < 3) && ($ImageCount != 0)) {
	while ($ImageCount <3) {
		echo '<td></td>';
		$ImageCount++;
	}
}

if ($TotalImages == 0) 
	echo '<div class="med_blue" align="center">You have not uploaded any media to WEvolt yet.</div>';
	
echo '</tr></table>';
$db->close();?>
</div>
<div id="mediadiv" style="display:none"><? if ($TotalMedia == 0) echo 'NO MEDIA UPLOADED YET'; else echo $MediaMediaString;?></div>
<div id="downloadsdiv" style="display:none;"><? if ($TotalDownloads == 0) echo 'NO DOWNLOADS UPLOADED YET'; else echo $DownloadMediaString;?></div>


<div id="media_settings" style="display:none;"></div>
<? }?>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
</td></tr></table>
</div>
 </div>
<input type="hidden" name="media_type" id="media_type" value="">
<input type="hidden" name="media_path" id="media_path" value="">
<input type="hidden" name="media_width" id="media_width" value="">
<input type="hidden" name="media_height" id="media_height" value="">
<input type="hidden" name="media_popup" id="media_popup" value="">
<input type="hidden" name="SiteWidth" id="SiteWidth" value="">
<input type="hidden" name="Border" id="Border" value="">
<input type="hidden" name="Vspace" id="Vspace" value="">
<input type="hidden" name="Hspace" id="Hspace" value="">
<input type="hidden" name="Custom1" id="Custom1" value="">
<input type="hidden" name="Custom2" id="Custom2" value="">
<input type="hidden" name="Custom3" id="Custom3" value="">
<input type="hidden" name="Custom4" id="Custom4" value="">
<input type="hidden" name="MediaCount" id="MediaCount" value="">
<input type="hidden" name="sectionid" id="sectionid" value="<? echo $_GET['sectionid'];?>">
<input type="hidden" name="ReUrl" id="ReUrl" value="<? echo $ReUrl;?>">

 </form>
 </div>