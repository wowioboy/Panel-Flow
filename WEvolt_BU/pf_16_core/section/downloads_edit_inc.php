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
<td width="450" align="center" valign="top"><div id='savealert' style="color:#FF0000; font-weight:bold; font-size:12px;"></div><div class="sender_name">CONTENT</div>
<div>

<? 

$DownloadType = $DownloadsArray->DlType;
if ($DownloadsArray->Image == '') {?>

<img src="/images/cms/no_content.png" alt="" id='pageimage' width="250"/>

<? } else { ?>
<img src="/<? echo $_SESSION['basefolder'];?>/<? echo $_SESSION['projectfolder'];?>/<? if (($DownloadType == 4))  echo stripslashes($DownloadsArray->Thumb); else echo stripslashes($DownloadsArray->Image);?>" alt="" border='1' id='pageimage'  <? if (($DownloadType == 1)||($DownloadType == 2)||($DownloadType == 5)) {?>width="250"<? }?>/>

<? }?>
</div></td><td width="470" height="600" valign="top">
<center><div style="height:10px;"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/downloads_inc.php';" class="navbuttons" /></center><div class="spacer"></div>

<form action="/<? echo $_SESSION['pfdirectory'];?>/section/downloads_inc.php?a=<? if ($_GET['dlid'] == ''){?>finish<? } else {?>save<? }?>&project=<? echo $_SESSION['safefolder'];?>" method="post" name="pageform" id="pageform">
<table width="380" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="364" align="left">

<div class='sender_name'>NAME:<br /> <input name="txtName" id="txtName" type="text" style="width:325px;" class="inputstyle" value="<? echo stripslashes($DownloadsArray->Name);?>"/><div style="height:5px;"></div>

<div class="sender_name">
DESCRIPTION
<br />
<textarea name='txtDescription' id='txtDescription' class="inputstyle" style="width:95%;height:50px;"><? echo stripslashes($DownloadsArray->Description);?></textarea><div style="height:5px;"></div>

DOWNLOAD TYPE
<select name="DLType">
<option value="1" <? if ($DownloadType == "1") echo 'selected';?>>Desktop</option>
<option value="2" <? if ($DownloadType == "2") echo 'selected';?>>Cover</option>
<option value="3" <? if ($DownloadType == "3") echo 'selected';?>>Avatar</option>
<option value="4" <? if ($DownloadType == "4") echo 'selected';?>>File</option>
<option value="5" <? if ($DownloadType == "5") echo 'selected';?>>Other</option>
</select><div style="height:5px;"></div>
<? if (($_SESSION['IsPro'] == 1) &&($_GET['a']=='edit')) {?>
	<? if ($FlowArray->id =='') {?>
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['dlid'];?>','download','0');">[Connect to Page]</a>
    <? } else {?>
    Content Connected to Page:<br />
    <? echo $FlowArray->title;?><br />
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['dlid'];?>','download','1');">[Edit Page Connection]</a>
    <? }?>
	<div class="spacer"></div>
<? }?>
PRIVACY SETTING :<select name="txtPrivacy">
<option value='public' <? if ($DownloadsArray->PrivacySetting == 'public') echo 'selected';?>>Public</option>
<option value='fans' <? if ($DownloadsArray->PrivacySetting == 'fans') echo 'selected';?>>Fans</option>
<option value='superfans' <? if ($DownloadsArray->PrivacySetting == 'superfans') echo 'selected';?>>Superfans</option>
<option value='friends' <? if ($DownloadsArray->PrivacySetting == 'friends') echo 'selected';?>>Friends</option>
</select>
</div>

</div>
<div style="height:5px;"></div>

 <div id='change_image'>
<? 


	$_SESSION['uploadtype'] = 'download';

if ($_GET['item'] =='')
	$_SESSION['action'] = 'new';
else 
	$_SESSION['action'] = 'edit';
	?>
  <? if ($_GET['item'] =='')
  		echo 'UPLOAD CONTENT';
	else 
		echo 'CHANGE CONTENT';?>
 <iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?compact=yes" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
   <? /*
<iframe id='loaderframe' name='loaderframe' height='250' width="350" frameborder="no" scrolling="no" src="/product_file_upload.php"></iframe>*/?>
 
<!--<iframe src="/<? //echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?s=gallery&compact=yes" style="width:340px;height:75px;" frameborder="0" scrolling="no"></iframe>-->
</div>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table><div class="spacer"></div>
<input type="hidden" value="<? echo $_GET['dlid'];?>" name="txtItem" />
<input type="hidden" id="txtFilename" name="txtFilename" />
<input type="hidden" id="txtThumb" name="txtThumb" />
</form></td></tr></table>  

 