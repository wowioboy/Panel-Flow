<table width="350" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
										<td id="wizardBox_TL"></td>
										<td id="wizardBox_T"></td>
										<td id="wizardBox_TR"></td></tr>
										<tr><td class="wizardboxcontent"></td>
										<td class="wizardboxcontent" valign="top" width="334" align="left">
                                      
<div class="spacer"></div>	
<? if ($_GET['a'] == 'new') {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat&a=finish" method="post">
<? } else {?>
<form action="/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat&a=finish&cid=<? echo $_GET['cid'];?>" method="post">

<? }?>
<img src="http://www.wevolt.com/images/wizard_cancel_btn.png"  onClick="window.location='/<? echo $_SESSION['pfdirectory'];?>/section/blog_inc.php?sub=cat.php';" class="navbuttons" />

<input type="image" src="http://www.wevolt.com/images/wizard_save_btn.png"  style="background:none; border:none;"/><div class="spacer"></div>	
<div class="sender_name">Category Title</div>
<input type="text" style="width:475px;" name="txtTitle" value="<? echo $Title;?>"/>
<div class="spacer"></div>	
<div class="sender_name">Default Category</div> <input type="radio" value="1" name="txtDefault" <? if ($IsDefault == 1) echo 'checked';?>/>Yes&nbsp;&nbsp;<input type="radio" value="0" name="txtDefault" <? if ($IsDefault == 0) echo 'checked';?>/>No
 </form>
 <br />
Access Control<br />
<select name="txtAccessType" id="txtAccessType">
<option value="public" <? echo 'selected';?>>Everyone</option>
<option value="fans" >Fans Only</option>
<option value="superfans" >SuperFans Only</option>
</select>
 </div>
 <div class="spacer"></div></td><td class="wizardboxcontent"></td>

						</tr><tr><td id="wizardBox_BL"></td><td id="wizardBox_B"></td>
						<td id="wizardBox_BR"></td>
						</tr></tbody></table>