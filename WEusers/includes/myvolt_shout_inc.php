<div align="center">

<table width="100%">
<tr>
<td valign="top">
        <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-125);?>'>
      		<tr>
               <td valign="top" style="padding-left:10px;">
                
                <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-135);?>'>
          			<tr>
                        <td width="9" id="updateBox_TL"></td>
                        <td width="<? echo( $_SESSION['contentwidth']-146);?>" id="updateBox_T"></td>
                        <td width="21" id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign='top' class="updateboxcontent" colspan="3">
                               
                                  <? echo $Social->getUserFeed($UserID);?>
                                </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>
                  
          </td>
          </tr>
       </table>
  <div class="spacer"></div>
 
 </td>
 <td valign="top">
 	<? if ($TwitterName != '') {
		getTwitterModule($TwitterName);	
		}?>
 </td>
</tr>
</table> 
</div>




