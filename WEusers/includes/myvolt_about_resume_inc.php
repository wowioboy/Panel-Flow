      
       <!--RESUME-->
					<? if (($Resume != '')|| ($IsOwner)) {?>
                    <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-175);?>'>
                        <tr>
                            <td width="9" id="updateBox_TL"></td>
                            <td width="<? echo( $_SESSION['contentwidth']-186);?>" id="updateBox_T"></td>
                            <td width="21" id="updateBox_TR"></td>
                       </tr>
                       <tr>
                			<td valign='top' class="updateboxcontent" colspan="3">
                            <div style="padding:5px;">
                                 <img src="http://www.wevolt.com/images/resume_header.png" />
                                 <table width="100%"><tr>
                                  <? if ($IsOwner) {?> <td>
                                 <? if ($IsOwner) {?><div class="spacer"></div>
                                 Upload your professional resume (must be in .DOC or PDF format)<div class="spacer"></div>
                                 <input type="file" name="txtResume" onChange="show_save();"/>
                                 <? }?>
                                 
                                 </td>
                                 <? }?>
                                 <td width="269" align="left">
                                 <? if ($Resume != '') {?>
                                 <a href="<? echo $Resume;?>" target="_blank"><img src="http://www.wevolt.com/images/blue_download_box.png" border="0"/></a>
                                 <? }?>
                                 </td>
                                   <? if ($IsOwner) {
									   $iPrivacy = 'ResumePrivacy';
									   ?>
                                   <td>
                                   <div class="spacer"></div>
                                   <img src="http://www.wevolt.com/images/privacy_title.png" /><br />

                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    </td>
                                    <? }?>
                                 </tr>
                                 </table>
                              </div>
    						</td>
                        </tr>
                        <tr>
                           <td id="updateBox_BL"></td>
                           <td id="updateBox_B"></td>
                           <td id="updateBox_BR"></td>
                        </tr>
                      </table>
                    <? }?>
                    <div class="spacer"></div>
              <!--Work History-->      
                    <? if (($WorkHistory != '')|| ($IsOwner)) {?>
                        
                    <? 	  $iPrivacy = 'WorkHistoryPrivacy';?>
                              <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-175);?>'>
                        <tr>
                            <td width="9" id="updateBox_TL"></td>
                            <td width="<? echo( $_SESSION['contentwidth']-186);?>" id="updateBox_T"></td>
                            <td width="21" id="updateBox_TR"></td>
                       </tr>
                       <tr>
                			<td valign='top' class="updateboxcontent" colspan="3">
                                 <div style="padding:5px;">
                                <table>
                                <tr>
                                <td valign="top" style="padding-right:15px;">
                                <img src="http://www.wevolt.com/images/work_history.png" />
                                   <? if ($IsOwner) {?>
                                   <div class="spacer"></div>
                                   <img src="http://www.wevolt.com/images/privacy_title.png" /><br />
<div class="spacer"></div>
                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    <? }?>
                                </td>
                                <td class="dark_blue_text">
                               <? if ($IsOwner) {?><textarea name="txtWorkHistory" style="width:<? echo( $_SESSION['contentwidth']-290);?>px; height:150px;" onChange="show_save();"><? echo $WorkHistory;?></textarea><? } else {echo nl2br($WorkHistory);}?>
                                </td>
                                    
                      </tr></table></div>
                      
    						</td>
                        </tr>
                        <tr>
                           <td id="updateBox_BL"></td>
                           <td id="updateBox_B"></td>
                           <td id="updateBox_BR"></td>
                        </tr>
                      </table>
                      <? }?>
                      
                        <div class="spacer"></div>
              		<!--Education History-->      
                    <? if (($Education != '')|| ($IsOwner)) {?>
                        
                    <? 	  $iPrivacy = 'EducationPrivacy';?>
                              <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-175);?>'>
                        <tr>
                            <td width="9" id="updateBox_TL"></td>
                            <td width="<? echo( $_SESSION['contentwidth']-186);?>" id="updateBox_T"></td>
                            <td width="21" id="updateBox_TR"></td>
                       </tr>
                       <tr>
                			<td valign='top' class="updateboxcontent" colspan="3">
                                 <div style="padding:5px;">
                                <table>
                                <tr>
                                <td valign="top" style="padding-right:15px;">
                                <img src="http://www.wevolt.com/images/education_header.png" />
                                   <? if ($IsOwner) {?>
                                   <div class="spacer"></div>
                                   <img src="http://www.wevolt.com/images/privacy_title.png" /><br />
<div class="spacer"></div>
                                      <select name="txt<? echo $iPrivacy;?>" onChange="show_save();">
                                    <option  value='private' <? if (${$iPrivacy} == 'private') echo 'selected';?>>Private</option>
                                    <option  value='fans' <? if (${$iPrivacy} == 'fans') echo 'selected';?>>Fans</option>
                                    <option  value='friends' <? if (${$iPrivacy} == 'friends') echo 'selected';?>>Friends</option>
                                    <option  value='public' <? if ((${$iPrivacy} == 'public')||(${$iPrivacy} == '')) echo 'selected';?>>Public</option>
                                    </select>
                                    <? }?>
                                </td>
                                <td class="dark_blue_text">
                               <? if ($IsOwner) {?><textarea name="txtEducation" style="width:<? echo( $_SESSION['contentwidth']-300);?>px; height:100px;" onChange="show_save();"><? echo $Education;?></textarea><? } else {echo nl2br($WorkHistory);}?>
                                </td>
                                    
                      </tr></table></div>
                      
    						</td>
                        </tr>
                        <tr>
                           <td id="updateBox_BL"></td>
                           <td id="updateBox_B"></td>
                           <td id="updateBox_BR"></td>
                        </tr>
                      </table>
                      <? }?>
                      
                      <!--Work For Hire Settings-->      
                      <div class="spacer"></div>
                    <? if ((($UDataArray->WorkForHire != '') && ($UDataArray->WorkForHire != '0'))|| ($IsOwner)) {?>
                        
                                <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-175);?>'>
                        <tr>
                            <td width="9" id="updateBox_TL"></td>
                            <td width="<? echo( $_SESSION['contentwidth']-186);?>" id="updateBox_T"></td>
                            <td width="21" id="updateBox_TR"></td>
                       </tr>
                       <tr>
                			<td valign='top' class="updateboxcontent" colspan="3">
                                 <div style="padding:5px;">
                                <table>
                                <tr>
                             
                                <td class="dark_blue_text">
                                 
                      <div class="spacer"></div>                           
<img src="http://www.wevolt.com/images/work_for_hire.png" /><div class="spacer"></div>
 <? if ($IsOwner) {?>
<div class="blue_text"><strong>Available for contract / Work For Hire</strong></div>

<input type="radio" name="txtWorkForHire" value="0"  onChange="show_save();" <? if (($UDataArray->WorkForHire == '')||($UDataArray->WorkForHire == '0')) echo 'checked';?>>&nbsp;&nbsp;No I am not available&nbsp;&nbsp;<br />
<input type="radio" name="txtWorkForHire" value="1"onChange="show_save();" <? if ($UDataArray->WorkForHire == '1') echo 'checked';?>>&nbsp;&nbsp;Yes I am available to work<br>
<? } else {
	if ($UDataArray->WorkForHire == '1')
		echo 'I am available for Work for Hire';
 }?>
 
 <? if (($UDataArray->WorkForHire == '1') || ($IsOwner)) {?>
<div class='spacer'></div>
<div class="blue_text"><strong>Main Skill/Talent<br /></strong></div>
<? if ($IsOwner) {?>
<select name="txtMainService" onChange="show_save();">
<option value="">SELECT YOUR MAIN SERVICE</option>
<option value="all_artist" <? if ($UDataArray->MainService == 'all_artist') echo 'selected';?>>All in One Artist (Pencils/Inks/Colors)</option>
<option value="penciler" <? if ($UDataArray->MainService == 'penciler') echo 'selected';?>>Pencils</option>
<option value="inker" <? if ($UDataArray->MainService == 'inker') echo 'selected';?>>Inker</option>
<option value="colorist" <? if ($UDataArray->MainService == 'colorist') echo 'selected';?>>Colorist</option>
<option value="letterist" <? if ($UDataArray->MainService == 'letterist') echo 'selected';?>>Letterist</option>
<option value="storyboards" <? if ($UDataArray->MainService == 'storyboards') echo 'selected';?>>Storyboards</option>
<option value="digital_painter" <? if ($UDataArray->MainService == 'digital_painter') echo 'selected';?>>Digital Painter</option>
<option value="illustrations" <? if ($UDataArray->MainService == 'illustrations') echo 'selected';?>>Illustrations/Covers</option>
<option value="layouts" <? if ($UDataArray->MainService == 'layouts') echo 'selected';?>>Book Layouts</option>
<option value="writer" <? if ($UDataArray->MainService == 'writer') echo 'selected';?>>Writer</option>
<option value="editor" <? if ($UDataArray->MainService == 'editor') echo 'selected';?>>Editor (books/comics)</option>
<option value="promotions" <? if ($UDataArray->MainService == 'promotions') echo 'selected';?>>Promoter/Marketing</option>
<option value="musician" <? if ($UDataArray->MainService == 'musician') echo 'selected';?>>Musicician</option>
<option value="editor_video" <? if ($UDataArray->MainService == 'editor_video') echo 'selected';?>>Editor (video)</option>
<option value="3danimator" <? if ($UDataArray->MainService == '3danimator') echo 'selected';?>>3d Animator</option>
<option value="cell_animator" <? if ($UDataArray->MainService == 'cell_animator') echo 'selected';?>>Cell Animator</option>
<option value="flash_animator" <? if ($UDataArray->MainService == 'flash_animator') echo 'selected';?>>Flash Animator</option>
<option value="programmer" <? if ($UDataArray->MainService == 'programmer') echo 'selected';?>>Programmer</option>
<option value="designer" <? if ($UDataArray->MainService == 'designer') echo 'selected';?>>Designer</option>
</select>
<? } else {
	switch ($UDataArray->MainService) {
			case 'all_artist':
				echo  'All in One Artist (Pencils/Inks/Colors)';
				break;
			case 'penciler':
				echo  'Pencils';
				break;
			case 'inker':
				echo  'Inker';
				break;
			case 'colorist':
				echo  'Colorist';
				break;
			case 'letterist':
				echo  'Letterer';
				break;
			case 'storyboards':
				echo  'Storyboards';
				break;
			case 'digital_painter':
				echo  'Digital Painter';
				break;
			case 'illustrations':
				echo  'Illustrations / Covers';
				break;
			case 'layouts':
				echo  'Book Layouts';
				break;
			case 'writer':
				echo  'Writer';
				break;
			case 'editor':
				echo  'Editor';
				break;
			case 'promotions':
				echo  'Promoter/Marketing';
				break;
			case 'musician':
				echo  'Musician';
				break;
			case 'editor_video':
				echo  'Editor (video)';
				break;
			case '3danimator':
				echo  '3D Animator';
				break;
			case 'flash_animator':
				echo  'Flash Animator';
				break;
			case 'programmer':
				echo  'Programmer';
				break;
			case 'designer':
				echo  'Designer';
				break;

	}

}?>
<div class='spacer'></div>
<div class="blue_text"><strong>Rates Description<br /></strong></div><? if ($IsOwner) {?>Please give as much detail on your wage breakdown here. If you work on a page rate, please put all the types of rates for example (color, B/W, etc)<br /><?}?>

 <? if ($IsOwner) {?><textarea name="txtRates" style="width:300px;height:50px;" onChange="show_save();"><? echo $UDataArray->Rates;?></textarea><? } else {echo nl2br($UDataArray->Rates);}?>
<div class='spacer'></div>
<div class="blue_text"><strong>Other Services</strong></div><? if ($IsOwner) {?>Many of us are Jacks-of-all trades, so if you want to find work that is outside your main service, include that here. Be descriptive as possible. <br /><? }?>
 <? if ($IsOwner) {?><textarea name="txtOtherServices" style="width:300px;height:50px;" onChange="show_save();"><? echo $UDataArray->OtherServices;?></textarea><? } else {echo nl2br($UDataArray->OtherServices);}?>
<div class='spacer'></div>
 <? if ($IsOwner) {?>
<div class="blue_text"><strong>Work for WEvolt</strong></div><div class="spacer"></div>
If you would like to work for wevolt, please check the box below and we will review your information and let you know your approval status asap. If you do get picked to become a studio artist an agreement will need to be signed and all potential work will first have to go through the studio. If you have clients interested in using you, just have them contact us to schedule you.<br />
<br />

<input type="checkbox" name="txtIsStudio" value="1" onChange="show_save();" <? if ($UDataArray->IsStudio == 1) echo 'checked';?> />&nbsp;&nbsp;Yes I would like to submit my information to become a wevolt studio contractor.
<? }?>
<div class='spacer'></div>
<? }?>
            
                                </td>
                                    
                      </tr></table></div>
                      
    						</td>
                        </tr>
                        <tr>
                           <td id="updateBox_BL"></td>
                           <td id="updateBox_B"></td>
                           <td id="updateBox_BR"></td>
                        </tr>
                      </table>
                      <? }?>
                      
                     
                      