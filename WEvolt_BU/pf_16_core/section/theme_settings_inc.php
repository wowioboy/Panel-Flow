
<? 

$db = new DB($db_database,$db_host, $db_user, $db_pass);
$query = "SELECT * from templates where TemplateCode='$TemplateCode'";
$TemplateArray = $db->queryUniqueObject($query);
$TemplateHTML = $TemplateArray->HTMLCode;


$HeaderWidth = $TemplateArray->HeaderWidth;
$HeaderHeight = $TemplateArray->HeaderHeight;
$HeaderImage = $TemplateArray->HeaderImage;
$HeaderBackground = $TemplateArray->HeaderBackground;
$HeaderBackgroundRepeat = $TemplateArray->HeaderBackgroundRepeat;
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

$query = "SELECT * from template_settings where TemplateCode='$TemplateCode' and ProjectID='$ProjectID'";
$TemplateSettingsArray = $db->queryUniqueObject($query);

if (($HeaderWidth == '') || ($HeaderWidth == '0'))
	$HeaderWidth  = $TemplateSettingsArray->HeaderWidth;
if (($HeaderWidth == '') || ($HeaderWidth == '0'))
	$HeaderWidth = '800';
	
if ($HeaderWidth != '')
	$HeaderWidth = 'width:'. $HeaderWidth.'px;';
	
if (($HeaderHeight == '') || ($HeaderHeight == '0'))
	$HeaderHeight  = $TemplateSettingsArray->HeaderHeight;
if (($HeaderHeight == '') || ($HeaderHeight == '0'))
	$HeaderHeight = '100';

if ($HeaderHeight != '')
	$HeaderHeight = 'height:'. $HeaderHeight.'px;';	

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

$HeaderStyle = $HeaderWidth.$HeaderHeight.$HeaderBackground.$HeaderBackgroundRepeat.'onClick="edit_template_section(\'Header\',\''.$ProjectID.'\',\''.$TemplateCode.'\')onMouseOver="adrollover(this.id)" onMouseOut="adrollout(this.id);';
$HeaderContent = $HeaderImage.$HeaderContent;

if (($MenuWidth == '') || ($MenuWidth == '0'))
	$MenuWidth  = $TemplateSettingsArray->MenuWidth;
if (($MenuWidth == '') || ($MenuWidth == '0'))
	$MenuWidth = $MenuWidth;
if ($MenuWidth != '')
	$MenuWidth = 'width:'. $MenuWidth.'px;';
	
if (($MenuHeight == '') || ($MenuHeight == '0'))
	$MenuHeight  = $TemplateSettingsArray->MenuHeight;
if ($MenuHeight != '')
	$MenuHeight = 'height:'. $MenuHeight.'px;';
	
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
	
$MenuStyle = $MenuWidth.$MenuHeight.$MenuBackground.$MenuBackgroundRepeat.'onClick="edit_template_section(\'Menu\',\''.$ProjectID.'\',\''.$TemplateCode.'\')onMouseOver="adrollover(this.id)" onMouseOut="adrollout(this.id);';
$MenuContent = $MenuImage.$MenuContent;	
	
if (($ContentHeight == '') || ($ContentHeight == '0'))
	$ContentHeight  = $TemplateSettingsArray->ContentHeight;
if ($ContentHeight != '')
	$ContentHeight = 'height:'. $ContentHeight.'px;';
	
if (($ContentWidth == '') || ($ContentWidth == '0'))
	$ContentWidth  = $TemplateSettingsArray->ContentWidth;
if ($ContentWidth != '')
	$ContentWidth = 'width:'. $ContentWidth.'px;';
	
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
	
$ContentStyle = $ContentWidth.$ContentHeight.$ContentBackground.$ContentBackgroundRepeat.$ContentScroll.'onClick="edit_template_section(\'Content\',\''.$ProjectID.'\',\''.$TemplateCode.'\')onMouseOver="adrollover(this.id)" onMouseOut="adrollout(this.id);';
$ContentContent = '';		

if (($FooterWidth == '') || ($FooterWidth == '0'))
	$FooterWidth  = $TemplateSettingsArray->FooterWidth;
if (($FooterWidth == '') || ($FooterWidth == '0'))
	$FooterWidth = $HeaderWidth;

if ($FooterWidth != '')
	$FooterWidth = 'width:'. $FooterWidth.'px;';

if (($FooterHeight == '') || ($FooterHeight == '0'))
	$FooterHeight  = $TemplateSettingsArray->FooterHeight;
if ($FooterHeight != '')
	$FooterHeight = 'height:'. $FooterHeight.'px;';
	
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

$FooterStyle = $FooterWidth.$FooterHeight.$FooterBackground.$FooterBackgroundRepeat.';" onClick="edit_template_section(\'Footer\',\''.$ProjectID.'\',\''.$TemplateCode.'\')onMouseOver="adrollover(this.id)" onMouseOut="adrollout(this.id);';
$FooterContent = $FooterImage.$FooterContent;

$db->close();

$TemplateHTML=str_replace("{HeaderStyle}",$HeaderStyle,$TemplateHTML);
$TemplateHTML=str_replace("{HeaderContent}",$HeaderContent,$TemplateHTML);

$TemplateHTML=str_replace("{MenuStyle}",$MenuStyle,$TemplateHTML);
$TemplateHTML=str_replace("{MenuContent}",$MenuContent,$TemplateHTML);

$TemplateHTML=str_replace("{ContentStyle}",$ContentStyle,$TemplateHTML);
$TemplateHTML=str_replace("{ContentContent}",$contentContent,$TemplateHTML);

$TemplateHTML=str_replace("{FooterStyle}",$FooterStyle,$TemplateHTML);
$TemplateHTML=str_replace("{FooterContent}",$FooterContent,$TemplateHTML);

		
	?>
    
<div class="pagetitleLarge">BELOW ARE THE AVAILABLE AREAS FOR YOUR PROJECT's CURRENT TEMPLATE<br />
SELECT AN AREA BELOW TO EDIT: </div>

<script type="text/javascript">
function adrollover(linkid.id) {
			document.getElementById(linkid.id).className ='adlink_hover';
	}
	
function adrollout(linkid.id) {
			document.getElementById(linkid.id).className ='adlink';
	}

</script>

<div align="center">
<? echo $TemplateHTML;?>
</div>

