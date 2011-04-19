<table cellpadding="0" cellspacing="0" border="0"><tr><td width="500" align="center" valign="top"><? echo $HtmlContent;?></td><td valign="top" height="600"><div class="warning">ARE YOU SURE YOU WANT TO DELETE THIS PAGE? </div><div class="spacer"></div><div class='pagetitleLarge'><b>TITLE:</b> <? echo stripslashes($Title);?><div class="spacer"></div><form action="/story/edit/<? echo $SafeFolder;?>/?section=pages&?pageid=<? echo $PageID;?>&a=delete" method="post"><div align="center"><input type="submit" value ='YES' style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/><div class="spacer"></div><input type="button" value="CANCEL" onClick="window.location='/story/edit/<? echo $SafeFolder;?>/?section=pages';"  style="width:100px;"/></div><input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $StoryID;?>" name="txtStory" />
<input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" />
<input type="hidden" value="1" name="delete" />
<input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/>
</form></td></tr></table>  

 