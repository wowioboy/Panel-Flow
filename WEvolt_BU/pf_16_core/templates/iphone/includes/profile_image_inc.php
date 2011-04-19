<div class="imageName" align="center"><?php echo $Creator; ?></div>
	<div class="spacer"></div>
	<?php if (isset($Location)) { ?>
	<div class="locationwrapper">
		<div class="comicinfo">LOCATION: </div> 
		<div class="infotext"><?php echo $Location; ?>		</div>
		</div>
	<?php } ?>	
	<? if ($ContactSetting == 1) { ?><div class="chapterlinks" style="padding-left:3px;"><a href="contact.php" style="color:#FFFFFF;"> CONTACT CREATOR </a></div><? } ?>
	</td>
    <td background="images/image_right.jpg" style="background-repeat:no-repeat;" height="115" width="115" valign="middle"><?php if (isset($Avatar)) { ?>
	<div align="center"><img src="<?php echo $Avatar; ?>"  border="1" width="100" height="100"/></div>
<?php } ?>