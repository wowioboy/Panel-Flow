
<table width="100%">
<tr>
<td width="441" style="padding-right:10px;" valign="top">
<span class="dark_blue_header_med">Synopsis</span><div class="medspacer"></div><span class="blue_cell_text"><? echo $Synopsis;?></span>
<div class="spacer"></div>
<span class="dark_blue_header_med">Episode List</span>
<? $query = "select * from Episodes where ProjectID='$ProjectID' order by SeriesNum,EpisodeNum";
	
						$InitDB->query($query);
						$LastSeries = 0;
						while ($line = $InitDB->fetchNextObject()) { 
							if ($LastSeries != $line->SeriesNum) {
									$LastSeries = $line->SeriesNum;
									echo '<div class="blue_cell_text">Series '.$line->SeriesNum.'</div>';
							}
							
									echo '<a href="/'.$SafeFolder.'/reader';
								
									if ($line->SeriesNum != 1)
										 echo '/series/'.$line->SeriesNum;
										
								 echo '/episode/'.$line->EpisodeNum;
									echo  '/page/1/"><img src="http://www.wevolt.com/'.$line->ThumbMd.'" width="75" height="75" border="0" vspace="5" hspace="5" tooltip="Episode '.$line->EpisodeNum.'<br/>'.$line->Title.'" border="1" style="border:#82c1ff 1px solid;"></a>';
								
						}?><div class="spacer"></div>
<span class="dark_blue_header_med">Genre</span><div class="medspacer"></div><span class="blue_cell_text"><? echo $Genre;?></span>
<div class="spacer"></div>
<span class="dark_blue_header_med">Tags</span><div class="medspacer"></div><span class="blue_cell_text"><? echo $Tags;?></span>
</td>
<td width="200" valign="top">
<span class="dark_blue_header_med">Credits</span>
<div class="medspacer"></div>
<? if ($Creator!='') {?><span class="grey_text">Created By: </span><br>
<span class="blue_cell_text"><? echo $Creator;?></span><div class="spacer"></div><? }?>
<? if ($Writer!='') {?><span class="grey_text">Written by: </span><br>
<span class="blue_cell_text"><? echo $Writer;?></span><div class="spacer"></div><? }?>
<? if ($Artist!='') {?><span class="grey_text">Art: </span><br>
<span class="blue_cell_text"><? echo $Artist;?></span><div class="spacer"></div><? }?>
<? if ($Colorist!='') {?><span class="grey_text">Colors: </span><br>
<span class="blue_cell_text"><? echo $Colorist;?></span><div class="spacer"></div><? }?>
<? if ($Letterist!='') {?><span class="grey_text">Letters: </span><br>
<span class="blue_cell_text"><? echo $Letterist;?></span><div class="spacer"></div><? }?>

</span>
<div class="spacer"></div>
<span class="dark_blue_header_med">Related Projects</span>
<div class="spacer"></div>
<? $query = "select * from projects where (userid='$AdminUserID' or CreatorID='$AdminUserID' or userid='$CreatorID' or CreatorID='$CreatorID') and Hosted=1 and installed=1 and published=1 and ProjectID!='' and ProjectID != '$ProjectID' order by title";

						$InitDB->query($query);
						
						while ($line = $InitDB->fetchNextObject()) { 
							
									echo '<a href="/project/'.$line->SafeFolder.'/"><img src="http://www.wevolt.com'.$line->thumb.'" width="75" height="75" border="0" vspace="5" hspace="5" tooltip="<b>'.$line->title.'</b><br/><br/>Type: '.$line->ProjectType.'" border="1" style="border:#82c1ff 1px solid;"></a>';
								
						}?>
</td>
</tr>
</table>
