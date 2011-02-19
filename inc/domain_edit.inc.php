<?php

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
        echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=index.php?page=domain&domain=".$domain."'></head>";
}

$sqlShowDomain = "SELECT * FROM domain WHERE domain = '$domain';";
$result = $dbHandle->query($sqlShowDomain);
while ($entry = $result->fetch()) {
  $description = $entry['description'];
  $aliases = $entry['aliases'];
  $mailboxes = $entry['mailboxes'];
  $maxquota = $entry['maxquota'];
  $quota = $entry['quota'];
  $transport = $entry['transport'];
  $backupmx = $entry['backupmx'];
  $created = $entry['created'];
  $modified = $entry['modified'];
  $active = $entry['active'];
  $virtual = '';
  $relay = '';
  $local = '';
  if ($backupmx == 'on') {$backupmx='checked';} else {$backupmx='';}
  if ($active == 'on') {$active='checked';} else {$active='';}
  if ($transport == 'virtual') {$virtual='selected';} else if ($transport == 'local') {$local='selected';} else if ($transport == 'relay') {$relay = 'selected';}

  echo "<form action='index.php?page=edit_domain&domain=".$domain."' method='post'>";
  echo "<table><tr><td><table border='0'>";
  echo "<tr><td>Domain Name: </td><td><strong>".$domain."</strong></td></tr>";
  echo "<tr><td>Domain Description: </td><td><input type='text' value='".$description."' name='description' /></td></tr>";
  echo "<tr><td>Max Number of Aliases: </td><td><input type='text' size='3' value='".$aliases."' name='aliases' /></td></tr>";
  echo "<tr><td>Max Number of Mailboxs: </td><td><input type='text' size='3' value='".$mailboxes."' name='mailboxes' /></td></tr>";
  echo "<tr><td>Max Quota per Mailbox: </td><td><input type='text' size='5' value='".$maxquota."' name='maxquota' />MB</td></tr>";
  echo "<tr><td>Default Mailbox Quota: </td><td><input type='text' size='5' value='".$quota."' name='quota' />MB</td></tr>";
  echo "<tr><td>Transport Type: </td><td>
    <select name='transport'>
      <option value='virtual' ".$virtual." >Virtual</option>
      <option value='relay' ".$relay.">Relay</option>
      <option value='local' ".$local.">Local</option>
    </select></td></tr>";
  echo "<tr><td>Backup MX Server for Domain?: </td><td><input type='checkbox' $backupmx name='backupmx' /></td></tr>";
  echo "<tr><td>Is Domain Active?: </td><td><input type='checkbox' $active name='active' /></td></tr>";
  echo "<tr><td>Date Last Updated: </td><td>$modified</td></tr>";
  echo "<tr><td>Date Created: </td><td>$created</td></tr>";
  echo "</td></tr></table>";
  echo "<input type='hidden' value='".$domain."' name='domain' />";
  echo "<input type='submit' value='Update Domain' /></form>";
}

?>
