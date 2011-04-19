<div style="padding-left:25px;">
<form action="install.php" method="post">
<table width="480" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">
      <div class="header"><?php if (!isset($_POST['email'])) { ?> 
      Enter your PANEL FLOW account information below, this will become the admin account for your Panel Flow Pro Application.<div class="spacer"></div>If you don't yet have a PANEL FLOW account, please <a href="http://www.panelflow.com/register.php" target="_blank">CLICK HERE </a>  
            <?php } ?>
    </div>-----------COMIC ADMINISTRATOR LOGIN INFORMATION ------------<div class="spacer"></div></td>
  </tr>
   <tr>
    <td>Email <br/>(associated with your PANEL FLOW account)</td>
    <td><input name="email" type="text" size="30" maxlength="70" id="email"<?php if (isset($_POST['email'])) { ?> value="<?php echo $_POST['email']; ?>" <?php } ?> /></td>
  </tr>
  <tr>
    <td><div class="spacer"></div>Password</td>
    <td><div class="spacer"></div><input name="userpass" type="password" id="userpass" /></td>
  </tr>
</table>
<div class="spacer" style="height:10px;"></div>
<input type="submit" name="Submit" value="Next Step : Database Information" />
</form>
</div>