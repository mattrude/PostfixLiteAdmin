<?php

if (!isset($_REQUEST['domain']))
  {
    $_REQUEST['domain'] = 'dead';
  }
$domain = $_REQUEST['domain'];

if (!isset($_REQUEST['address']))
  {
    $_REQUEST['address'] = 'dead';
  }
$address_post = $_REQUEST['address'];

if (!isset($_REQUEST['user']))
  {
    $_REQUEST['user'] = 'dead';
  }
$user = $_REQUEST['user'];

if (!empty($_POST['goto'])) {
  $address = $address_post;
  $goto = $_POST['goto'];
  $domain = $domain;
  $modified = $_POST['modified'];
  $active_post = $_POST['active'];
  if ($active_post == 'on') {$active=1;} else {$active=0;}
  $updQuery = "UPDATE alias SET address = '$address_post', goto = '$goto', domain = '$domain', modified = datetime('NOW', 'localtime'), active = '$active' WHERE address = '$address_post';";
  $dbHandle->exec($updQuery);
  echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=index.php?page=edit_user&domain=".$domain."&user=".$user."'></head>";
}

$sqlShowAlias = "SELECT * FROM alias WHERE address = '$address_post';";
$result = $dbHandle->query($sqlShowAlias);
$entry = $result->fetch();
$address = $entry['address'];
$domain = $entry['domain'];
$goto = $entry['goto'];
$modified = $entry['modified'];
$created = $entry['created'];
$active = $entry['active'];
if ($active == 1) {$active='checked';} else {$active='';}

echo "<form action='index.php?page=edit_alias&domain=".$domain."&address=".$address."&user=".$user."' method='post'>";
echo "<table><tr><td><table border='0'>";
echo "<tr><td>Email Address: </td><td><strong>$address</strong></td></tr>";
echo "<tr><td>GO TO: </td><td><select name='goto'>";
$sqlAllAddress = "SELECT * FROM mailbox WHERE domain = '$domain';";
$result4 = $dbHandle->query($sqlAllAddress);
while ($entry4 = $result4->fetch()) {
  if ($goto == $entry4['username']) {$selected = 'selected';} else {$selected = '';}
  $alladdresses = $entry4['username'];
  echo "<option value='".$alladdresses."' $selected >".$alladdresses."</option>";
}

echo "</select></td></tr>";
echo "<tr><td>Domain: </td><td><select name='domain'>";
$sqlAllDomains = "SELECT * FROM domain;";
$result3 = $dbHandle->query($sqlAllDomains);
while ($entry3 = $result3->fetch()) {
  $thisdomain = $entry3['domain'];
  if ($domain == $thisdomain) { $selected = 'selected'; } else { $selected = '';}
  echo "<option value='".$thisdomain."' $selected >".$thisdomain."</option>";
}
echo "</select></td></tr>";
echo "<tr><td>Alias Active?: </td><td><input type='checkbox' $active name='active' /></td></tr>";
echo "<tr><td>Last Updated: </td><td>$modified</td></tr>";
echo "<tr><td>Created on: </td><td>$created</td></tr>";
echo "</td></tr></table>";
echo "<input type='submit' value='Update Alias' /></form>";

?>
