<? if ($ContentType == 'story') {?>
<form method="post" action="/story/edit/<? echo $SafeFolder;?>/?section=settings&t=layout&a=save" name="SaveModules" id="SaveModules">
<? } else {?>
<form method="post" action="/cms/edit/<? echo $SafeFolder;?>/?section=settings&t=layout&a=save" name="SaveModules" id="SaveModules">
<? }?>


<div class="spacer"></div>
<div class="warning" align="center">
LAYOUT SETTING : <input type="radio" value="standard" name="LayoutType" <? if (($LayoutType == 'standard') || ($LayoutType == '')) echo 'checked';?>/>Standard&nbsp;&nbsp;<input type="radio" value="custom" name="LayoutType"  <? if ($LayoutType == 'custom') echo 'checked';?>/>Custom&nbsp;&nbsp;&nbsp;<div class="spacer"></div></div>

<div id="customdiv" >
<div class="pageheader" style="color:#FF6600; padding-left:10px; padding-right:10px;">Below you can create your own layout layout in HTML. To place modules just use the Module Code shown to the left.
</div>
<div class="spacer"></div>
<table cellpadding="0" cellspacing="0" border="0" width="95%">
<tr>
<td valign="top" style="color:#FFFFFF; font:Verdana, Arial, Helvetica, sans-serif; line-height:16px;font-size:12px;padding-left:10px;"><span style="font-size:14px; font-weight:bold; text-decoration:underline;">MODULE CODES</span><br/>
<b>Author Comment</b>: {authcomm}<br />
<b>Characters</b>: {characters}<br />
<b>Downloads</b>: {downloads}<br />
<b>Comic Credits</b>: {comiccredits}<br />
<b>Comic Synopsis</b>: {comicsynopsis}<br />
<b>Links</b>: {linksbox}<br />
<b>Mobile Content</b>: {mobile}<br />
<b>Products</b>: {products}<br />
<b>Other Comics</b>: {othercreatorcomics}<br />
<b>Status Box</b>: {status}<br /><br />
<b>Page Content:</b> {content}<br /><br />
<span style="font-size:14px; font-weight:bold; text-decoration:underline;">NAVIGATION CODES</span><br/>
<b>First Page</b>: {first_page}<br />
<b>Next Page</b>: {next_page}<br />
<b>Last Page</b>: {last_page}<br />
<b>Previous Page</b>: {previous_page}<br /><br />

<span style="font-size:14px; font-weight:bold; text-decoration:underline;">MENU CODES</span><br/>
<b>Menu One</b>: {menuone}<br />
<b>Menu Two</b>: {menutwo}<br />

<span style="font-size:14px; font-weight:bold; text-decoration:underline;">AD CODES</span><br/>
<b>AD SPACE 1</b>: {adone}<br />
<b>AD SPACE 2</b>: {adtwo}<br />
<b>AD SPACE 3</b>: {adthree}<br />
<b>AD SPACE 4</b>: {adfour}<br />
<b>AD SPACE 5</b>: {adfive}<br />


</td>
<td valign="top" width="550" style="padding-left:10px; color:#FFFFFF; font-size:12px;">
<input type="button" onClick="document.SaveModules.submit();" value="Save Settings"><br />
<br />

<textarea name="LayoutHTML" id="LayoutHTML" style="width:100%; height:400px;"><? echo $LayoutHTML;?></textarea>
</td></tr></table>
</div>
 </form>