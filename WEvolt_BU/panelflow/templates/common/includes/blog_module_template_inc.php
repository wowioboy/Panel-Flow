<? 
 
//AUTHOR COMMENT MODULE 
$BlogModuleString ='';

if ($bcounter > 0 ) {
	$StringCounter = 0;
	if ($bcounter > 5)
		$BlogCounter = 5;
	else 
		$BlogCounter =$bcounter;
	 $BlogModuleString .='<div class="projectboxcontent" style="padding-left:10px;color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;" align="left">';
	while($StringCounter <$BlogCounter) {
	
	$BlogModuleString .='<b>'.stripslashes($blog_array[$StringCounter]->Title).'</b>';
	
	$BlogContent = @file_get_contents('http://www.panelflow.com/'.$blog_array[$StringCounter]->Filename);
	
	$BlogContent = preg_replace("/<img[^>]+\>/i", "", $BlogContent);
	$BlogContent = truncStringLink($BlogContent,280,' ','...[more]','/'.$ComicName.'/blog/'.$blog_array[$StringCounter]->EncryptID.'/');
	$BlogModuleString .= '<div style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;">posted: '.$blog_array[$StringCounter]->PublishDate.'</div>';
	
	$BlogModuleString .= '<div style="color:#'.$ContentBoxTextColor.';font-size:'.$ContentBoxFontSize.'px;border-bottom:dashed #'.$ContentBoxTextColor.' 1px; padding-top:5px;padding-bottom:5px;">'.$BlogContent.'</div>';
	
	$StringCounter++;
	}
$BlogModuleString .'</div>';
}

$HomeblogString =$BlogModuleString;

?>
