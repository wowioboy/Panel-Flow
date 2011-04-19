<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
?>
<script type="text/javascript" src="/<? echo $PFDIRECTORY;?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script> 
<div style="color:#FFFFFF;">
<?
$ContentID = $_GET['cid'];
if ($ContentID == '')
$ContentID = $_POST['cid'];
$PageID = $_GET['id'];
if ($PageID == '')
$PageID = $_POST['txtPage'];

$query = "select HTMLCode,ComicID from pf_hotspots where EncryptID='$ContentID' and PageID='$PageID'";
$HotArray = $InitDB->queryUniqueObject($query);
$HtmlContent = $HotArray->HTMLCode;

if ($_POST['txtEdit']==1) { 
$HtmlContent = mysql_real_escape_string($_POST['content']);
if (substr($HtmlContent,0,3) == '<p>') {

$HtmlContent = substr($HtmlContent,3,strlen($HtmlContent)- 7);

}
$query = "UPDATE pf_hotspots set HTMLCode='$HtmlContent' where EncryptID='$ContentID' and PageID='$PageID'";
$InitDB->execute($query);

?>
<script language="javascript" type="text/javascript">
parent.$.modal().close();
</script>

<? }

?>
<script type="text/javascript">

tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
	skin : "o2k7",
	theme_advanced_source_editor_width : 600,
theme_advanced_source_editor_height : 400,
	    theme_advanced_buttons1 : "bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink,anchor,cleanup,code,|,fullscreen, forecolor,backcolor,image,media",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,blockquote,|,formatselect,fontselect,fontsizeselect",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
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
<form action="#" method="post">
<table><tr><td><input type="image" src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg"/></td><td><img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg" onclick="parent.$.modal().close();" style="cursor:pointer;"/></td><td class="grey_text" style="padding-left:10px;">You can enter just text, or paste HTML code by click the [HTML] button</td></tr></table>
<div class="spacer"></div>



<textarea name="content" id="content" style="width:600px; height:340px;"><? echo $HtmlContent;?></textarea>

<?php
/*
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

$oFCKeditor = new FCKeditor('pf_post') ;
$oFCKeditor->BasePath	= '/'.$PFDIRECTORY.'/editor/';
//$oFCKeditor.Config['CustomConfigurationsPath'] = '/'.$PFDIRECTORY.'/editor/hot_spot_config.js' 
$oFCKeditor->ToolbarSet = 'Basic' ;
$oFCKeditor->Height = '600';
$oFCKeditor->Width = '500';
$oFCKeditor->Value		= $HtmlContent;
$oFCKeditor->Create() ;
*/
?>

<input type="hidden" name="txtPage" value="<? echo $PageID; ?>">
<input type="hidden" name="cid" value="<? echo $ContentID; ?>">
<input type="hidden" name="txtEdit" value="1">
</form>
</div>