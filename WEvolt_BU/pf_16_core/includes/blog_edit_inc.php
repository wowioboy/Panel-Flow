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
    mode : "exact",
	elements : "content",
    theme : "advanced",
	skin : "o2k7",
	convert_urls : false,
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

function select_image(Height, Width, Filename,Server) {
	document.getElementById("mediainfo").style.display = '';
		document.getElementById("mediapath").style.display = '';
		document.getElementById("mediaheight").style.display = '';
		document.getElementById("mediawidth").style.display = '';
		
		//document.getElementById("mediapath").innerHTML = '<b>MEDIA PATH:</b><br/>'+Server+'/'+Filename;
		ImagePath = Server+'/'+Filename;
		
	//	document.getElementById("mediaheight").innerHTML = '<b>Height:</b> '+ Height;
		//document.getElementById("mediawidth").innerHTML = '<b>Width:</b> ' + Width;
		
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
	
$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$query = "SELECT * from pf_media where (ProjectID='".$_SESSION['sessionproject']."' or (WorldID='$WorldID' and WorldID !='')) and FileType='image'";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
$ImageMediaString .= '<table cellpadding="0" cellspacing="0" border="0"><tr>';
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

$ImageMediaString .= '<td align="center" width="60" valign="bottom"><img src="'.$Server.'/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2" width="50">[<a href="javascript:void(0);" onclick="select_image(\''.$line->Height.'\',\''.$line->Width.'\',\''.$line->Filename.'\',\''.$SelectFileServer .'\');return false;">SELECT</a>]<div style="height:5px;"></div></td>';
	if ($ImageCount == 3) {
		$ImageMediaString .= '</tr><tr>';
		$ImageCount = 0;
	}
	}


if (($ImageCount < 3) && ($ImageCount != 0)) {
	while ($ImageCount <3) {
		$ImageMediaString .= '<td></td>';
		$ImageCount++;
	}
}

if ($TotalImages == 0) 
	$ImageMediaString .= '<div class="med_blue" align="center">You have not uploaded any media to WEvolt yet.</div>';
	
$ImageMediaString .= '</tr></table>';

/*
$query = "SELECT * from pf_media where (ComicID='$ComicID' or (WorldID='$WorldID' and WorldID !='')) and FileType='media'";
$db->query($query);
$MediaCount = 0;
$TotalMedia = $db->numRows();
$MediaMediaString = '<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';
while ($line = $db->FetchNextObject()) {
$MediaCount++;
	$MediaMediaString .= '<td><img src="/'.$line->Thumb.'" id="thumb_'.$line->ID.'"><br/>[<a href="#" onclick="select_media('.$line->ID.');return false;">SELECT</a>]<br/>[<a href="'.$line->Filename.'" rel="lightbox">VIEW</a>]</td>';
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
*/
$query = "SELECT * from pfw_blog_categories where (ComicID='".$_SESSION['sessionproject']."' or (WorldID='$WorldID' and WorldID !=''))";
$db->query($query);
$CatString = '<select name="txtCategory">';
while ($line = $db->FetchNextObject()) {
$CatString .= '<option value="'.$line->EncryptID.'"';
	if ($Category == $line->EncryptID)
		$CatString .= ' selected ';
$CatString .= '>'.$line->Title.'</option>';
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
<? if ($_GET['a'] == 'edit') {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?a=save&postid=<? echo $_GET['postid'];?>" method="post">
<? } else {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?a=finish" method="post">

<? }?>
<div align="center">

<table cellpadding="0" cellspacing="0" border="0" width="95%"><tr><td valign="top" align="center">



<div class="spacer"></div>

<div class="spacer"></div>
<div class="messageinfo_black" style="font-size:10px;">
You can enter just text, 
or paste HTML code by clicking the [html] button
</div>
<textarea name="content" id="content" style="width:500px; height:600px;"><? echo $HtmlContent;?></textarea>
<div class="spacer"></div>
<input type="hidden" name="txtItem" value="<? echo $_GET['postid']; ?>">
<input type="hidden" name="cid" value="<? echo $ContentID; ?>">
<input type="hidden" name="txtEdit" value="1">
</td>
<td valign="top" style="padding-left:10px;" width="400">
<center><div class="spacer"></div>
<input type="image" src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" style="background:none;border:none;"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php';" class="navbuttons" /></center>
<div class="spacer"></div>
<table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="center">

	<div class="sender_name">
POST TITLE<br /></div>
<div align="left">
<input type="text" style="width:100%;"  name="txtTitle" value="<? echo $Title;?>"/>
</div><div class="spacer"></div>
 <span class="sender_name">Publish Date: </span><span class="messageinfo">(MM-DD-YYYY)</span><br/><input name="txtDatelive" id="txtDatelive" size="10" type="text" value="<? if ($PostArray->PublishDate == '') echo date('m-d-Y'); else echo $PublishDate;?>">&nbsp;<img src="/<? echo $PFDIRECTORY;?>/images/cal.gif" onclick="displayDatePicker('txtDatelive',false,'mdy','-');" class="calpick"><div class="spacer"></div>
 <div class="sender_name">
 CATEGORY</div>
<? echo $CatString;?>
<div class="spacer"></div>
Tags (separate by a comma)
<textarea name="txtTags" id="txtTags" style="width:100%;height:25px;"><? echo $PostArray->Tags;?></textarea>
<div class="spacer"></div>
<? if (($_SESSION['IsPro'] == 1) &&($_GET['a']=='edit')) {?>
<? if ($FlowArray->id =='') {?>
<a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['postid'];?>','blog','0');">[CONNECT TO PAGE]</a>
<? } else {?>
Content Attached to Page:<br />
<? echo $FlowArray->title;?><br />
<a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['postid'];?>','blog','1');">[EDIT PAGE CONNECTION</a>

<? }?>
<div class="spacer"></div>
<? }?>
Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? if (($PostArray->AccessType == 'public') || ($PostArray->AccessType == 'public')) echo 'selected';?>>Everyone</option>
<option value="fans" <? if ($PostArray->AccessType == 'fans') echo 'selected';?>>Fans Only</option>
<option value="superfans" <? if ($PostArray->AccessType == 'superfans') echo 'selected';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>
<div id="mediainfo" style="display:none">
 <div id="mediapath" style="display:none;" class="messageinfo_black"></div>
<div id="mediawidth" style="display:none;" class="messageinfo_black"></div>
<div id="mediaheight" style="display:none;" class="messageinfo_black"></div>	
</div>

<div class="messageinfo_black">
UPLOAD MEDIA
</div>
<? $_SESSION['uploadtype'] = 'media';
   $_SESSION['comic'] = $ComicID;
   $_SESSION['story'] = '';
   $_SESSION['world'] = $WorldID;
   $_SESSION['safefolder'] = $SafeFolder;
   $_SESSION['dir'] = $ComicDir;
?>
<iframe id='loaderframe' name='loaderframe' allowtransparency="true" height='80px' width="250px" frameborder="no" scrolling="no" src="/<? echo $PFDIRECTORY;?>/includes/media_upload_inc.php"></iframe>
<div class="messageinfo_black">CURRENT MEDIA</div>
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

<div id="imagesdiv" style="height:150px;overflow:auto;"class="messageinfo_black"><? if ($TotalImages == 0) echo 'NO IMAGES UPLOADED YET'; else echo $ImageMediaString;?></div>
<div id="mediadiv" style="display:none"><? if ($TotalMedia == 0) echo 'NO MEDIA UPLOADED YET'; else echo $MediaMediaString;?></div>
<div id="downloadsdiv" style="display:none;"><? if ($TotalDownloads == 0) echo 'NO DOWNLOADS UPLOADED YET'; else echo $DownloadMediaString;?></div>


<div id="media_settings" style="display:none;"></div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
</td></tr></table>

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
<input type="hidden" name="txtFilename" id="txtFilename" value="<? echo $Filename;?>">
 </form>