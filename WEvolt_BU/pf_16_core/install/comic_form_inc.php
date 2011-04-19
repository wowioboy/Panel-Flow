<div style="padding-left:25px; padding-right:25px;">

<div class="spacer"></div>
Please enter your Comic title and Full URL for your comic as  : <b>http://www.yourcomicdomain.com</b>. no trailing slash<br /><br />
<strong>ATTENTION:</strong> Currently Panel Flow needs to reside on the root directory of the server. If you don't want to have it on the root of your website, you will need to create a subdomain with your host for the comic to reside on. <br />
<br />
You will be able to enter all other information and credits for your comic once the initial install is finished.  <br />
<div class="spacer"></div>
-----------COMIC INFORMATION ----------------
 <div class="spacer"></div><div class="spacer"></div>
<form action="install.php" method="post">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="30%">Comic Title</td>
     <td width="70%" style="padding-left:10px;">
	 <input name="comictitle" type="text" SIZE=40 id="comictitle"<?php if (isset($_POST['comictitle'])) { ?> value="<?php echo $_POST['comictitle']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td valign="top"><div class="spacer"></div>Comic URL<br />
	 (http://www.yourdomain.com)</td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div><input SIZE=40 name="comicurl" type="text" id="comicurl"<?php if (isset($_POST['comicurl'])) { ?> value="<?php echo $_POST['comicurl']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td colspan="2" valign="top"><div class="spacer"></div>
 Comic Genres - 
 [select all that apply
   
      ]
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
</table>
</td>
    </tr>
 </table>
 <div class="spacer"></div>
   <input type="hidden" name="usercreated" id="usercreated" value="1">
   <input type="hidden" name="configcreated" id="configcreated" value="1">
   <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>">
   <input type="submit" name="Submit" value="Final Step - Comic Thumb Creator" />
</form>