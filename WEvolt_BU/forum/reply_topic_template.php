
<?



if (($_GET['topic'] != '') && ($_GET['rmid'] == ''))
	$query = "SELECT u.username, t.Message, t.Subject,t.CreatedDate from pf_forum_topics as t
			join users as u on t.PosterID=u.encryptid 
			where t.ID='".$_GET['topic']."'";
else if ($_GET['rmid'] != '')
	$query = "SELECT u.username, m.Message,m.Subject,m.CreatedDate from pf_forum_messages as m
			join users as u on m.PosterID=u.encryptid 
			where m.ID='".$_GET['rmid']."'";
$ReplyArray = $DB->queryUniqueObject($query);
if (($_GET['rtid'] != '') || ($_GET['rmid'] != ''))
$Quote = '<div class="quoted" style="background-color:#e5e5e5; border:#000000 1px solid;padding:5px;"><em><b>quote: from '. $ReplyArray->username.' on '.date('m-d-Y',strtotime($ReplyArray->CreatedDate)).'</b><br/>'.nl2br(stripslashes($ReplyArray->Message)).'</em><br/></div><br/>';
$SubjectReply = 're: '. $ReplyArray->Subject;
flush();
?>
<form action="index.php?<? echo $ForumType;?>=<? echo $TargetName;?>&a=reply" method="post">
<div align="center">

<table cellpadding="0" cellspacing="0" border="0" width="95%"><tr><td valign="top">
<div align="center">
<input type='image' style="border:none;background:none;" src="http://www.wevolt.com/images/forums/cancelsave/save_off.png">&nbsp;&nbsp;
    <img src="http://www.wevolt.com/images/forums/cancelsave/cancel_off.png" onclick="window.location='index.php?<? echo $ForumType;?>=<? echo $TargetName;?>&a=read&topic=<? echo $_GET['topic'];?>&board=<? echo $_GET['board'];?>&page=<? echo $_GET['page'];?>';" class="navbuttons">
</div>	
	
<div class="messageinfo">
SUBJECT
</div>
<input type="text" style=" <? if ($_SESSION['IsPro'] == 1) {?>width:550px;<? } else {?>width:98%;<? }?>"  name="txtTitle" value="<? echo $$SubjectReply;?>"/>
<div class="spacer"></div>
You can enter just text, or paste HTML code by clicking the [html] button
<textarea name="content" id="content" style=" <? if ($_SESSION['IsPro'] == 1) {?>width:550px;<? } else {?>width:98%;<? }?> height:600px;"><? echo $Quote;?></textarea>
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

<input type="hidden" name="txtPoster" value="<? echo $_SESSION['userid']; ?>">
<input type="hidden" name="txtBoard" value="<? echo $_GET['board'];?>" />
<input type="hidden" name="txtPage" value="<? echo $_GET['page'];?>" />
<input type="hidden" name="txtTopic" value="<? echo $_GET['topic']; ?>">
<input type="hidden" name="txtAction" value="reply" />
<input type="hidden" name="submitted" value="1" />

</div>
</td>
<td valign="top" width="250">
<table width="270" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="254" align="center"><div align="left" class="blue_med_header" >MESSAGE SETTINGS</div> 
<hr/>
<div class="sender_name">Notify on Replies</div>
<input type="radio" value="1" name="txtNotify" <? if (($ContentArray->NotifyOnReply == 1) || ($ContentArray->NotifyOnReply == '')) echo 'checked';?> /> Yes &nbsp;&nbsp;<input type="radio" value="1" name="txtNotify" <? if ($ContentArray->NotifyOnReply == 0) echo 'checked';?> /> No
<div class="spacer"></div>
<div class="sender_name">Tags</div>
<textarea name="txtTags" style="width:98%; border:1px #999999 solid;"><? echo $ContentArray->Tags;?></textarea>
<div class="spacer"></div>
<div id="mediainfo" style="display:none">
 <div class="blue_med_header">MEDIA INFO</div>
 <div id="mediapath" style="display:none;"></div>
<div id="mediawidth" style="display:none;"></div>
<div id="mediaheight" style="display:none;"></div>	
<div class="spacer"></div>

</div>
</div>	
<div align="left" class="blue_med_header" >
UPLOAD MEDIA</div>
<? $_SESSION['uploadtype'] = 'media';
   $_SESSION['project'] = $ProjectID;
?>
<iframe id='loaderframe' name='loaderframe' height='75px' width="250px" frameborder="no" scrolling="auto" src="/<? echo $PFDIRECTORY;?>/includes/media_upload_inc.php"></iframe>
<div align="left" class="blue_med_header">HOSTED MEDIA</div>
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

<div id="imagesdiv" style="height:400px; width:250px;overflow:auto; padding:5px; background-color:#d2d9e1; border:#999999 1px solid;"><? 
$query = "SELECT * from pf_media where UploadBy='".$_SESSION['userid']."'  and FileType='image' order by UploadDate DESC";
$DB->query($query);
$TotalImages = $DB->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $DB->FetchNextObject()) {

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

echo '<td align="center" width="60" valign="bottom"><img src="'.$Server.'/'.$line->Thumb.'" id="thumb_'.$line->ID.'" border="1" style="border:#fffff solid 1px;" vspace="2" hspace="2" width="50">[<a href="#" onclick="select_image(\''.$line->Height.'\',\''.$line->Width.'\',\''.$line->Filename.'\',\''.$SelectFileServer .'\');return false;">SELECT</a>]<br/>[<a href="'.$Server.'/'.$line->Filename.'" class="pirobox">VIEW</a>]<div style="height:5px;"></div></td>';
	if ($ImageCount == 3) {
		echo '</tr><tr>';
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
	echo  '<div class="med_blue" align="center">You have not uploaded any media to WEvolt yet.</div>';
	
echo '</tr></table>';
?></div>
<div id="mediadiv" style="display:none"><? if ($TotalMedia == 0) echo 'NO MEDIA UPLOADED YET'; else echo $MediaMediaString;?></div>
<div id="downloadsdiv" style="display:none;"><? if ($TotalDownloads == 0) echo 'NO DOWNLOADS UPLOADED YET'; else echo $DownloadMediaString;?></div>


<div id="media_settings" style="display:none;"></div></td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
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

 </form>
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
    mode: "exact",
    elements : "content",
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
</script>