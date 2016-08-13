<?php

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
<form action="#" method="post">
  <div class="col-sm-5">
    <p>Domain Name:</p>
    <p>Domain Description:</p>
    <p>Max Number of Aliases:</p>
    <p>Max Number of Mailboxs:</p>
    <p>Max Quota per Mailbox:</p>
    <p>Default Mailbox Quota:</p>
    <p>Transport Type:</p>
    <p>Backup MX Server for Domain?:</p>
    <p>Is Domain Active?:</p>
  </div>
  <div class="col-sm-offset-5">
    <p><input type="text" name="domain" /></p>
    <p><input type="text" name="description" /></p>
    <p><input type="text" size="3" value="25" name="aliases" /></p>
    <p><input type="text" size="3" value="25" name="mailboxes" /></p>
    <p><input type="text" size="3" value="2048" name="maxquota" /></p>
    <p><input type="text" size="5" value="1024" name="quota" /></p>
    <p><input type="text" value="virtual" name="transport" /></p>
    <p><input type="checkbox" name="backupmx" /></p>
    <p><input type="checkbox" checked name="active" /></p>
  </div>
  <input class="btn btn-primary col-sm-offset-6" type="submit" value="Create Domain" />
</form>
