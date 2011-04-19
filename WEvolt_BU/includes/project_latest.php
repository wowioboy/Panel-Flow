
<table width="100%">
<tr>
<td width="441" style="padding-right:10px;" valign="top">
<? 
$query = "select cp.* from comic_pages as cp where cp.ComicID='".$ProjectID."' and cp.PublishDate<='".date('Y-m-d 00:00:00')."' order by cp.PublishDate DESC";
$LatestPageArray =  $InitDB->queryUniqueObject($query);
$PageLink = '/'.$SafeFolder.'/reader/';
if ($LatestPageArray->SeriesNum != 1)
	$PageLink .= 'series/'.$LatestPageArray->SeriesNum.'/';
	$PageLink .= 'episode/'.$LatestPageArray->EpisodeNum.'/page/'.$LatestPageArray->EpPosition.'/';

?>
                        
                        
<span class="dark_blue_header_med">Latest Page:</span><div class="medspacer"></div><span class="blue_cell_text"><? echo $LatestPageArray->Title;?></span><div class="spacer"></div>

<a href="<? echo $PageLink ;?>"><img src="/<? echo $LatestPageArray->ThumbLg;?>" width="400" style="border:1px solid #82c1ff;" /></a>
<div class="spacer"></div>

<td width="200" valign="top">
<span class="dark_blue_header_med">Update Feed:</span><div class="spacer"></div>
<? $db = new Danb();
				
					$NumItems = 6;
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
				<div align="left" id="feed_holder">
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
<div class="spacer"></div>
<? 
if ($ProjectType == 'blog') 
							$query = "select bc.*, u.username, u.avatar 
										from blogcomments as bc 
										LEFT join users as u on u.encryptid=bc.UserID
										where  bc.comicid='".$ProjectID."' ORDER BY bc.creationdate DESC";
						else 
							$query = "select pc.*,u.username,u.avatar, cp.title, cp.SeriesNum, cp.EpisodeNum,cp.EpPosition
									 from pagecomments as pc 
									 LEFT join users as u on u.encryptid=pc.userid
									 join comic_pages as cp on cp.EncryptPageID=pc.pageid
									 where  pc.comicid='".$ProjectID."' ORDER BY pc.creationdate DESC";
	
$LatestComment = $InitDB->queryUniqueObject($query);

if ($LatestComment->comicid != '') {
	$PageLink = '/'.$SafeFolder.'/reader/';
if ($LatestComment->SeriesNum != 1)
	$PageLink .= 'series/'.$LatestComment->SeriesNum.'/';
	$PageLink .= 'episode/'.$LatestComment->EpisodeNum.'/page/'.$LatestComment->EpPosition.'/';
	?>
<span class="dark_blue_header_med">Latest Comment:</span><br />
Content: <a href="<? echo $PageLink;?>"><? echo $LatestComment->title;?></a>
<table><tr>
<td valign="top"><img src="<? echo $LatestComment->avatar;?>" width="50"/></td>
<td valign="top"><? echo $LatestComment->comment;?></td>
</tr>
</table>

<? }?>

</td>
</tr>
</table>
