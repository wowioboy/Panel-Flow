<script type="text/javascript">
	function show_tab(value)
	{
			if (value == 'basic') {
				document.getElementById("basic_div").style.display = '';
				document.getElementById("credits_div").style.display = 'none';
				document.getElementById("personal_div").style.display = 'none';
				document.getElementById("contact_div").style.display = 'none';
			} else if (value == 'personal') {
				document.getElementById("basic_div").style.display = 'none';
				document.getElementById("credits_div").style.display = 'none';
				document.getElementById("personal_div").style.display = '';
				document.getElementById("contact_div").style.display = 'none';
			}  else if (value == 'credits') {
				document.getElementById("basic_div").style.display = 'none';
				document.getElementById("credits_div").style.display = '';
				document.getElementById("personal_div").style.display = 'none';
				document.getElementById("contact_div").style.display = 'none';
			}  else if (value == 'contact') {
				document.getElementById("basic_div").style.display = 'none';
				document.getElementById("credits_div").style.display = 'none';
				document.getElementById("personal_div").style.display = 'none';
				document.getElementById("contact_div").style.display = '';
			} 
	}
	function show_save() {
		document.getElementById('save_alert').style.display = '';
	
	}

</script> 

<div align="center">
 <? if ($IsOwner) {?>
  <form name="profileform" method="post" action="/<? echo $_SESSION['username'];?>/?tab=profile&s=<? echo $_GET['s'];?>" enctype="multipart/form-data" >
  <input type="hidden" name="edit" id="edit" />
  <? }?>
<table width="100%">
<tr>
<td valign="top">

 
        <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-165);?>'>
      		<tr>
               <td valign="top" style="padding-left:10px;">
                
                <? if ($_GET['s'] == 'resume') {?>
                	
                  <? include 'myvolt_about_resume_inc.php';?>

                <? } else if ($_GET['s'] == 'portfolio') {?>
                	
                  <? include 'myvolt_about_portfolio_inc.php';?>

                <? } else if (($_GET['s']=='') || ($_GET['s']=='details')|| ($_GET['s']=='interests')) {?>
            
                
                                        <div id='basic_div' style="<?  if (($_GET['s']!='')&&($_GET['s']!='details')) echo 'display:none;';?>">
                                            <? include 'myvolt_about_basic_inc.php';?>
                                         </div>
                                         
                                         <div id="interests_div" style="<? if ($_GET['s']!='interests') echo 'display:none;';?>">
                                            <? include 'myvolt_about_interests_inc.php';?>
                                         </div>
                               
                  <? } else if ($_GET['s'] == 'stats') {?>
                  <table border='0' cellspacing='0' cellpadding='0' width='500'>
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="484" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign='top' class="updateboxcontent" colspan="3">
                        <div style="padding-left:5px;">
                 <img src="http://www.wevolt.com/images/site_stats.png" /><div class="spacer"></div>
				 
				 <?
					 echo getStatsModule($UserID, 'user');?>
                     
                      </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>
					   </div>
				  <? }?>
                
                  
 		
          </td>
          </tr>
       </table>
  <div class="spacer"></div>
 
  
   <?  if (($_GET['s']=='') || ($_GET['s']=='details')) {?>
   <table border='0' cellspacing='0' cellpadding='0' width='<? echo ($_SESSION['contentwidth']-165);?>'>
      		<tr>
            
               
                <td valign="top" style="padding-left:10px;">
                
   
                                <div class="messageinfo" id="contact_div">
                                <?  include 'myvolt_about_contact_inc.php';?>
                            </div>
                       
                        
 				 </td>
  
  </tr>
  </table>
  <? } //contact Wrapper If?>
  
</td>
 
</tr>
</table> 
 <? if ($IsOwner) {?>
   </form>
   <? }?>
</div>




