
<div style="padding-left:15px;padding-right:20px;">
<div class="spacer"></div><div class="spacer"></div><div class="spacer"></div>
      <div class="header">PANEL FLOW CREATOR CONFIRM</div>
      <div class="spacer"></div><div class="spacer"></div>
Please confirm that this is the creator you wish to assign to this comic, all the current Creator information on the 'Creator' section of the site will be replaced.
<form action="/cms/creator/<? echo $_GET['comic'];?>/" method="post"><div align="center"> </div>
<div class="spacer"></div>
<table width="366" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="112" valign="top" align="right">
   </td>
    <td width="254" valign="top"><font size="+1"><? echo $CreatorName;?></font><div class="spacer"></div></td>
  </tr>
  <tr>
    <td width="112" valign="top"><div class="spacer"></div></td>
    <td width="254" valign="top"><img src="<? echo $Avatar;?>" /><div class="spacer"></div></td>
  </tr>
  <tr>
    <td align="right" colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><div class="spacer"></div>
      <div align="center"><input type="submit" name="submit" value="Confirm" /> 
        <input type="hidden" value="1" name="confirmcreator" />
        <input type="hidden" value="<? echo $_POST['txtComic']?>" name="txtComic" />
        <input type="hidden" value="<? echo $Email;?>" name="email" />
        <input type="hidden" value="<? echo $CreatorName;?>" name="username" />
        <input type="hidden" value="<? echo $Location;?>" name="location" />
        <input type="hidden" value="<? echo $Hobbies;?>" name="hobbies" />
        <input type="hidden" value="<? echo $Website;?>" name="website" />
        <input type="hidden" value="<? echo $Link1;?>" name="link1" />
        <input type="hidden" value="<? echo $Link2;?>" name="link2" />
        <input type="hidden" value="<? echo $Link3;?>" name="link3" />
        <input type="hidden" value="<? echo $Link4;?>" name="link4" />
        <input type="hidden" value="<? echo $Music;?>" name="music" />
            <input type="hidden" value="<? echo $Credits;?>" name="credits" />
            <input type="hidden" value="<? echo $Books;?>" name="books" />
           <input type="hidden" value="<? echo $Avatar;?>" name="avatar" />
           <input type="hidden" value="<? echo $Influences;?>" name="influences" />
           <input type="hidden" value="<? echo $Bio;?>" name="bio" />
             
        </div></td>
    </tr>
</table>

</form>
</div>