<?php 

$PostID = $_GET['id'];
if ($PostID == "") {
	$PostID = $_POST['id'];
}
if ($PostID == "undefined") {
	$PostID = "";
}
$SideBarWidth = 300;

$CurrentDate = date('Y-m-d').' 00:00:00';

$query = "select count(*) from pfw_blog_posts where PublishDate='$CurrentDate' and ComicID = '$ComicID'";
$TodayBlog = $InitDB->queryUniqueValue($query);


$query = "select PublishDate from pfw_blog_posts where PublishDate<='$CurrentDate' and ComicID = '$ComicID' order by PublishDate DESC";
$LatestBlog = date('m.d.y',strtotime($InitDB->queryUniqueValue($query)));

$query = "select LatestPageHeader from template_skins where  SkinCode = '$SkinCode'";
$LatestPageHeader = $InitDB->queryUniqueValue($query);

$query = "select BlogButtonImage,BlogButtonBGColor,BlogButtonTextColor,BlogButtonRolloverImage from template_skins where  SkinCode = '$SkinCode'";
$BlogButtonArray = $InitDB->queryUniqueObject($query); 

$BlogButtonImage =$BlogButtonArray->BlogButtonImage;
$BlogButtonBGColor =$BlogButtonArray->BlogButtonBGColor;
$BlogButtonTextColor =$BlogButtonArray->BlogButtonTextColor;
$BlogButtonRolloverImage =$BlogButtonArray->BlogButtonRolloverImage;

if ($TodayBlog > 0) {
	
$query = "select bp.*, bc.Title as CategoryTitle 
		  from pfw_blog_posts as bp
		  join pfw_blog_categories as bc on bp.Category=bc.EncryptID
		  where bp.PublishDate='$CurrentDate' and bp.ComicID = '$ComicID'";
$TodayBlogArray = $InitDB->queryUniqueObject($query);

}



$query = "select distinct bp.*,bc.Title as CategoryTitle, (SELECT count(*) from blogcomments as bc where bc.PostID=bp.EncryptID and bc.ComicID=bp.ComicID) as CommentCount 
          from pfw_blog_posts as bp
		join pfw_blog_categories as bc on bp.Category=bc.EncryptID where bp.ComicID = '$ComicID' and ";
		
		if (isset($_GET['post']))
			$query .= "bp.EncryptID='".$_GET['post']."' ";
		else if (isset($_GET['category']))
			$query .= "bc.Title='".$_GET['category']."' ";
		else 	
		 $query .= "bp.PublishDate<='$CurrentDate' ";
		 
		$query .= "order by bp.PublishDate DESC";

$bcounter=0;
$blog_array = array();

$InitDB->query($query);

while ($setting = $InitDB->fetchNextObject()) { 
	
	$blog_array[$bcounter]->Title = $setting->Title;
	$blog_array[$bcounter]->Filename = 'http://'.$_SERVER['SERVER_NAME'].'/'.$setting->Filename;
    $blog_array[$bcounter]->Author = $setting->Author;
	$blog_array[$bcounter]->Category = $setting->CategoryTitle;
	$blog_array[$bcounter]->EncryptID = $setting->EncryptID;
	$blog_array[$bcounter]->PublishDate = date('m-d-Y',strtotime($setting->PublishDate));	
	$blog_array[$bcounter]->CommentCount = $setting->CommentCount;
	$bcounter++;
}


if ($Section == 'Blog') {
$query = "select * from pfw_blog_categories where ComicID = '$ComicID' order by Title";
		$InitDB->query($query);
		$CatString ='<table width="'.$SideBarWidth.'" border="0" cellspacing="0" cellpadding="0"><tr><td id="modtopleft"></td><td id="modtop"></td><td id="modtopright"></td></tr><tr><td id="modleftside"></td><td class="boxcontent" width="'.($SideBarWidth-($CornerWidth*2)).'" valign="top"><div class="modheader">Blog Categories</div>';
		
		$CatString .='<div clas="pagelinks">';
		while ($setting = $InitDB->fetchNextObject()) { 
			$CatString .='<a href="/'.$ComicName.'/blog/?category='.urlencode($setting->Title).'">'.stripslashes($setting->Title).'</a><br/>';
		}
		$CatString .='</div></td><td id="modrightside"></td></tr><tr><td id="modbottomleft"></td><td id="modbottom"></td><td id="modbottomright"></td></tr></table>';
$SidebarString =$CatString;
}


?>