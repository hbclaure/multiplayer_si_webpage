<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $videoName= $_POST["videoName"];
  $videoName = str_replace('.mp4', '', $videoName);
  $playerID = strstr($videoName, '_', true);
  if (preg_match('/_g([^_]+)/', $videoName, $matches)) {
    $gameNo = $matches[1]; // the game unique ID
  }



  $trust = $_POST["fullfair"];
  $relationship1 = $_POST["nao_shutter_relationship"];
  $relationship2 = $_POST["nao_human_relationship"];
  $support = $_POST["support"];
  $directory = "responses/" . $playerID . "/" ;
  $file = fopen($directory . "/survey_g" . $gameNo . ".csv", "a");
 
  if ($file === false) {
    die('Failed to open the file.');
  }



  // Store the response in a file or a database
  // Now we'll store it in a CSV file
  // $file = fopen("responses2.csv", "a");

  // Enclose data into an array
  $data = [$trust, $relationship1, $relationship2, $support, date('Y-m-d H:i:s'), $_SERVER["REMOTE_ADDR"]];

  // fputcsv function will format the data as CSV and write it to the file
  fputcsv($file, $data);
  
  fclose($file);
}
?>