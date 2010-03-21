<?php

include_once('../config.inc.php');
include_once('../include/database.inc.php');

if (!empty($_POST['domain'])) {
        // generate INSERT query
        $domain = $_POST['domain'];
        $description = $_POST['description'];
        $aliases = $_POST['aliases'];
        $mailboxs = $_POST['mailboxs'];
        $maxquota = $_POST['maxquota'];
        $quota = $_POST['quota'];
        $transport = $_POST['transport'];
        $backupmx = $_POST['backupmx'];
        $active = $_POST['active'];
        $insQuery = "INSERT INTO domain VALUES ('$domain', '$description', '$aliases', '$mailboxs', '$maxquota', '$quota', '$transport', '$backupmx', datetime('NOW', 'localtime'), datetime('NOW', 'localtime'), '$active')";
        // execute query
        $dbHandle->exec($insQuery);
}

?><form action="#" method="post">
Domain Name: <input type="text" name="domain" /><br />
Domain Description: <input type="text" name="description" /><br />
Max Number of Aliases: <input type="text" size="3" name="aliases" /><br />
Max Number of Mailboxs: <input type="text" size="3" name="mailboxs" /><br />
Max Quota per Mailbox: <input type="text" size="3" name="maxquota" /><br />
Default Mailbox Quota: <input type="text" size="5" name="quota" /><br />
Transport Type: <input type="text" name="transport" /><br />
Backup MX Server for Domain?: <input type="checkbox" name="backupmx" /><br />
Is Domain Active?: <input type="checkbox" name="active" /><br />
<input type="submit" value="Create Domain" /></form><?php


?>
