<table cellpadding="0" cellspacing="0" border="0"><tr><td width="300" align="center" valign="top">
<? if ($CharArray->Image == '') {?>
<img src="/<? echo $PFDIRECTORY;?>/images/temp_char.jpg" alt="" border='1' id='pageimage'/>

<? } else { ?>
<img src="/comics/<? echo $ComicDirectory;?>/<? echo stripslashes($CharArray->Image);?>" alt="" border='1' id='pageimage'/>

<? }?>
</td><td valign="top" height="600"><div class="messageinfo_black">ARE YOU SURE YOU WANT TO DELETE THIS CHARACTER? </div><div class="spacer"></div><div class='sender_name'><b>NAME:</b> <? echo stripslashes($CharArray->Name);?><div class="spacer"></div><form action="/<? echo $_SESSION['pfdirectory'];?>/section/characters_inc.php" method="post"><div align="center"><input type="submit" value ='YES' style="width:100px; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/><div class="spacer"></div><input type="button" value="CANCEL" onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/characters_inc.php';"  style="width:100px;"/></div><input type="hidden" value="<? echo $_GET['charid'];?>" name="txtItem" />
<input type="hidden" value="delete" name="a" />
<input type="hidden" value="delete" name="txtAction" /><input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 