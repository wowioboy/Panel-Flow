<div id='trmain' >
<center> 
              
              
 				 <? $ContentSection->drawPageNav($ReaderTemplate,'iphone');?>
             
       <div align="center">[tap image to view large]</div>
               <div class="spacer"></div>
               <? $ContentSection->drawiPhoneReader();?>
               <? flush();?>
                <div class="spacer"></div>
               <? $ContentSection->drawPageNav($ReaderTemplate,'iphone');?>
              
                 <div class="spacer"></div>
                 <? echo $ContentSection->drawReaderModules(320,'iphone');?>
                
               
                
</center>


	   