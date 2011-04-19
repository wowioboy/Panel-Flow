<table>
<tr><td></td><td> <table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
	<td id="blue_cmsBox_TL"></td>
	<td id="blue_cmsBox_T"></td>
	<td id="blue_cmsBox_TR"></td></tr>
	<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
		<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
          <div style="float:left">Design</div><div style="float:right;">Themes</div>
 		</td>
        <td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>
	</tr>
    <tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
	<td id="blue_cmsBox_BR"></td>
	</tr></tbody></table>
     <div class="spacer"></div></td></tr>
<tr><td valign="top">
						<div class="<? if ($_GET['sa'] == 'new') echo 'cms_blue_button_active'; else echo 'cms_blue_button_off';?>"><div class="spacer"></div>
                        <? if ($_GET['sa'] != 'new'){?><a href="/cms/admin/?t=themes&section=themes&sa=new"><? }?>New Theme <? if ($_GET['sa'] != 'new'){?></a> <? }?>
                       </div>
                          <div class="spacer"></div>
                      <div class="<? if ($_GET['st'] == 'my') echo 'cms_blue_button_active'; else echo 'cms_blue_button_off';?>"><div class="spacer"></div>
                       <? if ($_GET['st'] != 'my'){?><a href="/cms/admin/?t=themes&section=themes&st=my"><? }?>My Themes<? if ($_GET['st'] != 'my'){?></a> <? }?>
                       </div>
                          <div class="spacer"></div>
                      <div class="<? if ($_GET['st'] == 'w3') echo 'cms_blue_button_active'; else echo 'cms_blue_button_off';?>"><div class="spacer"></div>
                       <? if ($_GET['st'] != 'w3'){?><a href="/cms/admin/?t=themes&section=themes&st=w3"><? }?>WEvolt Themes<? if ($_GET['st'] != 'w3'){?></a> <? }?>

                       </div>
                          <div class="spacer"></div>
                      <div class="<? if ($_GET['st'] == 'community') echo 'cms_blue_button_active'; else echo 'cms_blue_button_off';?>"><div class="spacer"></div>
                      <? if ($_GET['st'] != 'community'){?><a href="/cms/admin/?t=themes&section=themes&st=community"><? }?>Community Themes<? if ($_GET['st'] != 'community'){?></a> <? }?>
                        
                       </div></td><td>
                       
                       
<div id="pagelisting" align="center">
<div class="grey_text" align="right"><b>Total Themes: </b><? echo $PageCount;?>&nbsp;&nbsp;</div>
<div class="spacer"></div>
<? if ($PageCount == 0) {?>
	<div class="warning" style="padding-top:50px;">
   <?  if ($_GET['st'] == 'project') { ?>
   			You have not set up your project's theme yet. Select the Community or WEvolt tabs at the top to browse themes that you can use. Or you can just start from scratch and create a <a href="/cms/edit/<? echo $SafeFolder;?>/?t=design&section=themes&sa=new">NEW</a> one
   
   <? } else  if ($_GET['st'] == 'my') {?>
		You have not created any Themes yet. 
        Create a <a href="/cms/admin/?t=themes&section=themes&sa=new">NEW</a> theme now!  
     <? }?>   
      </div>
      
      <div style="height:250px;"></div>
  <? } else {
  		echo $PostString;
	}?>

</div>
                       </td></tr>
 
</table>

