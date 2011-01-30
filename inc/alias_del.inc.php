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

$delQuery = "DELETE FROM alias WHERE address = '$address'";
$dbHandle->exec($delQuery);

echo "<h2>Deleted $address</h2>";
echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=view_domain.php?domain=".$domain."'></head>";

?>
