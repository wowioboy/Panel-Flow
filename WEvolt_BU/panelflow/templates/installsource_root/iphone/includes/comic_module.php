
<div class="rightwrapper"> 
	 <div class="authornote"><img src="images/radiobtn.jpg" />COMIC CREDITS: </div>
	 <div class="comiccredits" style="padding-left:10px;"><div class="halfspacer"></div>
	<?php if ((isset($Creator)) && ($Creator != '')) { ?>
			<div class="comicinfo">CREATED BY: </div>
			<div class="infotext"> <?php echo $Creator; ?></div>
	<?php } ?>
	
	<?php if ((isset($Writer)) && ($Writer != '')) { ?>
			<div class="comicinfo">WRITTEN BY: </div>
			<div class="infotext"><?php echo $Writer; ?></div>
	<?php } ?>
	
	<?php if ((isset($Artist))&& ($Artist != ''))  { ?>
			<div class="comicinfo">ILLUSTRATED BY: </div>
			<div class="infotext"><?php echo $Artist; ?></div>
	<?php } ?>		
	
		<?php if ((isset($Colorist)) && ($Colorist != ''))  { ?>
			<div class="comicinfo">COLORED BY: </div>
			<div class="infotext"><?php echo $Colorist; ?></div>
	<?php } ?>		

    <?php if ((isset($Letterist))&& ($Letterist != '')) { ?>
			<div class="comicinfo">LETTERED BY: </div>
			<div class="infotext"><?php echo $Letterist; ?></div>
	<?php } ?>	
	</div>
		
	</div>