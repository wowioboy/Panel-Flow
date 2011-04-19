function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    statusHTML.push('<div style="padding:3px;border-bottom:1px solid #000000;"><span style="color:#<? echo $ContentBoxTextColor;?>;">'+status+'</span> <span class="pagelinks"><a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></span></div>');
  }
  
  if (document.getElementById('twitter_update_list') != null)
 	 document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}



function toggle_arrows(value) {
	if (value == 'on')
		document.getElementById("arrowsstate").value = '';
	else 
		document.getElementById("arrowsstate").value = 'off';
	
}
 
function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}


function addListener(a,b,c,d){if(a.addEventListener){a.addEventListener(b,c,d);return true;}else if(a.attachEvent){var e=a.attachEvent("on"+b,c);return e;}else{alert("Handler could not be attached");}}

function bind(a,b,c,d){return window.addListener(a,b,function(){d.apply(c,arguments)});}
function handleKeystroke(evt)
{             
// Grab the cross browser event
if( !evt ) evt = window.event;
// Character code of key pressed
var asc = !evt.keyCode ? (!evt.which ? evt.charCode : evt.which) : evt.keyCode;
// ASCII character of above code
var chr = String.fromCharCode(asc).toLowerCase();
for (var i in this)
{
  if (asc == i)
  {
 this[i](evt);
 break;
  }
}
}
function cancelEvent(evt)
{
evt.cancelBubble = true;
evt.returnValue = false;
if (evt.preventDefault) evt.preventDefault();
if (evt.stopPropagation) evt.stopPropagation();
return false;
}
//
// KEY COMMANDS
var keyMap = new Array();
var ARROW_UP  = 38;
var ARROW_DOWN    = 40;
var ARROW_LEFT = 37;
var ARROW_RIGHT   = 39;
keyMap[ARROW_LEFT] = prevPAGE;
keyMap[ARROW_UP] = currentPAGE;
keyMap[ARROW_RIGHT] = nextPAGE;
keyMap[ARROW_DOWN] = firstPAGE;
//
function prevPAGE(evt)
{
var arrowstate = document.getElementById("arrowsstate").value;
if (arrowstate == ''){
var location = '/'+SafeFolder+'/reader';

if ((SeriesNum != '') && (SeriesNum != 1))
	location += '/series/'+SeriesNum;
	
if (PrevEpisode != '')
	location += '/episode/'+PrevEpisode;
else 
	location += '/episode/'+EpisodeNum;


location += '/page/'+PrevPage+'/';
document.location = location;
}
}
function firstPAGE(evt)
{
	//window.location = '/'+SafeFolder+'/page/1/';

}
function currentPAGE(evt)
{
	//window.location = '/'+SafeFolder+'/page/'+LastPage+'/';

}
function nextPAGE(evt)
{
	var arrowstate = document.getElementById("arrowsstate").value;
if (arrowstate == ''){
	var location = '/'+SafeFolder+'/reader';
	if ((SeriesNum != '') && (SeriesNum != 1))
	location += '/series/'+SeriesNum;
if (NextEpisode != '')
	location += '/episode/'+NextEpisode;
else 
	location += '/episode/'+EpisodeNum;
location += '/page/'+NextPage+'/';
document.location = location;
}
	

//cancelEvent(evt);
}
bind(document, 'keydown', keyMap, handleKeystroke);

function preloader() 
{
     var i = 0;
     imageObj = new Image();

     images = new Array();
     images[0]= PrevPageImage;
     images[1]= NextPageImage;
    
     for(i=0; i<=1; i++) 
     {		
	
          imageObj.src=images[i];
     }



} 



function doClear(theText) {
     if (theText.value == theText.defaultValue) {
         theText.value = "";
     }
 }

function revealModal(divID,target) {

		document.getElementById(target).style.display = "";	
		
		window.onscroll = function () { document.getElementById(divID).style.top = document.body.scrollTop; };
		document.getElementById(divID).style.display = "block";
		document.getElementById(divID).style.top = document.body.scrollTop;
	}
	
function hideModal(divID,target){
		document.getElementById(divID).style.display = "none";
		document.getElementById(target).style.display = "none";	
} 

function swapimage(target,source) {
	document.getElementById(target).src = '/'+PFDIRECTORY+'/templates/skins/'+SkinCode+'/images/'+source;
	return true;
}

function swapMenuimage(target,source) {
	document.getElementById(target).src = source;
	return true;
}

function rolloverinactive(tabid, divid) {
if (document.getElementById(divid).style.display != '')
	document.getElementById(tabid).className ='tabinactive';
	
}

function rolloveractive(tabid, divid) {
	if (document.getElementById(divid).style.display != 'none') 
		document.getElementById(tabid).className ='tabactive';
		
}

