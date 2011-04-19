<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/init.php';
include_once($_SERVER['DOCUMENT_ROOT']."/".$_SESSION['pfdirectory']."/classes/pagination.php");  // include main class filw which creates pages
$ProjectID = $_SESSION['sessionproject'];
$UserID = $_SESSION['userid'];
$NumItemsPerPage = $_GET['c'];
if ($NumItemsPerPage == '')
	$NumItemsPerPage = 7;
include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/processing/pages_app_functions_inc.php';
?>
<link href="/<? echo $_SESSION['pfdirectory'];?>/css/cal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/<? echo $_SESSION['pfdirectory'];?>/scripts/cal.js"></script> 
<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
<LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function switch_episode(series,episode) {
		document.location.href='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series='+series+'&ep='+episode;
}

function switch_series(series) {
		var redir = '/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series='+series;
		var sub = '<? echo $_GET['sub'];?>';
		if (sub != '')
			redir = redir +'&sub='+sub;
		document.location.href=redir;
}


</script>
<script src="http://www.wevolt.com/js/jquery-1.4.2.min.js"></script>
<script src="http://www.wevolt.com/scripts/modal-window.min.js"></script>
<link type="text/css" rel="stylesheet" href="http://www.wevolt.com/css/modal-window.css" />

<script type="text/javascript">

function story_flow(cid,ctype,edit){
	$(this).modal({width:700, height:500,src:"/connectors/story_flow.php?cid="+cid+"&ctype="+ctype+"&edit="+edit}).open(); 
}
</script>

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
                                        <div style="float:left">Pages</div><div style="float:right;">edit or add new pages to your Reader section.</div>
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
                        
                        <div class="spacer"></div>
                               

                        </td></tr>
                        
                        
                        
                         <tr>
                         
                         <td valign="top" align="left">
                         
                
                         <div class="<? if(($_GET['a'] != '') || ($_GET['sub'] != '')) {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if(($_GET['a'] != '') || ($_GET['sub'] != '')) {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>'><? }?>List Pages<? if(($_GET['a'] != '') || ($_GET['sub'] != '')) {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                          <div class="<? if(($_GET['a'] == 'new') &&($_GET['sub'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == 'new') &&($_GET['sub'] == '')) {?><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?a=new&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>'><? }?>Add Page<? if(($_GET['a'] == 'new') &&($_GET['sub'] == '')) {?><?} else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                          <? if ($_SESSION['projecttype'] != 'writing') {?> 
                           <div class="<? if ($_GET['a'] != 'batch') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if ($_GET['a'] != 'batch') {?><a href="javascript:void(0)" onClick="parent.window.location.href='/cms/batch/<? echo $_SESSION['safefolder'];?>/?section=pages&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>';"><? }?>Batch Upload<? if ($_GET['a'] != 'batch') {?></a><? }?>
                       </div>
                        <div class="spacer"></div>
                       <? }?>
                        <div class="<? if($_GET['sub'] != 'chapters') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><div class="spacer"></div><? if($_GET['sub'] != 'chapters') {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=chapters&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>"><? }?>List Chapters<? if($_GET['sub'] != 'chapters') {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                          
          
                         <div class="<? if ($_GET['a'] == 'move'){?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if  ($_GET['a'] == 'move') {?><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series=<? echo $_GET['series'];?>&a=move"><? }?>Move Pages<? if ($_GET['a'] == 'move') {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>

                          
                          <div class="<? if(($_GET['sub'] == 'episodes') && ($_GET['a'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['sub'] == 'episodes')&& ($_GET['a'] == '')) {?><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=episodes&series=<? echo $SeriesNum;?>"><? }?>List Episodes<? if (($_GET['sub'] == 'episodes')&& ($_GET['a'] == '')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                             <div class="<? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'episodes')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'episodes')) {?><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=episodes&a=new&series=<? echo $SeriesNum;?>"><? }?>New Episode<? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'episodes')) {?><? } else {?></a><? }?>
                       </div><div class="spacer"></div>
                    
					   		<? if ($_SESSION['IsPro'] == 1) {?>
                         <div class="<? if(($_GET['sub'] == 'series') && ($_GET['a'] == '')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if (($_GET['sub'] == 'series')&& ($_GET['a'] == '')) {?><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=series"><? }?>List Series<? if (($_GET['sub'] == 'series')&& ($_GET['a'] == '')) {?><? } else {?></a><? }?>
                       </div>
                          <div class="spacer"></div>
                             <div class="<? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'series')) {?>cms_blue_button_active<? } else {?>cms_blue_button_off<? }?>"><div class="spacer"></div><? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'series')) {?><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=series&a=new"><? }?>New Series<? if(($_GET['a'] == 'new') &&($_GET['sub'] == 'series')) {?><? } else {?></a><? }?>
                       </div>
                       
                       <? }?>
              
                       <? /* <? if(($_GET['a'] != '') || ($_GET['sub'] != '')) {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>'><img src="http://www.wevolt.com/images/cms/listpages_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/listpages_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/listpages_off.png';" border="0"/></a><? } else {?><img src="http://www.wevolt.com/images/cms/listpages_on.png" border="0"/><? }?><? 
<? if(($_GET['a'] == 'new') &&($_GET['sub'] == '')) {?><img src="http://www.wevolt.com/images/cms/addpage_on.png" border="0"/><? } else {?><a href='/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?a=new&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>'><img src="http://www.wevolt.com/images/cms/addpage_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/addpage_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/addpage_off.png';" border="0"/></a><? }?><br>

<? if ($_SESSION['projecttype'] != 'writing') { if ($_GET['a'] != 'batch') {?><a href='#' onClick="parent.window.location.href='/cms/batch/<? echo $_SESSION['safefolder'];?>/?section=pages&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>';"><img src="http://www.wevolt.com/images/cms/batchupload_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/batchupload_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/batchupload_off.png';" border="0"/></a><? } else {?><img src="http://www.wevolt.com/images/cms/batchupload_on.png" border="0"/><? } }?><br>

<? if($_GET['sub'] != 'chapters') {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=chapters&series=<? echo $SeriesNum;?>&ep=<? echo $EpisodeNum;?>"><img src="http://www.wevolt.com/images/cms/listchapters_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/listchapters_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/listchapters_off.png';" border="0"/></a><? } else {?><img src="http://www.wevolt.com/images/cms/listchapters_on.png" border="0"/><? }?><br>
<? if(($_GET['sub'] == 'episodes') &&($_GET['a'] == '')) {?><img src="http://www.wevolt.com/images/cms/listepisodes_on.png" border="0"/><? } else {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=episodes&series=<? echo $SeriesNum;?>"><img src="http://www.wevolt.com/images/cms/listepisodes_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/listepisodes_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/listepisodes_off.png';" border="0"/></a><? }?><br>
<? if((($_GET['sub'] != 'episodes') && ($_GET['a'] != 'new')) || (($_GET['sub'] == '') && ($_GET['a'] != '')) || (($_GET['sub'] == 'episodes') && ($_GET['a'] != 'new'))) {?><a href="/<? echo $_SESSION['pfdirectory'];?>/section/pages_inc.php?sub=episodes&a=new&series=<? echo $SeriesNum;?>"><img src="http://www.wevolt.com/images/cms/newepisode_off.png" onMouseOver="this.src='http://www.wevolt.com/images/cms/newepisode_over.png';" onMouseOut="this.src='http://www.wevolt.com/images/cms/newepisode_off.png';" border="0"/></a><? } else {?><img src="http://www.wevolt.com/images/cms/newepisode_on.png" border="0"/><? }?><br>*/?>

  <div class="spacer"></div>


  <? /*
                         <div class="<? if ($_GET['sa'] != 'new') {?>cms_blue_button_off<? } else {?>cms_blue_button_active<? }?>"><? if ($_GET['sa'] != 'new') {?><a href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&sa=new"><? }?>New Content<br />Section<? if ($_GET['sa'] != 'new') {?></a><? }?>
                       </div>
                          <div class="spacer"></div><? */?>
                
                        </td>
                        
                        
                        <td valign="top">


  

<?	
if (($_GET['a'] == '') && ($_GET['sub'] == '')) {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_inc_html.php';
} else if (($_GET['a'] == '') && ($_GET['sub'] == 'episodes')) {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/episodes_inc_html.php';
} else if (($_GET['a'] == '') && ($_GET['sub'] == 'series')) {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/series_inc_html.php';
}else if (($_GET['a'] == '') && ($_GET['sub'] == 'chapters')) {
		include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_inc_html.php';
} else if (($_GET['a'] == 'edit') && ($_GET['sub'] == '')) {
			if ($_SESSION['projecttype'] != 'writing')
				include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_edit_inc.php';
			else 
				include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_writing_edit_inc.php';
} else if (($_GET['a'] == 'new') && ($_GET['sub'] == '') ) {
		if ($_SESSION['projecttype'] != 'writing')
				include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_new_inc.php';
			else 
				include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_writing_edit_inc.php';
} else if (($_GET['a'] == 'delete') && ($_GET['sub'] == '') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_delete_inc.php';
}else if (($_GET['a'] == 'edit') && ($_GET['sub'] == 'episodes') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/episodes_edit_inc.php';
} else if (($_GET['a'] == 'new') && ($_GET['sub'] == 'episodes') ) {
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/episodes_edit_inc.php';
} else if (($_GET['a'] == 'delete') && ($_GET['sub'] == 'episodes') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/episode_delete_inc.php';
}else if (($_GET['a'] == 'edit') && ($_GET['sub'] == 'series') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/series_edit_inc.php';
} else if (($_GET['a'] == 'new') && ($_GET['sub'] == 'series') ) {
	include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/series_edit_inc.php';
} else if (($_GET['a'] == 'delete') && ($_GET['sub'] == 'series') ) {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/series_delete_inc.php';
}else if ($_GET['a'] == 'move')  {
			include $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['pfdirectory'].'/section/pages_move_inc.php';
}
						
?>

  </td>
                        </tr>
                        </table>
</body>