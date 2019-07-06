<?php
// Evaluation view
// Data : $product, $bids
require_once("../model/DB.php");
?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="static/auction.css"/>
   <title>Quiz Manager - (id <?= $evaluation["evaluation_id"] ?>)</title>

   <?php include("header_styles.php"); ?>
  
   </head>
   <body>
      <?php include("header.php"); ?>

	  <div class="container">
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Evaluation Id</th>
                  <th>Quiz Id</th>
                  <th>Title</th>
                  <th>Scheduled At</th>
                  <th>Ending At</th>
                  <th>Corrected At</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($evaluation as $eve) {
                  ?>
                  <tr>
                     <td ><a href="<?= 'trainer-' . $eve["creator_id"] . 'evaluations-' . $eve["evaluation_id"] ?>"><?= $eve["evaluation_id"] ?></a></td>
                     <td><a href="<?= 'trainer-' . $eve["creator_id"] . 'evaluations-' . $eve["evaluation_id"] . 'quiz-' .$eve["quiz_id"] ?>"><?= $eve["quiz_id"] ?></a></td>
                     <td><?= $eve["title"] ?></td>
                     <td><?=  $eve["scheduled_at"] ?></td>
                     <td><?=  $eve["ending_at"] ?></td>
                     <td><?=  $eve["corrected_at"] ?></td>
                  </tr>
                  <?php
               }
               ?>
            </tbody>
         </table>  
      </div>

   </body>
   
   <?php include("page_scripts.php"); ?>

</html>