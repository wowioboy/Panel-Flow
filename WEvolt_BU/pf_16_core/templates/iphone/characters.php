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
$Pagetracking = 'Characters'; 
$Section = 'Characters';


$chardb = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "select * from characters where ComicID = '$ComicID'";
$charstring = "<table width ='100%' cellspacing='0' cellpadding='0' border='0' margin ='0'><tr>";
$avatarcnt = 0;
$chardb->query($query);
while ($character = $chardb->fetchNextObject()) { 
$DlThumb = $character->Thumb;
$Downname = $character->Name;
$Filename = $character->Filename;
	$charstring .= "<td align='center'><div class='downloadimage'><a href='/".$SafeFolder."/iphone/characters/?id=".$character->ID."'><img src='/comics/".$ComicFolder.'/'.$DlThumb."' width='100' height='100' style='border:#000000 1px solid;'></a></div><div class='dltitle'>".$Downname."</div><div class='spacer'></div></td>";
	 $avatarcnt++;
	 if ($avatarcnt == 2){
	 	$charstring .= "</tr><tr>";
 		$avatarcnt = 0;
 	}	
	
}
 $charstring .= "</tr></table>";

if (isset($_GET['id'])) {
$CharID = $_GET['id'];
$query = "select * from characters where ComicID = '$ComicID' and ID='$CharID'";
$Smallbaseurl = '/comics/'.$ComicFolder.'/iphone/images/characters/320/';
$Largebaseurl = '/comics/'.$ComicFolder.'/iphone/images/characters/480/';
$CharacterArray = $chardb->queryUniqueObject($query);
			$CharName = stripslashes($CharacterArray->Name);
			$Title = ' Characters | '.$CharName;
			$CharAge = $CharacterArray->Age;
			$CharTown = stripslashes($CharacterArray->Hometown);
			$CharRace = stripslashes($CharacterArray->Race);
			$CharHeight = $CharacterArray->HeightFt."' ".$CharacterArray->HeightIn."''";
			$CharWeight = $CharacterArray->Weight;
			$CharAbility = stripslashes($CharacterArray->Abilities);
			$CharDesc = stripslashes($CharacterArray->Description);
			$CharNotes = stripslashes($CharacterArray->Notes);
			$Image = $CharacterArray->Filename;
			$CharImage = $Largebaseurl.$Image;

}
$chardb->close();
$BGcolor = substr($MovieColor, 2, 6); 
$UserType = $_SESSION['usertype'];


?>
<? if (isset($_GET['id'])) {?>
<script type="text/javascript" language="javascript">
	function listtab()
	{		
			//Activate TR
	        document.getElementById("trlist").style.display = '';
			//Change Style of Tab
			document.getElementById("listtab").className ='ActiveStyle';

			//DeActivate TR
			document.getElementById("trstats").style.display = 'none';
			//Change Style of Tab
			document.getElementById("statstab").className ='NonActiveStyle';
			//DeActivate TR
			
	}
	function statstab()
	{		
			//Activate TR
	        document.getElementById("trlist").style.display = 'none';
			//Change Style of Tab
			document.getElementById("listtab").className ='NonActiveStyle';

			//DeActivate TR
			document.getElementById("trstats").style.display = '';
			//Change Style of Tab
			document.getElementById("statstab").className ='ActiveStyle';
			//DeActivate TR
			
	}
</script>
<? }?>
<? include 'includes/header.php';?>

<div id="topbar" style="background-color:#<? echo substr($TextColor, 2, 6);?>">

<table id="topmenu" cellpadding="0px" cellspacing="0px;">
		<tr>
			<td id="startbutton"></td>
            <td class="buttonfield"><a href="/<? echo $SafeFolder;?>/iphone/?id=<? echo $NextPage; ?>">
			<img alt="Home" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/Home.png" /></a></td>
            <td id="buttonend"></td>
		</tr>
	</table>

    
<div id="title" style="background-color:#<? echo substr($BarColor, 2, 6);?>; color:#<? echo substr($TextColor, 2, 6);?>;"><? echo $ComicTitle;?></div>
</div>
<? if (isset($_GET['id'])) {?>
<table width='100%' cellspacing=0 cellpadding=0 border=0>
  		<tr>
    	<td width='25%' id='listtab' class='ActiveStyle' height="30" onClick="listtab()">Character</td>
    	<td  width='25%'id='statstab' class='NonActiveStyle' height="30" onClick="statstab()" >Stats</td>
    	</tr>
        </table> 
<? }?>
  <div id="page_wrapper">
<div id="content">

		<? include 'characters_content_normal.php';?>
  

	<ul class="menu"><div class="graytitle">Navigation </div>
     <li><a href="/<? echo $SafeFolder;?>/iphone/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Back to Comic</span><span class="arrow"></span></a></li>
     <? if ($Downloads > 0) {?>
<li><a href="/<? echo $SafeFolder;?>/iphone/downloads/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Downloads</span><span class="arrow"></span></a></li><? }?>
    <? if ($Extras > 0) {?>
<li><a href="/<? echo $SafeFolder;?>/iphone/extras/"><img alt="" src="/<? echo $PFDIRECTORY;?>/templates/iphone/images/comic.png" /><span class="menuname">Extras</span><span class="arrow"></span></a></li><? }?>
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
            <li><a href="/logout/" ><span class="menuname">Logout</span><span class="arrow"></span></a></li>
         <li><a href="/iphone/profile/<? echo $_SESSION['username'];?>/" target="_blank"><span class="menuname">My Profile</span><span class="arrow"></span></a></li>
         <? }?>
	</ul>
	
</div>
</div>
<? include 'includes/footer.php';?>
