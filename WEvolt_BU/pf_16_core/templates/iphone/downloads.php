<? 
$config = array();
$SafeFolder = $_GET['comic'];
include '../../includes/config.php';
include '../../../includes/tracking_functions.php';

$AdminUser = $config['adminusername'];
$AdminEmail = $config['adminemail'];
$ComicID = $config['comicid'];
$CreatorID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
include "../../includes/db.class.php";	
include 'includes/iphone_init.php';
include_once('../common/includes/comic_functions.php');
$PageTitle = 'Iphone Version';
$Pagetracking = 'Downloads'; 
$Section = 'Downloads';




$downloaddb = new DB($db_database,$db_host, $db_user, $db_pass);
$deskstring = "";
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 1";
$downloaddb->query($query);
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Filename;
$Smallbaseurl = '/comics/'.$ComicFolder.'/iphone/images/downloads/desktops/320/';
$Largebaseurl = '/comics/'.$ComicFolder.'/iphone/images/downloads/desktops/480/';
$DLDescription = stripslashes($download->Description);
	$deskstring .= "<div class='downloadimage'><img src='".$Smallbaseurl.$DlThumb."'  border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='/comics/".$ComicFolder."/".$DlImage."' target='blank'>[download]</a><div class='spacer'></div>";
}
 
$coverstring = "";
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 2";
$downloaddb->query($query);
$Smallbaseurl = '/comics/'.$ComicFolder.'/iphone/images/downloads/covers/320/';
$Largebaseurl = '/comics/'.$ComicFolder.'/iphone/images/downloads/covers/480/';
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Filename;
$DLDescription = stripslashes($download->Description);
	$coverstring .= "<div class='downloadimage'><img src='".$Smallbaseurl.$DlThumb."' width='150' height='175' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href='../".$DlImage."' target='blank'>[download]</a><div class='spacer'></div>";

}

$avatarstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$avatarcnt = 0;
$query = "select * from comic_downloads where ComicID = '$ComicID' and DlType = 3";
$downloaddb->query($query);
while ($download = $downloaddb->fetchNextObject()) { 
$DownID = $download->ID;
$Downname = $download->Name;
$DlType = $download->DlType;
$DlResolution = $download->Resolution;
$DlImage = $download->Image;
$DlThumb = $download->Thumb;
$DLDescription = stripslashes($download->Description);
	$avatarstring .= "<td width ='100'><div class='downloadimage'><img src='../".$DlThumb."' width='100' height='100' border='1' style='border-color:#000000;'></div><div class='dltitle'>".$Downname."</div><div class='dllink'><a href=../'".$DlImage."' target='blank'>[download]</a><div class='spacer'></div></td>";
	 $avatarcnt++;
 if ($avatarcnt == 2){
 $avatarstring .= "</tr><tr>";
 $avatarcnt = 0;
 }	
}
 $avatarstring .= "</table>";
$downloaddb->close();
$BGcolor = substr($MovieColor, 2, 6); 
$UserType = $_SESSION['usertype'];


?>
<script type="text/javascript" language="javascript">
function desktopstab()
	{		
			//Activate TR
	       document.getElementById("trdesktops").style.display = '';
			//Change Style of Tab
			document.getElementById("desktoptab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("trcovers").style.display = 'none';
			//Change Style of Tab
			document.getElementById("coverstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("travatars").style.display = 'none';
			//Change Style of Tab
			document.getElementById("avatarstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
	function coverstab()
	{		
	//Activate TR
	        document.getElementById("trdesktops").style.display = 'none';
			//Change Style of Tab
			document.getElementById("desktoptab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcovers").style.display = '';
			//Change Style of Tab
			document.getElementById("coverstab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("travatars").style.display = 'none';
			//Change Style of Tab
			document.getElementById("avatarstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
	function avatarstab()
	{		
			//Activate TR
	        document.getElementById("trdesktops").style.display = 'none';
			//Change Style of Tab
			document.getElementById("desktoptab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcovers").style.display = 'none';
			//Change Style of Tab
			document.getElementById("coverstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("travatars").style.display = '';
			//Change Style of Tab
			document.getElementById("avatarstab").className ='ActiveStyle';
			//DeActivate TR
			
	}
</script>
<? include 'includes/header.php';?>
<div id="topbar" style="background-color:#<? echo substr($TextColor, 2, 6);?>">
<? if ($CurrentIndex > 0) {?>
<table id="topmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="startbutton"></td>
            <td class="buttonfield"><a href="/<? echo $SafeFolder;?>/iphone/">
			<img alt="Home" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/Home.png" /></a></td>
            <td id="buttonend"></td>
		</tr>
	</table>
    	<? }?>
     <? if ($CurrentIndex < ($TotalPages-1)) {?>
	<table id="toprightmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="buttonbegin"></td>
		<td class="buttonfield"> <a href="/<? echo $SafeFolder;?>/iphone/">
			<img alt="Home" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/Home.png" /></a></td>
			<td id="buttonstartright"></td>
		</tr>
	</table> 
    <? }?>
<div id="title" style="background-color:#<? echo substr($BarColor, 2, 6);?>; color:#<? echo substr($TextColor, 2, 6);?>;"><? echo $ComicTitle;?></div>
</div>
<table width='100%' cellspacing=0 cellpadding=0 border=0>
  		<tr>
    	<td width='25%' id='desktoptab' class='ActiveStyle' height="30" onClick="desktopstab()">Desktops</td>
    	<td  width='25%'id='coverstab' class='NonActiveStyle' height="30" onClick="coverstab()" >Covers</td>
    	<td width='25%' id='avatarstab' class='NonActiveStyle' height="30" onClick="avatarstab()">Avatars</td>
    	</tr>
        </table> 

  <div id="page_wrapper">
<div id="content">

		<? include 'downloads_content_normal.php';?>
  

	<ul class="menu"><div class="graytitle">Navigation </div>
    <li><a href="/<? echo $SafeFolder;?>/iphone/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Back to Comic</span><span class="arrow"></span></a></li>
    <? if ($Extras > 0) {?>
<li><a href="/<? echo $SafeFolder;?>/iphone/extras/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Extras</span><span class="arrow"></span></a></li><? }?>
<? if ($Characters > 0) { ?>
		<li><a href="/<? echo $SafeFolder;?>/iphone/characters/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/creator.png" /><span class="menuname">Characters</span><span class="arrow"></span></a></li>
       <? }?>
   <? if ($BioSetting == 1) { ?>      
        <li><a href="/<? echo $SafeFolder;?>/iphone/about/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/creator.png" /><span class="menuname">Creator</span><span class="arrow"></span></a></li>
        </ul>
        <? }?>
        <div class="spacer"></div><div class="graytitle">Account </div>
	<ul class="menu"> 
    <? if ($loggedin == 0) { ?>
        <li><a href="/iphone/login.php"><span class="menuname">Login</span><span class="arrow"></span></a></li>
        <li><a href="/iphone/register.php"><span class="menuname">Free Registration</span><span class="arrow"></span></a></li>
        	<? } else {?>
            <li><a href="/logout.php" ><span class="menuname">Logout</span><span class="arrow"></span></a></li>
         <li><a href="/iphone/profile/<? echo $_SESSION['username'];?>/" target="_blank"><span class="menuname">My Profile</span><span class="arrow"></span></a></li>
         <? }?>
	</ul>
	
</div>
</div>
<? include 'includes/footer.php';?>
