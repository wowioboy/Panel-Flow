    <script type="text/javascript">
	function menulink(action, menuid,theme) {
			//var divID = 'scriptModal';
				var Source = '/<? echo $_SESSION['pfdirectory'];?>/includes/edit_menu_links_inc.php?id='+menuid+'&a='+action+'&comic=<? echo $_SESSION['sessionproject'];?>';
				<? if ($MenuOneCustom != 1) {?>
					Source = Source + '&theme=<? echo $ProjectTheme;?>';
				<? }?>
				if (theme != '')
					Source = Source + '&theme='+theme;
			
		$(this).modal({width:650, height:500,src:Source}).open(); 

		}
	
	function removeMenuItem(menuid) {
		var answer = confirm('Are you sure you want to delete this menu link. If you want to turn it off, you can simply UNPUBLISH it.');
		if (answer) {
			attach_file('/<? echo $_SESSION['pfdirectory'];?>/includes/remove_menu_link.php?id='+menuid);
		}
	}
	</script>
<? //GLOBAL SETTINGS?>
<center>
<div class='spacer'></div>
<? /*
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
*/ ?>
<? if ($_GET['section'] != 'menu') {?>
<div class='pagetitleLarge' style="border-bottom:solid 1px #FF9900; padding-right:10px;">GLOBAL BUTTON</div>
<span style="color:#000000;">The global button settings will be used for all buttons unless set otherwise.</span>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td width='150' rowspan="2" align="center" valign="top" class="buttonbox">BACKGROUND IMAGE<br /><div class="spacer"></div><div id='ButtonImageDiv' align="center"><? if ($ButtonImage != '') echo '<font color="green">IMAGE SET</font><a href="javascript:void)=(0)" onclick="removeSkinImage(\'ButtonImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div><img src="'.$ButtonImage.'"><br/>'; ?>
<a href="#" onclick="revealModal('uploadModal','ButtonImage');return false;"><font color="#0099FF">
<? if ($ButtonImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '<div class=\'spacer\'></div>[CHANGE IMAGE]';?></font></a><? }?></div></td>
<td width="163" rowspan="2" valign="top" class="buttonbox">IMAGE REPEAT<br />
<input  type="radio" name="ButtonImageRepeat" value='none' <? if (($ButtonImageRepeat == '') || ($ButtonImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="ButtonImageRepeat" value='repeat-y' <? if ($ButtonImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="ButtonImageRepeat" value='repeat-x' <? if ($ButtonImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="ButtonImageRepeat" value='' <? if ($ButtonImageRepeat == '')  echo 'checked';?>>
Repeat All</td>
<td width='195' valign="top" class="buttonbox">BACKGROUND <br />
  <center>
<input class="color {adjust:false}" id="ButtonBGColor" name="ButtonBGColor" value='<? if ($ButtonBGColor == '') { echo 'click here for color'; } else { echo $ButtonBGColor;}?>'  size="15"></center><div style="height:5px;"></div>
TEXT COLOR<center>
<input class="color {adjust:false}" id="ButtonTextColor" name="ButtonTextColor" value='<? if ($ButtonTextColor == '') { echo 'click here for color'; } else { echo $ButtonTextColor;}?>'  size="15"></center><div class="spacer"></div>
TEXT ALIGNMENT:<select name="ButtonAlign">
 <option value="center" <? if ($ButtonAlign == 'center') echo 'selected';?>>center</option>
<option value="left" <? if ($ButtonAlign == 'left') echo 'selected';?>>left</option>
<option value="right" <? if ($ButtonAlign == 'right') echo 'selected';?>>right</option>
  <option value="justify" <? if ($ButtonAlign == 'justify') echo 'selected';?>>justify</option><div style="height:5px;"></div>
  </select></td>
<td class="buttonbox" valign="top" width='160'>FONT SIZE<br />
  <center>
<input id="ButtonFontSize" name="ButtonFontSize" value='<? if ($ButtonFontSize == '') { echo '12';} else { echo $ButtonFontSize; }?>' size="15"></center>



FONT STYLE<center>
<select name="ButtonFontStyle">
<option value="regular" <? if (($ButtonFontStyle == '') || ($ButtonFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($ButtonFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($ButtonFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select></center><div class="spacer"></div>
FONT FAMILY<br /><center>
<select name="ButtonFontFamily">
<option value="Verdana, Arial, Helvetica, sans-serif" <? if (($ButtonFontFamily == "Verdana, Arial, Helvetica, sans-serif") || ($ButtonFontFamily == ""))  echo 'selected';?>><span style="font-family:Verdana, Arial, Helvetica, sans-serif;">Verdana</span></option>
<option value="'Times New Roman',Times,serif" <? if ($ButtonFontFamily == "'Times New Roman',Times,serif")  echo 'selected';?>><span style="font-family:'Times New Roman', Times, serif;">Times New Roman</span></option>
<option value="Arial, Helvetica, sans-serif" <? if ($ButtonFontFamily == "Arial, Helvetica, sans-serif")  echo 'selected';?>><span style="font-family: Arial, Helvetica, sans-serif;">Arial</span></option>
<option value=" Georgia, 'Times New Roman', Times, serif" <? if ($ButtonFontFamily == " Georgia, 'Times New Roman', Times, serif")  echo 'selected';?>><span style="font-family: Georgia, 'Times New Roman', Times, serif;">Georgia</span></option>
<option value="'Courier New', Courier, monospace" <? if ($ButtonFontFamily == "'Courier New', Courier, monospace")  echo 'selected';?>><span style="font-family:'Courier New', Courier, monospace;">Courier New</span></option>

<option value="Algerian, 'Lucida Grande', fantasy" <? if ($ButtonFontFamily == "Algerian, 'Lucida Grande', fantasy")  echo 'selected';?>><span style="font-family:Algerian, 'Lucida Grande', fantasy;">Algerian</span></option>
<option value="Impact, fantasy" <? if ($ButtonFontFamily == "Impact, fantasy")  echo 'selected';?>><span style="font-family:Impact, fantasy;">Impact</span></option>
</select></center></td>
</tr>
<tr>
  <td colspan="2" valign="top" class="buttonbox"><div class="spacer"></div>
PADDING:<br />
<span class="messageinfo">(must include the 'px' after each value. ex: 5px)</span>
<div class="messageinfo">
Left: <input type="text" name="ButtonPaddingLeft" value="<? echo $ButtonPaddingLeft;?>" style="width:30px;border:#666666 1px solid;"/>&nbsp;&nbsp;
Right: <input type="text" name="ButtonPaddingRight" value="<? echo $ButtonPaddingRight;?>" style="width:30px;border:#666666 1px solid;"/>
Top: 
<input type="text" name="ButtonPaddingTop" value="<? echo $ButtonPaddingTop;?>" style="width:30px;border:#666666 1px solid;"/>&nbsp;&nbsp;
Bottom: <input type="text" name="ButtonPaddingBottom" value="<? echo $ButtonPaddingBottom;?>" style="width:30px; border:#666666 1px solid;"/>&nbsp;&nbsp;
</div></td>
  </tr>
</table>


<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">BUTTON TEXT SETTINGS</div>
<div class='spacer'></div>

<table cellpadding="0" cellspacing="0" border="0">
<tr><td colspan='2'>HOVER STATE</td><td colspan='2'>VISITED STATE</td></tr>
<tr> 
<td class="buttonbox" valign="top" width='150'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalButtonHoverTextColor" name="GlobalButtonHoverTextColor" value='<? if ($GlobalButtonHoverTextColor == '') { echo 'click here for color'; } else { echo $GlobalButtonHoverTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='150'>FONT STYLE<br />
<center>
<select name="GlobalButtonHoverFontStyle">
<option value="regular" <? if (($GlobalButtonHoverFontStyle == '') || ($GlobalButtonHoverFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalButtonHoverFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalButtonHoverFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>

<td class="buttonbox" valign="top" width='150'>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="GlobalButtonVisitedTextColor" name="GlobalButtonVisitedTextColor" value='<? if ($GlobalButtonVisitedTextColor == '') { echo 'click here for color'; } else { echo $GlobalButtonVisitedTextColor;}?>'  size="15">
</center></td>

<td class="buttonbox" valign="top" width='150'>FONT STYLE<br />
<center>
<select name="GlobalButtonVisitedFontStyle">
<option value="regular" <? if (($GlobalButtonVisitedFontStyle == '') || ($GlobalButtonVisitedFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalButtonVisitedFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalButtonVisitedFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>

</tr>

</table>
<div class="spacer"></div>
<? }?>
<? if ($_GET['themeid'] == '') {?>
<form method="post" action="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=menu" name="menuform" id="menuform">
 <table width="96%" cellspacing="3">
 <tr>
 <td></td>
 <td colspan="2">
 <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td id="blue_cmsBox_TL"></td>
	<td id="blue_cmsBox_T"></td>
	<td id="blue_cmsBox_TR"></td></tr>
	<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
		<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
          <div style="float:left">Design</div><div style="float:right;">Menu</div>
 		</td>
        <td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>
	</tr>
    <tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
	<td id="blue_cmsBox_BR"></td>
	</tr></tbody></table>
     <div class="spacer"></div>
     </td>
     </tr>
     <td valign="top">
      <div class="cms_blue_button_off" style="cursor:pointer;">
    <div class="spacer"></div>
                        <a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=skins&skincode=<? echo $CurrentSkin;?>&a=edit">Current Skin</a> 
                       </div>
                          <div class="spacer"></div>
                       <div class="cms_blue_button_active">  <div class="spacer"></div>
                     Menu
                       </div>
                          <div class="spacer"></div>
                      <div class="cms_blue_button_off" style="cursor:pointer;">  <div class="spacer"></div>
                      <a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design&section=themes">Themes</a> 
                       </div>
                       

   <div class="spacer"></div>
                       <? if (($MenuOneCustom == 1)||($_GET['themeid'] != '')) {?>
    <a href="javascript:void(0)" onclick="menulink('new','0','<? echo $_GET['themeid'];?>');"><img src="http://www.wevolt.com/images/cms/cms_create_new_link.png" border="0"/></a>
    <? }?>
    <div class="spacer"></div>
    <table width="109" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="93" align="left">
<strong>ABOUT THE MENU</strong>    <div class="spacer"></div>
<div style="border-bottom:dotted 1px #bababa;"></div>    <div class="spacer"></div>
This allows you to create each button on your menu and where it leads to.<br />
    <div class="spacer"></div>
You can upload a slick looking image or just go for text.

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
     </td>
     <td valign="top" align="center"> 
	 
	 <? if ($_SESSION['isprojecttheme'] != 1) {?>
<strong>MENU SETTINGS:</strong> :
Use Pre Built Template Buttons <input type="radio" value="0" <? if (($MenuOneCustom == 0) || ($MenuOneCustom =='')) echo 'checked';?> onclick="document.menuform.submit();" name="txtCustom"/>
Use Custom Buttons <input type="radio" value="1" <? if ($MenuOneCustom == 1) echo 'checked';?> name="txtCustom" onclick="document.menuform.submit();"/><br />
<? }?><div class="spacer"></div>
<div id="menulist">
	 <? echo $menuString;?>
     </div>
     
            </td>
     </table>
    
       
                       

<input type="hidden" name="changemenu" value="1" />
</form>
<? }?>
