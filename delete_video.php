<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    $filepath = "videos/" . $filename . ".mp4";

    if (file_exists($filepath)) {
      unlink($filepath);
      echo "File deleted successfully";
    } else {
      echo "File not found";
    }
  } else {
    echo "No filename provided";
  }
?>