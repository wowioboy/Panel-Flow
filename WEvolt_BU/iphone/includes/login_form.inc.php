<?php if (isset($login_error)) { ?>
There was an error: <?php echo $login_error; ?>, please try again.
<?php } ?>
<form action="login.php" method="post">
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" style="padding-right:5px;"> EMAIL : </td>
    <td><input type="text" style="width:100%" maxlength="50" name="email"
<?php if (isset($_POST['email'])) { ?> value="<?php echo $_POST['email']; ?>" <?php } ?>/></td>
  </tr>
  <tr>
    <td align="right" style="padding-right:5px;">PASSWORD:</td>
    <td> <input type="password" style="width:100%" maxlength="10" name="userpass" /></td>
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