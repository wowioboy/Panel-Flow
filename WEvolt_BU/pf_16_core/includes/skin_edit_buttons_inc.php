<div class='pagetitleLarge'><b>BUTTON SETTINGS</b></div>
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">GLOBAL BUTTON</div>
<span style="color:#FFFFFF;">The global button settings will be used for all buttons unless set otherwise.</span>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top" align="center">BACKGROUND IMAGE<br /><div class="spacer"></div><div id='ButtonImageDiv' align="center"><? if ($ButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','ButtonImage');return false;"><font color="#0099FF">
<? if ($ButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div>
</td>
<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="ButtonImageRepeat" value='none' <? if (($ButtonImageRepeat == '') || ($ButtonImageRepeat == 'none'))  echo 'checked';?>>
<font color="white">No Repeat</font><br />
<input  type="radio" name="ButtonImageRepeat" value='repeat-y' <? if ($ButtonImageRepeat == 'repeat-y')  echo 'checked';?>>
<font color="white">Repeat Vertical</font><br />
<input  type="radio" name="ButtonImageRepeat" value='repeat-x' <? if ($ButtonImageRepeat == 'repeat-x')  echo 'checked';?>>
<font color="white">Repeat Horizontal</font>
</td>
<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br /><center>
<input class="color {adjust:false}" id="ButtonBGColor" name="ButtonBGColor" value='<? if ($ButtonBGColor == '') { echo 'click here for color'; } else { echo $ButtonBGColor;}?>'  size="15"></center><div style="height:5px;"></div>
TEXT COLOR<center>
<input class="color {adjust:false}" id="ButtonTextColor" name="ButtonTextColor" value='<? if ($ButtonTextColor == '') { echo 'click here for color'; } else { echo $ButtonTextColor;}?>'  size="15"></center>
</td>
<td class="buttonbox" valign="top" width='150'>FONT SIZE<br /><center>
<input id="ButtonFontSize" name="ButtonFontSize" value='<? if ($ButtonFontSize == '') { echo '12';} else { echo $ButtonFontSize; }?>' size="15"></center><div style="height:5px;"></div>
FONT STYLE<center>
<select name="ButtonFontStyle">
<option value="regular" <? if (($ButtonFontStyle == '') || ($ButtonFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($ButtonFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($ButtonFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select></center>
</td>
</tr></table>



<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">NAVIGATION BUTTONS</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td width='130' align="left" style="color:#FFFFFF;font-weight:bold;">FIRST PAGE</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">NEXT PAGE</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">PREVIOUS PAGE</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">LAST PAGE</td>
</tr>
<tr>
<td width='130'  class='buttonbox2'>
<div id='FirstButtonImageDiv' align="center">
<? if ($FirstButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'FirstButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','FirstButtonImage');return false;">
<font color="#0099FF"><? if ($FirstButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($FirstButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','FirstButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($FirstButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>

<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="FirstButtonBGColor" name="FirstButtonBGColor" value='<? if ($FirstButtonBGColor == '') { echo 'click here for color'; } else { echo $FirstButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="FirstButtonTextColor" name="FirstButtonTextColor" value='<? if ($FirstButtonTextColor == '') { echo 'click here for color'; } else { echo $FirstButtonTextColor;}?>' size="15"></center></div></td>
<td width="15">&nbsp;</td>
<td width='130'  class='buttonbox2'>
<div id='NextButtonImageDiv' align="center">
<? if ($NextButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'NextButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','NextButtonImage');return false;">
<font color="#0099FF"><? if ($NextButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($NextButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','NextButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($NextButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="NextButtonBGColor" name="NextButtonBGColor" value='<? if ($NextButtonBGColor == '') { echo 'click here for color'; } else { echo $NextButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="NextButtonTextColor" name="NextButtonTextColor" value='<? if ($NextButtonTextColor == '') { echo 'click here for color'; } else { echo $NextButtonTextColor;}?>' size="15"></center></div></td><td width="15">&nbsp;</td>
<td width='130'  class='buttonbox2'>
<div id='BackButtonImageDiv' align="center">
<? if ($BackButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'BackButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','BackButtonImage');return false;">
<font color="#0099FF"><? if ($BackButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($BackButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','BackButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($BackButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="BackButtonBGColor" name="BackButtonBGColor" value='<? if ($BackButtonBGColor == '') { echo 'click here for color'; } else { echo $BackButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="BackButtonTextColor" name="BackButtonTextColor" value='<? if ($BackButtonTextColor == '') { echo 'click here for color'; } else { echo $BackButtonTextColor;}?>' size="15"></center></div></td><td width="15">&nbsp;</td>
<td width='130'  class='buttonbox2'>
<div id='LastButtonImageDiv' align="center">
<? if ($LastButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'LastButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','LastButtonImage');return false;">
<font color="#0099FF"><? if ($LastButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($LastButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','LastButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($LastButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="LastButtonBGColor" name="LastButtonBGColor" value='<? if ($LastButtonBGColor == '') { echo 'click here for color'; } else { echo $LastButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="LastButtonTextColor" name="LastButtonTextColor" value='<? if ($LastButtonTextColor == '') { echo 'click here for color'; } else { echo $LastButtonTextColor;}?>' size="15"></center></div></td>
</tr>

<tr>
<td colspan='7' height="10"></td>
</tr>



</table>




<div class='spacer'></div><div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">SECTION BUTTONS</div><div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">

<tr>
<td width='130'  align="left" style="color:#FFFFFF;font-weight:bold;">HOME BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">CREATOR BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">CHARACTERS BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">DOWNLOADS BUTTON</td>
</tr>

<tr>
<td width='130'  class='buttonbox2'>
<div id='HomeButtonImageDiv' align="center">
<? if ($HomeButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'HomeButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','HomeButtonImage');return false;">
<font color="#0099FF"><? if ($HomeButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($HomeButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','HomeButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($HomeButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="HomeButtonBGColor" name="HomeButtonBGColor" value='<? if ($HomeButtonBGColor == '') { echo 'click here for color'; } else { echo $HomeButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="HomeButtonTextColor" name="HomeButtonTextColor" value='<? if ($HomeButtonTextColor == '') { echo 'click here for color'; } else { echo $HomeButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>

<td width='130'  class='buttonbox'>
<div id='CreatorButtonImageDiv' align="center">
<? if ($CreatorButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'CreatorButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','CreatorButtonImage');return false;">
<font color="#0099FF"><? if ($CreatorButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($CreatorButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','CreatorButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($CreatorButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="CreatorButtonBGColor" name="CreatorButtonBGColor" value='<? if ($CreatorButtonBGColor == '') { echo 'click here for color'; } else { echo $CreatorButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="CreatorButtonTextColor" name="CreatorButtonTextColor" value='<? if ($CreatorButtonTextColor == '') { echo 'click here for color'; } else { echo $CreatorButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>
<td width='130'  class='buttonbox'>
<div id='CharactersButtonImageDiv' align="center">
<? if ($CharactersButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'CharactersButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','CharactersButtonImage');return false;">
<font color="#0099FF"><? if ($CharactersButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($CharactersButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','CharactersButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($CharactersButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="CharactersButtonBGColor" name="CharactersButtonBGColor" value='<? if ($CharactersButtonBGColor == '') { echo 'click here for color'; } else { echo $CharactersButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="CharactersButtonTextColor" name="CharactersButtonTextColor" value='<? if ($CharactersButtonTextColor == '') { echo 'click here for color'; } else { echo $CharactersButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>

<td width='130'  class='buttonbox'>
<div id='DownloadsButtonImageDiv' align="center">
<? if ($DownloadsButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'DownloadsButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','DownloadsButtonImage');return false;">
<font color="#0099FF"><? if ($DownloadsButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($DownloadsButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','DownloadsButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($DownloadsButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="DownloadsButtonBGColor" name="DownloadsButtonBGColor" value='<? if ($DownloadsButtonBGColor == '') { echo 'click here for color'; } else { echo $DownloadsButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="DownloadsButtonTextColor" name="DownloadsButtonTextColor" value='<? if ($DownloadsButtonTextColor == '') { echo 'click here for color'; } else { echo $DownloadsButtonTextColor;}?>' size="15"></center></div></td>

</tr>

<tr>
<td colspan='7' height="10"></td>
</tr>

<tr>
<td width='130'  align="left" style="color:#FFFFFF;font-weight:bold;">EXTRAS BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">EPISODES BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">MOBILE BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">PRODUCTS BUTTON</td>
</tr>
<tr>
<td width='130'  class='buttonbox'>
<div id='ExtrasButtonImageDiv' align="center">
<? if ($ExtrasButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ExtrasButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','ExtrasButtonImage');return false;">
<font color="#0099FF"><? if ($ExtrasButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($ExtrasButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','ExtrasButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($ExtrasButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="ExtrasButtonBGColor" name="ExtrasButtonBGColor" value='<? if ($ExtrasButtonBGColor == '') { echo 'click here for color'; } else { echo $ExtrasButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="ExtrasButtonTextColor" name="ExtrasButtonTextColor" value='<? if ($ExtrasButtonTextColor == '') { echo 'click here for color'; } else { echo $ExtrasButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>
<td width='130'  class='buttonbox'>
<div id='EpisodesButtonImageDiv' align="center">
<? if ($EpisodesButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'EpisodesButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','EpisodesButtonImage');return false;">
<font color="#0099FF"><? if ($EpisodesButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($EpisodesButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','EpisodesButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($EpisodesButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="EpisodesButtonBGColor" name="EpisodesButtonBGColor" value='<? if ($EpisodesButtonBGColor == '') { echo 'click here for color'; } else { echo $EpisodesButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="EpisodesButtonTextColor" name="EpisodesButtonTextColor" value='<? if ($EpisodesButtonTextColor == '') { echo 'click here for color'; } else { echo $EpisodesButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>

<td width='130'  class='buttonbox'>
<div id='MobileButtonImageDiv' align="center">
<? if ($MobileButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'MobileButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','MobileButtonImage');return false;">
<font color="#0099FF"><? if ($MobileButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($MobileButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','MobileButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($MobileButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR<center>
<input class="color {adjust:false}" id="MobileButtonBGColor" name="MobileButtonBGColor" value='<? if ($MobileButtonBGColor == '') { echo 'click here for color'; } else { echo $MobileButtonBGColor;}?>' size="15"></center><br />

TEXT COLOR<center>
<input class="color {adjust:false}" id="MobileButtonTextColor" name="MobileButtonTextColor" value='<? if ($MobileButtonTextColor == '') { echo 'click here for color'; } else { echo $MobileButtonTextColor;}?>' size="15"></center></div></td>

<td width="15">&nbsp;</td>
<td width='130'  class='buttonbox'>
<div id='ProductsButtonImageDiv' align="center">
<? if ($ProductsButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ProductsButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','ProductsButtonImage');return false;">
<font color="#0099FF"><? if ($ProductsButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($ProductsButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','ProductsButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($ProductsButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR
<input class="color {adjust:false}" id="ProductsButtonBGColor" name="ProductsButtonBGColor" value='<? if ($ProductsButtonBGColor == '') { echo 'click here for color'; } else { echo $ProductsButtonBGColor;}?>' size="15"><br />

TEXT COLOR
<input class="color {adjust:false}" id="ProductsButtonTextColor" name="ProductsButtonTextColor" value='<? if ($ProductsButtonTextColor == '') { echo 'click here for color'; } else { echo $ProductsButtonTextColor;}?>' size="15"></div></td>
</tr>
<tr>
<td colspan='7' height="10"></td>
</tr>

<tr>
<td width='130'  align="left" style="color:#FFFFFF;font-weight:bold;">COMMENT BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">VOTE BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;">LOGOUT BUTTON</td>
<td width="15"></td>
<td  width='130' align="left" style="color:#FFFFFF; font-weight:bold;"></td>
</tr>
<tr>
<td width='130'  class='buttonbox'>
<div id='CommentButtonImageDiv' align="center">
<? if ($CommentButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'CommentButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','CommentButtonImage');return false;">
<font color="#0099FF"><? if ($CommentButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($CommentButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','CommentButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($CommentButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR
<input class="color {adjust:false}" id="CommentButtonBGColor" name="CommentButtonBGColor" value='<? if ($CommentButtonBGColor == '') { echo 'click here for color'; } else { echo $CommentButtonBGColor;}?>' size="15"><br />

TEXT COLOR
<input class="color {adjust:false}" id="CommentButtonTextColor" name="CommentButtonTextColor" value='<? if ($CommentButtonTextColor == '') { echo 'click here for color'; } else { echo $CommentButtonTextColor;}?>' size="15"></div></td>
<td width="15">&nbsp;</td>

<td width='130'  class='buttonbox'>
<div id='VoteButtonImageDiv' align="center">
<? if ($VoteButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'VoteButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','VoteButtonImage');return false;">
<font color="#0099FF"><? if ($VoteButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($VoteButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','VoteButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($VoteButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR
<input class="color {adjust:false}" id="VoteButtonBGColor" name="VoteButtonBGColor" value='<? if ($VoteButtonBGColor == '') { echo 'click here for color'; } else { echo $VoteButtonBGColor;}?>' size="15"><br />

TEXT COLOR
<input class="color {adjust:false}" id="VoteButtonTextColor" name="VoteButtonTextColor" value='<? if ($VoteButtonTextColor == '') { echo 'click here for color'; } else { echo $VoteButtonTextColor;}?>' size="15"></div></td>
<td width="15">&nbsp;</td>

<td width='130'  class='buttonbox'>
<div id='LogoutButtonImageDiv' align="center">
<? if ($LogoutButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'LogoutButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','LogoutButtonImage');return false;">
<font color="#0099FF"><? if ($LogoutButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($LogoutButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','LogoutButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($LogoutButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR
<input class="color {adjust:false}" id="LogoutButtonBGColor" name="LogoutButtonBGColor" value='<? if ($LogoutButtonBGColor == '') { echo 'click here for color'; } else { echo $LogoutButtonBGColor;}?>' size="15"><br />

TEXT COLOR
<input class="color {adjust:false}" id="LogoutButtonTextColor" name="LogoutButtonTextColor" value='<? if ($LogoutButtonTextColor == '') { echo 'click here for color'; } else { echo $LogoutButtonTextColor;}?>' size="15"></div></td>
<td width="15">&nbsp;</td>
<td width='130'  class='buttonbox'>
<div id='BlogButtonImageDiv' align="center">
<? if ($LogoutButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'BlogButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?>
<a href="#" onclick="revealModal('uploadModal','BlogButtonImage');return false;">
<font color="#0099FF"><? if ($BlogButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';}?></font>
</a>
<? if ($BlogButtonImage != ''){ ?>
<div style="height:5px;"></div>
<a href="#" onclick="revealModal('uploadModal','BlogButtonRolloverImage');return false;">
<font color="#0099FF">
<? if ($BlogButtonRolloverImage == '') {
	echo '[UPLOAD ROLLOVER]'; 
 } else { echo '[CHANGE ROLLOVER]';}?>	
 </font>
</a>
<? } ?>
</div>
<div style="padding-top:5px;">
BACKGROUND COLOR
<input class="color {adjust:false}" id="BlogButtonBGColor" name="BlogButtonBGColor" value='<? if ($BlogButtonBGColor == '') { echo 'click here for color'; } else { echo $BlogButtonBGColor;}?>' size="15"><br />

TEXT COLOR
<input class="color {adjust:false}" id="BlogButtonTextColor" name="BlogButtonTextColor" value='<? if ($BlogButtonTextColor == '') { echo 'click here for color'; } else { echo $BlogButtonTextColor;}?>' size="15"></div></td>
</tr>
</table>