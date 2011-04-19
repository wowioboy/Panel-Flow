<div align="center">
			POST CALENDAR
			<div id="calendar">You need to have your javascript turned on and make sure you have the latest version of Flash<a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Player 9</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/post_calendar.swf','cal','210','150','9');                  
				  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				  so.addVariable('currentday','<?php echo $CurrentDay;?>');
				  so.addVariable('currentmonth','<?php echo $CurrentMonth;?>');
				  so.addVariable('currentyear','<?php echo $CurrentYear;?>');
				  so.addVariable('pageday','<?php echo $CurrentPageDay;?>');
				  so.addVariable('pagemonth','<?php echo $CurrentPageMonth;?>');
				  so.addVariable('pageyear','<?php echo $CurrentPageYear;?>');
				  so.addVariable('calXML','<?php echo $CalXML;?>');
                  so.write('calendar'); 
</script>
</div>_