<div style="padding-left:25px; padding-right:25px;">
Please enter the name and email of main creator of comic.<br />
<br />
You will be able to enter all other information and credits for your comic once the initial install is finished.  <br />
<div class="spacer"></div>
-----------CREATOR INFORMATION ----------------
 <div class="spacer"></div><div class="spacer"></div>
<form action="create_comic.php" method="post">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="30%">Creator Name</td>
     <td width="70%" style="padding-left:10px;">
	 <input name="creatorname" type="text" SIZE=40 id="creatorname"<?php if (isset($_POST['creatorname'])) { ?> value="<?php echo $_POST['creatorname']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td valign="top"><div class="spacer"></div>
     Creator Email<br /></td>
     <td valign="top" style="padding-left:10px;"><div class="spacer"></div><input SIZE=40 name="creatoremail" type="text" id="creatoremail"<?php if (isset($_POST['creatoremail'])) { ?> value="<?php echo $_POST['creatoremail']; ?>" <?php } ?> />
      <br />
      This will search the Panel Flow User database for this user, if the creator does not have an account, an email will be sent to them with an invitation to join.</td>
   </tr>
   <tr>
     <td colspan="2" valign="top"></td>
   </tr>
     <tr>
       <td colspan="2">&nbsp;</td>
    </tr>
 </table>
 <div class="spacer"></div>
   <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>">
   <input type="hidden" name="step" id="step" value="Creator">
   <input type="hidden" name="comicid" id="comicid" value="<?php echo $ComicID; ?>">
   <input type="hidden" name="step" id="step" value="Creator">
   <input type="submit" name="Submit" value="Final Step - Comic Thumb Creator" />
</form>