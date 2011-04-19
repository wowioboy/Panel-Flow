<div class='pagetitleLarge'><b>PAGE READER</b></div>
<div class='spacer'></div>

<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">CONTROL BAR SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class="spacer"></div><div id='ControlBarImageDiv' align="center"><? if ($ControlBarImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ControlBarImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ControlBarImage');return false;"><font color="#0099FF">
<? if ($ControlBarImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="ControlBarImageRepeat" value='none' <? if (($ControlBarImageRepeat == '') || ($ControlBarImageRepeat == 'none'))  echo 'checked';?>>
<font color="white">No Repeat</font><br />
<input  type="radio" name="ControlBarImageRepeat" value='repeat-y' <? if ($ControlBarImageRepeat == 'repeat-y')  echo 'checked';?>>
<font color="white">Repeat Vertical</font><br />
<input  type="radio" name="ControlBarImageRepeat" value='repeat-x' <? if ($ControlBarImageRepeat == 'repeat-x')  echo 'checked';?>>
<font color="white">Repeat Horizontal</font>
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="ControlBarBGColor" name="ControlBarBGColor" value='<? if ($ControlBarBGColor == '') { echo 'click here for color'; } else { echo $ControlBarBGColor;}?>' size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="ControlBarTextColor" name="ControlBarTextColor" value='<? if ($ControlBarTextColor == '') { echo 'click here for color'; } else { echo $ControlBarTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="ControlBarFontSize" name="ControlBarFontSize" value='<? if ($ControlBarFontSize == '') { echo '12';} else { echo $ControlBarFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="ControlBarFontStyle">
<option value="regular" <? if (($ControlBarFontStyle == '') || ($ControlBarFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($ControlBarFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($ControlBarFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center>
</td>
</tr>


<tr>


<td class="buttonbox" valign="top" width='150'>READER BUTTON COLOR<br />
<center>
<input class="color {adjust:false}" id="ReaderButtonBGColor" name="ReaderButtonBGColor" value='<? if ($ReaderButtonBGColor == '') { echo 'click here for color'; } else { echo $ReaderButtonBGColor;}?>' size="15">
</center>
<div style="height:5px;"></div>
ARROW COLOR
<center>
<input class="color {adjust:false}" id="ReaderButtonAccentColor" name="ReaderButtonAccentColor" value='<? if ($ReaderButtonAccentColor == '') { echo 'click here for color'; } else { echo $ReaderButtonAccentColor;}?>'  size="15">
</center>
</td>

<td  valign="top" width='150' class="buttonbox">NAVIGATION BAR<br />
<input  type="radio" name="NavBarPlacement" value='both' <? if (($NavBarPlacement == '') || ($NavBarPlacement == 'both'))  echo 'checked';?>>
<font color="white">Top And Bottom</font><br />
<input  type="radio" name="NavBarPlacement" value='top' <? if ($NavBarPlacement == 'top')  echo 'checked';?>>
<font color="white">Top Only</font><br />
<input  type="radio" name="NavBarPlacement" value='bottom' <? if ($NavBarPlacement == 'bottom')  echo 'checked';?>>
<font color="white">Bottom</font>

</td>
<td  width='150' valign="top" class="buttonbox"> NAV ALIGNMENT<br />(html only)<br/>
<input  type="radio" name="NavBarAlignment" value='right' <? if (($NavBarAlignment == '') || ($NavBarAlignment == 'right'))  echo 'checked';?>>
<font color="white">Right</font><br />
<input  type="radio" name="NavBarAlignment" value='left' <? if ($NavBarAlignment == 'left')  echo 'checked';?>>
<font color="white">Left</font><br />
<input  type="radio" name="NavBarAlignment" value='center' <? if ($NavBarAlignment == 'center')  echo 'checked';?>>
<font color="white">Center (bottom only)</font>



</td>

<td valign="top"  width="125" class="buttonbox">FLASH BAR STYLE
<center>

<select name="FlashReaderStyle">
<option value="standard" <? if (($FlashReaderStyle == '') || ($FlashReaderStyle == 'standard'))  echo 'selected';?>>Standard</option>
</select>
</center>

</td>
</tr>

</table>
<div class='spacer'></div>
<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">PAGE AREA</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
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
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">HOT SPOT APPEARANCE</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top" align="center">HOT SPOT IMAGE<br /><div class="spacer"></div><div id='HotSpotImageDiv' align="center"><? if ($HotSpotImage != '')  echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'HotSpotImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div><center><img src="/'.$PFDIRECTORY.'/templates/skins/'.$SkinCode.'/images/'.$HotSpotImage.'"></center>'; ?>


<a href="#" onclick="revealModal('uploadModal','HotSpotImage');return false;"><font color="#0099FF">
<? if ($HotSpotImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
<td class="buttonbox" valign="top" width='150'>HOT SPOT COLOR<br /><center>
  <input class="color {adjust:false}" id="HotSpotBGColor" name="HotSpotBGColor" value='<? if ($HotSpotBGColor == '') { echo 'click here for color'; } else { echo $HotSpotBGColor;}?>'  size="15"></center></td>
<td valign="top" class="buttonbox" width="133">HOT SPOT OPEN<br />
<input  type="radio" name="BubbleOpen" value='mouseover' <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'checked';?>>
<font color="white">On Mouseover</font><br />
<input  type="radio" name="BubbleOpen" value='click' <? if ($BubbleOpen == 'click')  echo 'checked';?>>
<font color="white">On Click</font>
</td>
<td valign="top" class="buttonbox" width="155">HOT SPOT CLOSE<br />
<input  type="radio" name="BubbleClose" value='mouseout' <? if (($BubbleClose == '') || ($BubbleClose == 'mouseout'))  echo 'checked';?>>
<font color="white">On Mouse Out</font><br />
<input  type="radio" name="BubbleClose" value='click' <? if ($BubbleClose == 'click')  echo 'checked';?>>
<font color="white">On Click</font> 
</td>
</tr></table>

<div class="spacer"></div>
<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">CHARACTERS</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" valign="top" width='150'>CHARACTER DISPLAY<br />
<center>
<select name="CharacterReader">
<option value="html_one" <? if (($CharacterReader == '') || ($CharacterReader == 'html_one'))  echo 'selected';?>>HTML List w/ Character popup</option>
<option value="html_two" <? if ($CharacterReader == 'html_two')  echo 'selected';?>>HTML List w/ Character Reveal</option>
<option value="flash_one" <? if ($CharacterReader == 'flash_one')  echo 'selected';?>>Flash Reader w/ Character Reveal</option>
</select>
</center>

</td>
</tr>
</table>

