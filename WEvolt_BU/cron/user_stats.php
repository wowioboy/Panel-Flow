<? 
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php';
$DB = new DB();
$CurrentDayRange = date('Y-m-d 00:00:00');
$yesterdaystart=date("Y-m-d", time()-86400).' 00:00:00';
$yesterdayend=date("Y-m-d", time()-86400).' 23:59:59';
print '<br/>------------USERS----------------<br/>';
$query = "select count(*) from users";
$TotalUsers = $DB->queryUniqueValue($query);
print 'Total Users = ' . $TotalUsers.'<br/><br/>';

$query = "select count(*) from users where joindate>='".date("Y-m-d")." 00:00:00' and joindate<='".date("Y-m-d")." 23:59:59'";
$TotalNewUsers = $DB->queryUniqueValue($query);
print 'Total New Users Today = ' . $TotalNewUsers.'<br/><br/>';

$query = "select count(*) from users where joindate>='$yesterdaystart' and joindate<='$yesterdayend'";
$TotalNewUsers = $DB->queryUniqueValue($query);
print 'Total New Users on '.date("m/d/Y", time()-86400).' = ' . $TotalNewUsers.'<br/>';

$query = "select count(*) from users where joindate>='".date("Y-m-d", time()-172800)." 00:00:00' and joindate<='".date("Y-m-d", time()-172800)." 23:59:59'";
$TotalNewUsers = $DB->queryUniqueValue($query);
print 'Total New Users on '.date("m/d/Y", time()-172800).' = ' . $TotalNewUsers.'<br/>';

$query = "select count(*) from users where joindate>='".date("Y-m-d", time()-259200)." 00:00:00' and joindate<='".date("Y-m-d", time()-259200)." 23:59:59'";
$TotalNewUsers = $DB->queryUniqueValue($query);
print 'Total New Users on '.date("m/d/Y", time()-259200).' = ' . $TotalNewUsers.'<br/>';
print '<br/>------------SUBSCRIPTIONS----------------<br/>';
$query = "select count(*) from pf_subscriptions where Status='active' and SubscriptionType='hosted' and OrderID!=0";
$TotalProCreators = $DB->queryUniqueValue($query);
print 'Total Pro Creator Subscriptions = ' . $TotalProCreators.'<br/>';

$query = "select count(*) from pf_subscriptions where Status='active' and SubscriptionType='hosted' and OrderID!=0 and (CreatedDate>='$yesterdaystart' and CreatedDate<='$yesterdayend')";
$TotalProCreators = $DB->queryUniqueValue($query);
print 'Total Pro Creator Signed up today = ' . $TotalProCreators.'<br/>';

$query = "select count(*) from pf_subscriptions where Status='active' and Temp=1";
$TotalTemp = $DB->queryUniqueValue($query);
print 'Total Promotional Subscriptions= ' . $TotalTemp.'<br/>';

$query = "select count(*) from pf_subscriptions where Status='active' and SubscriptionType='fan' and OrderID!=0";
$TotalSuperFan = $DB->queryUniqueValue($query);
print 'Total SuperFan Subscriptions = ' . $TotalSuperFan.'<br/>';

$query = "select count(*) from pf_subscriptions where Status='active' and SubscriptionType='fan' and OrderID!=0 and (CreatedDate>='$yesterdaystart' and CreatedDate<='$yesterdayend')";
$TotalProCreators = $DB->queryUniqueValue($query);
print 'Total SuperFans Signed up today = ' . $TotalProCreators.'<br/>';

print '<br/>------------PROJECTS----------------<br/>';
$query = "select count(*) from projects where installed=1 and Published=1";
$TotalProjects = $DB->queryUniqueValue($query);
print 'Total Projects  = ' . $TotalProjects.'<br/>';

$query = "select count(*) from comic_pages";
$TotalPages = $DB->queryUniqueValue($query);
print 'Total Comic Pages  = ' . $TotalPages.'<br/>';

$DB->close();
?>