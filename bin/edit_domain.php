<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

if (!empty($_POST['domain'])) {
        // generate INSERT query
        $domain = $_POST['domain'];
        $description = $_POST['description'];
        $aliases = $_POST['aliases'];
        $mailboxes = $_POST['mailboxes'];
        $maxquota = $_POST['maxquota'];
        $quota = $_POST['quota'];
        $transport = $_POST['transport'];
        $backupmx = $_POST['backupmx'];
        $active = $_POST['active'];
        $updQuery = "UPDATE domain SET domain = '$domain', description = '$description', aliases = '$aliases', mailboxes = '$mailboxes', maxquota = '$maxquota', quota = '$quota', transport = '$transport', backupmx = '$backupmx', modified = datetime('NOW', 'localtime'), active = '$active' WHERE domain= '$domain';";
        $dbHandle->exec($updQuery);
        echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin/bin/view_domain.php?domain=".$domain."'></head>";
}

$sqlShowBlocked = "SELECT * FROM domain WHERE domain = '$domain';";
$result = $dbHandle->query($sqlShowBlocked);
while ($entry = $result->fetch()) {
  $description = $entry['description'];
  $aliases = $entry['aliases'];
  $mailboxes = $entry['mailboxes'];
  $maxquota = $entry['maxquota'];
  $quota = $entry['quota'];
  $transport = $entry['transport'];
  $backupmx = $entry['backupmx'];
  $active = $entry['active'];
  if ($backupmx == 'on') {$backupmx='checked';} else {$backupmx='';}
  if ($active == 'on') {$active='checked';} else {$active='';}


echo "<form action='#' method='post'>";
echo "<table><tr><td><table border='0'>";
echo "<tr><td>Domain Name: </td><td><input type='text' value='".$domain."' name='domain' /></td></tr>";
echo "<tr><td>Domain Description: </td><td><input type='text' value='".$description."' name='description' /></td></tr>";
echo "<tr><td>Max Number of Aliases: </td><td><input type='text' size='3' value='".$aliases."' name='aliases' /></td></tr>";
echo "<tr><td>Max Number of Mailboxs: </td><td><input type='text' size='3' value='".$mailboxes."' name='mailboxes' /></td></tr>";
echo "<tr><td>Max Quota per Mailbox: </td><td><input type='text' size='3' value='".$maxquota."' name='maxquota' /></td></tr>";
echo "<tr><td>Default Mailbox Quota: </td><td><input type='text' size='5' value='".$quota."' name='quota' /></td></tr>";
echo "<tr><td>Transport Type: </td><td><input type='text' value='".$transport."' name='transport' /></td></tr>";
echo "<tr><td>Backup MX Server for Domain?: </td><td><input type='checkbox' $backupmx name='backupmx' /></td></tr>";
echo "<tr><td>Is Domain Active?: </td><td><input type='checkbox' $active name='active' /></td></tr>";
echo "</td></tr></table>";
echo "<input type='submit' value='Update Domain' /></form>";

}

?>
