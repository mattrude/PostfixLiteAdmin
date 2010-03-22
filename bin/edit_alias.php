<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!isset($_REQUEST['domain']))
  {
    $_REQUEST['domain'] = 'dead';
  }
$domain = $_REQUEST['domain'];

if (!isset($_REQUEST['address']))
  {
    $_REQUEST['address'] = 'dead';
  }
$address = $_REQUEST['address'];

if (!empty($_POST['address'])) {
  $address = $_POST['address'];
  $goto = $_POST['goto'];
  $domain = $_POST['domain'];
  $modified = $_POST['modified'];
  $active = $_POST['active'];
  $updQuery = "UPDATE alias SET address = '$address@$domain', goto = '$goto', domain = '$domain', modified = '$modified', modified = datetime('NOW', 'localtime'), active = '$active' WHERE address = '$address@$domain';";
  echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=view_domain.php?domain=".$domain."'></head>";
  //echo $updQuery;
  $dbHandle->exec($updQuery);
}

$sqlShowAlias = "SELECT * FROM alias WHERE address = '$address';";
$result = $dbHandle->query($sqlShowAlias);
while ($entry = $result->fetch()) {
  $domain = $entry['domain'];
  $goto = $entry['goto'];
  $modified = $entry['modified'];
  $created = $entry['created'];
  $active = $entry['active'];
  if ($active == 'on') {$active='checked';} else {$active='';}

  echo "<form action='?domain=".$domain."&address=".$address."' method='post'>";
  echo "<table><tr><td><table border='0'>";
  echo "<tr><td>Email Address: </td><td><strong>$address</strong></td></tr>";
  echo "<tr><td>GO TO: </td><td><input type='text' value='".$goto."' name='name' /></td></tr>";
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
  echo "<input type='submit' value='Update Domain' /></form>";
}

?>
