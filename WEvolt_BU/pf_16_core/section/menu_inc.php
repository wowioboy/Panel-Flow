<script type="text/javascript">
	function rolloverinactive(tabid, divid) {
			if (document.getElementById(divid).style.display != '') {
				document.getElementById(tabid).className ='profiletabinactive';
			} 
	}

	
	function customtab()
	{
		
			document.getElementById("infodiv").style.display = 'none';
			document.getElementById("infotab").className ='profiletabinactive';
			
			document.getElementById("customdiv").style.display = '';
			document.getElementById("customtab").className ='profiletabactive';

	}
	function infotab()
	{
		
			document.getElementById("infodiv").style.display = '';
			document.getElementById("infotab").className ='profiletabactive';
		
			document.getElementById("customdiv").style.display = 'none';
			document.getElementById("customtab").className ='profiletabinactive';


	}

	


	
	function removeImage(value) {
		attach_file( '/<? echo $PFDIRECTORY;?>/includes/remove_menu_image.php?&id='+value+'&comic=<? echo $ComicID;?>');
		}
	

</script>
<form action="/cms/edit/<? echo $SafeFolder;?>/?section=links&t=menu&a=save" method="post">

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>

<td width="200" align="center" valign="top" > 
<table cellpadding="0" cellspacing="0" border="0" width="80%"> 
<tr>
<td class="profiletabactive" align="left" id='infotab' onMouseOver="rolloveractive('infotab','infodiv')" onMouseOut="rolloverinactive('infotab','infodiv')" onclick="infotab();"> SETTINGS</td>
</tr>
<tr><td height="4"></td></tr>
<tr>
<td class="profiletabinactive" align="left"  id='customtab' onMouseOver="rolloveractive('customtab','customdiv')" onMouseOut="rolloverinactive('customtab','customdiv')" onclick="customtab();">CUSTOM</td>
</tr>
<tr><td height="4"></td></tr>


</table>
<div align="center">
<div style="height:10px;"></div>
<input type="submit" value ='APPLY'  name='btnsubmit' style="width:80%; background-color:#fdb65b; color:#000000; font-weight:bold;"/>
<div style="height:4px;"></div>
<input type="submit" value ='SAVE'  name='btnsubmit' style="width:80%; background-color:#FF6600; color:#FFFFFF; font-weight:bold;"/>
<div style="height:4px;"></div>
<input type="button" value="CANCEL" onClick="window.location='/cms/edit/<? echo $SafeFolder;?>/';"  style="width:80%;"/>
</div>
</td>
<td width="685" height="600" valign="top">

<div id='infodiv'>
<? include 'includes/menu_edit_settings_inc.php';?>
</div>

<div id='customdiv'>
<? include 'includes/menu_links_inc.php';?>
</div>


<input type="hidden" value="<? echo $_GET['section'];?>" name="txtSection" />
<input type="hidden" value="<? echo $ComicID;?>" name="txtComic" />
<input type="hidden" value="edit" name="txtAction" />
<input type="hidden" value="<? echo $Position;?>" name="txtPosition" id='txtPosition'/>

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
