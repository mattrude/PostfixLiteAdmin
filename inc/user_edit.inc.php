<?php
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
  $dbHandle->exec($updQuery);
  echo "<h2>User updated</h2>";
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

echo "<form action='index.php?page=edit_user&domain=".$domain."&user=".$user."' method='post'>";
echo "<table border='0'>";
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
echo "<a href='index.php?page=add_alias&domain=$domain'>Add Alias</a><br />";
echo "<table class='table table-striped'>";
echo "<tr><td></td><td>Deliver Mail Sent To</td><td>Modified Last</td><td>Active</td><td></td><td></tr>";
$sqlShowAlias = "SELECT * FROM alias WHERE goto = '$username';";
$result5 = $dbHandle->query($sqlShowAlias);
$row_count = 0;
$line_count = 0;
while ($entry5 = $result5->fetch()) {
  $row_color = ($row_count % 2) ? $color1 : $color2;
  $address = $entry5['address'];
  $goto_post = $entry5['goto'];
  $modified = $entry5['modified'];
  $active = $entry5['active'];
  if ($active == 1) {$active='check';} else {$active='del';}

  $line_count++;
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='index.php?page=edit_alias&domain=" .$domain. "&address=" .$address. "&user=" .$user. "'>$address</a></td><td><small>$modified<small></td><td><center><div id=$active></div></center></td><td><a href='ndex.php?page=del_alias&address=$address&domain=$domain'><img border=0 src='images/icon_del.png'></a></td></tr>";
}
echo "</table></pre>";

?>
