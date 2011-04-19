<script type="text/javascript">

	
	function submitpage() {
	if (document.getElementById("txtName").value == '') {
			alert('Please enter a name for your item');
	<? if ($_GET['a'] == 'new') {?>
	} else if (document.getElementById("txtFilename").value == '') {
	
		alert('Please upload content');
	
	<? }?>} else {
			document.pageform.submit();
	}
		

	}
		
</script>
<table cellpadding="0" cellspacing="0" border="0"><tr>
<td width="450" align="center" valign="top"><div id='savealert' style="color:#FF0000; font-weight:bold; font-size:12px;"></div><div class="grey_text">CONTENT</div>
<div>

<? 

$DownloadType = $DownloadsArray->Type;
if ($DownloadsArray->Image == '') {?>

<img src="/images/cms/no_content.png" alt="" id='pageimage' width="250"/>

<? } else { ?>
<img src="/<? echo $_SESSION['basefolder'];?>/<? echo $_SESSION['projectfolder'];?>/<? echo stripslashes($DownloadsArray->Image);?>" alt="" border='1' id='pageimage' width="250"/>

<? }?>
</div></td><td width="470" height="600" valign="top">
<center><div style="height:10px;"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/mobile_inc.php';" class="navbuttons" /></center><div class="spacer"></div>

<form action="/<? echo $_SESSION['pfdirectory'];?>/section/mobile_inc.php?a=<? if ($_GET['dlid'] == ''){?>finish<? } else {?>save<? }?>&project=<? echo $_SESSION['safefolder'];?>" method="post" name="pageform" id="pageform">
<table width="380" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="364" align="left">

<div class='sender_name'>NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" class="inputstyle" value="<? echo stripslashes($DownloadsArray->Title);?>"/><div style="height:5px;"></div>

<div class="sender_name">
DESCRIPTION
<br />
<textarea name='txtDescription' id='txtDescription' class="inputstyle" style="width:95%;height:50px;"><? echo stripslashes($DownloadsArray->Description);?></textarea><div style="height:5px;"></div>
<div style="height:5px;"></div>

PRIVACY SETTING :<select name="txtPrivacy">
<option value='public' <? if ($DownloadsArray->PrivacySetting == 'public') echo 'selected';?>>Public</option>
<option value='fans' <? if ($DownloadsArray->PrivacySetting == 'fans') echo 'selected';?>>Fans</option>
<option value='superfans' <? if ($DownloadsArray->PrivacySetting == 'superfans') echo 'selected';?>>Superfans</option>
<option value='friends' <? if ($DownloadsArray->PrivacySetting == 'friends') echo 'selected';?>>Friends</option>
</select>
</div>

</div>
<div style="height:5px;"></div>

 <div id='cms_links'>
[<a href="javascript:void(0)" onclick="parent.location.href='/cms/mobile/start/<? echo $_SESSION['safefolder'];?>/?action=edit&item=<? echo $_GET['dlid'];?>';">CHANGE IMAGE</a>]
</div>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
<input type="hidden" value="<? echo $_GET['dlid'];?>" name="txtItem" />

</form></td></tr></table>  

 