<div>
	<? $Site->drawHeaderSide();?>
     <div class="spacer"></div>
     <? if ($_SESSION['noads'] != 1) {?>
    <!--AD TAGS-->
    <iframe src="" allowtransparency="true" width="300" height="250" frameborder="0" scrolling="no" id="left_ads" name="left_ads"></iframe>
    <!--<a href="http://www.vgmarketsurveys.comm?campaign=wowio&adgroup=wv"><img src="/ads/vgm_wv_300x250.png" /></a>-->
<? } ?>
    <div align="right" style="padding-right:20px;">
       
        <div class="spacer"></div>
        
        <div align="right" style="padding-right:90px;">
        <img src="http://www.wevolt.com/images/project_header.png" />
           <!--<img src="http://www.wevolt.com/images/random_rumble.png" />-->
        </div>
        
         <div class="spacer"></div>
         <? $Site->drawSpotLight('project','side',$RumbleRound);?> 
         <div class="spacer"></div>
         <div class="spacer"></div>
        
         <div align="right" style="padding-right:90px;">
            <img src="http://www.wevolt.com/images/reccomends_header.png" />
         </div>
             
             <div class="spacer"></div>
             <? if ($IsProject) {
				 
				 $Project->getReccomendations($Tags, $Genre, $CreatorSays, $SafeFolder);
			 } else {
				 $Site->getReccomendationsCreator($SelfTags, $CreatorSays, $FeedOfTitle);
				 
			 }?>
           
    </div>

    <div class="spacer"></div>
    <div align="center" style="padding-right:15px;">
   <span class="blue_links"><a href="http://www.wevolt.com/wevolt.php">ABOUT</a></span>&nbsp;&nbsp;<span class="blue_links"><a href="http://www.wevolt.com/contact.php">CONTACT</a></span>&nbsp;&nbsp;
     <div class="spacer"></div> <table cellpadding="0" cellspacing="0"><tr><td>&nbsp;&nbsp;&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FWEvoltcom%2F133069580069900&amp;layout=button_count&amp;show_faces=false&amp;width=50&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
                </td>
                <td><a href="http://www.facebook.com/#!/group.php?gid=131247090248002&ref=ts" target="_blank"><img src="http://www.wevolt.com/images/fb_icon.png" border="0"/></a>
                </td>
                <td><a href="http://www.twitter.com/wevoltonline" target="_blank"><img src="http://www.wevolt.com/images/twitter_icon.png" border="0"/></a></td>
                <td width="30"></td>
               </tr></table>
               </div>
               <div style="padding-left:17px;">
    <? echo $Site->drawLegal();?>
    </div>
    <div class="spacer"></div>
     <div class="spacer"></div>
</div>
