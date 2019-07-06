<?php
    session_start();
    $errors = array();
    include '../model/EvalDao.php';

    $evaluation_id = $_GET["evaluation_id"];
    $getEval = EvalDao::getDetailOfEvaluation($evaluation_id);
    require_once '../view/sheet_view.php';
?>