<script type="text/javascript">
function submit_template(step, task, type) {


<? if ($_GET['t'] == 'themes') {?>
var formaction = '/cms/admin/?t=themes&section='+type+'&sa='+task+'&step='+step;
<? } else {?>
var formaction = '/cms/edit/<? echo $SafeFolder;?>/?tab=design&section='+type+'&sa='+task+'&step='+step;
<? }?>
	document.templateform.action = formaction;
	document.templateform.submit();

}

</script>
<? 
if ($_POST['content'] != '') 
	$_SESSION['contentpost'] = $_POST['content'];
	
$HTMLArray = array('content'=>$_POST['content']);?>
<table>
<tr><td></td><td> <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td id="blue_cmsBox_TL"></td>
	<td id="blue_cmsBox_T"></td>
	<td id="blue_cmsBox_TR"></td></tr>
	<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
		<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
          <div style="float:left">Themes</div><div style="float:right;">Create New</div>
 		</td>
        <td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>
	</tr>
    <tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
	<td id="blue_cmsBox_BR"></td>
	</tr></tbody></table>
     <div class="spacer"></div></td></tr>
<tr><td valign="top">
						<div class="cms_blue_button_active"><div class="spacer"></div>
                        <? if ($_GET['step'] == '') {?>
                      <input type="button" onClick="submit_template('title','new','themes');" value="NEXT STEP" class="navbuttons">
                      <? } if ($_GET['step'] == 'title') { ?>
							<input type="button" onClick="submit_template('finish','finish','themes');" value="NEXT STEP" class="navbuttons">
						<? } if ($_GET['step'] == 'finish') { ?>
							<input type="button" onClick="window.location.href='/cms/admin/?t=themes&sa=edit&themeid=<? echo $ThemeID;?>';" value="EDIT SKIN" class="navbuttons">
						<? }?>
                        
                     
                       </div>  <div class="spacer"></div>
                       <img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg" onclick="window.location.href='/cms/admin/?t=themes&section=themes';" class="navbuttons"/>
                          <div class="spacer"></div>
                    </td>
                    
                    <td>
                       
<form name="templateform" id="templateform" method="post">
<? if ($_GET['step'] == '') {?>
 <table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="left">
<div class="spacer"></div>
So you want to create a new Theme to use on your project or to post to the community? Well you're in the right place. Just follow these easy steps to get started and become a design master in minutes!

The first step is to select the basic frameset you want to use. <br />
<div align="center">
<? 
$db = new DB();

$query = "SELECT * from templates where IsPublic=1";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	echo '<td align="center" width="60"><img src="/'.$line->Image.'" border="1" style="border:#fffff solid 1px;" vspace="5" hspace="5" width="100"><br/><input type="radio" name="txtTemplate" value="'.$line->TemplateCode.'"';
	if ($line->TemplateCode == 'TPL-001')
	echo ' checked ';
	
	
	echo '>SELECT<div style="height:5px;"></div></td>';
	if ($ImageCount == 5) {
		echo '</tr><tr>';
		$ImageCount = 0;
	}
	
}
if (($ImageCount < 5) && ($ImageCount != 0)) {
	while ($ImageCount < 5) {
		echo '<td></td>';
		$ImageCount++;
	}
}
echo '</tr></table>';
$db->close();



?>
  </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        

</div>


<? } else if ($_GET['step'] == 'template_settings') {
$TemplateCode = $_POST['txtTemplate'];

include 'theme_settings_inc.php';

 } else if ($_GET['step'] == 'html') { 
$db = new DB();

$query = "SELECT * from pf_media where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !='')) and FileType='image'";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
$ImageMediaString = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	$ImageMediaString .= '<td align="center" width="60"><img src="/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2"><br/>[<a href="#" onclick="select_image(\''.$line->Height.'\',\''.$line->Width.'\',\''.$line->Filename.'\');return false;">SELECT</a>]<br/>[<a href="/'.$line->Filename.'" rel="shadowbox" title="PATH: '.$_SERVER['SERVER_NAME'].'/'.$line->Filename.'">VIEW</a>]<div style="height:5px;"></div></td>';
	if ($ImageCount == 5) {
		$ImageMediaString .= '</tr><tr>';
		$ImageCount = 0;
	}
	
}
if (($ImageCount < 5) && ($ImageCount != 0)) {
	while ($ImageCount < 5) {
		$ImageMediaString .= '<td></td>';
		$ImageCount++;
	}
}
$ImageMediaString .= '</tr></table>';
$db->close();?>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
	skin : "o2k7",
	spellchecker_rpc_url : '/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/plugins/spellchecker/rpc.php',

    theme_advanced_buttons1 : "mybutton,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,,link,unlink,anchor,cleanup,help,code,|,fullscreen",
    theme_advanced_buttons2 : "tablecontrols,hr,removeformatcut,copy,paste,pastetext,pasteword,|,search,replace,blockquote",
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
</script>

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

function select_image(Height, Width, Filename) {
	document.getElementById("mediainfo").style.display = '';
		document.getElementById("mediapath").style.display = '';
		document.getElementById("mediaheight").style.display = '';
		document.getElementById("mediawidth").style.display = '';
		
		document.getElementById("mediapath").innerHTML = '<b>MEDIA PATH:</b><br/> http://panelflow.com/'+Filename;
		ImagePath = 'http://wevolt.com/'+Filename;
		
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
</script> 
<table><tr><td valign="top">
To create your own template there are (3) tags that you MUST include somwhere in your layout.<br>

1. {content} - This is where all content will be shown in your template<br>
2. {menu} - This is where you want the menu to appear<br>
3. {banner} - This is the header/banner image that you can upload for your project.<br>
4. *optional - {modulebar} - This creates a space for a module bar which can be configured in the modules section of the design. 
<br>

You can use the WYSIWIG editor below to create a table structure, or work with HTML code by clicking the [html] button<br><br>


NOTE: <br>
All scripts will be stripped upon submitting with the exception of < embed > and < style > tags
<br>
<div class="spacer"></div>

<input type="button" onClick="submit_template('title','new','themes');" value="NEXT STEP">

<textarea name="content" id="content" style="width:475px; height:375px;"><? if ($_SESSION['contentpost'] == '') {?><table width="100%">
<tr><td valign="top">{banner}</td></tr><tr><td valign="top">{menu}</td></tr><tr><td valign="top">{content}</td></tr></table><? } else { echo $_SESSION['contentpost'];}?></textarea>
</td>
<td valign="top" style="padding-left:10px; color:#000000" width="300">

<div class="spacer"></div>
<div id="mediainfo" style="display:none">
 <div class="warning">MEDIA INFO</div>
 <div id="mediapath" style="display:none;"></div>
<div id="mediawidth" style="display:none;"></div>
<div id="mediaheight" style="display:none;"></div>	
<div class="spacer"></div>	
</div>

UPLOAD MEDIA <br />
<? $_SESSION['uploadtype'] = 'media';
   $_SESSION['comic'] = $ComicID;
   $_SESSION['story'] = '';
   $_SESSION['world'] = $WorldID;
   $_SESSION['safefolder'] = $SafeFolder;
   $_SESSION['dir'] = $ComicDir;
?>
<iframe id='loaderframe' name='loaderframe' height='75px' width="300px" frameborder="no" scrolling="auto" src="/<? echo $PFDIRECTORY;?>/includes/media_upload_inc.php"></iframe>
<div class="warning">CURRENT MEDIA</div>
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

<div id="imagesdiv" style="height:400px;overflow:auto;"><? if ($TotalImages == 0) echo 'NO IMAGES UPLOADED YET'; else echo $ImageMediaString;?></div>
<div id="mediadiv" style="display:none"><? if ($TotalMedia == 0) echo 'NO MEDIA UPLOADED YET'; else echo $MediaMediaString;?></div>
<div id="downloadsdiv" style="display:none;"><? if ($TotalDownloads == 0) echo 'NO DOWNLOADS UPLOADED YET'; else echo $DownloadMediaString;?></div>


<div id="media_settings" style="display:none;"></div>

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
<? } else if ($_GET['step'] == 'template') { 

$db = new DB();

$query = "SELECT * from templates where IsPublic=1";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	echo '<td align="center" width="60"><img src="/'.$line->Image.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2"><br/><input type="radio" name="txtTemplate" value="'.$line->TemplateCode.'">SELECT<div style="height:5px;"></div></td>';
	if ($ImageCount == 5) {
		echo '</tr><tr>';
		$ImageCount = 0;
	}
	
}
if (($ImageCount < 5) && ($ImageCount != 0)) {
	while ($ImageCount < 5) {
		echo '<td></td>';
		$ImageCount++;
	}
}
echo '</tr></table>';
$db->close();



?>
SELECT WHICH BASE LAYOUT YOU WANT TO USE: <br>
<br>
<table width="100%"><tr>
<td>
<img src="/images/template_stacked_top_header.jpg" hspace="5" vspace="5"  width="150"><br>
STACKED - BANNER AT TOP<input type="radio" name="txtTemplate" value='stacked_header_top' <? if (($_POST['txtTemplate'] == 'stacked_header_top')  || ($_POST['txtTemplate'] == '')) echo 'checked';?>>
</td>
<td>
<img src="/images/template_stacked_top_menu.jpg" hspace="5" vspace="5"  width="150"><br>
STACKED - MENU AT TOP<input type="radio" name="txtTemplate" value='stacked_menu_top' <? if ($_POST['txtTemplate'] == 'stacked_menu_top') echo 'checked';?>>

</td>

<td>

<img src="/images/template_left_menu.jpg" hspace="5" vspace="5" width="150"><br>

LEFT MENU <input type="radio" name="txtTemplate" value='left_menu' <? if ($_POST['txtTemplate'] == 'left_menu') echo 'checked';?>>
</td>
<td>
<img src="/images/template_left_menu_tall.jpg" hspace="5" vspace="5"  width="150"><br>

LEFT MENU TALL<input type="radio" name="txtTemplate" value='left_menu_tall' <? if ($_POST['txtTemplate'] == 'left_menu_tall') echo 'checked';?>>
</td>


</tr>
</table>
<input type="button" onClick="submit_template('title','new','themes');" value="NEXT STEP">
<? } else if ($_GET['step'] == 'title') { ?>
 <table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="left">
<strong>ALMOST THERE!</strong> Now just a few more details.<div class="spacer"></div>
Title: <br />
<input type="text" name="txtTitle" id="txtTitle" value="<? if ($_POST['txtTitle'] == '') echo $_POST['txtTitle'];?>" style="border:#000000 1px solid;"><div class="spacer"></div>
<div class="spacer"></div>
DESCRIPTION:<br />

<textarea name="txtDescription" style="width:300px;height:100px;"><? echo $_POST['txtDescription'];?></textarea><br>
<div class="spacer"></div>

TAGS:<br />

<textarea name="txtTags" style="width:300px;height:100px;"><? echo $_POST['txtTags'];?></textarea><div class="spacer"></div>
  </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
<? } else if ($_GET['step'] == 'finish') { ?>
<table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="center">
Alright! Your basic theme is created. <div class="spacer"></div>Now comes the part where you can get into the whole 'look' of the template.<div class="spacer"></div> This step is called skinning.<div class="spacer"></div> The skin is laid over the template you just selected.
<div class="spacer"></div> 
<div class="cms_links"> 
<a href="/cms/admin/?t=themes&sa=edit&themeid=<? echo $ThemeID;?>">Start Skinning Now!</a></div>
  </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>

<? }?>


<? if ($_GET['step'] != '') {?>

<input type="hidden" name="txtTemplate" id="txtTemplate" value="<? echo $_POST['txtTemplate'];?>">
<? }?>

<? if ($_GET['step'] != 'title') {?>

<input type="hidden" name="txtTitle" id="txtDescription" value="<? echo $_POST['txtDescription'];?>">
<input type="hidden" name="txtTitle" id="txtTitle" value="<? echo $_POST['txtTitle'];?>">
<input type="hidden" name="txtTitle" id="txtTags" value="<? echo $_POST['txtTags'];?>">

<? }?>


</form>
</td></tr></table>