<table cellpadding="0" cellspacing="0" border="0"><tr><td valign="top" height="600"><div class="messageinfo_black">ARE YOU SURE YOU WANT TO DELETE THIS GALLERY? </div><div class="spacer"></div><div class='sender_name'><b>NAME:</b> <? echo stripslashes($GalleryArray->Title);?><div class="spacer"></div><form action="/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php" method="post"><div align="center"><input type="submit" value ='YES' style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/><div class="spacer"></div><input type="button" value="CANCEL" onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php';"  style="width:100px;"/></div><input type="hidden" value="<? echo $_GET['charid'];?>" name="txtItem" />
<input type="hidden" value="delete" name="a" id='a'/>
<input type="hidden" value="<? echo $_GET['gallery'];?>" name="txtGallery" id='txtGallery'/></form></td></tr></table>  

 
