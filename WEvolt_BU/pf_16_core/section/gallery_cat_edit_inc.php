<script type="text/javascript">

	
	function submitpage() {
	if (document.getElementById("txtName").value == '') {
			alert('Please enter a name for your category');
	}  else{
		document.pageform.submit();
	}
		

	}
		
</script>
<center>
<div class="grey_text"><? if ($_GET['gallery'] ==''){?>NEW <? }else {?>EDIT<? }?> GALLERY CATEGORY</div>
<div class="spacer"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=cat';" class="navbuttons" />
<div class="spacer"></div>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=cat&a=<? if ($_GET['item'] == ''){?>finish<? } else {?>save<? }?>" method="post" name="pageform" id="pageform">
<table width="500" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="484" align="left">
<div class='grey_text'>NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" class="inputstyle" value="<? echo stripslashes($GalleryArray->Title);?>"/>

<div style="height:5px;"></div>
<div class="grey_text">

PRIVACY SETTING :<select name="txtPrivacy">
<option value='public' <? if ($GalleryArray->PrivacySetting == 'public') echo 'selected';?>>Public</option>
<option value='fans' <? if ($GalleryArray->PrivacySetting == 'fans') echo 'selected';?>>Fans</option>
<option value='superfans' <? if ($GalleryArray->PrivacySetting == 'superfans') echo 'selected';?>>Superfans</option>
<option value='friends' <? if ($GalleryArray->PrivacySetting == 'friends') echo 'selected';?>>Friends</option>
<option value='private' <? if ($GalleryArray->PrivacySetting == 'private') echo 'selected';?>>Private</option>
</select>
</div>

</div>
<div class="spacer"></div>

 
<div align="center">

<input type="hidden" id="txtItem" name="txtItem" value="<? echo $_GET['item'];?>"/>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div></center>
</form> 

 