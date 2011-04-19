<div class='pagetitleLarge'><b>HOT SPOT SETTINGS</b></div>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">HOT SPOT APPEARANCE</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top" align="center">HOT SPOT IMAGE<br /><div class="spacer"></div><div id='HotSpotImageDiv' align="center"><? if ($HotSpotImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'HotSpotImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','HotSpotImage');return false;"><font color="#0099FF">
<? if ($HotSpotImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
<td valign="top" class="buttonbox" width="125">HOT SPOT OPEN<br />
<input  type="radio" name="BubbleOpen" value='mouseover' <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'checked';?>>
<font color="white">On Mouseover</font><br />
<input  type="radio" name="BubbleOpen" value='click' <? if ($BubbleOpen == 'click')  echo 'checked';?>>
<font color="white">On Click</font>
</td>
<td class="buttonbox" valign="top" width='150'>HOT SPOT COLOR<br /><center>
<input class="color {adjust:false}" id="HotSpotBGColor" name="HotSpotBGColor" value='<? if ($HotSpotBGColor == '') { echo 'click here for color'; } else { echo $HotSpotBGColor;}?>'  size="15"></center><div style="height:5px;"></div>
</td>

</tr></table>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;"><span class="pagetitleLarge" style="border-bottom:solid 1px #FF9900; padding-right:10px;">HOT SPOT TRIGGERS</span></div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="top" class="buttonbox" width="154">HOT SPOT OPEN<br />
<input  type="radio" name="BubbleOpen" value='mouseover' <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'checked';?>>
<font color="white">On Mouseover</font><br />
<input  type="radio" name="BubbleOpen" value='click' <? if ($BubbleOpen == 'click')  echo 'checked';?>>
<font color="white">On Click</font>
</td>
<td valign="top" class="buttonbox" width="177">HOT SPOT CLOSE<br />
<input  type="radio" name="BubbleClose" value='mouseout' <? if (($BubbleClose == '') || ($BubbleClose == 'mouseout'))  echo 'checked';?>>
<font color="white">On Mouse Out</font><br />
<input  type="radio" name="BubbleClose" value='click' <? if ($BubbleClose == 'click')  echo 'checked';?>>
<font color="white">On Click</font> 
</td>

</tr></table>