<form action="/<? echo $PFDIRECTORY;?>/section/pages_inc.php?series=<? echo $_GET['series'];?>&sub=episodes" method="post">
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="300" align="center" valign="top"><img src="/<? echo $ThumbLg;?>" alt="" border='1' width="400"/></td><td valign="top" height="600" style="padding-left:20px;">
<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="384" align="left">
                                        <div class="messageinfo_warning">ARE YOU SURE YOU WANT TO DELETE THIS EPISODE? </div><div class="spacer"></div>
                                        This will delete all the pages on this episode. <strong>THIS CANNOT BE UNDONE.</strong>
                                        <div class="spacer"></div>
                                        <div class='messageinfo_white'><b>Episode Title:</b> <? echo stripslashes($Title);?><div class="spacer"></div>
                                        <div class='messageinfo_white'><em>Series: <? echo stripslashes($SeriesTitle);?></em><div class="spacer"></div>
                                         <div class='messageinfo_white'><em>Total Pages: <? echo stripslashes($TotalPages);?></em><div class="spacer"></div>
                                         <? /*
                                         What would you like to do with the Pages under this episode?<br />
<input type="radio" value="delete" name="txtPageAction" checked/>Delete Pages&nbsp;&nbsp;<br />
<? if ($_GET['episode'] > $FirstEpisode) {?>
<input type="radio" value="moveprev" name="txtPageAction" />Move Pages to Previous Episode&nbsp;&nbsp;<br />
<? }?>
<? if ($_GET['episode'] < $LastEpisode) {?>
<input type="radio" value="movenext" name="txtPageAction" />Move Pages to Next Episode&nbsp;&nbsp;
<? }?><? */?>

<input type="hidden" value="delete" name="txtPageAction"/>
                                        </td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table><div class="spacer"></div>
<div align="center">
                                        <input type="image" style="border:none;background:none;" src="http://www.wevolt.com/images/wizard_save_btn.png"  class="navbuttons"/>&nbsp;<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=episodes';" class="navbuttons" /><div style="height:5px;"></div></center><div class="spacer"></div>
                                        
                                        </div>
                                        <input type="hidden" value="<? echo $_GET['episode'];?>" name="txtEpisode" /><input type="hidden" value="delete" name="txtAction" /></td></tr></table>  </form>

 