<? if ($EpisodeSetting == 1) { 
 if ($EpisodeCount > 0) { ?>
<div align="center"><a href="episodes.php" ><img src="images/episode_list.jpg" border='0'/></a></div>
<? } }?>
<? if ($ArchiveSetting == 1) { ?>
<div class="jumpbox"><? echo $boxString; ?></div><div class="spacer"></div> 
<? } ?>
<? if ($ChapterSetting == 1) { ?>
<div class="chapters"><? echo $ChapterString; ?></div><div class="spacer"></div>
<? } ?>
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
	<div class="spacer"></div>
		<? if ($CalendarSetting == 1) { ?>
	<div align="center">
	PAGE CALENDAR
	<div id="calendar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/page_calendar_db.swf','cal','210','150','9');                  
				  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				  so.addVariable('currentday','<?php echo $CurrentDay;?>');
				  so.addVariable('currentmonth','<?php echo $CurrentMonth;?>');
				  so.addVariable('currentyear','<?php echo $CurrentYear;?>');
				  so.addVariable('pageday','<?php echo $CurrentPageDay;?>');
				  so.addVariable('pagemonth','<?php echo $CurrentPageMonth;?>');
				  so.addVariable('pageyear','<?php echo $CurrentPageYear;?>');
				  so.addVariable('calXML','<?php echo $CalXML;?>');
				  so.addVariable('activepages','<?php echo $TotalPages;?>');
                  so.write('calendar'); 
</script>
</div>
<? }?>