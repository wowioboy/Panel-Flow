<?php 
session_start();
if ($_GET['p'] == 'contact')
	header("Location:/contact.php");
require_once('includes/init.php');
$InitDB->close();
$PageTitle .= 'home';
$TrackPage = 1; 
$HomePage = 1;
$Takeover=false;
$TakeOverStyle='';
$Home = true;
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
 if ($_SESSION['IsPro'] == 1) {
           $_SESSION['noads'] = 1;
		} 
?>

<script>

    $(document).ready(function(){
 
		$("#twitter_wevolt").tweet({
          count: 1,
           username: "wevoltonline",
           loading_text: "loading tweets..."
        });
		$("#twitter_jasonbadower").tweet({
          count: 1,
           username: "jasonbadower",
           loading_text: "loading tweets..."
        });
		$("#twitter_matteblack").tweet({
          count: 1,
           username: "matteblack",
           loading_text: "loading tweets..."
        });
        $('.ten_select').click(function(){
            if ($(this) != $('.arrow_select_on')) {
	            var tabId = $(this).attr('tab') + '-tab';
	            $('.arrow_select_on').removeClass('arrow_select_on').addClass('arrow_select_off');
	            $(this).removeClass('arrow_select_off').addClass('arrow_select_on');
	            $('.ten_tab[id!=' + tabId + ']').hide();
	            $('#' + tabId).show();
            } 
        });
    });
</script>
<style>
.arrow_select_on {
	color:#fff;
}
.slide {
	border-color:#fff !important;
	background-color:#000 !important;
	margin: 0px 5px 0px 5px !important;
}
.activeSlide {
	background-color:#fff !important;
}
.carousel_label {
	width:130px;
	height:30px;
	background-color:#000;
	filter:alpha(opacity=50);
	-ms-filter: "alpha(opacity=50)";
	opacity:.5;
	position:absolute;
	left:0;
	bottom:0;
	z-index:1;
	-webkit-border-top-right-radius: 30px;
	-moz-border-radius-topright: 30px;
	border-top-right-radius: 30px;
}
#LateNav {
	position:absolute;
	z-index:2;
	bottom:7.5px;
	left:5px;
}
.carousel_label span {
	filter:alpha(opacity=100);
	-ms-filter: "alpha(opacity=100)";
	opacity:1;
}
.tweets {

font-size:10px;	
}
</style>
<div align="center">
<? if ($_SESSION['userid'] != '') {?>
<div class="content_bg">
		
            <div id="controlnav">
                <?php $Site->drawControlPanel('980px'); ?>
            </div>
   
 </div>  
<? } ?>    
<table cellpadding="0" cellspacing="0" border="0" width="1058">
  <tr>
    <td valign="top" align="center">
    <div class="content_bg">
		
        <? if ($_SESSION['noads'] != 1) {?>
            <div id="ad_div" style="background-color:#FFF;width:980px;" align="center">
         
<?php if ($Takeover) : ?>
            <a href="http://www.vgmarketsurveys.comm/?campaign=wowio&adgroup=wv" target="_blank"><img src="/ads/vgm_wv_954x60.jpg" 
border="0" /></a>
   <?php else: ?>
            <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
  <?php endif; ?>
            </div>
        <?  }?>
        <div id="header_div" style="background-color:#FFF;width:980px;">
           <? $Site->drawHeaderWide();?>
        </div>
    </div>
     <div class="shadow_bg">
        	 <? $Site->drawSiteNavWide();?>
    </div>
    
     <!--<div class="content_bg" >-->
        <div id="feature_div"  style="width:980px;" >
                      <table cellpadding="0" cellspacing="0" border="0"><tr>
                      <td  style="width:680px;background-color:#FFF;" valign="top">
                           
                            <div>
                                <div style="width:680px;height:250px; background-color:#CCC; position:relative;">
                                 <div style="position:absolute;top:0;left:0;z-index:0;">
                                 
                              
                                <?php echo $Site->drawLatestModule('CreatedDate DESC', true, 2); ?>
                                  
                                 </div>
                               <div class="carousel_label">
                               </div>
                                <span id="LateNav"></span>
                              
                                </div>
                            </div>
                          
                  </td>
                  <td width="300px;" valign="top">
               
<?php if ($Takeover) : ?>
                  <a href="http://www.vgmarketsurveys.comm/?campaign=wowio&adgroup=wv" target="_blank"><img 
src="/ads/vgm_wv_300x250.png" /></a>
<?php else: ?>
                 <iframe src="" allowtransparency="true" width="300" height="250" frameborder="0" scrolling="no" id="home_300" name="home_300"></iframe> 
 <?php endif; ?>
                  </td>
                  </tr>
                  </table>
  
         <div style="background-color:#fff;">
      
      
        <div class="spacer"></div>
   
        <div class="spacer"></div>
        
         <div id="top_ten_div" style="background-color:#FFF;width:980px;">
         <div style="padding-left:10px;">
         <div align="left">
         <img src="http://www.wevolt.com/images/top_ten_header.png" /><br />
    	</div>
                            <table><tr><td width="860px" align="left">
                                <div id="comics-tab" class="ten_tab">
                                <? $mVersion =2;
									include 'modules/top_10_mod.php';
								?>
                                </div>
                              <div id="blog-tab" class="ten_tab" style="display:none;">
                                </div>
                              <div id="forum-tab" class="ten_tab" style="display:none;">
                                </div>
                              <div id="writing-tab" class="ten_tab" style="display:none;">
                              <? $mVersion =2;
							  		$ModContent = 'writing';
									include 'modules/top_10_mod.php';
								?>
                              
                                </div>
                                
                        
                            </td>
                            
                            <td valign="top" >
                            <div class="ten_select arrow_select_on" tab="comics">Comics</div>
                            <div class="ten_select arrow_select_off" tab="writing">Writing</div>
                             <? /*<div class="ten_select arrow_select_off" tab="blog">Blogs</div>
                              <div class="ten_select arrow_select_off" tab="forum">Forums</div> 
                               <div class="ten_select arrow_select_off" tab="writing">Writing</div><? */?>
                             </td></tr></table>
                        
             <input id="top_10_tabs" value="Comics,Forums,Blogs,Writing" type="hidden" />
        </div>
        </div>

        <div class="spacer"></div>
        <div id="coumns" style="width:980px;">
          <div style="padding-left:15px;">
        <table cellpadding="0" cellspacing="0">
            <tr>
             <td width="200" valign="top"> <div class="spacer"></div><div class="spacer"></div><img src="http://www.wevolt.com/images/the_news.png" />
           	 <div class="spacer"></div>
			<? 
			$ModProject = 'abd81528278';
			include $_SERVER['DOCUMENT_ROOT'].'/modules/blog_pull.php';?>
            
            </td>
            <td width="20"></td>
                <td valign="top"> <div class="spacer"></div><div class="spacer"></div>
                 <div align="left">
            <img src="http://www.wevolt.com/images/the_spotlight_header.png" />
              <!--<img src="http://www.wevolt.com/images/random_rumble.png" />-->
             
              </div>
              <div class="spacer"></div>
              <table><tr>
              <td width="126" valign="top">
              
              <!--<img src="http://www.wevolt.com/images/project_header.png" />--><div style="height:5px;"></div>
              <? $Site->drawSpotLight('project',$RumbleRound);?>
              </td>
              <td width="38"></td>
              <? /*
              <td width="106" valign="top">
                <img src="http://www.wevolt.com/images/creator_header.png" /><div style="height:5px;"></div>
                <? $Site->drawSpotLight('creator');?>
              </td>
			  
			  <? */?>
             
              </tr>
              </table>
              
                </td>
                <td width="18"></td>
                <td width="280" valign="top"> <div class="spacer"></div><div class="spacer"></div>
                 <div align="left">
                <img src="http://www.wevolt.com/images/the_feed_header.png" />
                </div>
                <div style="width:280px; overflow:hidden;">
                 <div class="spacer"></div>
                <? include 'modules/feed_pull.php';?>
                </div>
                <div class="spacer"></div>
         
                </td>

                <td style="width:298px;"> 
                 <div class="spacer"></div>
                <div style="width:298px; background-image:url(images/twitter_box_top.png); background-repeat:no-repeat; height:8px;"></div>
                <div style="background-color:#0e478a;">
                <div style="padding-left:12px;">
              
    				           <table width="100%"><tr>
               <td><img src="http://www.wevolt.com/images/follow_on_wevolt.png" /></td>
               <td><a href="http://www.facebook.com/#!/group.php?gid=131247090248002&ref=ts" target="_blank"><img src="http://www.wevolt.com/images/fb_icon.png" border="0"/></a></td>
                <td><a href="http://www.twitter.com/wevoltonline" target="_blank"><img src="http://www.wevolt.com/images/twitter_icon.png" border="0"/></a></td>
               <td align="right" width="90">
                </td>
                
               </tr></table>
               
             	<div style="height:5px;"></div>
                 <div style="height:5px;"></div>
                        <table cellpadding="0" cellspacing="0"><tr>
                        <td width="55">
                       <div style="color:#7fdbed; font-weight:bold;font-size:11px;">WEvolt</div>
                        <a href="http://www.twitter.com/wevoltonline"><img src="http://www.wevolt.com/images/wevolt_avatar.jpg" width="46" height="46" border="0"/></a>
                        </td>
                        <td > 
                        
                        
                            <table width="218" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  background="http://www.wevolt.com/images/twitter_box_TL.png" width="17" height="4" style="background-repeat:no-repeat;"></td>
                                <td content rowspan="3" bgcolor="#FFFFFF">  <div id="twitter_wevolt" align="left" style="width:95%;" class="tweets"></div></td>
                                <td background="http://www.wevolt.com/images/twitter_box_TR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                              </tr>
                              <tr>
                                <td  background="http://www.wevolt.com/images/twitter_box_L.png" width="17" height="47" style="background-repeat:repeat-y;"></td>
                                <td  bgcolor="#FFFFFF"></td>
                              </tr>
                              <tr>
                                <td background="http://www.wevolt.com/images/twitter_box_BL.png" width="17" height="17" style="background-repeat:no-repeat;"></td>
                                <td background="http://www.wevolt.com/images/twitter_box_BR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                              </tr>
                            </table>
         
                        </td>
                        </tr>
                        </table>
               <div style="height:5px;"></div>
                 <table cellpadding="0" cellspacing="0"><tr>
                <td  width="55">
               <div style="color:#7fdbed;font-weight:bold; font-size:11px;">Jason<br/>Badower</div>
                <a href="http://www.twitter.com/jasonbadower"><img src="http://www.wevolt.com/images/jason_avatar.jpg" width="46" height="46" border="0"/></a>
                </td>
                <td >
                
                
                <table width="218" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  background="http://www.wevolt.com/images/twitter_box_TL.png" width="17" height="4" style="background-repeat:no-repeat;"></td>
                    <td content rowspan="3" bgcolor="#FFFFFF">  <div id="twitter_jasonbadower" align="left" style="width:95%;" class="tweets"></div></td>
                    <td background="http://www.wevolt.com/images/twitter_box_TR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                  </tr>
                  <tr>
                    <td  background="http://www.wevolt.com/images/twitter_box_L.png" width="17" height="47" style="background-repeat:repeat-y;"></td>
                    <td  bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr>
                    <td background="http://www.wevolt.com/images/twitter_box_BL.png" width="17" height="17" style="background-repeat:no-repeat;"></td>
                    <td background="http://www.wevolt.com/images/twitter_box_BR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                  </tr>
                </table>
 
                </td>
                
             
                </tr>
                </table>
                <div style="height:5px;"></div>
                 <table cellpadding="0" cellspacing="0"><tr>
                <td  width="55">
               <div style="color:#7fdbed;font-weight:bold;font-size:11px;">Matt<br/>Jacobs</div>
                <a href="http://www.twitter.com/matteblack"><img src="http://www.wevolt.com/images/matt_avatar_new.jpg" width="46" height="46" border="0"/></a>
                </td>
                <td >
                
                
                <table width="218" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  background="http://www.wevolt.com/images/twitter_box_TL.png" width="17" height="4" style="background-repeat:no-repeat;"></td>
                    <td content rowspan="3" bgcolor="#FFFFFF">  <div id="twitter_matteblack" align="left" style="width:95%;" class="tweets"></div></td>
                    <td background="http://www.wevolt.com/images/twitter_box_TR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                  </tr>
                  <tr>
                    <td  background="http://www.wevolt.com/images/twitter_box_L.png" width="17" height="47" style="background-repeat:repeat-y;"></td>
                    <td  bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr>
                    <td background="http://www.wevolt.com/images/twitter_box_BL.png" width="17" height="17" style="background-repeat:no-repeat;"></td>
                    <td background="http://www.wevolt.com/images/twitter_box_BR.png" width="4" height="4" style="background-repeat:no-repeat;"></td>
                  </tr>
                </table>
 
                </td>
                </tr>
                </table>
				 <div style="height:5px;"></div>
                </div>
                </div>
                 <div style="background-color:#0e478a;height:10px;">
                 
                 </div>
                </td>
                </tr><tr><td></td><td></td>
            </tr>
        </table>
            
        </div>
        </div>
    </div>
    </div>
	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_with_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
</table>
</div>
  <!-- AD TAG BEGINS: WeVolt(gr.wevolt) / homepage / 1x1 -->
<script type="text/javascript">
  var gr_ads_zone = 'homepage';
  var gr_ads_size = '1x1';
</script>
<script type="text/javascript" src="http://a.giantrealm.com/gr.wevolt/a.js">
</script>
<noscript>
  <a href="http://ans.giantrealm.com/click/gr.wevolt/homepage;tile=4;sz=1x1;ord=1234567890">
    <img src="http://ans.giantrealm.com/img/gr.wevolt/homepage;tile=4;sz=1x1;ord=1234567890" width="1" height="1" alt="advertisement" />
  </a>
</noscript>
<!-- AD TAG ENDS: WeVolt / homepage / 1x1 -->
<?php require_once('includes/pagefooter_inc.php'); ?>

