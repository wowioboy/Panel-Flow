
<? 

include_once($_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php');
 include_once(INCLUDES.'/db.class.php');
 $db = new DB(PANELDB, PANELDBHOST, PANELDBUSER, PANELDBPASS);
$query = "SELECT * from templates where TemplateCode='$TemplateCode'";
$TemplateArray = $db->queryUniqueObject($query);
/*if ($_SESSION['username'] != 'matteblack') {
$TemplateHTML = $TemplateArray->HTMLCode;

$HeaderWidth = $TemplateArray->HeaderWidth;
$HeaderHeight = $TemplateArray->HeaderHeight;
$HeaderImage = $TemplateArray->HeaderImage;
$HeaderBackground = $TemplateArray->HeaderBackground;
$HeaderBackgroundRepeat = $TemplateArray->HeaderBackgroundRepeat;
$HeaderContent = $TemplateArray->HeaderContent;
$HeaderBackgroundImagePositionContent = $TemplateArray->HeaderContent;
$HeaderContent = $TemplateArray->HeaderContent;

$MenuBackground = $TemplateArray->MenuBackground;
$MenuImage = $TemplateArray->MenuImage;
$MenuHeight = $TemplateArray->MenuHeight;
$MenuWidth = $TemplateArray->MenuWidth;
$MenuContent = $TemplateArray->MenuContent;

$ContentBackground = $TemplateArray->ContentBackground;
$ContentBackgroundRepeat = $TemplateArray->ContentBackgroundRepeat;
$ContentWidth = $TemplateArray->ContentWidth;
$ContentHeight = $TemplateArray->ContentHeight;
$ContentScroll = $TemplateArray->ContentScroll; 

$FooterImage = $TemplateArray->FooterImage;
$FooterBackground = $TemplateArray->FooterBackground;
$FooterBackgroundRepeat = $TemplateArray->FooterBackgroundRepeat;
$FooterWidth = $TemplateArray->FooterWidth;
$FooterHeight = $TemplateArray->FooterHeight; 
$FooterContent = $TemplateArray->FooterContent;
$TemplateWidth = $TemplateArray->TemplateWidth;

$query = "SELECT TemplateWidth from template_settings where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
$TemplateWidth = $db->queryUniqueValue($query);
if ($TemplateWidth == '')
	$TemplateWidth = $TemplateArray->TemplateWidth;
$shrink = 1.5;

//$query = "SELECT * from template_settings where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
//$TemplateSettingsArray = $db->queryUniqueObject($query);

//if ($HeaderWidth == '')
	//$HeaderWidth  = $TemplateSettingsArray->HeaderWidth;
	
if ($HeaderWidth == '')
	$HeaderWidth = (650/$shrink).'px';
else if (($HeaderWidth == '100%')|| ($HeaderWidth == '0'))
	$HeaderWidth = (800/$shrink).'px';

$HeaderWidth = 'width:'.$HeaderWidth.';';
	
if ($HeaderHeight == '')
	$HeaderHeight = (600/$shrink).'px';
else if (($HeaderHeight == '100%')|| ($HeaderHeight == '0'))
	$HeaderHeight = (600/$shrink).'px';

$HeaderHeight = 'height:'.$HeaderHeight.';';

/*
if ($HeaderImage == '')
	$HeaderImage  = $TemplateSettingsArray->HeaderImage;
	
if ($HeaderBackground == '')
	$HeaderBackground  = $TemplateSettingsArray->HeaderBackground;
if ($HeaderBackground != '')
	$HeaderBackground  ='background-image:url('.$HeaderImage.')';	
	
if ($HeaderBackgroundRepeat == '')
	$HeaderBackgroundRepeat  = $TemplateSettingsArray->HeaderBackgroundRepeat;
if ($HeaderBackgroundRepeat == '')
	$HeaderBackgroundRepeat  = 'no-repeat';
if ($HeaderBackgroundRepeat != '')
	$HeaderBackgroundRepeat  = 'background-repeat:'.$HeaderBackgroundRepeat.';';
	
if ($HeaderContent == '')
	$HeaderContent  = $TemplateSettingsArray->HeaderContent;


$HeaderStyle = $HeaderWidth.$HeaderHeight.'" onClick="edit_template_section(\'Header\',\''.$ProjectID.'\',\''.$TemplateCode.'\',\''.$SkinCode.'\',\''.$_GET['themeid'].'\');" onMouseOver="adrollover(this.id);" onMouseOut="adrollout(this.id);" class="adlink';
$HeaderContent = $HeaderImage.$HeaderContent;



if ($ContentWidth == '')
	$ContentWidth = (650/$shrink).'px';
else if (($ContentWidth == '100%')|| ($ContentWidth == '0'))
	$ContentWidth = (800/$shrink).'px';

$ContentWidth = 'width:'.$ContentWidth.';';
	
if ($ContentHeight == '')
	$ContentHeight = (600/$shrink).'px';
else if (($ContentHeight == '100%')|| ($ContentHeight == '0'))
	$ContentHeightpx = (600/$shrink).'px';
$ContentHeightpx = '400px';
$ContentHeight = 'height:'.$ContentHeightpx.';';
/*	
if ($ContentBackground == '')
	$ContentBackground  = $TemplateSettingsArray->ContentBackground;
	
if ($ContentBackground != '')
	$ContentBackground  ='background-image:url('.$ContentBackground.')';	

	
if ($ContentBackgroundRepeat == '')
	$ContentBackgroundRepeat  = $TemplateSettingsArray->ContentBackgroundRepeat;
if ($ContentBackgroundRepeat == '')
	$ContentBackgroundRepeat  = 'no-repeat';
if ($ContentBackgroundRepeat != '')
	$ContentBackgroundRepeat  = 'background-repeat:'.$ContentBackgroundRepeat.';';

if ($ContentScroll == '')
	$ContentScroll = $TemplateSettingsArray->ContentScroll;

if ($ContentScroll != '')
	$ContentScroll = 'overflow:'.$ContentScroll.';';
	
$ContentStyle = $ContentWidth.$ContentHeight.'" onClick="edit_template_section(\'Content\',\''.$ProjectID.'\',\''.$TemplateCode.'\',\''.$SkinCode.'\',\''.$_GET['themeid'].'\');" onMouseOver="adrollover(this.id);" onMouseOut="adrollout(this.id);" class="adlink';
$ContentContent = '';		

if (($MenuWidth == '100%')|| ($MenuWidth == '0'))
	$MenuWidth = (800/$shrink).'px';

else $MenuWidth = '150px';

$MenuWidth = 'width:'.$MenuWidth.';';
	
if ($MenuHeight == '')
	$MenuHeight = $ContentHeightpx;

$MenuHeight = 'height:'.$MenuHeight.';';


if ($MenuImage == '')
	$MenuImage  = $TemplateSettingsArray->MenuImage;
	
if ($MenuBackground == '')
	$MenuBackground  = $TemplateSettingsArray->MenuBackground;
if ($MenuBackground != '')
	$MenuBackground  ='background-image:url('.$MenuBackground.')';	
		
if ($MenuBackgroundRepeat == '')
	$MenuBackgroundRepeat  = $TemplateSettingsArray->MenuBackgroundRepeat;	
if ($MenuBackgroundRepeat == '')
	$MenuBackgroundRepeat  = 'no-repeat';
if ($MenuBackgroundRepeat != '')
	$MenuBackgroundRepeat  = 'background-repeat:'.$MenuBackgroundRepeat.';';
	
if ($MenuContent == '')
	$MenuContent  = $TemplateSettingsArray->MenuContent;

$MenuStyle = $MenuWidth.$MenuHeight.'" onClick="edit_template_section(\'Menu\',\''.$ProjectID.'\',\''.$TemplateCode.'\',\''.$SkinCode.'\',\''.$_GET['themeid'].'\');" onMouseOver="adrollover(this.id);" onMouseOut="adrollout(this.id);" class="adlink';
$MenuContent = $MenuImage.$MenuContent;	

if ($FooterWidth == '')
	$FooterWidth = (650/$shrink).'px';
else if (($FooterWidth == '100%')|| ($FooterWidth == '0'))
	$FooterWidth = (800/$shrink).'px';

$FooterWidth = 'width:'.$FooterWidth.';';
	
if ($FooterHeight == '')
	$FooterHeight = (90/$shrink).'px';
else if (($FooterHeight == '100%')|| ($FooterHeight == '0'))
	$FooterHeight = (90/$shrink).'px';

$FooterHeight = 'height:'.$FooterHeight.';';

/*	
if ($FooterImage == '')
	$FooterImage  = $TemplateSettingsArray->FooterImage;
	
if ($FooterBackground == '')
	$FooterBackground  = $TemplateSettingsArray->FooterBackground;
if ($FooterBackground != '')
	$FooterBackground  ='background-image:url('.$FooterBackground.')';	
	
if ($FooterBackgroundRepeat == '')
	$FooterBackgroundRepeat  = $TemplateSettingsArray->FooterBackgroundRepeat;
if ($FooterBackgroundRepeat == '')
	$FooterBackgroundRepeat  = 'no-repeat';

if ($FooterBackgroundRepeat != '')
	$FooterBackgroundRepeat  ='background-repeat:'.$FooterBackgroundRepeat.';';	
	
if ($FooterContent == '')
	$FooterContent  = $TemplateSettingsArray->FooterContent;

$FooterStyle = $FooterWidth.$FooterHeight.'" onClick="edit_template_section(\'Footer\',\''.$ProjectID.'\',\''.$TemplateCode.'\',\''.$SkinCode.'\',\''.$_GET['themeid'].'\');"';
$FooterContent = $FooterImage.$FooterContent;



$TemplateHTML=str_replace("{HeaderStyle}",$HeaderStyle,$TemplateHTML);
$TemplateHTML=str_replace("{HeaderContent}","<div class='spacer'></div>HEADER AREA<div class='spacer'></div>",$TemplateHTML);

$TemplateHTML=str_replace("{MenuStyle}",$MenuStyle,$TemplateHTML);
$TemplateHTML=str_replace("{MenuContent}","<div class='spacer'></div>MENU AREA<div class='spacer'></div>",$TemplateHTML);

$TemplateHTML=str_replace("{ContentStyle}",$ContentStyle,$TemplateHTML);
$TemplateHTML=str_replace("{ContentContent}","<div class='spacer'></div>MAIN CONTENT AREA<div class='spacer'></div>",$TemplateHTML);

$TemplateHTML=str_replace("{FooterStyle}",$FooterStyle,$TemplateHTML);
$TemplateHTML=str_replace("{FooterContent}","<div class='spacer'></div>FOOTER AREA<div class='spacer'></div>",$TemplateHTML);

$TemplateHTML=str_replace("{TemplateStyle}",'',$TemplateHTML);
} else {*/
$TemplateHTML=str_replace("{templatecode}",$TemplateCode,$TemplateArray->cms_box);
$TemplateHTML=str_replace("{themeid}",$_GET['themeid'],$TemplateHTML);
$TemplateHTML=str_replace("{projectid}",$ProjectID,$TemplateHTML);
$TemplateHTML=str_replace("{skincode}",$SkinCode,$TemplateHTML);

$db->close();
	?> 
    <table><tr><td valign="top">
  <table width="400" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="384" align="center"><table width="100%"><td align="left"><strong>Template Settings</strong></td><td align="right"><img src="http://www.wevolt.com/images/cms/cms_grey_question.jpg" class="navbuttons" tooltip="This is where you change the look of your actual template. Like uploading a header image, changing the width or height of a section or edit padding and alignment. Just click below on your desired section to begin editing." tooltip_position="left"/>&nbsp;&nbsp;</td></table>

                                                <div class="spacer"></div>
   <div style="border-bottom:dotted 1px #bababa;"></div>                     <div class="spacer"></div>                           
Click on your available template section below to edit them.<br />

 <div class="spacer"></div>
<div align="center">
<? echo $TemplateHTML;?>
</div>

 </td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        
         </td><td width="10"></td><td valign="top">               
       <table width="300" border="0" cellpadding="0" cellspacing="0"><tbody><tr> 
												<td id="grey_cmsBox_TL"></td> 
												<td id="grey_cmsBox_T"></td>
												<td id="grey_cmsBox_TR"></td></tr>
												<tr><td class="grey_cmsBox_L" background="http://www.wevolt.com/images/cms/grey_cms_box_L.png" width="8"></td>
												<td class="grey_cmsboxcontent" valign="top" width="284" align="center">    
                                                <div align="left">               
<strong>Template Width</strong>
<div class="spacer"></div>    
</div><div style="border-bottom:dotted 1px #bababa;"></div>
<div class="spacer"></div>       
<div align="left">You can leave this at 100% unless you want to force the width of your site on any size screen</div>                    
<input id="TemplateWidth" name="TemplateWidth" value='<? if ($TemplateWidth == '') { echo '100%'; } else { echo $TemplateWidth;}?>' size="5" />
</td><td class="grey_cmsBox_R" background="http://www.wevolt.com/images/cms/grey_cms_box_R.png" width="8"></td>

						</tr><tr><td id="grey_cmsBox_BL"></td><td id="grey_cmsBox_B"></td>
						<td id="grey_cmsBox_BR"></td>
						</tr></tbody></table>
                        
              </td></tr></table>          
