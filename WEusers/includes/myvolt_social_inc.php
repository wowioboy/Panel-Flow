<div align="center">

<table width="100%">
<tr>
<td valign="top">
        <table border='0' cellspacing='0' cellpadding='0'>
      		<tr>
               <td valign="top" style="padding-left:10px;">
                <img src="http://www.wevolt.com/images/wevolt_header.png" />
               <table border='0' cellspacing='0' cellpadding='0' width='310'>
                                            <tr>
                                        <td id="lightblueBox_TL"></td>
                                        <td width="294" id="lightblueBox_T"></td>
                                        <td id="lightblueBox_TR"></td>
                                          </tr>
                                            <tr>
                                            
                                                <td valign='top' class="lightblueBox_C" colspan="3" align="center">
                               
                                  <? echo $Social->getUserFeed($UserID);?>
                                   </td>
                                      
                                            </tr>
                                            <tr>
                                                <td id="lightblueBox_BL"></td>
                                                <td id="lightblueBox_B"></td>
                                                <td id="lightblueBox_BR"></td>
                                            </tr>
                                        </table>
                  
          </td>
          </tr>
       </table>
  <div class="spacer"></div>
 
 </td>
 <td width="10">
 </td>
 <td valign="top" align="left">
 <? if ($TwitterName != '') {?>
 <style type="text/css">
 #tweets ul {
	 margin:0px;
	 padding:2px;
	
 }
 
 </style>
<img src="http://www.wevolt.com/images/twitter_title.png" />
<table border='0' cellspacing='0' cellpadding='0' width='230'>
                                            <tr>
                                        <td id="lightblueBox_TL"></td>
                                        <td width="224" id="lightblueBox_T"></td>
                                        <td id="lightblueBox_TR"></td>
                                          </tr>
                                            <tr>
                                            
                                                <td valign='top' class="lightblueBox_C" colspan="3" align="center">
                                                       
                                                      <? echo getTwitterModule($TwitterName);	?>
                                               
                                                </td>
                                      
                                            </tr>
                                            <tr>
                                                <td id="lightblueBox_BL"></td>
                                                <td id="lightblueBox_B"></td>
                                                <td id="lightblueBox_BR"></td>
                                            </tr>
                                        </table>

 	
		
		<? }?>
 </td>
</tr>
</table> 
</div>




