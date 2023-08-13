<?php
$directory = './videos/'; // Directory where videos are stored
$files = glob($directory . '[Pp]*_m*_g*.mp4'); // Match the pattern

if (count($files) > 0) {
  $filename = basename($files[0]); // Get the first matching file
  echo $filename;
} else {
  echo 'No file found';
}
?>
