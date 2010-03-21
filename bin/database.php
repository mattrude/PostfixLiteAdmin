<?php

// Connected to Database if it is there
try{
$dbHandle = new PDO("sqlite:$sqlite_dir/$sqlite_database");
}catch( PDOException $exception ){
        echo "Can NOT connect to database";
        die($exception->getMessage());
}

// check if table/s needs to be created
$table_check_alias = $dbHandle->exec('SELECT address FROM alias WHERE type = \'table\'');
if ( $table_check_alias === false ){
  $sqlCreateTable = 'CREATE TABLE alias (
  address varchar(255) NOT NULL,
  goto text NOT NULL,
  domain varchar(255) NOT NULL,
  created datetime NOT NULL default '0000-00-00 00:00:00',
  modified datetime NOT NULL default '0000-00-00 00:00:00',
  active tinyint(1) NOT NULL default '1');';
  $dbHandle->exec($sqlCreateTable);
}

$table_check_domain = $dbHandle->exec('SELECT domain FROM domain WHERE type = \'table\'');
if ( $table_check_domain === false ){
  $sqlCreateTable = 'CREATE TABLE domain (
  domain varchar(255) NOT NULL,
  description varchar(255) NOT NULL,
  aliases int(10) NOT NULL default '0',
  mailboxes int(10) NOT NULL default '0',
  maxquota bigint(20) NOT NULL default '0',
  quota bigint(20) NOT NULL default '0',
  transport varchar(255) NOT NULL,
  backupmx tinyint(1) NOT NULL default '0',
  created datetime NOT NULL default '0000-00-00 00:00:00',
  modified datetime NOT NULL default '0000-00-00 00:00:00',
  active tinyint(1) NOT NULL default '1' );';
  $dbHandle->exec($sqlCreateTable);
}

$table_check_mailbox = $dbHandle->exec('SELECT username FROM mailbox WHERE type = \'table\'');
if ( $table_mailbox === false ){
  $sqlCreateTable = 'CREATE TABLE mailbox (
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  maildir varchar(255) NOT NULL,
  local_part varchar(255) NOT NULL ),
  domain varchar(255) NOT NULL,
  quota bigint(20) NOT NULL default '0',
  quota_usage varchar(255),
  quota_usage_date varchar(255),
  created datetime NOT NULL default '0000-00-00 00:00:00',
  modified datetime NOT NULL default '0000-00-00 00:00:00',
  active tinyint(1) NOT NULL default '1' );';
  $dbHandle->exec($sqlCreateTable);
}

?>

