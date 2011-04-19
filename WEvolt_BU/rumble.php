<? 
require_once('includes/init.php');
$TrackPage = 1;
$CurrentRound = 'round_three';

$CurrentWeek = 'lord';
$MaxWeek = 4;
$MaxRound = 3;

	$PageTitle .= 'weekly rumble';
$IsRumble = true;
require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

?>

<div align="center">
<table cellpadding="0" cellspacing="0" border="0">
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
    <? if ($CurrentWeek == 'lord') {
     
			?>
            <div style="padding-left:26px;">
     <table cellpadding="0" cellspacing="0" width="100%" border="0"><tr>
       <td valign="top">
       <img src="/images/rumble_top.png" />
   
       </td>
       </tr>
       <tr>
       <td valign="top" style="background-image:url(/images/rumble_bottom.png); background-repeat:no-repeat; width:1005px; height:498px;">
       <table width="100%" cellpadding="0" cellspacing="0"><tr><td width="425"></td>
       <td valign="top" align="center">
       <div class="spacer"></div>
       <img src="/images/contenders_2.png" /><div class="spacer"></div>
 <? $query = "SELECT p.title, r.signup_date, u.username,u.avatar,p.thumb,p.SafeFolder
	                from rumble_entries as r
					join projects as p on r.project_id=p.ProjectID
					join users as u on p.userid=u.encryptid
					where r.round_one_rank=1 or r2_w1_rank=1 or r2_w2_rank=1 or r2_w3_rank=1 or r2_w4_rank=1 or r3_w1_rank=1 or r3_w2_rank=1 or r3_w3_rank=1 or r3_w4_rank=1 order by ordering ASC";
					
		$InitDB->query($query);	
		echo '<table width="99%" cellspacing="10"><tr>';
 		$Count = 1;
		while ($project = $InitDB->fetchNextObject()){
				echo '<td width="33%" class="nav_links_white"><a href="/'.$project->SafeFolder.'/"><img src="http://www.wevolt.com'.$project->thumb.'" width="75" height="75" vspace="3"><br/><b>'.$project->title.'</b></a><br/><em><a href="http://users.wevolt.com/'.$project->username.'/">'.$project->username.'</a></em></td>';	
				$Count++;
				if ($Count == 4) {
					$Count = 1;
					echo '</tr><tr>';	
					
				}
		}
			echo '</table>';?>
            </td></tr></table>
       </td>
       </tr>
       </table>
        
    </div>
    <? } else {?>
        <? if ($_GET['s'] == '') {?>
    
      
       <img  src="http://www.wevolt.com/images/battle_page_1.gif" border="0" usemap="#Map" />
<map name="Map" id="Map">
  <area shape="rect" coords="836,611,973,653" href="/rumble.php?s=faq" />
  <area shape="rect" coords="833,562,978,609" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="822,518,979,557" href="/rumble.php?s=signup" />
  <area shape="rect" coords="825,467,975,508" href="/rumble.php?s=details" />
  <area shape="rect" coords="828,417,977,458" href="/rumble.php?s=leaderboard" />
</map>

      
       
         <? } else  if ($_GET['s'] == 'details') {?> 
       
        <img src="http://www.wevolt.com/images/battle_page_2.gif" border="0" usemap="#Map" />
<map name="Map" id="Map">
  <area shape="rect" coords="836,611,973,653" href="/rumble.php?s=faq" />
  <area shape="rect" coords="833,562,978,609" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="822,518,979,557" href="/rumble.php?s=signup" />
  <area shape="rect" coords="825,467,975,508" href="/rumble.php?s=details" />
  <area shape="rect" coords="828,417,977,458" href="/rumble.php?s=leaderboard" />
</map>

        <? } else if ($_GET['s'] == 'competitors') {?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      <td valign="top" align="left" style="padding-left:13px;"><img src="http://www.wevolt.com/images/rumble_title.jpg" border="0"  /><div class="spacer"></div>
   
       <div align="center" style="padding-left:40px;">
 <img src="http://www.wevolt.com/images/lord_rumble_board.png" />
      </div>
       </td>
       <td valign="top">
        
       <div style="height:100px;"></div>
       <? 
	  
	   $query = "SELECT p.title, r.signup_date, u.username,u.avatar,p.thumb,p.SafeFolder
	                from rumble_entries as r
					join projects as p on r.project_id=p.ProjectID
					join users as u on p.userid=u.encryptid
					where r.active=1 order by r.signup_date ASC";
					
		$InitDB->query($query);	
		?>
        <table><tr><td valign="top" style="padding-left:15px;">
        <img src="http://www.wevolt.com/images/sign_up_list.png" />
   
        <div style="width:350px;height:500px; overflow:auto;">
         <table width="100%" cellpadding="5" cellspacing="5">
         <tr><td colspan="2" width="125"><img src="http://www.wevolt.com/images/username_title.png" /><td width="5"></td><td colspan="2" width="125">  <img src="http://www.wevolt.com/images/project_title.png" /></td></tr>
        <?
		while ($project = $InitDB->fetchNextObject()){
				echo '<tr><td width="25"><img src="'.$project->avatar.'" width="20" height="20" ></td><td width="100" class="nav_links_white"><a href="http://users.wevolt.com/'.$project->username.'/">'.$project->username.'</td><td width="5"></td><td width="20"><img src="http://www.wevolt.com'.$project->thumb.'" width="20" height="20"></td><td class="nav_links_white"><a href="/'.$project->SafeFolder.'/">'.$project->title.'</a></td></tr>';	
		}
					?>
                        </table>
                    </div>
                    </td><td valign="top" style="padding-top:330px;">
                      

<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map>

                    </td></tr></table>
       </td>
       </tr>
       </table>
        
</div>
  
         <? } else if ($_GET['s'] == 'leaderboard') {?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      
       <td valign="top">
       <? 
	    $eventId = 'week-' . date('W');
	   $query = "select p.title, p.thumb, p.SafeFolder, re.project, SUM(re.likes) as TotalLikes from 
	   				rumble_entries_stats as re 
					join projects as p on re.project=p.SafeFolder 
					where re.`week`='$eventId'
					group by re.project 
					order by TotalLikes desc";
					
		$InitDB->query($query);	
		
		?>
       <div align="center" style="padding-left:50px;padding-top:25px;">
         <img src="http://www.wevolt.com/images/<? echo $CurrentRound;?>_header.png" />&nbsp;&nbsp;<img src="http://www.wevolt.com/images/<? echo $CurrentWeek;?>_header.png" /> <div class="spacer"></div>
         <div class="spacer"></div>
         
      
        <?
		$Count=1;
		function kshuffle(&$array) {
				if(!is_array($array) || empty($array)) {
					return false;
				}
				$tmp = array();
				foreach($array as $key => $value) {
					$tmp[] = array('k' => $key, 'v' => $value);
				}
				shuffle($tmp);
				$array = array();
				foreach($tmp as $entry) {
					$array[$entry['k']] = $entry['v'];
				}
				return true;
		}
		
		$TopFive = array();
		$Contenders = array();
		while ($project = $InitDB->fetchNextObject()){
			
			
			if ($Count < 6){
				$TopFive[] = array ('SafeFolder'=>$project->SafeFolder,'Title'=>$project->title,'Thumb'=>$project->thumb,'Likes'=>$project->TotalLikes);
				//echo '<a href="/'.$project->SafeFolder.'/" tooltip="'.$project->title.'"><img src="http://www.wevolt.com'.$project->thumb.'" width="90" height="90" hspace="6" vspace="6" style="border:1px #fff solid;"></a>';
			}else {
				$Contenders[] = array ('SafeFolder'=>$project->SafeFolder,'Title'=>$project->title,'Thumb'=>$project->thumb,'Likes'=>$project->TotalLikes);
				//echo '<a href="/'.$project->SafeFolder.'/" tooltip="'.$project->title.'"><img src="http://www.wevolt.com'.$project->thumb.'" width="68" height="68" hspace="5" vspace="5" style="border:1px #fff solid;"></a>';	
			}
			//if ($Count == 5)
				//echo '</div><div class="spacer"></div><div class="spacer"></div><img src="http://www.wevolt.com/images/contenders.png"><div style="width:600px;height:300px; overflow:auto;">';
		
			$Count++;		
		}
		
		


		kshuffle($TopFive);?>
         <div style="width:566px;height:168px; background-image:url(http://www.wevolt.com/images/top_five_box.png); background-repeat:no-repeat;">
          <div class="spacer"></div>
         <div class="spacer"></div>
         <div class="spacer"></div>
       
        <div class="spacer"></div><div class="spacer"></div>
        <?
		foreach($TopFive as $entry) {
			if ($entry['SafeFolder'] != '')
			echo '<a href="/'.$entry['SafeFolder'].'/" tooltip="'.$entry['Title'].'"><img src="http://www.wevolt.com'.$entry['Thumb'].'" width="90" height="90" hspace="6 vspace="6" style="border:1px #fff solid;"></a>';
			
			
		}?>
        </div>
        <div class="messageinfo_white">**Order above does not reflect ACTUAL position in top 5, just that they are in the top 5</div>
		<div class="spacer"></div><div class="spacer"></div><div class="spacer"></div>
         <div class="spacer"></div><img src="http://www.wevolt.com/images/contenders.png"><div style="width:600px;height:300px; overflow:auto;">
		<? foreach($Contenders as $entry) {
			if ($entry['SafeFolder'] != '')
			echo '<a href="/'.$entry['SafeFolder'].'/" tooltip="'.$entry['Title'].'"><img src="http://www.wevolt.com'.$entry['Thumb'].'" width="68" height="68" hspace="5" vspace="5" style="border:1px #fff solid;"></a>';
			
		}
		


		?> 
                     </div>  </div> 
                    </td>
                    
                    <td valign="top" style="padding-right:15px;" align="right">
                      <img src="http://www.wevolt.com/images/rumble_title_right.jpg" border="0"  /><div style="height:225px;"></div>


<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map>
                    </td></tr></table>
                    
    
        
</div>
  
         <? } else if ($_GET['s'] == 'winner') {
			 
			 $Week = $_GET['week'];
			 $Round = $_GET['round'];
			 
		
			 
			 
			 
			 ?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      
       <td valign="top">
       
       
       <? 
	   if (($Week <= $MaxWeek) &&($Round <= $MaxRound)){

	   
	   $query = "select p.title, p.thumb, p.cover, p.SafeFolder, re.project, SUM(re.likes) as TotalLikes from 
	   				rumble_entries_stats as re 
					join projects as p on re.project=p.SafeFolder
					where round='$Round' and  round_week='$Week'
					group by re.project 
					order by TotalLikes DESC limit 3";
					
		$InitDB->query($query);	
		 if ($Week == 1)
			 	$CurrentWeek = 'week_one';
			 if ($Week == 2)
			 	$CurrentWeek = 'week_two';
				 if ($Week == 3)
			 	$CurrentWeek = 'week_three';
				 if ($Week == 4)
			 	$CurrentWeek = 'week_four';
		?>
        <style type="text/css">
		.congrats {
			font-size:16px;
			color:#fff;
			font-weight:700;
			font-family:Arial, Helvetica, sans-serif;	
			
		}
		.money_text {
			font-size:16px;
			color:#fcb040;
			
			font-family:Arial, Helvetica, sans-serif;	
			
		}
		</style>
       <div align="center" style="padding-left:50px;padding-top:25px;">
         <img src="http://www.wevolt.com/images/<? echo $CurrentRound;?>_header.png" />&nbsp;&nbsp;<img src="http://www.wevolt.com/images/<? echo $CurrentWeek;?>_header.png" /> <div class="spacer"></div>
         <div class="spacer"></div>
         
        <div style="width:266px;height:301px; background-image:url(http://www.wevolt.com/images/winner_box.png); background-repeat:no-repeat;">
          <div class="spacer"></div>
         <div class="spacer"></div>
         <div class="spacer"></div>
       <div class="spacer"></div>
         <div class="spacer"></div><div class="spacer"></div>
         
        <?
		$Count=0;
		while ($project = $InitDB->fetchNextObject()){
			  $ProjectTitle = $project->title;
			  if ($Count == 0){
			  		echo '<a href="http://www.wevolt.com/'.$project->SafeFolder.'/"><img src="http://www.wevolt.com'.$project->cover.'" class="navbuttons" width="225" height="225"></a>';
			
					echo '</div></div> 
                    <div class="spacer"></div>
					 <div class="spacer"></div>
					 <div align="center" style="padding-left:35px;">
							  <span class="congrats">Congratulations to '.$ProjectTitle.'!</span><div class="spacer"></div>
							  <span class="money_text">They won $100 bucks!</span><div class="spacer"></div>
								<span class="congrats">But will they win the ENTIRE ROUND?</span>
								</div>';
					   
				 	echo '<div class="spacer"></div><div class="spacer"></div><div style="width:266px;padding-left:200px;" align="center"><span class="money_text">Honorable Mention</span><div class="spacer"></div>'; 
					
			   } else {
				   echo '<a href="http://www.wevolt.com/'.$project->SafeFolder.'/"><img src="http://www.wevolt.com'.$project->thumb.'" class="navbuttons" width="100" height="100" vspace="5" hspace="5" tooltip="'.$ProjectTitle.'" style="border:1px #fff solid;"></a>';
				   
			   }
			   $Count++;
			  
			   	
				
			  		
			}		
		
		
?>
</div>
       
                   
                    <? } else {?>
                    Those results are not available yet. 
                    
                    <? }?>
                    </td>
                    
                    <td valign="top" style="padding-right:15px;" align="right">
                      <img src="http://www.wevolt.com/images/rumble_title_right.jpg" border="0"  /><div style="height:225px;"></div>


<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map>
                    </td></tr></table>
                    
    
        
</div>
  
         <? } else if ($_GET['s'] == 'preview') {
			 
			 $Round = $_GET['round'];
			 
			 
			 ?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      
       <td valign="top">
       
       
       <? 
	  

	   
	   $query = "select p.title, p.thumb, p.cover, p.SafeFolder, re.project_id, re.preview_cover,re.rumble_pdf from 
	   				rumble_entries as re 
					join projects as p on re.project_id=p.ProjectID
					where re.round_".$Round."_rank=1";
					
		$WinnerArray = $InitDB->queryUniqueObject($query);	
		
		?>
        <style type="text/css">
		.congrats {
			font-size:16px;
			color:#fff;
			font-weight:700;
			font-family:Arial, Helvetica, sans-serif;	
			
		}
		.money_text {
			font-size:16px;
			color:#fcb040;
			
			font-family:Arial, Helvetica, sans-serif;	
			
		}
		</style>
       <div align="center" style="padding-left:50px;padding-top:25px;">
         <img src="http://www.wevolt.com/images/round_<? echo $_GET['round'];?>_preview.png" /><div class="spacer"></div>
         <div class="spacer"></div>
         
          <img src="http://www.wevolt.com/<? echo $WinnerArray->preview_cover;?>" />
         <table width="60%" cellpadding="5" cellspacing="5">
             <tr>
                 <td align="center" class="messageinfo_white" style="padding:10px;">Download the free preview
of the WEvolt Rumble Series
Round <? echo $_GET['round'];?> winner:
<div class="spacer"></div>
  <a href="/panelflow/download_content.php?s=rumble&id=<? echo $WinnerArray->project_id;?>"><img src="http://www.wevolt.com/images/download_btn.png" border="0" /></a>
                 </td>
                 <td class="messageinfo_white" align="center" style="padding:10px;">Check out the full edition on WOWIO:
                 <div class="spacer"></div>
                 <a href="<? echo $WinnerArray->rumble_pdf;?>" target="_blank"><img src="http://www.wevolt.com/images/wowio_btn.png" border="0" /></a>
                 </td>
             </tr>
         </table>
       
       
                   
               
                    </td>
                    
                    <td valign="top" style="padding-right:15px;" align="right">
                      <img src="http://www.wevolt.com/images/rumble_title_right.jpg" border="0"  /><div style="height:225px;"></div>


<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map>
                    </td></tr></table>
                    
    
        
</div>
  
         <? } else  if ($_GET['s'] == 'signup') {?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      
      <td width="84%" align="center" valign="top">
      <div style="padding-left:247px;">
      <img src="http://www.wevolt.com/images/rumble_title_sm.jpg" border="0"  />
      </div>
      <div style="padding-left:200px;">
      <img src="http://www.wevolt.com/images/sign_up_title.png" />
      
      <div class="spacer"></div>
       <div style="height:440px;">
      <? if ($_SESSION['userid']=='') {?>
        <img src="http://www.wevolt.com/images/seeing_title.png" />
     
      <div class="spacer"></div>
      <table cellspacing="10">
      <tr>
      <td style="padding-left:50px;">
      <img src="http://www.wevolt.com/images/no_account.png" border="0" usemap="#Map2" />
<map name="Map2" id="Map2">
  <area shape="rect" coords="34,267,115,296" href="/register.php" />
</map>
      </td>
      <td>
     <img src="http://www.wevolt.com/images/have_account.png" border="0" usemap="#Map3" />
<map name="Map3" id="Map3">

  <area shape="rect" coords="59,267,145,293" href="javascript:void(0)"  onclick="pop_login('http%3A%2F%2Fwww.wevolt.com%2Frumble.php%3Fs%3Dsignup');return false;"/>
</map>

      </td>
      </tr>
      </table>
      
      
      
      <div class="spacer"></div>
     <div class="spacer"></div>
       <div align="center" style="padding-left:40px;">
  <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.wevolt.com%2Frumble.php&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;font=lucida+grande&amp;colorscheme=dark&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
      </div>
      
      <? } else {
		  
		  $query = "SELECT count(*) from rumble_entries where user_id='".$_SESSION['userid']."' and (round_one_rank is NULL || round_one_rank!=1)and (round_three_rank is NULL || round_three_rank!=1)and (round_two_rank is NULL || round_two_rank!=1) and active=1";
		 
		  $AlreadySubmitted = $InitDB->queryUniqueValue($query);
		 
		  if ($AlreadySubmitted == 0) {
				$query = "select * 
							from projects where installed = 1 and Hosted=1 and IsPublic=1 and (CreatorID ='".$_SESSION['userid']."' or userid='".$_SESSION['userid']."') and ProjectType ='comic' ORDER BY title ASC";
				$InitDB->query($query);
				echo '<div class="spacer"></div>
          <div class="yellow_title">Select a project below to enter into the WEvolt weekly rumble.</div>
           <div class="spacer"></div>
     <div class="spacer"></div>';
	 
				while ($line = $InitDB->fetchNextObject()) {  
					echo "<a href=\"#\" onclick=\"apply_rumble('".$line->ProjectID."','".$CurrentRound."');\"><img src=\"http://www.wevolt.com/".$line->thumb."\" border=\"2\" style=\"border-color:#000000;\" width=\"100\" height=\"100\" vspace=\"5\" hspace=\"5\"></a>"; 
				}
 				
			  
			  
		  } else {
			  $query = "SELECT r.*,p.title,p.thumb,p.SafeFolder from rumble_entries as r
			  join projects as p on r.project_id=p.ProjectID
			  where r.user_id='".$_SESSION['userid']."' and r.".$CurrentRound."=1 and r.active=1";
		  $ProjectArray = $InitDB->queryUniqueObject($query);
			  
			  ?>
           <div class="spacer"></div>
     <div class="spacer"></div>
          <div class="yellow_title">You already have a project in the Rumble!</div>
          <div class="spacer"></div>
		  <div class="yellow_title"><? echo $ProjectArray->title;?></div>
          
<a href="http://www.wevolt.com/<? echo $ProjectArray->SafeFolder;?>"><img src="http://www.wevolt.com<? echo $ProjectArray->thumb;?>" class="navbuttons"/></a>
           <div class="spacer"></div>
     <div class="spacer"></div>
          <? }
		  ?>
      
      
      
      <? }?>
      </div>
      </div>
       </td>
        <td width="200" valign="bottom">
        
    
     
<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map><div class="spacer"></div><div class="spacer"></div> <div class="spacer"></div><div class="spacer"></div></td>
       </tr>
     
       </table>
        
</div>
  
         <? } else  if ($_GET['s'] == 'faq') {?>
       <div style="background-image:url(images/battle_bg.gif); background-repeat:no-repeat; height:681px; width:1006px;">
       <table cellpadding="0" cellspacing="0" width="100%"><tr>
      <td width="39%" align="left" valign="top" style="padding-left:25px; padding-top:30px;">
      <img src="http://www.wevolt.com/images/registration_faq.png" border="0" usemap="#Map"/>
<map name="Map" id="Map">
  <area shape="rect" coords="114,158,348,186" href="http://www.wevolt.com/register.php?a=pro" />
</map>
  
      <div class="spacer"></div>
       <img src="http://www.wevolt.com/images/facebook_faq.png" />
       </td>
       <td width="61%" valign="top"  align="right">
       <div style="padding-right:22px;">
       <img src="http://www.wevolt.com/images/faq_title.jpg" />
       </div>
       <table width="598"><tr>
       <td width="431" valign="top" align="center">
       <img src="http://www.wevolt.com/images/ownership_faq.png" />
       </td>
        <td width="155" valign="top" style="padding-right:5px; padding-bottom:10px;"> 
        
        <div style="height:100px;"></div><div style="height:100px;"></div><div style="height:80px;"></div>
    
<img src="http://www.wevolt.com/images/rumble_buttons_new.png"  border="0" usemap="#Map" />
<map name="Map" id="Map">

  <area shape="rect" coords="1,-1,150,40" href="/rumble.php?s=leaderboard" />
  <area shape="rect" coords="0,47,150,88" href="/rumble.php?s=details" />
  <area shape="rect" coords="0,99,157,138" href="/rumble.php?s=signup" />
  <area shape="rect" coords="-10,142,135,189" href="/rumble.php?s=competitors" />
  <area shape="rect" coords="-4,190,141,267" href="/rumble.php?s=faq" />
</map>
           
         </td>
         </tr>
         </table>
 
       </td>
                    
       
       </tr>
       </table>
        
</div>
  
        <? }?>  
        <? }?>                     
      </td>
            
            </tr>
         </table>       
 

	</td>
  </tr>
  
</table>
</div>
  
<?php require_once('includes/pagefooter_inc.php'); ?>


