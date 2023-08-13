<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $videoName = $_POST['videoName'];
  $videoName = str_replace('.mp4', '', $videoName);
  $playerID = strstr($videoName, '_', true);

  $pausePoint= $_POST['pausePoint'];

  $round = $_POST['round'];
  
  $fairness = $_POST["fairness"];
  $harm = $_POST["harm"];
  $harm2 = $_POST["harm2"];
  $feasibility = $_POST["feasibility"];
  $appropriateness = $_POST["appropriateness"];

  // Create a folder with the given video name if it does not exist
  $directory = "responses/" . $playerID . "/" . $videoName . "_" . $pausePoint;
  echo "directory". $directory;

  if (!is_dir($directory)) {
    if (!mkdir($directory, 0777, true)) {
      $error = error_get_last();
      die('Failed to create directory. Error was: ' . $error['message']);
   }
  }

  // Now we'll store it in a CSV file inside the created folder
  $file = fopen($directory . "/fairness_profile.csv", "a");
  if ($file === false) {
    die('Failed to open the file.');
  }
  
  // Enclose data into an array
  $data = [$fairness,$harm,$harm2, $feasibility,$appropriateness, date('Y-m-d H:i:s'), $_SERVER["REMOTE_ADDR"]];
  
  // fputcsv function will format the data as CSV and write it to the file
  fputcsv($file, $data);
  
  fclose($file);
}

?>
