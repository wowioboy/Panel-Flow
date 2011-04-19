<div style="padding-left:25px;">
<form action="install.php" method="post">
<table width="480" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">
      <div class="header"><?php if (isset($_POST['email'])) { ?> 
      Enter your PANEL FLOW License Key. This was emailed to you at the time of your purchase of the application. If you have lost your key, please send us an email here: 
           <a href="http://www.panelflow.com/contact.php" target="_blank">CONTACT US</a>  
            <?php } ?>
    </div>-----------PANEL FLOW LICENSE KEY------------<div class="spacer"></div></td>
  </tr>
   <tr>
    <td>KEY <br/></td>
    <td><input name="txtKey" type="text" size="30" maxlength="70" id="txtKey"/></td>
  </tr>
 </table>
<div class="spacer" style="height:10px;"></div>
   <input type="hidden" name="usercreated" id="usercreated" value="1">
   <input type="hidden" name="email" id="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="id" id="id" value="<?php echo $ID; ?>">
<input type="submit" name="Submit" value="Next Step : Database Information" />

</form>
</div>