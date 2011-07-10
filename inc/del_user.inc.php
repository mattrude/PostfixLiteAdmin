<?php

include_once('../functions.inc.php');

if (!isset($_REQUEST['username']))
        {
         $_REQUEST['username'] = 'dead';
        }
$username = $_REQUEST['username'];

if (!isset($_REQUEST['domain']))
  {
    $_REQUEST['domain'] = 'dead';
  }
$domain = $_REQUEST['domain'];

$delQuery = "DELETE FROM mailbox WHERE username = '$username'";
$dbHandle->exec($delQuery);

echo "<h2>Deleted $username</h2>";
echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=index.php?page=domain&domain=".$domain."'></head>";

?>
