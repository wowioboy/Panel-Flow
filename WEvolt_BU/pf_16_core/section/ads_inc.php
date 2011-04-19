<div align="center">
<? if ($ContentType == 'story')
		$PageTarget = 'story';
	else 
		$PageTarget = 'cms';
	?>
<div class="pagetitleLarge">BELOW ARE THE AVAILABLE AD SPACES FOR YOUR COMIC'S CURRENT TEMPLATE<br />
SELECT AN AD SPACE BELOW TO EDIT: </div>
<script type="text/javascript">
function adrollover(linkid) {
			document.getElementById(linkid).className ='adlink_hover';
	}
	
function adrollout(linkid) {
			document.getElementById(linkid).className ='adlink';
	}

</script>

<? 
if (($PositionTwo == 1) && ($PositionThree == 1)) {
	$TopColSpan = 3;
	//print 'MY TOP COL SPAN = ' . $TopColSpan ;
} else if (($PositionTwo == 1) || ($PositionThree == 1)) {
	$TopColSpan = 2;
	//print 'MY TOP COL SPAN = ' . $TopColSpan ;
} else {
$TopColSpan = 0;
}
//print 'MY TOP COL SPAN = ' . $TopColSpan ;
if ($PositionFour == 1) {
	$SideRowSpan = 2;
} else {
	$SideRowSpan = 1;
}
 ?>
<table cellpadding="0" cellspacing="0" border="0" width="800">
<? 

if ($PositionOne == 1) {
 echo '<tr>';
 	if ($TopColSpan == 0) {
		echo '<td class="adlink" id="positionone" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=1\'" onMouseOver="adrollover(\'positionone\')" onMouseOut="adrollout(\'positionone\')" height="90">POSITION ONE';
		if ($PositionOnePublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';
	} else {
		echo '<td colspan='.$TopColSpan.' class="adlink" id="positionone" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=1\'" onMouseOver="adrollover(\'positionone\')" onMouseOut="adrollout(\'positionone\')" height="90">POSITION ONE';
		if ($PositionOnePublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';
	}
echo '</tr>';

 echo '<tr>';
 	if ($TopColSpan == 0) {
		echo '<td height="10"></td>';
	} else {
		echo '<td colspan='.$TopColSpan.' height="10"></td>';
	}
echo '</tr>';

}

echo '<tr>';
if ($PositionTwo == 1) {
echo '<td class="adlink" id="positiontwo" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=2\'" onMouseOver="adrollover(\'positiontwo\')" onMouseOut="adrollout(\'positiontwo\')" width="15%"';
	if ($SideRowSpan != 0) {
		echo 'rowspan="'.$SideRowSpan.'"';
	}
echo '>POSITION TWO';
		if ($PositionTwoPublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';
}
echo '<td width="70%"><div id="readerspace">PAGE SPACE</div></td>';
if ($PositionThree == 1) {
echo '<td class="adlink" id="positionthree" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=3\'" onMouseOver="adrollover(\'positionthree\')" onMouseOut="adrollout(\'positionthree\')" width="15%"';
	if ($SideRowSpan != 0) {
		echo 'rowspan="'.$SideRowSpan.'"';
	}
echo '>POSITION THREE';
		if ($PositionThreePublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';

}
echo '</tr>';

if ($PositionFour == 1) {

	echo '<tr><td style="padding:5px;"><div class="adlink" id="positionfour" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=4\'" onMouseOver="adrollover(\'positionfour\')" onMouseOut="adrollout(\'positionfour\')" height="60">POSITION FOUR<br/> (UNDER THE COMIC PAGE)';
		if ($PositionFourPublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</div></td></tr>';


}




echo '<tr>';
 	if ($TopColSpan == 0) {
		echo '<td class="noadlink" height="50">COMMENTS / AUTHOR NOTE</td>';
	} else {
		echo '<td colspan='.$TopColSpan.' class="noadlink" height="50">COMMENTS / AUTHOR NOTE</td>';
	}
echo '</tr>';
echo '<tr>';
 	if ($TopColSpan == 0) {
		echo '<td height="10"></td>';
	} else {
		echo '<td colspan='.$TopColSpan.'  height="10"></td>';
	}
echo '</tr>';

if ($PositionFive == 1) {
 echo '<tr>';
 	if ($TopColSpan == 0) {
		echo '<td class="adlink" id="positionfive" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=5\'" onMouseOver="adrollover(\'positionfive\')" onMouseOut="adrollout(\'positionfive\')" height="90">POSITION FIVE';
		if ($PositionFivePublished == 1) {
		echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';
	} else {
		echo '<td colspan='.$TopColSpan.' class="adlink" id="positionfive" onClick="window.location=\'/'.$PageTarget.'/edit/'.$SafeFolder.'/?section=ads&a=edit&p=5\'" onMouseOver="adrollover(\'positionfive\')" onMouseOut="adrollout(\'positionfive\')" height="90">POSITION FIVE';
		if ($PositionFivePublished == 1) {
			echo '<br/>[<font color="#30733c">Active</font>]';
		} else {
			echo '<br/>[<font color="black">InActive</font>]';
		}
		echo '</td>';
	}
echo '</tr>';

}

echo '</table><div class="spacer"></div>';
?>
</div>
