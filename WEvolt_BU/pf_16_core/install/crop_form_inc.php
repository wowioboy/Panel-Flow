<div class="content" align="center">
		<table width="400"><tr><td>
		<div class='errormsg'>You have reached the point of no return, DO NOT HIT YOUR BACK BUTTON.</div><div class="spacer"></div>
		<form action="crop_image.php" method="post" name="imageUpload" id="imageUpload" enctype="multipart/form-data">
		<fieldset>
			<div>UPLOAD IMAGE TO USE FOR YOUR COMIC THUMB.
			  <max size 3mb> </div><div class="spacer"></div>
			<div align="center"></div>
			<input type="hidden" class="hidden" name="max_file_size" value="1000000" />
			<div class="file">
				<label for="image">Image</label>
				<input type="file" name="image" id="image" />
			</div>
		
			<div id="submit">
				<input class="submit" type="submit" name="submit" value="Upload" id="upload" />
			</div>
			<div class="hidden" id="wait">
				<img src="http://www.panelflow.com/images/wait.gif" alt="Please wait..." />
			</div>
		</fieldset>
		</form>
		</td></tr></table></div>