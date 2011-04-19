
<div style="padding-left:15px;padding-right:20px;">
<div class="spacer"></div><div class="spacer"></div><div class="spacer"></div>
      <div class="header">PANEL FLOW CREATOR LOOKUP</div>
      <div class="spacer"></div><div class="spacer"></div>
<?php if (isset($login_error)) { ?>
<b>There was an error: </b><br/><br/><?php echo $login_error; ?>
<?php } ?>

<form action="/cms/creator/<? echo $_GET['comic'];?>/" method="post">
<div align="center">Please enter the email of the Creator you would like to add. If the email entered is not an active Panel Flow accout, you can send an invite for them to join.<br /><br />If the email account is found, the creator information will be pulled from their Panel Flow profile and replace what is currently in place for this comic. </div>
<div class="spacer"></div>
<table width="366" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="112" valign="top"> EMAIL: <div class="spacer"></div></td>
    <td width="254" valign="top"><input type="text" size="20" maxlength="50" name="email"
<?php if (isset($_POST['email'])) { ?> value="<?php echo $_POST['email']; ?>" <?php } ?>/><div class="spacer"></div></td>
  </tr>
  <tr>
    <td align="right"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div class="spacer"></div><input type="hidden" value="1" name="loadcreator" /><input type="hidden" value="<? echo $ComicID;?>" name="txtComic" /><input type="submit" name="submit" value="Load Creator" style="background-color:#999999; border:solid 1px 
    #000000;"/>&nbsp;&nbsp;<? if ($Error!='') {?><input type="submit" name="submit" value="Invite Creator" style="background-color:#FF9900; border:solid 1px 
    #000000;" /><? }?></td>
    </tr>
</table>

</form>
</div>