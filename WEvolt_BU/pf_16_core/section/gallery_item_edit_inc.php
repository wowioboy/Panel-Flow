<script type="text/javascript">

	
	function submitpage() {
	if (document.getElementById("txtName").value == '') {
			alert('Please enter a name for your item');
	}  else{
		document.pageform.submit();
	}
		

	}
		
</script>
<table cellpadding="0" cellspacing="0" border="0"><tr>
<td width="450" align="center" valign="top">CONTENT
<div>
<? if (($GalleryArray->ThumbLg == '') && ($GalleryArray->NeedConvert == 0) && ($GalleryArray->Embed == '')) {?>
<img src="/<? echo $_SESSION['pfdirectory'];?>/images/temp_content_image.jpg" alt="" border='1' id='pageimage'/>

<? } else if ($GalleryArray->NeedConvert == 1) {?>
<img src="/<? echo $_SESSION['pfdirectory'];?>/images/temp_upload.jpg" alt="" border='1' id='pageimage'/>

<? } else if ($GalleryArray->Embed != '') {

echo stripslashes($GalleryArray->Embed); 

} else {?>
<img src="/<? echo stripslashes($GalleryArray->ThumbLg);?>" alt="" border='1' id='pageimage'/>
<? }?>
</div></td><td width="470" height="600" valign="top">
<div class="grey_text"><? if ($_GET['item'] ==''){?>NEW <? }else {?>EDIT<? }?> GALLERY ITEM</div>
<div class="spacer"></div>
<center><div id='savealert' style="color:#FF0000; font-weight:bold; font-size:12px;"></div>

<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=item';" class="navbuttons" /></center><div class="spacer"></div>
</center><div class="spacer"></div>

<form action="/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=item&a=<? if ($_GET['item'] != ''){?>save<? } else {?>finish<? }?>" method="post" name="pageform" id="pageform">
<table width="470" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="354" align="left">

<div class='sender_name'>NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" class="inputstyle" value="<? if ($_GET['item'] != '') echo stripslashes($GalleryArray->Title);?>"/><div style="height:5px;"></div>
<? if (($_GET['gallery'] == '') && ($_GET['item'] == '')) {?>
GALLERY:
<? echo $GallerySelect;?>
<div style="height:5px;"></div>
<? }?>
CATEGORY:
<? echo $CatSelect;?>
<div style="height:5px;"></div>
<? if ($_GET['item'] != '') {?>
MAKE GALLERY THUMBNAIL: <input type="checkbox" name="txtGalleryThumb" value="1" <? if ($GalleryArray->GalleryThumb == 1) echo 'checked';?>/><div style="height:5px;"></div>
<? }?>
<div class="sender_name">
DESCRIPTION
<br />

<textarea name='txtDescription' id='txtDescription' class="inputstyle" style="width:95%;height:50px;"><? if ($_GET['item'] != '') echo stripslashes($GalleryArray->Description);?></textarea><div style="height:5px;"></div>
<? if (($GalleryArray->GalleryType == 'videos') || ($GalleryArray->GalleryType == 'media')) {?>
EMBED CODE (Paste video embed code from Youtube or other providers in this box. This will stream the video in your gallery section)
<br />
<textarea name='txtEmbed' id='txtEmbed' class="inputstyle" style="width:95%;height:100px;"><? echo stripslashes($GalleryArray->Embed);?></textarea>
<div style="height:5px;"></div>
<? }?>
<? if (($_SESSION['IsPro'] == 1) &&($_GET['a']=='edit')) {?>
<? if ($FlowArray->id =='') {?>
<a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['item'];?>','gallery item','0');">[Connect to Page]</a>
<? } else {?>
Content Connected to Page:<br />
<? echo $FlowArray->title;?><br />
<a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['item'];?>','gallery item','1');">[edit connection]</a>

<? }?>
<div class="spacer"></div>
<? }?>
PRIVACY SETTING :<select name="txtPrivacy">
<option value='public' <? if ($_GET['item'] != '') { if ($GalleryArray->PrivacySetting == 'public') echo 'selected';}?>>Everyone</option>
<option value='fans' <? if ($_GET['item'] != '') {if ($GalleryArray->PrivacySetting == 'fans') echo 'selected';}?>>Fans</option>
<option value='superfans' <? if ($_GET['item'] != '') {if ($GalleryArray->PrivacySetting == 'superfans') echo 'selected';}?>>Superfans</option>
<option value='friends' <? if ($_GET['item'] != ''){ if ($GalleryArray->PrivacySetting == 'friends') echo 'selected';}?>>Friends</option>
<option value='private' <? if ($_GET['item'] != ''){ if ($GalleryArray->PrivacySetting == 'private') echo 'selected';}?>>Private</option>
</select>
</div>

</div>
<div style="height:5px;"></div>

 <div id='change_image'>
<? 

if (($GalleryArray->GalleryType == '') || ($GalleryArray->GalleryType == 'image'))
	$_SESSION['uploadtype'] = 'gallery_image';
else if ($GalleryArray->GalleryType == 'videos')
	$_SESSION['uploadtype'] = 'gallery_video';
else if ($GalleryArray->GalleryType == 'media')
	$_SESSION['uploadtype'] = 'gallery_content';
else if (($GalleryArray->GalleryType == 'music') || ($GalleryArray->GalleryType == 'sounds'))
	$_SESSION['uploadtype'] = 'gallery_sound';	

if ($_GET['item'] =='')
	$_SESSION['action'] = 'new';
else 
	$_SESSION['action'] = 'edit';
	?>
 
<iframe src="/<? echo $PFDIRECTORY;?>/includes/file_upload_inc.php?compact=yes" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
<? /*<iframe id='loaderframe' name='loaderframe' height='300' width="350" frameborder="no" scrolling="auto" src="/product_file_upload.php"></iframe>*/?>
 
<!--<iframe src="/<? //echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?s=gallery&compact=yes" style="width:340px;height:75px;" frameborder="0" scrolling="no"></iframe>-->
</div>
<div align="center">
<? if ($_GET['gallery'] != '') {?>
<input type="hidden" value="<? echo $_GET['gallery'];?>" name="txtGallery" />
<? }?>
<? if ($_GET['item'] != '') {?>
<input type="hidden" value="<? echo $GalleryArray->GalleryID;?>" name="txtGallery" />

<? }?>
<input type="hidden" value="<? echo $_GET['item'];?>" name="txtItem" />
<input type="hidden" id="txtFilename" name="txtFilename" />

</form>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
</td></tr></table>  

 