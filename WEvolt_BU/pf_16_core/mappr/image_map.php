<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/2001/REC-xhtml11-20010531/DTD/xhtml11-flat.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="title" content="" />
<meta name="description" content="" />
<meta name="keywords" content="" />

<style type="text/css">
*{font-family: "Trebuchet MS";}
fieldset {width: 200px;}
label.lbl{ font-weight: bold; }
input.input:focus { background-color:#feb; }
select:focus { background-color:#feb; }
</style>
<script type="text/javascript" src="behaviour.js"></script>
<script type="text/javascript" src="prototype-1.4.0.js"></script>

<script type="text/javascript">
  <!--
  function doSomething()
  {
	  var e = window.event;

	  var s = e.clientX + ',' + e.clientY;
	  $('span1').innerText = s;

	  //set pic:
	  //$('DivDot').style.visibility = 'visible';
	  //$('DivDot').style.left = e.clientX - 10;
	  //$('DivDot').style.top = e.clientY - 10;
  }


var myrules = {
'img' : function(el){
	el.onclick = function(){
		alert(el.offsetLeft);

	}
}
};

Behaviour.register(myrules);

var tt, ll, bb, rr="";
function point_it(event){
  pos_x = event.offsetX ? (event.offsetX) : event.pageX - $("pointer_div").offsetLeft;
  pos_y = event.offsetY?(event.offsetY):event.pageY - $("pointer_div").offsetTop;
  switch(running){
  	case 1:
  	  tt = pos_x;
  	  ll = pos_y;
  	  break;
  	case 2:
  	  bb = pos_x;
  	  rr = pos_y;
  	  break;
  	case 3:
  	  $('coords').value="";
  	  break;
  }
  //$("cross").style.left = (pos_x-1) ;
  //$("cross").style.top = (pos_y-15) ;
  //$("cross").style.visibility = "visible" ;
  document.pointform.form_x.value = pos_x;
  document.pointform.form_y.value = pos_y;
  fx(pos_y-22,pos_x);
}

running=1;
click_="";
var t, l, b, r="";
function fx(top,left){
	//alert(top+","+left);

	switch(running){
		case 1:
			t=top;
			l=left;
			running=2;
			break;
		case 2:
			b=top;
			r=left;
			element = document.createElement("div");
			element.setAttribute("id","pointer");
			element.setAttribute("style", "background-color:#fff;-moz-opacity:0.5;width:"+(r-l)+"px;height:"+(b-t)+"px;border:2px solid #000;position:relative;top:"+t+"px;left:"+l+"px;");
			$('pointer_div').appendChild(element);
			$('coords').value=tt+","+ll+","+bb+","+rr;
			running=3;
			break;
		case 3:
			current = $('pointer');
			current.parentNode.removeChild(current);
			running=1;
			break;
	}

}

// first set is top left coords
// second set determine the height and width
// third step to output 4 coords

// first click 10,10 <- top left coords
// secnd click 80,90 <- bot rght coords
// width:80 height: 70
// output 10,10,80,90
  //-->
</script>

</head>

<body>
<div>
</div>


      <form name="pointform" method="post">
      <div id="pointer_div" onclick="point_it(event)" style = "position:relative;background-image:url('http://www.needcomics.com/comics/S/Stupid_Users/images/pages/000b34beb02835eeb3d854aaf517aebd.jpg');width:800px;height:1238px;">
      <img src="point.gif" id="cross" style="position:relative;visibility:hidden;z-index:2;"></div>
      You pointed on x = <input type="text" name="form_x" size="4" /> - y = <input type="text" name="form_y" size="4" />

      </form>

      <fieldset><label for="coords">Image Map Coordinates: </label><input type="text" name="coords" id="coords"/></fieldset>

</body>
</html>