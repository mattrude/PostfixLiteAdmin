<?php

include_once('config.inc.php');
include_once('inc/database.inc.php');

function ByteSize($bytes) {
  $size = $bytes / 1000;
  if($size < 1024) {
    $size = number_format($size, 2);
    $size .= ' KB';
  } else {
    if($size / 1000 < 1024) {
      $size = number_format($size / 1024, 2);
      $size .= ' MB';
    } else if ($size / 1000 / 1024 < 1024) {
      $size = number_format($size / 1000 / 1024, 2);
      $size .= ' GB';
    }
  }
  return $size;
}

function CheckAlias($address) {

}

function AddDomain($domain) {
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
        $insQuery = "INSERT INTO domain ( domain, description, aliases, mailboxes, maxquota, quota, transport, backupmx, created, modified active ) VALUES ('$domain', '$description', '$aliases', '$mailboxes', '$maxquota', '$quota', '$transport', '$backupmx', datetime('NOW', 'localtime'), datetime('NOW', 'localtime'), '$active')";
        // execute query
        $dbHandle->exec($insQuery);
        echo "<head><meta HTTP-EQUIV='REFRESH' content='0; url=/PostfixLiteAdmin'></head>";
    } ?>
    <form action="/PostfixLiteAdmin/inc/add_domain.php" method="post">
    <table><tr><td><table border='0'>
    <tr><td>Domain Name: </td><td><input type="text" name="domain" /></td></tr>
    <tr><td>Domain Description: </td><td><input type="text" name="description" /></td></tr>
    <tr><td>Max Number of Aliases: </td><td><input type="text" size="3" value="25" name="aliases" /></td></tr>
    <tr><td>Max Number of Mailboxs: </td><td><input type="text" size="3" value="25" name="mailboxes" /></td></tr>
    <tr><td>Max Quota per Mailbox: </td><td><input type="text" size="3" value="2048" name="maxquota" /></td></tr>
    <tr><td>Default Mailbox Quota: </td><td><input type="text" size="5" value="1024" name="quota" /></td></tr>
    <tr><td>Transport Type: </td><td><input type="text" value="virtual" name="transport" /></td></tr>
    <tr><td>Backup MX Server for Domain?: </td><td><input type="checkbox" name="backupmx" /></td></tr>
    <tr><td>Is Domain Active?: </td><td><input type="checkbox" checked name="active" /></td></tr>
    </td></tr></table>
    <input type="submit" value="Create Domain" /></form><?php
}

?>
