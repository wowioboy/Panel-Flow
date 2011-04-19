<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 5; 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/content_functions.php');
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/blog_app_functions_inc.php';?>
<link href="/<? echo $_SESSION['pfdirectory'];?>/css/cal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/<? echo $_SESSION['pfdirectory'];?>/scripts/cal.js"></script> 
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<LINK href="http://www.wevolt.com/<? echo $_SESSION['pfdirectory'];?>/css/cms_css.css" rel="stylesheet" type="text/css">

<script src="http://www.wevolt.com/js/jquery-1.4.2.min.js"></script>
<script src="http://www.wevolt.com/scripts/modal-window.min.js"></script>
<? 

				echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"http://www.wevolt.com/css/modal-window.css\" />";
			

?>

<script type="text/javascript">
function delete_cat(value) {
	var answer = confirm('Are you sure you want to delete this category?');
	if (answer) {
		
		document.location.href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?cid='+value+'&sub=cat&section=<? echo $Section;?>&a=delete';
	}

}
function delete_post(value) {
	var answer = confirm('Are you sure you want to delete this post?');
	if (answer) {
		document.location.href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?postid='+value+'&section=<? echo $Section;?>&a=delete';
	}
	
}
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
                                        <div style="float:left">Blog</div><div style="float:right;">edit or create blog entries and categories</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                               

                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left">
                         
                
                         <div class="<? if(($_GET['a'] == '') && ($_GET['sub'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == '') && ($_GET['sub'] == '')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php'><? }?>List Entries<? if(($_GET['a'] == '') && ($_GET['sub'] == '')) {?><? } else {?></a><? }?>
                       </div>
                       <div class="spacer"></div>

                       <div class="<? if(($_GET['a'] == 'new') && ($_GET['sub'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == 'new') && ($_GET['sub'] == '')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?a=new'><? }?>New Entry<? if(($_GET['a'] == 'new') && ($_GET['sub'] == '')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
 <div class="<? if(($_GET['a'] == 'new') && ($_GET['sub'] == 'cat')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == 'new') && ($_GET['sub'] == 'cat')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?a=new&sub=cat'><? }?>New Category<? if(($_GET['a'] == 'new') && ($_GET['sub'] == 'cat')) {?><? } else {?></a><? }?>
                       </div>
                         <div class="spacer"></div>
 <div class="<? if(($_GET['a'] == '') && ($_GET['sub'] == 'cat')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == '') && ($_GET['sub'] == 'cat')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat'><? }?>List Categories<? if(($_GET['a'] == '') && ($_GET['sub'] == 'cat')) {?><? } else {?></a><? }?>
                       </div>

  <? /*
                         <div class="<? if ($_GET['sa'] != 'new') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><? if ($_GET['sa'] != 'new') {?><a href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=new"><? }?>New Content<br />Section<? if ($_GET['sa'] != 'new') {?></a><? }?>
                       </div>
                          <div class="spacer"></div><? */?>
                
                        </td>
                        
                        
                        <td valign="top">




<?	



	if (($_GET['a'] == '') && ($_GET['sub'] == '')) {
							include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/blog_inc_html.php'; 
	} else if ((($_GET['a'] == 'edit')||($_GET['a'] == 'new')) && ($_GET['sub']=='')) { 
							include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/includes/blog_edit_inc.php';
	} else if ((($_GET['a'] == 'edit')||($_GET['a'] == 'new')) && ($_GET['sub']!= '')) { 
							include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/includes/blog_edit_cat_inc.php';

	}  else if ($_GET['sub'] == 'cat') { 
							include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/blog_cats_html_inc.php';
	}
					
?>
<script type="text/javascript" src="http://www.wevolt.com/js/piroBox.1_2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$().piroBox({
			my_speed: 600, //animation speed
			bg_alpha: 0.5, //background opacity
			radius: 4, //caption rounded corner
			scrollImage : false, // true == image follows the page, false == image remains in the same open position
			pirobox_next : 'piro_next', // Nav buttons -> piro_next == inside piroBox , piro_next_out == outside piroBox
			pirobox_prev : 'piro_prev',// Nav buttons -> piro_prev == inside piroBox , piro_prev_out == outside piroBox
			close_all : '.piro_close',// add class .piro_overlay(with comma)if you want overlay click close piroBox
			slideShow : '', // just delete slideshow between '' if you don't want it.
			slideSpeed : 4 //slideshow duration in seconds(3 to 6 Recommended)
	});
});
</script>


 </td>
                        </tr>
                        </table>
</body>
