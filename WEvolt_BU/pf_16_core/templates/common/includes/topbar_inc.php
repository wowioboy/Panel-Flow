<div id="topbar">To listen this track, you will need to have Javascript turned on and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 8</a> or better installed.</div>
<script type="text/javascript"> 
    var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/topcontrols_db.swf','mpl','850','40','#000000','9');                  so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
                  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				   so.addVariable('backID','<?php echo $PrevPage;?>');
				   so.addVariable('nextID','<?php echo $NextPage;?>');
				  so.addVariable('currentindex','<?php echo $CurrentIndex;?>');
				  so.addVariable('totalpages','<?php echo  $TotalPages;?>');
			      so.addVariable('barcolor','<?php echo $BarColor;?>');
				  so.addVariable('textcolor','<?php echo $TextColor;?>');
				  so.addVariable('moviecolor','<?php echo $MovieColor;?>');
				   so.addVariable('buttoncolor','<?php echo $ButtonColor;?>');
				    so.addVariable('arrowcolor','<?php echo $ArrowColor;?>');
					so.addVariable('characters','<?php echo $Characters;?>');
					so.addVariable('extras','<?php echo $Extras;?>');
					so.addVariable('downloads','<?php echo $Downloads;?>');
					 so.addVariable('loggedin','<?php echo $loggedin;?>');
					so.addVariable('pathtopf','<?php echo $PFDIRECTORY;?>');
				    so.addVariable('baseurl','<?php echo $ComicFolder;?>');
					so.addVariable('comicid','<?php echo $ComicID;?>');
                  so.write('topbar'); 
</script>