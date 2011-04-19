<script type="text/javascript">

	
	function submitpage() {
	if (document.getElementById("txtName").value == '') {
			alert('Please enter a name for your item');
	}  else{
		document.pageform.submit();
	}
		

	}
		
</script>
<center>
<div class="grey_text"><? if ($_GET['gallery'] ==''){?>NEW <? }else {?>EDIT<? }?> GALLERY</div>
<div class="spacer"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php';" class="navbuttons" />

<div class="spacer"></div>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?a=<? if ($_GET['gallery'] == ''){?>finish<? } else {?>save<? }?>" method="post" name="pageform" id="pageform">
<table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="left">
<div class='sender_name'>NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" class="inputstyle" value="<? echo stripslashes($GalleryArray->Title);?>"/>

<div style="height:5px;"></div>
<div class="sender_name">
DESCRIPTION
<br />
<textarea name='txtDescription' id='txtDescription' class="inputstyle" style="width:95%;height:50px;"><? echo stripslashes($GalleryArray->Description);?></textarea><div style="height:5px;"></div>
TAGS
<br />
<textarea name='txtTags' id='txtTags' class="inputstyle" style="width:95%;height:50px;"><? echo stripslashes($GalleryArray->Tags);?></textarea><div style="height:5px;"></div>
<div style="height:5px;"></div>
<? if ($_GET['gallery'] == '') {?>
GALLERY TYPE :<select name="GalleryType">

<option value='images' <? if ($GalleryArray->GalleryType == 'images') echo 'selected';?>>Images</option>
<option value='music' <? if ($GalleryArray->GalleryType == 'music') echo 'selected';?>>Music</option>
<option value='sounds' <? if ($GalleryArray->GalleryType == 'sounds') echo 'selected';?>>Sounds</option>
<option value='videos' <? if ($GalleryArray->PrivacySetting == 'videos') echo 'selected';?>>Videos</option>
<option value='media' <? if ($GalleryArray->GalleryType == 'media') echo 'selected';?>>Multi-Media (Sound, Video, Images)</option>
</select>
<div style="height:5px;"></div>
<? }?>
<? if (($_SESSION['IsPro'] == 1) &&($_GET['a']=='edit')) {?>
<? if ($FlowArray->id =='') {?>
<a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['gallery'];?>','gallery','0');">Connect to Page</a>
<? } else {?>
Content Connected to Page:<br />
<? echo $FlowArray->title;?><br />
<a href="javascript:void(0);" onclick="story_flow('<? echo$_GET['gallery'];?>','gallery','1');">Edit Page Connected</a>

<? }?>
<div class="spacer"></div>
<? }?>
PRIVACY SETTING :<select name="txtPrivacy">
<option value='public' <? if ($GalleryArray->PrivacySetting == 'public') echo 'selected';?>>Public</option>
<option value='fans' <? if ($GalleryArray->PrivacySetting == 'fans') echo 'selected';?>>Fans</option>
<option value='superfan' <? if ($GalleryArray->PrivacySetting == 'superfan') echo 'selected';?>>Superfans</option>
<option value='friends' <? if ($GalleryArray->PrivacySetting == 'friends') echo 'selected';?>>Friends</option>

<option value='private' <? if ($GalleryArray->PrivacySetting == 'private') echo 'selected';?>>Private</option>
</select>
</div>

</div>
<div class="spacer"></div>

 
<div align="center">

<input type="hidden" id="txtGallery" name="txtGallery" value="<? echo $_GET['gallery'];?>"/>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div></center>
</form> 

 