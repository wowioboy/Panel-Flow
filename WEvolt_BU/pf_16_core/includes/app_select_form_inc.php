<div style="padding-left:25px; padding-right:25px;" class="warning">Please select which of your installed domains you would like this <? if ($ContentType == 'story') {?>Story<? } else {?>Comic <? }?> to reside on. 
<br />
<div class="spacer"></div>
<div class="spacer"></div>
<? if ($ContentType == 'story') {?>
<form action="/story/create/" method="post">
<? } else {?>

<form action="/cms/create/" method="post">
<? }?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td align='center'><font style="font-size:14px; font-weight:bold;">INSTALLED DOMAINS</font> <br />
<? echo $AppSelectString;?></td>
   </tr>
  
 </table>
 <div class="spacer"></div>
 <? if ($ContentType != 'story') {?>

   <input type="submit" name="Submit" value="Next Step - Comic Information" />
 <? } else {?>
  <input type="submit" name="Submit" value="Next Step - Story Information" />
 <? }?>  
   <input type="hidden" name="appset" value="1" />
 </form>