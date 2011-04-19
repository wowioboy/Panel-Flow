<script type="text/javascript">
function togglebox(boxid) {
var currentschedule = document.getElementById('txtSchedule').value;
		if (document.getElementById(boxid).className =='boxoff') {
				document.getElementById(boxid).className ='boxon';
				
				if (currentschedule.length == 0) {
					currentschedule = boxid;
				} else {
					currentschedule = currentschedule + ','+boxid;
				}
			
			document.getElementById('txtSchedule').value= currentschedule;
			
			} else {
				document.getElementById(boxid).className ='boxoff';
				var schedulearray =currentschedule.split(",");
	 			var tempstring = '';
				for ( var i=schedulearray.length-1; i>=0; --i ){
					if (boxid != schedulearray[i]) {
						if (tempstring != '' ) 
          					tempstring = tempstring + ',';
						tempstring = tempstring + schedulearray[i];
					} 
				}
		 	document.getElementById('txtSchedule').value = tempstring;
			}
}
</script>

<div style="padding-left:25px; padding-right:25px;">Please enter your story title and the Folder for your story<br />
<br />
You will be able to enter all other information and credits for your story once the initial install is finished.  <br />
<div class="spacer"></div>
-----------STORY INFORMATION ----------------
 <div class="spacer"></div><div class="spacer"></div>
<form action="/story/create/" method="post">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="30%"><font style="font-size:14px; font-weight:bold;">Story Title</font></td>
     <td width="70%" style="padding-left:10px;">
	 <input name="comictitle" type="text" SIZE=40 id="comictitle"<?php if (isset($_POST['comictitle'])) { ?> value="<?php echo stripslashes($_POST['comictitle']); ?>" <?php } ?> /></td>
   </tr>
  <? if (($HostedAccount != 1)&&($HostedAccount != 0)){ ?>
  
   <tr>
     <td valign="top"><div class="spacer"></div><font style="font-size:14px; font-weight:bold;">Story Folder</font><br /></td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div><input SIZE=40 name="comicfolder" type="text" id="comicfolder"<?php if (isset($_POST['comicfolder'])) { ?> value="<?php echo $_POST['comicfolder']; ?>" <?php } ?> />
      <br />
      This should be the folder you want this story to install to off your main site, for example (http://www.yourdomain.com/MYFOLDER), just put in the folder name, no slashes, for instance MYFOLDER. If you want to run the comic off the main directory of your site, just enter a '/'. You will only be able to run one comic off the root of your domain.</td>
   </tr>
   <? }?>
     <tr>
     <td valign="top"><div class="spacer"></div>
     <font style="font-size:14px; font-weight:bold;">Story Format</font><br /></td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div><input type="radio" name="txtComicFormat" value="novel" checked />Novel &nbsp; <input type="radio" value="short" name='txtComicFormat'>Short Story
     </td>
   </tr>
    <tr>
     <td valign="top"><div class="spacer"></div>
     <font style="font-size:14px; font-weight:bold;">Update Schedule</font><br /></td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div>Click the days your story will update
     <table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
     <td id="mon" class="boxoff" onclick="togglebox(this.id);">MONDAY</td>
     <td id="tues" class="boxoff" onclick="togglebox(this.id);">TUESDAY</td>
     <td id="wed" class="boxoff" onclick="togglebox(this.id);">WEDNESDAY</td>
     <td id="thur" class="boxoff" onclick="togglebox(this.id);">THURSDAY</td>
     <td id="fri" class="boxoff" onclick="togglebox(this.id);">FRIDAY</td>
     <td id="sat" class="boxoff" onclick="togglebox(this.id);">SATURDAY</td>
     <td id="sun" class="boxoff" onclick="togglebox(this.id);">SUNDAY</td>
     <td id="ran" class="boxoff" onclick="togglebox(this.id);">RANDOM</td>
     
     
     </tr></table>
     </td>
   </tr>
   <tr>
     <td colspan="2" valign="top"><font style="font-size:14px; font-weight:bold;">Story Template</font><br />
	   <?
	   $counter = 0;
	   $TemplateArray = explode(',',trim(file_get_contents($ApplicationLink.'/connectors/get_templates.php')));
	 
 	echo "<table width='100%'><tr>"; 

 	$TemplatesFound = 0;
  foreach($TemplateArray as $templateitem ) {
  	$query = "SELECT * from templates where TemplateCode='$templateitem'";
	$TemplateInfoArray = $createDB->queryUniqueObject($query);
	
  	 echo "<td valign='top'><input type='radio' value='".$TemplateInfoArray->TemplateCode."' name='txtTemplate'";
	  if ($TemplateInfoArray->TemplateCode == 'TPL-001') {
	  	echo ' checked ';
	  }
	  
	 echo "><b>".$TemplateInfoArray->Title."</b><div align='left'><img class=\"photo\" src=\"/".$TemplateInfoArray->Image."\" alt=\"\" width=\"150\" height=\"150\" border='1'><br/>";
	  $counter++;
 	 	if ($counter == 4){
 			echo "</tr><tr>";
 			$counter = 0;
 		}
	}
	echo "</table>";
	  ?>      </td>
    </tr>
   <tr>
     <td colspan="2" valign="top"><div class="spacer"></div>
 <font style="font-size:14px; font-weight:bold;">Story Genres - [select all that apply]</font>
 <div class="spacer"></div></td>
    </tr>
     <tr>
     <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%"><input type="checkbox" id="g1" name="g1" value="Comedy" <?php if (isset($_POST['g1'])) { echo "checked"; }?> /></td>
    <td width="18%">Comedy</td>
    <td width="5%"><input type="checkbox" id="g2" name="g2" value="Fantasy" <?php if (isset($_POST['g2'])) { echo "checked"; }?>/></td>
    <td width="20%">Fantasy</td>
    <td width="5%"><input type="checkbox" id="g3" name="g3" value="Horror" <?php if (isset($_POST['g3'])) { echo "checked"; }?>/></td>
    <td width="21%">Horror</td>
    <td width="5%"><input type="checkbox" id="g4" name="g4" value="Sci-Fi" <?php if (isset($_POST['g4'])) { echo "checked"; }?>/></td>
    <td width="21%">SciFi</td>
  </tr>
  <tr>
    <td><input type="checkbox" id="g5" name="g5" value="Parody" <?php if (isset($_POST['g5'])) { echo "checked"; }?>/></td>
    <td>Parody</td>
    <td><input type="checkbox" id="g6" name="g6" value="Drama" <?php if (isset($_POST['g6'])) { echo "checked"; }?>/></td>
    <td>Drama</td>
    <td><input type="checkbox" id="g7" name="g7" value="Western" <?php if (isset($_POST['g7'])) { echo "checked"; }?>/></td>
    <td>Western</td>
    <td width="5%"><input type="checkbox" id="g8" name="g8" value="Action" <?php if (isset($_POST['g8'])) { echo "checked"; }?>/></td>
    <td width="21%">Action</td>
  </tr>
	  <tr>
    <td><input type="checkbox" id="g9" name="g9" value="Realism" <?php if (isset($_POST['g9'])) { echo "checked"; }?>/></td>
    <td>Realism</td>
    <td><input type="checkbox" id="g10" name="g10" value="Thriller" <?php if (isset($_POST['g10'])) { echo "checked"; }?>/></td>
    <td>Thriller</td>
    <td><input type="checkbox" id="g11" name="g11" value="Superhero" <?php if (isset($_POST['g11'])) { echo "checked"; }?>/></td>
    <td>Superhero</td>
    <td width="5%"><input type="checkbox" id="g12" name="g12" value="Adventure" <?php if (isset($_POST['g12'])) { echo "checked"; }?>/></td>
    <td width="21%">Adventure</td>
	  </tr>
	  <tr>
    <td><input type="checkbox" id="g13" name="g13" value="Noir" <?php if (isset($_POST['g13'])) { echo "checked"; }?>/></td>
    <td>Noir</td>
    <td><input type="checkbox" id="g14" name="g14" value="Mystery" <?php if (isset($_POST['g14'])) { echo "checked"; }?>/></td>
    <td>Mystery</td>
    <td><input type="checkbox" id="g15" name="g15" value="Romance" <?php if (isset($_POST['g15'])) { echo "checked"; }?>/></td>
    <td>Romance</td>
    <td><input type="checkbox" id="g16" name="g16" value="War" <?php if (isset($_POST['g16'])) { echo "checked"; }?>/></td>
    <td>War</td>
	  </tr>
</table></td>
    </tr>
 </table>
 <div class="spacer"></div>
   <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>">

    <input type="hidden" name="txtApp" id="txtApp" value="<?php echo $AppInstallID; ?>">
    <input type="hidden" name="txtSchedule" id="txtSchedule" value="">
    <input type="hidden" name="step" id="step" value="new">
     <input type="hidden" name="appset" value="1" />
     <input type="hidden" name="TitleSafe" value="<? echo $TitleSafe;?>" />
   <input type="submit" name="Submit" value="Final Step - Story Thumb Creator" />
</form>