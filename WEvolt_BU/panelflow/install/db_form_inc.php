<div style="padding-left:25px;">

<div class="spacer"></div><?php if (!isset($_POST['db_user'])) { ?> YOU WILL NEED TO CREATE THE DATABASE AND DATABASE USER ON YOUR HOSTING SERVER BEFORE PUTTING IN THE DATABASE CREDENTIALS. <?php } ?><br /><div class="spacer"></div>
-----------COMMENT DATABASE INFORMATION ----------------
 <div class="spacer"></div><div class="spacer"></div>
<form action="install.php" method="post">
 <table width="480" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="110">Database User </td>
     <td width="370">
	 <input name="db_user" type="text" id="db_user"<?php if (isset($_POST['db_user'])) { ?> value="<?php echo $_POST['db_user']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td>DB Password </td>
     <td><input name="db_pass" type="text" id="db_pass"<?php if (isset($_POST['db_pass'])) { ?> value="<?php echo $_POST['db_pass']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td>Database</td>
     <td><input name="db_database" type="text" id="db_database"<?php if (isset($_POST['db_database'])) { ?> value="<?php echo $_POST['db_database']; ?>" <?php } ?> /></td>
   </tr>
   <tr>
     <td>Host </td>
     <td><input name="db_host" type="text" id="db_host"<?php if (isset($_POST['db_host'])) { ?> value="<?php echo $_POST['db_host']; ?>" <?php } ?> /> (usually localhost)</td>
   </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
    </tr>
 </table>
   <input type="hidden" name="usercreated" id="usercreated" value="1">
      <input type="hidden" name="keyset" id="keyset" value="1">
   <input type="hidden" name="email" id="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
    <input type="hidden" name="txtKey" id="txtKey" value="<?php echo $_POST['txtKey']; ?>">
  
 <input type="submit" name="Submit" value="Next Step - Application Information" />
</form>