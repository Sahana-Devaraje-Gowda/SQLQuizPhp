<?php
session_start();
$errors = array();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$quiz_id=$_GET['quiz_id'];  
include '../model/EvalDao.php';
$question_list = EvalDao::getQuestions($quiz_id);

if (!isset($question_list) || is_array($question_list) == false) {
  $ex = " Evaluation is not define";
  $errors['eval'] = "The server endure the following error: " . $ex;
  include_once '../view/error_view.php';
}
require_once '../view/question_list_view.php';
