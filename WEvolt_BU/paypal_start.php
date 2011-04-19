<? 
function randomPrefix($length) {
$random= "";

srand((double)microtime()*1000000);

$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
$data .= "0FGH45OP89";

for($i = 0; $i < $length; $i++) {
$random .= substr($data, (rand()%(strlen($data))), 1);

}
return $random;
}


// Include the paypal library
if ($_GET['t'] == 'sub') {
	include_once ('gateway/Paypal_subscribe.php');
} else {
	include_once ('gateway/Paypal.php');
}
include 'includes/init.php';
$PageTitle = 'payapl processing';
$TrackPage = 0;
include_once('cart/cart-functions.php');
include_once('cart/common.php');
include_once 'cart/checkout-functions.php';

$date = date('Y-m-d h:i:s');
$PurchaseID = randomPrefix(15); 
$UserID = $_SESSION['userid'];
if (($_GET['type'] == 'selfbook')||($_GET['type'] == 'selfmerch')||($_GET['type'] == 'selfprint')) {
	$query = "SELECT * from users_data where UserID='$UserID'";
	$StoreArray = $InitDB->queryUniqueObject($query);
} else{
	$query = 'SELECT * from pf_store';
	$StoreArray = $InitDB->queryUniqueObject($query);
	
}
// Create an instance of the paypal library
$myPaypal = new Paypal();

if ($_GET['t'] == 'sub') {		
	$SubID = $_GET['subid'];
	$Domain = $_GET['domain'];
	$Type = $_GET['type'];
	$query = "SELECT * from pf_subscription_types where ID='$SubID'";
	$SubscriptionArray = $InitDB->queryUniqueObject($query);
	
	$query = "SELECT * from pf_subscriptions where UserID='$UserID' and SubscriptionType ='$Type' and Status!='active'";
	$SubArray = $InitDB->queryUniqueObject($query);
	$SubStatus = $SubArray->Status;
	
	
	
		$PurchaseID = randomPrefix(15); 
		$query = "INSERT into tbl_order (od_date, od_type, od_transaction_id, od_status, od_total_cost, od_total_paid, refID) values ('$date','subscription','$PurchaseID','new','".$SubscriptionArray->Price."','".$SubscriptionArray->Price."','".$_GET['p']."')";
		$InitDB->execute($query);
		$query = "SELECT od_id from tbl_order where od_transaction_id='$PurchaseID'";
		$OrderID = $InitDB->queryUniqueValue($query);
		$query = "INSERT into tbl_order_item (od_id, sub_id,Complete,refID) values ('$OrderID', '$SubID',1,'".$_GET['p']."')";
		$InitDB->execute($query);	
		$query = "INSERT into user_orders (orderid, userid) values ('$OrderID', '$UserID')";
		$InitDB->execute($query);	
		
		if (($SubStatus != '') && ($SubStatus != 'Active')) {
			if ($Type == 'application') {
			$query = " UPDATE pf_subscriptions set Status='pending',OrderID='$OrderID', TypeID='$SubID' where SubscriptionType='application' and UserID='$UserID'";
			}else if ($Type == 'hosted') {
			$query = " UPDATE pf_subscriptions set Status='pending',OrderID='$OrderID', LastUpdated='$date', TypeID='$SubID' where  SubscriptionType='hosted' and UserID='$UserID'";
			}else if ($Type == 'fan') {
			$query = " UPDATE pf_subscriptions set Status='pending',OrderID='$OrderID', LastUpdated='$date', TypeID='$SubID' where  SubscriptionType='fan' and UserID='$UserID'";
			}
			$InitDB->execute($query);
		} else {
			$query = "INSERT into pf_subscriptions (UserID, Status,OrderID, TypeID, SubscriptionType, SubscriptionDomain,SuperFanRef) values ('$UserID','pending','$OrderID','$SubID', '$Type','$Domain','".$_GET['p']."')";
			$InitDB->execute($query);
		}
	
//print $query;
	$TrialPeriod = $SubscriptionArray->TrialPeriod;
	$ItemName = $SubscriptionArray->Name;
	
	$Code = $SubscriptionArray->ProductCode;
	$Price = $SubscriptionArray->Price;
	$Frequency = $SubscriptionArray->Frequency;
	$SubTerm = $SubscriptionArray->SubTerm;
	
    $TrialMeasure =  $SubscriptionArray->TrialMeasure;
	
		if ($_GET['modify'] >0) {
			$myPaypal->addField('modify', '2');
			if ($Type == 'fan'){
				if ($_GET['p'] != '')
					$ItemName = 'adding $2.00 to your current $'.$Price.'/month SuperFan subscription -- adding '. str_replace('_', ' ',$_GET['p']);	
	
				$Price = ((intval($Price)*$_GET['modify']) + 2).'.00';
			}
		}
		$myPaypal->addField('item_number', $Code);
	$myPaypal->addField('item_name', $ItemName);
	if ($TrialPeriod != '') {
		$myPaypal->addField('a1', '0');
		$myPaypal->addField('p1', $TrialPeriod);
		$myPaypal->addField('t1', $TrialMeasure);
		$myPaypal->addField('a3', $Price);
		$myPaypal->addField('p3', $Frequency);
		$myPaypal->addField('t3', $SubTerm);
		$myPaypal->addField('src', '1');
		$myPaypal->addField('sra', '1');
	} else {
		$myPaypal->addField('a3', $Price);
		$myPaypal->addField('p3', $Frequency);
		$myPaypal->addField('t3', $SubTerm);
	}
	$myPaypal->addField('currency_code', 'USD');
} else if ($_GET['t'] == 'product') {		
	$ProductID = $_GET['id'];
	$Type = $_GET['type'];	
	$query = "SELECT * from pf_store_items where EncryptID='$ProductID' and ProductType='$Type'";
	$ProductArray = $InitDB->queryUniqueObject($query);
		$PurchaseID = randomPrefix(15); 
		$query = "INSERT into tbl_order (od_date, od_type, od_transaction_id, od_status, od_total_cost, od_total_paid) values ('$date','product','$PurchaseID','new','".$ProductArray->Price."','".$ProductArray->Price."')";
		$InitDB->execute($query);
		
		$query = "SELECT od_id from tbl_order where od_transaction_id='$PurchaseID'";
		$OrderID = $DB->queryUniqueValue($query);
		$query = "INSERT into tbl_order_item (od_id, pd_id,Complete) values ('$OrderID', '$ProductID',1)";
		$InitDB->execute($query);	
		//print $query;
		$query = "INSERT into user_orders (orderid, userid) values ('$OrderID', '$UserID')";
		$InitDB->execute($query);	
			
//print $query;
	$ItemName = $ProductArray->ShortTitle;
	$Code = $ProductArray->ProductCode;
	$Price = $ProductArray->Price;
	$Shipping = $ProductArray->ShippingRate;
	$myPaypal->addField('item_number_1', $Code);
	$myPaypal->addField('item_name_1', $ItemName);
    $myPaypal->addField('amount_1', $Price);

	$myPaypal->addField('quantity_1', '1');
	$myPaypal->addField('currency_code', 'USD');
	if (($_GET['type'] == 'selfbook')||($_GET['type'] == 'selfmerch')||($_GET['type'] == 'selfprint')) {
	        $query = "UPDATE tbl_order set 
			          od_shipping_first_name='".mysql_real_escape_string($_POST['txtShippingFirstName'])."',
					  od_shipping_last_name='".mysql_real_escape_string($_POST['txtShippingLastName'])."',
					  od_shipping_address1='".mysql_real_escape_string($_POST['txtShippingAddress1'])."',
					  od_shipping_address2='".mysql_real_escape_string($_POST['txtShippingAddress2'])."',
					  od_shipping_city='".mysql_real_escape_string($_POST['txtShippingCity'])."',
					  od_shipping_state='".mysql_real_escape_string($_POST['txtShippingState'])."',
					  od_shipping_postal_code='".mysql_real_escape_string($_POST['txtShippingPostalCode'])."',
					  od_shipping_phone='".mysql_real_escape_string($_POST['txtShippingPhone'])."',
					  od_shipping_email='".mysql_real_escape_string($_POST['txtShippingEmail'])."' 
					  where od_id='$OrderID'";
			$InitDB->execute($query);			  
			$myPaypal->addField('address1',$_POST['txtShippingAddress1']);
			$myPaypal->addField('address2', $_POST['txtShippingAddress2']);
			$myPaypal->addField('city', $_POST['txtShippingCity']);
			$myPaypal->addField('state',$_POST['txtShippingState']);
			$myPaypal->addField('zip', $_POST['txtShippingPostalCode']);
			$myPaypal->addField('first_name', $_POST['txtShippingFirstName']);
			$myPaypal->addField('last_name', $_POST['txtShippingLastName']);
			$myPaypal->addField('no_shipping', 2);
			$myPaypal->addField('shipping_1', $Shipping);
	} else {
			$myPaypal->addField('no_shipping', 1);
	}
	
} else {
	$orderId= $_SESSION['orderId'];
	$query = "UPDATE tbl_order set od_transaction_id ='$PurchaseID' where od_id='$orderId'";
	$InitDB->execute($query);
//print $query;
	$query = "SELECT * from tbl_order_item where od_id='$orderId'";
	$InitDB->query($query);
//print $query;
	$Count = 1;
	while ($orderitem = $InitDB->fetchNextObject()) { 
		$ProductID = $orderitem->pd_id;
		$query = "SELECT * from pf_store_items where ID='$ProductID'";
		$ProductArray = $DB->queryUniqueObject($query);
//print $query;
		$Quanity = $orderitem->od_qty;
		$ItemName = $ProductArray->ShortTitle;
		$ShippingRate = $ProductArray->ShippingRate;
		$Code = $ProductArray->ProductCode;
		$Price = $ProductArray->Price;
		$Quanity1 = $ProductArray->Quanity1;
		$QuanityPrice = $ProductArray->QuanityPrice1;
		$myPaypal->addField('item_name_'.$Count, $ItemName);
		$myPaypal->addField('shipping_'.$Count, $ShippingRate);
		
		$myPaypal->addField('amount_'.$Count, $Price);
		$myPaypal->addField('item_number_'.$Count, $Code);
		$myPaypal->addField('quantity_'.$Count, $Quanity);
		$Count++;
	}
}

// Specify your paypal email
$myPaypal->addField('business', $StoreArray->PayPalEmail);
// Specify the currency
$myPaypal->addField('currency_code', 'USD');

// Specify the url where paypal will send the user on success/failure
$SERVER = $_SERVER['SERVER_NAME'];


if (($Type == 'hosted') ||($Type == 'fan')){
	$myPaypal->addField('return', 'http://www.wevolt.com/register.php?a=pro&r=success&p='.$_GET['p'].'&type='.$Type);
	$myPaypal->addField('cancel_return', 'http://www.wevolt.com/register.php?a=pro&d=cancel');
} else {
	$myPaypal->addField('return', 'http://www.wevolt.com/store.php?r=success');
	$myPaypal->addField('cancel_return', 'http://www.wevolt.com/store.php?r=cancel');
}

// Specify the url where paypal will send the IPN
$myPaypal->addField('notify_url', 'http://www.wevolt.com/gateway/paypal_ipn.php');
// Specify the product information
// Specify any custom value
$myPaypal->addField('custom', $PurchaseID);
// Enable test mode if needed
//$myPaypal->enableTestMode();
// Let's start the train!
unset($_SESSION['orderId']);

require_once('includes/pagetop_inc.php');
$Site->drawModuleCSS();

?>

<div align="center">
<table cellpadding="0" cellspacing="0" border="0" width="<? echo $TemplateWrapperWidth;?>">
  <tr>
    <td valign="top" align="center">
    <div class="content_bg">
		<? if ($_SESSION['userid'] != '') {?>
            <div id="controlnav">
                <?php $Site->drawControlPanel(); ?>
            </div>
        <? }?>
        <? if ($_SESSION['noads'] != 1) {?>
            <div id="ad_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;" align="center">
                <iframe src="" allowtransparency="true" width="728" height="90" frameborder="0" scrolling="no" name="top_ads" id="top_ads"></iframe>
            </div>
        <?  }?>
       
       
        <div id="header_div" style="background-color:#FFF;width:<? echo $SiteTemplateWidth;?>px;">
           <? $Site->drawHeaderWide();?>
        </div>
    </div>
    
     <div class="shadow_bg">
        	 <? $Site->drawSiteNavWide();?> 
    </div>
    
     <div class="content_bg" id="content_wrapper">
         <!--Content Begin -->
         <div class="spacer"></div>
          <? $myPaypal->submitPayment();?>
			 <div class="spacer"></div>		 
             <div class="spacer"></div>
					 				  
                     
                     
    </div>

	</td>
  </tr>
  <tr>
      <td style="background-image:url(http://www.wevolt.com/images/bottom_frame_no_blue.png); background-repeat:no-repeat;width:1058px;height:12px;">
      </td>
  </tr>
</table>
</div>

<?php require_once('includes/pagefooter_inc.php'); ?>

