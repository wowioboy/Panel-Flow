<? /*
<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="384" align="center">
                                                
                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                
                                <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
                                        <div style="float:left">Design</div><div style="float:right;">change the look of your project's site</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table><? */?>
                                       
                                                
         <div class="cms_wrappercontent" >                                    
 
                 
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
                             <? if (($ProjectID == '') || ($TemplateLocks->HeaderImage == 0)) {?>
                        <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                           
 Header Image:
  <span id='HeaderImageDiv' align="center" class="grey_cmsboxcontent"><? if ($HeaderImage != '') {?><img src="/<? echo $HeaderImage;?>" id="HeaderImage_img" width="50"/><a href="javascript:void(0)" onclick="removeTemplateImage('HeaderImage');return false;"><font color="red">&nbsp;remove[x]</font></a><? } else {?>NONE SET<? } ?></span>
 
    <iframe id='loaderframe' name='loaderframe' height='40px' width="334px" frameborder="no" scrolling="no" src="http://<? echo $_SERVER['SERVER_NAME'];?>/<? echo $PFDIRECTORY;?>/includes/template_upload_inc.php?compact=yes&transparent=1&type=HeaderImage&project=<? echo $ProjectID;?>&skincode=<? echo $_GET['skin'];?>&db=template&template=<? echo $_GET['template'];?>&theme=<? echo $_GET['theme'];?>" allowtransparency="true"></iframe>
  
  </div>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
    <? }?>
        <div class="spacer"></div>
                          <? if (($ProjectID == '') || ($TemplateLocks->HeaderRollover == 0)) {?>
                        <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                           
 ROLLOVER IMAGE:
<span id='HeaderRolloverDiv' align="center" class="grey_cmsboxcontent"><? if ($HeaderRollover != '') {?><img src="/<? echo $PFDIRECTORY;?>/<? echo $HeaderRollover;?>" id="headerrolloverimage"  width="50"/><a href="javascript:void(0)" onclick="removeTemplateImage('HeaderRollover');return false;"><img src="http://www.wevolt.com/images/cms/cms_grey_delete_box.jpg" border="0"/></a><? } else {?>NONE SET<? } ?></span>
    <iframe id='loaderframe' name='loaderframe' height='40px' width="334px" frameborder="no" scrolling="no" src="http://<? echo $_SERVER['SERVER_NAME'];?>/<? echo $PFDIRECTORY;?>/includes/template_upload_inc.php?compact=yes&transparent=1&type=HeaderRollover&project=<? echo $ProjectID;?>&skincode=<? echo $_GET['skin'];?>&db=template&template=<? echo $_GET['template'];?>&theme=<? echo $_GET['theme'];?>" allowtransparency="true"></iframe>
    </div>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
    <? }?>
  <div class="spacer"></div>
 <? if (($ProjectID == '') || ($TemplateLocks->HeaderLink == 0)) {?>
                        <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                           
Header Link:<span style="font-size:10px;">(this is where people will go when they click on the banner, leave blank to default to project homepage)&nbsp;&nbsp;</span><br />
<input type="text" name="HeaderLink" value="<? echo $HeaderLink;?>" style="width:95%; border:#333333 1px solid;"/>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
    <? }?> <div class="spacer"></div>  
  
                   <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
     <table><tr>
  <?  if (($ProjectID == '') || ($TemplateLocks->HeaderWidth == 0)) {?>  
  <td class="grey_cmsboxcontent"> 
Width<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderWidthLock" <? if ($TemplateLocks->HeaderWidth == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 800px or 100%)</span><input type="text" name="HeaderWidth" value="<? echo $HeaderWidth;?>"  style="border:#333333 1px solid;"/><? }?></td>
   <? if (($ProjectID == '') || ($TemplateLocks->HeaderHeight == 0)) {?> 
<td class="grey_cmsboxcontent">Height<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderHeightLock" <? if ($TemplateLocks->HeaderHeight == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(ex: 150px or 50%)</span><input type="text" name="HeaderHeight" value="<? echo $HeaderHeight;?>"  style="border:#333333 1px solid;"/></td>

<? }?>
</tr></table>
     </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                  <div align="center">
                                  <div class="spacer"></div> 
<img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_save_box.jpg" onclick="submit_form();" class="navbuttons" />     <img src="http://<? echo $_SERVER['SERVER_NAME'];?>/images/cms/cms_grey_cancel_box.jpg" onclick="parent.$.modal().close();" class="navbuttons"/></div>                  
  </td><td  valign="top" style="padding:5px;"> 

                        <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                                 <? if (($ProjectID == '')|| ($TemplateLocks->HeaderBackground == 0)) {?>
                                                 Background Image: <span id='HeaderBackgroundDiv' align="center"><? if ($HeaderBackground != '') {?><img src="/<? echo $PFDIRECTORY;?>/<? echo $HeaderBackground;?>" id="headerbackgroundimage" width="50"/><a href="javascript:void(0)" onclick="removeTemplateImage('HeaderBackground');return false;"><font color="red">&nbsp;remove[x]</font></a><? } else {?>NONE SET<? } ?></span> <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderBackgroundLock" <? if ($TemplateLocks->HeaderBackground == 1) echo 'checked';?> />lock<? }?>
                                                 <? }?>
                                                <table><tr>
                                               
                                              
        <? if (($ProjectID == '')|| ($TemplateLocks->HeaderBackground == 0)) {?>     
          <td width="200">                                     
    <iframe id='loaderframe' name='loaderframe' height='60px' width="180px" frameborder="no" scrolling="no" src="http://<? echo $_SERVER['SERVER_NAME'];?>/<? echo $PFDIRECTORY;?>/includes/template_upload_inc.php?compact=yes&transparent=1&type=HeaderBackground&project=<? echo $ProjectID;?>&skincode=<? echo $_GET['skin'];?>&db=template&template=<? echo $_GET['template'];?>&theme=<? echo $_GET['theme'];?>&vert=1" allowtransparency="true"></iframe>
 </td>  <? }?>
       
         <? if (($ProjectID == '') || ($TemplateLocks->HeaderBackgroundRepeat == 0)) {?>  
         <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderBackgroundRepeatLock" <? if ($TemplateLocks->HeaderBackgroundRepeat == 1) echo 'checked';?> />lock<? }?>    
          <td valign="top" id="grey_box" align="center">
                                             
Image Repeat<br />
<select name="HeaderBackgroundRepeat" class="cms_input" style="width:60px;">
<option value="" <? if ($HeaderBackgroundRepeat == '')  echo 'selected';?>>All&nbsp;&nbsp;</option>
<option value="no-repeat" <? if ($HeaderBackgroundRepeat == 'no-repeat')  echo 'selected';?>>None&nbsp;&nbsp;</option>
<option value="repeat-y" <? if ($HeaderBackgroundRepeat == 'repeat-y')  echo 'selected';?>>Vertical&nbsp;&nbsp;</option>
<option value="repeat-x" <? if ($HeaderBackgroundRepeat == 'repeat-x')  echo 'selected';?>>Horizontal&nbsp;&nbsp;</option>
</select>
</td>
           <? }?> 
        
        </tr></table>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>

    
    


       


 <? if (($ProjectID == '') || ($TemplateLocks->HeaderBackgroundImagePosition == 0)) {?>     
   <div class="spacer"></div>                          <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
Background Position: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderBackgroundImagePositionLock" <? if ($TemplateLocks->HeaderBackgroundImagePosition == 1) echo 'checked';?> />lock<? }?>
<br /><em>examples: top left, top center, bottom right, etc.</em>
<input type="text" name="HeaderBackgroundImagePosition" value="<? echo $HeaderBackgroundImagePosition;?>" style="border:#333333 1px solid;"/>

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
Content<div style="font-size:10px;"> (place html/embed code here) If you have an banner image uploaded, this content will appear below that</div>
   
<textarea name="HeaderContent" id="HeaderContent" style="width:99%; height:50px; border:#333333 1px solid;"><? echo $HeaderContent;?></textarea>

                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                 <? if (($ProjectID == '') || ($TemplateLocks->HeaderPadding == 0)) {?> 
 <div class="spacer"></div>   
    <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                            
Padding <? if ($ProjectID == '') {?><input type="checkbox" value="1"  name="HeaderPaddingLock" <? if ($TemplateLocks->HeaderPadding == 1) echo 'checked';?> />lock<? }?><span style="font-size:10px;">(must include the 'px' after each value. ex: 5px)</span>
    <table><tr><td class="grey_cmsboxcontent">
Left:<input type="text" name="HeaderPaddingLeft" value="<? echo $HeaderPaddingLeft;?>"  style="width:40px;"/>
</td><td class="grey_cmsboxcontent">
Right:<input type="text" name="HeaderPaddingRight" value="<? echo $HeaderPaddingRight;?>" style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Top:<input type="text" name="HeaderPaddingTop" value="<? echo $HeaderPaddingTop;?>"style="width:40px;"/></td>
<td class="grey_cmsboxcontent">
Bottom: <input type="text" name="HeaderPaddingBottom" value="<? echo $HeaderPaddingBottom;?>" style="width:40px;"/></td></tr></table>



                                                </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                                 <? }?>
                                  <? if (($ProjectID == '') || (($TemplateLocks->HeaderVAlign == 0) || ($TemplateLocks->HeaderAlign == 0))) {?> 
                                <div class="spacer"></div>
          <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
    
   
<table><tr>
	 <? if (($ProjectID == '') ||($TemplateLocks->HeaderVAlign == 0)){?>   
    <td  class="grey_cmsboxcontent">
    
VERTICAL ALIGNMENT: <? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderVAlignLock" <? if ($TemplateLocks->HeaderVAlign == 1) echo 'checked';?> />lock<? }?><select name="HeaderVAlign">
     <option value="top" <? if ($HeaderVAlign == 'top') echo 'selected';?>>top</option>
    <option value="bottom" <? if ($HeaderVAlign == 'bottom') echo 'selected';?>>bottom</option>
    <option value="middle" <? if ($HeaderVAlign == 'middle') echo 'selected';?>>middle</option>
      <option value="baseline" <? if ($HeaderVAlign == 'baseline') echo 'selected';?>>baseline</option>
    </select>
    </td><td width="5"></td>
    
    <? }?>
	 <? if (($ProjectID == '') || ($TemplateLocks->HeaderAlign == 0)){?>  
    <td class="grey_cmsboxcontent">
 TEXT ALIGNMENT:<? if ($ProjectID == '') {?><input type="checkbox" value="1" name="HeaderAlignLock" <? if ($TemplateLocks->HeaderAlign == 1) echo 'checked';?> />lock<? }?><select name="HeaderAlign">
     <option value="center" <? if ($HeaderAlign == 'center') echo 'selected';?>>center</option>
    <option value="left" <? if ($HeaderAlign == 'left') echo 'selected';?>>left</option>
    <option value="right" <? if ($HeaderAlign == 'right') echo 'selected';?>>right</option>
      <option value="justify" <? if ($HeaderAlign == 'justify') echo 'selected';?>>justify</option>
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