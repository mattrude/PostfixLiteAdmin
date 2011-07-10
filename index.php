<?php
echo "<head><link rel='stylesheet' href='style.css' type='text/css' media='screen' />
<body> 
<div id='content'> 
	<div id='primary' class='main'>";
include_once('functions.inc.php');

if (!empty($_GET)) {
  if ($_GET['page'] == 'create_user') {
    require_once('inc/user_create.inc.php');
  } elseif ($_GET['page'] == 'del_user') {
    require_once('inc/del_user.inc.php');
  } elseif ($_GET['page'] == 'domain') {
    require_once('inc/domain.inc.php');
  } elseif ($_GET['page'] == 'edit_domain') {
    require_once('inc/domain_edit.inc.php');
  } elseif ($_GET['page'] == 'edit_user') {
    require_once('inc/user_edit.inc.php');
  } elseif ($_GET['page'] == 'edit_alias') {
    require_once('inc/alias_edit.inc.php');
  } elseif ($_GET['page'] == 'del_alias') {
    require_once('inc/alias_del.inc.php');
  } elseif ($_GET['page'] == 'add_alias') {
    require_once('inc/alias_add.inc.php');
  }
} else {
  echo "<h2>Domains</h2>";
  echo "<a href='./bin/add_domain.php'>Add Domain</a>";
  
  $row_count = "0";
  $line_count = "0";
  
  echo "<table><tr><td><table border='0'>";
  $sqlShowBlocked = 'SELECT * FROM domain;';
  $result = $dbHandle->query($sqlShowBlocked);
  while ($entry = $result->fetch()) {
    $row_color = ($row_count % 2) ? $color1 : $color2;
    $domain = $entry['domain'];
    $description = $entry['description'];
  
    $row_count++;
    $line_count++;
    echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='index.php?page=domain&domain=" .$domain. "'>$domain</a></td><td>$description</td><td><a href='./bin/del_domain.php?domain=$domain'><div id='del'></div></a></td></tr>";
  }
  echo "</table></pre></td></tr></table>";
}
include_once('inc/footer.inc.php');

?>
