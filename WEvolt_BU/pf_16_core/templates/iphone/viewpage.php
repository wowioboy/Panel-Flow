<? 
$config = array();
include '../includes/config.php';
$ComicID = $config['comicid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
include "../../".$PFDIRECTORY.'/includes/db.class.php';	
include '../includes/iphone_init.php';
$PageTitle = 'Iphone Version';
$Pagetracking = 'Home'; 
$Section = $_GET['s'];
include_once("../../".$PFDIRECTORY.'/templates/common/includes/comic_functions.php');
$BGcolor = substr($MovieColor, 2, 6); 

//print "MY PAGEIMAGE = " . $Image;
if ($Section == 'Extras') { 
		$PageImage = '../images/extras/';
} else { 
		$PageImage = '../images/pages/';
}

?>
<? include 'includes/header.php';?>

<div id="topbar" style="background-color:#<? echo substr($TextColor, 2, 6);?>">
<? if ($CurrentIndex > 0) {?>
<table id="topmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="startbutton"></td>
			<td class="buttonfield"> <a href="index.php?id=<? echo $PageID; ?>">Back</a></td>
            <td id="buttonend"></td>
		</tr>
	</table>
    	<? }?>
     <? if ($CurrentIndex < ($TotalPages-1)) {?>
	<table id="toprightmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="buttonbegin"></td>
		<td class="buttonfield"> <a href="index.php?id=<? echo $NextPage; ?>">Next</a></td>
			<td id="buttonstartright"></td>
		</tr>
	</table>
    <? }?>
<div id="title" style="background-color:#<? echo substr($BarColor, 2, 6);?>; color:#<? echo substr($TextColor, 2, 6);?>;"><? if ($HeaderImage != "" ) {?><img src="images/<?php echo $HeaderImage;?>" /><? } else {echo $ComicTitle;}?></div>
</div>


<div id="content">

		<? include 'large_content_normal.php';?>
  

	<ul class="menu"><div class="graytitle">Navigation </div>
    <? if ($Extras > 0) {?>
<li><a href="extras.php"><img alt="" src="images/comic.png" /><span class="menuname">Extras</span><span class="arrow"></span></a></li><? }?>
<? if ($Characters > 0) { ?>
		<li><a href="characters.php"><img alt="" src="images/creator.png" /><span class="menuname">Characters</span><span class="arrow"></span></a></li>
       <? }?>
   <? if ($Downloads > 0) { ?>     
        <li><a href="downloads.php"><img alt="" src="images/creator.png" /><span class="menuname">Downloads</span><span class="arrow"></span></a></li>
  <? }?>
  <? if ($BioSetting == 1) { ?>      
        <li><a href="about.php"><img alt="" src="images/creator.png" /><span class="menuname">Creator</span><span class="arrow"></span></a></li>
        </ul>
        <? }?>
        <div class="spacer"></div><div class="graytitle">Account </div>
	<ul class="menu"> 
    <? if ($loggedin == 0) { ?>
       <li><a href="login.php"><span class="menuname">Login</span><span class="arrow"></span></a></li>
        <li><a href="register.php"><span class="menuname">Free Registration</span><span class="arrow"></span></a></li>
        	<? } else {?>
            <li><a href="logout.php" ><span class="menuname">Logout</span><span class="arrow"></span></a></li>
         <li><a href="/iphone/profile/<? echo $_SESSION['username'];?>/" target="_blank"><span class="menuname">My Profile</span><span class="arrow"></span></a></li>
         <? }?>
	</ul>
	
</div>
<? include 'includes/footer.php';?>
