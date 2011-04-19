<div class="content" align="center">
		<table width="400"><tr><td>
		<form action="/cms/mobile/<? echo $_SESSION['safefolder'];?>/" method="post" name="imageUpload" id="imageUpload" enctype="multipart/form-data">

			<div>UPLOAD IMAGE TO USE FOR A MOBILE WALLPAPER.<br />
(JPEG, PNG, GIF) minimum resolution (500w x 500h)</div>
		<div class="spacer"></div>
		
			<input type="hidden" class="hidden" name="max_file_size" value="20000000" />
			
				<input type="file" name="image" id="image" />
			
		
				<input type="submit" name="submit" value="Upload" id="upload"  style="background-color:#FF6600; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/>
                <input type="hidden"  name="txtComic" value="<? echo $_POST['txtComic'];?>" id="txtComic" />
                <input type="hidden"  name="txtUrl" value="<? echo $_POST['txtUrl'];?>" id="txtUrl" />
                <input type="hidden"  name="txtSafeFolder" value="<? echo $_GET['comic'];?>" id="txtSafeFolder" />
                <input type="hidden"  name="txtAction" value="<? echo $_REQUEST['action'];?>" id="txtAction" />
			<input type="hidden"  name="txtItem" value="<? echo $_REQUEST['item'];?>" id="txtAction" />
			<div class="hidden" id="wait">
				<img src="/images/wait.gif" alt="Please wait..." />
			</div>
		
		</form>
		</td></tr></table></div>