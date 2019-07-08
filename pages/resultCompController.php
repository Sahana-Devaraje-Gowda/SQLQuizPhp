<?php

session_start();
$errors = array();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump($_GET);
            $question_id=$_GET["question_id"];
            $evaluation_id=$_GET["evaluation_id"];


            try {
              include '../model/EvalDao.php';
              $getResults = displayResults($question_id,$evaluation_id)
              if (!isset($getResults) || is_array($getResults) == false) {
                $ex = " Evaluation is not define";
                $errors['eval'] = "The server endure the following error: " . $ex;
                include_once '../view/error_view.php';
              }
              require_once '../view/results_view.php';
            } catch (PDOException $ex) {
              $errors['PDOError'] = "The server endure the following error: " . $ex;
              include_once '../view/error_view.php';
            }

}
