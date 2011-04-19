
<form action="/<? echo $PFDIRECTORY;?>/includes/write_skin.php?a=create" method="post">

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>

<td width="200" align="center" valign="top" > 
<table cellpadding="0" cellspacing="0" border="0" width="80%"> 
<tr>
<td class="profiletabactive" align="left" id='infotab' onMouseOver="rolloveractive('infotab','infodiv')" onMouseOut="rolloverinactive('infotab','infodiv')" onclick="infotab();"> INFORMATION</td>
</tr>

</table>
<div align="center">
<div style="height:4px;"></div>
<input type="submit" value ='NEXT STEP' style="width:80%; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>
<div style="height:4px;"></div>
<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=skins';"  style="width:80%;"/>
</div>
</td>
<td width="685" height="600" valign="top">

<div id='infodiv'>
<div class="pageheader" style="color:#FF9900;">
Please Enter the information below to continue creating a new skin.<div class="spacer"></div>
</div>
<? include 'includes/skin_edit_info_inc.php';?>
</div>

<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" />
<input type="hidden" value="<? echo $ComicID;?>" name="txtComic" />
<input type="hidden" value="create" name="txtAction" />
<input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/>

</td></tr></table> 
</form>