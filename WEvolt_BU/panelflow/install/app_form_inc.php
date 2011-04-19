<div style="padding-left:25px; padding-right:25px;">Please enter the full path your Panel Flow Install is in. This should be off the root directory, so in the following example: http://www.panelflow.com/APPFOLDER. You would enter APPFOLDER, without slashes. <br />
<p>  http://www.panelflow.com/comics/APPFOLDER you would enter comics/APPFOLDER.</p> Panel Flow Needs to be placed in a directory off the root, it cannot be installed on the root directory.
<div class="spacer"></div><div class="spacer"></div>
<form action="install.php" method="post">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="30%">Application Folder</td>
     <td width="70%" style="padding-left:10px;">
	 <input name="appfolder" type="text" SIZE=40 id="appfolder"<?php if (isset($_POST['appfolder'])) { ?> value="<?php echo $_POST['appfolder']; ?>" <?php } ?> /></td>
   </tr>
     <tr>
     <td colspan="2">
</td>
    </tr>
 </table>
 <div class="spacer"></div>
   <input type="hidden" name="usercreated" id="usercreated" value="1">
   <input type="hidden" name="configcreated" id="configcreated" value="1">
   <input type="hidden" name="keyset" id="keyset" value="1">
   <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>">
   <input type="hidden" name="txtKey" id="txtKey" value="<?php echo $_POST['txtKey']; ?>">
   <input type="submit" name="Submit" value="Final Step - Complete Install" />
</form>