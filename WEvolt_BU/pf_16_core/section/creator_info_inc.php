  <div id="admin">To listen this track, you will need to have Javascript turned on and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 8</a> or better installed.</div>
  <script type="text/javascript">
   var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/pf_admin_DBpro_v1-6_creator_hosted.swf','mpl','851','650','9'); 
               		 so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				  so.addVariable('baseurl','<?php echo $ComicFolder;?>');
				  so.addVariable('userid','<?php echo $_SESSION['userid'];?>');
  				  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				  so.addVariable('comicid','<?php echo $ComicID;?>');
				   so.addVariable('storyid','<?php echo $StoryID;?>');
				  so.addVariable('currentsection','<?php echo $_GET['section'];?>');
				  so.addVariable('pfdirectory','<?php echo $PFDIRECTORY;?>');
				   so.addVariable('safefolder','<?php echo $SafeFolder;?>');
				   so.addVariable('contenttype','<?php echo $ContentType;?>');
				  so.addVariable('key','<?php echo $Key;?>');
				  so.addVariable('server','<?php echo $_SERVER['SERVER_NAME'];?>');
				  so.addVariable('CreatorXML','<?php echo $ComicXML;?>');
				 so.addVariable('profilesync','<?php echo $ProfileSync;?>');
				   so.write('admin'); 
                </script>
