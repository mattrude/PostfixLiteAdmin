<?php

include_once('config.inc.php');
include_once('include/database.inc.php');

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

?>
