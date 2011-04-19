<?php 
	// Comic Header
include str_repeat('../', $calling_dist - $include_dist + 1).$PFDIRECTORY.'/templates/'.$TEMPLATE.'/includes/comic_header.php';?>


<div class="spacer"></div>	
<div class="contentwrapper" align="center">
<div id="topbar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/topcharcontrols_db.swf','top','820','40','<?php echo '#'.$BGcolor;?>','9');                  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
                  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				  so.addVariable('backID','<?php echo $PrevPage;?>');
				  so.addVariable('nextID','<?php echo $NextPage;?>');
				   so.addVariable('comicid','<?php echo $ComicID;?>');
				  so.addVariable('currentindex','<?php echo $CurrentIndex;?>');
				  so.addVariable('totalpages','<?php echo  $TotalPages;?>');
			      so.addVariable('barcolor','<?php echo $BarColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				  so.addVariable('buttoncolor','<?php echo $ButtonColor;?>');
				  so.addVariable('arrowcolor','<?php echo $ArrowColor;?>');
				  so.addVariable('loggedin','<?php echo $loggedin;?>');
				  so.addVariable('extras','<?php echo $Extras;?>');
				  so.addVariable('characters','<?php echo $Characters;?>');
				  so.addVariable('downloads','<?php echo $Downloads;?>');
				  so.addVariable('biosetting','<?php echo $ShowBio;?>');
				  so.addVariable('pathtopf','<?php echo $PFDIRECTORY;?>');
				    so.addVariable('baseurl','<?php echo $ComicFolder;?>');
					so.addVariable('section','<?php echo $Pagetracking;?>');
                  so.write('topbar'); 
</script>

<div id="characters">To listen this track, you will need to have Javascript turned on and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 8</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/charlist_db.swf','mpl','820','250','#000000','9');                  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				   so.addVariable('buttoncolor','<?php echo $ButtonColor;?>');
				    so.addVariable('arrowcolor','<?php echo $ArrowColor;?>');
					so.addVariable('CharactersXML','<?php echo $CharacterXML;?>');
					so.addVariable('baseurl','<?php echo $ComicFolder;?>');
                  so.write('characters'); 
</script>
			<div class="spacer"></div>	
<div class="contentwrapper" align="center">
<table width="799">
	<tr>
	<td width="400" valign="top">
	<?php if (isset($CharImage)) {?>
	<div class="charimage" align="center"><img src="<?php echo $CharImage;?>" border ="2"/></div>
<?php } ?>
</td>
					
<td width="15">&nbsp;</td>	
			
<td width="368" valign="top">
<?php if (isset($_GET['id'])) { ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="modtopleft"></td>
	<td id="modtop"></td>
	<td id="modtopright"></td>
</tr>
<tr>
	<td id="modleftside"></td>
	<td class="boxcontent" valign="top">	
	<div class="rightwrapper"> 
	 <div class="authornote"><img src="images/radiobtn.jpg" />CHARACTER STATS  </div>
	 <div class="comiccredits" style="padding-left:10px;"><div class="halfspacer"></div>
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
	</table>
	</div>
	
	</div>
	</td>
	<td id="modrightside"></td>
</tr>
<tr>
	<td id="modbottomleft"></td>
	<td id="modbottom"></td>
	<td id="modbottomright"></td>
</tr>
</table>
	


<?php } ?>


				
</td>
</tr>
</table>
</div>			
</div>
