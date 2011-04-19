<script type="text/javascript">

	
	function submitpage() {
	if ((document.getElementById("txtLinkUrl").value == '') && (document.getElementById("txtInternalLink").value == '0')) {
		alert('You must first enter a URL for the link');
	} else if (document.getElementById("txtTitle").value == '') {
		alert('Please enter a title for this link');
	} else {
		document.pageform.submit();
	}
		

	}
	
	function switch_link (value) {
		if (value == 1)
			document.getElementById("linkdiv").style.display = 'none';
		else 
			document.getElementById("linkdiv").style.display = '';
	
	}
</script>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/links_inc.php?<? if (isset($_GET['linkid'])) {?>a=save&linkid=<? echo $_GET['linkid'];?><? } else {?>a=create<? }?>" method="post" name="pageform" id="pageform">
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="400" align="center" valign="top">
<div>
<? if ($LinkArray->Image != '') {
list($width,$height)=@getimagesize($LinkArray->Image);

?>
<input type="checkbox" name="txtDeleteImage" id="txtDeleteImage" value="1" /><span class="sender_name">Remove Image</span><div class="spacer"></div>
<img src="<? echo $LinkArray->Image;?>" alt="" border='1' <? if ($width > 300) echo 'width="250" '; ?>id='pageimage'/>

<? } else {?>

<img src="/<? echo $PFDIRECTORY;?>/images/temp_link_image.jpg" alt="" border='1' id='pageimage' width="250"/>
<? }?>

</div></td><td width="380" height="600" valign="top" align="center"><div class="spacer"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/links_inc.php';" class="navbuttons" />

<div id='savealert' style="color:#FF0000; font-weight:bold; font-size:10px;"></div></div>
<table width="380" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="364" align="left">
<div class="spacer"></div><div class='sender_name'>TITLE:<br /> <input name="txtTitle" id="txtTitle" type="text" class="inputstyle" style="width:325px;" value="<? echo stripslashes($LinkArray->Title);?>"/>
<div class="sender_name">
DESCRIPTION
<br />

<textarea name='txtDescription' id='txtDescription' style="width:325px;height:100px;" class="inputstyle"><? echo stripslashes($LinkArray->Description);?></textarea><div class="spacer"></div>

LINK TO MY SITE: <input name="txtInternalLink" id="txtInternalLink" type="radio"  value="1" <? if ($LinkArray->InternalLink == 1) echo 'checked';?> onclick="switch_link('1');"/> Yes&nbsp;&nbsp;<input name="txtInternalLink" id="txtInternalLink" type="radio"  value="0" <? if ($LinkArray->InternalLink == 0) echo 'checked';?> onclick="switch_link('0');"/>No<div class="spacer"></div>
<div id="linkdiv" <? if ($LinkArray->InternalLink == 1) {?>style="display:none;"<? }?>>
LINK (including http://) <br />
<input name="txtLinkUrl" id="txtLinkUrl" type="text" style="width:325px;" class="inputstyle" value="<? echo stripslashes($LinkArray->Link);?>"/>
</div>
</div>
</div>
<div class="spacer"></div>

 <div id='change_image'>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/file_upload_inc.php?compact=yes" style="width:340px;height:75px;" frameborder="0" scrolling="no"></iframe>
</div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
<input type="hidden" value="<? echo $_GET['linkid'];?>" name="txtLink" />
<input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/>
</td></tr></table>  </form>

 