<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 5;
//include_once($_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/includes/connect_functions.php');
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/mobile_app_functions_inc.php';
?><LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">
<body style="width:98%;"> 

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
                                        <div style="float:left">Mobile Downloads</div><div style="float:right;">edit or add new mobile wallpapers for your fans to send to their phone.</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                               

                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left">
                         
                
                         <div class="<? if($_GET['a'] != '') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if($_GET['a'] != '') {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/mobile_inc.php'><? }?>List Downloads<? if($_GET['a'] != '') {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                           <div class="<? if($_GET['a'] != 'new') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if($_GET['a'] == 'new') {?><? } else {?><a href="javascript:void(0)" onclick="parent.location.href='/cms/mobile/start/<? echo $_SESSION['safefolder'];?>/';"><? }?>New Download<? if($_GET['a'] == 'new') {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                
                        </td>
                        
                        
                        <td valign="top">

<?	
if ($_GET['a'] == '') {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/mobile_inc_html.php';
} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/mobile_edit_inc.php';
}  else if ($_GET['a'] == 'delete') {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/mobile_delete_inc.php';
}
						
?>
  </td>
                        </tr>
                        </table>
</body>