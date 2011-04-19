                                                
         <div class="cms_wrappercontent">                                    
 
                 
 <table cellspacing="10"><tr><td valign="top">
 
 <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="306" align="left">
                                 CURRENTLY EDITING: <? echo $Section;?>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>  
                         <div class="spacer"></div>  
                         <? if (($ProjectID == '')|| ($TemplateLocks->MenuBackground == 0)) {?>
                           <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                                
                                                 Background Image: <span id='MenuBackgroundDiv' align="center"><? if ($MenuBackground != '') {?><img src="/<? echo $MenuBackground;?>" id="menubackgroundimage" width="50"/><a href="javascript:void(0)" onclick="removeTemplateImage('MenuBackground');return false;"><font color="red">&nbsp;remove[x]</font></a><? } else {?>NONE SET<? } ?></span> <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuBackgroundLock" <? if ($TemplateLocks->MenuBackground == 1) echo 'checked';?> />lock<? }?>
                                                 <? }?>
                                                <table><tr>
                                               
                                              
        <? if (($ProjectID == '')|| ($TemplateLocks->MenuBackground == 0)) {?>     
          <td width="200">                                     
    <iframe id='loaderframe' name='loaderframe' height='60px' width="180px" frameborder="no" scrolling="no" src="http://<? echo $_SERVER['SERVER_NAME'];?>/<? echo $_SESSION['pfdirectory'];?>/includes/template_upload_inc.php?compact=yes&transparent=1&type=MenuBackground&project=<? echo $ProjectID;?>&skincode=<? echo $_GET['skin'];?>&db=template&template=<? echo $_GET['template'];?>&theme=<? echo $_GET['theme'];?>&vert=1" allowtransparency="true"></iframe>
 </td>  <? }?>
       
         <? if (($ProjectID == '') || ($TemplateLocks->MenuBackgroundRepeat == 0)) {?>  
         <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuBackgroundRepeatLock" <? if ($TemplateLocks->MenuBackgroundRepeat == 1) echo 'checked';?> />lock<? }?>    
          <td valign="top" id="grey_box" align="center">
               <div class="smspacer"></div>                              
Image Repeat<br /> <div class="smspacer"></div>  
<select name="MenuBackgroundRepeat" class="cms_input" style="width:60px;">
<option value="" <? if ($MenuBackgroundRepeat == '')  echo 'selected';?>>All&nbsp;&nbsp;</option>
<option value="no-repeat" <? if ($MenuBackgroundRepeat == 'no-repeat')  echo 'selected';?>>None&nbsp;&nbsp;</option>
<option value="repeat-y" <? if ($MenuBackgroundRepeat == 'repeat-y')  echo 'selected';?>>Vertical&nbsp;&nbsp;</option>
<option value="repeat-x" <? if ($MenuBackgroundRepeat == 'repeat-x')  echo 'selected';?>>Horizontal&nbsp;&nbsp;</option>
</select>
</td>

        
        </tr></table> <? if (($ProjectID == '') || ($TemplateLocks->MenuBackgroundImagePosition == 0)) {?>   
 <div class="spacer"></div>  
Background Position: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuBackgroundImagePositionLock" <? if ($TemplateLocks->MenuBackgroundImagePosition == 1) echo 'checked';?> />lock<? }?>
<br /><em>examples: top left, top center, bottom right, etc.</em>
<input type="text" name="MenuBackgroundImagePosition" value="<? echo $MenuBackgroundImagePosition;?>" style="border:#333333 1px solid;"/>
    <? }?>            


                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
           <? }?> 
            <div class="spacer"></div>  
            <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                       CONTENT<div style="font-size:10px;"> (place html/embed code here to customize your header even more) If you have an banner image uploaded, this content will appear below that</div>
   
<textarea name="MenuContent" id="MenuContent" style="width:99%; height:50px; border:#333333 1px solid;"><? echo $MenuContent;?></textarea>

                                                 </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                
                          
                  <div align="center">
                                  <div class="spacer"></div> 
<img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_save_box.jpg" onclick="submit_form();" class="navbuttons" />     <img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_cancel_box.jpg" onclick="parent.$.modal().close();" class="navbuttons"/></div>    

                        
  </td>
  <td valign="top">
  <div style="height:40px;"></div>
  
                   <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
     <table><tr>
  <?  if (($ProjectID == '') || ($TemplateLocks->MenuWidth == 0)) {?>  
  <td class="grey_cmsboxcontent"> 
Width<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuWidthLock" <? if ($TemplateLocks->MenuWidth == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 800px or 100%)</span><input type="text" name="MenuWidth" value="<? echo $MenuWidth;?>"  style="border:#333333 1px solid;"/><? }?></td>
   <? if (($ProjectID == '') || ($TemplateLocks->MenuHeight == 0)) {?> 
<td class="grey_cmsboxcontent">Height<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuHeightLock" <? if ($TemplateLocks->MenuHeight == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 150px or 50%)</span><input type="text" name="MenuHeight" value="<? echo $MenuHeight;?>"  style="border:#333333 1px solid;"/></td>

<? }?>
</tr></table>
     </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
<? if (($ProjectID == '') || ($TemplateLocks->MenuPadding == 0)) {?> 
 <div class="spacer"></div>   
    <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                            
Padding <? if ($ProjectID == '') {?><input type="checkbox" value="1"  name="MenuPaddingLock" <? if ($TemplateLocks->MenuPadding == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(must include the 'px' after each value. ex: 5px)</span>
    <table><tr><td class="grey_cmsboxcontent">
Left:<input type="text" name="MenuPaddingLeft" value="<? echo $MenuPaddingLeft;?>"  style="width:40px;"/>
</td><td class="grey_cmsboxcontent">
Right:<input type="text" name="MenuPaddingRight" value="<? echo $MenuPaddingRight;?>" style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Top:<input type="text" name="MenuPaddingTop" value="<? echo $MenuPaddingTop;?>"style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Bottom: <input type="text" name="MenuPaddingBottom" value="<? echo $MenuPaddingBottom;?>" style="width:40px;"/></td></tr></table>



                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                 <? }?>
                                  <? if (($ProjectID == '') || (($TemplateLocks->MenuVAlign == 0) || ($TemplateLocks->MenuAlign == 0))) {?> 
                                <div class="spacer"></div>
          <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
    
   
<table><tr>
	 <? if (($ProjectID == '') ||($TemplateLocks->MenuVAlign == 0)){?>   
    <td  class="grey_cmsboxcontent">
    
VERTICAL ALIGNMENT: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuVAlignLock" <? if ($TemplateLocks->MenuVAlign == 1) echo 'checked';?> />lock<? }?><select name="MenuVAlign">
     <option value="top" <? if ($MenuVAlign == 'top') echo 'selected';?>>top</option>
    <option value="bottom" <? if ($MenuVAlign == 'bottom') echo 'selected';?>>bottom</option>
    <option value="middle" <? if ($MenuVAlign == 'middle') echo 'selected';?>>middle</option>
      <option value="baseline" <? if ($MenuVAlign == 'baseline') echo 'selected';?>>baseline</option>
    </select>
    </td><td width="5"></td>
    
    <? }?>
	 <? if (($ProjectID == '') || ($TemplateLocks->MenuAlign == 0)){?>  
    <td class="grey_cmsboxcontent">
 TEXT ALIGNMENT:<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="MenuAlignLock" <? if ($TemplateLocks->MenuAlign == 1) echo 'checked';?> />lock<? }?><select name="MenuAlign">
     <option value="center" <? if ($MenuAlign == 'center') echo 'selected';?>>center</option>
    <option value="left" <? if ($MenuAlign == 'left') echo 'selected';?>>left</option>
    <option value="right" <? if ($MenuAlign == 'right') echo 'selected';?>>right</option>
      <option value="justify" <? if ($MenuAlign == 'justify') echo 'selected';?>>justify</option>
    </select>
    </td>
    <? }?>
</tr></table>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>                          
                                <? }?>
                                
 


</td></tr></table>

</div>