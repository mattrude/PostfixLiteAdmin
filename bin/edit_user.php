<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

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
  $active = $_POST['active'];
  $updQuery = "UPDATE mailbox SET username = '$local_part@$domain', password = '$password', name = '$name', local_part = '$local_part', domain = '$domain', quota = '$quota', modified = '$modified', modified = datetime('NOW', 'localtime'), active = '$active' WHERE username = '$user';";
  echo $updQuery;
  echo "<head><meta HTTP-EQUIV='REFRESH' content='5; url=view_domain.php?domain=".$domain."'></head>";
  $dbHandle->exec($updQuery);
}

$sqlShowBlocked = "SELECT * FROM mailbox WHERE domain = '$domain' AND username = '$user';";
$result = $dbHandle->query($sqlShowBlocked);
while ($entry = $result->fetch()) {
  $username = $entry['username'];
  $password = $entry['password'];
  $name = $entry['name'];
  $maildir = $entry['maildir'];
  $local_part = $entry['local_part'];
  $created = $entry['created'];
  $modified = $entry['modified'];
  $quota = $entry['quota'];
  $active = $entry['active'];
  if ($active == 'on') {$active='checked';} else {$active='';}

  echo "<form action='?domain=".$domain."&user=".$user."' method='post'>";
  echo "<table><tr><td><table border='0'>";
  echo "<tr><td>Editing User: </td><td><strong>$name</strong></td></tr>";
  echo "<tr><td>Name: </td><td><input type='text' value='".$name."' name='name' /></td></tr>";
  echo "<tr><td>User Name: </td><td><input type='text' value='".$local_part."' name='local_part' /></td></tr>";
  echo "<tr><td>Domain: </td><td>$domain</td></tr>";
  echo "<tr><td>Email Address: </td><td>$username</td></tr>";
  echo "<tr><td>Password: </td><td><input type='text' value='".$password."' name='password' /></td></tr>";
  echo "<tr><td>Mail Directory: </td><td><small>$maildir</small></td></tr>";
  echo "<tr><td>Quota: </td><td><input type='text' size='5' value='".$quota."' name='quota' />MB</td></tr>";
  echo "<tr><td>User Active?: </td><td><input type='checkbox' $active name='active' /></td></tr>";
  echo "<tr><td>Last Modified: </td><td>$modified</td></tr>";
  echo "<tr><td>Created on: </td><td>$created</td></tr>";
  echo "</td></tr></table>";
  echo "<input type='submit' value='Update Domain' /></form>";
}

?>
