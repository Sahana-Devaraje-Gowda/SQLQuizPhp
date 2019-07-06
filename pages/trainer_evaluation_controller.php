<?php

session_start();
$errors = array();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($_GET);
if (!isset($_SESSION["user"]["name"])) {
  $errors["connection"] = "You aren't connected";
  include '../view/login_view.php';
} else {
  $trainer_id = $_SESSION["user"]["person_id"];
  $is_trainer = $_SESSION["user"]["is_trainer"];
  if (!isset($trainer_id) || !isset($is_trainer)) {
    $ex = "trainer is not define or you aren't a trainer";
    $errors['trainer'] = "The server endure the following error: " . $ex;
    include_once '../view/error_view.php';
    //echo 'no';
  } else {
    if ($_SESSION["user"]["is_trainer"] == 1) {
        if ($_GET['trainer_id'] !== $trainer_id) {
            header('Location: trainer-' . $trainer_id . '_evaluation');
            // echo 'ok';
          } else {  
            try {
              include '../model/EvalDao.php';
              $getEval = EvalDao::getEvaluationsOfTrainer($trainer_id);
              //Get the quiz list
              $getQuiz = EvalDao::getQuizOfTrainer($trainer_id);
              if (!isset($getEval) || is_array($getEval) == false) {
                $ex = " Evaluation is not define";
                $errors['eval'] = "The server endure the following error: " . $ex;
                include_once '../view/error_view.php';
              }
              require_once '../view/trainer_evaluation_view.php';
            } catch (PDOException $ex) {
              $errors['PDOError'] = "The server endure the following error: " . $ex;
              include_once '../view/error_view.php';
            }
          }
    } elseif ($_SESSION["user"]["is_trainer"] == 0) {

      echo 'IN working !';
    } else {
      $ex = "trainer is not define ";
      $errors['trainer'] = "The server endure the following error: " . $ex;
      include_once '../view/error_view.php';
    }
  }
}
