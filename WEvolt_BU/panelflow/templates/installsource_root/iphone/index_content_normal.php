<div id='trmain' ><div align="center">[tap image to enlarge]</div>
<a href='../images/pages/<? echo $Image;?>' target="_blank">
<img src='<? echo $Smallbaseurl.$Image;?>' id='PageImage'></a>
	<ul class="textbox">
		<li class="writehere">
        <div align="left">
		<? include 'includes/author_comment_module.php';?>

<? if ($ArchiveSetting == 1) { ?>
<div class="jumpbox"><? echo $boxString; ?></div><div class="spacer"></div> 
<? } ?>
<? if ($ChapterSetting == 1) { ?>
<div class="chapters"><? echo $ChapterString; ?></div><div class="spacer"></div>
<? } ?>
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