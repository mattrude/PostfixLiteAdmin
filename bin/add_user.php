<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

if (!empty($_POST['local_part'])) {
        $local_part = $_POST['local_part'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $quota = $_POST['quota'];
        $active = $_POST['active'];
        $insQuery = "INSERT INTO mailbox VALUES ('$local_part@$domain', '$password', '$name', '$domain/$local_part@$domain/', '$local_part', '$domain', '$quota', datetime('NOW', 'localtime'), datetime('NOW', 'localtime'), '$active')";
        $dbHandle->exec($insQuery);
        echo $insQuery;
        echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin/bin/view_domain.php?domain=$domain'></head>";
} ?>
<form action="#" method="post">
<table><tr><td><table border='0'>
<tr><td>Username: </td><td><input type="text" name="local_part" />@<td><select name='domain'>";
  <?php $sqlAllDomains = "SELECT * FROM domain;";
  $result3 = $dbHandle->query($sqlAllDomains);
  while ($entry3 = $result3->fetch()) {
    $alldomain = $entry3['domain'];
    if ($domain == $alldomain) { $selected = 'selected'; } else { $selected = '';}
    echo "<option value='".$alldomain."' $selected >".$alldomain."</option>";
  } ?>
</select></td></tr>
<tr><td>Password: </td><td><input type="text" name="password" /></td></tr>
<tr><td>Full Name: </td><td><input type="text" name="name" /></td></tr>
<tr><td>Quota: </td><td><input type="text" size="5" value="1024" name="quota" />MB</td></tr>
<tr><td>Active: </td><td><input type="checkbox" checked name="active" />MB</td></tr>
</td></tr></table>
<input type="submit" value="Create User" /></form>
<?php


?>