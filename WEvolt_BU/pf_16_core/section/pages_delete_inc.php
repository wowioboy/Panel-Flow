<table cellpadding="0" cellspacing="0" border="0"><tr><td width="300" align="center" valign="top"><img src="/<? echo $ThumbLg;?>" alt="" border='1' width="300"/></td><td valign="top" height="600" style="padding-left:10px;">
<table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="284" align="left">
                                        <div class="messageinfo_white">ARE YOU SURE YOU WANT TO DELETE THIS PAGE? </div><div class="spacer"></div><div class='messageinfo_white'><b>TITLE:</b> <? echo stripslashes($Title);?><div class="spacer"></div>
                                        </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table><div class="spacer"></div>
<form action="/<? echo $PFDIRECTORY;?>/pager.php" method="post"><div align="center">
                                        <input type="image" style="border:none;background:none;" src="http://www.wevolt.com/images/wizard_save_btn.png"  class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php';" class="navbuttons" /><div style="height:5px;"></div></center><div class="spacer"></div>
                                        
                                        </div><input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="hidden" value="<? echo $AddedBefore;?>" name="addedbefore" /><input type="hidden" value="<? echo $_GET['pageid'];?>" name="txtPage" /><input type="hidden" value="delete" name="txtAction" /><input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/></form></td></tr></table>  

 