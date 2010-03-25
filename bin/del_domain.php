<?php

include_once('../functions.inc.php');

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

        $insQuery = "DELETE FROM domain WHERE domain = '$domain'";
        $dbHandle->exec($insQuery);

echo "Deleted $domain";
echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin'></head>";

?>
