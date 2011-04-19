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
function setCatSelect(value) {
		
		document.create_form.txtSubCategory.length = 0;
		if (value=='image') {
			document.create_form.txtSubCategory.options[0] = new Option("Comic Series", "comic_series", false, false);
			document.create_form.txtSubCategory.options[1] = new Option("Comic Strip", "comic_strip", false, false);
			document.create_form.txtSubCategory.options[2] = new Option("Artwork", "portfolio", false, false);
			document.create_form.txtSubCategory.options[3] = new Option("Photography", "photos", false, false);
			
		} else if (value=='writing') {
			document.create_form.txtSubCategory.options[0] = new Option("Digital Journal/Blog", "blog", false, false);
			document.create_form.txtSubCategory.options[1] = new Option("Novel", "novel", false, false);
			document.create_form.txtSubCategory.options[2] = new Option("Short Story", "short", false, false);
		}				
}
	
function finish() {
document.create_form.submit();	
}
</script>
<table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="384" align="center">
 <div class="blue_med" align="center">NEW PROJECT</div><div class="spacer"></div>
<? if ($Message != '') {?><div class='messageinfo' align="center"><div class='spacer'></div><b><? echo $Message;?></b></div><div class="spacer"></div><? }?>
 <form action="/<? echo $PFDIRECTORY;?>/create_new_project.php" method="post" name="create_form" id="create_form">

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="150" class="messageinfo"><strong>Title</strong><div class="spacer"></div></td>
     <td >
	 <input name="txtTitle"  style="width:85%; background-color:#C9DBE0;" type="text" id="txtTitle" <?php if (isset($_POST['txtTitle'])) { ?> value="<?php echo stripslashes($_POST['txtTitle']); ?>" <?php } ?> /><div class="spacer"></div></td>
   </tr>
   <tr>
   
     <td valign="top" class="messageinfo">
<strong>Format</strong></td>     
     <td valign="top"><table style="width:100%"><td width="175">
   
 <select name="txtProjectCategory" id="txtProjectCategory" onChange="setCatSelect(this.options[this.selectedIndex].value);">
       <option value="image" <?php if ((($_POST['txtProjectCategory'] == '') &&($_GET['type']=='')) || ($_POST['txtProjectCategory'] == 'image') ||($_GET['type'] == 'comic')) echo "selected";?>>Image</option>
       <option value="writing"  <?php if (($_POST['txtProjectCategory'] == 'writing') ||($_GET['type'] == 'blog')||($_GET['type'] == 'writing')) echo "selected";?>>Writing / Text</option></select></td>
       <td class="messageinfo" width="75"><strong>Sub-Category</strong></td>
       <td><select name="txtSubCategory" id="txtSubCategory">
      <? if ((($_POST['txtProjectCategory'] == '') &&($_GET['type']=='')) || ($_POST['txtProjectCategory'] == 'image')||($_GET['type'] == 'comic')) {?>
       <option value="comic_series" <?php if (($_POST['txtSubCategory'] == 'comic_series')||(($_POST['txtProjectCategory'] == '') &&($_GET['type']=='')) ||($_GET['type'] == 'comic')) echo "selected";?>>Comic Series / Graphic Novel</option>
       <option value="comic_strip" <?php if ($_POST['txtSubCategory'] == 'comic_strip') echo "selected";?>>Comic Strip</option>
        <option value="portfolio" <?php if ($_POST['txtSubCategory'] == 'portfolio') echo "selected";?>>Artwork</option>
         <option value="photo" <?php if ($_POST['txtSubCategory'] == 'photo') echo "selected";?>>Photography</option>
       <? } else  if (($_POST['txtProjectCategory'] == 'writing') ||($_GET['type'] == 'blog')||($_GET['type'] == 'writing')){?>
        <option value="blog" <?php if (($_POST['txtSubCategory'] == 'blog')||($_POST['txtSubCategory'] == '')||($_GET['type'] == 'blog')) echo "selected";?>>Digital Journal/Blog</option>
       <option value="novel" <?php if (($_POST['txtSubCategory'] == 'novel')||($_GET['type'] == 'writing')) echo "selected";?>>Novel</option>
        <option value="short" <?php if ($_POST['txtSubCategory'] == 'short') echo "selected";?>>Short Story</option>
             <? }?>
       </select></td></table>
       <div class="spacer"></div>
     </td>
     
   </tr>
   
    <tr>
     <td colspan="2" valign="top" class="messageinfo"><div class="spacer"></div><strong>Genres</strong> - [select all that apply]
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
</table> <div class="spacer"></div></td>
    </tr>
   
     
     
    <tr>
     <td valign="top" class="messageinfo"><strong>Update Schedule</strong></td>
     <td valign="top" class="messageinfo" style="font-size:10px;">Click the days your comic will update
     <table cellpadding="0" cellspacing="0" border="0" width="98%"><tr>
     <td id="mon" class="boxoff" onclick="togglebox(this.id);">MONDAY</td>
     <td id="tues" class="boxoff" onclick="togglebox(this.id);">TUESDAY</td>
     <td id="wed" class="boxoff" onclick="togglebox(this.id);">WEDNESDAY</td>
     <td id="thur" class="boxoff" onclick="togglebox(this.id);">THURSDAY</td>
     <td id="fri" class="boxoff" onclick="togglebox(this.id);">FRIDAY</td>
     <td id="sat" class="boxoff" onclick="togglebox(this.id);">SATURDAY</td>
     <td id="sun" class="boxoff" onclick="togglebox(this.id);">SUNDAY</td>
     <td id="ran" class="boxoff" onclick="togglebox(this.id);">RANDOM</td>
     
     
     </tr></table>   <div class="spacer"></div>
     </td>
   </tr>
   <tr>
     <td colspan="2" valign="top" class="messageinfo"><strong>Select Theme </strong>(scroll down for more)
	<div style="height:180px; overflow:auto; width:640px;">
      <? 
$db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);

$query = "SELECT * from templates where IsPublic=1";
$db->query($query);
$TotalImages = $db->numRows();
$ImageCount = 0;
echo '<table cellpadding="0" cellspacing="0" border="0"><tr>';
while ($line = $db->FetchNextObject()) {
$ImageCount++;
	echo '<td align="center" width="60" valign="top"><img src="/'.$line->Image.'"  border="1" style="border:#fffff solid 1px;" vspace="5" hspace="5" width="140"><br/>';
	
	if (($line->IsPro == 0) || ($_SESSION['IsPro'] == 1)) {
		echo '<input type="radio" name="txtTemplate" value="'.$line->TemplateCode.'"';
		if ($line->TemplateCode == 'TPL-001')
			echo ' checked ';
		echo ' style="cursor:pointer;">SELECT';
	} else {
		echo '<div class="med_blue" style="font-size:10px;">pro template</div>';
	}
	
	echo '<div style="height:5px;"></div></td>';
	if ($ImageCount == 4) {
		echo '</tr><tr>';
		$ImageCount = 0;
	}
	
}
if (($ImageCount < 4) && ($ImageCount != 0)) {
	while ($ImageCount < 4) {
		echo '<td></td>';
		$ImageCount++;
	}
}
echo '</tr></table>';
$db->close();



?>  
</div>  </td>
    </tr>

 </table>
 <div class="spacer"></div>
   <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>">

    <input type="hidden" name="txtApp" id="txtApp" value="<?php echo $AppInstallID; ?>">
    <input type="hidden" name="txtSchedule" id="txtSchedule" value="">
    <input type="hidden" name="step" id="step" value="new">
     <input type="hidden" name="appset" value="1" />
     <input type="hidden" name="TitleSafe" value="<? echo $TitleSafe;?>" />

</form>