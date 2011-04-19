<? if ($_SESSION['IsPro'] == 1) {?>
<table cellspacing="5"><tr>
<td>
<table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="center">
                                                <div style="float:left; text-align:left; width:300px;">&nbsp;&nbsp;<strong>Hot Spot Settings</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="These settings will change the look of HOT SPOT areas on your page." tooltip_position="left"/>&nbsp;&nbsp;</div>
                                              
                                                     <table cellpadding="0" cellspacing="10" border="0" >
                                                <tr>
                                                <td align="left">                                             
                                                <div id='HotSpotImageDiv' align="center"><? if ($HotSpotImage != '') echo '<a href="javascript:void(0)" onclick="removeSkinImage(\'HotSpotImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_background.jpg" border="0" class="navbuttons"></a>'; else echo '<a href="javascript:void(0)" onclick="revealModal(\'uploadModal\',\'HotSpotImage\');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_load_background.jpg" border="0" class="navbuttons"></a>';?></div>
                                              </td>
                                                                                       
                                                
                                               
                                                <td valign="top" id="grey_box">Background Color<br />
                                               
                                               <input class="color {adjust:false}" id="HotSpotBGColor" name="HotSpotBGColor" value='<? if ($HotSpotBGColor == '') { echo 'click here for color'; } else { echo $HotSpotBGColor;}?>' size="15" style="font-size:10px;width:60px;">
                                                                                              
                                                </td>
</tr>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>                  
</td>
<td>
<table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="center">
                                                <div style="float:left; text-align:left; width:280px;">&nbsp;&nbsp;<strong>Hot Spot Triggers</strong></div><div style="float:right;"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="These settings will change how the HOT SPOT is opened and closed." tooltip_position="left"/>&nbsp;&nbsp;</div>
                                              
                                                     <table cellpadding="0" cellspacing="10" border="0" >
                                                <tr>
                                                                                                                                   
                                                
                                                <td valign="top" id="grey_box" align="center"><div class="smspacer"></div>Open<br />
Trigger<div class="smspacer"></div>
                                                <center>
                                      
                                              <select name="BubbleOpen" class="cms_input" style="width:60px;">
												<option value="mouseover"  <? if (($BubbleOpen == '') || ($BubbleOpen == 'mouseover'))  echo 'selected';?>>mouseover</option>
                                               <option value="click"  <? if (($BubbleOpen == '') || ($BubbleOpen == 'click'))  echo 'selected';?>>click</option>
                                                </select>
                                                </center>
                                                </td> 
                                                
                                 <td valign="top" id="grey_box" align="center">
                                 <div class="smspacer"></div>Close<br/>Trigger
                                                <center>
                                     
                                              <select name="BubbleClose" class="cms_input" style="width:60px;">
												<option value="mouseout"  <? if (($BubbleClose == '') || ($BubbleClose == 'mouseout'))  echo 'selected';?>>mouseout</option>
                                               <option value="click"  <? if (($BubbleClose == '') || ($BubbleClose == 'click'))  echo 'selected';?>>click</option>
                                                </select>
                                                </center>
                                                </td> 
</tr>
                                                </tr></table>
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>    

</td>

</tr></table>     
      
   <? } else {?>
     <table width="600" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="584" align="left">
                                             <strong>  Pro Subscriber Access Only</strong><br />
                                             <div class="spacer"></div>
Sorry you've reached a section or feature of the CMS that is available to Pro Creators only. <div class="spacer"></div>
To check out a list of all the pro features available click <a href="javascript:void(0);" onclick="open_pro_features();">[HERE]</a>
                                               <div class="spacer"></div>
If you're interested, go save your work (buttom left over there), then click 'GO PRO' from the main WEvolt menu under our Logo. Packages start as low as $4, but $1 of that you get to support another creator on WEvolt.  <div class="spacer"></div>
You and your fans are gonna love the extra stuff you get access too!
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>      
   
   <? }?>