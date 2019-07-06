<?php

session_start();

if(!isset($_SESSION['user_sql_skills'])){
   header("Location: ./");
}
// Memorize the page to redirect to it if logging in
$_SESSION["page"] = $_SERVER["REQUEST_URI"];
// The Evaluation
$evaluation = null;
// Errors
$errors = array();


$trainer_id = filter_input(INPUT_GET, "trainer_id", FILTER_VALIDATE_INT);
if ($trainer_id === null // no value
  || $trainer_id == false) { // not an integer
  $errors["$trainer_id"] = "$trainer_id parameter must be set and integer (eg: $trainer_id-1)";
}
else {
  // Call the model
  require_once("../model/EvalDao.php");
  $evaluation = EvalDao::getEvaluationList($trainer_id);
}
// Sent to the view
require_once("../view/evaluation_view.php");



