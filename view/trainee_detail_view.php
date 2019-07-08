<?php require_once("header.php"); 
?>

<div class="trainee-details">
  <h1> Trainee-Detail </h1>
    <ul>
    <?php 
    foreach($getEval as $uneEval) {
        $person_id = $uneEval["person_id"];
        $name = $uneEval["name"];
        $first_name = $uneEval["first_name"];
    ?>
        <li>Person_id : <?=$person_id?></li>
        <li>name : <?=$name?> <?=$first_name?></li>

<?php  }  ?>

    </ul>

    <h1> Question-List </h1>
    <ul>
  <?php
    if (count($getEval2) > 0) {
      foreach ($getEval2 as $unequestion) {
        $db_name=$unequestion["db_name"];
        $question_text = $unequestion["question_text"];
        $rank = $unequestion["rank"];
        $question_id = $unequestion["question_id"];
        ?>
        <div class="question-card">

        <? if($correctedVal == NULL){ ?>
          <li>Question No. <a href=""><?=$question_id?></a> [ <?=$question_text?> ] Topic : <?=$db_name?> Rank : <?=$rank?></li><br>          
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