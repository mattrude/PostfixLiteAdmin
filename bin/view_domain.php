<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

echo "<h2>Options and Users in Domain $domain</h2>";

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
  if ($backupmx == 'on') {$backupmx='yes';} else {$backupmx='no';}
  if ($active == 'on') {$active='yes';} else {$active='no';}

echo "<strong>Domain Name: </strong>$domain<br />";
echo "<strong>Domain Description: </strong>$description";
echo "<table><tr><td><table border='0'>";
echo "<tr><td>Max Number of Aliases: </td><td>$aliases</td><td>Max Number of Mailboxes: </td><td>$mailboxes</td></tr>";
echo "<tr><td>Default User Quota: </td><td>$quota MB</td><td>Default Transport: </td><td>$transport</td></tr>";
echo "<tr><td>Backup MX Domain: </td><td>$backupmx</td><td>Domain Active: </td><td>$active</td></tr>";
echo "</td></tr></table>";
echo "<a href='edit_domain.php?domain=$domain'>Edit Domain</a> <a href='../'>Back to Domain List</a>";

}

echo "<h3>Users in Domain</h3>";
echo "<a href='add_user.php?domain=$domain'>Add User</a><br />";
echo "<table><tr><td><table border='0'>";
echo "<tr><td></td><td>Name:</td><td>Email Address:</td><td>Mail Directory:</td><td>Quota:</td><td>Modified Last:</td><td>Active:</td><td></td><td></tr>";
$sqlShowUsers = "SELECT * FROM mailbox WHERE domain = '$domain';";
$result2 = $dbHandle->query($sqlShowUsers);
while ($entry2 = $result2->fetch()) {
  $row_color = ($row_count % 2) ? $color1 : $color2;
  $name = $entry2['name'];
  $username = $entry2['username'];
  $maildir = $entry2['maildir'];
  $quota = $entry2['quota'];
  $modified = $entry2['modified'];
  $active = $entry2['active'];
  if ($active == 'on') {$active='yes';} else {$active='no';}

  $row_count++;
  $line_count++;
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='edit_user.php?domain=" .$domain. "&user=" .$username. "'>$name</a></td><td>$username</td><td><small>$maildir</small></td><td>$quota MB</td><td><small>$modified<small></td><td>$active</td><td><a href='del_user.php?username=$username&domain=$domain'>del</a></td></tr>";
}
echo "</table></pre></td></tr></table>";

?>

