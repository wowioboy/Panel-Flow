
<table width="100%" cellpadding="0" cellspacing="0"><tr><td class="messageinfo" align="left" width="200">Series:
<? echo $SeriesSelect;?></td><td class="messageinfo" align="left">&nbsp;&nbsp;Episode: 
<? echo $EpisodeSelect;?></td></tr></table>
<div class="spacer"></div>
<div align="right" style="width:720px;"><table width="100%"><tr><td width="150" class="cms_links"><b>Total Pages: </b><? echo $TotalPages;?></td><td align="right" class="cms_links">&nbsp;&nbsp; <? echo $pagination->displayPaging($EpisodeNum,$SeriesNum);?></td></tr></table>
</div>
<div class="spacer"></div>
<? if ($TotalPages == 0){
	echo '<div class="med_blue" style="padding-top:50px;">There are currently no pages for this project.</div><div class="spacer"></div><div align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?a=new&series=';
	if ($_GET['series'] == '')
		echo '1';
	else 
		echo $_GET['series'];
	
	echo '&ep=';
	
	if ($_GET['ep'] == '')
		echo '1';
	else 
	
	echo $_GET['ep'];
	echo '"><img src="/images/cms/create_btn.png" border="0"></a></div><div style="height:250px;"></div>';
}else echo $PageString;?>
                        
                      
          



