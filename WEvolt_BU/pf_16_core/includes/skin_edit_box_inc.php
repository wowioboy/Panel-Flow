
<table cellpadding="0" cellspacing="0" border="0" width="91%"><tr>
<td valign="top" width="250" style="padding:5px;">
<div align="center">
<a href="javascript:void(0)" onclick="module_designer()">LAUNCH MODULE DESIGNER</a>
</div>
<table width="250" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="ModTopLeftImage" style="height:<? echo $TopLeftCornerHeight;?>px; width:<? echo $TopLeftCornerWidth;?>px; background-image:url(<? echo $ModTopLeftImage;?>); background-color:#<? echo $ModTopLeftBGColor;?>;background-position:top left;"></td>

	<td width="<? echo (250-($TopLeftCornerWidth-$TopRightCornerWidth));?>" id="ModTopImage" style="height:<? echo $TopImageHeight;?>px; background-color:#<? echo $ModTopBGColor;?>; background-image:url(<? echo $ModTopImage;?>); background-repeat:repeat-x;background-position:top;"></td>
    
	<td id="ModTopRightImage" style="height:<? echo $TopRightCornerHeight;?>px;width:<? echo $TopRightCornerHeight;?>px; background-image:url(<? echo $ModTopRightImage;?>); background-color:#<? echo $ModTopRightBGColor;?>; background-repeat:no-repeat;background-position:top right;"></td>
</tr></table>
</td>
<tr><td colspan="3">
	<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="ModLeftSideImage" style="width:<? echo $LeftSideWidth;?>px; background-image:url(<? echo $ModLeftSideImage;?>); background-color:#<? echo $ModLeftSideBGColor;?>;background-position: left;"></td>
	<td class="boxcontent" width="<? echo (230-($LeftSideWidth-$RightSideWidth));?>" height="275" valign="top" style="color:#<? echo $ContentBoxTextColor;?>; background-color:#<? echo $ContentBoxBGColor;?>;background-image:url(<? echo $ContentBoxImage;?>);">	
	</td>
	<td id="ModRightSideImage" style="width:<? echo $RightSideWidth;?>px; background-image:url(<? echo $ModRightSideImage;?>); background-color:#<? echo $ModRightSideBGColor;?>; background-position:right;"></td>
</tr></table>
</td>
<tr><td colspan="3">
	<table width="100%" cellpadding="0" cellspacing="0"><tr><td id="ModBottomLeftImage" style="height:<? echo $BottomLeftCornerHeight;?>px;width:<? echo $BottomLeftCornerWidth;?>px; background-image:url(<? echo $ModBottomLeftImage;?>); background-position:bottom left; background-repeat:no-repeat;background-color:#<? echo $ModBottomLeftBGColor;?>;"></td>
	<td width="<? echo (250-($TopLeftCornerWidth-$TopRightCornerWidth));?>" id="ModBottomImage" style="height:<? echo $BottomImageHeight;?>px; background-color:#<? echo $ModBottomBGColor;?>; background-image:url(<? echo $ModBottomImage;?>);background-position:bottom; background-repeat:repeat-x;"></td>
	<td id="ModBottomRightImage" style="height:<? echo $BottomRightCornerHeight;?>px;width:<? echo $BottomRightCornerWidth;?>px; background-image:url(<? echo $ModBottomRightImage;?>); background-color:#<? echo $ModBottomRightBGColor;?>; background-position:bottom right;"></td>
    </tr></table>
    </td>
</tr>
</table>

<div class="spacer"></div>

<table width="250" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="234" align="center">
                                                <div><strong>Content Box</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="You can upload images or set the background color for each corner of your window box. TIP: If you are making a symetrical round corner box, you need to make sure all corners are the same dimensions." tooltip_position="left"/></div>

 <table cellpadding="0" cellspacing="5" border="0" >
                                                <tr>
                                                <td align="left" colspan="2">                                             
                                                <div id='ContentBoxImageDiv' align="center"><? if ($ContentBoxImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ContentBoxImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ContentBoxImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_background.jpg" border="0" class="navbuttons"></a>';?></div>
                                              </td>
                                                                                       
                                                </tr>
                                                <tr>
                                                <td valign="top" id="grey_box" align="center"><div class="smspacer"></div>Image Repeat<div class="smspacer"></div>
                                                <center>
                                              <select name="ButtomImageRepeat" class="cms_input" style="width:60px;">
												<option value="" <? if ($ContentBoxImageRepeat == '')  echo 'selected';?>>All</option>
                                                <option value="no-repeat" <? if ($ContentBoxImageRepeat == 'no-repeat')  echo 'selected';?>>None</option>
                                                <option value="repeat-y" <? if ($ContentBoxImageRepeat == 'repeat-y')  echo 'selected';?>>Vertical</option>
                                                <option value="repeat-x" <? if ($ContentBoxImageRepeat == 'repeat-x')  echo 'selected';?>>Horizontal</option>
                                                </select>
                                                </center>
                                                </td> 
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               
                                               <input class="color {adjust:false}" id="ContentBoxBGColor" name="ContentBoxBGColor" value='<? if ($ContentBoxBGColor == '') { echo 'click here for color'; } else { echo $ContentBoxBGColor;}?>' size="15" style="font-size:10px;width:60px;">
                                                                                              
                                                </td>
                                                
                                              
                                                </tr>
                                                <tr>
                                                
                                                <td valign="top" id="grey_box"><div class="smspacer"></div>Text Color<div class="smspacer"></div>
                                   
                                                <input class="color {adjust:false}" id="ContentBoxTextColor" name="ContentBoxTextColor" value='<? if ($ContentBoxTextColor == '') { echo 'click here for color'; } else { echo $ContentBoxTextColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                
                                           
                                                </td>
                                                 <td valign="top" id="grey_box"><div class="smspacer"></div>Font Size<div class="smspacer"></div>

                                                 <input id="ContentBoxFontSize" name="ContentBoxFontSize"  value='<? if ($ContentBoxFontSize == '') { echo '12';} else { echo $ContentBoxFontSize; }?>' size="10" style="font-size:10px;width:60px;"></td>
                                                 </tr><tr>
                                                 <td valign="top" id="grey_box"><div class="smspacer"></div>Font<div class="smspacer"></div>
<center>
<select name="ContentBoxFontFamily" class="cms_input" style="width:60px;">
<option value="Verdana, Arial, Helvetica, sans-serif" <? if (($ContentBoxFontFamily == "Verdana, Arial, Helvetica, sans-serif") || ($ContentBoxFontFamily == ""))  echo 'selected';?>><span style="font-family:Verdana, Arial, Helvetica, sans-serif;">Verdana</span></option>
<option value="'Times New Roman',Times,serif" <? if ($ContentBoxFontFamily == "'Times New Roman',Times,serif")  echo 'selected';?>><span style="font-family:'Times New Roman', Times, serif;">Times New Roman</span></option>
<option value="Arial, Helvetica, sans-serif" <? if ($ContentBoxFontFamily == "Arial, Helvetica, sans-serif")  echo 'selected';?>><span style="font-family: Arial, Helvetica, sans-serif;">Arial</span></option>
<option value=" Georgia, 'Times New Roman', Times, serif" <? if ($ContentBoxFontFamily == " Georgia, 'Times New Roman', Times, serif")  echo 'selected';?>><span style="font-family: Georgia, 'Times New Roman', Times, serif;">Georgia</span></option>
<option value="'Courier New', Courier, monospace" <? if ($ContentBoxFontFamily == "'Courier New', Courier, monospace")  echo 'selected';?>><span style="font-family:'Courier New', Courier, monospace;">Courier New</span></option>

<option value="Algerian, 'Lucida Grande', fantasy" <? if ($ContentBoxFontFamily == "Algerian, 'Lucida Grande', fantasy")  echo 'selected';?>><span style="font-family:Algerian, 'Lucida Grande', fantasy;">Algerian</span></option>
<option value="Impact, fantasy" <? if ($ContentBoxFontFamily == "Impact, fantasy")  echo 'selected';?>><span style="font-family:Impact, fantasy;">Impact</span></option>
</select>

</center></td>
      <td valign="top" id="grey_box">Text <br />
Alignment
<center>
<select name="ContentBoxAlign" class="cms_input" style="width:60px;">
 <option value="center" <? if ($ContentBoxAlign == 'center') echo 'selected';?>>center</option>
<option value="left" <? if ($ContentBoxAlign == 'left') echo 'selected';?>>left</option>
<option value="right" <? if ($ContentBoxAlign == 'right') echo 'selected';?>>right</option>
  <option value="justify" <? if ($ContentBoxAlign == 'justify') echo 'selected';?>>justify</option>
</select>

</center></td>
                                                </tr></table>
                                                  </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
</td>

<td valign="top" style="padding:10px;">

<div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Corners</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="You can upload images or set the background color for each corner of your window box. TIP: If you are making a symetrical round corner box, you need to make sure all corners are the same dimensions." tooltip_position="left"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='spacer'></div>
<table cellspacing="10"><tr><td>
<table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Top Left</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModTopLeftImageDiv' align="center"><? if ($ModTopLeftImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModTopLeftImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModTopLeftImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModTopLeftBGColor" name="ModTopLeftBGColor" value='<? if ($ModTopLeftBGColor == '') { echo 'click here for color'; } else { echo $ModTopLeftBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td>
 <td>
 <table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Top Right</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModTopRightImageDiv' align="center"><? if ($ModTopRightImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModTopRightImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModTopRightImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModTopRightBGColor" name="ModTopRightBGColor" value='<? if ($ModTopRightBGColor == '') { echo 'click here for color'; } else { echo $ModTopRightBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td></tr>
<tr><td>
<table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Bottom Left</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModBottomLeftImageDiv' align="center"><? if ($ModBottomLeftImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModBottomLeftImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModBottomLeftImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModBottomLeftBGColor" name="ModBottomLeftBGColor" value='<? if ($ModBottomLeftBGColor == '') { echo 'click here for color'; } else { echo $ModBottomLeftBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td>
 <td>
 <table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Bottom Right</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModBottomRightImageDiv' align="center"><? if ($ModBottomRightImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModBottomRightImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModBottomRightImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModBottomRightBGColor" name="ModBottomRightBGColor" value='<? if ($ModBottomRightBGColor == '') { echo 'click here for color'; } else { echo $ModBottomRightBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td></tr>
 </table>     
 
 <div class="spacer"></div>
 <div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sides</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="You can upload images or set the background color for each side of your window box. TIP: If you are making a symetrical round corner box, you need to make sure the width of the sides is the same width as the corner, or just set a background color." tooltip_position="left"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='spacer'></div>
<table cellspacing="10"><tr><td>
<table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Left Side</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModLeftSideImageDiv' align="center"><? if ($ModLeftSideImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModLeftSideImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModLeftSideImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModLeftSideBGColor" name="ModLeftSideBGColor" value='<? if ($ModLeftSideBGColor == '') { echo 'click here for color'; } else { echo $ModLeftSideBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td>
 <td>
 <table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Right Side</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModRightSideImageDiv' align="center"><? if ($ModRightSideImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModRightSideImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModRightSideImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModRightSideBGColor" name="ModRightSideBGColor" value='<? if ($ModRightSideBGColor == '') { echo 'click here for color'; } else { echo $ModRightSideBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td></tr>
 </table>     
 
 <div class="spacer"></div>
 <div style="float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Top and Bottom</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="You can upload images or set the background color for the TOP and BOTTOM of your window box. TIP: If you are making a symetrical round corner box, you need to make sure the height of these images are the same as the height of the corner, or just set a background color." tooltip_position="left"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class='spacer'></div>
<table cellspacing="10"><tr><td>
<table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Top Bar</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModTopImageDiv' align="center"><? if ($ModTopImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModTopImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModTopImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModTopBGColor" name="ModTopBGColor" value='<? if ($ModTopBGColor == '') { echo 'click here for color'; } else { echo $ModTopBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td>
 <td>
 <table width="210" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="194" align="center">
                                                <div style="float:left; text-align:left; width:180px;">&nbsp;&nbsp;<strong>Bottom Bar</strong></div>
                                              
                                                     <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td valign="top"><div id='ModBottomImageDiv' align="center"><? if ($ModBottomImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'ModBottomImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_image.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'ModBottomImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_image.jpg" border="0" class="navbuttons"></a>';?></div>                                                                               
                                                </td>
                                                
                                                <td valign="top" id="grey_box">Background<br />
Color<br />
                                               <input class="color {adjust:false}" id="ModBottomBGColor" name="ModBottomBGColor" value='<? if ($ModBottomBGColor == '') { echo 'click here for color'; } else { echo $ModBottomBGColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                                                                                                                          
                                                </td>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
 </td></tr>
 </table>    
                 
   <div class="spacer"></div>
<table cellspacing="10"><tr><td>
<table width="430" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="414" align="center">
                                                <table cellpadding="0" cellspacing="3" border="0">
                                                     <tr>
                              
                                                <td width="200">
                                                 <strong>Window Seperation</strong>&nbsp;&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="This setting lets you have all your windows appear in one window, or you can seperate each window into it's own self contained module." tooltip_position="left"/>&nbsp;&nbsp;<div class='spacer'></div>
                                                </td>
                                                
                                                <td> 
                                                 <select name="ModuleSeparation">
                                                <option value="1" <? if (($ModuleSeparation == 1) || ($ModuleSeparation == '')) echo 'selected';?>>Windows Self Contained</option>
                                                <option value="0" <? if ($ModuleSeparation == 0) echo 'selected';?>>Windows Not Seperated</option>
                                                    </select>
                                                                                                        
                                               
                                                </td>
                                               
                                                </tr>
                                                </table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
			
 </td></tr>
 </table> 
 
<? /*                    
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td width='160' align="left" style="font-weight:bold;">TOP LEFT</td>
<td width="15"></td>
<td  width='160' align="left" style=" font-weight:bold;">TOP RIGHT</td>
</tr>
<tr>
<td width='160'  class='buttonbox2'>
<div id='ModTopLeftImageDiv' align="center"><? if ($ModTopLeftImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModTopLeftImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModTopLeftImage');return false;"><font color="#0099FF">
<? if ($ModTopLeftImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModTopLeftBGColor" name="ModTopLeftBGColor" value='<? if ($ModTopLeftBGColor == '') { echo 'click here for color'; } else { echo $ModTopLeftBGColor;}?>' size="15"></center></div></td>
<td width="15">&nbsp;</td>

<td width='160'  class='buttonbox2'>
<div id='ModTopRightImageDiv' align="center"><? if ($ModTopRightImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModTopRightImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModTopRightImage');return false;"><font color="#0099FF">
<? if ($ModTopRightImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModTopRightBGColor" name="ModTopRightBGColor" value='<? if ($ModTopRightBGColor == '') { echo 'click here for color'; } else { echo $ModTopRightBGColor;}?>' size="15"></center></div></td>
</tr>
<tr>
<td colspan="3" height="5"></td>
</tr>
<tr>
<td width='160' align="left" style="font-weight:bold;">BOTTOM LEFT</td>
<td width="15"></td>
<td  width='160' align="left" style=" font-weight:bold;">BOTTOM RIGHT</td>
</tr>
<tr>
<td width='160'  class='buttonbox2'>
<div id='ModBottomLeftImageDiv' align="center"><? if ($ModBottomLeftImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModBottomLeftImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModBottomLeftImage');return false;"><font color="#0099FF">
<? if ($ModBottomLeftImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModBottomLeftBGColor" name="ModBottomLeftBGColor" value='<? if ($ModBottomLeftBGColor == '') { echo 'click here for color'; } else { echo $ModBottomLeftBGColor;}?>' size="15"></center></div></td>
<td width="15">&nbsp;</td>

<td width='160'  class='buttonbox2'>
<div id='ModBottomRightImageDiv' align="center"><? if ($ModBottomRightImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModBottomRightImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModBottomRightImage');return false;"><font color="#0099FF">
<? if ($ModBottomRightImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font><? }?></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModBottomRightBGColor" name="ModBottomRightBGColor" value='<? if ($ModBottomRightBGColor == '') { echo 'click here for color'; } else { echo $ModBottomRightBGColor;}?>' size="15"></center></div></td></tr>
<tr>
<td colspan="3" height="5"></td>
</tr>
</table>
<? }?>


<div class='spacer'></div><div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">SIDES</div><div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td width='160' align="left" style="font-weight:bold;">LEFT SIDE</td>
<td width="15"></td>
<td  width='160' align="left" style=" font-weight:bold;">RIGHT SIDE</td>
</tr>
<tr>
<td width='160'  class='buttonbox2'>
<div id='ModLeftSideImageDiv' align="center"><? if ($ModLeftSideImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModLeftSideImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModLeftSideImage');return false;"><font color="#0099FF">
<? if ($ModLeftSideImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModLeftSideBGColor" name="ModLeftSideBGColor" value='<? if ($ModLeftSideBGColor == '') { echo 'click here for color'; } else { echo $ModLeftSideBGColor;}?>' size="15"></center></div></td>
<td width="15">&nbsp;</td>

<td width='160'  class='buttonbox2'>
<div id='ModRightSideImageDiv' align="center"><? if ($ModRightSideImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModRightSideImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModRightSideImage');return false;"><font color="#0099FF">
<? if ($ModRightSideImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModRightSideBGColor" name="ModRightSideBGColor" value='<? if ($ModRightSideBGColor == '') { echo 'click here for color'; } else { echo $ModRightSideBGColor;}?>' size="15"></center></div></td>
</tr>
<tr>
<td colspan="3" height="5"></td>
</tr>
</table>


<div class='spacer'></div><div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">TOP AND BOTTOM</div><div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<tr>
<td width='160' align="left" style="font-weight:bold;">TOP BAR</td>
<td width="15"></td>
<td  width='160' align="left" style=" font-weight:bold;">BOTTOM BAR</td>
</tr>
<tr>
<td width='160'  class='buttonbox2'>
<div id='ModTopImageDiv' align="center"><? if ($ModTopImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModTopImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModTopImage');return false;"><font color="#0099FF">
<? if ($ModTopImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModTopBGColor" name="ModTopBGColor" value='<? if ($ModTopBGColor == '') { echo 'click here for color'; } else { echo $ModTopBGColor;}?>' size="15"></center></div></td>
<td width="15">&nbsp;</td>

<td width='160'  class='buttonbox2'>
<div id='ModBottomImageDiv' align="center"><? if ($ModBottomImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ModBottomImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ModBottomImage');return false;"><font color="#0099FF">
<? if ($ModBottomImage == '')  { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?><? }?></font></a></div>
<div style="padding-top:5px;">
<font color="#0066FF">
BACKGROUND</font><center>
<input class="color {adjust:false}" id="ModBottomBGColor" name="ModBottomBGColor" value='<? if ($ModBottomBGColor == '') { echo 'click here for color'; } else { echo $ModBottomBGColor;}?>' size="15"></center></div></td>
</tr>
</table>

<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">MODULE SEPARATION</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td width="300"  class='buttonbox2'>This setting will place each module into it's own content box<br />
<font color="#0066FF">Modules Self Contained 
    <input type="radio" name='ModuleSeparation' id='ModuleSeparation' <? if (($ModuleSeparation == 1) || ($ModuleSeparation == '')) echo 'checked';?> value='1'><br />
     Modules not Separated
   
     <input type="radio" name='ModuleSeparation' id='ModuleSeparation' <? if ($ModuleSeparation == 0) echo 'checked';?>  value='0'></font></td>


</tr>
</table>
<? */?>
</td></tr></table>
