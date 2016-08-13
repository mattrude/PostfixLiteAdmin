<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/PostfixLiteAdmin/css/jumbotron-narrow.css">
</head>
<body> 
<div class="container"> 
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="/PostfixLiteAdmin/">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">PostfixLiteAdmin</h3>
      </div>

<?php
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
  } elseif ($_GET['page'] == 'add_domain') {
    require_once('inc/add_domain.inc.php');
  } elseif ($_GET['page'] == 'edit_user') {
    require_once('inc/user_edit.inc.php');
  } elseif ($_GET['page'] == 'edit_alias') {
    require_once('inc/alias_edit.inc.php');
  } elseif ($_GET['page'] == 'del_alias') {
    require_once('inc/del_alias.inc.php');
  } elseif ($_GET['page'] == 'add_alias') {
    require_once('inc/alias_add.inc.php');
  }
} else {
  echo "<h2>Domains</h2>";
  echo "<a href='index.php?page=add_domain'>Add Domain</a>";
  
  $row_count = "0";
  $line_count = "0";
  
  echo "<table class='table table-striped'>";
  $sqlShowBlocked = 'SELECT * FROM domain;';
  $result = $dbHandle->query($sqlShowBlocked);
  while ($entry = $result->fetch()) {
    $domain = $entry['domain'];
    $description = $entry['description'];
    $active = $entry['active'];
    if ($active == 1) {$active='check';$switch_active='off';} else {$active='del';$switch_active='on';}
    $row_count++;
    $line_count++;
    echo "<tr><td>$line_count</td><td><a href='index.php?page=domain&domain=" .$domain. "'>$domain</a></td><td>$description</td><td><center><div id=$active></div></center></td><td><a href='./bin/del_domain.php?domain=$domain'><div id='del'></div></a></td></tr>";
  }
  echo "</table></pre>";
}

include_once('inc/footer.inc.php');

?>
