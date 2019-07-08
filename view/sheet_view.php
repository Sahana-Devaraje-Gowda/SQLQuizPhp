<?php require_once("header.php"); ?>
<html>
  <head>
    <script src="../static/jquery-3.3.1.js"></script>
    <script src="../static/app.js"></script>
  </head>
  <body>
<div class="Evaluation-Detail">
  <h1> Evaluation-Detail </h1>
  <ul>
  <?php
    foreach($getEval as $uneEval) {
        $evaluation_id = $uneEval["evaluation_id"];
        $title =$uneEval["title"];
        $scheduled_at =$uneEval["scheduled_at"];
        $ending_at = $uneEval["ending_at"];
        $corrected_at = $uneEval["corrected_at"];
        $quiz_id = $uneEval["quiz_id"];
    ?>  
      <div calss = "evaluation-detail">
        <li>Evaluation_id : <?=$evaluation_id?></li>
        <li>Quiz_id : <a href=<?= 'quiz-' . $quiz_id . '_quiz_detail' ?>><?=$quiz_id?></a></li>
        <li>Title : <?=$title?></li>
        <li>Scheduled_at : <?=$scheduled_at?></li>
        <li>Ending_at : <?=$ending_at?></li>
    <?php if(count($corrected_at) > 0) { ?>
        <li>Corrected_at : <?=$corrected_at?></li><br>
    <?php } 
        else { ?>
        <a href="complete.php?complete=true&evaluation_id=<?=$evaluation_id?>" onClick="">Complete</a>
    <?php }  ?>
      </div>
<?php  break; } ?>
  </ul>
  <h1> Trainee-list </h1>
    <ul>
      <?php 
      foreach($getEval as $uneEval) {
          $evaluation_id = $uneEval["evaluation_id"];
          $trainee_id = $uneEval["trainee_id"];
          $quiz_id = $uneEval["quiz_id"];
          ?>
      <li>Trainee_id : <a href=<?= 'trainee-'.$trainee_id .'_quiz_id-'.$quiz_id.'_evaluation_id-'.$evaluation_id.'_trainee_detail'?>><?=$trainee_id?></a></li>
   <?php  } ?>
    </ul>
</div>
<?php require_once ('footer.php'); ?>
  </body>
</html>
