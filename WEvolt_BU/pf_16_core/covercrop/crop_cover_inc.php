<div class="content" align="center">
		<table width="400"><tr><td>
		<form action="/cms/cover/crop/<? echo $SafeFolder;?>/" method="post" name="imageUpload" id="imageUpload" enctype="multipart/form-data">

			<div>UPLOAD IMAGE TO USE FOR YOUR COMIC THUMB. <br />
(JPEG, PNG, GIF) minimum resolution (200w x 266h)</div>
		<div class="spacer"></div>
		
			<input type="hidden" class="hidden" name="max_file_size" value="50000000" />
		
			<input type="file" name="image" id="image" />
			
		
		<input type="submit" name="submit" value="Upload" id="upload"  style="background-color:#FF6600; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/>
                <input type="hidden"  name="txtComic" value="<? echo $_POST['txtComic'];?>" id="txtComic" />
                <input type="hidden"  name="txtUrl" value="<? echo $_POST['txtUrl'];?>" id="txtUrl" />
                <input type="hidden"  name="txtSafeFolder" value="<? echo $SafeFolder;?>" id="txtUrl" />
	
			<div class="hidden" id="wait">
				<img src="/<? echo $PFDIRECTORY;?>/images/wait.gif" alt="Please wait..." />
			</div>
		
		</form>
		</td></tr></table></div>