                                                
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
                          <?  if (($ProjectID == '') || ($TemplateLocks->ContentBackground == 0)) {?>  
                           <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                                
                                                 Background Image: <span id='ContentBackgroundDiv' align="center"><? if ($ContentBackground != '') {?><img src="/<? echo $ContentBackground;?>" id="contentbackgroundimage" width="50"/><a href="javascript:void(0)" onclick="removeTemplateImage('ContentBackground');return false;"><font color="red">&nbsp;remove[x]</font></a><? } else {?>NONE SET<? } ?></span> <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentBackgroundLock" <? if ($TemplateLocks->ContentBackground == 1) echo 'checked';?> />lock<? }?>
                                                 <? }?>
                                                <table><tr>
                                               
                                              
        <? if (($ProjectID == '')|| ($TemplateLocks->ContentBackground == 0)) {?>     
          <td width="200">                                     
    <iframe id='loaderframe' name='loaderframe' height='60px' width="180px" frameborder="no" scrolling="no" src="http://<? echo $_SERVER['SERVER_NAME'];?>/<? echo $_SESSION['pfdirectory'];?>/includes/template_upload_inc.php?compact=yes&transparent=1&type=ContentBackground&project=<? echo $ProjectID;?>&skincode=<? echo $_GET['skin'];?>&db=template&template=<? echo $_GET['template'];?>&theme=<? echo $_GET['theme'];?>&vert=1" allowtransparency="true"></iframe>
 </td>  <? }?>
       
         <? if (($ProjectID == '') || ($TemplateLocks->ContentBackgroundRepeat == 0)) {?>  
         <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentBackgroundRepeatLock" <? if ($TemplateLocks->ContentBackgroundRepeat == 1) echo 'checked';?> />lock<? }?>    
          <td valign="top" id="grey_box" align="center">
               <div class="smspacer"></div>                              
Image Repeat<br /> <div class="smspacer"></div>  
<select name="ContentBackgroundRepeat" class="cms_input" style="width:60px;">
<option value="" <? if ($ContentBackgroundRepeat == '')  echo 'selected';?>>All&nbsp;&nbsp;</option>
<option value="no-repeat" <? if ($ContentBackgroundRepeat == 'no-repeat')  echo 'selected';?>>None&nbsp;&nbsp;</option>
<option value="repeat-y" <? if ($ContentBackgroundRepeat == 'repeat-y')  echo 'selected';?>>Vertical&nbsp;&nbsp;</option>
<option value="repeat-x" <? if ($ContentBackgroundRepeat == 'repeat-x')  echo 'selected';?>>Horizontal&nbsp;&nbsp;</option>
</select>
</td>

        
        </tr></table> <? if (($ProjectID == '') || ($TemplateLocks->ContentBackgroundImagePosition == 0)) {?>   
 <div class="spacer"></div>  
Background Position: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentBackgroundImagePositionLock" <? if ($TemplateLocks->ContentBackgroundImagePosition == 1) echo 'checked';?> />lock<? }?>
<br /><em>examples: top left, top center, bottom right, etc.</em>
<input type="text" name="ContentBackgroundImagePosition" value="<? echo $ContentBackgroundImagePosition;?>" style="border:#333333 1px solid;"/>
    <? }?>            


                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
           <? }?> 
              <? if (($ProjectID == '') || ($TemplateLocks->ContentScroll == 0)) {?>
            <div class="spacer"></div>  
            <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                    

<strong>CONTENT AREA SCROLL :</strong><br />
<? if ($ProjectID == '') {?><input type="checkbox" name="ContentScrollLock" value="1" <? if ($TemplateLocks->ContentScroll == 1) echo 'checked';?> />lock<? }?>&nbsp;&nbsp;<input  type="radio" name="ContentScroll" value='' <? if ($ContentScroll == '')  echo 'checked';?>>no&nbsp;&nbsp;
<input  type="radio" name="ContentScroll" value='auto' <? if ($ContentScroll == 'auto')  echo 'checked';?>>Auto&nbsp;&nbsp;
<input  type="radio" name="ContentScroll" value='hidden' <? if($ContentScroll == 'hidden')  echo 'checked';?>>
Hide Overflow&nbsp;&nbsp;
<input  type="radio" name="ContentScroll" value='scroll' <? if ($ContentScroll == 'scroll')  echo 'checked';?>>
Scroll
  
  

                                                 </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                
               <? }?>              
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
  <?  if (($ProjectID == '') || ($TemplateLocks->ContentWidth == 0)) {?>  
  <td class="grey_cmsboxcontent"> 
Width<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentWidthLock" <? if ($TemplateLocks->ContentWidth == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 800px or 100%)</span><input type="text" name="ContentWidth" value="<? echo $ContentWidth;?>"  style="border:#333333 1px solid;"/><? }?></td>
   <? if (($ProjectID == '') || ($TemplateLocks->ContentHeight == 0)) {?> 
<td class="grey_cmsboxcontent">Height<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentHeightLock" <? if ($TemplateLocks->ContentHeight == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 150px or 50%)</span><input type="text" name="ContentHeight" value="<? echo $ContentHeight;?>"  style="border:#333333 1px solid;"/></td>

<? }?>
</tr></table>
     </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
<? if (($ProjectID == '') || ($TemplateLocks->ContentPadding == 0)) {?> 
 <div class="spacer"></div>   
    <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                            
Padding <? if ($ProjectID == '') {?><input type="checkbox" value="1"  name="ContentPaddingLock" <? if ($TemplateLocks->ContentPadding == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(must include the 'px' after each value. ex: 5px)</span>
    <table><tr><td class="grey_cmsboxcontent">
Left:<input type="text" name="ContentPaddingLeft" value="<? echo $ContentPaddingLeft;?>"  style="width:40px;"/>
</td><td class="grey_cmsboxcontent">
Right:<input type="text" name="ContentPaddingRight" value="<? echo $ContentPaddingRight;?>" style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Top:<input type="text" name="ContentPaddingTop" value="<? echo $ContentPaddingTop;?>"style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Bottom: <input type="text" name="ContentPaddingBottom" value="<? echo $ContentPaddingBottom;?>" style="width:40px;"/></td></tr></table>



                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                 <? }?>
                                  <? if (($ProjectID == '') || (($TemplateLocks->ContentVAlign == 0) || ($TemplateLocks->ContentAlign == 0))) {?> 
                                <div class="spacer"></div>
          <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
    
   
<table><tr>
	 <? if (($ProjectID == '') ||($TemplateLocks->ContentVAlign == 0)){?>   
    <td  class="grey_cmsboxcontent">
    
VERTICAL ALIGNMENT: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentVAlignLock" <? if ($TemplateLocks->ContentVAlign == 1) echo 'checked';?> />lock<? }?><select name="ContentVAlign">
     <option value="top" <? if ($ContentVAlign == 'top') echo 'selected';?>>top</option>
    <option value="bottom" <? if ($ContentVAlign == 'bottom') echo 'selected';?>>bottom</option>
    <option value="middle" <? if ($ContentVAlign == 'middle') echo 'selected';?>>middle</option>
      <option value="baseline" <? if ($ContentVAlign == 'baseline') echo 'selected';?>>baseline</option>
    </select>
    </td><td width="5"></td>
    
    <? }?>
	 <? if (($ProjectID == '') || ($TemplateLocks->ContentAlign == 0)){?>  
    <td class="grey_cmsboxcontent">
 TEXT ALIGNMENT:<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="ContentAlignLock" <? if ($TemplateLocks->ContentAlign == 1) echo 'checked';?> />lock<? }?><select name="ContentAlign">
     <option value="center" <? if ($ContentAlign == 'center') echo 'selected';?>>center</option>
    <option value="left" <? if ($ContentAlign == 'left') echo 'selected';?>>left</option>
    <option value="right" <? if ($ContentAlign == 'right') echo 'selected';?>>right</option>
      <option value="justify" <? if ($ContentAlign == 'justify') echo 'selected';?>>justify</option>
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

