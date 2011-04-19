<? # image types to display 

$imagetypes = array("image/jpeg", "image/gif");
function getImages($dir) { global $imagetypes; 
# array to hold return value 
$retval = array(); 
# add trailing slash if missing 
if(substr($dir, -1) != "/") $dir .= "/"; 
# full server path to directory  
$fulldir = "{$_SERVER['DOCUMENT_ROOT']}/$dir"; $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading"); while(false !== ($entry = $d->read())) { 
# skip hidden files 

	if($entry[0] == ".") continue; 
# check for image files 
	$f = escapeshellarg("$fulldir$entry"); 
	if(in_array($mimetype = trim( `file -bi $f` ), $imagetypes)) { 
		$retval[] = array( "file" => "/$dir$entry", "size" => getimagesize("$fulldir$entry") ); 

	}
} $d->close(); 
return $retval; 

}

?>
<div style="padding-left:25px; padding-right:25px;">Please enter your Comic title and the Folder for your comic<br />
<br />
You will be able to enter all other information and credits for your comic once the initial install is finished.  <br />
<div class="spacer"></div>
-----------COMIC INFORMATION ----------------
 <div class="spacer"></div><div class="spacer"></div>
<form action="create_comic.php" method="post">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="30%"><font style="font-size:14px; font-weight:bold;">Comic Title</font></td>
     <td width="70%" style="padding-left:10px;">
	 <input name="comictitle" type="text" SIZE=40 id="comictitle"<?php if (isset($_POST['comictitle'])) { ?> value="<?php echo $_POST['comictitle']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td valign="top"><div class="spacer"></div><font style="font-size:14px; font-weight:bold;">Comic Folder</font><br /></td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div><input SIZE=40 name="comicfolder" type="text" id="comicfolder"<?php if (isset($_POST['comicfolder'])) { ?> value="<?php echo $_POST['comicfolder']; ?>" <?php } ?> />
      <br />
      This should be the folder you want this comic to install to off your main site, for example (http://www.yourdomain.com/MYFOLDER), just put in the folder name, no slashes, for instance MYFOLDER</td>
   </tr>
   <tr>
     <td colspan="2" valign="top"><font style="font-size:14px; font-weight:bold;">Comic Template</font><br />
	   <?
      # fetch image details 
	  $images = getImages($PFDIRECTORY."/templates"); 
	  # display on page 

	   $counter = 0;
	    echo "<table width='100%'><tr>";
	  foreach($images as $img) { 
	  $FileArray = explode(".", basename($img['file']));
	  $Filename = $FileArray[0];
  	  echo "<td valign='top'><input type='radio' value='".$Filename."' name='txtTemplate'";
	  if ($Filename == 'standard') {
	  echo ' checked ';
	  }
	  
	  echo "><b>".$Filename."</b><div align='left'><img class=\"photo\" src=\"{$img['file']}\" alt=\"\" width=\"150\" height=\"150\" border='1'><br/>";
	  $counter++;
 	 if ($counter == 4){
 		echo  "</tr><tr>";
 		$counter = 0;
 	}
	}
	echo "</table>";
	  ?>      </td>
    </tr>
   <tr>
     <td colspan="2" valign="top"><div class="spacer"></div>
 <font style="font-size:14px; font-weight:bold;">Comic Genres - [select all that apply]</font>
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
   <input type="submit" name="Submit" value="Final Step - Comic Thumb Creator" />
</form>