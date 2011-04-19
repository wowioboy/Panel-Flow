<table width="700" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="684" align="center">
                                                <div style="float:left; text-align:left; width:650px;">&nbsp;&nbsp;<strong>Global Header Settings</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="These settings will change the way any content or window headers look on your site. " tooltip_position="left"/>&nbsp;&nbsp;</div>
                                              
                                                     <table cellpadding="0" cellspacing="5" border="0" width="100%">
                                                <tr>
                                                <td align="left">                                             
                                                <div id='GlobalHeaderImageDiv' align="center"><? if ($GlobalHeaderImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'GlobalHeaderImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'GlobalHeaderImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_background.jpg" border="0" class="navbuttons"></a>';?></div>
                                              </td>
                                                                                       
                                                
                                                <td valign="top" id="grey_box" align="center"><div class="smspacer"></div>Image Repeat<div class="smspacer"></div>
                                                <center>
                                              <select name="GlobalHeaderImageRepeat" class="cms_input" style="width:60px;">
												<option value="" <? if ($GlobalHeaderImageRepeat == '')  echo 'selected';?>>All</option>
                                                <option value="no-repeat" <? if ($GlobalHeaderImageRepeat == 'no-repeat')  echo 'selected';?>>None</option>
                                                <option value="repeat-y" <? if ($GlobalHeaderImageRepeat == 'repeat-y')  echo 'selected';?>>Vertical</option>
                                                <option value="repeat-x" <? if ($GlobalHeaderImageRepeat == 'repeat-x')  echo 'selected';?>>Horizontal</option>
                                                </select>
                                                </center>
                                                </td> 
                                                
                                                <td valign="top" id="grey_box">Background Color<br />
                                               
                                               <input class="color {adjust:false}" id="GlobalHeaderBGColor" name="GlobalHeaderBGColor" value='<? if ($GlobalHeaderBGColor == '') { echo 'click here for color'; } else { echo $GlobalHeaderBGColor;}?>' size="15" style="font-size:10px;width:60px;">
                                                                                              
                                                </td>
                                                
                                              
                                                
                                                
                                                <td valign="top" id="grey_box"><div class="smspacer"></div>Text Color<div class="smspacer"></div>
                                   
                                                <input class="color {adjust:false}" id="GlobalHeaderTextColor" name="GlobalHeaderTextColor" value='<? if ($GlobalHeaderTextColor == '') { echo 'click here for color'; } else { echo $GlobalHeaderTextColor;}?>'  size="15" style="font-size:10px;width:60px;">
                                
                                           
                                                </td>
                                                 <td valign="top" id="grey_box"><div class="smspacer"></div>Font Size<div class="smspacer"></div>

                                                 <input id="GlobalHeaderFontSize" name="GlobalHeaderFontSize"  value='<? if ($GlobalHeaderFontSize == '') { echo '12';} else { echo $GlobalHeaderFontSize; }?>' size="10" style="font-size:10px;width:60px;"></td>
                                                 <td valign="top" id="grey_box"><div class="smspacer"></div>Font Style<div class="smspacer"></div>
<center>
<select name="GlobalHeaderFontStyle" class="cms_input" style="width:60px;">
<option value="regular" <? if (($GlobalHeaderFontStyle == '') || ($GlobalHeaderFontStyle == 'regular'))  echo 'checked';?>>Regular</option>
<option value="bold" <? if ($GlobalHeaderFontStyle == 'bold')  echo 'checked';?>>Bold</option>
<option value="underline" <? if ($GlobalHeaderFontStyle == 'underline')  echo 'checked';?>>Underline</option>
</select>
</center></td>
</tr>
<tr>
<td>
<td valign="top" id="grey_box"><div class="smspacer"></div>Font<br/>Transform
<center>
<select name="GlobalHeaderTextTransformation" class="cms_input" style="width:60px;">
<option value="none" <? if ($GlobalHeaderTextTransformation == 'none')  echo 'selected';?>>Normal</option>
<option value="uppercase" <? if ($GlobalHeaderTextTransformation == 'uppercase')  echo 'selected';?>>UPPERCASE</option>
<option value="lowercase" <? if ($GlobalHeaderTextTransformation == 'lowercase')  echo 'selected';?>>lowercase</option>
</select>
</center></td>
<td valign="top" id="grey_box"><div class="smspacer"></div>Font<div class="smspacer"></div>
<center>
<select name="GlobalHeaderFontFamily" class="cms_input" style="width:60px;">
<option value="Verdana, Arial, Helvetica, sans-serif" <? if (($GlobalHeaderFontFamily == "Verdana, Arial, Helvetica, sans-serif") || ($GlobalHeaderFontFamily == ""))  echo 'selected';?>><span style="font-family:Verdana, Arial, Helvetica, sans-serif;">Verdana</span></option>
<option value="'Times New Roman',Times,serif" <? if ($GlobalHeaderFontFamily == "'Times New Roman',Times,serif")  echo 'selected';?>><span style="font-family:'Times New Roman', Times, serif;">Times New Roman</span></option>
<option value="Arial, Helvetica, sans-serif" <? if ($GlobalHeaderFontFamily == "Arial, Helvetica, sans-serif")  echo 'selected';?>><span style="font-family: Arial, Helvetica, sans-serif;">Arial</span></option>
<option value=" Georgia, 'Times New Roman', Times, serif" <? if ($GlobalHeaderFontFamily == " Georgia, 'Times New Roman', Times, serif")  echo 'selected';?>><span style="font-family: Georgia, 'Times New Roman', Times, serif;">Georgia</span></option>
<option value="'Courier New', Courier, monospace" <? if ($GlobalHeaderFontFamily == "'Courier New', Courier, monospace")  echo 'selected';?>><span style="font-family:'Courier New', Courier, monospace;">Courier New</span></option>

<option value="Algerian, 'Lucida Grande', fantasy" <? if ($GlobalHeaderFontFamily == "Algerian, 'Lucida Grande', fantasy")  echo 'selected';?>><span style="font-family:Algerian, 'Lucida Grande', fantasy;">Algerian</span></option>
<option value="Impact, fantasy" <? if ($GlobalHeaderFontFamily == "Impact, fantasy")  echo 'selected';?>><span style="font-family:Impact, fantasy;">Impact</span></option>
</select>
</center></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>


 <div class="spacer"></div>
<table cellspacing="10"><tr><td>
<table width="430" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="414" align="center">
                                                <table cellpadding="0" cellspacing="3" border="0" width="100%">
                                                     <tr>
                              
                                                <td width="200">
                                                 <strong>Header Placement</strong>&nbsp;&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="This setting lets you place the header for your windows or content boxes inside or outside of the window." tooltip_position="left"/>&nbsp;&nbsp;<div class='spacer'></div>
                                                </td>
                                                
                                                <td> 
                                                 <select name="HeaderPlacement">
                                                <option value="inside" <? if (($HeaderPlacement == 'inside') || ($HeaderPlacement == '')) echo 'selected';?>>Inside Window</option>
                                                <option value="outside" <? if ($HeaderPlacement == 'outside') echo 'selected';?>>Outside Window</option>
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
<!-- AUTHOR COMMENT BOX -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">AUTHOR COMMENT</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='AuthorCommentImageDiv' align="center"><? if ($AuthorCommentImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'AuthorCommentImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','AuthorCommentImage');return false;"><font color="#0099FF">
<? if ($AuthorCommentImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="AuthorCommentImageRepeat" value='none'  <? if (($AuthorCommentImageRepeat == '') || ($AuthorCommentImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="AuthorCommentImageRepeat" value='repeat-y' <? if ($AuthorCommentImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="AuthorCommentImageRepeat" value='repeat-x' <? if ($AuthorCommentImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="AuthorCommentImageRepeat" value='' <? if ($AuthorCommentImageRepeat == '')  echo 'checked';?>>Repeat All
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="AuthorCommentBGColor" name="AuthorCommentBGColor" value='<? if ($AuthorCommentBGColor == '') { echo 'click here for color'; } else { echo $AuthorCommentBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="AuthorCommentTextColor" name="AuthorCommentTextColor" value='<? if ($AuthorCommentTextColor == '') { echo 'click here for color'; } else { echo $AuthorCommentTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="AuthorCommentFontSize" name="AuthorCommentFontSize" value='<? if ($AuthorCommentFontSize == '') { echo 'global';} else { echo $AuthorCommentFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="AuthorCommentFontStyle">
<option value="" <? if (($AuthorCommentFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($AuthorCommentFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($AuthorCommentFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($AuthorCommentFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>


<!-- COMMENTS HEADER -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">USER COMMENTS</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='UserCommentsImageDiv' align="center"><? if ($UserCommentsImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'UserCommentsImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','UserCommentsImage');return false;"><font color="#0099FF">
<? if ($UserCommentsImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="UserCommentsImageRepeat" value='none'  <? if (($UserCommentsImageRepeat == '') || ($UserCommentsImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="UserCommentsImageRepeat" value='repeat-y' <? if ($UserCommentsImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="UserCommentsImageRepeat" value='repeat-x' <? if ($UserCommentsImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="UserCommentsImageRepeat" value='' <? if ($UserCommentsImageRepeat == '')  echo 'checked';?>>Repeat All
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="UserCommentsBGColor" name="UserCommentsBGColor" value='<? if ($UserCommentsBGColor == '') { echo 'click here for color'; } else { echo $UserCommentsBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="UserCommentsTextColor" name="UserCommentsTextColor" value='<? if ($UserCommentsTextColor == '') { echo 'click here for color'; } else { echo $UserCommentsTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="UserCommentsFontSize" name="UserCommentsFontSize" value='<? if ($UserCommentsFontSize == '') { echo 'global';} else { echo $UserCommentsFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="UserCommentsFontStyle">
<option value="" <? if (($UserCommentsFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($UserCommentsFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($UserCommentsFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($UserCommentsFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>



<!-- COMMENTS HEADER -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">PROJECT INFO </div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='ComicInfoImageDiv' align="center"><? if ($ComicInfoImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ComicInfoImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ComicInfoImage');return false;"><font color="#0099FF">
<? if ($ComicInfoImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="ComicInfoImageRepeat" value='none'  <? if (($ComicInfoImageRepeat == '') || ($ComicInfoImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="ComicInfoImageRepeat" value='repeat-y' <? if ($ComicInfoImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="ComicInfoImageRepeat" value='repeat-x' <? if ($ComicInfoImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="ComicInfoImageRepeat" value='' <? if ($ComicInfoImageRepeat == '')  echo 'checked';?>>Repeat All
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="ComicInfoBGColor" name="ComicInfoBGColor" value='<? if ($ComicInfoBGColor == '') { echo 'click here for color'; } else { echo $ComicInfoBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="ComicInfoTextColor" name="ComicInfoTextColor" value='<? if ($ComicInfoTextColor == '') { echo 'click here for color'; } else { echo $ComicInfoTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="ComicInfoFontSize" name="ComicInfoFontSize" value='<? if ($ComicInfoFontSize == '') { echo 'global';} else { echo $ComicInfoFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="ComicInfoFontStyle">
<option value="" <? if (($ComicInfoFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($ComicInfoFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($ComicInfoFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($ComicInfoFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>

<!-- SYNOPSIS HEADER -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">SYNOPSIS</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='ComicSynopsisImageDiv' align="center"><? if ($ComicSynopsisImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ComicSynopsisImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ComicSynopsisImage');return false;"><font color="#0099FF">
<? if ($ComicSynopsisImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="ComicSynopsisImageRepeat" value='none'  <? if (($ComicSynopsisImageRepeat == '') || ($ComicSynopsisImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="ComicSynopsisImageRepeat" value='repeat-y' <? if ($ComicSynopsisImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="ComicSynopsisImageRepeat" value='repeat-x' <? if ($ComicSynopsisImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="ComicSynopsisBGColor" name="ComicSynopsisBGColor" value='<? if ($ComicSynopsisBGColor == '') { echo 'click here for color'; } else { echo $ComicSynopsisBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="ComicSynopsisTextColor" name="ComicSynopsisTextColor" value='<? if ($ComicSynopsisTextColor == '') { echo 'click here for color'; } else { echo $ComicSynopsisTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="ComicSynopsisFontSize" name="ComicSynopsisFontSize" value='<? if ($ComicSynopsisFontSize == '') { echo 'global';} else { echo $ComicSynopsisFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="ComicSynopsisFontStyle">
<option value="" <? if (($ComicSynopsisFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($ComicSynopsisFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($ComicSynopsisFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($ComicSynopsisFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>

<!-- PRODUCTS HEADER -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">PRODUCTS MODULE</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='ProductsImageDiv' align="center"><? if ($ProductsImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'ProductsImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','ProductsImage');return false;"><font color="#0099FF">
<? if ($ProductsImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="ProductsImageRepeat" value='none'  <? if (($ProductsImageRepeat == '') || ($ProductsImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="ProductsImageRepeat" value='repeat-y' <? if ($ProductsImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="ProductsImageRepeat" value='repeat-x' <? if ($ProductsImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="ProductsImageRepeat" value='' <? if ($ProductsImageRepeat == '')  echo 'checked';?>>Repeat All
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="ProductsBGColor" name="ProductsBGColor" value='<? if ($ProductsBGColor == '') { echo 'click here for color'; } else { echo $ProductsBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="ProductsTextColor" name="ProductsTextColor" value='<? if ($ProductsTextColor == '') { echo 'click here for color'; } else { echo $ProductsTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="ProductsFontSize" name="ProductsFontSize" value='<? if ($ProductsFontSize == '') { echo 'global';} else { echo $ProductsFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="ProductsFontStyle">
<option value="" <? if (($ProductsFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($ProductsFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($ProductsFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($ProductsFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>


<!-- PRODUCTS HEADER -->
<div class='spacer'></div>
<div class='pagetitleLarge' style="border-bottom:solid 1px #0066FF; padding-right:10px;">MOBILE CONTENT MODULE</div>
<div class='spacer'></div>
<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td class="buttonbox" width='150' valign="top">BACKGROUND IMAGE<div class='spacer'></div><div id='MobileContentImageDiv' align="center"><? if ($MobileContentImage != '') echo '<font color="green">IMAGE SET</font><a href="#" onclick="removeSkinImage(\'MobileContentImage\');return false;"><font color="red">&nbsp;[x]</font></a><div style="height:5px;"></div>'; ?><a href="#" onclick="revealModal('uploadModal','MobileContentImage');return false;"><font color="#0099FF">
<? if ($MobileContentImage == '') { echo '[UPLOAD IMAGE]'; } else { echo '[CHANGE IMAGE]';?></font></a></a><? }?></div>
</td>

<td valign="top" class="buttonbox" width="125">IMAGE REPEAT<br />
<input  type="radio" name="MobileContentImageRepeat" value='none'  <? if (($MobileContentImageRepeat == '') || ($MobileContentImageRepeat == 'none'))  echo 'checked';?>>
No Repeat<br />
<input  type="radio" name="MobileContentImageRepeat" value='repeat-y' <? if ($MobileContentImageRepeat == 'repeat-y')  echo 'checked';?>>
Repeat Vertical<br />
<input  type="radio" name="MobileContentImageRepeat" value='repeat-x' <? if ($MobileContentImageRepeat == 'repeat-x')  echo 'checked';?>>
Repeat Horizontal<br/>
<input  type="radio" name="MobileContentImageRepeat" value='' <? if ($MobileContentImageRepeat == '')  echo 'checked';?>>Repeat All
</td>

<td class="buttonbox" valign="top" width='150'>BACKGROUND COLOR<br />
<center>
<input class="color {adjust:false}" id="MobileContentBGColor" name="MobileContentBGColor" value='<? if ($MobileContentBGColor == '') { echo 'click here for color'; } else { echo $MobileContentBGColor;}?>'  size="15">
</center>
<div style="height:5px;"></div>
TEXT COLOR
<center>
<input class="color {adjust:false}" id="MobileContentTextColor" name="MobileContentTextColor" value='<? if ($MobileContentTextColor == '') { echo 'click here for color'; } else { echo $MobileContentTextColor;}?>'  size="15">
</center>
</td>

<td class="buttonbox" valign="top" width='150'>FONT SIZE<br />
<center>
<input id="MobileContentFontSize" name="MobileContentFontSize" value='<? if ($MobileContentFontSize == '') { echo 'global';} else { echo $MobileContentFontSize; }?>' size="15">
</center>
<div style="height:5px;"></div>
FONT STYLE
<center>
<select name="MobileContentFontStyle">
<option value="" <? if (($MobileContentFontStyle == ''))  echo 'selected';?>>Global</option>
<option value="regular" <? if ($MobileContentFontStyle == 'regular')  echo 'selected';?>>Regular</option>
<option value="bold" <? if ($MobileContentFontStyle == 'bold')  echo 'selected';?>>Bold</option>
<option value="underline" <? if ($MobileContentFontStyle == 'underline')  echo 'selected';?>>Underline</option>
</select>
</center>
</td>
</tr></table>
*/?>