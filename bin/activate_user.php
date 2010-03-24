<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

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
  $updateQuery = "UPDATE mailbox SET active = 'on' WHERE username = '$address'";
  $dbHandle->exec($updateQuery);
} elseif ($switch_active == 'off') {
  $updateQuery = "UPDATE mailbox SET active = 'off' WHERE username = '$address'";
  $dbHandle->exec($updateQuery);
} else {
}

echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=view_domain.php?domain=".$domain."'></head>";

?>
