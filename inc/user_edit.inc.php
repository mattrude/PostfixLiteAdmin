<?php
echo "<head><link rel='stylesheet' href='../style.css' type='text/css' media='screen' />";

include_once('../functions.inc.php');

if (!isset($_REQUEST['domain']))
  {
    $_REQUEST['domain'] = 'dead';
  }
$domain = $_REQUEST['domain'];

if (!isset($_REQUEST['user']))
  {
    $_REQUEST['user'] = 'dead';
  }
$user = $_REQUEST['user'];

if (!empty($_POST['local_part'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $maildir = $_POST['maildir'];
  $local_part = $_POST['local_part'];
  $modified = $_POST['modified'];
  $quota = $_POST['quota'];
  $active_post = $_POST['active'];
  if ($active_post == 'on') {$active=1;} else {$active=0;}
  $updQuery = "UPDATE mailbox SET username = '$local_part@$domain', password = '$password', name = '$name', local_part = '$local_part', domain = '$domain', quota = '$quota', modified = '$modified', modified = datetime('NOW', 'localtime'), active = $active WHERE username = '$user';";
  echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=view_domain.php?domain=".$domain."'></head>";
  //echo $updQuery;
  $dbHandle->exec($updQuery);
}

  if ($_POST['switch_active'] == 'active') {
    echo "active";
    $updateQuery = "UPDATE mailbox SET active = 'on' WHERE username = '$username'";
    $dbHandle->exec($updateQuery);
  } elseif ($_POST['switch_active'] == 'deactive') {
    echo "deactive";
    $updateQuery = "UPDATE mailbox SET active = 'off' WHERE username = '$username'";
    $dbHandle->exec($updateQuery);
  }

$sqlShowBlocked = "SELECT * FROM mailbox WHERE domain = '$domain' AND username = '$user';";
$result = $dbHandle->query($sqlShowBlocked);
$entry = $result->fetch();

$username = $entry['username'];
$password = $entry['password'];
$name = $entry['name'];
$maildir = $entry['maildir'];
$local_part = $entry['local_part'];
$created = $entry['created'];
$modified = $entry['modified'];
$quota = $entry['quota'];
$active = $entry['active'];
if ($active == 1) {$active='checked';} else {$active='';}

echo "<form action='?domain=".$domain."&user=".$user."' method='post'>";
echo "<table><tr><td><table border='0'>";
echo "<tr><td>Editing User: </td><td><strong>$name</strong></td></tr>";
echo "<tr><td>Name: </td><td><input type='text' value='".$name."' name='name' /></td></tr>";
echo "<tr><td>User Name: </td><td><input type='text' value='".$local_part."' name='local_part' /></td></tr>";
echo "<tr><td>Domain: </td><td><select name='domain'>";
$sqlAllDomains = "SELECT * FROM domain;";
$result3 = $dbHandle->query($sqlAllDomains);
while ($entry3 = $result3->fetch()) {
  $alldomain = $entry3['domain'];
  if ($domain == $alldomain) { $selected = 'selected'; } else { $selected = '';}
  echo "<option value='".$alldomain."' $selected >".$alldomain."</option>";
}
echo "</select></td></tr>";
echo "<tr><td>Email Address: </td><td>$username</td></tr>";
echo "<tr><td>Password: </td><td><input type='text' value='".$password."' name='password' /></td></tr>";
echo "<tr><td>Mail Directory: </td><td><small>$maildir</small></td></tr>";
echo "<tr><td>Quota: </td><td><input type='text' size='5' value='".$quota."' name='quota' />MB</td></tr>";
echo "<tr><td>User Active?: </td><td><input type='checkbox' $active name='active' /></td></tr>";
echo "<tr><td>Last Updated: </td><td>$modified</td></tr>";
echo "<tr><td>Created on: </td><td>$created</td></tr>";
echo "</td></tr></table>";
echo "<input type='submit' value='Update User' /></form>";

echo "<h3>Aliases for $name</h3>";
echo "<a href='add_alias.php?domain=$domain'>Add Alias</a><br />";
echo "<table border='0'>";
echo "<tr><td></td><td>Deliver Mail Sent To</td><td>Modified Last</td><td>Active</td><td></td><td></tr>";
$sqlShowAlias = "SELECT * FROM alias WHERE goto = '$username';";
$result5 = $dbHandle->query($sqlShowAlias);
while ($entry5 = $result5->fetch()) {
  $row_color = ($row_count % 2) ? $color1 : $color2;
  $address = $entry5['address'];
  $goto_post = $entry5['goto'];
  $modified = $entry5['modified'];
  $active = $entry5['active'];
  if ($active == 1) {$active='check';$switch_active='off';} else {$active='del';}

  $line_count++;
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='edit_alias.php?domain=" .$domain. "&address=" .$address. "'>$address</a></td><td><small>$modified<small></td><td><center><div id=$active></div></center></td><td><a href='del_alias.php?address=$address&domain=$domain'><img border=0 src='../images/icon_del.png'></a></td></tr>";
}
echo "</table></pre></td></tr></table>";

?>
