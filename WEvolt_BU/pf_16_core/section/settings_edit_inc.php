<div class="spacer"></div><div class="spacer"></div>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php" method="post" name="settingform" id="settingform">
        <table cellspacing="10"><tr><td valign="top">
   <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                       
<strong>General Project Settings</strong>
</div><div class="spacer"></div>


<input type="checkbox" id="txtComments" name="txtComments" value="1" <?php if ($SettingsArray->AllowComments == 1) echo 'checked';?> /> Allow Page Comments 
<div class="spacer"></div>
<input type="checkbox" id="txtPublicComments" name="txtPublicComments" value="1" <?php if ($SettingsArray->AllowPublicComents == 1) echo 'checked';?> />  Allow Anonymous Page Comments 
<div class="spacer"></div>

<input type="checkbox" id="txtEmailPost" name="txtEmailPost" value="1" <?php if ($SettingsArray->EmailPost== 1) echo 'checked';?> />  Allow Posting by Email
<? if ($SettingsArray->EmailPost== 1) {?><div class="spacer"></div>
<div class="messageinfo_black">&nbsp;&nbsp;<strong>POST CODE:</strong> <? echo $SettingsArray->PostCode;?></div>
<? }?>
<div class="spacer"></div>

<input type="checkbox" id="txtShowSchedule" name="txtShowSchedule" value="1" <?php if ($SettingsArray->ShowSchedule == 1) echo 'checked';?> /> Show Update Schedule <div class="spacer"></div

><?php if ($Transferred == 0){?>
 <div class="sender_name">
Panel Flow Transfer
</div>
<input type="checkbox" id="txtTransfer" name="txtTransfer" value="1"/>Transfer from NeedComics
<div class="spacer"></div>
<? }?>

<div class="spacer"></div>
Default Page<br />
<input type="radio" id="txtDefaultPage" name="txtDefaultPage" value="latest" <?php if ($SettingsArray->PageDefault == 'latest') echo 'checked';?> /> Latest Page&nbsp;&nbsp; <input type="radio" id="txtDefaultPage" name="txtDefaultPage" value="first" <?php if ($SettingsArray->PageDefault == 'first') echo 'checked';?> /> First Page
<div class="spacer"></div>
Default Reader Type

<input type="radio" id="txtReaderType" name="txtReaderType" value="flash" <?php if ($SettingsArray->ReaderType == 'flash') echo 'checked';?> />  Flash&nbsp;&nbsp;<input type="radio" id="txtReaderType" name="txtReaderType" value="html" <?php if ($SettingsArray->ReaderType == 'html') echo 'checked';?> />  Html (standard)
<div class="spacer"></div>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>

                        </td>
                        
                        <td valign="top"> 
                        
                        
                         <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
                                  
<div class="messageinfo">
Project Assistants (put in WEvolt usernames)
</div>
<div class="spacer"></div>
<div class='sender_name'>Assistant One</div>
<input type="text" name="txtAssOne" id='txtAssOne' value="<? echo stripslashes($SettingsArray->Assistant1);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Assistant Two</div>
<input type="text" name="txtAssTwo" id='txtAssTwo' value="<? echo stripslashes($SettingsArray->Assistant2);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Assistant Three</div>
<input type="text" name="txtAssThree" id='txtAssThree' value="<? echo stripslashes($SettingsArray->Assistant3);?>"  style="width:320px;"/>
<div class="spacer"></div>
<input type="checkbox" id="txtEmailPostAsst" name="txtEmailPostAsst" value="1" <?php if ($SettingsArray->EmailPostAsst == 1) echo 'checked';?> /> Allow Assistants Posting by Email  <div class="spacer"></div>
<div class='sender_name'>Link to buy on WOWIO</div>
<input type="text" name="wowio_link" id='wowio_link' value="<? echo stripslashes($SettingsArray->wowio_link);?>"  style="width:320px;"/>
     </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
													
                        
                

</td></tr></table>  
<div class="spacer"></div>

<input type="hidden" value="save" name="action" />
</form>
