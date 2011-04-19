<div class="spacer"></div><div class="spacer"></div>

<? $GenreArray = explode(',',$SettingArray->genre);?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php?sub=info" method="post" name="settingform" id="settingform">
        <table cellspacing="10"><tr><td valign="top">



                         <table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="334" align="left">
<div class='sender_name'>Created By:</div>
<input type="text" name="txtCreator" id='txtCreator' value="<? echo stripslashes($SettingArray->creator);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Writer:</div>
<input type="text" name="txtWriter" id='txtWriter' value="<? echo stripslashes($SettingArray->writer);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Artist</div>
<input type="text" name="txtArtist" id='txtArtist' value="<? echo stripslashes($SettingArray->artist);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Colorist:</div>
<input type="text" name="txtColorist" id='txtColorist' value="<? echo stripslashes($SettingArray->colorist);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Inker:</div>
<input type="text" name="txtInker" id='txtInker' value="<? echo stripslashes($SettingArray->inker);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Lettering:</div>
<input type="text" name="txtLetterist" id='txtLetterist' value="<? echo stripslashes($SettingArray->letterist);?>"  style="width:100%;"/>
<div class="spacer"></div>
<div class='sender_name'>Synopsis</div>
<textarea name="txtSynopsis" id="txtSynopsis" style="width:280px;height:100px;"><? echo stripslashes($SettingArray->synopsis);?></textarea>
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
                                     <strong>   Genres</strong>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="5%"><input type="checkbox" id="g1" name="g1" value="Comedy" <?php if (in_array('Comedy',$GenreArray)) echo "checked"; ?> /></td>
                                            <td width="18%" class="grey_cmsboxcontent" style="font-size:10px;">Comedy</td>
                                            <td width="5%"><input type="checkbox" id="g2" name="g2" value="Fantasy" <?php if (in_array('Fantasy',$GenreArray)) echo "checked"; ?>/></td>
                                            <td width="20%" class="grey_cmsboxcontent" style="font-size:10px;">Fantasy</td>
                                            <td width="5%"><input type="checkbox" id="g3" name="g3" value="Horror" <?php if (in_array('Horror',$GenreArray)) echo "checked"; ?>/></td>
                                            <td width="21%" class="grey_cmsboxcontent" style="font-size:10px;">Horror</td>
                                            <td width="5%"><input type="checkbox" id="g4" name="g4" value="Sci-Fi" <?php if (in_array('Sci-Fi',$GenreArray)) echo "checked"; ?>/></td>
                                            <td width="21%" class="grey_cmsboxcontent" style="font-size:10px;">SciFi</td>
                                          </tr>
                                          <tr>
                                            <td><input type="checkbox" id="g5" name="g5" value="Parody" <?php if (in_array('Parody',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Parody</td>
                                            <td><input type="checkbox" id="g6" name="g6" value="Drama" <?php if (in_array('Drama',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Drama</td>
                                            <td><input type="checkbox" id="g7" name="g7" value="Western" <?php if (in_array('Western',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Western</td>
                                            <td width="5%"><input type="checkbox" id="g8" name="g8" value="Action" <?php if (in_array('Action',$GenreArray)) echo "checked"; ?>/></td>
                                            <td width="21%"  class="grey_cmsboxcontent" style="font-size:10px;">Action</td>
                                          </tr>
                                              <tr>
                                            <td><input type="checkbox" id="g9" name="g9" value="Realism" <?php if (in_array('Realism',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Realism</td>
                                            <td><input type="checkbox" id="g10" name="g10" value="Thriller" <?php if (in_array('Thriller',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Thriller</td>
                                            <td><input type="checkbox" id="g11" name="g11" value="Superhero" <?php if (in_array('Superhero',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Superhero</td>
                                            <td width="5%"><input type="checkbox" id="g12" name="g12" value="Adventure" <?php if (in_array('Adventure',$GenreArray)) echo "checked"; ?>/></td>
                                            <td width="21%" class="grey_cmsboxcontent" style="font-size:10px;">Adventure</td>
                                              </tr>
                                              <tr>
                                            <td><input type="checkbox" id="g13" name="g13" value="Noir"<?php if (in_array('Noir',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Noir</td>
                                            <td><input type="checkbox" id="g14" name="g14" value="Mystery" <?php if (in_array('Mystery',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Mystery</td>
                                            <td><input type="checkbox" id="g15" name="g15" value="Romance" <?php if (in_array('Romance',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">Romance</td>
                                            <td><input type="checkbox" id="g16" name="g16" value="War" <?php if (in_array('War',$GenreArray)) echo "checked"; ?>/></td>
                                            <td class="grey_cmsboxcontent" style="font-size:10px;">War</td>
                                              </tr>
                                        </table>
                                        <div class="spacer"></div>
                                       <strong> Tags</strong>
                                        <textarea name="txtTags" id="txtTags" style="width:320px;height:50px;"><? echo stripslashes($SettingArray->tags);?></textarea>
                                       <div class="spacer"></div>
<strong>Copyright Info</strong>
<input type="text" name="txtCopyright" id="txtCopyright" value="<? echo stripslashes($SettingArray->Copyright);?>" style="width:320px;">
<div class="spacer"></div>
 
Other Creators (put in WEvolt usernames)

<div class="spacer"></div>
<div class='sender_name'>Creator One</div>
<input type="text" name="txtCreator1" id='txtCreator1' value="<? echo stripslashes($SettingArray->CreatorOne);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Creator Two</div>
<input type="text" name="txtCreator2" id='txtCreator2' value="<? echo stripslashes($SettingArray->CreatorTwo);?>"  style="width:320px;"/>
<div class="spacer"></div>
<div class='sender_name'>Creator Three</div>
<input type="text" name="txtCreator2" id='txtCreator2' value="<? echo stripslashes($SettingArray->CreatorThree);?>"  style="width:320px;"/>
<div class="spacer"></div>

Superfan Pitch<br />
<em>(this will appear on the Superfan Page when a user click on your banner)</em>

<div class="spacer"></div>
<div class='sender_name'>Pitch</div>
<textarea  name="superfan_pitch" id='superfan_pitch' style="width:320px; height:100px;"/><? echo stripslashes($SettingArray->superfan_pitch);?></textarea>
                                        
                                         </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
													
                        
                

</td></tr></table>  



<input type="hidden" value="save" name="action" />
</form>
