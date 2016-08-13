<?php

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

echo "<h2>Options and Users in Domain $domain</h2>";

$sqlShowBlocked = "SELECT * FROM domain WHERE domain = '$domain';";
$result = $dbHandle->query($sqlShowBlocked);
$entry = $result->fetch();

$description = $entry['description'];
$aliases = $entry['aliases'];
$mailboxes = $entry['mailboxes'];
$maxquota = $entry['maxquota'];
$quota = ByteSize($entry['quota']);
$transport = $entry['transport'];
$backupmx = $entry['backupmx'];
$active = $entry['active'];
if ($backupmx == '1') {$backupmx='Yes';} else {$backupmx='No';}
if ($active == '1') {$active='Yes';} else {$active='No';}
?>

<strong>Domain Name: </strong><?php echo $domain; ?> <br />
<strong>Domain Description: </strong> <?php echo $description; ?>

<div>
<div class="col-sm-5">
Max Number of Aliases: <?php echo $aliases; ?><br />
Default User Quota: <?php echo $quota; ?><br />
Backup MX Domain: <?php echo $backupmx; ?>
</div>
<div class="col-sm-offset-5">
Max Number of Mailboxes: <?php echo $mailboxes; ?><br />
Default Transport: <?php echo $transport; ?><br />
Domain Active: <?php echo $active; ?>
</div>
</div>
<br />
<div class="col-sm-offset-0">
<a href='index.php?page=edit_domain&domain=<?php echo $domain; ?>'>Edit Domain</a> | <a href='index.php'>Back to Domain List</a><br />
</div>
<br />
<?php
######################################################################
## Users in the Domain

echo "<h3>Users in Domain</h3>";
echo "<a href='index.php?page=create_user&domain=$domain'>Add User</a><br />";
echo "<table class='table table-striped'><tr><td></td><td>Name:</td><td>Email Address:</td><td>Quota:</td><td>Modified Last:</td><td>Active:</td><td></td></tr>";
$sqlShowUsers = "SELECT * FROM mailbox WHERE domain = '$domain';";
$result2 = $dbHandle->query($sqlShowUsers);
while ($entry2 = $result2->fetch()) {
  $row_color = ($line_count % 2) ? $color1 : $color2;
  $name = $entry2['name'];
  $username = $entry2['username'];
  $quota = ByteSize($entry2['quota']);
  $modified = $entry2['modified'];
  $active = $entry2['active'];
  if ($active == 1) {$active='glyphicon-ok';$active_color='green';$switch_active='off';} else {$active='glyphicon-remove';$active_color='red';$switch_active='on';}

  $line_count++;
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='index.php?page=edit_user&domain=" .$domain. "&user=" .$username. "'>$name</a></td><td>$username</td><td>$quota</td><td><small>$modified<small></td><td><center><a href='bin/activate_user.php?switch_active=$switch_active&address=$username&domain=$domain'><div style='color:$active_color;' class='glyphicon $active'></div></a></center></td><td><center><a href='index.php?page=del_user&username=$username&domain=$domain'><img border=0 src='images/icon_del.png'></a></center></td></tr>";
}
echo "</td></tr></table>";

######################################################################
## Aliases in the Domain

echo "<h3>Aliases in Domain</h3>";
echo "<a href='index.php?page=add_alias&domain=$domain'>Add Alias</a><br />";
echo "<table class='table table-striped'>";
echo "<tr><td></td><td>Email Address:</td><td>Deliver Mail To:</td><td>Modified Last:</td><td>Active:</td><td></td></tr>";
$sqlShowAlias = "SELECT * FROM alias WHERE domain = '$domain';";
$result5 = $dbHandle->query($sqlShowAlias);
while ($entry5 = $result5->fetch()) {
  $row_color = ($line_count2 % 2) ? $color1 : $color2;
  $address = $entry5['address'];
  $goto_post = $entry5['goto'];
  $domain = $entry5['domain'];
  $modified = $entry5['modified'];
  $active = $entry5['active'];
  $goto = str_replace(",", "<br />", $goto_post);
  if ($active == 1) {$active='glyphicon-ok';$active_color='green';$switch_active='off';} else {$active='glyphicon-remove';$active_color='red';$switch_active='on';}

  $line_count2++;
  echo "<tr bgcolor='$row_color'><td>$line_count2</td><td><a href='index.php?page=edit_alias&?domain=" .$domain. "&address=" .$address. "'>$address</a></td><td>$goto</td><td><small>$modified<small></td><td><center><a href='activate_alias.php?switch_active=$switch_active&address=$address&domain=$domain'><div style='color:$active_color;' class='glyphicon $active'></div></a></center></td><td><a href='index.php?page=del_alias&address=$address&domain=$domain'><img border=0 src='images/icon_del.png'></a></td></tr>";
}
echo "</table>";


include_once('functions.inc.php');
?>

