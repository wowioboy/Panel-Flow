<script type="text/javascript">
	function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}
	function buttonstab()
	{
			document.getElementById("buttonsdiv").style.display = '';
			document.getElementById("buttonstab").className ='profiletabactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("boxdiv").style.display = 'none';
			document.getElementById("boxtab").className ='profiletabinactive';
			document.getElementById("headersdiv").style.display = 'none';
			document.getElementById("headerstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = 'none';
			document.getElementById("readertab").className ='profiletabinactive';
			document.getElementById("globaldiv").style.display = 'none';
			document.getElementById("globaltab").className ='profiletabinactive';

	}
	
	function globaltab()
	{
			document.getElementById("buttonsdiv").style.display = 'none';
			document.getElementById("buttonstab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("boxdiv").style.display = 'none';
			document.getElementById("boxtab").className ='profiletabinactive';
			document.getElementById("headersdiv").style.display = 'none';
			document.getElementById("headerstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = 'none';
			document.getElementById("readertab").className ='profiletabinactive';
			document.getElementById("globaldiv").style.display = '';
			document.getElementById("globaltab").className ='profiletabactive';

	}
	function infotab()
	{
			document.getElementById("buttonsdiv").style.display = 'none';
			document.getElementById("buttonstab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = '';
			document.getElementById("infotab").className ='profiletabactive';
			document.getElementById("boxdiv").style.display = 'none';
			document.getElementById("boxtab").className ='profiletabinactive';
			document.getElementById("headersdiv").style.display = 'none';
			document.getElementById("headerstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = 'none';
			document.getElementById("readertab").className ='profiletabinactive';
			document.getElementById("globaldiv").style.display = 'none';
			document.getElementById("globaltab").className ='profiletabinactive';


	}

	function boxtab()
	{
			document.getElementById("buttonsdiv").style.display = 'none';
			document.getElementById("buttonstab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("boxdiv").style.display = '';
			document.getElementById("boxtab").className ='profiletabactive';
			document.getElementById("headersdiv").style.display = 'none';
			document.getElementById("headerstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = 'none';
			document.getElementById("readertab").className ='profiletabinactive';
			document.getElementById("globaldiv").style.display = 'none';
			document.getElementById("globaltab").className ='profiletabinactive';

		
			
	}


	function headerstab()
	{
			document.getElementById("buttonsdiv").style.display = 'none';
			document.getElementById("buttonstab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("boxdiv").style.display = 'none';
			document.getElementById("boxtab").className ='profiletabinactive';
			document.getElementById("headersdiv").style.display = '';
			document.getElementById("headerstab").className ='profiletabactive';
			document.getElementById("readerdiv").style.display = 'none';
			document.getElementById("readertab").className ='profiletabinactive';
			document.getElementById("globaldiv").style.display = 'none';
			document.getElementById("globaltab").className ='profiletabinactive';

		
			
	}
	function readertab()
	{
			document.getElementById("buttonsdiv").style.display = 'none';
			document.getElementById("buttonstab").className ='profiletabinactive';
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			document.getElementById("boxdiv").style.display = 'none';
			document.getElementById("boxtab").className ='profiletabinactive';
			document.getElementById("headersdiv").style.display = 'none';
			document.getElementById("headerstab").className ='profiletabinactive';
			document.getElementById("readerdiv").style.display = '';
			document.getElementById("readertab").className ='profiletabactive';
			document.getElementById("globaldiv").style.display = 'none';
			document.getElementById("globaltab").className ='profiletabinactive';

	}
	function removeSkinImage(skintype) {
		attach_file( '/<? echo $PFDIRECTORY;?>/includes/remove_skin_image.php?&skincode=<? echo $SkinCode;?>&type='+skintype+'&comic=<? echo $ComicID;?>');
	}
	

</script>
<form action="/<? echo $PFDIRECTORY;?>/includes/write_skin.php" method="post">

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>

<td width="200" align="center" valign="top" > 
<table cellpadding="0" cellspacing="0" border="0" width="80%"> 
<tr>
<td class="profiletabactive" align="left" id='infotab' onMouseOver="rolloveractive('infotab','infodiv')" onMouseOut="rolloverinactive('infotab','infodiv')" onclick="infotab();"> INFORMATION</td>
</tr>
<tr><td height="4"></td></tr>
<tr>
<td class="profiletabinactive" align="left"  id='globaltab' onMouseOver="rolloveractive('globaltab','globaldiv')" onMouseOut="rolloverinactive('globaltab','globaldiv')" onclick="globaltab();">SITE APPEARANCE</td>
</tr>
<tr><td height="4"></td></tr>

<tr>
<td class="profiletabinactive" align="left" id='buttonstab' onMouseOver="rolloveractive('buttonstab','buttonsdiv')" onMouseOut="rolloverinactive('buttonstab','buttonsdiv')" onclick="buttonstab();"> BUTTONS</td>
</tr>
<tr><td height="4"></td></tr>

<tr>
<td class="profiletabinactive" align="left"  id='boxtab' onMouseOver="rolloveractive('boxtab','boxdiv')" onMouseOut="rolloverinactive('boxtab','boxdiv')" onclick="boxtab();">CONTENT BOX</td>
</tr>

<tr><td height="4"></td></tr>

<tr>
<td class="profiletabinactive" align="left"  id='headerstab' onMouseOver="rolloveractive('headerstab','headersdiv')" onMouseOut="rolloverinactive('headerstab','headersdiv')" onclick="headerstab();">HEADERS</td>
</tr>

<tr><td height="4"></td></tr>
<td class="profiletabinactive" align="left"  id='readertab' onMouseOver="rolloveractive('readertab','readerdiv')" onMouseOut="rolloverinactive('readertab','readerdiv')" onclick="readertab();">PAGE READER</td>
</tr>

</table>
<div align="center">
<div style="height:4px;"></div>
<input type="submit" value ='SAVE' style="width:80%; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>
<div style="height:4px;"></div>
<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/?section=pages';"  style="width:80%;"/>
</div>
</td>
<td width="685" height="600" valign="top">

<div id='infodiv'>
<? include 'includes/skin_edit_info_inc.php';?>
</div>

<div id='headersdiv' style="display:none; color:#FF9900;">
<? include 'includes/skin_edit_headers_inc.php';?>
</div>

<div id='boxdiv' style="display:none;">
<? include 'includes/skin_edit_box_inc.php';?>
</div>

<div id='buttonsdiv' style="display:none; color:#FF9900;">
<? include 'includes/skin_edit_buttons_inc.php';?>
</div>

<div id='readerdiv' style="display:none; color:#FF9900;">
<? include 'includes/skin_edit_reader_inc.php';?>
</div>

<div id='globaldiv' style="display:none; color:#FF9900;">
<? include 'includes/skin_edit_global_inc.php';?>
</div>

<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" />
<input type="hidden" value="<? echo $ComicID;?>" name="txtComic" />
<input type="hidden" value="edit" name="txtAction" />
<input type="hidden" id="SkinCode" value="<? echo $_GET['skincode'];?>" name="SkinCode" />
<input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/>
<input type="hidden" value="<? echo $Section;?>" name="txtSection" id='txtSection'/>
<input type="hidden" value="<? echo $SafeFolder;?>" name="txtSafeFolder" id='txtSafeFolder'/>
<input type="hidden" value="<? echo $ComicFolder;?>" name="txtUrl" id='txtUrl'/>
<input type="hidden" id="ModTopRightImage" name="ModTopRightImage" />
<input type="hidden" id="ModTopLeftImage" name="ModTopLeftImage" />
<input type="hidden" id="ModBottomLeftImage" name="ModBottomLeftImage" />
<input type="hidden" id="ModBottomRightImage" name="ModBottomRightImage" />
<input type="hidden" id="ModRightSideImage" name="ModRightSideImage" />
<input type="hidden" id="ModLeftSideImage" name="ModLeftSideImage" />
<input type="hidden" id="ModTopImage" name="ModTopImage" />
<input type="hidden" id="ModBottomImage" name="ModBottomImage" />
<input type="hidden" id="ControlBarImage" name="ControlBarImage" />
<input type="hidden" id="ContentBoxImage" name="ContentBoxImage" />
<input type="hidden" id="GlobalSiteBGImage" name="GlobalSiteBGImage" />

<input type="hidden" id="ButtonImage" name="ButtonImage" />
<input type="hidden" id="SubmitCommentImage" name="SubmitCommentImage" />
<input type="hidden" id="SubmitCommentRolloverImage" name="SubmitCommentRolloverImage" />
<input type="hidden" id="VoteButtonImage" name="VoteButtonImage" />
<input type="hidden" id="VoteButtonRolloverImage" name="VoteButtonRolloverImage" />
<input type="hidden" id="LogOutButtonImage" name="LogOutButtonImage" />
<input type="hidden" id="LogOutButtonRolloverImage" name="LogOutButtonRolloverImage" />
<input type="hidden" id="FirstButtonImage" name="FirstButtonImage" />
<input type="hidden" id="FirstButtonRolloverImage" name="FirstButtonRolloverImage" />
<input type="hidden" id="BackButtonImage" name="BackButtonImage" />
<input type="hidden" id="BackButtonRolloverImage" name="BackButtonRolloverImage" />
<input type="hidden" id="LastButtonRolloverImage" name="LastButtonRolloverImage" />
<input type="hidden" id="LastButtonImage" name="LastButtonImage" />
<input type="hidden" id="NextButtonRolloverImage" name="NextButtonRolloverImage" />
<input type="hidden" id="NextButtonImage" name="NextButtonImage" />
<input type="hidden" id="HomeButtonRolloverImage" name="HomeButtonRolloverImage" />
<input type="hidden" id="HomeButtonImage" name="HomeButtonImage" />
<input type="hidden" id="CreatorButtonRolloverImage" name="CreatorButtonRolloverImage" />
<input type="hidden" id="CreatorButtonImage" name="CreatorButtonImage" />
<input type="hidden" id="CharactersButtonRolloverImage" name="CharactersButtonRolloverImage" />
<input type="hidden" id="CharactersButtonImage" name="CharactersButtonImage" />
<input type="hidden" id="DownloadsButtonRolloverImage" name="DownloadsButtonRolloverImage" />
<input type="hidden" id="DownloadsButtonImage" name="DownloadsButtonImage" />
<input type="hidden" id="ExtrasButtonRolloverImage" name="ExtrasButtonRolloverImage" />
<input type="hidden" id="ExtrasButtonImage" name="ExtrasButtonImage" />
<input type="hidden" id="EpisodesButtonRolloverImage" name="EpisodesButtonRolloverImage" />
<input type="hidden" id="EpisodesButtonImage" name="EpisodesButtonImage" />
<input type="hidden" id="MobileButtonRolloverImage" name="MobileButtonRolloverImage" />
<input type="hidden" id="MobileButtonImage" name="MobileButtonImage" />
<input type="hidden" id="ProductsButtonRolloverImage" name="ProductsButtonRolloverImage" />
<input type="hidden" id="ProductsButtonImage" name="ProductsButtonImage" />
<input type="hidden" id="CommentButtonRolloverImage" name="CommentButtonRolloverImage" />
<input type="hidden" id="CommentButtonImage" name="CommentButtonImage" />
<input type="hidden" id="VoteButtonRolloverImage" name="VoteButtonRolloverImage" />
<input type="hidden" id="VoteButtonImage" name="VoteButtonImage" />
<input type="hidden" id="LogoutButtonRolloverImage" name="LogoutButtonRolloverImage" />
<input type="hidden" id="LogoutButtonImage" name="LogoutButtonImage" />
<input type="hidden" id="AuthorCommentImage" name="AuthorCommentImage" />
<input type="hidden" id="CommentsHeader" name="CommentsHeader" />
<input type="hidden" id="UserCommentsImage" name="UserCommentsImage" />
<input type="hidden" id="ComicInfoImage" name="ComicInfoImage" />
<input type="hidden" id="ComicSynopsisImage" name="ComicSynopsisImage" />
<input type="hidden" id="GlobalHeaderImage" name="GlobalHeaderImage" />
<input type="hidden" id="txtDirectory" name="txtDirectory" />

</td></tr></table> 
</form>


 <div id="uploadModal" style="display:none;">
    <div class="modalBackground">
    </div>
    <div class="uploadContainer"> 
        <div class="modalupload">
            <div class="uploadTop"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="left"><b>UPLOAD IMAGE</b></td><td align="right" width="100"><a href="javascript:hideModal('uploadModal')">[close window]</a></td></tr></table></div>
            <div class="uploadBody">
           <div id='change_image'>
<iframe src="/<? echo $PFDIRECTORY;?>/includes/skin_upload_inc.php" style="width:250px;height:175px;" frameborder="0" scrolling="no" id='uploaderframe' name='uploaderframe'></iframe>
</div>
           <div align="center">
        <div class='spacer'></div>
				</div>
            </div>
        </div>
    </div>
</div>
