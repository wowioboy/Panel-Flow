
<table cellpadding="0" cellspacing="0"><tr>
<td valign="top">


        <table border='0' cellspacing='0' cellpadding='0' width='<? if ($IsOwner) echo '369'; else echo '575';?>'>
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="<? if ($IsOwner) echo '353'; else echo '591';?>" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign='top' class="updateboxcontent" colspan="3">
                               
                             
<table cellpadding="0" cellspacing="5" border="0" width="100%">
                            	<tr>
                                <td align="left" colspan="<? if ($IsOwner) {?>2<? } else {?>2<? }?>" width="300"> <img src="http://www.wevolt.com/images/personal_details.png" vspace="5"/>
                                </td>
                                <? if ($IsOwner) {?>
                                <td width="80">&nbsp;&nbsp;<img src="http://www.wevolt.com/images/privacy_title.png" vspace="5"/>
                                </td>
                                <? }?>
                                </tr>
                              
							  <? if (($Sex != '')|| ($IsOwner)) {
							  $iPrivacy = 'SexPrivacy';?>
                                <tr>
                                	<td class="profileInfoHeader" width="80">Gender
                                    </td>
                                    <td class="profileInfobox" width="180"><? if ($IsOwner) {?><select name="txtSex" style="width:100%;" onChange="show_save();">
                                    		<option value="M" <? if (($Sex == 'm') || ($Sex == 'M'))  echo 'selected';?>>Male</option>
                                        	<option value="F" <? if (($Sex == 'f') || ($Sex == 'F'))  echo 'selected';?>>Female</option>
                                        </select><? } else {echo $Sex;}?>
                                    </td>
                                      <? if ($IsOwner) {?>
                                   <td class="profilePrivacy" width="80">
                                     <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    
                                    </td>
                                    <? }?>
                                </tr>
                                <? }?>
									
                                 <? if (($BirthdayMonth != '') || ($IsOwner)) {
							  $iPrivacy = 'BirthdayPrivacy';?>
                                <tr>
                                	<td class="profileInfoHeader" width="80">Birthday 
                                    </td>
                                    <td class="profileInfobox" width="180">
									<? if ($IsOwner) {?>
                                    <table><tr><td><SELECT NAME='txtBdayMonth' class='inputstyle' onChange="show_save();"><?
								  for ( $i=1; $i<13; $i++ ) {
									echo "<OPTION VALUE='".$i."'";
									if ($BirthdayMonth ==$i) { 
										echo "selected";
									}
									echo ">".date("M", mktime(1,1,1,$i,1,1) )."</OPTION>";
								  }
								  ?></SELECT>
                                  </td>
                                  <td style="padding-left:5px;"><select name='txtBdayDay'  class='inputstyle' onChange="show_save();"><?
									for ($i=1; $i<32; $i++) {
									  echo "<OPTION VALUE='".$i."'";
									  if ($BirthdayDay == $i) {
										echo "selected";
										}
									 echo ">".$i."</OPTION>";
									}
								  ?></select>
                                  </td>
                                  <td style="padding-left:5px;"><select name='txtBdayYear'  class='inputstyle' onChange="show_save();"><?
									
									for ($i=date("Y")+1; $i>=(date("Y")-40); $i--) {
								
									echo "<OPTION VALUE='".$i."'";
									  if ($BirthdayYear == $i) {
										echo "selected";
										}
										echo ">".$i."</OPTION>";
									}
								  ?></select>
                                  </td>
                                  </tr>
                                  </table>
								  <? } else {echo $BirthdayMonth.'-'.$BirthdayDay.'-'.$BirthdayYear;}?>
                                   
                                    </td>
                                    
                                      <? if ($IsOwner) {?>
                                   <td class="profilePrivacy" width="80">
                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    
                                    </td>
                                    <? }?>
                                </tr>
                                <? }?>    
                                    
                                <? if (($HometownLocation != '')|| ($IsOwner)) {
							  $iPrivacy = 'HometownLocationPrivacy';?>
                                <tr>
                                	<td class="profileInfoHeader" width="80">Hometown:
                                    </td>
                                    <td class="profileInfobox" width="180"><? if ($IsOwner) {?><input type="text" name="txtHometown" style="width:100%;" value="<? echo $HometownLocation;?>" onChange="show_save();"><? } else {echo $HometownLocation;}?>
                                    </td>
                                      <? if ($IsOwner) {?>
                                   <td class="profilePrivacy" width="80">
                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    
                                    </td>
                                    <? }?>
                                </tr>
                                <? }?>

                                 <? if (($Location != '') || ($IsOwner)) {
							  $iPrivacy = 'LocationPrivacy';?>
                                <tr>
                                	<td class="profileInfoHeader" width="80">Current <br />
Location:
                                    </td>
                                    <td class="profileInfobox" width="180"><? if ($IsOwner) {?><input type="text" name="txtLocation" style="width:100%;" value="<? echo $Location;?>" onChange="show_save();"><? } else {echo $Location;}?>
                                    </td>
                                      <? if ($IsOwner) {?>
                                   <td class="profilePrivacy" width="80">
                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    
                                    </td>
                                    <? }?>
                                </tr>
                                <? }?>

                            </table>
                               </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>
</td>
<? if ($IsOwner) {?>
<td style="padding-left:5px;padding-right:5px;">

        <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-555);?>'>
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="<? echo( $_SESSION['contentwidth']-571);?>" id="updateBox_T"></td>
                        <td  id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign='top' class="updateboxcontent" colspan="3">
       
               
                    <div class="light_blue_text_sm" align="left" style="padding:5px; height:175px;">
                       
                              When people click on your ABOUT page, their relationship to you determines what they see.<div class="spacer"></div>


PRIVATE: Only you see this.<div class="spacer"></div>


FRIENDS: Only your friends can see this.<div class="spacer"></div>


FANS: Friends and fans can see this. <div class="spacer"></div>


PUBLIC: Anyone can see this.                
                       
                    
                    </div>
                </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>
</td>
<? }?>
</tr>
</table>
