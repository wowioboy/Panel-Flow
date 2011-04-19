

<table width="694" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="blue_cmsBox_TL"></td>
										<td id="blue_cmsBox_T"></td>
										<td id="blue_cmsBox_TR"></td></tr>
										<tr><td class="blue_cmsBox_L" background="http://www.wevolt.com/images/cms/blue_cms_box_L.png" width="8"></td>
										<td class="blue_cmsboxcontent" valign="top" width="678" align="left">
                                        Dashboard
 </td><td class="blue_cmsBox_R" background="http://www.wevolt.com/images/cms/blue_cms_box_R.png" width="8"></td>

						</tr><tr><td id="blue_cmsBox_BL"></td><td id="blue_cmsBox_B"></td>
						<td id="blue_cmsBox_BR"></td>
						</tr></tbody></table>
<div class="spacer"></div>

<div class="spacer"></div>
<div align="center">
<div>
<table><tr><td style="padding-left:10px;" valign="top">
<table width="280" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="264" align="center">

<img src="<? echo $ComicArray->cover;?>" width="200" style="border:#8c8c8c 2px solid;"/>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        
</td><td width="20"></td>

<td valign="top" width="300"><table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="284" align="center">
<div class="spacer"></div>

<div class="spacer"></div>

<table width="75%" cellpadding="2" cellspacing="7">
<tr><td colspan="2" align="left"><strong>Stats</strong>
</td>
</tr>
<tr><td colspan="2" style="border-bottom:dotted 1px #bababa;">
</td>
</tr>
<tr>
<td align="left">
<strong>Site Rank: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->Rank;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>REvolt Rank: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->ProjectRank;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Project XP: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TotalXP;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Todays Hits: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TodayHits;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Total Hits: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TotalHits;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Total Pages: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TotalPages;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Total User Volts: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TotalVolts;?>
</td>
</tr>
<tr>
<td  align="left">
<strong>Total Likes: </strong> 
</td>
<td align="left">
<? echo $ProjectStats->TotalLikes;?>
</td>
</tr>
<tr>
<td  align="left" class="cms_links">
view analytics:
</td>
<td align="left">
<a href="/cms/edit/<? echo $_SESSION['safefolder'];?>/?tab=analytics"><img src="http://www.wevolt.com/images/cms/analytics_btn.png" border="0" /></a>
</td>
</tr>
</table>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        
</td></tr>

<tr><td align="center" valign="top">

<div class="spacer"></div>
<table width="280" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="264" align="left">
<strong>QUICK LINKS</strong><div class="mdspacer"></div>
<div class="cms_links">
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=content">Manage Content</a><div class="mdspacer"></div>
<? if (($_SESSION['projecttype'] == 'comic') || ($_SESSION['projecttype'] == 'writing')){?>
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=content&section=pages">Edit Pages</a><div class="mdspacer"></div>
<? }?>
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=design">Edit the Look of your site</a><div class="mdspacer"></div>
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=tools">Access tools</a><div class="mdspacer"></div>
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=settings">Edit Settings</a><div class="mdspacer"></div>
<a href="/cms/edit/<? echo $SafeFolder;?>/?tab=settings&a=edit&sub=info">Edit Project Info</a>
</div>
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="9"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>

</td><td width="20"></td>
<td valign="top">

<div class="spacer"></div>
<table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="grey_cmsBox_TL"></td>
										<td id="grey_cmsBox_T"></td>
										<td id="grey_cmsBox_TR"></td></tr>
										<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
										<td class="grey_cmsboxcontent" valign="top" width="284" align="left">
<strong>Most Recent Comment</strong><div class="mdspacer"></div>

<? $CMS->getLatestComment();?>

</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="9"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
</td>

</tr>

</table>
</div>
</div>

</div>
<? /*
</
<div id="admin">To listen this track, you will need to have Javascript turned on and have <a href="http://www.adobe.com/go/getflashplayer/" target="_blank">Flash Player 8</a> or better installed.</div>
			    <script type="text/javascript">
 var so = new SWFObject('/<? echo $PFDIRECTORY;?>/flash/pf_admin_DBpro_v1-6_dash_hosted.swf','mpl','851','650','9'); 
               		 so.addParam('allowfullscreen','true'); 
                  so.addParam('allowscriptaccess','true'); 
				  so.addVariable('baseurl','<?php echo $ComicFolder;?>');
				  so.addVariable('userid','<?php echo $_SESSION['userid'];?>');
  				  so.addVariable('usertype','<?php echo $_SESSION['usertype'];?>');
				  so.addVariable('comicid','<?php echo $ComicID;?>');
				  so.addVariable('currentsection','<?php echo $_GET['section'];?>');
				  so.addVariable('pfdirectory','<?php echo $PFDIRECTORY;?>');
				   so.addVariable('safefolder','<?php echo $SafeFolder;?>');
				  so.addVariable('key','<?php echo $Key;?>');
				  so.addVariable('server','<?php echo $_SERVER['SERVER_NAME'];?>');
				   so.write('admin'); 
                </script>
				
				*/ ?>