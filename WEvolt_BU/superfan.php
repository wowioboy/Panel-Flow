<? 
require_once('includes/init.php');
$PageTitle .= 'become a SuperFan';
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
 if ($_GET['p'] != '') {
$query = "SELECT ProjectID, thumb, cover, title, superfan_pitch, superfan_link from projects where SafeFolder='".$_GET['p']."'";
$RefArray = $InitDB->queryUniqueObject($query);

}
$InitDB->close();
?>
<script type="text/javascript">
			   function start_subscription(type,sid) {
				   if (type == 'fan') {
					   document.getElementById("type").value = 'fan';
					   document.getElementById("SubType").value = sid;
				   } else if (type == 'pro') {
						document.getElementById("type").value = 'hosted';
						document.getElementById("SubType").value = sid;      
				   }
				   document.subform.submit();
			   }
			   
	function show_preview(){
	$(this).modal({width:1040, height:672,src:"http://www.wevolt.com/preview_pro.html"}).open();   
};		   
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
    <?  if  ($_GET['step'] != '3') {?>
     <div class="content_bg" id="content_wrapper">
     <? } else {?>
      <div style="width:<? echo $SiteTemplateWidth;?>px;">
     <? }?>
         <!--Content Begin -->
         <? if (($_GET['p'] == '') && ($_GET['step'] != 'go')) {?>
         
           
         <table width="<? echo $SiteTemplateWidth;?>"><tr>
         <td align="center" valign="top">
         <div class="spacer"></div>
			<? if (($_GET['step'] == '') || ($_GET['step'] == '1')) {?>
            <img src="http://www.wevolt.com/images/superfan_info_top.jpg" />
              <div class="spacer"></div>
              <div align="left" style="width:300px;">   
                <div class="spacer"></div>
                  <div class="spacer"></div>
                    <div class="spacer"></div>
                      <div class="spacer"></div>
                      <a href="javascript:void(0)" onclick="show_preview();">  <img src="http://www.wevolt.com/images/preview_button.jpg"class="navbuttons"  /></a>   <div class="spacer"></div>
                  <div class="spacer"></div>
                    <div class="spacer"></div>
                      <div class="spacer"></div>
                <a href="http://www.wevolt.com/register.php?a=pro">  <img src="http://www.wevolt.com/images/go_pro_sf_btn.png"class="navbuttons"  /></a> 
                 <div class="spacer"></div>
                   <div class="spacer"></div>
                     <div class="spacer"></div>
                  <div class="spacer"></div>
                 <? if ($_SESSION['userid'] != '') {?>
		<a href="javascript:void(0);" onclick="start_subscription('fan','1');">
        <img src="http://www.wevolt.com/images/superfan_go.jpg" class="navbuttons"/>
        </a>
           <form action="/process_store.php" method="post" id="subform" name="subform">
                        <input type="hidden" name="type" id="type" value="">
                        <input type="hidden" name="start" value="1">
                        <input type="hidden" name="txtSubType" id="SubType" value="">
                        <input type="hidden" name="p" id="p" value="<? echo $_GET['p'];?>">
                        </form>
        <? } else {?>
        	You need to log in first to become a SuperFan!
        <? }?>
                </div>  <div class="spacer"></div>
                  <div class="spacer"></div>
                
                					 <img src="http://www.wevolt.com/images/superfan_info_bottom.jpg" />				  

            <? } else if  ($_GET['step'] == '2') {?>
            
            <img src="http://www.wevolt.com/images/superfan_tour_2.jpg" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="346,421,450,455" href="/superfan.php?step=3" />
  </map>
             <? } else if  ($_GET['step'] == '3') {?>
              <img src="http://www.wevolt.com/images/superfan_tour_3.gif" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="897,728,1001,762" href="/superfan.php?step=go" />
  </map>
            
            <? }?>
         </td>
          </tr>
         </table>   
         
         <? } else {?>
           
         <table width="<? echo $SiteTemplateWidth;?>"><tr>
 
         
         <td align="center" valign="top">
         <div class="spacer"></div>
         
         
         <div class="spacer"></div><div class="spacer"></div>
             <img src="http://www.wevolt.com/images/superfan_info_top.jpg" />
              <div class="spacer"></div>
              <div align="left" style="width:300px;">   
                <div class="spacer"></div>
                  <div class="spacer"></div>
                    <div class="spacer"></div>
                      <div class="spacer"></div>
                      <a href="javascript:void(0)" onclick="show_preview();">  <img src="http://www.wevolt.com/images/preview_button.jpg"class="navbuttons"  /></a>   <div class="spacer"></div>
                  <div class="spacer"></div>
                    <div class="spacer"></div>
                      <div class="spacer"></div>
                <? if ($_SESSION['userid'] != '') {?>
		<a href="javascript:void(0);" onclick="start_subscription('fan','1');">
        <img src="http://www.wevolt.com/images/superfan_go.jpg" class="navbuttons"/>
        </a>
           <form action="/process_store.php" method="post" id="subform" name="subform">
                        <input type="hidden" name="type" id="type" value="">
                        <input type="hidden" name="start" value="1">
                        <input type="hidden" name="txtSubType" id="SubType" value="">
                        <input type="hidden" name="p" id="p" value="<? echo $_GET['p'];?>">
                        </form>
        <? } else {?>
        	You need to log in first
        <? }?>
                 <div class="spacer"></div>
                   <div class="spacer"></div>
                     <div class="spacer"></div>
                  <div class="spacer"></div>
    	<!--Content End -->
        		<div class="spacer"></div>	 <div class="spacer"></div>	
               
			 <div class="spacer"></div>		 <div class="spacer"></div>
					 <img src="http://www.wevolt.com/images/superfan_info_bottom.jpg" />				  
                     
         </td>
         <? if ($_GET['p'] != '') {?>
          <td width="300" align="center" valign="top"> <div class="spacer"></div> <div class="spacer"></div>
          <table width="288" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="dark_grey_box_TL"></td>
										<td id="dark_grey_box_T" width="276"></td>
										<td id="dark_grey_box_TR"></td></tr>
										<tr>
										<td style="background-color:#58595b;color:#fff;" colspan="3" valign="top" align="center" height="680">
        <div align="left" style="width:200px;">
         <b>Support</b><br />
<span style="color:#fdd700; font-size:14px;"><b><? echo $RefArray->title;?></b></span><div style="height:5px"></div>
         For only $2 / month!
         <div class="spacer"></div>
         </div>
         <img src="http://www.wevolt.com<? echo $RefArray->cover;?>" border="2" width="200"/>
		  <div align="left" style="width:200px;">
<div class="spacer"></div>
<? echo nl2br($RefArray->superfan_pitch);?><div class="spacer"></div>
         </div>
		
 </td>

						</tr><tr><td id="dark_grey_box_BL"></td><td id="dark_grey_box_B"></td>
						<td id="dark_grey_box_BR"></td>
						</tr></tbody></table>
         </td>
          <? }?>
         </tr>
         </table>   
         
         <? }?>
                
    </div>

	</td>
  </tr>
    <?  if  ($_GET['step'] != '3') {?>
      <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
     <? }?>
 
</table>
</div>

<?php require_once('includes/pagefooter_inc.php'); ?>

