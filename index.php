<?php

include_once('./config.inc.php');
include_once('./bin/database.inc.php');

echo "<h2>Domains</h2>";


$row_count = "0";
$line_count = "0";

echo "<table><tr><td><table border='0'>";
$sqlShowBlocked = 'SELECT * FROM domain;"';
$result = $dbHandle->query($sqlShowBlocked);
while ($entry = $result->fetch()) {
  $row_color = ($row_count % 2) ? $color1 : $color2;
  $domain = $entry['domain'];
  $description = $entry['description'];

  $row_count++;
  $line_count++;
  echo "<tr bgcolor='$row_color'><td>$line_count</td><td>$domain</td><td>$description</td></tr>";
}
echo "</table></pre></td></tr></table>";

?>
