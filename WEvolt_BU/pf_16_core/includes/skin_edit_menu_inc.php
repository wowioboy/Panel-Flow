<div class='pagetitleLarge'><b>MENU SETTINGS</b></div>
<div class='spacer'></div>

<? //GLOBAL SETTINGS?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">MENU ONE</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="top" class="buttonbox" width="191"> LAYOUT<br />

<select name="MenuOneLayout">
<option value='top'  <? if (($MenuOneLayout == '') || ($MenuOneLayout == 'none'))  echo 'selected';?>>Top</option>
<option value='bottom'  <? if ($MenuOneLayout == 'bottom')  echo 'selected';?>>Bottom</option>
<option value='left'  <? if ($MenuOneLayout == 'left')  echo 'selected';?>>Left</option>
<option value='right'  <? if ($MenuOneLayout == 'right')  echo 'selected';?>>Right</option>
<option value='off'  <? if ($MenuOneLayout == 'off')  echo 'selected';?>>Turn Off</option>
</select>
<div class="spacer"></div>
</td>
<td valign="top" class="buttonbox" width="173">TYPE<br />
<select name="MenuOneType">
<option value='standard'  <? if (($MenuOneType == '') || ($MenuOneType == 'standard'))  echo 'selected';?>>Standard</option>
<option value='dropdown'  <? if ($MenuOneType == 'dropdown')  echo 'selected';?>>Dropdown Menu</option>
</select>
<div class="spacer"></div>
</td><td valign="top" class="buttonbox" width="173">CUSTOM SETTINGS<br />
<select name="MenuOneCustom">
<option value='0'  <? if (($MenuOneCustom == '') || ($MenuOneCustom == '0'))  echo 'selected';?>>Use Built-in Buttons</option>
<option value='1'  <? if ($MenuOneCustom == '1')  echo 'selected';?>>Create menu buttons</option>
</select><div class="spacer"></div></td>


</tr>
</table>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">MENU TWO</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td valign="top" class="buttonbox" width="191">LAYOUT<br />

<select name="MenuTwoLayout">
<option value='top'  <? if (($MenuTwoLayout == '') || ($MenuTwoLayout == 'none'))  echo 'selected';?>>Top</option>
<option value='bottom'  <? if ($MenuTwoLayout == 'bottom')  echo 'selected';?>>Bottom</option>
<option value='left'  <? if ($MenuTwoLayout == 'left')  echo 'selected';?>>Left</option>
<option value='right'  <? if ($MenuTwoLayout == 'right')  echo 'selected';?>>Right</option>
<option value='off'  <? if ($MenuTwoLayout == 'off')  echo 'selected';?>>Turn Off</option>
</select></td>
<td valign="top" class="buttonbox" width="173">TYPE<br />
<select name="MenuTwoType">
<option value='standard'  <? if (($MenuTwoType == '') || ($MenuTwoType == 'standard'))  echo 'selected';?>>Standard</option>
<option value='dropdown'  <? if ($MenuTwoType == 'dropdown')  echo 'selected';?>>Dropdown Menu</option>
</select></td>
<td valign="top" class="buttonbox" width="173">CUSTOM SETTINGS<br />
<select name="MenuTwoCustom">
<option value='0'  <? if (($MenuTwoCustom == '') || ($MenuTwoCustom == '0'))  echo 'selected';?>>Use Built-in Buttons</option>
<option value='1'  <? if ($MenuTwoCustom == '1')  echo 'selected';?>>Create menu buttons</option>
</select>
<div class="spacer"></div>
</td>


</tr>
</table>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">CUSTOM MENU LINKS</div>
<div class='spacer'></div>
<div align="left">
<span class="submenu">[<a href="#" onclick="menulink('new','0');return false;">CREATE NEW LINK</a>]</span>
</div><div class='spacer'></div>
<div id="menulist">
<? echo $menuString;?>
</div>