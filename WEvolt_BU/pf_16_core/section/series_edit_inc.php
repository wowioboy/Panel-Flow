<script type="text/javascript">
			function toggleepisode() {
	
		if (document.getElementById("episodediv").style.display == '') {
			document.getElementById("episodediv").style.display = 'none';
		} else {
			document.getElementById("episodediv").style.display = '';
		}
	}
	
	function submitpage() {
	//if (document.getElementById("txtFilename").value == '') {
		//alert('You must first upload an image before saving');
	//} else 
	if (document.getElementById("txtTitle").value == '') {
		alert('Please enter a title for this series');
	} else {
	document.pageform.submit();
	}
		
 
	}
	
</script>

 <div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="250" align="center" valign="top"><div align="center"><div id='savealert' style="color:#FF0000; font-weight:bold; font-size:10px;"></div></div><? if ($_GET['a'] == 'edit') {?><div><img src="<? echo $PageArray->Image;?>" alt="" border='1' width="300" id="pageimage"/></div><? } else {?><div><img src="/images/cms/no_content.png" alt="" id='pageimage' width="200"/></div><? }?> </td><td width="400" valign="top" align="center" style="padding-left:15px;">
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=series&a=<? if ($_GET['a']=='edit') echo 'save'; else echo 'finish';?>" method="post" name="pageform" id="pageform" style="padding:0px; margin:0px;">
<img src="http://www.wevolt.com/images/wizard_save_btn.png" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=series';" class="navbuttons" /><div style="height:5px;"></div>

<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="384" align="left">

<div class='sender_name'>Title<br /></div>
<input type="text" name="txtTitle" id='txtTitle' value="<? echo stripslashes($PageArray->Title);?>"  style="width:380px;"/><div class="spacer"></div>

<span class="sender_name">Series Description&nbsp;</span><span class="messageinfo"><textarea name='txtDesc' id='txtDesc' style="width:380px;height:50px;"><? echo stripslashes($PageArray->Synopsis);?></textarea><div class="spacer"></div>
<span class="sender_name">Credits</span><span class="messageinfo"> (leave blank to use comic credits)</span><br />
<table width="100%"><tr>
<td class="sender_name" width="50">Writer:</td><td style="padding:3px;"> <input name="txtWriter" type="text" style="width:95%;" value="<? echo stripslashes($PageArray->Writer);?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Artist: </td><td style="padding:3px;"> <input name="txtArtist" type="text" style="width:95%;" value="<? echo stripslashes($PageArray->Artist);?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Colorist: </td><td style="padding:3px;"> <input name="txtColorist" type="text" style="width:95%;" value="<? echo stripslashes($PageArray->Colorist);?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Letterer:</td><td style="padding:3px;">  <input name="txtLetterer" type="text" style="width:95%;" value="<? echo stripslashes($PageArray->Letterist);?>"/><br/></td></tr></table>
</div>
Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? if (($PageArray->AccessType == 'public') || ($PageArray->AccessType == 'public')) echo 'selected';?>>Everyone</option>
<option value="fans" <? if ($PageArray->AccessType == 'fans') echo 'selected';?>>Fans Only</option>
<option value="superfans" <? if ($PageArray->AccessType == 'superfans') echo 'selected';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>
<div id='change_image'>
 <? 
$_SESSION['uploadtype'] = 'page';	
$_SESSION['action'] = 'new';
  		echo 'UPLOAD CONTENT';
?>
<? /*<iframe id='loaderframe' name='loaderframe'  frameborder="no" scrolling="no" src="/product_file_upload.php" style="width:350px; height:250px;""></iframe>*/?>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/file_upload_inc.php?pageid=<? echo $_GET['pageid'];?>&compact=yes" style="width:325px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>


</td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>

</td></tr></table>  

<? if ($_GET['a'] == 'edit') {?>
 <input type="hidden" value="<? echo $_GET['series'];?>" name="txtSeries" />
  <input type="hidden" id="txtAction" name="txtAction" value="edit"/>
 <input type="hidden" value="series" name="edittype"/>
<? } else {?>
  <input type="hidden" id="txtAction" name="txtAction" value="add"/>
 <input type="hidden" value="series" name="addtype"/>
<? }?>
 <input type="hidden" id="txtFilename" name="txtFilename" />
 </form>