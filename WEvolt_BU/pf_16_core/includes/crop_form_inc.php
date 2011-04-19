 <? if ($_GET['a'] == '') {?>
 
 <div class="blue_med" align="center">NEW PROJECT</div><div class="spacer"></div>
 <? } else { $SafeFolder = $_GET['s'];?>

  <div class="blue_med" align="center">EDIT THUMB</div><div class="spacer"></div>

 <? }?>
  <link type="text/css" rel="stylesheet" href="http://www.wevolt.com/css/pf_css_new.css" />
<div class="content" align="center">
		<table width="400"><tr><td>
         <? if ($_GET['a'] == '') {?>
		<div class='messageinfo'>Welcome to the point of no return! Sounds scary, huh? <div class="spacer"></div><strong>DO NOT HIT YOUR BACK BUTTON!</strong></div><div class="spacer"></div>
        
 <? }?>
		<form action="/cms/cover/crop/<? echo $SafeFolder;?>/" method="post" name="imageUpload" id="imageUpload" enctype="multipart/form-data">
       
		<fieldset>
              
			<div class="messageinfo" style="font-size:10px;">Upload an image to use for your REvolt's thumbnail. You should use an image atleast 200px wide and atleast 200px high. The final thumb will be a square. </div>
			  <em><max size 2mb></em> </div><div class="spacer"></div>
			<div align="center"></div>
			<input type="hidden" class="hidden" name="max_file_size" value="20000000" />
	
				<input type="file" name="image" id="image" />

				<input class="submit" type="submit" name="submit" value="Upload" id="upload"  style="border:solid 2px #000000; background-color:#114b8e;color:#ffffff;  cursor:pointer;"/>
                
                 <? if ($_GET['a'] == '') {?>
               <input type="hidden" name="step" id="step" value="new">
                <input  type="hidden" name="txtUrl" value="<? echo $ComicURL;?>" id="txtUrl" />
                <input  type="hidden" name="txtSafeFolder" value="<? echo $SafeFolder;?>" id="txtSafeFolder" />
                <input  type="hidden" name="txtComic" value="<? echo $ComicID;?>" id="txtComic" />
               <? } else {?>
               <input type="hidden" name="step" id="step" value="edit">
               <input  type="hidden" name="txtComic" value="<? echo $_GET['pid'];?>" id="txtComic" />
               <input  type="hidden" name="txtSafeFolder" value="<? echo $_GET['s'];?>" id="txtSafeFolder" />
               <input  type="hidden" name="txtUrl" value="<?  echo $_GET['u'];?>" id="txtUrl" />
               <? }?>
			</div>
			<div class="hidden" id="wait">
				<img src="http://www.wevolt.com/images/wait.gif" alt="Please wait..." />
			</div>
		</fieldset>
		</form>
		</td></tr></table></div>