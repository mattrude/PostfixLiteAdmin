<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!isset($_REQUEST['domain']))
        {
         $_REQUEST['domain'] = 'dead';
        }
$domain = $_REQUEST['domain'];

if (!empty($_POST['goto'])) {
        $address = $_POST['address'];
        $goto = $_POST['goto'];
        $domain = $_POST['domain'];
        $active = $_POST['active'];
        $insQuery = "INSERT INTO alias VALUES ('$address@$domain', '$goto', '$domain', datetime('NOW', 'localtime'), datetime('NOW', 'localtime'), '$active')";
        $dbHandle->exec($insQuery);
        //echo $insQuery;
        echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin/bin/view_domain.php?domain=$domain'></head>";
} ?>
<form action="#" method="post">
<table><tr><td><table border='0'>
<tr><td>Alias Email Address: </td><td><input type="text" name="address" />@<td><select name='domain'>;
  <?php $sqlAllDomains = "SELECT * FROM domain;";
  $result3 = $dbHandle->query($sqlAllDomains);
  while ($entry3 = $result3->fetch()) {
    $alldomain = $entry3['domain'];
    if ($domain == $alldomain) { $selected = 'selected'; } else { $selected = '';}
    echo "<option value='".$alldomain."' $selected >".$alldomain."</option>";
  } ?>
</select></td></tr>
<tr><td>Address To Send Mail To: </td><td><select name='goto'>";
  <?php $sqlAllDomains = "SELECT * FROM mailbox;";
  $result4 = $dbHandle->query($sqlAllDomains);
  while ($entry4 = $result4->fetch()) {
    $alladdresses = $entry4['username'];
    echo "<option value='".$alladdresses."' $selected >".$alladdresses."</option>";
  } ?>
</select></td></tr>

<tr><td>Active: </td><td><input type="checkbox" checked name="active" /></td></tr>
</td></tr></table>
<input type="submit" value="Create User" /></form>
<?php


?>
