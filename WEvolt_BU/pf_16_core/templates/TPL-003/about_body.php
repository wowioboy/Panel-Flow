<?php 
	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>

<?php 
//PANEL FLOW READER
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/topbar_inc.php';?>
<div class="spacer"></div>	
<div class="contentwrapper" align="center">
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td width="425" valign="top">
	<div class="leftwrapper"><table width="477" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="139" valign="top">
<table width="241" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="126" background="images/image_left.jpg" style="background-repeat:no-repeat;" valign="top">
    <?php 
	// Profile Image
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/profile_image_inc.php';?>
	</td>
  </tr>
</table>

<?php if (isset($Website)) { ?>

<table width="237" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/profile_top_left.png" width="15" height="13" style="background-repeat:no-repeat;"></td>
    <td width="198" height="13" background="images/profile_top.png" style="background-repeat:repeat-x;" ><div class="modheader">PERSONAL WEBSITE</div></td>
    <td background="images/profile_top_right.png" width="24" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="15" background="images/profile_left_side.png" style="background-repeat:repeat-y;"></td>
    <td class="content"  width="198"valign="top" style="background-color:#FFFFFF;"><div class="modtext" style="padding:5px;"><a href="<?php echo $Website; ?>" target="_blank" style="color:#FF6600;"><?php echo $Website; ?></a></div></td>
    <td background="images/profile_side.jpg"  style="background-repeat:repeat-y;" width="24"></td>
  </tr>
  <tr>
    <td height="10" colspan="3"  background="images/profile_bottom.png" style="background-repeat:repeat-x;"></td>
    </tr>
</table>

<?php } ?>

<? if ($linkstring != '') { ?>
<table width="237" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/profile_top_left.png" width="12" height="13" style="background-repeat:no-repeat;"></td>
    <td width="201" height="13" background="images/profile_top.png" style="background-repeat:repeat-x;" ><div class="modheader">RECOMMENDED LINKS</div></td>
    <td background="images/profile_top_right.png" width="24" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="12"  background="images/profile_left_side.png" style="background-repeat:repeat-y;"></td>
    <td class="content"  width="201"valign="top" style="background-color:#FFFFFF;"><div class="modtext" style="padding:5px;"><?php 
						// Show Creator Promoted Links
						echo $linkstring; ?></div></td>
    <td background="images/profile_side.jpg"  style="background-repeat:repeat-y;" width="24"></td>
  </tr>
  <tr>
    <td height="10" colspan="3"  background="images/profile_bottom.png" style="background-repeat:repeat-x;"></td>
    </tr>
</table>

<? } ?>

<?php if ((isset($Link1)) || (isset($Link2)) ||(isset($Link3)) ||(isset($Link4))){ ?>

<? if (($Link1 != '') || ($Link2 != '') || ($Link3 != '') || ($Link4 != '')) {?>
<table width="237" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/profile_top_left.png" width="12" height="13" style="background-repeat:no-repeat;"></td>
    <td width="201" height="13" background="images/profile_top.png" style="background-repeat:repeat-x;" ><div class="modheader">OTHER LINKS: </div></td>
    <td background="images/profile_top_right.png" width="24" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="12" background="images/profile_left_side.png" style="background-repeat:repeat-y;"></td>
    <td class="content"  width="201"valign="top" style="background-color:#FFFFFF;"><?php if (isset($Link1)) { ?>
<div class="modtext" style="padding:5px;"><a href="<?php echo $Link1; ?>" target="_blank" style="color:#FF6600;"><?php echo $Link1; ?></a></div>
<?php } ?>

<?php if (isset($Link2)) { ?>
<div class="modtext" style="padding:5px;"><a href="<?php echo $Link2; ?>" target="_blank" style="color:#FF6600;"><?php echo $Link2; ?></a></div>
<?php } ?>
<?php if (isset($Link3)) { ?>
<div class="modtext" style="padding:5px;"><a href="<?php echo $Link3; ?>" target="_blank" style="color:#FF6600;"><?php echo $Link3; ?></a></div>
<?php } ?>
<?php if (isset($Link4)) { ?>
<div class="modtext" style="padding:5px;"><a href="<?php echo $Link4; ?>" target="_blank" style="color:#FF6600;"><?php echo $Link4; ?></a></div>
<?php } ?></td>
    <td background="images/profile_side.jpg"  style="background-repeat:repeat-y;" width="24"></td>
  </tr>
  <tr>
    <td height="10" colspan="3"  background="images/profile_bottom.png" style="background-repeat:repeat-x;"></td>
    </tr>
</table>

<?php } ?>
<? }?></td>
<td width="367" valign="top">
<div class="creatorwrapper">
<?php 
	// Profile Info
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/profile_info_inc.php';?>

</div></td>
</tr>
</table>
	</div></td>
    <td width="200" valign="top"><?php if ($_SESSION['usertype'] == 1){?>
	
	<table width="193" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/mod_top_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td width="171" height="13" background="images/mod_top.png" style="background-repeat:repeat-x;" ></td>
    <td background="images/mod_top_right.png" width="11" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="11" height="67" background="images/left_side.jpg" style="background-repeat:repeat-y;"></td>
    <td class="content" width="171" valign="middle" style="background-color:#FFFFFF; color:#000000;">				
	<div> <?php 
	// Profile Image
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/common/includes/profile_info_inc.php';?>
</div></td>
    <td background="images/right_side.jpg"  style="background-repeat:repeat-y;" width="11"></td>
  </tr>
  <tr>
    <td  background="images/mod_bottom_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td background="images/mod_bottom.png" style="background-repeat:repeat-x;" height="13" ></td>
    <td background="images/mod_bottom_right.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
  </tr>
</table>
	
<? 	 } ?>
	<? if ($AllowComments == 1) { ?>
	
	
	<div class="rightwrapper">
	<table width="193" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/mod_top_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td width="171" height="13" background="images/mod_top.png" style="background-repeat:repeat-x;" ></td>
    <td background="images/mod_top_right.png" width="11" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="11" height="67" background="images/left_side.jpg" style="background-repeat:repeat-y;"></td>
    <td class="content" width="171" valign="middle" style="background-color:#FFFFFF;">				
	<div> <?php $ProfileComments = getProfileComments ($CreatorID);
echo $ProfileComments;?></div></td>
    <td background="images/right_side.jpg"  style="background-repeat:repeat-y;" width="11"></td>
  </tr>
  <tr>
    <td  background="images/mod_bottom_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td background="images/mod_bottom.png" style="background-repeat:repeat-x;" height="13" ></td>
    <td background="images/mod_bottom_right.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
  </tr>
</table>

	<table width="193" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/mod_top_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td width="171" height="13" background="images/mod_top.png" style="background-repeat:repeat-x;" ></td>
    <td background="images/mod_top_right.png" width="11" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="11" height="67" background="images/left_side.jpg" style="background-repeat:repeat-y;"></td>
    <td class="content" width="171" valign="middle" style="background-color:#FFFFFF;">				
	<?php if (is_authed()) { ?>


<div class="authornote">LEAVE A COMMENT FOR <?php echo $CreatorName;?></div>

	<form method="POST" action="about.php">
	  <div align="center">
	    <textarea rows="5" cols="16" name="txtFeedback" id="txtFeedback"></textarea>
	    <input type="hidden" name="profilecomment" id="profilecomment" value="1">
	      <input type="image" src="images/submit.jpg" value="Submit Comment" style="border:none;" />
	      </div>
	</form>
	<div class="spacer"></div>
	<div align="center"><a href="logout.php"><img src="images/logout_btn.jpg" border="0" /></a></div>
	
				
	
<?php } else { ?> 

<div class="authornote" align="center">YOU NEED TO LOG IN TO LEAVE COMMENTS </div>
<?php }?></td>
    <td background="images/right_side.jpg"  style="background-repeat:repeat-y;" width="11"></td>
  </tr>
  <tr>
    <td  background="images/mod_bottom_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td background="images/mod_bottom.png" style="background-repeat:repeat-x;" height="13" ></td>
    <td background="images/mod_bottom_right.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
  </tr>
</table>

<? } ?>

<?php if (!is_authed()) {?>

<table width="193" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  background="images/mod_top_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td width="171" height="13" background="images/mod_top.png" style="background-repeat:repeat-x;" ></td>
    <td background="images/mod_top_right.png" width="11" height="13"  style="background-repeat:no-repeat;"></td>
  </tr>
  <tr>
    <td width="11" height="41" background="images/left_side.jpg" style="background-repeat:repeat-y;"></td>
    <td class="content" width="171" valign="top" align="center" style="background-color:#FFFFFF; color:#000000;" >	
      <div class="infotext">Use your email associated with your Panel Flow account to log in. Or Register for a FREE account. </div>			
   <div id="login">YOU NEED TO TURN ON JAVASCRIPT and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/loginmod.swf','mpl','171','66','9');                  
	    so.addVariable('loggedin','<?php echo $loggedin;?>');
		so.write("login");
</script>				
</td>
    <td background="images/right_side.jpg"  style="background-repeat:repeat-y;" width="11"></td>
  </tr>
  <tr>
    <td  background="images/mod_bottom_left.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
    <td background="images/mod_bottom.png" style="background-repeat:repeat-x;" height="13" ></td>
    <td background="images/mod_bottom_right.png" width="11" height="13" style="background-repeat:no-repeat;"></td>
  </tr>
</table>
<? }?>
</div></td>
	</tr>
</table>

</div>
