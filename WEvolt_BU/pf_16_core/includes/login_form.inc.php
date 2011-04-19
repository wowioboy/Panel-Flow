
<div style="padding-left:15px;">
<div class="spacer"></div><div class="spacer"></div><div class="spacer"></div>
      <div class="header">PANEL FLOW LOGIN</div>
      <div class="spacer"></div><div class="spacer"></div>
<?php if (isset($login_error)) { ?>
<b>There was an error: </b><br/><br/><?php echo $login_error; ?>
<?php } ?>
<? if (!isset($_GET['ref'])) { ?>
<form action="login.php" method="post">
<? } else { ?>
<form action="login.php?ref=<? echo $_GET['ref'];?>" method="post">

<? }?>
<div align="center">Log in with your email associated with your Panel Flow account.</div><div class="spacer"></div>
<table width="366" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="112" valign="top"> EMAIL: <div class="spacer"></div></td>
    <td width="254" valign="top"><input type="text" size="20" maxlength="50" name="email"
<?php if (isset($_POST['email'])) { ?> value="<?php echo $_POST['email']; ?>" <?php } ?>/><div class="spacer"></div></td>
  </tr>
  <tr>
    <td>PASSWORD:</td>
    <td> <input type="password" size="20" maxlength="10" name="userpass" /></td>
  </tr>
  <tr>
    <td align="right">

</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div class="spacer"></div><input type="submit" name="submit" value="Login" /></td>
    </tr>
</table>

</form>
</div>