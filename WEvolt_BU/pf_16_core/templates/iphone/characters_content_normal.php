<div id='trlist' >
<? if(isset($_GET['id'])) {?>
<div align="center">
<a href="/<? echo $SafeFolder;?>/iphone/characters/">[BACK TO CHARACTER LIST]</a>
<div class="spacer"></div>
<? echo $CharName;?><br />
<img src='<? echo $CharImage;?>' id='PageImage'>
<? } else {?>
<div class="whitetitle">Character Listing </div>
<ul class="textbox">
		<li class="writehere"><? echo $charstring;?></li></ul>
		<? }?> 
</div>
</div> 

<div id='trstats' style="display:none;">
   <ul class="textbox">
		<li class="writehere">
          <div align="left">
  <table width="300" border="0" cellspacing="0" cellpadding="0">
 	
	<?php if (isset($CharName)) { ?>
	 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">NAME: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top"><div class="chartext"> <?php echo $CharName; ?></div></td>
    </tr>
	<?php } ?>
<?php if (isset($CharDesc)) { ?>
 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">ABOUT: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"> <?php echo $CharDesc; ?></div></td>
    </tr>
			
		
	<?php } ?>
	
	<?php if (isset($CharTown)) { ?>
	 <tr>
     <td width="87" align="right" valign="top">	<div class="chartitle">HOMETOWN: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top"><div class="chartext"><?php echo $CharTown; ?></div></td>
    </tr>
		
			
	<?php } ?>
	
	<?php if (isset($CharRace)) { ?>
		 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">RACE: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharRace; ?></div></td>
    </tr>
			
		
	<?php } ?>			

    <?php if (isset($CharAge)) { ?>
				 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">AGE: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharAge; ?></div></td>
    </tr>
	<?php } ?>	
	  <?php if (isset($CharHeight)) { ?>
	  	 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">HEIGHT: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharHeight; ?></div></td>
    </tr>

	<?php } ?>	
	
	  <?php if (isset($CharWeight)) { ?>
				 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">WEIGHT: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharWeight; ?></div></td>
    </tr>

	<?php } ?>	
	
		
	  <?php if (isset($CharAbility)) { ?>
	  	 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">ABILITIES: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharAbility; ?></div></td>
    </tr>
	<?php } ?>	
	
	 <?php if (isset($CharNotes)) { ?>
	 	 <tr>
     <td width="87" align="right" valign="top"><div class="chartitle">OTHER NOTES: </div></td>
     <td width="10" valign="top">&nbsp;</td>
     <td width="203" valign="top">	<div class="chartext"><?php echo $CharNotes; ?></div></td>
    </tr>
	<?php } ?>	
	</table></div>
   </li></ul>
</div>
   
<div id='trcomments' style="display:none;"><ul class="textbox">
		<li class="writehere">
  <?  include 'includes/page_comments_module.php';?> </li></ul>
</div>  