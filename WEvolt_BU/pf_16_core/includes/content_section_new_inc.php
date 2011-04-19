<?php
//include("editor/fckeditor.php") ;
?> 

<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

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
		ImagePath = 'http://panelflow.com/'+Filename;
		
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
<?
$ContentID = $_GET['cid'];
if ($ContentID == '')
$ContentID = $_POST['cid'];
$PageID = $_GET['id'];
if ($PageID == '')
$PageID = $_POST['txtPage'];
	
$db = new DB($db_database,$db_host, $db_user, $db_pass);

$query = "SELECT * from pf_media where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !='')) and FileType='image'";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
$ImageMediaString = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	$ImageMediaString .= '<td align="center" width="60"><img src="/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2"><br/>[<a href="#" onclick="select_image(\''.$line->Height.'\',\''.$line->Width.'\',\''.$line->Filename.'\');return false;">SELECT</a>]<br/>[<a href="/'.$line->Filename.'" rel="lightbox">VIEW</a>]<div style="height:5px;"></div></td>';
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
$CatString .= '</select>';
/*
$query = "select HTMLCode,ComicID from pf_hotspots where EncryptID='$ContentID' and PageID='$PageID'";
$HotArray = $db->queryUniqueObject($query);
$HtmlContent = $HotArray->HTMLCode;
$ComicID = $HotArray->ComicID;
*/
$db->close();

?>
<script type="text/javascript">
function customtab()
	{
			document.getElementById("customdiv").style.display = '';
			document.getElementById("customtab").className ='profiletabactive';
			document.getElementById("standarddiv").style.display = 'none';
			document.getElementById("standardtab").className ='profiletabinactive';
	}
function standardtab()
	{
			document.getElementById("customdiv").style.display = 'none';
			document.getElementById("customtab").className ='profiletabinactive';
			document.getElementById("standarddiv").style.display = '';
			document.getElementById("standardtab").className ='profiletabactive';
	}


</script>


<table cellpadding="0" cellspacing="0" border="0" width="100%"> 
<tr>
<td class="profiletabactive" align="center" id='standardtab' onMouseOver="rolloveractive('standardtab','standarddiv')" onMouseOut="rolloverinactive('standardtab','standarddiv')" onclick="standardtab();"> STANDARD LAYOUT</td>
<td class="profiletabinactive" align="center"  id='customtab' onMouseOver="rolloveractive('customtab','customdiv')" onMouseOut="rolloverinactive('customtab','customdiv')" onclick="customtab();" style="border-left:#000000 1px solid;border-right:#000000 1px solid;">CUSTOM HTML LAYOUT</td>
</tr>
</table>
<form action="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=finish" method="post">
<div class="spacer"></div>
<div id="standarddiv">
SELECT TEMPLATE: <? echo $TemplateSelect;?>

</div>
<div id="customdiv" style="display:none;">
<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="95%"><tr><td valign="top">
<div style="font-size:12px; color:#FFFFFF;font-family:Verdana, Arial, Helvetica, sans-serif;padding-bottom:5px;">
You can enter just text, or paste HTML code by clicking the [html] button

<input type="submit" value ='SAVE' style="width:475px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;border:1px #FFFFFF solid;"/><div class="spacer"></div>
	
POST TITLE<br /></div>

<input type="text" style="width:475px;"  name="txtTitle"/>
<div class="spacer"></div>
<textarea name="content" id="content" style="width:475px; height:600px;"></textarea>
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

<input type="hidden" name="txtItem" value="<? echo $ItemID; ?>">
<input type="hidden" name="cid" value="<? echo $ContentID; ?>">
<input type="hidden" name="txtEdit" value="1">

</div>
</td>
<td valign="top" style="padding-left:10px; color:#FFFFFF" width="300"><div class="warning">POST SETTINGS</div> <br />
 Publish Date: (MM-DD-YYYY)<br/><input name="txtDatelive" id="txtDatelive" size="10" type="text" value="<? echo date('m-d-Y');?>">&nbsp;<img src="/<? echo $PFDIRECTORY;?>/images/cal.gif" onclick="displayDatePicker('txtDatelive',false,'mdy','-');" class="calpick"><div class="spacer"></div>
 
 CATEGORY<br />
<? echo $CatString;?>
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

 </form>