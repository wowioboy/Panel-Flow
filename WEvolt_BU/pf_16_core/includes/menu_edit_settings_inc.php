<div class='pagetitleLarge'><b>MENU SETTINGS</b></div>
<div class='spacer'></div>

<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">MENU TYPE</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="top" class="buttonbox" width="191">MENU 1 LAYOUT<br />
<input  type="radio" name="MenuOneLayout" value='top' <? if (($MenuOneLayout == '') || ($MenuOneLayout == 'none'))  echo 'checked';?>>
<font color="white">Top</font><br />
<input  type="radio" name="MenuOneLayout" value='bottom' <? if ($MenuOneLayout == 'bottom')  echo 'checked';?>>
<font color="white">Bottom</font><br />
<input  type="radio" name="MenuOneLayout" value='left' <? if ($MenuOneLayout == 'left')  echo 'checked';?>>
<font color="white">Left Side</font><br />
<input  type="radio" name="MenuOneLayout" value='right' <? if ($MenuOneLayout == 'right')  echo 'checked';?>>
<font color="white">Right Side</font><br />
<input  type="radio" name="MenuOneLayout" value='off' <? if ($MenuOneLayout == 'off')  echo 'checked';?>>
<font color="white">Turn Off</font>
</td>
<td valign="top" class="buttonbox" width="207">MENU 2 LAYOUT<br />
<input  type="radio" name="MenuTwoLayout" value='top' <? if (($MenuTwoLayout == '') || ($MenuTwoLayout == 'none'))  echo 'checked';?>>
<font color="white">Top</font><br />
<input  type="radio" name="MenuTwoLayout" value='bottom' <? if ($MenuTwoLayout == 'bottom')  echo 'checked';?>>
<font color="white">Bottom</font><br />
<input  type="radio" name="MenuTwoLayout" value='left' <? if ($MenuTwoLayout == 'left')  echo 'checked';?>>
<font color="white">Left Side</font><br />
<input  type="radio" name="MenuTwoLayout" value='right' <? if ($MenuTwoLayout == 'right')  echo 'checked';?>>
<font color="white">Right Side</font><br />
<input  type="radio" name="MenuTwoLayout" value='off' <? if ($MenuTwoLayout == 'off')  echo 'checked';?>>
<font color="white">Turn Off</font>
</td>

<td class="buttonbox" valign="top" width='144'>&nbsp;</td>

<td class="buttonbox" valign="top" width='58'>&nbsp;</td>
</tr>


<tr>


<td class="buttonbox" valign="top" width='191'>MENU 1 SETTINGS<br />
<input  type="radio" name="MenuOneSettings" value='standard' <? if (($MenuOneSettings == '') || ($MenuOneSettings == 'standard'))  echo 'checked';?>>
<font color="white">Use Built-in Menu names</font><br />
<input  type="radio" name="MenuOneSettings" value='custom' <? if ($MenuOneSettings == 'custom')  echo 'checked';?>>
<font color="white">Custom</font><br />
</td>

<td  valign="top" width='207' class="buttonbox">MENU 2 SETTINGS<br />
<input  type="radio" name="MenuTwoSettings" value='standard' <? if (($MenuTwoSettings == '') || ($MenuTwoSettings == 'standard'))  echo 'checked';?>>
<font color="white">Use Built-in Menu names</font><br />
<input  type="radio" name="MenuTwoSettings" value='custom' <? if ($MenuTwoSettings == 'custom')  echo 'checked';?>>
<font color="white">Custom</font><br />
</td>
<td  width='144' valign="top" class="buttonbox">&nbsp;</td>

<td valign="top"  width="58" class="buttonbox"><center>
</center>

</td>
</tr>

</table>
<div class='spacer'></div>
