<?php
$db = new Danb();
$query = "select u.content_id as id, u.link, p.thumb, us.username as user,  actiontype as action, u.actionsection as subject, p.title, p.rating, i.time
from
(   select max(id) as 'i', max(if(live_date is not null and live_date > `date`, `live_date`, `date`)) as 'time'
    from updates
    where ((actionsection = 'series' or actionsection = 'strip' or actionsection = 'page' or actionsection='image gallery')
    and content_id is not null 
    and content_id != ''
    and if(live_date is not null and live_date != '0000-00-00 00:00:0000', live_date, date) <= now())
    group by content_id, actionsection
    order by time desc    
    limit 10
) as i
left join updates u 
on u.id = i.i 
left join users us 
on u.userid = us.encryptid 
left join projects p 
on (u.content_id = p.projectid and p.projectid != '') 
limit 10;";
$rows = $db->fetchAll($query);

	
?> 
<? /*
<script>
    function boink() {
		var firstItem = $('.feed_item:first')
		var user = firstItem.attr('user');
		$.getJSON('/ajax/feed.php', {user: ;user}, function(data) {
			if (data) {
				var id = data.id;
				var thumb = data.thumb;
				var user = data.user;
				var link = data.link;
				var action = data.action;
				var subject = data.subject;
				var title = data.title;
				var time = data.time;
				if (title.length > 15) {
					title = title.substring(0, 15) + '...';
				}
				// make title and date correct format and interval
				var html = '<div style="display:none;" class="feed_item" user="' + user + '"><div style="display:inline-block;">';
				<?php if ($_SESSION['userid']) : ?> 
				html += '<a href="javascript:void(0)" onclick="follow_content(\'' + id + '\',\'project\',\'follow_' + id + '\');"><img src="http://www.wevolt.com/images/vert_sm_follow.png" id="follow_' + id + '" border="0"></a>';
			    <?php endif; ?>
			    html += '</div><div style="display:inline-block;padding-left:2px;padding-right:2px;">' + 
			    '<img src="' + thumb + '" width="34" height="34" /></div><div style="display:inline-block;">' 
			    + '<a href="http://users.wevolt.com/' + user + '/">' + user + '</a><br />' + 
			     action + ' ' + subject + ': <a href="' + link + '">' + title + '</a><br />' + time + '</div></div>';
			    $('#feed_holder').prepend(html);
				$('.feed_item:last').slideUp('normal', function(){
					$(this).remove();
				});
				$('.feed_item:first').slideDown();
			}
		});
	}
$(document).ready(function(){
	setInterval("boink();", 5000);
});
</script>
<? */?>
<style>
.feed_item {
	font-size:10px;
	font-family:Arial, Helvetica, sans-serif;
	
}
.feed_date {
	color:#666;	
}
</style>
<div align="left" id="feed_holder">
<?php 
$RCount=1;
if (count($rows) > 0) : ?>
<?php foreach ($rows as $row) : ?>
  <?php 
    $date = new DateTime($row['time']); 
    $id = $row['id'];
	if (substr($row['thumb'],0,4) != 'http')
    $thumb = 'http://www.wevolt.com' . $row['thumb'];
	else 
	$thumb = $row['thumb'];
   // if (!is_array(@getimagesize($thumb))) {
		//$thumb = "http://www.wevolt.com/images/no_thumb_project.jpg";	
	//}
    $link = $row['link'];
    $action = $row['action'];
    $subject = $row['subject'];
    $title = stripslashes($row['title']);
    if (strlen($title) > 25) {
    	$title = substr($title, 0, 25) . '...';
    }
    $user = $row['user'];
	
	if ($row['rating'] != 'a'){
		
		
		
		if ($RCount < 6) {
		
  ?>
  <div class="feed_item" user="<?php echo $user; ?>">
    <div style="display:inline-block; width:17px;">
    <?php if ($_SESSION['userid']) :
			$newDB = new DB();
    		$query = "select count(*) from follows where user_id='".$_SESSION['userid']."' and follow_id='".$id."' and type='project'";
			$IsFollowing = $newDB->queryUniqueValue($query);
			$newDB->close();
			if ($IsFollowing == 0) {?>
                 <a href="javascript:void(0)" onclick="follow_content('<?php echo $id; ?>','project','follow_<?php echo $id; ?>');">	
                <img src="http://www.wevolt.com/images/vert_sm_follow.png" id="follow_<?php echo $id; ?>" border="0">
                </a>
   			 <? } else {?>
				f<br/>a<br/>n 
			 <? }?>
    <?php endif; ?>
    </div>
    <div style="display:inline-block; width:34px;">
        <img src="<?php echo $thumb; ?>" width="34" height="34" title="thumb"/>
    </div>
    <div style="display:inline-block;">
	           <a href="http://users.wevolt.com/<?php echo $user; ?>/"><?php echo $user; ?></a>
	           <br />
              <?php echo $action; ?> <?php echo $subject; ?> <? if ($subject == 'page') echo 'to ';?> <a href="<?php echo $link; ?>"><?php echo $title; ?></a>
              <br />
			  <span class="feed_date"><?php echo ($subject == 'page') ? $date->format('F jS, Y') : $date->format('F jS, Y @ g:i a'); ?></span>
	           
      
    </div>
    <div style="height:5px;"></div>
  </div>
<?php }$RCount++;}endforeach; ?>
<?php else: ?>
No recent updates.
<?php endif; ?>
</div>