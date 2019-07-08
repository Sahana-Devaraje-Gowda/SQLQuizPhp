
<?php require_once("header.php"); ?>
<div class="results-list">
  <h1> Results</h1>

  <ul>

  <table style="width:100%" border="1">
  <tr>
          <th>question_text</th>
          <th>student answer</th> 
          <th>student result</th>
          <th>correct_answer</th>
          <th>correct_result</th>
          
        </tr>
  <?php
    if (count($getResults) > 0) {
      foreach ($getResults as $uneResults) {
        $question_text = $uneResults["question_text"];
        $answer = $uneResults["answer"];
        $result = $uneResults["result"];
        $correct_answer = $uneResults["correct_answer"];
        $correct_result = $uneResults["correct_result"];
    
        ?>
          <tr>
          <th><?=$question_text?></th>
          <th><?=$answer?></th> 
          <th><?=$result?></th>
          <th><?=$correct_answer?></th>
          <th><?=$correct_result?></th>
          
        </tr>
        <?php
        }
    } 
    ?>
    </table>
  <ul>
</div>
<?php require_once ('footer.php'); ?>

