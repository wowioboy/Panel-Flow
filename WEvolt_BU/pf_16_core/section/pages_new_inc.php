<script type="text/javascript">
function toggleepisode(value) {
	if (value =='new') {
			document.getElementById("episodediv").style.display = '';
	} else {
		document.getElementById("episodediv").style.display = 'none';
	}
}
	
	function copycomment() {
		document.getElementById("txtEpisodeDesc").value = document.getElementById("txtComment").value;
	}
	
	function submitpage() {
	if (document.getElementById("txtFilename").value == '') {
		alert('You must first upload an image before saving');
	} else if (document.getElementById("txtTitle").value == '') {
		alert('Please enter a title for this page');
	} else {
	document.pageform.submit();
	}
		

	}
	
</script>

 <div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="250" align="center" valign="top"><div align="center"><div id='savealert' style="color:#FF0000; font-weight:bold; font-size:10px;"></div></div><div><img src="/images/cms/no_content.png" alt="" id='pageimage' width="200"/></div></td><td width="400" valign="top" align="center">
<form action="/cms/pager/" method="post" name="pageform" id="pageform" style="padding:0px; margin:0px;">
<img src="http://www.wevolt.com/images/wizard_save_btn.png" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php';" class="navbuttons" /><div style="height:5px;"></div>

<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="384" align="left">

<div class='sender_name'>Title<br /></div>
<input type="text" name="txtTitle" id='txtTitle' value="<? echo stripslashes($Title);?>"  style="width:380px;"/><div class="spacer"></div><div class='sender_name'>Creator Comment</div>
<textarea name="txtComment" id="txtComment" style="width:380px;height:50px;"><? echo stripslashes($Comment);?></textarea>
<div class="spacer"></div>
<table><tr><td class="messageinfo_white">Episode:</td> <td><? echo $EpisodeSelect;?></td></tr></table>
<? /*<input type="checkbox" name="txtEpisode" value="1" <? if ($Episode == 1) echo 'checked';?> onChange="toggleepisode();"/><span class="sender_name">Start Of Episode</span><? */?><input type="checkbox" name="txtChapter" value="1" <? if ($Chapter == 1) echo 'checked';?>/><span class="messageinfo_white">Start Of Chapter</span><div class="spacer"></div>
<div id='episodediv' <? if (($Episode == 0) || ($Episode == '')) {?>style="display:none;"<? } ?>/>

<span class="sender_name">Episode Description&nbsp;</span>[<span class="messageinfo"><a href="#" onclick="copycomment(); return false;">USE COMMENT</a></span>]<textarea name='txtEpisodeDesc' id='txtEpisodeDesc' style="width:380px;height:50px;"><? echo $EpisodeDesc;?></textarea><div class="spacer"></div>
<span class="sender_name">EPISODE CREDITS</span><span class="messageinfo"> (leave blank to use comic credits)</span><br />
<table width="100%"><tr>
<td class="sender_name" width="50">Writer:</td><td style="padding:3px;"> <input name="txtEpisodeWriter" type="text" style="width:95%;" value="<? echo $EpisodeWriter;?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Artist: </td><td style="padding:3px;"> <input name="txtEpisodeArtist" type="text" style="width:95%;" value="<? echo $EpisodeArtist;?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Colorist: </td><td style="padding:3px;"> <input name="txtEpisodeColorist" type="text" style="width:95%;" value="<? echo $EpisodeColorist;?>"/><br/></td></tr>
<tr>
<td class="sender_name" width="50">Letterer:</td><td style="padding:3px;">  <input name="txtEpisodeLetterer" type="text" style="width:95%;" value="<? echo $EpisodeLetterer;?>"/><br/></td></tr></table>
</div>
<span class="sender_name">
 Active Date: </span><span class="messageinfo" style="font-size:10px;">(MM-DD-YYYY)</span><br />
<input name="txtDatelive" id="txtDatelive" size="10" type="text" value="<? echo date('m-d-Y');?>">&nbsp;<img src="/<? echo $_SESSION['pfdirectory'];?>/images/cal.gif" onclick="displayDatePicker('txtDatelive',false,'mdy','-');" class="calpick">
 </div>
 Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? echo 'selected';?>>Everyone</option>
<option value="fans" >Fans Only</option>
<option value="superfans" >SuperFans Only</option>
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

 <input type="hidden" value="<? echo $_SESSION['sessionproject'];?>" name="txtComic" /><input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" /><input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" /><input type="hidden" value="add" name="txtAction" /><input type="hidden" id="txtFilename" name="txtFilename" /><input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/>
 <input type="hidden" value="<? echo $_GET['series'];?>" name="series" />
 </form>
