<?php require_once("header.php"); ?>


<div class="questionID-list">
  <h1> Question List </h1>
<!-- 
question_id
db_name
question_text
correct_answer
correct_result
theme_id
author_id
is_public
question_id
quiz_id
rank
 -->
  <ul>
  <?php
    if (count($question_list) > 0) {
      foreach ($question_list as $unequestion) {
        $db_name=$unequestion["db_name"];
        $question_text = $uneQuiz["question_text"];
        $rank = $uneQuiz["rank"];
        $question_id = $uneQuiz["question_id"];
        ?>
        <div class="question-card">

        <? if($correctedVal == NULL){ ?>
          <li>Question No. <?=$question_id?>: Question : <?=$question_text?> : Topic : <?=$db_name?> : Rank : <?=$rank?></li><br>          
        </div>
        <?php
      }
    } else {
      echo "No questions";
    }
    ?>
  <ul>
</div>

<?php require_once ('footer.php'); ?>

