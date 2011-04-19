<? 
include_once($_SERVER['DOCUMENT_ROOT'].'/includes/init.php');
include 'includes/connect_functions.php';

$PageID = $_GET['page'];
//$PageID = 'df7f28ac317';
$query ="SELECT * from comic_pages as cp
	      join projects as c on c.ProjectID=cp.ComicID
		  where cp.EncryptPageID='$PageID'";
$PageArray = $InitDB->queryUniqueObject($query);
$PageImage = $PageArray->Image;
$ComicDir = $PageArray->HostedUrl;
$ProjectID = $PageArray->ProjectID;

$PathToImage = '/'.$_SESSION['basefolder'].'/'.$ComicDir.'/images/pages/'.$PageImage;
list($width,$height)=getimagesize($_SERVER['DOCUMENT_ROOT'].$PathToImage);


$query ="SELECT * from pf_rg_entries where ComicID='$ProjectID'";
$InitDB->query($query);
$NumEntries = $InitDB->numRows();
$Rgstring = '<select id="txtRgEntryID" style="width:100%;">';
while ($entry = $InitDB->FetchNextObject()) {
$Rgstring .= '<option value='.$entry->EncryptID.'>'.$entry->Title.'</option>';
}
$Rgstring .= '</select>';

if ($NumEntries == 0) 
	$Rgstring = "YOU DON'T HAVE ANY RESOURCE GUIDE ENTRIES";

$PageTitle .= ' hot spot creator';
$TrackPage = 0;
include $_SERVER['DOCUMENT_ROOT'].'/includes/header_template_new.php';?>
<script type="text/javascript" src="http://www.wevolt.com/scripts/cms_wizard_functions.js"></script>

<LINK href="http://www.wevolt.com/<? echo $PFDIRECTORY;?>/css/cms_css.css" rel="stylesheet" type="text/css">
<style type="text/css">
.main_tab_active {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/main_tab_active.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.main_tab_inactive {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/main_tab_inactive.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}
.sub_tab_active {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/sub_tab_active.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.sub_tab_inactive {
	height:20px;
	width:71px;	
	background-image:url(http://www.wevolt.com/images/cms/sub_tab_inactive.png); background-repeat:no-repeat;
	color:#ffffff;
	text-align:center;
}

.sub_tab_inactive a{
	color:#ffffff;
}
.sub_tab_inactive a:link{
	color:#ffffff;
}
.sub_tab_inactive a:hover{
	color:#c6b450;
	text-decoration:underline;
}
.sub_tab_inactive a:visited{
	color:#ffffff;
}

.main_tab_inactive a{
	color:#ffffff;
}
.main_tab_inactive a:link{
	color:#ffffff;
	
}
.main_tab_inactive a:hover{
	color:#c6b450;
	text-decoration:underline;
}
.main_tab_inactive a:visited{
	color:#ffffff;
}

.sub_menu {
	background-color:#8c8c8c;	
}


</style>

<style type="text/css">
*{font-family: "Trebuchet MS";}
fieldset {width: 200px;}
label.lbl{ font-weight: bold; }
input.input:focus { background-color:#feb; }
select:focus { background-color:#feb; }
</style>
<script type="text/javascript" src="/pf_16_core/scripts/behaviour.js"></script>
<script type="text/javascript">
  <!--
    function attach_file( p_script_url ) {
      script = document.createElement( 'script' );
      script.src = p_script_url; 
      document.getElementsByTagName( 'head' )[0].appendChild( script );
  }

  function doSomething()
  {
	  var e = window.event;

	  var s = e.clientX + ',' + e.clientY;
	  document.getElementById('span1').innerText = s;

	  //set pic:
	  //document.getElementById('DivDot').style.visibility = 'visible';
	  //document.getElementById('DivDot').style.left = e.clientX - 10;
	  //document.getElementById('DivDot').style.top = e.clientY - 10;
  }

function revealModal(divID,hsid,cid)
	{
	
		if (divID == 'rgentries') {
			divID = 'rgModal';
			
		} else if (divID == 'htmlcode') {
		divID = 'scriptModal';
		
			document.getElementById('scriptframe').src='/<? echo $PFDIRECTORY;?>/write_hot_spot_html.php?id=<? echo $PageID;?>&cid='+cid;

		}
		
		window.onscroll = function () { document.getElementById(divID).style.top = document.body.scrollTop; };
		document.getElementById(divID).style.display = "block";
		document.getElementById(divID).style.top = document.body.scrollTop;
	}
	
	function hideModal(divID)
	{
		document.getElementById(divID).style.display = "none";
	}
	function rolloveractive(tabid, divid) { 
	var divstate = document.getElementById(divid).style.display;
	//alert('TABID = '+tabid+' and DIVID='+divid);
	//if (divstate == 'none') {
		//alert(divid+ 'state = hidden'); 
	//} else {
		//alert(divid+ 'state = active');
	//}
			if (document.getElementById(divid).style.display != '') {
			//alert('TABID = '+tabid+' and DIVID='+divid);
				document.getElementById(tabid).className ='profiletabhover';
			} 
	}

var myrules = {
'img' : function(el){
	el.onclick = function(){
		//alert(el.offsetLeft);

	}
}
};

function write_hot_spot(id, action, hsid, as, map) {
//alert('hello');
attach_file( '/<? echo $PFDIRECTORY;?>/includes/write_hotspot.php?comicid=<? echo $ProjectID;?>&pageid=<? echo $PageID;?>&action='+action+'&hsid='+hsid+'&as='+as+'&map='+map+'&id='+id );


}

function delete_hotspot(hsid,id,pid,aid) {
//alert('hello');
attach_file( '/<? echo $PFDIRECTORY;?>/includes/write_hotspot.php?comicid=<? echo $ProjectID;?>&pageid=<? echo $PageID;?>&action=delete&id='+id );
document.getElementById(hsid).style.display ='none';
document.getElementById(aid).style.display ='none';
document.getElementById(pid).style.display ='none';

}

Behaviour.register(myrules);

var tt, ll, bb, rr="";
function point_it(event){
  pos_x = event.offsetX ? (event.offsetX) : event.pageX - document.getElementById("pointer_div").offsetLeft;
  pos_y = event.offsetY?(event.offsetY):event.pageY - document.getElementById("pointer_div").offsetTop;
  
  switch(running){
  	case 1:
  	  att = pos_x;
  	  allt = pos_y;
  	  break;
    case 2:
  	  tt = pos_x;
  	  ll = pos_y;
  	  break;
  	case 3:
  	  bb = pos_x;
  	  rr = pos_y;
	 // alert(bb);alert(rr);
  	  break;
  	case 4:
  	  document.getElementById('coords').value="";
  	  break;
  }
  //document.getElementById("cross").style.left = (pos_x-1) ;
  //document.getElementById("cross").style.top = (pos_y-15) ;
  //document.getElementById("cross").style.visibility = "visible" ;
 
 // document.pointform.form_x.value = pos_x;
 // document.pointform.form_y.value = pos_y;
  fx(pos_y,pos_x);
}

running=4;
numspots = 0;
click_="";
var t, l, b, r="";
function fx(top,left){
	//alert(top+","+left);

	switch(running){
		case 1:
			numspots++;
			at=top;
			al=left;
			running=2;
			//document.getElementById("asterick").innerHTML = att+','+allt;
	   		element = document.createElement("div");
	   		element.setAttribute("id","asterickloc_"+numspots);
	   		element.setAttribute("style", "background-color:#ff0000;width:5px;height:5px;border:2px solid #000;position:absolute;top:"+at+"px;left:"+al+"px;z-index:2;");
			element.style.cssText ="background-color:#ff0000;width:5px;height:5px;border:2px solid #000;position:absolute;top:"+at+"px;left:"+al+"px;z-index:2;";
			
			document.getElementById('pointer_div').appendChild(element);
			running=2;
			document.getElementById('step').innerHTML = 'Select the top left position for the hotspot';
			break;
		case 2:
			t=top;
			l=left;
			running=3;
			element = document.createElement("div");
	   		element.setAttribute("id","topleft_"+numspots);
	   		element.setAttribute("style", "width:5px;height:5px;border-left:2px solid #000;border-top:2px solid #000;position:absolute;top:"+t+"px;left:"+l+"px;z-index:2;");
			element.style.cssText = "width:5px;height:5px;border-left:2px solid #000;border-top:2px solid #000;position:absolute;top:"+t+"px;left:"+l+"px;z-index:2;";
			document.getElementById('pointer_div').appendChild(element);
			
			document.getElementById('step').innerHTML = 'Select the bottom right position for the hotspot';
			break;
		case 3:
			b=top;
			r=left;
			document.getElementById('topleft_'+numspots).style.display = 'none';
			element = document.createElement("div");
			element.setAttribute("id","pointer_"+numspots);
			element.setAttribute("style", "background-color:#fff;-moz-opacity:0.8;width:"+(r-l)+"px;height:"+(b-t)+"px;border:2px solid #000; color:#000000;position:absolute;top:"+t+"px;left:"+l+"px;z-index:1;padding-left:3px;");
			element.style.cssText = "background-color:#fff;filter:alpha(opacity=60);width:"+(r-l)+"px;height:"+(b-t)+"px;border:2px solid #000; color:#000000;position:absolute;top:"+t+"px;left:"+l+"px;z-index:1;padding-left:3px;";
			document.getElementById('pointer_div').appendChild(element);
			document.getElementById('pointer_'+numspots).innerHTML = '<span style=\"font-size:12px;font-weight:bold;">HS '+numspots+'</span>';
		
			//document.getElementById('coords').value=tt+","+ll+","+bb+","+rr;
			running=4;
			document.getElementById('step').innerHTML = 'Confirm HotSpot';
			var x = window.confirm('Would you like to set this HotSpot?');
			if (x) {
				alert('Set the HotSpot content to the right.');
				//document.getElementById('step').innerHTML = 'Finish HotSpot Creation ->';
				document.getElementById('step').innerHTML = '[<a href=\"javascript:void(0)\" onclick=\"starthotspots();return false;\"><span style=\"font-size:18px;\">CLICK HERE TO CREATE A HOT SPOT</span></a>]';
				element = document.createElement("div");
	   			element.setAttribute("id","hotspotitem_"+numspots);
	   			element.setAttribute("style", "border:2px solid #000;");
				element.style.cssText = "border:2px solid #000;";
				document.getElementById('hotspotlist').appendChild(element);
				var action = 'new';
				var hsid = 'hotspotitem_'+numspots;
				var as = at+','+al;
				var map = tt+','+ll+','+bb+','+rr;
				write_hot_spot('', action, hsid, as, map);
				var newid = document.getElementById('newhotspot').value;
				
				document.getElementById('hotspotitem_'+numspots).innerHTML = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"/<? echo $PFDIRECTORY;?>/images/hotspot.gif\"></td><td valign=\"top\" width=\"75\">HOTSPOT '+ numspots+'</td><td valign=\"top\">HotSpot: '+tt+','+ll+','+bb+','+rr+'</td><td valign=\"top\" class=\"cms_links\">[<a href=\"javascript:void(0)\" onclick=\"edit_hotspot_content(\'<? echo $PageID;?>\',\''+newid+'\');\">text/html</a>]&nbsp;&nbsp;[<a href=\"javascript:void(0)\" onclick=\"delete_hotspot(\'hotspotitem_'+numspots+'\',\''+newid+'\',\'pointer_'+numspots+'\',\'asterickloc_'+numspots+'\');\">X</a>]</td></tr></table>';
			
			//alert('action='+action);
			//alert('hsid='+hsid);
			//alert('as='+as);
			//alert('map='+map);
			} else {
				current = document.getElementById('pointer_'+numspots);
				current.parentNode.removeChild(current);
				current = document.getElementById('asterickloc_'+numspots);
				current.parentNode.removeChild(current);
				document.getElementById('step').innerHTML = '[<a href=\"javascript:void(0)\" onclick=\"starthotspots();return false;\"><span style=\"font-size:18px;\">CLICK HERE TO CREATE A HOT SPOT</span></a>]';
			}
				
			break;
		case 4:
			//current = document.getElementById('pointer');
			//current.parentNode.removeChild(current);
			running=4;
			break;
	}

}
function starthotspots() {
document.getElementById('step').innerHTML = 'Select the location for the Asterick';
running = 1;
}
// first set is top left coords
// second set determine the height and width
// third step to output 4 coords

// first click 10,10 <- top left coords
// secnd click 80,90 <- bot rght coords
// width:80 height: 70
// output 10,10,80,90
  
  
  //-->
  
 function create_spot(asttop,asleft,hst,hsl,hsb,hsr,count) {
element = document.createElement("div");
element.setAttribute("id","asterickloc_"+count);
element.setAttribute("style", "background-color:#ff0000;width:5px;height:5px;border:2px solid #000;position:absolute;top:"+asttop+"px;left:"+asleft+"px;z-index:2;");
element.style.cssText = "background-color:#ff0000;width:5px;height:5px;border:2px solid #000;position:absolute;top:"+asttop+"px;left:"+asleft+"px;z-index:2;";
document.getElementById('pointer_div').appendChild(element);
			
element = document.createElement("div");
element.setAttribute("id","pointer_"+count);
element.setAttribute("style", "background-color:#fff;-moz-opacity:0.8;width:"+(hsb-hst)+"px;height:"+(hsr-hsl)+"px;border:2px solid #000; color:#000000;position:absolute;top:"+hsl+"px;left:"+hst+"px;z-index:1;padding-left:3px;");
element.style.cssText = "background-color:#fff;filter:alpha(opacity=60);width:"+(hsb-hst)+"px;height:"+(hsr-hsl)+"px;border:2px solid #000; color:#000000;position:absolute;top:"+hsl+"px;left:"+hst+"px;z-index:1;padding-left:3px;";

document.getElementById('pointer_div').appendChild(element);


document.getElementById('pointer_'+count).innerHTML = '<span style=\"font-size:12px;font-weight:bold;\">HS '+count+'</span>';

} 
</script>

<div align="left">
    <table cellpadding="0" cellspacing="0" border="0"  width="100%">
    <tr>
    <td valign="top" style="padding:5px; color:#FFFFFF;width:60px;">
    <? include  $_SERVER['DOCUMENT_ROOT'].'/includes/site_menu_popup_inc.php';?>
    </td> 
    
    <td valign="top" align="center">
           

<div class="wrapper" style="padding-top:30px;" align="center">
<table cellpadding="0" cellspacing="0" border="0"><tr><td>

     <div class="warninglarge" id='step'>[<a href="#" onclick="starthotspots();return false;"><span style="font-size:18px;">CLICK HERE TO CREATE A HOT SPOT</span></a>]</div>
      <div id="pointer_div" onclick="point_it(event)" style = "position:relative; border:#000000 2px solid; background-image:url('<? echo $PathToImage;?>');width:<? echo $width;?>px;height:<? echo $height;?>px;">
      <img src="point.gif" id="cross" style="position:relative;visibility:hidden;z-index:2;"></div> 

</td><td valign="top" width="400" style="padding:10px">
<input type="button" value="CANCEL" onclick="window.location='/cms/edit/<? echo $_GET['comic'];?>/?tab=content&section=pages&series=<? echo $PageArray->SeriesNum;?>&ep=<? echo $PageArray->EpisodeNum;?>';"/>&nbsp;&nbsp;<input type="button" value="BACK TO PAGE" onclick="window.location='/cms/edit/<? echo $_GET['comic'];?>/?tab=content&section=pages&series=<? echo $PageArray->SeriesNum;?>&ep=<? echo $PageArray->EpisodeNum;?>&pageid=<? echo $PageID;?>&a=edit';"/>

<div id='hotspotwrapper'>

 <table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr>
												<td id="grey_cmsBox_TL"></td>
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="384" align="center">

<div align="left"> HOT SPOTS</div>
 
 <form name="pointform" method="post">
  <div style="padding-left:5px;" id='hotspotlist'>
  

</div><input type="hidden" name="newhotspot" id="newhotspot" />
      </form>

    </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>
		
								</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
								<td id="grey_cmsBox_BR"></td>
								</tr></tbody></table>
</div></td></tr></table></div>

<?  
$query ="SELECT * from pf_hotspots where PageID='$PageID' order by ID ASC";
$InitDB->query($query);
$Count = 1;
while ($hotspot = $InitDB->FetchNextObject()) {
$ASArray = explode(',',$hotspot->AsterickCoords);
$ASTop =$ASArray[0];
$ASLeft =  $ASArray[1];
$MapArray = explode(',',$hotspot->HotSpotCoords);
$TopCoord = $MapArray[0];
$LeftCoord = $MapArray[1];
$BottomCoord = $MapArray[2];
$RightCoord = $MapArray[3];
$RGEntry = $hotspot->RGEntryID;
$HTMLCode = $hotspot->HTMLCode;
$ID = $hotspot->EncryptID;
?>
<script type="text/javascript">
var at='<? echo $ASTop;?>';
var al='<? echo $ASLeft;?>';
var it='<? echo $TopCoord;?>';
var il='<? echo $LeftCoord;?>';
var ib='<? echo $BottomCoord;?>';
var ir='<? echo $RightCoord;?>';


element2 = document.createElement("div");
element2.setAttribute("id","hotspotitem_<? echo $Count;?>");
element2.setAttribute("style", "border-bottom:1px dotted #000000; padding-bottom:3px; padding-top:3px;");
document.getElementById('hotspotlist').appendChild(element2);
document.getElementById('hotspotitem_<? echo $Count;?>').innerHTML = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td style=\"padding-right:3px;\"><img src=\"/<? echo $PFDIRECTORY;?>/images/hotspot.gif\"></td><td valign=\"top\" width=\"75\">HOTSPOT <? echo $Count;?></td><td valign=\"top\">HotSpot: '+it+','+il+','+ib+','+ir+'</td><td valign=\"top\" class=\"cms_links\">[<a href=\"javascript:void(0)\" onclick=\"edit_hotspot_content(\'<? echo $PageID;?>\',\'<? echo $ID;?>\');\">text/html</a>]&nbsp;&nbsp;[<a href=\"#\" onclick=\"delete_hotspot(\'hotspotitem_<? echo $Count;?>\',\'<? echo $ID;?>\',\'pointer_<? echo $Count;?>\',\'asterickloc_<? echo $Count;?>\');\">X</a>]</td></tr></table>';
numspots = <? echo $Count;?>;
create_spot(at,al,it,il,ib,ir,'<? echo $Count;?>');


</script>
<? 
$Count++;
}

?>


    </td>
    </tr>
    </table>
</div>


<div id="rgModal" style="display:none;">
    <div class="modalBackground">
    </div>
    <div class="rgContainer"> 
        <div class="modalrg">
            <div class="rgTop"><table cellpadding="0" cellspacing="0" border="0" width="100%"><tr><td align="left"><b>SELECT RG ENTRY</b></td><td align="right" width="100"><a href="javascript:hideModal('rgModal')">[close window]</a></td></tr></table></div>
            <div class="rgBody">
<? echo $Rgstring;?>
</div>
            </div>
        </div>
    </div>
</div>

<?
include $_SERVER['DOCUMENT_ROOT'].'/includes/footer_template_new.php';?> 
