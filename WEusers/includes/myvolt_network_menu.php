<? /* $Site->drawUserSearchJS();?>
 <input type="text" style="width:99%;" name="user_keywords" id="user_keywords"  value="Search NETWORK" onfocus="doClear(this);">
			  <div id="user_search_results"></div>
<div class="spacer"></div> <? */?>

<img src="http://www.wevolt.com/images/contacts_header.png" />
<div class="spacer"></div>
   <? if ($NetworkArray->TotalFans > 0) {?>
    <div class="<? if (($_GET['s'] == '') || ($_GET['s'] == 'fans')) {?>fade_select_on_tall<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=fans';">Fans<br/>(<? echo $NetworkArray->TotalFans;?>)</div>
    <div class="spacer"></div>
    <? }?>
     <? if ($NetworkArray->TotalFans > 0) {?>
    <div class="<? if ($_GET['s'] == 'celebs') {?>fade_select_on_tall<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=celebs';">Celebrities<br/>(<? echo $NetworkArray->TotalCelebs;?>)</div>
      <div class="spacer"></div>
     <? }?>
     <? if ($NetworkArray->TotalFans > 0) {?>
      <div class="<? if ($_GET['s'] == 'friends') {?>fade_select_on_tall<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=friends';">Friends<br/>(<? echo $NetworkArray->TotalFriends;?>)</div>
        <div class="spacer"></div>
       <? }?>
       <? if (($NetworkArray->TotalGroups > 0) && ($IsOwner)) {?>
		<div class="<? if ($_GET['s'] == 'groups') {?>fade_select_on_tall<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=groups';">Groups<br/>(<? echo $NetworkArray->TotalGroups;?>)</div>
          <div class="spacer"></div>
		 <? }?>
         <div class="spacer"></div>
          <img src="http://www.wevolt.com/images/sort_network.png" /><br />
			<? if ($_GET['s'] == '')
				$ContactSelect = 'fans';
			else
				$ContactSelect = $_GET['s'];
				?>
               <div class="light_blue_text">Sort by:</div><br />
                <div class="<? if (($_GET['sort'] == '') || ($_GET['sort'] == 'alpha')) {?>fade_select_on_wide<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=<? echo $ContactSelect;?>&sort=alpha';">Alphabetical</div>
                 <div class="<? if ($_GET['sort'] == 'chrono') {?>fade_select_on_wide<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=<? echo $ContactSelect;?>&sort=chrono';">Chronological</div>
                <div class="<? if ($_GET['sort'] == 'level') {?>fade_select_on_wide<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=<? echo $ContactSelect;?>&sort=level';">Level</div>
                 <div class="<? if ($_GET['sort'] == 'friends') {?>fade_select_on_wide<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=<? echo $ContactSelect;?>&sort=friends';">Most Friends</div>
                  <div class="<? if ($_GET['sort'] == 'fans') {?>fade_select_on_wide<? } else {?>fade_select_off<? }?>" onclick="window.location.href='/<? echo $FeedOfTitle;?>/?tab=network&s=<? echo $ContactSelect;?>&sort=fans';">Most Fans</div>

               <div class="spacer"></div><div class="spacer"></div> 
              
         <? 
		if ($IsOwner) {
		 foreach($GroupArray as $group) {
				echo '<div class="blue_links"><a href="/'.$FeedOfTitle.'/?tab=network&s=groups&a=edit&gid='.$group['GID'].'">'.$group['Title'].'</a></div>'; 
		 }}?>
		<? if ($_SESSION['username'] == $FeedOfTitle) {?>
        <div class="spacer"></div>  <div class="spacer"></div> 
        <a href="javascript:void(0)" onclick="window.location='/<? echo trim($_SESSION['username']);?>/?tab=network&s=groups&a=new';"><img src="http://www.wevolt.com/images/new_group.png" border="0"/></a><div class="spacer"></div>
         <a href="javascript:void(0)" onclick="invite_friends();"><img src="http://www.wevolt.com/images/invite_friends_box.png" border="0"/></a>
		<? }?><div class="spacer"></div><div class="spacer"></div>
      
     
<div class="spacer"></div>