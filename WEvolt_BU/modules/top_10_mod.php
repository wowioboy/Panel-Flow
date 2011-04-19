<?php
if ($mVersion ==2) {
		
	$iwidth=86;
	$iheight=86;	
	} else {
		$iwidth=55;
		$iheight=82;	
		
		
	}
	$string = '';
if ($mVersion!=2) 
echo'<table><tr>';
if ($ModContent == 'forums') {
} else {
	
	switch ($ModContent) {
		case 'comics':
			$where = " and c.pages > 0 and c.projecttype = 'comic' ";
			break;
		case 'writing':
			$where = " and c.pages > 0 and c.projecttype = 'writing' ";
			break;
		case 'blogs':
			$where = " and c.projecttype = 'blog' ";
			
		case '':
			$where = " and c.pages > 0 and c.projecttype != 'forum' ";
	}
	
	if ($_SESSION['overage'] == 'N' || $_SESSION['overage'] == '') {
		$where .= " and c.rating != 'a' ";
	}
	$query = "select * from projects as c
			 
			  where c.installed = 1 and c.Published = 1 and IsPublic=1 and c.Ranking !=0 and c.ShowRanking=1 and c.Hosted = 1 ". $where." 
			  ORDER BY c.Ranking ASC limit 10";
			
	$results = @$InitDB->fetchAll($query);
	
	foreach ($results as $i => $row) {
		$ProjectThumb = $row['thumb'];
//		$ProjectThumb = 'http://www.wevolt.com'.$comic['thumb'];
//		if (!is_array(@getimagesize($ProjectThumb))) {
//			$ProjectThumb = "/images/no_thumb_project.jpg";	
//		}
if ($mVersion!=2) 
		echo '<td align="center" valign="top" width="100"><div class="small_text">'.($i+1).'</div><a href="http://www.wevolt.com/'.$row['SafeFolder'].'/"><img src="http://www.wevolt.com'.$ProjectThumb.'" width="'.$iwidth.'" height="'.$iheight.'" border="0"></a><div class="small_blue_title">'.$row['title'].'</div></td>';
		else 
		echo '<a href="http://www.wevolt.com/'.$row['SafeFolder'].'/"><img src="'.$ProjectThumb.'" width="'.$iwidth.'" height="'.$iheight.'" border="0" tooltip="<h2>'.$row['title'].'</h2>'.$row['synopsis'].'"></a>';
	}
}
if ($mVersion!=2) 
echo '</tr></table>';
//echo $string;
