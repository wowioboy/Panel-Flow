  <table width="96%" cellspacing="3">
                         <tr>
                         
                         <td></td>
                         
                         <td>
                         
                         <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
                                        <div style="float:left">Content</div><div style="float:right;">edit or create content sections for your site.</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                        
                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left"><div class="<? if ($_GET['sa'] != 'new') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="mdspacer"></div><? if ($_GET['sa'] != 'new') {?><a href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=new"><? }?>New Content<br />Section<? if ($_GET['sa'] != 'new') {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                     <div class="grey_text" align="center"><b>Total Sections: </b><br />

<? echo $PageCount;?></div>
                      <div class="spacer"></div>
    <table width="109" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="93" align="left">
<b>ABOUT <br />
THE CONTENT <br />
SECTION</b>  <div class="spacer"></div>
<div style="border-bottom:dotted 1px #bababa;"></div>    <div class="spacer"></div>
This is where you come to edit and add new content. Once you've finished the design of the site, this should be the area you will use the most.<br />
    <div class="spacer"></div>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        </td>
                        
                        
                        <td valign="top">
                


<? if ($PageCount == 0)
	echo '<div class="messageinfo_black" style="padding-top:50px;">There are currently no content sections for this project.</div><div class="spacer"></div><div align="center"><a href="/cms/edit/'.$SafeFolder.'/?tab=content&sa=new"><img src="/images/cms/create_btn.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $PostString;?>


                        
                        </td>
                        </tr>
                        </table>
          

