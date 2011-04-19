<?
$IsProject = true;
$IsIndex = true;
$ComicName = $_GET['project'];
if ($ComicName == 'project.php')
	$ComicName = $_GET['section'];
$ComicDir = substr($ComicName,0,1);

$ProjectName = $ComicName;
$ProjectDir = substr($ComicName,0,1);

$ReaderUser = $_SESSION['userid'];
$ContentUrl = strtolower('home');
$Section = ucfirst(strtolower($ContentUrl));
$Section ='Home';
$TrackPage = 1;
$Pagetracking = $Section;
$PFDIRECTORY = 'panelflow';

include 'includes/init.php';
$InitDB->close();

$PageTitle .= $ComicTitle;
 if (($_GET['tab'] == '') || ($_GET['tab'] == 'overview')){
                        $includefile ='project_overview.php';
						$PageTitle.= ' - overview';
 }else {
                         $includefile ='project_'.$_GET['tab'].'.php';
						 $PageTitle.= ' - '.$_GET['tab'];
 }
$Tracker = new tracker();
$Remote = $_SERVER['REMOTE_ADDR'];
$Referal = substr($_SERVER['HTTP_REFERER'],7,strlen($_SERVER['HTTP_REFERER'])-1);
$pos = strpos($Referal,'www.wevolt.com');
if($pos === false) {
	$pos = strpos($Referal,'users.wevolt.com');
	if($pos === false) {
		
	} else {
 		 $Referal = 'www.wevolt.com';
	}
} else {
 $Referal = 'www.wevolt.com';
}

if ($AdminUserID != $_SESSION['userid'])
$Output = $Tracker->insertPageView($ProjectID,$Pagetracking,$Remote,$_SESSION['userid'],$Referal,$_SESSION['reflink'],$_SESSION['IsPro'],$IsCMS);	
$BodyStyle = $ProjectTemplate->getBodyStyle();
include_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
$query = "SELECT * from users where encryptid='$AdminUserID'";
$PublisherArray = $InitDB->queryUniqueObject($query);
$query = "SELECT wowio_link from comic_settings where ComicID='$ProjectID'";
$WowioLink = $InitDB->queryUniqueValue($query);

?>

<script type="text/javascript">
<? if ($_SESSION['userid'] != ''){?>

function follow(ProjectID,UserID,Type) {
 
	attach_file('http://www.wevolt.com/connectors/follow_content.php?fid='+ProjectID+'&type='+Type); 
	document.getElementById("follow_project_div").style.display = 'none';
	
}
<? }?>

</script>

<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="<? echo $TemplateWrapperWidth;?>">
  <tr>
    <td valign="top" align="center">
    <div class="content_bg">
		<? if ($_SESSION['userid'] != '') {?>
            <div id="controlnav">
                <?php $Site->drawControlPanel(); ?>
            </div>
        <? }?>
        <? if ($_SESSION['noads'] != 1) {?>
            <div id="ad_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;" align="center">
                <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
            </div>
        <?  }?>
       
       
        <div id="header_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;">
           <? $Site->drawHeaderWide();?>
        </div>
    </div>
    
     <div class="shadow_bg">
        	 <? $Site->drawSiteNavWide();?>
    </div>
    
     <div class="content_bg" id="content_wrapper">
         <!--Content Begin -->
         <div class="spacer"></div>
         <table cellspacing="0" cellpadding="0" width="<? echo $SiteTemplateWidth;?>">
             <tr>
             <td colspan="2" class="light_blue_header_lg" style="padding-left:25px; padding-bottom:10px;"><? echo $ComicTitle;?></td>
             </tr>
             <tr>
             <td style="padding-left:25px;" align="left" width="200" valign="top">
             <img src="<? echo $ProjectCover;?>" width="172" border="2" style="border:#82c1ff 2px solid;"/><br/>
             <? if ($InRumble == 1) {?>
              <img src="http://www.wevolt.com/images/rumble_competitor_banner.jpg" />
             <? }?> <div class="spacer"></div>
             <div class="spacer"></div>
             <a href="http://www.wevolt.com/<? echo $SafeFolder;?>/"><img src="http://www.wevolt.com/images/read_it_button.png" border="0"/></a>
             
             <? if ($ContentSection->IsProjectSuperFan != 1){?>
             <div class="spacer"></div>
             <a href="http://www.wevolt.com/superfan.php?p=<? echo $SafeFolder;?>"><img src="http://www.wevolt.com/images/become_superfan.png" border="0"/></a>
             <? }?>
              <? if (($ContentSection->IsFollowing != 1) && ($_SESSION['userid'] != '')){?>
             <div class="spacer"></div>
             <a href="javascript:void(0)" onclick="follow('<? echo $ProjectID;?>','<? echo $_SESSION['userid'];?>','project');"><img src="http://www.wevolt.com/images/follow_this.png" border="0"/></a>
             <? }?>
             
              <? 
			  
			  if ($WowioLink != ''){?>
             <div class="spacer"></div>
             <a href="<? echo $WowioLink;?>" target="_blank"><img src="http://www.wevolt.com/images/getit_wowio.png" border="0"/></a>
             <? }?>
              <div class="spacer"></div>
               <div class="spacer"></div>
               <span class="dark_blue_header_med">MEDIA: <span class="blue_cell_text"><? echo $ProjectType;?></span>
                <div class="spacer"></div>
               <span class="dark_blue_header_med">RANK: <span class="blue_cell_text"><? echo $Ranking;?></span>
               
               <? if ($PublisherArray->IsPublisher == 1) {?>
                <div class="spacer"></div>
               <span class="dark_blue_header_med">PUBLISHER: <br />
<span class="blue_cell_text"><? echo $PublisherArray->PublisherName;?></span>
               	
               <? }?>
                <div class="spacer"></div>
               <span class="dark_blue_header_med">SOCIAL: <div class="spacer"></div>
               <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.wevolt.com<?  echo '%2F'.$SafeFolder.'%2F';?>&amp;layout=button_count&amp;show_faces=false&amp;width=50&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
                 <div class="spacer"></div>
                 <form method="post" action="#" name="voltform" id="voltform">
                    <a href="http://www.facebook.com/sharer.php?u=<? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>&t=<? echo  urlencode($ComicTitle);?>" target="_blank" ><img src="http://www.wevolt.com/images/fb_icon.jpg" border="0"  width="25" /></a>
                    
                    <a href='http://twitter.com/home?status=Currently reading <? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>' title='Click to share this post on Twitter' target="_blank" ><img src="http://www.wevolt.com/images/twitter_icon.jpg" border="0" width="25" /></a>
                    <a href='http://digg.com/submit/?url=<? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>&title=<? echo urlencode($ComicTitle);?>' title='Click to share this post on Digg' target="_blank" ><img src="http://www.wevolt.com/images/digg_icon.jpg" border="0"  width="25"/></a>                
<a href="http://delicious.com/save" onclick="window.open('http://delicious.com/save?v=5&noui&jump=close&url='+encodeURIComponent('<? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>')+'&title='+encodeURIComponent('<? echo urlencode($ComicTitle);?>'), 'delicious','toolbar=no,width=550,height=550'); return false;"><img src="http://www.wevolt.com/images/del_icon.jpg" border="0"  width="25"/></a>
<a href='http://reddit.com/submit?url=<? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>&title=<? echo $ComicTitle;?>' target='_blank'><img src="http://www.wevolt.com/images/reddit_icon.png" border="0" width="25" /></a>
<? if ($_SESSION['userid'] != '') {?>
<a href='#' title='Post to wevolt' onclick="voltIt('<? echo $ProjectID;?>','<? echo  urlencode('http://www.wevolt.com/'.$SafeFolder.'/');?>','<? echo urlencode($ComicTitle);?>','<? echo $Type;?>'); return false;"><img src="http://www.wevolt.com/images/V_social_media_sm.jpg" border="0"  width="25"/></a><? }?>
<input type="hidden" name="txtItem" value="<? echo $ItemID;?>">
<input type="hidden" name="txtRefer" value="<? echo $Refer;?>">
<input type="hidden" name="txtLink" value="<? echo  $ReturnLink;?>">

<input type="hidden" name="txtAction" id="txtAction" value="1">
</form>
             </td>
                <td valign="top" style="padding-left:10px;"align="left">
                <? $Site->drawProjectIndexNav('772',$SafeFolder) ;?>
                <div class="spacer"></div>
                <?
                        include $_SERVER['DOCUMENT_ROOT'].'/includes/'.$includefile;
                    ?>
                </td>
              
            
            </tr>
         </table>       
    <!--Content End -->
    </div>

	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>