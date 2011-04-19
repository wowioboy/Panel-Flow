
<div class='spacer'></div>
<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">GLOBAL SITE SETTINGS</div>
<span class="listcell" align="left">The global sites settings will be used for all sections unless otherwise set.</span>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr>
<td class="buttonbox" width='25%' valign="top">BACKGROUND IMAGE<div class="spacer"></div><div id='GlobalSiteBGImageDiv' align="center"><? if ($GlobalSiteBGImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'GlobalSiteBGImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','GlobalSiteBGImage');return false;"><font color="#0099FF">
<? if ($GlobalSiteBGImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="25%">IMAGE REPEAT<br />
<input  type="radio" name="GlobalSiteImageRepeat" value='' <? if ($GlobalSiteImageRepeat == '')  echo 'checked';?>><font color="black">Repeat All</font><br />
<input  type="radio" name="GlobalSiteImageRepeat" value='no-repeat' <? if(($GlobalSiteImageRepeat == 'none') || ($GlobalSiteImageRepeat == 'no-repeat'))  echo 'checked';?>>
<font color="black">No Repeat</font><br />
<input  type="radio" name="GlobalSiteImageRepeat" value='repeat-y' <? if ($GlobalSiteImageRepeat == 'repeat-y')  echo 'checked';?>>
<font color="black">Repeat Vertical</font><br />
<input  type="radio" name="GlobalSiteImageRepeat" value='repeat-x' <? if ($GlobalSiteImageRepeat == 'repeat-x')  echo 'checked';?>>
<font color="black">Repeat Horizontal</font>
</td> 

<td class="buttonbox" valign="top" width='25%'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="GlobalSiteBGColor" name="GlobalSiteBGColor" value='<? if ($GlobalSiteBGColor == '') { echo 'click here for color'; } else { echo $GlobalSiteBGColor;}?>' size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalSiteTextColor" name="GlobalSiteTextColor" value='<? if ($GlobalSiteTextColor == '') { echo 'click here for color'; } else { echo $GlobalSiteTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='25%'>FONT SIZE<br />
<center>
<input id="GlobalSiteFontSize" name="GlobalSiteFontSize" value='<? if ($GlobalSiteFontSize == '') { echo '12';} else { echo $GlobalSiteFontSize; }?>' size="10">
</center>
</td>
</tr></table>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">LINK SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr><td colspan='2'>NORMAL STATE</td><td colspan='2'>HOVER STATE</td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalSiteLinkTextColor" name="GlobalSiteLinkTextColor" value='<? if ($GlobalSiteLinkTextColor == '') { echo 'click here for color'; } else { echo $GlobalSiteLinkTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalSiteLinkFontStyle">
<option value="regular" <? if (($GlobalSiteLinkFontStyle == '') || ($GlobalSiteLinkFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalSiteLinkFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalSiteLinkFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalSiteHoverTextColor" name="GlobalSiteHoverTextColor" value='<? if ($GlobalSiteHoverTextColor == '') { echo 'click here for color'; } else { echo $GlobalSiteHoverTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalSiteHoverFontStyle">
<option value="regular" <? if (($GlobalSiteHoverFontStyle == '') || ($GlobalSiteHoverFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalSiteHoverFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalSiteHoverFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
</tr>
<tr><td colspan='2' ><div class="spacer"></div>VISITED STATE</td><td colspan='2'></td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalSiteVisitedTextColor" name="GlobalSiteVisitedTextColor" value='<? if ($GlobalSiteVisitedTextColor == '') { echo 'click here for color'; } else { echo $GlobalSiteVisitedTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalSiteVisitedFontStyle">
<option value="regular" <? if (($GlobalSiteVisitedFontStyle == '') || ($GlobalSiteVisitedFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalSiteVisitedFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalSiteVisitedFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
<td valign="top" width='25%'>
</td>

<td  valign="top" width='25%'>&nbsp;</td>
</tr>

</table>
<div class="spacer"></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">PAGE COMMENT SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr><td>MAIN COLOR</td><td>ALT COLOR</td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
BACKGROUND COLOR
<center>
<input class="color {adjust:false}" id="CommentEvenBGColor" name="CommentEvenBGColor" value='<? if ($CommentEvenBGColor == '') { echo 'e5e5e5'; } else { echo $CommentEvenBGColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>
BACKGROUND COLOR
<center>
<input class="color {adjust:false}" id="CommentOddBGColor" name="CommentOddBGColor" value='<? if ($CommentOddBGColor == '') { echo 'FFFFFF'; } else { echo $CommentOddBGColor;}?>'  size="15">
</center></td>

</tr>

</table>

<div class="spacer"></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">GLOBAL BUTTON</div>
<span class="listcell" align="left">The global button settings will be used for all buttons unless set otherwise.</span>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr>
<td class="buttonbox" width='25%' valign="top" align="center">BACKGROUND IMAGE<br /><div class="spacer"></div><div id='ButtonImageDiv' align="center"><? if ($ButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','ButtonImage');return false;"><font color="#0099FF">
<? if ($ButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
<td valign="top" class="buttonbox" width="25%">IMAGE REPEAT<br />
<input  type="radio" name="ButtomImageRepeat" value='' <? if ($ButtomImageRepeat == '')  echo 'checked';?>><font color="black">Repeat All</font><br />
<input  type="radio" name="ButtomImageRepeat" value='no-repeat' <? if(($ButtomImageRepeat == 'none') || ($ButtomImageRepeat == 'no-repeat'))  echo 'checked';?>>
<font color="black">No Repeat</font><br />
<input  type="radio" name="ButtomImageRepeat" value='repeat-y' <? if ($ButtomImageRepeat == 'repeat-y')  echo 'checked';?>>
<font color="black">Repeat Vertical</font><br />
<input  type="radio" name="ButtomImageRepeat" value='repeat-x' <? if ($ButtomImageRepeat == 'repeat-x')  echo 'checked';?>>
<font color="black">Repeat Horizontal</font>
</td> 
<td class="buttonbox" valign="top" width='25%'>BACKGROUND COLOR<br /><center>
<input class="color {adjust:false}" id="ButtonBGColor" name="ButtonBGColor" value='<? if ($ButtonBGColor == '') { echo 'click here for color'; } else { echo $ButtonBGColor;}?>'  size="15"></center><div style="height:5px;"></div>
TEXT COLOR<center>
<input class="color {adjust:false}" id="ButtonTextColor" name="ButtonTextColor" value='<? if ($ButtonTextColor == '') { echo 'click here for color'; } else { echo $ButtonTextColor;}?>'  size="15"></center>
</td>
<td class="buttonbox" valign="top" width='25%'>FONT SIZE<br /><center>
<input id="ButtonFontSize" name="ButtonFontSize" value='<? if ($ButtonFontSize == '') { echo '12';} else { echo $ButtonFontSize; }?>' size="15"></center><div style="height:5px;"></div>
FONT STYLE<center>
<select name="ButtonFontStyle">
<option value="regular" <? if (($ButtonFontStyle == '') || ($ButtonFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($ButtonFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($ButtonFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select></center>
</td>
</tr></table>
<div class="spacer"></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">BUTTON TEXT SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr><td colspan='2'>NORMAL STATE</td><td colspan='2'>HOVER STATE</td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalButtonLinkTextColor" name="GlobalButtonLinkTextColor" value='<? if ($GlobalButtonLinkTextColor == '') { echo 'click here for color'; } else { echo $GlobalButtonLinkTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalButtonLinkFontStyle">
<option value="regular" <? if (($GlobalButtonLinkFontStyle == '') || ($GlobalButtonLinkFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalButtonLinkFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalButtonLinkFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalButtonHoverTextColor" name="GlobalButtonHoverTextColor" value='<? if ($GlobalButtonHoverTextColor == '') { echo 'click here for color'; } else { echo $GlobalButtonHoverTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalButtonHoverFontStyle">
<option value="regular" <? if (($GlobalButtonHoverFontStyle == '') || ($GlobalButtonHoverFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalButtonHoverFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalButtonHoverFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
</tr>
<tr><td colspan='2'><div class="spacer"></div>VISITED STATE</td><td colspan='2'></td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalButtonVisitedTextColor" name="GlobalButtonVisitedTextColor" value='<? if ($GlobalButtonVisitedTextColor == '') { echo 'click here for color'; } else { echo $GlobalButtonVisitedTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalButtonVisitedFontStyle">
<option value="regular" <? if (($GlobalButtonVisitedFontStyle == '') || ($GlobalButtonVisitedFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalButtonVisitedFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalButtonVisitedFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
<td valign="top" width='25%'>
</td>

<td  valign="top" width='25%'>&nbsp;</td>
</tr>

</table>


<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">TAB SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr><td colspan='2'>NORMAL STATE</td><td colspan='2'>HOVER STATE</td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
BACKGROUND COLOR
<center>
<input class="color {adjust:false}" id="GlobalTabInActiveBGColor" name="GlobalTabInActiveBGColor" value='<? if ($GlobalTabInActiveBGColor == '') { echo 'click here for color'; } else { echo $GlobalTabInActiveBGColor;}?>'  size="15">
</center>
<div class="spacer"></div>
TEXTCOLOR
<center>
<input class="color {adjust:false}" id="GlobalTabInActiveTextColor" name="GlobalTabInActiveTextColor" value='<? if ($GlobalTabInActiveTextColor == '') { echo 'click here for color'; } else { echo $GlobalTabInActiveTextColor;}?>'  size="15"></center>
</td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalTabInActiveFontStyle">
<option value="regular" <? if (($GlobalTabInActiveFontStyle == '') || ($GlobalTabInActiveFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalTabInActiveFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalTabInActiveFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center>FONT SIZE<br />
<center>
<input id="GlobalTabInActiveFontSize" name="GlobalTabInActiveFontSize" value='<? if ($GlobalTabInActiveFontSize == '') { echo '14';} else { echo $GlobalTabInActiveFontSize; }?>' size="15">
</center></td>
<td class="buttonbox" valign="top" width='25%'>
BACKGROUND COLOR
<center>
<input class="color {adjust:false}" id="GlobalTabHoverBGColor" name="GlobalTabHoverBGColor" value='<? if ($GlobalTabHoverBGColor == '') { echo 'click here for color'; } else { echo $GlobalTabHoverBGColor;}?>'  size="15">
</center>
<div class="spacer"></div>
TEXTCOLOR
<center>
<input class="color {adjust:false}" id="GlobalTabHoverTextColor" name="GlobalTabHoverTextColor" value='<? if ($GlobalTabHoverTextColor == '') { echo 'click here for color'; } else { echo $GlobalTabHoverTextColor;}?>'  size="15"></center>
</td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalTabHoverFontStyle">
<option value="regular" <? if (($GlobalTabHoverFontStyle == '') || ($GlobalTabHoverFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalTabHoverFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalTabHoverFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center>FONT SIZE<br />
<center>
<input id="GlobalTabHoverFontSize" name="GlobalTabHoverFontSize" value='<? if ($GlobalTabHoverFontSize == '') { echo '14';} else { echo $GlobalTabHoverFontSize; }?>' size="15">
</center></td>
</tr>
<tr><td colspan='2'><div class="spacer"></div>
ACTIVE STATE</td>
  <td colspan='2'></td></tr>
<tr>
<td class="buttonbox" valign="top" width='25%'>
BACKGROUND COLOR
<center>
<input class="color {adjust:false}" id="GlobalTabActiveBGColor" name="GlobalTabActiveBGColor" value='<? if ($GlobalTabActiveBGColor == '') { echo 'click here for color'; } else { echo $GlobalTabActiveBGColor;}?>'  size="15">
</center>
<div class="spacer"></div>
TEXTCOLOR
<center>
<input class="color {adjust:false}" id="GlobalTabActiveTextColor" name="GlobalTabActiveTextColor" value='<? if ($GlobalTabActiveTextColor == '') { echo 'click here for color'; } else { echo $GlobalTabActiveTextColor;}?>'  size="15"></center>
</td>

<td class="buttonbox" valign="top" width='25%'>FONT STYLE<br />
<center>
<select name="GlobalTabActiveFontStyle">
<option value="regular" <? if (($GlobalTabActiveFontStyle == '') || ($GlobalTabActiveFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalTabActiveFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalTabActiveFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center>FONT SIZE<br />
<center>
<input id="GlobalTabActiveFontSize" name="GlobalTabActiveFontSize" value='<? if ($GlobalTabActiveFontSize == '') { echo '14';} else { echo $GlobalTabActiveFontSize; }?>' size="15">
</center></td>
<td valign="top" width='25%'>
</td>

<td  valign="top" width='25%'>&nbsp;</td>
</tr>

</table>
<div class='spacer'></div>
<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">PAGE AREA (HTML READER ONLY)</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr>
<td class="buttonbox" valign="top" width='25%'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="PageBGColor" name="PageBGColor" value='<? if ($PageBGColor == '') { echo 'click here for color'; } else { echo $PageBGColor;}?>' size="15">
</center>

</td>
<td class="buttonbox" width='150' valign="top">LATEST  PAGE HEADER
  <div id='LatestPageHeaderDiv' align="center"><? if ($LatestPageHeader != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'LatestPageHeader\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','LatestPageHeader');return false;"><font color="#0099FF">
<? if ($LatestPageHeader == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
</tr>
</table>

<div class='spacer'></div>
<div class='pagetitleLarge'><b>HOT SPOT SETTINGS</b></div>

<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">HOT SPOT APPEARANCE</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr>
<td class="buttonbox" width='25%' valign="top" align="center">HOT SPOT IMAGE<br /><div class="spacer"></div><div id='HotSpotImageDiv' align="center"><? if ($HotSpotImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'HotSpotImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','HotSpotImage');return false;"><font color="#0099FF">
<? if ($HotSpotImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
<td valign="top" class="buttonbox" width="25%">HOT SPOT OPEN<br />
<input  type="radio" name="BubbleOpen" value='mouseover' <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'checked';?>>
On Mouseover<br />
<input  type="radio" name="BubbleOpen" value='click' <? if ($BubbleOpen == 'click')  echo 'checked';?>>
On Click
</td>
<td class="buttonbox" valign="top" width='25%'>HOT SPOT COLOR<br /><center>
<input class="color {adjust:false}" id="HotSpotBGColor" name="HotSpotBGColor" value='<? if ($HotSpotBGColor == '') { echo 'click here for color'; } else { echo $HotSpotBGColor;}?>'  size="15"></center><div style="height:5px;"></div>
</td>

</tr></table>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;" align="left">HOT SPOT TRIGGERS</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="90%">
<tr>
<td valign="top" class="buttonbox" width="25%">HOT SPOT OPEN<br />
<input  type="radio" name="BubbleOpen" value='mouseover' <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'checked';?>>
On Mouseover<br />
<input  type="radio" name="BubbleOpen" value='click' <? if ($BubbleOpen == 'click')  echo 'checked';?>>
On Click
</td>
<td valign="top" class="buttonbox" width="25%">HOT SPOT CLOSE<br />
<input  type="radio" name="BubbleClose" value='mouseout' <? if (($BubbleClose == '') || ($BubbleClose == 'mouseout'))  echo 'checked';?>>
On Mouse Out<br />
<input  type="radio" name="BubbleClose" value='click' <? if ($BubbleClose == 'click')  echo 'checked';?>>
On Click
</td>

</tr></table>