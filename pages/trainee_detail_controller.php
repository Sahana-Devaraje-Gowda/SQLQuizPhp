<?php
session_start();
$errors = array();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$trainee_id=$_GET['trainee_id'];  
include '../model/EvalDao.php';
$getEval = EvalDao::getTraineeDetails($trainee_id);

if (!isset($getEval) || is_array($getEval) == false) {
  $ex = " Evaluation is not define";
  $errors['eval'] = "The server endure the following error: " . $ex;
  include_once '../view/error_view.php';
}
require_once '../view/trainee_detail_view.php';
