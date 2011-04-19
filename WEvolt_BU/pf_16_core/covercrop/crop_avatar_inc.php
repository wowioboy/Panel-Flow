<div class="content" align="center">
		<table width="400"><tr><td>
		<form action="/creator/avatar/crop/<? echo $SafeFolder;?>/" method="post" name="imageUpload" id="imageUpload" enctype="multipart/form-data">

			<div>UPLOAD IMAGE TO USE FOR YOUR AVATAR.<br />
(JPEG, PNG, GIF) minimum resolution (100w x 100h)</div>
		<div class="spacer"></div>
		
			<input type="hidden" class="hidden" name="max_file_size" value="1000000" />
			
				<input type="file" name="image" id="image" /> 
			
				<input type="submit" name="submit" value="Upload" id="upload"  style="background-color:#FF6600; color:#FFFFFF; font-weight:bold; border:#000000 1px solid;cursor:pointer;"/>
                <input type="hidden"  name="txtComic" value="<? echo $ComicID;?>" />
	
			<div class="hidden" id="wait"> 
				<img src="/<? echo $PFDIRECTORY;?>/images/wait.gif" alt="Please wait..." />
			</div>
		
		</form>
		</td></tr></table></div>