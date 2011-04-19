<script type="text/javascript">
delete_group(value) {
	
	var answer = confirm('Are you sure you want to delete this group?');
	if (answer) {
		
		attach_file('http://www.wevolt.com/connectors/delete_user_group.php?gid='+value);
		document.location.href='/<? echo $_SESSION['username'];?>/?tab=network&s=groups';
	}	
	
}
</script>
<div align="center" style="padding-left:15px;">

<div style="height:600px; overflow:auto">
          				<? if ($_GET['s'] == 'friends'){
								echo $Social->getFriends($UserID, $_GET['sort']);
						}else if (($_GET['s'] == '') || ($_GET['s'] == 'fans')){
								echo $Social->getFans($UserID, $_GET['sort']);
						}else if  ($_GET['s'] == 'celebs'){
								echo $Social->getCelebs($UserID, $_GET['sort']);
						} else if ($_GET['s'] == 'groups') {?>
                        
                       

	<div class="spacer"></div>
  <div style="width:592px; text-align:right;" class="messageinfo"><? if (($_GET['a'] == 'new')||($_GET['a'] == 'edit')){?><a href="/<? echo $_SESSION['username'];?>/?tab=network&s=groups">[LIST GROUPS]</a><? } else { echo 'LIST GROUPS';}?>&nbsp;&nbsp;<? if (($_GET['a'] != 'new')&&($_GET['a'] != 'edit')){?><a href="/<? echo $_SESSION['username'];?>/?&tab=network&s=groups&a=new">[NEW]</a><? } else if ($_GET['a'] == 'edit'){ echo 'EDIT GROUP';} else { echo 'NEW GROUP';}?></div>

                                          <? if (($_GET['a'] == 'new')||($_GET['a'] == 'edit')) {?>
											  
											<iframe src="/includes/edit_groups_inc.php?a=<? echo $_GET['a'];?>&gid=<? echo $_GET['gid'];?>" width="700" height="500" allowtransparency="true" style="border:none;" scrolling="no"></iframe>
											 <?   } else {?>
                                             		<table border="0" cellspacing="0" cellpadding="0" width="592">
          			<tr>
                        <td  id="updateBox_TL"></td>
                        <td width="576" id="updateBox_T"></td>
                        <td id="updateBox_TR"></td>
                    </tr>
                    <tr>
            			<td valign="top" class="updateboxcontent" colspan="3">'
                                        <? $query = "select  * from user_groups where UserID='".$_SESSION['userid']."'"; 
											$InitDB->query($query);

											echo '<table width="100%" cellpadding="5" cellspacing="10"><tr>';
											echo '<td ><strong>TITLE</strong></td><td width="200"><strong>DESCRIPTION</strong></td><td  width="75"><strong>USERS</strong></td><td  width="100"><strong>ACTIONS</strong></td></tr>';
											while($line = $InitDB->fetchNextObject()) {
												echo '<tr><td valign="top" class="blue_cell_title"><b>';
												echo $line->Title;
												echo '</b></td>';
												echo '<td width="200" class="blue_cell_title">';
												echo $line->Description;
												echo '</td>';
												
												$GroupUsers = @explode(',',$line->GroupUsers);
												if ($GroupUsers == null)
													$GroupUsers = array();
												$TotalUsers = sizeof($GroupUsers);
												echo '<td width="75" class="blue_cell_title">';
												echo $TotalUsers . ' user';
												if ($TotalUsers != 1)
													echo 's';
												echo '</td>';
												echo '<td class="blue_cell_title" width="100">';
												echo '<a href="/'.$_SESSION['username'].'/?tab=network&s=groups&a=edit&gid='.$line->ID.'">EDIT</a>&nbsp;&nbsp;<a href="javascript:void(0)" onClick="delete_group(\''.$line->ID.'\');">DELETE</a>';
												echo '</td>';
												echo '</tr>';
											}
											echo '</table>';?>
                                            
  </td>
                      
                            </tr>
                            <tr>
                                <td id="updateBox_BL"></td>
                                <td id="updateBox_B"></td>
                                <td id="updateBox_BR"></td>
                            </tr>
                  </table>
                                            <? }?>

                        
	
<? } ?>
                   
       </div>

</div>
<input type="hidden" id="username" name="username" value="<? echo $FeedOfTitle;?>" />




