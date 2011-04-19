
                <img src="http://www.wevolt.com/images/personal_profile.png" />
                <div class="spacer"></div>
    <div class="<? if (($_GET['s'] == '') || ($_GET['s'] == 'details')) {?>fade_select_on<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=profile&s=details';">Details</div>
    <div class="<? if ($_GET['s'] == 'interests') {?>fade_select_on<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=profile&s=interests';">Interests</div>
    <div class="<? if ($_GET['s'] == 'stats') {?>fade_select_on<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=profile&s=stats';">Site Stats</div>
    <div class="<? if ($_GET['s'] == 'resume') {?>fade_select_on<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=profile&s=resume';">Resume</div>
    <? /*<div class="<? if ($_GET['s'] == 'portfolio') {?>fade_select_on<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=profile&s=portfolio';">Portfolio</div>*/?>
            
		<? if ($_SESSION['username'] == $FeedOfTitle) {?>
        <div class="spacer"></div>  <div class="spacer"></div>
        <a href="javascript:void(0)" onclick="window.location='/<? echo trim($_SESSION['username']);?>/?tab=profile&a=fbsync';"><img src="http://www.wevolt.com/images/sync_facebook_2.png" border="0"/></a><div class="spacer"></div>  <div class="spacer"></div>
         <? if ($_GET['s'] == 'portfolio') {?>
         <a href="/<? echo $FeedOfTitle;?>/?tab=profile&s=portfolio&a=edit"><img src="http://www.wevolt.com/images/cms/cms_grey_add_box.jpg" class="navbuttons" /></a><br />

         
         <? }?>
		<? }?><div class="spacer"></div><div class="spacer"></div>
        
       
        