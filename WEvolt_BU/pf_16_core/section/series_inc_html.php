<div id="messageinfo_black" align="center">
<div class="spacer"></div>
<div class="messageinfo_black" align="right"><b>Total Series: </b><? echo $TotalPages;?></font> &nbsp;&nbsp; <? echo $pagination->displayPaging();?></div>
<div class="spacer"></div>
<? if ($TotalPages == 0)
	echo '<div class="med_blue" style="padding-top:50px;">There are currently no episodes for this project.</div><div class="spacer"></div><div align="center"><a href="/'.$_SESSION['pfdirectory'].'/section/pages_inc.php?a=new&sub=series"><img src="/images/cms/create_btn.png" border="0"></a></div><div style="height:250px;"></div>';
else echo $PageString;?>
<div  class="messageinfo_black">Pages: <? echo $pagination->displayPaging();?></div>
</div>  