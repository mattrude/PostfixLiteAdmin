<?php

include_once('./config.inc.php');
include_once('./include/database.inc.php');

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
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='./bin/view_domain.php?domain=" .$domain. "'>$domain</a></td><td>$description</td><td><a href='./bin/del_domain.php?domain=$domain'>del</a></td></tr>";
}
echo "</table></pre></td></tr></table>";

?>
