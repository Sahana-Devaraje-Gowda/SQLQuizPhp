<?php require_once("header.php"); ?>

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
</div>

<?php require_once ('footer.php'); ?>