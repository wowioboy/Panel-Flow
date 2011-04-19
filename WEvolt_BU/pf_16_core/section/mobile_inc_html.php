<div class="spacer"></div>
<div align="right" style="width:720px;"><table width="100%"><tr><td width="150" class="cms_links"><b>Total Downloads: </b><? echo $TotalDownloads;?></td><td align="right" class="cms_links">&nbsp;&nbsp; <? echo $pagination->displayPaging();?></td></tr></table>
</div>
<div class="spacer"></div>
<? if ($TotalDownloads == 0)
echo '<div class="messageinfo_black" style="padding-top:50px;">There are currently no downloads for this project.</div><div class="spacer"></div><div class="spacer"></div><div class="spacer"></div><div align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/mobile_inc.php?a=new"><img src="/images/cms/create_btn.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $DownloadsString;?>
