<?php 
    //var_dump($_GET);
    $evaluation_id = $_GET["evaluation_id"];
    $complete = $_GET["complete"];
    if($complete=="true") {
        include '../model/EvalDao.php';
        $getEval = EvalDao::setCompleted($evaluation_id);
        
    } 
    header('Location: ./evaluation-' . $evaluation_id . '_evaluation_detail');
?>