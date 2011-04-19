<script type="text/javascript">
	function move_position_up() {
	var CurrentPosition = document.getElementById('txtPosition').value;
	if (CurrentPosition != <? echo $MaxPosition;?>) {
			 CurrentPosition++;
			 document.getElementById('txtPosition').value = CurrentPosition;
			 document.getElementById('pageposition').innerHTML = CurrentPosition;
		} else { 
			alert('You can\'t move this page any further');
		}
	}
	function move_position_down() {
	 var CurrentPosition = document.getElementById('txtPosition').value;
		if (CurrentPosition !=1) {
			 CurrentPosition--;
			  document.getElementById('txtPosition').value = CurrentPosition;
			  document.getElementById('pageposition').innerHTML = CurrentPosition;
		} else { 
			alert('You can\'t move this page any further');
		}
	}
	function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}
	function rolloveractive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabactive';
			} 
	}
	
	function removePeel(peeltype) {
		attach_file( '/<? echo $_SESSION['pfdirectory'];?>/includes/remove_peel.php?&pageid=<? echo $PageID;?>&type='+peeltype+'&comic=<? echo $ComicID;?>');
			
	}
	function finaltab() {
		if (document.getElementById("finaldiv")!= null) {
			document.getElementById("finaldiv").style.display = '';
			document.getElementById("editfinal").style.display = '';
			document.getElementById("finaltab").className ='profiletabactive';
		}
		if (document.getElementById("colorsdiv")!= null) {
			document.getElementById("colorsdiv").style.display = 'none';
			document.getElementById("editcolors").style.display = 'none';
			document.getElementById("colorstab").className ='profiletabinactive';
		}
		if (document.getElementById("pencilsdiv")!= null) {
			document.getElementById("pencilsdiv").style.display = 'none';
			document.getElementById("editpencils").style.display = 'none';
			document.getElementById("pencilstab").className ='profiletabinactive';
		}
		if (document.getElementById("inksdiv")!= null) {
			document.getElementById("inksdiv").style.display = 'none';
			document.getElementById("inkstab").className ='profiletabinactive';
			document.getElementById("editinks").style.display = 'none';
		}
		if (document.getElementById("scriptdiv")!= null) {
			document.getElementById("scriptdiv").style.display = 'none';
			document.getElementById("scripttab").className ='profiletabinactive';
			document.getElementById("editscript").style.display = 'none';
		}
		
	}
	
	function colorstab() {
		if (document.getElementById("finaldiv")!= null) {
			document.getElementById("finaldiv").style.display = 'none';
			document.getElementById("editfinal").style.display = 'none';
			document.getElementById("finaltab").className ='profiletabinactive';
		}
		if (document.getElementById("colorsdiv")!= null) {
			document.getElementById("colorsdiv").style.display = '';
			document.getElementById("editcolors").style.display = '';
			document.getElementById("colorstab").className ='profiletabactive';
		}
		if (document.getElementById("pencilsdiv")!= null) {
			document.getElementById("pencilsdiv").style.display = 'none';
			document.getElementById("editpencils").style.display = 'none';
			document.getElementById("pencilstab").className ='profiletabinactive';
		}
		if (document.getElementById("inksdiv")!= null) {
			document.getElementById("inksdiv").style.display = 'none';
			document.getElementById("inkstab").className ='profiletabinactive';
			document.getElementById("editinks").style.display = 'none';
		}
		
		if (document.getElementById("scriptdiv")!= null) {
			document.getElementById("scriptdiv").style.display = 'none';
			document.getElementById("scripttab").className ='profiletabinactive';
			document.getElementById("editscript").style.display = 'none';
		}
		
	}
	
	function pencilstab() {
		if (document.getElementById("finaldiv")!= null) {
			document.getElementById("finaldiv").style.display = 'none';
			document.getElementById("editfinal").style.display = 'none';
			document.getElementById("finaltab").className ='profiletabinactive';
		}
		if (document.getElementById("colorsdiv")!= null) {
			document.getElementById("colorsdiv").style.display = 'none';
			document.getElementById("editcolors").style.display = 'none';
			document.getElementById("colorstab").className ='profiletabinactive';
		}
		if (document.getElementById("pencilsdiv")!= null) {
			document.getElementById("pencilsdiv").style.display = '';
			document.getElementById("editpencils").style.display = '';
			document.getElementById("pencilstab").className ='profiletabactive';
		}
		if (document.getElementById("inksdiv")!= null) {
			document.getElementById("inksdiv").style.display = 'none';
			document.getElementById("inkstab").className ='profiletabinactive';
			document.getElementById("editinks").style.display = 'none';
		}
		
		if (document.getElementById("scriptdiv")!= null) {
			document.getElementById("scriptdiv").style.display = 'none';
			document.getElementById("scripttab").className ='profiletabinactive';
			document.getElementById("editscript").style.display = 'none';
		}
		
	}
	function inkstab() {
		if (document.getElementById("finaldiv")!= null) {
			document.getElementById("finaldiv").style.display = 'none';
			document.getElementById("editfinal").style.display = 'none';
			document.getElementById("finaltab").className ='profiletabinactive';
		}
		if (document.getElementById("colorsdiv")!= null) {
			document.getElementById("colorsdiv").style.display = 'none';
			document.getElementById("editcolors").style.display = 'none';
			document.getElementById("colorstab").className ='profiletabinactive';
		}
		if (document.getElementById("pencilsdiv")!= null) {
			document.getElementById("pencilsdiv").style.display = 'none';
			document.getElementById("editpencils").style.display = 'none';
			document.getElementById("pencilstab").className ='profiletabinactive';
		}
		if (document.getElementById("inksdiv")!= null) {
			document.getElementById("inksdiv").style.display = '';
			document.getElementById("editinks").style.display = '';
			document.getElementById("inkstab").className ='profiletabactive';
		}
		
		if (document.getElementById("scriptdiv")!= null) {
			document.getElementById("scriptdiv").style.display = 'none';
			document.getElementById("scripttab").className ='profiletabinactive';
			document.getElementById("editscript").style.display = 'none';
		}
		
	}
	
	function scripttab() {
		if (document.getElementById("finaldiv")!= null) {
			document.getElementById("finaldiv").style.display = 'none';
			document.getElementById("editfinal").style.display = 'none';
			document.getElementById("finaltab").className ='profiletabinactive';
		}
		if (document.getElementById("colorsdiv")!= null) {
			document.getElementById("colorsdiv").style.display = 'none';
			document.getElementById("editcolors").style.display = 'none';
			document.getElementById("colorstab").className ='profiletabinactive';
		}
		if (document.getElementById("pencilsdiv")!= null) {
			document.getElementById("pencilsdiv").style.display = 'none';
			document.getElementById("editpencils").style.display = 'none';
			document.getElementById("pencilstab").className ='profiletabinactive';
		}
		if (document.getElementById("inksdiv")!= null) {
			document.getElementById("inksdiv").style.display = 'none';
			document.getElementById("editinks").style.display = 'none';
			document.getElementById("inkstab").className ='profiletabinactive';
		}
		
		if (document.getElementById("scriptdiv")!= null) {
			document.getElementById("scriptdiv").style.display = '';
			document.getElementById("editscript").style.display = '';
			document.getElementById("scripttab").className ='profiletabactive';
			
		}
		
	}
	
	function toggleepisode(value) {
	if (value =='new') {
		
			document.getElementById("episodediv").style.display = '';
		
	}else {
			document.getElementById("episodediv").style.display = 'none';
	}
}
	
	function copycomment() {
		document.getElementById("txtEpisodeDesc").value = document.getElementById("txtComment").value;
	}
	
	function submitpage() {
	
			document.pageform.submit();

	}
	

	
</script>
	
</script>

<table cellpadding="0" cellspacing="0" border="0"><tr><td width="400" align="center" valign="top" style="padding:5px;">
<div align="left">
<? if ($_SESSION['IsPro'] == 1) {?>
<table cellpadding="0" cellspacing="0" border="0"> 
<tr>
<td class="profiletabactive" align="left" id='finaltab' onMouseOver="rolloveractive('finaltab','finaldiv')" onMouseOut="rolloverinactive('finaltab','finaldiv')" onclick="finaltab();">FINAL</td>
<td width="5"></td>

<td class="profiletabinactive" align="left" id='colorstab' onMouseOver="rolloveractive('colorstab','colorsdiv')" onMouseOut="rolloverinactive('colorstab','colorsdiv')" onclick="colorstab();">COLORS</td>
<td width="5"></td>


<td class="profiletabinactive" align="left" id='inkstab' onMouseOver="rolloveractive('inkstab','inksdiv')" onMouseOut="rolloverinactive('inkstab','inksdiv')" onclick="inkstab();">INKS</td>
<td width="5"></td>


<td class="profiletabinactive" align="left" id='pencilstab' onMouseOver="rolloveractive('pencilstab','pencilsdiv')" onMouseOut="rolloverinactive('pencilstab','pencilsdiv')" onclick="pencilstab();">PENCILS</td>
<td width="5"></td>
<? if (in_array($_SESSION['userid'],$SiteAdmins)) {?>
<td class="profiletabinactive" align="left" id='scripttab' onMouseOver="rolloveractive('scripttab','scriptdiv')" onMouseOut="rolloverinactive('scripttab','scriptdiv')" onclick="scripttab();">SCRIPT</td>
<td width="5"></td>
<td class="profiletabinactive" align="left" id='hotspottab' onMouseOver="rolloveractive('hotspottab','hotspotdiv')" onMouseOut="rolloverinactive('hotspottab','hotspotdiv')" onclick="window.parent.location='/cms/hotspots/<? echo $_SESSION['safefolder'];?>/?page=<? echo $PageID;?>';">HOT SPOTS</td>
<? }?>
</tr>
</table>
<? }?>
</div>
<div id='savealert' style="color:#FF0000; font-weight:bold; font-size:10px;"></div>
<div class='spacer'></div>
<div id='finaldiv'><img src="/<? echo $ThumbLg;?>" alt="" border='1' id='pageimage' width="400"/></div>
<div id='colorsdiv' style="display:none;"><? if($PeelThreeArray->ThumbLg =='') {echo '<img src="/images/cms/no_content.png" id=\'peelthreeimage\'>'; } else {?> <img src="/<? echo $PeelThreeArray->ThumbLg;?>" alt="" border='1' id='peelthreeimage' width="400"/><? } ?></div>
<div id='inksdiv'   style="display:none;"><? if($PeelTwoArray->ThumbLg =='') {echo '<img src="/images/cms/no_content.png" id=\'peeltwoimage\'>'; }else {?> <img src="/<? echo $PeelTwoArray->ThumbLg;?>" alt="" border='1' id='peeltwoimage' width="400"/><? } ?></div>
<div id='pencilsdiv'   style="display:none;"><? if($PeelOneArray->ThumbLg =='') {echo '<img src="/images/cms/no_content.png" id=\'peeloneimage\'>'; }else {?> <img src="/<? echo $PeelOneArray->ThumbLg;?>" alt="" border='1' id='peeloneimage' width="400"/><? } ?></div>
<div id='scriptdiv'   style="display:none;"><? if($PeelFourArray->ThumbLg =='') {echo '<img src="/images/cms/no_content.png" id=\'peeloneimage\'>'; }else {?> <img src="/<? echo $PeelFourArray->ThumbLg;?>" alt="" border='1' id='peelfourimage' width="400"/><? } ?></div>
</td><td width="400" valign="top" style="padding-left:10px;">

<div class="spacer"></div><center>

<form action="/cms/pager/" method="post" name="pageform" id="pageform"><img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submitpage();" class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series=<? echo $_GET['series'];?>&ep=<? echo $_GET['ep'];?>';" class="navbuttons" /><div style="height:5px;"></div></center><div class="spacer"></div>
<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="384" align="center">
<div id='editfinal'>

<div class='sender_name'>Title<br /></div>
<input type="text" name="txtTitle" id='txtTitle' value="<? echo stripslashes($Title);?>"  style="width:100%;"/><div class="spacer"></div><div class='sender_name'>Creator Comment</div>
<textarea name="txtComment" id="txtComment" style="width:100%;height:50px;"><? echo stripslashes($Comment);?></textarea>
<div class="spacer"></div>
<? /*
<table><tr><td class="messageinfo_white">Episode:</td> <td><? echo $EpisodeSelect;?></td></tr></table><? */?>
<input type="checkbox" name="txtChapter" value="1" <? if ($Chapter == 1) echo 'checked';?>/><span class="sender_name">Start Of Chapter</span><div class="spacer"></div>

<? /*
<div id='episodediv' <? if (($Episode == 0) || ($Episode == '')) {?>style="display:none;"<? } ?>/>
<span class="sender_name">Episode Description&nbsp;</span>[<span class="messageinfo"><a href="javascript: void(0)" onclick="copycomment(); return false;">USE COMMENT</a></span>]<textarea name='txtEpisodeDesc' id='txtEpisodeDesc' style="width:300px;height:50px;"><? echo $EpisodeDesc;?></textarea><div class="spacer"></div>
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
<? */?>
<span class="sender_name">
 Active Date: </span><span class="messageinfo" style="font-size:10px;">(MM-DD-YYYY)</span><br />
<input name="txtDatelive" id="txtDatelive" size="10" type="text" value="<? echo $Datelive;?>">&nbsp;<img src="/<? echo $_SESSION['pfdirectory'];?>/images/cal.gif" onclick="displayDatePicker('txtDatelive',false,'mdy','-');" class="calpick">

 
 <div class="spacer"></div>

Current Page Position: <span id='pageposition'><? echo $Position;?></span><div class="spacer"></div>
<input type="button" value="MOVE POSITION UP" onClick="move_position_up();"  style="width:160px;"/>&nbsp;<input type="button" value="MOVE POSITION DOWN" onClick="move_position_down();"  style="width:160px;"/><div class="spacer"></div>
<? if (($_SESSION['IsPro'] == 1) &&($_GET['pageid']!='')) {?>
	<? if ($FlowArray->id =='') {?>
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['pageid'];?>','story page','0');">[Connect to Page]</a>
    <? } else {?>
    Content Connected to Page:<br />
    <? echo $FlowArray->title;?><br />
    <a href="javascript:void(0);" onclick="story_flow('<? echo $_GET['pageid'];?>','story page','1');">[Edit Page Connection]</a>
    <? }?>
	<div class="spacer"></div>
<? }?>
<br />Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? if (($PageArray->AccessType == 'public') || ($PageArray->AccessType == 'public')) echo 'selected';?>>Everyone</option>
<option value="fans" <? if ($PageArray->AccessType == 'fans') echo 'selected';?>>Fans Only</option>
<option value="superfans" <? if ($PageArray->AccessType == 'superfans') echo 'selected';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>
<div id='change_image'>
<? 
$_SESSION['uploadtype'] = 'page';	
$_SESSION['action'] = 'edit';
  		echo 'UPLOAD CONTENT';
	?>
<? /*   
<iframe id='loaderframe' name='loaderframe' height='300' width="300" frameborder="no" scrolling="no" src="/product_file_upload.php"></iframe>
*/?>
<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?pageid=<? echo $_GET['pageid'];?>&compact=yes" style="width:300px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
</div>


<div id='editcolors' style="display:none;">
<div class="messageinfo_warning">EDIT COLORS PEEL</div>
<? if($PeelThreeArray->ThumbLg !=''){?><div class="spacer"></div><div class="messageinfo_white"  id='colorsremove'>[<a href="javascript: void(0)" onclick="removePeel('colors');return false;">REMOVE PEEL</a>]</div><? }?>
<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?pageid=<? echo $_GET['pageid'];?>&type=colors&compact=yes" style="width:300px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
<? /*
<iframe id='loaderframe' name='loaderframe' height='300' width="300" frameborder="no" scrolling="no" src="/product_file_upload.php?peel=colors"></iframe>*/?>
</div>

<div id='editpencils' style="display:none;">
<div class="messageinfo_warning">EDIT PENCILS PEEL</div>
<? if($PeelOneArray->ThumbLg !=''){?><div class="spacer"></div><div class="messageinfo_white"  id='pencilsremove'>[<a href="javascript: void(0)" onclick="removePeel('pencils');return false;">REMOVE PEEL</a>]</div><? }?>
<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?pageid=<? echo $_GET['pageid'];?>&type=pencils&compact=yes" style="width:300px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
<? /*
<iframe id='loaderframe' name='loaderframe' height='300' width="300" frameborder="no" scrolling="no" src="/product_file_upload.php?peel=pencils"></iframe>*/?>

</div>

<div id='editinks' style="display:none;">
<div class="messageinfo_warning">EDIT INKS PEEL</div>
<? if($PeelTwoArray->ThumbLg !=''){?><div class="spacer"></div><div class="messageinfo_white" id='inksremove'>[<a href="javascript: void(0)" onclick="removePeel('inks');return false;">REMOVE PEEL</a>]</div><? }?>
<iframe src="/<? echo $_SESSION['pfdirectory'];?>/includes/file_upload_inc.php?pageid=<? echo $_GET['pageid'];?>&type=inks&compact=yes" style="width:300px;height:175px;" frameborder="0" scrolling="no"></iframe>
</div>
<? /*
<iframe id='loaderframe' name='loaderframe' height='300' width="300" frameborder="no" scrolling="no" src="/product_file_upload.php?peel=inks"></iframe>*/?>

</div>

<div id='hotspotdiv' style="display:none;">
</div>
<? if (in_array($_SESSION['userid'],$SiteAdmins)) {?>

<div id='editscript' style="display:none;">
<div class="messageinfo_warning">EDIT SCRIPT PEEL</div>
<? if($PeelTwoArray->ThumbLg !=''){?><div class="spacer"></div><div class="messageinfo_white" id='scriptremove'>[<a href="javascript: void(0)" onclick="removePeel('script');return false;">REMOVE PEEL</a>]</div><? }?>
<div align="center" style="padding:15px;">[<a href="javascript: void(0)" onclick="parent.edit_script_peel('<? echo $_GET['pageid'];?>');return false;" style="color:#FFFFFF; font-size:14px;">LAUNCH SCRIPT EDITOR</a>]</div>
</div>
<? }?>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>

<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" />
<input type="hidden" value="<? echo $_SESSION['sessionproject'];?>" name="txtComic" />
<input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" />
<input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" />
<input type="hidden" value="edit" name="txtAction" />
<input type="hidden" value="<? echo $_GET['series'];?>" name="series" />
<input type="hidden" value="<? echo $_GET['ep'];?>" name="ep" />
<input type="hidden" id="txtFilename" name="txtFilename" />
<input type="hidden" id="txtPeelOneFilename" name="txtPeelOneFilename" />
<input type="hidden" id="txtPeelTwoFilename" name="txtPeelTwoFilename" />
<input type="hidden" id="txtPeelThreeFilename" name="txtPeelThreeFilename" />
<input type="hidden" id="txtPeelFourFilename" name="txtPeelFourFilename" />
<input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/>
<input type="hidden" value="<? echo $Section;?>" name="txtSection" id='txtSection'/><input type="hidden" value="<? echo $_SESSION['safefolder'];?>" name="txtSafeFolder" id='txtSafeFolder'/>
<input type="hidden" value="<? echo $ComicFolder;?>" name="txtUrl" id='txtUrl'/></form></td></tr></table>  
 