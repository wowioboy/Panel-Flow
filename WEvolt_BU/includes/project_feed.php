
<table width="100%">
<tr>
<td style="padding-right:10px;" valign="top" align="center">


<? $db = new Danb();
				
				$NumItems = 15;
				$query = "select u.content_id as id, u.link, p.thumb, p.Safefolder, u.UpdateType, u.ActionID, us.username as user, us.avatar, actiontype as action, u.actionsection as subject, p.title, i.time
				from
				(   select max(id) as 'i', max(if(live_date is not null and live_date > `date`, `live_date`, `date`)) as 'time'
					from updates
					where ((actionsection != '')
					
					and if(live_date is not null and live_date != '0000-00-00 00:00:0000', live_date, date) <= now())
					and content_id='$ProjectID'
					group by content_id, actionsection
					order by time desc    
					limit $NumItems
				) as i
				left join updates u 
				on u.id = i.i 
				left join users us 
				on u.userid = us.encryptid 
				left join projects p 
				on (u.content_id = p.projectid and p.projectid != '') 
				limit $NumItems;";
				
				$rows = $db->fetchAll($query);
				//print $query;
				?>
				<div align="left" id="feed_holder" style="width:400px;">
                <span class="dark_blue_header_med">Activity Feed:</span><div class="spacer"></div>
<?php if (count($rows) > 0) : ?>
<?php foreach ($rows as $row) : ?>
  <?php 
 
    $date = new DateTime($row['time']); 
    $id = $row['id'];
      $thumb =  $row['avatar'];
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
  ?>
  <div class="feed_item" user="<?php echo $user; ?>">
    
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
<?php endforeach; ?>
<?php else: ?>
No recent updates.
<?php endif; ?>
</div>
</td>
</tr>
</table>
