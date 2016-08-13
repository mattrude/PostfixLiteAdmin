<?php

include_once('../functions.inc.php');

if (!isset($_REQUEST['address']))
        {
         $_REQUEST['address'] = 'dead';
        }
$address = $_REQUEST['address'];

if (!isset($_REQUEST['domain']))
  {
    $_REQUEST['domain'] = 'dead';
  }
$domain = $_REQUEST['domain'];

if (!isset($_REQUEST['switch_active']))
  {
    $_REQUEST['switch_active'] = 'dead';
  }
$switch_active = $_REQUEST['switch_active'];

if ($switch_active == 'on') {
  $updateQuery = "UPDATE mailbox SET active = 1 WHERE username = '$address'";
  $dbHandle->exec($updateQuery);
} elseif ($switch_active == 'off') {
  $updateQuery = "UPDATE mailbox SET active = 0 WHERE username = '$address'";
  $dbHandle->exec($updateQuery);
} else {
}

echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin/index.php?page=domain&domain=".$domain."'></head>"; ?>
