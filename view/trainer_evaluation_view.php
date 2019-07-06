<?php require_once("header.php"); ?>
<div class="evaluation-list">
  <h1> My Evaluation list </h1>

  <ul>
  <?php
    if (count($getEval) > 0) {
      foreach ($getEval as $uneEval) {
        $evaluation_id = $uneEval["evaluation_id"];
        $correctedVal = $uneEval["corrected_at"];
        ?>
        <div class="evaluation-card">

        <? if($correctedVal == NULL){ ?>
          <li>Evalutation_id : <a href=<?= 'evaluation-' . $evaluation_id . '_evaluation_detail' ?>><?=$uneEval["evaluation_id"]?></a><?=" Group_id : " . $uneEval["group_id"].  " [ ". $uneEval["name"] . " ] Start: ".$uneEval["scheduled_at"]." End: " .$uneEval["ending_at"]?></li><br>          
        </div>
        <?php
      }
    } else {
      echo "Any evaluation is coming";
    }
    ?>
  <ul>
</div>

    <div class="quizID-list">
  <h1> Quiz List </h1>

  <ul>
  <?php
    if (count($getQuiz) > 0) {
      foreach ($getQuiz as $uneQuiz) {
        $trainer_id=$uneQuiz["creator_id"];
        $evaluation_id = $uneQuiz["evaluation_id"];
        $quiz_id = $uneQuiz["quiz_id"];
        $title = $uneQuiz["title"];
        ?>
        <div class="quiz-card">

        <!-- Based on sequence on Diagram -->
        <!-- /trainer-{trainer-id}-evaluations-{evaluation-id}-quiz-{quiz-id} -->

        <? if($correctedVal == NULL){ ?>
          <li>Quiz ID: <a href=<?= 'trainer-' . $trainer_id . '-evaluations-'.$evaluation_id.'-quiz-'.$quiz_id ?>><?=$title?></a></li><br>          
        </div>
        <?php
      }
    } else {
      echo "Any evaluation is coming";
    }
    ?>
  <ul>
</div>
    
<?php require_once ('footer.php'); ?>

