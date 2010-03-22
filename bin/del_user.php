<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

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
echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=view_domain.php?domain=".$domain."'></head>";

?>
