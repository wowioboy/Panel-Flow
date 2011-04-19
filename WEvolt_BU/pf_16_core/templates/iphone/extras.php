<? 
$config = array();
include '../includes/config.php';
$AdminUser = $config['adminusername'];
$AdminEmail = $config['adminemail'];
$ComicID = $config['comicid'];
$CreatorID = $config['adminuserid'];
$PFDIRECTORY = $config['pathtopf'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_database = $config['db_database'];
$db_host = $config['db_host'];
include "../../".$PFDIRECTORY.'/includes/db.class.php';	
include '../includes/iphone_init.php';
$PageTitle = 'Iphone Version';
$Pagetracking = 'Home'; 
$Section = 'Extras';
include_once("../../".$PFDIRECTORY.'/templates/common/includes/extras_functions.php');
$BGcolor = substr($MovieColor, 2, 6); 
$UserType = $_SESSION['usertype'];
if ($Section == 'Extras') { 
		$Smallbaseurl = 'images/extras/320/';
		$Largebaseurl = 'images/extras/480/';
} else { 
		$Smallbaseurl = 'images/pages/320/';
		$Largebaseurl = 'images/pages/480/';
}

?>
<script type="text/javascript" language="javascript">
function maintab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = 'none';
			//Change Style of Tab
			document.getElementById("creditstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = '';
			//Change Style of Tab
			document.getElementById("maintab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = 'none';
			//Change Style of Tab
			document.getElementById("commentstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
	function commentstab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = 'none';
			//Change Style of Tab
			document.getElementById("creditstab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = 'none';
			//Change Style of Tab
			document.getElementById("maintab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = '';
			//Change Style of Tab
			document.getElementById("commentstab").className ='ActiveStyle';
			//DeActivate TR
			
	}
	function creditstab()
	{		
			//Activate TR
	        document.getElementById("trcredits").style.display = '';
			//Change Style of Tab
			document.getElementById("creditstab").className ='ActiveStyle';
			//DeActivate TR
			document.getElementById("trmain").style.display = 'none';
			//Change Style of Tab
			document.getElementById("maintab").className ='NonActiveStyle';
			//DeActivate TR
			document.getElementById("trcomments").style.display = 'none';
			//Change Style of Tab
			document.getElementById("commentstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
</script>
<? include 'includes/header.php';?>

<div id="topbar" style="background-color:#<? echo substr($TextColor, 2, 6);?>">
<? if ($CurrentIndex > 0) {?>
<table id="topmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="startbutton"></td>
			<td class="buttonfield"> <a href="/<? echo $SafeFolder;?>/iphone/extras/?id=<? echo $PrevPage; ?>">Back</a></td>
            <td id="buttonend"></td>
		</tr>
	</table>
    	<? }?>
     <? if ($CurrentIndex < ($TotalPages-1)) {?>
	<table id="toprightmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="buttonbegin"></td>
		<td class="buttonfield"> <a href="/<? echo $SafeFolder;?>/iphone/extras/?id=<? echo $NextPage; ?>">Next</a></td>
			<td id="buttonstartright"></td>
		</tr>
	</table>
    <? }?>
<div id="title" style="background-color:#<? echo substr($BarColor, 2, 6);?>; color:#<? echo substr($TextColor, 2, 6);?>;"><? echo $ComicTitle;?></div>
</div>
<table width='100%' cellspacing=0 cellpadding=0 border=0>
  		<tr>
    	<td width='25%' id='maintab' class='ActiveStyle' height="30" onClick="maintab()">Pages</td>
    	<td  width='25%'id='creditstab' class='NonActiveStyle' height="30" onClick="creditstab()" >Credits</td>
    	<td width='25%' id='commentstab' class='NonActiveStyle' height="30" onClick="commentstab()">Comments</td>
    	</tr>
        </table> 

  <div id="page_wrapper">
<div id="content">

		<? include 'index_content_normal.php';?>
  

	<ul class="menu"><div class="graytitle">Navigation </div>
   

<li><a href="index.php"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Back to Comic</span><span class="arrow"></span></a></li>
<? if ($Characters > 0) { ?>
		<li><a href="/<? echo $SafeFolder;?>/iphone/characters/"<img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/creator.png" /><span class="menuname">Characters</span><span class="arrow"></span></a></li>
       <? }?>
   <? if ($Downloads > 0) { ?>     
        <li><a href="/<? echo $SafeFolder;?>/iphone/downloads/"<img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/creator.png" /><span class="menuname">Downloads</span><span class="arrow"></span></a></li>
  <? }?>
  <? if ($BioSetting == 1) { ?>      
        <li><a href="/<? echo $SafeFolder;?>/iphone/about/"<img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/creator.png" /><span class="menuname">Creator</span><span class="arrow"></span></a></li>
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
