<div class="spacer"></div><div class="spacer"></div>
<? $GenreArray = explode(',',$SettingArray->genre);?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php?sub=info" method="post" name="settingform" id="settingform">
        <table><tr><td valign="top">

   <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="284" align="center">
                                       
<strong>General Project Settings</strong>



<input type="checkbox" id="txtComments" name="txtComments" value="1" <?php if ($SettingsArray->AllowComments == 1) echo 'checked';?> /> Allow Page Comments 
<div class="spacer"></div>
<input type="checkbox" id="txtPublicComments" name="txtPublicComments" value="1" <?php if ($SettingsArray->AllowPublicComents == 1) echo 'checked';?> />  Allow Anonymous Page Comments 
<div class="spacer"></div>
<input type="checkbox" id="txtEmailPost" name="txtEmailPost" value="1" <?php if ($SettingsArray->EmailPost== 1) echo 'checked';?> />  Allow Posting by Email
<? if ($SettingsArray->EmailPost== 1) {?><div class="spacer"></div>
<div class="messageinfo_black">POST CODE: <? echo $SettingsArray->PostCode;?></div>
<? }?>
<div class="spacer"></div>

<input type="checkbox" id="txtShowSchedule" name="txtShowSchedule" value="1" <?php if ($SettingsArray->ShowSchedule == 1) echo 'checked';?> /> Show Update Schedule 
<div class="spacer"></div>
<input type="checkbox" id="txtReaderType" name="txtReaderType" value="1" <?php if ($SettingsArray->ReaderType == 1) echo 'checked';?> />  Default Reader Type
<div class="spacer"></div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>

                        </td>
                        
                        <td valign="top"> 
                        
                        
                         <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="284" align="center">
                                  
<div class="messageinfo">
Project Assistants (put in WEvolt usernames)
</div>
<div class="spacer"></div>
<div class='sender_name'>Assistant One</div>
<input type="text" name="txtAssOne" id='txtAssOne' value="<? echo stripslashes($SettingArray->Assistant1);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Assistant Two</div>
<input type="text" name="txtAssTwo" id='txtAssTwo' value="<? echo stripslashes($SettingArray->Assistant2);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Assistant Three</div>
<input type="text" name="txtAssThree" id='txtAssThree' value="<? echo stripslashes($SettingArray->Assistant3);?>"  style="width:320px;"/>
<div class="spacer"></div>
<input type="checkbox" id="txtEmailPostAsst" name="txtEmailPostAsst" value="1" <?php if ($SettingsArray->EmailPostAsst == 1) echo 'checked';?> />  
                                        
                                       </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
													
                        
                

</td></tr></table>  
<div class="spacer"></div>

        <input type="image" src="http://www.wevolt.com/images/wizard_save_btn.png" style="background:none; border:none;"/>&nbsp;<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php';" class="navbuttons" /><div style="height:5px;"></div></center><div class="spacer"></div>
<input type="hidden" value="save" name="action" />
</form>
