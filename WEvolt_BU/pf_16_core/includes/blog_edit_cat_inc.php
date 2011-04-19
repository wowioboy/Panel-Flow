<div class="grey_text" align="center">
<b>                             
<? if ($_GET['a'] == 'new'){?>
New Category

<? } else {?>
Edit Category
<? }?></b><div class="spacer"></div>	

<? if ($_GET['a'] == 'new') {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat&a=finish" method="post">
<? } else {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat&a=save&cid=<? echo $_GET['cid'];?>" method="post">

<? }?>


<input type="image" src="http://www.wevolt.com/images/cms/cms_grey_save_box.jpg"  style="background:none; border:none;"/>&nbsp;&nbsp;<img src="http://www.wevolt.com/images/cms/cms_grey_cancel_box.jpg"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat';" class="navbuttons" /> 

<div class="spacer"></div>
<table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="334" align="center">


 <div class="spacer"></div>	
Category Title<br/>
<input type="text" style="width:300px;" name="txtTitle" value="<? echo $Title;?>"/>
<div class="spacer"></div>	
Default Category <input type="radio" value="1" name="txtDefault" <? if ($IsDefault == 1) echo 'checked';?>/>Yes&nbsp;&nbsp;<input type="radio" value="0" name="txtDefault" <? if ($IsDefault == 0) echo 'checked';?>/>No<br />
Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? if (($CatArray->AccessType == 'public') || ($CatArray->AccessType == 'public')) echo 'selected';?>>Everyone</option>
<option value="fans" <? if ($CatArray->AccessType == 'fans') echo 'selected';?>>Fans Only</option>
<option value="superfans" <? if ($CatArray->AccessType == 'superfans') echo 'selected';?>>SuperFans Only</option>
</select>
 <div class="spacer"></div>

 <div class="spacer"></div></td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
                        
                        <div class="spacer"></div>	
</form>
                   
                   </div>