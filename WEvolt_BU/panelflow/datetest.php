<html>
<head>
<title>JavaScript Datepicker Test</title>
<script type="text/javascript" src="scripts/cal.js"></script>
<LINK href="css/cal.css" rel="stylesheet" type="text/css">

</head>

<body>
<form method='post' action='process_batch.php' enctype='multipart/form-data'>
  <div id='uploadbox' style="width:600px;">
CHOOSE FILE: <input type='file' name='images[]' style="width:100%;">
PAGE TITLE: <input type="text" name='titles[]' style="width:100%;">
START DATE: <input name="date0" value='' type="text" id='date0'> 
<img src="images/cal.gif" onClick="displayDatePicker('date0');" class='calpick'><br>


<input type='button' value='ADD SLOT' onclick='addslot()'><input type='button' value='START UPLOAD' onclick='startupload()'>
</div> 

</form> 

</body>
</html>

