<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/content_functions.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 5;
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/gallery_app_functions_inc.php';
?>

<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">

<script src="http://www.wevolt.com/js/jquery-1.4.2.min.js"></script>
<script src="http://www.wevolt.com/scripts/modal-window.min.js"></script>
<link type="text/css" rel="stylesheet" href="http://www.wevolt.com/css/modal-window.css" />

<script type="text/javascript">

function story_flow(cid,ctype,edit){
	$(this).modal({width:700, height:500,src:"/connectors/story_flow.php?cid="+cid+"&ctype="+ctype+"&edit="+edit}).open(); 
}
</script>

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
                                        <div style="float:left">Gallery</div><div style="float:right;">edit or add new galleries to use as extra content or portfolios</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                               

                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left">
                         
                
                         <div class="<? if(($_GET['a'] == '')  && ($_GET['sub'] =='')){?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == '') && ($_GET['sub'] =='')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php'><? }?>List Galleries<? if (($_GET['a'] == '') && ($_GET['sub'] =='')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                           <div class="<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == 'new') && ($_GET['sub'] =='')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?a=new'><? }?>New Gallery<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
               
                 <div class="<? if (($_GET['a'] == '') && ($_GET['sub'] =='item')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == '') && ($_GET['sub'] =='item')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=item'><? }?>List Content<? if (($_GET['a'] == '') && ($_GET['sub'] =='item')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                          <div class="<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='item')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == 'new') && ($_GET['sub'] =='item')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=item&a=new'><? }?>Add Content<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='item')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                           <div class="<? if (($_GET['a'] == '') && ($_GET['sub'] =='cat')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == '') && ($_GET['sub'] =='cat')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=cat'><? }?>Categories<? if (($_GET['a'] == '') && ($_GET['sub'] =='cat')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                           <div class="<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='cat')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['a'] == 'new') && ($_GET['sub'] =='cat')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/gallery_inc.php?sub=cat&a=new'><? }?>Add Category<? if (($_GET['a'] == 'new') && ($_GET['sub'] =='item')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>

                        </td>
                        
                        
                        <td valign="top">

<?	
 if ($_GET['sub'] != '') {
		if ($_GET['sub'] == 'cat') {
				if ($_GET['a'] == '') {
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_cat_inc_html.php';
				} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_cat_edit_inc.php';
				}  else if (($_GET['a'] == 'delete') || ($_GET['a'] == 'remove')) {
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_cat_delete_inc.php';
				}
		
		} else if ($_GET['sub'] == 'item') {
				if ($_GET['a'] == '') {
				
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_item_inc_html.php';
				} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_item_edit_inc.php';
				}  else if ($_GET['a'] == 'delete') {
					include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_item_delete_inc.php';
				}
		}
} else {

	if ($_GET['a'] == '') {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_inc_html.php';
	} else if (($_GET['a'] == 'edit') || ($_GET['a'] == 'new')) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_edit_inc.php';
	}  else if (($_GET['a'] == 'delete') || ($_GET['a'] == 'remove')) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/gallery_delete_inc.php';
	}
}						
?>
  </td>
                        </tr>
                        </table>
</body>