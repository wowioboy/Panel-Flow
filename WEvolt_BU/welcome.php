<? 
require_once('includes/init.php');
$query = "SELECT ReadBetaWelcome from users_settings where UserID='".$_SESSION['userid']."'";
$HasRead = $InitDB->queryUniqueValue($query);
if (($HasRead == '') or ($HasRead == 0)){
$query = "UPDATE users_settings set ReadBetaWelcome='1' where UserID='".$_SESSION['userid']."'";
$InitDB->execute($query);
}

$PageTitle .= 'Welcome to WEvolt';
$InitDB->close();


require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();
 
?>
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
        <div align="left" style="padding-left:50px;">
      <img src="http://www.wevolt.com/images/welcome_to_wevolt.jpg" /></div><div class="spacer"></div><div class="spacer"></div>
      <? if (($_SESSION['showelcome'] == 1) && ($HasRead == 1)) {?><div class="spacer"></div><div class="messageinfo_warning" style="font-size:10px;">
      psst...you can turn this page off in your <a href="http://users.wevolt.com/<? echo $_SESSION['username'];?>/?tab=settings">SETTINGS</a></div><div class="spacer"></div><? }?>
      
      <div class="spacer"></div>
 		<? if (($_GET['page'] == '') || ($_GET['page'] == '1')) {?>
       <img src="http://www.wevolt.com/images/welcome_1.jpg" width="905" height="610" border="0" usemap="#Map" />
       <map name="Map" id="Map">
  <area shape="rect" coords="798,525,902,588" href="http://www.wevolt.com/welcome.php?page=2" />
</map>
       <? } else if ($_GET['page'] == '2') {?>
        <img src="http://www.wevolt.com/images/welcome_2.jpg" border="0" usemap="#Map2" />
<map name="Map2" id="Map2">
  <area shape="rect" coords="829,494,933,557" href="http://www.wevolt.com/welcome.php?page=3" />
</map>
       <? } else if ($_GET['page'] == '3') {?>
        <img src="http://www.wevolt.com/images/welcome_3.jpg" border="0" usemap="#Map3" />
<map name="Map3" id="Map3">
  <area shape="rect" coords="490,198,677,321" href="http://users.wevolt.com/<? echo $_SESSION['username'];?>/?tab=profile" />
</map>
       <? } else if ($_GET['page'] == '4') {?>
         <img src="http://www.wevolt.com/images/tuts/wevolt_welcome_4.png" /><br />
       <? } else if ($_GET['page'] == '5') {?>
         <img src="http://www.wevolt.com/images/tuts/wevolt_welcome_5.png" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="190,416,355,472" href="http://www.wevolt.com/upgrade.php" /></map><br />
		
		<? } else if ($_GET['page'] == '6') {?>
<? if ($_SESSION['userid'] != '') {
				$SupriseCode = 'welcome_100';
				$query = "SELECT * from suprise_codes where Code='$SupriseCode' and IsActive=1";
				$SupriseArray = $InitDB->queryUniqueObject($query);
				
				$query = "SELECT count(*) from suprise_codes_redeem where Code='$SupriseCode' and UserID='".$_SESSION['userid']."'";
				$Found = $InitDB->queryUniqueValue($query);
				if ($Found == 0) {
					include_once($_SERVER['DOCUMENT_ROOT'].'/models/Users.php');
					$XPMaker = new Users();
					$XPMaker->addxp($InitDB, $_SESSION['userid'], $SupriseArray->XP);
					$ShowCongrats = true;
					$query = "INSERT into suprise_codes_redeem (Code, UserID) values ('$SupriseCode', '".$_SESSION['userid']."')"; 
					$InitDB->execute($query);	
				} else {
					$ShowCheater = true;
				}
				
				 if ($ShowCongrats) {?>
                  <img src="http://www.wevolt.com/images/tuts/wevolt_welcome_6.png" border="0" usemap="#Map" />

              <? } else if ($ShowCheater) {?>
                 <img src="http://www.wevolt.com/images/tuts/wevolt_welcome_6_no_xp.png" border="0" usemap="#Map"/><br />
              
              <? }?>

			
           <? } else {?>
       			 <img src="http://www.wevolt.com/images/tuts/wevolt_welcome_6_not_logged.png" border="0" usemap="#Map" /><br />
       		 <? }?>
             <map name="Map" id="Map">
<area shape="rect" coords="13,181,282,272" href="http://users.wevolt.com/myvolt/<? echo $_SESSION['username'];?>/" />
<area shape="rect" coords="327,184,583,263" href="http://www.wevolt.com/search/" />
<area shape="rect" coords="10,282,285,366" href="http://users.wevolt.com/<? echo $_SESSION['username'];?>/" />
<area shape="rect" coords="11,378,287,445" href="http://www.wevolt.com/cms/admin/" /><area shape="rect" coords="336,273,585,364" href="http://www.wevolt.com/" /><area shape="rect" coords="336,371,580,450" href="http://www.wevolt.com/forum/" /></map>
        <? }?>
       
        
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


