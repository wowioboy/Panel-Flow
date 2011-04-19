<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/settings_app_functions_inc.php';
?>
<link href="/<? echo $_SESSION['pfdirectory'];?>/css/cal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/<? echo $_SESSION['pfdirectory'];?>/scripts/cal.js"></script> 
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
<script type="text/javascript">
function submit_form() {
document.settingform.submit();	
}


</script>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">
<body style="width:98%;"> 
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td></td><td><table width="720" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="704" align="left">
                                        <div style="float:left">Settings</div><div style="float:right;">pop up the hood and get dirty</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table><div class="spacer"></div></td></tr>
<tr>
<td valign="top" align="left">
   <div class="<? if(($_GET['a'] == 'edit') && ($_GET['sub'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>" style="cursor:pointer;">
  <div class="spacer"></div>
  <? if(($_GET['a'] == 'edit') && ($_GET['sub'] == '')) {?><? } else {?>
                        <a href='/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php?a=edit'><? }?>Edit Settings<? if(($_GET['a'] == 'edit') && ($_GET['sub'] == '')) {?><? } else {?></a> <? }?>
                       </div>
                          <div class="spacer"></div>
                       <div class="<? if(($_GET['a'] == 'edit') && ($_GET['sub'] == 'info')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>" style="cursor:pointer;">
  <div class="spacer"></div>
  <? if(($_GET['a'] == 'edit') && ($_GET['sub'] == 'info')) {?><? } else {?>
                       <a href='/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php?a=edit&sub=info'><? }?>Edit Info<? if(($_GET['a'] == 'edit') && ($_GET['sub'] == 'info')) {?><? } else {?></a> <? }?>
                       </div><div class="spacer"></div>
                         <div class="cms_blue_button_off" style="cursor:pointer;">
  <div class="spacer"></div>
  
                     <a href="/<? echo $_SESSION['pfdirectory'];?>/includes/crop_form_inc.php?a=edit&pid=<? echo $_SESSION['sessionproject'];?>&s=<? echo $_SESSION['safefolder'];?>&u=<? echo $_SESSION['projectfolder'];?>">Edit Thumb</a>
                       </div>
         <? if ($_GET['a'] == 'edit') {?>   <div class="spacer"></div>           
               <img src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg" onClick="submit_form();" class="navbuttons"/>
<div class="spacer"></div>
<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg" class="navbuttons" onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/settings_inc.php';" />        
                       
               <? }?>        
       
</td>
<td>
<div align="center">
<?	
if (($_GET['a'] == '') && ($_GET['sub'] == '')) {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/settings_inc_html.php';
} else if (($_GET['a'] == 'edit') && ($_GET['sub'] == '') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/settings_edit_inc.php';
} else if (($_GET['a'] == 'edit') && ($_GET['sub'] == 'info') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/settings_info_edit_inc.php';
} 
						
?>
</div>

</td>
</tr>
</table>
