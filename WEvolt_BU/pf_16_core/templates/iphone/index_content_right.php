<div id='trmain' >
<a href='viewpage.php?id=<? echo $PageID;?>'>[tap image to enlarge]</a>
<img src='<? echo $baseurl.$Image;?>' width='480'>
	<ul class="textbox">
		<li class="writehere">
        <div align="left">
		<? include 'includes/author_comment_module.php';?>
			</div> </li>
            </ul>
</div>
<div id='trcredits' style="display:none;">
   <ul class="textbox">
		<li class="writehere">
          <div align="left">
   <? include 'includes/comic_module.php';
   include 'includes/comic_synopsis_module.php';
   ?></div>
   </li></ul>
</div>
   
<div id='trcomments' style="display:none;"><ul class="textbox">
		<li class="writehere">
  <?  include 'includes/page_comments_module.php';?> </li></ul>
</div>  